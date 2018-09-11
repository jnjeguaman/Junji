<?php
$sql2 = "SELECT * FROM acti_compra_temporal WHERE id = ".$id;
$sql2Resp = mysql_query($sql2);
while($row = mysql_fetch_array($sql2Resp)) { 
	$sqlGrupo = "SELECT cat_nombre FROM acti_categoria WHERE cat_id = ".$row["compra_grupo"];
	$sqlGrupoResp = mysql_query($sqlGrupo);
	$grupo = mysql_fetch_array($sqlGrupoResp);
	?>
	<div  style="width:630px; background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">
		<form name="form2" action="inv_graba_datosunidad.php" method="post"   onSubmit="return validar2()"  enctype="multipart/form-data">
			<table border="0" width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="10">DATOS DE LA UNIDAD REQUIRENTE</td>
				</tr>

				<tr>
					<td  class="Estilo1">CANTIDAD TOTAL</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" size="2" disabled value="<?php echo $row["compra_cantidad"] ?>"></td>

					<td  class="Estilo1">P BRUTO UNITARIO S/C</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" size="9" disabled value="$<?php echo number_format($row["compra_bruto_unitario"],0,".",".") ?>"></td>
				</tr>

				<tr>
					<td  class="Estilo1">UNIDAD O SECCION</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_dpto"] ?>"></td>

					<td  class="Estilo1">SOLICITANTE</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_responsable"] ?>"></td>
				</tr>

				<tr>
					<td  class="Estilo1">CENTRO RESPONSA</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_direccion"] ?>"></td>

					<td  class="Estilo1">ZONA</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_zona"] ?>"></td>
				</tr>

				<tr>
					<td  valign="center" class="Estilo1">GRUPO</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $grupo["cat_nombre"] ?>"></td>

					<td valign="center" class="Estilo1">SUB-GRUPO</td>
					<td class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_glosa"] ?>"></td>
				</tr>

				<tr>
					<td  valign="center" class="Estilo1">SUBTITULO</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["rc_subtitulo"] ?>"></td>

					<td  valign="center" class="Estilo1">ITEM</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_item"] ?>"></td>
				</tr>


				<tr>
					<td  class="Estilo1">CANTIDAD TOTAL</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_cantidad"] ?>"></td>

					<td  class="Estilo1">MONTO TOTAL C / IVA</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="$<?php echo number_format($row["compra_monto"],0,".",".") ?>"></td>
				</tr>

				<tr>
					<td  class="Estilo1">TIPO CAMBIO</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_moneda"] ?>" size="8"></td>		
				
					<td class="Estilo1">VALOR</td>
					<td><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_tipo_cambio"] ?>" size="4"></td>
				</tr>

				<tr>
					<td  class="Estilo1">PROGRAMA</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_programa"] ?>"></td>

					<td  class="Estilo1">TIPO COMPRA</td>
					<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["compra_tipo_compra"] ?>"></td>

				</tr>

				<tr>
					<td  class="Estilo1">PROVEEDOR</td>
					<td  class="Estilo1" colspan="3"><input type="text" class="Estilo2" size="70" disabled value="<?php echo $row["compra_proveedor"] ?>"></td>
				</tr>

				<tr>
					<td  class="Estilo1">ORDEN DE COMPRA</td>
					<td  class="Estilo1" colspan="3"><input type="text" class="Estilo2"  disabled value="<?php echo $row["oc_numero"] ?>"></td>
				</tr>

			</table>
		</form>
	</div>
	<?php } ?>
