<?php
extract($_POST);

if(isset($cmd) && $cmd == "buscar")
{
    $historial = getHistorial($periodo);
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
                    <select class="form-control" name="periodo" id="periodo">
                        <option value="">Seleccionar...</option>
                        <option value="2014" <?php if($periodo == 2014) { echo "selected"; } ?>>2014</option>
                        <option value="2015" <?php if($periodo == 2015) { echo "selected"; } ?>>2015</option>
                        <option value="2016" <?php if($periodo == 2016) { echo "selected"; } ?>>2016</option>
                        <option value="2017" <?php if($periodo == 2017) { echo "selected"; } ?>>2017</option>                        
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
                    <th>PERIODO</th>
                    <th>FECHA DE ENVIO</th>
                    <th>TIPO LIBRO</th>
                    <th>TIPO ENVÍO</th>
                    <th>CODIGO RECTIFICACIÓN</th>
                    <th>FECHA DE ENVÍO</th>
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
                        <td><?php echo $value["iecv_periodo"] ?></td>
                        <td><?php echo $value["iecv_fecha"] ?></td>
                        <td><?php echo $value["iecv_tipo_libro"] ?></td>
                        <td><?php echo $value["iecv_tipo_envio"] ?></td>
                        <td><?php echo $value["iecv_rectifica"] ?></td>
                        <td><?php echo $value["iecv_fecha"] ?></td>
                        <td><?php echo $value["iecv_track_id"] ?></td>
                        <td><?php echo $value["iecv_estado_envio"] ?></td>
                        <td><?php echo $value["iecv_estado_glosa"] ?></td>
                        <td>
                            <div class="btn-group mr5">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="?pagina=QueryEstUp&tracking=<?php echo $value["iecv_track_id"] ?>&id=<?php echo $value["iecv_id"] ?>&tipo=iecv"><i class="fa fa-cloud-upload"></i> UPLOAD</a></li>
                                    <li><a href="<?php echo $value["iecv_ruta"]."/".$value["iecv_archivo"] ?>" download><i class="fa fa-cloud-download"></i> DESCARGAR</a></li>
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
