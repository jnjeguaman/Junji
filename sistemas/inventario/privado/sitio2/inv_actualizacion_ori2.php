
<div  style="background-color:#E0F8E0; position:absolute; top:120px; left:810px; width: 400px" id="div2">
	<form action="inv_traslado_masivo.php" method="POST" onsubmit="return validarTraslado()">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="6">TRASLADO MASIVO</td>
			</tr>
		</table>
		<hr>
		<table border="1" width="100%">

			<tr>
				<td class="Estilo1">REGION DE DESTINO</td>
				<td class="Estilo1">
					<select class="Estilo1" id="traslado_region" name="traslado_region">
						<option selected value="">Seleccionar...</option>
						<?php while($resReg = mysql_fetch_array($regiones)	) { ?>
							<option value="<?php  echo $resReg["region_id"] ?>"><?php  echo $resReg["region_glosa"] ?></option>
							<?php } ?>
						</select>	
					</td>

					<!-- <td class="Estilo1">FECHA TRASLADO</td>
					<td class="Estilo1">
						<input type="text" class="Estilo1" id="traslado_fecha" name="traslado_fecha" readonly style="background-color: rgb(235, 235, 235)">
						<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
						onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
						<script type="text/javascript">
							Calendar.setup({
								inputField  : "traslado_fecha",
								ifFormat  : "%Y-%m-%d",
								button   : "f_trigger_c2",
								align   : "Bl",
								singleClick : true
							});
						</script>
					</td> -->

					<!-- <td class="Estilo1">RESOLUCION DE TRASLADO</td> -->
					<!-- <td class="Estilo1"><input type="text" name="traslado_resolucion" id="traslado_resolucion"></td> -->
				</tr>

				<tr>
					<td class="Estilo2titulo" colspan="2"><button type="submit" name="submit" value="MASIVO" class="btn btn-success">Pre-Traslado <i class="fa fa-link"></i></button></td>
				</tr>
			</table>
			<input type="hidden" name="totalElementos" id="totalElementos" value="<?php echo sizeof($_SESSION["Actualizacion"]) ?>">	
		</form>
	</div>