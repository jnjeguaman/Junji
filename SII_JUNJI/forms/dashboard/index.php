<?php
ini_set("display_errors", 1);
require_once("includes/functions.estadistica.php");
require_once("includes/functions.region.php");

$regionSession = $_SESSION["sii"]["usuario_region"];
$periodo = [
0 => (isset($_POST["periodo_annio"]) && $_POST["periodo_annio"] <> "") ? $_POST["periodo_annio"] : date("Y"),
1 => (isset($_POST["periodo_mes"]) && $_POST["periodo_mes"] <> "") ? $_POST["periodo_mes"] : date("m")
];

$periodo_annio = $periodo[0];
$periodo_mes = $periodo[1];

$regiones = getRegiones2();
$periodo_region = (isset($_POST["periodo_region"]) && $_POST["periodo_region"] <> "") ? $_POST["periodo_region"] : $regionSession;
?>
<script type="text/javascript" src="js/canvasJS/jquery.canvasjs.min.js"></script>

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>

		</div><!-- panel-btns -->
		<h4 class="panel-title">EMMISIÓN DE GUÍAS DE DESPACHO</h4>

	</div><!-- panel-heading -->
	<div class="panel-body">

		 <form action="?pagina=dashboard" method="POST">
            <div class="form-group">
                <label class="col-sm-3 control-label">AÑO <span class="asterisk">*</span></label>
                <div class="col-sm-3">

                    <select class="form-control" name="periodo_annio" id="periodo_annio">
                        <option value="">Seleccionar...</option>
                        <option value="2014" <?php if($periodo_annio == 2014) { echo "selected"; } ?>>2014</option>
                        <option value="2015" <?php if($periodo_annio == 2015) { echo "selected"; } ?>>2015</option>
                        <option value="2016" <?php if($periodo_annio == 2016) { echo "selected"; } ?>>2016</option>
                        <option value="2017" <?php if($periodo_annio == 2017) { echo "selected"; } ?>>2017</option>
                        <option value="2018" <?php if($periodo_annio == 2018) { echo "selected"; } ?>>2018</option>                        
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
                            <option value="<?php echo $value["codigo"] ?>" <?php if(isset($_POST["periodo_region"]) && $_POST["periodo_region"] == $value["codigo"]){echo"selected";} ?>><?php echo $value["codigo"]." : ".$value["nombre"] ?></option>
                        <?php endforeach ?>
                        <option value="0" <?php if(isset($_POST["periodo_region"]) && $_POST["periodo_region"] == 0){echo"selected";} ?> >CONSOLIDADO NACIONAL</option>
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


		<div id="chartContainer" style="height: 400px; width: 100%;"></div>
	</div>
</div>	


<?php 
$datosPeriodo = getDTEEmitidos($periodo_region,$periodo);
?>
<script type="text/javascript">
	
	window.onload = function () {
		var chart = new CanvasJS.Chart("chartContainer",
		{
			theme: "theme2",
			animationEnabled: true,
			title:{
				text: "Emision de Gúias : <?php echo $periodo[1]."-".$periodo[0] ?>"
			},
			data: [
			{
				type: "pie",
				// showInLegend: true,
				// toolTipContent: "{y} - #percent %",
				// yValueFormatString: "#0.#,,. Million",
				// legendText: "{label}",
				dataPoints: <?php echo json_encode($datosPeriodo,JSON_NUMERIC_CHECK) ?>
			}
			]
		});
		chart.render();
	}

</script>


