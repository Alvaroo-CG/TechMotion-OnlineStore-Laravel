@extends('layouts.app')

@section('title', 'Detalles del Pedido')
@section('subtitle', 'ID del Pedido: ' . $order->id)

@section('content')
<div class="container d-flex flex-column min-vh-100">
    <h1 class="my-4 text-center"><i class="bi bi-receipt me-2"></i>Detalles del Pedido #{{ $order->id }}</h1>

    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <h3 class="card-title"><i class="bi bi-person me-2"></i>Usuario: {{ $order->user->name }}</h3>
            <h4 class="card-subtitle mb-3"><i class="bi bi-currency-dollar me-2"></i>Total: ${{ number_format($order->total, 2) }}</h4>
            
            <h3 class="mt-4"><i class="bi bi-boxes me-2"></i>Productos</h3>
            <ul class="list-group">
                @foreach ($order->products as $product)
                    <li class="list-group-item">
                        <i class="bi bi-box me-2"></i>{{ $product->name }} 
                        - ${{ number_format($product->pivot->price, 2) }} 
                        <span class="badge bg-secondary">x{{ $product->pivot->quantity }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection