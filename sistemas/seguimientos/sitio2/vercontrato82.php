<?php
session_start();
require("inc/config.php");
include("Includes/FusionCharts.php");

require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
extract($_POST);
extract($_GET);

//------ Para el auditor
if ($nivel==23) {
  $regionsession = $region2;
} else {
   $regionsession = $_SESSION["region"];
}

$usuario=$_SESSION["nom_user"];
$regnombre=$_SESSION["regionnom"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$anno=date("Y");
$year2=date("Y");

if (isset($_GET["anno2"])) {
    $anno2=$_GET["anno2"];
} else {
    $anno2=date("Y");
}



$sql="select * from dpp_contratos where cont_id=$id";
//echo $sql.">><br>";;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$contvcuota2 =$row["cont_vcuota"];
if ($contvcuota==0) {
   $contvcuota =$row["cont_anual"]/12;
}

if ($sw==2) {
   $sql2 = "delete from dpp_fondoreserva where fres_id=$fresid";
   mysql_query($sql2);
   echo "<script>location.href='vercontrato82.php?id=$id&region2=$region2'</script>";
}

$conttipo2 =$row["cont_tipo2"];
$sql2 = "Select * from dpp_monedas where mone_id=$conttipo2";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda2=$row2["mone_tipo"];




?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Contratos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="Javascript" SRC="grafico/FusionCharts.js"></SCRIPT>
<script type="text/javascript" src="jquery/jquery-1.6.4.js"></script>

<script language="JavaScript" type="text/javascript" src="ajax5.js"></script>
</head>

<body>


<script type="text/javascript">
 //<![CDATA[
$(window).load(function(){
$('tr').bind('mouseover mouseout', function() {
    $(this).toggleClass("hover");
});
$('tr').bind('click', function() {
    $(this).toggleClass("active");
    
    pos = $(this).attr("id");
    var c=document.getElementById("b"+pos).value;
//    alert(c);
    enviarDatosEmpleado5(c,<? echo $tipodoc ?>);
    
    if (event.target.type !== 'checkbox') {
        $(this).find("input[type=checkbox]").prop("checked", (!$(this).find("input[type=checkbox]").prop("checked")) );
    }
});




});//]]>

</script>

<style type="text/css">
<!--

tr td {
    background:#D8D8D8;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
}
tr.hover td {
    background: orange;
}
tr.active td {
    background: lightgreen;
}

.Estilo1 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: left;
}
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right !important;;
}
-->
</style>
 <div  style="width:900px; height:45px; background-color:#E0F8F7; position:absolute; top:0px; left:00px;" id="div1">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">

                           <tr>
                             <td  valign="center" class="Estilo1"  width="20%">
                               <a href="valida8c.php" class="link">Volver</a>
                             </td>
                             <td class="Estilo1" width="70%" >
                                Nombre Empresa : <? echo $row["cont_nombre"]; ?>,
                                Rut Empresa : <? echo $row["cont_rut"]."-".$row["cont_dig"]; ?>
                                <br>
                                Fecha Inicio : <? echo $row["cont_fechainicio"]; ?>.
                                Fecha Termino : <? echo $row["cont_vence"]; ?>
                             </td>
                             <td  valign="center" class="Estilo1"  width="20%">
 <a href="javascript:void(0)" onclick="window.open('contrato_ficha.php?action=ficha1&id=<? echo $row['cont_id']; ?>&ori=2','','width=540,height=600,scrollbars=1,location=1')">Ficha Contrato </a>
                             </td>
                           </tr>
</table>



</div>
 <div  style="width:455px; height:560px; background-color:#FFFFFF; position:absolute; top:50px; left:00px; border-right-style: ridge;border-top-style: ridge;border-left-style: ridge;border-bottom-style: ridge" id="div1">
<?

//$id=$_POST["id"];
$id=$_GET["id"];

