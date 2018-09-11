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
                $pageTitle = 'Alertas';
                include 'layouts/panel/topbar.php' 
            ?>

            <?php include 'layouts/panel/left-sidebar.php' ?>
            <?php include '../rutas/listaResultados.php'; ?>


            <div class="content-page">
                <div class="content">
                    <div class="container">

                        <?php
                        /*
                        <div class="card-box">
                            <table class="table table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th>Fecha de creación</th>
                                        <th>Término de búsqueda</th>
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
                                        <td>
                                            <button data-search="<?= $termino["id"];?>" data-termino="<?= $termino["termino"];?>" class="btn btn-sm btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                		</div>
                        */
                        ?>

                        <div class="card-box">
                            <h4 class="header-title mt-0">Mi lista de alertas</h4>

                            <table class="table table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th>Detectado</th>
                                        <th>Término de busqueda</th>
                                        <th>Buscado en</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaResultados">
                                <?php foreach ($resultados as $resultado): ?>
                                    <tr>
                                        <td><?= $resultado["fecha"] ?></td>
                                        <td><?= $resultado["termino"] ?></td>
                                        <td><?= $resultado["filename"] ?></td>
                                        <td>
                                            <button data-details="<?= $resultado["id"] ?>"
                                                    data-termino="<?= $resultado["termino"] ?>"
                                                    class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button data-send="<?= $resultado["id"] ?>" class="btn btn-sm btn-info">
                                                <i class="fa fa-send-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>                    

                    </div>
                </div>
                
                <?php include 'footer.php'; ?>
            </div> <!-- content -->

            <?php include 'rightsidebar.php'; ?>
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

        <?php include 'layouts/panel/scripts.php'; ?>
        <script src="../assets/js/termino/alerta.js"></script>
        
    </body>
</html>
