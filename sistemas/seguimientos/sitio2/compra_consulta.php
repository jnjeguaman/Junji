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

function valida() {

   if (document.form1.rut.value==0 || document.form1.rut.value=='') {
      alert ("Rut presenta problemas ");
      return false;
  }
   if (document.form1.dig.value=='') {
      alert ("Dig presenta problemas ");
      return false;
  }
   if (document.form1.region.value==0 || document.form1.region.value=='') {
      alert ("Region presenta problemas ");
      return false;
  }

   if (document.form1.nombre.value=='' || document.form1.nombre.value=='Proveedor No Existe') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.nombre.value=='' || document.form1.nombre.value=='Proveedor No Existe') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.numero.value=='0' || document.form1.numero.value=='') {
      alert ("Número Factura presenta problemas ");
      return false;
  }
   if (document.form1.numero.value <= 0) {
      alert ("Número Factura debe ser positivo ");
      return false;
  }

   if (document.form1.monto.value=='0' || document.form1.monto.value=='') {
      x=document.form1.numero.value;
      alert ("Total factura presenta problemas "+ x);
      return false;
  }
   if (document.form1.tipodoc[0].checked=='' && document.form1.tipodoc[1].checked==''  && document.form1.tipodoc[2].checked=='' && document.form1.tipodoc[3].checked=='' && document.form1.tipodoc[4].checked=='') {
      alert ("No ha seleccionado Tipo de Documento ");
      return false;
  }


  
}
function envia() {
    document.form1.submit();
}


//-->

</script>

<body>
<?php
function generalista()
{
	$consulta=mysql_query("Select subcat_nombre,subcat_nombre from compra_subcat  where subcat_cat_id =4");

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='paises' id='paises' onChange='cargaContenido2(this.id)'>";
	echo "<option value='0'>Seleccione...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}
?>

    <div class="navbar-nav ">
    <div class="container">
        <div class="navbar-header">



	  <?
	  require("inc/top.php");
	  ?>

   </div>
</div>
</div>


   <div class="container">
         <div class="row">
          <div class="col-sm-2 col-lg-2">
            <div class="dash-unit2">

		  <?
		  require("inc/menu_1.php");
		  ?>

            </div>
      </div>

        <div class="col-sm-10 col-lg-10">
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">CONSULTA ORDEN DE COMPRA</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">
                         
<?

if(isset($_POST["region"])) {
   $region=$_POST["region"];
} else {
   $region=$regionsession;
}

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

if (!isset($_POST["tipo2"]) or !isset($_POST["tipo3"])) {

}

if (isset($_POST["anno2"])) {
    $anno2=$_POST["anno2"];
} else {
    $anno2=date("Y");
}


if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Registros insertados con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Registros NO insertados !";
}
//if (!$_POST["estado"]) {
//   $estado="EN PROCESO";
//}

 if ($regionsession==1) {
     $para1="845";
 }
 if ($regionsession==2) {
     $para1="1573";
 }
 if ($regionsession==3) {
     $para1="846";
 }
 if ($regionsession==4) {
     $para1="1574";
 }
 if ($regionsession==5) {
     $para1="847";
 }
 if ($regionsession==6) {
     $para1="1575";
 }
 if ($regionsession==7) {
     $para1="848";
 }
 if ($regionsession==8) {
     $para1="1576";
 }
 if ($regionsession==9) {
     $para1="852";
 }
 if ($regionsession==10) {
     $para1="853";
 }
 if ($regionsession==11) {
     $para1="854";
 }
 if ($regionsession==12) {
     $para1="855";
 }
 if ($regionsession==13) {
     $para1="856";
 }
 if ($regionsession==14) {
     $para1="599";
 }
 if ($regionsession==15) {
     $para1="1572";
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
                       <td><a href="compra_menuoc.php" class="link" >Volver</a></td>
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
                    </table>
					<table width="488" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_consulta.php" method="post" >

                    </table>
<div id="cuerpo" style="visibility:visible" >
					<table width="100%" border="0" cellspacing="0" cellpadding="0">


                   <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==0 or $regionsession==15) {
                                    $sql2 = "Select * from regiones where codigo<20 order by codigo";
                                    echo '<option value="">Seleccione...</option>';
                                  } else
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["codigo"] ?>"  <? if ($row2["codigo"]==$region) echo "selected=selected" ?>  ><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Número O/C </td>
                             <td class="Estilo1" colspan=3>
                              <input type="hidden" name="numerooc1" value="<? echo $para1 ?>"   ><? echo $para1 ?> -
                              <input type="text" name="numerooc2" class="Estilo2" size="7"  value="<? echo $numerooc2 ?>" > -
                              <input type="text" name="numerooc3" class="Estilo2" size="7"  value="<? echo $numerooc3 ?>">

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
<!--
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
-->

                   <tr>
                             <td  valign="center" class="Estilo1">Estado </td>
                             <td class="Estilo1" valign="center">
                            <select name="estado" class="Estilo1">
                                   <option value="">Seleccione...</option>
                                   <option value="ACEPTADO" <? if ($estado=="ACEPTADO") { echo "selected=selected"; } ?> >ACEPTADO</option>
                                   <option value="CANCELADA/ELIMINADA/RECHAZADA" <? if ($estado=="CANCELADA/ELIMINADA/RECHAZADA") { echo "selected=selected"; } ?> >CANCELADA/ELIMINADA/RECHAZADA</option>
                                   <option value="ENVIADA" <? if ($estado=="ENVIADA") { echo "selected=selected"; } ?> >ENVIADA</option>
                                   <option value="GUARDADA" <? if ($estado=="GUARDADA") { echo "selected=selected"; } ?> >GUARDADA</option>
                               </select>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Tipo</td>
                             <td class="Estilo1" colspan=3>
                             <table border=1>
                             <tr>
                               <td class="Estilo1"><input type="checkbox" name="tipo1" class="Estilo2" size="40" value="Orden Compra" <? if ($tipo1=='Orden Compra') { echo "checked"; } ?>  >Orden Compra</td>
                               <td class="Estilo1"><input type="checkbox" name="tipo2" class="Estilo2" size="40" value="Orden Pago" <? if ($tipo2=='Orden Pago') { echo "checked"; } ?>>Orden Pago<br></td>
                              <td class="Estilo1"><input type="checkbox" name="tipo3" class="Estilo2" size="40" value="Orden Reembolso" <? if ($tipo3=='Orden Reembolso') { echo "checked"; } ?>>Orden Reembolso</td>
                             </tr>
                             </table>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Año</td>
                             <td  valign="center" class="Estilo1">
                                <select name="anno2" class="Estilo1" >
                                   <option value="2013" <? if (2013==$anno2) { echo "selected=selected"; } ?> >2013</option>
                                   <option value="2014" <? if (2014==$anno2) { echo "selected=selected"; } ?> >2014</option>
                                   <option value="2015" <? if (2015==$anno2) { echo "selected=selected"; } ?> >2015</option>
                                   <option value="2016" <? if (2016==$anno2) { echo "selected=selected"; } ?> >2016</option>
                                   <option value="2017" <? if (2017==$anno2) { echo "selected=selected"; } ?> >2017</option>
                               </select>
                             </td>
                             </tr>


                           
                           


                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    BUSCAR ORDEN DE COMPRA    " >&nbsp;&nbsp;&nbsp;&nbsp; <a href="compra_consulta.php" class="link" >limpiar</a></td>
                           </tr>



                        </form>
