<?
session_start();
require("../inc/config.php");
require("../inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
$annomia=date('Y');


extract($_POST);
$archivo1 = $_FILES["archivo1"]["name"];
$archivo1 = $_FILES["archivo2"]["name"];
$archivo1 = $_FILES["archivo3"]["name"];

if (1==1) {

  $sql1="update dpp_encuestas  set encu_ext_nota='$nota1', encu_ext_por='$por1', encu_int_nota='$nota2', encu_int_por='$por2', encu_usu_nota='$nota3', encu_usu_por='$por3', encu_promedio='$promedio', encu_analisis='$analisis', encu_analisisext='$analisisext'  ,encu_analisisint='$analisisint'  ,encu_analisisusu='$analisisusu',encu_analisisotro='$analisisotro'   where encu_cont_id =$id and encu_id=$id41 and encu_estado=1 ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

  if ($archivo1 != "") {
     // guardamos el archivo a la carpeta files
     $archivo1="int_".$regionsession."_".$id41."_".$annomia.".PDF";
     $destino =  "filesencu/".$archivo1;
     if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
         $status = "Archivo subido: <b>".$archivo1."</b>";
         $sql2="update dpp_encuestas set encu_archivo='$archivo1' where encu_id=$id41 and encu_estado=1 ";
//            echo $sql2;
//            exit();
          mysql_query($sql2);
     }
  }

  if ($archivo2 != "") {
     // guardamos el archivo a la carpeta files
     $archivo1="ext_".$regionsession."_".$id41."_".$annomia.".PDF";
     $destino =  "filesencu/".$archivo2;
     if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
         $status = "Archivo subido: <b>".$archivo2."</b>";
         $sql2="update dpp_encuestas set encu_archivo2='$archivo2' where encu_id=$id41 and encu_estado=1 ";
//            echo $sql2;
//            exit();
          mysql_query($sql2);
     }
  }


  if ($archivo3 != "") {
     // guardamos el archivo a la carpeta files
     $archivo1="usu_".$regionsession."_".$id41."_".$annomia.".PDF";
     $destino =  "filesencu/".$archivo3;
     if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
         $status = "Archivo subido: <b>".$archivo3."</b>";
         $sql2="update dpp_encuestas set encu_archivo3='$archivo3' where encu_id=$id41 and encu_estado=1 ";
//            echo $sql2;
//            exit();
          mysql_query($sql2);
     }
  }

  
//exit();

}

echo "<script>location.href='../evaexterna.php?id2=$id';</script>";


?>


