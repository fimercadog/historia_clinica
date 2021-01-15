<script type="text/javascript" src="../js/usuario.js?rev= <?php echo time(); ?> "></script>
<div class="col-md-12">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">BIENVENIDO AL CONTENIDO DEL USUARIO</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group">
                <div class="col-lg-10">
                    <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter"
                            placeholder="Ingresar dato a buscar">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-success" style="width: 100%;" onclick="AbrirModalRegistro()">
                        <i class="fa fa-plus"> Nuevo Registro</i>
                    </button>
                </div>
            </div>
            <table id="tabla_usuario" class="display responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Sexo</th>
                        <th>Estatus</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Sexo</th>
                        <th>Estatus</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </tfoot>

            </table>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_registro" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Registro de Usuario</b></h4>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="txt_usu" placeholder="Ingrese el usuario"
                            name="usuario">
                    </div><br>
                    <div class="col-lg-12">
                        <label for="password">Contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="txt_con1" placeholder="Ingrese la contraseña"
                            name="password">
                    </div><br>
                    <div class="col-lg-12">
                        <label for="password">Repita la Contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="txt_con2" placeholder="repita la contraseña"
                            name="password">
                    </div><br>
                    <div class="col-lg-12">
                        <label for="password">Sexo</label>
                        <select class="js-example-basic-single" name="state" id="cbm_sexo" style="width: 100%;">
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div><br>
                    <div class="col-lg-12">
                        <label for="password">Rol</label>
                        <select class="js-example-basic-single" name="state" id="cbm_rol" style="width: 100%;">
                        </select>
                    </div><br>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="Registrar_Usuario()"><i class="fa fa-check">
                            <b>Registrar</b></i></button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa  fa-asterisk">
                            <b>Cerrar</b></i></button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Editar de Usuario</b></h4>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <input type="text" id="txtidusaurio" hidden>
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="txtusu_editar" placeholder="Ingrese el usuario"
                            name="usuario" disabled>
                    </div><br>
                    <div class="col-lg-12">
                        <label for="password">Sexo</label>
                        <select class="js-example-basic-single" name="state" id="cbm_sexo_editar" style="width: 100%;">
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div><br>
                    <div class="col-lg-12">
                        <label for="password">Rol</label>
                        <select class="js-example-basic-single" name="state" id="cbm_rol_editar" style="width: 100%;">
                        </select>
                    </div><br>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="Modificar_Usuario()"><i class="fa fa-check">
                            <b>Registrar</b></i></button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa  fa-asterisk">
                            <b>Cerrar</b></i></button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
$(document).ready(function() {
    listar_usuario()
    $('.js-example-basic-single').select2();
    listar_combo_rol()
    $("#modal_registro").on('shown.bs.modal', function() {
        $("#txt_usu").focus()
    })
});
</script>