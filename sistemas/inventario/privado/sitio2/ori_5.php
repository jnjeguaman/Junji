<?php 
$sql = "SELECT * FROM acti_compra WHERE id = ".$_REQUEST["id"];
$sqlResp = mysql_query($sql);
$row = mysql_fetch_array($sqlResp);
$id = $row["compra_id"];
$compra_cantidad = $row["compra_cantidad"];

?>
<div style="width:640px; background-color:#E0F8E0; position:absolute; top:120px; left:710px;" id="div2">
	<form name="form1" action="inv_actualiza_recepcion.php" method="post"  onSubmit="return validar()">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">RECEPCION CONFORME</td>
			</tr>
		</table>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo1">PROGRAMA</td>
				<td class="Estilo1"><input type="text" disabled="1" value="<?php echo $row["compra_programa"] ?>" class="Estilo2"></td>

				<td class="Estilo1">PROVEEDOR</td>
				<td class="Estilo1"><input type="text" disabled="1" value="<?php echo $row["compra_proveedor"] ?>" class="Estilo2"></td>
			</tr>

			<tr>
				<td class="Estilo1">RESPONSABLE COMPRA</td>
				<td class="Estilo1"><input type="text" disabled="1" value="<?php echo $row["compra_responsable"] ?>" class="Estilo2"></td>

				<td class="Estilo1">TIPO DE COMPRA</td>
				<td class="Estilo1"><input type="text" disabled="1" value="<?php echo $row["compra_tipo_compra"] ?>" class="Estilo2"></td>
			</tr>

		</table>


	</form>
	<hr>
	<?php 
	$query = "SELECT * FROM acti_recepcion a INNER JOIN acti_compra b ON a.rece_compra_id = b.id WHERE a.rece_compra_id = ".$_REQUEST["id"];
	$query = mysql_query($query);
	?>
	<table border=0 width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">RECEPCION</td>
		</tr>
	</table>

	<table border="0" width="100%">
		<thead>
			<th class="Estilo1mc">ID</th>
			<th class="Estilo1mc">CANTIDAD</th>
			<th class="Estilo1mc">USUARIO</th>
			<th class="Estilo1mc">FECHA REGISTRO</th>
			<th class="Estilo1mc">HORA REGISTRO</th>
			<th class="Estilo1mc">BIEN</th>
		</thead>
		<tbody>
			<?php while($row = mysql_fetch_array($query)) { ?>
			<tr>
				<td class="Estilo1mc"><?php echo $row["rece_id"] ?></td>
				<td class="Estilo1mc"><?php echo $row["rece_cantidad"] ?></td>
				<td class="Estilo1mc"><?php echo $row["rece_user"] ?></td>
				<td class="Estilo1mc"><?php echo $row["rece_fechasys"] ?></td>
				<td class="Estilo1mc"><?php echo $row["rece_horasys"] ?></td>
				<td class="Estilo1mc"><?php echo $row["compra_glosa"] ?></td>
			</tr>	
			<?php } ?>
		</tbody>
	</table>

</div>