<?php
session_start();
// Traemos la informacion del contenedor desde la BD
include_once("inc/config.php");
extract($_GET);
extract($_POST);
$sql = "SELECT * FROM bode_contenedor WHERE contenedor_id =".$cid." LIMIT 1";
$sql = mysql_query($sql);
$sql = mysql_fetch_array($sql);

// Actualizar la informacion
if(isset($enviar) AND $enviar == "ACTUALIZAR")
{
	$update = "UPDATE bode_contenedor SET contenedor_numero = '".strtoupper($contenedor_numero)."', contenedor_dpto = '".strtoupper($contenedor_dpto)."', contenedor_direccion = '".strtoupper($contenedor_direccion)."', contenedor_seccion = '".strtoupper($contenedor_seccion)."', contenedor_funcionario = '".strtoupper($contenedor_funcionario)."', contenedor_jefe_func = '".strtoupper($contenedor_jefe_func)."', contenedor_anexo = '".strtoupper($contenedor_anexo)."' WHERE contenedor_id = ".$cid;
	mysql_query($update);

		$fechamia=date('Y-m-d');
	$horaSys = Date("H:i:s");
	$log = "INSERT INTO log VALUES(NULL,".$cid.",0,'ACTUALIZA CONTENEDOR','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTOS - CONTENEDOR')";
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
					<td class="Estilo2titulo" colspan="10">DETALLE CONTENEDOR</td>
				</tr>
			</table>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
<table border="1" cellpadding="0" cellspacing="0" width="100%">
	<tr class="Estilo1">
		<td>NUMERO CONTENEDOR</td>
		<td><input type="text" name="contenedor_numero" id="contenedor_numero" value="<?php echo $sql["contenedor_numero"] ?>" class="Estilo1"></td>
	</tr>

	<tr class="Estilo1">
		<td>DEPARTAMENTO</td>
		<td><input type="text" name="contenedor_dpto" id="contenedor_dpto" value="<?php echo $sql["contenedor_dpto"] ?>" class="Estilo1"size="30"></td>
	</tr>

	<tr class="Estilo1">
		<td>DIRECCION</td>
		<td><input type="text" name="contenedor_direccion" id="contenedor_direccion" value="<?php echo $sql["contenedor_direccion"] ?>" class="Estilo1" size="30"></td>
	</tr>

	<tr class="Estilo1">
		<td>SECCION</td>
		<td><input type="text" name="contenedor_seccion" id="contenedor_seccion" value="<?php echo $sql["contenedor_seccion"] ?>" class="Estilo1" size="30"></td>
	</tr>

	<tr class="Estilo1">
		<td>FUNCIONARIO RESPONSABLE</td>
		<td><input type="text" name="contenedor_funcionario" id="contenedor_funcionario" value="<?php echo $sql["contenedor_funcionario"] ?>" class="Estilo1" size="30"></td>
	</tr>

	<tr class="Estilo1">
		<td>JEFE FUNCIONARIO</td>
		<td><input type="text" name="contenedor_jefe_func" id="contenedor_jefe_func" value="<?php echo $sql["contenedor_jefe_func"] ?>" class="Estilo1" size="30"></td>
	</tr>

	<tr class="Estilo1">
		<td>ANEXO</td>
		<td><input type="text" name="contenedor_anexo" id="contenedor_anexo" value="<?php echo $sql["contenedor_anexo"] ?>" class="Estilo1"></td>
	</tr>
	<tr class="Estilo1">
		<td></td>
		<td><input type="submit" name="enviar" id="enviar" value="ACTUALIZAR"></td>
	</tr>
</table>
<input type="hidden" name="cid" id="cid" value="<?php echo $cid ?>">
</form>
</div>
</body>
</html>