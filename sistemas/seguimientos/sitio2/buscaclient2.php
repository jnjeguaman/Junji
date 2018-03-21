<?php
require("inc/config.php");
$tipoDato=$_POST['d'];
$rut=$_POST['e'];
$sql="select * from dpp_etapas where eta_rut='$rut' and eta_numero ='$tipoDato'  ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

if ($row["eta_cli_nombre"]<>"")
  echo "";
else
  echo "1";

?>
