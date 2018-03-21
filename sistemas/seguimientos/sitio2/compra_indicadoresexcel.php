<?
//session_start();
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reportes.xls");


require("inc/config.php");

$nivel = $_SESSION["pfl_user"];
//$regionsession = $_SESSION["region"];
$date_in=date("Y-m-d");
$annomio=date("Y");

if (isset($_GET["anno2"])) {
    $anno2=$_GET["anno2"];
} else {
    $anno2=date("Y");
}

?>
                    <h3>INDICADORES PLAN DE COMPRAS</h3>

<?
$regionsession=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$nombre=$_GET["nombre"];
$ccosto=$_GET["ccosto"];
$programado=$_GET["programado"];
$uniresp=$_GET["uniresp"];
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




     <table width="488" border="0" cellspacing="0" cellpadding="0">

                     <table border=1>
                        <tr>
                         <td class="Estilo1b2" colspan="3">1.-  % Compras Ejecutadas</td>
                        </tr>

                        <tr>
                         <td class="Estilo1b" colspan="1">Total Compras  </td>
                         <td class="Estilo1b" colspan="1">Total Ejecutadas </td>
                         <td class="Estilo1b" colspan="1">% de Ejecucion </td>
                        </tr>

<?
$estilo="Estilo1b";
$sql="select compra_ccosto as uno, count(compra_total) as total,  sum(compra_total) as total2 from compra_compra where compra_region='$regionsession' and compra_origen=1 and compra_anno='$anno2' ";
//echo $sql;
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
 $total1=$row["total"];
 $total1c=$row["total2"];

$sql2="select compra_ccosto as uno, count(compra_total) as total,  sum(compra_total) as total2 from compra_compra where compra_region='$regionsession' and compra_origen=1 and compra_estado='CUMPLIDA' and compra_anno='$anno2'";
//$sql2="select x.compra_ccosto as uno, count(y.oc_monto) as  total, sum(y.oc_monto) as  total2 from compra_compra x left join compra_orden y on x.compra_id=y.oc_compra_id  ";
//echo $sql2;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$total2=$row2["total"];
$total2c=$row2["total2"];

$porce1=$total2*100/$total1;



?>
                      

                       <tr>
                         <td class="<? echo $estilo ?>"><? echo $total1;  ?> </td>
                         <td class="<? echo $estilo ?>"><? echo $total2;  ?> </td>
                         <td class="<? echo $estilo ?>"><? echo number_format($porce1,1,",",".");  ?>% </td>
                       </tr>

</table>
<br><br>

                     <table border=1>
                        <tr>
                         <td class="Estilo1b2" colspan="4">2.- %Compras ejecutadas de acuerdo al mes programado</td>
                        </tr>

                        <tr>
                         <td class="Estilo1b" colspan="1">Mes  </td>
                         <td class="Estilo1b" colspan="1">Total Programadas </td>
                         <td class="Estilo1b" colspan="1">Total Ejecutadas</td>
                         <td class="Estilo1b" colspan="1">% de Ejecucion</td>
                        </tr>

<?

$sql="select compra_mes as uno, count(compra_total) as total1, (compra_mes2) as mes2 from compra_compra where compra_region='$regionsession' and compra_origen =1 and compra_anno='$anno2' GROUP BY compra_mes ORDER BY compra_mes2 ";
//echo $sql."<br>";
$res = mysql_query($sql);
$j=1;
while ($row2 = mysql_fetch_array($res)) {
   $j=$row2["mes2"];
   $arr1[$j]=$row2["total1"];
//   echo $arr1[0];
   $j++;
}


$sql2="select compra_mes as uno, count(compra_total) as total2, (compra_mescumple2) as mes2 from compra_compra where compra_region='$regionsession' and compra_origen =1 and compra_estado='CUMPLIDA' and compra_anno='$anno2' GROUP BY compra_mescumple2 ORDER BY compra_mescumple2 ";
//$sql="select compra_mes as uno, count(compra_total) as total2 from compra_compra where compra_region='15' and compra_origen =1 and compra_estado='CERRADA' GROUP BY compra_mes ORDER BY compra_mes2 ";
//$sql2="SELECT compra_mes AS uno, count( y.oc_monto )AS total2 FROM compra_compra x LEFT JOIN compra_orden y ON x.compra_origen =1 AND x.compra_id = y.oc_compra_id WHERE x.compra_region ='$regionsession' GROUP BY compra_mes ORDER BY compra_mes2";
//echo $sql2."<br>";
$res2 = mysql_query($sql2);
while ($row2 = mysql_fetch_array($res2)) {
   $i=$row2["mes2"];
   $arr2[$i]=$row2["total2"];

}


