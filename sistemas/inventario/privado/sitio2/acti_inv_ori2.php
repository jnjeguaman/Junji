<form name="form1" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" onSubmit="return valBusquedaRE()">
	<table border="0" width="80%">
		<tr>
			<td class="Estilo1">CLAVE</td>
			<td class="Estilo1">
				<input type="text" name="clave" id="clave" class="Estilo2" value="<?php if(isset($clave)){echo $clave;} ?>" />
			</td>

			<td class="Estilo1">
				<select name="filtro" id="filtro" class="Estilo1">
					<option value="">Seleccionar...</option>
					<option value="1" <?php if(isset($filtro) && $filtro == 1) { echo "selected";} ?>>CÓDIGO INVENTARIO</option>
					<option value="2" <?php if(isset($filtro) && $filtro == 2) { echo "selected";} ?>>FUNCIONARIO RESPONSABLE</option>
					<option value="3" <?php if(isset($filtro) && $filtro == 3) { echo "selected";} ?>>DIRECCION</option>
					<option value="4" <?php if(isset($filtro) && $filtro == 4) { echo "selected";} ?>>ZONA</option>
					<option value="5" <?php if(isset($filtro) && $filtro == 5) { echo "selected";} ?>>CUENTA CONTABLE</option>
					<option value="6" <?php if(isset($filtro) && $filtro == 6) { echo "selected";} ?>>AÑO DEVENGO (INGRESAR NÚMERO AAAA)</option>
					<option value="7" <?php if(isset($filtro) && $filtro == 7) { echo "selected";} ?>>MES DEVENGO (INGRESAR NÚMERO MM/AAAA)</option>
					<option value="8" <?php if(isset($filtro) && $filtro == 8) { echo "selected";} ?>>ORDEN DE COMPRA</option>
					<option value="9" <?php if(isset($filtro) && $filtro == 9) { echo "selected";} ?>>ESTADO</option>
					<option value="10"<?php if(isset($filtro) && $filtro == 10) { echo "selected";} ?>>PRODUCTO</option>
					<option value="11"<?php if(isset($filtro) && $filtro == 11) { echo "selected";} ?>>PROGRAMA</option>
					<option value="12"<?php if(isset($filtro) && $filtro == 12) { echo "selected";} ?>>N° RESOLUCION BAJA</option>
				</select>
			</td>

			<?php if ($_SESSION["region"] == 16 || $_SESSION["pfl_user"] == 23): ?>
				<td>
					<select name="region2" id="filtro" class="Estilo1">
						<option  value="">Seleccionar...</option>
						<?php
						$sqlRegion = "SELECT * FROM acti_region order by region_id";
						$sqlRegionResp = mysql_query($sqlRegion);
						while($row = mysql_fetch_array($sqlRegionResp)) { ?>
						<option value="<? echo  $row["region_id"] ?>" <? if ( $row["region_id"]==$region2) { echo "selected=selected"; } ?> ><? echo $row["region_glosa"] ?></option>
						<? }//While ?>
						<option value="17" <?php if($region2 == 17 ){echo"selected";} ?>>NACIONAL
						</select>
					</td>
				<?php endif ?>
				<td class="Estilo1">
					<button type="submit" name="submit" value="normal">BUSCAR <i class="fa fa-search"></i></button>
					
					<a href="/sistemas/inventario/privado/sitio2/inv_nuevo_producto.php" class="popup">NUEVO</a> |
					<a href="acti_inv.php?ori=1&cod=24">BUSQUEDA AVANZADA</a> |
					<a href="acti_inv.php&cod=24">LIMPIAR</a>
				</td>
			</tr>
		</table>
	</form>

	<?php
	$limite = 100;

	if($page <> "")
		{
			$page = $page;
		}else{
			$page = 1;
		}
		$start = ($page -1 ) * $limite;

	if($submit == "normal" || $ori == '')
	{
		if($_SESSION["region"] == 16)
		{
			if($region2 == 17)
			{
				$where = "";
			}else{
				$where = "inv_region = ".$region2." AND (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_visible = 1 AND ";
			}

		}else{
			$where = "inv_region = ".$_SESSION["region"]." AND (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_visible = 1 AND ";
		}

						//Filtros
		if($filtro == 1)
		{
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_codigo LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_codigo LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";
		}

		if($filtro == 2){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_responsable LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_responsable LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}

		if($filtro == 3){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_direccion LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_direccion LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}

		if($filtro == 4){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_zona LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_zona LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}if($filtro == 5){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_ccontable LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_ccontable LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}if($filtro == 6){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where YEAR(inv_devengofecha) = ".$clave." AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where YEAR(inv_devengofecha) = ".$clave." AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}if($filtro == 7){
			$params = explode("/", $clave);
			$mes = intval($params[0]);
			$anno = intval($params[1]);
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where MONTH(inv_devengofecha) = ".$mes." AND YEAR(inv_devengofecha) = ".$anno." AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where MONTH(inv_devengofecha) = ".$mes." AND YEAR(inv_devengofecha) = ".$anno." AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}if($filtro == 8){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_oc LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_oc LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}if($filtro == 9){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_estadocosto = '".$clave."' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_estadocosto = '".$clave."' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}if($filtro == 10){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_bien LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_bien LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}if($filtro == 11){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_programa LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_programa LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";

		}if($filtro == 12){
			$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where inv_baja LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC";
			$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where inv_baja LIKE '%".$clave."%' AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";
		}

		if($atributo == 23)
		{
					// AUDITOR
			if($region2 <> '')
			{
				if($region2 == 17)
				{
							//Reporte Nacional
							//$sqlFiltro = "SELECT * FROM acti_inventario /*WHERE (inv_estado2 = 1 or inv_estado2 = 0)*/ LIMIT 400";
					$sqlFiltro = "SELECT * FROM acti_inventario WHERE (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_visible = 1 ORDER BY inv_id DESC";
					$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_visible = 1 ORDER BY inv_id DESC LIMIT $start,$limite";
				}else{
							//$sqlFiltro = "SELECT * FROM acti_inventario WHERE /*(inv_estado2 = 1 or inv_estado2 = 0) AND*/ inv_region = ".$region2." ORDER by inv_id DESC LIMIT 400";
					$sqlFiltro = "SELECT * FROM acti_inventario WHERE (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_region = ".$region2." AND inv_visible = 1 ORDER by inv_id DESC";
					$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_region = ".$region2." AND inv_visible = 1 ORDER by inv_id DESC LIMIT $start,$limite";
				}
			}

		}
		// $totalRegistros = str_replace("LIMIT 400","",$sqlFiltro);
		// $totalRegistros = mysql_query($totalRegistros);
		// $totalRegistros = mysql_num_rows($totalRegistros);

		
	}
	?>