<?php
require_once("includes/functions.documentos.php");
require_once("includes/functions.referencia.php");
$regionSession = $_SESSION["sii"]["usuario_region"];

$periodo = [
0 => (isset($_POST["periodo_annio"]) && $_POST["periodo_annio"] <> "") ? $_POST["periodo_annio"] : date("Y"),
1 => (isset($_POST["periodo_mes"]) && $_POST["periodo_mes"] <> "") ? $_POST["periodo_mes"] : date("m")
];

$periodo_annio = $periodo[0];
$periodo_mes = $periodo[1];
$regionConsulta = (isset($_POST["periodo_region"]) && $_POST["periodo_region"] <> "") ? $_POST["periodo_region"] : $_SESSION["sii"]["usuario_region"];

$periodoInicio = 2014;
$periodoTermino = date("Y");
$regiones = getRegiones2();
$documentos = getDocumentosDTE(34,$regionSession,$periodo);
?>

<div class="panel panel-dark">

    <div class="panel-heading">
        <h4 class="panel-title">CAMBIAR PERIODO Y REGION DE CONSULTA</h4>

    </div>
    <div class="panel-body">
        <form action="?pagina=facturaexenta&ori=ver" method="POST">

            <div class="form-group">
                <label class="col-sm-3 control-label">AÑO <span class="asterisk">*</span></label>
                <div class="col-sm-3">

                    <select class="form-control" name="periodo_annio" id="periodo_annio">
                        <option value="">Seleccionar...</option>
                        <?php for($i=$periodoInicio;$i<=$periodoTermino;$i++):?>
                        <option value="<?php echo $i ?>" <?php if($periodo_annio == $i) { echo "selected"; } ?>><?php echo $i ?></option>
                        <?php endfor ?>                    
                    </select>

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">MES <span class="asterisk">*</span></label>
                <div class="col-sm-3">
                    <select class="form-control" name="periodo_mes" id="periodo_mes">
                        <option value="">Seleccionar...</option>
                        <option value="01" <?php if($periodo_mes == "01") { echo "selected"; } ?> >ENERO</option>
                        <option value="02" <?php if($periodo_mes == "02") { echo "selected"; } ?> >FEBRERO</option>
                        <option value="03" <?php if($periodo_mes == "03") { echo "selected"; } ?> >MARZO</option>
                        <option value="04" <?php if($periodo_mes == "04") { echo "selected"; } ?> >ABRIL</option>
                        <option value="05" <?php if($periodo_mes == "05") { echo "selected"; } ?> >MAYO</option>
                        <option value="06" <?php if($periodo_mes == "06") { echo "selected"; } ?> >JUNIO</option>
                        <option value="07" <?php if($periodo_mes == "07") { echo "selected"; } ?> >JULIO</option>
                        <option value="08" <?php if($periodo_mes == "08") { echo "selected"; } ?> >AGOSTO</option>
                        <option value="09" <?php if($periodo_mes == "09") { echo "selected"; } ?> >SEPTIEMBRE</option>
                        <option value="10" <?php if($periodo_mes == "10") { echo "selected"; } ?> >OCTUBRE</option>
                        <option value="11" <?php if($periodo_mes == "11") { echo "selected"; } ?> >NOVIEMBRE</option>
                        <option value="12" <?php if($periodo_mes == "12") { echo "selected"; } ?> >DICIEMBRE</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">REGIÓN <span class="asterisk">*</span></label>
                <div class="col-sm-3">
                    <select class="form-control" name="periodo_region" id="periodo_region">
                        <option value="">Seleccionar...</option>
                        <?php foreach ($regiones as $key => $value): ?>
                            <option value="<?php echo $value["codigo"] ?>" <?php if($regionConsulta == $value["codigo"]){echo"selected";} ?>><?php echo $value["codigo"]." : ".$value["nombre"] ?></option>
                        <?php endforeach ?>
                        <option value="17" <?php if(isset($_POST["periodo_region"]) && $_POST["periodo_region"] == 17){echo"selected";} ?> >CONSOLIDADO NACIONAL</option>
                    </select>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <button class="btn btn-success" onclick="this.form.submit()">BUSCAR <i class="fa fa-search"></i></button>
                    <!-- <button type="reset" class="btn btn-dark">Reset</button> -->
                </div>
            </div>

        </form>
    </div>
</div>

<div class="panel panel-dark">
    <div class="panel-heading">
        <h4 class="panel-title">FACTURAS NO AFECTAS O EXENTAS PERIODO <?php echo $periodo[1]."-".$periodo[0]?></h4>
    </div><!-- panel-heading -->

    <table id="basicTable" class="table table-striped table-bordered responsive">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>FOLIO</th>
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
                    <td><?php echo $value["cliente_empresa"] ?></td>
                    <td><?php echo $value["dte_fecha"] ?></td>
                    <td>$<?php echo number_format($value["dte_total"],0,".",".") ?></td>
                    <td><a href="<?php echo $value["dte_ruta"].$value["dte_archivo"] ?>.xml" target="_blank">XML</td>
                    <td><a href="documento.php?dte_id=<?php echo $value["dte_id"] ?>" target="_blank">PDF</td>
                    <td><?php echo $value["dte_estado_upload"] ?></td>
                    <td>
                        <div class="btn-group mr5">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                <li><a class="btn pull-left" href="?pagina=QueryEstDteAv&id=<?php echo $value["dte_id"] ?>"><i class="fa fa-question-circle"></i> Consulta Avanzada</a></li>
                                <li><a class="btn pull-left" href="?pagina=QueryEstDte&id=<?php echo $value["dte_id"] ?>&tipo=dte&action=emitido"><i class="fa fa-exclamation-circle"></i> Consulta Estado</a></li>
                                <li><a class="btn pull-left" href="?pagina=QueryEstUp&id=<?php echo $value["dte_id"] ?>&tipo=dte"><i class="fa fa-cloud-upload"></i> Consulta Upload</a></li>
                                <li class="divider"></li>
                                <li><a class="btn pull-left" href="?pagina=detalle&id=<?php echo $value["dte_id"] ?>"><i class="fa fa-eye"></i> Detalle</a></li>
                                <li><a onClick="enviarCorreo('<?php echo $value["dte_tracking"] ?>',<?php echo $regionSession ?>)"><i class="fa fa-envelope-o"></i> Reenviar Correo</a></li>
                                   <?php if ($value["dte_estado_upload"] == "EPR - Envio Procesado"): ?>
                                        <li><a cliente_id="<?php echo $value["cliente_id"] ?>" fact_id="<?php echo $value["dte_id"] ?>" class="btn enviarcorreo pull-left" ><i class="fa fa-envelope"></i> Enviar / Correo</a></li>
                                    <?php endif ?>
                                    <!-- <li class="divider"></li> -->
                                    <!-- <li><a href="#">Separated link</a></li> -->
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

