<?php
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

//error_reporting(E_ALL);
$fechamia=date('Y-m-d');
$annomia=date('Y');
$fechamia2=date('d-m-Y');
$hora=date("H:i");



$numsigfe=$_POST["numsigfe"];
$descripsigfe=$_POST["descripsigfe"];
$cargosigfe=$_POST["cargosigfe"];
$abonosigfe=$_POST["abonosigfe"];




$numero=$_POST["numero"];
if (isset($_GET["numero"])) {
   $numero=$_GET["numero"];
}

header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>bienvenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/stylo_defensoriapenal2.css" rel="stylesheet" type="text/css">

</head>

<body>

<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
  <script type="text/javascript" src="jquery/jquery.min.js"></script>
<style type="text/css">
<!--
  .Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right !important;;
}
-->
</style>

<script>
<!--



function valida() {
//      alert ("Entra ");
  var c1=document.form22.totalfactura.value;
  var c2=document.form22.totalfactura3.value;
  var tc=document.form22.totalcartola.value;
  
  var s1=document.form22.totalfactura2.value;
  var s2=document.form22.totalfactura4.value;
  var ts=document.form22.totalsigfe.value;
  
  var totalgeneral=Math.abs(tc)-Math.abs(ts);
  if ((c1=='' || c1=='0') && (c2=='' || c2=='0') && (tc=='' || tc == '0') && (s1=='' ) && (s2=='' ) && (ts=='' ) ) {
//  if ((c1=='' || c1=='0') && (c2=='' || c2=='0') && (tc=='' || tc == '0') && (s1=='' || s1=='0') && (s2=='' || s2=='0') && (ts=='' || ts == '0') ) {
      alert ("No hay datos seleccionados 1 ");
      return false;
  }
  if (((c1=='' || c1=='0') && (c2=='' || c2=='0') && (tc=='' || tc == '0')) && ts != '0' ) {
      alert ("Monto Sigfe no Cuadran ");
      return false;
  }
  if (((((s1=='' || s1=='0') && (s2=='' || s2=='0') && (ts=='' || ts == '0')) && tc != '0' )) && (ts != '0')) {
      alert ("Monto Cartola no Cuadran "+ts+"<--"+tc);
      return false;
  }
  if (totalgeneral != '0' ) {
      alert ("Total general no cuadra ");
      return false;
  }


      return true

}



-->
</script>
<script type="text/javascript">
//<![CDATA[
$(window).load(function(){
$('tr').bind('mouseover mouseout', function() {
    $(this).toggleClass("hover");
});

$('tr').bind('click', function() {
    $(this).toggleClass("active");
//    if (event.target.type !== 'checkbox') {
//        $(this).find("input[type=checkbox]").prop("checked", (!$(this).find("input[type=checkbox]").prop("checked")) );
//    }
});

$("input").bind( "click", function() {
//    alert($(this).val());
      var a=($(this).val());
      var arreglo=a.split("|");

// inicializacion de variables
     var c=0;
     var c2=0;
     var b=0;
     var d=0;
     var d2=0;
     var e=0;

      var a=arreglo[0];
      var dos=arreglo[1];

     var cue1=document.getElementById("cuenta1").value;
     var cue2=document.getElementById("cuenta2").value;
     var a = parseInt(a);
     var cue1 = parseInt(cue1);
     var cue2 = parseInt(cue2);
//      alert(a +" < "+cue1 );
      if (a<cue1) {
        var c=document.getElementById("a"+a).value;
        var cc=document.getElementById("aa"+a).value;
        var b=document.getElementById("b"+a).checked;
//        alert("entra2 "+dos);
      } else if (a<cue2) {
         var d=document.getElementById("d"+a).value;
         var dd=document.getElementById("dd"+a).value;
         var e=document.getElementById("e"+a).checked;
      }

//      var b = parseInt(b);
//      var dos = parseInt(dos);
//      alert (b+" "+dos);
    
    
    if  (b && dos==1) {
//         alert(c);
//         alert(b);
         document.form22.totalfactura.value=Math.round(document.form22.totalfactura.value)+Math.round(c);
         document.form22.totalfactura3.value=Math.round(document.form22.totalfactura3.value)+Math.round(cc);
         document.form22.totalcartola.value=Math.round(document.form22.totalfactura.value)-Math.round(document.form22.totalfactura3.value);
    }
    if  (!b && dos==1) {
//         alert(c);
//         alert(b);
         document.form22.totalfactura.value=Math.round(document.form22.totalfactura.value)-Math.round(c);
         document.form22.totalfactura3.value=Math.round(document.form22.totalfactura3.value)-Math.round(cc);
         document.form22.totalcartola.value=Math.round(document.form22.totalfactura.value)-Math.round(document.form22.totalfactura3.value);
    }
    
    
    if  (e && dos==2) {
//         alert(e);
//         alert(d);
         document.form22.totalfactura2.value=Math.round(document.form22.totalfactura2.value)+Math.round(d);
         document.form22.totalfactura4.value=Math.round(document.form22.totalfactura4.value)+Math.round(dd);
         document.form22.totalsigfe.value=Math.round(document.form22.totalfactura2.value)-Math.round(document.form22.totalfactura4.value);
    }
    if  (!e && dos==2) {
//         alert(e);
//         alert(d);
         document.form22.totalfactura2.value=Math.round(document.form22.totalfactura2.value)-Math.round(d);
         document.form22.totalfactura4.value=Math.round(document.form22.totalfactura4.value)-Math.round(dd);
         document.form22.totalsigfe.value=Math.round(document.form22.totalfactura2.value)-Math.round(document.form22.totalfactura4.value);
    }


});

});//]]>

<!--
    function suma(a,b) {
       alert(a);
//         alert(document.form22["var["+b+"]"].checked);
         var c= document.form22["var["+b+"]"].checked;
//         alert (c);
         if  (c) {
            document.form22.totalfactura.value=Math.round(document.form22.totalfactura.value)+Math.round(a);
         }
         if  (!c) {
            document.form22.totalfactura.value=Math.round(document.form22.totalfactura.value)-Math.round(a);
         }
//        cantidad=Math.round(document.form22.totalfactura.value/document.form22.cantidad.value);
//        document.form22.totalfactura2.value=cantidad*document.form22.cantidad.value;
//         alert(cantidad);
   }


   function ejectua() {
       document.form2.numsigfe.value=document.form22.numsigfe.value;
       document.form2.descripsigfe.value=document.form22.descripsigfe.value;
       document.form2.cargosigfe.value=document.form22.cargosigfe.value;
       document.form2.abonosigfe.value=document.form22.abonosigfe.value;
       document.form2.submit();
   }
   function ejectua2() {
       document.form2.numsigfe.value="";
       document.form2.descripsigfe.value="";
       document.form2.cargosigfe.value="";
       document.form2.abonosigfe.value="";
       document.form2.submit();
   }

   -->
</script>
<?
     $sql=" select count(carto_id) as m11 from concilia_cartola where carto_estado='1' and carto_region='$regionsession'";
//     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m11=$row2["m11"];

      $sql=" select count(sigfe_id) as m22 from concilia_sigfe where sigfe_estado=1 and sigfe_region='$regionsession' ";
//     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m22=$row2["m22"];
     
         $sql2 = "Select * from regiones where codigo=$regionsession";
    //echo $sql;
    $res2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($res2);
    $activo4=$row2["activo4"];


?>


<div style="width:1130px; height:80px; background-color:#EEEEEE; position:absolute; top:0px; left:00px; z-index:3;border-right-style: ridge;border-top-style: ridge;border-left-style: ridge;border-bottom-style: ridge; ">
                     <a href="consolidacion_menu.php" class="link" > Volver </a>
