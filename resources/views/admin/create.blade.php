<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="{{ route('admin.admin') }}">Panel de Administración</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Crear un Nuevo Usuario</h1>

        <form action="{{ route('admin.store') }}" method="POST" id="create_user_form">
            @csrf
        
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control">
                @if ($errors->has('nombre'))
                    <div class="text-danger">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
            </div>
        
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
        
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control">
                @if ($errors->has('password'))
                    <div class="text-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
        
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                @if ($errors->has('password_confirmation'))
                    <div class="text-danger">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @endif
            </div>
        
            <div class="mb-3">
                <label for="roles_id" class="form-label">Rol</label>
                <select name="roles_id" id="roles_id" class="form-control">
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('roles_id') == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                    @endforeach
                </select>
                @if ($errors->has('roles_id'))
                    <div class="text-danger">
                        {{ $errors->first('roles_id') }}
                    </div>
                @endif
            </div>
        
            <div class="mb-3">
                <label for="sedes_id" class="form-label">Sede</label>
                <select name="sedes_id" id="sedes_id" class="form-control">
                    @foreach($sedes as $sede)
                        <option value="{{ $sede->id }}" {{ old('sedes_id') == $sede->id ? 'selected' : '' }}>{{ $sede->nombre }}</option>
                    @endforeach
                </select>
                @if ($errors->has('sedes_id'))
                    <div class="text-danger">
                        {{ $errors->first('sedes_id') }}
                    </div>
                @endif
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <button type="submit" class="btn btn-primary">Crear usuario</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybFSQ6bJY14ISh08h0HgFJ2R1U7ew3uZCp1tSx3YxyPOT2R4n6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqQxt4q70zjJXrxSOiJwE5Xn7WzJ5wXLOQW+3N7Vj7a+L" crossorigin="anonymous"></script>
    <script src="{{ asset('js/create_users.js') }}"></script>
</body>
</html>
