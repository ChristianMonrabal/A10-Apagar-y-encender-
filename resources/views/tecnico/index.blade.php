<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Incidencias</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  @include('layout.navbar')

  <div class="container mt-4">
    <h1 class="mb-4 text-center">Listado Completo de Incidencias</h1>
    
    <!-- Formulario de filtros -->
    <form method="GET" action="{{ route('tecnico.index') }}" class="mb-4">
      <div class="row">
        <!-- Campo de búsqueda -->
        <div class="col-md-4">
          <input type="text" name="search" class="form-control" placeholder="Buscar por título o descripción" value="{{ request('search') }}">
        </div>
        <!-- Filtro por Estado -->
        <div class="col-md-4">
          <select name="estado" class="form-control">
            <option value="">Todos los estados</option>
            @foreach($estados as $id => $nombre)
              <option value="{{ $id }}" {{ request('estado') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
            @endforeach
          </select>
        </div>
        <!-- Filtro por Prioridad -->
        <div class="col-md-4">
          <select name="prioridad" class="form-control">
            <option value="">Todas las prioridades</option>
            @foreach($prioridades as $id => $nivel)
              <option value="{{ $id }}" {{ request('prioridad') == $id ? 'selected' : '' }}>{{ $nivel }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="mt-3">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <!-- Botón para quitar filtros -->
        <a href="{{ route('tecnico.index') }}" class="btn btn-secondary">Limpiar filtros</a>
      </div>
    </form>

    <!-- Tabla de incidencias -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Usuario</th>
            <th>Técnico</th>
            <th>Estado</th>
            <th>Prioridad</th>
            <th>Fecha Resolución</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($incidencias as $incidencia)
            <tr>
              <td>{{ $incidencia->titulo }}</td>
              <td>{{ $incidencia->descripcion }}</td>
              <td>{{ optional($incidencia->cliente)->nombre }}</td>
              <td>{{ optional($incidencia->tecnico)->nombre }}</td>
              <td>
                <span class="badge bg-primary">
                  {{ optional($incidencia->estado)->nombre }}
                </span>
              </td>
              <td>
                <span class="badge bg-warning text-dark">
                  {{ optional($incidencia->prioridad)->nivel }}
                </span>
              </td>
              <td>
                {{ $incidencia->fecha_resolucion ? \Carbon\Carbon::parse($incidencia->fecha_resolucion)->format('d-m-Y') : 'Pendiente' }}
              </td>
              <td>
                <a href="{{ route('tecnico.show', $incidencia->id) }}" class="btn btn-info btn-sm">
                  <i class="fas fa-eye"></i> Ver
                </a>
                @if(optional($incidencia->estado)->nombre == 'Asignada')
                  <form action="{{ route('tecnico.iniciarTrabajo', $incidencia->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                      <i class="fas fa-play"></i> Iniciar
                    </button>
                  </form>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS Bundle (incluye Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
