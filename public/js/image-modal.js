$(document).ready(function(){
    $('.clickable-image').on('click', function(){
        var src = $(this).attr('src');
        $('#enlargedImage').attr('src', src);
        $('#imageModal').modal('show');
    });
});

$(document).ready(function(){
    $('.btn-close-incidencia').on('click', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: '¿Estás seguro de cerrar esta incidencia?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, cerrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if(result.isConfirmed) {
                form.submit();
            }
        });
    });
});