<?
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$nom_user = $_SESSION["nom_user"];
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nombrecom"];
extract($_GET);
extract($_POST);

if($regionsession == 16)
{

if($tipo_guia == 1)
{
	$region_destino = $bodega;
}else if($tipo_guia == 2 )
{
	$region_destino = $region_destino;
}else if($tipo_guia == 3)
{
	$region_destino = $region_destino;
}else if($tipo_guia == 5)
{
	$region_destino = $regionsession;
} else if($tipo_guia == 6)
{
	$region_destino = $regionsession;
}

}else{
	if($tipo_guia == 1)
	{
		$region_destino = $bodega;
	}else{
		$region_destino = $regionsession;
	}
}

$regiones = array(
	1 => "BODEGA REGIONAL. I REGION",
	2 => "BODEGA REGIONAL. II REGION",
	3 => "BODEGA REGIONAL. III REGION",
	4 => "BODEGA REGIONAL. IV REGION",
	5 => "BODEGA REGIONAL. V REGION",
	6 => "BODEGA REGIONAL. VI REGION",
	7 => "BODEGA REGIONAL. VII REGION",
	8 => "BODEGA REGIONAL. VIII REGION",
	9 => "BODEGA REGIONAL.  IX REGION",
	10 => "BODEGA REGIONAL. X REGION",
	11 => "BODEGA REGIONAL. XI REGION",
	12 => "BODEGA REGIONAL. XII REGION",
	13 => "CENTRAL DE ABASTECIMIENTO",
	14 => "BODEGA REGIONAL. XIV REGION",
	15 => "BODEGA REGIONAL. XV REGION",
	16 => "CENTRAL DE ABASTECIMIENTO",
	);

if($tipo_guia == 5)
{
	$bodega = $regiones[$_SESSION["region"]];
	$consumo = "SELECT consumo_folio FROM bode_folio_consumo";
	$consumo = mysql_query($consumo);
	$consumo = mysql_fetch_array($consumo);
	$consumo = $consumo["consumo_folio"] + 1;
}

/*
// Verificamos si existen registros en acti_compra_temportal
$sqlTemportal = "SELECT count(*) as total FROM acti_compra_temporal";
$sqlTemportalResp = mysql_query($sqlTemportal);
$respTemporal = mysql_fetch_array($sqlTemportalResp);
$respTemporal = intval($respTemporal["total"]);

// Verificamos si existen registros en acti_compra_temportal

if ($respTemporal >= 1) {

	$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra_temporal";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$compra_id = intval($row["compra_id"] + 1);


} else {
	$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$compra_id = intval($row["compra_id"] + 1);

}
*/

//$compra_bruto_unitario = round($total / $cantidad);
$fecha2= substr($fecha_orden_compra,6,4)."-".substr($fecha_orden_compra,3,2)."-".substr($fecha_orden_compra,0,2);

// $sqlLast = "SELECT max(oc_folioguia) as maximo FROM bode_orcom";
$sqlLast = "SELECT max(oc_id) as maximo FROM bode_orcom";
$sqlLastResp = mysql_query($sqlLast);
$row = mysql_fetch_array($sqlLastResp);
$maximo = intval($row["maximo"] + 1);

if($tipo_guia == 5)
{
	$maximo = $consumo;
}

$oc=$maximo;

$sql = "INSERT INTO bode_orcom (oc_id2, oc_region,  oc_region2, oc_nombre_oc, oc_prog,        oc_fecha,    oc_fecha_recep,     oc_usu, oc_pro_id, oc_observaciones, oc_proveerut,   oc_proveedig, oc_proveenomb, oc_cantidad, oc_monto, oc_swdespacho, oc_folioguia,oc_tipo_guia,oc_tipo,oc_region_destino,oc_usuario)
VALUES ( '$oc', '$bodega', '$regionsession', '0',    '0',              '$fecha2', '$fechamia', '$usuario', '0',        '',           '0', '0', '".$regiones[$regionsession]."'   ,'0',  '0', '1', '$maximo',$tipo_guia,1,'$region_destino','".$nom_user."');";
if($tipo_guia == 5)
{
	mysql_query("UPDATE  bode_folio_consumo SET consumo_folio = ".$consumo);
}
mysql_query($sql);

$fechamia2=date('Y-m-d');
$horaSys = Date("H:i:s");

if($tipo_guia == 1)
{
	$tipoGlosa = "BODEGA REGIONAL";
}else if($tipo_guia ==2)
{
	$tipoGlosa = "OFICINA";
}elseif($tipo_guia == 3)
{
	$tipoGlosa = "JARDIN";
}elseif($tipo_guia == 5)
{
	$tipoGlosa = "CONSUMO";
}else if($tipo_guia == 6)
{
	$tipoGlosa = "TRASLADO INTERNO";
}

$log = "INSERT INTO log VALUES(NULL,".mysql_insert_id().",1,'GENERACION G/D (".$tipoGlosa.")','".$_SESSION["nom_user"]."','".$fechamia2."','".$horaSys."','BODEGA','DESPACHOS')";
mysql_query($log);

//exit();

echo "<script>location.href='bode_inv_indexoc3.php?cod=22&ok=1';</script>";
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
