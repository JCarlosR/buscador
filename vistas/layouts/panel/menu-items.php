<div id="sidebar-menu">
    <ul>
    	<li class="text-muted menu-title">Navegación</li>

        <?php if ($_SESSION['rol']==2) { ?>

        <li>
            <a href="usuarios.php" class="waves-effect">
                <i class="zmdi zmdi-accounts-add"></i> 
                <span>Gestionar usuarios</span>
            </a>
        </li>
        
        <li>
            <a href="archivos.php" class="waves-effect">
                <i class="zmdi zmdi-file-text"></i> 
                <span>Gestionar archivos</span>
            </a>
        </li>

        <?php } elseif ($_SESSION['rol']==1) { ?>


        <li>
            <a href="buscador.php" class="waves-effect">
                <i class="zmdi zmdi-search-in-file"></i> 
                <span>Mis archivos</span> 
            </a>
        </li>

        <?php } ?>

        <li>
            <a href="terminos.php" class="waves-effect">
                <i class="zmdi zmdi-format-list-bulleted"></i> 
                <span>Términos de búsqueda</span> 
            </a>
        </li>

        <li>
            <a href="#" class="waves-effect">
                <i class="zmdi zmdi-alert-circle"></i>
                <span>Alertas</span>
            </a>
        </li>

        <li>
            <a href="configuracion.php" class="waves-effect">
                <i class="zmdi zmdi-settings"></i>
                <span>Configuración</span>
            </a>
        </li>

    </ul>

    <div class="clearfix"></div>
</div>

<div class="clearfix"></div>