@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container d-flex flex-column min-vh-100">
  <div class="card shadow-lg">
    <div class="card-header bg-gradient-to-r from-primary to-blue-600 text-dark">
      <h5 class="mb-0"><i class="bi bi-cart me-2"></i>Productos en el Carrito</h5>
    </div>
    <div class="card-body">
      {{-- Mostrar mensajes de error si existen --}}
      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if (isset($viewData["products"]) && count($viewData["products"]) > 0)
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center">
            <thead class="table-light">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($viewData["products"] as $product)
              <tr>
                <td>{{ $product->getName() }}</td>
                <td>${{ $product->getPrice() }}</td>
                <td>{{ $product->quantity ?? 0 }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- Formulario para ingresar el código de cupón --}}
        <form action="{{ route('cart.index') }}" method="GET" class="mb-4">
          @csrf
          <div class="row g-2 justify-content-start">
            <div class="col-2">
              <input type="text" class="form-control" name="coupon_code" placeholder="Código de cupón" />
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-ticket-perforated me-1"></i>Aplicar
              </button>
            </div>
          </div>
        </form>

        {{-- Mostrar el descuento si se aplicó --}}
        @if ($viewData["discount"] > 0)
          <p class="text-start small"><strong>Descuento: </strong> ${{ $viewData["discount"] }}</p>
        @endif

        <div class="row">
          <div class="text-end">
            <a class="btn btn-outline-secondary mb-2"><b>Total:</b> ${{ $viewData["total"] }}</a>
            
            {{-- Botón de compra --}}
            <a href="{{ route('cart.purchase') }}" class="btn btn-primary mb-2">
              <i class="bi bi-credit-card me-2"></i>Comprar
            </a>

            <a href="{{ route('cart.delete') }}">
              <button class="btn btn-danger mb-2">
                <i class="bi bi-trash me-2"></i>Eliminar todo
              </button>
            </a>
          </div>
        </div>
      @else
        {{-- Mensaje si el carrito está vacío --}}
        <p class="text-center text-muted">Tu carrito está vacío. ¡Empieza a añadir productos!</p>
      @endif
    </div>
  </div>
</div>
@endsection
