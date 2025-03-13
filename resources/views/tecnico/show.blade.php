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

        <!-- Sección de Chat -->
        <div class="card mb-4">
            <div class="card-header">Chat con el Cliente</div>
            <div class="card-body">
                <!-- Mostrar el historial de mensajes -->
                <div class="mb-3">
                    <h5>Mensajes</h5>
                    @forelse($incidencia->comentario as $comentario)
                        <div class="mb-2">
                            <strong>
                                @if($comentario->tecnico_id)
                                    Técnico: {{ optional($comentario->tecnico)->nombre }}
                                @elseif($comentario->cliente_id)
                                    Cliente: {{ optional($comentario->cliente)->nombre }}
                                @else
                                    Desconocido
                                @endif
                            :</strong>
                            <p class="mb-0">{{ $comentario->texto }}</p>
                            <small class="text-muted">{{ $comentario->created_at->format('d-m-Y H:i') }}</small>
                        </div>
                    @empty
                        <p class="text-muted">No hay mensajes en el chat.</p>
                    @endforelse
                </div>
                <!-- Formulario para enviar un mensaje -->
                <form action="{{ route('tecnico.storeComentario', $incidencia->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="texto" class="form-label">Escribe tu mensaje</label>
                        <textarea class="form-control" id="texto" name="texto" rows="3" placeholder="Ingresa tu mensaje aquí..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
        
    </div>

    <!-- Bootstrap JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
