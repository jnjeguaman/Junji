<?php 
session_start();
$respuesta = array();
$estado = "";
$mensaje = "";

if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];
} else {
    $accion = "";
}

if($accion=="ListarRegiones"){
    require_once "../class/Region.class.php";
    $region = new Region();
    $campos = $region->Listar();
    if($region->myException->getMensaje()==0){
        $estado="ok";
    }else{
        header($_SERVER['SERVER_PROTOCOL'] . ' 400');
        $estado="error";
        $mensaje=$region->myException->getMensaje();    
    }
    $respuesta=array("estado"=>$estado, "mensaje"=>$mensaje, "campos"=>$campos);
}

if($accion=="Buscar"){
    
}

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header("Content-type: application/json");
$respuesta=json_encode($respuesta);
echo $respuesta;

?>