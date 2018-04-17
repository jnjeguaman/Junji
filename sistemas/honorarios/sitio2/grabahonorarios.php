<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fecha=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$dia=$_POST["dia"];
$mes=$_POST["mes"];
$anno=$_POST["anno"];
$fecha1="$anno-$mes-$dia";

//$fecha1=$_POST["fecha1"];
$codigo=$_POST["codigo"];

$region=$_POST["region"];
$rut=$_POST["rut"];
$dig=$_POST["dig"];
$nombre=$_POST["nombre"];
$item=$_POST["item"];
$cantidad=$_POST["cantidad"];
$banco=$_POST["banco"];
$programa=$_POST["programa"];
$detalle=$_POST["detalle"];

list($cuenta, $nombrebanco)=split('[|]', $banco);

$nboleta1=$_POST["nboleta1"];
$bruto1=$_POST["bruto1"];
$retencion1=$_POST["retencion1"];
$liquido1=$_POST["liquido1"];

$nboleta2=$_POST["nboleta2"];
$bruto2=$_POST["bruto2"];
$retencion2=$_POST["retencion2"];
$liquido2=$_POST["liquido2"];

$nboleta3=$_POST["nboleta3"];
$bruto3=$_POST["bruto3"];
$retencion3=$_POST["retencion3"];
$liquido3=$_POST["liquido3"];

$nboleta4=$_POST["nboleta4"];
$bruto4=$_POST["bruto4"];
$retencion4=$_POST["retencion4"];
$liquido4=$_POST["liquido4"];

$nboleta5=$_POST["nboleta5"];
$bruto5=$_POST["bruto5"];
$retencion5=$_POST["retencion5"];
$liquido5=$_POST["liquido5"];

$nboleta6=$_POST["nboleta6"];
$bruto6=$_POST["bruto6"];
$retencion6=$_POST["retencion6"];
$liquido6=$_POST["liquido6"];


if ($nboleta1<>"" and $retencion1<>"") {
  $sql2="select * from dpp_honorarios where hono_nro_boleta='$nboleta1' and hono_rut='$rut' ";
  $result=mysql_query($sql2);
  $row=mysql_fetch_array($result);
  if ($row["hono_fecha1"]<>""){
     echo "1) Nº de Boleta $nboleta1 Repetida para este proveedor  <a href='javascript:window.history.back();'>Volver</a>";
     exit();
  }

}

if ($nboleta2<>"" and $retencion2<>"") {
  $sql2="select * from dpp_honorarios where hono_nro_boleta='$nboleta2' and hono_rut='$rut' ";
  $result=mysql_query($sql2);
  $row=mysql_fetch_array($result);
  if ($row["hono_fecha1"]<>""){
     echo "2) Nº de Boleta $nboleta2 Repetida para este proveedor  <a href='javascript:window.history.back();'>Volver</a>";
     exit();
  }
}

if ($nboleta3<>"" and $retencion3<>"") {
  $sql2="select * from dpp_honorarios where hono_nro_boleta='$nboleta3' and hono_rut='$rutt' ";
  $result=mysql_query($sql2);
  $row=mysql_fetch_array($result);
  if ($row["hono_fecha1"]<>""){
     echo "3) Nº de Boleta $nboleta3 Repetida para este proveedor  <a href='javascript:window.history.back();'>Volver</a>";
     exit();
  }

}

if ($nboleta4<>"" and $retencion4<>"") {
  $sql2="select * from dpp_honorarios where hono_nro_boleta='$nboleta4' and hono_rut='$rut' ";
  $result=mysql_query($sql2);
  $row=mysql_fetch_array($result);
  if ($row["hono_fecha4"]<>""){
     echo "4) Nº de Boleta $nboleta4 Repetida para este proveedor  <a href='javascript:window.history.back();'>Volver</a>";
     exit();
  }
}

if ($nboleta5<>"" and $retencion5<>"") {
  $sql2="select * from dpp_honorarios where hono_nro_boleta='$nboleta5' and hono_rut='$rut' ";
  $result=mysql_query($sql2);
  $row=mysql_fetch_array($result);
  if ($row["hono_fecha1"]<>""){
     echo "5) Nº de Boleta $nboleta5 Repetida para este proveedor  <a href='javascript:window.history.back();'>Volver</a>";
     exit();
  }

}

if ($nboleta6<>"" and $retencion6<>"") {
  $sql2="select * from dpp_honorarios where hono_nro_boleta='$nboleta6' and hono_rut='$rut' ";
  $result=mysql_query($sql2);
  $row=mysql_fetch_array($result);
  if ($row["hono_fecha1"]<>""){
     echo "6) Nº de Boleta $nboleta6 Repetida para este proveedor  <a href='javascript:window.history.back();'>Volver</a>";
     exit();
  }

}


