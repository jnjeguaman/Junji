<table border="0" width="100%">
	<tr>
		<td class="Estilo2titulo" colspan="10">BÚSQUEDA</td>
	</tr>
</table>
<hr>
<table border="0" width="100%">
	<tr>
		<td class="Estilo1">CLAVE</td>
		<td class="Estilo1">
			<input type="text" name="clave" id="clave" class="Estilo2" value="<?php echo $clave ?>" />
		</td>

		<td class="Estilo1">
			<select name="filtro" id="filtro" class="Estilo1">
				<option value="">Seleccionar...</option>
				<option value="1" <?php if($filtro == 1) { echo "selected";} ?>>CÓDIGO INVENTARIO</option>
				<option value="2" <?php if($filtro == 2) { echo "selected";} ?>>FUNCIONARIO RESPONSABLE</option>
				<option value="3" <?php if($filtro == 3) { echo "selected";} ?>>DIRECCION</option>
				<option value="4" <?php if($filtro == 4) { echo "selected";} ?>>ZONA</option>
				<option value="5" <?php if($filtro == 5) { echo "selected";} ?>>CUENTA CONTABLE</option>
				<option value="6" <?php if($filtro == 6) { echo "selected";} ?>>AÑO DEVENGO (INGRESAR NÚMERO AAAA)</option>
				<option value="7" <?php if($filtro == 7) { echo "selected";} ?>>MES DEVENGO (INGRESAR NÚMERO MM/AAAA)</option>
				<option value="8" <?php if($filtro == 8) { echo "selected";} ?>>ORDEN DE COMPRA</option>
				<option value="9" <?php if($filtro == 9) { echo "selected";} ?>>ESTADO</option>
				<option value="10"<?php if($filtro == 10) { echo "selected";} ?>>PRODUCTO</option>
				<option value="11"<?php if($filtro == 11) { echo "selected";} ?>>PROGRAMA</option>
				<option value="12"<?php if($filtro == 12) { echo "selected";} ?>>N° RESOLUCION BAJA</option>
			</select>
		</td>

		<td class="Estilo1">
			<button type="submit" name="submit" value="BUSCAR">BUSCAR <i class="fa fa-search"></i></button> | <a href="inv_actualizacion.php?ori=1">BUSQUEDA AVANZADA</a>
		</td>
	</tr>
</table>
<input type="hidden" name="cod" value="<?php echo $cod ?>">