?>
				  <form name="form111" action="vercontrato82.php" method="get"  >
                            <tr>
                             <td  valign="center" class="Estilo1">Año
                                <select name="anno2" class="Estilo1" onchange="this.form.submit()">
                                   <option value="2011" <? if (2011==$anno2) { echo "selected=selected"; } ?> >2011</option>
                                   <option value="2012" <? if (2012==$anno2) { echo "selected=selected"; } ?> >2012</option>
                                   <option value="2013" <? if (2013==$anno2) { echo "selected=selected"; } ?> >2013</option>
                                   <option value="2014" <? if (2014==$anno2) { echo "selected=selected"; } ?> >2014</option>
                                   <option value="2015" <? if (2015==$anno2) { echo "selected=selected"; } ?> >2015</option>
                                   <option value="2016" <? if (2016==$anno2) { echo "selected=selected"; } ?> >2016</option>
                                   <option value="2017" <? if (2017==$anno2) { echo "selected=selected"; } ?> >2017</option>
                                   <option value="2018" <? if (2018==$anno2) { echo "selected=selected"; } ?> >2018</option>
                                   <option value="2019" <? if (2019==$anno2) { echo "selected=selected"; } ?> >2019</option>
                                   <option value="2020" <? if (2020==$anno2) { echo "selected=selected"; } ?> >2020</option>
                               </select>
                             </td>
                             </tr>
                            <input type="hidden" name="id" value="<? echo $id ?>" >
                            <input type="hidden" name="tipodoc" value="<? echo $tipodoc ?>" >
                            <input type="hidden" name="region2" value="<? echo $region2 ?>" >
                   </form>


<table border=0 width="100%">
 <thead>
 <tr>
   <td  class="Estilo1" colspan="5">RESUMEN DE FACTURAS</td>
 </tr>

 <tr>
   <td  class="Estilo1">N°</td>
   <td  class="Estilo1">FOLIO</td>
   <td  class="Estilo1">N°DOC</td>
   <td  class="Estilo1">MONTO $</td>
   <td  class="Estilo1">RESERVA $</td>
   <td  class="Estilo1">MONTO <? echo $nombremoneda2 ?></td>
   <td  class="Estilo1">DESCRIPCION PAGO</td>
 </tr>
 </thead>
 <tbody>
<?
/*
echo
$row["fac_valortipo"];
$row["fac_fechatipo"];
$row["fac_valortipo2"];
$row["fac_fechatipo2"];
$row["fac_valortipo3"];
$row["fac_fechatipo3"];
$row["fac_montotipo2"];
$row["fac_montotipo3"];
*/


for ($i=1;$i<=12;$i++) {
   $dato2[$i]=0;
}
//   $sql2 = "Select *, (hono_montotipo) as fac_valortipo2,(hono_montotipo2) as fac_valortipo3 from dpp_contratos x, dpp_cont_fac y, dpp_honorarios z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and confa_tipodoc='h'  and y.confa_fac_id=z.hono_id and z.hono_eta_id=w.eta_id  and w.eta_estado=8 order by w.eta_folio desc ";
//   echo $sql2."<br><br>";

if (1==2) {
     $cont_id=$row["cont_id"];
//   Honorario
    if ($tipodoc==2 and 1==2) {
     $sql2 = "Select *, (hono_montotipo) as fac_valortipo2,(hono_montotipo2) as fac_valortipo3 from dpp_contratos x, dpp_cont_fac y, dpp_honorarios z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and confa_tipodoc='h'  and y.confa_fac_id=z.hono_id and z.hono_eta_id=w.eta_id  and w.eta_estado=>2 order by w.eta_folio desc ";
    }
    if ($tipodoc==1 and 1==2) {
//    Factura
     $sql2 = "Select *, (fac_valortipo) as fac_valortipo from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and fac_eta_id=w.eta_id and year(w.eta_fechache)='$anno2' and  w.eta_estado<10 and confa_tipodoc='f' and w.eta_estado>=2 order by w.eta_folio desc ";
    }


//   exit();
   $res2 = mysql_query($sql2);
   $cont=1;
//------------- aqui empieza 1 honorario  ---------------

 //  $sql2 = "Select *, (hono_montotipo) as fac_valortipo2,(hono_montotipo2) as fac_valortipo3 from dpp_contratos x, dpp_cont_fac y, dpp_honorarios z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and confa_tipodoc='h'  and y.confa_fac_id=z.hono_id and z.hono_eta_id=w.eta_id  and w.eta_estado=8 order by w.eta_folio desc ";
//   echo $sql2."<br><br>";
   $res2 = mysql_query($sql2);
   while($row2 = mysql_fetch_array($res2)){
        $fechache=substr($row2["eta_fechache"],0,4);
        $estilo=$cont%2;
        if ($estilo==0) {
          $estilo2="Estilo1mc";
        } else {
          $estilo2="Estilo1mcblanco";
        }

      $etaid=$row2["eta_id"];
     $sql33="select * from dpp_fondoreserva where fres_cont_id=$id and fres_eta_id=$etaid and fres_tipo='abono' ";
  //   echo $sql33;
     $res33 = mysql_query($sql33);
     $row33 = mysql_fetch_array($res33);
     $fresmonto=$row33["fres_monto"];



       $mes=substr($row2["eta_fechache"],5,2);
       $mes=$mes*1;
       $dato1[$mes]=$mes;

       $dato2[$mes]=$row2["eta_monto2"]+$dato2[$mes];
//       echo $dato2[$mes]."--$mes<br>";
//       echo $conttipo2;

  $positivo=1;
  $eta_tipo_doc3=$row2["eta_tipo_doc3"];
  if ($eta_tipo_doc3=='NC' or $eta_tipo_doc3=='NCEL') {
       $positivo=-1;
   }


//-- Peso
if ($conttipo2==1) {
   $contvcuota =$row["cont_anual"]/12;
   $monto2=$row2["eta_monto2"];
   $contvcuota =($row["cont_total"]/$row["cont_nrocuotas"])*$row2["fac_valortipo"];
   $total2=$total2+($monto2*$positivo);
}
//-- Dolar
if ($conttipo2==2) {
   $contvcuota =$row2["cont_anual"]/12;
   $total2=$total2+$contvcuota;
}
//-- UTM
if ($conttipo2==3) {
   $contvcuota =$row["cont_anual"]/12;
   $monto2=$row2["eta_monto2"]/$row2["fac_valortipo2"];
   $contvcuota =($row["cont_total"]/$row["cont_nrocuotas"])*$row2["fac_valortipo2"];
//   echo $row["cont_total"]."/".$row["cont_nrocuotas"].")*".$row2["fac_valortipo2"];
   $total2=$total2+($monto2*$positivo);
}
//-- UF
if ($conttipo2==4) {
   $contvcuota =$row["cont_anual"]/12;
   $monto2=$row2["eta_monto2"]/$row2["fac_valortipo3"];
   $contvcuota =($row["cont_total"]/$row["cont_nrocuotas"])*$row2["fac_valortipo3"];
//   echo $row["cont_total"]."/".$row["cont_nrocuotas"].")*".$row2["fac_valortipo3"];
   $total2=$total2+($monto2*$positivo);

}




?>
 <tr  class=""  id="<? echo $cont ?>">
   <td  class="<? echo $estilo2 ?>">
   <? echo $cont; ?>
    <input id="b<? echo $cont ?>" type="hidden" name="var[<? $cont ?>]" value="<? echo $row2["eta_id"] ?>" >
   </td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["eta_folio"] ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["eta_numero"] ?></td>
   <td  class="Estilo1d"><? echo number_format($row2["eta_monto2"],0,',','.') ?></td>
   <td  class="Estilo1d"><? echo number_format($fresmonto-$fresmonto2,0,',','.') ?></td>
   <td  class="Estilo1d"> <a href="javascript:void(0)" onclick="window.open('contrato_fichamoneda.php?action=ficha1&id=<? echo $row['cont_id']; ?>&facid=<? echo $row2["fac_valortipo3"] ?>&ori=2&tipodoc=<? echo $tipodoc ?>','','width=540,height=600,scrollbars=1,location=1')"> <? echo number_format($monto2,0,',','.') ?></a></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["eta_servicio_final"] ?></td>
  </tr>

<?
     $total3=$total3+($row2["eta_monto2"]*$positivo);
     $cont++;
    }

}
//------------------------------------

//------------- aqui empieza 2  facturas ---------------
   $sql2 = "Select *, (fac_valortipo) as fac_valortipo from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and fac_eta_id=w.eta_id and (w.eta_estado>=3 and w.eta_estado<=15) and confa_tipodoc='f'  order by w.eta_folio desc ";
//   $sql2 = "Select *, (fac_valortipo) as fac_valortipo from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and fac_eta_id=w.eta_id and (year(w.eta_fechache)='$anno2' or year(w.eta_fecha_aprobacionok)='$anno2') and  (w.eta_estado>=3 and w.eta_estado<=15) and confa_tipodoc='f'  order by w.eta_folio desc ";
   $res2 = mysql_query($sql2);
