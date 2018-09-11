<?php
session_start();
include_once("inc/config.php");
// Ingresamos el nuevo contenedor a la BD
extract($_POST);
if(isset($enviar) AND $enviar == "AGREGAR")
{
	$insert = "INSERT INTO bode_contenedor VALUES(null,'".strtoupper($contenedor_numero)."', '".strtoupper($contenedor_dpto)."', '".strtoupper($contenedor_direccion)."', '".strtoupper($contenedor_seccion)."', '".strtoupper($contenedor_funcionario)."', '".strtoupper($contenedor_jefe_func)."', '".strtoupper($contenedor_anexo)."')";
	mysql_query($insert);

	$fechamia=date('Y-m-d');
	$horaSys = Date("H:i:s");
	$log = "INSERT INTO log VALUES(NULL,".mysql_insert_id().",0,'NUEVO CONTENEDOR','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTOS - CONTENEDOR')";
	mysql_query($log);

	echo "<script>opener.location.reload(); window.close();</script>";

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div style="background-color:#E0F8E0; position:absolute;width:100%" id="div1">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">AGREGAR NUEVO CONTENEDOR</td>
			</tr>
		</table>
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				<tr class="Estilo1">
					<td>NUMERO CONTENEDOR</td>
					<td><input type="text" name="contenedor_numero" id="contenedor_numero" class="Estilo1"></td>
				</tr>

				<tr class="Estilo1">
					<td>DEPARTAMENTO</td>
					<td><input type="text" name="contenedor_dpto" id="contenedor_dpto" class="Estilo1"size="30"></td>
				</tr>

				<tr class="Estilo1">
					<td>DIRECCION</td>
					<td><input type="text" name="contenedor_direccion" id="contenedor_direccion" class="Estilo1" size="30"></td>
				</tr>

				<tr class="Estilo1">
					<td>SECCION</td>
					<td><input type="text" name="contenedor_seccion" id="contenedor_seccion" class="Estilo1" size="30"></td>
				</tr>

				<tr class="Estilo1">
					<td>FUNCIONARIO RESPONSABLE</td>
					<td><input type="text" name="contenedor_funcionario" id="contenedor_funcionario" class="Estilo1" size="30"></td>
				</tr>

				<tr class="Estilo1">
					<td>JEFE FUNCIONARIO</td>
					<td><input type="text" name="contenedor_jefe_func" id="contenedor_jefe_func" class="Estilo1" size="30"></td>
				</tr>

				<tr class="Estilo1">
					<td>ANEXO</td>
					<td><input type="text" name="contenedor_anexo" id="contenedor_anexo" class="Estilo1"></td>
				</tr>
				<tr class="Estilo1">
					<td></td>
					<td><input type="submit" name="enviar" id="enviar" value="AGREGAR"></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>