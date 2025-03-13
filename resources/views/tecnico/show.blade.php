<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de la Incidencia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (opcional para iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layout.navbar')

    <div class="container mt-4">
        <!-- Encabezado con botones -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Detalle de la Incidencia</h1>
            <div>
                @if(optional($incidencia->estado)->nombre === 'En trabajo')
                    <form action="{{ route('tecnico.finalizarTrabajo', $incidencia->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-check"></i> Marcar como Resuelta
                        </button>
                    </form>
                @endif
                <a href="{{ route('tecnico.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>

        <!-- Tarjeta de detalles de la incidencia -->
        <div class="card mb-4">
            <div class="card-header">
                <strong>ID:</strong> {{ $incidencia->id }} 
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <strong>Título:</strong> {{ $incidencia->titulo }}
            </div>
            <div class="card-body">
                <p><strong>Descripción:</strong> {{ $incidencia->descripcion }}</p>
                <p><strong>Estado:</strong> {{ optional($incidencia->estado)->nombre ?? 'Sin estado' }}</p>
                <p><strong>Creada:</strong> {{ $incidencia->created_at->format('d-m-Y H:i') }}</p>
            </div>
        </div>

        <!-- Sección para mostrar las imágenes -->
        <div class="card mb-4">
            <div class="card-header">Imágenes</div>
            <div class="card-body">
                @if($incidencia->imagen->count() > 0)
                    <div>
                        <h4>Imagen(es):</h4>
                        @foreach($incidencia->imagen as $img)
                            <img src="{{ asset('storage/' . $img->ruta) }}" alt="Imagen de la Incidencia" class="img-fluid mb-2" style="max-width:200px;">
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No hay imágenes disponibles.</p>
                @endif
            </div>
        </div>

  <!-- Muestra el chat -->
<div>
    <h4>Chat:</h4>
    <div class="chat-box mb-3" style="border: 1px solid #ccc; padding: 10px; height:300px; overflow-y: auto;">
        @foreach($incidencia->comentario as $comentario)
            @if($comentario->cliente)
                <!-- Mensaje del cliente: se alinea a la derecha -->
                <div class="d-flex justify-content-end mb-2">
                    <div class="p-2 bg-primary text-white rounded" style="max-width:70%;">
                        <small class="d-block text-right"><strong>{{ $comentario->cliente->nombre }} (Cliente)</strong></small>
                        <span>{{ $comentario->texto }}</span>
                    </div>
                </div>
            @elseif($comentario->tecnico)
                <!-- Mensaje del técnico: se alinea a la izquierda -->
                <div class="d-flex justify-content-start mb-2">
                    <div class="p-2 bg-light border rounded" style="max-width:70%;">
                        <small class="d-block"><strong>{{ $comentario->tecnico->nombre }} (Técnico)</strong></small>
                        <span>{{ $comentario->texto }}</span>
                    </div>
                </div>
            @else
                <!-- Mensaje de usuario desconocido -->
                <div class="mb-2">
                    <strong>Usuario desconocido:</strong> {{ $comentario->texto }}
                </div>
            @endif
        @endforeach
    </div>

    <!-- Formulario para enviar un nuevo comentario -->
    <form action="{{ route('tecnico.storeComentario', $incidencia->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <!-- Importante: el name del textarea debe coincidir con lo que validas en el controlador -->
            <textarea name="texto" rows="3" class="form-control" placeholder="Escribe un comentario..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<!-- Botón para volver a la lista -->
<a href="{{ route('tecnico.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>


    <!-- Bootstrap JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
