<?
session_start();

require("inc/config.php");

require("inc/querys.php");

$fechamia=date('Y-m-d');

$anno=date('Y');

$hora=date("h:i");

$usuario=$_SESSION["nom_user"];

$regionsession = $_SESSION["region"];



  $sql2="select * from regiones where codigo=$regionsession ";

//  echo $sql2."<br>";

  $result2=mysql_query($sql2);

  $row2=mysql_fetch_array($result2);

  $mailparte=$row2["mail"];







extract($_POST);



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

//  echo $sql2."<br>";

  $result2=mysql_query($sql2);

  $row2=mysql_fetch_array($result2);

  $folio=$row2["folio"];

  

//  echo $folio;

  $folio=$folio+1;

//  echo $tipo,"--".$contrato."<br>";

//  echo $paises,"--".$estados."<br>";









  $sql1="INSERT INTO argedo_despachada (despa_defensoria, despa_area, despa_subarea, despa_destinatario, despa_numero, despa_tipodoc, despa_fecha_doc, despa_fecha_recep, despa_hora, despa_materia, despa_remitente, despa_obs, despa_tipodes, despa_anno, despa_fechasys, despa_folio, despa_user,despa_origen)

                              values ('$regionsession', '$tipo',  '$contrato',  '$destinatario',        '$numero'  ,'$tipodoc',         '$fecha2' ,         '$fecha1',     '$hora',       '$materia',    '$remite',      '$obs',    '$tipodes',     '$anno',   '$fechamia',  '$folio', '$usuario','$origen' )";

//  echo $sql1."<br>";

//  exit();

  mysql_query($sql1);

  

//  exit();

  $prefijo="Des";

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



   }









//        exit();

  



  $sql2="update argedo_folios set $campo='$folio' where fol_id=1 ";

//  echo $sql2."<br>";



  $result2=mysql_query($sql2);

//  exit();

  



}



//exit();

echo "<script>location.href='argedo_despachada.php?sw=1';</script>";





?>





