<!DOCTYPE html>
<html>
    <?php
        $prefixAssets = '../';
        include '../vistas/layouts/simple/head.php'
    ?>
    <body>
        <div class="account-pages"></div>
        <div class="clearfix"></div>

        <div class="wrapper-page">
            <div class="text-center">
                <a href="#" class="logo"><span>Busca<span>dor</span></span></a>
                <h5 class="text-muted m-t-0 font-600">De expresiones regulares</h5>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Recuperar contraseña</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" id="frmRecover">

						<div class="form-group">
                            <input class="form-control" name="email" type="email" required placeholder="Email">
						</div>

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
									Enviar enlace de recuperación
								</button>
							</div>
						</div>

					</form>

                </div>
            </div>

            <div class="card-box text-center">
                <p class="text-muted m-b-0">
                    ¿Ya tienes una cuenta?
                    <a href="../index.php" class="text-primary m-l-5">
                        <b>Inicia sesión</b>
                    </a>
                </p>
            </div>
        </div>

        <?php include '../vistas/layouts/simple/scripts.php' ?>
        <script src="../assets/js/recuperar/recuperar.js"></script>
	</body>
</html>