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
                include 'layouts/panel/topbar.php';
                include 'layouts/panel/left-sidebar.php';
                include '../rutas/listaResultados.php';
            ?>

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
                                        <th>Resultado</th>
                                        <?php if ($_SESSION['rol']==2): ?>
                                            <th>Usuario</th>
                                        <?php endif; ?>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaResultados">
                                <?php foreach ($resultados as $resultado): ?>
                                    <tr>
                                        <td><?= $resultado["fecha"] ?></td>
                                        <td><?= $resultado["termino"] ?></td>
                                        <td><?= $resultado["filename"] ?></td>
                                        <td><?= $resultado["coincidencia"] ?></td>
                                        <?php if ($_SESSION['rol']==2): ?>
                                            <td><?= $resultado["username"] ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <button data-send="<?= $resultado["id"] ?>" class="btn btn-sm btn-info"
                                                    data-title="Compartir por correo"
                                                    data-toggle="tooltip">
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

        <?php include 'layouts/panel/scripts.php'; ?>
        <script src="../assets/js/termino/alerta.js"></script>
    </body>
</html>
