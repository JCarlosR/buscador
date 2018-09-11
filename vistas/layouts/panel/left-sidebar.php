<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <div class="user-box">
            <div class="user-img">
                <img src="../assets/images/users/avatar-1.jpg" class="img-circle img-thumbnail img-responsive">
                <div class="user-status online">
                    <i class="zmdi zmdi-dot-circle"></i>
                </div>
            </div>
            <h5>
                <a href="#"><?= $_SESSION['username'] ?></a>
            </h5>
            <ul class="list-inline">
                <li>
                    <a href="configuracion.php">
                        <i class="zmdi zmdi-settings"></i>
                    </a>
                </li>

                <li>
                    <a href="../rutas/logout.php" class="text-custom">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <?php include 'layouts/panel/menu-items.php'; ?>
    </div>

</div>