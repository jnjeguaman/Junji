<?
session_start();
require("inc/config.php");
$fechaRegistro = Date("d-m-Y H:i:s");
extract($_GET);
extract($_POST);
$respuesta = false;
$exito = 0;

$compra_cantidad = intval($compra_cantidad);
$recepcion_fecha = Date("d-m-Y");

$updateEstado = "UPDATE acti_compra SET compra_estado = 1 WHERE id = ".$id;

if(mysql_query($updateEstado))
{
	$respuesta = true;
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}

if($respuesta)
{
	$sqlDatos = "SELECT * FROM acti_compra WHERE id = ".$id;
	$sqlDatos = mysql_query($sqlDatos);
	$sqlDatos = mysql_fetch_array($sqlDatos);

	/*******************/
	$maximo = "SELECT MAX(CAST(inv_corre AS UNSIGNED)) AS Maximo FROM acti_inventario WHERE inv_region = ".$_SESSION["region"];
	$maximo = mysql_query($maximo);
	$maximo = mysql_fetch_array($maximo);
	$maximo = ($maximo["Maximo"] > 1) ? $maximo["Maximo"]+1 : $_SESSION["region"]."0" ;
	/*******************/

	for ($i=0; $i < $compra_cantidad; $i++) { 
		$correlativo = $maximo++;
		$query = "INSERT INTO acti_inventario (`inv_id`,`inv_codigo`,`inv_programa`,`inv_bien`,`inv_costo`,`inv_region`,`inv_oc`,`inv_recepcionfecha`,`inv_alta_en_transito`) VALUES(0,".$sqlDatos["compra_region_id"].$correlativo.",'".$sqlDatos["compra_programa"]."','".$sqlDatos["compra_glosa"]."','".$sqlDatos["compra_bruto_unitario"]."',".$sqlDatos["compra_region_id"].",'".$sqlDatos["oc_numero"]."','".$recepcion_fecha."', 'ALTA EN TRANSITO')";
		if(mysql_query($query,$dbh))
		{
			$exito ++;
		}
	}

	if($compra_cantidad === $exito)
	{
		echo "<script>location.href='acti_inv.php?cod=16';</script>";
	}else{
		echo "No se ha podido realiar la operacion, intente más tarde.";
	}
	
}else{
	echo "No se ha podido realiar la operacion, intente más tarde.";
}

?>
