<?php
$proveedor = "SELECT * FROM bode_transporte a INNER JOIN acti_proveedor b ON b.proveedor_id = a.transporte_empresa_id AND a.transporte_estado = 1";
$proveedor = mysql_query($proveedor);

if($submit == "limpiar")
{
	$_SESSION["lista"] = array();
	echo "<script>window.location.href='bode_desp.php?cod=46';</script>";
}

if($_REQUEST["action"] == "eliminar")
{

	foreach ($_SESSION["lista"] as $key => $value) {
		if($value["oc_id"] == $_REQUEST["id"])
		{
			unset($_SESSION["lista"][$key]);
			break;
		}
	}
}

?>
<!-- FORMULARIO DE GENERACION DE DOCUMENTO -->
<div  style="width:630px; background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">
<table border="1" width="100%">
	<tr>
		<td class="Estilo2titulo" colspan="4"><center>GUIAS DE DESPACHO AÑADIDAS</center></td>
	</tr>

	<tr>
		<td class="Estilo1mc"></td>
		<td class="Estilo1mc">OC ID</td>
		<td class="Estilo1mc">N° FOLIO</td>
		<td class="Estilo1mc">ELIMIMAR</td>
	</tr>

	<tbody>
	<?php $contador=1; ?>
		<?php foreach ($_SESSION["lista"] as $key => $value): ?>
			<tr>
				<td class="Estilo1mc"><?php echo $contador ?></td>
				<td class="Estilo1mc"><?php echo $value["oc_id"] ?></td>
				<td class="Estilo1mc"><?php echo $value["oc_folioguia"] ?></td>
				<td class="Estilo1mc"><a href="bode_desp.php?ori=3&action=eliminar&id=<?php echo $value["oc_id"]?>"><i class="link fa fa-trash fa-lg"></i></td>
			</tr>
			<?php $contador++; ?>
		<?php endforeach ?>
		<tr>
			<td colspan="4" align="right">
			<form action="<?php echo $_SESSION["PHP_SELF"] ?>" method="POST">
				<button type="submit">Limpiar <i class="fa fa-trash-o"></i></button>
			<input type="hidden" name="submit" value="limpiar">
			</form>
		</tr>
	</tbody>
</table>

<hr>
<form action="bode_dest_gr.php" method="POST" onSubmit="return valida()">
<table border="1" width="100%">
	<tr>
		<td class="Estilo1">EMPRESA</td>
		<td class="Estilo1">
			<select class="Estilo1" name="empresa_id" id="empresa_id" onChange="getPatente(this.value)">
				<option value="" selected>Seleccionar...</option>
				<?php
				while($row = mysql_fetch_array($proveedor)) {
					?>
					<option value="<?php echo $row["transporte_empresa_id"] ?>"><?php echo $row["proveedor_glosa"] ?></option>
					<?php } ?>
				</select>
				<a href="bode_desp_agrega_e.php" class="empresa"><i class="fa fa-plus link"></i></a>
			</td>
		</tr>

		<tr>
			<td class="Estilo1">CHOFER</td>
			<td class="Estilo1">
				<select class="Estilo1" id="chofer" name="chofer">
					<option value="">Seleccionar...</option>
				</select>
				<a href="bode_desp_agrega_c.php" class="chofer"><i class="fa fa-plus link"></i></a>
			</td>
		</tr>

		<tr>
			<td class="Estilo1">PATENTE</td>
			<td class="Estilo1">
					<select class="Estilo1" id="patente" name="patente">
						<option value="">Seleccionar...</option>
					</select>
				<a href="bode_desp_agrega_p.php" class="patente"><i class="fa fa-plus link"></i></a>
			</td>
		</tr>

		<tr>
			<td class="Estilo1">OBSERVACIONES</td>
			<td class="Estilo1">
				<?php if ($gd["oc_observaciones"] <> ""): ?>
					<textarea name="obs" id="obs" style="margin: 0px; width: 465px; height: 153px;" disabled><?php echo $gd["oc_observaciones"] ?></textarea>
				<?php else: ?>
					<textarea name="obs" id="obs" style="margin: 0px; width: 465px; height: 153px;"></textarea>
				<?php endif ?>
			</td>
		</tr>
		<?php if (count($_SESSION["lista"]) > 0): ?>
			<tr>
				<td class="Estilo1"></td>
				<td class="Estilo1">
				<button type="submit" name="submit" value="grabaLista">Grabar</button>
				</td>
			</tr>
		<?php endif ?>
	</table>
	</form>
</div>
<script src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript">

	jQuery('.empresa').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=700, height=350, top=100, left=200, toolbar=1');
	});

	jQuery('.chofer').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=700, height=350, top=100, left=200, toolbar=1');
	});

	jQuery('.patente').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=700, height=350, top=100, left=200, toolbar=1');
	});

</script>	