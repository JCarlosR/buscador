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
                $pageTitle = 'Dashboard';
                include 'layouts/panel/topbar.php' 
            ?>

            <?php include 'layouts/panel/left-sidebar.php' ?>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="card-box">
                            <h4 class="header-title m-t-0">Mensaje de bienvenida</h4>

                            <p>Bienvenido.
                                Por favor seleccione una opción del menú lateral izquierdo.</p>
                        </div>

                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include 'footer.php'; ?>

            </div>

            <?php include 'rightsidebar.php'; ?>

        </div>

        <?php include 'layouts/panel/scripts.php' ?>

    </body>
</html>
