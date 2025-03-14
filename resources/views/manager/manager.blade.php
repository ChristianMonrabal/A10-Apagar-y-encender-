@extends('layout.gestor')

@section('title', 'Gestor de equipo')

@section('content')

<div class="contenido">
    {{-- Filtros --}}
    <div class="filter-section text-white py-5" style="background: url('{{ asset('img/header.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container">
            <form id="filtro-form" class="row g-3 align-items-center">
                <!-- Técnico -->
                <div class="col-md-3">
                    <label for="tecnico" class="form-label">Filtrar por Técnico</label>
                    <select name="tecnico" id="tecnico" class="form-select">
                        <option value="">Todos</option>
                        @foreach($tecnicosMiSede as $id => $nombre)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Prioridad -->
                <div class="col-md-3">
                    <label for="prioridad" class="form-label">Filtrar por Prioridad</label>
                    <select name="prioridad" id="prioridad" class="form-select">
                        <option value="">Todos</option>
                        @foreach($prioridades as $id => $nivel)
                            <option value="{{ $id }}">{{ $nivel }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Estado -->
                <div class="col-md-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-select">
                        <option value="">Todos</option>
                        <option value="abiertas">Quitar Cerradas</option>
                        <option value="cerradas">Ver Cerradas</option>
                    </select>
                </div>

                <!-- Orden -->
                <div class="col-md-3">
                    <label for="orden" class="form-label">Orden</label>
                    <select name="orden" id="orden" class="form-select">
                        <option value="desc">Descendente</option>
                        <option value="asc">Ascendente</option>
                    </select>
                </div>

                <div class="col-12 text-center mt-3">
                    <button type="button" class="btn btn-secondary" id="reset-filters">Borrar Filtros</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Incidencias --}}
    <div class="d-flex justify-content-center flex-wrap" id="incidencias-container">
    </div>

</div>

<script>

    var formulario = document.getElementById("filtro-form");
    var contenedorIncidencias = document.getElementById("incidencias-container");
    var botonResetear = document.getElementById("reset-filters");

    var csrf = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrf.getAttribute('content');

    function cargarIncidencias() {
        var formData = new FormData(formulario);
        var formString = new URLSearchParams(formData).toString();

        fetch("{{ route('manager') }}" + "?" + formString, {
            headers: { "accept": "application/json" }
        })
        .then(response => response.json())
        .then(data => {
            contenedorIncidencias.innerHTML = "";

            if (data.incidencias.length === 0) {
                contenedorIncidencias.innerHTML = "<p>No hay incidencias disponibles.</p>";
                return;
            }

            data.incidencias.forEach(incidencia => {
                var div = document.createElement("div");
                div.classList.add("card", "mb-3", "col-md-4", "shadow-sm", "mx-3");
                div.style.paddingBottom = "17px";

                div.innerHTML = 
                "<div class='card-header'>" +
                    "<h5 class='card-title'>" + incidencia.titulo + "</h5>" +
                    "<h6 class='card-subtitle mb-2 text-muted'>" + incidencia.cliente.nombre + "</h6>" +
                "</div>" +
                "<div class='card-body'>" +
                    "<p><strong>Técnico:</strong>" +
                        "<select class='form-select tecnico-select' data-incidencia-id='" + incidencia.id + "' onchange='actualizarTecnico(this)'>" +
                            "<option value='' " + (incidencia.tecnico === null ? "selected" : "") + ">Sin asignar</option>" +
                            @foreach($tecnicosMiSede as $id => $nombre)
                                "<option value='{{ $id }}' " + (incidencia.tecnico && incidencia.tecnico.id == {{ $id }} ? 'selected' : '') + ">{{ $nombre }}</option>" +
                            @endforeach
                        "</select>" +
                    "</p>" +
                    "<p><strong>Subcategoría:</strong> " + incidencia.subcategoria.nombre + "</p>" +
                    "<p><strong>Descripción:</strong> " + incidencia.descripcion + "</p>" +
                    "<p><strong>Estado:</strong> " + incidencia.estado.nombre + "</p>" +
                    "<p><strong>Prioridad:</strong>" +
                        "<select class='form-select prioridad-select' data-incidencia-id='" + incidencia.id + "' onchange='actualizarPrioridad(this)'>" +
                            @foreach($prioridades as $id => $nivel)
                                "<option value='{{ $id }}' " + (incidencia.prioridad.id == {{ $id }} ? 'selected' : '') + ">{{ $nivel }}</option>" +
                            @endforeach
                        "</select>" +
                    "</p>" +
                "</div>";

                contenedorIncidencias.appendChild(div);
            });
        })
        .catch(error => console.error("Error cargando incidencias:", error));
    }

    // Función para actualizar el técnico
    function actualizarTecnico(select) {
        var incidenciaId = select.getAttribute("data-incidencia-id");
        var tecnicoId = select.value;

        fetch("/incidencias/" + incidenciaId + "/tecnico", {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ tecnico_id: tecnicoId })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert('Error al actualizar técnico.');
            }
        });
    }

    // Función para actualizar la prioridad
    function actualizarPrioridad(select) {
        var incidenciaId = select.getAttribute("data-incidencia-id");
        var prioridadId = select.value;

        fetch("/incidencias/" + incidenciaId + "/prioridad", {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ prioridad_id: prioridadId })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert('Error al actualizar prioridad.');
            } else {
                alert('Prioridad actualizada.');
            }
        });
    }

    // Llamar a la función cuando cambian los filtros
    formulario.onchange = cargarIncidencias;

    // Resetear filtros
    botonResetear.onclick = () => {
        formulario.reset();
        cargarIncidencias();
    };

    // Cargar incidencias al inicio
    cargarIncidencias();

</script>

@endsection
