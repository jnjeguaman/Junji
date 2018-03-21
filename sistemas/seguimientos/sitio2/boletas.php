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
?>
<html>
<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
	<title>Facturas y/o Boletas</title>
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
		.linkrojo {
			font-family: Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-weight: bold;
			color: #CC0000;
			text-decoration:none;
			text-transform:uppercase;
		}
		.Estilo4 {
			font-size: 10px;
			font-weight: bold;
		}
		.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif; 
			font-size: 14px; font-weight: bold; }
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
  <!-- <script src="../../inventario/privado/sitio2/librerias/jquery-1.11.3.min.js"></script> -->

  <script language="javascript">

function licitacion(input)
{
	/*
	1 PUBLICO
	2 PRIVADO
	3 OTRO
	*/
	console.log(input);

	if(input == 1)
	{
		$("#publica_sufijo").attr("required",true);
		$("#publica_correlativo").attr("required",true);
		$("#publica_tipo").attr("required",true);

		$("#privada_sufijo").attr("required",false);
		$("#privada_correlativo").attr("required",false);
		$("#privada_tipo").attr("required",false);

		$("#licitacion_otro").attr("required",false);

		$("#licitacionPublica").css("display","inline");
		$("#licitacionOtro").css("display","none");
		$("#licitacionPrivada").css("display","none");
	}else if(input == 2)
	{
		$("#privada_sufijo").attr("required",true);
		$("#privada_correlativo").attr("required",true);
		$("#privada_tipo").attr("required",true);

		$("#publica_sufijo").attr("required",false);
		$("#publica_correlativo").attr("required",false);
		$("#publica_tipo").attr("required",false);

		$("#licitacion_otro").attr("required",false);

		$("#licitacionPublica").css("display","none");
		$("#licitacionOtro").css("display","none");
		$("#licitacionPrivada").css("display","inline");
	}else if(input == 3)
	{
		$("#privada_sufijo").attr("required",false);
		$("#privada_correlativo").attr("required",false);
		$("#privada_tipo").attr("required",false);

		$("#publica_sufijo").attr("required",false);
		$("#publica_correlativo").attr("required",false);
		$("#publica_tipo").attr("required",false);

		$("#licitacion_otro").attr("required",true);

		$("#licitacionPublica").css("display","none");
		$("#licitacionPrivada").css("display","none");
		$("#licitacionOtro").css("display","inline");

	}
}

  	<!--

  	function valida2(input)
  	{
  		console.log(input);
  		if(input == "VALE VISTA")
  		{
  			$("#f_date_c2").attr("readonly",true);
  			$("#f_date_c2").css("background","lightgrey");
  		}else{
  			$("#f_date_c2").attr("readonly",false);
  			$("#f_date_c2").css("background","none");
  		}
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
			nombre2.innerText=ajax.responseText;


			var Date = document.form1.nombre.value;
			var elem = Date.split('/');
			document.form1.nombre.value=elem[0];
			nombre2.innerText=elem[0];
//            document.form1.fpago.value = elem[1];


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
           	alert ("Numero de Boleta Existe Para esta proveedor "+c);
//                  document.form1.nboleta1.value=ajax.responseText;
document.getElementById(c).value =ajax.responseText;
//                    document.getElementById(c).value =0;

}

}
}

}


