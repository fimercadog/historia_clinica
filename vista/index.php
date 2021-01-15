<?php
session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location: ../Login/index.php');
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Plantilla/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../Plantilla/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../Plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../Plantilla/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Plantilla/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../Plantilla/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../Plantilla/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../Plantilla/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="../Plantilla/plugins/sweetalert2/sweetalert2.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../Plantilla/plugins/DataTables/datatables.min.css">

    <link rel="stylesheet" href="../Plantilla/plugins/select2/css/select2.min.css">

</head>
<style>
.swal2-popup {
    /* TODO: HACER QUE DETECTE EL VIEWPORT  */
    font-size: 1.6rem !important;
}
</style>

<!-- TODO: REVISAR EL CODIGO RESPONSIVE -->

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>


                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <!-- poup -->

                <li class="dropdown user user-menu open">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <img id="img_nav" class="user-image" alt="User Image">
                        <span class="hidden-xs"> <?php echo $_SESSION['S_USER']; ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img id="img_subnav" class="img-circle" alt="User Image">

                            <p>
                                <?php echo $_SESSION['S_USER']; ?> - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>

                        <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="#" onclick="AbrirModalEditarContra()" class="btn btn-default btn-sm float-left">cambiar
                            contraseña</a>
                    </div>
                    <div class="pull-right">
                        <a href="../controlador/usuario/controlador_cerrar_session.php"
                            class="btn btn-default btn-sm float-right">Salir</a>
                    </div>
                </li>
            </ul>
            </li>

            <!-- /.card -->


            <!-- /.card -->
    </div>




    <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
        </a>
    </li>
    </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <img src="../Plantilla/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img id="img_lateral" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"> <?php echo $_SESSION['S_USER']; ?> </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a onclick="cargar_contenido('contenido_principal','usuario/vista_usuario_listar.php')"
                            class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                USUARIO
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <input type="text" name="" value="<?php echo $_SESSION['S_IDUSUARIO'] ?>" id="txtidprincipal" hidden>
            <input type="text" name="" value="<?php echo $_SESSION['S_USER'] ?>" id="usuarioprincipal" hidden>
            <div class="row" id="contenido_principal">
                <div class="col-md-12">
                    <div class="card card-warning box-solid">
                        <div class="card-header with-border">
                            <h3 class="card-title">BIENVENIDO AL CONTENIDO PRINCIPAL</h3>

                            <div class="card-tools pull-right">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            CONTENIDO PRINCIPAL
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.5
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <form autocomplete="false" onsubmit="return false">
        <div class="modal fade" id="modal_editar_contra" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Editar Contraseña</b></h4>
                    </div>

                    <div class="modal-body">
                        <div class="col-lg-12">
                            <input type="text" id="txtcontra_bd">
                            <label for="usuario">Contraseña actual</label>
                            <input type="password" class="form-control" id="txtcontraactual_editar"
                                placeholder="Contraseña actual">
                        </div>

                        <div class="col-lg-12">
                            <label for="usuario">nueva Contraseña</label>
                            <input type="text" class="form-control" id="txtcontranu_editar"
                                placeholder="nueva Contraseña ">
                        </div>

                        <div class="col-lg-12">
                            <label for="usuario">repetir Contraseña</label>
                            <input type="text" class="form-control" id="txtcontrare_editar"
                                placeholder="repetir Contraseña ">
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" onclick="Editar_Contra()"><i class="fa fa-check">
                                    <b>Registrar</b></i></button>
                            <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa  fa-asterisk">
                                    <b>Cerrar</b></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- jQuery -->
    <script src="../Plantilla/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../Plantilla/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    var idioma_espanol = {
        select: {
            rows: "%d fila seleccionada"
        },
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningun dato disponible en esta tabla",
        "sInfo": "Registros del (_START_  al _END_) total de  _TOTAL_ registros",
        "sInfoEmpty": "Registrol  del (0 al 0) total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ Registrado)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "<b>No se encontraron datos</b>",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ultimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterrior"
        },
        "oAria": {
            "sSortAscending": ": Activar para orernar la columna de manera ascendente",
            "sSortDescending": ": Activar para orernar la columna de manera descendente"
        }
    }


    function cargar_contenido(contenedor, contenido) {
        $("#" + contenedor).load(contenido);
    }
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../Plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../Plantilla/plugins/chart.js/Chart.min.js"></script>

    <script src="../Plantilla/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- JQVMap -->
    <script src="../Plantilla/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../Plantilla/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../Plantilla/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../Plantilla/plugins/moment/moment.min.js"></script>
    <script src="../Plantilla/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../Plantilla/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../Plantilla/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../Plantilla/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../Plantilla/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../Plantilla/dist/js/demo.js"></script>

    <script src="../Plantilla/plugins/DataTables/datatables.min.js"></script>

    <script src="../Plantilla/plugins/select2/js/select2.min.js"></script>

    <script src="../js/usuario.js"></script>
    <script>
    TraerDatosUsuario()
    </script>
</body>

</html>