			
				<tr>
					<td class="Estilo1">CLAVE</td>
					<td><input type="text" name="clave" id="clave" value="<?php echo $clave ?>" class="Estilo1"></td>
					<td>
						<select id="filtro" name="filtro" class="Estilo1">
							<option value="">Seleccionar...</option>
							<option value="1" <?php if($filtro == 1) { echo "selected"; } ?>>ORDEN DE COMPRA</option>
							<option value="2" <?php if($filtro == 2) { echo "selected"; } ?>>N° GUIA PROVEEDOR</option>
							<option value="3" <?php if($filtro == 3) { echo "selected"; } ?>>APROBADO POR</option>
							<option value="4" <?php if($filtro == 4) { echo "selected"; } ?>>GRUPO</option>
							<?php if ($_SESSION["region"] == 16): ?>
								<option value="5" <?php if($filtro == 5) { echo "selected"; } ?>>REGION</option>
							<?php endif ?>
						</select>
					</td>
					<td class="Estilo1">
						<button type="submit" name="submit" id="submit" value="normal">BUSCAR</button> | <a href="inv_clasificacion.php?ori=1">BUSQUEDA AVANZADA</a> | <a href="inv_clasificacion.php?ori=2">LIMPIAR</a>
					</td>
				</tr>
