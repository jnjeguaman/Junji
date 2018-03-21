<?
require("inc/config.php");
$regionsession = $_SESSION["region"];
extract($_POST);
extract($_GET);
$date_in=date("d-m-Y");
$annomio=date("Y");
$annomio2=$annomio-1;



?>
<html>
<head>
	<title>Unidades</title>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
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
		.Estilo3 {
			font-family: Verdana;
			font-size: 9px;
			text-align: left;
			font-weight: bold;
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
			text-align: right;
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
			font-size: 12px;
			font-weight: bold;
			color: #00659C;
			text-decoration:none;
			text-transform:uppercase;
		}
		.link:over {
			font-family: Geneva, Arial, Helvetica, sans-serif;
			font-size: 12px;
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


	<!-- calendar stylesheet -->
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

	<!-- main calendar program -->
	<script type="text/javascript" src="librerias/calendar.js"></script>

	<!-- language for the calendar -->
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
  adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

  <script>
  	function ponPrefijo(pref,aux) {
  		opener.document.formul.codigo.value=pref
  		opener.document.formul.pvp.value=aux
  		window.close()
  	}

  	function cerrarventana(a){
  		window.opener.location.replace('consolidacion_reporte1.php?numero='+a);
  		opener.document.form1.submit();
  		window.close();
//alert('cerrando');
}



</script>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
	<br>
	<form action="consolidacion_subirarchivo.php" name="buscar" method="post" enctype="multipart/form-data" onsubmit="return valida()">

		<?
		$archivo1 = $_FILES["archivo1"]['name'];
		//echo "-->".$archivo1;
		if ($archivo1 != "") {
			$mensaje = "";
			if($_FILES["archivo1"]["type"] <> "application/pdf"){
				$mensaje.="Contenido del archivo no es PDF<br>";
			}
			$extension = strtoupper(pathinfo($_FILES["archivo1"]["name"],PATHINFO_EXTENSION));

			if($extension <> "PDF")
			{
				$mensaje.="Extensión no permitida<br>";
			}

			if($mensaje == "")
			{
				$archivo1="rep".$regionsession."_".$numero."_".$mesp."_".$annop.".PDF";
     		// guardamos el archivo a la carpeta files
				$destino =  "../../archivos/docconciliacion/reportes/".$archivo1;
				//echo "-->".$archivo1;
				if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {
					$status = "Archivo subido: <b>".$archivo1."</b>";
					$sql2="update concilia_resumen set resu_archivo='$archivo1' where resu_numero='$numero' and resu_mesp='$mesp' and resu_annop='$annop' ";
				//        echo $sql2;
					mysql_query($sql2);
				}
				echo "<script>cerrarventana(".$numero.");</script>";
			}else{
				echo $mensaje;
				echo '<input type="submit" name="Submit" value="Cerrar ventana" onclick="JavaScript: window.close();">';
			}

		}


		?>


		<table>
			<tr>
				<td class="Estilo1">Archivo
					<input type="file" name="archivo1" class="Estilo2" size="20" required> <br>
					<a href="../../archivos/docconciliacion/resportes/<? echo $row21["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row21["oc_archivo"]; ?></a>
				</td>
			</tr>

			<tr>
				<td  class="Estilo1" colspan=2>
					<input type="submit" value="Subir Archivo">
				</td>
			</tr>
		</table>


		<input type="hidden" name="numero" value="<? echo $numero ?>" >
		<input type="hidden" name="mesp" value="<? echo $mesp ?>" >
		<input type="hidden" name="annop" value="<? echo $annop ?>" >

	</form>
	<br><br>
	<input type="submit" name="Submit" value="Cerrar ventana" onclick="JavaScript: window.close();">

	<script>
		function valida()
		{
			var archivo1 = document.buscar.archivo1.value;

			if(archivo1 != "")
			{
				var extension = archivo1.split(".").pop().toUpperCase();
				if(extension != "PDF")
				{
					alert("La extension permitida es : .PDF");
					document.buscar.archivo1.focus();
					return false;
				}else{
					return true;
				}
			}
		}
	</script>