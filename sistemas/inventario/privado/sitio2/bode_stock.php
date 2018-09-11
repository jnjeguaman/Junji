	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<?php 
	require("inc/config.php");
	extract($_POST);
	session_start();
	ini_set("display_errors", 0);


	if (!isset($_POST['nivel'])) {
		$nivel="";
	}
	if (!isset($_POST['tipo'])) {
		$tipo="";
	}
	if (!isset($_GET['avanzada'])) {
		$avanzada="";
	}
	if (!isset($_POST['bodeClave'])) {
		$bodeClave="";
	}
	if (!isset($_POST['bodeFiltro'])) {
		$bodeFiltro="";
	}

	if (!isset($_POST['oc'])) {
		$oc="";
	}
	if (!isset($_POST['nguia'])) {
		$nguia="";
	}
	if (!isset($_POST['bien'])) {
		$bien="";
	}
	if (!isset($_POST['proveedor'])) {
		$proveedor="";
	}
	if (!isset($_POST['fentrega'])) {
		$fentrega="";
	}
	if (!isset($_POST['ubicacion'])) {
		$ubicacion="";
	}
	if (!isset($_POST['programa'])) {
		$programa="";
	}
	if (!isset($_POST['grupo'])) {
		$grupo="";
	}





	$consulta="";
	$where1="";
	$where2="";
	$where3="";
	$where4="";
	$where5="";
	$where6="";
	$where7="";
	$where8="";
	

	$colspan = ($_SESSION["region"] == 16) ? 11 : 10 ;
	if ($nivel==40) {
		$wherenivel40="  and doc_tecnicos>0 ";
	}

	if($_SESSION["region"] == 16 OR $_SESSION["region"] == 13)
	{
		$arrayUBI = [];
		$ubi = "(";
		$sql_ubicacion = "SELECT * FROM bode_ubicacion WHERE ubi_region = 16 AND ubi_estado = 1";
		$res_ubicacion = mysql_query($sql_ubicacion,$dbh);

		while($row_ubicacion = mysql_fetch_array($res_ubicacion))
		{
			$arrayUBI[] = $row_ubicacion["ubi_glosa"];
		}
		$totalUBI = sizeof($arrayUBI);

		foreach ($arrayUBI as $key => $value) {
			if(($totalUBI -1) == $key)
			{
				$ubi.="c.ding_ubicacion = '".$value."'";
			}else{
				$ubi.="c.ding_ubicacion = '".$value."' OR ";
			}
		}
		$ubi.=")";
	}

	if($_SESSION["region"] == 16)
	{
		$region = "(d.doc_region = 16 OR d.doc_region = 13) AND ".$ubi;
	}elseif($_SESSION["region"] == 13){
		$region = "d.doc_region = 13 AND ".$ubi;
	}else{
		$region = "d.doc_region = ".$_SESSION["region"];
	}

