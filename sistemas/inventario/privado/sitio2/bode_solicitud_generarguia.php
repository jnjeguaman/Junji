<?php
session_start();
$regionSession = $_SESSION["region"];
$nombrecom = $_SESSION["nombrecom"];
$fechamia = date("Y-m-d");
$proveedor = "CENTRAL DE ABASTECIMIENTO";
$nom_user = $_SESSION["nom_user"];
extract($_POST);
require_once("inc/config.php");
// SE BUSCAN LOS DATOS DE LA SOLICITUD
$sql = "SELECT * FROM bode_solicitud WHERE sp_id = ".$sp_id;
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

// // CAMBIAMOS DE ESTADO LOS PRODUCTOS EN LA RELACION
// $sql5 = "SELECT * FROM bode_solicitud_rel WHERE sp_rel_sp_id = ".$sp_id." AND sp_rel_estado = 1";
// $res5 = mysql_query($sql5,$dbh);
// while($row5 = mysql_fetch_array($res5))
// {
// 	$sql6 = "UPDATE bode_solicitud_rel SET sp_rel_estado = 2,sp_rel_despachado = sp_rel_cantidad, sp_rel_cantidad = 0 WHERE sp_rel_id = ".$row5["sp_rel_id"];
// 	mysql_query($sql6);
// }
// SE CREA LA ESTRUCTURA EN BODE_ORCOM
if($sp_tipo_envio == 1)
{
	$horamia = date("H:i:s");
	$sql = "UPDATE bode_solicitud SET sp_aprobacion_usr = '".$nom_user."', sp_aprobacion = ".$sp_aprobacion.",sp_aprobacion_fecha = '".$fechamia."',sp_aprobacion_hora = '".$horamia."' WHERE sp_id = ".$sp_id;
	mysql_query($sql);
	echo "<script>window.location.href='bode_inv_indexoc4.php?cmd=Solicitudes'</script>";
	exit;
}

$sql2 = "INSERT INTO bode_orcom (oc_region,					oc_region2,		oc_fecha,		oc_usu,		oc_proveenomb,oc_swdespacho,oc_tipo_guia,				oc_tipo,oc_fecha_recep,oc_sp_id,oc_obs,oc_region_destino) 
VALUES ('".$row["sp_destino"]."','$regionSession',	 '$fechamia',	 '$nombrecom',  '$proveedor',   1,		'".$row["sp_tipo_destino"]."', 1,'".$fechamia."','$sp_id','".$solicitud_observacion."','".$region_destino."')";

mysql_query($sql2);

$rs=mysql_query("select @@identity as id");
if ($row4=mysql_fetch_row($rs)) {
	$id_ultimo = trim($row4[0]);
}


for($i=1;$i<=$totalElementos;$i++)
{
	if($var1[$i] <> "")
	{
		$var1[$i]."<br>";
		// INFORMACION DEL PRODUCTO A INGRESAR
		// $sql3 = "SELECT * FROM bode_detoc a inner join bode_detingreso b on b.ding_prod_id = a.doc_id inner join bode_orcom c on c.oc_id = a.doc_oc_id WHERE b.ding_id = ".$var3[$i];
		$sql3 = "SELECT * FROM bode_detoc3 WHERE doc_id = ".$var5[$i];
		$res3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($res3);

		$sql4 = "INSERT INTO bode_detoc(doc_oc_id,				doc_especificacion,			doc_cantidad,				doc_valor_unit,			doc_region,					doc_numerooc,					doc_unit,					doc_moneda,doc_valor_moneda,doc_conversion,doc_umedida,doc_factor,doc_activo,doc_gasto,doc_clasificacion,doc_sp_rel_doc_id)
		VALUES	('$id_ultimo',	'".$row3["doc_especificacion"]."','$var2[$i]',			'".$row3["doc_valor_unit"]."',		'".$row["sp_destino"]."', '".$row3["oc_id2"]."',  '".$row3["doc_unit"]."',	'".$row3["doc_moneda"]."','".$row3["doc_valor_moneda"]."','".$row3["doc_conversion"]."','".$row3["doc_umedida"]."','".$row3["doc_factor"]."','".$row3["doc_activo"]."','".$row3["doc_gasto"]."','".$var6[$i]."','".$var7[$i]."')";
		mysql_query($sql4);	

		// $sql5 = "UPDATE bode_solicitud_rel SET sp_rel_estado = 2,sp_rel_despachado = sp_rel_cantidad, sp_rel_cantidad = 0 WHERE sp_rel_id = ".$var4[$i];							
		// mysql_query($sql5);
		// $sql5 = "SELECT * FROM bode_solicitud_rel WHERE sp_rel_cantidad <> 0 AND sp_rel_sp_id = ".$sp_id." AND sp_rel_doc_id = ".$var5[$i];
		$sql5 = "UPDATE bode_solicitud_rel SET sp_rel_estado = 2, sp_rel_despachado = sp_rel_cantidad,sp_rel_cantidad = 0 WHERE sp_rel_sp_id = ".$sp_id." AND sp_rel_doc_id =".$var5[$i]." AND (sp_rel_cantidad <> '' OR sp_rel_cantidad <> NULL OR sp_rel_cantidad <> 0)";
		mysql_query($sql5,$dbh);
	}
}

// COMPROBACION
// SELECCIONAMOS TODOS LOS PRODUCTOS DE LA SOLICITUD
$sql10 = "SELECT * FROM bode_detoc3 where doc_sp_id = ".$_POST["sp_id"];
$res10 = mysql_query($sql10);
$contador = 0;
while($row10 = mysql_fetch_array($res10))
{
	$solicitado = intval($row10["doc_cantidad"]);
	// BUSCAMOS LO DESPACHADO
	$sql11 = "SELECT SUM(sp_rel_despachado) as Despachado FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row10["doc_id"];
	$res11 = mysql_query($sql11);
	$row11 = mysql_fetch_array($res11);
	$despachado = intval($row11["Despachado"]);
	if($solicitado == $despachado)
	{
		$contador++;
	}

}
if(mysql_num_rows($res10) == $contador)
{
	mysql_query("UPDATE bode_solicitud SET sp_estado = 2 WHERE sp_id = ".$_POST["sp_id"]);
}
echo "<script>window.location.href='bode_inv_indexoc4.php?cmd=Solicitudes'</script>";
?>
