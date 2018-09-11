<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
extract($_GET);
extract($_POST);

$bode_inventario = "INSERT INTO bode_inventario(inv_fecha, inv_region, inv_descripcion, inv_fechatoma, inv_folio, inv_tipo, inv_forma, inv_cantidad, inv_user, inv_fechasys)VALUES ('$fecha_orden_compra', '$regionsession', '$tipo', '$fecha2', '0', '$tipo',   '$forma', '$cantidad', '$usuario', '$fechamia' ) ";
mysql_query($bode_inventario);

$sqlLast = "SELECT max(inv_id) as maximo FROM bode_inventario where inv_user='$usuario'";
$sqlLastResp = mysql_query($sqlLast);
$row = mysql_fetch_array($sqlLastResp);
$maximo = $row["maximo"];

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");

if($tipo == "Aleatorio")
{
		if($forma == "Oculto")
		{
				$nitems = rand(1,100);
				$update = "UPDATE bode_inventario SET inv_cantidad = ".$nitems." WHERE inv_id = ".$maximo;
				mysql_query($update);
		}else{
				$nitems = $cantidad;
		}
		$sql = "INSERT INTO  bode_detoc_inv (doci_oc_id, doci_prod_id, doci_inv_id, doci_especificacion, doci_cantidad, doci_valor_unit, doci_valor_unit2, doci_recibidos, doci_tecnicos, doci_final, doci_stock, doci_despachados, doci_region, doci_origen_id, doci_estado, doci_estadocierre, doci_numerooc,doci_ubi) select doc_oc_id, doc_id,   '$maximo',   doc_especificacion, doc_cantidad, doc_conversion, doc_valor_unit2, doc_recibidos, doc_tecnicos, doc_final, ding_unidad, doc_despachados, doc_region, doc_origen_id, doc_estado, doc_estadocierre, doc_numerooc,ding_ubicacion FROM bode_detoc a INNER JOIN bode_detingreso b ON a.doc_id = b.ding_prod_id AND b.ding_recep_tecnica = 'A' where b.ding_unidad>0  AND a.doc_region = ".$_SESSION["region"]." ORDER BY rand() LIMIT $nitems ";
		$log = "INSERT INTO log VALUES(NULL,".$maximo.",".$nitems.",'CREA TOMA INVENTARIO : ".$tipo." - ".$forma."','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','TOMA INVENTARIO')";

}

if($tipo == "Completo")
{
		$sql = "INSERT INTO  bode_detoc_inv (doci_oc_id, doci_prod_id, doci_inv_id, doci_especificacion, doci_cantidad, doci_valor_unit, doci_valor_unit2, doci_recibidos, doci_tecnicos, doci_final, doci_stock, doci_despachados, doci_region, doci_origen_id, doci_estado, doci_estadocierre, doci_numerooc,doci_ubi) select doc_oc_id, doc_id,   '$maximo',   doc_especificacion, doc_cantidad, doc_conversion, doc_valor_unit2, doc_recibidos, doc_tecnicos, doc_final, ding_unidad, doc_despachados, doc_region, doc_origen_id, doc_estado, doc_estadocierre, doc_numerooc,ding_ubicacion FROM bode_detoc a INNER JOIN bode_detingreso b ON a.doc_id = b.ding_prod_id AND b.ding_recep_tecnica = 'A' AND a.doc_region = ".$_SESSION["region"]." ";
		$log = "INSERT INTO log VALUES(NULL,".$maximo.",0,'CREA TOMA INVENTARIO : ".$tipo." - ".$forma."','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','TOMA INVENTARIO')";

}
mysql_query($sql);
mysql_query($log);

echo "<script>location.href='bode_inv_indexoc6.php?cod=$cod&ok=1';</script>";
?>