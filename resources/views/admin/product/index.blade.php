@extends('layouts.admin')

@section('content')
<div class="container mt-5">

  <div class="card mb-5 shadow-lg">
    <div class="card-header bg-gradient-to-r from-primary to-blue-600 text-dark">
      <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Crear Producto</h5>
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

      <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
          <div class="col-md-6">
            <label for="name" class="form-label">Nombre</label>
            <input id="name" name="name" value="{{ old('name') }}" type="text" class="form-control" placeholder="Nombre del producto">
          </div>

          <div class="col-md-6">
            <label for="price" class="form-label">Precio</label>
            <input id="price" name="price" value="{{ old('price') }}" type="number" class="form-control" placeholder="Precio del producto">
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
          <textarea id="description" class="form-control" name="description" rows="4" placeholder="Descripción del producto">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-4">
          <i class="bi bi-save me-2"></i>Guardar Producto
        </button>
      </form>
    </div>
  </div>

  <div class="card shadow-lg">
    <div class="card-header bg-gradient-to-r from-secondary to-gray-600 text-dark">
      <h5 class="mb-0"><i class="bi bi-grid me-2"></i>Gestionar Productos</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($viewData["products"] as $product)
            <tr>
              <td>{{ $product->getId() }}</td>
              <td>{{ $product->getName() }}</td>
              <td>
                <a href="{{ route('admin.product.edit', ['id' => $product->getId()]) }}" class="btn btn-warning btn-sm">
                  <i class="bi-pencil"></i> Editar
                </a>
              </td>
              <td>
                <form action="{{ route('admin.product.delete', $product->getId()) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi-trash"></i> Eliminar
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection