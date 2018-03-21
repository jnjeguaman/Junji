<?php
extract($_POST);
require_once("includes/functions.iecvcompra.php");
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
$regionSession = $_SESSION["sii"]["usuario_region"];

if(isset($cmd) && $cmd == "buscar")
{
    $periodo = array(0 => $periodo_annio,1 => $periodo_mes);
    $iecv = getIECVPeriodo($periodo);
    $dteCompras = getDTECompras($periodo);
}

$historial = getHistorial($region);
$estados = array();

$totalIVA = 0;
$totalNETO = 0;
$totalEXENTO = 0;
$totalTOTAL = 0;
?>
<form class="form-horizontal" action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">LIBRO COMPRA</h4>
            <p>Información Electrónica de compras</p>
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
            <h4 class="panel-title">LIBRO COMPRA</h4>
        </div>
        <div class="panel-body">
            <!-- CONTENIDO -->
            <table id="basicTable" class="table table-striped table-bordered responsive">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>TIPO DOCUMENTO</th>
                        <th>FOLIO</th>
                        <th>PROVEEDOR</th>
                        <th>FECHA EMISION</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($iecv as $key => $value): ?>
                        <tr>
                            <td><?php echo $value["iecv_id"] ?></td>
                            <td><?php echo $value["ref_glosa"] ?></td>
                            <td><?php echo $value["iecv_folio"] ?></td>
                            <td><?php echo $value["iecv_cliente"] ?></td>
                            <td><?php echo $value["iecv_femision"] ?></td>
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
                        <th>IVA NO RECONOCIDO</th>
                        <th>OTROS IMPUESTOS</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($dteCompras as $key => $value): ?>

                        <?php
                        $totalNETO += $value["Neto"];
                        $totalIVA += $value["Iva"];
                        $totalEXENTO += $value["Exento"];
                        $totalTOTAL += $value["Total"];
                        ?>
                        <tr>
                            <td><?php echo $value["Tipo"] ?></td>
                            <td><?php echo $value["TotalDTE"] ?></td>
                            <td><?php echo $value["Iva"] ?></td>
                            <td><?php echo $value["Neto"] ?></td>
                            <td><?php echo $value["Exento"] ?></td>
                            <td><?php echo $value["NoReconocido"] ?></td>
                            <td><?php echo $value["OtrosImpuestos"] ?></td>
                            <td><?php echo $value["Total"] ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>$<?php echo number_format($totalIVA,0,".",".") ?></th>
                        <th>$<?php echo number_format($totalNETO,0,".",".") ?></th>
                        <th>$<?php echo number_format($totalEXENTO,0,".",".") ?></th>
                        <td></td>
                        <td></td>
                        <th>$<?php echo number_format($totalTOTAL,0,".",".") ?></th>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>   
    
    <form class="form-horizontal" id="frmIECV">

       <div class="form-group">
        <label class="col-sm-3 control-label">TIPO OPERACION <span class="asterisk">*</span></label>
        <div class="col-sm-3">
            <select class="form-control" name="periodo_tipo_operacion" id="periodo_tipo_operacion">
                <!-- <option value="">Seleccionar...</option> -->
                <option value="COMPRA" <?php if($periodo_mes == "COMPRA") { echo "selected"; } ?> >COMPRA</option>
                <!-- <option value="VENTA" <?php if($periodo_mes == "VENTA") { echo "selected"; } ?> >VENTA</option> -->
            </select>
        </div>
    </div>

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
            <select class="form-control" name="periodo_tipo_libro" id="periodo_tipo_libro" onChange="checkTipoLibro(this.value)">
                <option value="">Seleccionar...</option>
                <option value="MENSUAL" <?php if($periodo_mes == "MENSUAL") { echo "selected"; } ?> >MENSUAL</option>
                <option value="ESPECIAL" <?php if($periodo_mes == "ESPECIAL") { echo "selected"; } ?> >ESPECIAL</option>
                <option value="RECTIFICA" <?php if($periodo_mes == "RECTIFICA") { echo "selected"; } ?> >RECTIFICA</option>
            </select>
        </div>
    </div>

    <div class="form-group rectifica">
        <label class="col-sm-3 control-label">Codigo de Autorización de Rectificación <span class="asterisk">*</span></label>
        <div class="col-sm-3">
            <input type="text" name="CodAutRec" id="CodAutRec" class="form-control">
        </div>
    </div>  

    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-primary mr5">Generar DTE</button>
                <input type="hidden" name="dte_id" value="<?php echo $_GET["dte_id"] ?>">
            </div>
        </div>
    </div> 
    
    <input type="hidden" name="tipo_dcto" value="IECVCompra">
    <input type="hidden" name="periodo" value="<?php echo $periodo_annio."-".$periodo_mes ?>">

    <input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
    <input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
    <input type="hidden" name="emisor_region" id="emisor_region" value="<?php echo $regionSession ?>">

</form>
<?php endif ?>

<script type="text/javascript">
 $(".rectifica").hide();

 function checkTipoLibro(input)
 {
    if(input == "RECTIFICA")
    {
        $(".rectifica").show("slow");
    }else{
        $(".rectifica").hide();
    }
}

$("#frmIECV").validate({
    rules : {
        periodo_tipo_operacion : { required : true},
        periodo_tipo_envio : { required : true},
        periodo_tipo_libro : { required : true},
        CodAutRec : { required : true}
    },
    submitHandler : function ( form )
    {
        var data = $(form).serializeArray();
        $.ajax({
            type:"POST",
            url:"includes/functions.generardte.php",
            data:data,
            dataType:"JSON",
            beforeSend : function(){
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