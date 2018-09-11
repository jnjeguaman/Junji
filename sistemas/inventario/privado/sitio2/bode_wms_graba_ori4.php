<?php
session_start();
if($_SESSION["nom_user"] == "" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_POST);
$fechamia = date("Y-m-d");

$sql = "SELECT * FROM bode_orcom WHERE oc_id2 = '".$ing_oc."' AND oc_estado = 1 AND oc_tipo = 0";
$res = mysql_query($sql,$dbh);
$row = mysql_fetch_array($res);

$sql_tc = "SELECT MAX(ing_guianumerotc) as RT FROM bode_ingreso";
$res_tc = mysql_query($sql_tc);
$row_tc = mysql_fetch_array($res_tc);
$rt = $row_tc["RT"] + 1;

$sql_rc = "SELECT MAX(ing_guianumerorc) as RC FROM bode_ingreso";
$res_rc = mysql_query($sql_rc);
$row_rc = mysql_fetch_array($res_rc);
$rc = $row_rc["RC"] + 1;

// 1° INGRESO
$sql_ingreso =  "INSERT INTO bode_ingreso (
ing_guia,
ing_oc_id,
ing_fecha,
ing_region,
ing_recib_usu_id,
ing_guiafechatc,
ing_guianumerotc,
ing_guiaemisortc,
ing_guiafecharc,
ing_guianumerorc,
ing_guiaemisorrc,
ing_estado,
ing_clasificacion,
ing_wms
) 
VALUES 
(
'".$ing_guia."',
'".$row["oc_id"]."',
'".$fechamia."',
'".$ing_region."',
'".$ing_usuario."',
'".$fechamia."',
'".$rt."',
'".$ing_emisor."',
'".$fechamia."',
'".$rc."',
'".$ing_emisor."',
1,
0,
'".$ing_wms."'
)
";
mysql_query($sql_ingreso);
$ultimo_id = mysql_insert_id();

for($i=1;$i<$totalElementos;$i++)
{
	$pizza = explode("-", $ing_oc);
	if($pizza[0] == "599")
	{
		$region = 16;
	}
	if($pizza[0] == "856")
	{
		$region = 13;
	}
	$unidad = $var4[$i] / $var5[$i];
	// AUMENTAMOS LOS RECIBIDOS
	$update1 = "UPDATE bode_detoc SET doc_recibidos = doc_recibidos + ".$unidad." WHERE doc_oc_id = ".$row["oc_id"]." AND doc_id_mercado_publico = '".$var2[$i]."' AND doc_region = '".$region."'";
	mysql_query($update1);
	$sql_detalle = "SELECT doc_id FROM bode_detoc WHERE doc_oc_id = ".$row["oc_id"]." AND doc_id_mercado_publico = '".$var2[$i]."' AND doc_region = '".$region."' LIMIT 1";
	$res_detalle = mysql_query($sql_detalle);
	$row_detalle = mysql_fetch_array($res_detalle);

	$sql_detingreso = "INSERT INTO bode_detingreso (
	ding_ing_id,
	ding_prod_id,
	ding_cantidad,
	ding_region_id,
	ding_recep_tecnica,
	ding_cant_conf,
	ding_cant_final,
	ding_ubicacion,
	ding_user,
	ding_fecha,
	ding_userf,
	ding_fechaf,
	ding_fentrega,
	ding_recep_conforme,
	ding_umedida,
	ding_unidad,
	ding_factor,
	ding_estado,
	ding_cant_rechazo,
	ding_glosa_rechazo
	)
	VALUES (
	'".$ultimo_id."',
	'".$row_detalle["doc_id"]."',
	'".$unidad."',
	'".$ing_region."',
	'A',
	'".$unidad."',
	'".$unidad."',
	'CD - DIRNAC',
	'".$ing_usuario."',
	'".$fechamia."',
	'".$ing_usuario."',
	'".$fechamia."',
	'".$ing_fecha."',
	'C',
	'UNIDAD',
	'".$var4[$i]."',
	'".$var5[$i]."',
	1,
	0,
	''
	)
	";
	mysql_query($sql_detingreso);
}

if(1==1){
// MOVEMOS EL ARCHIVO CSV A LA CARPETA DE LOS PROCESADOS
	$configuracion = [
	"url" =>  "ftp.degesis.cl",
	"usuario" => "junji",
	"pwd" => "23.junWms"
	];

	$ftp = ftp_connect($configuracion["url"]);
	$ftp_id = ftp_login($ftp, $configuracion["usuario"], $configuracion["pwd"]);
	if($ftp){
	// CONEXION ESTABLECIDA
		if(ftp_rename($ftp,"openbox/nuevos/".$_POST["wms_file"],"openbox/procesado/".$_POST["wms_file"])){
			echo "<script>alert('El archivo ".$_POST["wms_file"]." ha sido procesado correctamente.');</script>";
		}else{
			echo "<script>alert('El archivo ".$_POST["wms_file"]." ha sido procesado correctamente pero no se ha podido mover de carpeta.');</script>";
		}

	}else{
		echo "<script>alert('Ha ocurrido un error al conectarse al host : ".$configuracion["url"]."');</script>";
	} 
}
?>
<script type="text/javascript">
	window.location.href="bode_inv_indexoc4.php?cmd=WMS&ori=3";
</script>