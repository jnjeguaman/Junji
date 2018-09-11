<?php
// UNIDAD REQUIRENTE SEGUN ORGANIGRAMA
$unidadRequirente = [
"DIRNAC" => array("Gabinete","Comunicaciones","Auditoría Interna","Atención Ciudadana, Participación y Relaciones Gremiales","Editorial","Prevención de Riesgos y Seguridad","Promoción Ambientes Bien Tratantes","Depto. Técnico Pedagógico","Depto. de Calidad y Control Normativo","Depto. Jurídico","Depto. de Planificación","Depto. de Recursos Humanos","Depto. de Recursos Financieros"),
"REGION" => array("Asesor Jurídico","Asesor Comunicaciones","Atencion Ciudadana y Participación","Promoción Ambientes Bien Tratantes","Subdirección Técnico Pedagógico","Subdirección de Calidad y Control Normativo","Subdirección de Planificación","Subdirección de Recursos Financieros","Subdirección de Infraestructura y Cobertura","Subdirección de Recursos Humanos")
];

?>
<div style="width:800px;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<form name="form11" action="bode_inv_indexoc7.php" method="post" >
		<table border="1" width="100%">
			<tr>
				<td class="Estilo1">TIPO PEDIDO</td>
				<td class="Estilo1">
					<input type="radio" name="tipo" id="tipo" class="Estilo2 tipo" value="Oficina" onclick="this.form.submit();" <? if ($tipo=="Oficina") { echo "checked"; }  ?>>Oficina
					<?php if ($regionsession <> 16): ?>
						<input type="radio" name="tipo" id="tipo" class="Estilo2 tipo" value="Jardines" onclick="this.form.submit();" <? if ($tipo=="Jardines") { echo "checked"; }  ?>>Jardines
					<?php endif ?>
					<!-- <input type="radio" name="tipo" id="tipo" class="Estilo2 tipo" value="Excel" onclick="this.form.submit();" <? if ($tipo=="Excel") { echo "checked"; }  ?>>Excel -->
				</td>
			</tr>
			<input type="hidden" name="cod" value="50"  >
		</form>

		<form id="form22" name="form22" action="bode_inv_grabaindexoc7.php" method="POST" onsubmit="return validar()" enctype="multipart/form-data">
			<?
			if ($tipo=="Oficina") {
				if($regionsession == 16)
				{
					$unidad_requirente = "DIRNAC";
				}else{
					$unidad_requirente = "REGION";
				}

				?>
				<input type="hidden" value="2"  name="tipo_guia">

				<tr>
					<td class="Estilo1">OFICINA DESTINO</td>
					<td class="Estilo1" colspan=1>
						<?php
						$sql = "SELECT * FROM acti_zona WHERE zona_region = ".$regionsession." AND zona_glosa NOT LIKE '%JI %' AND zona_glosa NOT LIKE '%BR %' AND zona_glosa NOT LIKE '%DR %'";
						$res = mysql_query($sql,$dbh);
						?>
						<select name="destino" id="destino" class="Estilo1" required>
							<option value="">Seleccionar...</option>
							<?php while($row = mysql_fetch_array($res)) { ?>
							<option value="<?php echo $row["zona_glosa"] ?>"><?php echo $row["zona_glosa"] ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr>
					<td class="Estilo1">UNIDAD REQUIRENTE</td>
					<td class="Estilo1">
						<select name="unidadRequirente" id="unidadRequirente" class="Estilo1" required>
							<option value="">Seleccionar...</option>
							<?php foreach ($unidadRequirente[$unidad_requirente] as $key => $value): ?>
								<option value="<?php echo $value ?>"><?php echo $value ?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>

				<tr>
					<td class="Estilo1">TIPO DE BIENES</td>
					<td class="Estilo1">
						<select name="tipoBienes" id="tipoBienes" class="Estilo1" required>
							<option value="" selected>Seleccionar...</option>
							<option value="1">INVENTARIABLES</option>
							<option value="0">EXISTENCIA</option>
						</select>
					</td>
				</tr>
			 <? }
			?>
			<?
			if ($tipo=="Jardines") {
				?>
				<input type="hidden" value="3" name="tipo_guia">
				<?php if (intval($regionsession) === 16 ): ?>
					<table border="0" width="100%">
						<tr>
							<td class="Estilo1">SELECCIONAR REGION</td>
							<td class="Estilo1" colspan="1">
								<select id="jardin" class="Estilo2" onChange="getJardinesRegion(this.value)" name="region_destino" id="region_destino" required>
									<option value="">Seleccionar...</option>
									<?php
									$listaRegion = "SELECT * FROM acti_region";
									$listaResp = mysql_query($listaRegion,$dbh);
									while($regiones = mysql_fetch_array($listaResp)) {
										?>
										<option value="<?php echo $regiones["region_id"] ?>"><?php echo $regiones["region_glosa"] ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>

							<tr>
								<td class="Estilo1">JARDIN DESTINO</td>
								<td class="Estilo1" colspan="1">
									<select name="destino" id="destino" class="Estilo select2" onChange="tipoCarga(this.value);" style="width:350px;" tabindex="1" required>
										<option value="">Seleccionar...</option>
										<option value="matriz">Matriz</option>
									</select>
								</td>
							</tr>
							<div class="cargamatriz">
								<tr>
									<td class="Estilo1">CARGAR EXCEL</td>
									<td class="Estilo1" colspan="1"><input type="file" name="Excel" id="Excel"></td>
								</tr>

								<tr>
									<td class="Estilo1">FORMATO</td>
									<td class="Estilo1"><a href="#" class="link"><i class="fa fa-cloud-download fa-lg"></i></a></td>
								</tr>
						</div>

					<?php else: ?>
							<tr>
								<td class="Estilo1">JARDIN DESTINO</td>
								<td class="Estilo1" colspan=1>

									<select name="destino" id="destino" class="Estilo1 select2" onChange="tipoCarga(this.value);" style="width:350px;" tabindex="1" required>
										<option value="">Seleccionar...</option>
										<option value="matriz">Matriz</option>
										<?php
										$sqlZona = "SELECT * FROM jardines where jardin_region='$regionsession' AND jardin_estado = 1 order by jardin_codigo";
										$sqlZonaResp = mysql_query($sqlZona);
										while ($row2 = mysql_fetch_array($sqlZonaResp)) {
											?>
											<option value="<? echo  $row2["jardin_codigo"] ?>" > <? echo  $row2["jardin_codigo"]." : ".$row2["jardin_nombre"] ?></option>
											<?php
											$j++;
										}
										?>
									</select>
								</td>
							</tr>
								<tr class="cargamatriz">
									<td class="Estilo1">CARGAR EXCEL</td>
									<td class="Estilo1" colspan="1"><input type="file" name="Excel" id="Excel"></td>
								</tr>

								<tr class="cargamatriz">
									<td class="Estilo1">FORMATO</td>
									<td class="Estilo1"><a href="#" class="link"><i class="fa fa-cloud-download fa-lg"></i></a></td>
								</tr>
					<?php endif ?>

					<?
				}?>
				<?php if ($tipo <> ""): ?>
					<tr>
						<td class="Estilo1c" colspan="2">
							<input type="hidden" name="tipo" value="<? echo $tipo ?>"  >
							<input type="hidden" name="sp_region_destino" value="<?php echo $regionsession ?>">
							<input type="submit" name="submit" class="Estilo2 btn btn-black" size="11" value="Generar Nota de Pedido">
						</td>
					</tr>
				<?php endif ?>
			</table>
		</form>
	</div>

	<script type="text/javascript">
		$(function(){
			$(".cargamatriz").hide();
		})
		function validar()
		{
			var opcion = document.form22.tipo.value;
			if(opcion == "")
			{
				alert("Favor seleccione un destino");
				return false;
			}else{
				return true;
			}
		}

		function tipoCarga(input)
		{
			if(input == "matriz")
			{
				$(".cargamatriz").show();
				$("#Excel").prop("required",true);
				$("#jardin").prop("required",false);
				$("#destino").prop("required",false);
			}else{
				$(".cargamatriz").hide();
				$("#Excel").prop("required",false);
				$("#jardin").prop("required",true);
				$("#destino").prop("required",true);
			}
		}

		function ObtenerunidadRequirente()
		{
			if($("#region_destino").val() == 16)
			{
				var unidadRequirente = [
				"Depto. Técnico Pedagógico",
				"Depto. de Calidad y Control Normativo",
				"Depto. Jurídico",
				"Depto. de Planificación",
				"Depto. de Recursos Humanos",
				"Depto. de Recursos Financieros"
				];
			}else{
				var unidadRequirente = [
				"Subdirección Técnico Pedagógico",
				"Subdirección de Calidad y Control Normativo",
				"Subdirección de Planificación",
				"Subdirección de Recursos Financieros",
				"Subdirección de Infraestructura y Cobertura",
				"Subdirección de Recursos Humanos"
				]
			}

			var options = '<option value="">Seleccionar...</option>';
			$.each(unidadRequirente,function(index,value){
				options+='<option value="'+value+'">'+value+'</option>';
			});
			$("#unidadRequirente").html(options);
		}
	</script>