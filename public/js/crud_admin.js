document.addEventListener('DOMContentLoaded', function() {
    // Función para cargar los usuarios en la tabla
    function cargarUsuarios() {
        fetch('/admin', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#usuarios-table tbody');
            tableBody.innerHTML = ''; // Limpiar la tabla antes de agregar los datos

            data.forEach(usuario => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${usuario.nombre}</td>
                    <td>${usuario.email}</td>
                    <td>${usuario.roles_id}</td>
                    <td>${usuario.sedes_id}</td>
                    <td>
                        <button onclick="deleteUsuario(${usuario.id})">Eliminar</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.log(error));
    }

    // Cargar los usuarios cuando la página se carga
    cargarUsuarios();

    const filterForm = document.getElementById('filter-form');
    const tableBody = document.querySelector('#usuarios-table tbody');

    // Enviar la solicitud AJAX cuando se aplica el filtro
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const nombre = document.getElementById('nombre').value;
        const roles_id = document.getElementById('roles_id').value;
        const sedes_id = document.getElementById('sedes_id').value;

        fetch(`/admin?nombre=${nombre}&roles_id=${roles_id}&sedes_id=${sedes_id}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = ''; // Limpiar la tabla antes de agregar los datos
            data.forEach(usuario => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${usuario.nombre}</td>
                    <td>${usuario.email}</td>
                    <td>${usuario.roles_id}</td>
                    <td>${usuario.sedes_id}</td>
                    <td>
                        <button onclick="deleteUsuario(${usuario.id})">Eliminar</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.log(error));
    });
});

// Función para eliminar usuario (puedes implementarla según tu lógica)
function deleteUsuario(id) {
    // Código para eliminar el usuario mediante AJAX
    fetch(`/admin/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        // Recargar los usuarios después de la eliminación
        cargarUsuarios();
    })
    .catch(error => console.log(error));
}
