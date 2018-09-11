<?php
session_start();
require("inc/config.php");
if(isset($_REQUEST["id"]) && is_numeric($_REQUEST["id"]))
{
	$query = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_id = ".$_REQUEST["id"]." AND a.guia_origen = ".$_REQUEST["guia_origen"];
	$query = mysql_query($query);
	$datos = mysql_fetch_array($query); 

	$query2 = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_id = c.inv_id WHERE a.guia_id = ".$_REQUEST["id"]." AND a.guia_origen = ".$_REQUEST["guia_origen"];
	$query2 = mysql_query($query2);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>

	<script src="librerias/jquery-1.11.3.min.js"></script>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">

</head>
<body>
	<div style="background-color:#E0F8E0;" id="div2">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">DETALLE</td>
			</tr>
		</table>	

		<hr>

		<table border="0" width="100%" align="center">
			<tr>
				<td class="Estilo1">N° GUIA</td>
				<td class="Estilo1"><input type="text" class="Estilo1" disabled value="<?php echo $datos["guia_numero"] ?>"></td>

				<td class="Estilo1">FECHA EMISION</td>
				<td class="Estilo1"><input type="text" class="Estilo1" disabled value="<?php echo $datos["guia_emision"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">ABASTECE</td>
				<td class="Estilo1"><input type="text" class="Estilo1" disabled value="<?php echo $datos["guia_abastece"] ?>"></td>
				<td class="Estilo1">DESTINATARIO</td>
				<td class="Estilo1"><input type="text" class="Estilo1" disabled value="<?php echo $datos["guia_destinatario"] ?>"></td>
			</tr>

			<tr>
				<td  class="Estilo1">DIRECCION</td>
				<td class="Estilo1"><input type="text" class="Estilo1" disabled value="<?php echo $datos["guia_direccion"] ?>"></td>
				<td  class="Estilo1">ZONA</td>
				<td class="Estilo1"><input type="text" class="Estilo1" disabled value="<?php echo $datos["guia_zona"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">COMUNA</td>
				<td class="Estilo1"><input type="text" class="Estilo1" disabled value="<?php echo $datos["guia_comuna"] ?>"></td>
				<td class="Estilo1">RESPONSABLE</td>
				<td class="Estilo1"><input type="text" value="<?php echo $datos["inv_responsable"] ?>" class="Estilo1" disabled></td>
			</tr>

			<tr>
				<td class="Estilo1">OBSERVACION</td>
				<td class="Estilo1" colspan="5"><textarea style="margin: 0px; width:819px; height: 205px;" disabled><?php echo $datos["guia_obs"] ?></textarea></td>
			</tr>

			<tr>
				<td class="Estilo1">EMISOR</td>
				<td class="Estilo1" colspan="5"><input type="text" value="<?php echo $datos["guia_emisor"] ?>" size="70" class="Estilo1" disabled></td>
			</tr>

		</table>

		<hr>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">DETALLE</td>
			</tr>
		</table>

		<table border="0" width="100%">
				<tr>
					<td class="Estilo1mc">CODIGO DE INVENTARIO</td>
					<td class="Estilo1mc">PRODUCTO</td>
					<td class="Estilo1mc">ABASTECE</td>
					<td class="Estilo1mc">DESTINATARIO</td>
					<td class="Estilo1mc">FECHA EMISION</td>
					<td class="Estilo1mc">DIRECCION</td>
					<td class="Estilo1mc">COMUNA</td>
					<td class="Estilo1mc">EMISOR</td>
					<td class="Estilo1mc">RESPONSABLE ANTERIOR</td>
					</tr>

					<?php while ($row = mysql_fetch_array($query2)) { ?>
					<tr>
						<td class="Estilo1mc"><?php echo $row["detalle_inv_codigo"] ?></td>
						<td class="Estilo1mc"><?php echo $row["inv_bien"] ?></td>
						<td class="Estilo1mc"><?php echo $row["guia_abastece"] ?></td>
						<td class="Estilo1mc"><?php echo $row["guia_destinatario"] ?></td>
						<td class="Estilo1mc"><?php echo $row["guia_emision"] ?></td>
						<td class="Estilo1mc"><?php echo $row["guia_direccion"] ?></td>
						<td class="Estilo1mc"><?php echo $row["guia_comuna"] ?></td>
						<td class="Estilo1mc"><?php echo utf8_decode($row["guia_emisor"]) ?></td>
						<td class="Estilo1mc"><?php echo $datos["detalle_responsable_anterior"] ?></td>
			</tr>
					</tr>
					<?php } ?>
			</table>
			<br>
			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="10"><button onclick="cerrarVentana()">CERRAR VENTANA</button></td>
				</tr>
			</table>

		</div>

		<script type="text/javascript">
			function cerrarVentana(){
				window.close();
			}
		</script>
	</body>
	</html>