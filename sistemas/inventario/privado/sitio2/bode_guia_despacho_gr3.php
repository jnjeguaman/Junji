	<?php
ini_set("display_errors", 1);
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
include("inc/config.php");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
extract($_POST);

$fecha = explode("-", $emision);
$fechaNueva = $fecha[2]."-".$fecha[1]."-".$fecha[0];


$sql3 = "SELECT max(ing_guianumerorc) as maximo FROM bode_ingreso";
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_array($res3);
$maximo=$row3["maximo"]+1;

//ORI $query = "UPDATE bode_detingreso x, bode_ingreso y, bode_orcom z  SET y.ing_guiaabasterc = '$abastece', y.ing_guiafecharc = '$emision', y.ing_guiadestinarc = '$destinatario', y.ing_guiaemisorrc='$emisor', y.ing_guianumerorc = $maximo, y.ing_region='$regionsession' where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and x.ding_userf<>'' and y.ing_guianumerorc=0 ";
//ORI2 $query = "UPDATE bode_detingreso x, bode_ingreso y, bode_orcom z  SET y.ing_guiaabasterc = '$abastece', y.ing_guiafecharc = '$emision', y.ing_guiadestinarc = '$destinatario', y.ing_guiaemisorrc='$emisor', y.ing_guianumerorc = $guianumerorc, y.ing_region='$regionsession' where x.ding_ing_id=$ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and x.ding_userf<>'' and y.ing_guianumerorc=0";
$query = "UPDATE bode_ingreso y SET y.ing_guiafecharc = '$emision', y.ing_guiaemisorrc='$emisor', y.ing_guianumerorc = $maximo, y.ing_region='$regionsession' where y.ing_id=$ing_id";
//$query = "UPDATE bode_ingreso SET ing_guiaabastetc = '$abastece', ing_guiafechatc = '$emision', ing_guiadestinatc = '$destinatario', ing_guiaemisortc='$emisor', ing_guianumerotc = $nro_guia, ing_region='$regionsession' WHERE ing_oc_id = $id";
mysql_query($query);


/* MOSTRAMOS EN STOCK */
$detingreso = "UPDATE bode_detingreso SET ding_recep_conforme = 'C' WHERE ding_ing_id = ".$ing_id;
mysql_query($detingreso);

/* CONEXION CON INVENTARIO */

$regiones = array(
	1 => "I REGION",
	2 => "II REGION",
	3 => "III REGION",
	4 => "IV REGION",
	5 => "V REGION",
	6 => "VI REGION",
	7 => "VII REGION",
	8 => "VIII REGION",
	9 => "IX REGION",
	10 => "X REGION",
	11 => "XI REGION",
	12 => "XII REGION",
	13 => "REGION METROPOLITANA",
	14 => "XIV REGION",
	15 => "XV REGION",
	16 => "DIRECCION NACIONAL");

/* PRODUCTOS A INGRESAR */
$productos = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b on a.ding_prod_id = b.doc_id WHERE a.ding_ing_id = ".$ing_id;
$productos = mysql_query($productos);
$rowProductos = array();
while($row = mysql_fetch_array($productos))
{
	$rowProductos[] = $row;
}

/* OBTENEMOS EL OC_ID */
$oc_id = "SELECT ing_oc_id as OC FROM bode_ingreso WHERE ing_id = ".$ing_id;
$oc_id = mysql_query($oc_id);
$oc_id = mysql_fetch_array($oc_id);
$oc_id = $oc_id["OC"];

/* INFO DE LA OC */
$oc = "SELECT * FROM bode_orcom WHERE oc_id = ".$oc_id;
$oc = mysql_query($oc);
$oc = mysql_fetch_array($oc);

/* VERIFICA SI EXISTE LA OC EN INVENTARIO */
$existe = "SELECT count(id) as Total FROM acti_compra_temporal WHERE oc_numero ='".$oc["oc_id2"]."'";

$existe = mysql_query($existe);
$existe = mysql_fetch_array($existe);
$existe = $existe["Total"];

