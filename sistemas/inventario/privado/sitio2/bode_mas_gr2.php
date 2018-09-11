<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
ini_set("max_input_vars", 10000);
require_once("inc/config.php");
extract($_GET);
$emisor = $_SESSION["nombrecom"];
//Buscamos los jardines
$jardines = array();
$productos = array();
$nom_user = $_SESSION["nom_user"];

$femision = mysql_query("SELECT * FROM bode_masiva WHERE mas_id = ".$masid);
$femision = mysql_fetch_array($femision);
$frecep = $femision["mas_fechasys"];
$femision = $femision["mas_fecha"];

$getJardines = "SELECT * FROM bode_orcom2 a INNER JOIN bode_masiva b ON a.oc_mas_id = b.mas_id WHERE a.oc_mas_id = ".$masid;
$resJardines = mysql_query($getJardines);
while($rowJardines = mysql_fetch_array($resJardines))
{
	$jardines[] = $rowJardines;
}


//$getProductos = "SELECT * FROM bode_detoc_2 a INNER JOIN bode_detoc b ON a.ddoc_prod_id = b.doc_id WHERE a.ddoc_mas_id = ".$masid;

$getProductos = "SELECT * FROM bode_detoc_2 a INNER JOIN bode_detingreso b ON a.ddoc_prod_id = b.ding_id INNER JOIN bode_detoc c ON c.doc_id = b.ding_prod_id WHERE a.ddoc_mas_id = ".$masid;
$resProductos = mysql_query($getProductos);
while($rowProductos = mysql_fetch_array($resProductos))
{
	$productos[] = $rowProductos;
}

$ids = array();

for ($i=0; $i < count($jardines); $i++) { 
	
	 # Este folio asociada a los productos
	$folio = "SELECT max(oc_id) as Folio FROM bode_orcom";
	$folio = mysql_query($folio);
	$folio = mysql_fetch_array($folio);
	$folio = intval($folio["Folio"] + 1);

	$ids[] = array("Jardin" => $jardines[$i]["oc_region"],"Folio" => $folio);

	# INSTANCIA DE LA GUIA DE DESPACHO
	$bode_orcom = "INSERT INTO bode_orcom (oc_id2,        oc_region,  				oc_region2, 						oc_nombre_oc, 						oc_prog,					oc_fecha,		oc_fecha_recep,						oc_usu, 						oc_pro_id, 						oc_observaciones, 						oc_proveerut,   					oc_proveedig, 						oc_proveenomb, 						oc_cantidad, 						oc_monto, 						oc_swdespacho, 				oc_folioguia,		oc_tipo_guia,				oc_tipo, 		oc_estado, 		oc_mas_id,oc_usuario) ";
	$bode_orcom .=" VALUES ";
	$bode_orcom .="(".$folio.",".$jardines[$i]["oc_region"].",".$jardines[$i]["oc_region2"].",'".$jardines[$i]["oc_nombre_oc"]."','".$jardines[$i]["oc_prog"]."','".$femision."','".$frecep."','".$emisor."',".$jardines[$i]["oc_pro_id"].",'".$jardines[$i]["oc_observaciones"]."','".$jardines[$i]["oc_proveerut"]."','".$jardines[$i]["oc_proveedig"]."','".$jardines[$i]["oc_proveenomb"]."',".$jardines[$i]["oc_cantidad"].",".$jardines[$i]["oc_monto"].",".$jardines[$i]["oc_swdespacho"].",".$folio.",".$jardines[$i]["oc_tipo_guia"].",".$jardines[$i]["oc_tipo"].",".$jardines[$i]["oc_estado"].",".$jardines[$i]["oc_mas_id"].",'".$nom_user."');";

 	 //echo $bode_orcom."<br>";
	mysql_query($bode_orcom);
 	}//Fin For

 	for ($i=0; $i <count($productos) ; $i++) { 
 		for ($j=0; $j <count($ids) ; $j++) {
 			if($ids[$j]["Jardin"] == $productos[$i]["ddoc_oc_id"])
 			{
 				$new = $ids[$j]["Folio"];
 			}
 		}

 		$stock = "UPDATE bode_detingreso SET ding_unidad = ding_unidad - ".$productos[$i]["ddoc_cantidad"]." WHERE ding_id = ".$productos[$i]["ddoc_prod_id"]." AND ding_recep_tecnica = 'A';";
 		//echo $stock."<br>";
 		mysql_query($stock);
 		$bode_detoc = "INSERT INTO bode_detoc (
 		doc_oc_id,
 		doc_prod_id, 
 		doc_especificacion, 
 		doc_cantidad, 
 		doc_valor_unit, 
 		doc_recibidos, 
 		doc_region,
 		doc_origen_id, 
 		doc_numerooc,
 		doc_unit,
 		doc_moneda,
 		doc_valor_moneda,
 		doc_conversion,
 		doc_mas_id,
 		doc_factor,
 		doc_umedida)";
 		$bode_detoc.=" VALUES ";
 		$bode_detoc.="(
 		".$new.",
 		".$productos[$i]["doc_prod_id"].", 
 		'".$productos[$i]["doc_especificacion"]."',
 		".$productos[$i]["ddoc_cantidad"].",
 		".$productos[$i]["doc_valor_unit"].",
 		".$productos[$i]["doc_recibidos"].",
 		'".$productos[$i]["doc_region"]."',
 		".$productos[$i]["ddoc_prod_id"].",
 		'".$productos[$i]["doc_numerooc"]."',
 		'".$productos[$i]["doc_unit"]."',
 		'".$productos[$i]["doc_moneda"]."',
 		'".$productos[$i]["doc_valor_moneda"]."',
 		".$productos[$i]["doc_conversion"].",
 		".$masid.",
 		".$productos[$i]["doc_factor"].",
 		'".$productos[$i]["doc_umedida"]."'
 		);";
 			//echo $bode_detoc."<br>";
 		mysql_query($bode_detoc);
 	}
 	$update = "UPDATE bode_orcom SET oc_estado = '', oc_tipo_guia = 3 WHERE oc_mas_id = ".$masid; mysql_query($update);
 	$update2 = "UPDATE bode_masiva SET mas_publico = 1 WHERE mas_id = ".$masid; mysql_query($update2);

 	$log = "INSERT INTO log VALUES(NULL,".$masid.",0,'PUBLICA MATRIZ','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','MATRIZ')";
	mysql_query($log);
 	?>
 	<script type='text/javascript'>
 		window.location.href='bode_inv_indexoc3.php?cod=22';
 	</script>