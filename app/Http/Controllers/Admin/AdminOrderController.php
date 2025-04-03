<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
{
    $orders = Order::with('user', 'items.product')->get();  

    return view('admin.orders.index', compact('orders'));
}

public function show($id)
{
    $order = Order::with('user', 'products')->findOrFail($id);

    return view('admin.orders.show', compact('order'));
}



}
