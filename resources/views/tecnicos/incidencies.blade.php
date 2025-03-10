@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Incidències assignades</h1>
    <!-- Tabla de incidències -->
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Títol</th>
                <th>Descripció</th>
                <th>Estat</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incidences as $incidence)
            <tr>
                <td>{{ $incidence->id }}</td>
                <td>{{ $incidence->title }}</td>
                <td>{{ $incidence->description }}</td>
                <td>
                    @if($incidence->status == 'Assignada')
                        <span class="badge bg-warning">Assignada</span>
                    @elseif($incidence->status == 'En treball')
                        <span class="badge bg-info">En treball</span>
                    @elseif($incidence->status == 'Resolta')
                        <span class="badge bg-success">Resolta</span>
                    @endif
                </td>
                <td>
                    @if($incidence->status == 'Assignada')
                        <button class="btn btn-primary btn-sm" id="btnIniciar_{{ $incidence->id }}">Iniciar Treball</button>
                    @elseif($incidence->status == 'En treball')
                        <button class="btn btn-success btn-sm" id="btnResolt_{{ $incidence->id }}">Marcar com Resolta</button>
                    @endif
                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal" data-incidence="{{ $incidence->id }}">Enviar Missatge</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal para enviar mensajes al cliente -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Enviar Missatge al Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tancar"></button>
            </div>
            <div class="modal-body">
                <form id="messageForm">
                    @csrf
                    <div class="mb-3">
                        <label for="messageText" class="form-label">Missatge</label>
                        <textarea class="form-control" id="messageText" rows="3" placeholder="Escriu aquí el teu missatge..."></textarea>
                    </div>
                    <input type="hidden" id="incidenceId" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel·lar</button>
                <button type="button" class="btn btn-primary" id="btnEnviarMissatge">Enviar Missatge</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Asigna acciones a los botones de cambiar estado
    document.querySelectorAll('[id^="btnIniciar_"]').forEach(function(button) {
        button.addEventListener('click', function() {
            changeStatus(this.id.split('_')[1], 'En treball');
        });
    });

    document.querySelectorAll('[id^="btnResolt_"]').forEach(function(button) {
        button.addEventListener('click', function() {
            changeStatus(this.id.split('_')[1], 'Resolta');
        });
    });

    // Captura el ID de la incidencia al abrir el modal de mensaje
    var messageModal = document.getElementById('messageModal');
    messageModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var incidenceId = button.getAttribute('data-incidence');
        document.getElementById('incidenceId').value = incidenceId;
    });

    // Acción del botón de enviar mensaje en el modal
    document.getElementById('btnEnviarMissatge').addEventListener('click', function() {
        sendMessage();
    });
});

// Función para actualizar el estado de la incidencia mediante fetch
function changeStatus(id, newStatus) {
    fetch(`/tecnicos/${id}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error al canviar l\'estat.');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Función para enviar el mensaje
function sendMessage() {
    var id = document.getElementById('incidenceId').value;
    var message = document.getElementById('messageText').value;

    fetch(`/tecnicos/${id}/message`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Missatge enviat.');
            var modal = bootstrap.Modal.getInstance(document.getElementById('messageModal'));
            modal.hide();
            document.getElementById('messageText').value = '';
        } else {
            alert('Error al enviar el missatge.');
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection
