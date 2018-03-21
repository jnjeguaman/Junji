<?php
session_start();
require("inc/config.php");
include("Includes/FusionCharts.php");
$regionsession = $_SESSION["region"];
$annomia=date('Y');
$fechamia=date('Y-m-d');
$fechamia2=date('d-m-Y');
$hora=date("H:i");

$fecha1=$_POST["fecha1"];
if ($fecha1=='') {
   $fecha1="01-01-".$annomia;
}

$fecha2=$_POST["fecha2"];
if ($fecha2=='') {
   $fecha2=$fechamia2;
}

$tipo=$_POST["tipo"];
$modalidad=$_POST["modalidad"];
$region=$_POST["region"];
$estado1=$_POST["estado1"];
$estado2=$_POST["estado2"];
$estado3=$_POST["estado3"];
$estado4=$_POST["estado4"];

if (isset($_POST["forma"])) {
   $forma=$_POST["forma"];
} else {
   $forma=0;
}


if (isset($_POST["forma3"])) {
   $forma3=$_POST["forma3"];
} else {
   $forma3=0;
}

$forma2=$_POST["forma2"];

if (isset($_POST["anno2"])) {
    $anno2=$_POST["anno2"];
} else {
    $anno2=date("Y");
}



?>


<SCRIPT LANGUAGE="Javascript" SRC="grafico/FusionCharts.js"></SCRIPT>

<style type="text/css">
.Estilo1{
    text-align:left;
    font-style:italic;
    font-family:"Times New Roman", Times;
    font-size:12px;
}
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
 function desmarcar1() {
     if (document.form1.region.value=='') {
        document.form1.forma2.checked = false;
     }
 }
 
 function desmarcar2() {
     if (document.form1.tipo.value!='') {
        document.form1.modalidad.checked = false;
     }
 }
-->
</script>
    <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />

<div  style="width:200px; height:50px; background-color:#ffffff; position:absolute;  top:0px; left:0px; content:''; z-index:4; " id="div2">
        <a href="compra_menu2.php" class="link" >VOLVER </a>
</div>

<div  style="width:900px; height:130px; background-color:#E0F8F7; position:absolute;  top:10px; left:0px; content:''; z-index:4; " id="div2">
  <table width="100%" border="1" >
  
	 <form name="form1" action="compra_informes2.php" method="post" >
    <tr>
      <td colspan=4 align="center" class="Estilo1">
         Informe Control Ordenes de Compra
      </td>
    </tr>
    <tr>
                             <td  valign="center" class="Estilo1">Fecha Inicio</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c1" readonly="1">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c1",
        trigger    : "f_trigger_c1",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>
                             </td>
                             <td  valign="center" class="Estilo1">Fecha Termino</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha2 ?>" id="f_date_c2" readonly="1">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c2",
        trigger    : "f_trigger_c2",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>
                             </td>


     </tr>
     <tr>
       <td  valign="center" class="Estilo1">&nbsp;</td>
       <td  valign="top" class="Estilo1" >  &nbsp;

        </td>

        <td  class="Estilo1" width="20%" class="Estilo1">Tipo Contratación  </td>
          <td class="Estilo1" width="30%" class="Estilo1">
  	       <select name='tipo'  onChange='desmarcar2()' class='Estilo1'>
          	<option value=''>Todas...</option>
<?
      	     $consulta=mysql_query("Select cat_nombre, cat_id from compra_categoria where cat_estado =2");
   	         while($registro=mysql_fetch_row($consulta))	{
?>
		        <option value='<? echo $registro[1] ?>'   <? if ( $registro[1]==$tipo) { echo "selected=selected"; }  ?>><? echo $registro[0] ?></option>
<?
             }
