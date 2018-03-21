<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();
//$usuario=$_SESSION["nom_user"];
require("inc/config.php");
$regionsession = $_SESSION["region"];

$numero=$_GET["numero"];
$mesp=$_GET["mesp"];
$annop=$_GET["annop"];
$fechamia = date("Y-m-d");
$horamia = date("H:i:s");

/*
$archivo = "ANEXO_2_".$numero."_".$mesp."_".$annop.".pdf";
$dompdf->stream($archivo);
file_put_contents("../../archivos/docconciliacion/respaldo/".$annop."/".$mesp."/".$archivo, $dompdf->output());
*/
$archivo = "RESPALDO_".$numero."_".$mesp."_".$annop."_".$regionsession."_".$fechamia.".sql";
mkdir("../../archivos/docconciliacion/respaldo/".$annop."/".$mesp,0777,true);
$fp = fopen("../../archivos/docconciliacion/respaldo/".$annop."/".$mesp."/".$archivo,"w+");

$sql = "SELECT * FROM concilia_sigfe WHERE sigfe_estado='2' and sigfe_numero='$numero' and sigfe_mesp = ".$mesp." and sigfe_annop = ".$annop;

$encabezado = "#######################################################\n";
$encabezado .="#													\n";
$encabezado .="#	      N° CUENTA : $numero 	            \n";
$encabezado .="#          PERIODO : $mesp / $annop            \n";
$encabezado .="#	      FECHA / HORA CREACION : $fechamia $horamia\n";
$encabezado .="#													\n";
$encabezado .="#######################################################\n";
$res = mysql_query($sql);
fwrite($fp, "-- ".$sql);
fwrite($fp, "\n");
fwrite($fp, $encabezado);
while($row = mysql_fetch_array($res))
{
	$linea = "INSERT INTO  concilia_sigfe (sigfe_id ,sigfe_anno ,sigfe_area ,sigfe_cbancaria ,sigfe_ccontable ,sigfe_tipo ,sigfe_fecha ,sigfe_sigfe ,sigfe_estado2 ,sigfe_tesoreria ,sigfe_numdoc ,sigfe_rut ,sigfe_bene ,sigfe_cargo ,sigfe_abono ,sigfe_numero ,sigfe_mesp ,sigfe_annop ,sigfe_region ,sigfe_fechasis ,sigfe_user ,sigfe_estado) VALUES (NULL ,'".$row["sigfe_anno"]."','".$row["sigfe_area"]."','".$row["sigfe_cbancaria"]."','".$row["sigfe_ccontable"]."','".$row["sigfe_tipo"]."','".$row["sigfe_fecha"]."','".$row["sigfe_sigfe"]."','".$row["sigfe_estado2"]."','".$row["sigfe_tesoreria"]."','".$row["sigfe_numdoc"]."','".$row["sigfe_rut"]."','".$row["sigfe_bene"]."','".$row["sigfe_cargo"]."','".$row["sigfe_abono"]."','".$row["sigfe_numero"]."','".$row["sigfe_mesp"]."','".$row["sigfe_annop"]."','".$row["sigfe_region"]."','".$row["sigfe_fechasis"]."','".$row["sigfe_user"]."','".$row["sigfe_estado"]."');\n";
	fwrite($fp, $linea);
}
fclose($fp);

?>
<script type="text/javascript">window.close()</script>