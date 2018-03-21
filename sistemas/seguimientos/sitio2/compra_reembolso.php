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
	font-size: 9px;
	text-align: left;
	color: #003063;
}
.Estilo3 {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	font-weight: bold;
	color: #003063;
}
.Estilo3c {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
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
  
    <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />


  <script type="text/javascript" src="select_dependientes2.js"></script>
  
<script language="JavaScript1.2">


</script>


<script language="javascript">


</script>

<body>

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
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

		  <?
		  require("inc/menu_1.php");
		  ?>

            </div>
      </div>

        <div class="col-sm-9 col-lg-9">
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">REEMBOLSOS NUEVOS</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">
                         
<?

if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Registros insertados con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Registros NO insertados !";
}

?>
                         </td>
                      </tr>
                       <tr>
                       <td><a href="#" class="link" ></a> </td>
                       <td> <a href="#" class="link" onClick="mostrarcon();"></a></td>
                      </tr>

<?
if (isset($_GET["anno2"])) {
    $anno2=$_GET["anno2"];
} else {
    $anno2=date("Y");
}



?>


                      


                      <tr>
				  <form name="form111" action="compra_orden2.php" method="get"  >
                            <tr>
                             <td  valign="center" class="Estilo1">Año
                                <select name="anno2" class="Estilo1" onchange="this.form.submit()">
                                   <option value="2013" <? if (2013==$anno2) { echo "selected=selected"; } ?> >2013</option>
                                   <option value="2014" <? if (2014==$anno2) { echo "selected=selected"; } ?> >2014</option>
                                   <option value="2015" <? if (2015==$anno2) { echo "selected=selected"; } ?> >2015</option>
                                   <option value="2016" <? if (2016==$anno2) { echo "selected=selected"; } ?> >2016</option>
                                   <option value="2017" <? if (2017==$anno2) { echo "selected=selected"; } ?> >2017</option>
                                   <option value="2018" <? if (2018==$anno2) { echo "selected=selected"; } ?> >2018</option>
                                   <option value="2019" <? if (2019==$anno2) { echo "selected=selected"; } ?> >2019</option>
                                   <option value="2020" <? if (2020==$anno2) { echo "selected=selected"; } ?> >2020</option>
                                   <option value="2021" <? if (2021==$anno2) { echo "selected=selected"; } ?> >2021</option>
                               </select>
                             </td>
                             </tr>
                             
                   </form>
                      <td colspan="8">


                         </table>
                      <table border=1 width=100%>
<tr></tr>


<br>


                        <tr>
        <td class="Estilo1">Folio</td>
        <td class="Estilo1">Nombre</td>
        <td class="Estilo1">Fecha_Inicio</td>
        <td class="Estilo1">Fecha_Termino</td>
        <td class="Estilo1">Dias</td>
        <td class="Estilo1">Destino</td>
                        </tr>
<?

  $sql="select * from cometido_funcionario where come_certificado<>'' and come_region='$regionsession' order by come_fechaini desc";
//  $sql="select * from compra_orden where oc_region=$regionsession and oc_nombre<>'' and oc_fpago<>'' and  oc_emitidapor<>'' and oc_modalidad<>'Reembolso' and year(oc_fechacompra)='$anno2' order by oc_id desc LIMIT 0 , 300 ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){

if ($row3["oc_archivo"]=='') {
    $imagen="punt_rojo.jpg";
    $titulo="Subir Archivo";
    $href="<a href='#' class='link' onclick='abreVentana2(".$row3["oc_id"].",".$row3["oc_id"].")' title='".$titulo."'>";
} else {
    $imagen="punt_verde.jpg";
    $titulo="Ver Archivo";
    $href="<a href='../../archivos/docfac/".$row3["oc_archivo"]."' class='link' target='_blank' title='".$titulo."'>";
}

