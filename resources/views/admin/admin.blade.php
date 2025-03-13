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
    @include('layout.navbar') 
    <div class="container mt-4">
        <h2 class="mb-4">Panel de usuarios</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-primary mb-4">Crear Usuario</a>
        <form id="filter-form" class="mb-4" method="GET" action="{{ route('admin.admin') }}">
            <div class="form-row align-items-center">
                <!-- Input de nombre -->
                <div class="col-md-3 mb-2 position-relative">
                    <input type="text" id="nombre" name="nombre" class="form-control pr-5" placeholder="Buscar por nombre" 
                        value="{{ request('nombre') }}">
                    <i class="fas fa-times-circle position-absolute" id="clear-nombre" 
                        style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                </div>
        
                <!-- Select de Rol -->
                <div class="col-md-3 mb-2">
                    <select id="roles_id" name="roles_id" class="form-control">
                        <option value="">Filtrar por rol</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" {{ request('roles_id') == $rol->id ? 'selected' : '' }}>
                                {{ $rol->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <!-- Select de Sede -->
                <div class="col-md-3 mb-2">
                    <select id="sedes_id" name="sedes_id" class="form-control">
                        <option value="">Filtrar por sede</option>
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->id }}" {{ request('sedes_id') == $sede->id ? 'selected' : '' }}>
                                {{ $sede->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-md-2 mb-2">
                    <select id="activo" name="activo" class="form-control">
                        <option value="" {{ request('activo') === null ? 'selected' : '' }}>Filtrar por estado</option>
                        @foreach($estados as $key => $estado)
                            <option value="{{ $key }}" {{ request('activo') === (string)$key ? 'selected' : '' }}>
                                {{ $estado }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-md-1 d-flex align-items-center">
                    <button type="submit" class="btn btn-block">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('admin.admin') }}" id="clear-filters" class="btn btn-link p-0" style="font-size: 1.5rem; color: black; display: none;">                        
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
            </div>
        </form>
        
        <div class="table-responsive">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/delete_user.js') }}"></script>
    <script src="{{ asset('js/drop_filters.js') }}"></script>
</body>
</html>
