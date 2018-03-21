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
  <title>Facturas y/o Boletas</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="css/estilos.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="librerias/jquery.blockUI.js"></script>

  <script type="text/javascript" src="librerias/js/jscal2.js"></script>
  <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />


  <link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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
     text-transform: uppercase;
   }
   .Estilo1b {
     font-family: Verdana;
     font-weight: bold;
     font-size: 8px;
     color: #003063;
     text-align: center;

   }
   .Estilo1c {
     font-family: Verdana;
     font-weight: bold;
     font-size: 8px;
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
     text-transform: uppercase;
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
<script type="text/javascript" src="select_dependientesargedo.js"></script>
<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

<!-- main calendar program -->
<script type="text/javascript" src="librerias/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
  adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

  <script src="librerias/js/jscal2.js"></script>

  <script src="librerias/js/lang/es.js"></script>

  <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />

  <SCRIPT LANGUAGE ="JavaScript">



  </script>
  <script language="javascript">
    <!--

    function mostrar22() {
//      nn=document.form1.tipodoc1.value;
//      alert ("Entra "+nn);
if (document.form1.tipodoc1.value=='LICENCIA MÉDICA')  {
 seccion1.style.display="";
} else {
 seccion1.style.display="none";
}
}


function nuevoAjax(){
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
  if (rut!='') {
    traerDatos(rut);
  }


}

}

function traerDatos(tipoDato)  {
	var ajax=nuevoAjax();
  ajax.open("POST", "buscaclient.php", true);
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  ajax.send("d="+tipoDato);
  ajax.onreadystatechange=function()	{
    if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
      var Date =ajax.responseText;
      var elem = Date.split('/');
      document.form1.nombre1.value=elem[0];
//            document.form1.calidad.value=elem[4];
//            document.form1.estamento.value=elem[5];
//            document.form1.grado.value=elem[6];
//            document.form1.cargo.value=elem[7];
//            document.form1.region2.value=elem[8];
//            document.form1.unidad.value=elem[9];


}
}
}



function autoescribe() {
  document.form1.numeroext.value=document.form1.numfolio1.value+"-"+document.form1.numfolio2.value;
  document.form1.materia.value="LICENCIA MEDICA N°"+document.form1.numfolio1.value+"-"+document.form1.numfolio2.value+" POR "+document.form1.dias.value+" DIAS DE "+document.form1.nombre1.value;
}


function valida() {
  if (document.form1.tipodoc1.value=='') {
    alert ("Tipo Documento presenta problemas ");
    return false;
  }
  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && document.form1.numfolio1.value=='') {
    alert ("Numero de Folio presenta problemas ");
    return false;
  }
  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && document.form1.numfolio2.value=='') {
    alert ("Numero de Folio presenta problemas ");
    return false;
  }
  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && document.form1.rut.value=='') {
    alert ("RUT presenta problemas ");
    return false;
  }
  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && document.form1.dig.value=='') {
    alert ("Digito presenta problemas ");
    return false;
  }
  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && document.form1.nombre1.value=='') {
    alert ("Nombre Funcionario presenta problemas ");
    return false;
  }
  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && document.form1.dias.value=='') {
    alert ("N° Dias presenta problemas ");
    return false;
  }
  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && document.form1.tipolicencia.value=='') {
    alert ("Tipo Licencia presenta problemas ");
    return false;
  }
  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && (document.form1.carareposo[0].checked == '' && document.form1.carareposo[1].checked == '')) {
    alert ("Caracteristica del Reposo presenta problemas ");
    return false;
  }

  if (document.form1.tipodoc1.value=='LICENCIA MÉDICA' && document.form1.archivo1.value=='') {
    alert ("Adjunto 1 presenta problemas ");
    return false;
  }



  if (document.form1.fecha2.value=='') {
    alert ("Fecha Dcoumento presenta problemas ");
    return false;
  }

  if (document.form1.materia.value=='') {
    alert ("Materia presenta problemas ");
    return false;
  }

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }

}

function validaGeneraguia() {

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA GENERACIÓN DE GUÍA ?')) {
    blockUI();
  }
  else{
    return false;
  }
}


//-->

</script>
<?

