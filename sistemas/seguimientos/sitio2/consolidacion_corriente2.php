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





$getSuplentes = mysql_query("SELECT * FROM concilia_suplentes WHERE suplente_region =".$regionsession." AND suplente_estado = 1");

$arraySuplentes = array();

while($rowSuplente = mysql_fetch_array($getSuplentes))

{

	$arraySuplentes[] = $rowSuplente;

}



$getTitulares = mysql_query("SELECT * FROM concilia_titulares WHERE titular_region =".$regionsession." AND titular_estado = 1");

$arrayTitulares = array();

while($rowTitular = mysql_fetch_array($getTitulares))

{

	$arrayTitulares[] = $rowTitular;

}



$getEncargados = mysql_query("SELECT * FROM concilia_encargados WHERE encargado_region = ".$regionsession);

$encargados = mysql_fetch_array($getEncargados);

$getOficio = mysql_query("SELECT * FROM concilia_oficio WHERE concilia_region = ".$regionsession);
$oficio = mysql_fetch_array($getOficio);
?>

<html>

<head>

	<title>CHEQUES CADUCADOS</title>

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

  	function valida() {



  		if (document.form1.region.value==0 ) {

  			alert ("Region presenta problemas ");

  			return false;

  		}

  		if (document.form1.fecha1.value=='') {

  			alert ("Fecha Documento presenta problemas ");

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

											<td height="20" colspan="2"><span class="Estilo7">INGRESO CUENTAS CORRIENTE</span></td>

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

											<td><a href="consolidacion_menu.php" class="link" > Volver </a></td>

										</tr>



										<tr>

											<td><hr></td><td><hr></td>





										</tr>



										<tr>

											<td height="50" colspan="3">



												<table width="488" border="0" cellspacing="0" cellpadding="0">





												</td>





												<table border=1>

													<tr>

														<td class="Estilo1">NUMERO</td>

														<td class="Estilo1">DESCRIPCION</td>

														<td class="Estilo1">EDITAR </td>

													</tr>

													<?

													$sql="select * from concilia_cc where cc_region='$regionsession' order by cc_id desc";

//     echo $sql;

													$res2 = mysql_query($sql);

													while ($row2 = mysql_fetch_array($res2)) {



														?>

														<tr>

															<td  class="Estilo1"><? echo $row2["cc_numero"]; ?></td>

															<td  class="Estilo1"><? echo $row2["cc_descripcion"]; ?></td>

															<td  class="Estilo1"><a href="consolidacion_corriente3.php?id=<? echo  $row2["cc_id"]; ?>" class="link" > Editar </a></td>

														</tr>

														<?

													}

													?>









												</table>

												<BR>

													<table border="1" width="100%">

														<tr>

															<td class="Estilo1crojoc" align="center" colspan="3">FIRMAS GIRADORAS SUPLENTES</td>

														</tr>



														<tr>

															<td class="Estilo1" colspan="2">NOMBRE</td>

															<td class="Estilo1" colspan="1">ELIMINAR</td>

														</tr>



														<tbody>

															<?php foreach ($arraySuplentes as $key => $value): ?>

																<tr>

																	<td class="Estilo1" colspan="2"><?php echo $value["suplente_nombre"] ?></td>

																	<td colspan="1"><a href="eliminar_suplente.php?id=<?php echo $value["suplente_id"] ?>" class="Estilo2">ELIMINAR</td>

																</tr>

															<?php endforeach ?>

														</tbody>



														<form action="graba_firma_suplente.php" method="POST">

															<tr>

																<td class="Estilo1">NOMBRE</td>

																<td><input type="text" name="suplente" required class="Estilo1"></td>

																<td><input type="submit" value="Agregar"></td>

															</tr>

															<input type="hidden" name="region" value="<?php echo $regionsession ?>">

														</form>



													</table>



													<BR>

														<table border="1" width="100%">

															<tr>

																<td class="Estilo1crojoc" align="center" colspan="3">FIRMAS GIRADORAS TITULARES</td>

															</tr>



															<tr>

																<td class="Estilo1" colspan="2">NOMBRE</td>

																<td class="Estilo1" colspan="1">ELIMINAR</td>

															</tr>



															<tbody>

																<?php foreach ($arrayTitulares as $key => $value): ?>

																	<tr>

																		<td class="Estilo1" colspan="2"><?php echo $value["titular_nombre"] ?></td>

																		<td colspan="1"><a href="eliminar_titular.php?id=<?php echo $value["titular_id"] ?>" class="Estilo2">ELIMINAR</td>

																	</tr>

																<?php endforeach ?>

															</tbody>



															<form action="graba_firma_titular.php" method="POST">

																<tr>

																	<td class="Estilo1">NOMBRE</td>

																	<td><input type="text" name="titular" required class="Estilo1"></td>

																	<td><input type="submit" value="Agregar"></td>

																</tr>

																<input type="hidden" name="region" value="<?php echo $regionsession ?>">

															</form>

														</table>



														<br>

														<form action="edita_encargados.php" method="POST">

														<table border="1" width="100%">

															<tr>

																<td class="Estilo1crojoc" align="center" colspan="2">ENCARGADOS</td>

															</tr>



															<tr>

																<td class="Estilo2">ENCARGADO/A ELABORACION CONCILIACION</td>

																<td class="Estilo1"><input type="text" name="encargado_1" value="<?php echo $encargados["encargado_1"] ?>" required></td>

															</tr>



															<tr>

																<td class="Estilo2">ENCARGADO/A OFICINA DE CONTABILIDAD</td>

																<td class="Estilo1"><input type="text" name="encargado_2" value="<?php echo $encargados["encargado_2"] ?>" required></td>

															</tr>

															<tr>

																<td class="Estilo2">ENCARGADO/A SECCION CONTABILIDAD Y FINANZAS</td>

																<td class="Estilo1"><input type="text" name="encargado_3" value="<?php echo $encargados["encargado_3"] ?>" required></td>

															</tr>

															<tr>

																<td class="Estilo2">ENCARGADO/A OFICINA DE TESORERIA</td>

																<td class="Estilo1"><input type="text" name="encargado_4" value="<?php echo $encargados["encargado_4"] ?>" required></td>

															</tr>



															<tr>

																<td colspan="2" align="right"><input type="submit" value="Actualizar"></td>

															</tr>

														</table>

														<input type="hidden" name="region" value="<?php echo $regionsession ?>">

														</form>	

														<form action="edita_oficio.php">
															<table border="1" width="100%">
																<tr>
																	<td class="Estilo2">OFICIO QUE AUTORIZA</td>
																	<td><input class="Estilo1" type="text" name="oficio" value="<?php echo $oficio["concilia_oficio"] ?>"></td>
																</tr>

																<tr>
																<td></td>
																	<td><input type="submit" value="Actualizar"></td>
																</tr>
															</table>
															<input type="hidden" name="concilia_region" value="<?php echo $regionsession ?>">
														</form>

													

														<?

														if ($regionsession==15) {

															?>



															<table>

																<tr>

																	<td><a href="consolidacion_cuentasexcel.php" class="link" > Exportar todas la cuentas </a></td>

																</tr>

															</table>

															<?

														}

														?>



														<tr>

															<td colspan="8">



																<table border=1>

																	<tr></tr>







																	<tr>















																	</td>

																</tr>





						</table>

       <img src="images/pix.gif" width="1" height="10">






</body>

</html>


