<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear subcategoria</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
@include('layout.navbar')

<div class="container mt-5">
    <a href="{{ route('admin.admin') }}" class="btn btn-secondary mr-2">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <h1>Crear Subcategoría</h1>
    <form action="{{ route('admin.store.subcategory') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="categorias_id">Categoría</label>
            <select id="categorias_id" name="categorias_id" class="form-control" onchange="toggleSubcategoryField()">
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categorias_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mt-3">
            <label for="nombre">Nombre de la subcategoría</label>
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre de la subcategoría" disabled onblur="validateSubcategoryName()">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <p id="error-message" style="color:red; display:none;">Este campo no puede estar vacío.</p>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <button type="submit" class="btn btn-primary mt-3">Crear Subcategoría</button>
    </form>
</div>

<script src="{{ asset('js/create_subcategorias.js') }}"></script>
