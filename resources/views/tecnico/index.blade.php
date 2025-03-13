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
        
        <!-- Campo de búsqueda -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input 
                    type="text" 
                    id="search" 
                    class="form-control" 
                    placeholder="Buscar incidencia por título o descripción..."
                >
            </div>
        </div>

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
                <!-- Importante: le damos un id al tbody para reemplazar su contenido mediante AJAX -->
                <tbody id="incidencias-tbody">
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
                                {{ $incidencia->fecha_resolucion ? $incidencia->fecha_resolucion->format('d-m-Y') : 'Pendiente' }}
                            </td>
                            <td>
                                <a href="{{ route('tecnico.show', $incidencia->id) }}" class="btn btn-info btn-sm" style="padding: 0.25rem 0.4rem; font-size: 0.75rem;">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                @if(optional($incidencia->estado)->nombre == 'Asignada')
                                    <form action="{{ route('tecnico.iniciarTrabajo', $incidencia->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" style="padding: 0.25rem 0.4rem; font-size: 0.75rem;">
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
    
    <!-- Script para filtrar con fetch -->
    <script>
        const searchInput = document.getElementById('search');
        const tbody = document.getElementById('incidencias-tbody');

        // Detectamos cuando el usuario escribe
        searchInput.addEventListener('keyup', function() {
            let query = this.value; // texto que se está escribiendo

            // Realizamos una petición GET a la ruta de filtro, por ej /tecnico/incidencias/filter
            // Asegúrate de tener la ruta en routes/web.php y un método en tu controlador
            fetch("{{ route('tecnico.filter') }}?search=" + encodeURIComponent(query))
                .then(response => response.text())
                .then(html => {
                    // Reemplazamos el contenido del tbody con el HTML parcial que nos regresa el servidor
                    tbody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error en fetch:', error);
                });
        });
    </script>
</body>
</html>
