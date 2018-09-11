<?php
session_start();
require_once("inc/config.php");
extract($_POST);
$fechamia = date("Y-m-d");
$horamia = date("H:i:s");
$usuario = $_SESSION["nom_user"];
$region = $_SESSION["region"];

if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

require_once('librerias/Classes/PHPExcel.php');
require_once('librerias/Classes/PHPExcel/Reader/Excel5.php');

$sql = "SELECT MAX(sp_folio) as Folio FROM bode_solicitud WHERE sp_region = ".$region;
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$folio = $row["Folio"] + 1;

$identificador = date("YmdHis");
if($destino == "matriz")
{
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load($_FILES["Excel"]["tmp_name"]);

	$totalJardines = PHPExcel_Cell::columnIndexFromString($objPHPExcel->setActiveSheetIndex(1)->getHighestColumn());

	// GUARDAMOS EL LISTADO EN EL ARREGLO
	for($x=0;$x<$totalJardines;$x++)
	{
		$_DATOS_EXCEL[$x]["a2"] = $objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($x)."1")->getCalculatedValue();
	}

	$totalProductos = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

	// GUARDAMOS EL DETALLE DEL PEDIDO EN UN ARREGLO
	for ($i=1; $i <= $totalProductos ; $i++) { 
		$_DATOS_EXCEL[$i]['a3'] =  $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
	}

	$distribucionFilas =  $objPHPExcel->setActiveSheetIndex(1)->getHighestRow();
	$distribucionColumnas = PHPExcel_Cell::columnIndexFromString($objPHPExcel->setActiveSheetIndex(1)->getHighestColumn());

	// echo $distribucionFilas.":".$distribucionColumnas;



	for($x=0;$x<$totalJardines;$x++)
	{
		// echo "Jardin:".$_DATOS_EXCEL[$x]["a2"]."<br>";

		// SE OBTIENE EL ULTIMO FOLIO INGRESADO
		

		$sql2 = "INSERT INTO bode_solicitud (sp_id,sp_folio,sp_usuario,sp_region,sp_fecha,sp_hora,sp_estado,sp_destino,sp_tipo_destino,sp_region_destino,sp_matriz,sp_unidad_requirente,sp_tipo_bien,sp_aprobacion) VALUES(NULL,'','$usuario','$region','$fechamia','$horamia',0,'".$_DATOS_EXCEL[$x]["a2"]."','3','$region','".$identificador."','Jardin Infantil',2,1)";
		mysql_query($sql2);
		// OBTENEMOS EL ULTIMO ID INGRESADO AL SISTEMA
		$rs=mysql_query("select @@identity as id");
		if ($row=mysql_fetch_row($rs)) {
			$ultimo = trim($row[0]);
		}

		for($i=2;$i<=$totalProductos;$i++)
		{
			$sql = "INSERT INTO bode_detoc3 (doc_especificacion,	doc_cantidad,	doc_origen_id,doc_sp_id) 
			VALUES ('".$_DATOS_EXCEL[$i]["a3"]."','".$objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex(($x)).$i)->getCalculatedValue()."','0','$ultimo')";
			mysql_query($sql);
			// echo $_DATOS_EXCEL[$i]["a3"]." <> ".$objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex(($x)).$i)->getCalculatedValue()."<br>";
		}
	}

	// for($i=2;$i<=$distribucionFilas;$i++) //4
	// {
	// 	// CREAMOS LA SOLICITUD AL JARDIN
	// 	ECHO $_DATOS_EXCEL[$i]["a2"]."<br>";
	// 	for($x=0;$x<$distribucionColumnas;$x++) // 2
	// 	{
	// 		 $_DATOS_EXCEL[$i]["a2"].":".$_DATOS_EXCEL[$x]["a2"].":".$objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($x).$i)->getCalculatedValue()."<br>";
	// 	}
	// }

	// echo "<script>alert('Solicitud de pedido generada con exito');window.location.href='bode_inv_indexoc7.php?cod=50';</script>";
	echo "<script>window.location.href='bode_inv_indexoc7.php?cod=50';</script>";
	exit;

}

if($region == 16)
{
	$reg_destino = $region_destino;
}else{
	$reg_destino = $region;
}

if($tipo_guia == 3)
{
	$UnidadRequirente = "Jardin Infantil";
}else{
	$UnidadRequirente = $unidadRequirente;
}

if($tipoBienes == 1)
{
	// SI ES INVENTARIABLE, FALTA LA APROBACION DE INVENTARIO
	$aprobacion = 0;
}else{
	// SI ES EXISTENCIA NO HACE FALTA LA APROBACION DE INVENTARIO
	$aprobacion = 1;
}

$sql2 = "INSERT INTO bode_solicitud (sp_id,sp_folio,sp_usuario,sp_region,sp_fecha,sp_hora,sp_estado,sp_destino,sp_tipo_destino,sp_region_destino,sp_matriz,sp_unidad_requirente,sp_tipo_bien,sp_aprobacion) VALUES(NULL,0,'$usuario','$region','$fechamia','$horamia',0,'$destino','$tipo_guia','$sp_region_destino',NULL,'".$UnidadRequirente."','".$tipoBienes."',".$aprobacion.")";
if(mysql_query($sql2))
{
	$rs=mysql_query("select @@identity as id");
	if ($row=mysql_fetch_row($rs)) {
		$ultimo = trim($row[0]);
	}
	// echo "<script>alert('Solicitud de pedido generada con exito');window.location.href='bode_inv_indexoc7.php?ori=2&id=".$ultimo."';</script>";
	echo "<script>window.location.href='bode_inv_indexoc7.php?ori=2&id=".$ultimo."';</script>";
}else{
	echo "<script>alert('Hubo un error al procesar la solicitu. Intente más tarde');window.location.href='bode_inv_indexoc7.php?cod=50';</script>";
}
?>