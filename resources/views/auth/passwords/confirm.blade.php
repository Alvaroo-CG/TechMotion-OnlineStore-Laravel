@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column min-vh-100">
    <div class="row justify-content-center my-auto">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-to-r from-primary to-blue-600 text-white text-center">
                    <h4 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Confirmar Contraseña</h4>
                </div>

                <div class="card-body">
                    <p class="text-center text-muted mb-4">
                        Por favor, confirma tu contraseña antes de continuar.
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Confirmar Contraseña
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        <i class="bi bi-question-circle me-2"></i>¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection