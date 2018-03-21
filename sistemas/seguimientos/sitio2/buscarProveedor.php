<?php 
session_start();
require("inc/config.php");
$tipoDato=trim($_POST['rut']);
$sql="select * from dpp_proveedores where provee_rut=$tipoDato";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (!empty($row)){
    echo trim($row["provee_paterno"])."/".trim($row["provee_materno"])."/".trim($row["provee_nombre"])."/".trim($row["provee_dir"])."/".trim($row["provee_fono"])."/".trim($row["provee_rsocial"])."/".trim($row["provee_mail"])."/".trim($row["provee_cat_juri"]."/".trim($row["provee_id"]));
}else{
  echo "Proveedor No Existe";
}
?>