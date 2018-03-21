<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date("Y-m-d");
$anno=date('Y');
$hora=date("h:i");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];



extract($_POST);
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);


$archivo1 = $_FILES["archivo1"]["name"];

if (1==1) {


//  echo $tipo." ".$paises."<br>";
  if ($contrato=='' or $paises=='') {
      $paises=$area2;
      $estados=$subarea2;
  }
  
//  echo $tipo." ".$contrato."<br>";

  $sql1="update argedo_despachada set despa_defensoria='$regionsession', despa_area='$paises', despa_subarea='$estados', despa_destinatario='$destinatario', despa_numero='$numero', despa_tipodoc='$tipodoc', despa_fecha_doc='$fecha2', despa_materia='$materia', despa_remitente='$remite', despa_obs='$obs', despa_tipodes='$tipodes', despa_fechamod='$fechamia', despa_horamod='$hora',despa_origen = '$origen' where despa_id='$id'";

//  echo $sql1."<br>";
// exit();
  mysql_query($sql1);
  

  $prefijo="Des";
  $subfijo="despachada";



  
  $anno=date("Y");
  $anno2012=date("Y");
  if ($archivo1 != "") {

      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession."_1.PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo1;
      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo1."</b>";
           $archivo1="fileargedo".$anno."/".$subfijo."/".$archivo1;
          $sql2="update argedo_despachada set despa_archivo ='$archivo1' where despa_id=$id ";
//          echo $sql2;
          mysql_query($sql2);
      }

   }

}

//exit();
echo "<script>location.href='argedo_editdespachada.php?sw=1&id=$id';</script>";


?>


