<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$fechaSys = Date("Y-m-d");
$horaSys = Date("H:m:s");

extract($_GET);
extract($_POST);
extract($_SESSION);
$respuesta = false;
$exito = 0;
$compra_cantidad = intval($compra_cantidad);
$tipo_activo = intval($tipo_activo);


$enviado = intval($qty);
$cantidadRequerida = intval($qtyTotal);
//
$totalParcial = "SELECT SUM(rece_cantidad) as Parcial FROM acti_recepcion WHERE rece_compra_id = ".$id;
$totalParcial = mysql_query($totalParcial);
$totalParcial = mysql_fetch_array($totalParcial);
$totalParcial = intval($totalParcial["Parcial"]);

$respuesta = false;
$temp = $enviado + $totalParcial;

$fechamia=date('Y-m-d');
$horaSyst = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$id.",".$temp.",'ENVIO A INVENTARIO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSyst."','INVENTARIO','RECEPCION')";
mysql_query($log);

$consulta = "INSERT INTO `acti_recepcion`(`rece_id`, `rece_compra_id`, `rece_cantidad`, `rece_user`, `rece_fechasys`, `rece_horasys`, `rece_tipo`, `rece_contacto`, `rece_obs`, `rece_unidad`, `rece_numero`, `rece_nrc`, `rece_estado`)
VALUES(0,".$id.",".$qty.",'".$nombrecom."','".$fechaSys."','".$horaSys."','".$tipo_recepcion."','".$recepcion_contacto."','".$recepcion_obs."','".$unidad_que_recibe."','".$numero_guia."','".$numero_recepcion."',0)";

$consulta2 = "UPDATE acti_recepcion SET rece_estado = 1 WHERE rece_compra_id = ".$id;

$consulta3 = "UPDATE acti_compra SET compra_estado = 1, rc_numero = '".$numero_recepcion."' WHERE id = ".$id;
/* DETALLE PRODUCTO */
$detalle = "SELECT * FROM acti_compra WHERE id = ".$id;
$detalle = mysql_query($detalle);
$detalle = mysql_fetch_array($detalle);

