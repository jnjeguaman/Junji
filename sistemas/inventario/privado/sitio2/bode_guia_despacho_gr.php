<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_POST);
$regionSession = $_SESSION["region"];

if(1 == 1 && ($regionSession == 16 || $regionSession == 7 || $regionSession == 8 || $regionSession == 12 || $regionSession == 2 || $regionSession == 3 || $regionSession == 4 || $regionSession == 5 || $regionSession == 9 || $regionSession == 1 || $regionSession == 6 || $regionSession == 15 || $regionSession == 14 || $regionSession == 11 || $regionSession == 10)){
// SE GENERA TODO TIPO DE GUIA DE DESPACHO ELECTRÓNICA EXCEPTO LAS DE CONSUMO INTERNO. $v_oc_tipoguia = 5
	if($v_oc_tipoguia <> 5) {
		/* INTEGRACION GUIA DESPACHO ELECTRONICA */
		require_once("52.php");

		if ($regionSession == 16) {
			$regionSession = 14;
		}else if($regionSession == 14)
		{
			$regionSession = 16;
		}




// OBTENCION DE USUARIO AUTORIZADO A EMITIR SEGUN REGION
		$dbsii = mysql_connect ("localhost", "usii", "ubnaeCFXqd4735PE") or die ('I cannot connect to the database because: ' . mysql_error());
		mysql_select_db("junji_sii",$dbsii);
		$sql = "SELECT * FROM sii_usuario WHERE usuario_region = ".$regionSession." AND usuario_autorizado_52 = 1 AND usuario_autorizado_firmar	= 1 AND (usuario_sistema = 2 OR usuario_sistema = 4) AND usuario_user = '".$_SESSION["nom_user"]."' LIMIT 1";
		$res = mysql_query($sql,$dbsii);
		$row = mysql_fetch_array($res);
		if($row["usuario_autorizado_52"] == 1 and $row["usuario_autorizado_firmar"] == 1)
		{

			$arrayDatosXML = array();
			$querytablabode_detoc ="SELECT * FROM bode_detoc WHERE doc_oc_id =".$id." and doc_estado <> 'ELIMINADO'";
			$querytablabode_orcom ="SELECT * FROM bode_orcom WHERE oc_id =".$id;
			$resultormcom = mysql_query($querytablabode_orcom,$dbh);
			$dataEnArrayBodeorcom = mysql_fetch_array($resultormcom);
			$resultormcom2 = mysql_query($querytablabode_detoc,$dbh);
			$detalleproductosporGD = array();
			while($rowData = mysql_fetch_array($resultormcom2))
			{
			// $detalleproductosporGD[] = $rowData;
				$detalleproductosporGD[] = array("doc_cantidad" => $rowData['doc_cantidad']  ,"doc_especificacion" =>$rowData['doc_especificacion'], "doc_conversion" =>$rowData['doc_conversion'],"doc_estado" => 0,"doc_umedida" => $rowData["doc_umedida"],"inv_codigo" => $rowData['doc_numerooc']);
			}
		// $regionDestino = $dataEnArrayBodeorcom['oc_region_destino'];
			$regionDestino = $region_destino;
			if ($regionDestino == 16) {
				$regionDestino = 14;
			}else if($regionDestino == 14)
			{
				$regionDestino = 16;
			}

			if($v_oc_tipoguia == 1)
			{
				$sql1 = "SELECT * FROM sii_empresa WHERE empresa_region = ".$regionDestino." AND empresa_origen = ".$origen_despacho;
				$res1 = mysql_query($sql1,$dbsii);
				$row1 = mysql_fetch_array($res1);

				$datosDestino = [
					"Destinatario" => $row1["empresa_glosa"],
					"Ciudad" => $row1["empresa_ciudad"],
					"Comuna" => $row1["empresa_comuna"],
					"Direccion" => $row1["empresa_direccion"]
				];

			}else if($v_oc_tipoguia == 2)
			{
				$sql1 = "SELECT * FROM acti_zona WHERE zona_glosa = '".$destinatario."'";
				$res1 = mysql_query($sql1,$dbh);
				$row1 = mysql_fetch_array($res1);

				$sql2 = "SELECT * FROM sii_comuna a INNER JOIN sii_provincia b ON a.comuna_provincia_id = b.provincia_id WHERE a.comuna_glosa = '".$row1["zona_comuna"]."'";
				$res2 = mysql_query($sql2,$dbsii);
				$row2 = mysql_fetch_array($res2);

				$datosDestino = [
					"Destinatario" => "JUNTA NACIONAL DE JARDINES INFANTILES",
					"Ciudad" => mb_convert_encoding($row2["provincia_glosa"],"ISO-8859-1"),
					"Comuna" => $row1["zona_comuna"],
					"Direccion" => $destinatario
				];

			}else if($v_oc_tipoguia == 3)
			{
				$sql1 = "SELECT * FROM jardines WHERE jardin_codigo = '".$destinatario."' AND jardin_region = ".$region_destino." and jardin_estado = 1 LIMIT 1";
				$res1 = mysql_query($sql1,$dbh);
				$row1 = mysql_fetch_array($res1);
				$datosDestino = [
					"Destinatario" => $row1["jardin_nombre"],
					"Ciudad" => $row1["jardin_provincia"],
					"Comuna" => $row1["jardin_comuna"],
					"Direccion" => $row1["jardin_direccion"]
				];
			}else if($v_oc_tipoguia == 6)
			{
				$sql1 = "SELECT * FROM sii_empresa WHERE empresa_region = ".$regionDestino." AND empresa_origen = ".$origen_despacho;
				$res1 = mysql_query($sql1,$dbsii);
				$row1 = mysql_fetch_array($res1);

				$datosDestino = [
					"Destinatario" => $row1["empresa_glosa"],
					"Ciudad" => $row1["empresa_ciudad"],
					"Comuna" => $row1["empresa_comuna"],
					"Direccion" => $row1["empresa_direccion"]
				];
			}



		/* TIPOS DE GUIA
		1 : BODEGA
		2 : OFICINA
		3 : JARDIN
		5 : TRASLADO INTERNO

		*/

		$arrayDatosXML['destino_region'] = $regionDestino;
		$arrayDatosXML['emisor_region'] = $regionSession;
		$arrayDatosXML['detalle_prod'] = $detalleproductosporGD;
		$arrayDatosXML['guia_despacho_id'] = $id;
		$arrayDatosXML['tipo_guia_despacho'] = $v_oc_tipoguia;
		$arrayDatosXML["emisor_rut"] = $row["usuario_rut"];
		$arrayDatosXML["emisor_dv"] = $row["usuario_dv"];
		$arrayDatosXML["datosDestino"] = $datosDestino;
		$arrayDatosXML["origen_despacho"] = $origen_despacho;
		$arrayDatosXML["dte_origen"] = 1;

		$errores = NULL;
		if($datosDestino["Ciudad"] == "")
		{
			$errores.=" HA OCURRIDO UN ERROR AL DETECTAR LA CIUDAD DE DESTINO.";
		}

		if($datosDestino["Comuna"] == "")
		{
			$errores.=" HA OCURRIDO UN ERROR AL DETECTAR LA COMUNA DE DESTINO.";	
		}

		if($datosDestino["Destinatario"] == "")
		{
			$errores.=" HA OCURRIDO UN ERROR AL DETECTAR EL DESTINATARIO.";	
		}

		if($datosDestino["Direccion"] == "")
		{
			$errores.=" HA OCURRIDO UN ERROR AL LA DIRECCIÓN DEL DESTINATARIO.";	
		}

		if($datosDestino["Ciudad"] == "" || $datosDestino["Comuna"] == "" || $datosDestino["Destinatario"] == "" || $datosDestino["Direccion"] == "")
		{
			echo "<script>alert('HA OCURRIDO UN ERROR : ".$errores."');window.history.back();</script>";
			exit;
		}

		// echo $sql1;
		// print_r($row1);exit;
		
		$GD52 = new GuiaDespachoElectronica($arrayDatosXML);
		$Response = $GD52->GenerarXML();
		if ($Response["Respuesta"]) {
			$idUltimoDteIngresado = $Response["Iddte"];
			$folio_generado = $Response["folio"];
			$folio = $folio_generado;
			// echo "<script>alert('".$idUltimoDteIngresado." : ".$folio_generado."');</script>";
			mysql_query("UPDATE bode_orcom SET oc_folioguia = ".$folio_generado." WHERE oc_id = ".$id,$dbh);
			mysql_query("UPDATE bode_orcom SET oc_dte_id = ".$idUltimoDteIngresado." where oc_id = ".$id,$dbh);
		}else{
			echo "<script>alert('HA OCURRIDO UN ERROR: ".$Response['Mensaje']."');window.history.back();</script>";
			exit();
		}
	}else{
		echo "<script>alert('No hay usuarios autorizados a emitir documentos electronicos para su region');window.history.back();</script>";
		exit;
	}

}
}
/* FIN INTEGRACION */