<?
if ($activo4<>0) {
?>
<table width="100%">
 <tr>
 <td width="51%">
  <form name="form2" action="consolidacion_consolida2.php" method="post"   >
<table border=0 width="50%">
                         <tr>
                             <td  valign="top" class="Estilo1">CUENTA</td>
                             <td class="Estilo1">
                                <select name="numero" class="Estilo1" onchange="this.form.submit()">
                                   <option value="0">Seleccione...</option>
                                 <?
                                    $sql2 = "Select * from concilia_cc where cc_region=$regionsession ";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["cc_numero"] ?>" <? if ($row2["cc_numero"]==$numero) echo "selected=selected" ?> ><? echo $row2["cc_numero"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>
</table>
     <input type="hidden" name="numsigfe" value="" size="2" >
     <input type="hidden" name="descripsigfe" value="" size="2" >
     <input type="hidden" name="cargosigfe" value="" size="2" >
     <input type="hidden" name="abonosigfe" value="" size="2" >
</form>

</td>
<td width="49%">
<table>
 <tr>
   <td>
     <table border=0 width="100%">
      <tr>
        <td  class="Estilo1" colspan="1">Sin Consolidar Cartola</td>
        <td  class="Estilo1" colspan="1"><? echo $m11;  ?></td>
      </tr>
      <tr>
       <td  class="Estilo1" colspan="1">Sin Consolidar Sigfe</td>
       <td  class="Estilo1" colspan="1"><? echo $m22;  ?></td>
     </tr>
     <tr>
    </table>
   </td>
   <td width="10%">
   </td>
   <td >
      <a href="consolidacion_ordenado.php?numero=<? echo $numero ?>" class="link" > Procesar</a>  <br>
   </td>

 </tr>
</table>

      </td>
      </tr>
   </table>

</div>




<div  style="width:570px; height:530px; background-color:#EEEEEE; position:absolute; top:83px; left:00px;border-right-style: ridge;border-top-style: ridge;border-left-style: ridge;border-bottom-style: ridge;" id="div1">

<form name="form22" action="consolidacion_grabaconsolida2.php" method="post"   onSubmit="return valida()"  enctype="multipart/form-data">
        <input type="submit" value="Grabar Conciliación Manual">
<table border=0 width="100%">
  <tr>
   <td  class="Estilo2titulo" colspan="10">Cartola </td>
 </tr>
   <tr>
   <td  class="Estilo2titulo" colspan="5">Cargo <input type="text" name="totalfactura" readonly size=12></td>
   <td  class="Estilo2titulo" colspan="5">Abono <input type="text" name="totalfactura3" readonly size=12></td>
   <td  class="Estilo2titulo" colspan="5"> = </td>
   <td  class="Estilo2titulo" colspan="5"> <input type="text" name="totalcartola" readonly size=12></td>
 </tr>

</table>

<table border=0 width="100%">
    <thead>
     <tr class="">
        <th>OP.</th>
        <th>Fecha</th>
        <th>N°</th>
        <th>Descripcion</th>
        <th>Cargo</th>
        <th>Abono</th>
    </tr>
	</thead>
    <tbody>



<?
     $sql=" select * from concilia_cartola where carto_estado='1' and carto_numero='$numero' order by carto_fecha  ";
//     echo $sql2;
     $res2 = mysql_query($sql);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo1mc";
          $estilo2d="Estilo1mcd";
          $estilo2i="Estilo1mci";
       } else {
          $estilo2="Estilo1mcblanco";
          $estilo2d="Estilo1mcblancod";
          $estilo2i="Estilo1mcblancoi";
       }

?>
 <tr  class="">
   <td>
     <input id="b<? echo $cont ?>" type="checkbox" name="var3[<? echo $cont ?>]" value="<? echo $cont ?>|1" >
     <input id="a<? echo $cont ?>" type="hidden" name="va<? echo $cont ?>" value="<? echo $row2["carto_cargo"]; ?>">
     <input id="aa<? echo $cont ?>" type="hidden" name="va2<? echo $cont ?>" value="<? echo $row2["carto_abono"]; ?>">
     <input  type="hidden" name="var33[<? echo $cont ?>]" value="<? echo $row2["carto_id"]; ?>">
     <? echo $cont  ?>
   </td>
   <td><? echo substr($row2["carto_fecha"],8,2)."-".substr($row2["carto_fecha"],5,2)."-".substr($row2["carto_fecha"],0,4) ?></td>
   <td><? echo $row2["carto_operacion"] ?></td>
   <td><? echo $row2["carto_descripcion"] ?></td>
   <td class="Estilo1d"><? echo number_format($row2["carto_cargo"],0,',','.') ?></td>
   <td class="Estilo1d"><? echo number_format($row2["carto_abono"],0,',','.') ?></td>
  </tr>

<?
     $sumacartolacargo=$sumacartolacargo+$row2["carto_cargo"];
     $sumacartolaabono=$sumacartolaabono+$row2["carto_abono"];
     $cont++;
    }
  $cont1=$cont;
?>
 <tr  class="">
    <td class="Estilo1d" colspan=4>Totales</td>
    <td class="Estilo1d"><? echo number_format($sumacartolacargo,0,',','.') ?></td>
    <td class="Estilo1d"><? echo number_format($sumacartolaabono,0,',','.') ?></td>
 </tr>

    </tbody>
</table>



 </div>
