<?
session_start();

header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reportesoc.xls");

require("inc/config.php");

$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];

$date_in=date("d-m-Y");
$date_in2=date("Y-m-d");


$region=$_GET["region"];
$nombre=$_GET["nombre"];
$rut=$_GET["rut"];
$numerooc2=$_GET["numerooc2"];
$numerooc3=$_GET["numerooc3"];
$tipo1=$_GET["tipo1"];
$tipo2=$_GET["tipo2"];
$tipo3=$_GET["tipo3"];
$tipo4=$_GET["tipo4"];
$tipo5=$_GET["tipo5"];
$anno2=$_GET["anno2"];



?>


<table border=0>

                        <tr>
                         <td class="Estilo1c">Nº </td>
                         <td class="Estilo1c">Rut</td>
                         <td class="Estilo1c">Proveedor</td>
                         <td class="Estilo1c">Número OC</td>
                         <td class="Estilo1c">Modalidad</td>
                         <td class="Estilo1c">Tipo</td>
                         <td class="Estilo1c">Region</td>
                         <td class="Estilo1c">Nombre OC</td>
                         <td class="Estilo1c">Centro Costo</td>
                         <td class="Estilo1c">Fecha</td>
                         <td class="Estilo1c">Descripción</td>
                         <td class="Estilo1c">Estado</td>
                         <td class="Estilo1c">Monto</td>
                         <td class="Estilo1c">Moneda</td>
                         <td class="Estilo1c">Comprometido</td>
                         <td class="Estilo1c">Item</td>
                         <td class="Estilo1c">Programa</td>
                        </tr>
                        
<?
 $sw=0;
  $sql="select * from compra_orden where oc_region=$regionsession order by oc_orden asc LIMIT 0 , 1000 ";


     $sql="select * from compra_orden where ";
if ($region<>"") {
    if ($region==0)
        $sql.=" oc_region<>'' and ";
    else
        $sql.=" oc_region=$region and ";
    $sw=1;
}


if ($rut<>"") {
    $sql.=" oc_rut like '%$rut%' and ";
    $sw=1;
}
if ($nombre<>"") {
    $sql.=" oc_rsocial like '%$nombre%' and ";
    $sw=1;
}
if ($numerooc2<>"") {
    $sql.=" oc_orden='$numerooc2' and ";
    $sw=1;
}
if ($numerooc3<>"") {
    $sql.=" oc_numero like '%$numerooc3' and ";
    $sw=1;
}
if ($tipo1<>"" ) {
    $sql.=" oc_tipo<>'' and ";
    $sw=1;
}
if ($tipo2<>"" ) {
    $sql.=" ( oc_tipo='' and  oc_modalidad<>'Reembolso') and  ";
    $sw=1;
}
if ($tipo3<>"" ) {
    $sql.=" (oc_modalidad='Reembolso') and  ";
    $sw=1;
}
if ($anno2<>"" ) {
    $sql.=" year(oc_fechacompra)='$anno2' and ";
    $sw=1;
}

/*
if ($estado<>"" and $estado=='CONTRATO' and $estado<>'TODOS' ) {
    $sql.=" oc_estado<>'' and ";
}
if ($estado=='TODOS' ) {
    $sql.=" oc_estado<>'' and  ";
    $sw=1;

}
*/


if ($sw==1){
    $sql.=" 1=1 order by oc_id desc";
}
if ($sw==0){
    $sql.=" 1=2";
}

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
     $estado2=$row3["oc_estado"];

$archivo="compra_fichaorden.php";
if ($estado2=='EN PROCESO') {
   $archivo="compra_fichaorden.php";
}
if ($estado2=='ACEPTADO') {
   $archivo="compra_fichaorden3.php";
}
if ($estado2=='CERRADO') {
   $archivo="compra_fichaorden2.php";
}

  $octipo=$row3["oc_tipo"];
  $ocmodalidad=$row3["oc_modalidad"];
  

  $sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$octipo";
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $octipo2=$registro["cat_nombre"];

if (is_numeric($ocmodalidad)) {

  $sql33="Select subcat_nombre, subcat_id from compra_subcat where subcat_id =$ocmodalidad";
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $ocmodalidad2=$registro["subcat_nombre"];
} else {
  $ocmodalidad2=$ocmodalidad;
}


?>


    <tr>
     <td class="Estilo3c"><? echo $cont; ?> </td>
     <td class="Estilo2"><? echo $row3["oc_rut"]."-".$row3["oc_dig"]  ?></td>
     <td class="Estilo2"><? echo $row3["oc_rsocial"]  ?></td>
     <td class="Estilo3c"><? echo $row3["oc_numero"]  ?></td>
     <td class="Estilo3c"><? echo $octipo2  ?></td>
     <td class="Estilo3c"><? echo $ocmodalidad2  ?></td>
     <td class="Estilo3c"><? echo $row3["oc_region"]  ?></td>
     <td class="Estilo3c"><? echo $row3["oc_nombre"]  ?></td>
     <td class="Estilo3c"><? echo $row3["oc_ccosto"]  ?></td>
     <td class="Estilo3c" ><? echo substr($row3["oc_fechacompra"],8,2)."-".substr($row3["oc_fechacompra"],5,2)."-".substr($row3["oc_fechacompra"],0,4)   ?></td>
     <td class="Estilo2"><? echo $row3["oc_nombre"]  ?></td>
     <td class="Estilo2b"><? echo $row3["oc_estado"]  ?></td>
     <td class="Estilo2b"><? echo $row3["oc_monto"]  ?></td>
     <td class="Estilo2b">pesos</td>
     <td class="Estilo2b"><? echo $row3["oc_compromiso"]  ?></td>
     <td class="Estilo2b"><? echo $row3["oc_item"]  ?></td>
     <td class="Estilo2b"><? echo $row3["oc_prog"]  ?></td>
    </tr>





<?

   $cont++;

}
?>



</table>



