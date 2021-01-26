function listar_procedimiento() {
    var tableprocedimiento = $("#tabla_procedimiento").DataTable({
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
            "url": "../controlador/procedimiento/controlador_procedimiento_listar.php",
            type: 'POST'
        },
        "order": [
            [1, 'asc']
        ],
        "columns": [
            { "defaultContent": "" },
            { "data": "procedimiento_nombre" },
            { "data": "procedimiento_fecregistro" },
            {
                "data": "procedimiento_estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            { "defaultContent": "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>" }
        ],

        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_procedimiento_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

    tableprocedimiento.on('draw.dt', function() {
        var PageInfo = $('#tabla_procedimiento').DataTable().page.info();
        tableprocedimiento.column(0, { page: 'current' }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

}

function AbrirModalRegistro() {
    $("#modal_registro").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro").modal('show');
}

function Registro_Procedimiento() {
    var procedimiento = $("#txt_procedimiento").val();
    var estatus = $("#cbm_estatus").val();
    if (procedimiento.length == 0) {
        return Swal.fire("Mensaje De Advertencia", "El campo procedimiento debe tener datos", "warning");
    }

    $.ajax({
        url: '../controlador/procedimiento/controlador_procedimiento_registro.php',
        type: 'post',
        data: {
            p: procedimiento,
            e: estatus
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                $("#modal_registro").modal('hide');
                listar_procedimiento();
                LimpiarDatos();
                Swal.fire("Mensaje De Confirmacion", "Datos guardados correctamente, procedimiento registrado", "success");
            } else {
                LimpiarDatos();
                Swal.fire("Mensaje De Advertencia", "El procedimiento ya existe en nuestra data", "warning");
            }
        }
    })
}


function LimpiarDatos() {
    $("#txt_procedimiento").val("");
}