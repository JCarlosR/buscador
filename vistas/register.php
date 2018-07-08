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
                    <h4 class="text-uppercase font-bold m-b-0">Registro</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" id="frmRegister">

						<div class="form-group">
                            <input class="form-control" name="email" type="email" required="" placeholder="Email">
						</div>

						<div class="form-group">
                            <input class="form-control" name="username" type="text" required placeholder="Username">
						</div>

						<div class="form-group">
                            <input class="form-control" name="password" type="password" required placeholder="Password">
						</div>

						<div class="form-group">
                            <div class="checkbox checkbox-custom">
									<input id="checkbox-signup" type="checkbox" checked="checked">
									<label for="checkbox-signup">Acepto los <a href="#">Términos y Condiciones</a>.</label>
								</div>
						</div>

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
									Confirmar registro
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
        <script src="../assets/js/register/register.js"></script>
	</body>
</html>