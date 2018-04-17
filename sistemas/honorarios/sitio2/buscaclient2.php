<?php
require("inc/config.php");
$tipoDato=$_POST['d'];
$rut=$_POST['e'];
$sql="select * from dpp_honorarios where hono_rut='$rut' and hono_nro_boleta='$tipoDato'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$row["provee_nombre"];
if ($row["hono_nombre"]<>"")
  echo "0";
else
  echo "1";

?>
