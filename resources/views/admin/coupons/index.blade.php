@extends('layouts.admin')

@section('title', 'Lista de Cupones')
@section('content')

<div class="container d-flex flex-column min-vh-100">
    <h2 class="my-4 text-center"><i class="bi bi-ticket-perforated me-2"></i>Lista de Cupones</h2>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('admin.coupons.create') }}" class="btn btn-dark btn-sm mb-4 w-25">
        <i class="bi bi-plus-circle me-2"></i>Crear Nuevo Cupón
    </a>
    
    <div class="card shadow-lg">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ ucfirst($coupon->type) }}</td>
                            <td>{{ $coupon->value }}{{ $coupon->type === 'percentage' ? '%' : '' }}</td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection