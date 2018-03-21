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
foreach ($_REQUEST AS $indice => $valor){
  if(!is_numeric($valor)) {
     ${$indice}=strtoupper($valor);
  }
}

$anno=$docsanno;
$anno2012=$docsanno;

$fecha2b=$fecha2;
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);


$archivo1 = $_FILES["archivo1"]["name"];
$archivo2 = $_FILES["archivo2"]["name"];
$archivo3 = $_FILES["archivo3"]["name"];
$archivo4 = $_FILES["archivo4"]["name"];



if ($tipodoc=='RESOLUCION AFECTA') {
    $ti=2;
}
if ($tipodoc=='RESOLUCION EXENTA') {
    $ti=1;
}
if ($tipodoc=='OFICIO DN' or $tipodoc=='OFICIO DAN' or $tipodoc=='OFICIO DEPTO' or $tipodoc=='OFICIO DAR' or $tipodoc=='OFICIO DR' ) {
    $ti=3;
}


if (1==1) {


if ($paises=='' or $paises==0 ) {
   $paises=$area;
}

if ($estados=='' ) {
   $estados=$subarea;
//   echo "entra";
}

//echo $fechasis."--".$fecha2."<br>";
//exit();

  $sql1="update argedo_documentos set docs_defensoria='$regionsession', docs_fechamodi='$fechamia', docs_horamodi='$hora', docs_area='$paises', docs_subarea='$estados', docs_tramite=upper('$tramite'), docs_fecha='$fecha2', docs_materia=upper('$materia'), docs_obs=upper('$obs'), docs_anno='$anno', docs_user='$usuario', docs_tipodoc=upper('$tipodoc'), docs_tipo='$ti', docs_destinatario=upper('$destinatario'), docs_diferencia='0' where docs_id=$id ";

//  echo $sql1;
//  exit();
  mysql_query($sql1);
  
  if ($ti==1) {
   $prefijo="RE";
   $subfijo="resexc";
  }
  if ($ti==2) {
   $prefijo="RA";
   $subfijo="resafec";
  }
  if ($ti==3) {
   $prefijo="O";
   $subfijo="oficio";
  }


  
  $anno=$docsanno;
  $anno2012=$docsanno;
  


  if ($archivo1 != "") {

      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession."_".$id."_1.PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo1;
      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo1."</b>";
           $archivo1="fileargedo".$anno."/".$subfijo."/".$archivo1;
          $sql2="update argedo_documentos set docs_archivo ='$archivo1', docs_servidor='1' where docs_id=$id ";
//          echo $sql2;
          mysql_query($sql2);
      }

   }
   






}
//exit();
echo "<script>location.href='argedo_editant.php?sw=1&ti=$ti&id=$id&ori=$ori&volver=$volver';</script>";


?>


