<?php 
    session_start();
    $sessionStarted = isset($_SESSION['username']);
    if (isset($_SESSION['rol'])) {
        $rol = $_SESSION['rol'];
    }

    if (!$sessionStarted || $rol != 2) {
        header('Location: ../index.php');
    }
 ?>
<!DOCTYPE html>
<html>
    <?php include 'layouts/panel/head.php'; ?>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <?php 
                $pageTitle = 'Usuarios';
                include 'layouts/panel/topbar.php' 
            ?>

            <?php include 'layouts/panel/left-sidebar.php' ?>

            <?php include '../rutas/listaUsuarios.php'; ?>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="card-box">
                            <button id="btn-create" class="btn btn-info waves-effect waves-light m-b-5"> <i class="fa fa-plus m-r-5"></i> <span>Agregar usuario</span> </button>
                            <table class="table table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach ($usuarios as $usuario) {
                                ?>
                                    <tr>
                                        <td><?php echo $usuario["email"] ?></td>
                                        <td><?php echo $usuario["username"] ?></td>
                                        <?php 
                                        if ($usuario['rol'] == 1) {
                                        ?>
                                            <td>Usuario</td>
                                        <?php
                                        } else {
                                        ?>
                                            <td>Administrador</td>
                                        <?php
                                        }
                                        ?>
                                        
                                        <td>
                                            <button class="btn btn-sm btn-info"  
                                                data-email="<?= $usuario["email"] ?>" 
                                                data-username="<?= $usuario["username"] ?>"
                                                data-active="<?= $usuario["activo"] ?>"
                                                data-edit="<?= $usuario["id"] ?>">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                            <button class="btn btn-sm btn-danger" 
                                                data-username="<?= $usuario["username"] ?>"
                                                data-delete="<?= $usuario["id"] ?>">
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

                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include 'footer.php'; ?>

            </div>

            <!-- Modal -->
            <div id="edit-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Editar usuario</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-edit">
                            <div class="modal-body">
                                <input type="hidden" name="id">

                        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="newEmail">
                                        Nuevo email
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" id="newEmail"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="newUserName">
                                        Nuevo usuario
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="username" id="newUserName"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="status_active">
                                        Activo
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="active" id="status_active" class="form-control">
                                            <option value="1">Sí</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="newPass">
                                        Nueva contraseña (opcional)
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="password" id="newPass"
                                               class="form-control">
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
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <!-- Modal -->
            <div id="delete-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Eliminar usuario</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-delete">
                            <div class="modal-body">
                                <input type="hidden" name="id">
                        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="userNameToDelete">
                                        Usuario a elimnar
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" disabled name="username" id="userNameToDelete"
                                               class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Cerrar
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary pull-left" >
                                    <i class="ace-icon fa fa-save"></i>
                                    Eliminar
                                </button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <!-- Modal -->
            <div id="create-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Crear usuario</h3>
                        </div>
                        <form class="form-horizontal" role="form" id="form-create">
                            <div class="modal-body">
                        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right">
                                        Nuevo email
                                    </label>

                                    <div class="col-sm-9">
                                        <input type="text"  id="email" name="email" class="form-control col-xs-10 col-sm-10" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right">
                                        Nuevo usuario
                                    </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="username" name="username" class=" form-control col-xs-10 col-sm-10" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right">
                                        Nueva contraseña
                                    </label>

                                    <div class="col-sm-9">
                                        <input type="password" id="password" name="password" class="form-control col-xs-10 col-sm-10" />
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                    <i class="ace-icon fa fa-times"></i>
                                    Cerrar
                                </button>
                                <button id="create-user" type="submit" class="btn btn-sm btn-primary pull-left">
                                    <i class="ace-icon fa fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <?php include 'rightsidebar.php'; ?>

        </div>
        <!-- END wrapper -->

        <?php include 'layouts/panel/scripts.php' ?>
        <script src="../assets/js/usuario/usuario.js"></script>

    </body>
</html>