//   echo $sql2."<br><br>";
   $total2=0;
   $cont=1;
   while($row2 = mysql_fetch_array($res2)){
        $fechache=substr($row2["eta_fechache"],0,4);
        $estilo=$cont%2;
        if ($estilo==0) {
          $estilo2="Estilo1mc";
        } else {
          $estilo2="Estilo1mcblanco";
        }
     $fresmonto0215=$row2["cont_freserva2015"];


     $etaid=$row2["eta_id"];
     $sql33="select * from dpp_fondoreserva where fres_cont_id=$id and fres_eta_id=$etaid and fres_tipo='abono' ";
 //    echo $sql33;
     $res33 = mysql_query($sql33);
     $row33 = mysql_fetch_array($res33);
     $fresmonto=$row33["fres_monto"];
       $mes=substr($row2["eta_fechache"],5,2);
       $mes=$mes*1;
       $dato1[$mes]=$mes;

       $dato2[$mes]=$row2["eta_monto2"]+$dato2[$mes];
//       echo $dato2[$mes]."--$mes<br>";
//       echo $conttipo2;

  $positivo=1;
  $eta_tipo_doc3=$row2["eta_tipo_doc3"];
  if ($eta_tipo_doc3=='NC' or $eta_tipo_doc3=='NCEL') {
       $positivo=-1;
   }


//-- Peso
//echo $conttipo2;
if ($conttipo2==1) {
   $contvcuota =$row["cont_anual"]/12;
   $monto2=$row2["eta_monto2"];
   $contvcuota =($row["cont_total"]/$row["cont_nrocuotas"])*$row2["fac_valortipo"];
   $total2=$total2+($monto2*$positivo);
   
}
//-- Dolar
if ($conttipo2==2) {
//   $contvcuota =$row2["cont_anual"]/12;
   
   $monto2=$row2["fac_montotipo3"];
   $total2=$total2+$monto2;
}
//-- UTM
if ($conttipo2==3) {
   $monto2=$row2["fac_montotipo2"];
   $total2=$total2+($monto2*$positivo);
}
//-- UF
if ($conttipo2==4) {
   $monto2=$row2["fac_montotipo"];
   $total2=$total2+($monto2*$positivo)+$total3;
}

?>
 <tr  class=""  id="<? echo $cont ?>">
   <td  class="<? echo $estilo2 ?>">
   <? echo $cont; ?>
    <input id="b<? echo $cont ?>" type="hidden" name="var[<? $cont ?>]" value="<? echo $row2["eta_id"] ?>" >
   </td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["eta_folio"] ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["eta_numero"] ?></td>
   <td  class="Estilo1d"><? echo number_format($row2["eta_monto2"],0,',','.') ?></td>
   <td  class="Estilo1d"><? echo number_format($fresmonto,0,',','.') ?></td>
   <td  class="Estilo1d"> <a href="javascript:void(0)" onclick="window.open('contrato_fichamoneda.php?action=ficha1&id=<? echo $row['cont_id']; ?>&facid=<? echo $row2["fac_id"] ?>&ori=2&tipodoc=<? echo $tipodoc ?>','','width=540,height=600,scrollbars=1,location=1')"> <? echo number_format($monto2,0,',','.') ?></a></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["eta_servicio_final"] ?></td>
  </tr>

<?
     $total1=$total1+($row2["eta_monto2"]*$positivo);
     $total3=$total3+($fresmonto);
     $cont++;
    }

//------------------------------------

?>
  <tr  class="">
   <td  colspan=3>Totales</td>
   <td  class="Estilo1d"><? echo number_format($total1,0,',','.') ?></td>
   <td  class="Estilo1d"><? echo number_format($total3,0,',','.') ?></td>
   <td  class="Estilo1d"><? echo number_format($total2,0,',','.') ?></td>
  </tr>
 </tbody>
</table>

<hr>
<table border=0 width="100%">
 <thead>
 <tr>
   <td  class="Estilo1" colspan="2">RESUMEN MULTAS Y PAGOS</td>
   <td  class="Estilo1" colspan="1">
<?

if ($nivel==5) {

?>
      <a href="javascript:void(0)" onclick="window.open('contrato_multas.php?id=<? echo $row['cont_id']; ?>&anno=<? echo $fechache ?>','','width=540,height=500,scrollbars=1,location=1')">AGREGAR</a>
<?
}
?>
   </td>
 </tr>

 <tr>
   <td  class="Estilo1">N°</td>
   <td  class="Estilo1">FECHA</td>
   <td  class="Estilo1">MONTO $</td>
   <td  class="Estilo1">TIPO</td>
   <td  class="Estilo1">Eli.</td>
 </tr>
 </thead>
 <tbody>
<?
   $sql23 = "Select * from dpp_fondoreserva where fres_cont_id=$id and fres_tipo<>'abono' ";
   $res23 = mysql_query($sql23);
 //  echo $sql23."<br><br>";
   $cont23=1;
   while($row23 = mysql_fetch_array($res23)){
    $freservacargo=$freservacargo+$row23["fres_monto"];
?>
   <tr>
      <td  class="Estilo1"><? echo $cont23 ?></td>
      <td  class="Estilo1"><? echo $row23["fres_fecha"] ?></td>
      <td  class="Estilo1d"><? echo number_format($row23["fres_monto"],0,',','.') ?></td>
      <td  class="Estilo1"><? echo $row23["fres_tipo"] ?></td>
<?
if ($nivel==5) {
?>
      <td  class="Estilo1c"><a href="vercontrato82.php?fresid=<? echo $row23["fres_id"] ?>&id=<? echo $id ?>&tipodoc=<? echo $tipodoc ?>&region2=<? echo $region2 ?>&sw=2" class="link" title="Eliminar " onclick="return confirm('Seguro que desea Eliminar ?')"><img src="imagenes/b_drop.png" width="20" height="20" border=0></a> </td>
<?
}
?>
   </tr>
<?
  $cont23++;
}
?>
 </tbody>
 </table>
 <br>
 
