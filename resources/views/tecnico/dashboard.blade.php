@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Panel Técnico</h1>
        <p>Bienvenido, {{ Auth::user()->nombre }}.</p>
        <a href="{{ route('tecnico.incidencias.index') }}">Ver Incidencias</a>
    </div>
@endsection
