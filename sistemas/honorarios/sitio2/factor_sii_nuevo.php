<?php
require_once("inc/config.php");
extract($_POST);
if($enviar)
{
// print_r($_POST);
$sql = "INSERT INTO factor_sii VALUES (NULL,'".$factor_1."','".$factor_2."','".$factor_3."','".$factor_4."','".$factor_5."','".$factor_6."','".$factor_7."','".$factor_8."','".$factor_9."','".$factor_10."','".$factor_11."','".$factor_12."','".$factor_ano."',1)";
if(mysql_query($sql)){
	echo "<script>alert('Registros insertados con exito');window.close();</script>";
}else{
	echo "<script>alert('Ha ocurrido un error al grabar.');window.close();</script>";
}
}
?>

<form action="factor_sii_nuevo.php" method="POST">
<table border="1" width="100%">
	<tr>
		<td>Mes</td>
		<td>Factor</td>
	</tr>

	<tr>
		<td>Enero</td>
		<td><input type="text" name="factor_1" id="factor_1" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Febrero</td>
		<td><input type="text" name="factor_2" id="factor_2" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Marzo</td>
		<td><input type="text" name="factor_3" id="factor_3" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Abril</td>
		<td><input type="text" name="factor_4" id="factor_4" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Mayo</td>
		<td><input type="text" name="factor_5" id="factor_5" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Junio</td>
		<td><input type="text" name="factor_6" id="factor_6" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Julio</td>
		<td><input type="text" name="factor_7" id="factor_7" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Agosto</td>
		<td><input type="text" name="factor_8" id="factor_8" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Septiembre</td>
		<td><input type="text" name="factor_9" id="factor_9" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Octubre</td>
		<td><input type="text" name="factor_10" id="factor_10" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Noviembre</td>
		<td><input type="text" name="factor_11" id="factor_11" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>
	<tr>
		<td>Diciembre</td>
		<td><input type="text" name="factor_12" id="factor_12" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></td>
	</tr>

	<tr>
		<td colspan="2">
			<button>GRABAR</button>
		</td>
	</tr>
</table>
<input type="hidden" name="enviar" value="1">
<input type="hidden" name="factor_ano" value="<?php echo $_REQUEST["factor_ano"] ?>">
</form>