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



$sql = "update bode_orcom set oc_grupo='$grupo' where oc_id=$id;";

//echo $sql;
//exit();
mysql_query($sql);

/*
$sql3 = "SELECT max(oc_id) as ultimo FROM bode_orcom where oc_usu='$usuario' ";
//echo $sql3."<br>";
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_array($res3);
$ultimo = $row3["ultimo"];

*/


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

























