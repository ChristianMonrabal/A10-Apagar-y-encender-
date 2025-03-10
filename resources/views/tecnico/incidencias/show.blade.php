@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalle de la Incidencia</h1>
        <p><strong>ID:</strong> {{ $incidencia->id }}</p>
        <p><strong>Título:</strong> {{ $incidencia->titulo }}</p>
        <p><strong>Descripción:</strong> {{ $incidencia->descripcion }}</p>
        <p><strong>Estado:</strong> {{ $incidencia->estado->nombre ?? 'Sin estado' }}</p>
        <p><strong>Creada:</strong> {{ $incidencia->created_at }}</p>
        <a href="{{ route('tecnico.incidencias.index') }}">Volver al listado</a>
    </div>
@endsection
