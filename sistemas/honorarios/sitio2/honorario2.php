<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("Y-m-d");
      $region=$_GET["region"];
      $fecha1=$_GET["fecha1"];
      $fecha2=$_GET["fecha2"];
      $rut=$_GET["rut"];
      $item=$_GET["item"];
      $estado=$_GET["estado"];

?>
<html>
<head>
<title>Honorarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"">
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
.Estilo7 {font-size: 12px; font-weight: bold; }
-->
</style>



</head>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
<SCRIPT LANGUAGE ="JavaScript">
  function aparece(){
     if (document.form1.commodity.value == 'Other') {
       document.form1.specifications.style.display='';
     } else {
       document.form1.specifications.style.display='none';
     }
     if (document.form1.commodity.value == 'Fishmeal') {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
    }
     if (document.form1.commodity.value == 'Fishoil') {
       seccion2.style.display="";
     } else {
       seccion2.style.display="none";
    }
 }
 
  function aparece2(){
     if (document.form1.cantidad.value == 1) {
       seccion12.style.display="none";
       seccion13.style.display="none";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";
     }
     if (document.form1.cantidad.value == 2) {
       seccion12.style.display="";
       seccion13.style.display="none";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";

     }
     if (document.form1.cantidad.value == 3) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";

     }
     if (document.form1.cantidad.value == 4) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
     }
     if (document.form1.cantidad.value == 5) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="none";

     }
     if (document.form1.cantidad.value == 6) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";

     }

 }
 function calcula1(){
     document.form1.retencion1.value=Math.round(document.form1.bruto1.value * 10 / 100) ;
     document.form1.liquido1.value= Math.round(document.form1.bruto1.value)- Math.round(document.form1.retencion1.value);
 }
 function calcula2(){
     document.form1.retencion2.value=Math.round(document.form1.bruto2.value * 10 / 100) ;
     document.form1.liquido2.value= Math.round(document.form1.bruto2.value)- Math.round(document.form1.retencion2.value);
 }
 function calcula3(){
     document.form1.retencion3.value=Math.round(document.form1.bruto3.value * 10 / 100) ;
     document.form1.liquido3.value= Math.round(document.form1.bruto3.value)- Math.round(document.form1.retencion3.value);
 }
 function calcula4(){
     document.form1.retencion4.value=Math.round(document.form1.bruto4.value * 10 / 100) ;
     document.form1.liquido4.value= Math.round(document.form1.bruto4.value)- Math.round(document.form1.retencion4.value);
 }
 function calcula5(){
     document.form1.retencion5.value=Math.round(document.form1.bruto5.value * 10 / 100) ;
     document.form1.liquido5.value= Math.round(document.form1.bruto5.value)- Math.round(document.form1.retencion5.value);
 }
 function calcula6(){
     document.form1.retencion6.value=Math.round(document.form1.bruto6.value * 10 / 100) ;
     document.form1.liquido6.value= Math.round(document.form1.bruto6.value)- Math.round(document.form1.retencion6.value);
 }


 

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

if (digito == 11) {
	digito = 0;
}
if (digito == 10) {
	digito = "k";
}
if (dig!=digito) {
  alert('Rut incorrecto, es  '+digito);
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

		}
	}
}

function traerDatos2(a,b,c)  {
	var ajax=nuevoAjax();
    tipoDato1=a;
    tipoDato2=b;
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
//                  document.form1.nboleta1.value=ajax.responseText;
                  document.getElementById(c).value =ajax.responseText;

            }

		}
	}

}

