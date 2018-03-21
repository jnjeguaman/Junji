<?php
extract($_POST);

if(isset($cmd) && $cmd == "buscar")
{
    $periodo = $periodo_annio."-".$periodo_mes;
    $historial = getHistorialIECV($periodo,$periodo_tipo);
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

            <div class="form-group">
                <label class="col-sm-3 control-label">TIPO LIBRO <span class="asterisk">*</span></label>
                <div class="col-sm-3">
                    <select class="form-control" name="periodo_tipo" id="periodo_tipo">
                        <option value="">Seleccionar...</option>
                        <option value="COMPRA" <?php if($periodo_tipo == "COMPRA") { echo "selected"; } ?> >COMPRAS</option>
                        <option value="VENTA" <?php if($periodo_tipo == "VENTA") { echo "selected"; } ?> >VENTAS</option>
                        <option value="LIBROGD" <?php if($periodo_tipo == "LIBROGD") { echo "selected"; } ?> >GUIAS DE DESPACHO</option>
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

<?php if (count($historial) <> 0): ?>
    
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">LIBROS ENVIADOS</h4>
        </div>
        <div class="panel-body">
            <table id="basicTable" class="table table-striped table-bordered responsive table-hover">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>TIPO LIBRO</th>
                        <th>PERIODO</th>
                        <th>FECHA DE ENVIO</th>
                        <th>TIPO LIBRO</th>
                        <th>TIPO ENVÍO</th>
                        <th>CODIGO RECTIFICACIÓN</th>
                        <th>TRACKING</th>
                        <th>ESTADO LIBRO</th>
                        <th>GLOSA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($historial as $key => $value): ?>
                        <tr>
                            <td><?php echo $value["iecv_id"] ?></td>
                            <td><?php echo $value["iecv_tipo_operacion"] ?></td>
                            <td><?php echo $value["iecv_periodo"] ?></td>
                            <td><?php echo $value["iecv_femision"]." - ".$value["iecv_hora"] ?></td>
                            <td><?php echo $value["iecv_tipo_libro"] ?></td>
                            <td><?php echo $value["iecv_tipo_envio"] ?></td>
                            <td><?php echo $value["iecv_rectifica"] ?></td>
                            <td><?php echo $value["iecv_track_id"] ?></td>
                            <td><?php echo $value["iecv_estado_envio"] ?></td>
                            <td><?php echo $value["iecv_estado_glosa"] ?></td>
                            <td>
                                <div class="btn-group mr5">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="?pagina=QueryEstUp&tracking=<?php echo $value["iecv_track_id"] ?>&id=<?php echo $value["iecv_id"] ?>&tipo=iecv"><i class="fa fa-cloud-upload"></i> Consulta Upload</a></li>
                                        <li><a href="../<?php echo $value["iecv_ruta"]."/".$value["iecv_archivo"] ?>" download><i class="fa fa-cloud-download"></i> Descargar</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif ?>
