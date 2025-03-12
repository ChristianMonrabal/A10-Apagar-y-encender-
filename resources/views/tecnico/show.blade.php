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
        <!-- Título y detalles básicos de la incidencia -->
        <h1 class="mb-4">Detalle de la Incidencia</h1>
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
                @if(isset($incidencia->imagenes) && $incidencia->imagenes->count() > 0)
                    <div id="incidenciaCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($incidencia->imagenes as $key => $img)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/incidencias/' . $img->ruta) }}" class="d-block w-100" alt="Imagen de incidencia">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#incidenciaCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#incidenciaCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
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
                <!-- Se muestra la descripción para contextualizar el chat -->
                <div class="mb-3">
                    <p><strong>Descripción de la Incidencia:</strong></p>
                    <p>{{ $incidencia->descripcion }}</p>
                </div>
                {{-- <form action="{{ route('chat.send', $incidencia->id) }}" method="POST"> --}}
                    @csrf
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Escribe tu mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Ingresa tu mensaje aquí..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>

        <a href="{{ route('tecnico.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>

    <!-- Bootstrap JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
