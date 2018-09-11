<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
extract($_GET);
extract($_POST);

$fecha2= substr($fecha_orden_compra,6,4)."-".substr($fecha_orden_compra,3,2)."-".substr($fecha_orden_compra,0,2);


//ARCHIVO DE DISTRIBUCIÓN
$extensionesPeritidas =  array("xlsx","xls","csv");
$archivo1 = $_FILES["distribucion"]['name'];

$mensaje = "";
		if ($archivo1 != "") {
			$extension = pathinfo($archivo1,PATHINFO_EXTENSION);

			if(in_array($extension, $extensionesPeritidas))
			{
				$archivo1 = "docdist".Date("YmdHis").".".$extension;
				$ruta1="archivos/docdist/";
				$destino =  "../../../".$ruta1.$archivo1;

				if(file_exists($destino))
				{
					$mensaje .= "El archivo ya existe en el sistema<br>";
					$respuesta = false;
				}else{
					if (copy($_FILES["distribucion"]['tmp_name'],$destino)) {
					}else{
						$errores = error_get_last();
						$mensaje .= "Ha ocurrido un error al copiar el archivo: ".$errores["message"];
						$respuesta = false;
					}
				}

			}else{
				$mensaje.="Las extensiones permitidas son: .xlsx, .xls y .csv.";
				$respuesta = false;
			}
		}

//FIN ARCHIVO DE DISTRIBUCIÓN
		if(strlen($mensaje) > 0)
		{
			echo $mensaje."<br>";
			echo "<a href='javascript:window.history.back(-1)'>Volver</a>";
		}else{
			$sql = "INSERT INTO bode_orcom (oc_id2, oc_region,   oc_nombre_oc, oc_prog,        oc_fecha,    oc_fecha_recep,     oc_usu, oc_pro_id, oc_proveerut,   oc_proveedig, oc_proveenomb, oc_cantidad, oc_monto, oc_descuento, oc_numerooc, oc_grupo, oc_estado,oc_sc,oc_envio_fecha,oc_conversion,oc_rutatc,oc_archivotc )
						VALUES ( '$oc', '$regionsession', '$nombreoc',    '$programa', '$fecha2', '$fechamia', '$usuario', '0',             '$proveedor', '$proveedor2',  '$proveedornomb'   ,'$cantidad',  '$total', '$descuento', '$oc',  '$grupo',1,'$sc','$f_oc',($total * $tipo_cambio),'$ruta1','$archivo1');";

// Agregar el Proveedor a la BD
$buscar = "SELECT COUNT(proveedor_id) as Total FROM acti_proveedor WHERE proveedor_rut = '".$proveedor."'";
$buscar = mysql_query($buscar);
$buscar = mysql_fetch_array($buscar);
$buscar = intval($buscar["Total"]);
if($buscar === 0)
{
	$nuevo = "INSERT INTO acti_proveedor(proveedor_glosa,proveedor_rut,proveedor_dv,proveedor_estado) VALUES ('".$proveedornomb."','".$proveedor."','".$proveedor2."',1)";
	$nuevo = mysql_query($nuevo);
}

mysql_query($sql,$dbh);

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".mysql_insert_id().",0,'INGRESO NUEVA O/C','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','INGRESO BODEGA')";
mysql_query($log);

//----- calculo del valor unitario

$valoru=$descuento/$cantidad;

$sql3 = "SELECT max(oc_id) as ultimo FROM bode_orcom where oc_usu='$usuario' ";
//echo $sql3."<br>";
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_array($res3);
$ultimo = $row3["ultimo"];

$j=0;
//echo "$j $totallinea";
while ($j<=$totallinea) {
	$var1=$var[$j];
	$var22=$var2[$j];
	$var33=$var3[$j];
	$var44=$var4[$j];
	$var55=$var5[$j];
  // $var22=$var2[$cont2];
//  echo $var1."<br>";
	if ($var1<>"" ) {
		$folios.=$var1.",";
		$valorunitario=$var22-($var33*$valoru);
		$sql = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_valor_unit2, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_unit,doc_moneda,doc_valor_moneda,doc_conversion,doc_umedida,doc_factor,doc_especificacion2)
		VALUES ( '$ultimo', '0',               '$var1',    '$var33',      '$valorunitario',  '$var22',         '0',        '$var44',      '', upper('$oc'),          $var55   ,'$moneda',  '$tipo_cambio', ($tipo_cambio * $var55),'$tipo_compra',1,'".$var1."');";

//        echo $sql."<br>";

		mysql_query($sql,$dbh);


	}
	$j++;
}



//exit();

echo "<script>location.href='bode_inv_indexoc2.php?cod=20&ok=1';</script>";
//echo "<script>location.href='inv_indexoc2.php?cod=16&ori=1&ok=1';</script>";
/*
if(mysql_query($sql,$dbh))
{
	echo "<script>location.href='inv_indexoc2.php?ori=1&id=".mysql_insert_id()."&ok=1';</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
*/


//-------------- Envio de mail   ----------------

//include("ssgg_enviamail.php");

//-------------- FIN Envio de mail   ----------------


//echo "<script>location.href='ssgg_index.php?exito=1';</script>";
		}


?>