/*******************/
$maximo = "SELECT MAX(inv_codigo) AS Maximo FROM acti_inventario WHERE inv_region = ".$_SESSION["region"]." AND inv_codigo LIKE '".$_SESSION["region"]."%'";
$maximo = mysql_query($maximo);
$maximo = mysql_fetch_array($maximo);
$maximo = ($maximo["Maximo"] > 1) ? $maximo["Maximo"]+1 : $_SESSION["region"]."000001" ;
/*******************/
// Verificamos si las cantidades son iguales
if(($temp) === $cantidadRequerida)
{
	if(mysql_query($consulta,$dbh))
	{
		
		$respuesta = true;
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}

	if($respuesta)
	{
		if(mysql_query($consulta2,$dbh))
		{
			mysql_query($consulta3);

			$monto_total = $detalle["compra_monto"];
			$moneda = $detalle["compra_tipo_cambio"];
			$conversion = $detalle["compra_cantidad"] * $detalle["compra_bruto_unitario"];
			$diferencia = $monto_total - $conversion;

			$suma = 0;
			$suma2 = 0;

			for ($i=0; $i < $enviado; $i++) { 

				if($i == 0)
				{
					$valor = $detalle["compra_bruto_unitario"] + $diferencia;

					$correlativo = $maximo++;
					$inventario = "INSERT INTO acti_inventario (`inv_id`,`inv_codigo`,`inv_programa`,`inv_bien`,`inv_costo`,`inv_region`,`inv_oc`,`inv_recepcionfecha`,`inv_alta_en_transito`,`inv_nro_rece`,`inv_fechasys`,`inv_user`,`inv_horasys`,`inv_estado2`,`inv_doc_id`,`inv_ding_id`,`inv_obs`) VALUES(0,".$correlativo.",'".$detalle["compra_programa"]."','".$detalle["compra_glosa"]."','".$valor."',".$detalle["compra_region_id"].",'".$detalle["oc_numero"]."','".$recepcion_fecha."', 'ALTA EN TRANSITO','".$numero_recepcion."','".Date("Y-m-d")."','".$nom_user."','".Date("H:i:s")."',1,".$doc_id.",".$ding_id.",'".$recepcion_obs."')";
					if(mysql_query($inventario,$dbh))
					{
						$correcto ++;
					}
				}else{
					$correlativo = $maximo++;
					$inventario = "INSERT INTO acti_inventario (`inv_id`,`inv_codigo`,`inv_programa`,`inv_bien`,`inv_costo`,`inv_region`,`inv_oc`,`inv_recepcionfecha`,`inv_alta_en_transito`,`inv_nro_rece`,`inv_fechasys`,`inv_user`,`inv_horasys`,`inv_estado2`,`inv_doc_id`,`inv_ding_id`,`inv_obs`) VALUES(0,".$correlativo.",'".$detalle["compra_programa"]."','".$detalle["compra_glosa"]."','".$detalle["compra_bruto_unitario"]."',".$detalle["compra_region_id"].",'".$detalle["oc_numero"]."','".$recepcion_fecha."', 'ALTA EN TRANSITO','".$numero_recepcion."','".Date("Y-m-d")."','".$nom_user."','".Date("H:i:s")."',1,".$doc_id.",".$ding_id.",'".$recepcion_obs."')";
					if(mysql_query($inventario,$dbh))
					{
						$correcto ++;
					}
				}
				/*$correlativo = $maximo++;
				$inventario = "INSERT INTO acti_inventario (`inv_id`,`inv_codigo`,`inv_programa`,`inv_bien`,`inv_costo`,`inv_region`,`inv_oc`,`inv_recepcionfecha`,`inv_alta_en_transito`,`inv_nro_rece`) VALUES(0,".$correlativo.",'".$detalle["compra_programa"]."','".$detalle["compra_glosa"]."','".$detalle["compra_bruto_unitario"]."',".$detalle["compra_region_id"].",'".$detalle["oc_numero"]."','".$recepcion_fecha."', 'ALTA EN TRANSITO','".$numero_recepcion."')";
				if(mysql_query($inventario,$dbh))
				{
					$correcto ++;
				}*/
			}

			if($correcto === $enviado)
			{
				echo "<script>location.href='acti_inv.php?cod=16';</script>";
			}else{
				echo "No se ha podido realiar la operacion, intente más tarde.";
			}

		}else{
			echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
		}
	}
}elseif(($temp) > $cantidadRequerida){
	echo "Error Supera lo permitido.";
}else{
	if(mysql_query($consulta,$dbh))
	{
		for ($i=0; $i < $enviado; $i++) { 
			$correlativo = $maximo++;
			$inventario = "INSERT INTO acti_inventario (`inv_id`,`inv_codigo`,`inv_programa`,`inv_bien`,`inv_costo`,`inv_region`,`inv_oc`,`inv_recepcionfecha`,`inv_alta_en_transito`,`inv_nro_rece`,`inv_fechasys`,`inv_user`,`inv_horasys`,`inv_estado2`,`inv_doc_id`,`inv_ding_id`,`inv_obs`) VALUES(0,".$correlativo.",'".$detalle["compra_programa"]."','".$detalle["compra_glosa"]."','".$detalle["compra_bruto_unitario"]."',".$detalle["compra_region_id"].",'".$detalle["oc_numero"]."','".$recepcion_fecha."', 'ALTA EN TRANSITO','".$numero_recepcion."','".Date("Y-m-d")."','".$nom_user."','".Date("H:i:s")."',1,".$doc_id.",".$ding_id.",'".$recepcion_obs."')";
			if(mysql_query($inventario,$dbh))
			{
				$correcto ++;
			}
		}

		if($correcto === $enviado)
		{
			//echo "<script>location.href='inv_recepcion.php?ori=6&id=".$id."&compra_id=".$compra_id."';</script>";
			echo "<script>location.href='acti_inv.php?cod=16';</script>";
		}else{
			echo "No se ha podido realiar la operacion, intente más tarde.";
		}
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}
}
?>