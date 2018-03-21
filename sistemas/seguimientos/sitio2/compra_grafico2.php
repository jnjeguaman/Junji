<?php
session_start();
require("inc/config.php");
include("Includes/FusionCharts.php");
$regionsession = $_SESSION["region"];

$fechamia=date('Y-m-d');
$fechamia2=date('d-m-Y');
$hora=date("H:i");

$unidad=$_GET["unidad"];
$compraid=$_GET["compraid"];
$orden=$_GET["orden"];
$ocnumero=$_GET["ocnumero"];
$ocetaid2=$_GET["ocetaid2"];
$anno2=date('Y');

if (!isset($_GET["anno"])) {
    $anno=$anno2;
} else {
    $anno=$_GET["anno"];
}


?>

<SCRIPT LANGUAGE="Javascript" SRC="grafico/FusionCharts.js"></SCRIPT>
<style type="text/css">
.Estilo1c{
    text-align:center;
    font-style:italic;
    font-family:"Times New Roman", Times;
    font-size:10px;
}
.Estilo1i{
    text-align:left;
    font-style:italic;
    font-family:"Times New Roman", Times;
    font-size:10px;
}
.Estilo1d{
    text-align:right;
    font-style:italic;
    font-family:"Times New Roman", Times;
    font-size:12px;
}
.Estilo2mc {
	font-family: Verdana;

	font-size: 10px;
	color: #003063;
    background-color:#E0F8F7;
    text-transform:uppercase;
}
.Estilo2mcblanco {
	font-family: Verdana;

	font-size: 10px;
	color: #003063;
    background-color:#FFFFFF;
    text-transform:uppercase;

}
.link {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #00659C;
	text-decoration:none;
	text-transform:uppercase;
}
.link:over {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #0000cc;
	text-decoration:none;
	text-transform:uppercase;
}


</style>
<script>
<!--
   function ejecuta() {
       alert("entra");
       document.form2.submit();
   }

-->
</script>

<div  style="width:200px; height:50px; background-color:#ffffff; position:absolute;  top:0px; left:0px; content:''; z-index:4; " id="div2">
<table width=100%>
 <tr>
  <td width=50%>
        <a href="compra_menu.php" class="link" >VOLVER </a> /
        <a href="../../argedo/plancompra.php" class="link" target="_blank">Otras Regiones </a>
  </td>
  <td width=50%>
   <form method="get" action="compra_grafico2.php"  name="form2" >
                                <select name="anno" class="Estilo1" onchange="this.form.submit()">
                                   <option value="">Seleccione...</option>
                                   <option value="2013" <? if ($anno==2013) { echo "selected=selected"; } ?>>2013</option>
                                   <option value="2014" <? if ($anno==2014) { echo "selected=selected"; } ?>>2014</option>
                                   <option value="2015" <? if ($anno==2015) { echo "selected=selected"; } ?>>2015</option>
                                   <option value="2016" <? if ($anno==2016) { echo "selected=selected"; } ?>>2016</option>
                                   <option value="2017" <? if ($anno==2017) { echo "selected=selected"; } ?>>2017</option>
                                   <option value="2018" <? if ($anno==2018) { echo "selected=selected"; } ?>>2018</option>
                                   <option value="2019" <? if ($anno==2019) { echo "selected=selected"; } ?>>2019</option>
                               </select>
    </form>
  </td>
 </tr>
</table>
</div>

<div  style="width:700px; height:400px; background-color:#E0F8F7; position:absolute;  top:1px; left:0px; content:''; z-index:1; " id="div2">
<!-- <div  style="width:1030px; height:400px; background-color:#E0F8F7; position:absolute; top:1px; left:710px; overflow: scroll " id="div2"> -->


<?php
     $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total from compra_compra x
     left join compra_detorden y on x.compra_id=y.detorden_plan
     where x.compra_anno='$anno'
     group by x.compra_depto order by cast(x.compra_depto as integer) ";


/*
     $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total from compra_compra x
     left join compra_detorden y on x.compra_id=y.detorden_plan
     where x.compra_region='$regionsession' and x.compra_anno='$anno'
     group by x.compra_depto ";
 */
