<?php  
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nombrecom"];
extract($_GET);
extract($_POST);


require_once('librerias/Classes/PHPExcel.php');
require_once('librerias/Classes/PHPExcel/Reader/Excel5.php');

if(isset($_FILES["excel"]) && $_FILES["excel"]["error"] == 0)
{
	$region = $_SESSION["region"];
	$estado = 100;
	
	// Cargando la hoja de cálculo
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load($_FILES["excel"]["tmp_name"]);
	// echo "Uso de Memoria: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB<br><br>";

	// CARGA DE LOS JARDINES
	$jardinesColumnas = PHPExcel_Cell::columnIndexFromString($objPHPExcel->setActiveSheetIndex(1)->getHighestColumn());

		for($x=0;$x<$jardinesColumnas;$x++)
		{
			$_DATOS_EXCEL[$x]["a2"] = $objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($x)."1")->getCalculatedValue();
		}

		for($i=0;$i<$jardinesColumnas;$i++)
		{
			$cargaJardines = "INSERT INTO bode_orcom2 (oc_region, oc_region2,oc_mas_id,oc_estado,oc_tipo_guia,oc_tipo,oc_swdespacho) VALUES ('".$_DATOS_EXCEL[$i]["a2"]."',".$region.",".$masid.",".$estado.",3,1,1)";
			mysql_query($cargaJardines,$dbh);		
		}
	// FIN CARGA JARDINES

	// CARGA DE LOS PRODUCTOS
	$productosFilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	for ($i=2; $i <= $productosFilas ; $i++) { 
		$_DATOS_EXCEL[$i]['a2'] =  $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a3'] =  $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a4'] =  $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
	}

	for($i=2;$i<=$productosFilas;$i++)
	{
		$cargaProductos = "INSERT INTO bode_detoc2 (doc_prod_id, doc_especificacion,doc_conversion,doc_mas_id) VALUES (".$_DATOS_EXCEL[$i]["a2"].",'".$_DATOS_EXCEL[$i]["a3"]."',".$_DATOS_EXCEL[$i]["a4"].",".$masid.")";
		mysql_query($cargaProductos,$dbh);
		// echo $cargaProductos."<br>";
	}
	// FIN CARGA DE LOS PRODUCTOS

	// CARGA DE LA DISTRIBUCION
	$distribucionFilas =  $objPHPExcel->setActiveSheetIndex(1)->getHighestRow();
	$distribucionColumnas = PHPExcel_Cell::columnIndexFromString($objPHPExcel->setActiveSheetIndex(1)->getHighestColumn());

	for($i=2;$i<=$distribucionFilas;$i++)
	{
		for($x=0;$x<$distribucionColumnas;$x++)
		{
			$_SESSION["masiva"][($i-1)][($x+1)] = $objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($x).$i)->getCalculatedValue();
		}
	}
	
	echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";

