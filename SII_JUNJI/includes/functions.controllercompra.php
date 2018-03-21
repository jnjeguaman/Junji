<?php 
require_once("inc/class.iecvcompra.php");
extract($_POST);

if(isset($iecv_rut)){
 echo json_encode(IECVCompra::crearIECVCompra($_POST));
}

 ?>