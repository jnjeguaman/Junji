<?

session_start();
extract($_GET);

require("inc/config.php");

require("inc/querys.php");

$nivel = $_SESSION["pfl_user"];

$regionsession = $_SESSION["region"];

$usuario=$_SESSION["nom_user"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}

$date_in=date("d-m-Y");



$sql21 = "Select * from parametros";

$res21 = mysql_query($sql21);

$row21 = mysql_fetch_array($res21);

$mes21=$row21["para_mes"];

$ano21=$row21["para_anno"];



$ori=$_GET["ori"];

$id=$_GET["id"];

if ($ori==1 and $id<>'') {

     $sql="delete from ff_factura where fffac_id='$id' ";

//     echo $sql;

     mysql_query($sql);

}

$oc = "SELECT oc_numero FROM acti_compra WHERE id = ".$oc_id;
$oc = mysql_query($oc,$dbh6);
$oc = mysql_fetch_array($oc);

?>

<html>

<head>

<title>Inventario</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/estilos.css" rel="stylesheet" type="text/css">
<script src="../../inventario/privado/sitio2/librerias/jquery-1.11.3.min.js"></script>
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

.Estilo7c {font-family: Geneva, Arial, Helvetica, sans-serif;

font-size: 12px;

font-weight: bold; }



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

            if (elem[0]=='Proveedor No Existe') {

                alert("entra");

               document.getElementById("tipopersona2").style.visibility="visible";

//             document.getElementById("checkbox3").style.visibility="hidden";



            } else {

               document.getElementById("tipopersona2").style.visibility="hidden";

            }







		}

	}

}







function valida2() {

   if (document.form1.caja.value==0 ) {

      alert ("Nombre presenta problemas ");

      return false;

  }

   if (document.form1.responsable.value==0 ) {

      alert ("Responsable presenta problemas ");

      return false;

  }



   if (document.form1.region.value==0 ) {

      alert ("Region presenta problemas ");

      return false;

  }

   if (document.form1.fecha1.value=='') {

      alert ("Fecha Documento presenta problemas ");

      return false;

  }

   if (document.form1.fecha2.value=='') {

      alert ("Fecha Rendicion presenta problemas ");

      return false;

  }



   if (document.form1.rut.value=='') {

      alert ("RUT presenta problemas ");

      return false;

  }

   if (document.form1.dig.value=='') {

      alert ("Digito Verificador presenta problemas ");

      return false;

  }

   if (document.form1.nombre.value=='') {

      alert ("Nombre Proveedor presenta problemas ");

      return false;

  }

   if (document.form1.idtesoreria.value=='') {

      alert ("ID Tesoreria presenta problemas ");

      return false;

  }



   if (document.form1.nrocheque.value=='') {

      alert ("Nº Cheque presenta problemas ");

      return false;

  }

   if (document.form1.monto.value=='') {

      alert ("Monto presenta problemas ");

      return false;

  }

   if (document.form1.archivo1.value=='') {

      alert ("Documento Adjunto presenta problemas ");

      return false;

  }



}



function exenta() {

    if (document.form1.neto.value!=0) {

      document.form1.iva.value='0';

      document.form1.monto.value=document.form1.monto.value;

      document.form1.exento.value=document.form1.monto.value;

      document.form1.neto.value='0';

    }

}

function noexenta() {

    if (document.form1.neto.value==0) {

      document.form1.neto.value=Math.round(document.form1.monto.value/1.19);

      document.form1.iva.value=Math.round(document.form1.neto.value*0.19);

      document.form1.monto.value=Math.round(document.form1.neto.value)+Math.round(document.form1.iva.value);

      document.form1.exento.value=0;

    }



}



//-->



</script>



<body>

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

                    <td height="20" colspan="2"><span class="Estilo7">INGRESO FACTURAS FONDO FIJO</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1c">



<?





?>

                         </td>

                      </tr>

                      <tr>

                        <td><a href="menucontabilidad3.php" class="link" > Volver </a></td>

                      </tr>



                       <tr>

                       <td><hr></td><td><hr></td>





                      </tr>



                   <tr>

             			<td height="50" colspan="3">

                    
<form name="frmContabilidad" action="inv_contaedit_actualizar.php" method="POST" onSubmit="return contabilidad()">
		<table border="0" width="100%">
<?php
//DATOS DE INVENTARIO
$oc_numero = "SELECT oc_numero FROM acti_compra WHERE id = ".$oc_id;

$oc_numero = mysql_query($oc_numero);
$oc_numero = mysql_fetch_array($oc_numero);

