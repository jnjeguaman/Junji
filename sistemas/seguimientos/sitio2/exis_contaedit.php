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
														$sql = "SELECT * FROM acti_inventario WHERE inv_id = ".$_GET["inv_id"];
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
							<option value="1310201">1310201 - EXISTENCIAS DE TEXTILES Y ACABADOS TEXTILES</option>
							<option value="1310202">1310202 - EXISTENCIAS DE VESTUARIO, ACCESORIOS Y PRENDAS DIVERSAS</option>
							<option value="1310203">1310203 - EXISTENCIAS DE CALZADO</option>
							<option value="1310303">1310303 - EXISTENCIAS DE COMBUSTIBLES Y LUBRICANTE PARA CALEFACCION</option>
							<option value="1310401">1310401 - EXISTENCIAS DE MATERIALES DE OFICINA</option>
							<option value="1310402">1310402 - EXISTENCIAS DE TEXTOS Y OTROS MATERIALES DE ENSENANZA</option>
							<option value="1310407">1310407 - EXISTENCIAS DE MATERIALES Y UTILES DE ASEO</option>
							<option value="1310408">1310408 - EXISTENCIAS DE MENAJE PARA OFICINA, CASINO Y OTROS</option>
							<option value="1310409">1310409 - EXISTENCIAS DE INSUMOS, REPUESTOS Y ACCESORIOS COMPUTACIONALES</option>
							<option value="1310410">1310410 - EXISTENCIAS DE MATERIALES PARA MANTENIMIENTO Y REPARACIONES DE INMUEBLES</option>
							<option value="1310414">1310414 - EXISTENCIAS DE PRODUCTOS ELABORADOS DE CUERO, CAUCHO Y PLASTICO</option>
							<option value="1310416">1310416 - EXISTENCIAS DE EQUIPOS MENORES</option>
							<option value="1310499">1310499 - EXISTENCIAS DE OTROS MATERIALES DE USO O CONSUMO</option>
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
			<!--<input type="text" name="inv_id" value="<?php echo $row["inv_id"] ?>">!-->
			<input type="hidden" name="inv_rc" value="<?php echo $rc ?>">
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


	<form action="exis_contaedit_actualizar.php" method="POST">
		<table border="1" width="100%">

			<?php


			$inventario = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b on b.oc_id = a.doc_oc_id INNER JOIN bode_detingreso c on c.ding_prod_id = a.doc_id WHERE a.doc_oc_id = ".$oc_id." AND c.ding_clasificacion = 0";
			$inventario = mysql_query($inventario,$dbh6);
			?>

			<tr>
				<td class="Estilo1">O/C</td>
				<td class="Estilo1">O/C</td>
				<td class="Estilo1">BIEN</td>
				<td class="Estilo1">CANTIDAD RECIBIDA</td>
				<td class="Estilo1">STOCK</td>
				<td class="Estilo1">VALOR UNITARIO</td>
				<td class="Estilo1">CLP</td>
				<td class="Estilo1">CUENTA CONTABLE</td>
				<td class="Estilo1">DEVENGO</td>
			</tr>

			<?php $cont= 1;while($row3 = mysql_fetch_array($inventario)) { ?>

			<tr>
			<?php if (intval($row3["ding_devengado"]) === 0): ?>
				<td class="Estilo1"><input type="checkbox" name="var1[<?php echo $cont ?>]" id="var1_<?php echo $cont ?>" value="<?php echo $cont ?>" onClick="setRequired(<?php echo $cont ?>)"></td>
			<?php else: ?>
				<td></td>
			<?php endif ?>
				<td class="Estilo1"><?php echo $row3["oc_id2"] ?></td>
				<td class="Estilo1"><?php echo $row3["doc_especificacion"] ?></td>
				<td class="Estilo1"><?php echo $row3["ding_cantidad"] ?></td>
				<td class="Estilo1"><?php echo $row3["ding_unidad"] ?></td>
				<td class="Estilo1"><?php echo $row3["doc_unit"] ?></td>
				<td class="Estilo1"><?php echo number_format(($row3["doc_unit"] * $row3["ding_cantidad"]) * $row3["doc_valor_moneda"],0,".",".") ?></td>
				<td class="Estilo1">
				<?php if (intval($row3["ding_devengado"]) === 1): ?>
					<select class="Estilo1" disabled>
						<option selected value="">Seleccionar...</option>
						<option value="1310201" <?php if($row3["doc_cta_contable"] == "1310201"){echo"selected";}?> >1310201 - EXISTENCIAS DE TEXTILES Y ACABADOS TEXTILES</option>
						<option value="1310202" <?php if($row3["doc_cta_contable"] == "1310202"){echo"selected";}?> >1310202 - EXISTENCIAS DE VESTUARIO, ACCESORIOS Y PRENDAS DIVERSAS</option>
						<option value="1310203" <?php if($row3["doc_cta_contable"] == "1310203"){echo"selected";}?> >1310203 - EXISTENCIAS DE CALZADO</option>
						<option value="1310303" <?php if($row3["doc_cta_contable"] == "1310303"){echo"selected";}?> >1310303 - EXISTENCIAS DE COMBUSTIBLES Y LUBRICANTE PARA CALEFACCION</option>
						<option value="1310401" <?php if($row3["doc_cta_contable"] == "1310401"){echo"selected";}?> >1310401 - EXISTENCIAS DE MATERIALES DE OFICINA</option>
						<option value="1310402" <?php if($row3["doc_cta_contable"] == "1310402"){echo"selected";}?> >1310402 - EXISTENCIAS DE TEXTOS Y OTROS MATERIALES DE ENSENANZA</option>
						<option value="1310407" <?php if($row3["doc_cta_contable"] == "1310407"){echo"selected";}?> >1310407 - EXISTENCIAS DE MATERIALES Y UTILES DE ASEO</option>
						<option value="1310408" <?php if($row3["doc_cta_contable"] == "1310408"){echo"selected";}?> >1310408 - EXISTENCIAS DE MENAJE PARA OFICINA, CASINO Y OTROS</option>
						<option value="1310409" <?php if($row3["doc_cta_contable"] == "1310409"){echo"selected";}?> >1310409 - EXISTENCIAS DE INSUMOS, REPUESTOS Y ACCESORIOS COMPUTACIONALES</option>
						<option value="1310410" <?php if($row3["doc_cta_contable"] == "1310410"){echo"selected";}?> >1310410 - EXISTENCIAS DE MATERIALES PARA MANTENIMIENTO Y REPARACIONES DE INMUEBLES</option>
						<option value="1310414" <?php if($row3["doc_cta_contable"] == "1310414"){echo"selected";}?> >1310414 - EXISTENCIAS DE PRODUCTOS ELABORADOS DE CUERO, CAUCHO Y PLASTICO</option>
						<option value="1310416" <?php if($row3["doc_cta_contable"] == "1310416"){echo"selected";}?> >1310416 - EXISTENCIAS DE EQUIPOS MENORES</option>
						<option value="1310499" <?php if($row3["doc_cta_contable"] == "1310499"){echo"selected";}?> >1310499 - EXISTENCIAS DE OTROS MATERIALES DE USO O CONSUMO</option>
					</select>
				<?php else: ?>
<select class="Estilo1" name="var2[<?php echo $cont ?>]" id="var2_<?php echo $cont ?>">
						<option selected value="">Seleccionar...</option>
						<option value="1310201">1310201 - EXISTENCIAS DE TEXTILES Y ACABADOS TEXTILES</option>
						<option value="1310202">1310202 - EXISTENCIAS DE VESTUARIO, ACCESORIOS Y PRENDAS DIVERSAS</option>
						<option value="1310203">1310203 - EXISTENCIAS DE CALZADO</option>
						<option value="1310303">1310303 - EXISTENCIAS DE COMBUSTIBLES Y LUBRICANTE PARA CALEFACCION</option>
						<option value="1310401">1310401 - EXISTENCIAS DE MATERIALES DE OFICINA</option>
						<option value="1310402">1310402 - EXISTENCIAS DE TEXTOS Y OTROS MATERIALES DE ENSENANZA</option>
						<option value="1310407">1310407 - EXISTENCIAS DE MATERIALES Y UTILES DE ASEO</option>
						<option value="1310408">1310408 - EXISTENCIAS DE MENAJE PARA OFICINA, CASINO Y OTROS</option>
						<option value="1310409">1310409 - EXISTENCIAS DE INSUMOS, REPUESTOS Y ACCESORIOS COMPUTACIONALES</option>
						<option value="1310410">1310410 - EXISTENCIAS DE MATERIALES PARA MANTENIMIENTO Y REPARACIONES DE INMUEBLES</option>
						<option value="1310414">1310414 - EXISTENCIAS DE PRODUCTOS ELABORADOS DE CUERO, CAUCHO Y PLASTICO</option>
						<option value="1310416">1310416 - EXISTENCIAS DE EQUIPOS MENORES</option>
						<option value="1310499">1310499 - EXISTENCIAS DE OTROS MATERIALES DE USO O CONSUMO</option>
					</select>
				<?php endif ?>
					
				</td>
				<td>
					<?php if (intval($row3["ding_devengado"]) === 1): ?>
						<input type="text" disabled value="<?php echo $row3["ding_devengo"] ?>">
						<?php else: ?>
							<input type="text" name="var6[<?php echo $cont ?>]" id="var6_<?php echo $cont ?>">
					<?php endif ?>
				</td>
				<input type="hidden" name="var3[<?php echo $cont ?>]" value="<?php echo $row3["ding_id"] ?>">
				<input type="hidden" name="var4[<?php echo $cont ?>]" value="<?php echo $row3["ding_unidad"] ?>">
				<input type="hidden" name="var5[<?php echo $cont ?>]" value="<?php echo $row3["ding_prod_id"] ?>">
				<input type="hidden" name="oc_id" value="<?php echo $oc_id ?>">
				<input type="hidden" name="rc" value="<?php echo $rc ?>">
			</tr>
			<?php $cont++;} ?>
			<input type="hidden" name="totalElementos" value="<?php echo $cont-1 ?>">
			<tr>
				<td class="Estilo1" align="left" colspan="9"><button type="submit">ACTUALIZAR</button></td>
				
			</tr>
		</table>
	</form>
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

	function setRequired(input)
	{
		if($("#var1_"+input).is(":checked"))
		{
			$("#var2_"+input).prop("required",true);
			$("#var6_"+input).prop("required",true);
			console.log("YES");
		}else{
			$("#var2_"+input).prop("required",false);
			$("#var6_"+input).prop("required",false);
		}
	}
</script>

