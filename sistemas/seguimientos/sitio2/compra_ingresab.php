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
$annomio=date("Y");
$date_in2=date("Y-m-d");
?>
<html>
<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
<title>Compras 2015</title>
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
.Estilo3a {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: left;
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
	text-align: left;
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
  <script type="text/javascript" src="select_dependientes2b.js"></script>
  
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
            nombre2.innerText=ajax.responseText;

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

function traspasa() {
   document.form1.totalpresu.value=document.form1.monto.value;
}

function valida() {

   if (document.form1.nombre.value==0 ) {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.descripcion.value=='') {
      alert ("Descripcion presenta problemas ");
      return false;
  }
   if (document.form1.monto.value=='') {
      alert ("Monto presenta problemas ");
      return false;
  }
   if (document.form1.nromeses.value=='') {
      alert ("N� Meses presenta problemas ");
      return false;
  }
   if (document.form1.tipo2b.value=='') {
      alert ("Tipo Contratacion presenta problemas ");
      return false;
  }
   if (document.form1.nromeses.value=='') {
      alert ("N� Meses presenta problemas ");
      return false;
  }
   if (document.form1.documento2.value=='') {
      alert (" Modalidad presenta problemas ");
      return false;
  }
   if (document.form1.mesprograma.value=='') {
      alert (" Mes presenta problemas ");
      return false;
  }
   if (document.form1.ccosto.value=='') {
      alert ("Centro Costo presenta problemas ");
      return false;
  }
   if (document.form1.unidad.value=='') {
      alert ("Unidad Responsable presenta problemas ");
      return false;
  }
   if (document.form1.responsable.value=='') {
      alert ("Responsable presenta problemas ");
      return false;
  }
   if (document.form1.item.value=='') {
      alert ("Item presenta problemas ");
      return false;
  }
   if (document.form1.annocurso.value=='') {
      alert ("A�o En Curso presenta problemas ");
      return false;
  }
   if (document.form1.totalpresu.value=='') {
      alert ("Total Presupuesto presenta problemas ");
      return false;
  }
   if (document.form1.nromesespaga.value=='') {
      alert ("N� Meses a Pagar presenta problemas ");
      return false;
  }

  if(confirm('� EST� SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }


  
}


function puntitos(donde,caracter,campo) {
alert("entra");
var decimales = true
dec = campo
pat = /[\*,\+,\(,\),\?,\\,\$,\[,\],\^]/
valor = donde.value
largo = valor.length
crtr = true
if(isNaN(caracter) || pat.test(caracter) == true)
	{
	if (pat.test(caracter)==true)
		{caracter = "\\" + caracter}
	carcter = new RegExp(caracter,"g")
	valor = valor.replace(carcter,"")
	donde.value = valor
	crtr = false
	}
else
	{
	var nums = new Array()
	cont = 0
	for(m=0;m<largo;m++)
		{
		if(valor.charAt(m) == "." || valor.charAt(m) == " " || valor.charAt(m) == ",")
			{continue;}
		else{
			nums[cont] = valor.charAt(m)
			cont++
			}

		}
	}

if(decimales == true) {
	ctdd = eval(1 + dec);
	nmrs = 1
	}
else {
	ctdd = 1; nmrs = 3
	}
var cad1="",cad2="",cad3="",tres=0
if(largo > nmrs && crtr == true)
	{
	for (k=nums.length-ctdd;k>=0;k--){
		cad1 = nums[k]
		cad2 = cad1 + cad2
		tres++
		if((tres%3) == 0){
			if(k!=0){
				cad2 = "," + cad2
				}
			}
		}

	for (dd = dec; dd > 0; dd--)
	{cad3 += nums[nums.length-dd] }
	if(decimales == true)
	{cad2 += "." + cad3}
	 donde.value = cad2
	}
donde.focus()
}
//-->

</script>

<body>
<?

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


$sql2 = "Select * from regiones where codigo=$regionsession";
//echo $sql2;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$activo3=$row2["activo3"];
$anno3=$row2["anno3"];
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
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO REGISTRO AL PLAN DE COMPRAS <? echo $anno3 ?></span></td>
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
if (isset($_GET["ori"])) {
    $ori=$_GET["ori"];
}

if(isset($_GET["region"])) {
   $region=$_GET["region"];
} else {
   $region=$regionsession;
}
?>
                         </td>
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

if ($ori==2) {
    $volver="compra_orden.php";
} else {
    $volver="compra_menu.php";
}
$var=$_GET["var"];
$id=$_GET["id"];

if ($var==1) {
   $sql2 = "delete from compra_compra where compra_id=$id";
   //echo $sql;
   mysql_query($sql2);

   $sql2 = "delete from compra_vigentedet where cvig_compra_id=$id";
   //echo $sql;
   mysql_query($sql2);

}

if (isset($_GET["sw1"])) {
    $sw1=$_GET["sw1"];
    $idreg=$_GET["idreg"];
    if ($sw1==1) {
        $sql6="update regiones set activo3=0 where codigo=$idreg";
    }
    if ($sw1==2) {
        $sql6="update regiones set activo3=1 where codigo=$idreg";
    }
    if ($sw1==3) {
        $sql6="update regiones set activo3=0 ";
    }

    mysql_query($sql6);
}


?>
                  
                                 </table>
                                 <table border=1>
                                   <tr>
                                    <td class="Estilo1">Region</td><td class="Estilo1">Estado</td><td class="Estilo1">Cerrar</td>
                                   <tr>
                                 <?
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){
                                       $idregion=$row2["codigo"];

                                 ?>
                                    <tr>
                                    <td class="Estilo1"> <? echo $row2["nombre"] ?></td>
                                    <td class="Estilo1"> <? if ($row2["activo3"]==1) { ?><img src="images/punt_verde.jpg"  width="15" height="15" /> <? } else { ?><img src="images/punt_rojo.jpg"  width="15" height="15" /><? } ?></td>
                                    <td class="Estilo1"><a href="compra_ingresab.php?sw1=1&idreg=<? echo $idregion; ?>" >Cerrar</a></td>
                                 <?
                                    if ($regionsession==15 and 1==2) {
                                 ?>
                                    <td class="Estilo1"><a href="compra_ingresab.php?sw1=2&idreg=<? echo $idregion ?>" >Abrir</a></td>


                                 <?
                                    }
                                   }
                                 ?>

                           </tr>
                          </table>

                         <hr>
                        <table>    
                       <tr>
                       <td><a href="<? echo $volver; ?>" class="link" >Volver</a></td>
                      </tr>



                   <tr>
             			<td height="50" colspan="3">
                    
					<table width="488" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_grabaingresab.php" method="post"  onSubmit="return valida()">
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="4"><br>  </td>
                           </tr>



<tr>
                             <td  valign="center" class="Estilo1">Fecha Creaci�n</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly="1">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        singleClick    :    true,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)

    });
