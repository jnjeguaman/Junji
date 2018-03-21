<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$date_in2=date("Y-m-d");
?>
<html>
<head>
<title>Compras</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: left;
}
.Estilo1b2 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #0000FF;
	text-align: left;
}

.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right;
}
.Estilo2 {
	font-family: Verdana;
	font-size: 10px;
	text-align: left;
	color: #003063;

}
.Estilo2c {
	font-family: Verdana;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo2d {
	font-family: Verdana;
	font-size: 10px;
	text-align: right;
	color: #003063;
}
.Estilo2b {
	font-family: Verdana;
	font-size: 8px;
	text-align: left;
	color: #003063;
}
.Estilo3 {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	color: #003063;
}
.Estilo3c {
	font-family: Verdana;
	font-size: 9px;

	text-align: center;
	color: #003063;
}
.Estilo3d {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: right;
	color: #003063;
}
.Estilo1cverde {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #009900;
	text-align: right;
}
.Estilo1camarrillo {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #CCCC00;
	text-align: right;
}
.Estilo1crojo {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #CC0000;
	text-align: right;
}
.Estilo1crojoc {
	font-family: Verdana;
	font-weight: bold;
	font-size: 12px;
	color: #CC0000;
	text-align: center;
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
.Estilo4 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif;
font-size: 14px;
font-weight: bold;
text-align: center; }

}
.Estilo8 {font-family: Geneva, Arial, Helvetica, sans-serif; 
font-size: 10px; font-weight: bold; text-align: left; 
color: #009900;}

-->
</style>



</head>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

  <script type="text/javascript" src="select_dependientes2.js"></script>
  
<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--


function ChequearTodos(chkbox)
{
  for (var i=0;i < document.forms[0].elements.length;i++){
      var elemento = document.forms[0].elements[i];
      alert("aqui "+chkbox);
      if (elemento.type == "checkbox"){
          elemento.checked = chkbox.checked
      }
  }
}


//-->

</script>

<body>
<?php

?>

<img src="images/pix.gif" width="1" height="10">
<table width="752" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
  <tr>
    <td width="1009">
	  <?
	  require("inc/top.php");      
	  ?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="165" valign="top">
		  <?
		  require("inc/menu_1.php");
		  ?>		  </td>
          <td valign="top">           <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="530" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">ADMINISTRACIÓN ORDEN DE COMPRA</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">
                         
<?

$region=$_POST["region"];
$mesprograma=$_POST["mesprograma"];
$nombre=$_POST["nombre"];
$rut=$_POST["rut"];
$numerooc1=$_POST["numerooc1"];
$numerooc2=$_POST["numerooc2"];
$numerooc3=$_POST["numerooc3"];
$tipo1=$_POST["tipo1"];
$tipo2=$_POST["tipo2"];
$tipo3=$_POST["tipo3"];
$tipo4=$_POST["tipo4"];
$tipo5=$_POST["tipo5"];
$estado=$_POST["estado"];

if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Registros insertados con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Registros NO insertados !";
}
if (!$_POST["estado"]) {
   $estado="EN PROCESO";
}

 if ($regionsession==1) {
     $para1="1877";
 }
 if ($regionsession==2) {
     $para1="1333";
 }
 if ($regionsession==3) {
     $para1="1879";
 }
 if ($regionsession==4) {
     $para1="1880";
 }
 if ($regionsession==5) {
     $para1="2229";
 }
 if ($regionsession==6) {
     $para1="1739";
 }
 if ($regionsession==7) {
     $para1="4326";
 }
 if ($regionsession==8) {
     $para1="2230";
 }
 if ($regionsession==9) {
     $para1="1882";
 }
 if ($regionsession==10) {
     $para1="1740";
 }
 if ($regionsession==11) {
     $para1="1887";
 }
 if ($regionsession==12) {
     $para1="1890";
 }
 if ($regionsession==13) {
     $para1="4342";
 }
 if ($regionsession==14) {
     $para1="4326";
 }
 if ($regionsession==15) {
     $para1="1876";
 }
 if ($regionsession==17) {
     $para1="523522";
 }
 if ($regionsession==18) {
     $para1="523524";
 }


