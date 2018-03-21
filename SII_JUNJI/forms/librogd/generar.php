<?php
extract($_POST);
$regionSession = $_SESSION["sii"]["usuario_region"];
if(isset($cmd) && $cmd == "buscar")
{
    $periodo = array(0 => $periodo_annio,1 => $periodo_mes);
    $gd = getGDPeriodo($periodo,$regionSession);
    $gdDetalle = getDetalle($periodo,$regionSession);
    $anulados = getAnulados($periodo,$regionSession);
    $traslado = getTraslados($periodo,$regionSession);
    $tiposEnvio = getDetalleEnvio($periodo,$regionSession);

    $tpoTraslado = array(
    	1 => "OPERACIÓN CONSTITUYE VENTA",
		2 => "VENTAS POR EFECTUAR",
		3 => "CONSIGNACIONES",
		4 => "ENTREGA GRATUITA",
		5 => "TRASLADOS INTERNOS",
		6 => "OTROS TRASLADOS NO VENTA",
		7 => "GUÍA DE DEVOLUCIÓN"
    	);
}
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
?>
<form class="form-horizontal" action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">BUSCAR GUIAS POR PERIODO</h4>
        </div>
        <!-- CONTENIDO -->
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label">AÑO <span class="asterisk">*</span></label>
                <div class="col-sm-3">
                    <select class="form-control" name="periodo_annio" id="periodo_annio">
                        <option value="">Seleccionar...</option>
                        <option value="2014" <?php if($periodo_annio == 2014) { echo "selected"; } ?>>2014</option>
                        <option value="2015" <?php if($periodo_annio == 2015) { echo "selected"; } ?>>2015</option>
                        <option value="2016" <?php if($periodo_annio == 2016) { echo "selected"; } ?>>2016</option>
                        <option value="2017" <?php if($periodo_annio == 2017) { echo "selected"; } ?>>2017</option>                        
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

            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <button type="submit" class="btn btn-dark mr5">Buscar</button>
                    <!-- <button type="reset" class="btn btn-dark">Reset</button> -->
                </div>
            </div>

        </div>

    </div>
    <input type="hidden" name="cmd" value="buscar">
</form>


