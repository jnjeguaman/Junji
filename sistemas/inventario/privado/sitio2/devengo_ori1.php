<?php
// COMPROBAMOS EL INGRESO DE LA OC AL SISTEMA (LOGISTICA O INVENTARIO);
$oc = $oc1."-".$oc2."-".$oc3;
$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON b.ing_oc_id = a.oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = b.ing_id	 WHERE a.oc_id2 = '$oc' AND b.ing_guianumerorc <> 0 AND (b.ing_estado = 1 OR b.ing_estado = 2) AND (b.ing_clasificacion = 1 OR b.ing_clasificacion = 0) AND a.oc_estado = 1 AND b.ing_region = ".$_SESSION["region"]." GROUP BY b.ing_guianumerorc";
$res = mysql_query($sql,$dbh);

$sql2 = "SELECT * FROM acti_compra WHERE oc_numero = '".$oc."' AND (compra_ing_id = 0 OR compra_ing_id IS NULL)";
$res2 = mysql_query($sql2);
// INGRESADO EN BODEGA Y NO 
if(mysql_num_rows($res) > 0 && mysql_num_rows($res2) == 0 || $_GET["tipo"]=="BODEGA")
{
	// echo "INGRESADO SOLO EN BODEGA";
	require_once("devengo_ori11.php");
}else if(mysql_num_rows($res2) > 0 && mysql_num_rows($res) == 0 || $_GET["tipo"]=="INVENTARIO")
{
	// echo "INGRESADO SOLO EN INVENTARIO";
	require_once("devengo_ori12.php");
}else{
	echo '<a href="devengo.php?tipo=BODEGA&oc1='.$oc1.'&oc2='.$oc2.'&oc3='.$oc3.'&submit=BUSCAR" style="font-size:0.5em;border:1px solid green;padding:5px;background:#088A4B;color:white;margin:5px;">DEVENGAR BODEGA</a>';
	echo '<a href="devengo.php?tipo=INVENTARIO&oc1='.$oc1.'&oc2='.$oc2.'&oc3='.$oc3.'&submit=BUSCAR" style="font-size:0.5em;border:1px solid green;padding:5px;background:#088A4B;color:white;">DEVENGAR INVENTARIO</a>';
	// echo "BODEGA : ".mysql_num_rows($res);
	// echo "<br>INVENTARIO : ".mysql_num_rows($res2);
}

?>