<?
          $sql33="select sum(fres_monto) as totalfresabono from dpp_fondoreserva where fres_cont_id=$id and fres_tipo='abono'  ";
//        echo $sql33;
          $res33 = mysql_query($sql33);
          $row33 = mysql_fetch_array($res33);
          $freservaabono=$row33["totalfresabono"];

?>
<table border=0 width="100%">
 <thead>
 <tr>
   <td  class="Estilo1" colspan="2">


<h3 align="center">
 TOTAL FONDO RESERVA $ <? echo number_format(($freservaabono+$fresmonto0215)-$freservacargo,0,'.','.') ?>
</h3>
 
 </td>
<tr>
</table>

 </div>


 <div  style="width:445px; height:560px; background-color:#FFFFFF; position:absolute; top:50px; left:455px;border-right-style: ridge;border-top-style: ridge;border-bottom-style: ridge" id="div1">
<?


?>


<br>
<br>
<table border=0 width="100%">


   <div id="seccion1" style="background-color:#E0F8F7;" >
<table border=0 width="100%">
 <tr>
   <td  class="Estilo1" colspan="3">RESUMEN POR AÑO</td>
 </tr>

 <tr>
   <td  class="Estilo1">AÑO</td>
   <td  class="Estilo1">MONTO</td>
   <td  class="Estilo1">RESERVA</td>
   <td  class="Estilo1">MONTO <? echo $nombremoneda2 ?></td>
   <td  class="Estilo1">COMPROMISO</td>
   <td  class="Estilo1">SALDO</td>
 </tr>

<?
   $strXMLA="<chart caption='Ejecucion de Facturas' xAxisName='Meses' yAxisName='Montos' showValues= '0' numberPrefix='$' formatNumberScale='0'>";
   $strXMLB="<categories>";
   $strXMLC="<dataset seriesName='Anual'>";

    if ($tipodoc==2) {
       $sql2b = "Select *, sum(w.eta_monto2) as monto, avg(z.hono_valortipo) as promeuf, avg(z.hono_valortipo2) as promeutm from dpp_contratos x, dpp_cont_fac y, dpp_honorarios z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=hono_id and hono_eta_id=w.eta_id and (w.eta_estado>=3 and w.eta_estado<=15) and confa_tipodoc='h' and w.eta_tipo_doc3='NC' group by year(w.eta_fechache) order by year(w.eta_fechache) asc ";
    }
    if ($tipodoc==1) {
       $sql2b = "Select *, sum(w.eta_monto2) as monto, avg(z.fac_valortipo) as promeuf, avg(z.fac_valortipo2) as promeutm from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and fac_eta_id=w.eta_id and (w.eta_estado>=3 and w.eta_estado<=5) and confa_tipodoc='f' and w.eta_tipo_doc3='NC' group by year(w.eta_fechache) order by year(w.eta_fechache) asc ";
    }

/*
 echo $sql2b;
 $res2b = mysql_query($sql2b);
     while ($row2b = mysql_fetch_array($res2b)) {
     }
*/
    if ($tipodoc==2) {
       $sql2 = "Select *, sum(w.eta_monto2) as monto, avg(z.hono_valortipo) as promeuf, avg(z.hono_valortipo2) as promeutm from dpp_contratos x, dpp_cont_fac y, dpp_honorarios z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=hono_id and hono_eta_id=w.eta_id and (w.eta_estado>=3 and w.eta_estado<=15) and confa_tipodoc='h' and w.eta_tipo_doc3<>'NC' group by year(w.eta_fechache) order by year(w.eta_fechache) asc ";
    }
    if ($tipodoc==1) {
       $sql2 = "Select *, sum(w.eta_monto2) as monto, sum(z.fac_montotipo) as promeuf, sum(z.fac_montotipo2) as promeutm, sum(z.fac_montotipo3) as promedolar from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and fac_eta_id=w.eta_id and  confa_tipodoc='f' and (w.eta_estado>=3 and w.eta_estado<=15) and w.eta_tipo_doc3<>'NC' group by year(w.eta_fechache) order by year(w.eta_fechache) asc ";
//       $sql2 = "Select *, sum(w.eta_monto2) as monto, sum(z.fac_montotipo) as promeuf, sum(z.fac_montotipo2) as promeutm, sum(z.fac_montotipo3) as promedolar from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and fac_eta_id=w.eta_id and w.eta_estado=8 and confa_tipodoc='f' and w.eta_tipo_doc3<>'NC' group by year(w.eta_fechache) order by year(w.eta_fechache) asc ";
    }
       $sql2 = "Select *, sum(w.eta_monto2) as monto, sum(z.fac_montotipo) as promeuf, sum(z.fac_montotipo2) as promeutm, sum(z.fac_montotipo3) as promedolar from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and fac_eta_id=w.eta_id and confa_tipodoc='f' and (w.eta_estado>=3 and w.eta_estado<=15) and (w.eta_tipo_doc3<>'NC' and w.eta_tipo_doc3<>'NCEL') group by year(w.eta_fechache) order by year(w.eta_fechache) asc ";
