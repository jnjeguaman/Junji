<?php 
require_once("includes/functions.acceso.php");
extract($_GET);
extract($_SESSION);
$acceso = getAcceso($_SESSION["sii"]["usuario_rut"]);

?>

<div class="leftpanel">
    <div class="media profile-left">
        <a class="pull-left profile-thumb" href="?pagina=perfil&id=<?php echo $usuario_id ?>">
            <img class="img-circle" src="images/photos/profile.png" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $sii["usuario_nombre"]." ".$sii["usuario_apellido_paterno"]." ".$sii["usuario_apellido_materno"] ?></h4>
            <small class="text-muted"><?php echo $sii["usuario_rut"] ?></small>
        </div>
    </div><!-- media -->

    <h5 class="leftpanel-title">Navigation</h5>
    <ul class="nav nav-pills nav-stacked">
        <li <?php if($pagina == "dashboard"){echo"class='active'";} ?>><a href="?pagina=dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <?php if ($acceso[1]["usuario_autorizado_33"] == 1): ?>
            <li class="parent <?php if($pagina == "factura"){echo"active";} ?>"><a href=""><i class="fa fa-file-text-o"></i> <span>Factura Afecta</span></a>
                <ul class="children">
                    <li <?php if($ori == "nuevo" && $pagina == "factura"){echo"class='active'";} ?>><a href="?pagina=factura&ori=nuevo"><i class="fa fa-chevron-right"></i> Crear</a></li>
                    <!-- <li <?php if($ori == "cargar" && $pagina == "factura"){echo"class='active'";} ?>><a href="?pagina=factura&ori=cargar"><i class="fa fa-chevron-right"></i> Cargar</a></li> -->
                    <!-- <li><a href="?pagina=factura&ori=estado">Estado DTE</a></li> -->
                    <li <?php if($ori == "ver" && $pagina == "factura"){echo"class='active'";} ?>><a href="?pagina=factura&ori=ver"><i class="fa fa-chevron-right"></i> Ver DTE</a></li>
                </ul>
            </li>
        <?php endif ?>

        <?php if ($acceso[1]["usuario_autorizado_34"] == 1): ?>
            <li class="parent <?php if($pagina == "facturaexenta"){echo"active";} ?>"><a href=""><i class="fa fa-file-text-o"></i> <span>Factura Exenta</span></a>
                <ul class="children">
                    <li <?php if($ori == "nuevo"){echo"class='active'";} ?>><a href="?pagina=facturaexenta&ori=nuevo"><i class="fa fa-chevron-right"></i> Crear</a></li>
                    <!-- <li <?php if($ori == "estado"){echo"class='active'";} ?>><a href="?pagina=facturaafecta&ori=estado">Estado DTE</a></li> -->
                    <li <?php if($ori == "ver"){echo"class='active'";} ?>><a href="?pagina=facturaexenta&ori=ver"><i class="fa fa-chevron-right"></i> Ver DTE</a></li>
                </ul>
            </li>
        <?php endif ?>

        <?php if ($acceso[1]["usuario_autorizado_61"] == 1): ?>
            <li class="parent <?php if($pagina == "notacredito"){echo"active";} ?>"><a href=""><i class="fa fa-file-text-o"></i> <span>Nota de Crédito</span></a>
                <ul class="children">
                    <li <?php if($ori == "nuevo" && $pagina == "notacredito"){echo"class='active'";} ?>><a href="?pagina=notacredito&ori=nuevo"><i class="fa fa-chevron-right"></i> Crear</a></li>
                    <li <?php if($ori == "ver" && $pagina == "notacredito"){echo"class='active'";} ?>><a href="?pagina=notacredito&ori=ver"><i class="fa fa-chevron-right"></i> Ver DTE</a></li>
                </ul>
            </li>
        <?php endif ?>

        <?php if ($acceso[1]["usuario_autorizado_56"] == 1): ?>
            <li class="parent <?php if($pagina == "notadebito"){echo"active";} ?>"><a href=""><i class="fa fa-file-text-o"></i> <span>Nota de Débito</span></a>
                <ul class="children">
                 <li <?php if($ori == "nuevo" && $pagina == "notadebito"){echo"class='active'";} ?>><a href="?pagina=notadebito&ori=nuevo"><i class="fa fa-chevron-right"></i> Crear</a></li>
                 <li <?php if($ori == "ver" && $pagina == "notadebito"){echo"class='active'";} ?>><a href="?pagina=notadebito&ori=ver"><i class="fa fa-chevron-right"></i> Ver DTE</a></li>
             </ul>
         </li>
     <?php endif ?>

     <?php if ($acceso[1]["usuario_autorizado_52"] == 1): ?>
        <li class="parent <?php if($pagina == "gd"){echo"active";} ?>"><a href=""><i class="fa fa-file-text-o"></i> <span>Guía de Despacho</span></a>
            <ul class="children">
                <li <?php if($action == "nuevo" && $pagina == "gd"){echo"class='active'";} ?>><a href="?pagina=gd&action=nuevo"><i class="fa fa-chevron-right"></i> Nuevo</a></li>
                <li <?php if($action == "ver" && $pagina == "gd"){echo"class='active'";} ?>><a href="?pagina=gd&action=ver"><i class="fa fa-chevron-right"></i> Ver</a></li>
            </ul>
        </li>
    <?php endif ?>
    <li class="parent <?php if($tipo == "consulta"){echo"active";} ?>"><a href=""><i class="fa fa-info"></i> <span>Consultas</span></a>
        <ul class="children">
            <!-- <li <?php if($pagina == "QueryEstDteAv"){echo"class='active'";} ?>><a href="?pagina=QueryEstDteAv&tipo=consulta"><i class="fa fa-home"></i> <span>Consulta DTE AV</span></a></li> -->
            <li <?php if($pagina == "QueryEstDte" && $action == "emitido"){echo"class='active'";} ?>><a href="?pagina=QueryEstDte&tipo=consulta&action=emitido"><i class="fa fa-question"></i> <span>DTE Emitido</span></a></li>
            <li <?php if($pagina == "QueryEstDte" && $action == "recibido"){echo"class='active'";} ?>><a href="?pagina=QueryEstDte&tipo=consulta&action=recibido"><i class="fa fa-question"></i> <span>DTE Recibido</span></a></li>
            <li <?php if($pagina == "QueryEstUp"){echo"class='active'";} ?>><a href="?pagina=QueryEstUp&tipo=consulta"><i class="fa fa-home"></i> <span>Consulta Upload DTE</span></a></li>
            <li <?php if($pagina == "consultarDocDteCedible"){echo"class='active'";} ?>><a href="?pagina=consultarDocDteCedible&tipo=consulta"><i class="fa fa-home"></i> <span>Consulta Cesión</span></a></li>
        </ul>
    </li>

