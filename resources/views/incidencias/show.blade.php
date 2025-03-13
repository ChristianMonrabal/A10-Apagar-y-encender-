@extends('layout.app')

@section('content')
<div class="container">
    <h1>Detalle de la Incidencia</h1>
    
    <div class="card">
        <div class="card-header">
            <h2>{{ $incidencia->titulo }}</h2>
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
                        <img src="{{ asset('storage/' . $img->ruta) }}" alt="Incidencia Imagen" class="img-fluid mb-2" style="max-width:200px;">
                    @endforeach
                </div>
            @endif
            
            <!-- Sección del chat -->
            <div>
                <h4>Chat:</h4>
                <div class="chat-box mb-3" style="border: 1px solid #ccc; padding: 10px; height:300px; overflow-y: scroll;">
                    @foreach($incidencia->comentario as $comentario)
                        <div class="mb-2">
                            @if($comentario->cliente)
                                <strong>{{ $comentario->cliente->nombre }} (Cliente):</strong>
                            @elseif($comentario->tecnico)
                                <strong>{{ $comentario->tecnico->nombre }} (Técnico):</strong>
                            @else
                                <strong>Usuario desconocido:</strong>
                            @endif
                            {{ $comentario->texto }}
                        </div>
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
@endsection
