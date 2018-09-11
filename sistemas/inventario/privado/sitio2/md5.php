<?php
extract($_POST);

if(isset($enviar) && $enviar == "ENVIAR")
{
	$password = MD5($password);
	echo $password;
}else{
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ENCRIPTACION MD5</title>
</head>
<body>

<fieldset>
	<legend>ENCRIPTACION A MD5</legend>

	<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
		<tr>
			<td><center>INFORMACION DEL USUARIO</center></td>
		</tr>
	</table>
	<hr>
	<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
	<table border="0" cellpadding="0" cellspacing="0" align="center" width="50%">
		<tr>
			<td>CONTRASEÑA</td>
			<td><input type="password" name="password" id="password"></td>
		</tr>
		<tr>
			<td></td>
			<td>
			<input type="submit" name="enviar" id="enviar" value="ENVIAR">
			<a href="<?php echo $_SERVER["PHP_SELF"]?>">Limpiar</a>
			</td>
		</tr>
	</table>
</form>
</fieldset>
</body>
</html>