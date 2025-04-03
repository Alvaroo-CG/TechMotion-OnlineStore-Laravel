@extends('layouts.admin')

@section('title', 'Crear Cupón')
@section('content')

<div class="container d-flex flex-column min-vh-100">
    <h2 class="my-4 text-center"><i class="bi bi-ticket-perforated me-2"></i>Crear Nuevo Cupón</h2>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="code" class="form-label">Código del Cupón</label>
                    <input type="text" class="form-control" name="code" id="code" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Tipo de Descuento</label>
                    <select class="form-control" name="type" id="type" required>
                        <option value="percentage">Porcentaje</option>
                        <option value="fixed">Cantidad Fija</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="value" class="form-label">Valor del Descuento</label>
                    <input type="number" class="form-control" name="value" id="value" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm w-25">
                        <i class="bi bi-save me-2"></i>Crear Cupón
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection