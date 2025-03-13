@extends('layout.app')

@section('content')
<div class="container">
    <h1>Detalle de la Incidencia</h1>
    
    <div class="card">
        <div class="card-header">
            <h2 class="d-flex justify-content-between align-items-center">
                <span>{{ $incidencia->titulo }}</span>
                @if($incidencia->estado->nombre === 'Resuelta')
                    <form action="{{ route('incidencias.close', $incidencia->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="button" class="btn btn-danger btn-sm btn-close-incidencia">Cerrar Incidencia</button>
                    </form>
                @endif
            </h2>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $incidencia->descripcion }}</p>
            <p><strong>Estado:</strong> {{ $incidencia->estado->nombre ?? 'Sin estado' }}</p>
            <p><strong>Categoría:</strong> {{ $incidencia->categoria->nombre ?? 'Sin categoría' }}</p>
            <p><strong>Subcategoría:</strong> {{ $incidencia->subcategoria->nombre ?? 'Sin subcategoría' }}</p>
            <p><strong>Fecha de alta:</strong> {{ $incidencia->created_at->format('d/m/Y H:i') }}</p>
            
            @if($incidencia->imagen->count() > 0)
                <div>
                    <h4>Imagen(es):</h4>
                    @foreach($incidencia->imagen as $img)
                        <!-- Añadimos la clase clickable-image y cursor pointer -->
                        <img src="{{ asset($img->ruta) }}" alt="Incidencia Imagen" class="img-fluid mb-2 clickable-image" style="max-width:200px; cursor:pointer;">
                    @endforeach
                </div>
            @endif
            
            <!-- Sección del chat -->
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
            <form action="{{ route('incidencias.addComment', $incidencia->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="comentario" rows="3" class="form-control" placeholder="Escribe un comentario..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
            <!-- Fin sección chat -->
        </div>
    </div>

    <a href="{{ route('incidencias.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
<br>
<!-- Modal para imagen ampliada -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <img src="" class="img-fluid" id="enlargedImage" alt="Imagen ampliada">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('js/image-modal.js') }}"></script>
@endsection