/*
     $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total
from compra_compra x left join compra_detorden y on x.compra_id=y.detorden_plan left join compra_orden z on y.detorden_oc_id=z.oc_id
and year(y.detorden_fecha)='$anno'
where x.compra_region='$regionsession' and x.compra_anno='$anno' and z.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA'  group by x.compra_depto ";
*/
//     $sql2="select x.compra_depto as uno, sum(x.compra_total) as total from compra_compra x left join compra_detorden y on  x.compra_id=y.detorden_plan and year(y.detorden_fecha)='$anno' where x.compra_region='$regionsession' and x.compra_anno='$anno' and x.compra_estado<>'CANCELADA/ELIMINADA/RECHAZADA'  group by x.compra_depto  ";
//     $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total from compra_compra x left join compra_detorden y on  x.compra_id=y.detorden_plan where x.compra_region='$regionsession' and  x.compra_origen='1' and x.compra_anno='$anno' group by x.compra_depto  ";


//  echo $sql2."<br>";

     $res2 = mysql_query($sql2);
     $i=0;
     while ($ors = mysql_fetch_array($res2)) {
        $arrData[$i][1] = substr($ors['uno'],0,30);
        $arrData2[$i][1] = $ors['uno'];
        $arrData[$i][2] = $ors['total'];
        $i++;
    }

       $sql2="select compra_depto  as uno, sum(compra_total) as total from compra_compra where compra_anno='$anno'  group by compra_depto order by cast(compra_depto as integer)";
//       $sql2="select compra_depto  as uno, sum(compra_total) as total from compra_compra where compra_region='$regionsession' and compra_anno='$anno'  group by compra_depto ";
//       $sql2="select compra_depto  as uno, sum(compra_total) as total from compra_compra where compra_region='$regionsession' and compra_origen='1' and compra_anno='$anno' group by compra_depto ";
//       $sql2="select x.compra_ccosto as uno, sum(z.eta_monto) as     total from compra_compra x left join compra_orden y on x.compra_id=y.oc_compra_id left join dpp_etapas as z on y.oc_numero=z.eta_nroorden and z.eta_estado>=7 and year(eta_fechache)>=2013 group by x.compra_ccosto";
//   echo "<br><br><br><br><br><br><br>".$sql2."<br>";
     $res2 = mysql_query($sql2);
     $i=0;
     while ($ors = mysql_fetch_array($res2)) {
        $arrData[$i][3] = $ors['total'];
//        $arrData[$i][2] = $arrData[$i][2]-$ors['total'];
        if ($arrData[$i][3]<$arrData[$i][2]) {
           $arrData[$i][3]=0;
        }
        if ($arrData[$i][3]>$arrData[$i][2]) {
           $arrData[$i][3]=$arrData[$i][3]-$arrData[$i][2];
        }
//       echo $arrData[$i][3]."->".$arrData[$i][2]."<br>";
        $i++;
    }


                        //Initialize <chart> element
                        $strXML = "<chart palette='2' caption='Ejecucion Plan de Compra '  xAxisName='' yAxisName='Estado' numberPrefix='N°' showValues='10' stack100Percent='1' showPercentValues='0'>";
//                        $strXML = "<chart caption='Tareas Vigentes' labelDisplay='ROTATE' slantLabels='1'  numberPrefix='' formatNumberScale='0' rotateValues='1' placeValuesInside='0' decimals='0'  numberSuffix=' '>";
//                        $strXML .= "<set label='" . $ors['uno'] . "' value='" . $ors['total'] . "' link='" . urlencode("Detailed.php?FactoryId=" . $ors['FactoryId']) . "'/>";

                        //Initialize <categories> element - necessary to generate a multi-series chart
                        $strCategories = "<categories>";

                        //Initiate <dataset> elements
                        $strDataCurr = "<dataset seriesName='Ejecutada'>";
                        $strDataPrev = "<dataset seriesName='Pendiente'>";

                        //Iterate through the data
                        $j=0;
                        foreach ($arrData as $arSubData) {
                            //Append <category name='...' /> to strCategories
                            $strCategories .= "<category name='" . $arSubData[1] . "' />";
                            //Add <set value='...' /> to both the datasets
                            $strDataCurr .= "<set value='" . $arSubData[2] . "' link='" . urlencode("compra_grafico2.php?unidad=" . $arrData2[$j][1]) . "&anno=".$anno."'/>";
                            $strDataPrev .= "<set value='" . $arSubData[3] . "' link='" . urlencode("compra_grafico2.php?unidad=" . $arrData2[$j][1]) . "&anno=".$anno."'/>";
                            $j++;
                        }


                        //Close <categories> element
                        $strCategories .= "</categories>";

                        //Close <dataset> elements
                        $strDataCurr .= "</dataset>";
                        $strDataPrev .= "</dataset>";

                        //Assemble the entire XML now
                        $strXML .= $strCategories . $strDataCurr . $strDataPrev . "</chart>";

                        //Create the chart - MS Column 3D Chart with data contained in strXML
                        echo renderChart("grafico/StackedBar3D.swf", "", $strXML, "productSales", 750, 400, false, false);
                        ?>

                    </div>

