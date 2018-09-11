<?
require("../inc/config.php");
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

  	function cerrarventana(){
  		opener.location.reload(); window.close();
}



</script>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
	<br>
	<form action="subirarchivo.php" name="buscar" method="post" enctype="multipart/form-data">

		<?
		$extensionesPeritidas =  array("xlsx","xls");
		$archivo1 = $_FILES["archivo1"]['name'];

		if ($archivo1 != "") {
			$extension = pathinfo($archivo1,PATHINFO_EXTENSION);
			if(in_array($extension, $extensionesPeritidas))
			{
				$archivo1 = "docdist".$oc_id.".".$extension;
				$ruta1="archivos/docdist/";
				$destino =  "../../../../".$ruta1.$archivo1;

				if(file_exists($destino))
				{
					echo "El archivo ya existe en el sistema";
				}else{
					if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {
						$sql2 = "UPDATE bode_orcom SET oc_rutatc = '".$ruta1."', oc_archivotc = '".$archivo1."' WHERE oc_id = ".$oc_id;
						mysql_query($sql2);
						echo "<script>cerrarventana();</script>";
					}else{
						echo "Error al copiar '".$archivo1."'";
					}
				}

			}else{
				echo "Extensiones permitidas: .xlsx, .xls";
			}
		}


		?>

		<table>
			<tr>
				<td class="Estilo1">Archivo
					<input type="file" name="archivo1" class="Estilo2" size="20"  > <br>
					<a href="../../archivos/docfac/<? echo $row21["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row21["oc_archivo"]; ?></a>
				</td>
			</tr>

			<tr>
				<td  class="Estilo1" colspan=2>
					<input type="submit" value="Subir Archivo">
				</td>
			</tr>
		</table>


		<input type="hidden" name="oc_id" value="<? echo $oc_id ?>" >
	</form>
	<br><br>
	<input type="submit" name="Submit" value="Cerrar ventana" onclick="JavaScript: window.close();">

