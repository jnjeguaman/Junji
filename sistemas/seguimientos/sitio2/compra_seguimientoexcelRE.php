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
$estado=$_GET["estado"];
$year=$_GET["year"];
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
                         <td class="Estilo1b">Nº</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Centro Costo</td>
                         <td class="Estilo1b">Fecha</td>
                         <td class="Estilo1b">Monto</td>
                         <td class="Estilo1b">Estado</td>
                         <td class="Estilo1b">Tipo</td>
                         <td class="Estilo1b">Mes</td>
                         <td class="Estilo1b">Responsable</td>
                         <td class="Estilo1b">Item</td>
                         <td class="Estilo1b">Orden de Compra</td>
                        </tr>



<?
$sw=0;

   $sql="select * from compra_compra where ";
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





?>
                      

                       <tr>
                         <td><? echo $row3["compra_id"]  ?> </td>
                         <td><? echo $row3["compra_nombre"]  ?> </td>
                         <td><? echo $row3["compra_ccosto"]  ?> </td>
                         <td><? echo substr($row3["compra_fecha"],8,2)."-".substr($row3["compra_fecha"],5,2)."-".substr($row3["compra_fecha"],0,4)   ?></td>
                         <td><? echo number_format($row3["compra_total"],0,',','.')  ?> </td>
                         <td><? echo $row3["compra_estado"]  ?> </td>
                         <td><? echo $row3["compra_tipo"]  ?> </td>
                         <td><? echo $row3["compra_mes"]  ?> </td>
                         <td><? echo $row3["compra_responsable"]  ?> </td>
                         <td><? echo $row3["compra_item"]  ?> </td>
                       </tr>

<?
     $compraid=$row3["compra_id"];
     $sql4="select * from compra_orden where oc_compra_id=$compraid";
//     echo $sql;
     $res4 = mysql_query($sql4);
     while ($row4 = mysql_fetch_array($res4)) {
         $ocid=$row4["oc_id"];
         if ($ocid<>'') {
?>
                       <tr>
                         <td></td>
                         <td></td>
                         <td>ORDEN DE COMPRA ASOCIADA</td>
                         <td>N° <? echo $row4["oc_numero"]  ?> </td>
                         <td><? echo substr($row4["oc_fechacompra"],8,2)."-".substr($row4["oc_fechacompra"],5,2)."-".substr($row4["oc_fechacompra"],0,4)   ?></td>
                         <td><? echo number_format($row4["oc_monto"],0,',','.')  ?> </td>
                         <td><? echo $row4["oc_rut"]."-".$row4["oc_dig"]  ?> </td>
                         <td><? echo $row4["oc_estado"]  ?> </td>
                         <td><? echo $row4["oc_ccosto"]  ?> </td>
                       </tr>


<?

         }
         
     }



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


