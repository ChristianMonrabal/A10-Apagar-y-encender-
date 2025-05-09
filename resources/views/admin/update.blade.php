<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Actualizar Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    @include('layout.navbar')
    <div class="container mt-4">
        <a href="{{ route('admin.admin') }}" class="btn btn-secondary mr-2">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h2 class="mb-4">Editar usuario {{ $usuario->nombre }}</h2>
        <form action="{{ url('/admin/update/' . $usuario->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}">
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Dejar en blanco si no desea cambiarla">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="roles_id">Rol</label>
                <select id="roles_id" name="roles_id" class="form-control">
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('roles_id', $usuario->roles_id) == $rol->id ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                    @endforeach
                </select>
                @error('roles_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sedes_id">Sede</label>
                <select id="sedes_id" name="sedes_id" class="form-control">
                    @foreach ($sedes as $sede)
                        <option value="{{ $sede->id }}" {{ old('sedes_id', $usuario->sedes_id) == $sede->id ? 'selected' : '' }}>{{ $sede->nombre }}</option>
                    @endforeach
                </select>
                @error('sedes_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <button type="submit" class="btn btn-primary">Actualizar usuario</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/update_users.js') }}"></script>
</body>
</html>
