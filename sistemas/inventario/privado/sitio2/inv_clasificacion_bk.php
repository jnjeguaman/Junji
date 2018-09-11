<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<style type="text/css">
		ul{
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
		}
	</style>
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<script type="text/javascript" src="librerias/jquery.printPage.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php
		include("inc/menu_1b.php");
		?>
	</div>

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
			$where3 = "AND a.ing_aprobado LIKE '%".$clave."%'";
		}

		if($filtro == 4)
		{
			$where4 = "AND b.oc_grupo LIKE '%".$clave."%'";
		}

		if($filtro == 5)
		{
			$where5 = "AND b.oc_region LIKE ".$clave;
		}

		$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 $where1 $where2 $where3 $where4 $where5 AND a.ing_aprobado <> '' AND a.ing_estado = 1 AND b.oc_fecha_recep >= '2016-04-07' AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND oc_region = ".$_SESSION["region"]." ORDER BY ing_id DESC";
	}else{
		
		$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 AND a.ing_aprobado <> '' AND a.ing_estado = 1 AND b.oc_fecha_recep >= '2016-04-07' AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND oc_region = ".$_SESSION["region"]." ORDER BY ing_id DESC";
	}
	if($_SESSION["nom_user"] == "pcastaneda")
	{
		$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 AND a.ing_aprobado <> '' AND a.ing_estado = 1 AND b.oc_fecha_recep >= '2016-04-07' AND (b.oc_tipo = 0 OR b.oc_tipo = 1) ORDER BY ing_id DESC";	
	}
	$sql = mysql_query($sql);


	if($submit == "actualizar")
	{
		for ($i=1; $i <=$total; $i++) { 
			if($clasificacion[$i] == 1)
			{
				$update = "UPDATE acti_compra_temporal SET compra_clasificacion = ".$clasificacion[$i].", compra_visible = 1, compra_region_id = ".$var4[$i]." WHERE compra_ing_id =".$var1[$i]." AND compra_ding_id = ".$var2[$i];
				$update2 = "UPDATE bode_detingreso SET ding_clasificacion = ".$clasificacion[$i]." WHERE ding_id = ".$var2[$i];
				$update3 = "UPDATE bode_ingreso SET ing_estado = 0 WHERE ing_id = ".$var3;
				//$update4 = "UPDATE acti_compra_temporal SET compra_region_id = ".$var4[$i]." WHERE compra_ing_id = ".$var1[$i]." AND compra_ding_id = ".$var2[$i];

				mysql_query($update);
				mysql_query($update2);
				mysql_query($update3);
				//mysql_query($update4);
			}else{
				$update = "UPDATE acti_compra_temporal SET compra_clasificacion = ".$clasificacion[$i].", compra_visible = 0 WHERE compra_ing_id =".$var1[$i]." AND compra_ding_id = ".$var2[$i];
				$update2 = "UPDATE bode_detingreso SET ding_clasificacion = ".$clasificacion[$i]." WHERE ding_id = ".$var2[$i];
				$update3 = "UPDATE bode_ingreso SET ing_estado = 0 WHERE ing_id = ".$var3;
				mysql_query($update);
				mysql_query($update2);
				mysql_query($update3);
			}
		}
		echo "<script>window.location.href='inv_clasificacion.php?cod=45';</script>";
	}
	?>
	<div style="width:700px;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
		<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
			<table border="0" width="30%">
				<tr >
					<td class="Estilo1">CLAVE</td>
					<td><input type="text" name="clave" id="clave" value="<?php echo $clave ?>" class="Estilo1"></td>
					<td>
						<select id="filtro" name="filtro" class="Estilo1">
							<option value="">Seleccionar...</option>
							<option value="1" <?php if($filtro == 1) { echo "selected"; } ?>>ORDEN DE COMPRA</option>
							<option value="2" <?php if($filtro == 2) { echo "selected"; } ?>>N° GUIA PROVEEDOR</option>
							<option value="3" <?php if($filtro == 3) { echo "selected"; } ?>>APROBADO POR</option>
							<option value="4" <?php if($filtro == 4) { echo "selected"; } ?>>GRUPO</option>
							<option value="5" <?php if($filtro == 5) { echo "selected"; } ?>>REGION</option>
						</select>
					</td>
					<td><input type="submit" name="enviar" id="enviar" value="BUSCAR"></td>
				</tr>
			</table>
			<hr>
			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="10">LISTADO</td>
				</tr>
			</table>

			<hr>

			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				<tr class="Estilo1mc">
					<td></td>
					<td>ORDEN DE COMPRA</td>
					<td>REGION</td>
					<td>GRUPO</td>
					<td>NOMBRE ORDEN DE COMPRA</td>
					<td>N° GUIA PROVEEDOR</td>
					<td>APROBADO POR</td>
					<td>RT</td>
					<td>RC</td>
					<td>DETALLE</td>
				</tr>

				<?php 
				$cont=1;
				while($row = mysql_fetch_array($sql)) {

					$estilo=$cont%2;
					if ($estilo==0) {
						$estilo2="Estilo1mc";
					} else {
						$estilo2="Estilo1mcblanco";
					}

					if($row["ing_id"] == $ing_id){
						$stylo = "style='background-color: red; color: white;'";
					}else{
						$stylo = "";
					}
					?>
					<tr class="trh <?php echo $estilo2 ?>" <?php echo $stylo ?>>
						<td><?php echo $cont ?></td>
						<td><?php echo $row["oc_id2"] ?></td>
						<td><?php echo $row["oc_region"] ?></td>
						<td><?php echo $row["oc_grupo"] ?></td>
						<td><?php echo $row["oc_nombre_oc"] ?></td>
						<td><?php echo $row["ing_guia"] ?></td>
						<td><?php echo $row["ing_aprobado"] ?></td>
						<td><?php echo $row["ing_guianumerotc"] ?></td>
						<td><?php echo $row["ing_guianumerorc"] ?></td>
						<td><a href="<?php echo $_SERVER["PHP_SELF"]."?ing_id=" .$row["ing_id"] ?>"><i class="fa fa-eye link"></i></td>
					</tr>
					<?php $cont++;} ?>
				</table>
			</form>
		</div>

		<?php if (isset($ing_id) AND $ing_id <> ""): ?>
			<div style="width:640px; background-color:#E0F8E0; position:absolute; top:120px; left:710px;" id="div2">
				<?php
				$getPropductos = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON a.ding_prod_id = b.doc_id WHERE a.ding_ing_id = ".$ing_id;
				$getPropductos = mysql_query($getPropductos);
				?>
				<table border="0" width="100%">
					<tr>
						<td class="Estilo2titulo" colspan="10">LISTADO DE PRODUCTOS</td>
					</tr>
				</table>
				<hr>
				<table border="1" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="Estilo1mc"></td>
						<td class="Estilo1mc">REGION</td>
						<td class="Estilo1mc">BIEN</td>
						<td class="Estilo1mc">CANTIDAD</td>
						<td class="Estilo1mc">CLASIFICACION</td>
						<td class="Estilo1mc">EDITAR</td>
					</tr>

					<form action="<?php echo $_SERVER["PHP_SELF"] ?>?ing_id=<?php echo $ing_id ?>" method="POST">
						<?php $cont = 0; while($rowProd = mysql_fetch_array($getPropductos)){ $cont++;

							$estilo=$cont%2;
							if ($estilo==0) {
								$estilo2="Estilo1mc";
							} else {
								$estilo2="Estilo1mcblanco";
							}

							if($row["ing_aprobado"] == ''){
								$stylo = "style='background-color: red; color: white;'";
							}else{
								$stylo = "";
							}

							?>
							<tr class="trh <?php echo $estilo2 ?>">
								<td class="Estilo1mc"><?php echo $cont ?></td>
								<td class="Estilo1mc"><?php echo $rowProd["doc_region"] ?></td>
								<td class="Estilo1mc"><?php echo $rowProd["doc_especificacion2"] ?></td>
								<td class="Estilo1mc"><?php echo $rowProd["ding_unidad"] ?></td>
								<td class="Estilo1mc">
									<select class="Estilo1mc" name="clasificacion[<?php echo $cont ?>]" required>
										<option value="">Seleccionar...</option>
										<option value="1" <?php if($rowProd["ding_clasificacion"] === 1){ echo "selected";} ?> >INVENTARIABLE</option><
										<option value="0" <?php if($rowProd["ding_clasificacion"] === 0){ echo "selected";} ?> >EXISTENCIA</option><
									</select>
								</td>
								<td class="Estilo1mc"><a href="inv_detalle.php?ing_id=<?php echo $rowProd["ding_ing_id"] ?>&ding_id=<?php echo $rowProd["ding_id"] ?>&doc_id=<?php echo $rowProd["doc_id"] ?>" class="popup"><i class="fa fa-pencil-square link fa-lg"></i></td>
							</tr>

							<input type="hidden" name="var1[<?php echo $cont ?>]" value="<?php echo $rowProd["ding_ing_id"] ?>">
							<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $rowProd["ding_id"] ?>">
							<input type="hidden" name="var3" value="<?php echo $rowProd["ding_ing_id"] ?>">
							<input type="hidden" name="var4[<?php echo $cont ?>]" value="<?php echo $rowProd["doc_region"] ?>">
							<?php } ?>
							<tr>
								<td colspan="6"><center><button type="submit" name="submit" value="actualizar">ACTUALIZAR <i class="fa fa-refresh"></i></button></center></td>
							</tr>
						</table>
						<input type="hidden" name="total" value="<?php echo $cont ?>">
					</form>

				</div>
			<?php endif ?>

			<script type="text/javascript">
				jQuery('.popup').click(function(e){
					e.preventDefault();
					window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=800, height=400, top=100, left=200, toolbar=1');
				});

			</script>
		</body>
		</html>	