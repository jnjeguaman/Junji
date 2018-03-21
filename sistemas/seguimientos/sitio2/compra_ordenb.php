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
$read1= rand(0,1000000);

header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

?>
<html>
<head>

<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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
	font-size: 9px;
	color: #003063;
	text-align: left;
}
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 9px;
	color: #003063;
	text-align: right;
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
}
.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
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
  <script type="text/javascript" src="select_dependientes2b.js"></script>
  
  
    <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />
  
<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--
function limpiar() {
    document.form1.dig.value="";
}
function verificador() {
var rut = document.form1.rut.value;
var dig = document.form1.dig.value;
var count = 0;
var count2 = 0;
var factor = 2;
var suma = 0;
var sum = 0;
var digito = 0;
count2 = rut.length - 1;
	while(count < rut.length) {

		sum = factor * (parseInt(rut.substr(count2,1)));
		suma = suma + sum;
		sum = 0;

		count = count + 1;
		count2 = count2 - 1;
		factor = factor + 1;

		if(factor > 7) {
			factor=2;
		}

	}
digito = 11 - (suma % 11);
digito2 = 11 - (suma % 11);

if (digito == 11) {
	digito = 0;
	digito2 = 0;
}
if (digito == 10) {
	digito = "k";
	digito2 = "K";
}
if (dig!=digito && dig!=digito2) {
  alert('Rut incorrecto, es  '+digito);
  document.form1.dig.value=''
  document.form1.dig.focus();
} else {
  traerDatos(rut);
//  alert('estoy en el else');
//  llamado();

}
//form.dig.value = digito;
}

function llamado() {
    alert('llamando al un alerta de otra funcion');
}

function nuevoAjax()
{
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }

	return xmlhttp;
}

function traerDatos(tipoDato)  {
	var ajax=nuevoAjax();
//    alert (" dato "+tipoDato);
 	ajax.open("POST", "buscaclient.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("d="+tipoDato);

	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
			document.form1.nombre.value=ajax.responseText;
            var Date = document.form1.nombre.value;
            var elem = Date.split('/');
            document.form1.nombre.value=elem[0];
//            document.form1.fpago.value = elem[1];
            document.form1.direccion.value = elem[2];
            document.form1.telefono.value = elem[3];
            if (elem[0]=='Proveedor No Existe') {
//                alert("entra");
               document.getElementById("tipopersona2").style.visibility="visible";
//             document.getElementById("checkbox3").style.visibility="hidden";

            } else {
               document.getElementById("tipopersona2").style.visibility="hidden";
            }



		}
	}
}


 function traerDatos2()  {
	var ajax=nuevoAjax();
    tipoDato1=document.form1.numero.value;
    tipoDato2=document.form1.rut.value;
    rut=document.form1.rut.value;
    //alert (" dato "+c);
 	ajax.open("POST", "buscaclient2.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//ajax.send("d="+tipoDato,"e="+rut);
    ajax.send("d="+tipoDato1+"&e="+tipoDato2);

	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
			//b=ajax.responseText;
            if (ajax.responseText == 1) {
               //  alert (" No Existe "+b);
            }
            if (ajax.responseText == 0) {
                  alert ("Numero de Boleta Existe Para esta proveedor ");
                  document.form1.numero.value=ajax.responseText;
//                    document.getElementById(c).value =ajax.responseText;
//                    document.getElementById(c).value =0;

            }

		}
	}

}

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

   if (document.form1.documento2.value=='' ) {
      alert ("Modalidad presenta problemas ");
      return false;
  }
   if (document.form1.documento.value=='' ) {
      alert ("Plan de Compra presenta problemas ");
      return false;
  }
   if (document.form1.monto.value=='' ) {
      alert ("Monto presenta problemas ");
      return false;
  }

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }


}
//-->

</script>

<body>
<?php
function generalista()
{
    $regionsession = $_SESSION["region"];
	$consulta=mysql_query("Select compra_depto,compra_depto, compra_anno from compra_compra where compra_region='$regionsession' and compra_estado='PENDIENTE'  and compra_cierre=1 group by compra_anno, compra_depto order by compra_anno desc");
//	$consulta=mysql_query("Select compra_depto,compra_depto from compra_compra where compra_region='$regionsession' group by compra_depto");
//	$consulta=mysql_query("Select subcat_nombre,subcat_nombre from compra_subcat  where subcat_cat_id =4");

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='paises' id='paises' onChange='cargaContenido2(this.id)' class='Estilo1'>";
	echo "<option value='0'>Seleccione...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."/".$registro[2]."'>".$registro[1]."-".$registro[2]."</option>";
	}
	echo "</select>";
}

