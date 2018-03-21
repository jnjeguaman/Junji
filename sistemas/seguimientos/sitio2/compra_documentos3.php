<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>DOCUMENTOS</title>
	<meta charset="UTF-8">
	<link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

</body>
</html>
<div class="modal-dialog modal-lg" role="document">
<div class="col-md-12">
	<div class="modal-content">
		<div class="modal-header text-center">
			<h4 class="modal-title" id="myModalLabel">Documentos</h4>
		</div>
		<div class="modal-body">


			<?php
			require_once("inc/config.php");
			extract($_GET);

			$id=$viene_id;

			$sql5="select * from dpp_facturas x, dpp_etapas y where fac_id=".$fac_id." and fac_eta_id=eta_id ";

            // echo $sql5;

			$res5 = mysql_query($sql5,$dbh);

			$row5=mysql_fetch_array($res5);
            //$archivo5=$row5["fac_"];

			$idetapa=$row5["eta_id"];
			$eta_id = $row5["eta_id"];
			$etaporroid=$row5["eta_prorro_id"];

			$etanumero=$row5["eta_numero"];

			$etarut=$row5["eta_rut"];

			$eta_nroorden=$row5["eta_nroorden"];
			$oc = "SELECT count(oc_id) as Total,oc_id,oc_tipo2,oc_solicitud_archivo,oc_numero,oc_compromiso_archivo,oc_sc FROM compra_orden WHERE oc_numero = '".$eta_nroorden."'";

			$ocRes = mysql_query($oc);

			$rowRes = mysql_fetch_array($ocRes);
			?>
			<form action="compra_documentos3_gr.php" method="POST" onsubmit="return valida()">
			<table border="2" class="table table-striped">

			
				<tr>
					<td class="Estilo1" width="200px">Tipo documento</td>
					<td class="Estilo1" width="200px">Archivo</td>
					<td class="Estilo1" width="200px">Seleccionar</td>
				</tr>
				<tr>
					<td class="Estilo1"> Resoluci&oacute;n Aprueba Bases Administrativas </td>
					<td class="Estilo1">
						<?php 
						$sql8="select * from argedo_documentos where docs_id=".$row5["fac_docs_id"];

                                                    // echo $sql8;

						$res8 = mysql_query($sql8);

						$row8 = mysql_fetch_array($res8);

						$docsfecha=$row8["docs_fecha"];

						if ($row8["docs_archivo"]<>'') {

							$docsarchivo="../../archivos/docargedo/".$row8["docs_archivo"];

						}


						if($row8["docs_archivo"] == null){
							echo "No hay documentos";
						}
						else{
							?>
							<a href="<? echo $docsarchivo ?>" class="link" id="linkarchivo" target="_blank"><div id="verlink"><? echo $row8["docs_archivo"] ?></div></a>
							<?php 
						}
						?>
						<td class="Estilo1">
							<input type="checkbox" name="doc_1">
							<input type="hidden" name="var1[0]" value="<?php echo $row5["fac_docs_id"] ?>">

							<?php echo $row8["docs_archivo"] ?></td>

						</td>
					</tr>
					<tr>
						<td class="Estilo1"> Resoluci&oacute;n Adjudica Licitaci&oacute;n </td>
						<td class="Estilo1">
							<?php 

							$sql9="select * from argedo_documentos where docs_id=".$row5["fac_doc_id2"];

                                                  // echo $sql9;

							$res9 = mysql_query($sql9);

							$row9 = mysql_fetch_array($res9);

							$docsfecha=$row9["docs_fecha"];

							if ($row9["docs_archivo"]<>'') {

								$docsarchivo2="../../archivos/docargedo/".$row9["docs_archivo"];

							}

							if($row9["docs_archivo"] == null){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="<? echo $docsarchivo2 ?>" class="link" id="linkarchivo2" target="_blank"><div id="verlink2"><? echo $row9["docs_archivo"] ?></div></a>
								<?php 
							}
							?>
						</td>
						<td class="Estilo1">
							<input type="checkbox" name="doc_2">
							<input type="hidden" name="var2[0]" value="<?php echo $row5["fac_docs_id2"] ?>">
						</td>
					</tr>
					<tr>
						<td class="Estilo1"> Resoluci&oacute;n Aprueba Contrato </td>
						<td class="Estilo1">
							<?php 

							$sql10="select * from argedo_documentos where docs_id=".$row5["fac_doc_id3"];

                                                  // echo $sql10;

							$res10 = mysql_query($sql10);

							$row10 = mysql_fetch_array($res10);

							$docsfecha=$row10["docs_fecha"];

							if ($row10["docs_archivo"]<>'') {

								$docsarchivo3="../../archivos/docargedo/".$row10["docs_archivo"];

							}

							if($row10["docs_archivo"] == null){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="<? echo $docsarchivo3 ?>" class="link" id="linkarchivo3" target="_blank"><div id="verlink3"><? echo $row10["docs_archivo"] ?></div></a>
								<?php 
							}
							?>
						</td>
						<td class="Estilo1">
							<input type="checkbox" name="doc_3">
							<input type="hidden" name="var3[0]" value="<?php echo $row5["fac_docs_id3"] ?>">
						</td>
					</tr>
					<tr>
						<td class="Estilo1"> Resoluci&oacute;n de Trato Directo </td>
						<td class="Estilo1">
							<?php

							$sql11="select * from argedo_documentos where docs_id=".$row5["fac_doc_id4"];

                                                  //echo $sql8;

							$res11 = mysql_query($sql11);

							$row11 = mysql_fetch_array($res11);

							$docsfecha=$row11["docs_fecha"];

							if ($row11["docs_archivo"]<>'') {

								$docsarchivo4="../../archivos/docargedo/".$row11["docs_archivo"];

							}

							if($row11["docs_archivo"] == null){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="<? echo $docsarchivo4 ?>" class="link" id="linkarchivo4" target="_blank"><div id="verlink4"><? echo $row11["docs_archivo"] ?></div></a>
								<?php 
							}
							?>
						</td>
						<td class="Estilo1">
							<input type="checkbox" name="doc_4">
							<input type="hidden" name="var4[0]" value="<?php echo $row5["fac_docs_id4"] ?>">
						</td>
					</tr>
					<tr>
						<td class="Estilo1">Factura</td>
						<td class="Estilo1">
							<?php 
							if($row5["fac_archivo"] == null){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="../../archivos/docfac/<? echo $row5["fac_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["fac_archivo"]; ?></a>
								<?php 
							}
							?>
						</td>
						<td class="Estilo1">
							<input type="checkbox" name="doc_5">
							<input type="hidden" name="var5[0]" value="<?php echo $row5["fac_archivo"] ?>">

						</td>
					</tr>
					<tr>
						<td class="Estilo1">Archivo PDF Solicitud de compra</td>
						<td class="Estilo1" colspan="2">
							<?php 
							if($rowRes["oc_solicitud_archivo"] == null){
                                                    //echo "No hay documentos";
							}
							else{
								?>
								<a href="../../archivos/docfac/<? echo $rowRes["oc_solicitud_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $rowRes["oc_solicitud_archivo"]; ?></a>
								<?php 
							}
							?>

							<!-- <td class="Estilo1">
								<input type="checkbox" name="doc_6">
								<input type="hidden" name="var6[0]" value="<?php echo $rowRes["oc_solicitud_archivo"] ?>">
							</td> -->

						</td>
					</tr>

					<tr>
						<td class="Estilo1">Imagen Consulta cesi&oacute;n de factura</td>
						<td class="Estilo1">
							<?php 
							if($row5["fac_ant1"] == ''){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="<? echo $row5["fac_ruta1"]."/".$row5["fac_ant1"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["fac_ant1"]; ?></a>
								<?php 
							}
							?>

							<td class="Estilo1">
								<input type="checkbox" name="doc_7">
								<input type="hidden" name="var7[0]" value="<?php echo $row5["fac_ant1"] ?>">

							</td>
						</td>
					</tr>

					<tr>
						<td class="Estilo1"> Imagen Compromiso Cierto </td>
						<td class="Estilo1">
							<?php 
							if($row5["eta_compromiso_archivo"] == null){
                                                    //echo "No hay documentos";
							}
							else{
								?>
								<a href="../../archivos/docfac/<? echo $row5["eta_compromiso_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank">Compromiso Cierto</a>
								<?php 
							}
							?>
						</td>
						<td class="Estilo1">
							<input type="checkbox" name="doc_8">
							<input type="hidden" name="var8[0]" value="<?php echo $row5["eta_compromiso_archivo"] ?>">
							
						</td>
					</tr>
					<tr>
						<td class="Estilo1">Resoluci&oacute;n Cesi&oacute;n de Factura </td>
						<td class="Estilo1">
							<?php 

							$sql12="select * from argedo_documentos where docs_id=".$row5["fac_doc_id5"];

							$res12 = mysql_query($sql12);

							$row12 = mysql_fetch_array($res12);

							$docsfecha=$row12["docs_fecha"];

							if ($row12["docs_archivo"]<>'') {

								$docsarchivo5="../../archivos/docargedo/".$row12["docs_archivo"];

							}
							if($row12["docs_archivo"] == null){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="<? echo $docsarchivo5 ?>" class="link" id="linkarchivo6" target="_blank"><div id="verlink6"><? echo $row12["docs_archivo"] ?></div></a>
								<?php 
							}
							?>
						</td>

						<td class="Estilo1">
							<input type="checkbox" name="doc_9">
							<input type="hidden" name="var9[0]" value="<?php echo $row5["fac_doc_id5"] ?>">
						</td>
					</tr>
					<tr>
						<td class="Estilo1"> Resoluci&oacute;n Aplica Multa </td>
						<td class="Estilo1">
							<?php 

							$sql13="select * from argedo_documentos where docs_id=".$row5["fac_doc_id6"];

							$res13 = mysql_query($sql13);

							$row13 = mysql_fetch_array($res13);

							$docsfecha=$row13["docs_fecha"];

							if ($row13["docs_archivo"]<>'') {

								$docsarchivo6="../../archivos/docargedo/".$row13["docs_archivo"];

							}
							if($row13["docs_archivo"] == null){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="<? echo $docsarchivo6 ?>" class="link" id="linkarchivo6" target="_blank"><div id="verlink6"><? echo $row13["docs_archivo"] ?></div></a>
								<?php 
							}
							?>
						</td>
						<td class="Estilo1">
							<input type="checkbox" name="doc_10">
							<input type="hidden" name="var10[0]" value="<?php echo $row5["fac_doc_id6"] ?>">
						</td>
					</tr>
					<tr>
						<td class="Estilo1">Archivo PDF Orden de Compra</td>
						<td class="Estilo1">
							<?php 
							if($row5["fac_doc1"] == null){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="../../archivos/docfac/<? echo $row5["fac_doc1"]; ?>?read3=<? echo $read3 ?>" class="link" target="_blank"><? echo $row5["fac_doc1"]; ?></a>
								<?php 
							}
							?>
						</td>

						<td class="Estilo1">
							<input type="checkbox" name="doc_11">
							<input type="hidden" name="var11[0]" value="<?php echo $row5["fac_doc1"] ?>">
						</td>

					</tr>

					<tr>
						<td class="Estilo1">N&deg; Solicitud de Compra</td>
						<td class="Estilo1" colspan="2"><?php echo ($rowRes["oc_sc"] <> '') ? $rowRes["oc_sc"] : "No Tiene" ?></td>
					</tr>

					<tr>
						<td class="Estilo1">Archivo Recepci&oacute;n conforme desde INEDIS</td>
						<td class="Estilo1" colspan="2">
							<?php 
							$rc = "SELECT * FROM compra_doc_inedis WHERE doc_etapa_id = ".$eta_id." AND doc_tipo = 'RC' and doc_estado = 1";
							$rc = mysql_query($rc,$dbh);
							if(mysql_num_rows($rc) > 0){

								while($rowrc = mysql_fetch_array($rc)) {
									$rcInedis = "SELECT * FROM bode_ingreso WHERE ing_id = ".$rowrc["doc_ing_id"];
									$rcInedis = mysql_query($rcInedis,$dbh6);
									$rcInedis = mysql_fetch_array($rcInedis);
									echo '<br><a href="../../inventario/privado/sitio2/bode_imprimerca.php?numguia='.$rcInedis["ing_guianumerorc"].'" target="_blank">Recepcion N&deg; '.$rcInedis["ing_guianumerorc"].'</a> ';
								}
							}else{
								echo "No hay documentos";
							}
							?>
						</td>

					</tr>
					<tr>
						<td class="Estilo1">Archivo Recepci&oacute;n t&eacute;cnica desde INEDIS</td>
						<td class="Estilo1" colspan="2">
							<?php 
							$rc = "SELECT * FROM compra_doc_inedis WHERE doc_etapa_id = ".$eta_id." AND doc_tipo = 'RT' and doc_estado = 1";
							$rc = mysql_query($rc,$dbh);
							if(mysql_num_rows($rc) > 0)
							{
								while($rowrc = mysql_fetch_array($rc)) {
									$rcInedis = "SELECT * FROM bode_ingreso WHERE ing_id = ".$rowrc["doc_ing_id"];
									$rcInedis = mysql_query($rcInedis,$dbh6);
									$rcInedis = mysql_fetch_array($rcInedis);
									echo '<br><a href="../../inventario/privado/sitio2/bode_tca.php?numguia='.$rcInedis["ing_guianumerotc"].'" target="_blank">Recepcion N&deg; '.$rcInedis["ing_guianumerotc"].'</a> ';
								}
							}else{
								echo "No hay documentos";
							}
							?>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">Archivo Recepci&oacute;n Conforme</td>
						<td class="Estilo1">
							<?php 
							if($row5["fac_ant2"] == ''){
								echo "No hay documentos";
							}
							else{
								?>
								<a href="<? echo $row5["fac_ruta2"]."/".$row5["fac_ant2"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["fac_ant2"]; ?></a>
								<?php 
							}
							?>
						</td>

						<td class="Estilo1">
							<input type="checkbox" name="doc_12">
							<input type="hidden" name="var12[0]" value="<?php echo $row5["fac_ruta2"] ?>">
							<input type="hidden" name="var12[1]" value="<?php echo $row5["fac_ant2"] ?>">
						</td>

					</tr>

					<tr>
						<td class="Estilo1"> Otros Antecedentes </td>
						<td class="Estilo1" colspan="2">

							<table border="0" width="100%">
								<?php
								$sql27="Select * from compra_archivo where arch_eta_id=$eta_id order by arch_id desc";
								$sql27=mysql_query($sql27);
								if(mysql_num_rows($sql27) == 0)
								{
									?>
									<tr>
										<td>No hay documentos</td>
									</tr>
									<?php

								}else{
									while ($row27 = mysql_fetch_array($sql27)) {
										?>
										<tr>
											<td class="Estilo1"> <? echo $row27["arch_etiqueta"] ?></td>
											<td><a href="../../<? echo $row27["arch_ruta"]; ?>/<? echo $row27["arch_archivo"]; ?>?read2=<? echo $read3 ?>" class="link" target="_blank">Ver </a></td>
										</tr>
										<?
									}

								}

								?>
							</table>

						</td>
					</tr>

					<tr>
						<td class="Estilo1">Observaciones</td>
						<td colspan="2">
							<?php if ($row5["eta_obs"] == ''): ?>
								Sin observaciones
							<?php else: ?>
								<?php echo $row5["eta_obs"] ?>
							<?php endif ?>
						</td>
					</tr>

					<tr>
						<td class="Estilo1b">Comprobante Contable (Devengo)</td>
						<td colspan="2">
							<table class="table">
								<thead>
									<th>Fecha Devengo</th>
									<th>N&deg; Comprobante</th>
									<th>Documento</th>
								</thead>
								<tr>
									<td><?php echo ($row5["eta_fdevengo"] <> '') ? date("d-m-Y",strtotime($row5["eta_fdevengo"])) : "POR DEVENGAR"?></td>
									<td><?php echo ($row5["fac_nro_contable"] <> '') ? $row5["fac_nro_contable"] : "POR DEVENGAR" ?></td>
									<td><?php echo ($row5["fac_devengo_archivo"] <> '') ? "<a href='#'>".$row5["fac_devengo_archivo"]."</a>" : "POR DEVENGAR" ?></td>
								</tr>
							</table>
						</td>
					</tr>

					<tr>
    			<td class="Estilo1">Comprobante Egreso</td>
    			<td colspan="2">
    				<table class="table">
    					<thead>
    						<th class="Estilo1">Fecha Egreso</th>
    						<th class="Estilo1">N&deg; Egreso</th>
    						<th class="Estilo1">Documento</th>
    					</thead>
    					<tr>
    						<td class="Estilo1"><?php echo ($row5["eta_fecha_egreso"] <> '') ? date("d-m-Y",strtotime($row5["eta_fecha_egreso"])) : "FALTA EGRESO"?></td>
    						<td class="Estilo1"><?php echo ($row5["eta_num_egreso"] <> '') ? $row5["eta_num_egreso"] : "FALTA EGRESO" ?></td>
    						<td class="Estilo1"><?php echo ($row5["eta_doc_egreso"] <> '') ? "<a href='../../archivos/docfac/".$row5["eta_doc_egreso"]."' target='_blank'>".$row5["eta_doc_egreso"]."</a>" : "FALTA EGRESO" ?></td>
    					</tr>
    				</table>
    			</td>
    		</tr>

				</table>




			</div>
			<div class="modal-footer">
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-success" >Copiar Seleccionados</button>
					<input type="hidden" name="fac_id_destino" value="<?php echo $fac_id_destino ?>">
					<input type="hidden" name="eta_id_destino" value="<?php echo $eta_id_destino ?>">
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
	function valida()
	{
		return confirm("¿ ESTA SEGURO DE COPIAR LOS DOCUMENTOS SELECCIONADOS ?");
	}
</script>