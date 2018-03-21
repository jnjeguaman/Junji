<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];


$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

$folio=$_POST["folio"];
$region=$_POST["region"];
$rut=$_POST["rut"];
$dig=$_POST["dig"];
$nombre=$_POST["nombre"];
$monto=$_POST["monto"];
$depto=$_POST["depto"];
$numero=$_POST["numero"];
$tipodoc=$_POST["tipodoc"];



//echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);




if ($rut<>"" and $nombre<>"") {

  $sql1="insert into dpp_etapas (eta_tipo_doc,eta_tipo_doc2,eta_fecha_ing,eta_fecha_recepcion, eta_fecha_fac,eta_usu_recepcion, eta_folio, eta_region ,eta_rut,eta_dig,eta_cli_nombre,eta_numero, eta_monto)
                           values   ('Factura','$tipodoc','$fechamia',  '$fecha1',   '$fecha2',            '$usuario',    '$folio', '$region',       '$rut',    '$dig','$nombre', '$numero' , '$monto')  ";
  //echo $sql1;
  mysql_query($sql1);
  
  $sql2="select max(eta_id) as maximo from dpp_etapas where eta_usu_recepcion='$usuario' ";
  //echo $sql2;
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
  
  $sql21="select max(folio1_id) as foliomio from dpp_folio1 where folio1_region='$regionsession' and folio1_usuario='$usuario' ";
  //echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $foliomio=$row21["foliomio"];
  $foliomio=$foliomio+1;
  
  $sql22="insert into dpp_folio1 (folio1_region, folio1_usuario, folio1_fecha, folio1_tipo) values ('$regionsession','$usuario','$fechamia', 'fac')";
  //echo $sql22;
  mysql_query($sql22);


  $sql3 = "INSERT INTO dpp_facturas ( fac_eta_id, fac_fecha_ing,fac_fecha_recepcion, fac_fecha_fac, fac_usu_recepcion, fac_folio, fac_region, fac_rut, fac_dig, fac_numero, fac_cli_nombre, fac_monto)
                          VALUES   ( '$maximo' , '$fechamia'  , '$fecha1',          '$fecha2',     '$usuario',         '$foliomio', '$region', '$rut', '$dig',    '$numero', '$nombre', '$monto')";

  //echo $sql3;
  mysql_query($sql3);
  
  //exit();
}

echo "<script>location.href='facturas.php?llave=1';</script>";


?>


