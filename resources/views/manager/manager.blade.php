@extends('layout.gestor')

@section('title','Gestor de equipo')

@section('content')

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

@endsection