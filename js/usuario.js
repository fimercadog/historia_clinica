function VerificarUsuario() {
    var usu = $("#txt_usu").val();
    var con = $("#txt_con").val();

    if (usu.length == 0 || con.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Llene los campos", "warning");
    }
    $.ajax({
        url: "../controlador/usuario/controlador_verificar_usuario.php",
        type: "POST",
        data: {
            user: usu,
            pass: con
        }
    }).done(function(resp) {
        if (resp == 0) {
            Swal.fire(
                "Mensaje de Error",
                "Usuario y/o contrase\u00f1a incorrecta",
                "error"
            );
        } else {
            var data = JSON.parse(resp);
            if (data[0][5] === "INACTIVO") {
                return Swal.fire(
                    "Mensaje de Advertencia",
                    "Lo sentimos, el usuario " +
                    usu + " se encuentra supendido, cominiquese con el administrado ",
                    "warning");
            }
            $.ajax({
                url: "../controlador/usuario/controlador_crear_session.php",
                type: "POST",
                data: {
                    idusuario: data[0][0],
                    user: data[0][1],
                    rol: data[0][6]
                }
            }).done(function(resp) {
                let timerInterval
                Swal.fire({
                    title: 'BIENVENIDO AL SISTEMA!',
                    html: 'Usted sera redirigido en <b></b> milisegundos.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {
                            const content = Swal.getContent()
                            if (content) {
                                const b = content.querySelector('b')
                                if (b) {
                                    b.textContent = Swal.getTimerLeft()
                                }
                            }
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload()
                    }
                })
            })
        }
    })
}
var table

function listar_usuario() {
    table = $("#tabla_usuario").DataTable({
        "ordering": false,
        "paging": false,
        "searching": { "regex": true },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/usuario/controlador_usuario_listar.php",
            type: 'POST'
        },
        "columns": [
            { "data": "posicion" },
            { "data": "usu_nombre" },
            { "data": "rol_nombre" },
            {
                "data": "usu_sexo",
                render: function(data, type, row) {
                    if (data == 'M') {
                        return "MASCULINO";
                    } else {
                        return "FEMENINO";
                    }
                }
            },
            {
                "data": "usu_estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge badge-success'>" + data + "</span>";
                    } else {
                        return "<span class='badge badge-danger'>" + data + "</span>";
                    }
                }
            },
            { "defaultContent": "<button style='font-size:13px;' type='button' class='desactivar btn btn-dark'> <i class='fa fa-trash'></i> </button> &nbsp; <button style='font-size:13px;' type='button' class='activar btn btn-success'> <i class='fa fa-check'></i> </button>" }
        ],

        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_usuario_filter").style.display = 'none'
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

}

$('#tabla_usuario').on('click', '.activar', function() {
    var data = table.row($(this).parents('tr')).data()
        // alert(data.usu_id)
    if (table.row(this).child.isShown()) {
        var data = table.row(this);
    }
    Swal.fire({
        title: 'Esta seguro de activar el usuario?',
        text: "Una vez hecho esto, el usuario  tendra acesso al Sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!'
    }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.usu_id, 'ACTIVO')
            Swal.fire(
                'Activado!',
                'Su registro fue activado.',
                'success'
            )
        }
    })
})

$('#tabla_usuario').on('click', '.desactivar', function() {
    var data = table.row($(this).parents('tr')).data()
        // alert(data.usu_id)
    if (table.row(this).child.isShown()) {
        var data = table.row(this);
    }
    Swal.fire({
        title: 'Esta seguro de desactivar el usuario?',
        text: "Una vez hecho esto, el usuario n tendra acesso al Sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Eliminar!'
    }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.usu_id, 'INACTIVO')
            Swal.fire(
                'Eliminado!',
                'Su registro fue eliminado.',
                'success'
            )
        }
    })
})

function Modificar_Estatus(idusuario, estatus) {
    var mensaje = '';
    if (estatus == 'INACTIVO') {
        mensaje = 'desactivo';
    } else {
        mensaje = 'activo';
    }
    $.ajax({
        url: "../controlador/usuario/controlador_modificar_estatus_usuario.php",
        type: "POST",
        data: {
            idusuario: idusuario,
            estatus: estatus
        }
    }).done(function(resp) {
        alert(resp)
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmacion", "el usuario se " + mensaje + " con exito", "success")
                .then((value) => {
                    table.ajax.reload()
                })
        }
    })
}


function filterGlobal() {
    $('#tabla_usuario').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function AbrirModalRegistro() {
    $("#modal_registro").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro").modal('show')
}

function listar_combo_rol() {
    $.ajax({
        url: "../controlador/usuario/controlador_combo_rol_listar.php",
        type: "POST",
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = ""
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";

            }
            $("#cbm_rol").html(cadena)
        } else {
            cadena += "<option value=''>no se encontraron registros</option>";
        }
    })
}

function Registrar_Usuario() {
    var usu = $("#txt_usu").val()
    var contra = $("#txt_con1").val()
    var contra2 = $("#txt_con2").val()
    var sexo = $("#cbm_sexo").val()
    var rol = $("#cbm_rol").val()

    if (usu.length == 0 || contra.length == 0 || contra2.length == 0 || sexo.length == 0 || rol.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Llene los campos vacios", "warning");
    }

    if (contra != contra2) {
        return Swal.fire("Mensaje de Advertencia", "las contraseñas deben coincidir", "warning");
    }

    $.ajax({
        url: "../controlador/usuario/controlador_usuario_registro.php",
        type: "POST",
        data: {
            usuario: usu,
            contrasena: contra,
            sexo: sexo,
            rol: rol
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                $("#modal_registro").modal('hide')
                Swal.fire("Mensaje de Confirmacion", "Datos correctamente diligenciados, Nuevo usaurio registrado", "success").then((value) => {
                    LimparRegistro()
                    table.ajax.reload()
                })
            } else {
                Swal.fire(
                    "Mensaje de Advertencia",
                    "Lo sentimos, el nombre del usuario ya esta en nuestra base de datos ",
                    "warning"
                );
            }
        } else {
            Swal.fire(
                "Mensaje de Error",
                "Lo sentimos, no se pudo completar el registro ",
                "error"
            );
        }
    })


}

function LimparRegistro() {
    $('#txt_usu').val();
    $('#txt_con1').val();
    $('#txt_con2').val();
}