</div>
                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">



<a href="compra_buscaocexcel.php?region=<? echo $region; ?>&nombre=<? echo $nombre; ?>&rut=<? $rut; ?>&numerooc2=<? echo $numerooc2; ?>&tipo1=<? echo $tipo1 ?>&tipo2=<? echo $tipo2 ?>&tipo3=<? echo $tipo3 ?>&tipo4=<? echo $tipo4 ?>&tipo5=<? echo $tipo5 ?>&anno2=<? echo $anno2 ?>" class="link" >Exportar a Excel</a> /
<a href="compra_buscaocexcelb.php?region=<? echo $region; ?>&nombre=<? echo $nombre; ?>&rut=<? $rut; ?>&numerooc2=<? echo $numerooc2; ?>&tipo1=<? echo $tipo1 ?>&tipo2=<? echo $tipo2 ?>&tipo3=<? echo $tipo3 ?>&tipo4=<? echo $tipo4 ?>&tipo5=<? echo $tipo5 ?>&anno2=<? echo $anno2 ?>" class="link" >Exportar a Excel con Facturas</a>

<table border=1>
<tr class="Estilo8"></tr>

                        <tr>
                         <td class="Estilo1c">Nº </td>
                         <td class="Estilo1c">Rut</td>
                         <td class="Estilo1c">Proveedor</td>
                         <td class="Estilo1c"> Número Orden </td>
                         <td class="Estilo1c">Fecha</td>
                         <td class="Estilo1c">Descripción</td>
                         <td class="Estilo1c">Comprometido</td>
                         <td class="Estilo1c">Item</td>
                         <td class="Estilo1c">Monto Total</td>
                         <td class="Estilo1c">Estado</td>
                         <td class="Estilo1c">Ficha</td>
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


if ($estado<>""  ) {
    $sql.=" oc_estado='$estado' and ";
    $sw=1;
}
/*
if ($estado=='TODOS' ) {
    $sql.=" oc_estado<>'' and  ";
    $sw=1;

}
*/


if ($sw==1){
    $sql.=" 1=1 order by oc_orden asc";
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
   $archivo="compra_fichaorden.php";
}
if ($estado2=='CERRADO') {
   $archivo="compra_fichaorden.php";
}

?>


     <tr>
     <td class="Estilo3c"><? echo $cont; ?> </td>
     <td class="Estilo2"><? echo $row3["oc_rut"]."-".$row3["oc_dig"]  ?></td>
     <td class="Estilo2"><? echo $row3["oc_rsocial"]  ?></td>
     <td class="Estilo3c"><? echo $row3["oc_numero"]  ?></td>
     <td class="Estilo3c" ><? echo substr($row3["oc_fechacompra"],8,2)."-".substr($row3["oc_fechacompra"],5,2)."-".substr($row3["oc_fechacompra"],0,4)   ?></td>
     <td class="Estilo2"><? echo $row3["oc_nombre"]  ?></td>
     <td class="Estilo2"><? echo $row3["oc_compromiso"]  ?></td>
     <td class="Estilo2"><? echo $row3["oc_item"]  ?></td>
     <td class="Estilo2"><? echo $row3["oc_monto"]  ?></td>
     <td class="Estilo2b"><? echo substr($row3["oc_estado"],0,10)  ?></td>
     <td class="Estilo1"><a href="compra_fichaorden2.php?id=<? echo $row3["oc_id"]  ?>&ori=2" class="link" >ver</a></td>
     </tr>





<?

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
