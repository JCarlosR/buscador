<?php 
    session_start();
    $inicioSesion = isset($_SESSION['username']);
    if ($inicioSesion) {
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <title>Adminto - Responsive Admin Dashboard Template</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="../assets/plugins/morris/morris.css">

        <!-- App css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="../assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo"><span>Admin<span>to</span></span><i class="zmdi zmdi-layers"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <h4 class="page-title">Términos</h4>
                            </li>
                        </ul>

                        <!-- Right(Notification and Searchbox -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline m-b-0">
                                        <li>
                                            <a href="javascript:void(0);" class="right-bar-toggle">
                                                <i class="zmdi zmdi-notifications-none"></i>
                                            </a>
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Notification bar -->
                            </li>
                            <li class="hidden-xs">
                                <form role="search" class="app-search">
                                    <input type="text" placeholder="Search..."
                                           class="form-control">
                                    <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                        </ul>

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <div class="user-img">
                            <img src="../assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                            <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                        </div>
                        <h5><a href="#"><?php echo $_SESSION['username'] ?></a> </h5>
                        <ul class="list-inline">
                            <li>
                                <a href="#" >
                                    <i class="zmdi zmdi-settings"></i>
                                </a>
                            </li>

                            <li>
                                <a href="../rutas/logout.php" class="text-custom">
                                    <i class="zmdi zmdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <?php include 'sidebarleft.php'; ?>

                </div>

            </div>
            <!-- Left Sidebar End -->

            <?php include '../rutas/listaTerminos.php'; ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <button id="btn-create" class="btn btn-info waves-effect waves-light m-b-5"> <i class="fa fa-plus m-r-5"></i> <span>Agregar término</span> </button>
                                    <table class="table table table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th>Fecha de Creación</th>
                                                <th>Término</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            foreach ($terminos as $termino) {
                                        ?>
                                            <tr>
                                                <td><?php echo $termino["fechaCreacion"] ?></td>
                                                <td><?php echo $termino["termino"] ?></td>
                                                <td>
                                                    <a href="#" data-delete="<?php echo $termino["id"];?>" data-termino="<?php echo $termino["termino"];?>" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                    <a href="#" data-search="<?php echo $termino["id"];?>" data-termino="<?php echo $termino["termino"];?>" class="on-default remove-row"><i class="fa fa-search"></i></a>
                                                </td>
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                        		</div>
                            </div><!-- end col -->

                            

                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <button id="btn-create" class="btn btn-info waves-effect waves-light m-b-5"> <i class="fa fa-plus m-r-5"></i> <span>Resultados de búsqueda</span> </button>
                                    <table class="table table table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th>ID del resultado</th>
                                                <th>Término de busqueda</th>
                                                <th>Archivo fuente</th>
                                                <th>Fecha</th>
                                                <th>Envío por correo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaResultados">
                                    
                                            
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end col -->

                            

                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include 'footer.php'; ?>

            </div>

            <!-- Modal -->
            <div id="delete-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Eliminar termino</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-delete">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">

                        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Término a eliminar </label>

                                    <div class="col-sm-9">
                                        <input type="text" disabled=""  id="termino" name="termino" class="form-control col-xs-10 col-sm-10" />
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Close
                                </button>
                                <button id="edit-user" type="submit" class="btn btn-sm btn-primary pull-left" >
                                    <i class="ace-icon fa fa-save"></i>
                                    Eliminar
                                </button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <div id="result-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Coincidencias</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-result">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Término buscado </label>

                                    <div class="col-sm-9">
                                        <input type="text" disabled=""  id="terminoBuscado" name="terminoBuscado" class="form-control col-xs-10 col-sm-10" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Coincidencias </label>
                                    <br>
                                    <div id="coincidencias"></div>
                                    
                                </div>


                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Close
                                </button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <!-- Modal -->
            <div id="create-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Crear término</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-create" method="POST">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Introduzca término </label>

                                    <div class="col-sm-9">
                                        <input type="input" name="termino" id="termino" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Close
                                </button>
                                <button id="create-term" type="submit" class="btn btn-sm btn-primary pull-left" >
                                    <i class="ace-icon fa fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <?php include 'rightsidebar.php'; ?>

        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/detect.js"></script>
        <script src="../assets/js/fastclick.js"></script>
        <script src="../assets/js/jquery.blockUI.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/js/jquery.slimscroll.js"></script>
        <script src="../assets/js/jquery.scrollTo.min.js"></script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="../assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart-->
		<script src="../assets/plugins/morris/morris.min.js"></script>
		<script src="../assets/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard init -->
        <script src="../assets/pages/jquery.dashboard.js"></script>

        <!-- App js -->
        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>
        <script src="../assets/js/termino/termino.js"></script>

    </body>
</html>
<?php } else { 
    header('Location: ../index.php');
} 

?>