<?php $background = "style='background:lightgreen;'"; ?>
<div id="seccion1" style="background-color:#E0F8E0;" >
	<!-- BUSCADOR DE GUIAS DE DESPACHO !-->
	<form action="bode_inv_indexoc3.php?cod=22" method="POST">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo1mc">N° GUIA</td>
				<td class="Estilo1mc" style="text-align:left"><input type="text" name="n_guia" value="<?php echo $n_guia ?>"></td>

				<td class="Estilo1mc">FECHA EMISION</td>
				<td class="Estilo1mc" style="text-align:left">
					<input type="text" name="f_emision" id="f_emision" placeholder="YYYY-MM-DD" value="<?php echo $f_emision ?>">
					<i class="fa fa-calendar fa-lg link" id="f_trigger_c1" style="cursor:pointer;" title="Seleccionar Fecha"></i>
					<script type="text/javascript">
						Calendar.setup({
        inputField     :    "f_emision",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
</td>
</tr>

<tr>

</tr>

<tr>
	<td class="Estilo1mc">MES</td>
	<td class="Estilo1mc" style="text-align:left">
		<input type="text" name="mes" id="mes" placeholder="YYYY-MM" value="<?php echo $mes ?>">
		<i class="fa fa-calendar fa-lg link" id="f_trigger_c22" style="cursor:pointer;" title="Seleccionar Fecha"></i>
		<script type="text/javascript">
			Calendar.setup({
        inputField     :    "mes",     // id of the input field
        ifFormat       :    "%Y-%m",      // format of the input field
        button         :    "f_trigger_c22",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
</td>

<td class="Estilo1mc">DESTINO</td>
<td class="Estilo1mc" style="text-align:left"><input type="text" name="destino" value="<?php echo $destino ?>"></td>
</tr>

<tr>
	<td class="Estilo1mc">FECHA DE INICIO</td>
	<td class="Estilo1mc" style="text-align:left">
		<input type="text" name="finicio" id="finicio" placeholder="YYYY-MM-DD" value="<?php echo $finicio ?>">
		<i class="fa fa-calendar fa-lg link" id="f_trigger_c3" style="cursor:pointer;" title="Seleccionar Fecha"></i>
		<script type="text/javascript">
			Calendar.setup({
        inputField     :    "finicio",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
</td>


<td class="Estilo1mc">FECHA DE TERMINO</td>
<td class="Estilo1mc" style="text-align:left">
	<input type="text" name="ftermino" id="ftermino" placeholder="YYYY-MM-DD" value="<?php echo $ftermino ?>">
	<i class="fa fa-calendar fa-lg link" id="f_trigger_c4" style="cursor:pointer;" title="Seleccionar Fecha"></i>
	<script type="text/javascript">
		Calendar.setup({
        inputField     :    "ftermino",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c4",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
</td>

</tr>


<tr>
	<td class="Estilo1mc">N° FOLIO DESDE</td>
	<td class="Estilo1mc" style="text-align:left"><input type="text" name="inicio" value="<?php echo $inicio ?>"></td>

	<td class="Estilo1mc">N° FOLIO HASTA</td>
	<td class="Estilo1mc" style="text-align:left"><input type="text" name="termino" value="<?php echo $termino ?>"></td>
</tr>

<tr>
	<td class="Estilo1mc">MOSTRAR NULOS</td>
	<td><input type="checkbox" name="inc_nulo" <?php if($inc_nulo == "on"){echo"checked";} ?>></td>

	<td class="Estilo1mc">TIPO DE GUIA</td>
	<td>
		<select name="tipoguia" id="tipoguia" class="Estilo1">
			<option value="" selected>Seleccionar...</option>
			<option value="1" <?php if($tipoguia == 1){echo"selected";}?>>BODEGA</option>
			<option value="2" <?php if($tipoguia == 2){echo"selected";}?>>OFICINA</option>
			<option value="3" <?php if($tipoguia == 3){echo"selected";}?>>JARDIN</option>
			<option value="5" <?php if($tipoguia == 5){echo"selected";}?>>CONSUMO</option>
			<option value="6" <?php if($tipoguia == 6){echo"selected";}?>>TRASLADO</option>
		</select>
	</td>
</tr>

<tr>
	<td colspan="4"><center><button type="submit">BUSCAR <i class="fa fa-search"></i></button></center></td>
</tr>
</table>
</form>
<hr>
<table border="0" width="100%">
	<tr>
		<td  class="Estilo2titulo" colspan="10">GUIAS EN TRANSITO</td>
	</tr>

	<tr>
		<td class="Estilo1mc">ID</td>
		<td class="Estilo1mc">N° GUIA</td>
		<td class="Estilo1mc">F.DESPACHO</td>
		<td class="Estilo1mc">DESTINO</td>
		<td class="Estilo1mc">DESTINATARIO</td>
		<td class="Estilo1mc">VER</td>
		<td class="Estilo1mc">IMP</td>
		<td class="Estilo1mc">ESTADO</td>
		<?php if ($_SESSION["region"] == 16): ?>
			<?php if($_SESSION["Acceso"]["acc_anular_gd"] == 1): ?>
				<td  class="Estilo1mc">ANULAR</td>
			<?php endif ?>
		<?php else: ?>
			<td  class="Estilo1mc">ANULAR</td>
			
		<?php endif ?>

		<?php if ($_SESSION["region"] == 16): ?>
			<td class="Estilo1mc">COPIAR</td>
		<?php endif ?>
	</tr>


	<?php 

	$where="";

	if($n_guia <> "")
	{
		$where.= "y.oc_folioguia LIKE '%".$n_guia."%' AND ";
	}
	if($f_emision <> "")
	{
		$where.= "y.oc_guiafecha = '".$f_emision."' AND ";
	}

	if($finicio <> "")
	{
		$where.="y.oc_guiafecha >= '".$finicio."' AND ";
	}

	if($ftermino <> "")
	{
		$where.="y.oc_guiafecha <= '".$ftermino."' AND ";
	}

	if($inicio <> "")
	{
		$where.="y.oc_folioguia >= ".$inicio." AND ";
	}

	if($termino <> "")
	{
		$where.="y.oc_folioguia <= ".$termino." AND ";
	}
	if($mes <> "")
	{
		$fecha = explode("-", $mes);
		$where.= "YEAR(y.oc_guiafecha) = ".$fecha[0]." AND MONTH(y.oc_guiafecha) = ".$fecha[1]." AND ";
	}
	if($destino <> "")
	{
		$where.= "y.oc_region = '".$destino."' AND ";
	}

	if($inc_nulo <> "")
	{
		$nulo = "AND y.oc_guiadestina = 'NULO'";
	}else{
		$nulo = "AND y.oc_guiadestina <> 'NULO'";
	}

	if($tipoguia <> "")
	{
		$where.="y.oc_tipo_guia = ".$tipoguia." AND ";
	}
	//TOTAL RESULTADOS
	$sql22 = "SELECT * FROM bode_orcom y WHERE y.oc_region2 = ".$_SESSION["region"]." and $where y.oc_swdespacho='1' and  y.oc_guiafecha<>'0000-00-00' ".$nulo." ORDER by y.oc_folioguia DESC";
	//LISTA RESULTADOS
	 $sql2 = "SELECT * FROM bode_orcom y WHERE y.oc_region2 = ".$_SESSION["region"]." and $where y.oc_swdespacho='1' and  y.oc_guiafecha<>'0000-00-00' ".$nulo." ORDER by y.oc_dte_id DESC LIMIT 50";
	
	//REPORTES
	$sql3 = "SELECT * FROM bode_orcom y INNER JOIN bode_detoc b ON b.doc_oc_id = y.oc_id WHERE y.oc_region2 = ".$_SESSION["region"]." and $where y.oc_swdespacho='1' and y.oc_guiafecha<>'0000-00-00' ".$nulo." and b.doc_estado <> 'ELIMINADO' ORDER by y.oc_folioguia DESC LIMIT 50";
	$sql4 = "SELECT * FROM bode_orcom y INNER JOIN bode_detoc b ON b.doc_oc_id = y.oc_id /*INNER JOIN bode_detingreso c ON c.ding_id = b.doc_origen_id*/ WHERE y.oc_region2 = ".$_SESSION["region"]." and $where y.oc_swdespacho='1' and y.oc_guiafecha<>'0000-00-00' ".$nulo." and b.doc_estado <> 'ELIMINADO' ORDER by y.oc_folioguia DESC LIMIT 50";
	// echo $sql2;
	$res2 = mysql_query($sql2);
	$cont=1;
	while ($row2 = mysql_fetch_array($res2)) {
		$estilo=$cont%2;
		if ($estilo==0) {
			$estilo2="Estilo1mc";
		} else {
			$estilo2="Estilo1mcblanco";
		}

		?>
		<tr class="<? echo $estilo2 ?> trh" <?php if($row2["oc_id"] === $id){echo $background;} ?>>
			<td><? echo $row2["oc_id"] ?></td>
			<td><? echo $row2["oc_folioguia"] ?></td>
			<td><? echo $row2["oc_guiafecha"] ?></td>
			<td><? echo $row2["oc_region"] ?></td>
			<td><? echo $row2["oc_guiadestina"] ?></td>
			<td><a href="bode_inv_indexoc3.php?ori=4&id=<? echo $row2["oc_id"] ?>" class="link"><i class="fa fa-eye"></i></a></td>
			<td>
				<a href="bode_imprimirguia.php?ori=4&id=<? echo $row2["oc_id"] ?>" class="link"><i class="fa fa-print"></i></a>
				<?php if ($tipoguia == 5): ?>
					<a href="reporte/consumo.php?id=&id=<? echo $row2["oc_id"] ?>" class="link" target="_blank"><i class="fa fa-file"></i></a></td>
				<?php else: ?>
					<a href="bode_guia_despacho.php?ori=4&id=<? echo $row2["oc_id"] ?>" class="link" target="_blank"><i class="fa fa-file"></i></a>
				<?php if ($row2["oc_dte_id"] <> ''): ?>
					<?php 
					if($row2["oc_region2"] == 16)
					{
						$region = 14;
					}else if($row2["oc_region2"] == 14)
					{
						$region = 16;
					}else{
						$region = $row2["oc_region2"];
					}
					?>
					<a href="../../../../SII_JUNJI/documento.php?dte_id=<?php echo $row2["oc_dte_id"] ?>&regionSession=<?php echo $region ?>&origen=1" target="_blank" class="link"><i class="fa fa-file-pdf-o"></i></a>
				<?php endif ?>
				</td>
				<?php endif ?>
			</td>
			<?php if (intval($row2["oc_estado"]) === 1): ?>
				<td><i class="fa fa-check fa-lg"></i></a></td>
			<?php else: ?>
				<td><i class="fa fa-warning fa-lg"></i></td>
			<?php endif ?>

			<td>
				<?php if ($_SESSION["region"] == 16): ?>
					<?php if($_SESSION["Acceso"]["acc_anular_gd"] == 1): ?>
						<?php if ($row2["oc_region"] <> "NULO"): ?>
							<?php if ($row2["oc_wms"] <> "" && strtotime($row2["oc_fecha_recep"]) < strtotime("2017-08-06")): ?>
								<i class="fa fa-ban link fa-lg"></i>
							<?php else: ?>
								<a href="bode_anular_guia.php?id=<?php echo $row2["oc_id"] ?>&dte_id=<?php echo $row2["oc_dte_id"] ?>" class="link" onClick="return confirm('¿ DESEA ANULAR LA G/D N° <?php echo $row2['oc_folioguia']?> ? ')"><i class="fa fa-remove"></i></a>
							<?php endif ?>
						<?php else: ?>
							<font color="red">NULO</font>
						<?php endif ?>
					<?php endif ?>
				<?php else: ?>
					<?php if ($row2["oc_region"] <> "NULO"): ?>
						<a href="bode_anular_guia.php?id=<?php echo $row2["oc_id"] ?>&dte_id=<?php echo $row2["oc_dte_id"] ?>" class="link" onClick="return confirm('¿ DESEA ANULAR LA G/D N° <?php echo $row2['oc_folioguia']?> ? ')"><i class="fa fa-remove"></i></a>
					<?php else: ?>
						<font color="red">NULO</font>
					<?php endif ?>
				<?php endif ?>
			</td>

			<?php if ($_SESSION["region"] == 16): ?>
				<td><a href="bode_inv_copiar.php?id=<?php echo $row2["oc_id"] ?>&dte_id=<?php echo $row2["oc_dte_id"] ?>" class="link" onClick="return confirm('AL REALIZAR LA COPIA DE LA GUIA SE ANULARÁ LA ANTERIOR , ¿ DESEA CONTINUAR CON LA SOLICITUD ?');blockUI();"><i class="fa fa-copy"></i></a></td>
			<?php endif ?>
		</tr>
		<?
		$cont++;
	}
	?>
	<tr>
		<td colspan="7"></td>
		<td class="Estilo1mc">Total resultados</td>
		<td class="Estilo1mc"><?php echo number_format(mysql_num_rows(mysql_query($sql22)),0,".",".") ?></td>
	</tr>

	<tr>
		<td colspan="7"></td>
		<td align="center"><form action="reporte/reporte4.php" method="POST" id="exportar"><input type="hidden" name="qry" id="qry" value="<?php echo $sql3 ?>"><a href="#" onClick="exportar4()" class="Estilo1mc">EXPORTAR A EXCEL</a><script type="text/javascript">function exportar4(){document.getElementById("exportar").submit();}</script></form></td>
		<td align="center"><form action="reporte/reporte3.php" method="POST" id="exportar2"><input type="hidden" name="qry" id="qry" value="<?php echo $sql4 ?>"><a href="#" onClick="exportar2()" class="Estilo1mc">REPORTE</a><script type="text/javascript">function exportar2(){document.getElementById("exportar2").submit();}</script></form></td>
	</tr>
	</table>
</div>