//     echo $sql2."<br><br>";
//   exit();
     $res2 = mysql_query($sql2);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
     $row22["monto"]=0;
//----- Comienza nota de credito ----------
     $fechache=substr($row2["eta_fechache"],0,4);
     $sql22 = "Select *, sum(w.eta_monto2) as monto, sum(z.fac_montotipo) as promeuf, sum(z.fac_montotipo2) as promeutm, sum(z.fac_montotipo3) as promedolar from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_region='$regionsession' and x.cont_id=$id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and fac_eta_id=w.eta_id  and confa_tipodoc='f' and (w.eta_estado>=3 and w.eta_estado<=15) and (w.eta_tipo_doc3='NC' or w.eta_tipo_doc3='NCEL') and year(w.eta_fechache)='$fechache' group by year(w.eta_fechache) order by year(w.eta_fechache) asc ";
//     echo $sql22."<br><br>";
//   exit();
     $res22 = mysql_query($sql22);
     $row22 = mysql_fetch_array($res22);


//----- Termina nota de credito ------------


       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo1mc";
       } else {
          $estilo2="Estilo1mcblanco";
       }
         $fechache=substr($row2["eta_fechache"],0,4);
        if ($fechache==2011) {
          $compromiso=$row["cont_ejec2011"];
       }
       if ($fechache==2012) {
          $compromiso=$row["cont_ejec2012"];
       }
       if ($fechache==2013) {
          $compromiso=$row["cont_ejec2013"];
       }
       if ($fechache==2014) {
          $compromiso=$row["cont_ejec2014"];
       }
       if ($fechache==2015) {
          $compromiso=$row["cont_ejec2015"];
          $freservaanno=$fresmonto0215;
       }
       if ($fechache==2016) {
          $compromiso=$row["cont_ejec2016"];
          $sql33="select sum(fres_monto) as totalfres from dpp_fondoreserva where fres_cont_id=$id and fres_tipo='abono' and fres_anno=2016 ";
//        echo $sql33;
          $res33 = mysql_query($sql33);
          $row33 = mysql_fetch_array($res33);
          $freservaanno=$row33["totalfres"];

          
       }
       if ($fechache==2017) {
          $compromiso=$row["cont_ejec2017"];
          $sql33="select sum(fres_monto) as totalfres from dpp_fondoreserva where fres_cont_id=$id and fres_tipo='abono' and fres_anno=2016 ";
//        echo $sql33;
          $res33 = mysql_query($sql33);
          $row33 = mysql_fetch_array($res33);
          $freservaanno=$row33["totalfres"];

       }
       if ($fechache==2018) {
          $compromiso=$row["cont_ejec2018"];
       }
       if ($fechache==2019) {
          $compromiso=$row["cont_ejec2019"];
       }
       if ($fechache==2020) {
          $compromiso=$row["cont_ejec2020"];
       }
       
   $strXMLB.="<category label='".$fechache."' />";
   $strXMLC.="<set value='".$row2["monto"]."' />";


       
//echo "--->".$conttipo2;
//-- Peso
if ($conttipo2==1) {
   $promedio =$row2["monto"]-$row22["monto"];
}
//-- Dolar
if ($conttipo2==2) {
    $promedio =$row2["promedolar"]-$row22["promedolar"];
//   $promedio =$row2["monto"]/$row2["promeuf"];
}
//-- UTM
if ($conttipo2==3) {
   $promedio =$row2["promeutm"]-$row22["promeutm"];
//   $promedio =$row2["monto"]/$row2["promeutm"];

}
//-- UF
if ($conttipo2==4) {
   $promedio =$row2["promeuf"]-$row22["promeuf"];
//   $promedio =$row2["monto"]/$row2["promeuf"];

}


