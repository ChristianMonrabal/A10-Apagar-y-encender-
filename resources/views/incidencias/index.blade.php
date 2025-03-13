@extends('layout.app')

@section('content')
<br>
<div class="container">

    {{-- FILTROS y BOTONES SUPERIORES --}}
    <div class="d-flex mb-3">
        <!-- Botón de crear incidencia -->
        <div class="mr-3">
            <a href="{{ route('incidencias.create') }}" class="btn btn-primary">Crear Incidencia</a>
        </div>

        <!-- Filtro de estado (select) y otros filtros -->
        <form method="GET" action="{{ route('incidencias.index') }}" class="form-inline">
            <div class="form-group mr-2">
                <label for="estado" class="mr-2">Filtrar por estado:</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="">Todos</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Checkbox para ocultar resueltas -->
            <div class="form-group form-check mr-2">
                <input type="checkbox" class="form-check-input" id="hide_resolved" name="hide_resolved" value="1">
                <label class="form-check-label" for="hide_resolved">Ocultar resueltas</label>
            </div>

            <!-- Botones para ordenar por fecha ASC/DESC -->
            <div class="form-group mr-2">
                <label for="order" class="mr-2">Ordenar fecha:</label>
                <select name="order" id="order" class="form-control">
                    <option value="ASC" {{ $order == 'ASC' ? 'selected' : '' }}>ASC</option>
                    <option value="DESC" {{ $order == 'DESC' ? 'selected' : '' }}>DESC</option>
                </select>
            </div>

            <button type="submit" class="btn btn-outline-secondary ml-2">Aplicar</button>
            <!-- Botón para borrar filtros -->
            <a href="{{ route('incidencias.index') }}" class="btn btn-outline-secondary ml-2">Borrar filtros</a>
        </form>
    </div>

    {{-- LISTADO DE INCIDENCIAS con un diseño lineal (sin tabla) --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($incidencias as $incidencia)

    @php
    $colores = [
        'sin asignar' => 'badge-sin-asignar',
        'asignada'    => 'badge-asignada',
        'en trabajo'  => 'badge-en-trabajo',
        'resuelta'    => 'badge-resuelta',
        'cerrada'     => 'badge-cerrada'
    ];
    // Convertir el nombre del estado a minúsculas
    $estadoNombre = strtolower(trim($incidencia->estado->nombre));
    $claseEstado = $colores[$estadoNombre] ?? 'badge-secondary';
@endphp

    <div class="d-flex justify-content-between align-items-center p-3 mb-2 bg-white shadow-sm rounded border card-hover">
        <div>
            <strong>Incidencia:</strong> {{ $incidencia->titulo }}<br>
            <small>Creada el {{ $incidencia->created_at->format('d/m/Y') }}</small>
        </div>
        <div class="ml-auto mr-2">
            <span class="badge {{ $claseEstado }}">
                {{ $incidencia->estado->nombre ?? 'Sin estado' }}
            </span>
        </div>
        <div>
            <a href="{{ route('incidencias.show', $incidencia->id) }}" class="btn btn-outline-info btn-sm boton-custom">
                Ver Detalle
            </a>
        </div>
    </div>
    @empty
        <p>No hay incidencias registradas.</p>
    @endforelse

</div>
@endsection
