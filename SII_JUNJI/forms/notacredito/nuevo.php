<?php
require_once("includes/functions.documentos.php");
$documentos = getDocumentosDTE2();
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
                <th>MONTO</th>
                <th>TIPO</th>
                <th>XML</th>
                <th>PDF</th>
                <th>ACCION</th>
                <th>REFERENCIAS</th>
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
                    <td><a href="documento.php?dte_id=<?php echo $value["dte_id"] ?>" target="_blank">PDF</td>
                    <td>
                        <div class="btn-group mr5">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                <li><a class="btn pull-left" href="?pagina=QueryEstDteAv&id=<?php echo $value["dte_id"] ?>"><i class="fa fa-question-circle"></i> Consulta Avanzada</a></li>
                                <li><a class="btn pull-left" href="?pagina=QueryEstDte&id=<?php echo $value["dte_id"] ?>&tipo=dte&action=emitido"><i class="fa fa-exclamation-circle"></i> Consulta Estado</a></li>
                                <li><a class="btn pull-left" href="?pagina=QueryEstUp&id=<?php echo $value["dte_id"] ?>&tipo=dte"><i class="fa fa-cloud-upload"></i> Consulta Upload</a></li>
                                    <li class="divider"></li>
                                    <?php if ($value["dte_dcto_id"] <> 56): ?>
                                     <li><a href="?pagina=notacredito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=1">Anula Documento de Referencia</a></li>
                                    <li><a href="?pagina=notacredito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=2">Corrige Texto Documento de Referencia</a></li>
                                    <li><a href="?pagina=notacredito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=3">Corrige montos</a></li>
                                    <?php endif ?>
                                    
                                    <?php if ($value["dte_dcto_id"] == 56): ?>
                                        <li><a href="?pagina=notacredito&ori=paso2&dte_id=<?php echo $value["dte_id"] ?>&action=4">Nota de Crédito de anulación</a></li>
                                    <?php endif ?>
                                </ul>
                            </div><!-- btn-group -->
                    </td>

                    <td>
                            <?php
                            $referencias = getReferencias($value["dte_id"]);
                            if($referencias["Respuesta"] == true)
                            {
                                foreach ($referencias["Mensaje"] as $key => $value) {
                                    echo "Folio : ".$value["dte_folio"].". Tipo : ".$value["dcto_glosa"]." (".$value["dte_dcto_id"].")<br>";
                                }
                            }else{
                                echo "<font color='red'>".$referencias["Mensaje"]."</font>";
                            }
                            ?>
                        </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

 