</script>



                             </td>
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
                       <td colspan=6><hr></td>



                      </tr>
                    </table>
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1" width="330">Nombre Servicio</td>
                             <td class="Estilo1" colspan=3>
                             <textarea name="nombre" rows="3" cols="60" class="Estilo2"  ></textarea>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Descripci�n</td>
                             <td class="Estilo1" colspan=3>
                             <textarea name="descripcion" rows="3" cols="60" class="Estilo2"  ></textarea>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Monto a Contratar</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="monto" class="Estilo2" size="15" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  onkeyup="traspasa();" >
                              
                              Pesos
<!--
                                <select name="moneda" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
                                    $sql2 = "Select * from dpp_monedas order by mone_tipo ";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){
                                       $monetipo=$row2["mone_tipo"];

                                 ?>
                                    <option value="<? echo $row2["mone_tipo"] ?>" <? if ($monetipo=='Pesos') { echo "selected=selected"; } ?>  ><? echo $row2["mone_tipo"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
-->

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">N� Meses a Contratar</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nromeses" class="Estilo2" size="15" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  >
                             </td>
                           </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Mes programado</td>
                             <td class="Estilo1">
                                <select name="mesprograma" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
                                    $sql2 = "Select * from compra_subcat  where subcat_cat_id =1";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["subcat_nombre"] ?>"><? echo $row2["subcat_nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>
                      <tr>
                        <td colspan=4><hr></td>
                      </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Tipo Contrataci�n  </td>
                             <td class="Estilo1">
                             <?php generalista2(); ?>
                              <input type="hidden" name="tipo2b" class="Estilo2" size="40" value="" >
                             </td>
                           </tr>
                           
                            <tr>
                             <td  valign="center" class="Estilo1">Modalidad  </td>
                             <td class="Estilo1">
					            <select disabled="disabled" name="estados2" id="estados2" class="Estilo1">
  						          <option value="0">Seleccione...</option>
					            </select>
                             </td>
                           </tr>

                            <input type="hidden" name="documento2" class="Estilo2" size="40" value="<? echo $row["cont_contrato"]; ?>">
                            <input type="hidden" name="programa" class="Estilo2" size="40" value="2">


                           <tr>
                             <td  valign="center" class="Estilo1">Centro de Costo </td>
                             <td class="Estilo1" colspan=3>
                                <select name="ccosto" class="Estilo1" >
                                       <option value="">Seleccione...</option>
<?
                                   $cadena = strlen($regionsession);
                                   if ($cadena==1) {
                                       $where="SUBSTRING(num,1,1)='$regionsession' and character_length(num)=3 ";

                                   } else {
                                       $where="SUBSTRING(num,1,2)='$regionsession' and character_length(num)=4 ";
                                   }

                                   $sql4="select * from defensorias  where $where and estado=1 order by nombre";
                                  //echo $sql;
                                   $res4 = mysql_query($sql4);
                                    while($row=mysql_fetch_array($res4)) {
?>
                                        <option value="<? echo $row["nombre"]; ?>"  ><? echo $row["nombre"]; ?></option>
<?
                                   }
?>
                                  </select>

                              </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Unidad Responsable </td>
                             <td class="Estilo1" colspan=3>
                                <select name="unidad" class="Estilo1" >
                                       <option value="">Seleccione...</option>
<?
                                   $cadena = strlen($regionsession);
                                   if ($cadena==1) {
                                       $where="SUBSTRING(num,1,1)='$regionsession' and character_length(num)=3 ";

                                   } else {
                                       $where="SUBSTRING(num,1,2)='$regionsession' and character_length(num)=4 ";
                                   }

                                   $sql4="select * from defensorias  where $where and estado=1 order by nombre";
                                  //echo $sql;
                                   $res4 = mysql_query($sql4);
                                    while($row=mysql_fetch_array($res4)) {
?>
                                        <option value="<? echo $row["nombre"]; ?>"  ><? echo $row["nombre"]; ?></option>
<?
                                   }
?>
                                  </select>

                              </td>
                           </tr>



                            <tr>
                             <td  valign="center" class="Estilo1">Nombre Responsable </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="responsable" class="Estilo2" size="60"  >
                             </td>
                           </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Item</td>
                             <td class="Estilo1">
                                <select name="item" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
                                    $sql2 = "Select * from compra_subcat  where subcat_cat_id =10";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["subcat_nombre"] ?>"><? echo $row2["subcat_nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">A�o En Curso </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="annocurso" class="Estilo2" size="15"  value="<? echo $anno3 ?>" readonly=1>
                             </td>
                           </tr>
                      <tr>
                        <td colspan=4><hr></td>
                      </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Presupuesto <? echo $anno3 ?> </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="totalpresu" class="Estilo2" size="15"  >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">N� Meses a Pagar</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nromesespaga" class="Estilo2" size="15"  >
                             </td>
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
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <input type="hidden" name="ori" value="<? echo $ori ?>"  >
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR REGISTRO    " > </td>
                           </tr>

                           <input type="hidden" name="occompraid" value="" >
                           <input type="hidden" name="occompraid2" value="" >


                        </form>

                      </td>


                       <tr>
                       <td></td><td></td><td></td><td></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">


                      <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="compra_seguimientoexcel2.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&nombre=<? echo $nombre ?>&ccosto=<? echo $ccosto ?>&uniresp=<? echo $uniresp ?>&programado=<? echo $programado ?>&estado=<? echo $estado ?>&year=2014&origen=1" class="link" >EXPORTAR A TODO EXCEL </a>  </td>
                      </tr>


                      <table border=1>
<tr></tr>


<br>
<tr class="Estilo8"></tr>

                        <tr>
                         <td class="Estilo3c">N� </td>
                         <td class="Estilo3c">Nombre Compra</td>
                         <td class="Estilo3c">Descripci�n</td>
                         <td class="Estilo3c">Fecha Progr.</td>
                         <td class="Estilo3c">Centro Costo</td>
                         <td class="Estilo3c">Programacion</td>
                         <td class="Estilo3c">Eliminar</td>
                         <td class="Estilo3c"></td>
                        </tr>
<?

$sql="select * from compra_compra where compra_region='$region' and compra_origen=1 and compra_anno=$anno3 order by compra_id desc ";
//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont2=mysql_num_rows($res3);
while($row3 = mysql_fetch_array($res3)){
$compraorigen=$row3["compra_origen"];
if ($compraorigen==1) {
    $texto="Programado";
} else {
    $texto="No Programado";

}
?>


  <tr>
	<td class="Estilo3c"><? echo $cont2 ?> </td>
    <td class="Estilo3d" title="<? echo $row3["compra_nombre"]  ?>"><? echo $row3["compra_nombre"]  ?></td>
    <td class="Estilo3d" title="<? echo $row3["compra_descip"]  ?>"><? echo $row3["compra_descip"]  ?></td>
    <td class="Estilo3c" title="<? echo $row3["compra_mes"]  ?>"><? echo $row3["compra_mes"]  ?></td>
    <td class="Estilo3d" title="<? echo $row3["compra_ccosto"]  ?>"><? echo $row3["compra_ccosto"]  ?></td>
    <td class="Estilo3c" title="<? echo $row3["compra_ccosto"]  ?>"><? echo $texto ?></td>
<!--    <td class="Estilo3c" title="<? echo $row3["compra_ccosto"]  ?>"><a href="compra_seguimiento2b.php?id=<? echo $row3["compra_id"] ?>&ori=1" class="link" >EDI </a></td> -->
    <td class="Estilo1c"><a href="compra_ingresab.php?id=<? echo $row3["compra_id"] ?>&var=1" class="link" onclick="return confirm('Seguro que desea Eliminar  ?')"><img src="imagenes/b_drop.png" border=0></a> </td>
  </tr>



<?

   $cont++;
   $cont2--;

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