//TRASLADO
if($v_oc_tipoguia == 6)
{
	$data = mysql_query($qry,$dbh);
	$dataResult = array();
	while($rowData = mysql_fetch_array($data))
	{
		$dataResult[] = $rowData;
	}

	// OBTENEMOS LA INFORMACION DEL PRODUCTO
	foreach ($dataResult as $key => $value) {
		$data1 = mysql_query("SELECT * FROM bode_detingreso WHERE ding_id = ".$value["doc_origen_id"],$dbh);
		$dataRes = mysql_fetch_array($data1);

		// VERIFICAMOS SI LA CANTIDAD ENVIADA ES IGUAL AL STOCK DISPONIBLE

		// if(($value["doc_cantidad"] / $dataRes["ding_factor"]) == $dataRes["ding_cantidad"])
		if($value["doc_cantidad"] == $dataRes["ding_cantidad"])
		{
			// SOLO CAMBIAMOS DE POSICION LOS BIENES
			mysql_query("UPDATE bode_detingreso SET ding_ubicacion = '".$_POST["destinatario"]."', ding_unidad = ".$value["doc_cantidad"]." WHERE ding_id = ".$value["doc_origen_id"],$dbh);
		}else{
			// SE REALIZA EL DESCUENTO DEL STOCK Y SE AGREGA UNA NUEVA LINEA
			// mysql_query("UPDATE bode_detingreso SET ding_unidad = ding_unidad - ".$value["doc_cantidad"]." WHERE ding_id = ".$value["doc_origen_id"]);
			mysql_query("INSERT INTO bode_detingreso VALUES (
				NULL,
				".$dataRes["ding_ing_id"].",
				".$dataRes["ding_prod_id"].",
				".$value["doc_cantidad"].",
				".$dataRes["ding_region_id"].",
				'".$dataRes["ding_recep_tecnica"]."',
				".$dataRes["ding_cant_conf"].",
				".$dataRes["ding_cant_despacho"].",
				".$dataRes["ding_cant_final"].",
				".$dataRes["ding_cant_rechazo"].",
				'".$dataRes["ding_glosa_rechazo"]."',
				'".$_POST["destinatario"]."',
				'".$dataRes["ding_user"]."',
				'".$dataRes["ding_fecha"]."',
				'".$dataRes["ding_userf"]."',
				'".$dataRes["ding_fechaf"]."',
				'".$dataRes["ding_fentrega"]."',
				'".$dataRes["ding_recep_conforme"]."',
				'".$dataRes["ding_umedida"]."',
				".$value["doc_cantidad"].",
				".$dataRes["ding_factor"].",
				'".$dataRes["ding_clasificacion"]."',
				".$dataRes["ding_devengo"].",
				0)",$dbh);
		}
		
	}

}
// CARGAMOS EL ARCHIVO
$extensionesPeritidas =  array("pdf","PDF","xlsx","xls","XLSX","XLS","msg","MSG");
$archivo1 = $_FILES["archivo"]['name'];

