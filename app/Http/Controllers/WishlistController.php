<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $wishlist = Wishlist::where('user_id', $user->id)->with('product')->get();
            return view('wishlist.index', compact('wishlist'));
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to view your wishlist.');
        }
    }

    public function add(Request $request, $productId)
    {
        $user = Auth::user();
        if ($user) {
            $exists = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->exists();

            if ($exists) {
                return redirect()->route('wishlist.index')->with('info', 'This product is already in your wishlist.');
            }

            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);

            return redirect()->route('wishlist.index')->with('success', 'Product added to wishlist.');
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to add products to your wishlist.');
        }
    }

    public function remove($productId)
    {
        $user = Auth::user();
        if ($user) {
            Wishlist::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->delete();

            return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist.');
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to remove products from your wishlist.');
        }
    }
}