?>


                       <tr>
                         <td class="<? echo $estilo ?>">Enero</td><td class="Estilo1b"><? echo $arr1[1]; ?></td><td class="Estilo1b"><? echo number_format($arr2[1],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[1]*100/$arr1[1]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Febreo</td><td class="Estilo1b"><? echo $arr1[2]; ?></td><td class="Estilo1b"><? echo number_format($arr2[2],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[2]*100/$arr1[2]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Marzo</td><td class="Estilo1b"><? echo $arr1[3]; ?></td><td class="Estilo1b"><? echo number_format($arr2[3],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[3]*100/$arr1[3]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Abril</td><td class="Estilo1b"><? echo $arr1[4]; ?></td><td class="Estilo1b"><? echo number_format($arr2[4],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[4]*100/$arr1[4]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Mayo</td><td class="Estilo1b"><? echo $arr1[5]; ?></td><td class="Estilo1b"><? echo number_format($arr2[5],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[5]*100/$arr1[5]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Junio</td><td class="Estilo1b"><? echo $arr1[6]; ?></td><td class="Estilo1b"><? echo number_format($arr2[6],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[6]*100/$arr1[6]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Julio</td><td class="Estilo1b"><? echo $arr1[7]; ?></td><td class="Estilo1b"><? echo number_format($arr2[7],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[7]*100/$arr1[7]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Agosto</td><td class="Estilo1b"><? echo $arr1[8]; ?></td><td class="Estilo1b"><? echo number_format($arr2[8],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[8]*100/$arr1[8]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Septiembre</td><td class="Estilo1b"><? echo $arr1[9]; ?></td><td class="Estilo1b"><? echo number_format($arr2[9],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[9]*100/$arr1[9]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Octubre</td><td class="Estilo1b"><? echo $arr1[10]; ?></td><td class="Estilo1b"><? echo number_format($arr2[10],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[10]*100/$arr1[10]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Noviembre</td><td class="Estilo1b"><? echo $arr1[11]; ?></td><td class="Estilo1b"><? echo number_format($arr2[11],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[11]*100/$arr1[11]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>
                       <tr>
                         <td class="<? echo $estilo ?>">Diciembre</td><td class="Estilo1b"><? echo $arr1[12]; ?></td><td class="Estilo1b"><? echo number_format($arr2[12],0,",","."); ?></td><td class="Estilo1b"><? $porce1=$arr2[12]*100/$arr1[12]; echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>

                       <tr>
                         <td class="<? echo $estilo ?>">Total</td><td class="Estilo1b"><? echo array_sum($arr1); ?></td><td class="Estilo1b"><? echo array_sum($arr2); ?></td><td class="Estilo1b"><?php $porce1=array_sum($arr2)*100/array_sum($arr1); echo number_format($porce1,1,",","."); ?> %</td>
                       </tr>



</table>
<br><br>

                     <table border=1>
                        <tr>
                         <td class="Estilo1b2" colspan="3">3.-   %Desviación de $Monto y Tipo de Compra</td>
                        </tr>

                        <tr>
                         <td class="Estilo1b" colspan="1">Monto Programado  </td>
                         <td class="Estilo1b" colspan="1">Monto Ejecutado </td>
                         <td class="Estilo1b" colspan="1">% de Ejecucion </td>
                        </tr>

<?

$sql="select compra_ccosto as uno, sum(compra_total) as total from compra_compra where x.compra_region='$regionsession' and compra_origen=1 and compra_anno='$anno2' ";
//echo $sql;
//$res = mysql_query($sql);
//$row = mysql_fetch_array($res);
// $total1=$row["total"];

$sql="select compra_ccosto as uno, sum(compra_total) as total from compra_compra where x.compra_region='$regionsession' and compra_origen=1 and compra_estado='CUMPLIDA' and compra_anno='$anno2' ";
//$sql2="select x.compra_ccosto as uno, sum(y.oc_monto) as  total from compra_compra x left join compra_orden y on x.compra_id=y.oc_compra_id where x.compra_region='$regionsession' ";
//$res2 = mysql_query($sql2);
//$row2 = mysql_fetch_array($res2);
//$total2=$row2["total"];

$porce3=$total2c*100/$total1c;

?>


                       <tr>
                         <td class="<? echo $estilo ?>"><? echo number_format($total1c,0,",",".");  ?> </td>
                         <td class="<? echo $estilo ?>"><? echo number_format($total2c,0,",",".");  ?> </td>
                         <td class="<? echo $estilo ?>"><? echo number_format($porce3,1,",",".");  ?> % </td>
                       </tr>

</table>
<br><br>




                     <table border=1>
                        <tr>
                         <td class="Estilo1b2" colspan="3">4.-  % Compras No programadas</td>
                        </tr>

                        <tr>
                         <td class="Estilo1b" colspan="1">Total Compras  </td>
                         <td class="Estilo1b" colspan="1">Total No Prog. </td>
                         <td class="Estilo1b" colspan="1">% Desviacion </td>
                        </tr>

<?
    $sql="select compra_ccosto as uno, count(compra_total) as total,  sum(compra_total) as total2 from compra_compra where compra_region='$regionsession' and compra_origen=1 and compra_anno='$anno2' ";
//  $sql="select compra_ccosto as uno, count(compra_total) as total,  sum(compra_total) as total2 from compra_compra where compra_region='$regionsession' and compra_origen<>1  ";
//$sql="select compra_ccosto as uno, count(compra_total) as total,  sum(compra_total) as total2 from compra_compra where compra_origen=1 and compra_region='$regionsession'";
//echo $sql;
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
 $total1=$row["total"];
 $total1c=$row["total2"];

  $sql2="select compra_ccosto as uno, count(compra_total) as total,  sum(compra_total) as total2 from compra_compra where compra_region='$regionsession' and compra_origen<>1 and compra_estado='CUMPLIDA' and compra_anno='$anno2' ";
//  $sql2="select compra_ccosto as uno, count(y.oc_monto) as  total, sum(y.oc_monto) as  total2 from compra_compra where compra_region='$regionsession' and compra_origen<>1 and compra_estado='CUMPLIDA' ";
//$sql2="select x.compra_ccosto as uno, count(y.oc_monto) as  total, sum(y.oc_monto) as  total2 from compra_compra x left join compra_orden y on x.compra_id=y.oc_compra_id where compra_id=1 and x.compra_region='$regionsession'";
//echo $sql2;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$total2=$row2["total"];
$total2c=$row2["total2"];

$porce1=$total2*100/$total1;
$porce3=$total2c*100/$total1c;

   if ($compraid<=147) {
      $estilo="Estilo1b2";
  } else {
      $estilo="Estilo1b";
  }


?>


                       <tr>
                         <td class="Estilo1b"><? echo $total1;  ?> </td>
                         <td class="Estilo1b"><? echo $total2;  ?> </td>
                         <td class="Estilo1b"><? echo number_format($porce1,1,",",".");  ?>% </td>
                       </tr>


</table>

<br><br>
                     <table border=1>
                        <tr>
                         <td class="Estilo1b2" colspan="3">5.-  $ Compras No programadas</td>
                        </tr>

                        <tr>
                         <td class="Estilo1b" colspan="1">Total Compras  </td>
                         <td class="Estilo1b" colspan="1">Total No Prog. </td>
                         <td class="Estilo1b" colspan="1">% Desviacion </td>
                        </tr>
                       <tr>
                         <td class="Estilo1b"><? echo number_format($total1c,0,",",".");  ?> </td>
                         <td class="Estilo1b"><? echo number_format($total2c,0,",",".");  ?> </td>
                         <td class="Estilo1b"><? echo number_format($porce3,1,",",".");  ?>% </td>
                       </tr>


</table>



