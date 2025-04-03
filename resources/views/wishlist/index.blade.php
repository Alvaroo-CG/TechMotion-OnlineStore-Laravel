@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Tu Lista de Deseos❤️</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($wishlist->isEmpty())
        <div class="alert alert-info text-center">
            Tu lista de deseos está vacía. ¡Empieza a agregar productos!
        </div>
    @else
        <div class="list-group">
            @foreach ($wishlist as $item)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('product.show', $item->product->id) }}" class="text-decoration-none">
                        <strong>{{ $item->product->name }}</strong> - ${{ number_format($item->product->price, 2) }}
                    </a>
                    <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('styles')
  <style>
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    .list-group-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
        transition: background-color 0.3s;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
  </style>
@endsection
