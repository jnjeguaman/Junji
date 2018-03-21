<?php
extract($_POST);
$ruta_wms = "../../archivos/respaldos/INEDIS/WMS/".date("Y")."/".date("m");
mkdir($ruta_wms,0777,true);
$archivo =$ruta_wms."/INEDIS_WMS_OC_".strtoupper($oc).".csv";
$archivo2 = "INEDIS_WMS_OC_".strtoupper($oc).".csv";
$fp = fopen($archivo, "w");
$fp2 = fopen($archivo2, "w");
$id_chilecompra = array();
fputcsv($fp, array("ITEM","PRODUCTO","NOMBRE","CANTIDAD","ORDEN DE COMPRA","FECHA COMPRA","PROVEEDOR","NOMBRE PROVEEDOR"));
for($a=0;$a<$totallinea;$a++)
{
	$pizza = explode(" ", $var[$a]);

	$largo = strlen($pizza[0]);

	$inicio = $pizza[0][0];
	$final  = $pizza[0][$largo - 1];
	$reemplazo = array("(",")","ID: ","ID:");
	$reemplazo2 = array("CM","SE","-");

	if($inicio == "(" && $final == ")")
	{
		$temporal = str_replace($reemplazo,"",$pizza[0]);
		$temporal = trim($temporal);

	}else{
		$temporal = trim(str_replace($reemplazo2, "", strtoupper($oc)));
		$temporal = $temporal.($a+1);
	}
	$id_chilecompra[$a] = strtoupper($temporal);
	fputcsv($fp,array(($a+1),strtoupper($temporal),utf8_encode($var[$a]),$var3[$a],$oc,date("d/m/Y",strtotime($fecha1)),$rut."-".$dig,$nombre));
	fputcsv($fp2,array(($a+1),strtoupper($temporal),utf8_encode($var[$a]),$var3[$a],$oc,date("d/m/Y",strtotime($fecha1)),$rut."-".$dig,$nombre));
}
fclose($fp);
fclose($fp2);

// ESTABLECER CONEXION FTP
$configuracion = [
"url" =>  "ftp.degesis.cl",
"usuario" => "junji",
"pwd" => "23.junWms"
];

$ftp = ftp_connect($configuracion["url"]);
$ftp_id = ftp_login($ftp, $configuracion["usuario"], $configuracion["pwd"]);

// VERIFICAMOS QUE TENGAMOS CONEXION AL SERVIDOR FTP
	if($ftp_id)
	{
		ftp_pasv($ftp,true);
		$directorios = ftp_nlist($ftp, "inedis");
		print_r($directorios);

		$destino = $directorios[1]."/".$archivo2;
		// CARGAMOS EL ARCHIVO EN EL SERVIDOR FTP EN EL DIRECTORIO INEDIS/NUEVOS
		if(ftp_put($ftp, $destino, $archivo, FTP_BINARY))
		{
			unlink($archivo2);
			// echo "Archivo '".$archivo."' cargado correctamente";
		}

	}
?>
