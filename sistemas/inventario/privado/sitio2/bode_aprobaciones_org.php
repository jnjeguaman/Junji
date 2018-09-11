<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<script type="text/javascript" src="librerias/jquery.Rut.js"></script>
	<link rel="stylesheet" href="librerias/jquery-ui-1.11.4.custom/themes/start/jquery-ui.min.css">
	<script src="librerias/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>
	<div style="background-color:#E0F8E0; position:absolute; top:120px; left:00px; width:100%" id="div1">


		<?php
		extract($_SESSION);
		extract($_GET);
		extract($_POST);

			if(isset($enviar) && $enviar == "BUSCAR")
			{
				if($filtro == 1)
				{
					$where1 = "AND b.oc_id2 LIKE '%".$clave."%'";
				}

				if($filtro == 2)
				{
					$where2 = "AND a.ing_guia LIKE '%".$clave."%'";
				}
				if($filtro == 3)
				{
					$where3 = "AND a.ing_aprobado = ''";
				}
				if($filtro == 4)
				{
					$where4 = "AND a.ing_aprobado LIKE '%".$clave."%'";
				}

				$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 $where1 $where2 $where3 $where4 AND  a.ing_region = ".$_SESSION["region"]." ORDER BY ing_id DESC";
			}else{
				$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 AND  a.ing_region = ".$_SESSION["region"]." ORDER BY ing_id DESC";
			}

		//echo $sql;
		$sql = mysql_query($sql);

		if(isset($ing_id) && intval($ing_id))
		{
			$aprobado = "UPDATE bode_ingreso SET ing_aprobado = '".$nombrecom."' WHERE ing_id = ".$ing_id;
			mysql_query($aprobado);
			echo "<script>window.location.href='bode_aprobaciones.php?cod=39';</script>";
		//echo $aprobado;
		}

		?>

			<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">BUSCADOR</td>
			</tr>
		</table>
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
			<table border="0" width="30%">
					<tr >
						<td class="Estilo1">CLAVE</td>
						<td><input type="text" name="clave" id="clave" value="<?php echo $clave ?>" class="Estilo1"></td>
						<td>
							<select id="filtro" name="filtro" class="Estilo1">
								<option value="">Seleccionar...</option>
								<option value="1" <?php if($filtro == 1) { echo "selected"; } ?>>ORDEN DE COMPRA</option>
								<option value="2" <?php if($filtro == 2) { echo "selected"; } ?>>N° GUIA PROVEEDOR</option>
								<option value="3" <?php if($filtro == 3) { echo "selected"; } ?>>PENDIENTES</option>
								<option value="4" <?php if($filtro == 4) { echo "selected"; } ?>>APROBADO POR</option>
							</select>
						</td>
						<td><input type="submit" name="enviar" id="enviar" value="BUSCAR"></td>

					</tr>
			</table>
			</form>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">APROBACIONES PENDIENTES</td>
			</tr>
		</table>

		<table border="1" cellpadding="0" cellspacing="0" width="100%">
			<tr class="Estilo1mc">
				<td>ORDEN DE COMPRA</td>
				<td>NOMBRE ORDEN DE COMPRA</td>
				<td>N° GUIA PROVEEDOR</td>
				<td>RT</td>
				<td>RC</td>
				<td>APROBADO POR</td>
				<!--<td>ID INGRESO</td>!-->
				<td>RT</td>
				<td>RC</td>
				<td>ESTADO</td>

			</tr>
			<?php while($row = mysql_fetch_array($sql)) { ?>
			<tr class="Estilo1mc">
				<td><?php echo $row["oc_id2"] ?></td>
				<td><?php echo $row["oc_nombre_oc"] ?></td>
				<td><?php echo $row["ing_guia"] ?></td>
				<td><a href="bode_tca.php?numguia=<?php echo $row["ing_guianumerotc"] ?>" target="_blank"><i class="fa fa-download"></i></a></td>
				<td><a href="bode_imprimerca.php?numguia=<?php echo $row["ing_guianumerorc"] ?>" target="_blank"><i class="fa fa-download"></i></a></td>
				<td><?php echo $row["ing_aprobado"] ?></td>
				<!--<td><?php //echo $row["ing_id"] ?></td>!-->
				<td><?php echo $row["ing_guianumerotc"] ?></td>
				<td><?php echo $row["ing_guianumerorc"] ?></td>
				<td>
					<?php if ($row["ing_aprobado"] <> ''): ?>
						<font color="green"><i class="fa fa-check"></i></font>
					<?php else: ?> 
						<a href="?cod=39&ing_id=<?php echo $row["ing_id"] ?>" onClick="return confirm('¿ Seguro que desea Cambiar Estado ?')"><i class="fa fa-warning"></i></a>
					<?php endif ?>
				</td>

			</tr>
			<?php } ?>
		</table>
	</div>
</body>

</html>