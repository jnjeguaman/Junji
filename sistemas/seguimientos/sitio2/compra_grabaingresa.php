<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];



extract($_POST);

if (1==1) {

$mesprograma=trim($mesprograma);
// echo $mesprograma;

if ($mesprograma=='ENERO') {
   $mesprograma2=1;
}
if ($mesprograma=='FEBRERO') {
   $mesprograma2=2;
}
if ($mesprograma=="MARZO") {
   $mesprograma2=3;
}
if ($mesprograma=='ABRIL') {
   $mesprograma2=4;
}
if ($mesprograma=='MAYO') {
   $mesprograma2=5;
}
if ($mesprograma=='JUNIO') {
   $mesprograma2=6;
}
if ($mesprograma=='JULIO') {
   $mesprograma2=7;
}
if ($mesprograma=='AGOSTO') {
   $mesprograma2=8;
}
if ($mesprograma=='SEPTTIEMBRE') {
   $mesprograma2=9;
}
if ($mesprograma=='OCTUBRE') {
   $mesprograma2=10;
}
if ($mesprograma=='NOVIEMBRE') {
   $mesprograma2=11;
}
if ($mesprograma=='DICIEMBRE') {
   $mesprograma2=12;
}



$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$sql="INSERT INTO compra_compra (compra_folio, compra_nombre, compra_descip, compra_total, compra_moneda, compra_meses, compra_tipo, compra_mes, compra_mes2, compra_ccosto, compra_depto, compra_responsable, compra_item, compra_totalpre, compra_pagarmes, compra_fecha, compra_user, compra_region, compra_fechasis, compra_anno, compra_tipo2, compra_modalidad, compra_vigente, compra_programa)
                         VALUES ('1',upper('$nombre'),upper('$descripcion'),'$monto','$moneda','$nromeses','$documento2','$mesprograma','$mesprograma2','$ccosto','$unidad','$responsable','$item','$totalpresu','$nromesespaga','$fecha1','$usuario','$region','$fechamia', '$annocurso', '$tipo2b', '$documento2','$monto',  '$progasociado')";
//echo $sql;
//exit();
mysql_query($sql);


$sql="select max(compra_id) as id from compra_compra where compra_region='$regionsession' and compra_user='$usuario' ";
//echo $sql;
$res3 = mysql_query($sql);
$row3 = mysql_fetch_array($res3);
$compraid=$row3["id"];



     $compraanno=$annocurso;
     if ($nromeses<=12) {
         $limite=2;
     }
     if ($nromeses>12 and $nromeses<=24) {
         $limite=3;
     }
     if ($nromeses>24 and $nromeses<=36) {
         $limite=4;
     }
     if ($nromeses>36 and $nromeses<=48) {
         $limite=5;
     }
     if ($nromeses>48 and $nromeses<=60) {
         $limite=6;
     }
     if ($nromeses>60 and $nromeses<=72) {
         $limite=7;
     }


     $cont=1;
     while ($cont<=$limite) {
        $sql1="insert into compra_vigentedet (cvig_compra_id, cvig_vigente, cvig_total, cvig_meses, cvig_anno) values ('$compraid','0', '0', '$comprapagarmes','$compraanno')  ";
//      echo $sql1;
//      exit();
        mysql_query($sql1);
        $cont++;
        $compraanno=$compraanno+1;
     }




}

if ($ori==1) {
echo "<script>location.href='compra_orden2.php?llave=1';</script>";
} else {
echo "<script>location.href='compra_ingresa.php?llave=1';</script>";
}


?>


