<?php
session_start();
require("inc/config.php");
extract($_GET);
$claves = array("JI ", "BR ", "DR ");
$codigo = str_replace($claves, "", $codigo);
$sql = "SELECT * FROM jardines WHERE jardin_codigo = '".$codigo."' LIMIT 1";
$sql = mysql_query($sql);
$numRows = mysql_num_rows($sql);
$sql = mysql_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

	<style type="text/css">
		.Estilo2titulo{
			text-align: left;
		}
	</style>
</head>
<body>
	<div style="background-color:#E0F8E0;" id="div1">

		<?php if ($numRows === 1): ?>
			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo"><center>DETALLE JARDIN</center></td>
				</tr>
			</table>
			<br>
			<hr>
			<table border="0" width="100%">
				<tr>
					<td class="Estilo1">CODIGO</td>
					<td class="Estilo2titulo"><?php echo $sql["jardin_codigo"] ?></td>
				</tr>

				<tr>
					<td class="Estilo1">PROVINCIA</td>
					<td class="Estilo2titulo"><?php echo $sql["jardin_provincia"] ?></td>
				</tr>


				<tr>
					<td class="Estilo1">COMUNA</td>
					<td class="Estilo2titulo"><?php echo $sql["jardin_comuna"] ?></td>
				</tr>

				<tr>
					<td class="Estilo1">NOMBRE</td>
					<td class="Estilo2titulo"><?php echo $sql["jardin_nombre"] ?></td>
				</tr>

				<tr>
					<td class="Estilo1">DIRECCION</td>
					<td class="Estilo2titulo"><?php echo $sql["jardin_direccion"] ?></td>
				</tr>

				<tr>
					<td class="Estilo1">PROGRAMA</td>
					<td class="Estilo2titulo"><?php echo $sql["jardin_programa"] ?></td>
				</tr>

				<tr>
					<td class="Estilo1">TELEFONO</td>
					<td class="Estilo2titulo"><?php echo $sql["jardin_telefono"] ?></td>
				</tr>

			</table>

		<?php else: ?>
			NO SE HAN ENCONTRADO RESULTADOS
		<?php endif ?>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo1c"><button onClick="cerrarVentana()">CERRAR VENTANA</button></td>
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