<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
extract($_POST);
extract($_GET);
$date_in=date("d-m-Y");
$fechamio=date("Y-m-d");
$annomio=date("Y");
$annomio2=$annomio-1;
$usuario=$_SESSION["nom_user"];

?>

<html>
<head>
	<title>Unidades</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<script>
		function valida2() {
			if (document.buscar.etiqueta.value==''  ) {
				alert ("Nombre presenta problemas ");
				document.buscar.etiqueta.focus();
				return false;
			}
			return true;
		}

		function ponPrefijo(pref,aux) {
			opener.document.formul.codigo.value=pref
			opener.document.formul.pvp.value=aux
			window.close()
		}

		function cerrarventana(){
			window.opener.location.replace('facturasarchivos.php?id=<? echo $id ?>&&id1b=<?php echo $id2 ?>&ori=<?php echo $ori ?>');
//   opener.document.form1.submit();
window.close();
//alert('cerrando');
}
function muestra(){

	if (document.buscar.alerta.checked==true) {
		seccion1.style.display="";
		seccion2.style.display="";
		seccion3.style.display="";
	} else {
		seccion1.style.display="none";
		seccion2.style.display="none";
		seccion3.style.display="none";
	}



}

</script>
</head>
<body>
	<?

	if(isset($_POST) && $_POST["submit"] == 1)
	{
	// GRABAR EN dpp_facturas_antecedente
		$archivo1 = $_FILES["archivo1"]['name'];
		$ruta = "../../archivos/docfac";
		$archivo = "doc".date("Y")."/factura/ANTECEDENTE_FACTURA_".date("YmdHis").".PDF";

		$destino = $ruta."/".$archivo;
		if ($archivo1 != "" and $etiqueta!='') {
			$sql2="INSERT INTO dpp_facturas_antecedente (ant_id,ant_fecha,ant_hora,ant_region,ant_usuario,ant_estado,ant_ruta,ant_nombre) VALUES(NULL,'".date("Y-m-d")."','".date("H:i:s")."','".$regionsession."','".$_SESSION["nom_user"]."',1,'".$archivo."','".$_POST["etiqueta"]."')";
    // exit();
			mysql_query($sql2);
	// GRABAR ARCHIVO EN CARPETA
			copy($_FILES["archivo1"]['tmp_name'],$destino);
		}
		$mensaje = "
		<div class='alert alert-success' role='alert'>
		<strong>Archivo cargado correctamente</strong>
		</div>
		";

	}

	?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<form action="facturas_antecedente.php" name="buscar" method="post" enctype="multipart/form-data"  onSubmit="return valida2()">

					<table class="table table-bordered">
						<tr>
							<td><font color="red"><strong>*</strong></font> Descripción</td>
							<td>
								<input type="text" name="etiqueta" class="form-control" required>
							</td>
						</tr>

						<tr>
							<td><font color="red"><strong>*</strong></font> Archivo</td>
							<td>
								<input type="file" name="archivo1" class="form-control" required>
								<a href="../../archivos/docfac/<? echo $row21["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row21["oc_archivo"]; ?></a>
							</td>
						</tr>

						<tr>
							<td  colspan="2" align="center">
								<!-- <input type="submit" value="Subir Archivo" class="btn btn-primary btn-sm"> -->
								<button class="btn btn-primary btn-sm" type="submit">SUBIR</button>
								<a href="#" onclick="window.close()" class="btn btn-danger btn-sm">CERRAR</a>
							</td>
						</tr>
					</table>

					<input type="hidden" name="submit" value="1">
				</form>
			<?php echo $mensaje ?>
			</div>
		</div>
	</div>

