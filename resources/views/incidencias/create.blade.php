@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Incidencia</h1>
    
    <form method="POST" action="{{ route('incidencias.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo') }}">
        </div>
        @error('titulo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion') }}</textarea>
        </div>
        @error('descripcion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <!-- Select de Categoría -->
        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control">
                <option value="" disabled selected>Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        @error('categoria_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- Select de Subcategoría (se llenará vía AJAX) -->
        <div class="form-group">
            <label for="subcategoria_id">Subcategoría</label>
            <select name="subcategoria_id" id="subcategoria_id" class="form-control">
                <option value="" disabled selected>Selecciona una subcategoría</option>
            </select>
        </div>
        @error('subcategoria_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="imagen">Imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="form-control-file">
        </div>
        @error('imagen')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-primary">Registrar Incidencia</button>
    </form>
</div>
@endsection

@section('scripts')
    {{-- Asegúrate de cargar jQuery (versión completa) antes del script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Ya se incluye el archivo subcategorias.js para cargar las subcategorías vía AJAX --}}
    <script src="{{ asset('js/subcategorias.js') }}"></script>
    {{-- Incluye el archivo de validaciones --}}
    <script src="{{ asset('js/validations.js') }}"></script>
@endsection
