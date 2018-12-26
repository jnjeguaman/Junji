<?php 
session_start();
if ($_SESSION["nom_user"] == "") {
?>
	<script language="javascript">location.href='sesion_perdida.php';</script>
<?php
}

$regionSession = $_SESSION["region"];
require("inc/config.php");
extract($_POST);
$direccion = "SELECT zona_glosa FROM acti_zona WHERE zona_id = '" . $responsa . "'";
$direccion = mysql_query($direccion, $dbh);
$direccion = mysql_fetch_array($direccion);
$direccion = $direccion["zona_glosa"];
$contador = 0;
$tipo = intval($tipo);

$abastece = reemplazaCaracter($abastece);
$destinatario = reemplazaCaracter($destinatario);
$responsa2 = reemplazaCaracter($responsa2);
$comuna2 = reemplazaCaracter($comuna2);
$emisor = reemplazaCaracter($emisor);
$obs = reemplazaCaracter($obs);
$responsa = reemplazaCaracter($responsa);
$inv_responsable = reemplazaCaracter($inv_responsable);
$obs = reemplazaCaracter($obs);


$fechamia = date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL," . $nro_guia . ",0,'GENERACION G/D','" . $_SESSION["nom_user"] . "','" . $fechamia . "','" . $horaSys . "','INVENTARIO','GUIA')";
mysql_query($log, $dbh);
if (1 == 1 && ($regionSession == 12 || $regionSession == 13 || $regionSession == 1 || $regionSession == 3 || $regionSession == 4 || $regionSession == 6 || $regionSession == 7 || $regionSession == 15 || $regionSession == 5 || $regionSession == 11 || $regionSession == 16 || $regionSession == 10 || $regionSession == 11)) {
	/* INTEGRACION GUIA DE DESPACHO ELECTRONICA */
	if ($regionSession == 16) {
		$regionSession = 14;
	} else if ($regionSession == 14) {
		$regionSession = 16;
	}
// OBTENCION DE USUARIO AUTORIZADO A EMITIR SEGUN REGION
	$dbsii = mysql_connect("192.168.100.237", "admin", "Hol@1234") or die('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db("junji_sii", $dbsii);	
	$sql = "SELECT * FROM sii_usuario WHERE usuario_region = " . $regionSession . " AND usuario_autorizado_52 = 1 AND usuario_autorizado_firmar	= 1 AND (usuario_sistema = 3 OR usuario_sistema = 4) AND usuario_user = '" . $_SESSION["nom_user"] . "' LIMIT 1";
	$res = mysql_query($sql, $dbsii);
	$row = mysql_fetch_array($res);
	if ($row["usuario_autorizado_52"] == 1 and $row["usuario_autorizado_firmar"] == 1) {
		require_once("52.php");
		$arrayItems = $_SESSION["items"];
		$idUltimoDteIngresado = null;
		$arrayDatosXML = array();
		$detalleproductosporGD = array();
		foreach ($arrayItems as $key => $value) {
			$query_tabla_acti_inventario = "SELECT * FROM acti_inventario WHERE inv_id =" . $value['inv_id'];
			$resultinventario = mysql_query($query_tabla_acti_inventario, $dbh);
			$dataEnArrayInventario = mysql_fetch_array($resultinventario);
			$detalleproductosporGD[] = array("doc_cantidad" => $value['inv_qty'], "doc_especificacion" => $dataEnArrayInventario['inv_bien'], "doc_conversion" => $dataEnArrayInventario['inv_costo'], "doc_estado" => 0, "doc_umedida" => 'UNID', "inv_codigo" => $value['inv_codigo']);
		}

		if ($tipo == 1) {
			// Verificamos si es jardin infanil
			$temp = explode(" ", $responsa);
			if ($temp[0] == "JI") {
				$sql_j = "select * from jardines where jardin_codigo = " . $temp[1] . " and jardin_estado = 1 limit 1";
				$res_j = mysql_query($sql_j, $dbh);
				$row_j = mysql_fetch_array($res_j);
				$datosDestino = [
					"Destinatario" => $row_j["jardin_codigo"] . " / " . $row_j["jardin_nombre"],
					"Ciudad" => $row_j["jardin_provincia"],
					"Comuna" => $row_j["jardin_comuna"],
					"Direccion" => $row_j["jardin_direccion"]
				];
			} else {
				$datosDestino = [
					"Destinatario" => $destinatario,
					//"Destinatario" => "JUNTA NACIONAL DE JARDINES INFANTILES",
					"Ciudad" => $comuna,
					"Comuna" => $comuna,
					"Direccion" => $responsa
				];
			}
		} else {
			$datosDestino = [
				"Destinatario" => $destinatario,
				"Ciudad" => $comuna2,
				"Comuna" => $comuna2,
				"Direccion" => $responsa2
			];
		}

		$errores = null;
		if ($datosDestino["Ciudad"] == "") {
			$errores .= " HA OCURRIDO UN ERROR AL DETECTAR LA CIUDAD DE DESTINO.";
		}

		if ($datosDestino["Comuna"] == "") {
			$errores .= " HA OCURRIDO UN ERROR AL DETECTAR LA COMUNA DE DESTINO.";
		}

		if ($datosDestino["Destinatario"] == "") {
			$errores .= " HA OCURRIDO UN ERROR AL DETECTAR EL DESTINATARIO.";
		}

		if ($datosDestino["Direccion"] == "") {
			$errores .= " HA OCURRIDO UN ERROR AL LA DIRECCIÓN DEL DESTINATARIO.";
		}

		if ($datosDestino["Ciudad"] == "" || $datosDestino["Comuna"] == "" || $datosDestino["Destinatario"] == "" || $datosDestino["Direccion"] == "") {
			echo "<script>alert('HA OCURRIDO UN ERROR : " . $errores . "');window.history.back();</script>";
			exit;
		}
		
		// $arrayDatosXML['destino_region'] = $regionSession;
		// $arrayDatosXML['emisor_region'] = $regionSession;
		// $arrayDatosXML['detalle_prod'] = $detalleproductosporGD;
		// $arrayDatosXML['guia_despacho_id'] = $nro_guia;
		// $arrayDatosXML["emisor_rut"] = $row["usuario_rut"];
		// $arrayDatosXML["emisor_dv"] = $row["usuario_dv"];

		$arrayDatosXML['destino_region'] = $regionSession;
		$arrayDatosXML['emisor_region'] = $regionSession;
		$arrayDatosXML['detalle_prod'] = $detalleproductosporGD;
		$arrayDatosXML['guia_despacho_id'] = $nro_guia;
		$arrayDatosXML["emisor_rut"] = $row["usuario_rut"];
		$arrayDatosXML["emisor_dv"] = $row["usuario_dv"];
		$arrayDatosXML["datosDestino"] = $datosDestino;
		$arrayDatosXML["origen_despacho"] = 2;
		$arrayDatosXML["dte_origen"] = 2;

		$GD52 = new GuiaDespachoElectronica($arrayDatosXML);
		$Response = $GD52->GenerarXML();
		if ($Response["Respuesta"]) {
			$idUltimoDteIngresado = $Response["Iddte"];
			$folio_generado = $Response["folio"];
		} else {
			echo "<script>alert('HA OCURRIDO UN ERROR :  " . $Response['Mensaje'] . "');window.history.back();</script>";
			exit;
		}
		/* FIN INTEGRACION */
	} else {
		echo "<script>alert('No hay usuarios autorizados a emitir documentos electronicos para su region');window.history.back();</script>";
		exit;
	}

}//IF

if ($tipo === 0) {
	if ($_SESSION["region"] == 12 || $_SESSION["region"] == 13 || $_SESSION["region"] == 1 || $_SESSION["region"] == 3 || $_SESSION["region"] == 4 || $_SESSION["region"] == 6 || $_SESSION["region"] == 7 || $_SESSION["region"] == 15 || $_SESSION["region"] == 5 || $_SESSION["region"] == 11 || $_SESSION["region"] == 16 || $_SESSION["region"] == 10 || $_SESSION["region"] == 11) {
		$sql = "INSERT INTO `inv_guia_despacho_encabezado`(`guia_id`, `guia_numero`, `guia_emision`, `guia_abastece`, `guia_destinatario`, `guia_direccion`, `guia_comuna`,`guia_emisor`,`guia_obs`,`guia_estado`,`guia_origen`,`guia_region_origen`,`guia_dte_id`) VALUES (0,'" . $folio_generado . "','" . $fechamia . "','" . $abastece . "','" . $destinatario . "','" . $responsa2 . "','" . $comuna2 . "','" . $emisor . "','" . $obs . "',1,0," . $_SESSION["region"] . ",'" . $idUltimoDteIngresado . "')";
	} else {
		$sql = "INSERT INTO `inv_guia_despacho_encabezado`(`guia_id`, `guia_numero`, `guia_emision`, `guia_abastece`, `guia_destinatario`, `guia_direccion`, `guia_comuna`,`guia_emisor`,`guia_obs`,`guia_estado`,`guia_origen`,`guia_region_origen`) VALUES (0,'" . $nro_guia . "','" . $fechamia . "','" . $abastece . "','" . $destinatario . "','" . $responsa2 . "','" . $comuna2 . "','" . $emisor . "','" . $obs . "',1,0," . $_SESSION["region"] . ")";
	}
	if (mysql_query($sql, $dbh)) {
		$ultimo_id = mysql_insert_id($dbh);
		grabarDetalle($_SESSION["items"], $ultimo_id, $tipo, $idUltimoDteIngresado, $regionSession);

	} else {
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}

} else {
	if ($_SESSION["region"] == 12 || $_SESSION["region"] == 13 || $_SESSION["region"] == 1 || $_SESSION["region"] == 3 || $_SESSION["region"] == 4 || $_SESSION["region"] == 6 || $_SESSION["region"] == 7 || $_SESSION["region"] == 15 || $_SESSION["region"] == 5 || $_SESSION["region"] == 11 || $_SESSION["region"] == 16 || $_SESSION["region"] == 10 || $_SESSION["region"] == 11) {
		$sql = "INSERT INTO `inv_guia_despacho_encabezado`(`guia_id`, `guia_numero`, `guia_emision`, `guia_abastece`, `guia_destinatario`, `guia_direccion`, `guia_zona`, `guia_comuna`, `guia_responsable`,`guia_emisor`,`guia_obs`,`guia_estado`,`guia_origen`,`guia_region_origen`,`guia_dte_id`) VALUES (0,'" . $folio_generado . "','" . $fechamia . "','" . $abastece . "','" . $destinatario . "','" . $responsa . "','" . $inv_zona . "','" . $comuna . "','" . $inv_responsable . "','" . $emisor . "','" . $obs . "',1,0," . $_SESSION["region"] . ",'" . $idUltimoDteIngresado . "')";
	} else {
		$sql = "INSERT INTO `inv_guia_despacho_encabezado`(`guia_id`, `guia_numero`, `guia_emision`, `guia_abastece`, `guia_destinatario`, `guia_direccion`, `guia_zona`, `guia_comuna`, `guia_responsable`,`guia_emisor`,`guia_obs`,`guia_estado`,`guia_origen`,`guia_region_origen`) VALUES (0,'" . $nro_guia . "','" . $fechamia . "','" . $abastece . "','" . $destinatario . "','" . $responsa . "','" . $inv_zona . "','" . $comuna . "','" . $inv_responsable . "','" . $emisor . "','" . $obs . "',1,0," . $_SESSION["region"] . ")";
	}
	if (mysql_query($sql, $dbh)) {
		$ultimo_id = mysql_insert_id($dbh);
		grabarDetalle($_SESSION["items"], $ultimo_id, $tipo, $idUltimoDteIngresado, $regionSession);

	} else {
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}
}
$_SESSION["items"] = array();

function grabarDetalle($input, $ultimo_id, $tipo, $idUltimoDteIngresado, $regionSession)
{
	require("inc/config.php");
	$encabezado = $_POST;
	$contador = 0;
	for ($i = 0; $i < count($input); $i++) {
		$ingresa = "INSERT INTO `inv_guia_despacho_detalle`(`detalle_id`, `detalle_guia_numero`, `detalle_inv_codigo`, `detalle_cantidad`,`detalle_responsable_anterior`,`detalle_direccion_anterior`,`detalle_zona_anterior`,`detalle_origen`,`detalle_inv_id`) VALUES (0,'" . $ultimo_id . "','" . $input[$i]["inv_codigo"] . "','1','" . $input[$i]["inv_responsable"] . "','" . $input[$i]["inv_direccion"] . "','" . $input[$i]["inv_zona"] . "',0," . $input[$i]["inv_id"] . ")";
		if (mysql_query($ingresa, $dbh)) {
			$contador++;
		}
	}

	if ($contador === count($input)) {
		if (intval($tipo) === 1) {
			actualizaResponsable($encabezado, $input, $idUltimoDteIngresado, $regionSession, $ultimo_id);
		} else {
			$_SESSION["encabezado"] = $encabezado;

			if ($_SESSION["region"] == 12 || $_SESSION["region"] == 13 || $_SESSION["region"] == 1 || $_SESSION["region"] == 3 || $_SESSION["region"] == 4 || $_SESSION["region"] == 6 || $_SESSION["region"] == 7 || $_SESSION["region"] == 15 || $_SESSION["region"] == 5 || $_SESSION["region"] == 11 || $_SESSION["region"] == 16 || $_SESSION["region"] == 10 || $_SESSION["region"] == 11) {
				echo "<script>alert('SIN MODIFICACION DE INVENTARIO');window.open('../../../../SII_JUNJI/documento.php?dte_id=" . $idUltimoDteIngresado . "&regionSession=" . $regionSession . "&origen=2');window.location.href='registro_guias.php?cod=27';</script>";
			} else {
				echo "<script>alert('SIN MODIFICACION DE INVENTARIO');window.open('imprimir2.php?guia=" . $ultimo_id . "&guia_origen=0');window.location.href='registro_guias.php?cod=27';</script>";
			}
		}

	} else {
		echo "Ha ocurrido un error. Intente más tarde.";
	}
}

function actualizaResponsable($encabezado, $items, $idUltimoDteIngresado, $regionSession, $ultimo_id)
{
	require("inc/config.php");
	$_SESSION["encabezado"] = $encabezado;
	$contador = 0;
	for ($i = 0; $i < count($items); $i++) {
		$sql = "UPDATE acti_inventario SET inv_direccion = '" . $encabezado["responsa"] . "', inv_zona = '" . $encabezado["inv_zona"] . "', inv_responsable = '" . $encabezado["inv_responsable"] . "' WHERE inv_codigo = '" . $items[$i]["inv_codigo"] . "' AND inv_region = '" . $_SESSION["region"] . "'";
		if (mysql_query($sql, $dbh)) {
			$contador++;
		}
	}
	if ($contador === count($items)) {
		if ($_SESSION["region"] == 12 || $_SESSION["region"] == 13 || $_SESSION["region"] == 1 || $_SESSION["region"] == 3 || $_SESSION["region"] == 4 || $_SESSION["region"] == 6 || $_SESSION["region"] == 7 || $_SESSION["region"] == 15 || $_SESSION["region"] == 5 || $_SESSION["region"] == 11 || $_SESSION["region"] == 16 || $_SESSION["region"] == 10 || $_SESSION["region"] == 11) {
			echo "<script>alert('LOS REGISTROS DE INVENTARIO HAN SIDO ACTUALIZADOS');window.open('../../../../SII_JUNJI/documento.php?dte_id=" . $idUltimoDteIngresado . "&regionSession=" . $regionSession . "&origen=2');window.location.href='registro_guias.php?cod=27';</script>";

		} else {

			echo "<script>alert('LOS REGISTROS DE INVENTARIO HAN SIDO ACTUALIZADOS');window.open('imprimir2.php?guia=" . $ultimo_id . "&guia_origen=0');window.location.href='registro_guias.php?cod=27';</script>";
		}
		//echo "<script>alert('LOS REGISTROS DE INVENTARIO HAN SIDO ACTUALIZADOS');window.open('imprimir_guia_despacho.php');window.location.href='registro_guias.php?cod=27';</script>";

	} else {
		echo "HA OCURRIDO UN ERROR AL ACTUALIZAR";
	}
}

function reemplazaCaracter($input)
{
	$input = str_replace("Ñ", "N", $input);
	$input = str_replace("Á", "A", $input);
	$input = str_replace("É", "E", $input);
	$input = str_replace("Í", "I", $input);
	$input = str_replace("Ó", "O", $input);
	$input = str_replace("Ú", "U", $input);
	return $input;
}

?>