<?php
$regionSession = $_SESSION["sii"]["usuario_region"];
require_once("includes/functions.recibo.php");
$dteRecibidos = getDTERecibidos($regionSession);
$dteRecibidosCompletados = getDTERecibidosCompletados($regionSession);
?>
<div class="alert alert-warning" role="alert" style="text-align: center;">
    <strong>ADMINISTRACIÓN DE DOCUMENTOS RECIBIDOS</strong><br>
    En esta página el usuario autorizado puede revisar, ordenar, obtener representaciones impresas y administrar los DTE recibidos por el contribuyente.<br>

    Adicionalmente, seleccionando sobre el botón Acciones de color azul, podrá dar respuesta comercial a un documento recibido, además del dar el acuse de recibo de las mercaderías indicado en la Ley N°19.983.
</div>
<div class="panel panel-dark">
    <div class="panel-heading">
        <h4 class="panel-title">DOCUMENTOS TRIBUTARIOS ELECTRÓNICOS RECIBIDOS</h4>
        <p>Listado con todos los DTE ingresados al sistema en estado pendiente</p>
    </div><!-- panel-heading -->

    <table id="basicTable" class="table table-striped table-bordered responsive">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>TIPO DOCUMENTO</th>
                <th>FOLIO</th>
                <th>RUT</th>
                <th>CLIENTE</th>
                <th>FECHA EMISION</th>
                <th>IVA</th>
                <th>NETO</th>
                <th>EXENTO</th>
                <th>TOTAL</th>
                <th>ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dteRecibidos as $key => $value): ?>
                <tr>
                    <td><?php echo $value["recibido_id"] ?></td>
                    <td><?php echo $value["dcto_glosa"] ?></td>
                    <td><?php echo $value["recibido_folio"] ?></td>
                    <td><?php echo $value["recibido_rut"]."-".$value["recibido_dv"] ?></td>
                    <td><?php echo $value["recibido_cliente"] ?></td>
                    <td><?php echo $value["recibido_femision"] ?></td>
                    <td>$<?php echo number_format($value["recibido_iva"],0,".",".") ?></td>
                    <td>$<?php echo number_format($value["recibido_neto"],0,".",".") ?></td>
                    <td>$<?php echo number_format($value["recibido_exento"],0,".",".") ?></td>
                    <td>$<?php echo number_format($value["recibido_monto"],0,".",".") ?></td>
                    <td>
                        <div class="btn-group mr5">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                                <!-- <li><a href="#" onClick="actualizarEstado(<?php echo $value["recibido_folio"] ?>,<?php echo $value["recibido_rut"] ?>,'<?php echo $value["recibido_dv"] ?>',<?php echo $value["dcto_codigo"] ?>,<?php echo $value["recibido_monto"] ?>,'<?php echo $value["recibido_femision"] ?>','<?php echo $value["recibido_ruta"] ?>','<?php echo $value["recibido_archivo"] ?>',<?php echo $value["recibido_id"] ?>)">ACTUALIZAR ESTADO</a></li> -->
                                <?php if ($value["recibido_acuse_1"] == ""): ?>                                	
                                	<!-- <li><a href="?pagina=dteRecibidos&ori=acuse&action=1&id=<?php echo $value["recibido_id"] ?>" title="">RECEPCION ENVÍO</a></li> -->
                                    <li><a href="?pagina=dteRecibidos&ori=acuse&action=1&id=<?php echo $value["recibido_id"] ?>&folio=<?php echo $value["recibido_foliointerno"]?>"><i class="fa fa-envelope-o"></i> Acuse de Recibo del Envío</a></li>
                                <?php endif ?>
                                
                                <?php if ($value["recibido_acuse_2"] == "" && $value["recibido_acuse_1"] == 0): ?>                                 
                                    <li><a href="?pagina=dteRecibidos&ori=acuse&action=2&id=<?php echo $value["recibido_id"] ?>&folio=<?php echo $value["recibido_foliointerno"]?>" title=""><i class="fa fa-reply-all"></i> Aceptacion/Rechazo del Documento</a></li>
                                <?php endif ?>                                                             

                                <?php if ($value["recibido_acuse_3"] == "" && $value["recibido_acuse_1"] == 0 && $value["recibido_acuse_2"] == 0): ?>
                                    <li><a href="?pagina=dteRecibidos&ori=acuse&action=3&id=<?php echo $value["recibido_id"] ?>&folio=<?php echo $value["recibido_foliointerno"]?>" title=""><i class="fa fa-retweet"></i> Recibo de Mercaderia/Servicio (Ley 19.983)</a></li>
                                <?php endif ?>
                            </ul>
                        </div><!-- btn-group -->
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="panel panel-dark">
    <div class="panel-heading">
        <h4 class="panel-title">DOCUMENTOS TRIBUTARIOS ELECTRÓNICOS RECIBIDOS</h4>
        <p>Listado con todos los DTE ingresados al sistema en estado pendiente</p>
    </div><!-- panel-heading -->

    <table id="basicTable" class="table table-striped table-bordered responsive">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>TIPO DOCUMENTO</th>
                <th>FOLIO</th>
                <th>RUT</th>
                <th>CLIENTE</th>
                <th>FECHA EMISION</th>
                <th>IVA</th>
                <th>NETO</th>
                <th>EXENTO</th>
                <th>TOTAL</th>
                <th>ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dteRecibidosCompletados as $key => $value): ?>
                <tr>
                    <td><?php echo $value["recibido_id"] ?></td>
                    <td><?php echo $value["dcto_glosa"] ?></td>
                    <td><?php echo $value["recibido_folio"] ?></td>
                    <td><?php echo $value["recibido_rut"]."-".$value["recibido_dv"] ?></td>
                    <td><?php echo $value["recibido_cliente"] ?></td>
                    <td><?php echo $value["recibido_femision"] ?></td>
                    <td>$<?php echo number_format($value["recibido_iva"],0,".",".") ?></td>
                    <td>$<?php echo number_format($value["recibido_neto"],0,".",".") ?></td>
                    <td>$<?php echo number_format($value["recibido_exento"],0,".",".") ?></td>
                    <td>$<?php echo number_format($value["recibido_monto"],0,".",".") ?></td>
                    <td>
                        <div class="btn-group mr5">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                                <!-- <li><a href="#" onClick="actualizarEstado(<?php echo $value["recibido_folio"] ?>,<?php echo $value["recibido_rut"] ?>,'<?php echo $value["recibido_dv"] ?>',<?php echo $value["dcto_codigo"] ?>,<?php echo $value["recibido_monto"] ?>,'<?php echo $value["recibido_femision"] ?>','<?php echo $value["recibido_ruta"] ?>','<?php echo $value["recibido_archivo"] ?>',<?php echo $value["recibido_id"] ?>)">ACTUALIZAR ESTADO</a></li> -->
                                <?php if ($value["recibido_acuse_1"] == ""): ?>                                 
                                    <!-- <li><a href="?pagina=dteRecibidos&ori=acuse&action=1&id=<?php echo $value["recibido_id"] ?>" title="">RECEPCION ENVÍO</a></li> -->
                                    <li><a href="?pagina=dteRecibidos&ori=acuse&action=1&id=<?php echo $value["recibido_id"] ?>&folio=<?php echo $value["recibido_foliointerno"]?>"><i class="fa fa-envelope-o"></i> Acuse de Recibo del Envío</a></li>
                                <?php endif ?>
                                
                                <?php if ($value["recibido_acuse_2"] == ""): ?>                                 
                                    <li><a href="?pagina=dteRecibidos&ori=acuse&action=2&id=<?php echo $value["recibido_id"] ?>&folio=<?php echo $value["recibido_foliointerno"]?>" title=""><i class="fa fa-reply-all"></i> Aceptacion/Rechazo del Documento</a></li>
                                <?php endif ?>                                                             

                                <?php if ($value["recibido_acuse_3"] == ""): ?>
                                    <li><a href="?pagina=dteRecibidos&ori=acuse&action=3&id=<?php echo $value["recibido_id"] ?>&folio=<?php echo $value["recibido_foliointerno"]?>" title=""><i class="fa fa-retweet"></i> Recibo de Mercaderia/Servicio (Ley 19.983)</a></li>
                                <?php endif ?>
                                <li class="divider"></li>
                                <li><a href="<?php echo $value["recibido_ruta_1"] ?>" download><i class="fa fa-cloud-download"></i> Acuse de Recibo del Envío</a></li>
                                <li><a href="<?php echo $value["recibido_ruta_2"] ?>" download><i class="fa fa-cloud-download"></i> Aceptacion/Rechazo del Documento</a></li>
                                <li><a href="<?php echo $value["recibido_ruta_3"] ?>" download><i class="fa fa-cloud-download"></i> Recibo de Mercaderia/Servicio (Ley 19.983)</a></li>
                            </ul>
                        </div><!-- btn-group -->
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    function actualizarEstado(dcto_folio,rutEmisor,dvEmisor,sii_tipo_dcto,dcto_monto,dcto_fecha_emision,ruta,archivo,id)
    {
        var data = ({
            dcto_folio : dcto_folio,
            rutEmisor : rutEmisor,
            dvEmisor : dvEmisor,
            sii_tipo_dcto : sii_tipo_dcto,
            dcto_monto : dcto_monto,
            receptor_rut : "76535898",
            receptor_dv : "1",
            command : "QueryEstDteAv",
            dcto_fecha_emision : dcto_fecha_emision,
            ruta : ruta,
            archivo : archivo,
            recibido_id : id
        });

        console.log(data);

        $.ajax({
            type:"POST",
            url:"includes/functions.consulta.php",
            data:data,
            dataType:"JSON",
            success : function ( response ) {
                console.log(response);
            }
        });

    }
</script>