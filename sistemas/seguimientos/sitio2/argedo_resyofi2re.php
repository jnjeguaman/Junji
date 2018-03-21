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
$ti=$_GET["ti"];
?>
<html>
<head>
<title>Argedo</title>
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
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />


<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--

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

function peso(tipoDato,c)  {
	var ajax=nuevoAjax();
//    alert (" dato "+tipoDato);
 	ajax.open("POST", "peso.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("d="+tipoDato);

	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
//			document.form1.nombre.value=ajax.responseText;
//            nombre2.innerText=ajax.responseText;
              var nn=ajax.responseText;
//              alert(nn);
              if (nn=='1')  {
                  alert("Archivo muy grande");
                  document.getElementById(c).value ="1";
              }
              if (nn=='0')  {
                    document.getElementById(c).value ="0";
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
  var33=document.form1.peso1.value;
  if (document.form1.peso1.value=='1') {
      alert ("Archivo 1 presenta problemas ");
      return false;
  }
  if (document.form1.peso2.value=='1') {
      alert ("Archivo 2 presenta problemas ");
      return false;
  }
  if (document.form1.peso3.value=='1') {
      alert ("Archivo 3 presenta problemas ");
      return false;
  }
  if (document.form1.peso4.value=='1') {
      alert ("Archivo 4 presenta problemas ");
      return false;
  }


  if (document.form1.fecha2.value=='') {
      alert ("Fecha Dcoumento presenta problemas ");
      return false;
  }
  if (document.form1.tipo.value=='') {
      alert ("Area presenta problemas "+var33);
      return false;
  }
  if (document.form1.contrato.value=='') {
      alert ("Subarea presenta problemas ");
      return false;
  }
  
<?
 if ($ti==1) {
?>

  if (document.form1.tramite[0].checked == '' && document.form1.tramite[1].checked == '' ) {
      alert ("Tramite presenta problemas ");
      return false;
  }
  if (document.form1.op1[0].checked != '' && document.form1.materia.value=='' ) {
      alert ("Materia presenta problemas ");
      return false;
  }
  
  if ((document.form1.op1[1].checked !='' || document.form1.op1[2].checked !='') && document.form1.nombre1.value=='' ) {
      alert ("Nombre Funcionario presenta problemas ");
      return false;
  }
  if ((document.form1.op1[1].checked !='' || document.form1.op1[2].checked !='') && document.form1.fechaini1.value=='' ) {
      alert ("Fecha Inicio presenta problemas ");
      return false;
  }
  if ((document.form1.op1[1].checked !='' || document.form1.op1[2].checked !='') && document.form1.fechater1.value=='' ) {
      alert ("Fecha Termino presenta problemas ");
      return false;
  }

  if (document.form1.op1[3].checked !='' && document.form1.nombre2.value=='' ) {
      alert ("Nombre Funcionario presenta problemas ");
      return false;
  }

  if (document.form1.op1[3].checked !='' && document.form1.destino2.value=='' ) {
      alert ("Destino presenta problemas ");
      return false;
  }
  
  if (document.form1.op1[3].checked !='' && document.form1.fechaini2.value=='' ) {
      alert ("Fecha Inicio presenta problemas ");
      return false;
  }
  
  if (document.form1.op1[3].checked !='' && document.form1.fechater2.value=='' ) {
      alert ("Fecha Termino presenta problemas ");
      return false;
  }
  if (document.form1.op1[4].checked !='' && (document.form1.archivo1.value!='' || document.form1.archivo2.value!='' || document.form1.archivo3.value!='' || document.form1.archivo4.value!='')) {
      alert ("Documento reservado no pueden llevar archivo ");
      return false;
  }

<?
}
if ($ti==2 or $ti==3) {
?>
  if (document.form1.ti.value == 2 && document.form1.materia.value=='' ) {
      alert ("Materia presenta problemas ");
      return false;
  }
  if (document.form1.ti.value == 3 && document.form1.materia.value=='' ) {
      alert ("Materia presenta problemas ");
      return false;
  }

<?
}
?>


}



function mostrar() {
       document.form1.materia.value="";
    if (document.form1.op1[0].checked!='')  {
       seccion3.style.display="";
       seccion1.style.display="none";
       seccion2.style.display="none";
    }

    if (document.form1.op1[1].checked!='')  {
       seccion1.style.display="";
       seccion2.style.display="none";
       seccion3.style.display="none";

    }
    if (document.form1.op1[2].checked!='')  {
       seccion1.style.display="";
       seccion2.style.display="none";
       seccion3.style.display="none";
    }

    if (document.form1.op1[3].checked!='') {
       seccion1.style.display="none";
       seccion2.style.display="";
       seccion3.style.display="none";
    }
    if (document.form1.op1[4].checked!='') {
       seccion1.style.display="none";
       seccion2.style.display="none";
       seccion3.style.display="none";
       document.form1.materia.value="RESERVADO"
//    document.getElementById("piso2").style.visibility="hidden";
//    document.getElementById("checkbox3").style.visibility="visible";
    }

}

function mostrar() {

       seccion1b.style.display="";
//       div41.style.display="none";
//       div5.style.display="none";
}

function mostrar2() {

    document.form1.submit();
//       seccion1b.style.display="";
//       div41.style.display="none";
//       div5.style.display="none";
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



  if ($ti==1) {
   $prefijo="RESOLUCIÓN EXENTA";

  }
  if ($ti==2) {
   $prefijo="RESOLUCIÓN AFECTA";
  }
  if ($ti==3) {
   $prefijo="OFICIO";
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
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE DOCUMENTOS (<? echo $prefijo ?>)</span></td>
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
                         <td width="487" valign="top" class="Estilo1c">
                         
<?





if (isset($_GET["llave"])) {
 $llave=$_GET["llave"];
 if ($llave==0) {
   echo "<p>Registros insertados con Exito !";
 }
 if ($llave==1) {
//   echo "<p><font color='#FF0000'>Registros NO insertados, Problemas con Tamaño de Archivos !</font></p>";
 }
}

?>
                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
<?
  $campo="fol_reg".$regionsession."_".$ti;
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
				  <form name="form2" action="argedo_grabaresyofi2.php" method="post"  >
                              <input type="hidden" name="ti" value="<? echo $ti; ?>" >
                              <input type="hidden" name="prefijo" value="<? echo $prefijo; ?>" >
                  </form>
                  </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                             <td  valign="center" class="Estilo1" width="200">Resolucion Exenta RR.HH.</td>
				             <td class="Estilo1">
                              <input type="radio" name="rrhh" class="Estilo2" value="1" onclick="mostrar2();"> SI
                              <input type="radio" name="rrhh" class="Estilo2" value="2" onclick="mostrar();" > NO
                             </td>
                           </tr>
                    </table>
                
             <div id="seccion1b" style="display:">
             
             
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
     
				  <form name="form1" action="argedo_grabaresyofi.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">

                          <tr><td><br></td><tr>
<tr>
                             <td  valign="center" class="Estilo1">Fecha Recepción Oficina de Partes</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly="1">
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
                          <tr><td><br></td><tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1" width="340">
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
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" readonly="1">
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
                       <td><hr></td><td><hr></td>
                            <tr>
                             <td  valign="center" class="Estilo1">ÁREA <font color="#FF0000">* </font></td>
				             <td>
<?
  if ($regionsession==15) {
?>
                               <select name="tipo" class="Estilo1">
 						          <option value="">Seleccione...</option>
  						          <option value="3">DN Defensor Nacional</option>
  						          <option value="4">DAN Director Administrativo Nacional</option>
                               </select>
<?
} else {
?>
                               <select name="tipo" class="Estilo1">
 						          <option value="">Seleccione...</option>
  						          <option value="3">DR Defensor Regional</option>
  						          <option value="4">DAR Director Administrativo Regional</option>
                               </select>

<?
}
?>
                             </td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">SUBÁREA <font color="#FF0000">* </font></td>
                             <td class="Estilo1">
                              <input type="hidden" name="estados" class="Estilo2" size="40"  value="RRHH Recursos Humanos" >RRHH Recursos Humanos

                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>EN TRÁMITE  <font color="#FF0000">* </font></td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="radio" name="tramite" class="Estilo2" value="SI" > Si<br>
                              <input type="radio" name="tramite" class="Estilo2" value="NO" checked> No <br>
                             </td>
                           </tr>
<?
if ($ti==1) {
?>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>TIPO RESOLUCIÓN EXENTA</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="radio" name="op1" class="Estilo2" value="NORMAL" checked onclick="mostrar();">Res. Exenta "Normal"<br>
                              <input type="radio" name="op1" class="Estilo2" value="PERMISO ADMINISTRATIVO" onclick="mostrar();">Res. Exenta "Permiso Administrativo"<br>
                              <input type="radio" name="op1" class="Estilo2" value="FERIADO LEGAL" onclick="mostrar();">Res. Exenta "Feriado Legal"<br>
                              <input type="radio" name="op1" class="Estilo2" value="COMETIDO FUNCIONARIO" onclick="mostrar();">Res. Exenta "Cometido Funcionario"<br>
                              <input type="radio" name="op1" class="Estilo2" value="RESERVADO" onclick="mostrar();">Res. Exenta "Reservado"<br>
                             </td>
                           </tr>
                     </table>
                    <div id="seccion1" style="display:none">
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1"><br>NOMBRE FUNCIONARIO</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="nombre1" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>FECHA INICIO</td>
                             <td class="Estilo1" colspan=3><br>

<input type="text" name="fechaini1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c3" readonly="1">
<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c3",
        trigger    : "f_trigger_c3",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>FECHA TÉRMINO</td>
                             <td class="Estilo1" colspan=3><br>
<input type="text" name="fechater1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c4" readonly="1">
<img src="calendario.gif" id="f_trigger_c4" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c4",
        trigger    : "f_trigger_c4",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>


                             </td>
                           </tr>



                    </table>
                    </div>
                    <div id="seccion2" style="display:none">
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1"><br>NOMBRE FUNCIONARIO</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="nombre2" class="Estilo2" size="40"  onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>DESTINO COMETIDO</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="destino2" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>FECHA INICIO</td>
                             <td class="Estilo1" colspan=3><br>
<input type="text" name="fechaini2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c5" readonly="1">
<img src="calendario.gif" id="f_trigger_c5" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c5",
        trigger    : "f_trigger_c5",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>FECHA TÉRMINO</td>
                             <td class="Estilo1" colspan=3><br>
<input type="text" name="fechater2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c6" readonly="1">
<img src="calendario.gif" id="f_trigger_c6" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c6",
        trigger    : "f_trigger_c6",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                           </tr>



                    </table>
                    </div>
                    <div id="seccion3" style="display:visibility">
   					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1" ><br>MATERIA 1 <font color="#FF0000">* </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                             <td class="Estilo1" colspan=3><br>
                             <textarea name="materia" rows="3" cols="63" class="Estilo2" onkeyup="this.value=this.value.toUpperCase()"></textarea>
                             </td>
                           </tr>
                   </table>
                   </div>

        
  					<table width="488" border="0" cellspacing="0" cellpadding="0">
                           
<?


} else {
?>
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1" ><br>MATERIA 2<font color="#FF0000">* </font> </td>
                             <td class="Estilo1" colspan=3><br>
                             <textarea name="materia" rows="3" cols="40" class="Estilo2" onkeyup="this.value=this.value.toUpperCase()"></textarea>
                             </td>
                           </tr>


<?
}
if ($ti==3) {
?>
                            <tr>
                             <td  valign="center" class="Estilo1">Tipo de Documento</td>
                             <td class="Estilo1" colspan=4>
<?
if ($regionsession==15) {

?>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DN" > Oficio DN <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DAN" > Oficio DAN  <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DEPTO" > Oficio DEPTO  <br>
<?
} else {
?>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DEPTO" > Oficio DEPTO  <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DAR" > Oficio DAR  <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DR" > Oficio DR  <br>
<?
}
?>
             </td>
                           </tr>
<?
}
?>
                            <tr>
                             <td  valign="center" class="Estilo1" width="340"><br>DESTINATARIO  </td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="destinatario" class="Estilo2" size="65" onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1" width="340"><br>OBSERVACIÓN  </td>
                             <td class="Estilo1" colspan=3><br>
                             <textarea name="obs" rows="3" cols="40" onkeyup="this.value=this.value.toUpperCase()"></textarea>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 1</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo1" class="Estilo2" size="40" onchange="peso(document.form1.archivo1.value,'peso1')" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 2</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo2" class="Estilo2" size="40" onchange="peso(document.form1.archivo2.value,'peso2')" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 3</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo3" class="Estilo2" size="40" onchange="peso(document.form1.archivo3.value,'peso3')" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 4</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo4" class="Estilo2" size="40" onchange="peso(document.form1.archivo4.value,'peso4')">
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1" colspan="4"><BR><font color="#FF0000"> * CAMPOS OBLIGATORIOS </font></td>
                           </tr>


                      </tr>
                     <tr>
                       <td><hr></td><td><hr></td>


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
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR <? echo $prefijo ?>    " > </td>
                           </tr>

                              <input type="hidden" name="peso1" value="" >
                              <input type="hidden" name="peso2" value="" >
                              <input type="hidden" name="peso3" value="" >
                              <input type="hidden" name="peso4" value="" >
                              
                              <input type="hidden" name="ti" value="<? echo $ti; ?>" >
                              <input type="hidden" name="prefijo" value="<? echo $prefijo; ?>" >
                              <input type="hidden" name="contrato" >

                        </form>

                      </td>


   </div>


                      <tr>
                      <td colspan="8">
                      <table border=1>

<br>




<?
  $sql21="select max(eta_folioguia) as foliomio from dpp_etapas where eta_region='$regionsession' ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $foliomio=$row21["foliomio"];
  $foliomio=$foliomio+1;
  

?>
                        <tr>
                         <td class="Estilo1" colspan=4></td>
                        </tr>


                        <tr>
                         <td class="Estilo1" colspan=4>


                        <tr>
                         <td class="Estilo1b">FOLIO</td>
                         <td class="Estilo1b">TIPO DOCUMENTO</td>
                         <td class="Estilo1b">FECHA DOCUMENTO</td>
                         <td class="Estilo1b">MATERIA</td>
                         <td class="Estilo1b">AREA</td>
                         <td class="Estilo1b">SUBAREA</td>
                         <td class="Estilo1b">TRAMITE</td>
                         <td class="Estilo1b">FICHA</td>

                        </tr>

<?



if ($regionsession==0) {
     $sql="select * from argedo_documentos where  eta_estado=1 and eta_folioguia=0 order by eta_folio desc limit 0,10";
} else {
     $sql="select * from argedo_documentos where docs_estado=1 and docs_folioguia=0 and docs_defensoria ='$regionsession' and docs_tipo='$ti'  order by docs_fecha desc, docs_folio desc limit 0,10";
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
   
   $areaid=$row3["docs_area"];
   $subareaid=$row3["docs_subarea"];
   
   $sql6="select * from area where id=$areaid ";
//   echo $sql6;
   $res6 = mysql_query($sql6);
   $row6 = mysql_fetch_array($res6);
   $areanombre=$row6["opcion"];

   $sql7="select * from subarea where id=$subareaid ";
//   echo $sql7;
   $res7 = mysql_query($sql7);
   $row7 = mysql_fetch_array($res7);
   $subareanombre=$row7["opcion"];



?>


                       <tr>
                         <td class="Estilo1b"><? echo $row3["docs_folio"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["docs_documento"]  ?> </td>
                         <td class="Estilo1b"><? echo substr($row3["docs_fecha"],8,2)."-".substr($row3["docs_fecha"],5,2)."-".substr($row3["docs_fecha"],0,4)   ?></td>
                        
                         <td class="Estilo1b"><? echo $row3["docs_materia"]  ?> </td>
                         <td class="Estilo1b"><? echo $areanombre  ?> </td>
                         <td class="Estilo1b"><? echo $subareanombre ?> </td>
                         <td class="Estilo1b"><? echo $row3["docs_tramite"]  ?> </td>
                         <td class="Estilo1b"><a href="argedo_ficharesyofi.php?id=<? echo $row3["docs_id"]; ?>&ti=<? echo $ti; ?>&ori=1" class="link" > VER  </a> </td>



                       </tr>





<?

   $cont++;

}
?>




                      <tr>
                       <tr>
                       
                      </tr>



<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
