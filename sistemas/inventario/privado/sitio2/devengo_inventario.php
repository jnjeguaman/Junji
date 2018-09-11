<?php
include("inc/config.php");
extract($_GET);

// VERIFICAMOS QUE EXISTAN LOS PRODUCTOS EN INVENTARIO
$sql = "SELECT count(inv_id) as Total,inv_oc,inv_nro_rece, inv_comprobante_egreso, inv_devengofecha, inv_ccontable, inv_num_factura, inv_num_factura, inv_anno,inv_fecha_factura FROM acti_inventario WHERE inv_nro_rece = '".$rc."' AND inv_oc = '".$oc."'";
$res = mysql_query($sql,$dbh);
$row = mysql_fetch_array($res);
?>

<!DOCTYPE html>
<html>
<head>
	<title>CONTABILIDAD INVENTARIO</title>
	<link href="css/estilos.css" rel="stylesheet" type="text/css">
	<script src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/calendar.js"></script>
<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
<script type="text/javascript" src="librerias/calendar-setup.js"></script>
<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

</head>
<body>
<div style="background-color:#E0F8E0;" id="div2">
<?php if (intval($row["Total"]) > 0): ?>	
<form name="frmContabilidad" action="inv_actualiza_contabilidad.php" method="POST" onSubmit="return contabilidad()">
		<table border="0" width="100%">

			<tr>
				<td class="Estilo2titulo" colspan="4">CONTABILIDAD</td>

			</tr>

			<tr>
				<td class="Estilo1">COMPROBANTE EGRESO</td>
				<td class="Estilo1">

					<?php if($row["inv_comprobante_egreso"] == ""): ?>
						<input type="text" class="Estilo1" size="9" id="inv_comprobante_egreso" name="inv_comprobante_egreso" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
					<?php else: ?>
						<input type="text" class="Estilo1" size="9" id="inv_comprobante_egreso" name="inv_comprobante_egreso" value="<?php echo $row["inv_comprobante_egreso"] ?>" readonly style="background-color: rgb(235, 235, 235)">
					<?php endif ?>
				</td>

				<td class="Estilo1">FECHA DE DEVENGO</td>
				<td class="Estilo1">
					<?php if($row["inv_devengofecha"] == "" || $row["inv_devengofecha"] == "0000-00-00"): ?>
						<input type="text" class="Estilo1" size="9" id="inv_devengofecha" name="inv_devengofecha" readonly style="background-color: rgb(235, 235, 235)">
						<img src="calendario.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
						onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
						<script type="text/javascript">
							Calendar.setup({
								inputField  : "inv_devengofecha",
								ifFormat  : "%Y-%m-%d",
								button   : "f_trigger_c",
								align   : "Bl",
								singleClick : true
							});
						</script>
					<?php else: ?>
						<input type="text" class="Estilo1" size="9" id="inv_devengofecha" name="inv_devengofecha" value="<?php echo $row["inv_devengofecha"] ?>" readonly style="background-color: rgb(235, 235, 235)">
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td class="Estilo1">CUENTA CONTABLE</td>
				<td class="Estilo1">
					<?php if($row["inv_ccontable"] == ""): ?>
						<!--<input type="text" class="Estilo1" size="9" id="inv_cta_contable" name="inv_cta_contable" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>!-->
						<select class="Estilo1" id="inv_cta_contable" name="inv_cta_contable">
							<option selected value="">Seleccionar...</option>
							<?php foreach ($ctaContable as $key => $value): ?> 
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"]." - ".$value["param_desc"] ?></option>
								<?php endforeach ?>
						</select>
					<?php else: ?>
						<input type="text" class="Estilo1" size="9" id="inv_cta_contable" name="inv_cta_contable" value="<?php echo $row["inv_ccontable"] ?>" readonly style="background-color: rgb(235, 235, 235)">
					<?php endif ?>
				</td>

				<td class="Estilo1">NUMERO FACTURA</td>
				<td class="Estilo1">
					<?php if($row["inv_num_factura"] == ""): ?>
						<input type="text" class="Estilo1" size="9" id="inv_num_factura" name="inv_num_factura" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
					<?php else: ?>
						<input type="text" class="Estilo1" size="9" id="inv_num_factura" name="inv_num_factura" value="<?php echo $row["inv_num_factura"] ?>" readonly style="background-color: rgb(235, 235, 235)">
					<?php endif ?>
				</td>

			</tr>

			<tr>
				<td class="Estilo1">FECHA FACTURA</td>
				<td class="Estilo1">
					<?php if($row["inv_fecha_factura"] == ""): ?>
						<input type="text" class="Estilo1" size="9" id="inv_fecha_factura" name="inv_fecha_factura" readonly style="background-color: rgb(235, 235, 235)">
						<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
						onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
						<script type="text/javascript">
							Calendar.setup({
								inputField  : "inv_fecha_factura",
								ifFormat  : "%d-%m-%Y",
								button   : "f_trigger_c3",
								align   : "Bl",
								singleClick : true
							});
						</script>
					<?php else: ?>
						<input type="text" class="Estilo1" size="9" id="inv_fecha_factura" name="inv_fecha_factura" value="<?php echo $row["inv_fecha_factura"] ?>" readonly style="background-color: rgb(235, 235, 235)">
					<?php endif ?>
				</td>
				<td class="Estilo1">AÑO ADQUISICION</td>
				<td class="Estilo1">
					<?php if($row["inv_anno"] == ""): ?>
						<input type="text" class="Estilo1" size="9" id="inv_anno" name="inv_anno" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
					<?php else: ?>
						<input type="text" class="Estilo1" size="9" id="inv_anno" name="inv_anno" value="<?php echo $row["inv_anno"] ?>" readonly style="background-color: rgb(235, 235, 235)">
					<?php endif ?>
				</td>
			</tr>

			<?php if($row["inv_comprobante_egreso"] == "" || $row["inv_devengofecha"] == "" || $row["inv_ccontable"] == "" || $row["inv_num_factura"] == "" || $row["inv_num_factura"] == "" || $row["inv_anno"] == ""): ?>
				<tr>
					<td class="Estilo1">TIPO ACTUALIZACION</td>
					<td class="Estilo1">
						<select class="Estilo1" name="tipoActualizacion" id="tipoActualizacion">
							<option selected value="">Seleccionar...</option>
							<!-- <option value="0">LOTE ORDEN DE COMPRA</option> -->
							<option value="2">LOTE RECEPCION</option>
						</select>
					</td>
				</tr>
			</table>

			<table border="0" width="100%">
				<tr>
					<td class="Estilo1c">
						<input type="submit" name="submit" class="Estilo2" size="11" value="  GRABAR  " >
					</td>
				</tr>
			</table>
		<?php else: ?>
		</table>
	<?php endif ?>

	<input type="hidden" name="inv_oc" value="<?php echo $row["inv_oc"] ?>">
	<input type="hidden" name="inv_rc" value="<?php echo $row["inv_nro_rece"] ?>">