<?

  if ($numero<>'') {

?>

<div  style="width:550px; height:530px; background-color:#EEEEEE; position:absolute; top:83px; left:580px;border-right-style: ridge;border-top-style: ridge;border-left-style: ridge;border-bottom-style: ridge" id="div1">

<br>
<table border=0 width="100%">
  <tr>
   <td  class="Estilo2titulo" colspan="10">Sigfe </td>
 </tr>
   <tr>
   <td  class="Estilo2titulo" colspan="5">Cargo<input type="text" name="totalfactura2" readonly size=12></td>
   <td  class="Estilo2titulo" colspan="5">Abono<input type="text" name="totalfactura4" readonly size=12></td>
   <td  class="Estilo2titulo" colspan="5"> = </td>
   <td  class="Estilo2titulo" colspan="5"><input type="text" name="totalsigfe" readonly size=12></td>
 </tr>

</table>

<table border=0 width="100%">
    <thead>
        <tr class="">
        <th>OP</th>
        <th>Fecha</th>
        <th>N°</th>
        <th>Descripcion</th>
        <th>Cargo</th>
        <th>Abono</th>
    </tr>
	</thead>
    <tbody>
    
 <tr  class="">
   <td>
   <input type="button" name="limpiarsigfe" value="Limpiar" onclick="ejectua2();" >
   <input type="button" name="enviarsigfe" value="Ir"  onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="fechasigfe" value="<? echo $fechasigfe ?>" size="2" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="numsigfe" value="<? echo $numsigfe ?>" size="2" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="descripsigfe" value="<? echo $descripsigfe ?>" size="20" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="cargosigfe" value="<? echo $cargosigfe ?>" size="4" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="abonosigfe" value="<? echo $abonosigfe ?>" size="4" onchange="ejectua();">
  </td>

 </tr>


<?
/*
//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' order by sigfe_fecha";
     $sql=" select *, sum(sigfe_abono) AS sigfe_abono, count(sigfe_id) as total from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and sigfe_cargo='0' GROUP BY sigfe_bene, sigfe_numdoc having total>1 order by sigfe_fecha";
//     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $wherenumdoc=" sigfe_numdoc in ( ";
     $wherebene=" sigfe_bene in ( ";

     while ($row2 = mysql_fetch_array($res2)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo1mc";
          $estilo2d="Estilo1mcd";
          $estilo2i="Estilo1mci";
       } else {
          $estilo2="Estilo1mcblanco";
          $estilo2d="Estilo1mcblancod";
          $estilo2i="Estilo1mcblancoi";
       }

       $wherenumdoc.= $row2["sigfe_numdoc"].",";
       $wherebene.= "'".$row2["sigfe_bene"]."',";
*/
?>
<!--
 <tr  class="">
   <td> <? echo $row2["total"] ?>
   <input id="e<? echo $cont ?>" type="checkbox" name="var4[<? echo $cont ?>]" value="<? echo $cont ?>|2" >
   <input id="d<? echo $cont ?>" type="hidden" name="va<? echo $cont ?>" value="<? echo $row2["sigfe_cargo"]; ?>">
   <input id="dd<? echo $cont ?>" type="hidden" name="va2<? echo $cont ?>" value="<? echo $row2["sigfe_abono"]; ?>">
   <input  type="hidden" name="var44[<? echo $cont ?>]" value="<? echo $row2["sigfe_id"]; ?>">
   <input  type="hidden" name="var45[<? echo $cont ?>]" value="<? echo $row2["sigfe_numdoc"]; ?>">
   <input  type="hidden" name="var46[<? echo $cont ?>]" value="<? echo $row2["sigfe_bene"]; ?>">
    <? echo $cont  ?></td>
   <td><? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td><? echo $row2["sigfe_numdoc"] ?></td>
   <td><? echo $row2["sigfe_bene"] ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_cargo"],0,',','.') ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_abono"],0,',','.') ?></td>

  </tr>
-->
<?
/*
     $cont++;

    }
     $wherenumdoc.=" 0 ) ";
     $wherebene.=" 'A' ) ";
*/
?>
 <tr  class="">
   <td colspan=10> &nbsp;  </td>

  </tr>
  
