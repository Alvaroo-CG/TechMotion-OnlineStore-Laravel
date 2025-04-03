@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column min-vh-100">
    <div class="row justify-content-center my-3">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-to-r from-primary to-blue-600 text-dark text-center py-3"> <!-- Menor padding -->
                    <h4 class="mb-0"><i class="bi bi-envelope-check me-2"></i>Verifica tu Correo Electrónico</h4>
                </div>

                <div class="card-body p-4 text-center">
                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="mb-4">
                        {{ __('Antes de continuar, por favor revisa tu correo electrónico para encontrar el enlace de verificación.') }}
                    </p>

                    <p class="mb-4">
                        {{ __('Si no recibiste el correo electrónico') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 text-decoration-none">
                                {{ __('haz clic aquí para solicitar otro') }}
                            </button>.
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection