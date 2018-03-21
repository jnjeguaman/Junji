<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
if(isset($_POST["periodo_annio"]) && $_POST["periodo_annio"] <> "" && $_POST["periodo_mes"] <> "")
{
    $documentos = getDocumentos($_POST["periodo_annio"],$_POST["periodo_mes"]);
}else{
    $periodo_annio = date("Y");
    $periodo_mes = date("m");
    $documentos = getDocumentos($periodo_annio,$periodo_mes);
}
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
$hoy = date("Y-m-d");
?>
<div class="alert alert-warning" role="alert" style="text-align: center;">
    <strong>ADMINISTRACIÓN DE DOCUMENTOS RECIBIDOS</strong><br>
    Con motivo de la modificación a ley 19.983, introducida por la Ley 20.956, que señala que el Recibo de las Mercaderías o Servicios Prestados se
    debe efectuar dentro de los 8 días a contar de la recepción del DTE, caso contrario se presumirá recibida la mercadería o que los servicios han sido
    prestados si es que no se ha Reclamado en contra de su contenido o de la falta total o parcial de la entrega de las mercaderías o de la prestación
    del servicio, el SII habilitó en su sitio una aplicación que permite a los contribuyentes relacionados con un DTE (emisor, receptor o tenedor vigente
    del DTE) consultar o registrar la aceptación o reclamo a dicho DTE.
</div>

<div class="panel panel-dark">
    <div class="panel-heading">
        <h4 class="panel-title">CAMBIAR PERIODO Y REGION DE CONSULTA</h4>
    </div>
    <div class="panel-body">
        <form action="?pagina=dteWS&ori=ver" method="POST">

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

            <!-- <div class="form-group">
                <label class="col-sm-3 control-label">REGIÓN <span class="asterisk">*</span></label>
                <div class="col-sm-3">
                    <select class="form-control" name="periodo_region" id="periodo_region">
                        <option value="">Seleccionar...</option>
                        <?php foreach ($regiones as $key => $value): ?>
                            <option value="<?php echo $value["codigo"] ?>" <?php if(isset($_POST["periodo_region"]) && $_POST["periodo_region"] == $value["codigo"]){echo"selected";} ?>><?php echo $value["codigo"]." : ".$value["nombre"] ?></option>
                        <?php endforeach ?>
                        <option value="17" <?php if(isset($_POST["periodo_region"]) && $_POST["periodo_region"] == 17){echo"selected";} ?> >CONSOLIDADO NACIONAL</option>
                    </select>

                </div>
            </div> -->

            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <button class="btn btn-success" type="submit">BUSCAR <i class="fa fa-search"></i></button>
                    <!-- <button type="reset" class="btn btn-dark">Reset</button> -->
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-dark">
    <div class="panel-heading">
        <h4 class="panel-title">DOCUMENTOS TRIBUTARIOS ELECTRÓNICOS RECIBIDOS</h4>
        <p>Listado con todos los DTE ingresados al sistema en estado pendiente</p>
    </div><!-- panel-heading -->
    <table id="basicTable" class="table table-striped table-bordered">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>TIPO DOCUMENTO</th>
                <th>FOLIO</th>
                <th>RUT</th>
                <th>CLIENTE</th>
                <th>FECHA EMISION</th>
                <th>FECHA RECEPCION S.I.I.</th>
                <th>DIAS TRANSCURRIDOS</th>
                <th>TOTAL</th>
                <th>ESTADO</th>
                <th>TRACKID</th>
                <th>ACCION</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($documentos as $key => $value): ?>
                <tr align="center">
                    <td><?php echo $value["recibido_id"] ?></td>
                    <td><?php echo $value["dcto_glosa"] ?></td>
                    <td><?php echo $value["recibido_folio"] ?></td>
                    <td><?php echo $value["recibido_rut"]."-".$value["recibido_dv"] ?></td>
                    <td><?php echo utf8_encode($value["recibido_razon"]) ?></td>
                    <td><?php echo $value["recibido_emision"] ?></td>
                    <td><?php echo $value["recibido_recepcion"] ?></td>
                    <td>
                        <?php
                        $color = [
                        1 => "success",
                        2 => "info",
                        3 => "warning",
                        4 => "danger",
                        ];
                        $fechaRecepcion = explode(" ", $value["recibido_recepcion"]);
                        $inicio = strtotime($fechaRecepcion[0]);
                        $final = strtotime(Date("Y-m-d"));
                        $dias = ceil(($final-$inicio)/60/60/24);
                        if($dias <= 4)
                        {
                            echo "<h4><span class='label label-".$color[1]."'>".$dias."</span></h4>";
                        }else if($dias > 4 && $dias <= 6)
                        {
                            echo "<h4><span class='label label-".$color[2]."'>".$dias."</span></h4>";
                        }else if($dias > 6 && $dias <=8)
                        {
                            echo "<h4><span class='label label-".$color[3]."'>".$dias."</span></h4>";
                        }else if($dias > 8)
                        {
                            echo "<h4><span class='label label-".$color[4]."'>".$dias."</span></h4>";
                        }
                        
                        ?>
                    </td>
                    <td>$<?php echo number_format($value["recibido_monto"],0,".",".") ?></td>
                    <td><?php echo $value["recibido_estado"] ?></td>
                    <td><?php echo $value["recibido_track"] ?></td>
                    <td>
                        <div class="btn-group mr5">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#" onclick="consultaCesion(<?php echo $value["recibido_rut"] ?>,'<?php echo $value["recibido_dv"] ?>',<?php echo $value["recibido_tipo"] ?>,<?php echo $value["recibido_folio"] ?>)"><i class="fa fa-envelope-o"></i> Consultar Cesión Electrónica</a></li>
                              <li><a href="?pagina=dteWS&ori=aceptaReclama&id=<?php echo $value["recibido_id"] ?>" <?php if($dias > 8){echo"class='btn disabled'";} ?>><i class="fa fa-envelope-o"></i> Aceptar/Rechazar DTE</a></li>
                              <li><a href="#" onclick="consultaHistorico(<?php echo $value["recibido_rut"] ?>,'<?php echo $value["recibido_dv"] ?>',<?php echo $value["recibido_tipo"] ?>,<?php echo $value["recibido_folio"] ?>)"><i class="fa fa-envelope-o"></i> Lista de Eventos Históricos</a></li>
                              <li><a href="#"><i class="fa fa-envelope-o"></i> Fecha Recepción S.I.I.</a></li>
                          </ul>
                      </div><!-- btn-group -->
                  </td>
              </tr>
          <?php endforeach ?>
      </tbody>
  </table>
