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



if ($descripcion<>"") {


   $archivo1 = $_FILES["archivo1"]['name'];

  if ($archivo1 != "") {

     $archivo1="docotro_".$annomio."_".$regionsession."_".$id.".PDF";
//     echo $archivo1;
//   $archivo1="doc".$annomia."/ocompra/OC".$regionsession."_".$numerooc."_".$annomia.".PDF";
     // guardamos el archivo a la carpeta files
     $destino =  "../../archivos/doccontratos/$annomio/".$archivo1;

     $destino2 =  "../../archivos/doccontratos/$annomio/";
     if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo1."</b>";
        $sql2="INSERT INTO  contra_otrosarchivos (contotro_cont_id, contotro_descripcion, contotro_ruta, contotro_archivo, contotro_user, contotro_fechasys)
                                          VALUES ('$id',   '$descripcion', '$destino2', '$archivo1', '$usuario', '$fechamia')";
//        echo $sql2;
        mysql_query($sql2);
     }
//    exit();

  }
    

}


//exit();
echo "<script>location.href='contrato_otrosarchivos.php?llave=1&rut=$rut&id=$id&ori=$ori';</script>";


?>


