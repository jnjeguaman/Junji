<?
session_start();

require("inc/config.php");
require("inc/querys.php");
date_default_timezone_set('America/Santiago');

$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
$fechamia=date('Y-m-d H:m:s');

$date1 = $_POST["fecha_recepcion"];
$date1b = DateTime::createFromFormat('d-m-Y', $date1);
$fecha_recepcion = $date1b->format('Y-m-d');

//$date2 = $_POST["fecha_derivacion"];
//$date2b = DateTime::createFromFormat('d-m-Y', $date2);
//$fecha_derivacion = $date2b->format('Y-m-d');

$tipodoc = $_POST["tipodoc"];
$num_doc = $_POST["numero_doc"];
$remitente = $_POST["remitente"];
$destinatario = $_POST["destinatario"];

if ($remitente == "otro") {
  $remitente = $_POST["remitente_b"];
}

if ($destinatario == "otro") {
  $destinatario = $_POST["destinatario_b"];
}

$materia = $_POST["materia"];
//$observacion = $_POST["observacion"];
//$tramite = $_POST["tramite"];

//$fecha=date("Y-m-d");

//   $sql2="select * from regiones where codigo=$regionsession ";

 //  echo $sql2."<br>";

//   $result2=mysql_query($sql2);

//   $row2=mysql_fetch_array($result2);

//   $mailparte=$row2["mail"];


/*extract($_POST);



foreach ($_REQUEST AS $indice => $valor){

  if(!is_numeric($valor)) {

     ${$indice}=strtoupper($valor);

  }

}

$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);





$archivo1 = $_FILES["archivo1"]["name"];

$archivo2 = $_FILES["archivo2"]["name"];

$archivo3 = $_FILES["archivo3"]["name"];

$archivo4 = $_FILES["archivo4"]["name"];





if (1==1) {



  $campo="fol_reg".$regionsession."_5";

  $sql2="select $campo as folio from argedo_folios where fol_id=1 ";

  echo $sql2."<br>";

  $result2=mysql_query($sql2);

  $row2=mysql_fetch_array($result2);

  $folio=$row2["folio"];

  

  //echo $folio;

  $folio=$folio+1;*/

//  echo $tipo,"--".$contrato."<br>";

//  echo $paises,"--".$estados."<br>";


$sql1=" INSERT INTO argedo_doc_internos (inte_region, inte_fecha_recepcion, inte_tipo_doc, inte_num_doc, inte_remitente, inte_destinatario, inte_materia, inte_usu_ing, inte_fecha_ing, inte_estado) 

        VALUES ('$regionsession', '$fecha_recepcion', '$tipodoc', '$num_doc', '$remitente','$destinatario', '$materia', '$usuario', '$fechamia', '2')";

//echo $sql1."<br>";


mysql_query($sql1);


//  exit();

/*  $prefijo="Des";

  $subfijo="despachada";





  $sql2="select max(despa_id) as maximo from argedo_despachada where despa_user='$usuario' ";

 // echo $sql2;

  $result2=mysql_query($sql2);

  $row2=mysql_fetch_array($result2);

  $maximo=$row2["maximo"];



  

  $anno=$anno;

  $anno2012=$anno;

  if ($archivo1 != "") {



      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession."_1.PDF";

      // guardamos el archivo a la carpeta files

      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo1;

      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {

          $status = "Archivo subido: <b>".$archivo1."</b>";

           $archivo1="fileargedo".$anno."/".$subfijo."/".$archivo1;

          $sql2="update argedo_despachada set despa_archivo ='$archivo1' where despa_id=$maximo ";

//          echo $sql2;

          mysql_query($sql2);

      }



   }*/









//        exit();

  



//  $sql2="update argedo_folios set $campo='$folio' where fol_id=1 ";

//  echo $sql2."<br>";


//  $result2=mysql_query($sql2);

//  exit();

//}


//exit();

echo "<script>location.href='argedo_cartolaregional.php?sw=1';</script>";





?>