<?

if ($unidad<>'') {

?>
<div  style="width:530px; height:600px; background-color:#ffffff; position:absolute;  top:20px; left:750px; " id="div4">


<img src="images/red.png" alt="PENDIENTE" height="17" width="19" border=0> PENDIENTE    &nbsp;&nbsp;&nbsp;&nbsp;
<img src="images/green.png" alt="CUMPLIDA" height="17" width="19" border=0> CUMPLIDA    &nbsp;&nbsp;&nbsp;&nbsp;
<img src="images/yellow.png" alt="CUMPLIDA" height="17" width="19" border=0> CANCELADA
                     <table border=0>

                      <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="compra_seguimientoexcelb.php?region=<? echo $regionsession ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&nombre=<? echo $nombre ?>&ccosto=<? echo $unidad ?>&uniresp=<? echo $uniresp ?>&programado=<? echo $programado ?>&estado=<? echo $estado ?>&anno=<? echo $anno ?>" class="link" >EXPORTAR PLAN CON O/C </a>  </td>
                             <td class="link">/</td>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="compra_seguimientoexcel2b.php?region=<? echo $regionsession ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&nombre=<? echo $nombre ?>&ccosto=<? echo $unidad ?>&uniresp=<? echo $uniresp ?>&programado=<? echo $programado ?>&estado=<? echo $estado ?>&anno=<? echo $anno ?>" class="link" >EXPORTAR PLAN </a>  </td>
                      </tr>
                      </table>

<table id="tablesorter-demo2" class="tablesorter" border="1" cellpadding="0" cellspacing="1">
 <thead>
 <tr>
   <td class="Estilo2mc" colspan=10 align="center">PLAN DE COMPRA DE <? echo $unidad; ?></td>
 </tr>
 <tr>
   <th class="Estilo2mc">N°</th>
   <th class="Estilo2mc"><a href="compra_grafico2.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=1&anno=<? echo $anno; ?>" class="link"  >Nombre</a></th>
   <th class="Estilo2mc"><a href="compra_grafico2.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=2&anno=<? echo $anno; ?>" class="link"  >Total</a></th>
   <th class="Estilo2mc">Vigente</th>
   <th class="Estilo2mc">Monto OC</th>
   <th class="Estilo2mc">Saldo</th>
   <th class="Estilo2mc" width="40">% OC</th>
   <th class="Estilo2mc"><a href="compra_grafico2.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=3&anno=<? echo $anno; ?>" class="link"  >Mes</a></th>
   <th class="Estilo2mc">Est.</th>
   <th class="Estilo2mc">Prog.</th>
 </tr>
</thead>
<tbody>

<?
    $order='';
    if ($orden==1) {
        $order=" order by compra_nombre";
     }
     if ($orden==2) {
        $order=" order by compra_total";
     }
     if ($orden==3) {
        $order=" order by compra_mes2";
     }
     
     $cont=1;
     $sql3="select * from compra_compra where compra_depto='$unidad' and compra_anno=$anno  $order ";
//     $sql3="select * from compra_compra where compra_ccosto='$unidad' and compra_id<='147'";

//  echo $sql3;
     $res3 = mysql_query($sql3);
     $i=0;
     while ($ors = mysql_fetch_array($res3)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo2mc";
       } else {
          $estilo2="Estilo2mcblanco";
       }
     $compraid2=$ors['compra_id'];
     $suma=0;
     



     $sql3b="select sum(y.detorden_monto) as total2, count(x.oc_compra_id) as suma from compra_orden x, compra_detorden y where y.detorden_plan ='$compraid2' and x.oc_id=y.detorden_oc_id  and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' and oc_monto<>'0' ";
//   $sql3b="select sum(oc_monto) as total2, count(oc_compra_id) as suma from compra_orden where oc_compra_id='$compraid2' and oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' ";
//     echo $sql3b."<br>";
     $res3b = mysql_query($sql3b);
     $i=0;
     $orsb = mysql_fetch_array($res3b);
     $suma=$orsb['suma'];
     $total2=$orsb['total2'];
     $porce2= $total2*100/$ors['compra_vigente'];
     $total31=$total31+$ors['compra_vigente'];
     
                                   //   $sql3b="select sum(oc_monto) as total2, count(oc_compra_id) as suma from compra_orden where oc_compra_id='$compraid2' and oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' ";
     if ($ors['compra_origen']=='1') {
         $origen="SI";
     }
     if ($ors['compra_origen']=='0') {
         $origen="NO";
     }
     if ($ors['compra_estado']=='PENDIENTE') {
         $imagen="red.png";
         $imagen2="PENDIENTE";

     }
     if ($ors['compra_estado']=='CUMPLIDA') {
         $imagen="green.png";
         $imagen2="CUMPLIDA";
     }
     if ($ors['compra_estado']=='CANCELADA') {
         $imagen="yellow.png";
         $imagen2="CANCELADA";
         $origen="Null";
         
     }

/*
      $sql2v = "Select * from compra_vigentedet  where cvig_compra_id =$compraid2 and cvig_anno='$anno'";
 //     echo $sql2v."<br>";
      $res2v = mysql_query($sql2v);
      $row2v = mysql_fetch_array($res2v);
      $vigente=$row2v["cvig_vigente"];
*/


?>
 <tr>
   <td class="<? echo $estilo2 ?>"><? echo $cont; ?></td>
   <td class="<? echo $estilo2 ?>"><a href="compra_grafico2.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=<? echo $orden; ?>&anno=<? echo $anno; ?>" class="link"  ><? echo $ors['compra_nombre']; ?></a></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($ors['compra_total']),0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($ors['compra_vigente']),0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($total2),0,',','.'); ?>&nbsp;</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($ors['compra_vigente']-$total2),0,',','.'); ?>&nbsp;</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($porce2),0,',','.'); ?>%</td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['compra_mes']; ?></td>
   <td class="<? echo $estilo2 ?>"><img src="images/<? echo $imagen ?>" alt="<? echo $imagen2 ?>" height="17" width="19" border=0> (<? echo $suma ?>)</td>
   <td class="<? echo $estilo2 ?>"><? echo $origen; ?></td>
 </tr>