</form>

<?php else: ?>
	ESTE ITEM NO ESTÁ INVENTARIADO
<?php endif ?>

</div>
<script type="text/javascript">
	function contabilidad(){

		if($("#inv_comprobante_egreso").val() == "")
		{
			alert("INGRESE EL COMPROBANTE DE EGRESO");
			document.getElementById("inv_comprobante_egreso").focus();
			return false;
		}else if($("#inv_devengofecha").val() == "" || $("#inv_devengofecha").val() == "0000-00-00"){
			alert("INGRESE LA FECHA DEL COMPROBANTE DE EGRESO");
			document.getElementById("inv_devengofecha").focus();
			return false;
		}else if($("#inv_cta_contable").val() == ""){
			alert("INGRESE LA CUENTA CONTABLE");
			document.getElementById("inv_cta_contable").focus();
			return false;
		}else if($("#inv_num_factura").val() == ""){
			alert("INGRESE EL NUMERO DE FACTURA");
			document.getElementById("inv_num_factura").focus();
			return false;
		}else if($("#inv_fecha_factura").val() == ""){
			alert("INGRESE LA FECHA DE LA FACTURA");
			document.getElementById("inv_fecha_factura").focus();
			return false;
		}else if($("#inv_anno").val() == ""){
			alert("INGRESE EL AÑO DE ADQUISICION");
			document.getElementById("inv_anno").focus();
			return false;
		}else if(document.forms["frmContabilidad"]["tipoActualizacion"].value == ""){
			alert("SELECCIONE EL TIPO DE ACTUALIZACION");
			document.forms["frmContabilidad"]["tipoActualizacion"].focus();
			return false;
		}else{
			if(confirm('¿ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS?'))
			{
				blockUI();
				return true;
			}else{
				return false;
			}
		}
	}
</script>
</body>
</html>