	<?php
	session_start();
	$nom_user = $_SESSION["nom_user"];
	$fechamia=date('Y-m-d');
	include("inc/config.php");
	extract($_POST);
	//print_r($_POST);
	for ($i=0; $i <=$totalElementos ; $i++) { 
		// PASO 1 : VERIFICAR LOS ELEMENTOS SELECCIONADOS
		if($var1[$i] <> "")
		{
			// PASO 2 : VERIFICAMOS SU CLASIFICACION
			if(intval($var4[$i]) === 1)
			{
				// BUSCAMOS EL ID DE COMPRA POR LA O/C Y LA RECEPCION CONFORME
				$id = "SELECT id FROM acti_compra WHERE oc_numero = '".$var12[$i]."' AND compra_rc = ".$var8[$i]." AND compra_doc_id = ".$var9[$i]." LIMIT 1";
				$resId = mysql_query($id,$dbh);
				$row = mysql_fetch_array($resId);

				// OBTENIDO EL ID, ACTUALIZAMOS EL MONTO.
				$query = "UPDATE acti_compra SET compra_monto = ".$var2[$i].", compra_devengado = 1 WHERE id = ".$row["id"];
				mysql_query($query,$dbh);
				
				$log = "INSERT INTO log VALUES(NULL,".$row["id"].",0,'ACTUALIZA DEVENGO','".$nom_user."','".$fechamia."','".Date("H:i:s")."','INVENTARIO','CONTABILIDAD')";
				mysql_query($log,$dbh);
				// HACEMOS LO MISMO CON LA TABLA DE PASO

				// BUSCAMOS EL ID DE COMPRA POR LA O/C Y LA RECEPCION CONFORME
				$id = "SELECT id FROM acti_compra_temporal WHERE oc_numero = '".$var12[$i]."' AND compra_rc = ".$var8[$i]." AND compra_doc_id = ".$var9[$i]." LIMIT 1";

				$resId = mysql_query($id,$dbh);
				$row = mysql_fetch_array($resId);

				// OBTENIDO EL ID, ACTUALIZAMOS EL MONTO.
				$query = "UPDATE acti_compra_temporal SET compra_monto = ".$var2[$i]." WHERE id = ".$row["id"];
				
				mysql_query($query,$dbh);

			}else if(intval($var4[$i]) === 0)
			{
				$unitario = round($var2[$i] / $var11[$i]);

				// ACTUALIZAMOS EL MONTO DEVENGADO DE UN INGRESO ESPECIFICO EN BODEGA
				$ding_devengo = "UPDATE bode_detingreso SET ding_devengo = ".$var2[$i].", ding_devengado = 1 WHERE ding_id = ".$var7[$i];
				//echo $ding_devengo."<br>";
				mysql_query($ding_devengo,$dbh);

				// ACTUALIZAMOS EL NUEVO VALOR UNITARIO DE LA EXISTENCIA EN BODEGA SIN MODIFICAR LOS PRECIOS DE LOS DESPACHOS ENVIADOS.
				$doc_id = "UPDATE bode_detoc SET doc_unit = ".$unitario.", doc_conversion = ".$unitario.", doc_cta_contable = ".$var3[$i]." WHERE doc_id = ".$var9[$i];
				//echo $doc_id."<br>";
				mysql_query($doc_id,$dbh);
			}else{
				// ESTE ITEM NO SE PUDE ACTUALIZAR YA QUE ESTA SIN CLASIFICACION
			}
		}
	}

	?>

<script type="text/javascript">
	window.location.href="devengo.php";
</script>