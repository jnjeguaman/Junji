<?
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nombrecom"];
extract($_GET);
extract($_POST);


$j=0;
//echo "$j $totallinea";
while ($j<=$cont) {
	$var1=$var[$j];
	$var22=$var2[$j];
  // $var22=$var2[$cont2];
	if ($var22 <> 0 ) {
		$sql = "update bode_detoc_inv set doci_toma=$var22, doci_diferencia=$var22-doci_stock where doci_id=$var1 ";

//                               VALUES ( '$ultimo', '0',               '$var1',    '$var33',       '$var22',         '0',        '$var44');";

//        echo $sql."<br>";

		mysql_query($sql,$dbh);

		$fechamia2=date('Y-m-d');
		$horaSys = Date("H:i:s");
		$log = "INSERT INTO log VALUES(NULL,".$var1.",".$var22.",'ACTUALIZACION TOMA INVENTARIO (".$inv_id.")','".$_SESSION["nom_user"]."','".$fechamia2."','".$horaSys."','BODEGA','TOMA INVENTARIO')";
		mysql_query($log);


	}
	$j++;
}

echo "<script>location.href='bode_realizatoma.php?inv_id=$inv_id';</script>";
