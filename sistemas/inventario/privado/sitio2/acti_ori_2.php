<?php 
session_start();
require("inc/config.php");
extract($_GET);
extract($_POST);

$ns = "SELECT inv_nro_rece FROM acti_inventario WHERE inv_id = ".$_REQUEST["id"];
$ns = mysql_query($ns);
$ns = mysql_fetch_array($ns);
$ns = $ns["inv_nro_rece"];

$sql = "SELECT * FROM acti_inventario WHERE inv_id = ".$_REQUEST["id"];
$sqlResp = mysql_query($sql);
$row = mysql_fetch_array($sqlResp);

$sqlZona = "SELECT * FROM acti_zona WHERE zona_region = ".$_SESSION["region"];
$sqlZonaResp = mysql_query($sqlZona);

$sqlZona2 = "SELECT * FROM acti_zona WHERE zona_region = ".$_SESSION["region"];
$sqlZonaResp2 = mysql_query($sqlZona2);

$sqlRegion = "SELECT * FROM acti_region";
$sqlRegionResp = mysql_query($sqlRegion);
$region = intval($_SESSION["region"]);
?>
<meta charset="utf-8">
<script src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/calendar.js"></script>
<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
<script type="text/javascript" src="librerias/calendar-setup.js"></script>
<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />


<div style="background-color:#E0F8E0;" id="div2">
	<?php 
	$vd = "SELECT catsub_vu FROM acti_catsub WHERE catsub_nombre = '".$row["inv_bien"]."'";
	$vd = mysql_query($vd);
	$vd = mysql_fetch_array($vd);
	$vd = intval($vd["catsub_vu"]);
	?>
	<form name="frmFicha" action="graba_acti_ori_1.php" method="post" onSubmit="return fichaProducto()">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">FICHA PRODUCTO</td>
			</tr>
		</table>
		<hr>
		<table border="0" width="40%">				
			<tr>
				<td class="Estilo1">ORDEN DE COMPRA</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_oc"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">RECEPCIÓN CONFORME</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $ns ?>"></td>
			</tr>
		</table>
		<hr>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo1">CALIDAD ADMINISTRATIVA</td>
				<td class="Estilo1">
					<select class="Estilo1" name="inv_calidad" id="inv_calidad">
							<option selected value="">Seleccionar...</option>
							<?php foreach ($calidad as $key => $value): ?>
								<option value="<?php echo $value["param_glosa"] ?>" <?php if($row["inv_calidad"] == $value["param_glosa"]){echo"selected";} ?>><?php echo $value["param_desc"] ?></option>
							<?php endforeach ?>
					</select>
				</td>

				<td class="Estilo1">VIDA UTIL</td>
				<td class="Estilo1">
					<?php if ($row["inv_vutil"] == ""): ?>
						<input type="text" name="inv_vutil" id="inv_vutil" readonly value="<?php echo $vd ?>" size="2" style="background-color: rgb(235, 235, 235)">
					<?php else: ?>
						<input type="text" name="inv_vutil" id="inv_vutil" readonly value="<?php echo $row["inv_vutil"] ?>" size="2" style="background-color: rgb(235, 235, 235)">
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td class="Estilo1">VIDA UTIL CONSUMIDA</td>
				<td class="Estilo1">
					<?php if ($row["inv_vutilconsumida"] == ""): ?>
						<input type="number" name="inv_vutilconsumida" id="inv_vutilconsumida" min="0" max="<?php echo $vd?>" value="0" size="2">
					<?php else: ?>
						<input type="number" name="inv_vutilconsumida" id="inv_vutilconsumida" min="0" max="<?php echo $vd?>" value="<?php echo $row["inv_vutilconsumida"] ?>" size="2">
					<?php endif ?>
				</td>

			</tr>

			<tr>
				<td class="Estilo1">ESTADO</td>
				<td class="Estilo1">
					<select class="Estilo1" name="inv_estadocosto" id="inv_estadocosto">
							<option selected value="">Seleccionar...</option>
							<?php foreach ($estados as $key => $value): ?>
								<option value="<?php echo $value["param_glosa"] ?>" <?php if($row["inv_estadocosto"] == $value["param_glosa"]){echo"selected";} ?>><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
							<?php endforeach ?>
						
					</select>
				</td>

				<td class="Estilo1">RESPONSABLE</td>
				<td class="Estilo1"><input type="text" name="inv_responsable" id="inv_responsable" value="<?php echo $row["inv_responsable"] ?>" class="Estilo1"></td>
			</tr>

			<tr>
				<td  class="Estilo1">CENTRO RESPONSA</td>
				<td  class="Estilo1">
					<select name="responsa" id="responsa" class="Estilo1" onchange="getSubZona(this.value)">
							<option selected value="">Seleccionar...</option>
							<?php while($row3 = mysql_fetch_array($sqlZonaResp)) { ?>
							<option value="<?php echo $row3["zona_glosa"] ?>" <?php if($row3["zona_glosa"] == $row["inv_direccion"]){echo"selected";}?>><?php echo $row3["zona_glosa"] ?></option>
							<?php } ?>
					</select>
				</td>

				<td  class="Estilo1">ZONA</td>
				<td  class="Estilo1">
					<select name="inv_zona" id="inv_zona" class="Estilo1">
						<?php if ($row["inv_zona"] == ""): ?>
							<option selected value="">Seleccionar...</option>
						<?php else: ?>
							<option value="">Seleccione...</option>
							<option selected value="<?php echo $row["inv_zona"] ?>"><?php echo $row["inv_zona"] ?></option>
						<?php endif ?>
					</select>
				</td>
			</tr>

			<tr>
				<td class="Estilo1">OBSERVACION</td>
				<td class="Estilo1" colspan="4"><textarea name="inv_obs" id="inv_obs" style="margin: 0px; width: 406px; height: 72px;"><?php echo $row["inv_obs"] ?></textarea></td>
			</tr>


			<tr>
				<td class="Estilo1">TIPO ACTUALIZACION</td>
				<td class="Estilo1">
					<select class="Estilo1" name="tipoActualizacion" id="tipoActualizacion">
						<option selected value="">Seleccionar...</option>
						<?php if ($row["inv_oc"] <> ""): ?>
							<option value="0">LOTE ORDEN DE COMPRA</option>
						<?php endif ?>
						<?php if ($ns <> ""): ?>
							<option value="2">LOTE RECEPCION</option>
						<?php endif ?>
						<option value="1">INDIVIDUAL</option>
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
		<input type="hidden" name="inv_oc" value="<?php echo $row["inv_oc"] ?>">
		<input type="hidden" name="inv_id" value="<?php echo $row["inv_id"] ?>">
		<input type="hidden" name="inv_rc" value="<?php echo $ns ?>">
	</form>

	<hr>
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
								<option value="<?php echo $value["param_glosa"] ?>" <?php if($row["inv_ccontable"] == $value["param_glosa"]){echo"selected";} ?>><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
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

					<?php if($row["inv_num_factura"] == ""): ?>
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
							<?php if ($row["inv_oc"] <> ""): ?>
							<option value="0">LOTE ORDEN DE COMPRA</option>
						<?php endif ?>
						<?php if ($ns <> ""): ?>
							<option value="2">LOTE RECEPCION</option>
						<?php endif ?>
							<option value="1">INDIVIDUAL</option>
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
	<input type="hidden" name="inv_id" value="<?php echo $row["inv_id"] ?>">
	<input type="hidden" name="inv_rc" value="<?php echo $ns ?>">
