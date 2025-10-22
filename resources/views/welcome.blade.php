<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Task Manager') }}</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body class="bg-light">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">
                    <i class="fas fa-tasks me-2"></i>Task Manager
                </a>
                <div class="navbar-nav ms-auto">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">
                            <i class="fas fa-sign-in-alt me-1"></i>Connexion
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-user-plus me-1"></i>Inscription
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="container-fluid bg-primary text-white">
            <div class="container py-5">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="display-4 fw-bold mb-4">
                            <i class="fas fa-tasks me-3"></i>Task Manager
                        </h1>
                        <p class="lead mb-4 fs-5">
                            Application de gestion de tâches moderne avec Laravel, Livewire et Bootstrap
                        </p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg px-4">
                                    <i class="fas fa-rocket me-2"></i>Accéder au Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                                    <i class="fas fa-rocket me-2"></i>Commencer maintenant
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>