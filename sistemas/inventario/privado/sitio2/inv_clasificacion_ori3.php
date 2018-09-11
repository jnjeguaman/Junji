<?php
// $getPropductos = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON a.ding_prod_id = b.doc_id WHERE a.ding_ing_id = ".$ing_id;
$getPropductos = "SELECT * FROM acti_compra_temporal a INNER JOIN bode_detoc b ON b.doc_id = a.compra_doc_id WHERE a.compra_ing_id = ".$ing_id;
$getPropductos = mysql_query($getPropductos);
?>
<div style="width:640px; background-color:#E0F8E0; position:absolute; top:120px; left:710px;" id="div2">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">LISTADO DE PRODUCTOS</td>
		</tr>
	</table>
	<hr>

	<table border="1" width="100%">
		<tr>
			<td class="Estilo1">CLASIFICACION</td>
			<td class="Estilo1">
				<select name="tipoClasificacion" id="tipoClasificacion" class="Estilo1">
					<option value="">Seleccionar...</option>
					<option value="1">INVENTARIABLE</option>
					<option value="0">EXISTENCIA</option>
				</select>
			</td>
			<td class="Estilo1"><input type="checkbox" name="sel" id="sel" onClick="sel()"> Seleccionar Todo</td>
		</tr>
	</table>
	<hr>
	<table border="1" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td class="Estilo1mc"></td>
			<td class="Estilo1mc">REGION</td>
			<td class="Estilo1mc">BIEN</td>
			<td class="Estilo1mc">CANTIDAD / STOCK</td>
			<td class="Estilo1mc">CLASIFICACION</td>
			<td class="Estilo1mc">EDITAR</td>
		</tr>

		<form action="<?php echo $_SERVER["PHP_SELF"] ?>?ing_id=<?php echo $ing_id ?>" method="POST" onSubmit="blockUI();">
			<?php $cont = 0; while($rowProd = mysql_fetch_array($getPropductos)){ $cont++;
				if($rowProd["doc_region"] == 16 || $rowProd["doc_region"] == 13)
				{
					$getCantidadSQL = "SELECT SUM(ding_cantidad) as Total FROM bode_detingreso WHERE ding_ing_id = ".$ing_id." AND ding_prod_id = ".$rowProd["doc_id"]." AND (ding_region_id = 16 OR ding_region_id = 13)";
				}else{
					// $getCantidadSQL = "SELECT SUM(ding_cantidad) as Total FROM bode_detingreso WHERE ding_ing_id = ".$ing_id." AND ding_prod_id = ".$rowProd["doc_id"]." AND ding_region_id = ".$rowProd["doc_region"];
					$getCantidadSQL = "SELECT SUM(ding_cantidad) as Total FROM bode_detingreso WHERE ding_ing_id = ".$ing_id." AND ding_prod_id = ".$rowProd["doc_id"];
				}
				// echo $getCantidadSQL;
				$getCantidadSQLResp = mysql_query($getCantidadSQL);
				$getCantidadRow = mysql_fetch_array($getCantidadSQLResp);

				$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
				} else {
					$estilo2="Estilo1mcblanco";
				}

				if($row["ing_aprobado"] == ''){
					$stylo = "style='background-color: red; color: white;'";
				}else{
					$stylo = "";
				}

				?>
				<tr class="trh <?php echo $estilo2 ?>">
					<td class="Estilo1mc"><?php echo $cont ?></td>
					<td class="Estilo1mc"><?php echo $rowProd["compra_region_id"] ?></td>
					<td class="Estilo1mc"><?php echo $rowProd["doc_especificacion2"] ?></td>
					<td class="Estilo1mc"><?php echo $getCantidadRow["Total"] ?></td>
					<td class="Estilo1mc">
						<select class="Estilo1" id="clasificacion_<?php echo $cont ?>" name="clasificacion[<?php echo $cont ?>]" required>
							<option value="">Seleccionar...</option>
							<option value="1" <?php if($rowProd["ding_clasificacion"] === 1){ echo "selected";} ?> >INVENTARIABLE</option><
							<option value="0" <?php if($rowProd["ding_clasificacion"] === 0){ echo "selected";} ?> >EXISTENCIA</option><
						</select>
					</td>
					<td class="Estilo1mc"><a href="inv_detalle.php?ing_id=<?php echo $rowProd["compra_ing_id"] ?>&ding_id=<?php echo $rowProd["compra_ding_id"] ?>&doc_id=<?php echo $rowProd["doc_id"] ?>&id=<?php echo $rowProd["id"]?>" class="popup"><i class="fa fa-pencil-square link fa-lg"></i></td>
				</tr>

				<input type="hidden" name="var1[<?php echo $cont ?>]" value="<?php echo $rowProd["compra_ing_id"] ?>">
				<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $rowProd["compra_ding_id"] ?>">
				<input type="hidden" name="var3" value="<?php echo $ing_id ?>">
				<input type="hidden" name="var4[<?php echo $cont ?>]" value="<?php echo $rowProd["doc_region"] ?>">
				<input type="hidden" name="var5[<?php echo $cont ?>]" value="<?php echo $rowProd["ding_unidad"] ?>">
				<input type="hidden" name="var6[<?php echo $cont ?>]" value="<?php echo $rowProd["compra_doc_id"] ?>">
				<input type="hidden" name="compra_id[<?php echo $cont ?>]" value="<?php echo $rowProd["id"] ?>">
				<?php } ?>
				<tr>
					<td colspan="6"><center><button type="submit" name="submit" value="actualizar">ACTUALIZAR <i class="fa fa-refresh"></i></button></center></td>
				</tr>
			</table>
			<input type="hidden" name="total" id="total" value="<?php echo $cont ?>">
		</form>
	</div>

	<script type="text/javascript">

		function sel()
		{
			// OBTENEMOS LA CANTIDAD DE BIENES A CLASIFICAR
			var totalLineas = $("#total").val();

			if($("#sel").is(":checked"))
			{	
				// SE HA PULSADO EL BOTON DE SELECCIONAR TODO
				var clasificacion = $("#tipoClasificacion :selected").val();

				// COMPROBAMOS QUE SE HAYA SELCCIONADO UN TIPO DE CLASIFICACION
				if(clasificacion == "")
				{
					// MOSTRAMOS UN MENSAJE DE ALERTA QUE NO SE HA SELECCIONADO UN TIPO DE CLASIFICACION
					alert("Debe seleccionar un tipo de clasificacion para usar esta funcion");
					$("#tipoClasificacion").focus();
					$("#sel").prop("checked",false);
				}else{
					//SI SE HA SELECCIONADO UN TIPO DE CLASIFICACION, SE PROCEDE A CAMBIAR LOS VALORES
					var texto = $("#tipoClasificacion :selected").text();
					var valor = $("#tipoClasificacion").val();

					for (var i = 1; i <= totalLineas; i++) {
						$("#clasificacion_"+i+" :selected").val(valor);
						$("#clasificacion_"+i+" :selected").text(texto);
						$("#clasificacion_"+i+" :selected").prop("selected",true);
					}
				}
			}else{
				// SI SE HA DESELECCIONADO LA OPCION, VUELVE A SU ESTADO ORIGINAL
				for (var i = 1; i <= totalLineas; i++) {
					$("#clasificacion_"+i+" option:selected").val("");
					$("#clasificacion_"+i+" option:selected").text("Seleccionar...");
				}
			}
		}

	</script>