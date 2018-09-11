<?php
session_start();
require_once("inc/config.php");
extract($_GET);
extract($_POST);
$regionsession = $_SESSION["region"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>INEDIS</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>

</head>
<body>
	<div style="background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>
	<div class="container">
		<div style="width:800px;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
			<table border="0" width="100%">
				<tr>
					<td>
						<table border="1" width="100%">
							<tr>
								<td class="Estilo2titulo">SOLICITUDES DE PEDIDO PENDIENTES DE ENVÍO</td>
							</tr>

						</table>

						<table width="100%" border="1">
							<tr>
								<td class="Estilo1mc">ID</td>
								<td class="Estilo1mc">N° PEDIDO</td>
								<td class="Estilo1mc">N° IDENTIFICADOR MATRIZ</td>
								<td class="Estilo1mc">FECHA SOLICITUD</td>
								<td class="Estilo1mc">DESTINO</td>
								<td class="Estilo1mc">EDITAR</td>
								<td class="Estilo1mc">ELIMINAR</td>
							</tr>

							<?php 
							$sql = "SELECT * FROM bode_solicitud WHERE sp_estado = 0 AND sp_region = ".$regionsession." AND sp_usuario = '".$nom_user."'";
							$res = mysql_query($sql);
							while($row = mysql_fetch_array($res)){ ?>
							<tr <?php if($id==$row["sp_id"]){echo$color;} ?>>
								<td class="Estilo1mc"><?php echo $row["sp_id"] ?></td>
								<td class="Estilo1mc"><?php echo ($row["sp_folio"] == 0 || $row["sp_folio"] == "") ? "FOLIO SIN ASIGNAR" : "" ?></td>
								<td class="Estilo1mc"><?php echo($row["sp_matriz"] == NULL) ? "SIN MATRIZ" : $row["sp_matriz"] ?></td>
								<td class="Estilo1mc"><?php echo substr($row["sp_fecha"], 8,9)."-".substr($row["sp_fecha"], 5,2)."-".substr($row["sp_fecha"],0,4) ?></td>
								<td class="Estilo1mc"><?php echo $row["sp_destino"] ?> / <?php echo ($row["sp_tipo_destino"] == 2) ? "OFICINA" : "JARDIN INFANTIL" ?></td>
								<td class="Estilo1mc"><a href="bode_inv_indexoc7.php?ori=2&id=<?php echo $row["sp_id"] ?>&sp_matriz=<?php echo $row["sp_matriz"] ?>" class="link"><i class="fa fa-pencil"></i></a></td>
								<td class="Estilo1mc"><a href="bode_solicitud_eliminar.php?id=<?php echo $row["sp_id"] ?>" onClick="return confirm('¿ ESTÁ SEGURO DE ELIMINAR LA SOLICITID N° <?php echo $row["sp_id"] ?>  ?')"><i class="fa fa-trash link fa-lg"></i></a></td>
							</tr>
							<? } ?>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<!-- SOLICITUDES ENVIADAS PERO PENDIENTES DE DESPACHO -->
						<table border="1" width="100%">
							<tr>
								<td class="Estilo2titulo">SOLICITUDES DE PEDIDO PENDIENTES DE DESPACHO</td>
							</tr>

						</table>

						<table width="100%" border="1">
							<tr>
								<td class="Estilo1mc">ID</td>
								<td class="Estilo1mc">N° PEDIDO</td>
								<td class="Estilo1mc">N° IDENTIFICADOR MATRIZ</td>
								<td class="Estilo1mc">FECHA SOLICITUD</td>
								<td class="Estilo1mc">DESTINO</td>
								<td class="Estilo1mc">VER</td>
							</tr>

							<?php 
							$sql = "SELECT * FROM bode_solicitud WHERE sp_estado = 1 AND sp_region = ".$regionsession." AND sp_usuario = '".$nom_user."'";
							$res = mysql_query($sql);
							while($row = mysql_fetch_array($res)) { ?>
							<tr <?php echo$color2 ?>>
								<td class="Estilo1mc"><?php echo $row["sp_id"] ?></td>
								<td class="Estilo1mc"><?php echo $row["sp_folio"] ?></td>
								<td class="Estilo1mc"><?php echo($row["sp_matriz"] == NULL) ? "SIN MATRIZ" : $row["sp_matriz"] ?></td>
								<td class="Estilo1mc"><?php echo substr($row["sp_fecha"], 8,9)."-".substr($row["sp_fecha"], 5,2)."-".substr($row["sp_fecha"],0,4) ?></td>
								<td class="Estilo1mc"><?php echo $row["sp_destino"] ?> / <?php echo ($row["sp_tipo_destino"] == 2) ? "OFICINA" : "JARDIN INFANTIL" ?></td>
								<td class="Estilo1mc"><a href="#" onClick="abrirVentana(<?php echo $row["sp_id"] ?>)"><i class="fa fa-eye fa-lg"></i></a></td>
							</tr>
							<? } ?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<!-- SOLICITUDES 100% DESPACHADA -->
						<table border="1" width="100%">
							<tr>
								<td class="Estilo2titulo">SOLICITUDES DE PEDIDO COMPLETADAS</td>
							</tr>

						</table>

						<table width="100%" border="1">
							<tr>
								<td class="Estilo1mc">ID</td>
								<td class="Estilo1mc">N° PEDIDO</td>
								<td class="Estilo1mc">N° IDENTIFICADOR MATRIZ</td>
								<td class="Estilo1mc">FECHA SOLICITUD</td>
								<td class="Estilo1mc">DESTINO</td>
								<td class="Estilo1mc">VER</td>
							</tr>

							<?php 
							$sql = "SELECT * FROM bode_solicitud WHERE sp_estado = 2 AND sp_region = ".$regionsession." AND sp_usuario = '".$nom_user."'";
							$res = mysql_query($sql);
							while($row = mysql_fetch_array($res)){ ?>
							<tr <?php if($id==$row["sp_id"]){echo$color;}else{echo$color3;} ?>>
								<td class="Estilo1mc"><?php echo $row["sp_id"] ?></td>
								<td class="Estilo1mc"><?php echo $row["sp_folio"] ?></td>
								<td class="Estilo1mc"><?php echo($row["sp_matriz"] == NULL) ? "SIN MATRIZ" : $row["sp_matriz"] ?></td>
								<td class="Estilo1mc"><?php echo substr($row["sp_fecha"], 8,9)."-".substr($row["sp_fecha"], 5,2)."-".substr($row["sp_fecha"],0,4) ?></td>
								<td class="Estilo1mc"><?php echo $row["sp_destino"] ?> / <?php echo ($row["sp_tipo_destino"] == 2) ? "OFICINA" : "JARDIN INFANTIL" ?></td>
								<td class="Estilo1mc"><a href="#" onClick="abrirVentana(<?php echo $row["sp_id"] ?>)"><i class="fa fa-eye fa-lg"></i></a></td>
							</tr>
							<? } ?>
						</table>
					</td>
				</tr>
			</table>
		</div>

	</div>

	<script type="text/javascript">
		function abrirVentana(id)
		{
			window.open("bode_solicitud_popup_detalle.php?id="+id,"miwin","channelmode=0,directories=0,fullscreen=0,height=500,location=0,menubar=0,resizable=0,scrollbars=1,status=0,titlebar=0,toolbar=0,width=1000")
		}
	</script>
</body>
</html>