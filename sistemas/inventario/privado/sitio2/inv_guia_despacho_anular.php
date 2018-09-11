<?php
session_start();
if(isset($_REQUEST["cmd"]))
{
	$cmd = htmlspecialchars($_REQUEST["cmd"]);
	$cmd = htmlentities($cmd);

	switch ($cmd) {
		case 'anularGuia':
		echo json_encode(anularGuia($_POST));
		break;
	}
}

function anularGDElectronica($input)
{
	$dbsii = mysql_connect ("localhost", "usii", "ubnaeCFXqd4735PE") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db("junji_sii",$dbsii);

	$sql = "UPDATE sii_dte SET dte_gd_tipo_anulacion = 2 WHERE dte_id = ".$input;
	mysql_query($sql,$dbsii);
}

function anularGuia($input)
{

if($input["guia_dte_id"] <> "")
{
	anularGDElectronica($input["guia_dte_id"]);
}
	/* VERIFICAMOS EL ORIGEN DE LOS DATOS

		0 : GUIA DE DESPACHO NORMAL
		1 : GUIA DE DESPACHO DE TRASLADO

	*/

		$origen = intval($input["origen"]);
		$respuesta = false;

		//SI ES GUIA DE DESPACHO NORMAL
		if($origen === 0)
		{
			$info = getProductosResponsable($input["guia_numero"]);

			$actualizar = actualizarInventario($info);

			if($actualizar)
			{
				$respuesta =  anular($input);
			}else{
				$respuesta = false;
			}

		//SI ES GUIA DE DESPACHO DE TRASLADO
		}else{
			// BUSCAMOS LA INFORMACION ORIGINAL
			$infoOriginal = getInfoOriginal($input);

			//INSERTAMOS LA INFORMACION infoOriginal
			anular($input);
			return insertarInformacion($infoOriginal);
		}

		return $respuesta;
	}

	function insertarInformacion($input)
	{
		require("inc/config.php");
		foreach ($input as $key => $value) {
			//OBTENEMOS LA INFORMACION DEL BIEN CUANDO SE DIO DE BAJA
			$sql = "SELECT * FROM acti_inventario WHERE inv_codigo = ".$value["detalle_inv_codigo"]." AND inv_id = ".$value["detalle_inv_id"];
			$res = mysql_query($sql,$dbh);
			$row = mysql_fetch_array($res);
			//print_r($row);


			//DAMOS DE BAJA EL BIEN TRASLADADO
			$baja = "UPDATE acti_inventario SET inv_estado2 = 0 WHERE inv_region = ".$value["detalle_dest"]." AND inv_codigo = ".$value["detalle_inv_codigo"];
			mysql_query($baja,$dbh);

			//ACTUALIZAMOS EL ORIGINAL
			$alta = "UPDATE acti_inventario SET inv_programa = '".$row["inv_programa"]."',inv_bien = '".$row["inv_bien"]."',inv_costo = '".$row["inv_costo"]."',inv_region = '".$row["inv_region"]."',inv_estadocosto = '".$row["inv_estadocosto"]."',inv_obs = '".$row["inv_obs"]."',inv_altares = '".$value["detalle_res_alta"]."',inv_altafecha = '".$value["detalle_fecha_alta"]."',inv_baja = '".$value["detalle_res_baja"]."',inv_bajafecha = '".$value["detalle_fecha_baja"]."',inv_anno = '".$row["inv_anno"]."',inv_oc = '".$row["inv_oc"]."',inv_recepcionfecha = '".$row["inv_recepcionfecha"]."',inv_responsable = '".$row["inv_responsable"]."',inv_calidad = '".$row["inv_calidad"]."',inv_vutil = '".$row["inv_vutil"]."',inv_direccion = '".$row["inv_direccion"]."',inv_zona = '".$row["inv_zona"]."',inv_vutilconsumida = '".$row["inv_vutilconsumida"]."',inv_devengofecha = '".$row["inv_devengofecha"]."',inv_ccontable = '".$row["inv_ccontable"]."',inv_vfinal = '".$row["inv_vfinal"]."',inv_correcion = '".$row["inv_correcion"]."',inv_acumulada = '".$row["inv_acumulada"]."',inv_depreciaanno = '".$row["inv_depreciaanno"]."',inv_total = '".$row["inv_total"]."',inv_user = '".$row["inv_user"]."',inv_fechasys = '".$row["inv_fechasys"]."',inv_horasys = '".$row["inv_horasys"]."',inv_estado2 = 1,inv_alta_en_transito = '".$row["inv_alta_en_transito"]."',inv_comprobante_egreso = '".$row["inv_comprobante_egreso"]."',inv_num_factura = '".$row["inv_num_factura"]."',inv_fecha_factura = '".$row["inv_fecha_factura"]."',inv_nro_rece = '".$row["inv_nro_rece"]."',inv_doc_id = '".$row["inv_doc_id"]."' WHERE inv_id = ".$value["detalle_inv_id"];

			//$alta = "UPDATE acti_inventario SET inv_estado2 = 0 WHERE inv_codigo = ".$value["detalle_inv_codigo"]." AND inv_estado2 = 0";
			mysql_query($alta,$dbh);
			//mysql_query($update2);
		}
		return true;
	}

	function getInfoOriginal($input)
	{
		require("inc/config.php");
		$sql = "SELECT * FROM inv_guia_despacho_detalle WHERE detalle_guia_numero = ".$input["guia_numero"];
		$res = mysql_query($sql,$dbh);
		$arrayName = array();
		while($row = mysql_fetch_array($res))
		{
			$arrayName[] = $row;
		}
		return $arrayName;
	}

	function getProductosResponsable($input)
	{
		require("inc/config.php");
		$query = "SELECT * FROM inv_guia_despacho_detalle WHERE detalle_guia_numero = ".$input;
		$arrayName = array();
		$max = 0;
		$query = mysql_query($query,$dbh);

		while ($row = mysql_fetch_array($query)) {
			$arrayName[$max]["detalle_inv_codigo"] = $row["detalle_inv_codigo"];
			$arrayName[$max]["detalle_responsable_anterior"] = $row["detalle_responsable_anterior"];
			$arrayName[$max]["detalle_direccion_anterior"] = $row["detalle_direccion_anterior"];
			$arrayName[$max]["detalle_zona_anterior"] = $row["detalle_zona_anterior"];
			$max++;
		}

		return $arrayName;
	}


	function actualizarInventario($input)
	{
		$contador = 0;
		require("inc/config.php");
		for ($i=0; $i < count($input); $i++) { 
			$sql = "UPDATE acti_inventario SET inv_responsable = '".$input[$i]["detalle_responsable_anterior"]."', inv_direccion = '".$input[$i]["detalle_direccion_anterior"]."', inv_zona = '".$input[$i]["detalle_zona_anterior"]."' WHERE inv_codigo = ".$input[$i]["detalle_inv_codigo"];
			if(mysql_query($sql,$dbh))
			{
				$contador++;
			}
		}

		if($contador === count($input))
		{
			return true;
		}else{
			return false;
		}
	}

	function anular($input)
	{
		require("inc/config.php");
		$sql = "UPDATE inv_guia_despacho_encabezado SET guia_abastece = 'NULO',guia_destinatario = 'NULO',guia_direccion = 'NULO',guia_zona = 'NULO',guia_comuna = 'NULO',guia_responsable = 'NULO',guia_emisor = 'NULO',guia_obs = 'NULO', guia_estado = 0 WHERE guia_id = ".$input["guia_numero"];
		if(mysql_query($sql,$dbh))
		{
			$fechamia=date('Y-m-d');
			$horaSys = Date("H:i:s");
			$log = "INSERT INTO log VALUES(NULL,".$input["guia_numero"].",0,'ANULACION G/D','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','REGISTRO GUIA')";
			mysql_query($log,$dbh);

			return true;
		}else{
			echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
		}
	}
	?>