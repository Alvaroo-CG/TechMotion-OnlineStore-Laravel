@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container d-flex flex-column min-vh-100">
  <div class="card shadow-lg">
    <div class="card-header bg-gradient-to-r from-primary to-blue-600 text-dark">
      <h5 class="mb-0"><i class="bi bi-check-circle me-2"></i>Compra Completada</h5>
    </div>
    <div class="card-body">
      <div class="alert alert-success" role="alert">
        ¡Felicidades! Tu compra se ha completado con éxito. El número de orden es <b>#{{ $viewData["order"]->getId() }}</b>
      </div>
    </div>
  </div>
</div>
@endsection