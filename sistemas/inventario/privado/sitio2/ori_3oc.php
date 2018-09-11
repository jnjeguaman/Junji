<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">
	<form name="form2" action="#" method="post"   onSubmit="return validar2()"  enctype="multipart/form-data">
		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">DISTRIBUCIÓN</td>
			</tr>

			<tr>
				<td  valign="center" class="Estilo1">REGIÓN</td>
				<td  class="Estilo1">
					<select name="region_distribucion[]" id="region_distribucion" class="Estilo2" multiple style="height=400px;" size="11">
						<option selected value="">Seleccione...</option>
						<?php
						while($row = mysql_fetch_array($sqlRegionResp)) {
							?>
							<option value="<?php echo $row["region_glosa"] ?>"><?php echo $row["region_glosa"] ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</table>

			<table border=0 width="100%">
				<tr>
					<td  class="Estilo1c">
						<input type="submit" class="Estilo2" size="11" value="Generar Distribución">
					</td>
				</tr>
			</table>
			<input type="hidden" name="generarDistribucion" value="1">
		</form>
	</div>

	<?php if (intval($generarDistribucion) === 1): ?>
		<div  style="width:630px; height:280px; background-color:#E0F8E0; position:absolute; top:340px; left:850px;" id="div2">
			<form name="form2" action="inv_graba_distribucion.php" method="post"   onSubmit="return validar2()"  enctype="multipart/form-data">
				<table border=0 width="100%">
					<tr>
						<td  class="Estilo2titulo" colspan="10">DISTRIBUCIÓN</td>
					</tr>
					<?php foreach ($_REQUEST["region_distribucion"] as $key => $value): ?>
						<tr>
							<td  valign="center" class="Estilo1"><?php echo $value ?></td>
							<td  class="Estilo1">
								<input type="text" name="<?php echo $value ?>" class="Estilo2" size="2">
							</td>
						</tr>
					<?php endforeach ?>
				</table>

				<table border=0 width="100%">
					<tr>
						<td  class="Estilo1c">
							<input type="submit" class="Estilo2" size="11" value="ACTIVAR">
						</td>
					</tr>
				</table>
				<input type="hidden" name="compra_id" value="<?php echo $_REQUEST["id"] ?>">
			</form>
		</div>
	<?php endif ?>