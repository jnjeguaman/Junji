<?
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


//$compra_bruto_unitario = round($total / $cantidad);
$fecha2= substr($fecha_orden_compra,6,4)."-".substr($fecha_orden_compra,3,2)."-".substr($fecha_orden_compra,0,2);


/*
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

*/
$j=0;

//echo "$j $totallinea";

while ($j<$totallinea2) {


	$var44=$var4[$j];
	$var55=$var5[$j];

   // UNIDAD DE MEDIDA
   $var66=$var6[$j]; // Unidad de medida
   //$var22=str_replace(".","",$var2[$j]); // Cantidad
   $var77=$var7[$j]; // Factor

   if($var66 == "CAJA" || $var66 == "BALDE" || $var66 == "PAQUETE" || $var66 == "SET" || $var66 == "TARRO"){
   	$factor = $var77;
   }else{
   	$factor = 1;
   }
// FIN

   if ($var44<>"" or 1==1 ) {
//       $folios.=$var1.",";
       //$sql = "update bode_detoc set doc_region='$var44' where doc_id='$var55' ";
      $sql = "update bode_detoc set doc_region = '$var44', doc_umedida = '$var66', doc_factor = $factor WHERE doc_id= $var55";
        //echo $sql."<br>";

   	mysql_query($sql,$dbh);
   }
   $j++;
}
//exit();
echo "<script>location.href='bode_inv_indexoc2.php?ori=2&id=$id&ok=1';</script>";
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