// LEEMOS EL ARCHIVO DE LOS JARDINES
}elseif(isset($_FILES["jardincsv"]) && $_FILES["jardincsv"]["error"] == 0)
{
	// EXTRAEMOS LA EXTENSION DEL ARCHIVO SUBIDO
	$extencion = pathinfo($_FILES["jardincsv"]["name"],PATHINFO_EXTENSION);
	if($extencion === "csv")
	{
		$start = 1;
		$filePath = $_FILES["jardincsv"]["tmp_name"];
		$fila = 1;
		$estado = 100;
		if(($gestor = fopen($filePath,"r")) !== FALSE)
		{
			$datos = fgetcsv($gestor,10000,';');
			while (($datos = fgetcsv($gestor,10000,',')) !== FALSE) {
			$numero = count($datos); //NUMERO DE COLUMNAS DEL CSV
			$file++;

			for ($i=0; $i < $numero; $i++) { 
				$explode = explode(';', $datos[$i]);
				$sql = "INSERT INTO bode_orcom2 (oc_region, oc_region2,oc_mas_id,oc_estado,oc_tipo_guia,oc_tipo,oc_swdespacho) VALUES 
				(".$explode[0].",".$_SESSION["region"].",".$masid.",".$estado.",3,1,1)";
				mysql_query($sql);
			}
		}
		fclose($gestor);
	}

}
echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";
}else if(isset($_FILES["productoscsv"]) && $_FILES["productoscsv"]["error"] == 0)
{
	// EXTRAEMOS LA EXTENSION DEL ARCHIVO SUBIDO
	$extencion = pathinfo($_FILES["productoscsv"]["name"],PATHINFO_EXTENSION);
	if($extencion === "csv")
	{
		$start = 1;
		$filePath = $_FILES["productoscsv"]["tmp_name"];
		$fila = 1;
		$estado = 100;
		if(($gestor = fopen($filePath,"r")) !== FALSE)
		{
			$datos = fgetcsv($gestor,10000,';');
			while (($datos = fgetcsv($gestor,10000,',')) !== FALSE) {
			$numero = count($datos); //NUMERO DE COLUMNAS DEL CSV
			$file++;

			for ($i=0; $i < $numero; $i++) { 
				$explode = explode(';', $datos[$i]);
				$sql = "INSERT INTO bode_detoc2 (doc_prod_id, doc_especificacion,doc_conversion,doc_mas_id) VALUES 
				(".$explode[0].",'".$explode[1]."',".$explode[2].",".$masid.")";
				mysql_query($sql);
			}
		}
		fclose($gestor);
	}

}
echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";
}else if(isset($_FILES["distribucioncsv"]) && $_FILES["distribucioncsv"]["error"] == 0)
{
	// CANTIDAD DE JARDINES
	$tj = "SELECT COUNT(oc_id) FROM bode_orcom2 WHERE oc_mas_id = ".$masid;
	$tj = mysql_query($tj);
	$tj = mysql_fetch_array($tj);
	$tj = $tj[0];

	$tp = "SELECT COUNT(doc_id) FROM bode_detoc2 WHERE doc_mas_id = ".$masid;
	$tp = mysql_query($tp);
	$tp = mysql_fetch_array($tp);
	$tp = $tp[0];

	// EXTRAEMOS LA EXTENSION DEL ARCHIVO SUBIDO
	$extencion = pathinfo($_FILES["distribucioncsv"]["name"],PATHINFO_EXTENSION);
	$explode=array();
	if($extencion === "csv")
	{
		$start = 1;
		$filePath = $_FILES["distribucioncsv"]["tmp_name"];
		$fila = 1;
		$estado = 100;
		if(($gestor = fopen($filePath,"r")) !== FALSE)
		{
			$datos = fgetcsv($gestor,10000,';');
			while (($datos = fgetcsv($gestor,10000,',')) !== FALSE) {
			$numero = count($datos); //NUMERO DE COLUMNAS DEL CSV
			$file++;

			for ($i=0; $i < $numero; $i++) { 
				$explode[] = explode(';', $datos[$i]);
			}
		}

		//RECORRER LOS PRODUCTOS
		for ($i=0; $i < $tp; $i++) { 
			//RECORRER LOS JARDINES
			for ($k=0; $k < $tj; $k++) { 
				$_SESSION["masiva"][($i+1)][($k+1)] = $explode[$i][$k];
			}
		}
		fclose($gestor);
	}
}
echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";
}else{
	$fecha2= substr($fecha_orden_compra,6,4)."-".substr($fecha_orden_compra,3,2)."-".substr($fecha_orden_compra,0,2);

	$sqlLast = "SELECT max(oc_folioguia) as maximo FROM bode_orcom";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$maximo = intval($row["maximo"] + 1);

	$oc=$maximo;

	$existe = "SELECT count(oc_id) as Total FROM bode_orcom2 WHERE oc_region = ".$bodega." AND oc_mas_id = ".$masid;
	$existe = mysql_query($existe);
	$existe = mysql_fetch_array($existe);
	$existe = intval($existe["Total"]);
	if($existe == 0)
	{


		$sql = "INSERT INTO bode_orcom2 (oc_id2, oc_region,  oc_region2, oc_nombre_oc, oc_prog,        oc_fecha,    oc_fecha_recep,     oc_usu, oc_pro_id, oc_observaciones, oc_proveerut,   oc_proveedig, oc_proveenomb, oc_cantidad, oc_monto, oc_swdespacho, oc_folioguia,oc_tipo_guia,oc_tipo, oc_estado, oc_mas_id )
		VALUES ( '$oc', '$bodega', '$regionsession', '0',    '0',              '$fecha2', '$fechamia', '$usuario', '0',        '',           '0', '0',  '0'   ,'0',  '0', '1', '$maximo',$tipo_guia,1,100,'$masid');";

		mysql_query($sql);
	}

	echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";
}

?>