<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require("inc/config.php");
extract($_POST);
$oc_id = Date("YmdHis");

$sql2 = "SELECT * FROM bode_orcom x WHERE  x.oc_estado=100 and x.oc_mas_id=$masid";
$res2 = mysql_query($sql2);
$row = mysql_fetch_array($res2);
$id = $row["oc_id"];

for ($i=0; $i < $totallinea; $i++) {
	$var11=$var1[$i];
	$var22=$var2[$i];
	$var33=$var3[$i];
	$var44=$var4[$i];
	$var55=$var5[$i];
	if($var11 <> "")
	{
		$doc_id = "SELECT ding_prod_id FROM bode_detingreso WHERE ding_id = ".$var11;
		$doc_id = mysql_query($doc_id);
		$doc_id = mysql_fetch_array($doc_id);
		$doc_id = $doc_id["ding_prod_id"];

		$datos = "SELECT * FROM bode_detoc WHERE doc_id = ".$doc_id;
		$datos = mysql_query($datos);
		$datos = mysql_fetch_array($datos);
		
		$existe = "SELECT count(doc_prod_id) as Total FROM bode_detoc2 WHERE doc_prod_id = ".$var11." AND doc_mas_id = ".$masid;
		$resExiste = mysql_query($existe);
		$rowExiste = mysql_fetch_array($resExiste);
		$existe = intval($rowExiste["Total"]);
		if($existe == 0)
		{
			$sql = "INSERT INTO bode_detoc2 (doc_oc_id,doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_unit,doc_moneda,doc_valor_moneda,doc_conversion,doc_mas_id,doc_factor,doc_umedida) VALUES ('".$oc_id."',       $var11,            '$var33',       '$var22',       '$var55',       '0',        '$v_oc_region', '$doc_id', '$var66',$datos[doc_unit],'$datos[doc_moneda]',$datos[doc_valor_moneda],$datos[doc_conversion],$masid,$datos[doc_factor],'$datos[doc_umedida]' );";
			mysql_query($sql);
		}
	}
}
?>
<script>location.href='bode_inv_indexguia3.php?ori=3&masid=<?php echo $masid?>&ok=1&cmd=nuevo';</script>