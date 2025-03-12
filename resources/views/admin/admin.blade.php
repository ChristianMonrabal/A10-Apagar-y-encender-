<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administrador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">Panel de Administración</a>
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

    <div class="container mt-4">
        <h2 class="mb-4">Panel de usuarios</h2>

        <a href="{{ route('admin.create') }}" class="btn btn-primary mb-4">Crear Usuario</a>

        <form id="filter-form" class="mb-4">
            <div class="form-row">
                <div class="col-md-3 mb-2">
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Buscar por nombre">
                </div>
                <div class="col-md-3 mb-2">
                    <select id="roles_id" name="roles_id" class="form-control">
                        <option value="">Filtrar por rol</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select id="sedes_id" name="sedes_id" class="form-control">
                        <option value="">Filtrar por sede</option>
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select id="activo" name="activo" class="form-control">
                        <option value="">Filtrar por estado</option>
                        <option value="1">Activo</option>
                        <option value="0">Desactivado</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <button type="submit" class="btn btn-success btn-block">Filtrar</button>
                </div>
            </div>
        </form>

        <table id="usuarios-table" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Sede</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->nombre ?? 'No asignado' }}</td>
                        <td>{{ $usuario->sede->nombre ?? 'No asignada' }}</td>
                        <td>
                            @if($usuario->activo)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-danger">Desactivado</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/admin/update/' . $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            @if($usuario->activo)
                            <a href="{{ route('admin.disable', $usuario->id) }}" class="btn btn-secondary btn-sm">Baja</a>
                            @else
                                <a href="{{ route('admin.enable', $usuario->id) }}" class="btn btn-success btn-sm">Alta</a>
                            @endif
                            <form action="{{ route('admin.delete', $usuario->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
