<?
session_start();
$usuario=$_SESSION["nom_user"];
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];

echo $usuario."=usuario<BR>";
echo $nivel."=nivel<BR>";
echo $regionsession."=region<BR>";

?>



