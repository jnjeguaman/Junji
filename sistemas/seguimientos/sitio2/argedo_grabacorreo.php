<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$anno=date('Y');
$hora=date("h:i");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
$regionnombre=$_SESSION["regionnom"];


extract($_POST);
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);

  $sql2="select * from regiones where codigo=$regionsession ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $mailparte=$row2["mail"];



$archivo1 = $_FILES["archivo1"]['name'];

if (1==1) {
/*
  $campo="fol_reg".$regionsession."_4";
  $sql2="select $campo as folio from argedo_folios where fol_id=1 ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $folio=$row2["folio"];
  
//  echo $folio;
  $folio=$folio+1;
  */



  $sql1="INSERT INTO argedo_correo (corre_fecha, corre_dependencia, corre_cantidad, corre_precio, corre_total, corre_responsable, corre_tipo, corre_region, corre_user, corre_fechasys)
                              VALUES ('$fecha2', '$dependencia', '$cantidad', '$precio', '$total', '$usuario', '$tipodoc', '$regionsession', '$usuario', '$fechamia');";
//  echo $sql1."<br>";
//  exit();
  mysql_query($sql1);
  

  $prefijo="correo";
  $subfijo="correo";


  $sql2="select max(corre_id) as maximo from argedo_correo where corre_user='$usuario' ";
//  echo $sql2;
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
  
  $anno=$anno;
  $anno2012=$anno;

  if ($archivo1 != "") {
      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession.".PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo1;
      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo1."</b>";
           $archivo1="fileargedo".$anno."/".$subfijo."/".$archivo1;
          $sql2="update argedo_correo set corre_archivo ='$archivo1' where corre_id=$maximo ";
//          echo $sql2;
          mysql_query($sql2);
      }

   }

//        exit();
  

//  $sql2="update argedo_folios set $campo='$folio' where fol_id=1 ";
//  echo $sql2."<br>";

// $result2=mysql_query($sql2);
//  exit();

}


//exit();
echo "<script>location.href='argedo_correo.php?sw=1';</script>";


?>


