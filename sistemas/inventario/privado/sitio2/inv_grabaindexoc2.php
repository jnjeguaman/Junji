<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
extract($_GET);
extract($_POST);
/*
// Verificamos si existen registros en acti_compra_temportal
$sqlTemportal = "SELECT count(*) as total FROM acti_compra_temporal";
$sqlTemportalResp = mysql_query($sqlTemportal);
$respTemporal = mysql_fetch_array($sqlTemportalResp);
$respTemporal = intval($respTemporal["total"]);

// Verificamos si existen registros en acti_compra_temportal

if ($respTemporal >= 1) {

	$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra_temporal";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$compra_id = intval($row["compra_id"] + 1);


} else {
	$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$compra_id = intval($row["compra_id"] + 1);

}
*/

//$compra_bruto_unitario = round($total / $cantidad);
$fecha2= substr($fecha_orden_compra,6,4)."-".substr($fecha_orden_compra,3,2)."-".substr($fecha_orden_compra,0,2);

$sql = "INSERT INTO bode_orcom (oc_id2, oc_region,   oc_nombre_oc, oc_prog,        oc_fecha,    oc_fecha_recep,     oc_usu, oc_pro_id, oc_observaciones, oc_proveerut,   oc_proveedig, oc_proveenomb, oc_cantidad, oc_monto )
                        VALUES ( '$oc', '$regionsession', '0',    '$programa', '$fecha2', '$fechamia', '$usuario', '0',        '0',           '$proveedor', '$proveedor2',  '$proveedornomb'   ,'$cantidad',  '$total');";

//echo $sql;
//exit();
mysql_query($sql,$dbh);

$sql3 = "SELECT max(oc_id) as ultimo FROM bode_orcom where oc_usu='$usuario' ";
//echo $sql3."<br>";
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_array($res3);
$ultimo = $row3["ultimo"];

$j=0;
//echo "$j $totallinea";
while ($j<=$totallinea) {
   $var1=$var[$j];
   $var22=$var2[$j];
   $var33=$var3[$j];
   $var44=$var4[$j];
  // $var22=$var2[$cont2];
   if ($var1<>"" ) {
       $folios.=$var1.",";
       $sql = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_recibidos, doc_region)
                               VALUES ( '$ultimo', '0',               '$var1',    '$var33',       '$var22',         '0',        '$var44');";

//        echo $sql."<br>";

        mysql_query($sql,$dbh);


   }
   $j++;
}



//exit();

echo "<script>location.href='inv_indexoc2.php?cod=16&ok=1';</script>";
//echo "<script>location.href='inv_indexoc2.php?cod=16&ori=1&ok=1';</script>";
/*
if(mysql_query($sql,$dbh))
{
	echo "<script>location.href='inv_indexoc2.php?ori=1&id=".mysql_insert_id()."&ok=1';</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
*/
   

//-------------- Envio de mail   ----------------

//include("ssgg_enviamail.php");

//-------------- FIN Envio de mail   ----------------


//echo "<script>location.href='ssgg_index.php?exito=1';</script>";
?>

























