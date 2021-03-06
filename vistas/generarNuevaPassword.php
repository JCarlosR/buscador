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
                    <h4 class="text-uppercase font-bold m-b-0">Nueva contraseña</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" id="frmChangePassword">

						<div class="form-group">
                            <input class="form-control" name="email" type="email" required placeholder="Email"
                                   value="<?= $_GET['email'] ?>" readonly>
						</div>

                        <div class="form-group">
                            <input class="form-control" name="token" type="text" required placeholder="Token"
                                   value="<?= $_GET['token'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <input class="form-control" name="password" type="password" placeholder="Nueva contraseña"
                                   required>
                        </div>

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
									Confirmar nueva contraseña
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
        <script src="../assets/js/recuperar/confirmar.js"></script>
	</body>
</html>