// echo $region;
	if($tipo == 1)
	{

		if($bodeFiltro == 1)
		{
	// Orden de compra
			$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE ".$region." AND c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND b.oc_id2 LIKE '%".$bodeClave."%' AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' and (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND a.ing_clasificacion = 1 LIMIT 200";
		}

		if($bodeFiltro == 2)
		{
	// Numero de guia de proveedor
			$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE ".$region." AND c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND a.ing_guia = ".$bodeClave." AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' and (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND (b.oc_tipo = 0 OR b.oc_tipo= 1) AND a.ing_clasificacion = 1  LIMIT 200";
		}

		if($bodeFiltro == 3)
		{
	// proveedor
			$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE ".$region." AND c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND  b.oc_proveenomb LIKE '%".$bodeClave."%' AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' and (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND a.ing_clasificacion = 1  LIMIT 200";
		}

		if($bodeFiltro == 4)
		{
	// Sin Stock
			$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE ".$region." AND c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND c.ding_unidad = 0 AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' and (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND a.ing_clasificacion = 1  LIMIT 200";
		}

		if($bodeFiltro == 5)
		{
	// Fecha de entrega
			$fechas = explode("-", $bodeClave);
			$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE ".$region." AND c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND YEAR(c.ding_fentrega) = ".$fechas[0]." AND MONTH(c.ding_fentrega) = ".$fechas[1]." AND DAY(c.ding_fentrega) = ".$fechas[2]." AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' and a.ing_estado = 1 AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND a.ing_clasificacion = 1  LIMIT 200";
		}

		if($bodeFiltro == 6)
		{
			$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE ".$region." AND c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND c.ding_ubicacion LIKE '%".$bodeClave."%' AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' and (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND a.ing_clasificacion = 1";
		}

		if($bodeFiltro == 7)
		{
			$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE ".$region." AND c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND b.oc_prog = '".$bodeClave."' AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' and (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND a.ing_clasificacion = 1  LIMIT 200";
		}

		if($bodeFiltro == 8)
		{
			$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE ".$region." AND c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND d.doc_especificacion LIKE '%".$bodeClave."%' AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' and (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND a.ing_clasificacion = 1  LIMIT 200";
		}

	}else if($tipo == 2)
	{
		if($oc <> ''){
			$where1 = "AND b.oc_id2 LIKE '%".$oc."%'";
		}

		if($nguia <> ''){
			$where2 = "AND a.ing_guia = ".$nguia;
		}

		if($bien <> ''){
			$where3 = "AND d.doc_especificacion LIKE '%".$bien."%'";
		}

		if($proveedor <> ''){
			$where4 = "AND b.oc_proveenomb LIKE '%".$proveedor."%'";
		}

		if($fentrega <> ''){
			$fechas = explode("-", $fentrega);
			$where5 = "AND YEAR(c.ding_fentrega) = ".$fechas[0]." AND MONTH(c.ding_fentrega) = ".$fechas[1]." AND DAY(c.ding_fentrega) = ".$fechas[2];
		}

		if($ubicacion <> ''){
			$where6 = "AND c.ding_ubicacion LIKE '%".$ubicacion."%'";
		}

		if($programa <> ''){
			$where7 = "AND b.oc_prog LIKE '%".$programa."%'";
		}

		if($grupo <> '')
		{
			$where8 = "AND b.oc_grupo = '".$grupo."'";
		}

		$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 $where1 $where2 $where3 $where4 $where5 $where6 $where7 $where8 AND ".$region." AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' AND (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND a.ing_clasificacion = 1 AND (b.oc_tipo = 0 OR b.oc_tipo = 1) ORDER BY c.ding_id DESC LIMIT 200 ";
	}else{
		$consulta = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE c.ding_recep_tecnica = 'A' AND b.oc_estado = 1 AND ".$region." AND d.doc_estado <> 'B' AND c.ding_recep_conforme = 'C' AND a.ing_aprobado <> '' AND (a.ing_estado = 1 OR a.ing_estado = 3) AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND a.ing_clasificacion = 1 AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND c.ding_unidad > 0 ORDER BY c.ding_id DESC LIMIT 200 ";
	}
	// echo $consulta;
	$excel = $consulta;
	$consulta = mysql_query($consulta,$dbh);


	function getWorkingDays($startDate, $endDate)
	{
		$begin = strtotime($startDate);
		$end   = strtotime($endDate);
		if ($begin > $end) {
			// echo "startdate is in the future! <br />";

			return 0;
		} else {
			$no_days  = 0;
			$weekends = 0;
			while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
            	$weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<style type="text/css">
		/*ul{
			padding: 0;
			list-style-type: none;
			text-align: center;
		}

		li {
			text-decoration: none;
			padding: .1em;
			color: #fff;
			display: inline;
		}
		a{
			text-decoration: none;
		}*/
	</style>
	<script src="librerias/jquery-1.11.3.min.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php
		include("inc/menu_1b.php");
		?>
	</div>

	<div style="background-color:#E0F8E0; position:absolute; top:130px; left:00px; width:100%" id="div1">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="Estilo2titulo" colspan="9"><center>CONSULTAS</center></td>
			</tr>
		</table>
		<hr>
		<?php if ($avanzada == 0): ?>
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
				<table border="0" cellpadding="0" cellspacing="0" width="60%">
					<tr>
						<td class="Estilo1">CLAVE</td>
						<td class="Estilo1"><input type="text" name="bodeClave" id="bodeClave" class="Estilo1" value="<?php echo $bodeClave ?>"></td>
						<td class="Estilo1mc">
							<select name="bodeFiltro" class="Estilo1">
								<option selected value="">Seleccionar</option>
								<option value="1" <?php if($bodeFiltro == 1) { echo "selected";} ?>>ORDEN DE COMPRA</option>
								<option value="2" <?php if($bodeFiltro == 2) { echo "selected";} ?>>NUMERO DE GUIA / FACTURA</option>
								<option value="3" <?php if($bodeFiltro == 3) { echo "selected";} ?>>PROVEEDOR</option>
								<option value="4" <?php if($bodeFiltro == 4) { echo "selected";} ?>>SIN STOCK</option>
								<option value="5" <?php if($bodeFiltro == 5) { echo "selected";} ?>>FECHA DE ENTREGA (YYYY-MM-DD)</option>
								<option value="6" <?php if($bodeFiltro == 6) { echo "selected";} ?>>UBICACION</option>
								<option value="7" <?php if($bodeFiltro == 7) { echo "selected";} ?>>PROGRAMA</option>
								<option value="8" <?php if($bodeFiltro == 8) { echo "selected";} ?>>BIEN</option>
							</select>
						</td>
						<td class="Estilo1">
						<button type="submit" onClick="blockUI()">CONSULTAR <i class="fa fa-search"></i></button>
						<input type="hidden" name="tipo" value="1">
						</td>
						<td class="Estilo1"><a href="bode_stock.php?cod=37&avanzada=1">BUSQUEDA AVANZADA</a></td>
					</tr>
				</table>
			</form>
		<?php endif ?>
		
		<?php if ($avanzada == 1): ?>
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
				<table border="0" cellpadding="0" cellspacing="0" width="70%">
					<tr>
						<td class="Estilo1">ORDEN DE COMPRA</td>
						<td class="Estilo1"><input type="text" name="oc" id="oc" value="<?php echo $oc ?>"></td>

					<td class="Estilo1">N° GUIA / FACTURA</td>
					<td class="Estilo1"><input type="text" name="nguia" id="nguia" value="<?php echo $nguia ?>"></td>
				</tr>

				<tr>
					<td class="Estilo1">BIEN</td>
					<td class="Estilo1"><input type="text" name="bien" id="bien" value="<?php echo $bien ?>"></td>
				
					<td class="Estilo1">PROVEEDOR</td>
					<td class="Estilo1"><input type="text" name="proveedor" id="proveedor" value="<?php echo $proveedor ?>"></td>
				</tr>

				<tr>
					<td class="Estilo1">FECHA DE ENTREGA</td>
					<td class="Estilo1">
					<input type="text" name="fentrega" id="fentrega" value="<?php echo $fentrega ?>" placeholder="YYYY-MM-DD">
						<i class="fa fa-calendar fa-lg link" id="f_trigger_c2" style="cursor:pointer;" title="Seleccionar Fecha"></i>
						<script type="text/javascript">
							Calendar.setup({
        inputField     :    "fentrega",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
</td>

	<td class="Estilo1">UBICACION</td>
	<td class="Estilo1"><input type="text" name="ubicacion" id="ubicacion" value="<?php echo $ubicacion ?>"></td>
</tr>

<tr>
	<td class="Estilo1">PROGRAMA</td>
	<td class="Estilo1">

	<select name="programa" id="programa" class="Estilo2">
	<option selected value="">Seleccionar...</option>
	<?php foreach ($programas as $key => $value): ?>
		<option value="<?php echo $value["param_glosa"] ?>"  <?php if($programa == $value["param_glosa"]){echo"selected";} ?>><?php echo $value["param_desc"] ?></option>
	<?php endforeach ?>
	</select>
	</td>
	
	<td class="Estilo1">GRUPO</td>
	<td class="Estilo1">
		<select class="Estilo2" name="grupo" id="grupo">
			<option value="">Seleccionar...</option>
			<?php foreach ($grupos as $key => $value): ?>
				<option value="<?php echo $value["param_glosa"] ?>" <?php if($grupo == $value["param_glosa"]){echo"selected";} ?>><?php echo $value["param_glosa"] ?></option>
			<?php endforeach ?>
		</select>
	</td>
</tr>

<tr>
	<td class="Estilo1" style="text-align:center" colspan="4">
		<button type="submit" onclick="blockUI()">CONSULTAR <i class="fa fa-search"></i></button>
		<a href="bode_stock.php?cod=37&avanzada=1">LIMPIAR</a> |
		<a href="bode_stock.php?cod=37">BUSQUEDA SIMPLE</a>
		<input type="hidden" name="tipo" value="2">
	</td>
</tr>
</table>
<input type="hidden" name="avanzada" value="<?php echo $avanzada ?>">
</form>
<?php endif ?>

<hr>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td class="Estilo2titulo" colspan="10"><center>STOCK</center></td>
	</tr>

</table>
<br>
<table border="1" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td class="Estilo1mcR" colspan="<?php echo $colspan ?>">
			<form action="bode_exportar.php" method="POST" id="exportar">
				<input type="hidden" name="qry" id="qry" value="<?php echo $excel ?>">
				<a href="#" onClick="exportar()" class="link">EXPORTAR A EXCEL</a>
				<script type="text/javascript">
					function exportar()
					{
						document.getElementById("exportar").submit();
					}
				</script>
			</form>
		</td>
	</tr>
	<tr>
		<td class="Est1lo1mc"></td>
		<td class="Estilo1mc">ORDEN DE COMPRA</td>
		<td class="Estilo1mc">BIEN</td>
		<td class="Estilo1mc">STOCK DISPONIBLE</td>
		<td class="Estilo1mc">PROVEEDOR</td>
		<td class="Estilo1mc">FECHA ENTREGA</td>
		<td class="Estilo1mc">VALOR UNITARIO NETO</td>
		<td class="Estilo1mc">UBICACION</td>
		<td class="Estilo1mc">PROGRAMA</td>
		<td class="Estilo1mc">GUIA</td>
		<?php if ($_SESSION["region"] == 16): ?>
			<td class="Estilo1mc">ESTADISTICA</td>
		<?php endif ?>
	</tr>
	<?php
	$cont=1;
	while ($row = mysql_fetch_array($consulta)) {
		$estilo=$cont%2;
		if ($estilo==0) {
			$estilo2="Estilo1mc";
		} else {
			$estilo2="Estilo1mcblanco";
		}

		$v_ing_aprueba = $row["ing_aprobado"];
		$v_fentrega = $row["ding_fentrega"];
		$diasHabiles = getWorkingDays($v_fentrega,Date("Y-m-d"));
		$v_ding_unidad = $row["ding_unidad"];
		?>
		<tr class="<?php echo $estilo2 ?> trh">
			<td><?php echo $cont ?></td>
			<td><?php echo ($row["oc_tipo"] == 1 ? $row["oc_folioguia"] : $row["oc_id2"]) ?></td>
			<td><?php echo $row["doc_especificacion"] ?></td>
			<td><?php echo $row["ding_unidad"]?></td>
			<td><?php echo $row["oc_proveenomb"] ?></td>
			<td><?php echo $row["ding_fentrega"] ?></td>
			<td>$<?php echo number_format( ($row["doc_conversion"] / $row["ding_factor"]),0,".",".") ?></td>
			<td><a href="/sistemas/inventario/privado/sitio2/bode_nueva_ubicacion.php?id=<?php echo $row["ing_id"]?>&prod_id=<?php echo $row["doc_id"] ?>&ding_id=<?php echo $row["ding_id"] ?>" class="nuevaUbicacion"><?php echo $row["ding_ubicacion"] ?></a></td>
			<td><?php echo $row["oc_prog"] ?></td>
			<td><?php echo $row["ing_guia"] ?></td>
			<?php if($_SESSION["region"] == 16) : ?>
			<td>
				<?php if ($v_fentrega >= "2016-04-01"): ?>
				<?php if ($v_ing_aprueba == ""): ?>
				<font color="red"><strong title="FALTA RECEPCION TECNICA Y CONFORME"><i class="fa fa-warning"></i></strong></font>
			<?php elseif($v_ding_unidad > 0 && $diasHabiles >= 5 && $v_ing_aprueba <> ""): ?>
			<font color="red"><strong title="DIAS QUE HA PERMANECIDO EN BODEGA"><?php echo $diasHabiles ?></strong></font>/<?php echo $v_ding_unidad ?>
		<?php elseif($v_ding_unidad > 0 && $diasHabiles < 5 && $v_ing_aprueba <> ""): ?>
		<font color="green"><strong title="DIAS QUE HA PERMANECIDO EN BODEGA"><?php echo $diasHabiles ?></strong></font>/<?php echo $v_ding_unidad ?>
	<?php elseif($v_ding_unidad == 0 && $v_ing_aprueba <> ""): ?>
	<font color="green"><strong><i class="fa fa-check"></i></strong></font>
<?php endif ?>
<?php endif ?>
</td>
<?php endif ?>
</tr>
<?php $cont++;} ?>
</table>
</div>

<script type="text/javascript">
	jQuery('.nuevaUbicacion').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=600, height=600, top=100, left=200, toolbar=1');

	});

</script>
</body>
</html>