</form>

<hr>
<form action="inv_actualiza_resolucion.php" method="post" onSubmit="return resAlta()" name="frmResAlta">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="4">DATOS RESOLUCION DE ALTA</td>
		</tr>

		<tr>
			<td class="Estilo1">RES. ALTA</td>
			<td class="Estilo1">
				<?php if($row["inv_altares"] == ""): ?>
					<input type="text" class="Estilo2" size="9" id="inv_altares" name="inv_altares">
				<?php else: ?>
					<input type="text" class="Estilo2" size="9" id="inv_altares" name="inv_altares" value="<?php echo $row["inv_altares"] ?>" readonly style="background-color: rgb(235, 235, 235)">
				<?php endif ?>
			</td>

			<td class="Estilo1">FECHA RES. ALTA</td>
			<td class="Estilo1">

				<?php if($row["inv_altafecha"] == ""): ?>
					<input type="text" class="Estilo1" size="9" id="inv_altafecha" name="inv_altafecha" readonly style="background-color: rgb(235, 235, 235)">
					<img src="calendario.gif" id="f_trigger_c12" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
					<script type="text/javascript">
						Calendar.setup({
							inputField  : "inv_altafecha",
							ifFormat  : "%d-%m-%Y",
							button   : "f_trigger_c12",
							align   : "Bl",
							singleClick : true
						});
					</script>
				<?php else: ?>
					<input type="text" class="Estilo1" size="9" id="inv_altafecha" name="inv_altafecha" value="<?php echo $row["inv_altafecha"] ?>" readonly style="background-color: rgb(235, 235, 235)">
				<?php endif ?>
			</td>
		</tr>

		<?php if($row["inv_altares"] == "" || $row["inv_altafecha"] == ""): ?>
			<tr>
				<td class="Estilo1">TIPO ACTUALIZACION</td>
				<td class="Estilo1">
					<select class="Estilo1" name="tipoActualizacion" id="tipoActualizacion">
						<option selected value="">Seleccionar...</option>
						<?php if ($row["inv_oc"] <> ""): ?>
							<option value="0">LOTE ORDEN DE COMPRA</option>
						<?php endif ?>
						<?php if ($ns <> ""): ?>
							<option value="2">LOTE RECEPCION</option>
						<?php endif ?>
						<option value="1">INDIVIDUAL</option>
					</select>
				</td>
			</tr>
		</table>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo1c">
					<input type="submit" class="Estilo2" size="11" value="  GRABAR  " >
				</td>
			</tr>
		</table>
	<?php endif ?>

	<input type="hidden" name="inv_oc" value="<?php echo $row["inv_oc"] ?>">
	<input type="hidden" name="inv_id" value="<?php echo $row["inv_id"] ?>">
	<input type="hidden" name="inv_rc" value="<?php echo $ns ?>">