<?
/*

     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ($wherenumdoc and $wherebene and sigfe_cargo=0 ) order by sigfe_fecha";
//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ($wherenumdoc and $wherebene and sigfe_Abono<>0 ) order by sigfe_fecha";
//     $sql=" select *, sum(sigfe_abono) AS sigfe_abono, count(sigfe_id) as total from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' GROUP BY sigfe_bene, sigfe_numdoc having total>1 order by sigfe_fecha";
//     echo $sql."<br><br>";
     $res2 = mysql_query($sql);
//     $cont=1;
    $whereid=" sigfe_id in ( ";
     while ($row2 = mysql_fetch_array($res2)) {
         $whereid.=$row2["sigfe_id"].",";
     }

    $whereid.=" 0 ) ";
    
    
*/
$wherefiltro='';
$sw=0;
if ($numsigfe<>'') {
  $wherenum="";
   $partes = explode(" ", $numsigfe);
   $totalpartes = count($partes);
   for ($i=0;$i<$totalpartes;$i++) {
       $wherenum.=$partes[$i].",";
   }
   $wherenum.="'AAA'";
   
   $wherefiltro.="  sigfe_numdoc in ($wherenum) and  ";
   $sw=1;
}
if ($descripsigfe<>'') {
   $wherefiltro.="  sigfe_bene like '%$descripsigfe%' and ";
   $sw=1;
}
if ($cargosigfe<>'') {
   $wherefiltro.="  sigfe_cargo='$cargosigfe' and ";
   $sw=1;
}
if ($abonosigfe<>'') {
   $wherefiltro.="  sigfe_abono='$abonosigfe' and ";
   $sw=1;
}
if ($sw==0) {
   $wherefiltro.=" 1=1 " ;
}
if ($sw==1) {
   $wherefiltro.=" 1=1 ";
}


     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ( $wherefiltro ) order by sigfe_numdoc ASC";
//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and (not $whereid) order by sigfe_fecha";
//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ($wherenumdoc and $wherebene and sigfe_Abono<>0 ) order by sigfe_fecha";
//     $sql=" select *, sum(sigfe_abono) AS sigfe_abono, count(sigfe_id) as total from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' GROUP BY sigfe_bene, sigfe_numdoc having total>1 order by sigfe_fecha";
//     echo $sql."<br><br>";
     $res2 = mysql_query($sql);
//     $cont=1;
     $cont22=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo1mc";
          $estilo2d="Estilo1mcd";
          $estilo2i="Estilo1mci";
       } else {
          $estilo2="Estilo1mcblanco";
          $estilo2d="Estilo1mcblancod";
          $estilo2i="Estilo1mcblancoi";
       }

?>
 <tr  class="">
   <td>
   <input id="e<? echo $cont ?>" type="checkbox" name="var4[<? echo $cont ?>]" value="<? echo $cont ?>|2" >
   <input id="d<? echo $cont ?>" type="hidden" name="va<? echo $cont ?>" value="<? echo $row2["sigfe_cargo"]; ?>">
   <input id="dd<? echo $cont ?>" type="hidden" name="va2<? echo $cont ?>" value="<? echo $row2["sigfe_abono"]; ?>">
     <input  type="hidden" name="var44[<? echo $cont ?>]" value="<? echo $row2["sigfe_id"]; ?>">
    <? echo $cont22  ?></td>
   <td><? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td><? echo $row2["sigfe_numdoc"] ?></td>
   <td><? echo $row2["sigfe_bene"] ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_cargo"],0,',','.') ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_abono"],0,',','.') ?></td>

  </tr>

<?
     $cont++;
     $cont22++;
     $sumasigfecargo=$sumasigfecargo+$row2["sigfe_cargo"];
     $sumasigfeabono=$sumasigfeabono+$row2["sigfe_abono"];


    }
     $cont2=$cont;
?>
   <tr  class="">
    <td class="Estilo1d" colspan=4>Totales</td>
    <td class="Estilo1d"><? echo number_format($sumasigfecargo,0,',','.') ?></td>
    <td class="Estilo1d"><? echo number_format($sumasigfeabono,0,',','.') ?></td>
   </tr>

    </tbody>
</table>

        <input id="cuenta1"  type="hidden" name="cont1" value="<? echo $cont1 ?>">
        <input id="cuenta2"  type="hidden" name="cont2" value="<? echo $cont2 ?>">
        <input id="numero"  type="hidden" name="numero" value="<? echo $numero ?>">
    </form>

 </div>

<?
}
} else {
    echo "<br>PERIODO CERRADO<br>";
}

?>



</body>
</html>