function generalista2()
{
	$consulta=mysql_query("Select cat_nombre, cat_id from compra_categoria where cat_estado =2");

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='paises2' id='paises2' onChange='cargaContenido2b(this.id)' class='Estilo1'>";
	echo "<option value='0'>Seleccione...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[1]."'>".$registro[0]."</option>";
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
                    <td height="20" colspan="2"><span class="Estilo7">DISTRIBUCION ORDEN DE COMPRA</span></td>
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
                       <td><a href="compra_orden.php" class="link" >Volver</a></td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
<?
  $id=$_GET["id"];
  $sql21="select * from compra_orden where oc_id=$id ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $ocrsocial=$row21["oc_rsocial"];


$id2=$_GET["id2"];
if ($_GET["ori"]==1)  {
    $sql2 = "delete from compra_detorden where detorden_id=$id2";
//    echo $sql2;
    mysql_query($sql2);

}


$fechacompra=substr($row21["oc_fechacompra"],8,2)."-".substr($row21["oc_fechacompra"],5,2)."-".substr($row21["oc_fechacompra"],0,4);

?>


                   <tr>
             			<td height="50" colspan="3">
                     </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_grabaordenb.php" method="post"  onSubmit="return valida()" enctype="multipart/form-data">
                   <tr>
                             <td  valign="center" class="Estilo1">Fecha Compra</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fechacompra ?>" id="f_date_c1" >
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
                     </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
                                 <?
                                  $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);
                                  $row2 = mysql_fetch_array($res2);
                                  echo $row2["nombre"];
                                 ?>



                             </td>
                      </tr>
                      <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Numero O/C </td>
                             <td class="Estilo1" colspan=3>
                                   <? echo $row21["oc_numero"] ?>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                                   <? echo $row21["oc_rut"]."-".$row21["oc_dig"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre  </td>
                             <td class="Estilo1" colspan=3> <? echo $ocrsocial ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Direccion  </td>
                             <td class="Estilo1" colspan=3>
                                   <? echo $row21["oc_direccion"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Telefono</td>
                             <td class="Estilo1" colspan=3>
                                   <? echo $row21["oc_fono"] ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Monto O.C.</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="monto2" class="Estilo2" size="15"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<? echo $row21["oc_monto"]; ?>"> Pesos
                              <input type="hidden" name="moneda" class="Estilo2" size="15" value="Pesos" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Observacion  </td>
                             <td class="Estilo1" colspan=3>
                               <textarea name="obs" rows="3" class="Estilo2" cols="64"><? echo $row21["oc_obs"] ?></textarea>

                             </td>
                           </tr>

                   <tr>
                             <td  valign="center" class="Estilo1">Estado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                             <td class="Estilo1" valign="center">
                            <select name="estado22" class="Estilo1">
                                   <option value="">Seleccione...</option>
                                   <option value="ACEPTADO" <? if ($row21["oc_estado"]=="ACEPTADO") { echo "selected=selected"; } ?>>ACEPTADO</option>
                                   <option value="CANCELADA/ELIMINADA/RECHAZADA"  <? if ($row21["oc_estado"]=="CANCELADA/ELIMINADA/RECHAZADA") { echo "selected=selected"; } ?> >CANCELADA/ELIMINADA/RECHAZADA</option>
                                   <option value="ENVIADA"  <? if ($row21["oc_estado"]=="ENVIADA") { echo "selected=selected"; } ?> >ENVIADA</option>
                                   <option value="RECEPCION CONFORME"  <? if ($row21["oc_estado"]=="RECEPCION CONFORME") { echo "selected=selected"; } ?> >RECEPCION CONFORME</option>
                               </select>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1" width="79"> Archivo</td>
                             <td class="Estilo1" colspan=3>
                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>
                              <a href="../../archivos/docfac/<? echo $row21["oc_archivo"] ; ?>" class="link" target="_blank"><? echo $row21["oc_archivo"]; ?></a><br><br>
                             </td>
                           </tr>


                           


<?
  $octipo=$row21["oc_tipo"];
  $sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$octipo";
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $octipo2=$registro["cat_nombre"];

    $ocmodalidad=$row21["oc_modalidad"];
  $sql33="Select subcat_nombre, subcat_id from compra_subcat where subcat_id =$ocmodalidad";
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $ocmodalidad2=$registro["subcat_nombre"];

?>

                            <tr>
                             <td  valign="center" class="Estilo1">Tipo Contratación  </td>
                             <td class="Estilo1">
                             <?php generalista2(); ?>
                              <input type="hidden" name="tipo2b" class="Estilo2" size="40" value="" ><br>
                                <? echo $octipo2; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Modalidad  </td>
                             <td class="Estilo1">
					            <select disabled="disabled" name="estados2" id="estados2" class="Estilo1">
  						          <option value="0">Seleccione...</option>
					            </select>                 <br>
                                 <? echo $ocmodalidad2; ?>
                             </td>
                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    Modificar    " > </td>
                           </tr>
                           <tr><td colspan=4><hr></td></tr>

                           
                           
                           <tr>
                             <td valign="center" class="Estilo1">Centro de Costo</td>
				             <td class="Estilo1"><?php generalista(); ?>
                              <input type="hidden" name="tipo2" class="Estilo2" size="40" value="" >
                              <br>
                               <? //echo $row21["oc_ccosto"] ?>
                               <br>&nbsp;
                             </td>
                           </tr>
                           <input type="hidden" name="occompraid" value="<? echo $row21["oc_compra_id"]; ?>" >
<?
  $occompraid=$row21["oc_compra_id"];
  $sql22="select * from compra_compra where compra_id=$occompraid ";
//  echo $sql22;
  $result22=mysql_query($sql22);
  $row22=mysql_fetch_array($result22);
  $compranombre=$row22["compra_nombre"];


?>
                           <tr>
                             <td valign="center" class="Estilo1">Plan de Compra</td>
                             <td class="Estilo1">
					            <select disabled="disabled" name="estados" id="estados" class="Estilo1">
  						          <option value="0">Seleccione...</option>
					            </select>
                              <br>
                               <? //echo $compranombre; ?>



                             </td>
                             
                                    <input type="hidden" name="documento" class="Estilo2" size="40" value="<? echo $occompraid; ?>">
                                    <input type="hidden" name="documento2" class="Estilo2" size="40" value="<? echo $ocmodalidad ?>">

                           <tr>
                           <tr><td>&nbsp;</td></tr>


                           <tr>
                               <td  valign="center" class="Estilo1">Monto  </td>
                               <td  valign="center" class="Estilo1"><input type="text" name="monto" class="Estilo2" size="20"  > </td>

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
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR    " > </td>
                           </tr>

                             <input type="hidden" name="id" value="<? echo $id; ?>" >
                             <input type="hidden" name="numerooc" value="<? echo $row21["oc_numero"]; ?>" >
                             <input type="hidden" name="ori" value="1" >
                             
                             <input type="hidden" name="uno" value="<? echo $row21["oc_ccosto"] ?>" >
                             <input type="hidden" name="dos" value="<? echo $compranombre; ?>" >
                             <input type="hidden" name="tres" value="<? echo  $row21["oc_archivo"]; ?>" >

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">
                      <table border=1>
                        <tr>
                         <td class="Estilo1">Eli.</td>
                         <td class="Estilo1">Centro de Costo</td>
                         <td class="Estilo1">Plan de Compra</td>
                         <td class="Estilo1">Monto</td>
                        </tr>
<?
   $ocnumero=$row21["oc_numero"];
   $sql5="select * from compra_detorden where detorden_oc_id=$id  ";
   $res3 = mysql_query($sql5);
   $cont=1;
   while($row3 = mysql_fetch_array($res3)){
      $a=$row3["fac_fecha_fac"];
      $b=$row3["fac_fecha_recepcion"];
       //echo $a."-";
      $detordenplan=$row3["detorden_plan"];
      $sql4="select * FROM compra_compra where compra_id='$detordenplan' ";
//      echo $sql4;
      $res4 = mysql_query($sql4);
      $row4 = mysql_fetch_array($res4);
      $plannombre=$row4["compra_nombre"];
      $suma=$suma+$row3["detorden_monto"];

?>
                        <tr>
                        <td class="Estilo1" width="20"><a href="compra_ordenb.php?id2=<? echo $row3["detorden_id"] ?>&id=<? echo $id; ?>&ori=1" class="link" onclick="return confirm('Seguro que desea Borrar o Eliminar?')"><img src="imagenes/b_drop.png" border=0></a></td>
                         <td class="Estilo1"><? echo $row3["detorden_ccosto"];  ?></td>
                         <td class="Estilo1"><? echo $plannombre;  ?></td>
                         <td class="Estilo1c"><? echo number_format($row3["detorden_monto"],0,',','.');  ?></td>
                        </tr>

<?
   }
   
   
   if ($suma<>$row21["oc_monto"]) {
       $estilo="Estilo1crojo";
   } else {
       $estilo="Estilo1c";
   }
?>

                        <tr>
                         <td class="Estilo1c" colspan=3>Total</td>
                         <td class="<? echo $estilo ?>" colspan=1><? echo number_format($suma,0,',','.');  ?></td>
                        </tr>


                      </table>





</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
