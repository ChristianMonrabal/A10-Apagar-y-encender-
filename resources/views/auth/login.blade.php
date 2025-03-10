<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('img/icon.png') }}">
        </div>
        <h2>Jira Service Management</h2>
        <br>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-container">
                <input type="email" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <br>
            <div class="input-container">
                <input type="password" id="password" name="password" placeholder="Contraseña">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <br>
            @if ($errors->has('login'))
                <p class="error-message">{{ $errors->first('login') }}</p>
            @endif
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
