<?php
$zonas = array();
$subzona = array();
$zq = "SELECT DISTINCT(zona_glosa) FROM acti_zona WHERE zona_estado = 1 AND zona_region = ".$_SESSION["region"];
$rzq = mysql_query($zq);
while($row = mysql_fetch_array($rzq))
{
	$zonas[] = $row;
}

$sq = "SELECT DISTINCT(acti_subzona_glosa) FROM acti_subzona WHERE acti_subzona_estado = 1 AND acti_subzona_region = ".$_SESSION["region"];
$rsq = mysql_query($sq);
while($row = mysql_fetch_array($rsq))
{
	$subzona[] = $row;
}
?>
<table border="0" width="100%">
	<tr>
		<td class="Estilo2titulo" colspan="10">BÚSQUEDA AVANZADA</td>
	</tr>
</table>
<hr>
<table border="1" width="100%">
	<tr>
		<td class="Estilo1">CODIGO DE INVENTARIO</td>
		<td class="Estilo1"><input type="text" name="a_cinventario" id="a_cinventario" value="<?php echo $a_cinventario ?>"></td>

		<td class="Estilo1">FUNCIONARIO RESPONSABLE</td>
		<td class="Estilo1"><input type="text" name="a_fresponsable" id="a_fresponsable" value="<?php echo $a_fresponsable ?>"></td>
	</tr>

	<tr>
		<td class="Estilo1">DIRECCION</td>
		<td class="Estilo1">
			<select class="Estilo1" name="a_direccion" id="a_direccion">
				<option value="">Seleccionar...</option>
				<?php foreach ($zonas as $key => $value): ?>
					<?php
					$temp = explode(" ",$value["zona_glosa"]); 
					if($temp[0] == "JI")
					{
						$direccion = mysql_query("SELECT jardin_nombre FROM jardines WhERE jardin_codigo = ".$temp[1]);
						$direccion = mysql_fetch_array($direccion);
						?>
						<option value="<?php echo $value["zona_glosa"] ?>" <?php if($value["zona_glosa"] == $a_direccion){echo"selected";}?> ><?php echo $value["zona_glosa"]." - ".$direccion["jardin_nombre"] ?></option>
					<?php } else { ?>
					<option value="<?php echo $value["zona_glosa"]?>" <?php if($a_direccion == $value["zona_glosa"]){echo"selected";}?>><?php echo $value["zona_glosa"]?></option>
					<?php } ?>
					
				<?php endforeach ?>
			</select>
		</td>

		<td class="Estilo1">ZONA</td>
		<td class="Estilo1">
			<select class="Estilo1" name="a_zona" id="a_zona">
				<option value="">Seleccionar...</option>
				<?php foreach ($subzona as $key => $value): ?>
					<option value="<?php echo $value["acti_subzona_glosa"]?>" <?php if($a_zona == $value["acti_subzona_glosa"]){echo"selected";}?>><?php echo $value["acti_subzona_glosa"]?></option>
				<?php endforeach ?>
			</select>
		</td>
	</tr>

	<tr>
		<td class="Estilo1">CUENTA CONTABLE</td>
		<td class="Estilo1">
			<select class="Estilo1" name="a_ccontable" id="a_ccontable">
				<option value="">Seleccionar...</option>
				<?php foreach ($ctaContable as $key => $value): ?>
					<option value="<?php echo $value["param_glosa"] ?>" <?php if($a_ccontable == $value["param_glosa"]){echo"selected";}?>><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
				<?php endforeach ?>
			</select>
		</td>

		<td class="Estilo1">ORDEN DE COMPRA</td>
		<td class="Estilo1"><input type="text" name="a_oc" id="a_oc" value="<?php echo $a_oc ?>"></td>
	</tr>

	<tr>
		<td class="Estilo1">AÑO DEVENGO (INGRESAR NÚMERO AAAA)</td>
		<td class="Estilo1">
			<input type="text" name="a_adevengo" id="a_adevengo" value="<?php echo $a_adevengo ?>">
			<i class="fa fa-calendar fa-lg link" id="f_trigger_c2" style="cursor:pointer;" title="Seleccionar Fecha"></i>
			<script type="text/javascript">
				Calendar.setup({
					inputField     :    "a_adevengo",
					ifFormat       :    "%Y",
					button         :    "f_trigger_c2",
					align          :    "Bl",
					singleClick    :    true
				});
			</script>
		</td>

		<td class="Estilo1">MES DEVENGO (INGRESAR NÚMERO MM/AAAA)</td>
		<td class="Estilo1">
			<input type="text" name="a_mdevengo" id="a_mdevengo" value="<?php echo $a_mdevengo ?>">
			<i class="fa fa-calendar fa-lg link" id="f_trigger_c3" style="cursor:pointer;" title="Seleccionar Fecha"></i>
			<script type="text/javascript">
				Calendar.setup({
					inputField     :    "a_mdevengo",
					ifFormat       :    "%m/%Y",
					button         :    "f_trigger_c3",
					align          :    "Bl",
					singleClick    :    true
				});
			</script>
		</td>
	</tr>

	<tr>
		<td class="Estilo1">ESTADO</td>
		<td class="Estilo1">
			<select class="Estilo1" name="a_estado" id="a_estado">
				<option value="">Seleccionar...</option>
				<?php foreach ($estados as $key => $value): ?>
					<option value="<?php echo $value["param_glosa"] ?>" <?php if($a_estado == $value["param_glosa"]){echo"selected";}?>><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
				<?php endforeach ?>
			</select>
		</td>

		<td class="Estilo1">PRODUCTO</td>
		<td class="Estilo1"><input type="text" name="a_bien" id="a_bien" value="<?php echo $a_bien ?>"></td>
	</tr>

	<tr>
		<td class="Estilo1">PROGRAMA</td>
		<td class="Estilo1">
			<select class="Estilo1" name="a_programa" id="a_programa">
				<option value="">Seleccionar...</option>
				<?php foreach ($programas as $key => $value): ?>
					<option value="<?php echo $value["param_glosa"] ?>" <?php if($a_programa == $value["param_glosa"]){echo"selected";}?>><?php echo $value["param_glosa"] ?></option>
				<?php endforeach ?>
			</select>
		</td>

		<td class="Estilo1">N° RESOLUCION BAJA / TRASLADO</td>
		<td class="Estilo1"><input type="text" name="a_res_baja" id="a_res_baja" value="<?php echo $a_res_baja ?>"></td>
	</tr>

	<tr>
		<td class="Estilo1">N° RECEPCION CONFORME</td>
		<td class="Estilo1"><input type="text" name="a_nro_rc" id="a_nro_rc" value="<?php echo $a_nro_rc ?>"></td>
	</tr>
	
	<tr>
		<td class="Estilo1" colspan="4" style="text-align:center">
			<button type="submit" name="submit" id="submit" value="avanzada">BUSCAR <i class="fa fa-search"></i></button> | <a href="inv_actualizacion.php?ori=1">LIMPIAR</a> | <a href="inv_actualizacion.php">BUSQUEDA NORMAL</a>
		</td>
	</tr>


</table>
<input type="hidden" name="ori" value="1">