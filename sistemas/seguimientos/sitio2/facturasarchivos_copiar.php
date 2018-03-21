
<?php
require_once("inc/config.php");
session_start();
extract($_POST);
extract($_GET);
$annio = date("Y");
?>
<!DOCTYPE html>
<html>
<head>
	<title>SIGEJUN</title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
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

	<!-- main calendar program -->
	<script type="text/javascript" src="librerias/calendar.js"></script>

	<!-- language for the calendar -->
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
  adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

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

  					<table width="100%">
  					<tbody>
  						<tr>
  							<td align="left"><span class="Estilo7">COPIAR SET DE PAGO</span></td>
  						</tr>
  						<tr>
  							<td align="left"><a href="facturasarchivos.php?id=<?php echo $_GET["id"] ?>&id1b=<?php echo $_GET["id1b"] ?>" class="link">VOLVER</a></td>
  						</tr>
	
		<tr>
			<td height="20px"></td>
		</tr>

  						<tr>
  							<td>
  								<div class="alert alert-warning" role="alert">
  								<i class="fa fa-warning"></i>	En esta seccion se podra seleccionar el documento del cual se desea copiar la documentacion adjunta.
  								</div>
  							</td>
  						</tr>
  					</tbody>
  					</table>
<hr>
  					<?php
  					$sql2 = "SELECT * FROM dpp_etapas WHERE eta_rut = ".$rut." AND eta_dig = '".$dv."' AND eta_region = ".$region." AND eta_folioguia2 <> 0 AND YEAR(eta_fecha_recepcion) = ".$annio." AND eta_asignado <> '' AND eta_fechaguia2 <> '0000-00-00 00:00:00' ORDER BY eta_fechaguia2 DESC";
  					$res2 = mysql_query($sql2);

  					if(mysql_num_rows($res2) > 0) { ?>
  					<table border="1" class="table table-hover table-stripped">
  						<thead>
  							<th class="Estilo1">Folio</th>
  							<th class="Estilo1">Rut</th>
  							<th class="Estilo1">N&deg; Documento</th>
  							<th class="Estilo1">Tipo Documento</th>
  							<th class="Estilo1">Monto Documento</th>
  							<th class="Estilo1">Asignado</th>
                <th class="Estilo1">Fecha Env&iacute;o Contabilidad</th>
  							<th class="Estilo1">Ver Documentos</th>
  						</thead>
  						<tbody>
  							<?php while($row2 = mysql_fetch_array($res2)) { 
  								$sql3 = "SELECT * FROM dpp_facturas WHERE fac_eta_id = ".$row2["eta_id"];
  								$res3 = mysql_query($sql3);
  								$row3 = mysql_fetch_array($res3);

  								$vartipodoc1=$row2["eta_tipo_doc"];
										if ($vartipodoc1=='Factura') {
											$vartipodoc2=$row2["eta_tipo_doc2"];
                      if($vartipodoc2 == "FEL")
                        $vartipodoc = "Factura Electronica";
                       if($vartipodoc2 == "FELEX")
                        $vartipodoc = "Factura Exenta Electronica";
											if ($vartipodoc2=="f")
												$vartipodoc="Factura";
											if ($vartipodoc2=="b")
												$vartipodoc="Boleta Servicio";
											if ($vartipodoc2=="r")
												$vartipodoc="Recibo";
											if ($vartipodoc2=="n")
												$vartipodoc="N.Credito";
											if ($vartipodoc2=="bh" or $vartipodoc2=="BH" or $vartipodoc2=="BHS")
												$vartipodoc="Honorario";
										}
										if ($vartipodoc1=='Honorario') {
											$vartipodoc="Honorario";
										}

  								?>
  								<tr>
  									<td class="Estilo1"><?php echo $row2["eta_folio"] ?></td>
  									<td class="Estilo1"><?php echo number_format($row2["eta_rut"],0,".",".")."-".$row2["eta_dig"] ?></td>
  									<td class="Estilo1"><?php echo $row2["eta_numero"] ?></td>
  									<td class="Estilo1"><?php echo $vartipodoc ?></td>
  									<td class="Estilo1">$<?php echo number_format($row2["eta_monto"],0,".",".") ?></td>
  									<td class="Estilo1"><?php echo $row2["eta_asignado"] ?></td>
  									<td class="Estilo1"><?php echo date("d-m-Y",strtotime($row2["eta_fechaguia2"])) ?></td>
                    <td class="Estilo1"><a href="#" onClick="abrirVentana('<?php echo $row3["fac_id"] ?>','<?php echo $row2["eta_id"] ?>','<?php echo $id ?>','<?php echo $id1b ?>')">VER</a></td>
  								</tr>
  								<?php } ?>
  							</tbody>
  						</table>
  						<?php }else{ ?>
  						<div class="alert alert-danger" role="alert">
  							No se han encontrado resultados
  						</div>
  						<?php } ?>

  					</div>
  				</div>
  			</div>
  		</div>

  		<script type="text/javascript">
  			function abrirVentana(fac_id,eta_id,fac_id_destino,eta_id_destino){
  				miPopup = window.open("compra_documentos3.php?fac_id="+fac_id+"&eta_id="+eta_id+"&fac_id_destino="+fac_id_destino+"&eta_id_destino="+eta_id_destino,"miwin","width=900,height=600,scrollbars=yes,toolbar=0")
  				miPopup.focus()
  			}
  		</script>
  	</body>
  	</html>		