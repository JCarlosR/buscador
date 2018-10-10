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

        <div id="wrapper">

            <?php 
                $pageTitle = 'Términos';
                include 'layouts/panel/topbar.php' 
            ?>

            <?php include 'layouts/panel/left-sidebar.php' ?>

            <?php include '../rutas/listaTerminos.php'; ?>


            <div class="content-page">
                <div class="content">
                    <div class="container">

                        <div class="card-box">
                            <button id="btn-create" class="btn btn-info waves-effect waves-light m-b-5"> <i class="fa fa-plus m-r-5"></i> <span>Agregar término</span> </button>
                            <table class="table table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th>Fecha de creación</th>
                                        <th>Término de búsqueda</th>
                                        <?php if ($_SESSION['rol']==2): ?>
                                            <th>Usuario</th>
                                        <?php endif; ?>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach ($terminos as $termino) {
                                ?>
                                    <tr>
                                        <td><?= $termino["fechaCreacion"] ?></td>
                                        <td><?= $termino["termino"] ?></td>
                                        <?php if ($_SESSION['rol']==2): ?>
                                            <td><?= $termino["username"] ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <button data-delete="<?= $termino["id"] ?>" data-termino="<?= $termino["termino"] ?>" class="btn btn-sm btn-danger">
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

                    </div>
                </div>
                
                <?php include 'footer.php'; ?>
            </div> <!-- content -->

            <?php include 'rightsidebar.php'; ?>    

        </div>

        <div id="delete-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="smaller lighter blue no-margin">Eliminar término</h3>
                    </div>
                    <form class="form-horizontal" role="form" id="form-delete">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">

                    
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Término a eliminar</label>

                                <div class="col-sm-9">
                                    <input type="text" disabled=""  id="termino" name="termino" class="form-control col-xs-10 col-sm-10" />
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
                                <label class="col-sm-3 control-label no-padding-right">
                                    Término buscado
                                </label>

                                <div class="col-sm-9">
                                    <input type="text" disabled id="terminoBuscado" name="terminoBuscado" class="form-control col-xs-10 col-sm-10" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Coincidencias</label>
                                <div id="coincidencias"></div>                                
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cerrar
                            </button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                    Introduzca término
                                </label>
                                <div class="col-sm-9">
                                    <input type="input" name="termino" id="termino" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Cerrar
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

        <?php include 'layouts/panel/scripts.php'; ?>
        <script src="../assets/js/termino/termino.js"></script>
        
    </body>
</html>
