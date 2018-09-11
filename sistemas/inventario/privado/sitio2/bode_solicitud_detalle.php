<?php
$sql = "SELECT * FROM bode_detoc3 WHERE doc_sp_id = ".$id;
// $sql = "SELECT * FROM bode_detoc3 a inner join bode_solicitud b on a.doc_sp_id = b.sp_id where b.sp_region = ".$_GET["region"]." and b.sp_folio = ".$_GET["folio"];
$res = mysql_query($sql);
$totalProductos = mysql_num_rows($res);
$contador = 1;
$completados = 0;
$atributo = $_SESSION["atributo1"];
$completoInventario = 0;
$totalAsociados = 0;

?>
<div  style="width:770px; background-color:#E0F8E0; position:absolute; top:0px; left:710px;" id="div2">
	<form action="bode_solicitud_generarguia.php" method="POST" onSubmit="return valida()">
		<table border="1" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">PRODUCTOS SOLICITADOS</td>
			</tr>

			<tr>
				<td class="Estilo1mc">OP</td>
				<td class="Estilo1mc">#</td>
				<td class="Estilo1mc">DETALLE DEL PRODUCTO</td>
				<td class="Estilo1mc">CANTIDAD SOLICITADA</td>
				<td class="Estilo1mc">CANTIDAD ASOCIADA</td>
				<td class="Estilo1mc">PENDIENTE</td>
				<td class="Estilo1mc">DESPACHADO</td>
				<td class="Estilo1mc">CLASIFICACION</td>
				<td class="Estilo1mc">ASOCIAR</td>
				<td class="Estilo1mc">DESASOCIAR</td>
			</tr>

			<?php while($row = mysql_fetch_array($res)) { 
				$sql2 = "SELECT SUM(sp_rel_cantidad) as Asociado,sp_rel_id FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row["doc_id"]." AND sp_rel_estado = 1";
				$res2 = mysql_query($sql2);
				$row2 = mysql_fetch_array($res2);

				$sql3 = "SELECT SUM(sp_rel_despachado) as Despachado FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row["doc_id"]." AND sp_rel_estado = 2";
				$res3 = mysql_query($sql3);
				$row3 = mysql_fetch_array($res3);
				$completado = 0;
				if($row["doc_cantidad"] == $row3["Despachado"])
				{
					$completado = 1;
					$completados++;
				}
				?>
				<tr>
					<td class="Estilo1mc">
						<?php if ($atributo == 35 || $atributo == 38 || $atributo == 50): ?>
							<?php if ($row2["Asociado"] == $row["doc_cantidad"]): ?>
								<?php $completoInventario++ ?>
								<?php $totalAsociados++ ?>
								<input type="checkbox" name="var1[<?php echo $contador ?>]" id="var1_<?php echo $contador ?>" value="<?php echo $row["doc_id"] ?>">
							<?php endif ?>
						<?php elseif($atributo == 37 || $atributo == 39): ?> 
							<?php if ($row2["Asociado"] <> ""): ?>
								<?php $totalAsociados++ ?>
								<input type="checkbox" name="var1[<?php echo $contador ?>]" id="var1_<?php echo $contador ?>" value="<?php echo $row["doc_id"] ?>">
							<?php endif ?>
						<?php endif ?>

					</td>
					<input type="hidden" name="var2[<?php echo $contador ?>]" value="<?php echo $row2["Asociado"] ?>">
					<input type="hidden" name="var3[<?php echo $contador ?>]" value="<?php echo $row["doc_origen_id"] ?>">
					<input type="hidden" name="var4[<?php echo $contador ?>]" value="<?php echo $row2["sp_rel_id"] ?>">
					<input type="hidden" name="var5[<?php echo $contador ?>]" value="<?php echo $row["doc_id"] ?>">
					<input type="hidden" name="var6[<?php echo $contador ?>]" value="<?php echo $row["doc_clasificacion"] ?>">
					<input type="hidden" name="var7[<?php echo $contador ?>]" value="<?php echo $row["doc_id"] ?>">
					
					<td class="Estilo1mc"><?php  echo $contador ?></td>
					<td class="Estilo1mc"><?php echo $row["doc_especificacion"] ?></td>
					<td class="Estilo1mc"><?php echo $row["doc_cantidad"] ?></td>
					<td class="Estilo1mc"><?php echo $row2["Asociado"] ?></td>
					<td class="Estilo1mc"><?php echo $row["doc_cantidad"] - $row3["Despachado"] ?></td>
					<td class="Estilo1mc"><?php echo $row3["Despachado"] ?></td>
					<td class="Estilo1mc"><?php echo ($row["doc_clasificacion"] == 1) ? "I" : "E" ?></td>
					<td class="Estilo1mc">
						<?php if (!$completado): ?>
							<a href="#" class="link" onClick="abrirVentana(<?php echo $row["doc_origen_id"] ?>,<?php echo $row["doc_id"] ?>,<?php echo $id ?>)"><i class="fa fa-link"></i></a>
						<?php else: ?>
							<a href="#" class="link"><i class="fa fa-ban"></i></a>
						<?php endif ?>
					</td>
					<td class="Estilo1mc">
						<?php if ($row2["Asociado"] > 0): ?>
							<a href="#" class="link" onClick="abrirVentana2(<?php echo $row["doc_origen_id"] ?>,<?php echo $row["doc_id"] ?>,<?php echo $row["doc_sp_id"] ?>)"><i class="fa fa-unlink"></i></a>
						<?php else: ?>
							<a href="#" class="link"><i class="fa fa-ban"></i></a>
						<?php endif ?>
					</td>
				</tr>
				<input type="hidden" value="<?php echo $completoInventario ?>">
				<?php $contador++;} ?>
				<?php if ($totalAsociados > 0): ?>
					<tr>
						<td class="Estilo2titulo" colspan="10">OBSERVACIONES</td>
					</tr>
					<tr>
						<td colspan="10"><textarea name="solicitud_observacion" id="solicitud_observacion" id="" cols="30" rows="10" style="margin: 0px; width: 756px; height: 152px;"></textarea></td>
					</tr>
					
					<tr>
						<td colspan="10" align="right">
							<?php if ($atributo == 35 || $atributo == 38 || $atributo == 50): ?>
								<input type="hidden" name="sp_aprobacion" id="sp_aprobacion" value="1">
								<input type="hidden" name="sp_tipo_envio" id="sp_tipo_envio" value="1">
								<?php if ($completoInventario == $totalProductos): ?>
									<button style="background-color: #FFF;border-radius: 15px;">Aprobar</button>
								<?php endif ?>
							<?php else: ?>	
								<?php if ($completados != mysql_num_rows($res)): ?>
									<button style="border-radius: 5px;background-color: white;border: 1px solid black; ">Generar Guia</button>
								<?php endif ?>
							<?php endif ?>
						</td>
					</tr>
				<?php endif ?>
			</table>
			<input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
			<input type="hidden" name="sp_id" value="<?php echo $id ?>">
			<input type="hidden" name="region_destino" value="<?php echo $_REQUEST["region"] ?>">
		</form>

	</div>

	<script type="text/javascript">
		function abrirVentana(doc_origen_id,doc_id,sp_id)
		{
			miPopup = window.open("bode_solicitud_asociar.php?id="+doc_origen_id+"&doc_id="+doc_id+"&sp_id="+sp_id,"miwin","width=1024,height=500,scrollbars=yes,toolbar=0")
			miPopup.focus()
		}

		function abrirVentana2(doc_origen_id,doc_id,doc_sp_id)
		{
			miPopup = window.open("bode_solicitud_desasociar.php?doc_origen_id="+doc_origen_id+"&doc_id="+doc_id+"&doc_sp_id="+doc_sp_id,"miwin","width=1024,height=500,scrollbars=yes,toolbar=0")
			miPopup.focus()
		}

		function valida()
		{
			var sp_aprobacion = $("#sp_aprobacion").val();
			if(!sp_aprobacion){
				var numberOfChecked = $('input:checkbox:checked').length;

				if(numberOfChecked == 0)
				{
					alert("Debe seleccionar al menos 1 item");
					return false;
				}else{
					return true;
				}
			}else{
				return confirm("¿ESTÁ SEGURO DE APROBAR LA SOLICITUD N° <?php echo $folio ?> ?");
			}
		}
	</script>