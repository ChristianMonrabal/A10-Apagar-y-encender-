$(document).ready(function(){
    $('#categoria_id').on('change', function(){
        var categoriaId = $(this).val();
        if(categoriaId){
            $.ajax({
                url: '/categorias/' + categoriaId + '/subcategorias',
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data); // Para depuración
                    $('#subcategoria_id').empty();
                    $('#subcategoria_id').append('<option value="" disabled selected>Selecciona una subcategoría</option>');
                    $.each(data, function(key, subcategoria){
                        $('#subcategoria_id').append('<option value="'+ subcategoria.id +'">'+ subcategoria.nombre +'</option>');
                    });
                },
                error: function(){
                    alert('Error al cargar las subcategorías.');
                }
            });
        } else {
            $('#subcategoria_id').empty();
            $('#subcategoria_id').append('<option value="">Selecciona una subcategoría</option>');
        }
    });
});
