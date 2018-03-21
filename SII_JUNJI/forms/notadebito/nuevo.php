<?php
require_once("includes/functions.documentos.php");
$documentos = getDocumentosDTE3();
?>
<div class="panel panel-dark">
    <div class="panel-heading">
        <h4 class="panel-title">DOCUMENTOS EMITIDOS</h4>
    </div>
<div class="panel-body">

    <table id="basicTable" class="table table-striped table-bordered responsive">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>FOLIO</th>
                <th>FECHA EMISION</th>
                <th>TOTAL</th>
                <th>TIPO</th>
                <th>XML</th>
                <th>PDF</th>
                <th>ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($documentos as $key => $value): ?>
                <tr>
                    <td><?php echo $value["dte_id"] ?></td>
                    <td><?php echo $value["dte_folio"] ?></td>
                    <td><?php echo $value["dte_fecha"] ?></td>
                    <td>$<?php echo number_format($value["dte_total"],0,".",".") ?></td>
                    <td><?php echo $value["dcto_glosa"] ?></td>
                    <td><a href="<?php echo $value["dte_ruta"].$value["dte_archivo"] ?>.xml" target="_blank">XML</td>
                    <td><a href="documento.php?xml=<?php echo $value["dte_archivo"] ?>&tipo=<?php echo $value["dte_dcto_id"] ?>" target="_blank">PDF</td>
                    <td>
                        <div class="btn-group mr5">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                <li><a href="?pagina=QueryEstDteAv&cliente_id=<?php echo $value["dte_cliente_id"] ?>&dcto_codigo=<?php echo $value["dte_dcto_id"] ?>&dcto_folio=<?php echo $value["dte_folio"] ?>&dcto_fecha_emision=<?php echo $value["dte_fecha"] ?>&dcto_monto=<?php echo $value["cotizacion_total"] ?>&receptor_rut=<?php echo $value["cliente_rut"] ?>&receptor_dv=<?php echo $value["cliente_dv"] ?>" target="_blank">CONSULTA AVANZADA DTE</a></li>
                                <li><a href="?pagina=QueryEstDte&cliente_id=<?php echo $value["dte_cliente_id"] ?>&dcto_codigo=<?php echo $value["dte_dcto_id"] ?>&dcto_folio=<?php echo $value["dte_folio"] ?>&dcto_fecha_emision=<?php echo $value["dte_fecha"] ?>&dcto_monto=<?php echo $value["cotizacion_total"] ?>&receptor_rut=<?php echo $value["cliente_rut"] ?>&receptor_dv=<?php echo $value["cliente_dv"] ?>" target="_blank">CONSULTA DTE</a></li>
                                <li><a href="?pagina=QueryEstUp&track_id=<?php echo $value["dte_tracking"]?>">UPLOAD</a></li>
                                    <li class="divider"></li>
                                    <!-- <li><a href="?pagina=notacredito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=1">Anula Documento de Referencia</a></li> -->
                                    <!-- <li><a href="?pagina=notacredito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=2">Corrige Texto Documento de Referencia</a></li> -->
                                    <li><a href="?pagina=notadebito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=3">Corrige montos</a></li>
                                    <?php if ($value["dte_dcto_id"] == 61): ?>
                                        <li><a href="?pagina=notadebito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=4">Nota de Débito de anulación / Montos</a></li>
                                        <li><a href="?pagina=notadebito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=5">Nota de Débito de anulación / Texto</a></li>
                                    <?php endif ?>
                                </ul>
                            </div><!-- btn-group -->
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

 