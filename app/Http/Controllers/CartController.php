<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use App\Mail\OrderPlacedAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $total = 0;
    $products = [];
    $discount = 0;

    if ($user) {
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $product->quantity = $cartItem->quantity; 
            $products[] = $product;
        }

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->getPrice());
    } else {
        
        $productsInSession = $request->session()->get("products", []);
        foreach ($productsInSession as $id => $quantity) {
            $product = Product::find($id);
            if ($product) {
                $product->quantity = $quantity; 
                $products[] = $product;
            }
        }

        $total = array_sum(array_map(fn($product) => $product->quantity * $product->getPrice(), $products));
    }

    $couponCode = $request->input('coupon_code');
    if ($couponCode) {
        $coupon = Coupon::where('code', $couponCode)->first();

        if ($coupon) {
            if ($coupon->type == 'percentage') {
                $discount = ($total * $coupon->value) / 100;
            } elseif ($coupon->type == 'fixed') {
                $discount = $coupon->value;
            }

            $discount = min($discount, $total);
        } else {
            return redirect()->route('cart.index')->with('error', 'Código de cupón inválido.');
        }
    }

    $viewData = [];
    $viewData["title"] = "Carrito - Tienda Online";
    $viewData["subtitle"] = "Carrito de compras";
    $viewData["total"] = $total - $discount;
    $viewData["discount"] = $discount;
    $viewData["products"] = $products;

    return view('cart.index')->with("viewData", $viewData);
}


    public function add(Request $request, $id)
    {
        $quantity = $request->input("quantity", 1);

        if ($quantity <= 0) {
            return redirect()->route('cart.index')->with('error', 'La cantidad debe ser mayor que 0.');
        }

        $user = Auth::user();

        if ($user) {

            $cartItem = Cart::where('user_id', $user->id)
                            ->where('product_id', $id)
                            ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $products = $request->session()->get("products", []);
            $products[$id] = ($products[$id] ?? 0) + $quantity;
            $request->session()->put('products', $products);
        }

        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito.');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            Cart::where('user_id', $user->id)->delete();
        } else {
            $request->session()->forget('products');
        }

        return back()->with('success', 'Carrito vaciado correctamente.');
    }

    public function purchase(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('cart.index')->with('error', 'Necesitas iniciar sesión para realizar una compra.');
    }

    DB::beginTransaction();

    try {
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->getPrice());

        if ($user->getBalance() < $total) {
            return redirect()->route('cart.index')->with('error', 'Fondos insuficientes. Por favor, recarga tu cuenta.');
        }

        $order = new Order();
        $order->user_id = $user->id;
        $order->total = $total;
        $order->save();

        foreach ($cartItems as $cartItem) {
            $item = new Item();
            $item->quantity = $cartItem->quantity;
            $item->price = $cartItem->product->getPrice();
            $item->product_id = $cartItem->product->id;
            $item->order_id = $order->id;
            $item->save();
        }

        $newBalance = $user->getBalance() - $total;
        $user->setBalance($newBalance);
        $user->save();

        $cartItems->each->delete(); 

        DB::commit();

        Mail::to($user->email)->send(new OrderPlaced($order));

        $adminEmail = 'alvaro.s268463@cesurformacion.com'; 
        Mail::to($adminEmail)->send(new OrderPlacedAdmin($order));

        $viewData = [];
        $viewData["title"] = "Compra - Tienda Online";
        $viewData["subtitle"] = "Estado de la compra";
        $viewData["order"] = $order;

        return view('cart.purchase')->with("viewData", $viewData);

    } catch (\Exception $e) {
        DB::rollBack();

        \Log::error('Error al procesar la compra: ' . $e->getMessage());
        return redirect()->route('cart.index')->with('error', 'Ocurrió un error al procesar tu compra. Por favor, inténtalo nuevamente.');
    }
}

}