$sql = "SELECT * FROM acti_inventario WHERE inv_oc = '".$oc_numero["oc_numero"]."' AND inv_nro_rece = ".$rc;
$res = mysql_query($sql);
$row = mysql_fetch_array($res); 
?>
			<!--<tr>

				<td class="Estilo2titulo" colspan="4">CONTABILIDAD</td>

			</tr>!-->



			<tr>

				<td class="Estilo1">COMPROBANTE EGRESO</td>

				<td class="Estilo1">



					<?php if($row["inv_comprobante_egreso"] == ""): ?>

						<input type="text" class="Estilo1" size="9" id="inv_comprobante_egreso" name="inv_comprobante_egreso" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

					<?php else: ?>

						<input type="text" class="Estilo1" size="9" id="inv_comprobante_egreso" name="inv_comprobante_egreso" value="<?php echo $row["inv_comprobante_egreso"] ?>" readonly style="background-color: rgb(235, 235, 235)">

					<?php endif ?>

				</td>



				<td class="Estilo1">FECHA COM EGRESO</td>

				<td class="Estilo1">

					<?php if($row["inv_devengofecha"] == "" || $row["inv_devengofecha"] == "0000-00-00"): ?>

						<input type="text" class="Estilo1" size="9" id="inv_devengofecha" name="inv_devengofecha" readonly style="background-color: rgb(235, 235, 235)">

						<img src="calendario.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"

						onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

						<script type="text/javascript">

							Calendar.setup({

								inputField  : "inv_devengofecha",

								ifFormat  : "%Y-%m-%d",

								button   : "f_trigger_c",

								align   : "Bl",

								singleClick : true

							});

						</script>

					<?php else: ?>

						<input type="text" class="Estilo1" size="9" id="inv_devengofecha" name="inv_devengofecha" value="<?php echo $row["inv_devengofecha"] ?>" readonly style="background-color: rgb(235, 235, 235)">

					<?php endif ?>

				</td>

			</tr>



			<tr>

				<td class="Estilo1">CUENTA CONTABLE</td>

				<td class="Estilo1">

					<?php if($row["inv_ccontable"] == ""): ?>

						<!--<input type="text" class="Estilo1" size="9" id="inv_cta_contable" name="inv_cta_contable" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>!-->

						<select class="Estilo1" id="inv_cta_contable" name="inv_cta_contable">

							<option selected value="">Seleccionar...</option>

							<option value="14104">14104 - MAQUINAS Y EQUIPOS DE OFICINA</option>

							<option value="14105">14105 - VEHICULOS</option>

							<option value="14106">14106 - MUEBLES Y ENSERES</option>

							<option value="14107">14107 - HERRAMIENTAS</option>

							<option value="14108">14108 - EQUIPOS COMPUTACIONALES Y PERIFERICOS</option>

							<option value="14114">14114 - OTROS BIENES DE USO DEPRECIABLES</option>

							<option value="15101">15101 - PROGRAMAS COMPUTACIONALES</option>

							<option value="15102">15102 - SISTEMAS DE INFORMACION</option>

							<option value="1610205">1610205 - EQUIPAMIENTO</option>

							<option value="5320413">5320413 - EQUIPOS MENORES</option>

							<option value="5321207">5321207 - PROGRAMAS COMPUTACIONALES</option>

							<option value="5321401">5321401 - MOBILIARIO Y OTROS</option>

							<option value="5321402">5321402 - MAQUINAS Y EQUIPOS DE OFICINA</option>

							<option value="5321404">5321404 - EQUIPOS COMPUTACIONALES Y PERIFERICOS</option>

							<option value="5410302">5410302 - BB Y SS. PROGRAMA MATERIAL DE ENSEÃ‘ANZA</option>

							<option value="5410305">5410305 - BB Y SS. PLAN FOMENTO LECTURA</option>

							<option value="541030301">541030301 - EQUIPAMIENTO PROGRAMA CASH</option>

							<option value="541030302">541030302 - EQUIPAMIENTO PROGRAMA PMI</option>

							<option value="541030303">541030303 - EQUIPAMIENTO PROGRAMA CECI</option>

						</select>

					<?php else: ?>

						<input type="text" class="Estilo1" size="9" id="inv_cta_contable" name="inv_cta_contable" value="<?php echo $row["inv_ccontable"] ?>" readonly style="background-color: rgb(235, 235, 235)">

					<?php endif ?>

				</td>



				<td class="Estilo1">NUMERO FACTURA</td>

				<td class="Estilo1">

					<?php if($row["inv_num_factura"] == ""): ?>

						<input type="text" class="Estilo1" size="9" id="inv_num_factura" name="inv_num_factura" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

					<?php else: ?>

						<input type="text" class="Estilo1" size="9" id="inv_num_factura" name="inv_num_factura" value="<?php echo $row["inv_num_factura"] ?>" readonly style="background-color: rgb(235, 235, 235)">

					<?php endif ?>

				</td>



			</tr>



			<tr>

				<td class="Estilo1">FECHA FACTURA</td>

				<td class="Estilo1">



					<?php if($row["inv_num_factura"] == ""): ?>

						<input type="text" class="Estilo1" size="9" id="inv_fecha_factura" name="inv_fecha_factura" readonly style="background-color: rgb(235, 235, 235)">

						<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"

						onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

						<script type="text/javascript">

							Calendar.setup({

								inputField  : "inv_fecha_factura",

								ifFormat  : "%d-%m-%Y",

								button   : "f_trigger_c3",

								align   : "Bl",

								singleClick : true

							});

						</script>

					<?php else: ?>

						<input type="text" class="Estilo1" size="9" id="inv_fecha_factura" name="inv_fecha_factura" value="<?php echo $row["inv_fecha_factura"] ?>" readonly style="background-color: rgb(235, 235, 235)">

					<?php endif ?>

				</td>

				<td class="Estilo1">AÃ‘O ADQUISICION</td>

				<td class="Estilo1">

					<?php if($row["inv_anno"] == ""): ?>

						<input type="text" class="Estilo1" size="9" id="inv_anno" name="inv_anno" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

					<?php else: ?>

						<input type="text" class="Estilo1" size="9" id="inv_anno" name="inv_anno" value="<?php echo $row["inv_anno"] ?>" readonly style="background-color: rgb(235, 235, 235)">

					<?php endif ?>

				</td>

			</tr>



			<?php if($row["inv_comprobante_egreso"] == "" || $row["inv_devengofecha"] == "" || $row["inv_ccontable"] == "" || $row["inv_num_factura"] == "" || $row["inv_num_factura"] == "" || $row["inv_anno"] == ""): ?>

				<tr>

					<td class="Estilo1">TIPO ACTUALIZACION</td>

					<td class="Estilo1">

						<select class="Estilo1" name="tipoActualizacion" id="tipoActualizacion">

							<option selected value="">Seleccionar...</option>

							<option value="0">LOTE ORDEN DE COMPRA</option>

							<option value="2">LOTE RECEPCION</option>

							<!--<option value="1">INDIVIDUAL</option>!-->

						</select>

					</td>

				</tr>

			</table>


            <input type="hidden" name="inv_oc" value="<?php echo $oc["oc_numero"] ?>">
    <input type="hidden" name="inv_rc" value="<?php echo $rc ?>">
    <input type="hidden" name="oc_id" value="<?php echo $oc_id ?>">
			<table border="0" width="100%">

				<tr>

					<td class="Estilo1c">

						<input type="submit" name="submit" class="Estilo2" size="11" value="  GRABAR  " >

					</td>

				</tr>

			</table>

		<?php else: ?>

		</table>

	<?php endif ?>