?>
          </select>
           <input type="checkbox" class="Estilo2" value="modalidad" name="modalidad"  <? if ($modalidad=="modalidad") { echo "checked"; }  ?> onclick="desmarcar2();">Por Modalidad <br>
          </td>
      </tr>


      <tr>
          <td  valign="center" class="Estilo1">Regi&oacute;n</td>
          <td class="Estilo1">
               <select name="region" class="Estilo1" onchange="desmarcar1();">
                   <option value="">Todas</option>
<?
                   $sql2 = "Select * from regiones where codigo<20 order by codigo";
                     //echo $sql;
                   $res2 = mysql_query($sql2);
                   while($row2 = mysql_fetch_array($res2)){
?>
                      <option value="<? echo $row2["codigo"] ?>"  <? if ($row2["codigo"]==$region) { echo "selected=selected"; }  ?>  ><? echo $row2["nombre"] ?></option>
<?
                   }
?>
                </select>
            </td>

           <td  valign="top" class="Estilo1" >&nbsp;</td>
           <td  valign="top" class="Estilo1" >
           <input type="checkbox" class="Estilo2" value="1" name="forma2"  <? if ($forma2=="1" ) { echo "checked"; }  ?> onclick="desmarcar1();">Centro Costo
           </td>
         </tr>
        <tr>
           <td  valign="top" class="Estilo1" >Criterio </td>
           <td  valign="top" class="Estilo1" >
           <input type="radio" class="Estilo2" value="1" name="forma"  <? if ($forma=="1") { echo "checked"; }  ?> >Monto
           <input type="radio" class="Estilo2" value="0" name="forma"  <? if ($forma=="0" ) { echo "checked"; }  ?> >Numero   <br>
           <input type="checkbox" class="Estilo2" value="1" name="forma3"  <? if ($forma3=="1" ) { echo "checked"; }  ?> >Porcentaje
           </td>

           <td  valign="top" class="Estilo1" >Estados </td>
           <td  valign="top" class="Estilo1" >
           <input type="checkbox" class="Estilo2" value="ACEPTADO" name="estado1"  <? if ($estado1=="ACEPTADO") { echo "checked"; }  ?> >ACEPTADO <br>
           <input type="checkbox" class="Estilo2" value="CANCELADA/ELIMINADA/RECHAZADA" name="estado2"  <? if ($estado2=="CANCELADA/ELIMINADA/RECHAZADA" ) { echo "checked"; }  ?> >CANCELADA/ELIMINADA/RECHAZADA<br>
           <input type="checkbox" class="Estilo2" value="ENVIADA" name="estado3"  <? if ($estado3=="ENVIADA") { echo "checked"; }  ?> >ENVIADA <br>
           <input type="checkbox" class="Estilo2" value="RECEPCION CONFORME" name="estado4"  <? if ($estado4=="RECEPCION CONFORME" ) { echo "checked"; }  ?> >RECEPCION CONFORME

           </td>
         </tr>


        <tr>
           <td  valign="top" class="Estilo1c" colspan=4>
             <input type="submit" class="Estilo2" value="Consultar" >
             <a href="compra_informes2.php" class="link" >limpiar </a>
             </td>
         </tr>


     </form>
  </table>

</div>
<div  style="width:200px; height:50px; background-color:#ffffff; position:absolute;  top:253px; left:5px; content:''; z-index:10; " id="div2">

</div>



<div  style="width:1000px; height:400px; background-color:#E0F8F7; position:absolute;  top:252px; left:4px; content:''; z-index:1; " id="div2">

<?php


/*
   $sql="SELECT (
compra_region
) AS region, z.cat_nombre AS tipo, count( z.cat_nombre )AS tipo2
FROM compra_compra x, compra_subcat y, compra_categoria z
WHERE x.compra_region =15
AND x.compra_origen =1
AND x.compra_anno =2013
AND x.compra_tipo = y.subcat_nombre
AND y.subcat_cat_id >=14
AND y.subcat_cat_id = z.cat_id
GROUP BY z.cat_nombre

 ";
 */

 
