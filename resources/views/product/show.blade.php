@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')

<div class="card shadow-sm mb-4 rounded-3 position-relative">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ asset('/storage/'.$viewData["product"]->getImage()) }}" class="img-fluid rounded-start">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h3 class="card-title text-dark fw-bold">
          {{ $viewData["product"]->getName() }}
        </h3>

        @php
          $averageRating = $viewData["product"]->ratings->avg('rating');
          $averageRating = $averageRating ? number_format($averageRating, 1) : 0;
          $ratingCount = $viewData["product"]->ratings->count();
        @endphp
        
        <div class="d-flex align-items-center mb-3">
          <div class="stars me-2">
            @for ($i = 1; $i <= 5; $i++)
              <i class="star {{ $i <= $averageRating ? 'filled' : '' }}">&#9733;</i>
            @endfor
          </div>
          <span class="text-muted">{{ $ratingCount }} valoración(es)</span>
        </div>

        <h4 class="card-text text-dark fw-bold">${{ number_format($viewData["product"]->getPrice(), 2) }}</h4>
        <p class="card-text text-muted">{{ $viewData["product"]->getDescription() }}</p>

        <form method="POST" action="{{ route('cart.add', ['id'=> $viewData['product']->getId()]) }}">
          @csrf
          <div class="row g-3">
            <div class="col-auto">
              <div class="input-group">
                <span class="input-group-text">Cantidad</span>
                <input type="number" min="1" max="10" class="form-control" name="quantity" value="1">
              </div>
            </div>
            <div class="col-auto">
              <button class="btn btn-dark text-white" type="submit">Añadir al carrito</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  @auth
    <form action="{{ route('wishlist.add', $viewData['product']->id) }}" method="POST" class="position-absolute top-0 end-0 p-3">
      @csrf
      <button type="submit" class="btn btn-outline-danger">
        Añadir a favoritos❤️
      </button>
    </form>
  @endauth
</div>

<div class="container mt-4">
  <h3 class="text-center text-dark">Comentarios</h3>
  @foreach($viewData['product']->comments as $comment)
    <div class="border-bottom mb-3 pb-3">
      <strong>{{ $comment->user->name }}:</strong>
      <p>{{ $comment->comment }}</p>
    </div>
  @endforeach

  <form action="{{ route('product.addComment', $viewData['product']->id) }}" method="POST" class="mt-4">
    @csrf
    <textarea name="comment" placeholder="Añade tu comentario" class="form-control" required></textarea>
    <button type="submit" class="btn btn-dark mt-2">Enviar comentario</button>
  </form>
</div>

<div class="container mt-4">
  <form action="{{ route('product.addRating', $viewData['product']->id) }}" method="POST">
    @csrf
    <h5>Valora este producto</h5>
    <div class="d-flex mb-3">
      <select name="rating" class="form-select w-25" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <button type="submit" class="btn btn-dark ms-3">Enviar valoración</button>
    </div>
  </form>
</div>

<div class="mt-3 text-center">
  <h4 class="text-dark">Comparte este producto:</h4>
  <div class="d-flex justify-content-center gap-3">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-primary">
      <i class="fab fa-facebook-f"></i> Facebook
    </a>
    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($viewData['product']->getName()) }}" target="_blank" class="btn btn-info">
      <i class="fab fa-twitter"></i> Twitter
    </a>
    <a href="https://api.whatsapp.com/send?text={{ urlencode($viewData['product']->getName().' '.url()->current()) }}" target="_blank" class="btn btn-success">
      <i class="fab fa-whatsapp"></i> WhatsApp
    </a>
  </div>
</div>

@endsection

@section('styles')
  <style>
    .stars {
      font-size: 1.5rem;
      color: #d3d3d3;
    }

    .stars .star.filled {
      color: #ffcc00;
    }

    .stars i {
      margin-right: 2px;
    }

    .d-flex {
      display: flex;
      align-items: center;
    }

    .me-2 {
      margin-right: 0.5rem;
    }

    .fab {
      margin-right: 10px;
    }

    .btn-dark, .btn-info, .btn-success {
      margin-right: 10px;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .btn-outline-danger {
      border-color: #e74c3c;
      color: #e74c3c;
    }

    .btn-outline-danger:hover {
      background-color: #e74c3c;
      color: white;
    }

    .form-label {
      font-weight: bold;
    }

    .container {
      max-width: 960px;
    }

    .btn-dark {
      border-radius: 5px;
    }

    .btn-outline-danger {
      border-radius: 5px;
    }

    .position-absolute {
      position: absolute !important;
    }

    .top-0 {
      top: 0 !important;
    }

    .end-0 {
      right: 0 !important;
    }

    .p-3 {
      padding: 1rem !important;
    }
  </style>
@endsection

@section('meta')
  <meta property="og:title" content="{{ $viewData['product']->getName() }}">
  <meta property="og:description" content="{{ $viewData['product']->getDescription() }}">
  <meta property="og:image" content="{{ asset('/storage/'.$viewData['product']->getImage()) }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta name="twitter:card" content="summary_large_image">
@endsection
