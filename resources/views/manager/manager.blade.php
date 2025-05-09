@extends('layout.app')

@section('title', 'Gestor de equipo')

@section('content')
<div class="contenido">
    {{-- Filtros --}}
    <div class="filter-section text-white py-4" style="background: url('{{ asset('img/header.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container">
            <form id="filtro-form" class="form-row align-items-center">
                <!-- Técnico -->
                <div class="col-md-3 pt-4">
                    <select name="tecnico" id="tecnico" class="custom-select">
                        <option value="">Técnicos</option>
                        @foreach($tecnicosMiSede as $id => $nombre)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Prioridad -->
                <div class="col-md-3 pt-4">
                    <select name="prioridad" id="prioridad" class="custom-select">
                        <option value="">Prioridades</option>
                        @foreach($prioridades as $id => $nivel)
                            <option value="{{ $id }}">{{ $nivel }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Estado -->
                <div class="col-md-3 pt-4">
                    <select name="estado" id="estado" class="custom-select">
                        <option value="">Incidencias</option>
                        <option value="abiertas">Quitar Cerradas</option>
                        <option value="cerradas">Ver Cerradas</option>
                    </select>
                </div>

                <!-- Orden -->
                <div class="col-md-3 pt-4">
                    <select name="orden" id="orden" class="custom-select">
                        <option value="desc">Descendente</option>
                        <option value="asc">Ascendente</option>
                    </select>
                </div>

                <div class="text-center w-100 mt-4 mb-1">
                    <button type="button" class="btn btn-outline-secondary" id="reset-filters">Borrar filtros</button>
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
                div.classList.add("card", "mb-3", "shadow-sm", "mx-3");
                div.style.paddingBottom = "17px";

                div.innerHTML = 
                    "<div class='card-header' style='background-color: #343A40;'>" +
                        "<h5 class='card-title mb-0' style='color: white;'>" + incidencia.titulo + "</h5>" +
                        "<small style='color: #ffffffc7;'>" + (incidencia.cliente ? incidencia.cliente.nombre : "") + "</small>" +
                    "</div>" +
                    "<div class='card-body'>" +
                        "<p><strong>Técnico:</strong>" +
                            "<select class='custom-select tecnico-select' data-incidencia-id='" + incidencia.id + "' onchange='actualizarTecnico(this)'>" +
                                // Si incidencia.tecnico es null se selecciona "Sin asignar"
                                "<option value='' " + (incidencia.tecnico == null ? "selected" : "") + ">Sin asignar</option>" +
                                @foreach($tecnicosMiSede as $id => $nombre)
                                    "<option value='{{ $id }}' " + ((incidencia.tecnico && incidencia.tecnico.id == {{ $id }}) ? 'selected' : '') + ">{{ $nombre }}</option>" +
                                @endforeach
                            "</select>" +
                        "</p>" +
                        "<p><strong>Subcategoría:</strong> " + (incidencia.subcategoria ? incidencia.subcategoria.nombre : "") + "</p>" +
                        "<p><strong>Descripción:</strong> " + incidencia.descripcion + "</p>" +
                        "<p><strong>Estado:</strong> " + (incidencia.estado ? incidencia.estado.nombre : "") + "</p>" +
                        "<p><strong>Prioridad:</strong>" +
                            "<select class='custom-select prioridad-select' data-incidencia-id='" + incidencia.id + "' onchange='actualizarPrioridad(this)'>" +
                                // Verificamos si incidencia.prioridad existe; si no, se selecciona "Sin asignar"
                                "<option value='' " + (incidencia.prioridad == null ? "selected" : "") + ">Sin asignar</option>" +
                                @foreach($prioridades as $id => $nivel)
                                    "<option value='{{ $id }}' " + ((incidencia.prioridad && incidencia.prioridad.id == {{ $id }}) ? 'selected' : '') + ">{{ $nivel }}</option>" +
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