if ($region<>'') {
    $where1=" and x.oc_region=$region ";
    $sql21 = "Select * from regiones where codigo=$region";
    //echo $sql21;
    $res21 = mysql_query($sql21);
    $row21 = mysql_fetch_array($res21);
    $nombrereg=$row21["nombre"];

}
$orden=" x.oc_tipo ";

if ($fecha1<>'' and $fecha1<>'') {
    $fecha1b= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    $fecha2b= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
    $sqlfecha=" (oc_fechacompra>='$fecha1b' and oc_fechacompra <='$fecha2b') and  ";
}

if ($tipo=='') {
    $tiponombre="Todas";
    $where2=" oc_tipo ='$tipo' ";
}
if ($tipo=='14') {
    $tiponombre="Licitaciones Publicas";
    $where2=" oc_tipo ='$tipo' ";
}
if ($tipo=='15') {
    $tiponombre="Informa en el Portal";
    $where2=" oc_tipo ='$tipo' ";
}
if ($tipo=='16') {
    $tiponombre="Convenio Marco";
    $where2=" oc_tipo ='$tipo' ";
}
if ($tipo=='17') {
    $tiponombre="Trato Directo";
    $where2=" oc_tipo ='$tipo' ";
}
if ($modalidad<>'') {
//    $tipo="algo";
    $orden=" x.oc_modalidad ";
    $where2=" oc_tipo<>'' ";
}

//echo "---->".$forma;
if ($forma=='0') {
   $operacion="count( x.oc_tipo )AS tipo2";
}
if ($forma=='1') {
   $operacion="sum( x.oc_monto )AS tipo2";
}
$sw=0;
$or=" and ( ";
if ($estado1<>'') {
    $or.=" oc_estado='$estado1' or ";
    $sw=1;
}
if ($estado2<>'') {
    $or.=" oc_estado='$estado2' or ";
    $sw=1;
}
if ($estado3<>'') {
    $or.=" oc_estado='$estado3' or ";
    $sw=1;
}
if ($estado4<>'') {
    $or.=" oc_estado='$estado4' or ";
    $sw=1;
}

if ($sw==1) {
   $or.=" 1=2 )";
}
if ($sw==0) {
   $or.=" 1=1 )";
}



