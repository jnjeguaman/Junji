<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<script type="text/javascript" src="librerias/jquery.Rut.js"></script>

</head>
<body>
	<fieldset>
		<legend>NUEVO PROVEEDOR</legend>
		<form action="graba_proveedor.php" method="POST">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td>NOMBRE EMPRESA (*)</td>
					<td><input type="text" name="proveedor_glosa" id="proveedor_glosa" required></td>
				</tr>

				<tr>
					<td>RUT (*)</td>
					<td><input type="text" name="proveedor_rut" id="proveedor_rut" required></td>
				</tr>

				<tr>
					<td>NOMBRE CONTACTO (*)</td>
					<td><input type="text" name="proveedor_contacto" id="proveedor_contacto" required></td>
				</tr>

				<tr>
					<td>EMAIL (OPCIONAL)</td>
					<td><input type="text" name="proveedor_email" id="proveedor_email"></td>
				</tr>

				<tr>
					<td>TELEFONO (OPCIONAL)</td>
					<td><input type="text" name="proveedor_telefono" id="proveedor_telefono"></td>
				</tr>

				<tr>
					<td></td>
					<td><input type="submit" value="   INGRESAR PROVEEDOR   "/></td>
				</tr>

			</table>
			<input type="hidden" name="proveedor_estado" id="proveedor_estado" value="1"/>
		</form>
	</fieldset>

	<script type="text/javascript">
		$(function(){
			$("#proveedor_rut").Rut();
		})
	</script>

</body>
</html>