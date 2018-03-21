<?php
require_once("inc/config.php");
session_start();
$regionSession = $_SESSION["region"];
$identificador = date("YmdHis");
$annio = date("Y");
extract($_POST);
if($_FILES["fac_devengo_archivo"]["name"] != "")
{
	$archivo6="DEVENGO_".$fac_nro_contable."_".$regionSession."_".$identificador.".PDF";
	$destino =  "../../archivos/docfac/".$annio."/".$regionSession."/".$archivo6;
	$ruta = $annio."/".$regionSession."/".$archivo6;
	if(copy($_FILES["fac_devengo_archivo"]["tmp_name"], $destino))
	{
		$respuesta = true;
	}else{
		echo "Error al copiar";
	}
}
if($respuesta == true){
	for($i=1;$i<=$totalRegistros;$i++)
	{
		if($var[$i] <> "")
		{
			// ACTUALIZA FECHA DEVENGO
			$sql = "UPDATE dpp_etapas SET eta_fdevengo = '".$eta_fdevengo."' WHERE eta_id = ".$var[$i];
			$sql2 = "UPDATE dpp_facturas SET fac_devengo_archivo = '".$ruta."', fac_nro_contable = '".$fac_nro_contable."' WHERE fac_id = ".$var2[$i];	
			// echo $sql2."<br>";
			// echo $sql."<br>";
			mysql_query($sql);
			mysql_query($sql2);
		}
	}
}
?>

<script>
	window.location.href="contabilidad_devengo.php";
</script>