?>
                         </td>
                      </tr>
                       <tr>
                       <td><a href="cambioestado.php" class="link" >Volver</a></td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
<?
$sql21="select max(folio1_folio) as foliomio from dpp_folio1 where folio1_region='$regionsession'  ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $foliomio=$row21["foliomio"];
  $foliomio2=$foliomio+1;
  
$sql22="select count(eta_id) as totaldevueltos from dpp_etapas where eta_estado=12 and eta_region='$regionsession' ";
//  echo $sql21;
  $result22=mysql_query($sql22);
  $row22=mysql_fetch_array($result22);
  $totaldevueltos=$row22["totaldevueltos"];
?>


                   <tr>
             			<td height="50" colspan="3">
                    
					<table width="488" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_ocfactura.php" method="post" >

                    </table>
<div id="cuerpo" style="visibility:visible" >
					<table width="488" border="0" cellspacing="0" cellpadding="0">


                   <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">
                                    <option value="">Select...</option>
                                 <?
                                    $sql2 = "Select * from regiones where activo=1 order by codigo";


                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["codigo"] ?>" <? if ($row2["codigo"]==$region) { echo "selected=selected"; } ?>><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Mes </td>
                             <td class="Estilo1">
                                <select name="mesprograma" class="Estilo1">
                                   <option value="">Seleccione...</option>
                                   <option value="01" <? if ($mesprograma=='01') { echo "selected=selected"; } ?>>ENERO </option>
                                   <option value="02" <? if ($mesprograma=='02') { echo "selected=selected"; } ?>>FEBRERO </option>
                                   <option value="03" <? if ($mesprograma=='03') { echo "selected=selected"; } ?>>MARZO </option>
                                   <option value="04" <? if ($mesprograma=='04') { echo "selected=selected"; } ?>>ABRIL </option>
                                   <option value="05" <? if ($mesprograma=='05') { echo "selected=selected"; } ?>>MAYO </option>
                                   <option value="06" <? if ($mesprograma=='06') { echo "selected=selected"; } ?>>JUNIO </option>
                                   <option value="07" <? if ($mesprograma=='07') { echo "selected=selected"; } ?>>JULIO </option>
                                   <option value="08" <? if ($mesprograma=='08') { echo "selected=selected"; } ?>>AGOSTO </option>
                                   <option value="09" <? if ($mesprograma=='09') { echo "selected=selected"; } ?>>SEPTIEMBRE </option>
                                   <option value="10" <? if ($mesprograma=='10') { echo "selected=selected"; } ?>>OCTUBRE </option>
                                   <option value="11" <? if ($mesprograma=='11') { echo "selected=selected"; } ?>>NOVIEMBRE </option>
                                   <option value="12" <? if ($mesprograma=='12') { echo "selected=selected"; } ?>>DICIEMBRE </option>
                               </select>


                             </td>
                      </tr>

