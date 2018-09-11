<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
include("inc/config.php");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
extract($_POST);
//$sql3 = "SELECT max(ing_guianumerotc) as maximo FROM bode_ingreso where ing_region=$regionsession ";
$sql3 = "SELECT max(ing_guianumerotc) as maximo FROM bode_ingreso";
//echo $sql3;
$res3 = mysql_query($sql3,$dbh);
$row3 = mysql_fetch_array($res3);
$maximo=$row3["maximo"]+1;

$fecha = explode("-", $emision);
// $fechaNueva = $fecha[2]."-".$fecha[1]."-".$fecha[0];

//$query = "UPDATE bode_detingreso x, bode_ingreso y, bode_orcom z  SET y.ing_guiaabastetc = '$abastece', y.ing_guiafechatc = '$emision', y.ing_guiadestinatc = '$destinatario', y.ing_guiaemisortc='$emisor', y.ing_guianumerotc = $maximo, y.ing_region='$regionsession' where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0";
  //OR $query = "UPDATE bode_detingreso x, bode_ingreso y, bode_orcom z  SET y.ing_guiaabastetc = '$abastece', y.ing_guiafechatc = '$emision', y.ing_guiadestinatc = '$destinatario', y.ing_guiaemisortc='$emisor', y.ing_guianumerotc = $maximo, y.ing_region='$regionsession' where x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 AND y.ing_id = ".$ing_id;
  //OR2     $query = "UPDATE bode_detingreso x, bode_ingreso y, bode_orcom z  SET y.ing_guiaabastetc = '$abastece', y.ing_guiafechatc = '$emision', y.ing_guiadestinatc = '$destinatario', y.ing_guiaemisortc='$emisor', y.ing_guianumerotc = $maximo, y.ing_region='$regionsession' where x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 AND x.ding_ing_id = ".$ing_id;
$query = "UPDATE bode_ingreso SET ing_guiafechatc = '$emision', ing_guiaemisortc='$emisor', ing_guianumerotc = $maximo , ing_region='$regionsession' where ing_id=$ing_id";
//$query = "UPDATE bode_ingreso SET ing_guiaabastetc = '$abastece', ing_guiafechatc = '$emision', ing_guiadestinatc = '$destinatario', ing_guiaemisortc='$emisor', ing_guianumerotc = $nro_guia, ing_region='$regionsession' WHERE ing_oc_id = $id";
mysql_query($query);

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$maximo.",0,'APRUEBA RECEPCION TECNICA','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','INGRESO BODEGA')";
mysql_query($log);

?>
<script type="text/javascript">
	window.location.href="bode_inv_indexoc2.php?cod=20";
</script>
