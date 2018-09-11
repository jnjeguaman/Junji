	<?php 
	extract($_POST);
	if(isset($contenedor_id) AND $contenedor_id <> '')
	{	
		if($contenedor_id == "Todos"){
			$sql2 = "SELECT * FROM bode_contenedor ORDER BY contenedor_numero";
		}else{
			$sql2 = "SELECT * FROM bode_contenedor WHERE contenedor_id = ".$contenedor_id;	
		}
	}else{
		$sql2 = "SELECT * FROM bode_contenedor ORDER BY contenedor_numero";
	}
	$sql2 = mysql_query($sql2);
	?>

	<?php 
	extract($_SESSION);
		//$sql = "SELECT DISTINCT(contenedor_id), contenedor_numero FROM bode_contenedor ORDER BY contenedor_numero";
	$sql = "SELECT contenedor_id, contenedor_numero FROM bode_contenedor ORDER BY contenedor_numero";

	$sql = mysql_query($sql);
	?>
	<div style="background-color:#E0F8E0; position:absolute; top:160px; left:00px; width:100%" id="div1">
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
						<option value="<?php echo $row["contenedor_id"] ?>" <?php if($contenedor_id == $row["contenedor_id"]){ echo "selected";} ?>><?php echo $row["contenedor_numero"] ?></option>
						<?php } ?>
						<option value="Todos" <?php if($contenedor_id == "Todos"){ echo "selected";} ?>>Todos</option>
					</select>
					<?php if ($nom_user == "mcantillana" || $nom_user == "dvaldes" || $nom_user == "sebastian"): ?>
						<a href="/sistemas/inventario/privado/sitio2/bode_contenedor_nuevo.php" class="link nuevo"><i class="fa fa-plus"></i></a>
					<?php endif ?>
				</form>
			</td>
			
		</tr>
	</table>
	<br>
	<hr>
	
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

		<?php $cont = 1; while ($row2 = mysql_fetch_array($sql2)) {

			$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
				} else {
					$estilo2="Estilo1mcblanco";
				}

		?>
		<tr class="<?php echo $estilo2 ?> trh">
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
		<?php $cont++;} ?>
	</table>
</div>
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
