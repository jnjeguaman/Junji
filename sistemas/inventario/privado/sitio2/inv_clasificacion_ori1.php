<?php
if($_SESSION["region"] <> 16)
{
	$qreg = "SELECT * FROM acti_region WHERE region_estado = 1 AND region_id = ".$_SESSION["region"];
}else{
$qreg = "SELECT * FROM acti_region WHERE region_estado = 1";
}
$rreg = mysql_query($qreg);
$regs = array();
while($rowreg = mysql_fetch_array($rreg))
{
	$regs[] = $rowreg;
}
?>

<tr>
	<td class="Estilo1mc">ORDEN DE COMPRA</td>
	<td class="Estilo1"><input type="text" name="oc" id="oc" value="<?php echo $oc ?>"></td>

	<td class="Estilo1mc">N° GUIA / FACTURA</td>
	<td class="Estilo1"><input type="text" name="nguia" id="nguia" value="<?php echo $nguia ?>"></td>
</tr>

<tr>
	<td class="Estilo1mc">APROBADO POR</td>
	<td class="Estilo1"><input type="text" name="aprobado" id="aprobado" value="<?php echo $aprobado ?>"></td>

	<?php if ($_SESSION["region"] == 16): ?>
		<td class="Estilo1mc">REGION</td>
	<td class="Estilo1">
		<select class="Estilo1" name="region" id="region">
			<option value="" selected>Seleccionar...</option>
			<?php foreach ($regs as $key => $value): ?>
				<option value="<?php echo $value["region_id"] ?>" <?php if($_GET["region"] == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
			<?php endforeach ?>
			<?php if ($_SESSION["region"] == 16): ?>
				<option value="17" <?php if($_GET["region"] == 17){echo"selected";}?>>NACIONAL</option>
			<?php endif ?>
		</select>
	</td>
	<?php endif ?>
</tr>

<tr>
	<td class="Estilo1mc">GRUPO</td>
	<td class="Estilo1">
		<select class="Estilo1" name="grupo" id="grupo">
			<option value="" selected>Seleccionar...</option>
			<?php foreach ($grupos as $key => $value): ?>
				<option value="<?php echo $value["param_glosa"] ?>" <?php if($grupo == $value["param_glosa"]){echo"selected";}?>><?php echo $value["param_desc"] ?></option>
			<?php endforeach ?>
		</select>
	</td>
</tr>

<tr>
	<td class="Estilo1" colspan="4" style="text-align:center">
		<button type="submit" name="submit" id="submit" value="avanzada">BUSCAR <i class="fa fa-search"></i></button>
		<a href="inv_clasificacion.php?ori=1">LIMPIAR</a> | <a href="inv_clasificacion.php">BUSQUEDA NORMAL</a>
	</td>
</tr>
<input type="hidden" name="ori" value="1">
