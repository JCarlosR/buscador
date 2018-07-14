<?php 
    require '../modelos/Usuario.php';

    session_start();
    $sessionStarted = isset($_SESSION['username']);

    if (!$sessionStarted) {
        header('Location: ../index.php');
    }

    $user = Usuario::find($_SESSION['id']);
 ?>
<!DOCTYPE html>
<html>
    <?php include 'layouts/panel/head.php'; ?>

    <body class="fixed-left">

        <div id="wrapper">

            <?php 
                $pageTitle = 'Configuración';
                include 'layouts/panel/topbar.php' 
            ?>

            <?php include 'layouts/panel/left-sidebar.php' ?>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="card-box">
                            <form id="form" method="post" autocomplete="off">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                                <div class="form-group">
                                    <label for="username">Nombre de usuario</label>
                                    <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="email">Correo electrónico</label>
                                    <input type="text" name="email" value="<?= $user['email'] ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" value="" class="form-control">
                                    <p class="text-help">Ingresar sólo si desea modificar su contraseña.</p>
                                </div>

                                <button type="submit" class="btn btn-info waves-effect waves-light m-b-5"> 
                                    <i class="fa fa-save m-r-5"></i>
                                    Guardar cambios
                                </button>  
                            </form>                          
                		</div>

                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include 'footer.php'; ?>

            </div>



            <?php include 'rightsidebar.php'; ?>

        </div>
        <!-- END wrapper -->

        <?php include 'layouts/panel/scripts.php' ?>
        <script src="../assets/js/configuracion/index.js"></script>
    </body>
</html>
