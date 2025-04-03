@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column min-vh-100">
    <div class="row justify-content-center my-auto">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-to-r from-primary to-blue-600 text-dark text-center">
                    <h4 class="mb-0"><i class="bi bi-key me-2"></i>Restablecer Contraseña</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="text-center text-muted mb-4">
                        Introduce tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-2"></i>Restablecer contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection