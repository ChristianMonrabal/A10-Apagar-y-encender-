<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Incidencias</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (opcional para iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layout.navbar')

    <div class="container mt-4">
        <h1 class="mb-4 text-center">Listado Completo de Incidencias</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Cliente</th>
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
                                <span class="badge bg-primary">{{ optional($incidencia->estado)->nombre }}</span>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ optional($incidencia->prioridad)->nivel }}</span>
                            </td>
                            <td>{{ $incidencia->fecha_resolucion ? $incidencia->fecha_resolucion->format('d-m-Y') : 'Pendiente' }}</td>
                            <td>
                                <a href="{{ route('tecnico.show', $incidencia->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
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
