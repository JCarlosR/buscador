<?php 
    session_start();
    $sessionStarted = isset($_SESSION['username']);

    if (!$sessionStarted) {
        header('Location: ../index.php');
    } ?>
<!DOCTYPE html>
<html>
    <?php include 'layouts/panel/head.php'; ?>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <?php 
                $pageTitle = 'Archivos';
                include 'layouts/panel/topbar.php' 
            ?>

            <?php include 'layouts/panel/left-sidebar.php' ?>

            <?php include_once '../rutas/listaArchivos.php'; ?>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="card-box">
                            <button id="btn-create" class="btn btn-info waves-effect waves-light m-b-5"> <i class="fa fa-plus m-r-5"></i> <span>Agregar archivo</span> </button>
                            <table class="table table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th>Fecha de subida</th>
                                        <th>Nombre de archivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach ($archivos as $archivo) {
                                ?>
                                    <tr>
                                        <td><?= $archivo["created_at"] ?></td>
                                        <td><?= $archivo["filename"] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" data-delete="<?= $archivo["id"] ?>" data-archivo="<?= $archivo["filename"] ?>">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php 
                                    }
                                ?>
                                </tbody>
                            </table>
                		</div>

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
                            <h3 class="smaller lighter blue no-margin">Eliminar archivo</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-delete">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">

                        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Archivo a eliminar</label>

                                    <div class="col-sm-9">
                                        <input type="text" disabled=""  id="archivo" name="archivo" class="form-control col-xs-10 col-sm-10" />
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

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                        Subir archivo
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="cboOpcion" id="cboOpcion" class="form-control">
                                            <option value="1">Todos</option>
                                            <option value="2">Ninguno</option>
                                            <option value="3">Algunos</option>
                                        </select>
                                    </div>
                                </div>

                               

                                <div class="row" id="divUsuarios" style="display: none">
                                    <div class="col-lg-6">
                                        <div class="card-box">
                                            <label for="cboUsuarios">Asociar a:</label>

                                            <select multiple="multiple" class="multi-select" id="cboUsuarios" name="cboUsuarios[]" data-plugin="multiselect">
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                    

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Cerrar
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

            <?php include 'rightsidebar.php'; ?>
        </div>

        <?php include 'layouts/panel/scripts.php' ?>
        <script src="../assets/js/archivo/archivo.js"></script>
    </body>
</html>
