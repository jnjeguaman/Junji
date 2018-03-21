<pre>
	<?php
	include("inc/config.php");
	extract($_POST);
	print_r($_POST);
	/*
		var1 = CHECKED
		var2 = CUENTA CONTABLE EXISTECIAS
		var3 = DING_ID
		var4 = STOCK DISPONIBLE
		var5 = DOC_ID
		var6 = VALOR DEVENGO
	*/
	//$unitario = 
	//$totalElementos = intval($totalElementos);
	//echo $totalElementos;

	for ($i=1; $i <= $totalElementos ; $i++) { 

		if($var1[$i] <> "")
		{
			// OBTENEMOS EL VALOR UNITARIO
			if($var4[$i] == 0)
			{
				$unitario = 0;
			}else{
				$unitario = $var6[$i] / $var4[$i];
			}
			echo "UNITARIO:".$unitario."<br>";

			// ACTUALIZAMOS EL MONTO DEVENGADO DE UN INGRESO ESPECIFICO EN BODEGA
			$ding_devengo = "UPDATE bode_detingreso SET ding_devengo = ".$var6[$i].", ding_devengado = 1 WHERE ding_id = ".$var3[$i];
			echo $ding_devengo."<br>";
			mysql_query($ding_devengo,$dbh6);
			// ACTUALIZAMOS EL NUEVO VALOR UNITARIO DE LA EXISTENCIA EN BODEGA SIN MODIFICAR LOS PRECIOS DE LOS DESPACHOS ENVIADOS.
			$doc_id = "UPDATE bode_detoc SET doc_unit = ".$unitario.", doc_conversion = ".$unitario.", doc_cta_contable = '".$var2[$i]."' WHERE doc_id = ".$var5[$i];
			echo $doc_id."<br>";
			mysql_query($doc_id,$dbh6);
		}
	}
	?>
</pre>
<script type="text/javascript">
	window.location.href="exis_contaedit.php?ori=1&oc_id=<?php echo $oc_id ?>&rc=<?php echo $rc ?>";
</script>