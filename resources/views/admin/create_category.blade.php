<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Categoría</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    @include('layout.navbar')
    <div class="container mt-5">
        <a href="{{ route('admin.admin') }}" class="btn btn-secondary mr-2">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1>Crear una nueva categoría</h1>
        <form action="{{ route('admin.store.category') }}" method="POST" id="create_category_form">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la categoría</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control" onblur="validateCategoryName()">
                @if ($errors->has('nombre'))
                    <div class="text-danger">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
                <p id="error-message-category" style="color:red; display:none;">Este campo no puede estar vacío.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <button type="submit" class="btn btn-primary">Crear categoría</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybFSQ6bJY14ISh08h0HgFJ2R1U7ew3uZCp1tSx3YxyPOT2R4n6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqQxt4q70zjJXrxSOiJwE5Xn7WzJ5wXLOQW+3N7Vj7a+L" crossorigin="anonymous"></script>
    <script src="{{ asset('js/subcategorias.js') }}"></script>
</body>
</html>
