<div  style="background-color:#E0F8E0; position:absolute; top:120px; left:810px;" id="div2">
	<form action="inv_actualizacion.php" method="POST" onsubmit="return validar()">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="8">INFORMACIÓN A ACTUALIZAR</td>
			</tr>
		</table>
		<hr>
		<table border="1" width="100%">
			<tr>
				<td class="Estilo1">CALIDAD ADMINISTRATIVA</td>
				<td class="Estilo1">
					<select class="Estilo1" name="inv_calidad" id="inv_calidad">
						<option selected value="">Seleccionar...</option>
						<?php foreach ($calidad as $key => $value): ?>
							<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
						<?php endforeach ?>
					</select>
				</td>

				<td class="Estilo1">ESTADO</td>
				<td class="Estilo1">
					<select class="Estilo1" name="inv_estadocosto" id="inv_estadocosto">
						<option selected value="">Seleccionar...</option>
						<?php foreach ($estados as $key => $value): ?>
							<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
						<?php endforeach ?>
					</select>
				</td>

				<td class="Estilo1">RESPONSABLE</td>
				<td class="Estilo1" colspan="3"><input type="text" name="inv_responsable" id="inv_responsable" value="<?php echo $inv_responsable ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">CENTRO RESPONSA</td>
				<td class="Estilo1" >
					<select name="responsa" id="responsa" class="Estilo1" onchange="getSubZona(this.value)">
						<option selected value="">Seleccionar...</option>
						<?php 
						while($row3 = mysql_fetch_array($sqlZonaResp)) { ?>
							<option value="<?php echo $row3["zona_glosa"] ?>" <?php if($row3["zona_glosa"] == $responsa){echo"selected";}?> ><?php echo $row3["zona_glosa"] ?></option>
						<?php } ?>
						</select>
					</td>

					<td class="Estilo1">ZONA</td>
					<td class="Estilo1" colspan="5">
						<select name="inv_zona" id="inv_zona" class="Estilo1">
							<option selected value="">Seleccionar...</option>
						</select>
					</td>
				</tr>

				<tr>
					<td class="Estilo1">GRUPO</td>
					<td class="Estilo1" >
						<select name="grupo" id="grupo" class="Estilo1" onchange="getSubCat(this.value)">
							<option selected value="">Seleccionar...</option>
							<?php 
							while($row4 = mysql_fetch_array($sqlGrupoRes)) { ?>
								<option value="<?php echo $row4["cat_id"] ?>" <?php if($row4["cat_nombre"] == $responsa){echo"selected";}?> ><?php echo $row4["cat_nombre"] ?></option>
								<?php } ?>
							</select>
						</td>

						<td class="Estilo1">SUB-GRUPO</td>
						<td class="Estilo1" colspan="5">
							<select name="subgrupo" id="subgrupo" class="Estilo1">
								<option selected value="">Seleccionar...</option>
							</select>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">COMPROBANTE EGRESO</td>
						<td class="Estilo1"><input type="text" class="Estilo1"  id="inv_comprobante_egreso" name="inv_comprobante_egreso" value="<?php echo $inv_comprobante_egreso ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>

						<td class="Estilo1">FECHA DEVENGO</td>
						<td class="Estilo1">
							<input type="text" class="Estilo1"  id="inv_devengofecha" name="inv_devengofecha" value="<?php echo $inv_devengofecha ?>" readonly style="background-color: rgb(235, 235, 235)">
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
						</td>

						<td class="Estilo1">CUENTA CONTABLE</td>
						<td class="Estilo1" colspan="3">
							<select class="Estilo1" id="inv_cta_contable" name="inv_cta_contable">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($ctaContable as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
								<?php endforeach ?>
							</select>
						</td>

					</tr>

					<tr> 
						<td class="Estilo1">NUMERO FACTURA</td>
						<td class="Estilo1"><input type="text" class="Estilo1" id="inv_num_factura" name="inv_num_factura" value="<?php echo $inv_num_factura ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>

						<td class="Estilo1">FECHA FACTURA</td>
						<td class="Estilo1">

							<input type="text" class="Estilo1" id="inv_fecha_factura" name="inv_fecha_factura" value="<?php echo $inv_fecha_factura ?>" readonly style="background-color: rgb(235, 235, 235)">
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
						</td>

						<td class="Estilo1">AÑO ADQUISICION</td>
						<td class="Estilo1" colspan="3"><input type="text" class="Estilo1" id="inv_anno" name="inv_anno" value="<?php echo $inv_anno ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>

					<tr> 
						<td class="Estilo1">RES. ALTA</td>
						<td class="Estilo1">
							<input type="text" class="Estilo2" id="inv_altares" name="inv_altares" value="<?php echo $inv_altares ?>">
						</td>

						<td class="Estilo1">FECHA RES. ALTA</td>
						<td class="Estilo1">

							<input type="text" class="Estilo1" id="inv_altafecha" name="inv_altafecha" value="<?php echo $inv_altafecha ?>" readonly style="background-color: rgb(235, 235, 235)">
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
						</td>

						<td class="Estilo1">RES. BAJA</td>
						<td class="Estilo1">
							<input type="text" class="Estilo2" id="inv_baja" name="inv_baja" value="<?php echo $inv_baja ?>" />
						</td>

						<td class="Estilo1">FECHA RES. BAJA</td>
						<td class="Estilo1">

							<input type="text" class="Estilo1" id="inv_bajafecha" name="inv_bajafecha" value="<?php echo $inv_bajafecha ?>"  readonly style="background-color: rgb(235, 235, 235)">
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
						</td>
					</tr>

					<tr>
						<tr>
							<td class="Estilo1">OBSERVACION</td>
							<td class="Estilo1">
							<textarea id="observacion" name="observacion" style="margin: 0px; width: 277px; height: 85px;"></textarea>
							</td>
						</tr>
					</tr>
					<tr>
						<td class="Estilo2titulo" colspan="8"><button type="submit" name="submit" value="ACTUALIZAR">ACTUALIZAR <i class="fa fa-refresh"></i></button></td>
					</tr>
				</table>
			</form>
		</div>