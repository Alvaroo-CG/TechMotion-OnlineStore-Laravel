<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />
  <title>@yield('title', 'Panel de Administración - Tienda Online')</title>
</head>

<body>
  <div class="row g-0">
    <!-- sidebar -->
    <div class="p-3 col-md-2 fixed text-white bg-dark min-vh-100">
      <a href="{{ route('admin.home.index') }}" class="text-white text-decoration-none">
        <span class="fs-4">Panel de Administración</span>
      </a>
      <hr />
      <ul class="nav flex-column">
        <li>
          <a href="{{ route('admin.home.index') }}" class="nav-link text-white">
            <i class="bi bi-house-door me-2"></i>Inicio
          </a>
        </li>
        <li>
          <a href="{{ route('admin.product.index') }}" class="nav-link text-white">
            <i class="bi bi-box-seam me-2"></i>Productos
          </a>
        </li>
        <li>
          <a href="{{ route('admin.orders.index') }}" class="nav-link text-white">
            <i class="bi bi-receipt me-2"></i>Pedidos
          </a>
        </li>
        <li>
          <a href="{{ route('admin.coupons.index') }}" class="nav-link text-white">
            <i class="bi bi-ticket-perforated me-2"></i>Cupones
          </a>
        </li>
        <li>
          <a href="{{ route('home.index') }}" class="mt-2 btn btn-primary text-white">
            <i class="bi bi-arrow-left-circle me-2"></i>Volver a la página principal
          </a>
        </li>
      </ul>
    </div>
    <!-- sidebar -->

    <div class="col-md-10 ms-auto">
      <nav class="p-3 shadow-sm bg-light d-flex justify-content-end align-items-center">
        <span class="profile-font me-3">Administrador</span>
        <img class="img-profile rounded-circle" src="{{ asset('/img/undraw_profile.svg') }}" alt="Perfil">
      </nav>

      <div class="p-4">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- footer -->
  <footer class="bg-dark text-white py-3">
    <div class="container text-center">
      <small>
        Copyright - Álvaro Campillo González
      </small>
    </div>
  </footer>
  <!-- footer -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
</body>
</html>