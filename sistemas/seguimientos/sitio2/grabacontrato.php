<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];




$rut=$_POST["rut"];
$dig=$_POST["dig"];
$nombre=$_POST["nombre"];
$region=$_POST["region"];
$tipo=$_POST["tipo"];
$unidad=$_POST["unidad"];
$contrato=$_POST["contrato"];
$fecha2=$_POST["fecha2"];
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3=$_POST["fecha3"];
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);
$total=$_POST["total"];
$moneda2=$_POST["moneda2"];
$moneda3=$_POST["moneda3"];
$moneda4=$_POST["moneda4"];
$garantia=$_POST["garantia"];
$anticipado=$_POST["anticipado"];
$multas=$_POST["multas"];
$licitacion=$_POST["licitacion"];


$vcuota=$_POST["vcuota"];

$descripcion=$_POST["descripcion"];
$duracion=$_POST["duracion"];
$nrocuotas=$_POST["nrocuotas"];
$rea=$_POST["rea"];
$obs=$_POST["obs"];

$id=$_POST["id"];
$id2=$_POST["id2"];

$estados=$_POST["estados"];


if ($rut<>"" and $nombre<>"") {

  $sql3 = "INSERT INTO  dpp_contratos (cont_rut, cont_recepcion, cont_dig, cont_nombre, cont_nombre1, cont_region, cont_tipo,  cont_unidad, cont_contrato, cont_fechainicio, cont_vence, cont_total, cont_tipo2, cont_vcuota, cont_tipo3,  cont_anticipado,  cont_usogarantia, cont_multas, cont_usu, cont_descripcion, cont_duracion, cont_nrocuotas, cont_rea, cont_reamoneda, cont_obs, cont_licitacion)
                               VALUES ('$rut',   '$fechamia','$dig ','$nombre',   '$descripcion',  '$region',   '$tipo',     '$unidad',   '$contrato',  '$fecha2',        '$fecha3',  '$total', '$moneda4',   '$vcuota',    '$moneda3',  '$anticipado',  '$garantia'  ,  '$multas',  '$usuario', '$descripcion', '$duracion', '$nrocuotas', '$rea', '$moneda4','$obs', '$licitacion')";
                               

//  echo $sql3;
//  exit();
  mysql_query($sql3);

  $sql2="select max(cont_id) as maximo from dpp_contratos where cont_usu='$usuario' ";
  //echo $sql2;
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
/*
 $sql4="insert into dpp_evaexterna (evaext_cont_id) values ('$maximo')";
  mysql_query($sql4);
  
 $sql5="insert into dpp_evainterna (evaint_cont_id) values ('$maximo')";
  mysql_query($sql5);
*/

  $sql6="insert into dpp_evausuario (evausu_cont_id) values ('$maximo')";
  mysql_query($sql6);

   if ($id<>'' and $id2<>'') {
     $sql6="update compra_contrato set ccont_estado=2 where ccont_id=$id  ";
     // echo $sql6;
     mysql_query($sql6);
 
 
     $sql2="update compra_orden set oc_cont_id='$maximo' where oc_id=$id2 ";
     //      echo $sql2."<br>";
     //      exit();
     mysql_query($sql2);

   }
}
//exit();
echo "<script>location.href='contratosadjuntos.php?id=$maximo';</script>";


?>