<?php if ($cmd == "buscar"): ?>
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">LISTADO DE GUIAS DEL PERIODO : <?php echo $periodo_annio."-".$periodo_mes ?></h4>
        </div>
        <div class="panel-body">
            <!-- CONTENIDO -->
            <table id="basicTable" class="table table-striped table-bordered table-responsive">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>TIPO DOCUMENTO</th>
                        <th>TIPO GUIA</th>
                        <th>FOLIO</th>
                        <th>CLIENTE</th>
                        <th>FECHA EMISION</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($gdDetalle as $key => $value): ?>
                        <tr>
                            <td><?php echo $value["dte_id"] ?></td>
                            <td><?php echo $value["dte_dcto_id"] ?></td>
                            <td><?php echo $tpoTraslado[$value["dte_gd_traslado"]] ?></td>
                            <td><?php echo $value["dte_folio"] ?></td>
                            <td><?php echo $value["empresa_glosa"] ?></td>
                            <td><?php echo $value["dte_fecha"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>


            <table id="basicTable" class="table table-striped table-bordered responsive">
                <thead class="">
                    <tr>
                        <th>TIPO DOCUMENTO</th>
                        <th>TOTAL DOCUMENTOS</th>
                        <th>IVA</th>
                        <th>NETO</th>
                        <th>EXENTO</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($gd as $key => $value): ?>
                        <tr>
                            <td><?php echo $value["Tipo"] ?></td>
                            <td><?php echo $value["TotalDTE"] ?></td>
                            <td><?php echo $value["Iva"] ?></td>
                            <td><?php echo $value["Neto"] ?></td>
                            <td><?php echo $value["Exento"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <table id="basicTable" class="table table-striped table-bordered responsive">
                <thead class="">
                    <tr>
                        <th>TIPO DOCUMENTO</th>
                        <th>TOTAL DOCUMENTOS</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($anulados as $key => $value): ?>
                        <tr>
                            <td><?php echo ($value["Tipo"] == 1) ? "FOLIO ANULADO" : "GUIA ANULADA" ?></td>
                            <td><?php echo $value["Total"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <table id="basicTable" class="table table-striped table-bordered responsive">
                <thead class="">
                    <tr>
                        <th>TIPO DOCUMENTO</th>
                        <th>TOTAL DOCUMENTOS</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($tiposEnvio as $key => $value): ?>
                        <tr>
                            <td><?php echo $tpoTraslado[$value["Tipo"]] ?></td>
                            <td><?php echo $value["Total"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>   
    

   <form class="form-horizontal" id="frmIECV">


    <div class="form-group">
        <label class="col-sm-3 control-label">TIPO ENVIO <span class="asterisk">*</span></label>
        <div class="col-sm-3">
            <select class="form-control" name="periodo_tipo_envio" id="periodo_tipo_envio">
                <option value="">Seleccionar...</option>
                <option value="PARCIAL" <?php if($periodo_mes == "PARCIAL") { echo "selected"; } ?> >PARCIAL</option>
                <option value="FINAL" <?php if($periodo_mes == "FINAL") { echo "selected"; } ?> >FINAL</option>
                <option value="TOTAL" <?php if($periodo_mes == "TOTAL") { echo "selected"; } ?> >TOTAL</option>
                <option value="AJUSTE" <?php if($periodo_mes == "AJUSTE") { echo "selected"; } ?> >AJUSTE</option>
            </select>
        </div>
    </div>   

    <div class="form-group">
        <label class="col-sm-3 control-label">TIPO LIBRO <span class="asterisk">*</span></label>
        <div class="col-sm-3">
            <select class="form-control" name="periodo_tipo_libro" id="periodo_tipo_libro">
                <option value="">Seleccionar...</option>
                <option value="ESPECIAL" <?php if($periodo_mes == "ESPECIAL") { echo "selected"; } ?> >ESPECIAL</option>
            </select>
        </div>
    </div>


    <!-- <div class="form-group">
        <label class="col-sm-3 control-label">Folio Notificación <span class="asterisk">*</span></label>
        <div class="col-sm-3">
            <input type="text" name="periodo_notificacion" id="periodo_notificacion" class="form-control">
        </div>
    </div>  

    <div class="form-group">
        <label class="col-sm-3 control-label">Número Segmento <span class="asterisk">*</span></label>
        <div class="col-sm-3">
            <input type="text" name="periodo_segmento" id="periodo_segmento" class="form-control">
        </div>
    </div> -->  

    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-dark mr5">Generar DTE</button>
                <input type="hidden" name="dte_id" value="<?php echo $_GET["dte_id"] ?>">
            </div>
        </div>
    </div> 
    
    <input type=hidden name="tipo_dcto" value="LibroGD">
    <input type=hidden name="periodo" value="<?php echo $periodo_annio."-".$periodo_mes ?>">
    <input type=hidden name="envia_rut" value="<?php echo $_SESSION["sii"]["usuario_rut"] ?>">
    <input type=hidden name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">
    <input type=hidden name="emisor_rut" value="<?php echo $rut[0] ?>">
    <input type=hidden name="emisor_dv" value="<?php echo $rut[1] ?>">
    </form>
<?php endif ?>


<script type="text/javascript">
	    $("#frmIECV").validate({
        rules : {
            periodo_tipo_envio : { required : true},
            periodo_tipo_libro : { required : true},
            periodo_notificacion : { required : true},
            periodo_segmento : { required : true}

        },
        submitHandler : function ( form )
        {
            var data = $(form).serializeArray();
            $.ajax({
                type:"POST",
                url:"includes/functions.generardte.php",
                data:data,
                dataType:"JSON",
                beforeSend : function()
                {
                    blockUI();
                },
                success : function ( response ) {
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

                },
                complete : function (){
                    unBlockUI();
                }
            });
        }
    })
</script>