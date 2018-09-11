<?php
require("inc/config.php");
header("Content-Type: text/plain; charset=ISO-8859-1");
$tipoDato=trim($_POST['d']);
$sql="select * from jardines where jardin_codigo='$tipoDato' OR jardin_nombre = '$tipoDato' AND jardin_estado = 1";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row["jardin_nombre"]<>"")
  echo trim(utf8_decode($row["jardin_nombre"]))."/".trim(utf8_decode($row["jardin_comuna"]))."/".trim(utf8_decode($row["jardin_direccion"]));
else
  echo "Jardin No Existe $tipoDato";

?>