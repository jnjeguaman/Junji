<?
session_start();
extract($_POST);
extract($_GET);
extract($_SESSION);
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

?>
<html>
<head>
	<title>CHEQUES CADUCADOS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/estilos.css" rel="stylesheet" type="text/css">
	<link href="../../inventario/privado/sitio2/css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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
												<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" onSubmit="return valida()">
													<table border="1">
														<tr>
															<td class="Estilo1mc">ORDEN DE COMPRA : <input type="text" size="3" name="oc1" id="oc1" value="<?php echo $oc1 ?>">-<input type="text" size="3" id="oc2" name="oc2" value="<?php echo $oc2 ?>">-<input type="text" size="3" id="oc3" name="oc3" value="<?php echo $oc3 ?>"> <button type="submit" name="submit" value="BUSCAR">Buscar <i class="fa fa-search"></i></button></td>
														</tr>
													</table>
												</form>
												<?php if(isset($submit) && $submit == "BUSCAR") {/*$_SESSION["oc1"] =  $oc1; $_SESSION["oc2"] = $oc2;$_SESSION["oc3"] = $oc3;*/include("devengo_ori1.php"); }?>
												<?php if($ori == 2) { include("devengo_ori2.php"); }?>
												<?php if($_POST["ori"] == 3) { include("devengo_ori3.php"); }?>
											</tr>

										</table>

										<img src="images/pix.gif" width="1" height="10">
									</body>
									</html>

									<script type="text/javascript">

										$("#toggle").click(function(event)
										{
											if($("#toggle").is(":checked"))
											{
												$(':checkbox').each(function() {
													this.checked = true;                        
												});
											}else{
												$(':checkbox').each(function() {
													this.checked = false;                        
												});
											}
										});

										function valida(){
											var prefijoOC = $("#oc1").val();
											var correlativoOC = $("#oc2").val();
											var sufijoOC = $("#oc3").val();

											if(prefijoOC == "")
											{
												alert("INGRESE EL PREFIJO DE LA ORDEN DE COMPRA");
												$("#oc1").focus();
												return false;
											}else if(correlativoOC == "")
											{
												alert("INGRESE EL CORRELATIVO DE LA ORDEN DE COMPRA");
												$("#oc2").focus();
												return false;
											}else if(sufijoOC == "")
											{
												alert("INGRESE EL SUFIJO DE LA ORDEN DE COMPRA");
												$("#oc3").focus();
												return false;
											}else{
												return true;
											}
										}
									</script>
