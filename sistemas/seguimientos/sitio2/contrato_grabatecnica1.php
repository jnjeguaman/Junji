<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$annomio=date('Y');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);

$fecha1=$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


$archivo1 = $_FILES["archivo1"]["name"];

//echo $monto."---->".$rut."--->".$archivo1;
//exit();



if ($super<>"" and $admin<>"") {

   $sql1="update dpp_contratos set cont_supervisor='$super', cont_admin='$admin' where cont_id=$id";
//   echo $sql1;
// exit();
    mysql_query($sql1);
    
   $archivo1 = $_FILES["archivo1"]['name'];

  if ($archivo1 != "") {

     $archivo1="doceva1_".$annomio."_".$regionsession."_".$id.".PDF";
//     echo $archivo1;
//   $archivo1="doc".$annomia."/ocompra/OC".$regionsession."_".$numerooc."_".$annomia.".PDF";
     // guardamos el archivo a la carpeta files
     $destino =  "../../archivos/doccontratos/".$archivo1;

     $destino2 =  "../../archivos/doccontratos/";
     if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo1."</b>";
        $sql2="update dpp_contratos set cont_archivo='$archivo1', cont_ruta='$destino2' where cont_id=$id ";
//        echo $sql2;
        mysql_query($sql2);
     }
//    exit();

  }
    

}


//exit();
echo "<script>location.href='contrato_tecnico.php?llave=1&rut=$rut&id=$id&ori=$ori';</script>";


?>


