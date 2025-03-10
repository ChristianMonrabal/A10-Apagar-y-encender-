@extends('layout.gestor')

@section('title','Gestor de equipo')

@section('content')

    <div class="contenido">
        {{-- F I L T R O S --}}
        <div class="filter-section text-white py-5" style="background: url('{{ asset('img/header.jpg') }}') no-repeat center center; background-size: cover;">
            <div class="container">
                <form action="{{ route('manager') }}" method="GET" class="row g-3 align-items-center">
                    <!-- Menú desplegable para filtrar por Técnico -->
                    <div class="col-md-4">
                        <label for="tecnico" class="form-label">Filtrar por Técnico</label>
                        <select name="tecnico" id="tecnico" class="form-select" onchange="this.form.submit()">
                            <option value="">Todos</option>
                            @foreach($tecnicosMiSede as $id => $nombre)
                                <option value="{{ $id }}" {{ request('tecnico') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="prioridad" class="form-label">Filtrar por Prioridad</label>
                        <select name="prioridad" id="prioridad" class="form-select" onchange="this.form.submit()">
                            <option value="">Todos</option>
                            @foreach($prioridades as $id => $nivel)
                                <option value="{{ $id }}" {{ request('prioridad') == $id ? 'selected' : '' }}>{{ $nivel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('manager') }}'">Borrar Filtros</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- FIN FILTROS --}}

        <div class="d-flex justify-content-center">

            @foreach ($incidencias as $incidencia)
                <div style="padding-bottom: 17px; ">
                    <p>{{$incidencia->titulo}}</p>
                    <p>{{$incidencia->cliente->nombre}}</p>
                    <p>{{$incidencia->gestor->nombre}}</p>
                    <p>{{$incidencia->subcategoria->nombre}}</p>
                    <p>{{$incidencia->descripcion}}</p>
                    <p>{{$incidencia->estado->nombre}}</p>
                    <p>{{$incidencia->prioridad->nivel}}</p>
                </div>    
            @endforeach
            
        </div>

    </div>

@endsection