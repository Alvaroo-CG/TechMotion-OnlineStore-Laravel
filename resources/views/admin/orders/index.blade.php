@extends('layouts.app')

@section('title', 'Admin - Pedidos')
@section('subtitle', 'Lista de Todos los Pedidos')

@section('content')
<div class="container d-flex flex-column min-vh-100">
    <h1 class="my-4 text-center"><i class="bi bi-receipt me-2"></i>Todos los Pedidos</h1>
    
    <div class="card shadow-lg flex-grow-1">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID del Pedido</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Total</th>
                        <th scope="col">Productos</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($order->items as $item)
                                        <li>
                                            <i class="bi bi-box me-2"></i>{{ $item->product->name }} 
                                            <span class="badge bg-secondary">x{{ $item->quantity }}</span> 
                                            - ${{ number_format($item->product->price, 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye me-2"></i>Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection