<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Productos";
        $viewData["subtitle"] = "Catálogo de Productos";
        $viewData["products"] = Product::paginate(10);  
        return view('product.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData["title"] = $product->getName()." - Tienda Online";
        $viewData["subtitle"] =  $product->getName()." - Información de Producto";
        $viewData["product"] = $product;
        return view('product.show')->with("viewData", $viewData);
    }

    public function loadMore(Request $request)
    {
        $page = $request->get('page', 1);
        $products = Product::paginate(10, ['*'], 'page', $page);

        return response()->json([
            'products' => $products->items(), 
            'nextPage' => $products->hasMorePages() ? $products->currentPage() + 1 : null  // Pasar null si no hay más productos
        ]);
    }


    public function addComment(Request $request, $productId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->product_id = $productId;
        $comment->user_id = auth()->id();
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('product.show', $productId);
    }

    public function addRating(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = new Rating();
        $rating->product_id = $productId;
        $rating->user_id = auth()->id();
        $rating->rating = $request->rating;
        $rating->save();

        return redirect()->route('product.show', $productId);
    }

}