<?
      $cont++;
    }

?>


</tbody>
</table>



</div>

<?
}

if ($compraid<>'') {
?>



<div  style="width:710px; height:600px; background-color:#ffffff; position:absolute;  top:400px; left:10px; " id="div4">
<table border="1"   width="100%">
<thead>
<?
    $sql3c="select * from compra_compra where compra_id='$compraid' ";
//   $sql3b="select sum(y.detorden_monto) as total2, count(x.oc_compra_id) as suma from compra_orden x, compra_detorden y where y.detorden_plan ='$compraid2' and x.oc_id=y.detorden_oc_id  and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA
//     echo $sql3c;
     $res3c = mysql_query($sql3c);
     $orsc = mysql_fetch_array($res3c);
     $nombrecompra=$orsc['compra_nombre'];
?>
 <tr>
   <td class="Estilo2mc" colspan=8 align="center">ORDENES DE COMPRA "<? echo $nombrecompra ?>"</td>
 </tr>

 <tr>
   <td class="Estilo2mc" >N°</td>
   <td class="Estilo2mc" >Doc</td>
   <td class="Estilo2mc" >Nombre</td>
   <td class="Estilo2mc">N° OC</td>
   <td class="Estilo2mc">Monto OC</td>
   <td class="Estilo2mc">Monto Eje</td>
   <td class="Estilo2mc">% Eje</td>
   <td class="Estilo2mc">Estado</td>
 </tr>
</thead>
<tbody>
<?
     $cont=1;
     $sql3="select * from compra_orden x, compra_detorden y where  y.detorden_plan='$compraid' and y.detorden_oc_id=x.oc_id and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' and x.oc_monto<>0 ";
//   echo $sql3."<br>";
     $res3 = mysql_query($sql3);
     $i=0;
     while ($ors = mysql_fetch_array($res3)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo2mc";
       } else {
          $estilo2="Estilo2mcblanco";
       }

     $sumaoc=$sumaoc+$ors['detorden_monto'];
     
     $ocnumero2=$ors['oc_numero'];
     $ocetaid=$ors['oc_eta_id'];
     $sql3b="select sum(eta_monto) as total2,count(eta_nroorden) as suma from dpp_etapas where eta_nroorden='$ocnumero2' and eta_estado=8";
     
//     $sql3b="select sum(eta_monto) as total2,count(eta_nroorden) as suma from dpp_etapas where eta_id='$ocetaid' and eta_estado=8";
     
     

//     $sql3b="select sum(eta_monto) as total2,count(eta_nroorden) as suma from dpp_etapas where eta_nroorden='$ocnumero2' and eta_estado=8";
//     echo $sql3b."<br>";
     $res3b = mysql_query($sql3b);
     $i=0;
     $orsb = mysql_fetch_array($res3b);
     $total2=$orsb['total2'];
     
     $compramontototal=$ors['oc_monto'];
     $porcentaje=$ors['detorden_monto']*100/$compramontototal;
     $asterisco="";
     if ($ors['oc_monto']>$ors['detorden_monto']) {
         $asterisco="*";
         $total2=$total2*50/100;
     }  else {
//         $total2=$orsb['total2'];
     }


     $suma=$orsb['suma'];
     $sumaoc2=$sumaoc2+$total2;
     $porce1=$total2*100/$ors['detorden_monto'];


     
?>
 <tr>
   <td class="<? echo $estilo2 ?>"><? echo $cont; ?></td>
   <td class="<? echo $estilo2 ?>">
    <a href="../../archivos/docfac/<? echo $ors['oc_archivo']; ?>" class="link" target="_blank" ><IMG height=14 alt="" src="imagenes/attach.gif" width=8 border="0"></a></td>
   <td class="<? echo $estilo2 ?>"><a href="compra_grafico2.php?unidad=<? echo $unidad; ?>&compraid=<? echo $compraid; ?>&orden=<? echo $orden; ?>&ocnumero=<? echo $ors['oc_numero']; ?>&ocetaid2=<? echo $ocetaid; ?>&anno=<? echo $anno; ?>" class="link"  ><? echo $ors['oc_nombre']; ?></a></td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['oc_numero']; ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($ors['detorden_monto'],0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($total2,0,',','.'); ?><? echo $asterisco ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($porce1,0,',','.'); ?>%</td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['oc_estado']; ?>(<? echo $suma; ?>)</td>

 </tr>


<?
      $cont++;
    }

?>
 <tr>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>">Total</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($sumaoc,0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($sumaoc2,0,',','.'); ?></td>
 </tr>

  </tbody>
</table>
<hr>
<?
if ($ocnumero<>'') {




?>
<table border="1"   width="100%">
<thead>
 <tr>
   <td class="Estilo2mc" colspan=7 align="center">FACTURAS O/C N° <? echo $ocnumero; ?></td>
 </tr>
 <tr>
   <td class="Estilo2mc">N°</td>
   <td class="Estilo2mc">Proveedor</td>
   <td class="Estilo2mc">Rut</td>
   <td class="Estilo2mc">Numero</td>
   <td class="Estilo2mc">Fecha Pago</td>
   <td class="Estilo2mc">Monto </td>
   <td class="Estilo2mc">Estado</td>
 </tr>
</thead>
<tbody>
<?
     $cont=1;
//     $sql3="select * from dpp_etapas where eta_id='$ocetaid2'";
     $sql3="select * from dpp_etapas where eta_nroorden='$ocnumero'";
//   echo $sql3;
     $res3 = mysql_query($sql3);
     $i=0;
     while ($ors = mysql_fetch_array($res3)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo2mc";
       } else {
          $estilo2="Estilo2mcblanco";
       }
     $sumaeta=$sumaeta+$ors['eta_monto'];
     $estado=$ors['eta_estado'];
     
     if ($estado==1) {
         $estadotxt="OF. DE PARTES";
     }
     if ($estado==2) {
         $estadotxt="ADMINISTRACIÓN";
     }
     if ($estado==3) {
         $estadotxt="PROCESO SIGFE";
     }
     if ($estado==5) {
         $estadotxt="CONTABILIDAD";
     }
     if ($estado==6) {
         $estadotxt="CONTABILIDAD";
     }
     if ($estado==7) {
         $estadotxt="PAGO PROVEEDOR";
     }
     if ($estado==8) {
         $estadotxt="PAGADO";
     }
     if ($estado==9) {
         $estadotxt="CADUCADO";
     }
     if ($estado==15) {
         $estadotxt="RECHAZADO";
     }

     $periodo=substr($ors['eta_fecha_fac'],0,4);
     $region=$ors['eta_region'];
?>
 <tr>
   <td class="<? echo $estilo2 ?>"><? echo $cont; ?></td>
   <td class="<? echo $estilo2 ?>"><a href="../../argedo/ficha2f.php?reg=15&op=5&periodo=<? echo $periodo; ?>&id=<? echo $ors['eta_id'] ?>" class="link"  target="_blank"><? echo $ors['eta_cli_nombre']; ?></a></td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['eta_rut']; ?>-<? echo $ors['eta_dig']; ?></td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['eta_numero']; ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo $ors['eta_fechache']; ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format( $ors['eta_monto'],0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>"><? echo $estadotxt; ?></td>
 </tr>


<?
      $cont++;
    }

?>
 <tr>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>">Total</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($sumaeta,0,',','.'); ?></td>

 </tr>

  </tbody>
</table>
<?
}
?>


</div>

<?
}
?>





</body>
</html>