?>
 <tr>
   <td  class="<? echo $estilo2 ?>"><? echo $fechache; ?></td>
   <td  class="Estilo1d"><? echo number_format($row2["monto"]-$row22["monto"],0,',','.') ?></td>
   <td  class="Estilo1d"><? echo number_format($freservaanno,0,',','.') ?></td>
   <td  class="Estilo1d"><? echo number_format($promedio,0,',','.') ?></td>
   <td  class="Estilo1d">
   <a href="javascript:void(0)" onclick="window.open('contrato_presupuesto.php?id=<? echo $row['cont_id']; ?>&anno=<? echo $fechache ?>','','width=540,height=400,scrollbars=1,location=1')"><? echo number_format($compromiso,0,',','.') ?></a>
   </td>
   <td  class="Estilo1d"><? echo number_format($compromiso-($row2["monto"]-$row22["monto"]),0,',','.') ?></td>
  </tr>

<?

     $cont++;
     $total2g=$total2g+$row2["monto"]-$row22["monto"];
     $total3g=$total3g+($promedio);
     $freservaannotot=$freservaannotot+$freservaanno;
     $sumapromedio=$sumapromedio+$promedio;
    }

    
    
?>
 <tr>
   <td  class="<? echo $estilo2 ?>">Totales</td>
   <td  class="Estilo1d" colspan="1"><? echo number_format($total2g,0,',','.') ?></td>
   <td  class="Estilo1d" colspan="1"><? echo number_format($freservaannotot,0,',','.') ?></td>
   <td  class="Estilo1d" colspan="1"><? echo number_format($sumapromedio,0,',','.') ?></td>
  </tr>
</table>
<br>
<table>
 <tr>
   <td  class="<? echo $estilo2 ?>">Total Contrato</td>
   <td  class="Estilo1d" colspan="1"><? echo number_format($row["cont_total"],0,',','.') ?> </td>
  </tr>
 <tr>
   <td  class="<? echo $estilo2 ?>">Ejecutado</td>
   <td  class="Estilo1d" colspan="1"><? echo number_format($total3g*100/$row["cont_total"],0,',','.') ?> %</td>
  </tr>


</table>
<br>
<hr>
 <br>

<table border=0 width="100%">
 <tr>
   <td  class="Estilo1" colspan="2">DETALLE FACTURA</td>
 </tr>

 <tr>
   <td  class="Estilo1">FOLIO</td>
   <td  class="Estilo1" id="folio"></td>
   <td  class="Estilo1">DESCRIPCION</td>
   <td  class="Estilo1" id="descripcion"></td>
 </tr>
 <tr>
   <td  class="Estilo1" >N°</td>
   <td  class="Estilo1" id="numero"></td>
   <td  class="Estilo1">FECHA PAGO</td>
   <td  class="Estilo1" id="fpago"></td>
 </tr>
 <tr>
   <td  class="Estilo1">RUT</td>
   <td  class="Estilo1" id="rut"></td>
   <td  class="Estilo1">DOCTO</td>
   <td  class="Estilo1" id="">
     <a href="" class="link" id="ifac" target="_blank"><div id="verlink"></div></a>
   </td>
 </tr>
 <tr>
   <td  class="Estilo1">PROVEEDOR</td>
   <td  class="Estilo1" id="proveedor"></td>
   <td  class="Estilo1">ORDEN</td>
   <td  class="Estilo1" id="">
      <a href="" class="link" id="iorden" target="_blank"><div id="verlink2"></div></a>
   </td>
 </tr>
 <tr>
   <td  class="Estilo1">MONTO </td>
   <td  class="Estilo1" id="monto"></td>
   <td  class="Estilo1">RESOLUCION</td>
   <td  class="Estilo1" id="">
     <a href="" class="link" id="ires" target="_blank"><div id="verlink3"></div></a>
   </td>
 </tr>
 <!--      Agregar la imagen del pago en pago
 <tr>
   <td  class="Estilo1">NETO</td>
   <td  class="Estilo1" id="neto"></td>
   <td  class="Estilo1">PAGO</td>
   <td  class="Estilo1" id="pago"></td>
 </tr>
-->

</table>

<br>
<hr>


 </div>

</div>


