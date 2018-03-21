<?php
require("inc/config.php");
header("Content-Type: text/plain; charset=ISO-8859-1");
$tipoDato=trim($_POST['d']);
$sql="select * from dpp_proveedores where provee_rut=$tipoDato ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row["provee_nombre"]<>"")
  echo trim($row["provee_paterno"])." ".trim($row["provee_materno"])." ".trim($row["provee_nombre"])."/".trim($row["provee_fpago"])."/".trim($row["provee_dir"])."/".trim($row["provee_fono"])."/".trim($row["provee_calidad"])."/".trim($row["provee_escalafon"])."/".trim($row["provee_grado"])."/".trim($row["provee_cargo"])."/".trim($row["provee_region"])."/".trim($row["provee_unidad"])."/".trim($row["provee_mail"]);
else
  echo "Proveedor No Existe";

?>