function valida() {
   if (document.form1.rut.value==0 || document.form1.rut.value=='') {
      alert ("Rut presenta problemas ");
      return false;
  }
   if (document.form1.nboleta1.value==0 || document.form1.nboleta1.value=='') {
      alert ("Numero de Boleta 1 Presenta problemas ");
      return false;
  }

  /* if (document.form1.cantidad.value>=2 && (document.form1.nboleta2.value==0 || document.form1.nboleta2.value=='')) {
      alert ("Numero de Boleta 2 Presenta problemas ");
      return false;
  }
   if (document.form1.cantidad.value>=3 && (document.form1.nboleta3.value==0 || document.form1.nboleta3.value=='')) {
      alert ("Numero de Boleta 3 Presenta problemas ");
      return false;
  }
   if (document.form1.cantidad.value>=4 && (document.form1.nboleta4.value==0 || document.form1.nboleta4.value=='')) {
      alert ("Numero de Boleta 4 Presenta problemas ");
      return false;
  }
   if (document.form1.cantidad.value>=5 && (document.form1.nboleta5.value==0 || document.form1.nboleta5.value=='')) {
      alert ("Numero de Boleta 5 Presenta problemas ");
      return false;
  }
   if (document.form1.cantidad.value>=6 && (document.form1.nboleta6.value==0 || document.form1.nboleta6.value=='')) {
      alert ("Numero de Boleta 6 Presenta problemas ");
      return false;
  }*/

   if (document.form1.codigo.value==0 || document.form1.codigo.value=='') {
      alert ("Egreso presenta problemas ");
      return false;
  }
   if (document.form1.dia.value==0 || document.form1.dia.value=='') {
      alert ("dia presenta problemas ");
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

                <table width="500" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td height="20" colspan="2"><span class="Estilo7">NUEVO INGRESO DE HONORARIOS</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1">
                         <a href='consultas.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item=<? echo $item ?>&estado=<? echo $estado ?>'  class="link" >Volver al Listado</a>
<?

if (isset($_GET["llave"]))
 echo "<p>Registro Modificado con Exito !";
?>
                         </td>
                      </tr>

                      <tr>
                       <td><hr></td><td><hr></td>
                      </tr>


                   <tr>
                    <td height="50" colspan="3">
<?

                                $sql25 = "Select * from parametros";
                                $res25 = mysql_query($sql25);
                                $row25 = mysql_fetch_array($res25);
                                $mes25=$row25["para_mes"];
                                $anno25=$row25["para_anno"];


      $id=$_GET["id"];
      $sql22 = "Select * from dpp_honorarios where hono_id=$id";
      //echo $sql22;
      $res22 = mysql_query($sql22);
      while($row22 = mysql_fetch_array($res22)){
          $fechabase=$row22["hono_fecha1"];
          $diabase=substr($fechabase,8,2);
          //echo "----".$diabase;

?>

					<table width="488" border="0" cellspacing="0" cellpadding="0">
					  <form name="form1" action="modficahonorarios.php" method="post"  onSubmit="return valida()">
       <?
//                 if ($row22["hono_estado"]==1 and substr($row22["hono_fecha1"],5,2)==$mes25) {
                 if (substr($row22["hono_fecha1"],5,2)==$mes25 or 1==1) {
       ?>
                         <tr>
                             <td  valign="top" class="Estilo1">Fecha </td>
                             <td class="Estilo1">
                             <?
                                $sql2 = "Select * from parametros";
                                $res2 = mysql_query($sql2);
                                $row2 = mysql_fetch_array($res2);
                             ?>
                                  <select name="dia" class="Estilo1">
                                   <option value="">dia...</option>
                                   <option value="01" <?  if ( $diabase=='01') echo "selected=selected" ?> >01</option>
                                   <option value="02" <?  if ( $diabase=='02') echo "selected=selected" ?> >02</option>
                                   <option value="03" <?  if ( $diabase=='03') echo "selected=selected" ?> >03</option>
                                   <option value="04" <?  if ( $diabase=='04') echo "selected=selected" ?> >04</option>
                                   <option value="05" <?  if ( $diabase=='05') echo "selected=selected" ?> >05</option>
                                   <option value="06" <?  if ( $diabase=='06') echo "selected=selected" ?> >06</option>
                                   <option value="07" <?  if ( $diabase=='07') echo "selected=selected" ?> >07</option>
                                   <option value="08" <?  if ( $diabase=='08') echo "selected=selected" ?> >08</option>
                                   <option value="09" <?  if ( $diabase=='09') echo "selected=selected" ?> >09</option>
                                   <option value="10" <?  if ( $diabase=='10') echo "selected=selected" ?> >10</option>
                                   <option value="11" <?  if ( $diabase=='11') echo "selected=selected" ?> >11</option>
                                   <option value="12" <?  if ( $diabase=='12') echo "selected=selected" ?> >12</option>
                                   <option value="13" <?  if ( $diabase=='13') echo "selected=selected" ?> >13</option>
                                   <option value="14" <?  if ( $diabase=='14') echo "selected=selected" ?> >14</option>
                                   <option value="15" <?  if ( $diabase=='15') echo "selected=selected" ?> >15</option>
                                   <option value="16" <?  if ( $diabase=='16') echo "selected=selected" ?> >16</option>
                                   <option value="17" <?  if ( $diabase=='17') echo "selected=selected" ?> >17</option>
                                   <option value="18" <?  if ( $diabase=='18') echo "selected=selected" ?> >18</option>
                                   <option value="19" <?  if ( $diabase=='19') echo "selected=selected" ?> >19</option>
                                   <option value="20" <?  if ( $diabase=='20') echo "selected=selected" ?> >20</option>
                                   <option value="21" <?  if ( $diabase=='21') echo "selected=selected" ?> >21</option>
                                   <option value="22" <?  if ( $diabase=='22') echo "selected=selected" ?> >22</option>
                                   <option value="23" <?  if ( $diabase=='23') echo "selected=selected" ?> >23</option>
                                   <option value="24" <?  if ( $diabase=='24') echo "selected=selected" ?> >24</option>
                                   <option value="25" <?  if ( $diabase=='25') echo "selected=selected" ?> >25</option>
                                   <option value="26" <?  if ( $diabase=='26') echo "selected=selected" ?> >26</option>
                                   <option value="27" <?  if ( $diabase=='27') echo "selected=selected" ?> >27</option>
                                   <option value="28" <?  if ( $diabase=='28') echo "selected=selected" ?> >28</option>
                                   <option value="29" <?  if ( $diabase=='29') echo "selected=selected" ?> >29</option>
                                   <option value="30" <?  if ( $diabase=='30') echo "selected=selected" ?> >30</option>
                                   <option value="31" <?  if ( $diabase=='31') echo "selected=selected" ?> >31</option>
                                  </select>
                                  -<? echo $row2["para_mes"] ?>-<? echo $row2["para_anno"] ?>
                                  <input type="hidden" name="mes" class="Estilo2" size="12" value="<? echo $row2["para_mes"] ?>">
                                  <input type="hidden" name="anno" class="Estilo2" size="12" value="<? echo $row2["para_anno"] ?>">

                             </td>
                           </tr>
<?
  }  else {
?>
                            <tr>
                             <td  valign="top" class="Estilo1">Fecha</td>
                             <td class="Estilo1" colspan=3>
                              <? echo substr($row22["hono_fecha1"],8,2)."-".substr($row22["hono_fecha1"],5,2)."-".substr($row22["hono_fecha1"],0,4)   ?>
                             </td>
                           </tr>
<?
  }
?>
                            <tr>
                             <td  valign="top" class="Estilo1">Egreso</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="codigo" class="Estilo2" size="11" value="<? echo $row22["hono_codigo"] ?>" >
                             </td>
                           </tr>
                           
                         <tr>
                             <td  valign="top" class="Estilo1">Región</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==0) {
                                    $sql2 = "Select * from regiones order by codigo";
                                    echo '<option value="0">Select...</option>';
                                  } else
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["codigo"] ?>" <?  if ( $row2["codigo"]==$row22["hono_region"]) echo "selected=selected" ?>><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>

                            <tr>
                             <td  valign="top" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" value="<? echo $row22["hono_rut"] ?>"> -
                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()" value="<? echo $row22["hono_dig"] ?>">
                             </td>
                           </tr>

                           <tr>
                             <td  valign="top" class="Estilo1">Nombre  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="40" value="<? echo $row22["hono_nombre"] ?>">
                             </td>
                           </tr>
                           <tr>
                            <td  valign="top" class="Estilo1">Detalles  </td>
                            <td  valign="top" class="Estilo1" colspan=3>
                              <table border=1>
                                <tr>
                                  <td class="Estilo1">NºBoleta</td><td class="Estilo1">Bruto</td><td class="Estilo1">Retencion</td><td class="Estilo1">Liquido</td>
                                </tr>
                                <tr>
                                   <td class="Estilo1" >1
                                    <input type="text" name="nboleta1" class="Estilo2" size="10" value="<? echo $row22["hono_nro_boleta"] ?>" onchange="traerDatos2(document.form1.nboleta1.value,document.form1.rut.value,'nboleta1')" >
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="bruto1" class="Estilo2" size="10" value="<? echo $row22["hono_bruto"] ?>" onChange="calcula1()">
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="retencion1" class="Estilo2" size="10" value="<? echo $row22["hono_retencion"] ?>" >
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="liquido1" class="Estilo2" size="10" value="<? echo $row22["hono_liquido"] ?>" >
                                  </td>
                                </tr>
                                </table>


                            </td>
                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1">  </td>
                               <td  valign="center" class="Estilo1">Los Valores no deben ser ingresados con puntos y comas </td>

                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Sub Titulo  </td>
                             <td class="Estilo1" colspan=3>
                              21<input type="radio" name="item" class="Estilo2" value="21" <? if ($row22["hono_item"]==21) echo "checked" ?> >
                              22<input type="radio" name="item" class="Estilo2" value="22" <? if ($row22["hono_item"]==22) echo "checked" ?> >
                              24<input type="radio" name="item" class="Estilo2" value="24" <? if ($row22["hono_item"]==24) echo "checked" ?> >
                              29<input type="radio" name="item" class="Estilo2" value="29"  <? if ($row22["hono_item"]==29) echo "checked" ?>>
                              31<input type="radio" name="item" class="Estilo2" value="31" <? if ($row22["hono_item"]==31) echo "checked" ?> >
                              34<input type="radio" name="item" class="Estilo2" value="34" <? if ($row22["hono_item"]==34) echo "checked" ?>>
                              Otro<input type="radio" name="item" class="Estilo2" value="99" <? if ($row22["hono_item"]==99) echo "checked" ?> >
                              <br>
                             </td>

                           </tr>
<?
$banco2=trim($row22["hono_cuenta"]."|".$row22["hono_banconombre"]);
//echo $banco2."<br>9006028|Bienes y Servicios P.01 Dirnac";

?>
                          <tr>
                             <td  valign="top" class="Estilo1"><br> Banco</td>
                             <td class="Estilo1"><br>
                                <select name="banco" class="Estilo1" >
                                 <option value="">Seleccione...</option>
                                 <option value="9549099|Remuneraciones P.01 Dirnac" <? if ('$banco2'=='9549099|Remuneraciones P.01 Dirnac') { echo "selected"; } ?> >9549099 - Remuneraciones P.01 Dirnac</option>
                                 <option value="9006028|Bienes y Servicios P.01 Dirnac"  <? if ($banco2=='9006028|Bienes y Servicios P.01 Dirnac') { echo "selected"; } ?> >9006028 - Bienes y Servicios P.01 Dirnac</option>
                                 <option value="9001824|Convenio MIDEPLAN P.02"  <? if ($banco2=='9001824|Convenio MIDEPLAN P.02') { echo "selected";} ?> >9001824 - Convenio MIDEPLAN P.02</option>
                                 <option value="9549218|Remuneraciones P.02 Dirnac"  <? if ($banco2=='9549218|Remuneraciones P.02 Dirnac') { echo "selected"; } ?> >9549218 - Remuneraciones P.02 Dirnac</option>
                                 <option value="9020829|Bienes y Servicios P02 Dirnac"  <? if ($banco2=='9020829|Bienes y Servicios P02 Dirnac') { echo "selected"; } ?> >9020829 - Bienes y Servicios P02 Dirnac </option>
                               </select>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1"><br> Programa</td>
                             <td class="Estilo1"><br>
                                <select name="programa" class="Estilo1" >
                                 <option value="">Seleccione...</option>
                                  <option value="CASH" <? if ($row22["hono_programa"]=='CASH') { echo "selected"; } ?> >CASH</option>
                                 <option value="PMI" <? if ($row22["hono_programa"]=='PMI') { echo "selected"; } ?>>PMI</option>
                                 <option value="CECI" <? if ($row22["hono_programa"]=='CECI') { echo "selected"; } ?>>CECI</option>
                                 <option value="CONADI" <? if ($row22["hono_programa"]=='CONADI') { echo "selected"; } ?>>CONADI</option>
                                 <option value="SENADI" <? if ($row22["hono_programa"]=='SENADI') { echo "selected"; } ?>>SENADI</option>
                                 <option value="SUMA ALZADA" <? if ($row22["hono_programa"]=='UMA ALZADA') { echo "selected"; } ?>>SUMA ALZADA</option>
                                 <option value="GORE" <? if ($row22["hono_programa"]=='GORE') { echo "selected"; } ?>>GORE</option>
                                 <option value="META PRESIDENCIAL" <? if ($row22["hono_programa"]=='META PRESIDENCIAL') { echo "selected"; } ?>>META PRESIDENCIAL</option>
                                 <option value="CAPACITACION A TERCEROS"  <? if ($row22["hono_programa"]=='CAPACITACION A TERCEROS') { echo "selected"; } ?> >CAPACITACION A TERCEROS</option>
                               </select>
                             </td>
                           </tr>
                          <tr>
                             <td  valign="top" class="Estilo1"><br> Detalle</td>
                             <td class="Estilo1">
                              P01<input type="radio" name="detalle" class="Estilo2" value="P01"  <? if ($row22["hono_detalle"]=='P01') { echo "checked"; } ?>>
                              P02<input type="radio" name="detalle" class="Estilo2" value="P02"  <? if ($row22["hono_detalle"]=='P02') { echo "checked"; } ?>>
                             </td>
                           </tr>
                          
                           
                           
                           <tr>
                               <td  valign="center" class="Estilo1"><br><br><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
                           <?
//                            echo $row22["hono_estado"]." and ".substr($row22["hono_fecha1"],5,2)."==$mes25 and".substr($row22["hono_fecha1"],0,4)."==$anno25";
//                           if ($row22["hono_estado"]==1 and substr($row22["hono_fecha1"],5,2)==$mes25 and substr($row22["hono_fecha1"],0,4)==$anno25) {
                           if (substr($row22["hono_fecha1"],5,2)==$mes25 and substr($row22["hono_fecha1"],0,4)==$anno25 or 1==1) {
                           ?>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    MODIFICAR BOLETA    " > </td>
                           </tr>
                           <?
                          }
                           ?>


                           <input type="hidden" name="id" value="<? echo $id ?>">
                           <input type="hidden" name="region2" value="<? echo $region ?>">
                           <input type="hidden" name="fecha12" value="<? echo $fecha1 ?>">
                           <input type="hidden" name="fecha22" value="<? echo $fecha2 ?>">
                           <input type="hidden" name="rut2" value="<? echo $rut ?>">
                           <input type="hidden" name="item2" value="<? echo $item?>">
                           <input type="hidden" name="estado2" value="<? echo $estado ?>">
                        </form>
                        <?
}
?>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      
                      <tr>
                      <td><br></tr>
                      </tr>

                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>



</td>
  </tr>
 
 
</table>




              <img src="images/pix.gif" width="1" height="10">

                <br>

                <br>

                <? require("inc/pie.php"); ?>


                <img src="images/pix.gif" width="1" height="10">

              </div>

          </div>

        </div>
        
    </div>
</body>
</html>

<?

?>