if($existe > 0)
{
	/* OBTENEMOS LA COMPRA ID */
	$ultima = "SELECT compra_id as Maximo FROM acti_compra_temporal WHERE oc_numero = '".$oc["oc_id2"]."'";
	$ultima = mysql_query($ultima);
	$ultima = mysql_fetch_array($ultima);
	$ultima = $ultima["Maximo"];
	$hoy = Date("Y-m-d H:i:s");

	foreach ($rowProductos as $key => $value) {
		//$ocBruto = $value["doc_valor_unit"] / $value["ding_cantidad"];
		$ocBruto = $value["doc_conversion"];
		$ingresa = "INSERT INTO acti_compra_temporal (compra_id,compra_proveedor,compra_glosa,compra_region,compra_cantidad,compra_programa,compra_moneda,compra_tipo_cambio,oc_numero,compra_estado,compra_region_id,compra_ing_id,compra_ding_id,compra_clasificacion,compra_monto,solicitud_estado,oc_estado,rc_estado,compra_bruto_unitario,compra_plazo_entrega,compra_fecha_registro,solicitud_bruto_sc,solicitud_cantidad_entregado,oc_bruto_oc,oc_cantidad_entregado,compra_doc_id,compra_rc) VALUES (".$ultima.",'".$oc["oc_proveenomb"]."','".$value["doc_especificacion"]."','".$regiones[$value["doc_region"]]."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$oc["oc_prog"]."','".$value["doc_moneda"]."',".$value["doc_valor_moneda"].",'".$oc["oc_id2"]."',0,".$value["doc_region"].",".$ing_id.",".$value["ding_id"].",0,'".($value["doc_conversion"] * ($value["ding_cantidad"] - $value["ding_cant_rechazo"]))."','PENDIENTE','PENDIENTE','PENDIENTE','".$ocBruto."','".$oc["oc_fecha"]."','".$hoy."','".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",".$value["doc_id"].",'".$guianumerorc."')";
		mysql_query($ingresa);
	}

}else{
	/* AGREGA LINEA DE COMPRA */
	$ultima = "SELECT MAX(compra_id) as Maximo FROM acti_compra_temporal";
	$ultima = mysql_query($ultima);
	$ultima = mysql_fetch_array($ultima);
	$ultima = $ultima["Maximo"] + 1;
	$hoy = Date("Y-m-d H:i:s");

	/* va dentro de un while segun los productos */
	foreach ($rowProductos as $key => $value) {
		//$ocBruto = $value["doc_valor_unit"] / $value["ding_cantidad"];
		$ocBruto = $value["doc_conversion"];
		$ingresa = "INSERT INTO acti_compra_temporal (compra_id,compra_proveedor,compra_glosa,compra_region,compra_cantidad,compra_programa,compra_moneda,compra_tipo_cambio,oc_numero,compra_estado,compra_region_id,compra_ing_id,compra_ding_id,compra_clasificacion,compra_monto,solicitud_estado,oc_estado,rc_estado,compra_bruto_unitario,compra_plazo_entrega,compra_fecha_registro,solicitud_bruto_sc,solicitud_cantidad_entregado,oc_bruto_oc,oc_cantidad_entregado,compra_doc_id,compra_rc) VALUES (".$ultima.",'".$oc["oc_proveenomb"]."','".$value["doc_especificacion"]."','".$regiones[$value["doc_region"]]."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$oc["oc_prog"]."','".$value["doc_moneda"]."',".$value["doc_valor_moneda"].",'".$oc["oc_id2"]."',0,".$value["doc_region"].",".$ing_id.",".$value["ding_id"].",0,'".($value["doc_conversion"] * ($value["ding_cantidad"] - $value["ding_cant_rechazo"]))."','PENDIENTE','PENDIENTE','PENDIENTE','".$ocBruto."','".$oc["oc_fecha"]."','".$hoy."','".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",".$value["doc_id"].",'".$guianumerorc."')";
		mysql_query($ingresa);
	}
}

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$guianumerorc.",0,'APRUEBA RECEPCION CONFORME','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','INGRESO BODEGA')";
mysql_query($log);

?>
<script type="text/javascript">
	window.location.href="bode_inv_indexoc2.php?oc_id=<? echo $oc_id ?>&ori=6&doc_id=<? echo $doc_id ?>";
</script>
