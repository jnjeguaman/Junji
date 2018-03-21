<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$anno=date('Y');
$hora=date("h:i");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];



extract($_POST);
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);


$archivo1 = $_FILES["archivo1"]["name"];

if (1==1) {

  $sql1="update argedo_recibida set reci_defensoria='$regionsession', reci_tipodoc='$tipodoc1', reci_numero='$numeroext', reci_fecha_doc='$fecha2', reci_hora='$hora', reci_materia='$materia', reci_remite='$remite', reci_obs='$obs', reci_destinatario='$destinatario', reci_jornada='$jornada', reci_fechamod='$fechamia', reci_horamod='$hora',reci_int = '".$numeroint."' where reci_id=$id";

//  echo $sql1."<br>";
//  exit();
  mysql_query($sql1);
  

  $prefijo="recibida";
  $subfijo="recibida";



  
  $anno=date("Y");
  $anno2012="2012";
  if ($archivo1 != "") {

      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession.".PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo1;
      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo1."</b>";
           $archivo1="fileargedo".$anno."/".$subfijo."/".$archivo1;
         $sql2="update argedo_recibida set reci_archivo ='$archivo1' where reci_id=$id ";
//          echo $sql2;
          mysql_query($sql2);
      }

   }


//        exit();
  



}
//exit();
echo "<script>location.href='argedo_editrecibida.php?sw=1&id=$id';</script>";


?>


