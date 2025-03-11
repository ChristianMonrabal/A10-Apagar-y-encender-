$(document).ready(function() {
    // Función para mostrar mensaje de error (si aún no existe)
    function showError(element, message) {
        if ($(element).next('.error-message').length === 0) {
            $(element).after('<div class="error-message text-danger">' + message + '</div>');
        }
    }

    // Función para eliminar el mensaje de error
    function removeError(element) {
        $(element).next('.error-message').remove();
    }

    // Validar el input de título al perder el foco
    $('#titulo').on('blur', function() {
        if ($.trim($(this).val()) === '') {
            showError(this, 'El título es obligatorio.');
        } else {
            removeError(this);
        }
    });

    // Validar el textarea de descripción al perder el foco
    $('#descripcion').on('blur', function() {
        if ($.trim($(this).val()) === '') {
            showError(this, 'La descripción es obligatoria.');
        } else {
            removeError(this);
        }
    });

    // Validar el select de categoría al cambiar o perder el foco
    $('#categoria_id').on('change blur', function() {
        if ($(this).val() === null || $(this).val() === '') {
            showError(this, 'Debes seleccionar una categoría.');
        } else {
            removeError(this);
        }
    });

    // Validar el select de subcategoría al cambiar o perder el foco
    $('#subcategoria_id').on('change blur', function() {
        if ($(this).val() === null || $(this).val() === '') {
            showError(this, 'Debes seleccionar una subcategoría.');
        } else {
            removeError(this);
        }
    });
});
