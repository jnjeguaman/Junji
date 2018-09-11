	<?php
	session_start();
	if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
	require_once("inc/config.php");
	extract($_GET);

	// BUSCAMOS LOS PRODUCTOS SEGUN EL INGRESO Y ELIMINARMOS LA RECEPCION TECNICA COMPLETA
	$sql = "SELECT ding_prod_id,ding_cantidad FROM bode_detingreso WHERE ding_ing_id = ".$ing_id;

	$res = mysql_query($sql);

	while($row = mysql_fetch_array($res))
	{
		$update = "UPDATE bode_detoc SET doc_recibidos = doc_recibidos - ".$row["ding_cantidad"].", doc_tecnicos = doc_tecnicos - ".$row["ding_cantidad"]." WHERE doc_id = ".$row["ding_prod_id"].";";
		mysql_query($update);
	}
	$update2 = "UPDATE bode_ingreso SET ing_estado = 0 WHERE ing_id = ".$ing_id;
	mysql_query($update2);

	$log = "INSERT INTO log VALUES (NULL,".$ing_id.",0,'RECHAZA RECEPCION TECNICA','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA' ,'RECEPCION TECNICA')";
	mysql_query($log);
	echo json_encode(array("Respuesta" => true,"Mensaje" => "Recepcion Técnica Anulada"));
	?>