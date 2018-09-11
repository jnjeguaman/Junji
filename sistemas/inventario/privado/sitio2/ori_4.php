<?php 
$sql = "SELECT * FROM acti_compra WHERE id = ".$_REQUEST["id"];
$sqlResp = mysql_query($sql);
$row = mysql_fetch_array($sqlResp);
$id = $row["compra_id"];
$compra_cantidad = $row["compra_cantidad"];

$totalParcial = "SELECT SUM(rece_cantidad) as Parcial FROM acti_recepcion WHERE rece_compra_id = ".$_REQUEST["id"];
$totalParcial = mysql_query($totalParcial);
$totalParcial = mysql_fetch_array($totalParcial);
$totalParcial = intval($totalParcial["Parcial"]);
?>
<form name="form1" action="inv_graba_recepcion.php" method="post">
	<div  style="width:540px; background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">
		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">RECEPCION CONFORME</td>
			</tr>
		</table>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo1">N° DE SOLICITUD</td>
				<td class="Estilo1"><input type="text" disabled="1" value="<?php echo $row["solicitud_numero"] ?>" class="Estilo2"></td>

				<td class="Estilo1">ORDEN DE COMPRA</td>
				<td class="Estilo1"><input type="text" disabled="1" value="<?php echo $row["oc_numero"] ?>" class="Estilo2"></td>
			</tr>

		</table>

		<input type="hidden" name="compra_dpto" value="<?php echo $row["compra_dpto"] ?>">
		<input type="hidden" name="id" value="<?php echo $_REQUEST["id"] ?>">
		<input type="hidden" name="compra_cantidad" value="<?php echo $compra_cantidad ?>">
		<hr>
		<?php if (intval($compra_cantidad) === intval($totalParcial) && $row["solicitud_numero"] != "" && $row["oc_numero"] != ""): ?>
			<table border="0" width="100%">
				<tr>
					<td  class="Estilo1c">
						<input type="submit" name="submit" class="Estilo2" size="11" value="    Grabar    " >
					</td>
				</tr>
			</table>
		<?php endif ?>
		<input type="hidden" name="id" value="<?php echo $_REQUEST["id"] ?>">
	</div>
</form>