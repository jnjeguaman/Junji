<?php
extract($_GET);
extract($_SESSION);
$regionSession = $_SESSION["sii"]["usuario_region"];
?>
<div class="leftpanel">
    <div class="media profile-left">
        <a class="pull-left profile-thumb" href="profile.html">
            <img class="img-circle" src="images/photos/profile.png" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $sii["usuario_nombre"]." ".$sii["usuario_apellido"] ?></h4>
            <small class="text-muted"><?php echo $sii["usuario_rut"] ?></small>
        </div>
    </div>

    <ul class="nav nav-pills nav-stacked">
        <li <?php if($pagina == "dashboard"){echo"class='active'";} ?>><a href="?pagina=dashboard"><i class="fa fa-home"></i> <span>INICIO</span></a></li>
        <li <?php if($pagina == "empresa"){echo"class='active'";} ?>><a href="?pagina=empresa&region=<?php echo $regionSession ?>"><i class="fa fa-home"></i> <span>EMPRESA</span></a></li>
        <li class="parent <?php if($pagina == "clientes"){echo"active";} ?>"><a href=""><i class="fa fa-users"></i> <span>CLIENTES</span></a>
            <ul class="children">
                <li <?php if($ori == "nuevo" && $pagina == "clientes"){echo"class='active'";} ?>><a href="?pagina=clientes&ori=nuevo"><i class="fa fa-plus"></i> NUEVO</a></li>
                <li <?php if($ori == "ver" && $pagina == "clientes"){echo"class='active'";} ?>><a href="?pagina=clientes&ori=ver"><i class="fa fa-pencil"></i> EDITAR</a></li>
            </ul>
        </li>

        <li class="parent <?php if($pagina == "usuario"){echo"active";} ?>"><a href=""><i class="fa fa-users"></i> <span>USUARIOS</span></a>
            <ul class="children">
                <li <?php if($ori == "nuevo" && $pagina == "usuario"){echo"class='active'";} ?>><a href="?pagina=usuario&ori=nuevo"><i class="fa fa-plus"></i> NUEVO</a></li>
                <li <?php if($ori == "ver" && $pagina == "usuario"){echo"class='active'";} ?>><a href="?pagina=usuario&ori=ver"><i class="fa fa-pencil"></i> EDITAR</a></li>
            </ul>
        </li>

        <li class="parent <?php if($pagina == "folios"){echo"active";} ?>"><a href=""><i class="fa fa-users"></i> <span>MANTENEDOR FOLIOS</span></a>
            <ul class="children">
                <li <?php if($ori == "nuevo" && $pagina == "folios"){echo"class='active'";} ?>><a href="?pagina=folios&ori=nuevo"><i class="fa fa-plus"></i> NUEVO</a></li>
                <li <?php if($ori == "ver" && $pagina == "folios"){echo"class='active'";} ?>><a href="?pagina=folios&ori=ver"><i class="fa fa-pencil"></i> VER</a></li>
            </ul>
        </li>

        <li class="parent <?php if($pagina == "categorias"){echo"active";} ?>"><a href=""><i class="fa fa-users"></i> <span>CATEGORIAS</span></a>
            <ul class="children">
                <li <?php if($ori == "nuevo" && $pagina == "categorias"){echo"class='active'";} ?>><a href="?pagina=categorias&ori=nuevo"><i class="fa fa-plus"></i> NUEVO</a></li>
                <li <?php if($ori == "ver" && $pagina == "categorias"){echo"class='active'";} ?>><a href="?pagina=categorias&ori=ver"><i class="fa fa-pencil"></i> EDITAR</a></li>
            </ul>
        </li>

        <li class="parent <?php if($pagina == "productos"){echo"active";} ?>"><a href=""><i class="fa fa-users"></i> <span>PRODUCTOS</span></a>
            <ul class="children">
                <li <?php if($ori == "nuevo" && $pagina == "productos"){echo"class='active'";} ?>><a href="?pagina=productos&ori=nuevo"><i class="fa fa-plus"></i> NUEVO</a></li>
                <li <?php if($ori == "ver" && $pagina == "productos"){echo"class='active'";} ?>><a href="?pagina=productos&ori=ver"><i class="fa fa-pencil"></i> EDITAR</a></li>
            </ul>
        </li>
        <li><a href="../"><i class="fa fa-cog"></i> <span>SISTEMA</span></a></li>

    </div>
