<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo')</title>
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('img/icon.png') }}" class="logo-navbar">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-auto">
            @if(Auth::check())
                <li class="nav-item d-none d-lg-block">
                    <span class="navbar-text mr-3">
                        <strong>Hola {{ Auth::user()->nombre }}</strong>
                    </span>
                </li>

                <li class="nav-item d-lg-none">
                    <form action="{{ route('logout') }}" method="POST" class="nav-link p-0">
                        @csrf
                        <button type="submit" class="btn btn-link">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </li>

                <li class="nav-item d-none d-lg-block">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                </li>
            @endif
        </ul>
    </nav>
</body>
</html>
