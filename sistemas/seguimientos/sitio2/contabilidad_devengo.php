<?
session_start();
extract($_POST);
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SIGEJUN</title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
<style type="text/css">
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
	}
	.Estilo1 {
		font-family: Verdana;
		font-weight: bold;
		font-size: 10px;
		color: #003063;
		text-align: left;
	}
	.Estilo1b {
		font-family: Verdana;
		font-weight: bold;
		font-size: 8px;
		color: #003063;
		text-align: left;
	}
	.Estilo1c {
		font-family: Verdana;
		font-weight: bold;
		font-size: 8px;
		color: #003063;
		text-align: right;
	}
	.Estilo2 {
		font-family: Verdana;
		font-size: 10px;
		text-align: left;
	}
	.Estilo2b {
		font-family: Verdana;
		font-size: 9px;
		text-align: left;
	}
	.link {
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		font-weight: bold;
		color: #00659C;
		text-decoration:none;
		text-transform:uppercase;
	}
	.link:over {
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #0000cc;
		text-decoration:none;
		text-transform:uppercase;
	}
	.Estilo4 {
		font-size: 10px;
		font-weight: bold;
	}
	.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif; 
		font-size: 15px; font-weight: bold; }
	</style>
	<body>
		<div class="navbar-nav ">
			<div class="container">
				<div class="navbar-header">
					<?
					require("inc/top.php");
					?>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-lg-2">
					<div class="dash-unit2">
						<?
						require("inc/menu_1.php");
						?>

					</div>
				</div>

				<div class="col-sm-10 col-lg-10">
					<div class="dash-unit2">
						<table>
							<tr>
								<td class="Estilo7">DEVENGOS</td>
							</tr>
							<tr>
								<td class="link"><a href="menucontabilidad.php?cod=7">VOLVER</a></td>
							</tr>
						</table>
						<br><br>

						<?php
						if ($regionsession==0) {

							$sql="select * from dpp_etapas where  eta_estado=1 and eta_folioguia=0 order by eta_folio desc";

						} else {

     // $sql="select * from dpp_etapas x, dpp_facturas y where x.eta_estado=1 and x.eta_folioguia=0 and x.eta_region='$regionsession' and x.eta_id=y.fac_eta_id order by x.eta_folio desc";
							$sql = "SELECT * FROM dpp_etapas WHERE (eta_estado <> '0' AND eta_estado <> '98' AND eta_estado <> '99') AND (eta_fdevengo = '0000-00-00' OR eta_fdevengo IS NULL) AND eta_region = ".$regionsession." AND eta_fecha_ing >= '2017-04-01'  AND (eta_tipo_doc2 <> 'BH' and eta_tipo_doc2 <> 'BHS' and eta_tipo_doc2 <> 'bh')";

						}
						$res = mysql_query($sql);
						$contador = 1;
						//echo $sql;
						?>
						<form action="contabilidad_devengo_multiple.php" method="POST" onSubmit="return valida()">
							<table class="table table-hover table-borderer table-stripped">
								<thead>
									<tr>
										<th class="Estilo2titulo" colspan="9">DOCUMENTOS PENDIENTE DE DEVENGO</th>
									</tr>
									<th class="Estilo1b">OP</th>
									<th class="Estilo1b">FOLIO</th>
									<th class="Estilo1b">RUT</th>
									<th class="Estilo1b">PROVEEDOR</th>
									<th class="Estilo1b">N&deg; DOCUMENTO</th>
									<th class="Estilo1b">MONTO DOCUMENTO</th>
									<th class="Estilo1b">TIPO DOCUMENTO</th>
									<th class="Estilo1b">RECEPCI&Oacute;N OF. PARTES</th>
									<th class="Estilo1b">EDITAR</th>
								</thead>

								<tbody>
									<?php while($row = mysql_fetch_array($res)) { 
										$sql2 = "SELECT * FROM dpp_facturas WHERE fac_eta_id = ".$row["eta_id"];
										$res2 = mysql_query($sql2);
										$row2 = mysql_fetch_array($res2);


										$vartipodoc1=$row["eta_tipo_doc"];
										if ($vartipodoc1=='Factura') {
											$vartipodoc2=$row["eta_tipo_doc2"];
											if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
												$vartipodoc="Factura";
											if ($vartipodoc2=="b")
												$vartipodoc="Boleta Servicio";
											if ($vartipodoc2=="r")
												$vartipodoc="Recibo";
											if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
												$vartipodoc="N.Credito";
											if ($vartipodoc2=="bh" or $vartipodoc2=="BH" or $vartipodoc2=="BHS")
												$vartipodoc="Honorario";
											if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
												$vartipodoc="N.Débito";
										}
										if ($vartipodoc1=='Honorario') {
											$vartipodoc="Honorario";
										}

										?>
										<tr>
											<td class="Estilo1b"><input type="checkbox" name="var[<?php echo $contador ?>]" value="<?php echo $row["eta_id"] ?>"></td>
											<td class="Estilo1b"><?php echo $row["eta_folio"] ?></td>
											<td class="Estilo1b"><?php echo $row["eta_rut"]."-".$row["eta_dig"] ?></td>
											<td class="Estilo1b"><?php echo $row["eta_cli_nombre"] ?></td>
											<td class="Estilo1b"><?php echo $row["eta_numero"] ?></td>
											<td class="Estilo1b"><?php echo number_format($row["eta_monto"],0,".",".") ?></td>
											<td class="Estilo1b"><?php echo $vartipodoc ?></td>
											<td class="Estilo1b"><?php echo date("d-m-Y",strtotime($row["eta_fecha_recepcion"])) ?></td>
											<td class="Estilo1b"><a href="verdocedit.php?id2=<?php echo $row["eta_id"] ?>&fac_id=<?php echo $row2["fac_id"] ?>"><i class="fa fa-pencil fa-lg"></i></a></td>
										</tr>
										<?php $contador++;} ?>
									</tbody>

									<tfoot>
										<tr>
											<td colspan="9" align="right"><button class="btn btn-success">DEVENGAR SELECCIONADOS</button></td>
										</tr>
									</tfoot>
								</table>
								<input type="hidden" name="totalRegistros" value="<?php echo $contador ?>">
							</form>

							<hr>

							<?php
							if ($regionsession==0) {
								$sql3="SELECT * FROM dpp_etapas a INNER JOIN dpp_facturas b ON a.eta_id = b.fac_eta_id WHERE b.fac_devengo_archivo <> '' AND b.fac_nro_contable <> '' AND a.eta_fechache = '0000-00-00' ORDER BY fac_nro_contable DESC";
							} else {
								$sql3 = "SELECT * FROM dpp_etapas a INNER JOIN dpp_facturas b ON a.eta_id = b.fac_eta_id WHERE b.fac_devengo_archivo <> '' AND b.fac_nro_contable <> '' AND a.eta_region = ".$regionsession." AND a.eta_fechache = '0000-00-00' AND eta_estado <> 99 AND eta_estado <> 98 ORDER BY fac_nro_contable DESC";
							}
							// echo $sql3;
							$res3 = mysql_query($sql3);
							?>
							<div class="alert alert-info" role="alert">
								<i class="fa fa-info-circle fa-lg"></i> <strong>NOTA</strong><br><br>
								El siguiente listado de documentos devengados, estar&aacute; disponible hasta que tesorer&iacute;a realice el pago correspondiente
							</div>
							<table class="table table-hover table-borderer">
								<thead>
									<tr>
										<th class="Estilo2titulo" colspan="9">DOCUMENTOS DEVENGADOS</th>
									</tr>
									<th class="Estilo1b">FOLIO</th>
									<th class="Estilo1b">RUT</th>
									<th class="Estilo1b">PROVEEDOR</th>
									<th class="Estilo1b">N&deg; DOCUMENTO</th>
									<th class="Estilo1b">MONTO DOCUMENTO</th>
									<th class="Estilo1b">TIPO DOCUMENTO</th>
									<th class="Estilo1b">RECEPCI&Oacute;N OF. PARTES</th>
									<th class="Estilo1b">COMPROBANTE CONTABLE</th>
									<th class="Estilo1b">FECHA DEVENGO</th>
									<th class="Estilo1b">LIBRO DE COMPRAS</th>
								</thead>

								<tbody>
									<?php while($row3 = mysql_fetch_array($res3)) { 
										$vartipodoc1=$row3["eta_tipo_doc"];
										if ($vartipodoc1=='Factura') {
											$vartipodoc2=$row3["eta_tipo_doc2"];
											if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
												$vartipodoc="Factura";
											if ($vartipodoc2=="b")
												$vartipodoc="Boleta Servicio";
											if ($vartipodoc2=="r")
												$vartipodoc="Recibo";
											if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
												$vartipodoc="N.Credito";
											if ($vartipodoc2=="bh" or $vartipodoc2=="BH" or $vartipodoc2=="BHS")
												$vartipodoc="Honorario";
											if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
												$vartipodoc="N.Débito";
										}
										if ($vartipodoc1=='Honorario') {
											$vartipodoc="Honorario";
										}

										$doc3=$row3["eta_tipo_doc3"];
										if ($doc3=="" || $doc3==null) {
											$muestra4="<i class='fa fa-warning fa-lg'></i>";
											$href4="verdocedit.php?id2=".$row3["eta_id"];
										}
										if ($doc3<>"") {
                      						$muestra4="<i class='fa fa-check fa-lg'></i>";
                      						$href4="#";
                    						}

										?>
										<tr>
											<td class="Estilo1b"><?php echo $row3["eta_folio"] ?></td>
											<td class="Estilo1b"><?php echo $row3["eta_rut"]."-".$row3["eta_dig"] ?></td>
											<td class="Estilo1b"><?php echo $row3["eta_cli_nombre"] ?></td>
											<td class="Estilo1b"><?php echo mb_convert_encoding($row3["eta_numero"],"ISO-8859-1") ?></td>
											<td class="Estilo1b"><?php echo number_format($row3["eta_monto"],0,".",".") ?></td>
											<td class="Estilo1b"><?php echo $vartipodoc ?></td>
											<td class="Estilo1b"><?php echo $row3["eta_fecha_recepcion"] ?></td>
											<td class="Estilo1b"><a href="../../archivos/docfac/<?php echo $row3["fac_devengo_archivo"] ?>" target="_blank"><?php echo $row3["fac_nro_contable"] ?></a></td>
											<td class="Estilo1b"><?php echo date("d-m-Y",strtotime($row3["eta_fdevengo"])) ?></td>
											<td class="Estilo1b link"><a href="<? echo $href4; ?>"><? echo $muestra4 ?></a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>

				<script type="text/javascript">
					function valida()
					{
						var numberOfChecked = $('input:checkbox:checked').length;
						if(numberOfChecked > 0)
						{
							return confirm("SE HAN SELECCIONADO ("+numberOfChecked+") DOCUMENTOS, ¿ DESEA CONTINUAR CON LA OPERACION ?");
						}else{
							alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA.");
							return false;
						}
					}
				</script>
			</body>
			</html>			