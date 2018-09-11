<?php
extract($_GET);
session_start();
if($_SESSION["nom_user"] =="" ){ ?>
<script language="javascript">location.href='sesion_perdida.php';</script>
<?php
}

ini_set("auto_detect_line_endings", true);

$ruta = "../../../archivos/respaldos/INEDIS/WMS/".date("Y")."/".date("m");
mkdir($ruta,0777,true);

$archivo = $ruta."/INEDIS_WMS_RECEPCION_".$ing_id.".csv";
$archivo2 = "INEDIS_WMS_RECEPCION_".$ing_id.".csv";

$regionSession = $_SESSION["region"];
$nom_user = $_SESSION["nom_user"];


require_once("inc/config.php");

$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_detingreso b ON a.ing_id = b.ding_ing_id INNER JOIN bode_detoc c ON b.ding_prod_id = c.doc_id INNER JOIN bode_orcom d ON d.oc_id = a.ing_oc_id WHERE a.ing_id = ".$ing_id;
$res = mysql_query($sql,$dbh);

$fp = fopen($archivo, "w");
$fp2 = fopen($archivo2, "w");

fputcsv($fp, array("empresa","identificador_erp","producto","nombre","cantidad","orden_compra","documento_respaldo","numero_documento_respaldo","responsable","item_presupuestario","cuenta_activo","cuenta_gasto","programa","tipo_producto"));
while($row = mysql_fetch_array($res)) {
	$empresa_tmp = explode("-", $row["oc_id2"]);
	$empresa = ($empresa_tmp[0] == "599") ? "DIRNAC" : "METRO";
	if($row["ding_clasificacion"] == "")
	{
		$clasificacion = "INVENTARIABLE";
	}else if($row["ding_clasificacion"] == 0){
		$clasificacion = "EXISTENCIA";
	}
	fputcsv($fp,array($empresa,$row["ing_guianumerorc"],$row["doc_id_mercado_publico"],utf8_encode($row["doc_especificacion"]),$row["ding_unidad"],$row["oc_id2"],"RECEPCION CONFORME",$row["ing_guia"],$nom_user,$row["doc_item"],$row["doc_activo"],$row["doc_gasto"],$row["oc_prog"],$clasificacion));
	fputcsv($fp2,array($empresa,$row["ing_guianumerorc"],$row["doc_id_mercado_publico"],utf8_encode($row["doc_especificacion"]),$row["ding_unidad"],$row["oc_id2"],"RECEPCION CONFORME",$row["ing_guia"],$nom_user,$row["doc_item"],$row["doc_activo"],$row["doc_gasto"],$row["oc_prog"],$clasificacion));
} 

fclose($fp);
fclose($fp2);

// ESTABLECER CONEXION FTP
$configuracion = [
"url" =>  "ftp.degesis.cl",
"usuario" => "junji",
"pwd" => "23.junWms"
];

$ftp = ftp_connect($configuracion["url"]);
$ftp_id = ftp_login($ftp, $configuracion["usuario"], $configuracion["pwd"]);

// VERIFICAMOS QUE TENGAMOS CONEXION AL SERVIDOR FTP
	if($ftp_id)
	{
		ftp_pasv($ftp,true);
		$directorios = ftp_nlist($ftp, "inedis");
		$destino = $directorios[1]."/".$archivo2;
// CARGAMOS EL ARCHIVO EN EL SERVIDOR FTP EN EL DIRECTORIO INEDIS/NUEVOS
		if(ftp_put($ftp, $destino, $archivo, FTP_BINARY))
		{
			unlink($archivo2);
			// echo "Archivo '".$archivo."' cargado correctamente";
		}

	}

?>
<script type="text/javascript">
	window.close();
</script>
