<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_GET);
extract($_POST);;
$nom_user = $_SESSION["nom_user"];
// BUSCAMOS LOS PRODUCTOS SEGUN EL INGRESO Y ELIMINARMOS LA RECEPCION TECNICA COMPLETA
$productos = mysql_query("SELECT * FROM bode_detingreso WHERE ding_ing_id = ".$ing_id,$dbh);
$productos2 = mysql_query("SELECT * FROM bode_detingreso WHERE ding_ing_id = ".$ing_id,$dbh);

$sql = "SELECT * FROM bode_ingreso WHERE ing_id = ".$ing_id;
$res = mysql_query($sql,$dbh);
$row = mysql_fetch_array($res);
$ing_estado = $row["ing_estado"];

if($ing_estado <> 0){
if($ing_estado == 1 || $ing_estado == 2)
{

// COMPROBAMOS SI ALGUNO DE LOS PRODUCTOS TIENE DESPACHO ASOCIADO
$total = 0;
while($row =  mysql_fetch_array($productos))
{
	$query = mysql_query("SELECT count(b.doc_id) as Total FROM bode_detingreso a INNER JOIN bode_detoc b ON b.doc_origen_id = a.ding_id WHERE a.ding_id = ".$row["ding_id"]." AND b.doc_estado <> 'ELIMINADO'",$dbh);
	$res = mysql_fetch_array($query);
	$total += $res["Total"];
}
if($total == 0)
{
	while($row = mysql_fetch_array($productos2))
	{
		mysql_query("UPDATE bode_detoc SET doc_stock = doc_stock - (".$row["ding_cantidad"]." - ".$row[9]."), doc_recibidos = doc_recibidos - (".$row["ding_cantidad"]." - ".$row["ding_cant_rechazo"].") WHERE doc_id = ".$row["ding_prod_id"],$dbh);
	}

	mysql_query("UPDATE bode_ingreso SET ing_estado = 0 WHERE ing_id = ".$ing_id,$dbh);
	mysql_query("INSERT INTO log VALUES (NULL,".$ing_id.",0,'RECHAZA INGRESO','".$nom_user."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA' ,'APROBACIONES')",$dbh);
	// echo "<script>alert('');</script>";
	echo json_encode(array("Respuesta" => true,"Mensaje" => "EL INGRESO HA SIDO ANULADO EXITOSAMENTE!"));
}else{
	// echo "<script>alert('NO SE HA PODIDO ANULAR EL INGRESO DEBIDO A QUE HAY DESPACHOS ASOCIADOS');</script>";
	echo json_encode(array("Respuesta" => false,"Mensaje" => "NO SE HA PODIDO ANULAR EL INGRESO DEBIDO A QUE HAY DESPACHOS ASOCIADOS"));
}
}else{
	mysql_query("UPDATE bode_ingreso SET ing_estado = 0 WHERE ing_id = ".$ing_id,$dbh);
	mysql_query("INSERT INTO log VALUES (NULL,".$ing_id.",0,'RECHAZA INGRESO','".$nom_user."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA' ,'APROBACIONES')",$dbh);
	echo json_encode(array("Respuesta" => true,"Mensaje" => "EL INGRESO HA SIDO ANULADO EXITOSAMENTE!"));
}
}else{
	echo json_encode(array("Respuesta" => true,"Mensaje" => "EL INGRESO HA SIDO ANULADO CON ANTERIORIDAD!"));
}
?>