<!--
                           <tr>
                             <td  valign="center" class="Estilo1"><br>Tipo</td>
                             <td class="Estilo1" colspan=3>
                               <input type="checkbox" name="tipo1" class="Estilo2" size="40" value="Orden de Compra" <? if ($tipo1=='Orden de Compra') { echo "checked"; } ?>  >Orden de Compra<br>
                               <input type="checkbox" name="tipo2" class="Estilo2" size="40" value="Arriendo" <? if ($tipo2=='Arriendo') { echo "checked"; } ?>>Arriendo<br>
                              </td>
                             </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Número O/C </td>
                             <td class="Estilo1" colspan=3>
                              <input type="hidden" name="numerooc1" value="<? echo $para1 ?>"   ><? echo $para1 ?> -
                              <input type="text" name="numerooc2" class="Estilo2" size="7"  > -
                              <input type="text" name="numerooc3" class="Estilo2" size="7"  >

                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" value="<? echo $rut ?>">  Rut sin puntos, Ni digito verificador
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1"><br>Nombre Proveedor</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="40" value="<? echo $nombre ?>" >
                             </td>
                           </tr>

                            <tr id="tipopersona2" >
                             <td  valign="center" class="Estilo1">Estado</td>
                             <td class="Estilo1" colspan=3>
                             <select name="estado" class="Estilo1">
                                   <option value="">Seleccione...</option>
                                   <option value="TODOS">TODOS</option>
                                   <option value="ACEPTADO">ACEPTADO</option>
                                   <option value="ELIMINADA">ELIMINADA</option>
                                   <option value="ENVIADA A PROVEEDOR">ENVIADA A PROVEEDOR</option>
                                   <option value="GUARDADA">GUARDADA</option>
                                   <option value="EN PROCESO">EN PROCESO</option>
                                   <option value="SOLICITA CANCELACION">SOLICITA CANCELACION</option>
                                   <option value="RECEPCION CONFORME">RECEPCION CONFORME</option>
                                   <option value="NO ACEPTADA">NO ACEPTADA</option>
                                   <option value="CONTRATO">CREADOS POR CONTRATO</option>

                               </select>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1"><br>Tipo</td>
                             <td class="Estilo1" colspan=3>
                             <table border=1>
                             <tr>
                               <td class="Estilo1"><input type="checkbox" name="tipo1" class="Estilo2" size="40" value="Orden de Compra" <? if ($tipo1=='Orden de Compra') { echo "checked"; } ?>  >Orden de Compra</td>
                               <td class="Estilo1"><input type="checkbox" name="tipo2" class="Estilo2" size="40" value="Arriendo" <? if ($tipo2=='Arriendo') { echo "checked"; } ?>>Arriendo<br></td>
                              <td class="Estilo1"><input type="checkbox" name="tipo3" class="Estilo2" size="40" value="Consumos Basicos" <? if ($tipo3=='Consumos Basicos') { echo "checked"; } ?>>Consumos Basicos</td>
                             </tr>
                             <tr>
                              <td class="Estilo1"><input type="checkbox" name="tipo4" class="Estilo2" size="40" value="Reembolso" <? if ($tipo4=='Reembolso') { echo "checked"; } ?>>Reembolso<br></td>
                              <td class="Estilo1"><input type="checkbox" name="tipo5" class="Estilo2" size="40" value="Otros Pagos" <? if ($tipo5=='Otros Pagos') { echo "checked"; } ?>>Otros Pagos</td>
                              <td class="Estilo1">&nbsp;</td>
                             </tr>
                             </table>
                             </td>
                           </tr>
-->

                           
                           


                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    BUSCAR ORDEN DE COMPRA    " >&nbsp;&nbsp;&nbsp;&nbsp; <a href="compra_ocfactura.php" class="link" >limpiar</a></td>
                           </tr>



                        </form>
</div>
                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">



<a href="compra_buscaocexcel.php?$region=<? echo $region; ?>&nombre=<? echo $nombre; ?>&rut=<? $rut; ?>&numero=<? echo $numero; ?>&estado=<? echo $estado ?>" class="link" >Exportar a Excel</a>

<table border=1>
<tr class="Estilo8"></tr>

                        <tr>
                         <td class="Estilo1c">Nº </td>
                         <td class="Estilo1c">Rut</td>
                         <td class="Estilo1c">Proveedor</td>
                         <td class="Estilo1c">Número OC</td>
                         <td class="Estilo1c">Fecha</td>
                         <td class="Estilo1c">Descripción</td>
                         <td class="Estilo1c">Monto</td>
                         <td class="Estilo1c">Estado</td>
                         <td class="Estilo1c">Ficha</td>
                        </tr>
<?
  $sw=0;
  $sql="select * from compra_orden where oc_tipo<>'' and ";

