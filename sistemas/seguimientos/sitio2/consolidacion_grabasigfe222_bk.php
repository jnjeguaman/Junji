<?php
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
$user=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");

$numero=$_POST["numero"];
$fechamia=date("Y-m-d");


require("inc/config.php");

/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');

/** Clases necesarias */
require_once('Classes/PHPExcel.php');
require_once('Classes/PHPExcel/Reader/Excel5.php');

//require_once('PHPExcel.php');
//require_once('PHPExcel/Reader/Excel2007.php');

// Variables de la página
$archivo1 = $_FILES["archivo1"]['name'];

$trozos2=explode(".", $archivo1);
$anno=$trozos2[0];
$extension=$trozos2[1];

//echo $archivo1."-----".$extension."<br>";

if ($archivo1 != "" or 1==1) {
	$archivo1="sigfe_".$regionsession.".".$extension;

        // guardamos el archivo a la carpeta files
	$destino =  "../../archivos/docconciliacion/".$archivo1;
 //       echo $destino;
	if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
		$status = "Archivo subido: <b>".$archivo1."</b>";
//            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";
//            echo $sql2;
//            mysql_query($sql2);
	}

// Petición de cálculo?

	// Cargando la hoja de cálculo
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load($destino);
	$objPHPExcel->setActiveSheetIndex(0);
	$highestRow =  $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	for ($i = 1; $i <= $highestRow; $i++) {
		$_DATOS_EXCEL[$i]['a1'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a2'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a3'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a4'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a5'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a6'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a7'] = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a8'] = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a9'] = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a10'] = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a11'] = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a12'] = $objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue();
		$_DATOS_EXCEL[$i]['a13'] = $objPHPExcel->getActiveSheet()->getCell('M' . $i)->getCalculatedValue();

		$_DATOS_EXCEL[$i]['a10'] = str_replace(",","",$_DATOS_EXCEL[$i]['a10']);
		$_DATOS_EXCEL[$i]['a11'] = str_replace(".","",$_DATOS_EXCEL[$i]['a11']);
		$_DATOS_EXCEL[$i]['a12'] = str_replace(".","",$_DATOS_EXCEL[$i]['a12']);
		$_DATOS_EXCEL[$i]['a13'] = str_replace(".","",$_DATOS_EXCEL[$i]['a13']);

      // $a61= substr($_DATOS_EXCEL[$i]['a6'],0,2);
      // $a62= substr($_DATOS_EXCEL[$i]['a6'],3,2);
      // $a63= substr($_DATOS_EXCEL[$i]['a6'],6,4);

		$a61= substr($_DATOS_EXCEL[$i]['a6'],6,2);
		$a62= substr($_DATOS_EXCEL[$i]['a6'],4,2);
		$a63= substr($_DATOS_EXCEL[$i]['a6'],0,4);
		$a6= $a63."".$a62."".$a61;

		if (strstr($_DATOS_EXCEL[$i]['a11'], ')')) {
			$_DATOS_EXCEL[$i]['a11'] = str_replace(")","",$_DATOS_EXCEL[$i]['a11']);
			$_DATOS_EXCEL[$i]['a11'] = str_replace("(","",$_DATOS_EXCEL[$i]['a11']);
			$_DATOS_EXCEL[$i]['a11']=$_DATOS_EXCEL[$i]['a11']*-1;
		}
		if (strstr($_DATOS_EXCEL[$i]['a12'], ')')) {

			$_DATOS_EXCEL[$i]['a12'] = str_replace(")","",$_DATOS_EXCEL[$i]['a12']);
			$_DATOS_EXCEL[$i]['a12'] = str_replace("(","",$_DATOS_EXCEL[$i]['a12']);
			$_DATOS_EXCEL[$i]['a12'] = $_DATOS_EXCEL[$i]['a12']*-1;
//        echo "entra 2 ===".$_DATOS_EXCEL[$i]['a12']." <br>";
		}

		list($b1, $b2, $b3, $b4, $b5, $b6, $b7, $b8, $b9, $b10, $b11, $b12, $b13, $b14, $b15, $b16, $b17, $b18, $b19, $b20) = split(' ', $_DATOS_EXCEL[$i]['a13']);
		$_DATOS_EXCEL[$i]['a13']=$b2." ".$b3." ".$b4." ".$b5." ".$b6." ".$b7." ".$b8." ".$b9." ".$b10." ".$b11." ".$b12." ".$b13." ".$b14." ".$b15." ".$b16." ".$b17." ".$b18." ".$b19." ".$b20;
		$rut=$b1;

		if($_DATOS_EXCEL[$i]["a5"] == "ABONO")
		{
			$sql="insert into concilia_sigfetmp (blanco1,blanco2,blanco6,blanco9,blanco10,blanco12, user, blanco5,blanco3,blanco4)
		values ('".$a63."','".$_DATOS_EXCEL[$i]["a2"]."','".$_DATOS_EXCEL[$i]["a6"]."','".$_DATOS_EXCEL[$i]['a9']."','".$_DATOS_EXCEL[$i]['a12']."','".$rut."','$user', '".$_DATOS_EXCEL[$i]["a5"]."','".$_DATOS_EXCEL[$i]["a3"]."','".$_DATOS_EXCEL[$i]["a4"]."') ";
		}else if($_DATOS_EXCEL[$i]["a5"] == "CARGO"){
			$sql="insert into concilia_sigfetmp (blanco1,blanco2,blanco6,blanco9,blanco10,blanco11, user, blanco5,blanco3,blanco4)
		values ('".$a63."','".$_DATOS_EXCEL[$i]["a2"]."','".$_DATOS_EXCEL[$i]["a6"]."','".$_DATOS_EXCEL[$i]['a9']."','".$_DATOS_EXCEL[$i]['a12']."','".$rut."','$user', '".$_DATOS_EXCEL[$i]["a5"]."','".$_DATOS_EXCEL[$i]["a3"]."','".$_DATOS_EXCEL[$i]["a4"]."') ";
		}	

               // echo $sql."<br>";
		mysql_query($sql);
	}
// exit();
	$sql2 = "Select * from concilia_parametros";
	$res2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($res2);
	$mesp=$row2["para_mes"];
	$annop=$row2["para_anno"];

	$sql2 = "Select max(sigfe_fecha) as sigfe_fecha from concilia_sigfe where sigfe_numero='$numero'";
	$res2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($res2);
	$sigfefecha=$row2["sigfe_fecha"];


	$sql="INSERT INTO concilia_sigfe (sigfe_anno,sigfe_area,sigfe_cbancaria,sigfe_ccontable,sigfe_tipo,sigfe_fecha,sigfe_sigfe,sigfe_estado2,sigfe_tesoreria,sigfe_numdoc,sigfe_rut,sigfe_bene,sigfe_abono, sigfe_cargo,sigfe_fechasis,sigfe_user,sigfe_numero,sigfe_mesp, sigfe_annop, sigfe_region)
	select blanco1   ,   blanco2,        blanco3,        blanco4,   blanco5,    blanco6,    blanco7,      blanco8,        blanco9,     blanco9,  blanco5,  blanco10,   blanco12,    blanco11,   '$fechamia','$user',   '$numero',   '$mesp',    '$annop','$regionsession' from concilia_sigfetmp
	where blanco6>'$sigfefecha' and blanco1<>''";

//       echo $sql."<br><br>";
 //        exit();
	mysql_query($sql);

	$sql="delete from concilia_sigfetmp where user='$user'";
//      echo $sql."<br><br>";
	mysql_query($sql);

 // exit();
	echo "<script>location.href='consolidacion_subida22.php?llave=1';</script>";

}
?>
