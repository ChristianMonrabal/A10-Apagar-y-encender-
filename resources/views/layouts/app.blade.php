<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicación de Incidencias</title>
    <!-- Aquí puedes incluir tus archivos CSS y otros recursos -->
</head>
<body>
    <header>
        <nav>
            <!-- Menú de navegación -->
            <a href="{{ route('tecnico.home') }}">Inicio</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <!-- Pie de página -->
        <p>&copy; 2025</p>
    </footer>
</body>
</html>
