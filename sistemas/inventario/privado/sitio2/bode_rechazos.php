<div style="width:100%;background-color:#E0F8E0; position:absolute; top:160px; left:0px;" id="div1">
	<?php
	extract($_SESSION);
	extract($_GET);
	extract($_POST);

	if (!isset($_POST['filtro'])) {
		$filtro="";
	}
	if (!isset($_POST['clave'])) {
		$clave="";
	}

	$where1="";
	$where2="";
	$where3="";
	$where4="";


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
			$where3 = "AND a.ing_rechazado = ''";
		}
		if($filtro == 4)
		{
			$where4 = "AND a.ing_rechazado LIKE '%".$clave."%'";
		}

		$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerorrchzo <> 0  $where1 $where2 $where3 $where4 AND a.ing_region = ".$_SESSION["region"]." ORDER BY ing_id DESC";
	}else{
		$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerorrchzo <> 0 AND a.ing_region = ".$_SESSION["region"]." ORDER BY ing_id DESC";
	}

		//echo $sql;
	$sql = mysql_query($sql);

	if(isset($ing_id) && intval($ing_id))
	{
		$rechazado = "UPDATE bode_ingreso SET ing_rechazado = '".$nombrecom."' WHERE ing_id = ".$ing_id;
		mysql_query($rechazado);

		$fechamia=date('Y-m-d');
		$horaSys = Date("H:i:s");
		$log = "INSERT INTO log VALUES(NULL,".$ing_id.",0,'RECHAZO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTO - RECHAZOS')";
		mysql_query($log);
		echo "<script>window.location.href='bode_inv_indexoc4.php?cmd=Rechazos';</script>";
		//echo $rechazado;
	}

	?>

	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">BUSCADOR</td>
		</tr>
	</table>
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
			<td></td>
			<td>ORDEN DE COMPRA</td>
			<td>NOMBRE ORDEN DE COMPRA</td>
			<td>N° GUIA PROVEEDOR</td>
			<td>DESCARGAR</td>
			<td>APROBADO POR</td>
			<!--<td>ID INGRESO</td>!-->
			<td>RC</td>
			<td>ESTADO</td>

		</tr>
		<?php 
		$cont=1;
		while($row = mysql_fetch_array($sql)) {

			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}

			if($row["ing_rechazado"] == ''){
				$stylo = "style='background-color: red; color: white;'";
			}else{
				$stylo = "";
			}


			?>
			<tr class="<?php echo $estilo2 ?> trh" <?php echo $stylo ?>>
				<td><?php echo $cont; ?></td>
				<td><?php echo $row["oc_id2"] ?></td>
				<td><?php echo $row["oc_nombre_oc"] ?></td>
				<td><?php echo $row["ing_guia"] ?></td>
				<td><a href="bode_imprimerechazo.php?numguia=<?php echo $row["ing_guianumerorrchzo"] ?>" target="_blank"><i class="fa fa-download"></i></a></td>
				<td><?php echo $row["ing_rechazado"] ?></td>
				<!--<td><?php //echo $row["ing_id"] ?></td>!-->
				<td><?php echo $row["ing_guianumerorrchzo"] ?></td>
				<td>
					<?php if ($row["ing_rechazado"] <> ''): ?>
						<font color="green"><i class="fa fa-check"></i></font>
					<?php else: ?> 
					<?php if($_SESSION["pfl_user"] <> 53):?>
						<a href="<?php echo $_SERVER["REQUEST_URI"] ?>&ing_id=<?php echo $row["ing_id"] ?>" onClick="return confirm('¿ Seguro que desea Cambiar Estado ?')"><i class="fa fa-warning"></i></a>
					<?php endif ?>
					<?php endif ?>
				</td>

			</tr>
			<?php } ?>
		</table>
	</div>
