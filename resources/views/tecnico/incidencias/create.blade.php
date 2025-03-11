@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nueva Incidencia</h1>
        <form action="{{ route('tecnico.incidencias.store') }}" method="POST">
            @csrf
            <div>
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required>
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required></textarea>
            </div>
            <!-- Agrega otros campos según la tabla -->
            <button type="submit">Guardar</button>
        </form>
    </div>
@endsection