<!--
         <li class="parent <?php if($pagina == "cotizacion"){echo"active";} ?>"><a href=""><i class="fa fa-tasks"></i> <span>Cotizacion</span></a>
            <ul class="children">
                <li <?php if($action == "nuevo" && $pagina == "cotizacion"){echo"class='active'";} ?>><a href="?pagina=cotizacion&action=nuevo"><i class="fa fa-chevron-right"></i> Crear</a></li>
                <li <?php if($action == "ver" && $pagina == "cotizacion"){echo"class='active'";} ?>><a href="?pagina=cotizacion&action=ver"><i class="fa fa-chevron-right"></i> Ver</a></li>
            </ul>
        </li>
        !-->

        <?php if ($acceso[1]["usuario_autorizado_libro_venta"] == 1 || $acceso[1]["usuario_autorizado_libro_compra"] == 1): ?>
            <li class="parent <?php if($pagina == "iecv"){echo"active";} ?>"><a href=""><i class="fa fa-usd"></i> <span>IECV</span></a>
                <ul class="children">
                    <?php if ($acceso[1]["usuario_autorizado_libro_compra"] == 1): ?>
                        <li <?php if($ori == "compra" && $pagina == "iecv"){echo"class='active'";} ?>><a href="?pagina=iecv&ori=compra"><i class="fa fa-chevron-right"></i> Compra</a></li>
                    <?php endif ?>
                    <?php if ($acceso[1]["usuario_autorizado_libro_venta"] == 1): ?>
                        <li <?php if($ori == "venta" && $pagina == "iecv"){echo"class='active'";} ?>><a href="?pagina=iecv&ori=venta"><i class="fa fa-chevron-right"></i> Venta</a></li>
                    <?php endif ?>
                    <li <?php if($ori == "historial" && $pagina == "iecv"){echo"class='active'";} ?>><a href="?pagina=iecv&ori=historial"><i class="fa fa-chevron-right"></i> Historial</a></li>
                </ul>
            </li>
        <?php endif ?>

        <?php if ($acceso[1]["usuario_autorizado_libro_guia"] == 1): ?>
         <li class="parent <?php if($pagina == "librogd"){echo"active";} ?>"><a href=""><i class="fa fa-tags"></i> <span>Libro G/D</span></a>
            <ul class="children">
                <li <?php if($ori == "generar" && $pagina == "librogd"){echo"class='active'";} ?>><a href="?pagina=librogd&ori=generar"><i class="fa fa-chevron-right"></i> Generar</a></li>
                <li <?php if($ori == "historial" && $pagina == "librogd"){echo"class='active'";} ?>><a href="?pagina=librogd&ori=historial"><i class="fa fa-chevron-right"></i> Historial</a></li>
            </ul>
        </li>
    <?php endif ?>
    
    <?php if ($acceso[1]["usuario_tipo"] == 1): ?>
        <!-- <li <?php if($pagina == "generaSET"){echo"class='active'";} ?>><a href="?pagina=generaSET"><i class="fa fa-bar-chart-o"></i> <span>Generar SET</span></a></li> -->
        <li><a href="mantenedor"><i class="fa fa-cogs"></i> <span>Mantenedor</span></a></li>
    <?php endif ?>
</ul>
</div>