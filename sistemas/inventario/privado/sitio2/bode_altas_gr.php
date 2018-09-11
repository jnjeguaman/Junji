<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}
extract($_POST);
require_once("inc/config.php");

$fechamia=date('Y-m-d');
$nom_user = $_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
$emisor = $_SESSION["nombrecom"];
// BUSCAMOS EL ULTIMO ID INGRESADO
$maximoUsuario = "SELECT MAX(oc_id) as Ultimo FROM bode_orcom";
$maximoUsuario = mysql_query($maximoUsuario,$dbh);
$maximoUsuario = mysql_fetch_array($maximoUsuario);

if($maximoUsuario["Ultimo"] === NULL)
{
	$ultimo = 1;
}else{
	$ultimo = $maximoUsuario["Ultimo"] + 1;
}

if($oc <> "")
{
	$numerooc = strtoupper($oc);
}else{
	$numerooc = "DTT-".$ultimo."-JUNJI";
}

$cantidad = 0;
for ($i=0; $i < $totalElementos; $i++) { 
	$cantidad+=$stock[$i];
}
$fecha2= substr($fecha_orden_compra,6,4)."-".substr($fecha_orden_compra,3,2)."-".substr($fecha_orden_compra,0,2);

$proveedor = trim(str_replace(".", "", $proveedor));

// INGRESAMOS EN LA TABLA bode_orcom
$bode_orcom = "INSERT INTO bode_orcom (oc_id2, oc_region,oc_nombre_oc,oc_prog,oc_fecha,oc_fecha_recep,oc_usu,oc_pro_id,oc_observaciones,oc_proveerut,oc_proveedig,oc_proveenomb,oc_cantidad,oc_monto,oc_numerooc,oc_grupo,oc_estado,oc_descuento) VALUES ('".$numerooc."',".$region.",'$nombre_oc','$programa','$fecha2','$fechamia','".$nom_user."','0','','$proveedor','$proveedor2','$proveedornomb','$cantidad','$total','".$numerooc."','".$grupo."',1,'$descuento');";

$sql3 = "SELECT MAX(ing_guianumerotc) as Tecnica, MAX(ing_guianumerorc) as Conforme FROM bode_ingreso";
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_array($res3);
$n_tecnica = $row3["Tecnica"] + 1;
$n_conforme = $row3["Conforme"] + 1;

// INGRESAMOS LA INFORMACION EN LA TABLA BODE_INGRESO
$sql2 = "INSERT INTO bode_ingreso (ing_id,ing_guia,ing_oc_id,ing_fecha,ing_region,ing_estado,ing_recib_usu_id,ing_guianumerotc,ing_guiaemisortc,ing_guiafechatc,ing_guianumerorc,ing_guiaemisorrc,ing_guiafecharc) 
						   VALUES (NULL,1,$ultimo,'".Date("Y-m-d")."',$region,3,'".$nom_user."','$n_tecnica','$emisor','$fechamia','$n_conforme','$emisor','$fechamia')";

$res2 = mysql_query($sql2);
$rs=mysql_query("select @@identity as id");
if ($row=mysql_fetch_row($rs)) {
	$ultimoIngreso = trim($row[0]);
}



// COMPROBAMOS SI EL PROVEEDOR INGRESADO EXISTE
$buscar = "SELECT COUNT(proveedor_id) as Total FROM acti_proveedor WHERE proveedor_rut = '".$proveedor."'";
$buscar = mysql_query($buscar);
$buscar = mysql_fetch_array($buscar);
$buscar = intval($buscar["Total"]);
if($buscar === 0)
{
	// SI EL PROVEEDOR NO EXISTE, LO AGREGAMOS A LA TABLA acti_proveedor
	$nuevo = "INSERT INTO acti_proveedor(proveedor_glosa,proveedor_rut,proveedor_dv,proveedor_estado) VALUES ('".$proveedornomb."','".$proveedor."','".$proveedor2."',1)";
	$nuevo = mysql_query($nuevo);
}

