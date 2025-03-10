@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Incidencia</h1>
        <form action="{{ route('tecnico.incidencias.update', $incidencia->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="{{ $incidencia->titulo }}" required>
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required>{{ $incidencia->descripcion }}</textarea>
            </div>
            <!-- Agrega otros campos según la tabla -->
            <button type="submit">Actualizar</button>
        </form>
    </div>
@endsection
