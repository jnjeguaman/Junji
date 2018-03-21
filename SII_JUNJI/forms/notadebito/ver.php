<?php
require_once("includes/functions.documentos.php");
require_once("includes/functions.referencia.php");
$regionSession = $_SESSION["sii"]["usuario_region"];
$documentos = getDocumentosDTE(56,$regionSession);
?>
<div class="panel panel-dark">
    <div class="panel-heading">
        <h4 class="panel-title">NOTAS DE DÉBITO EMITIDAS</h4>
    </div>
<div class="panel-body">

    <table id="basicTable" class="table table-striped table-bordered responsive">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>FOLIO</th>
                <th>TIPO DOCUMENTO</th>
                <th>CLIENTE</th>
                <th>FECHA EMISION</th>
                <th>TOTAL</th>
                <th>XML</th>
                <th>PDF</th>
                <th>ESTADO DTE</th>
                <th>ACCION</th>
                <th>REFERENCIAS</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($documentos as $key => $value): ?>
                <tr>
                    <td><?php echo $value["dte_id"] ?></td>
                    <td><?php echo $value["dte_folio"] ?></td>
                    <td><?php echo $value["dcto_glosa"] ?></td>
                    <td><?php echo $value["cliente_empresa"] ?></td>
                    <td><?php echo $value["dte_fecha"] ?></td>
                    <td>$<?php echo number_format($value["dte_total"],0,".",".") ?></td>
                    <td><a href="<?php echo $value["dte_ruta"].$value["dte_archivo"] ?>.xml" target="_blank">XML</a></td>
                    <td><a href="documento.php?dte_id=<?php echo $value["dte_id"] ?>" target="_blank">PDF</a></td>
                    <td><?php echo $value["dte_estado_upload"] ?></td>
                    <td>
                        <div class="btn-group mr5">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                <li><a class="btn pull-left" href="?pagina=QueryEstDteAv&id=<?php echo $value["dte_id"] ?>"><i class="fa fa-question-circle"></i> Consulta Avanzada</a></li>
                                <li><a class="btn pull-left" href="?pagina=QueryEstDte&id=<?php echo $value["dte_id"] ?>"><i class="fa fa-exclamation-circle"></i> Consulta Estado</a></li>
                                <li><a class="btn pull-left" href="?pagina=QueryEstUp&id=<?php echo $value["dte_id"] ?>&tipo=dte"><i class="fa fa-cloud-upload"></i> Consulta Upload</a></li>
                                    <li class="divider"></li>
                                    <li><a class="btn pull-left" href="?pagina=detalle&id=<?php echo $value["dte_id"] ?>"><i class="fa fa-eye"></i> Detalle</a></li>
                                    <?php if ($value["dte_estado_upload"] == "EPR - Envio Procesado"): ?>
                                        <li><a cliente_id="<?php echo $value["cliente_id"] ?>" fact_id="<?php echo $value["dte_id"] ?>" class="btn enviarcorreo pull-left" ><i class="fa fa-envelope"></i> Enviar / Correo</a></li>
                                    <?php endif ?>
                                    <li><a onClick="enviarCorreo('<?php echo $value["dte_tracking"] ?>',<?php echo $regionSession ?>)"><i class="fa fa-envelope-o"></i> Reenviar Correo</a></li>
                                    <!-- <li><a href="#">Separated link</a></li> -->

                                    <!-- <li><a href="#">Separated link</a></li> -->
                                </ul>
                            </div>
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
</div>
<script type="text/javascript">
     $(".enviarcorreo").click(function(){
        var idfactura = $(this).attr("fact_id");
        var idcliente = $(this).attr("cliente_id");
             $.ajax({
                type:"GET",
                url:"documentocorreo.php",
                data:{ "idcli": idcliente , "idfact" : idfactura},
                dataType:"JSON",
                beforeSend:function(){
                    blockUI();
                },
                success : function ( response ) {
                    unBlockUI();
                    console.log(response);
                    if(response.Respuesta)
                    {
                        jQuery.gritter.add({
                            title: 'Exito!',
                            text: response.Mensaje,
                            class_name: 'growl-success',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
                        // setTimeout(function(){
                        //  window.location.href='?pagina=factura&ori=ver';
                        // },1500);
                    }else{
                        jQuery.gritter.add({
                            title: 'Ha ocurrido un error!',
                            text: response.Mensaje,
                            class_name: 'growl-danger',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
                    }
                }
            });
    });
</script>