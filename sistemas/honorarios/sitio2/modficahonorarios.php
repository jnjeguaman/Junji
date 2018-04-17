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

$codigo=$_POST["codigo"];
$id=$_POST["id"];

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

if ($nboleta1<>"" and $retencion1<>""){


  $sql1="update dpp_honorarios set hono_fecha1='$fecha1',hono_codigo='$codigo',hono_region='$region',hono_rut='$rut',hono_dig='$dig',hono_nombre='$nombre',hono_nro_boleta='$nboleta1',hono_bruto='$bruto1',hono_retencion='$retencion1',hono_liquido='$liquido1',hono_item='$item',hono_usuario='$usuario',hono_fecha='$fecha', hono_cuenta='$cuenta', hono_banconombre='$nombrebanco', hono_programa='$programa', hono_detalle='$detalle' where hono_id='$id'";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
                           
}


echo "<script>location.href='honorario2.php?llave=1&id=$id';</script>";


?>


