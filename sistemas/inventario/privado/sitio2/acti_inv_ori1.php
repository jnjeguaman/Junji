<form name="form1" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
	<table border="0" width="90%">
		<tr>
			<td class="Estilo1">ORDEN DE COMPRA</td>
			<td class="Estilo1"><input type="text" name="oc" id="clave" class="Estilo2" value="<?php if(isset($oc)){echo $oc;} ?>" /></td>
			<td class="Estilo1">CODIGO INVENTARIO</td>
			<td class="Estilo1">
				<input type="text" name="codigo" id="clave" class="Estilo2" value="<?php if(isset($codigo)){echo $codigo;} ?>" />
			</td>
		</tr>
		<tr>
			<td class="Estilo1">PRODUCTO</td>
			<td class="Estilo1">
				<input type="text" name="bien" id="clave" class="Estilo2" value="<?php if(isset($bien)){echo $bien;} ?>" />
			</td>
			<td class="Estilo1">PROGRAMA</td>
			<td class="Estilo1">
				<select name="programa" id="clave" class="Estilo1">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($programas as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>" <?php if(isset($programa) && $programa == $value["param_glosa"]){echo"selected";} ?>><?php echo $value["param_desc"] ?></option>
								<?php endforeach ?>
							</select>
			</td>
		</tr>
		<tr>
			<td class="Estilo1">FUNCIONARIO RESPONSABLE</td>
			<td class="Estilo1">
				<input type="text" name="fresponsable" id="clave" class="Estilo2" value="<?php if(isset($fresponsable)){echo $fresponsable;} ?>" />
			</td>
			<td class="Estilo1">DIRECCION</td>
			<td class="Estilo1">
				<input type="text" name="direccion" id="clave" class="Estilo2" value="<?php if(isset($direccion)){echo $direccion;} ?>" />
			</td>
		</tr>
		<tr>
			<td class="Estilo1">ZONA</td>
			<td class="Estilo1">
				<input type="text" name="zona" id="clave" class="Estilo2" value="<?php if(isset($zona)){echo $zona;} ?>" />
			</td>
			<td class="Estilo1">CUENTA CONTABLE</td>
			<td class="Estilo1">
				<select class="Estilo1" id="clave" name="ccontable">
							<option selected value="">Seleccionar...</option>
							<?php foreach ($ctaContable as $key => $value): ?>
								<option value="<?php echo $value["param_glosa"] ?>" <?php if(isset($ccontable) && $ccontable == $value["param_glosa"]){echo"selected";} ?>><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
							<?php endforeach ?>
						</select>
			</td>
		</tr>
		<tr>
			<td class="Estilo1">AÑO DEVENGO (INGRESAR NÚMERO AAAA)</td>
			<td class="Estilo1">
				<input type="text" name="adevengo" id="adevengo" class="Estilo2" value="<?php if(isset($adevengo)){echo $adevengo;} ?>" />
				<i class="fa fa-calendar fa-lg link" id="f_trigger_c2" style="cursor:pointer;" title="Seleccionar Fecha"></i>
				<script type="text/javascript">
							Calendar.setup({
        inputField     :    "adevengo",     // id of the input field
        ifFormat       :    "%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
			</td>
			<td class="Estilo1">MES DEVENGO (INGRESAR NÚMERO MM/AAAA)</td>
			<td class="Estilo1">
				<input type="text" name="mdevengo" id="mdevengo" class="Estilo2" value="<?php if(isset($mdevengo)){echo $mdevengo;} ?>" />
				<i class="fa fa-calendar fa-lg link" id="f_trigger_c3" style="cursor:pointer;" title="Seleccionar Fecha"></i>
				<script type="text/javascript">
							Calendar.setup({
        inputField     :    "mdevengo",     // id of the input field
        ifFormat       :    "%m/%Y",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
			</td>
		</tr>
		<tr>
			<td class="Estilo1">ESTADO</td>
			<td class="Estilo1">
				<select class="Estilo1" name="estado" id="clave">
							<option selected value="">Seleccionar...</option>
				<?php foreach ($estados as $key => $value): ?>
					<option value="<?php echo $value["param_glosa"] ?>" <?php if(isset($estado) && $estado == $value["param_glosa"]){echo"selected";} ?>><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
				<?php endforeach ?>
				</select>
			</td>
			<td class="Estilo1">N° RES/BAJA</td>
			<td class="Estilo1">
				<input type="text" name="baja" id="baja" class="Estilo2" value="<?php if(isset($baja)){echo $baja;} ?>" />
			</td>
		</tr>
		<?php if ($_SESSION["region"] == 16): ?>
			<tr>
				<td class="Estilo1">TIPO REPORTE</td>
				<td class="Estilo1">
					<select name="region2" id="filtro" class="Estilo1">
						<option  value="">Seleccionar...</option>
						<?php
						$sqlRegion = "SELECT * FROM acti_region order by region_id";
						$sqlRegionResp = mysql_query($sqlRegion);
						while($row = mysql_fetch_array($sqlRegionResp)) {
							?>
							<option value="<? echo  $row["region_id"] ?>" <? if (isset($region2) && $row["region_id"]==$region2) { echo "selected"; } ?> ><? echo $row["region_glosa"] ?></option>
							<?
						}
						?>
						<option value="17" <?php if(isset($region2) && $region2 == 17 ){echo"selected";} ?>>NACIONAL</select>
						</td>
					</tr>
				<?php else: ?>
					<?php $region2 = $_SESSION["region"] ?>
				<?php endif ?>
				<tr>
					<td class="Estilo1" colspan="4" align="center" style="text-align:center;">
					<button type="submit" name="submit" value="avanzada">BUSCAR <i class="fa fa-search"></i></button>
					<a href="acti_inv.php?ori=1">LIMPIAR</a> |
					<a href="acti_inv.php">BUSQUEDA SIMPLE</a>
					</td>
					
					
				</tr>
			</tr>
		</table>
		<input type="hidden" name="ori" value="<?php if(isset($ori)){echo $ori;} ?>">
	</form>

	<?php
	if(isset($submit) && $submit == "avanzada" || isset($ori) && $ori == 1)
	{
		if (isset($oc) && $oc<>'') {
			$where.=" inv_oc like '%$oc%' and ";
		}
		if (isset($codigo) && $codigo<>'') {
			$where.=" inv_codigo like '%$codigo%' and ";
		}
		if (isset($bien) && $bien<>'') {
			$where.=" inv_bien like '%$bien%' and ";
		}
		if (isset($programa) && $programa<>'') {
			$where.=" inv_programa like '%$programa%' and ";
		}
		if (isset($fresponsable) && $fresponsable<>'') {
			$where.=" inv_responsable like '%$fresponsable%' and ";
		}
		if (isset($direccion) && $direccion<>'') {
			$where.=" inv_direccion like '%$direccion%' and ";
		}
		if (isset($zona) && $zona<>'') {
			$where.=" inv_zona like '%$zona%' and ";
		}
		if (isset($ccontable) && $ccontable<>'') {
			$where.=" inv_ccontable = $ccontable and ";
		}
		if (isset($adevengo) && $adevengo<>'') {
			$where.=" YEAR(inv_devengofecha) = $adevengo and ";
		}
		if (isset($mdevengo) && $mdevengo<>'') {
			$clave = explode("/", $mdevengo);
			$where.=" YEAR(inv_devengofecha) = ".$clave[1]." and MONTH(inv_devengofecha) = ".$clave[0]." and ";
		}
		if (isset($estado) && $estado<>'') {
			$where.=" inv_estadocosto = '".$estado."' and ";
		}
		if (isset($baja) && $baja<>'') {
			$where.=" inv_baja LIKE '%".$baja."%' and ";
		}
		if(isset($region2) && $region2 <>'')
		{
			if($region2 == 17)
			{
				$where.= "";
			}else{
				$where.= "inv_region = ".$region2." AND ";
			}
		}
		$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where (inv_estado2 = 1 or inv_estado2 = 0) AND inv_visible = 1 ORDER by inv_id DESC";
		$consulta = $sqlFiltro;
		$res = mysql_query($sqlFiltro);
		$numRows = mysql_num_rows($res);

		$limite = 100;
		if($page <> "")
		{
			$page = $page;
		}else{
			$page = 1;
		}
		$start = ($page -1 ) * $limite;
		$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE $where (inv_estado2 = 1 or inv_estado2 = 0) AND inv_visible = 1 ORDER by inv_id DESC LIMIT $start,$limite";
	}

	?>