function valida() {

	if (document.form1.nrogarantia.value=='') {
		alert ("Vacio Nº Documento ");
		return false;
	}
	if (document.form1.emisora.value=='') {
		alert ("Vacio Emisora ");
		return false;
	}
	if (document.form1.monto.value=='') {
		alert ("Vacio Monto ");
		return false;
	}
	if (document.form1.monto.value=='') {
		alert ("Vacio Monto ");
		return false;
	}

	if(document.form1.tipoLicitacion.value=='')
	{
		alert("Seleccione el tipo de Licitación");
		document.form1.tipoLicitacion.focus();
		return false;
	}
	if (document.form1.fecha2.value=='' && document.form1.tipo2.value != "VALE VISTA") {
		alert ("Vacio Fecha Vencimiento ");
		return false;
	}
	if (document.form1.fecha3.value=='') {
		alert ("Vacio Fecha Emision");
		return false;
	}
	if (document.form1.rut.value=='') {
		alert ("Vacio Rut");
		return false;
	}
	if (document.form1.dig.value=='') {
		alert ("Vacio Digito");
		return false;
	}
	if (document.form1.nombre.value=='') {
		alert ("Vacio Razon Social");
		return false;
	}
	if (document.form1.glosa.value=='') {
		alert ("Vacio Glosa");
		return false;
	}

	if(document.form1.nombre.value == 'Proveedor No Existe')
	{
		alert("El proveedor no existe");
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
							<td height="20" colspan="2"><span class="Estilo7">INGRESO DE GARANTÍA</span></td>
						</tr>
						<tr>
							<td></td><td></td>
						</tr>
						<tr>
							<td width="487" valign="top" class="Estilo1">

								<?

								if (isset($_GET["llave"]))
									echo "<p>Registros insertados con Éxito !";
								?>
							</td>
						</tr>

						<tr>
							<td><hr></td><td><hr></td>
						</tr>


						<tr>
							<td height="50" colspan="3">
							</table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>

									<td  valign="top" class="Estilo1" colspan="4"><a href="garantia_rechazos.php" class="link" >Rechazadas</a><br>  </td>

								</tr>
								<form name="form1" action="grababoletas.php" method="post"  onSubmit="return valida()"  enctype="multipart/form-data">
									<tr>
										<td  valign="center" class="Estilo1">Fecha Recepción</td>
										<td class="Estilo1" valign="center">
											<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly="1">
											<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
											onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

											<script type="text/javascript">
												Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>



</td>
</tr>
<tr>
	<td  valign="top" class="Estilo1">Hora de Recepción  </td>
	<td class="Estilo1" colspan=3>Hora:
		<select name="hora" class="Estilo1">
			<option value=''></option>
			<option value='01'>01</option>
			<option value='02'>02</option>
			<option value='03'>03</option>
			<option value='04'>04</option>
			<option value='05'>05</option>
			<option value='06'>06</option>
			<option value='07'>07</option>
			<option value='08'>08</option>
			<option value='09'>09</option>
			<option value='10'>10</option>
			<option value='11'>11</option>
			<option value='12'>12</option>
			<option value='13'>13</option>
			<option value='14'>14</option>
			<option value='15'>15</option>
			<option value='16'>16</option>
			<option value='17'>17</option>
			<option value='18'>18</option>
			<option value='19'>19</option>
			<option value='20'>20</option>
			<option value='21'>21</option>
			<option value='22'>22</option>
			<option value='23'>23</option>
			<option value='00'>00</option>
		</select>
		Minutos :
		<select name="min" class="Estilo1">
			<option value=''></option>
			<option value='01'>01</option>
			<option value='02'>02</option>
			<option value='03'>03</option>
			<option value='04'>04</option>
			<option value='05'>05</option>
			<option value='06'>06</option>
			<option value='07'>07</option>
			<option value='08'>08</option>
			<option value='09'>09</option>
			<option value='10'>10</option>
			<option value='11'>11</option>
			<option value='12'>12</option>
			<option value='13'>13</option>
			<option value='14'>14</option>
			<option value='15'>15</option>
			<option value='16'>16</option>
			<option value='17'>17</option>
			<option value='18'>18</option>
			<option value='19'>19</option>
			<option value='20'>20</option>
			<option value='21'>21</option>
			<option value='22'>22</option>
			<option value='23'>23</option>
			<option value='24'>24</option>
			<option value='25'>25</option>
			<option value='26'>26</option>
			<option value='27'>27</option>
			<option value='28'>28</option>
			<option value='29'>29</option>
			<option value='30'>30</option>
			<option value='31'>31</option>
			<option value='32'>32</option>
			<option value='33'>33</option>
			<option value='34'>34</option>
			<option value='35'>35</option>
			<option value='36'>36</option>
			<option value='37'>37</option>
			<option value='38'>38</option>
			<option value='39'>39</option>
			<option value='40'>40</option>
			<option value='41'>41</option>
			<option value='42'>42</option>
			<option value='43'>43</option>
			<option value='44'>44</option>
			<option value='45'>45</option>
			<option value='46'>46</option>
			<option value='47'>47</option>
			<option value='48'>48</option>
			<option value='49'>49</option>
			<option value='50'>50</option>
			<option value='51'>51</option>
			<option value='52'>52</option>
			<option value='53'>53</option>
			<option value='54'>54</option>
			<option value='55'>55</option>
			<option value='56'>56</option>
			<option value='57'>57</option>
			<option value='58'>58</option>
			<option value='59'>59</option>
			<option value='00'>00</option>

		</select>

	</td>
</tr>
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

<tr>
	<td><hr></td><td><hr></td>
</tr>


<tr>
	<td  valign="center" class="Estilo1">Tipo de Documento</td>
	<td class="Estilo1" colspan=3>
		<input type="Radio" name="tipo2" class="Estilo2" onClick="valida2(this.value)" value="BOLETA GARANTIA" checked>BOLETA GARANTÍA<br>
		<input type="Radio" name="tipo2" class="Estilo2" onClick="valida2(this.value)" value="VALE VISTA">VALE VISTA<br>
		<input type="Radio" name="tipo2" class="Estilo2" onClick="valida2(this.value)" value="POLIZA SEGURO">POLIZA SEGURO<br>
		<input type="Radio" name="tipo2" class="Estilo2" onClick="valida2(this.value)" value="OTROS">OTROS<br>
	</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1" colspan=8><hr></td>
</tr>


<tr>
	<td  valign="center" class="Estilo1">Tipo de Garantía </td>
	<td class="Estilo1" colspan=3>
		<input type="Radio" name="tipo" class="Estilo2" value="SERIEDAD DE LA OFERTA" >SERIEDAD DE LA OFERTA<br>
		<input type="Radio" name="tipo" class="Estilo2" value="FIEL CUMPLIMIENTO DE CONTRATO" checked>FIEL CUMPLIMIENTO DE CONTRATO<br>
		<input type="Radio" name="tipo" class="Estilo2" value="OBLIGACIONES LABORALES Y PREVISIONALES">OBLIGACIONES LABORALES Y PREVISIONALES<br>
		<input type="Radio" name="tipo" class="Estilo2" value="CORRECTA EJECUCION DE LA OBRA">CORRECTA EJECUCION DE LA OBRA<br>
		<input type="Radio" name="tipo" class="Estilo2" value="ANTICIPO DE CONTRATO">ANTICIPO DE CONTRATO<br>
		<input type="Radio" name="tipo" class="Estilo2" value="TODO RIESGO DE CONSTRUCCION Y MONTAJE">TODO RIESGO DE CONSTRUCCION Y MONTAJE<br>


	</td>
</tr>
<tr>
	<td><hr></td><td><hr></td>
</tr>
<tr>
	<td  valign="top" class="Estilo1">Tipo Licitacion</td>
	<td>
		<select name="tipoLicitacion" id="tipoLicitacion" class="Estilo1" onChange="licitacion(this.value)">
			<option value="" selected>Seleccionar</option>
			<option value="1">Pública</option>
			<option value="2">Privada</option>
			<option value="3">Otros</option>
		</select>
	</td>
</tr>
<tr>
	<td  valign="top" class="Estilo1">ID Licitación </td>
	<td class="Estilo1" colspan=3>
		<!-- <input type="text" name="idlicitacion" class="Estilo2" size="10" > -->
		<div id="licitacionPublica" style="display: none">
			<input type="text" size="5" id="publica_sufijo" name="publica_sufijo">-
			<input type="text" size="5" id="publica_correlativo" name="publica_correlativo">-
			<select name="publica_tipo" id="publica_tipo">
				<option value="" selected>Seleccionar...</option>
				<option value="L1<?php echo substr(date("Y"), 2,2) ?>">L1<?php echo substr(date("Y"), 2,2) ?></option>
				<option value="LE<?php echo substr(date("Y"), 2,2) ?>">LE<?php echo substr(date("Y"), 2,2) ?></option>
				<option value="LP<?php echo substr(date("Y"), 2,2) ?>">LP<?php echo substr(date("Y"), 2,2) ?></option>
				<option value="LQ<?php echo substr(date("Y"), 2,2) ?>">LQ<?php echo substr(date("Y"), 2,2) ?></option>
				<option value="LR<?php echo substr(date("Y"), 2,2) ?>">LR<?php echo substr(date("Y"), 2,2) ?></option>

//bug se agrega 2017
				<option value="LI17">LI17</option>
				<option value="LE17">LE17</option>
				<option value="LP17">LP17</option>
				<option value="LQ17">LQ17</option>
				<option value="LR17">LR17</option>

				<option value="L116">L116</option>
				<option value="LE16">LE16</option>
				<option value="LP16">LP16</option>
				<option value="LQ16">LQ16</option>
				<option value="LR16">LR16</option>

				<option value="L115">L115</option>
				<option value="LE15">LE15</option>
				<option value="LP15">LP15</option>
				<option value="LQ15">LQ15</option>
				<option value="LR15">LR15</option>
			</select>
		</div>

		<div id="licitacionPrivada" style="display: none">
			<input type="text" size="5" id="privada_sufijo" name="privada_sufijo">-
			<input type="text" size="5" id="privada_correlativo" name="privada_correlativo">-
			<select name="privada_tipo" id="privada_tipo">
				<option value="" selected>Seleccionar...</option>
				<option value="E2<?php echo substr(date("Y"), 2,2) ?>">E2<?php echo substr(date("Y"), 2,2) ?></option>
				<option value="CO<?php echo substr(date("Y"), 2,2) ?>">CO<?php echo substr(date("Y"), 2,2) ?></option>
				<option value="B2<?php echo substr(date("Y"), 2,2) ?>">B2<?php echo substr(date("Y"), 2,2) ?></option>
				<option value="H2<?php echo substr(date("Y"), 2,2) ?>">H2<?php echo substr(date("Y"), 2,2) ?></option>
				<option value="I2<?php echo substr(date("Y"), 2,2) ?>">I2<?php echo substr(date("Y"), 2,2) ?></option>

				<option value="E216">E216</option>
				<option value="CO16">CO16</option>
				<option value="B216">B216</option>
				<option value="H216">H216</option>
				<option value="I216">I216</option>

				<option value="E215">E215</option>
				<option value="CO15">CO15</option>
				<option value="B215">B215</option>
				<option value="H215">H215</option>
				<option value="I215">I215</option>
			</select>
		</div>

		<div id="licitacionOtro" style="display: none">
			<input type="text" size="30" id="licitacion_otro" name="licitacion_otro">
		</div>

	</td>
</tr>

<tr>
	<td  valign="top" class="Estilo1">Número Documento </td>
	<td class="Estilo1" colspan=3>
		<input type="text" name="nrogarantia" class="Estilo2" size="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
	</td>
</tr>
<tr>
	<td  valign="top" class="Estilo1">Banco Emisor</td>
	<td class="Estilo1" colspan=3>
		<input type="text" name="emisora" class="Estilo2" size="40" >
	</td>
</tr>
<tr>
	<td  valign="top" class="Estilo1">Monto</td>
	<td class="Estilo1" colspan=3>
		<input type="text" name="monto" class="Estilo2" size="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46'>
		<select name="tipomoneda" class="Estilo1">
			<option value='Pesos'>Pesos</option>
			<option value='U.F.'>U.F.</option>
			<option value='Dolar'>Dolar</option>
			<option value='UTM'>UTM</option>
		</select>

	</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1">Fecha Vencimiento</td>
	<td class="Estilo1" valign="center">
		<input type="text" name="fecha2" class="Estilo2" size="12" value="" id="f_date_c2" readonly="1">
		<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
		onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

		<script type="text/javascript">
			Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1">Fecha Emisión</td>
	<td class="Estilo1" valign="center">
		<input type="text" name="fecha3" class="Estilo2" size="12" value="" id="f_date_c3" readonly="1">
		<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
		onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

		<script type="text/javascript">
			Calendar.setup({
        inputField     :    "f_date_c3",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


</td>
</tr>


<tr>
	<td  valign="top" class="Estilo1">Rut  </td>
	<td class="Estilo1" colspan=3>
		<input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" > -
		<input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()"> Rut sin puntos
	</td>
</tr>

<tr>
	<td  valign="center" class="Estilo1">Razón Social </td>
	<td class="Estilo1" colspan=3>
		<input type="hidden" name="nombre" id="nombre" class="Estilo2" size="49" >
		<label id="nombre2"></label> <br>

	</td>
</tr>

<tr>
	<td  valign="top" class="Estilo1">Glosa de la Garantía  </td>
	<td class="Estilo1" colspan=3>
		<textarea name="glosa" rows="3" cols="30"></textarea>
	</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1">Imagen Boleta </td>
	<td class="Estilo1" colspan=3>
		<input type="file" name="archivo1" class="Estilo2" size="20"  ><br>
		<a href="../../archivos/docgarantia/<? echo $row5["boleg_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["boleg_archivo"]; ?></a>
	</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1"><br>  </td>
	<td  valign="center" class="Estilo1"> </td>

</tr>
<tr>
	<td colspan=4 align="center"> <input type="submit" value="    GRABAR BOLETA DE GARANTÍA   " > </td>
</tr>



</form>

</td>


<tr>
	<td><hr></td><td><hr></td><td><hr></td><td><hr></td>
</tr>

<tr>
	<td colspan="8">
		<table border=1>
			<tr>
				<td class="Estilo1">Folio</td><td class="Estilo1">Rut</td><td class="Estilo1" width="10">Nombre</td><td class="Estilo1" width="30">Monto</td><td class="Estilo1">Número</td><td class="Estilo1">Fecha_Recepción</td>
			</tr>

			<?

			if ($regionsession==0) {
				$sql2 = "Select * from dpp_boletasg  order by boleg_folio desc limit 0,100";

			} else {
				$sql2 = "Select * from dpp_boletasg  where boleg_reg='$regionsession' order by boleg_folio desc limit 0,50";
                                    //$sql2 = "Select * from regiones where codigo=$regionsession";
			}
                                  //$sql2 = "Select * from dpp_boletasg  order by boleg_id desc limit 0,100";
                                  //echo $sql2;
			$res2 = mysql_query($sql2);
			$cont=1;
			while($row2 = mysql_fetch_array($res2)){
				$boleg_sw=$row2["boleg_sw"];
				if ($boleg_sw==0) {
					$estilo="linkrojo";
				} else {
					$estilo="link";
				}
				$read1= rand(0,1000000);
				?>
				<tr>

					<td class="Estilo1">
						<? echo $row2["boleg_folio"] ?>
						<a href="../../archivos/docgarantia/<? echo $row2["boleg_archivo"]; ?>?read1=<? echo $read1 ?>" class="<? echo $estilo ?>" target="_blank"><img src="images/attach.gif" width="8" height="14"></a>
					</td>
					<td class="Estilo1"><? echo $row2["boleg_rut"] ?></td>
					<td class="Estilo1"><? echo $row2["boleg_nombre"] ?></td>
					<td class="Estilo1"><? echo $row2["boleg_monto"] ?></td>
					<td class="Estilo1"><? echo $row2["boleg_numero"] ?></td>
					<td class="Estilo1"><? echo substr($row2["boleg_fecha_recep"],8,2)."-".substr($row2["boleg_fecha_recep"],5,2)."-".substr($row2["boleg_fecha_recep"],0,4) ?></td>
					<td class="Estilo1"><a href="imprimirguiag.php?guia=<? echo $row2["boleg_id"] ?>&folio=<? echo $row2["boleg_folio"] ?>" class="<? echo $estilo ?>" target="_blank">VER</a></td>
					<?
					$cont++;
				}
				?>

			</tr>
		</table>


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
			</body>
			</html>

			<?

			?>