<div  style="width:400px; height:300px; background-color:#E0F8F7; position:absolute;  top:0px; left:910px; content:''; z-index:1; " id="div2">
<!-- <div  style="width:1030px; height:400px; background-color:#E0F8F7; position:absolute; top:325px; left:710px; overflow: scroll " id="div2"> -->

        <?php


                        //Initialize <chart> element
                        $strXML = "<chart caption='Tareas Vigentes' labelDisplay='ROTATE' slantLabels='1'  numberPrefix='' formatNumberScale='0' rotateValues='1' placeValuesInside='0' decimals='0'  numberSuffix=' '>";
             //           $strXML .= "<set label='" . $ors['uno'] . "' value='" . $ors['total'] . "' link='" . urlencode("Detailed.php?FactoryId=" . $ors['FactoryId']) . "'/>";

                        //Initialize <categories> element - necessary to generate a multi-series chart
                        $strCategories = "<categories>";

                        //Initiate <dataset> elements
                        $strDataCurr = "<dataset seriesName='Asignacion'>";
                        $strDataPrev = "<dataset seriesName='Responsable'>";

                        //Iterate through the data
                        $j=0;
                        foreach ($arrData as $arSubData) {
                            //Append <category name='...' /> to strCategories
                            $strCategories .= "<category name='" . $arSubData[1] . "' />";
                            //Add <set value='...' /> to both the datasets
                            $strDataCurr .= "<set value='" . $arSubData[2] . "' link='" . urlencode("sisap_carga2.php?user1=" . $arrData[$j][1]) . "'/>";
                            $strDataPrev .= "<set value='" . $arSubData[3] . "' link='" . urlencode("sisap_carga2.php?user1=" . $arrData[$j][1]) . "'/>";
                            $j++;
                        }
                        

                        //Close <categories> element
                        $strCategories .= "</categories>";

                        //Close <dataset> elements
                        $strDataCurr .= "</dataset>";
                        $strDataPrev .= "</dataset>";

                        //Assemble the entire XML now
                        $strXML .= $strCategories . $strDataCurr . $strDataPrev . "</chart>";

   $strXML = "<chart caption='Tareas Vigentes' labelDisplay='ROTATE' slantLabels='1'  numberPrefix='' formatNumberScale='0' rotateValues='1' placeValuesInside='0' decimals='0'  numberSuffix=' '>";
   $strXML22="<chart caption='Ejecucion de Facturas' xAxisName='Meses' yAxisName='Montos' showValues= '0' numberPrefix='$' formatNumberScale='0'>
   <categories>
      <category label='Ene' />
      <category label='Feb' />
      <category label='Mar' />
      <category label='Abr' />
      <category label='May' />
      <category label='Jun' />
      <category label='Jul' />
      <category label='Ago' />
      <category label='Sep' />
      <category label='Oct' />
      <category label='Nov' />
      <category label='Dicc' />
   </categories>
   <dataset seriesName='".$anno2."'>
      <set value='".$dato2[1]."' />
      <set value='".$dato2[2]."'/>
      <set value='".$dato2[3]."' />
      <set value='".$dato2[4]."' />
      <set value='".$dato2[5]."' />
      <set value='".$dato2[6]."' />
      <set value='".$dato2[7]."' />
      <set value='".$dato2[8]."' />
      <set value='".$dato2[9]."' />
      <set value='".$dato2[10]."' />
      <set value='".$dato2[11]."' />
      <set value='".$dato2[12]."' />
   </dataset>
   <dataset seriesName='VCuota'>
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
      <set value='".$contvcuota."' />
   </dataset>


</chart>";



                        

                        //Create the chart - MS Column 3D Chart with data contained in strXML
                        FC_SetRenderer( "javascript" );
                        echo renderChart("grafico/MSLine.swf", "", $strXML22, "Chart1", 400, 300, false, false);

?>

</div>



<div  style="width:400px; height:300px; background-color:#E0F8F7; position:absolute;  top:310px; left:910px; z-index:1;" id="div4">
<?php


//   $strXML = "<chart caption='Tareas Vigentes' labelDisplay='ROTATE' slantLabels='1'  numberPrefix='' formatNumberScale='0' rotateValues='1' placeValuesInside='0' decimals='0'  numberSuffix=' '>";
//   $strXML222="<chart caption='Ejecucion de Facturas' xAxisName='Meses' yAxisName='Montos' showValues= '0' numberPrefix='$' formatNumberScale='0'>"";


   
   $strXMLB.="</categories>";
   $strXMLC.="</dataset>";

   $strXMLD="</chart>";

   $strXML222=$strXMLA.$strXMLB.$strXMLC.$strXMLD;



                        //Create the chart - MS Column 3D Chart with data contained in strXML
                        FC_SetRenderer( "javascript" );
                        echo renderChart("grafico/MSLine.swf", "", $strXML222, "Chart2", 400, 300, false, false);

                        echo   $strXML222;
?>


</div>






</body>
</html>


