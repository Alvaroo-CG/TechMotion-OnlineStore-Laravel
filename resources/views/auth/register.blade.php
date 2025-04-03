@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column min-vh-100">
    <div class="row justify-content-center my-3">
        <div class="col-md-6"> 
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-to-r from-primary to-blue-600 text-dark text-center py-3"> <!-- Menor padding -->
                    <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>Registro</h4>
                </div>

                <div class="card-body p-4"> 
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3"> 
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3"> 
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3"> 
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3"> 
                            <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid gap-2"> 
                            <button type="submit" class="btn btn-primary w-50 mx-auto"> 
                                <i class="bi bi-person-plus me-2"></i>Registrarse
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection