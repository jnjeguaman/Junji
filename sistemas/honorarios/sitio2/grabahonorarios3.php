<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fecha=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$dia=$_POST["dia"];
$mes=$_POST["mes"];
$anno=$_POST["anno"];


$fecha1=$_POST["fecha1"];
$fechache=$_POST["fechache"];
//$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


//$fecha1=$_POST["fecha1"];
$codigo=$_POST["codigo"];

$id=$_POST["id"];
$region=$_POST["region"];
$rut=$_POST["rut"];
$dig=$_POST["dig"];
$nombre=$_POST["nombre"];
$item=$_POST["item"];
$cantidad=$_POST["cantidad"];

$nboleta1=$_POST["nboleta1"];
$bruto1=$_POST["bruto1"];
$retencion1=$_POST["retencion1"];
$liquido1=$_POST["liquido1"];



if ($nboleta1<>"" and $retencion1<>"") {
  $sql2="select * from dpp_honorarios where hono_nro_boleta='$nboleta1' and hono_rut='$rut' ";
  $result=mysql_query($sql2);
  $row=mysql_fetch_array($result);
  if ($row["hono_fecha1"]<>""){
     echo "1) Nº de Boleta $nboleta1 Repetida para este proveedor  <a href='javascript:window.history.back();'>Volver</a>";
     exit();
  }
}


if ($nboleta1<>"" and $retencion1<>"") {

  $sql1="insert into dpp_honorarios (hono_fechabol,hono_fecha1,hono_codigo,hono_region,hono_rut,hono_dig,hono_nombre,hono_nro_boleta,hono_bruto,hono_retencion,hono_liquido,hono_item,hono_usuario,hono_fecha)
                           values   ('$fecha1',   '$fechache',  '$codigo',   '$region',   '$rut',    ucase('$dig'), '$nombre',  '$nboleta1',   '$bruto1',  '$retencion1','$liquido1',  '$item',  '$usuario', '$fecha')  ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

  $sql2 = "delete from dpp_honorarios2 where hono2_id=$id";
//  echo $sql2;
//  exit();
  mysql_query($sql2);

}

echo "<script>location.href='editconta.php?llave=1';</script>";


?>


