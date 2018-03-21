<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
?>
<html>
<head>
<title>Comprobante egreso</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: left;
}
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right;
}
</style>
<script>


function cerrarventana(){
   window.close();
	window.opener.document.location.reload();
}
</script>
<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
</head>
<body>
<br>
<?
$annio = date("Y");
$eta_id = $_POST['id'];
$numero = $_POST['numEgreso'];


$fecha1 = $_POST['fechaDevengo'];

if ($fecha1 != "") {
	$date1 = DateTime::createFromFormat('d-m-Y', $fecha1);
	$fdevengo = $date1->format('Y-m-d');

	$sql1="update dpp_etapas set eta_fdevengo='$fdevengo' where eta_id=$eta_id ";
}


$sql2="update dpp_etapas set eta_num_egreso='$numero' where eta_id=$eta_id ";



$fecha2 = $_POST['fechaEgreso'];
if ($fecha2 != "") {
	$date2 = DateTime::createFromFormat('d-m-Y', $fecha2);
	$fegreso = $date2->format('Y-m-d');
	$sql3="update dpp_etapas set eta_fecha_egreso='$fegreso' where eta_id=$eta_id ";
}

$archivo = $_FILES["eta_doc_egreso"]["name"];
if($archivo <> "")
{
	$archivo1="EGRESO_".$numero."_".$regionsession."_".$eta_id.".PDF";
	$destino =  "../../archivos/docfac/".$annio."/".$regionsession."/".$archivo1;
	$ruta = $annio."/".$regionsession."/".$archivo1;
	if(copy($_FILES["eta_doc_egreso"]["tmp_name"], $destino))
	{
		mysql_query("UPDATE dpp_etapas SET eta_doc_egreso = '".$ruta."' WHERE eta_id = ".$eta_id);
	}

}
//echo $fecha;
//echo $numero;
//echo $sql;
mysql_query($sql1);
mysql_query($sql2);
mysql_query($sql3);

$sql22 = "SELECT * FROM dpp_etapas WHERE eta_id = '$eta_id' ";
$res2 = mysql_query($sql22);
while($row2 = mysql_fetch_array($res2)){
	$devengo=$row2["eta_fdevengo"];
    $negreso=$row2["eta_num_egreso"];
    $fegreso=$row2["eta_fecha_egreso"];
    $doc3=$row2["eta_tipo_doc3"];
		
		
}
$fechamia = date("Y-m-d");
if ($devengo != "" && $devengo != null && $negreso > "0" && $fegreso != "0000-00-00" && $doc3 != "" && $doc3 != null) {
                    
    $sql3="update dpp_etapas set eta_usu_recepcion22='$usuario', eta_fecha_recepcion3='$fechamia' where eta_id=$eta_id ";
    mysql_query($sql3);
}
?>
<p class="Estilo1">Datos actualizados con exito!</p><br>
<button type="button" onclick="cerrarventana()">Cerrar</button>
</body>
</html>

