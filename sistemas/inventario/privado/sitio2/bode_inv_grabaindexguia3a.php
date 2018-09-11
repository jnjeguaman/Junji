<?
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

//$compra_bruto_unitario = round($total / $cantidad);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

// CARGAMOS EL ARCHIVO
$extensionesPeritidas =  array("pdf","PDF","xlsx","xls");
$archivo1 = $_FILES["archivo"]['name'];

if ($archivo1 != "") {
	$extension = pathinfo($archivo1,PATHINFO_EXTENSION);

	if(in_array($extension, $extensionesPeritidas))
	{
		$sql = "INSERT INTO bode_masiva (mas_fecha, mas_nombre,  mas_sector, mas_region,    mas_user,    mas_fechasys) VALUES  ( '$fecha2', '$nombre', '$sector','$regionsession', '$usuario',    '$fechamia');";
		mysql_query($sql);

		$archivo1 = "doc_".mysql_insert_id().".".$extension;
		$ruta1="archivos/doclogistica/".date("Y")."/".$regionsession."/matriz/";
		$destino =  "../../../".$ruta1.$archivo1;

		if(file_exists($destino))
		{
			$mensaje .= "El archivo ya existe en el sistema<br>";
			$respuesta = false;
		}else{
			if (copy($_FILES["archivo"]['tmp_name'],$destino)) {
				mysql_query("UPDATE bode_masiva SET mas_ruta = '".$ruta1."', mas_archivo = '".$archivo1."' WHERE mas_id = ".mysql_insert_id());
			}else{
				$errores = error_get_last();
				$mensaje .= "Ha ocurrido un error al copiar el archivo: ".$errores["message"];
				$respuesta = false;
			}
		}
	}else{
		$mensaje.="Las extensiones permitidas son: .pdf .xlsx .xls";
		$respuesta = false;
		echo $mensaje;
		exit();
	}
}
// FIN CARGA ARCHIVO

$log = "INSERT INTO log VALUES(NULL,".mysql_insert_id().",0,'CREA PLANTILLA MATRIZ','".$_SESSION["nom_user"]."','".$fechamia."','".Date("H:i:s")."','BODEGA','MATRIZ')";
mysql_query($log);
?>
<script>location.href='bode_inv_indexguia3a.php?cod=41&ok=1';</script>