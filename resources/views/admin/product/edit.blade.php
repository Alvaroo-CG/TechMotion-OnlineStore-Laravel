@extends('layouts.admin')

@section('content')
<div class="container mt-5">

  <div class="card mb-5 shadow-lg">
    <div class="card-header bg-gradient-to-r from-warning to-orange-400 text-dark">
      <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Editar Producto</h5>
    </div>
    <div class="card-body">
      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.product.update', ['id' => $viewData['product']->getId()]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
          <div class="col-md-6">
            <label for="name" class="form-label">Nombre</label>
            <input id="name" name="name" value="{{ $viewData['product']->getName() }}" type="text" class="form-control" placeholder="Nombre del producto">
          </div>

          <div class="col-md-6">
            <label for="price" class="form-label">Precio</label>
            <input id="price" name="price" value="{{ $viewData['product']->getPrice() }}" type="number" class="form-control" placeholder="Precio del producto">
          </div>
        </div>

        <div class="row g-3 mt-4">
          <div class="col-md-6">
            <label for="image" class="form-label">Imagen</label>
            <input id="image" name="image" type="file" class="form-control">
          </div>

          <div class="col-md-6"></div>
        </div>

        <div class="mt-4">
          <label for="description" class="form-label">Descripción</label>
          <textarea id="description" class="form-control" name="description" rows="4" placeholder="Descripción del producto">{{ $viewData['product']->getDescription() }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning mt-4">
          <i class="bi bi-save me-2"></i>Guardar Cambios
        </button>
      </form>
    </div>
  </div>

</div>
@endsection