if(mysql_query($bode_orcom))
{

	for ($i=0; $i < $totalElementos; $i++) { 
		$bode_detoc = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_valor_unit2, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_umedida,doc_factor,doc_valor_moneda,doc_conversion,doc_moneda,doc_unit,doc_especificacion2,doc_stock)
		VALUES ('$ultimo', '0','$descripcion[$i]','$stock[$i]',".$valor[$i] * $stock[$i].",".$valor[$i] * $stock[$i].",'0',".$region.",'','".$numerooc."','$tipo_compra[$i]','$factor[$i]',$tipo_cambio,".($valor[$i] * $tipo_cambio).",'$moneda',$valor[$i],'$descripcion[$i]','$stock[$i]')";

		if(mysql_query($bode_detoc,$dbh))
		{

			$rs=mysql_query("select @@identity as id");
			if ($row=mysql_fetch_row($rs)) {
				$ultimoProdID = trim($row[0]);
			}

			$consulta="INSERT INTO bode_detingreso (ding_id, ding_ing_id, ding_prod_id, `ding_cantidad` ,`ding_region_id` ,`ding_recep_tecnica` ,`ding_cant_conf` ,`ding_cant_despacho` ,`ding_cant_final` ,`ding_cant_rechazo` ,`ding_glosa_rechazo`, `ding_ubicacion`,`ding_fentrega`,ding_umedida,	ding_factor,	ding_recep_conforme,ding_unidad,ding_clasificacion)
			VALUES                                  (NULL ,'$ultimoIngreso','$ultimoProdID','$stock[$i]',  '$region',            'A',  				'$stock[$i]',  			'0',  			'$stock[$i]',  			'0',  				'',				'PENDIENTE',	'$fecha2',	  '$tipo_compra[$i]',$factor[$i],		'C',			'$stock[$i]',0)";
			mysql_query($consulta);



			$fechamia=date('Y-m-d');
			$horaSys = Date("H:i:s");
			$log = "INSERT INTO log VALUES(NULL,".$ultimoIngreso.",0,'ALTA','".$nom_user."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTO - ALTAS')";
			mysql_query($log);
		}else{
			echo "Ha ocurrido un error";
		}

	}

	// INGRESAMOS LA INFORMACION EN LA TABLA BODE_INGRESO
	// mysql_query("INSERT INTO bode_ingreso (ing_guia,ing_oc_id,ing_fecha,ing_region,ing_estado,ing_recib_usu_id) VALUES (1,$ultimo,'".Date("Y-m-d")."',$region,1,'".$_SESSION["nom_user"]."')");
	// $rs=mysql_query("select @@identity as id");
	// if ($row=mysql_fetch_row($rs)) {
	// 	$ingreso = trim($row[0]);
	// }
	// $productos = mysql_query("SELECT * FROM bode_detoc WHERE doc_oc_id = ".$ultimo);

	// while($prod = mysql_fetch_array($productos))
	// {
	// 	$sql = mysql_query("INSERT INTO bode_detingreso (ding_ing_id,ding_prod_id,ding_cantidad,ding_region_id,ding_recep_tecnica,ding_cant_final,ding_ubicacion,ding_user,ding_fecha,ding_userf,ding_fechaf,ding_fentrega,ding_recep_conforme,ding_umedida,ding_unidad,ding_factor) VALUES ($ingreso,".$prod["doc_id"].",".$prod["doc_cantidad"].",$region,'A',".$prod["doc_cantidad"].",'SIN UBICACION','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','$fecha2','C','".$prod["doc_umedida"]."','".$prod["doc_cantidad"]."','".$prod["doc_factor"]."')");
	// 	echo $sql."<br>";
	// }
}else{
	echo "Ha ocurrido un error";
}
echo "<script>alert('Registros insertados con exito!');window.location.href='bode_inv_indexoc4.php?cmd=Altas';</script>";

?>
