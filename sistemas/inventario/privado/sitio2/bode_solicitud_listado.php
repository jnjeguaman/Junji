<?php 
$atributo = $_SESSION["atributo1"];
$color = 'style="background-color:greenyellow;"';
$regionSession = $_SESSION["region"];
if($regionSession == 16)
{
	$region = "(sp_region = 16 OR sp_region = 13)";
}else{
	$region = "sp_region = ".$region;
}
if($Destino <> "")
{
	$where2.=" AND sp_destino = '".$Destino."'";
}

// SI EL USUARIO ES DE INVENTARIO VE LAS SOLICITUDES INDICADAS
// PERFILES DE INVENTARIO REGIONAL , DIRECCION NACIONAL Y ESPECIALES
if($atributo == 35 || $atributo == 38 || $atributo == 50)
{
	$sql2 = "SELECT * FROM bode_solicitud WHERE sp_estado = 1 AND ".$region.$where2." AND sp_tipo_bien = 1 AND sp_aprobacion = 0";
// PERFILES DE LOGISTICA DIRECCION NACIONAL Y REGIONAL
}else if($atributo == 37 || $atributo == 39)
{
	$sql2 = "SELECT * FROM bode_solicitud WHERE sp_estado = 1 AND ".$region.$where2." AND (sp_tipo_bien = 1 OR sp_tipo_bien = 0 OR sp_tipo_bien = 2)";
}

$res2 = mysql_query($sql2);
$contador = 1;

if($atributo == 35 || $atributo == 38 || $atributo == 50)
{
	$sql3 = "SELECT distinct(sp_destino) as Destino FROM bode_solicitud WHERE sp_estado = 1 AND ".$region." AND sp_tipo_bien = 1 AND sp_aprobacion = 0";
}else if($atributo == 37 || $atributo == 39)
{
	$sql3 = "SELECT distinct(sp_destino) as Destino FROM bode_solicitud WHERE sp_estado = 1 AND ".$region." AND (sp_tipo_bien = 1 OR sp_tipo_bien = 0 OR sp_tipo_bien = 2) AND sp_aprobacion = 1";
}
$res3 = mysql_query($sql3);


?>
<table border="1" width="100%">
	<tr>
		<td class="Estilo2titulo" colspan="2">Filtros</td>
	</tr>

	<tr>
		<td class="Estilo1mc">DESTINO</td>
		<td class="Estilo1mc">
			<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
				<select name="Destino" onChange="this.form.submit()" class="Estilo1">
					<option value="">Seleccionar...</option>
					<?php while($row3 = mysql_fetch_array($res3)) { ?>
					<option value="<?php echo $row3["Destino"] ?>" <?php if($Destino == $row3["Destino"]){echo"selected";} ?> ><?php echo $row3["Destino"] ?></option>
					<? } ?>
				</select>	
			</form>
		</td>
	</tr>

	<tr>
		<td class="Estilo1mc">N° PEDIDO</td>
		<td class="Estilo1mc"><input type="text" name="n_pedido" id="n_pedido" class="Estilo2mc"></td>
	</tr>
</table>
<hr>
<table border="1" width="100%">
	<tr>
		<td class="Estilo2titulo" colspan="7">SOLICITUDES PENDIENTES</td>
	</tr>

	<tr>
		<td class="Estilo1mc">#</td>
		<td class="Estilo1mc">N° PEDIDO</td>
		<td class="Estilo1mc">SOLICITANTE</td>
		<td class="Estilo1mc">DESTINO</td>
		<td class="Estilo1mc">FECHA SOLICITUD</td>
		<td class="Estilo1mc">VER</td>
		<td class="Estilo1mc">DETALLE</td>
	</tr>

	<?php while($row2 = mysql_fetch_array($res2)) { ?>
	<?php 
	if($row2["sp_tipo_destino"] == 3)
	{
		$sql4 = "SELECT * FROM jardines WHERE jardin_codigo = ".$row2["sp_destino"]." AND jardin_estado = 1 LIMIT 1";
		$res4 = mysql_query($sql4);
		$row4 = mysql_fetch_array($res4);
	}
	?>
	<tr <?php if($id==$row2["sp_id"]){echo$color;} ?>>
		<td class="Estilo1mc"><?php echo $contador ?></td>
		<td class="Estilo1mc"><?php echo $row2["sp_folio"] ?></td>
		<td class="Estilo1mc"><?php echo $row2["sp_usuario"] ?></td>
		<td class="Estilo1mc"><?php echo ($row2["sp_tipo_destino"] == 2) ? $row2["sp_destino"] : $row2["sp_destino"]." / ".$row4["jardin_nombre"] ?></td>
		<td class="Estilo1mc"><?php echo $row2["sp_fecha"] ?></td>
		<?php if ($row2["sp_aprobacion"] == 0): ?>
			<?php if ($atributo == 35 || $atributo == 38 || $atributo == 50): ?>
				<td class="Estilo1mc"><a href="bode_inv_indexoc4.php?cmd=Solicitudes&ori=1&id=<?php echo $row2["sp_id"] ?>&folio=<?php echo $row2["sp_folio"] ?>&region=<?php echo $row2["sp_region"] ?>" class="link"><i class="fa fa-eye"></i></td>
				<td class="Estilo1mc"><a href="bode_inv_indexoc4.php?cmd=Solicitudes&ori=2&regiondestino=<?php echo $row2["sp_region_destino"] ?>&tipo=<?php echo $row2["sp_tipo_destino"] ?>&id=<?php echo $row2["sp_id"] ?>" class="link"><i class="fa fa-globe"></i></a></td>
			<?php else: ?>
				<td class="Estilo1mc" colspan="2" style="background-color: red;color:#FFF">FALTA APROBACION DE INVENTARIO</td>
			<?php endif ?>
		<?php else: ?>
			<td class="Estilo1mc"><a href="bode_inv_indexoc4.php?cmd=Solicitudes&ori=1&id=<?php echo $row2["sp_id"] ?>&folio=<?php echo $row2["sp_folio"] ?>&region=<?php echo $row2["sp_region"] ?>" class="link"><i class="fa fa-eye"></i></td>
			<td class="Estilo1mc"><a href="bode_inv_indexoc4.php?cmd=Solicitudes&ori=2&regiondestino=<?php echo $row2["sp_region_destino"] ?>&tipo=<?php echo $row2["sp_tipo_destino"] ?>&id=<?php echo $row2["sp_id"] ?>" class="link"><i class="fa fa-globe"></i></a></td>
		<?php endif ?>
	</tr>
	<?php $contador++;} ?>
</table>