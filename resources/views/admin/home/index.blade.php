@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-3xl mx-auto">
    
    <div class="bg-gradient-to-r from-primary to-blue-600 text-white p-6 text-center">
      <h1 class="text-3xl font-bold">Panel de Administración</h1>
      <p class="mt-2 text-lg">Bienvenido al centro de control de tu tienda en línea</p>
    </div>
    
    <div class="p-8 text-center">
      <p class="text-gray-700 text-lg mb-6">
        Desde aquí puedes gestionar todos los aspectos clave de la tienda. A continuación, te mostramos algunas de las acciones que puedes realizar:
      </p>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
          <i class="bi bi-box-seam text-4xl text-primary mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Gestionar Productos</h3>
          <p class="text-gray-600">Añade, edita o elimina productos del catálogo de la tienda.</p>
        </div>
        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
          <i class="bi bi-receipt text-4xl text-primary mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Ver Pedidos</h3>
          <p class="text-gray-600">Revisa los pedidos.</p>
        </div>
        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
          <i class="bi bi-ticket-perforated text-4xl text-primary mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Administrar Cupones</h3>
          <p class="text-gray-600">Crea y gestiona cupones de descuento para promociones.</p>
        </div>
      </div>
      <p class="mt-8 text-gray-700 text-lg">
        Utiliza el menú lateral para acceder a las diferentes secciones y comenzar a gestionar la tienda.
      </p>
    </div>
  </div>
</div>
@endsection