if ($tipo=="" and $forma2=='') {
     $sql="SELECT cat_nombre AS tipo, $operacion FROM compra_orden x, compra_categoria y WHERE $sqlfecha x.oc_folio =0  and  x.oc_tipo = y.cat_id and y.cat_estado=2 $where1 $or GROUP BY $orden ";
//     $sql="SELECT cat_nombre AS tipo, $operacion FROM compra_orden x, compra_categoria y WHERE x.oc_folio =0 AND year( x.oc_fechacompra )='$anno2' AND x.oc_tipo = y.cat_id $where1 $or GROUP BY $orden ";
//     $sql="select cat_nombre as tipo, count(compra_tipo2) as tipo2 from compra_compra x, compra_categoria y where x.compra_origen=1 and x.compra_anno=2014 and x.compra_tipo2=y.cat_id  $where1 group by x.compra_tipo2  ";
}
if ($tipo<>"" and $forma2=='') {
   $sql="SELECT y.subcat_nombre AS tipo, $operacion FROM compra_orden x, compra_subcat y WHERE $sqlfecha x.oc_folio =0 AND $where2 AND x.oc_modalidad = y.subcat_id  $where1 $or GROUP BY x.oc_modalidad";
//   $sql="select y.subcat_nombre as tipo, count(x.compra_modalidad) as tipo2 from compra_compra x, compra_subcat y where x.compra_origen=1 and x.compra_anno=2014 and x.compra_tipo2='$tipo' and x.compra_modalidad=y.subcat_id $where1 group by x.compra_modalidad";
//   $sql="select (compra_region) as region, compra_tipo as tipo, count(compra_tipo) as tipo2 from compra_compra where compra_region=15 and compra_origen=1 and compra_anno=2013 group by compra_tipo  ";
}
if ($tipo=="" and $forma2<>'') {
     $sql="SELECT x.oc_ccosto AS tipo, $operacion FROM compra_orden x, compra_categoria y WHERE $sqlfecha x.oc_folio =0 AND  x.oc_tipo = y.cat_id and y.cat_estado=2 $where1 $or GROUP BY x.oc_ccosto ";
//     $sql="select cat_nombre as tipo, count(compra_tipo2) as tipo2 from compra_compra x, compra_categoria y where x.compra_origen=1 and x.compra_anno=2014 and x.compra_tipo2=y.cat_id  $where1 group by x.compra_tipo2  ";
//     $sql="select cat_nombre as tipo, count(compra_tipo2) as tipo2 from compra_compra x, compra_categoria y where x.compra_origen=1 and x.compra_anno=2014 and x.compra_tipo2=y.cat_id  $where1 group by x.compra_tipo2  ";
//   $sql="select (compra_region) as region, compra_tipo as tipo, count(compra_tipo) as tipo2 from compra_compra where compra_region=15 and compra_origen=1 and compra_anno=2013 group by compra_tipo  ";
}
if ($tipo<>"" and $forma2<>'') {
   $sql="SELECT x.oc_ccosto AS tipo, $operacion FROM compra_orden x, compra_subcat y WHERE $sqlfecha x.oc_folio =0 AND oc_tipo ='$tipo' AND x.oc_modalidad = y.subcat_id and y.cat_estado=2 $where1 $or GROUP BY x.oc_ccosto";
//   $sql="select y.subcat_nombre as tipo, count(x.compra_modalidad) as tipo2 from compra_compra x, compra_subcat y where x.compra_origen=1 and x.compra_anno=2014 and x.compra_tipo2='$tipo' and x.compra_modalidad=y.subcat_id $where1 group by x.compra_modalidad";
//   $sql="select (compra_region) as region, compra_tipo as tipo, count(compra_tipo) as tipo2 from compra_compra where compra_region=15 and compra_origen=1 and compra_anno=2013 group by compra_tipo  ";
}


//echo $sql;

                        //We first request the data from the form (Default.php)
                        $intSoups = 100;
                        $intSalads = 200;
                        $intSandwiches = 300;
                        $intBeverages = 400;
                        $intDesserts = 500;

                        //In this example, we're directly showing this data back on chart.
                        //In your apps, you can do the required processing and then show the
                        //relevant data only.

                        //Now that we've the data in variables, we need to convert this into XML.
                        //The simplest method to convert data into XML is using string concatenation.
                        //Initialize <chart> element
                        $strXML = "<chart caption='Tipos de Contratacion' subCaption='$tiponombre $nombrereg' showPercentValues='$forma3' pieSliceDepth='30' showBorder='1' formatnumberscale='0' decimalseparator=',' thousandseparator='.' >";
                        //Add all data
                       $res3 = mysql_query($sql);
                       $cont=1;
                       while($row3 = mysql_fetch_array($res3)){
                          $arr1[$cont]=$row3["tipo2"];
                          $arr2[$cont]=$row3["tipo"];
                          $cont++;
                          $strXML .= "<set label='".$row3["tipo"]."' value='" . $row3["tipo2"] . "' />";
                       }


//                        $strXML .= "<set label='Informa en el Portal' value='" . $arr1[2] . "' />";
//                        $strXML .= "<set label='Trato Directo' value='" . $arr1[3] . "' />";
//                        $strXML .= "<set label='Beverages' value='" . $intBeverages . "' />";
//                        $strXML .= "<set label='Desserts' value='" . $intDesserts . "' />";
                        //Close <chart> element
                        $strXML .= "</chart>";

                        //Create the chart - Pie 3D Chart with data from $strXML
                        echo renderChart("grafico/Pie3D.swf", "", $strXML, "Sales", 1000, 400, false, false);
                        ?>


</div>

