$(document).ready(function() {
    // ===========================================================================
    $('#adquisicion').on('change', function(event) {
        const id = $(this).val();
        if (id == 'Sede física') {
            $('#cajadepartamento').removeClass('d-none');
            $('#cajamunicipio_id').removeClass('d-none');
            $('#cajasede_id').removeClass('d-none');
        } else {
            $('#cajadepartamento').addClass('d-none');
            $('#cajamunicipio_id').addClass('d-none');
            $('#cajasede_id').addClass('d-none');
        }
    });
    $('#tipo').on('change', function(event) {
        $('.grupo_producto').toggleClass('d-none');
        $('.grupo_servicio').toggleClass('d-none');
    });

    //========================================================================================
    // Cambio departamentos -> Cargar municipios
    $('#departamento').on('change', function(event) {
        const url_t = $(this).attr('data_url');
        const id = $(this).val();
        var data = {
            "id": id,
        };
        $.ajax({
            url: url_t,
            type: 'GET',
            data: data,
            success: function(respuesta) {
                respuesta_html = '';
                respuesta_html += '<option value="">--Seleccione Municipio--</option>';
                $.each(respuesta, function(index, item) {
                    respuesta_html += '<option value="' + item['id'] + '">' + item['municipio'] + '</option>';
                });
                $('#municipio_id').html(respuesta_html);
            },
            error: function(e) {
                console.log(e)
            }
        });
    });
    //========================================================================================
    // Cambio municipios -> Cargar sedes
    $('#municipio_id').on('change', function(event) {
        const url_t = $(this).attr('data_url');
        const id = $(this).val();
        var data = {
            "id": id,
        };
        $.ajax({
            url: url_t,
            type: 'GET',
            data: data,
            success: function(respuesta) {
                respuesta_html = '';
                respuesta_html += '<option value="">--Seleccione Sede--</option>';
                $.each(respuesta, function(index, item) {
                    respuesta_html += '<option value="' + item['id'] + '">' + item['nombre'] + '</option>';
                });
                $('#sede_id').html(respuesta_html);
            },
            error: function(e) {
                console.log(e)
            }
        });
    });
    //========================================================================================
    // Categoria Productos
    $('#categoria').on('change', function(event) {
        const url_t = $(this).attr('data_url');
        const id = $(this).val();
        var data = {
            "id": id,
        };
        $.ajax({
            url: url_t,
            type: 'GET',
            data: data,
            success: function(respuesta) {
                respuesta_html = '';
                respuesta_html += '<option value="">--Seleccione--</option>';
                $.each(respuesta.productos, function(index, item) {
                    respuesta_html += '<option value="' + item['id'] + '">' + item['producto'] + '</option>';
                });
                $('#producto').html(respuesta_html);
            },
            error: function(e) {
                console.log(e)
            }
        });
    });
    //========================================================================================
    // Producto Marcas
    $('#producto').on('change', function(event) {
        const url_t = $(this).attr('data_url');
        const id = $(this).val();
        var data = {
            "id": id,
        };
        $.ajax({
            url: url_t,
            type: 'GET',
            data: data,
            success: function(respuesta) {
                respuesta_html = '';
                respuesta_html += '<option value="">--Seleccione--</option>';
                $.each(respuesta.marcas, function(index, item) {
                    respuesta_html += '<option value="' + item['id'] + '">' + item['marca'] + '</option>';
                });
                $('#marca').html(respuesta_html);
            },
            error: function(e) {
                console.log(e)
            }
        });
    });
    //========================================================================================
    // Marca Referencias
    $('#marca').on('change', function(event) {
        const url_t = $(this).attr('data_url');
        const id = $(this).val();
        var data = {
            "id": id,
        };
        $.ajax({
            url: url_t,
            type: 'GET',
            data: data,
            success: function(respuesta) {
                respuesta_html = '';
                respuesta_html += '<option value="">--Seleccione--</option>';
                $.each(respuesta.referencias, function(index, item) {
                    respuesta_html += '<option value="' + item['id'] + '">' + item['referencia'] + '</option>';
                });
                $('#referencia_id').html(respuesta_html);
            },
            error: function(e) {
                console.log(e.responseText)
            }
        });
    });
});
