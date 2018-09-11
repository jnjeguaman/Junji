<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
</head>
<body>

	<?php
	extract($_POST);
	extract($_GET);
	require_once("inc/config.php");

	// TRANSPORTES ACTUALES DEL SISTEMA
	$transportes = mysql_query("SELECT * FROM bode_transporte a INNER JOIN acti_proveedor b ON b.proveedor_id = a.transporte_empresa_id WHERE transporte_estado = 1");

	?>
	<div  style="width:100%; background-color:#E0F8E0; position:absolute;" id="div2">
		<form action="bode_desp_gr.php" method="POST" onsubmit="return valida()">
			<table border="1" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="2"><center>AGREGA TRANSPORTISTA</center></td>
				</tr>

				<tr>
					<td class="Estilo1">PROVEEDOR</td>
					<td class="Estilo1">
						<select id="transporte_id" name="transporte_id" class="Estilo1mc" required>
							<option value="">Seleccionar...</option>
							<?php while($row = mysql_fetch_array($transportes)) { ?>
								<option value="<?php echo $row["proveedor_id"]?>"><?php echo strtoupper($row["proveedor_glosa"]) ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">PATENTE VEHICULO</td>
						<td class="Estilo1"><input type="text" name="patente_glosa" id="patente_glosa" required class="Estilo1"></td>
					</tr>

					<tr>
						<td colspan="2"><button type="submit">AGREGAR</button></td>
					</tr>
				</table>
				<input type="hidden" name="cmd" value="AgregarPatente">
			</form>

			<?php if (isset($exito)): ?>
			<?php if ($exito == 1): ?>
				<p class="Estilo1mc">Registro insertado con Exito! <i class="fa fa-check fa-lg"></i></p>
			<?php else: ?>
				<p class="Estilo1mc" style="color:red;">Ha ocurrido un error al agregar la patente.<i class="fa fa-warning fa-lg"></i></p>
			<?php endif ?>
		<?php endif ?>
		</div>

		<script type="text/javascript">
			function valida()
			{
				return confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?");
			}
		</script>

	</body>
	</html>