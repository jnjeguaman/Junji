<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/jquery.Rut.js"></script>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

	<script type="text/javascript">
		$(function(){
			$("#ProveedorExistente").hide();
			$("#ProveedorNuevo").hide();
			$("#proveedor_rut").Rut({
				on_error: function(){ alert('RUT INCORRECTO.'); 
				$("#proveedor_rut").val("");
				document.getElementById('proveedor_rut').focus();}
			});
		});
	</script>
</head>
<body>


<?php
extract($_POST);
extract($_GET);
session_start();
require_once("inc/config.php");

// BUSCAMOS A LOS PROVEEDORES EXISTENTES DEL SISTEMA
$proveedor = mysql_query("SELECT * FROM acti_proveedor WHERE proveedor_estado = 1 AND proveedor_id NOT IN (SELECT transporte_empresa_id FROM bode_transporte) ORDER BY proveedor_glosa ASC");

// PROVEEDORES DE TRANSPORTE INGRESADOS
$proveedor2 = mysql_query("SELECT * FROM acti_proveedor WHERE proveedor_estado = 2");

?>

<div  style="width:100%; background-color:#E0F8E0; position:absolute;" id="div2">

	<table border="1" width="100%" width="100%">
		<tr>
			<td class="Estilo2titulo"><center>AGREGAR TRANSPORTE</center></td>
		</tr>

		<tr>
			<td class="Estilo1">
			<center>
			<input type="radio" name="tipo" class="tipo" value="ProveedorExistente">PROVEEDOR EXISTENTE
			<input type="radio" name="tipo" class="tipo" value="ProveedorNuevo">PROVEEDOR NUEVO
			</center>
			</td>
		</tr>
	</table>
	<hr>
	
	<div id="ProveedorExistente" >
		<form action="bode_desp_gr.php" method="POST" onSubmit="return valida()">
			<table border="1" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="2"><center>PROVEEDORES</center></td>
				</tr>

				<tr>
					<td class="Estilo1">PROVEEDOR</td>
					<td class="Estilo1">
						<select id="proveedore" name="proveedore" class="Estilo1mc" required>
							<option value="">Seleccionar...</option>
							<?php while($row = mysql_fetch_array($proveedor)) { ?>
								<option value="<?php echo $row["proveedor_id"]?>"><?php echo strtoupper($row["proveedor_glosa"]) ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>

					<tr>
						<td colspan="2"><center><button type="submit">AGREGAR</button></center></td>
					</tr>
				</table>
				<input type="hidden" name="cmd" value="AgregaE">
			</form>
		</div>

		<div id="ProveedorNuevo">
			<form action="bode_desp_gr.php" method="POST" onSubmit="return valida2()">
				<table border="1" width="100%">
					<tr>
						<td class="Estilo2titulo" colspan="2"><center>NUEVO PROVEEDOR</center></td>
					</tr>

					<tr>
						<td class="Estilo1">PROVEEDOR</td>
						<td class="Estilo1"><input type="text" name="proveedor_glosa" id="proveedor_glosa" required class="Estilo1" size="60"></td>
					</tr>

					<tr>
						<td class="Estilo1">RUT</td>
						<td class="Estilo1"><input type="text" name="proveedor_rut" id="proveedor_rut" required class="Estilo1"></td>
					</tr>

					<tr>
						<td class="Estilo1" colspan="2"><center><button type="submit">AGREGAR</button></center></td>
					</tr>

				</table>
				<input type="hidden" name="cmd" value="AgregaN">
			</form>
		</div>

			<?php if ($exito == 1): ?>
				Registro insertado con Exito! <i class="fa fa-check fa-lg"></i>
			<?php else: ?>
				<i class="fa fa-warning fa-lg"></i> Error al insertar
			<?php endif ?>
	</div>

	<script type="text/javascript">

	function valida()
	{
		return confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?');
	}
		function valida2()
		{
			return confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?');
		}
		$(".tipo").click(function()
		{
			var x = $(".tipo:checked").val();

			if(x == "ProveedorExistente")
			{
				$("#ProveedorNuevo").hide();
				$("#ProveedorExistente").show();
			}
			if(x == "ProveedorNuevo")
			{
				$("#ProveedorExistente").hide();
				$("#ProveedorNuevo").show();
			}

			if(x == null)
			{
				alert("SELECCIONE UN TIPO DE TRANSPORTE A AÑADIR");
				$(".tipo").focus();
				return false;
			}

		});
	</script>
	</body>
</html>