</form>




                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      





                      <tr>

                      <td colspan="8">



                      <table border=1>

<tr></tr>







                      <tr>



                        











</td>

  </tr>





</table>

<table border="1" width="100%">

<?php


$inventario = "SELECT * FROM acti_inventario WHERE inv_oc = '".$oc["oc_numero"]."' AND inv_nro_rece = ".$rc;
$inventario = mysql_query($inventario,$dbh6);
?>

<tr>
	<td class="Estilo1">O/C</td>
	<td class="Estilo1">BIEN</td>
	<td class="Estilo1">VALOR UNITARIO</td>
</tr>

<?php while($row3 = mysql_fetch_array($inventario)) { ?>

<tr>
	<td class="Estilo1"><?php echo $row3["inv_oc"] ?></td>
	<td class="Estilo1"><?php echo $row3["inv_bien"] ?></td>
	<td class="Estilo1"><?php echo $row3["inv_costo"] ?></td>
</tr>
<?php } ?>
</table>

<img src="images/pix.gif" width="1" height="10">

</body>

</html>



<?



?>



<script type="text/javascript">
    function contabilidad(){

        if($("#inv_comprobante_egreso").val() == "")
        {
            alert("INGRESE EL COMPROBANTE DE EGRESO");
            document.getElementById("inv_comprobante_egreso").focus();
            return false;
        }else if($("#inv_devengofecha").val() == "" || $("#inv_devengofecha").val() == "0000-00-00"){
            alert("INGRESE LA FECHA DEL COMPROBANTE DE EGRESO");
            document.getElementById("inv_devengofecha").focus();
            return false;
        }else if($("#inv_cta_contable").val() == ""){
            alert("INGRESE LA CUENTA CONTABLE");
            document.getElementById("inv_cta_contable").focus();
            return false;
        }else if($("#inv_num_factura").val() == ""){
            alert("INGRESE EL NUMERO DE FACTURA");
            document.getElementById("inv_num_factura").focus();
            return false;
        }else if($("#inv_fecha_factura").val() == ""){
            alert("INGRESE LA FECHA DE LA FACTURA");
            document.getElementById("inv_fecha_factura").focus();
            return false;
        }else if($("#inv_anno").val() == ""){
            alert("INGRESE EL AÑO DE ADQUISICION");
            document.getElementById("inv_anno").focus();
            return false;
        }else if(document.forms["frmContabilidad"]["tipoActualizacion"].value == ""){
            alert("SELECCIONE EL TIPO DE ACTUALIZACION");
            document.forms["frmContabilidad"]["tipoActualizacion"].focus();
            return false;
        }else{
            return confirm('¿ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS?');
        }
    }
</script>

