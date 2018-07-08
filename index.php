<?php 
    session_start();
    $activeSession = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Buscador de archivos simple">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <title>Buscador</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/core.css" rel="stylesheet" />
        <link href="assets/css/components.css" rel="stylesheet" />
        <link href="assets/css/icons.css" rel="stylesheet" />
        <link href="assets/css/pages.css" rel="stylesheet" />
        <link href="assets/css/menu.css" rel="stylesheet" />
        <link href="assets/css/responsive.css" rel="stylesheet" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
    </head>
    <body>
        <div class="account-pages"></div>
        <div class="clearfix"></div>

        <?php if (!$activeSession) {?>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="#" class="logo"><span>Busca<span>dor</span></span></a>
                <h5 class="text-muted m-t-0 font-600">De expresiones regulares</h5>
            </div>

        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Iniciar sesión</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" id="frmLogin">

                        <div class="form-group">
                            <input class="form-control" name="username" type="text" required placeholder="Username">
                         </div>

                        <div class="form-group">
                            <input class="form-control" name="password" type="password" required placeholder="Password">
                        </div>

                        <div class="form-group text-center m-t-30">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                                Ingresar
                            </button>
                        </div>

                        <div class="form-group m-t-30 m-b-0">
                            <a href="page-recoverpw.html" class="text-muted">
                                <i class="fa fa-lock m-r-5"></i> ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    </form>

                </div>
            </div>

            <div class="card-box text-center">
                <p class="text-muted m-b-0">
                    ¿No tienes una cuenta?
                    <a href="vistas/register.php" class="text-primary m-l-5">
                        <b>Regístrate</b>
                    </a>
                </p>
            </div>
        </div>
        <?php } else {
            header('Location: vistas/panel.php');
        }
        ?>

    	<script>
            var resizefunc = [];
        </script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script src="assets/js/login/login.js"></script>
	</body>
</html>