function generaPaises()
{
//	include 'conexion.php';
//	conectar();
	$consulta=mysql_query("SELECT id, opcion FROM area");
    //echo $consulta;
//	desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='paises' id='paises' onChange='cargaContenido2(this.id)'>";
	echo "<option value='0'>Seleccione...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}

$ti=$_GET["ti"];

if ($ti==1) {
 $prefijo="Resolucion Afecta";

}
if ($ti==2) {
 $prefijo="Resolucion Exenta";
}
if ($ti==3) {
 $prefijo="Oficio";
}


?>
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
          <td height="20" colspan="2"><span class="Estilo7">INGRESO DE CORRESPONDENCIA RECIBIDA</span></td>
        </tr>
        <tr>
         <td width="487" valign="top" class="Estilo1">
           <a href="argedo_menudocs.php" class="link">VOLVER</a> <br>

         </td>
       </tr>

       <tr>
         <td></td><td></td>
       </tr>

       <tr>
         <td></td><td></td>
       </tr>
       <tr>
         <td width="487" valign="top" class="Estilo1c">

          <?





          if (isset($_GET["llave"]))
           echo "<p>Registros insertados con Exito !";
         ?>
       </td>
     </tr>

     <tr>
       <td><hr></td><td><hr></td>


     </tr>
     <?
     $campo="fol_reg".$regionsession."_4";
     $sql2="select $campo as folio from argedo_folios where fol_id=1 ";
//  echo $sql2."<br>";
     $result2=mysql_query($sql2);
     $row2=mysql_fetch_array($result2);
     $foliomio=$row2["folio"];
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
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <form name="form1" action="argedo_grabarecibida.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">

          <tr class="Estilo8"><td colspan="4">PASO 1: INGRESO DE DOCUMENTO<td></tr>


          <tr>
           <td  valign="center" class="Estilo1"  width="190">FECHA RECEPCIÓN OFICINA DE PARTES</td>
           <td class="Estilo1" valign="center">
            <input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" ><? //echo $date_in ?>
            <img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
            onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

            <script type="text/javascript">
        //       Calendar.setup({
        // inputField     :    "f_date_c1",     // id of the input field
        // ifFormat       :    "%d-%m-%Y",      // format of the input field
        // button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        // align          :    "Tl",           // alignment (defaults to "Bl")
        // singleClick    :    true
        Calendar.setup({
          inputField   :  "f_date_c1",
          trigger     :  "f_trigger_c1",
              onSelect   : function() { this.hide() }, //NUEVO
              dateFormat    :  "%d-%m-%Y",
              max : <?php echo date("Ymd") ?>,
              showTime   : 12,

            });
          </script>


        </td>
      </tr>
      <tr><td><br></td><tr>
       <tr>
         <td  valign="center" class="Estilo1">Regi&oacute;n</td>
         <td class="Estilo1">
          <select name="region" class="Estilo1">

           <?
           if ($regionsession==0) {
            $sql2 = "Select * from regiones order by codigo";
            echo '<option value="">Select...</option>';
          } else
          $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
          $res2 = mysql_query($sql2);

          while($row2 = mysql_fetch_array($res2)){

           ?>
           <option value="<? echo $row2["codigo"] ?>"><? echo $row2["nombre"] ?></option>

           <?
         }
         ?>


       </select>


     </td>
   </tr>
   <tr><td><br></td><tr>
     <tr>
       <td  valign="center" class="Estilo1">Fecha Documento <font color="#FF0000">* </font></td>
       <td class="Estilo1">
        <input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" >
        <img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

        <script type="text/javascript">
          Calendar.setup({
        // inputField     :    "f_date_c2",     // id of the input field
        // ifFormat       :    "%d-%m-%Y",      // format of the input field
        // button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        // align          :    "Tl",           // alignment (defaults to "Bl")
        // singleClick    :    true

        inputField   :  "f_date_c2",
        trigger     :  "f_trigger_c2",
              onSelect   : function() { this.hide() }, //NUEVO
              dateFormat    :  "%d-%m-%Y",
              max : <?php echo date("Ymd") ?>,
              showTime   : 12,
            });
          </script>


        </td>
      </tr>

      <tr>
       <td><hr></td><td><hr></td>

       <tr>
         <td  valign="center" class="Estilo1">TIPO DOCUMENTO.</td>
         <td class="Estilo1">
          <select name="tipodoc1" class="Estilo1" onChange="mostrar22();">
            <option value="">Seleccione...</option>

            <?
            $sql2 = "Select * from argedo_tipodoc order by tipodoc_nombre ";
            $res2 = mysql_query($sql2);

            while($row2 = mysql_fetch_array($res2)){

             ?>
             <option value="<? echo $row2["tipodoc_nombre"] ?>"><? echo $row2["tipodoc_nombre"] ?></option>

             <?
           }
           ?>


         </select>


       </td>
     </tr>
   </table>
   <table width="488" border="0" cellspacing="0" cellpadding="0" id="seccion1" style="display:none">


    <tr>
     <td  valign="center" class="Estilo1"  width="190"><br>NÚMERO FOLIO <font color="#FF0000">* </font></td>
     <td class="Estilo1" colspan=3>
      <input type="text" name="numfolio1" class="Estilo2" size="3" onkeyup="autoescribe();" >
      <input type="text" name="numfolio2" class="Estilo2" size="11" onkeyup="autoescribe();" >
    </td>
  </tr>
  <tr>
   <td  valign="center" class="Estilo1"><br>RUT FUNCIONARIO <font color="#FF0000">* </font></td>
   <td class="Estilo1" colspan=3>
    <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" > -
    <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()">  Rut sin puntos
  </td>
</tr>

<tr>
 <td  valign="center" class="Estilo1"><br>NOMBRE FUNCIONARIO <font color="#FF0000">* </font></td>
 <td class="Estilo1" colspan=3><br>
  <input type="text" name="nombre1" class="Estilo2" size="40" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; " >
</td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">FECHA EMISIÓN LICENCIA <font color="#FF0000">* </font></td>
 <td class="Estilo1">
  <input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c3" >
  <img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
  <script type="text/javascript">

    Calendar.setup({
      inputField   :  "f_date_c3",
      trigger     :  "f_trigger_c3",
onSelect   : function() { this.hide() }, //NUEVO
dateFormat    :  "%d-%m-%Y",
showTime   : 12,
max : <?php echo Date("Ymd") ?>
});

</script>
</td>
</tr>


<tr>
  <td class="Estilo1" valign="center">INICIO REPOSO</td>
  <td class="Estilo1" valign="center">

    <input type="text" name="fecha4" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c4" >
    <img src="calendario.gif" id="f_trigger_c4" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
    <script type="text/javascript">
     Calendar.setup({
      inputField   :  "f_date_c4",
      trigger     :  "f_trigger_c4",
onSelect   : function() { this.hide() }, //NUEVO
dateFormat    :  "%d-%m-%Y",
showTime   : 12,
max : <?php echo Date("Ymd") ?>
});
</script>

</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1"><br>NÚMERO DIAS <font color="#FF0000">* </font></td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="dias" class="Estilo2" size="3" onkeyup="autoescribe();">
</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1">TIPO LICENCIA <font color="#FF0000">* </font></td>
 <td class="Estilo1">
  <select name="tipolicencia" class="Estilo1">
    <option value="">Seleccione...</option>
    <option value="1/ENFERMEDAD O ACCIDENTE COMUN">1 ENFERMEDAD O ACCIDENTE COMUN</option>
    <option value="2/PRORROGA MEDICINA PREVENTIVA">2 PRORROGA MEDICINA PREVENTIVA</option>
    <option value="3/LICENCIA MATERNAL PRE Y POST NATAL">3 LICENCIA MATERNAL PRE Y POST NATAL</option>
    <option value="4/ENFERMEDAD GRAVE HIJO MENOR DE 1 AÑO">4 ENFERMEDAD GRAVE HIJO MENOR DE 1 AÑO</option>
    <option value="5/ACCIDENTE DEL TRABAJO DEL TRAYECTO">5 ACCIDENTE DEL TRABAJO DEL TRAYECTO</option>
    <option value="6/ENFERMEDAD PROFESIONAL"> 6 ENFERMEDAD PROFESIONAL</option>
    <option value="7/PATOLOGIA DEL EMBARAZO">7 PATOLOGIA DEL EMBARAZO</option>
  </select>


</td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">CARACTERISTICA DEL REPOSO <font color="#FF0000">* </font></td>
 <td class="Estilo1" colspan=4>
  <input type="radio" name="carareposo" class="Estilo2" value="1/REPOSO LABORAL TOTAL" >1 Reposo Laboral Total <br>
  <input type="radio" name="carareposo" class="Estilo2" value="2/REPOSO LABORAL PARCIAL" >2 Reposo Laboral Parcial  <br>
</td>
</tr>
<tr>
 <td colspan=3><hr></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
   <td  valign="center" class="Estilo1" width="200"><br>NÚMERO EXTERNO </td>
   <td class="Estilo1" colspan=3><br>
    <input type="text" name="numeroext" class="Estilo2" size="11" onkeyup="this.value=this.value.toUpperCase()" >
  </td>
</tr>

<tr>
 <td  valign="center" class="Estilo1" width="200"><br>NÚMERO INTERNO </td>
 <td class="Estilo1" colspan=3><br>
  <input type="text" name="numeroint" class="Estilo2" size="11" onkeyup="this.value=this.value.toUpperCase()" >
</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1"><br>MATERIA  <font color="#FF0000">* </font></td>
 <td class="Estilo1" colspan=3><br>
   <textarea name="materia" rows="3" cols="50" class="Estilo2" onkeyup="this.value=this.value.toUpperCase()"  onkeypress="if (event.keyCode ==13 || event.keyCode==39) event.returnValue = false;" ></textarea>
 </td>
</tr>
<tr>
 <td  valign="center" class="Estilo1"><br>REMITE  </td>
 <td class="Estilo1" colspan=3><br>
   <textarea name="remite" rows="2" cols="50" class="Estilo2" onkeyup="this.value=this.value.toUpperCase()" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>
 </td>
</tr>
<tr>
 <td  valign="center" class="Estilo1"><br>DESTINATARIO  </td>
 <td class="Estilo1" colspan=3><br>
   <textarea name="destinatario" rows="2" cols="50" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>
 </td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">J0RNADA</td>
 <td class="Estilo1" colspan=4>
  <input type="radio" name="jornada" class="Estilo2" value="Mañana" >Mañana <br>
  <input type="radio" name="jornada" class="Estilo2" value="Tarde" >Tarde  <br>
</td>
</tr>





<tr>
 <td  valign="center" class="Estilo1"><br>OBSERVACIÓN  </td>
 <td class="Estilo1" colspan=3><br>
   <textarea name="obs" rows="3" cols="50" class="Estilo2"  onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>
 </td>
</tr>

<tr>
 <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 1 </td>
 <td class="Estilo1" colspan=3><br>
  <input type="file" name="archivo1" class="Estilo2" size="40"  >
</td>
</tr>
<tr>
 <td  valign="center" class="Estilo1" colspan="4"><BR><font color="#FF0000"> * CAMPOS OBLIGATORIOS </font></td>
</tr>




</tr>
<tr>
 <td><br></td><td><br></td>


</tr>



<tr>
 <td  valign="center" class="Estilo1"><br>  </td>
 <td  valign="center" class="Estilo1"> </td>

</tr>

<tr>
 <td  valign="center" class="Estilo1"><br> </td>
 <td  valign="center" class="Estilo1"> </td>

</tr>
<tr>
 <td colspan=4 align="center" class="Estilo7">Último Correlativo : <? echo $foliomio ?>, el próximo es : <? echo $foliomio2 ?> </td>
</tr>
<tr>
 <td  valign="center" class="Estilo1"><br>  </td>
 <td  valign="center" class="Estilo1"> </td>

</tr>

<tr>
 <td colspan=4 align="center"> <input type="submit" value="GRABAR CORRESPONDENCIA RECIBIDA" > </td>
</tr>

<input type="hidden" name="ti" value="<? echo $ti; ?>" >
<input type="hidden" name="contrato" >

</form>

</td>


<tr>
 <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
</tr>



<tr>
  <td colspan="8">
    <table border=1>



      <tr class="Estilo8">PASO 2: CONFECCIÓN GUÍA DESPACHO INTERNO</tr> 

      <?
      $sql21="select max(eta_folioguia) as foliomio from dpp_etapas where eta_region='$regionsession' ";
//  echo $sql21;
      $result21=mysql_query($sql21);
      $row21=mysql_fetch_array($result21);
      $foliomio=$row21["foliomio"];
      $foliomio=$foliomio+1;


      ?>

      <tr>
       <td class="Estilo1" colspan=4>
        <form name="form2" action="argedo_grabaasignaguia.php" method="post" onsubmit="return validaGeneraguia()" >

          <tr>
           <td  valign="center" class="Estilo1" colspan=9>Destinatario
            <input type="text" name="destinatario2" class="Estilo2" size="50" value="" required>
            <td>


            </tr>



            <tr>
             <td class="Estilo1b">ITEM</td>
             <td class="Estilo1b">FOLIO</td>
             <td class="Estilo1b">FECHA</td>
             <td class="Estilo1b">TIPO</td>
             <td class="Estilo1b">N° EXTERNO</td>
             <td class="Estilo1b">N° INTERNO</td>
             <td class="Estilo1b">REMITE</td>
             <td class="Estilo1b">MATERIA</td>
             <td class="Estilo1b">DESTINATARIO</td>
           </tr>

           <?



           if ($regionsession==0) {
             $sql="select * from argedo_recibida where reci_estado=1 and reci_folioguia=0 order by eta_folio desc";
           } else {
             $sql="select * from argedo_recibida where reci_estado=1 and reci_folioguia=0 and reci_defensoria ='$regionsession' order by reci_folio desc";
           }


//echo $sql;
           $res3 = mysql_query($sql);
           $cont=1;

           while($row3 = mysql_fetch_array($res3)){
            $fechahoy = $date_in2;
            $dia1 = strtotime($fechahoy);
            $fechabase =$row3["eta_fecha_recepcion"];
            $dia2 = strtotime($fechabase);
            $diff=$dia1-$dia2;
            $diff=intval($diff/(60*60*24));
            if ($etapa1a>=$diff)
             $clase="Estilo1cverde";
           if ($etapa1a<$diff and $etapa1b>=$diff )
            $clase="Estilo1camarrillo";
          if ( $etapa1b<$diff)
            $clase="Estilo1crojo";


          $sql5="select * from dpp_plazos ";
   //echo $sql;
          $res5 = mysql_query($sql5);
          $row5 = mysql_fetch_array($res5);
          $etapa1a=$row5["pla_etapa1a"];
          $etapa1b=$row5["pla_etapa1b"];



          ?>


          <tr>
           <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["reci_id"] ?>" class="Estilo2" >  </td>
           <td class="Estilo1b"><? echo $row3["reci_folio"]  ?> </td>                        
           <td class="Estilo1b"><? echo substr($row3["reci_fecha_recep"],8,2)."-".substr($row3["reci_fecha_recep"],5,2)."-".substr($row3["reci_fecha_recep"],0,4)   ?></td>
           <td class="Estilo1b"><? echo $row3["reci_tipodoc"]  ?> </td>
           <td class="Estilo1b"><? echo $row3["reci_numero"]  ?> </td>
           <td class="Estilo1b"><? echo $row3["reci_int"]  ?> </td>
           <td class="Estilo1b"><? echo $row3["reci_remite"]  ?> </td>
           <td class="Estilo1b"><? echo $row3["reci_materia"]  ?> </td>
           <td class="Estilo1b"><? echo $row3["reci_destinatario"]  ?> </td>
         </tr>





         <?

         $cont++;

       }
       ?>
       <tr>
         <td  valign="center" class="Estilo1" colspan=9 align="center"><input type="submit" name="boton" class="Estilo2" value="  Generar Guía "> </td>


         <input type="hidden" name="cont" value="<? echo $cont ?>" >
         <input type="hidden" name="sw2" value="1" >
       </form>
     </tr>


   </table>
   <!-- BUSCADOR !-->
   <br><br>

   <form action="argedo_recibida.php" method="POST">
    <table width="100%" border="1">
      <tr align="center">
        <td class="Estilo8" colspan="4">BUSCADOR DE GUIAS INTERNAS</td>
      </tr>

      <tr>
        <td class="Estilo1b">FECHA DESDE</td>
        <td class="Estilo1">
          <input type="text" name="carto_fecha_desde" id="carto_fecha_desde" value="<?php echo $_POST["carto_fecha_desde"] ?>" readonly style="background: #E3E3E3">
          <i class="fa fa-calendar fa-lg" id="f_trigger_b" style="cursor: pointer;"></i>
          <script type="text/javascript">
            Calendar.setup({
              inputField   :  "carto_fecha_desde",
              trigger     :  "f_trigger_b",
              onSelect   : function() { this.hide() }, //NUEVO
              dateFormat    :  "%Y-%m-%d",
              max : <?php echo date("Ymd") ?>,
              showTime   : 12,
            });
          </script>
        </td>
        <td class="Estilo1b">FECHA HASTA</td>
        <td class="Estilo1">
          <input type="text" name="carto_fecha_hasta" id="carto_fecha_hasta" value="<?php echo $_POST["carto_fecha_hasta"] ?>" readonly style="background: #E3E3E3">
          <i class="fa fa-calendar fa-lg" id="f_trigger_c" style="cursor: pointer;"></i>
          <script type="text/javascript">
            Calendar.setup({
              inputField   :  "carto_fecha_hasta",
              trigger     :  "f_trigger_c",
              onSelect   : function() { this.hide() }, //NUEVO
              dateFormat    :  "%Y-%m-%d",
              max : <?php echo date("Ymd") ?>,
              showTime   : 12,
            });
          </script>
        </td>
      </tr>



      <tr>
        <td class="Estilo1b">FOLIO DESDE</td>
        <td class="Estilo1"><input type="number" name="carto_folio_desde" value="<?php echo $_POST["carto_folio_desde"] ?>"></td>
        <td class="Estilo1b">FOLIO HASTA</td>
        <td class="Estilo1"><input type="number" name="carto_folio_hasta" value="<?php echo $_POST["carto_folio_hasta"] ?>"></td>
      </tr>

      <tr>

        <td class="Estilo1b">DESTINATARIO</td>

        <td class="Estilo1">

          <input type="text" name="carto_region_destino" value="<?php echo $_POST["carto_region_destino"] ?>" class="Estilo1mc">

        </td>

      </tr>

      <tr>
        <td colspan="4" align="center">
          <button type="submit" name="cartola" value="1" class="btn btn-xs btn-primary">BUSCAR</button>
          <a href="argedo_recibida.php" class="btn btn-xs btn-danger">LIMPIAR</a>
        </td>
      </tr>
    </table>
  </form>
  <!-- FIN BUSCADOR !-->


  <table border=1>
    <tr></tr>


    <br>
    <tr class="Estilo8">PASO 3: IMPRIMIR GUÍA DESPACHO INTERNO</tr> 

    <tr>
     <td class="Estilo1b">Nº de Guía</td>
     <td class="Estilo1b">Nombre Destinatario</td>
     <td class="Estilo1b">Fecha Guía</td>
     <td class="Estilo1b">Ver Guía</td>
   </tr>
   <?
//  $sql="select * from argedo_recibida where reci_estado=1 and reci_folioguia=0 and reci_defensoria ='$regionsession' order by reci_folio desc";
   if(isset($_POST) && $_POST["cartola"])
   {
    $where = "";
    if($_POST["carto_fecha_desde"] <> "")
    {
      $where.="reci_fechaguia >= '".$_POST["carto_fecha_desde"]."' AND ";
    }

    if($_POST["carto_fecha_hasta"] <> "")
    {
      $where.="reci_fechaguia <= '".$_POST["carto_fecha_hasta"]."' AND ";
    }

    if($_POST["carto_folio_desde"] <> "")
    {
      $where.="reci_folioguia >= '".$_POST["carto_folio_desde"]."' AND ";
    }

    if($_POST["carto_folio_hasta"] <> "")
    {
      $where.="reci_folioguia <= '".$_POST["carto_folio_hasta"]."' AND ";
    }

    if($_POST["carto_region_destino"] <> "")
    {
      $where.="reci_destinatario2  LIKE '%".$_POST["carto_region_destino"]."%' AND ";
    }

    $sql = "SELECT * FROM argedo_recibida WHERE reci_defensoria = '".$regionsession."' AND $where reci_folioguia <> 0 group by reci_folioguia order by reci_folioguia desc";
  }else{
   $sql="SELECT * FROM argedo_recibida where  reci_defensoria ='$regionsession' and reci_folioguia<>0 group by reci_folioguia order by reci_folioguia desc LIMIT 0 , 60 ";
 }
// echo $sql;
 $res3 = mysql_query($sql);
 $cont=1;

 while($row3 = mysql_fetch_array($res3)){
  $fechahoy = $date_in;
  $dia1 = strtotime($fechahoy);
  $fechabase =$row3["eta_fecha_recepcion"];
  $dia2 = strtotime($fechabase);
  $diff=$dia1-$dia2;
  $diff=intval($diff/(60*60*24));
  if ($etapa1a>=$diff)
    $clase="Estilo1cverde";
  if ($etapa1a<$diff and $etapa1b>=$diff )
    $clase="Estilo1camarrillo";
  if ( $etapa1b<$diff)
    $clase="Estilo1crojo";

  ?>


  <tr>
   <td class="Estilo1b"><? echo $row3["reci_folioguia"] ?> </td>
   <td class="Estilo1b" title="<? echo $row3["reci_destinatario2"]  ?>"><? echo $row3["reci_destinatario2"]  ?></td>
   <td class="Estilo1b" title="<? echo $row3["reci_fechaguia"]  ?>"><? echo $row3["reci_fechaguia"]  ?></td>
   <td class="Estilo1c"><a href="argedo_imprimirguia.php?guia=<? echo $row3["reci_folioguia"] ?>" class="link" target="_blank">IMPRIMIR</a></td>

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
