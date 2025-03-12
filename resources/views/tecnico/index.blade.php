@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Listado Completo de Incidencias</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
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
                            <td>
                                <span class="badge bg-primary">{{ optional($incidencia->estado)->nombre }}</span>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ optional($incidencia->prioridad)->nivel }}</span>
                            </td>
                            <td>{{ $incidencia->fecha_resolucion ? $incidencia->fecha_resolucion->format('d-m-Y') : 'Pendiente' }}</td>
                            <td>
                                <a href="{{ route('tecnico.show', $incidencia->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
