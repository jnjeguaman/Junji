<?php
if($sector <> "")
{
	$where = "AND c.jardin_sector = ".$sector;
}

if($regionSession = 16)
{
	$where_region = 13;
}else{
	$where_region = $regionSession;
}
$sql = "SELECT * FROM 
bode_solicitud a 
-- INNER JOIN bode_detoc3 b ON a.sp_id = b.doc_sp_id 
INNER JOIN jardines c ON c.jardin_codigo = a.sp_destino 
WHERE 
a.sp_tipo_destino = 3 
AND c.jardin_region = ".$where_region." 
".$where."
GROUP BY a.sp_destino DESC
ORDER BY c.jardin_sector ASC";
$res = mysql_query($sql);
$completados = 0;

$sql5 = "SELECT distinct(jardin_sector) as Sector FROM jardines WHERE jardin_region = 13 ORDER BY Sector ASC";
$res5 = mysql_query($sql5);

?>
<div  style="width:900px; background-color:#E0F8E0; position:absolute; top:0px; left:710px;" id="div2">
	
	<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
		<table border="1" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="2">FILTROS</td>
			</tr>

			<tr>
				<td class="Estilo1mc">SECTOR</td>
				<td class="Estilo1mc">
					<select name="sector" onChange="this.form.submit()" class="Estilo1">
						<option value="">Seleccionar...</option>
						<?php while($row5 = mysql_fetch_array($res5)) { ?>
						<option value="<?php echo $row5["Sector"] ?>" <?php if($sector == $row5["Sector"]){echo"selected";} ?> >Sector #<?php echo $row5["Sector"] ?></option>
						<?php } ?>
						<option value="">Todos</option>
					</select>
				</td>
			</tr>
		</table>
	</form>
	
	<hr>

	<table width="100%" border="1">
		<tr>
			<td class="Estilo2titulo" colspan="3">LISTADO</td>
		</tr>

		<tr>
			<td class="Estilo1mc">GESPARVU</td>
			<td class="Estilo1mc">JARDIN</td>
			<td class="Estilo1mc">SECTOR</td>
		</tr>

		<?php while($row = mysql_fetch_array($res)) { ?>
		<tr>
			<td class="Estilo1mc"><?php echo $row["jardin_codigo"] ?></td>
			<td class="Estilo1mc"><?php echo $row["jardin_nombre"] ?></td>
			<td class="Estilo1mc">#<?php echo $row["jardin_sector"] ?></td>
		</tr>

		<tr style="background-color: #f5fffa;">
			<td colspan="2">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="Estilo1mc">OP</td>
						<td class="Estilo1mc">#</td>
						<td class="Estilo1mc">DETALLE DEL PRODUCTO</td>
						<td class="Estilo1mc">CANTIDAD SOLICITADA</td>
						<td class="Estilo1mc">CANTIDAD ASOCIADA</td>
						<td class="Estilo1mc">PENDIENTE</td>
						<td class="Estilo1mc">DESPACHADO</td>
						<td class="Estilo1mc">ASOCIAR</td>
						<td class="Estilo1mc">DESASOCIAR</td>
					</tr>

					<?php
					// DETALLE DE LOS PRODUCTOS SOLICITADOS A UN JARDIN ENTRE TODAS LAS SOLICITUDES INGRESADAS
					$sql2 = "SELECT * FROM bode_solicitud a INNER JOIN bode_detoc3 b ON b.doc_sp_id = a.sp_id WHERE a.sp_destino = ".$row["sp_destino"];
					
					$res2 = mysql_query($sql2);

					$contador = 1;
					while($row2 = mysql_fetch_array($res2)) { 

					// CANTIDAD DE PRODUCTOS YA ASOCIADOS
						$sql3 = "SELECT SUM(sp_rel_cantidad) as Asociado,sp_rel_id FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row2["doc_id"]." AND sp_rel_estado = 1";
						$res3 = mysql_query($sql3);
						$row3 = mysql_fetch_array($res3);

						$sql4 = "SELECT SUM(sp_rel_despachado) as Despachado FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row2["doc_id"]." AND sp_rel_estado = 2";
						$res4 = mysql_query($sql4);
						$row4 = mysql_fetch_array($res4);

						$completado = 0;
						if($row2["doc_cantidad"] == $row4["Despachado"])
						{
							$completado = 1;
							$completados++;
						}
						?>
						<tr>
							<form action="bode_solicitud_generarguia2.php" method="POST" onSubmit="return valida()">
								<td class="Estilo1mc">
									<?php if ($row3["Asociado"] <> ""): ?>
										<input type="checkbox" name="var1[<?php echo $contador ?>]" id="var1_<?php echo $contador ?>" value="<?php echo $row2["doc_id"] ?>">
									<?php endif ?>
									<input type="hidden" name="var2[<?php echo $contador ?>]" value="<?php echo $row3["Asociado"] ?>">
									<input type="hidden" name="var3[<?php echo $contador ?>]" value="<?php echo $row2["doc_origen_id"] ?>">
									<input type="hidden" name="var4[<?php echo $contador ?>]" value="<?php echo $row3["sp_rel_id"] ?>">	
									<input type="hidden" name="var5[<?php echo $contador ?>]" value="<?php echo $row2["doc_id"] ?>">
									<input type="hidden" name="var7[<?php echo $contador ?>]" value="<?php echo $row2["doc_especificacion"] ?>">
								</td>
								<td class="Estilo1mc"><?php  echo $contador ?></td>
								<td class="Estilo1mc"><?php echo $row2["doc_especificacion"] ?></td>
								<td class="Estilo1mc"><?php echo $row2["doc_cantidad"] ?></td>
								<td class="Estilo1mc"><?php echo $row3["Asociado"] ?></td>
								<td class="Estilo1mc"><?php echo $row2["doc_cantidad"] - $row4["Despachado"] ?></td>
								<td class="Estilo1mc"><?php echo $row4["Despachado"] ?></td>
								<td class="Estilo1mc">
									<?php if (!$completado): ?>
										<a href="#" class="link" onClick="abrirVentana(<?php echo $row2["doc_origen_id"] ?>,<?php echo $row2["doc_id"] ?>,<?php echo $row2["doc_sp_id"] ?>)"><i class="fa fa-link"></i></a>
									<?php else: ?>
										<a href="#" class="link"><i class="fa fa-ban"></i></a>
									<?php endif ?>
								</td>

								<td class="Estilo1mc">
									<?php if ($row3["Asociado"] > 0): ?>
										<a href="#" class="link" onClick="abrirVentana2(<?php echo $row2["doc_origen_id"] ?>,<?php echo $row2["doc_id"] ?>,<?php echo $row2["doc_sp_id"] ?>)"><i class="fa fa-unlink"></i></a>
									<?php else: ?>
										<a href="#" class="link"><i class="fa fa-ban"></i></a>
									<?php endif ?>
								</td>

							</tr>
							<input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
							<input type="hidden" name="var6[<?php echo $contador ?>]" value="<?php echo $row2["sp_id"] ?>">
							<?php $contador++;} ?>
							<tr>
								<?php if ($completados != mysql_num_rows($res2)): ?>
									<td colspan="9" align="right"><button style="background-color: #FFF;border-radius: 15px;">Generar Guia</button></td>
								<?php endif ?>
							</tr>
						</table>
						<input type="hidden" name="destino" value="<?php echo $row["jardin_codigo"] ?>">
						<input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
					</form>
				</td>
			</tr>
			<?php } ?>
		</table>

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
			var numberOfChecked = $('input:checkbox:checked').length;

			if(numberOfChecked == 0)
			{
				alert("Debe seleccionar al menos 1 item");
				return false;
			}else{
				return true;
			}
		}
	</script>