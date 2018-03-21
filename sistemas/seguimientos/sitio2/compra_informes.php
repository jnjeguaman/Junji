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

<div  style="width:200px; height:50px; background-color:#ffffff; position:absolute;  top:0px; left:0px; content:''; z-index:4; " id="div2">
        <a href="compra_menu.php" class="link" >VOLVER </a>
</div>


<?

if ($unidad<>'') {

?>
<div  style="width:530px; height:600px; background-color:#ffffff; position:absolute;  top:20px; left:750px; " id="div4">

<img src="images/red.png" alt="PENDIENTE" height="17" width="19" border=0> PENDIENTE    &nbsp;&nbsp;&nbsp;&nbsp;
<img src="images/green.png" alt="CUMPLIDA" height="17" width="19" border=0> CUMPLIDA
<table id="tablesorter-demo2" class="tablesorter" border="1" cellpadding="0" cellspacing="1">
 <thead>
 <tr>
   <td class="Estilo2mc" colspan=9 align="center">PLAN DE COMPRA DE <? echo $unidad; ?></td>
 </tr>
 <tr>
   <th class="Estilo2mc">N°</th>
   <th class="Estilo2mc" ><a href="compra_grafico.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=1" class="link"  >Nombre</a></th>
   <th class="Estilo2mc"><a href="compra_grafico.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=2" class="link"  >Total</a></th>
   <th class="Estilo2mc">Monto OC</th>
   <th class="Estilo2mc">Saldo</th>
   <th class="Estilo2mc" width="40">% OC</th>
   <th class="Estilo2mc"><a href="compra_grafico.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=3" class="link"  >Mes</a></th>
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
     $sql3="select * from compra_compra where compra_depto='$unidad' $order ";
//     $sql3="select * from compra_compra where compra_ccosto='$unidad' and compra_id<='147'";
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
     $compraid2=$ors['compra_id'];
     $suma=0;



     $sql3b="select sum(y.detorden_monto) as total2, count(x.oc_compra_id) as suma from compra_orden x, compra_detorden y where y.detorden_plan ='$compraid2' and x.oc_id=y.detorden_oc_id  and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' ";
//   $sql3b="select sum(oc_monto) as total2, count(oc_compra_id) as suma from compra_orden where oc_compra_id='$compraid2' and oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' ";
//     echo $sql3b."<br>";
     $res3b = mysql_query($sql3b);
     $i=0;
     $orsb = mysql_fetch_array($res3b);
     $suma=$orsb['suma'];
     $total2=$orsb['total2'];
     $porce2= $total2*100/$ors['compra_total'];
     $total31=$total31+$ors['compra_total'];
     
     if ($ors['compra_estado']=='PENDIENTE') {
         $imagen="red.png";
         $imagen2="PENDIENTE";
         
     }
     if ($ors['compra_estado']=='CUMPLIDA') {
         $imagen="green.png";
         $imagen2="CUMPLIDA";
     }                                  //   $sql3b="select sum(oc_monto) as total2, count(oc_compra_id) as suma from compra_orden where oc_compra_id='$compraid2' and oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' ";
     if ($ors['compra_origen']=='1') {
         $origen="SI";
     }
     if ($ors['compra_origen']=='0') {
         $origen="NO";
     }



?>
 <tr>
   <td class="<? echo $estilo2 ?>"><? echo $cont; ?></td>
   <td class="<? echo $estilo2 ?>"><a href="compra_grafico.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=<? echo $orden; ?>" class="link"  ><? echo $ors['compra_nombre']; ?></a></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($ors['compra_total']),0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($total2),0,',','.'); ?>&nbsp;</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($ors['compra_total']-$total2),0,',','.'); ?>&nbsp;</td>
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
   <td class="Estilo2mc" colspan=7 align="center">ORDENES DE COMPRA "<? echo $nombrecompra ?>"</td>
 </tr>

 <tr>
   <td class="Estilo2mc" >N°</td>
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
     $sql3="select * from compra_orden x, compra_detorden y where  y.detorden_plan='$compraid' and y.detorden_oc_id=x.oc_id and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA'";
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
     $sumaoc=$sumaoc+$ors['oc_monto'];
     
     $ocnumero2=$ors['oc_numero'];
     $ocetaid=$ors['oc_eta_id'];
     $sql3b="select sum(eta_monto) as total2,count(eta_nroorden) as suma from dpp_etapas where eta_id='$ocetaid' and eta_estado=8";
