<?php 
    session_start();
    $activeSession = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
    <?php include 'vistas/layouts/simple/head.php' ?>
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

        <?php include 'vistas/layouts/simple/scripts.php' ?>
        <script src="assets/js/login/login.js"></script>
	</body>
</html>