</div>


<input type="hidden" name="emisor_rut" id="emisor_rut" value="<?php echo $rut[0] ?>">
<input type="hidden" name="emisor_dv" id="emisor_dv" value="<?php echo $rut[1] ?>">



<script type="text/javascript">
    function consultaCesion(rut,dv,tipo,folio)
    {

        var data = {
            "cmd" :  "consultarDocDteCedible",
            "cesion_rut" :  rut,
            "cesion_dv" :  dv,
            "cesion_tipoDTE" :  tipo,
            "cesion_folio" :  folio,
            "emisor_rut" :  $("#emisor_rut").val(),
            "emisor_dv" :  $("#emisor_dv").val()
        };

        $.ajax({
            type:"POST",
            url:"includes/functions.dtews.php",
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
            complete : function(){
                unBlockUI();
            }
        });
    }

    function consultaHistorico(rut,dv,tipo,folio)
    {

        var data = {
            "cmd" :  "listarEventosHistDoc",
            "cesion_rut" :  rut,
            "cesion_dv" :  dv,
            "cesion_tipoDTE" :  tipo,
            "cesion_folio" :  folio,
            "emisor_rut" :  $("#emisor_rut").val(),
            "emisor_dv" :  $("#emisor_dv").val()
        };

        $.ajax({
            type:"POST",
            url:"includes/functions.dtews.php",
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
            complete : function(){
                unBlockUI();
            }
        });
    }

</script>