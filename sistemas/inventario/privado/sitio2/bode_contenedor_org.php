<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<script type="text/javascript" src="librerias/jquery.Rut.js"></script>
	<link rel="stylesheet" href="librerias/jquery-ui-1.11.4.custom/themes/start/jquery-ui.min.css">
	<script src="librerias/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<?php 
	extract($_POST);
	if(isset($contenedor_id) AND $contenedor_id <> '')
	{	
		if($contenedor_id == "Todos"){
			$sql2 = "SELECT * FROM bode_contenedor";
		}else{
			$sql2 = "SELECT * FROM bode_contenedor WHERE contenedor_id = ".$contenedor_id;	
		}
		$sql2 = mysql_query($sql2);
	}
	?>

	<div style="background-color:#E0F8E0; position:absolute; top:120px; left:00px; width:100%" id="div1">
		<?php 
		extract($_SESSION);
		$sql = "SELECT DISTINCT(contenedor_id), contenedor_numero FROM bode_contenedor"; 
		$sql = mysql_query($sql);
		?>
<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">DETALLE CONTENEDOR(ES)</td>
			</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" align="left">
			<tr>
				<td class="Estilo1">CONTENEDOR</td>
				<td>
					<form action="<?php echo $_SERVER["PHP_SELFT"] ?>" method="POST">
						<select class="Estilo1" name="contenedor_id" id="contenedor_id" onChange="this.form.submit()">
							<option value="" selected>Seleccionar...</option>
							<?php while($row = mysql_fetch_array($sql)) { ?>
							<option value="<?php echo $row["contenedor_id"] ?>"><?php echo $row["contenedor_numero"] ?></option>
							<?php } ?>
							<option value="Todos">Todos</option>
						</select>
						<?php if ($nom_user == "mcantillana" || $nom_user == "dvaldes" || $nom_user == "sebastian"): ?>
							<a href="/sistemas/inventario/privado/sitio2/bode_contenedor_nuevo.php" class="link nuevo"><i class="fa fa-plus"></i></a>
						<?php endif ?>
					</form>
				</td>
				
			</tr>
		</table>
		<hr>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">DETALLE CONTENEDOR(ES)</td>
			</tr>
		</table>
		<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center">
			<tr class="Estilo1mc">
				<td align="center">NUMERO CONTENEDOR</td>
				<td align="center">DPTO</td>
				<td align="center">SECCION</td>
				<td align="center">DIRECCION</td>
				<td align="center">RESPONSABLE</td>
				<td align="center">JEFATURA</td>
				<td align="center">CONTACTO</td>
				<?php if ($nom_user == "mcantillana" || $nom_user == "dvaldes" || $nom_user == "sebastian"): ?>
					<td align="center">EDITAR</td>
				<?php endif ?>
			</tr>

			<?php while ($row2 = mysql_fetch_array($sql2)) { ?>
			<tr class="Estilo1mc">
				<td><?php echo $row2["contenedor_numero"] ?></td>
				<td><?php echo $row2["contenedor_dpto"] ?></td>
				<td><?php echo $row2["contenedor_seccion"] ?></td>
				<td><?php echo $row2["contenedor_direccion"] ?></td>
				<td><?php echo $row2["contenedor_funcionario"] ?></td>
				<td><?php echo $row2["contenedor_jefe_func"] ?></td>
				<td>(2) 2654<?php echo $row2["contenedor_anexo"] ?></td>
				<?php if ($nom_user == "mcantillana" || $nom_user == "dvaldes" || $nom_user == "sebastian"): ?>
					<td align="center"><a href="/sistemas/inventario/privado/sitio2/bode_contenedor_editar.php?cid=<?php echo $row2["contenedor_id"]?>" class="link editar"><i class="fa fa-pencil"></i></a></td>
				<?php endif ?>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>

<script type="text/javascript">
	jQuery('.nuevo').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=700, height=350, top=100, left=200, toolbar=1');
	});

	jQuery('.editar').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=700, height=350, top=100, left=200, toolbar=1');
	});
</script>
</html>	