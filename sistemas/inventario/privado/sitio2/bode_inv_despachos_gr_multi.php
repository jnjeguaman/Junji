<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_POST);

$totalElementos = count($var8);

for($i=1;$i<=$totalElementos;$i++)
{
	if($var7[$i] <> '')
	{
	mysql_query("UPDATE bode_detingreso SET ding_unidad = ding_unidad + ".$var8[$i].",ding_cant_despacho = ding_cant_despacho - ".$var8[$i]." WHERE ding_id = ".$var7[$i]);
	mysql_query("update bode_detoc set doc_estado='ELIMINADO' where doc_id=".$var9[$i]);
	// $doc_id = "SELECT ding_prod_id FROM bode_detingreso WHERE ding_id = ".$var7[$i];
	// $doc_id = mysql_query($doc_id);
	// $doc_id = mysql_fetch_array($doc_id);
	// $doc_id = $doc_id["ding_prod_id"];
 	// echo $consulta="UPDATE bode_detoc set doc_stock = doc_stock+".$var8[$i]." where doc_id = ".$doc_id."<br><br>";
	}
}
?>
 <script>location.href='bode_inv_indexoc3.php?ori=<? echo $ori ?>&id=<? echo $id ?>';</script>