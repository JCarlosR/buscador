<?php 
    session_start();
    $sessionStarted = isset($_SESSION['username']);

    if (!$sessionStarted) {
        header('Location: ../index.php');
    }
 ?>
<!DOCTYPE html>
<html>
    <?php include 'layouts/panel/head.php'; ?>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <?php 
                $pageTitle = 'Buscador';
                include 'layouts/panel/topbar.php' 
            ?>

            <?php include 'layouts/panel/left-sidebar.php' ?>
            

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <button id="btn-create" class="btn btn-info waves-effect waves-light m-b-5"> <i class="fa fa-plus m-r-5"></i> <span>Agregar archivo</span> </button>
                                    <table class="table table table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th>Nombre de archivo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <tr>
                                                <td>xxzcxzcxz</td>
                                                <td>
                                                    <a href="#" data-delete="vxzvxzvz" data-username="sdgbdbvsdb" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
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
                            <h3 class="smaller lighter blue no-margin">Eliminar usuario</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-delete">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">

                        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Usuario a elimnar</label>

                                    <div class="col-sm-9">
                                        <input type="text" disabled=""  id="username" name="username" class="form-control col-xs-10 col-sm-10" />
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Cerrar
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

            <!-- Modal -->
            <div id="create-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Subir archivo</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-create" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Subir archivo </label>

                                    <div class="col-sm-9">
                                        <input type="file" name="archivo" id="archivo" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Close
                                </button>
                                <button id="create-file" type="submit" class="btn btn-sm btn-primary pull-left" >
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

        <?php include 'layouts/panel/scripts.php' ?>
        <script src="../assets/js/archivo/archivo.js"></script>

    </body>
</html>