if ($nboleta1<>"" and $retencion1<>"") {

  
  $sql1="insert into dpp_honorarios (hono_fecha1,hono_codigo,hono_region,hono_rut,hono_dig,hono_nombre,hono_nro_boleta,hono_bruto,hono_retencion,hono_liquido,hono_item,hono_usuario,hono_fecha, hono_cuenta, hono_banconombre, hono_programa, hono_detalle)
                           values   ('$fecha1',  '$codigo',   '$region',   '$rut',    ucase('$dig'), upper('$nombre'),  '$nboleta1',   '$bruto1',  '$retencion1','$liquido1',  '$item',  '$usuario', '$fecha', '$cuenta', '$nombrebanco', '$programa', '$detalle')  ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

}
if ($nboleta2<>"" and $retencion2<>"") {
  $sql1="insert into dpp_honorarios (hono_fecha1,hono_codigo,hono_region,hono_rut,hono_dig,hono_nombre,hono_nro_boleta,hono_bruto,hono_retencion,hono_liquido,hono_item,hono_usuario,hono_fecha, hono_cuenta, hono_banconombre, hono_programa, hono_detalle)
                           values   ('$fecha1', '$codigo',  '$region',   '$rut',    ucase('$dig'),upper('$nombre'),  '$nboleta2',   '$bruto2',  '$retencion2','$liquido2',  '$item',  '$usuario', '$fecha', '$cuenta', '$nombrebanco', '$programa', '$detalle')  ";
  //echo $sql1;
  mysql_query($sql1);

}
if ($nboleta3<>"" and $retencion3<>"") {
  $sql1="insert into dpp_honorarios (hono_fecha1,hono_codigo,hono_region,hono_rut,hono_dig,hono_nombre,hono_nro_boleta,hono_bruto,hono_retencion,hono_liquido,hono_item,hono_usuario,hono_fecha, hono_cuenta, hono_banconombre, hono_programa, hono_detalle)
                           values   ('$fecha1', '$codigo',   '$region',   '$rut',    ucase('$dig'),'$nombre',  '$nboleta3',   '$bruto3',  '$retencion3','$liquido3',  '$item',  '$usuario', '$fecha', '$cuenta', '$nombrebanco', '$programa', '$detalle')  ";
  //echo $sql1;
  mysql_query($sql1);

}
if ($nboleta4<>"" and $retencion4<>"") {
  $sql1="insert into dpp_honorarios (hono_fecha1,hono_codigo,hono_region,hono_rut,hono_dig,hono_nombre,hono_nro_boleta,hono_bruto,hono_retencion,hono_liquido,hono_item,hono_usuario,hono_fecha, hono_cuenta, hono_banconombre, hono_programa, hono_detalle)
                           values   ('$fecha1', '$codigo',    '$region',   '$rut',   ucase('$dig'),'$nombre',  '$nboleta4',   '$bruto4',  '$retencion4','$liquido4',  '$item',  '$usuario', '$fecha', '$cuenta', '$nombrebanco', '$programa', '$detalle')  ";
 //echo $sql1;
 mysql_query($sql1);

}
if ($nboleta5<>"" and $retencion5<>"") {
  $sql1="insert into dpp_honorarios (hono_fecha1,hono_codigo,hono_region,hono_rut,hono_dig,hono_nombre,hono_nro_boleta,hono_bruto,hono_retencion,hono_liquido,hono_item,hono_usuario,hono_fecha, hono_cuenta, hono_banconombre, hono_programa, hono_detalle)
                           values   ('$fecha1',  '$codigo',   '$region',   '$rut',    ucase('$dig'),'$nombre',  '$nboleta5',   '$bruto5',  '$retencion5','$liquido5',  '$item',  '$usuario', '$fecha', '$cuenta', '$nombrebanco', '$programa', '$detalle')  ";
  //echo $sql1;
  mysql_query($sql1);

}


if ($nboleta6<>"" and $retencion6<>"") {
  $sql1="insert into dpp_honorarios (hono_fecha1,hono_codigo,hono_region,hono_rut,hono_dig,hono_nombre,hono_nro_boleta,hono_bruto,hono_retencion,hono_liquido,hono_item,hono_usuario,hono_fecha, hono_cuenta, hono_banconombre, hono_programa, hono_detalle)
                           values   ('$fecha1', '$codigo',   '$region',   '$rut',    ucase('$dig'),'$nombre',  '$nboleta6',   '$bruto6',  '$retencion6','$liquido6',  '$item',  '$usuario', '$fecha', '$cuenta', '$nombrebanco', '$programa', '$detalle')  ";
  //echo $sql1;
  mysql_query($sql1);

}
echo "<script>location.href='honorario.php?llave=1';</script>";


?>


