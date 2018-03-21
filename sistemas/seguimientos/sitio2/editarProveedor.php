<?php 
require("inc/config.php");
$id = $_POST["id"];
$dir = $_POST["dir"];
$tel = $_POST["tel"];
$correo = $_POST["correo"];
$rs = $_POST["rs"];
$nombre = $_POST["nom"];
$paterno = $_POST["paterno"];
$materno = $_POST["materno"];
$sql="update dpp_proveedores set provee_dir = '".$dir."' , provee_fono='".$tel."', provee_mail='".$correo."',provee_nombre='".$nombre."', provee_rsocial='".$rs."', provee_paterno='".$paterno."',provee_materno='".$materno."' where provee_id = ".$id;
$result=mysql_query($sql);
echo "<script>location.href='proveedores.php';
alert('PROVEEDOR EDITADO EXITOSAMENTE');
</script>";
 ?>