<?php
$regiones = array(1 => "I REGION" ,2 => "II REGION" ,3 => "III REGION" ,4 => "IV REGION" ,5 => "V REGION" ,6 => "VI REGION" ,7 => "VII REGION" ,8 => "VIII REGION" ,9 => "IX REGION" ,10 => "X REGION" ,11 => "XI REGION" ,12  => "XII REGION" ,13 => "REGION METROPOLITANA",14 => "XIV REGION",15 => "XV REGION",16 => "DIRECCION NACIONAL");
$sql = "SELECT compra_cantidad FROM acti_compra_temporal WHERE id = ".$id;
$sql = mysql_query($sql);
$sql = mysql_fetch_array($sql);
$sql = intval($sql["compra_cantidad"]);
?>

<div style="width:540px; background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">
	<form action="inv_graba_distribucion.php" method="post" onSubmit="blockUI()">
		<table border="0" width="100%">
			<tr>
				<td colspan="2" class="Estilo2titulo">DISTRIBUCIÓN</td>
			</tr>

			<tr>
				<td  valign="center" class="Estilo1">TIPO DISTRIBUCION</td>
				<td  class="Estilo1">
					<select name="region_distribucion" id="region_distribucion" class="Estilo2" style="height=500px;">
						<?php if (intval($_SESSION["region"]) === 16): ?>
							<option selected >DIRECCION NACIONAL</option>
						<?php else: ?>
							<option selected>MIXTA</option>
						<?php endif ?>
					</select>

				</td>
			</tr>

			<tr>
				<td  valign="center" class="Estilo1">REGION</td>
				<td  class="Estilo1">
					<select name="region_distribucion" id="region_distribucion" class="Estilo2">
						<option selected value="<?php echo $regiones[$_SESSION["region"]] ?>"><?php echo $regiones[$_SESSION["region"]] ?></option>
					</select>
				</td>
			</tr>

			<tr>
				<td class="Estilo1">CANTIDAD</td>
				<td  class="Estilo1"><input type="text" name="total" class="Estilo1" value="<?php echo $sql ?>" size="4" readonly style="background-color: rgb(235, 235, 228)"></td>
			</tr>

		</table>
		<br>
		<table border="0" width="100%">
			<tr>
				<td  class="Estilo1c" colspan="2">
					<input type="submit" class="Estilo2" size="11" value="DISTRIBUIR">
				</td>
			</tr>
		</table>
		<input type="hidden" name="region" value="<?php echo $regiones[$_SESSION["region"]] ?>">
		<input type="hidden" name="compra_id" value="<?php echo $_REQUEST["id"] ?>">
	</form>
</div>

<?php  //require("ultimas_compras2.php") ?>