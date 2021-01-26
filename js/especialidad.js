var tableespecialidad;

function listar_especialidad() {
    tableespecialidad = $("#tabla_especialidad").DataTable({
        "ordering": false,
        "bLengthChange": false,
        "searching": { "regex": false },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/especialidad/controlador_especialidad_listar.php",
            type: 'POST'
        },
        "order": [
            [1, 'asc']
        ],
        "columns": [
            { "defaultContent": "" },
            { "data": "especialidad_nombre" },
            { "data": "especialidad_fregistro" },
            {
                "data": "especialidad_estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            { "defaultContent": "<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='ed&iacute;tar'><i class='fa fa-edit'></i></button>" }
        ],

        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_especialidad_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

    tableespecialidad.on('draw.dt', function() {
        var PageInfo = $('#tabla_especialidad').DataTable().page.info();
        tableespecialidad.column(0, { page: 'current' }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

}