</table>
</form>


<hr>
<form name="frmResBaja" action="inv_actualiza_baja.php" method="post" onSubmit="return resBaja()">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="4">DATOS RESOLUCION DE BAJA</td>
		</tr>

		<tr>
			<td class="Estilo1">RES. BAJA</td>
			<td class="Estilo1">
				<?php if($row["inv_baja"] == ""): ?>
					<input type="text" class="Estilo2" size="9" id="inv_baja" name="inv_baja"/>
				<?php else: ?>
					<input type="text" class="Estilo2" size="9" id="inv_baja" name="inv_baja" value="<?php echo $row["inv_baja"] ?>" readonly style="background-color: rgb(235, 235, 235)">
				<?php endif ?>
			</td>

			<td class="Estilo1">FECHA RES. BAJA</td>
			<td class="Estilo1">

				<?php if($row["inv_bajafecha"] == ""): ?>
					<input type="text" class="Estilo1" size="9" id="inv_bajafecha" name="inv_bajafecha" readonly style="background-color: rgb(235, 235, 235)">
					<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
					<script type="text/javascript">
						Calendar.setup({
							inputField  : "inv_bajafecha",
							ifFormat  : "%d-%m-%Y",
							button   : "f_trigger_c1",
							align   : "Bl",
							singleClick : true
						});
					</script>
				<?php else: ?>
					<input type="text" class="Estilo1" size="9" id="inv_bajafecha" name="inv_bajafecha" value="<?php echo $row["inv_bajafecha"] ?>" readonly style="background-color: rgb(235, 235, 235)">
				<?php endif ?>
			</td>
		</tr>
	</table>

	<?php if($row["inv_baja"] == "" || $row["inv_bajafecha"] == ""): ?>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo1c">
					<input type="submit" name="submit" class="Estilo2" size="11" value="  GRABAR  " onclick="Confirmar2()">
				</td>
			</tr>
		</table>
	<?php endif ?>
	<input type="hidden" name="inv_id" value="<?php echo $row["inv_id"] ?>">
</form>

<!--
<hr>
<form name="frmResTraslado" action="inv_actualiza_traslado.php" method="post" onSubmit="return traslado()">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="4">DATOS RESOLUCION DE TRASLADO</td>
		</tr>

		<tr>
			<td class="Estilo1">REGION DE TRASLADO</td>
			<td class="Estilo1">
			<?php if($row["inv_baja"] == ""): ?>
					<select class="Estilo1" name="inv_traslado_region" id="inv_traslado_region">
						<option selected value="">Seleccionar...</option>
						<?php while($reg = mysql_fetch_array($sqlRegionResp)) { ?>
						<option value="<?php echo $reg["region_id"] ?>"><?php echo $reg["region_glosa"] ?></option>
						<?php } ?>
					</select>
					<?php else: ?>
					<input type="text" class="Estilo2" size="9" id="inv_baja" name="inv_baja" value="<?php echo $row["inv_baja"] ?>" readonly style="background-color: rgb(235, 235, 235)">
				<?php endif ?>
			</td>

			<td class="Estilo1">FECHA TRASLADO</td>
			<td class="Estilo1">
			<?php if($row["inv_bajafecha"] == ""): ?>
					<input type="text" class="Estilo1" size="9" id="inv_traslado_fecha" name="inv_traslado_fecha" readonly style="background-color: rgb(235, 235, 235)">
					<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
					<script type="text/javascript">
						Calendar.setup({
							inputField  : "inv_traslado_fecha",
							ifFormat  : "%Y-%m-%d",
							button   : "f_trigger_c2",
							align   : "Bl",
							singleClick : true
						});
					</script>
					<?php else: ?>
					<input type="text" class="Estilo1" size="9" id="inv_bajafecha" name="inv_bajafecha" value="<?php echo $row["inv_bajafecha"] ?>" readonly style="background-color: rgb(235, 235, 235)">
				<?php endif ?>
			</td>

			<td class="Estilo1">RESOLUCION DE TRASLADO</td>
			<td class="Estilo1">
			<?php if($row["inv_baja"] == ""): ?>
			<input type="text" class="Estilo2" size="9" id="inv_traslado" name="inv_traslado" value="<?php echo $row["inv_baja"] ?>">
			<input type="hidden" class="Estilo2" size="9" name="inv_bien" value="<?php echo $row["inv_bien"] ?>">
			<input type="hidden" class="Estilo2" size="9" name="inv_ori" value="<?php echo $row["inv_region"] ?>">
			<input type="hidden" class="Estilo2" size="9" name="inv_id" value="<?php echo $row["inv_id"] ?>">
			<input type="hidden" class="Estilo2" size="9" name="inv_oc" value="<?php echo $row["inv_oc"] ?>">
			<?php else: ?>
					<input type="text" class="Estilo2" size="9" id="inv_baja" name="inv_baja" value="<?php echo $row["inv_baja"] ?>" readonly style="background-color: rgb(235, 235, 235)">
				<?php endif ?>
			</td>
		</tr>
	</table>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo1c">
					<input type="submit" name="submit" class="Estilo2" size="11" value="  GRABAR  " onclick="Confirmar2()">
				</td>
			</tr>
		</table>
	<input type="hidden" name="inv_id" value="<?php echo $row["inv_id"] ?>">