if ($region<>"") {
        $sql.=" oc_region='$region' and ";
    $sw=1;
}
if ($mesprograma<>"") {
        $sql.=" month(oc_fechacompra)='$mesprograma' and ";
    $sw=1;
}
/*
     $sql="select * from compra_orden where ";
if ($regionsession<>"") {
    if ($regionsession==0)
        $sql.=" oc_region<>'' and ";
    else
        $sql.=" oc_region=$regionsession and ";
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
if ($numerooc1<>"" and ($numerooc2<>"" or $numerooc3<>"")) {
    $sql.=" oc_numero like '$numerooc1%$numerooc2%$numerooc3' and ";
    $sw=1;
}
if ($tipo1<>"" ) {
    $sql.=" oc_tipo<>'' and ";
    $sw=1;
}
if ($tipo2<>"" or $tipo3<>"" or $tipo4<>"") {
    $sql.=" (oc_modalidad='$tipo2' or oc_modalidad='$tipo3' or oc_modalidad='$tipo4') and  ";
    $sw=1;
}

*/
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


?>


   <tr>
     <td class="Estilo1b2"><? echo $cont; ?> </td>
     <td class="Estilo1b2"><? echo $row3["oc_rut"]."-".$row3["oc_dig"]  ?></td>
     <td class="Estilo1b2"><? echo $row3["oc_rsocial"]  ?></td>
     <td class="Estilo1b2"><? echo $row3["oc_numero"]  ?></td>
     <td class="Estilo1b2" ><? echo substr($row3["oc_fechacompra"],8,2)."-".substr($row3["oc_fechacompra"],5,2)."-".substr($row3["oc_fechacompra"],0,4)   ?></td>
     <td class="Estilo1b2"><? echo $row3["oc_nombre"]  ?></td>
     <td class="Estilo1b2"><? echo number_format($row3["oc_monto"],0,',','.')  ?></td>
     <td class="Estilo1b2"><? echo $row3["oc_estado"]  ?></td>
	 <td class="Estilo1b2"><a href=compra_fichaorden3.php?id=<? echo $row3["oc_id"]  ?>&ori=3" class="link" >ver</a></td>
   </tr>


<?
     $ocrut=$row3["oc_rut"];
     $ocfechacompra=$row3["oc_fechacompra"];
     $ocnumero=$row3["oc_numero"];

     $sql4="select * from dpp_etapas where eta_rut=$ocrut and eta_fecha_fac>='$ocfechacompra' and eta_estado<20 and eta_region='$region' ";
//     $sql4="select * from dpp_etapas where eta_rut=$ocrut and eta_fecha_fac>='$ocfechacompra' and (eta_nroorden='$ocnumero') ";
//     echo $sql4;
     $res4 = mysql_query($sql4);
     while ($row4 = mysql_fetch_array($res4)) {
         $etanroorden=$row4["eta_nroorden"];
         if ($ocnumero==$etanroorden or $etanroorden=='') {

?>
                       <tr>
                         <td class="Estilo3c">FACTURAS</td>
                         <td class="Estilo3c"><? echo $row4["eta_rut"]."-".$row4["eta_dig"]  ?> </td>
                         <td class="Estilo3c"><? echo $row4["eta_cli_nombre"]  ?> </td>
                         <td class="Estilo3c">N° <? echo $row4["eta_nroorden"]  ?> </td>
                         <td class="Estilo3c"><? echo substr($row4["eta_fecha_fac"],8,2)."-".substr($row4["eta_fecha_fac"],5,2)."-".substr($row4["eta_fecha_fac"],0,4)   ?></td>
                         <td class="Estilo3c"><? echo $row4["eta_servicio_final"]  ?> </td>
                         <td class="Estilo3c"><? echo number_format($row4["eta_monto"],0,',','.')  ?> </td>
                         <td class="Estilo3c"><? echo $row4["eta_estado"]  ?> </td>
        	             <td class="Estilo3c"><a href="facturasarchivos.php?id2=<? echo $row4["eta_id"]  ?>&ori=3" class="link" >ver</a></td>
                       </tr>


<?
        }

    }


   $cont++;

}
?>


                      <tr>
                       <input type="hidden" name="cont" value="<? echo $cont ?>" >

                        





</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
