<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];

$rut=$_POST["rut"];
$dig=$_POST["dig"];
$tipo=$_POST["tipo"];

if ($tipo=="2")
  $nombre=$_POST["nombrej"];
if ($tipo=="1")
  $nombre=$_POST["nombren"];
  
$paterno=$_POST["paterno"];
$materno=$_POST["materno"];

//echo $nombre."----".$rut."---".$tipo;
//exit();
if ($nombre<>"" and $rut<>"") {

  $sql1="insert into dpp_proveedores (provee_rut, provee_dig, provee_cat_juri, provee_nombre, provee_paterno, provee_materno, provee_fecha, provee_user)
                           values    ('$rut','$dig','$tipo',upper('$nombre'),upper('$paterno'),upper('$materno'),'$fechamia','$usuario')  ";
// echo $sql1;
// exit();
 mysql_query($sql1);


}



echo "<script>location.href='proveedores.php?llave=1';</script>";


?>