</form>
!-->
</div>	

<script type="text/javascript">

	$(function(){
		$('input').keyup(function()
		{
			$(this).val($(this).val().toUpperCase());
		});

		$('textarea').keyup(function()
		{
			$(this).val($(this).val().toUpperCase());
		});

	})

	function resBaja(){
		if($("#inv_baja").val() == "") {
			alert("INGRESE LA RESOLUCION DE BAJA");
			document.getElementById("inv_baja").focus();
			return false;
		}else if($("#inv_bajafecha").val() == ""){
			alert("INGRESE LA FECHA DE RESOLUCION DE ALTA");
			document.getElementById("inv_bajafecha").focus();
			return false;
		}else{
			return confirm('¿ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS?');
		}
	}
	function resAlta(){
		if($("#inv_altares").val() == "") {
			alert("INGRESE LA RESOLUCION DE ALTA");
			document.getElementById("inv_altares").focus();
			return false;
		}else if($("#inv_altafecha").val() == ""){
			alert("INGRESE LA FECHA DE RESOLUCION DE ALTA");
			document.getElementById("inv_altafecha").focus();
			return false;
		}else if(document.forms["frmResAlta"]["tipoActualizacion"].value == ""){
			alert("SELECCIONE EL TIPO DE ACTUALIZACION");
			document.forms["frmResAlta"]["tipoActualizacion"].focus();
			return false;
		}else{
			return confirm('¿ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS?');
		}
	}

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
			return confirm('¿ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS?');
		}
	}
	function fichaProducto(){

		if($("#inv_calidad").val() == "")
		{
			alert("SELECCIONAR CALIDAD ADMINISTRATIVA");
			document.getElementById("inv_calidad").focus();
			return false;
		}else if($("#inv_vutilconsumida").val() == ""){
			alert("INGRESE LA VIDA UTIL CONSUMIDA");
			document.getElementById("inv_vutilconsumida").focus();
			return false;
		}else if($("#inv_estadocosto").val() == ""){
			alert("SELECCIONE EL ESTADO DEL BIEN");
			document.getElementById("inv_estadocosto").focus();
			return false;
		}else if($("#inv_responsable").val() == ""){
			alert("INGRESE EL RESPONSABLE");
			document.getElementById("inv_responsable").focus();
			return false;
		}else if($("#responsa").val() == ""){
			alert("SELECCIONE EL CENTRO DE RESPONSA");
			document.getElementById("responsa").focus();
			return false;
		}else if($("#inv_zona").val() == ""){
			alert("SELECCIONE LA ZONA");
			document.getElementById("inv_zona").focus();
			return false;
		}else if($("#inv_obs").val() == ""){
			alert("INGRESE UNA OBSERVACION");
			document.getElementById("inv_obs").focus();
			return false;
		}else if($("#tipoActualizacion").val() == ""){
			alert("SELECCIONE UN TIPO DE ACTUALIZACION");
			document.getElementById("tipoActualizacion").focus();
			return false;
		}else{
			return true;
		}

	}
	function getSubZona(input) {
		$("#inv_direccion").val($("#responsa option:selected").text());
		var data = ({command : "getSubZona", zona_id : input});
		$.ajax({
			type:"POST",
			url:"inv_getsubzona.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success:function(response) {
				var resp = "";
				resp +="<option selected value=''>Seleccionar</option>";
				$.each(response,function(index,value){
					resp +="<option value='"+value.subzona+"'>"+value.subzona+"</option>";
				});
				$("#inv_zona").html(resp);

			}
		})
	}

</script>