<?

header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reportes.xls");

require("inc/config.php");

?>
<html>
<head>
<title>Defensoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<body>


<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$nombre=$_GET["nombre"];
$ccosto=$_GET["ccosto"];
$uniresp=$_GET["uniresp"];
$programado=$_GET["programado"];
$origen=$_GET["origen"];
if(isset($_GET["region"])) {
   $region=$_GET["region"];
} else {
   $region=$regionsession;
}
$estado=$_GET["estado"];
//$year=$_GET["year"];
$year=2015;
$var=$_GET["var"];
$id=$_GET["id"];
if ($var==1) {
   $sql2 = "delete from compra_compra where compra_id=$id";
   //echo $sql;
   mysql_query($sql2);


}

if (!isset($year)) {
    $year=$annomio;
}

?>




                      <table border=1>

                        <tr>
                         <td class="Estilo1b">N�</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Descripcion</td>
                         <td class="Estilo1b">Total</td>
                         <td class="Estilo1b">Moneda</td>
                         <td class="Estilo1b">N� Meses</td>
                         <td class="Estilo1b">Tipo</td>
                         <td class="Estilo1b">Mes Programado</td>
                         <td class="Estilo1b">C.Costo</td>
                         <td class="Estilo1b">Depto</td>
                         <td class="Estilo1b">Responsable</td>
                         <td class="Estilo1b">Item</td>
                         <td class="Estilo1b">Comprometido</td>
                         <td class="Estilo1b">Programa</td>
                         <td class="Estilo1b">Totalpre</td>
                         <td class="Estilo1b">Total meses</td>
                         <td class="Estilo1b">Fecha</td>
                         <td class="Estilo1b">Mes Cumple</td>
                         <td class="Estilo1b">Estado</td>
                         <td class="Estilo1b">Origen</td>
                         <td class="Estilo1b">Ejecutado</td>
                        </tr>



<?
$sw=0;

   $sql="select * from compra_compra where  ";
if ($region<>"" ) {
    if ($region==0)
        $sql.=" compra_region<>'' and ";
    else
        $sql.=" compra_region=$region and ";
    $sw=1;
}
if ($fecha1<>"" and $fecha2<>"" ) {
    $sql.=" ( compra_fecha>='$fecha1' and compra_fecha<='$fecha2' ) and ";
    $sw=1;
}
if ($nombre<>"") {
    $sql.=" compra_nombre like '%$nombre%' and ";
    $sw=1;
}
if ($ccosto<>"") {
    $sql.=" compra_ccosto='$ccosto' and ";
    $sw=1;
}
if ($uniresp<>"") {
    $sql.=" compra_depto='$uniresp' and ";
    $sw=1;
}
if ($programado<>"") {
    $sql.=" compra_mes='$programado' and ";
    $sw=1;
}
if ($year<>"" ) {
    $sql.=" compra_anno='$year' and ";
    $sw=1;
}
if ($origen<>"") {
    $sql.=" compra_origen='$origen' and ";
    $sw=1;
}
if ($estado<>"" and $estado<>'TODOS') {
    $sql.=" compra_estado='$estado' and ";
    $sw=1;
}
if ($estado<>"" and  $estado=='TODOS' ) {
    $sql.=" compra_estado<>'' and ";
    $sw=1;
}




if ($year<>"" and 1==2) {
    $sql.=" year(compra_fecha)='$year' and ";

}



if ($sw==1){
    $sql.="  1=1 order by compra_nombre  ";
}
if ($sw==0){
    $sql.=" 1=2";
}



//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
while($row3 = mysql_fetch_array($res3)){


$compratipo=$row3["compra_tipo2"];

if (is_numeric($compratipo) ) {
  $sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$compratipo";
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $compratipo2=$registro["cat_nombre"];
} else  {
  $compratipo2=$row3["compra_tipo2"];
}

if ($compratipo=='0') {
  $compratipo2=$row3["compra_tipo"];
}

$compraorigen=$row3["compra_origen"];
if ($compraorigen==1) {
    $texto="Programado";
} else {
    $texto="No Programado";

}


$compraid=$row3["compra_id"];
$sql4="select sum(oc_monto) as totaloc from compra_orden x, compra_detorden y where  y.detorden_plan='$compraid' and y.detorden_oc_id=x.oc_id and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA'";
//  $sql="select * from compra_orden where oc_compra_id='$id'  order by oc_id desc ";

//echo $sql;
$res4 = mysql_query($sql4);
$row4 = mysql_fetch_array($res4);
$totaloc=$row4["totaloc"];


?>


                       <tr>
                         <td><? echo $cont;  ?> </td>
                         <td><? echo $row3["compra_nombre"]  ?> </td>
                         <td><? echo $row3["compra_descip"]  ?> </td>
                         <td><? echo number_format($row3["compra_total"],0,',','.')  ?> </td>
                         <td><? echo $row3["compra_moneda"]  ?> </td>
                         <td><? echo $row3["compra_meses"]  ?> </td>
                         <td><? echo $compratipo2;  ?> </td>
                         <td><? echo $row3["compra_mes"]  ?> </td>
                         <td><? echo $row3["compra_ccosto"]  ?> </td>
                         <td><? echo $row3["compra_depto"]  ?> </td>
                         <td><? echo $row3["compra_responsable"]  ?> </td>
                         <td><? echo $row3["compra_item"]  ?> </td>
                         <td><? echo number_format($row3["compra_vigente"],0,',','.')  ?> </td>
                         <td><? echo $row3["compra_programa"]  ?> </td>
                         <td><? echo number_format($row3["compra_totalpre"],0,',','.')  ?> </td>
                         <td><? echo $row3["compra_pagarmes"]  ?> </td>
                         <td><? echo substr($row3["compra_fecha"],8,2)."-".substr($row3["compra_fecha"],5,2)."-".substr($row3["compra_fecha"],0,4)   ?></td>
                         <td><? echo $row3["compra_mescumple"];  ?> </td>
                         <td><? echo $row3["compra_estado"]  ?> </td>
                          <td><? echo $texto ?></td>
                          <td><? echo number_format($totaloc,0,',','.') ?></td>
                       </tr>

<?

$cont++;

}
?>

                       <tr>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         
                        </tr>




 
</table>

</body>
</html>