if ($archivo1 != "") {
	$extension = pathinfo($archivo1,PATHINFO_EXTENSION);

	if(in_array($extension, $extensionesPeritidas))
	{
		$archivo1 = "doc_".$id.".".$extension;
		$ruta1="archivos/doclogistica/".date("Y")."/".$regionSession."/gd/";
		mkdir("../../../".$ruta1,0777,true);
		$destino =  "../../../".$ruta1.$archivo1;

		if(file_exists($destino))
		{
			$mensaje .= "El archivo ya existe en el sistema<br>";
			$respuesta = false;
		}else{
			if (copy($_FILES["archivo"]['tmp_name'],$destino)) {
				mysql_query("UPDATE bode_orcom SET oc_rutatc = '".$ruta1."', oc_archivotc = '".$archivo1."' WHERE oc_id = ".$id,$dbh);
			}else{
				$errores = error_get_last();
				$mensaje .= "Ha ocurrido un error al copiar el archivo: ".$errores["message"];
				$respuesta = false;
			}
		}
	}else{
		$mensaje.="Las extensiones permitidas son: .pdf,xlsx,xls";
		$respuesta = false;
		echo $mensaje;
		// exit();
	}
}
// FIN CARGA ARCHIVO

$nombrecom=$_SESSION["nombrecom"];
$usuario=$_SESSION["nom_user"];
$emision= substr($emision,6,4)."-".substr($emision,3,2)."-".substr($emision,0,2);
$query = "update bode_orcom set oc_usu = '$nombrecom', oc_guiafecha='$emision', oc_guiaabaste='$abastece', oc_guiadestina='$destinatario', oc_guiaemisor='$usuario', oc_obs = '$obs', oc_estado=1 where oc_id=$id";
mysql_query("UPDATE bode_orcom SET oc_folioguia = ".$folio." WHERE oc_id = ".$id,$dbh);
mysql_query($query,$dbh);
// echo $tipo;
if($tipo=="Inventariable" || $tipo == "Existencia")
{
	// CREAR DIRECTORIO EN CASO DE NO EXISTIR EN ARCHIVOS/RESPALDO/INEDIS/AÑO/MES
	$ruta = "../../../archivos/respaldos/INEDIS/".date("Y")."/".date("m");
	mkdir($ruta,0777,true);	// CREAMOS LA CARPETA EN CASO DE NO EXISTIR

	$fichero = $_SESSION["region"]."_actualiza_inventario_".date("Ymd").".txt";
	for($i=1;$i<=$totalElementos;$i++)
	{
		if($desde[$i] <> "" && $hasta[$i] <> "")
		{
			for($j=$desde[$i];$j<=$hasta[$i];$j++)
			{
				// mysql_query("UPDATE acti_inventario SET inv_gd = ".$folio.", inv_direccion = '".$destinatario."' WHERE inv_codigo = ".$j,$dbh);
				// echo "UPDATE acti_inventario SET inv_gd = ".$folio.", inv_direccion = '".$destinatario."' WHERE inv_codigo = ".$j."<br>";
				$sql4 = "UPDATE acti_inventario SET inv_gd = '".$folio."', inv_direccion = '".$destinatario."' WHERE inv_region = '".$region_destino."' AND inv_codigo = ".$j;
				mysql_query($sql4,$dbh);
				$fp = fopen($ruta."/".$fichero, "a");
				fwrite($fp, date("Y-m-d H:i:s").";".$sql4.";".$_SESSION["nom_user"].";".$folio.";".$id.";".$destinatario.";".$j."\r");
				fclose($fp);
			}
		}
	}
	// if($desde <> "" && $hasta <> "")
	// {
	// 	$desde = trim($desde);
	// 	$hasta = trim($hasta);
	// 	for($i=$desde;$i<=$hasta;$i++)
	// 	{
	// 		mysql_query("UPDATE acti_inventario SET inv_gd = ".$folio.", inv_direccion = '".$destinatario."' WHERE inv_codigo = ".$i);
	// 	}
	// }

	if($separados <> "")
	{
		$separados = trim($separados);
		$separados = str_replace(".", ",", $separados);
		$separados = str_replace("-", ",", $separados);
		$separados = str_replace(";", ",", $separados);
		$pos = strpos($separados,',');
		if($pos == "")
		{
			$sql5 ="UPDATE acti_inventario SET inv_gd = '".$folio."', inv_direccion = '".$destinatario."' WHERE inv_region = '".$region_destino."' AND inv_codigo = ".trim($separados);
			// mysql_query("UPDATE acti_inventario SET inv_gd = ".$folio.", inv_direccion = '".$destinatario."' WHERE inv_codigo = ".trim($separados),$dbh);
			mysql_query($sql5,$dbh);
			$fp = fopen($ruta."/".$fichero, "a");
			fwrite($fp, date("Y-m-d H:i:s").";".$sql5.";".$_SESSION["nom_user"].";".$folio.";".$id.";".$destinatario.";".$j."\r");
			fclose($fp);
		}else{
			$separadosArray = explode(",",$separados);
			foreach ($separadosArray as $key => $value) {
			// mysql_query("UPDATE acti_inventario SET inv_gd = ".$folio.", inv_direccion = '".$destinatario."' WHERE inv_codigo = ".trim($value));
				if($value <> "")
				{
					// mysql_query("UPDATE acti_inventario SET inv_gd = ".$folio.", inv_direccion = '".$destinatario."' WHERE inv_codigo = ".trim($value),$dbh);
					$sql3 = "UPDATE acti_inventario SET inv_gd = '".$folio."', inv_direccion = '".$destinatario."' WHERE inv_region = '".$region_destino."' AND inv_codigo = ".trim($value);
					mysql_query($sql3,$dbh);
					$fp = fopen($fichero, "a");
					fwrite($fp, date("Y-m-d H:i:s").";".$sql3.";".$_SESSION["nom_user"].";".$folio.";".$id.";".$destinatario."\r");
					fclose($fp);
				}
			}
		}

	}
	// echo "<pre>";
	// print_r($_SESSION["arr"]);
	// echo $totalElementos;

	// for($z = 0; $z < count($_SESSION["inv_id"]); $z++)
// {
	// print_r($_SESSION["inv_id"][$z]."<br>");
	// $update = "UPDATE acti_inventario SET inv_gd = ".$folio.", inv_direccion = '".$destinatario."' WHERE inv_id = ".$_SESSION["inv_id"][$z];
	// echo $update."<br>";
	// mysql_query($update);
// }

// exit();
	// var_dump($_SESSION["arr"]);
	// //BUSCA
	// $busca = "SELECT * FROM acti_inventario WHERE inv_doc_id = ".$inv_doc_id." AND inv_ding_id = ".$inv_ding_id." AND (inv_direccion IS NULL OR inv_direccion = '') LIMIT ".$qty;
	// echo $busca;
	// exit();
	// $busca = mysql_query($busca);
	// while($row = mysql_fetch_array($busca))
	// {
	// $update = "UPDATE acti_inventario SET inv_gd = '".$folio."', inv_direccion = '".$destinatario."' WHERE inv_codigo = ".$row["inv_codigo"];
	// mysql_query($update);
	// }
// $_SESSION["inv_id"] = array();
}

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$id.",1,'CIERRA G/D','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','DESPACHOS')";
mysql_query($log,$dbh);
$_SESSION["Inventario"] = array();
?>
<!--
<?php if ($imprimir == "SI"): ?>
	<?php if ($_SESSION["region"] == 16): ?>
		<script type="text/javascript">
			window.open("../../../../SII_JUNJI/documento.php?dte_id=<?php echo $idUltimoDteIngresado ?>&regionSession=<?php echo $regionDestino ?>");
		</script>
	<?php endif ?>
	<script type="text/javascript">
		<?php if($tipo == 5) { ?>
			window.open("reporte/consumo.php?id=<?php echo $id ?>");
			window.location.href="bode_inv_indexoc3.php?cod=22";
			<?php }else{ ?>
				window.open("bode_guia_despacho.php?id=<?php echo $id ?>");
				window.location.href="bode_inv_indexoc3.php?cod=22";
				<?php } ?>
			</script>
		<?php else: ?>
			<script type="text/javascript">window.location.href="bode_inv_indexoc3.php?cod=22";</script>
		<?php endif ?>
		!-->

		<script type="text/javascript">
			<?php if ($imprimir == "SI"): ?>


			<?php if ($_SESSION["region"] == 16 || $_SESSION["region"] == 7 || $_SESSION["region"] == 8 || $_SESSION["region"] == 12 || $_SESSION["region"] == 2|| $_SESSION["region"] == 3 || $_SESSION["region"] == 4 || $_SESSION["region"] == 5 || $_SESSION["region"] == 9 || $_SESSION["region"] == 1 || $_SESSION["region"] == 6 || $_SESSION["region"] == 15 || $_SESSION["region"] == 14 || $_SESSION["region"] == 11 || $_SESSION["region"] == 10): ?>
// TIPO
<?php if ($tipo == 5): ?>
window.open("reporte/consumo.php?id=<?php echo $id ?>");
<?php else: ?>
window.open("../../../../SII_JUNJI/documento.php?dte_id=<?php echo $idUltimoDteIngresado ?>&regionSession=<?php echo $regionDestino ?>&origen=1");
<?php endif ?>
// FIN TIPO

<?php else: ?>

// TIPO
<?php if ($tipo == 5): ?>
window.open("reporte/consumo.php?id=<?php echo $id ?>");
<?php else: ?>
window.open("bode_guia_despacho.php?id=<?php echo $id ?>");
<?php endif ?>
// FIN TIPO

<?php endif ?>



<?php else: ?>
window.location.href="bode_inv_indexoc3.php?cod=22";
<?php endif ?>
window.location.href="bode_inv_indexoc3.php?cod=22";
</script>