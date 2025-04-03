<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  @yield('meta')
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
  @yield('styles')
  <title>@yield('title', 'TechMotion')</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .content {
      flex-grow: 1;
    }
    footer {
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 1.5rem 0;
    }
    .nav-link {
      display: flex;
      align-items: center;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home.index') }}">TechMotion</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link active" href="{{ route('home.index') }}">Inicio</a>
          <a class="nav-link active" href="{{ route('product.index') }}">Productos</a>
          <a class="nav-link active d-flex align-items-center" href="{{ route('cart.index') }}">
            <i class="bi bi-cart-fill fs-5 me-2"></i> Carrito
          </a>
          <div class="vr bg-white mx-2 d-none d-lg-block"></div>
          @guest
          <a class="nav-link active" href="{{ route('login') }}">Iniciar Sesión</a>
          <a class="nav-link active" href="{{ route('register') }}">Registrarse</a>
          @else
          <a class="nav-link active d-flex align-items-center" href="{{ route('wishlist.index') }}">
            <i class="bi bi-heart-fill fs-5 me-2"></i> Lista de deseos
          </a>
          <a class="nav-link active" href="{{ route('myaccount.orders') }}">Mis Pedidos</a>
          <form id="logout" action="{{ route('logout') }}" method="POST">
            <a role="button" class="nav-link active" onclick="document.getElementById('logout').submit();">Cerrar Sesión</a>
            @csrf
          </form>
          @endguest
        </div>
      </div>
    </div>
  </nav>
  <header class="masthead bg-secondary text-white text-center py-5">
    <div class="container d-flex align-items-center flex-column">
      <h2>@yield('subtitle', 'TechMotion')</h2>
    </div>
  </header>
  <div class="container my-5 content">
    @yield('content')
  </div>
  <footer>
    <div class="container text-center">
      <small>
        Copyright - Álvaro Campillo González
      </small>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  @yield('scripts')
</body>
</html>
