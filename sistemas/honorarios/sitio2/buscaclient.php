<?php
require("inc/config.php");
$tipoDato=$_POST['d'];
$sql="select * from dpp_proveedores where provee_rut=$tipoDato ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row["provee_nombre"]<>"")
  echo $row["provee_nombre"]." ".$row["provee_paterno"]." ".$row["provee_materno"];
else
  echo "Proveedor No Existe";

?>