?>


                       <tr>
                       
   <td class="Estilo3c"><? echo $row3["come_id"] ?></td>
   <td class="Estilo3c" width=200>  <? echo $row3["come_nombre"] ?></td>
   <td class="Estilo3c" width=50> <? echo substr($row3["come_fechaini"],8,2)."-".substr($row3["come_fechaini"],5,2)."-".substr($row3["come_fechaini"],0,4)   ?></td>
   <td class="Estilo3c" width=50> <? echo substr($row3["come_fechater"],8,2)."-".substr($row3["come_fechater"],5,2)."-".substr($row3["come_fechater"],0,4)   ?></td>
   <td class="Estilo3c"><? echo $row3["come_totaldia"] ?></td>
   <td class="Estilo3c"><? echo $row3["come_lugar"] ?></td>
   <td class="Estilo3c"><a href="compra_orden3.php?id=<? echo $row3["come_id"] ?>" class="link" > <img src="imagenes/editar.png" width="18" height="14" border=0 title="Editar"></a></td>
                       

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
<script>
  function  calculocombustible() {
       document.form33.totalc.value=Math.round((document.form33.ctdakm.value/document.form33.kmlitro.value)*document.form33.precio.value);
       document.form33.diferencia.value=Math.round(document.form33.totalc.value-document.form33.total.value);
  }
  function  ocultarcon() {
       theLayer.style.display="none";
  }
  function  mostrarcon() {
       theLayer.style.display="";
  }

</script>

<div  style="width:300px; height:400px; background-color:#E0F8F7; position:absolute;  top:72px; left:910px; z-index:1; display:none;" id="theLayer" >
<form name="form33" action="compra_grabaorden2.php" method="post"  >
   <table border=0>
<tr>
<td width="100%">
  <table border="0" width="100%" cellspacing="0" cellpadding="0" height="36">
  <tr>
  <td id="titleBar" style="cursor:move" width="100%">
  <ilayer width="100%" onSelectStart="return false">
  <layer width="100%" onMouseover="isHot=true;if (isN4) ddN4(theLayer)" onMouseout="isHot=false">
        &nbsp;
  </layer>
  </ilayer>
  </td>
  <td style="cursor:hand" valign="top">

  </td>
  </tr>

       <tr>
         <td class="Estilo1" colspan="2" ><a href="#" class="link" onClick="ocultarcon();" >OCULTAR</a></td>
       </tr>
   </table>

   <table border=0>
       <tr>
         <td class="Estilo1" width="120" ></td>
         <td class="Estilo1" >
           <select name="uno" class="Estilo1"  size="25" onChange="traerDatos3();">
                                 <?
                                  $sql2 = "select * from chile2013 order by nombre";
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                        <option value="<? echo $row2["codigo"]; ?>" > <? echo $row2["nombre"]; ?></option>

                                 <?
                                   }
                                 ?>



           </select>
         </td>
         <td width="100">
         </td>
         <td class="Estilo1" >
           <select name="dos" class="Estilo1"  size="25" onChange="traerDatos3();">
                                 <?
                                  $sql2 = "select * from chile2013 order by nombre";
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                        <option value="<? echo $row2["codigo"]; ?>" > <? echo $row2["nombre"]; ?></option>

                                 <?
                                   }
                                 ?>



           </select>
           </td>
       </tr>

   </table>

   <table border=0>
       <tr>
         <td class="Estilo1" width="120" >Cantidad de Km.</td>
         <td class="Estilo1" ><input type="text" name="ctdakm" class="Estilo2d" size="14"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calculocombustible();"> </td><td class="Estilo1" id="visualizar"> </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Km por Litro</td>
         <td class="Estilo1" ><input type="text" name="kmlitro" class="Estilo2d" size="14" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calculocombustible();" value="10">  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Precio Combustible</td>
         <td class="Estilo1" ><input type="text" name="precio" class="Estilo2d" size="14"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calculocombustible();">  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Total Informado</td>
         <td class="Estilo1" ><input type="text" name="total" class="Estilo2d" size="14"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calculocombustible();">  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" ></td>
         <td class="Estilo1" >_____________</td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Total Calculado</td>
         <td class="Estilo1" ><input type="text" name="totalc" class="Estilo2d" size="14"  >  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Diferencia</td>
         <td class="Estilo1" ><input type="text" name="diferencia" class="Estilo2d" size="14"  >  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >&nbsp;</td>
       </tr>
       <tr>
         <td class="Estilo1" colspan=2  >
         &nbsp;&nbsp;&nbsp;
         <input type="button" name="boton1" class="Estilo2c" value="Calcular" onClick="calculocombustible();" >
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="reset"  name="boton2" class="Estilo2c" value="Limpiar"  >
         </td>
       </tr>

  </table>



</form>


</div>