//     $sql3b="select sum(eta_monto) as total2,count(eta_nroorden) as suma from dpp_etapas where eta_nroorden='$ocnumero2' and eta_estado=8";
//     echo $sql3b;
     $res3b = mysql_query($sql3b);
     $i=0;
     $orsb = mysql_fetch_array($res3b);
     $total2=$orsb['total2'];
     $asterisco="";
     if ($ors['oc_monto']<$total2) {
         $asterisco="*";
         $total2=$ors['oc_monto'];
     }  else {
         $total2=$orsb['total2'];
     }
     $suma=$orsb['suma'];
     $sumaoc2=$sumaoc2+$total2;
     $porce1=$total2*100/$ors['oc_monto'];


     
?>
 <tr>
   <td class="<? echo $estilo2 ?>"><? echo $cont; ?></td>
   <td class="<? echo $estilo2 ?>"><a href="compra_grafico.php?unidad=<? echo $unidad; ?>&compraid=<? echo $compraid; ?>&orden=<? echo $orden; ?>&ocnumero=<? echo $ors['oc_numero']; ?>&ocetaid2=<? echo $ocetaid; ?>" class="link"  ><? echo $ors['oc_nombre']; ?></a></td>
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
     $sql3="select * from dpp_etapas where eta_id='$ocetaid2'";
//     $sql3="select * from dpp_etapas where eta_nroorden='$ocnumero'";
   echo $sql3;
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


<div  style="width:900px; height:400px; background-color:#E0F8F7; position:absolute;  top:8px; left:4px; content:''; z-index:1; " id="div2">
<?
 // $strXML = "<graph caption='Carga de Trabajo' subCaption='Por Funcionario' pieSliceDepth='0' showBorder='1' formatNumberScale='0' numberSuffix=' Unidad' animation=' " . $animateChart . "'>  decimalPrecision='0'";
  $strXML = "<graph caption='Actividades por Region' labelDisplay='ROTATE' slantLabels='1' pieSliceDepth='30' showBorder='0' showNames='1' formatNumberScale='0' numberSuffix='' decimalPrecision='0'>";
  

         $sql2="SELECT x.nombre AS uno, count( y.compra_origen )AS total FROM regiones x LEFT JOIN compra_compra y ON x.codigo = y.compra_region AND y.compra_origen =1 WHERE x.codigo <19 GROUP BY x.nombre ";
//       $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total from compra_compra x left join compra_detorden y on x.compra_id=y.detorden_plan where x.compra_region='$regionsession' and  x.compra_origen='1' group by x.compra_depto  ";
  //     $sql2 = "SELECT  x.usu_nombre as uno, count(y.asig_usuer) as total FROM sisap_usuario x left join sisap_asignado as y on  x.usu_estado='A' and x.usu_nombre=y.asig_usuer and y.asig_estado='TERMINADO' group by x.usu_nombre ";
  //     $sql2 = "SELECT  x.usu_nombre as uno, count(y.asig_responsable) as total FROM sisap_usuario x left join sisap_asignado as y on  x.usu_estado='A' and x.usu_nombre=y.asig_responsable group by x.usu_nombre ";
//Select asig_responsable as uno, count(asig_responsable) as total from sisap_asignado where asig_estado='ASIGNADO' GROUP BY asig_responsable order by
//     echo $sql2;
     $res2 = mysql_query($sql2);
     $i=0;
     while ($ors = mysql_fetch_array($res2)) {
        $strXML .= "<set label='" . $ors['uno'] . "' value='" . $ors['total'] . "' link='" . urlencode("sisap_tareascerradas2.php?FactoryId=" . $ors['FactoryId']) . "'/>";

        $arrData[$i][1] = $ors['uno'];
        $arrData[$i][2] = $ors['total'];
        $i++;
    }
  //  echo $arreglo;

     $strXML .= "</graph>";
     //Create the chart - Pie 3D Chart with data from strXML





?>


<?
      //include("Default.php");
      echo renderChart("grafico/Column3D.swf", "", $strXML, "Carga", 900, 450, false, false);
?>



</div>

