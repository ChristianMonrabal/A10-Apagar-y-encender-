@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listado Completo de Incidencias</h1>
        <a href="{{ route('tecnico.incidencias.create') }}">Nueva Incidencia</a>
        <table border="1" cellpadding="5">
            <thead>
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
                        <td>{{ optional($incidencia->estado)->nombre }}</td>
                        <td>{{ optional($incidencia->prioridad)->nivel }}</td>
                        <td>{{ $incidencia->fecha_resolucion }}</td>
                        <td>
                            <a href="{{ route('tecnico.incidencias.show', $incidencia->id) }}">Ver</a>
                            <a href="{{ route('tecnico.incidencias.edit', $incidencia->id) }}">Editar</a>
                            <!-- Aquí podrías incluir un botón o formulario para eliminar -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
