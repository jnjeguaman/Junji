<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/calendar.js"></script>
<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
<script type="text/javascript" src="librerias/calendar-setup.js"></script>
</head>
<body>
<div style="background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
	<?php include("inc/menu_1b.php"); ?>
</div>
<div style="width:100%; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
		<?php
		extract($_GET);
		extract($_POST);
		$sql = "SELECT * FROM  inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON b.detalle_guia_id = a.guia_id WHERE a.guia_estado = 2 AND a.guia_numero = ".$guia;
		$rs = mysql_query($sql);
		$rs2 = mysql_query($sql);
		$detalleGuia = mysql_fetch_array($rs);

		if($resolucion <> "" AND $traslado_fecha <> "" AND $guia_id <> "")
		{
			mysql_query("UPDATE inv_guia_despacho_encabezado SET guia_estado = 1 WHERE guia_id = ".$guia_id);
			while($row2 = mysql_fetch_array($rs2))
			{
				mysql_query("UPDATE acti_inventario SET inv_baja = '".$resolucion."', inv_bajafecha = '".$traslado_fecha."', inv_estado2 = 0 WHERE inv_codigo = ".$row2["detalle_inv_codigo"]." AND inv_region = ".$row2["detalle_region_origen"]);
				mysql_query("UPDATE acti_inventario SET inv_altares = '".$resolucion."', inv_altafecha = '".$traslado_fecha."', inv_alta_en_transito = 'ALTA' WHERE inv_codigo = ".$row2["detalle_inv_codigo"]." AND inv_region = ".$row2["detalle_dest"]);
			}
			echo "<script>alert('Proceso Completado'); window.location.href='registro_guias.php?cod=27';</script>";
		}
		?>

	<form action="inv_traslado_editar.php" method="POST" onSubmit="return valida()">
		<table border="1" width="70%">
			<tr>
				<td class="Estilo2titulo" colspan="4">GUIA DE DESPACHO TRASLADO MASIVO</td>
			</tr>

			<tr>
				<td class="Estilo1">N° GUIA INTERNO</td>
				<td class="Estilo1"><?php echo $detalleGuia["guia_numero"] ?></td>
			</tr>

			<tr>
				<td class="Estilo1">ABASTECE</td>
				<td class="Estilo1"><?php echo $detalleGuia["guia_abastece"] ?></td>
			</tr>

			<tr>
				<td class="Estilo1">DESTINATARIO</td>
				<td class="Estilo1"><?php echo $detalleGuia["guia_destinatario"]." / ".$detalleGuia["guia_direccion"]." / ".$detalleGuia["guia_zona"] ?></td>
			</tr>

			<tr>
				<td class="Estilo1">EMISOR</td>
				<td class="Estilo1"><?php echo $detalleGuia["guia_emisor"] ?></td>
			</tr>


			<tr>
				<td class="Estilo1">N° RESOLUCION DE TRASLADO</td>
				<td class="Estilo1"><input type="text" name="resolucion" id="resolucion"></td>
			</tr>

			<tr>
				<td class="Estilo1">FECHA TRASLADO</td>
					<td class="Estilo1">
						<input type="text" class="Estilo1" id="traslado_fecha" name="traslado_fecha" readonly style="background-color: rgb(235, 235, 235)">
						<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
						onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
						<script type="text/javascript">
							Calendar.setup({
								inputField  : "traslado_fecha",
								ifFormat  : "%Y-%m-%d",
								button   : "f_trigger_c2",
								align   : "Bl",
								singleClick : true
							});
						</script>
					</td>
			</tr>

			<tr>
			<td></td>
				<td class="Estilo1">
					<button type="submit">ACTUALIZAR</button>
				</td>
			</tr>
		</table>
		<input type="hidden" name="guia_id" value="<?php echo $detalleGuia["guia_id"] ?>">
		<input type="hidden" name="guia" value="<?php echo $guia ?>">					
	</form>
	<hr>

	<table border="1" width="70%">
		<tr>
			<td class="Estilo2titulo" colspan="4">GUIA DE DESPACHO TRASLADO MASIVO</td>
		</tr>

		<tr>
			<td class="Estilo1">Codigo</td>
			<td class="Estilo1">Producto</td>
			<td class="Estilo1">Origen</td>
			<td class="Estilo1">Destino</td>
		</tr>

		<?php while($row = mysql_fetch_array($rs2)){ 
			$detalle = mysql_query("SELECT inv_bien from acti_inventario WHERE inv_codigo = ".$row["detalle_inv_codigo"]." AND inv_region = ".$row["detalle_region_origen"]." LIMIT 1");
			$detalle = mysql_fetch_array($detalle);
			?>
			<tr>
				<td class="Estilo1"><?php echo $row["detalle_inv_codigo"] ?></td>
				<td class="Estilo1"><?php echo $detalle["inv_bien"] ?></td>
				<td class="Estilo1"><?php echo $row["detalle_region_origen"] ?></td>
				<td class="Estilo1"><?php echo $row["detalle_dest"] ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>



	<script type="text/javascript">
		function valida()
		{
			if($("#resolucion").val() == "")
			{
				alert("Ingrese el numero de la resolucion de traslado");
				$("#resolucion").focus();
				return false;
			}

			if($("#traslado_fecha").val() == "")
			{
				alert("Ingrese la fecha de traslado");
				$("#traslado_fecha").focus();
				return false;
			}

			if(confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?"))
			{
				blockUI();
				return true;
			}else{
				return false;
			}
		}
	</script>