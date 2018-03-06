<!--- Sidemenu -->
<div id="sidebar-menu">
<ul>
	<li class="text-muted menu-title">Navigation</li>

    <?php 
        if ($_SESSION['rol']==2) {
    ?>
    <li>
        <a href="usuarios.php" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Usuarios </span> </a>
    </li>
    <li>
        <a href="archivos.php" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Archivos </span> </a>
    </li>
    <?php } ?>


    <li>
        <a href="buscador.php" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> Buscador </span> </a>
    </li>

    <li>
        <a href="terminos.php" class="waves-effect"><i class="zmdi zmdi-chart"></i> <span> Términos </span> </a>
    </li>

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-chart"></i><span> Charts </span> <span class="menu-arrow"></span></a>
        <ul class="list-unstyled">
            <li><a href="chart-flot.html">Flot Chart</a></li>
            <li><a href="chart-morris.html">Morris Chart</a></li>
            <li><a href="chart-chartist.html">Chartist Charts</a></li>
            <li><a href="chart-chartjs.html">Chartjs Chart</a></li>
            <li><a href="chart-other.html">Other Chart</a></li>
        </ul>
    </li>

    <li>
        <a href="calendar.html" class="waves-effect"><i class="zmdi zmdi-calendar"></i><span> Calendar </span></a>
    </li>

</ul>
<div class="clearfix"></div>
</div>
<!-- Sidebar -->
<div class="clearfix"></div>