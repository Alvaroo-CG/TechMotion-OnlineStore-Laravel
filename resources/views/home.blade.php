@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column min-vh-100">
    <div class="row justify-content-center my-auto">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-to-r from-primary to-blue-600 text-dark text-center">
                    <h4 class="mb-0"><i class="bi bi-house-door me-2"></i>Bienvenido a Nuestra Tienda</h4>
                </div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="fs-5 text-muted mb-4">
                        <i class="bi bi-check-circle me-2"></i>¡Gracias por visitarnos!
                    </p>

                    <p class="fs-5 mb-4">
                        Explora nuestra amplia selección de productos y encuentra lo que necesitas. ¡Tenemos algo para todos!
                    </p>

                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading"><i class="bi bi-tag me-2"></i>¡Oferta Especial!</h4>
                        <p>
                            Usa el código de descuento <strong>APRUEBAME</strong> al finalizar tu compra y obtén un <strong>50% de descuento</strong> en tu pedido.
                        </p>
                        <hr>
                        <p class="mb-0">¡No te lo pierdas! Oferta válida por tiempo limitado.</p>
                    </div>

                    <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg mt-4">
                        <i class="bi bi-cart me-2"></i>Ver Productos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection