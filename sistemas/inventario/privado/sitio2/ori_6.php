<?php
$sql = "SELECT * FROM acti_compra WHERE id = ".$_REQUEST["id"];
$sqlResp = mysql_query($sql);
$row = mysql_fetch_array($sqlResp);

$totalParcial = "SELECT SUM(rece_cantidad) as Parcial FROM acti_recepcion WHERE rece_compra_id = ".$id;
$totalParcial = mysql_query($totalParcial);
$totalParcial = mysql_fetch_array($totalParcial);
$totalParcial = intval($totalParcial["Parcial"]);

$id = $row["compra_id"];
$compra_cantidad = $row["compra_cantidad"];

$sqlData = "SELECT compra_tipo_activo,id FROM acti_compra_temporal WHERE compra_id = ".$id;
$sqlDataResp = mysql_query($sqlData);
$tipo_activo = mysql_fetch_array($sqlDataResp);
$tipo_activo = intval($tipo_activo["compra_tipo_activo"]);

/* CONEXION BODEGA */
$detalle = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b on b.ing_oc_id = a.oc_id INNER JOIN bode_detingreso c on c.ding_ing_id = b.ing_id WHERE a.oc_id2 = '".$row["oc_numero"]."' AND b.ing_guiaemisorrc <> '' AND c.ding_id=".$compra_ding_id;
$detalle = mysql_query($detalle);
$detalle = mysql_fetch_array($detalle);

$bodegas = array(1 => "LOGISTICA I REGION",2 => "LOGISTICA II REGION",3 => "LOGISTICA III REGION",4 => "LOGISTICA IV REGION",5 => "LOGISTICA V REGION",6 => "LOGISTICA VI REGION",7 => "LOGISTICA VII REGION",8 => "LOGISTICA VIII REGION",9 => "LOGISTICA IX REGION",10 => "LOGISTICA X REGION",11 => "LOGISTICA XI REGION",12 => "LOGISTICA XII REGION",13 => "CENTRO DE DISTRIBUCION",14 => "LOGISTICA XIV REGION",15 => "LOGISTICA XV REGION",16 => "CENTRO DE DISTRIBUCION");

$sql_oc = "SELECT * FROM compra_orden WHERE oc_numero = '".$row["oc_numero"]."'";
$res_oc = mysql_query($sql_oc,$dbh2);
$row_oc = mysql_fetch_array($res_oc);


?>

<style type="text/css">
	td{
		text-align: right;
	}
</style>

<div style="width:640px; background-color:#E0F8E0; position:absolute; top:120px; left:710px;" id="div2">
	<?php include("ori_2.php") ?>

	<form name="form1" action="inv_actualiza_solicitud.php" method="post" onSubmit="return validar2()">
		<?php
		//$sql = "SELECT * FROM acti_compra WHERE compra_id = ".$compra_id." AND compra_region_id = ".$_SESSION["region"];
		$sql = "SELECT * FROM acti_compra WHERE id = ".$_REQUEST["id"]." AND compra_region_id = ".$_SESSION["region"];
		$sqlResp = mysql_query($sql);
		?>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo"  colspan="2">DATOS DE SOLICITUD DE COMPRA</td>
			</tr>

			<tr>
				<td class="Estilo1c">FECHA S/C</td>
				<td class="Estilo1c"><input type="text" name="solicitud_fecha" id="solicitud_fecha" class="Estilo2" value="<?php echo $row["solicitud_fecha"] ?>" readonly style="background-color: rgb(235, 235, 228)"/>
					<img src="calendario.gif" id="f_trigger_c5" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
					<script type="text/javascript">
						Calendar.setup({
							inputField   :  "solicitud_fecha",
							ifFormat    :  "%Y-%m-%d",
							button     :  "f_trigger_c5",
							align     :  "Bl",
							singleClick  :  true
						});
					</script>
				</td>
			</tr>

			<tr>
				<?php if ($row["solicitud_numero"] == ""): ?>
					<td class="Estilo1c">N° S/C</td>
					<td class="Estilo1c">
					<input type="text" name="solicitud_numero" id="solicitud_numero" class="Estilo2" value="<?php echo $detalle["oc_sc"] ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
					<?php if ($detalle["oc_sc"] <> ""): ?>
						<a href='http://abaco.junji.gob.cl/_layouts/FormServer.aspx?XmlLocation=/Solicitudes%20de%20Compra/SC%20n%C2%B0%20<?php echo $detalle["oc_sc"] ?>.xml&ClientInstalled=false&ource=http%3A%2F%2Fabaco%2Ejunji%2Egob%2Ecl%2FSolicitudes%2520de%2520Compra%2FForms%2FPrincipal%&DefaultItemOpen=1' target="_blank">ABACO</a>
					<?php endif ?>
					</td>
				<?php else: ?>
					<td class="Estilo1c">N° S/C</td>
					<td class="Estilo1c">
					<input type="text" name="solicitud_numero" id="solicitud_numero" class="Estilo2" value="<?php echo $row["solicitud_numero"] ?>" readonly style="background-color: rgb(235, 235, 228)"/>
					<a href='http://abaco.junji.gob.cl/_layouts/FormServer.aspx?XmlLocation=/Solicitudes%20de%20Compra/SC%20n%C2%B0%20<?php echo $detalle["oc_sc"] ?>.xml&ClientInstalled=false&ource=http%3A%2F%2Fabaco%2Ejunji%2Egob%2Ecl%2FSolicitudes%2520de%2520Compra%2FForms%2FPrincipal%&DefaultItemOpen=1' target="_blank" class="link">ABACO</a> | 
					<?php if ($row_oc["oc_sc"] <> ""): ?>
					<a href="../../../archivos/docfac/<?php echo $row_oc["oc_solicitud_archivo"] ?>" class="link" target="_blank"><?php echo $row_oc["oc_sc"] ?></a>
					<?php endif ?>
					</td>
				<?php endif ?>

			</tr>

		</table>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo">SOLICITUD DE COMPRA</td>
			</tr>
		</table>
		<table border="1" width="100%" cellspacing="0">

			<thead>
				<th class="Estilo1mc"></th>
				<th class="Estilo1mc">LOTE</th>
				<th class="Estilo1mc">REGION</th>
				<th class="Estilo1mc">CANTIDAD</th>
				<th class="Estilo1mc">ARTICULO</th>
				<th class="Estilo1mc">PRECIO UNITARIO</th>
				<th class="Estilo1mc">ESTADO</th>
			</thead>

			<tbody>
				<?php while($row2 = mysql_fetch_array($sqlResp)){ ?>
				<tr>
					<td class="Estilo1mc"><input type="radio" name="compra_id" id="compra_id" value="<?php echo $row2["id"] ?>" onClick="getVal(<?php echo $row2["id"] ?>)" checked/></td>
					<td class="Estilo1mc"><?php echo $row2["compra_lote_id"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["compra_region"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["compra_cantidad"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["compra_glosa"] ?></td>
					<td class="Estilo1mc">$<?php echo number_format($row2["compra_bruto_unitario"],0,".",".") ?></td>
					<td class="Estilo1mc"><?php echo $row2["solicitud_estado"] ?></td>
					<input type="hidden" name="id" value="<?php echo $row["compra_id"] ?>">
					<input type="hidden" name="id2" value="<?php echo $_REQUEST["id"] ?>">
					<input type="hidden" name="solicitud_cantidad" id="solicitud_cantidad>" value="<?php echo $row2["compra_cantidad"] ?>"/>
					<input type="hidden" name="solicitud_bruto" id="solicitud_bruto>" value="<?php echo $row2["compra_bruto_unitario"] ?>"/>
					<input type="hidden" name="solicitud_neto" id="solicitud_neto>" value="<?php echo round(intval($row2["compra_bruto_unitario"]) / 1.19) ?>"/>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<table border="0" width="100%">
			<tr>
				<?php if ($row["solicitud_numero"] == "" || $row["solicitud_fecha"] == ""): ?>
					<td class="Estilo1c">
						<input type="submit" name="submit" class="Estilo2" size="11" value="  ACTUALIZAR  " >
					</td>
				<?php endif ?>
			</tr>
		</table>

	</form>

	<hr>
	<form name="form1" action="inv_actualiza_orden.php" method="post" onSubmit="return validar3()">
		<?php
		$sql = "SELECT * FROM acti_compra WHERE id = ".$_REQUEST["id"]." AND compra_region_id = ".$_SESSION["region"];
		$sqlResp = mysql_query($sql);
		?>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo"  colspan="2">DATOS DE ORDEN DE COMPRA</td>
			</tr>

			<tr>
				<td class="Estilo1c">FECHA O/C</td>
				<td class="Estilo1c"><input type="text" name="oc_fecha" id="oc_fecha" class="Estilo2" value="<?php if($detalle["oc_envio_fecha"] <> ''){echo $detalle["oc_envio_fecha"];}else{echo $row["oc_fecha"];} ?>" readonly style="background-color: rgb(235, 235, 228)" />
					<img src="calendario.gif" id="f_trigger_c6" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
					<script type="text/javascript">
						Calendar.setup({
							inputField   :  "oc_fecha",
							ifFormat    :  "%Y-%m-%d",
							button     :  "f_trigger_c6",
							align     :  "Bl",
							singleClick  :  true
						});
					</script>
				</td>
			</tr>

			<tr>
				<?php if ($row["oc_numero"] == ""): ?>
					<td class="Estilo1c">N° O/C</td>
					<!--<td class="Estilo1c"><input type="text" name="oc_numero" id="oc_numero"  class="Estilo2" onBlur="validaOrden(this.value)"/></td>!-->
					<td class="Estilo1c"><input type="text" size="3" name="oc1" id="oc1">-<input type="text" size="3" name="oc2" id="oc2">-<input type="text" size="3" name="oc3" id="oc3" onblur="validaOrden()"></td>
				<?php else: ?>
					<td class="Estilo1c">N° O/C</td>
					<td class="Estilo1c"><input type="text" name="oc_numero" id="oc_numero" value="<?php echo $row["oc_numero"] ?>" class="Estilo2" readonly style="background-color: rgb(235, 235, 228)"/>
					<?php if ($row_oc["oc_archivo"] <> ""): ?>
					<a href="../../../archivos/docfac/<?php echo $row_oc["oc_archivo"] ?>" class="link" target="_blank"><?php echo $row["oc_numero"] ?></a>
					<?php endif ?>
					</td>
				<?php endif ?>
			</tr>

		</table>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo">ORDEN DE COMPRA</td>
			</tr>
		</table>
		<table border="1" width="100%" cellspacing="0">

			<thead>
				<th class="Estilo1mc"></th>
				<th class="Estilo1mc">N°</th>
				<th class="Estilo1mc">LOTE</th>
				<th class="Estilo1mc">S/C</th>
				<th class="Estilo1mc">REGION</th>
				<th class="Estilo1mc">PRODUCTO</th>
				<th class="Estilo1mc">PRECIO UNITARIO</th>
				<th class="Estilo1mc">CANTIDAD</th>
				<th class="Estilo1mc">ESTADO</th>
			</thead>

			<tbody>
				<?php while($row2 = mysql_fetch_array($sqlResp)){ ?>
				<tr>
					<td class="Estilo1mc"><input type="radio" name="compra_id" id="compra_id" value="<?php echo $row2["id"] ?>" onClick="getVal2(<?php echo $row2["id"] ?>)" checked/></td>
					<td class="Estilo1mc"><?php echo $row2["compra_id"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["compra_lote_id"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["solicitud_numero"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["compra_region"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["compra_glosa"] ?></td>
					<td class="Estilo1mc">$<?php echo number_format($row2["compra_bruto_unitario"],0,".",".") ?></td>
					<td class="Estilo1mc"><?php echo $row2["compra_cantidad"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["oc_estado"] ?></td>
					<input type="hidden" name="id2" value="<?php echo $_REQUEST["id"] ?>">
					<input type="hidden" name="id" value="<?php echo $row["compra_id"] ?>">
					<input type="hidden" name="oc_cantidad" id="oc_cantidad" value="<?php echo $row2["compra_cantidad"] ?>"/>
					<input type="hidden" name="oc_bruto" id="oc_bruto" value="<?php echo $row2["compra_bruto_unitario"] ?>"/>
					<input type="hidden" name="oc_neto" id="oc_neto" value="<?php echo round(intval($row2["compra_bruto_unitario"]) / 1.19) ?>"/>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<table border="0" width="100%">
			<tr>
				<?php if ($row["oc_fecha"] == "" || $row["oc_numero"] == ""): ?>
					<td class="Estilo1c">
						<input type="submit" name="submit" class="Estilo2" size="11" value="  ACTUALIZAR  " >
					</td>
				<?php endif ?>
			</tr>
		</table>

	</form>
	<?php if (intval($compra_cantidad) != intval($totalParcial)): ?>

		<?php if ($row["solicitud_numero"] != "" && $row["solicitud_fecha"] != "" && $row["oc_numero"] != "" && $row["oc_fecha"] != ""): ?>
			<hr>

			<form name="form1" action="inv_actualiza_recepcion.php" method="post" onSubmit="return validar()">
				<?php $temp = intval($compra_cantidad - $totalParcial) ?>
				<table border="0" cellpadding="0" cellspacing="0" width="50%" align="left">
					<tr>
						<td class="Estilo1mc">BIEN</td>
						<td class="Estilo1mc"><?php echo $row["compra_glosa"] ?></td>
					</tr>
					<tr>
						<td class="Estilo1mc">REQUERIDO</td>
						<td class="Estilo1mc"><?php echo $compra_cantidad ?></td>
					</tr>

					<tr>
						<td class="Estilo1mc">TOTAL RECEPCIONADOS</td>
						<td class="Estilo1mc"><?php echo $totalParcial ?></td>
					</tr>

					<tr>
						<td class="Estilo1mc">FALTAN</td>
						<td class="Estilo1mc"><?php echo $temp ?></td>
					</tr>
				</table>

				<table border="0" width="100%">
					<tr>
						<td class="Estilo2titulo" colspan="10">RECEPCION CONFORME</td>
					</tr>
				</table>

				<table border="0" width="100%">
					<tr>
						<td class="Estilo1">TIPO RECEPCION</td>
						<td class="Estilo1">
							<select name="tipo_recepcion" id="tipo_recepcion" class="Estilo2" onChange="tipoRecepcion(this.value)">
								|	<?php if ($row["rc_tipo"] == ""): ?>
								<option selected value="">Seleccionar...</option>
								<option value="CORREO ELECTRONICO">CORREO ELECTRONICO</option>
								<option value="RECEPCION CONFORME INTERNA">RECEPCION CONFORME INTERNA</option>
								<option value="MEMORANDUM">MEMORANDUM</option>
								<option value="GUIA DESPACHO">GUIA DESPACHO</option>
							<?php else: ?>
								<option value="">Seleccionar...</option>
								<option selected value="<?php echo $row["rc_tipo"] ?>"><?php echo $row["rc_tipo"] ?></option>
								<option value="CORREO ELECTRONICO">CORREO ELECTRONICO</option>
								<option value="RECEPCION CONFORME INTERNA">RECEPCION CONFORME INTERNA</option>
								<option value="MEMORANDUM">MEMORANDUM</option>
								<option value="GUIA DESPACHO">GUIA DESPACHO</option>
							<?php endif ?>
						</select>
					</td>

					<td class="Estilo1">UNIDAD O SECCION</td>
					<td class="Estilo1">
						
						<input type="text" name="unidad_que_recibe" id="unidad_que_recibe" class="<?php if($detalle["ing_guiaemisorrc"] <> ''){echo"bloqueado";}?>" <?php echo $detalle["ing_guiaemisorrc"] <> '' ? "value='".$bodegas[$_SESSION["region"]]."'" : '' ?>>
						<!-- <?php //if ($row["rc_unidad"] == ""): ?>
							<input type="text" name="unidad_que_recibe" id="unidad_que_recibe"/>
						<?php //else: ?>
							<input type="text" name="unidad_que_recibe" id="unidad_que_recibe" value="<?php //echo $row["rc_unidad"] ?>" />
						<?php //endif ?> -->
					
				</td>
			</tr>

			<tr>
				<td class="Estilo1">FECHA RECEPCION</td>
				<td class="Estilo1">
					<input type="text" name="recepcion_fecha" id="recepcion_fecha" class="Estilo2" style="background-color: rgb(235, 235, 228)" readonly value="<?php echo $detalle["ing_guiafecharc"] ?>">
					<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
					<script type="text/javascript">
						Calendar.setup({
							inputField   :  "recepcion_fecha",
							ifFormat    :  "%d-%m-%Y",
							button     :  "f_trigger_c3",
							align     :  "Bl",
							singleClick  :  true
						});
					</script>
				</td>

				<td class="Estilo1">CONTACTO</td>
				<td class="Estilo1">
					<!-- <input type="text" name="recepcion_contacto" id="recepcion_contacto" class="Estilo2" value="<?php //echo $row["rc_contacto"] ?>"> -->
					<input type="text" name="recepcion_contacto" id="recepcion_contacto" class="<?php if($detalle["ing_guiaemisorrc"] <> ''){echo"bloqueado";}?>" <?php echo $detalle["ing_guiaemisorrc"] <> '' ? "value='".$detalle["ing_aprobado"]."'" : '' ?>>
				</td>
			</tr>

			<tr>
				<?php if ($row["rc_tipo"] == "GUIA DESPACHO"): ?>
					<td class="Estilo1">N° GUIA</td>
					<td class="Estilo1"><input type="text" name="numero_guia" id="numero_guia" class="Estilo2" value="<?php echo $row["rc_numero"] ?>"></td>
				<?php else: ?>
					<td class="Estilo1 guiaDespacho">N° GUIA</td>
					<td class="Estilo1 guiaDespacho"><input type="text" name="numero_guia" id="numero_guia" class="Estilo2" value="<?php echo $row["rc_numero"] ?>"></td>
				<?php endif ?>


				<td class="Estilo1">N° RECEPCION</td>
				<td class="Estilo1 nre"><input type="text" name="numero_recepcion" id="numero_recepcion" class="Estilo2 <?php if($detalle["ing_guiaemisorrc"] <> ''){echo"bloqueado";}?>" <?php echo $detalle["ing_guiaemisorrc"] <> '' ? "value='".$detalle["ing_guianumerorc"]."'" : '' ?>></td>
			</tr>

			<tr>
				<td class="Estilo1">OBSERVACION</td>
				<td class="Estilo1 nre"><textarea id="recepcion_obs" name="recepcion_obs" style="margin: 0px; width: 406px; height: 72px;"><?php echo $row["rc_obs"] ?></textarea></td>
			</tr>


			<tr>
				<td class="Estilo1">CANTIDAD</td>
				<td class="Estilo1"><input type="number" id="qty" name="qty" min="1" max="<?php echo $temp ?>" <?php if($detalle["ing_guiaemisorrc"] <> ""){echo"value='".$row["compra_cantidad"]."' readonly class='bloqueado'";}?>></td>
			</tr>

		</table>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo1c">
					<input type="submit" name="submit" class="Estilo2" size="11" value="  ENVIAR A INVENTARIO  " >
				</td>
			</tr>
		</table>

		<hr>
		<input type="hidden" name="id" value="<?php echo $_REQUEST["id"] ?>">
		<input type="hidden" name="compra_id" value="<?php echo $_REQUEST["compra_id"] ?>">
		<input type="hidden" name="qtyParcial" value="<?php echo $totalParcial ?>">
		<input type="hidden" name="qtyTotal" value="<?php echo $compra_cantidad ?>">
		<input type="hidden" name="doc_id" value="<?php echo $row["compra_doc_id"] ?>">
		<input type="hidden" name="ding_id" value="<?php echo $row["compra_ding_id"] ?>">
	</form>
<?php endif ?>

<?php endif ?>
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


		$(".nre").attr("colspan",3);
		$(".guiaDespacho").hide();
	})
	function tipoRecepcion(input)
	{
		if(input == "GUIA DESPACHO") {
			$(".guiaDespacho").show();
			$("#numero_guia").val("");

		}else{
			$(".nre").attr("colspan",4);
			$(".guiaDespacho").hide();
		}
	}

	function validar(){
		var guiaDespacho = false;

		if(document.getElementById("tipo_recepcion").value == "") {
			alert("SELECCIONAR EL TIPO DE RECEPCION");
			document.getElementById("tipo_recepcion").focus();
			return false;
		}else{

			if(document.getElementById("tipo_recepcion").value == "GUIA DESPACHO") {
				guiaDespacho = true;
			}
		}

		if(guiaDespacho == true) {
			if(document.getElementById("unidad_que_recibe").value == ""){
				alert("INGRESAR LA UNIDAD QUE RECIBE");
				document.getElementById("unidad_que_recibe").focus();
				return false;
			}else if(document.getElementById("recepcion_fecha").value == ""){
				alert("INGRESAR LA FECHA DE RECEPCION");
				document.getElementById("recepcion_fecha").focus();
				return false;
			}else if(document.getElementById("recepcion_contacto").value == ""){
				alert("INGRESAR EL CONTACTO");
				document.getElementById("recepcion_contacto").focus();
				return false;
			}else if(document.getElementById("numero_guia").value == ""){
				alert("INGRESAR EL NUMERO DE GUIA");
				document.getElementById("numero_guia").focus();
				return false;
			}else if(document.getElementById("numero_recepcion").value == ""){
				alert("INGRESAR EL NUMERO DE RECEPCION");
				document.getElementById("numero_recepcion").focus();
				return false;
			}else if(document.getElementById("recepcion_obs").value == ""){
				alert("INGRESAR UNA OBSERVACION");
				document.getElementById("recepcion_obs").focus();
				return false;
			}else if(document.getElementById("qty").value == ""){
				alert("SELECCIONAR LA CANTIDAD A INGRESAR");
				document.getElementById("qty").focus();
				return false;
			}else{
				blockUI();
				return true;
			}

		}else{
			$("#numero_guia").val("SIN N° GUIA");
			if(document.getElementById("unidad_que_recibe").value == ""){
				alert("INGRESAR LA UNIDAD QUE RECIBE");
				document.getElementById("unidad_que_recibe").focus();
				return false;
			}else if(document.getElementById("recepcion_fecha").value == ""){
				alert("INGRESAR LA FECHA DE RECEPCION");
				document.getElementById("recepcion_fecha").focus();
				return false;
			}else if(document.getElementById("recepcion_contacto").value == ""){
				alert("INGRESAR EL CONTACTO");
				document.getElementById("recepcion_contacto").focus();
				return false;
			}else if(document.getElementById("numero_recepcion").value == ""){
				alert("INGRESAR EL NUMERO DE RECEPCION");
				document.getElementById("numero_recepcion").focus();
				return false;
			}else if(document.getElementById("recepcion_obs").value == ""){
				alert("INGRESAR UNA OBSERVACION");
				document.getElementById("recepcion_obs").focus();
				return false;
			}else if(document.getElementById("qty").value == ""){
				alert("SELECCIONAR LA CANTIDAD A INGRESAR");
				document.getElementById("qty").focus();
				return false;
			}else{
				blockUI();
				return true;
			}


		}

	}

	function cantidad(){
		if(document.getElementById("qty").value == ""){
			alert("SELECCIONAR LA CANTIDAD A INGRESAR");
			document.getElementById("qty").focus();
			return false;
		}else{
			return true;
		}
	}

	function validar2(){

		if(document.getElementById("solicitud_fecha").value == ""){
			alert("INGRESE FECHA SOLICITUD DE COMPRA");
			document.getElementById("solicitud_fecha").focus();
			return false;
		}else if(document.getElementById("solicitud_numero").value == ""){
			alert("INGRESE LA SOLICITUD DE COMPRA");
			document.getElementById("solicitud_numero").focus();
			return false;
		}else{
			blockUI();
			return true;
		}

	}

	function validar3(){

		var oc1 = $("#oc1").val();
		var oc2 = $("#oc2").val();
		var oc3 = $("#oc3").val();

		if(document.getElementById("oc_fecha").value == ""){
			alert("INGRESE FECHA ORDEN DE COMPRA");
			document.getElementById("oc_fecha").focus();
			return false;
		}else if(oc1 == ""){
			alert("INGRESE PREFIJO DE SU REGION");
			$("#oc1").focus();
			return false;
		}else if (oc2 == ""){
			alert("INGRESE CORRELATIVO DE LA ORDEN DE COMPRA");
			$("#oc2").focus();
			return false;
		}else if(oc3 == ""){
			alert("INGRESE SUFIJO DE LA ORDEN DE COMPRA");
			$("#oc3").focus();
			return false;
		}else{
			blockUI();
			return true;
		}

		/*if(document.getElementById("oc_fecha").value == ""){
			alert("INGRESE FECHA ORDEN DE COMPRA");
			document.getElementById("oc_fecha").focus();
			return false;
		}else if(document.getElementById("oc_numero").value == ""){
			alert("INGRESE LA ORDEN DE COMPRA");
			document.getElementById("oc_numero").focus();
			return false;
		}else{
			return true;
		}*/
	}

	function validaOrden()
	{
		var oc1 = $("#oc1").val();
		var oc2 = $("#oc2").val();
		var oc3 = $("#oc3").val();

		if(oc1 == ""){
			alert("INGRESE PREFIJO DE SU REGION");
			$("#oc1").focus();
		}else if (oc2 == ""){
			alert("INGRESE CORRELATIVO DE LA ORDEN DE COMPRA");
			$("#oc2").focus();
		}else if(oc3 == ""){
			alert("INGRESE SUFIJO DE LA ORDEN DE COMPRA");
			$("#oc3").focus();
		}else{
			var oc = oc1+"-"+oc2+"-"+oc3;
			var data = ({cmd : "validaOrden", oc_numero : oc});
			$.ajax({
				type:"POST",
				url:"validaOrden.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					console.log(response);
					return false;
					if(response == true)
					{
						alert("LA ORDEN DE COMPRA '" + oc + "' EXISTE EN EL SISTEMA");
						$("#oc1").val("");
						$("#oc2").val("");
						$("#oc3").val("");
						document.getElementById("oc1").focus();

					}
				}
			})
		}
}
</script>
