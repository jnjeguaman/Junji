<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nombrecom"];
extract($_GET);
extract($_POST);


// LEEMOS EL ARCHIVO DE LOS JARDINES
if(isset($_FILES["jardincsv"]) && $_FILES["jardincsv"]["error"] == 0)
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
			$datos = fgetcsv($gestor,100,';');
			while (($datos = fgetcsv($gestor,1000,',')) !== FALSE) {
			$numero = count($datos); //NUMERO DE COLUMNAS DEL CSV
			$file++;

		for ($i=0; $i < $numero - 2; $i++) { 
			$explode = explode(';', $datos[$i]);
			$sql = "INSERT INTO bode_orcom2 (oc_region, oc_region2,oc_mas_id,oc_estado,oc_tipo_guia,oc_tipo) VALUES 
			(".$explode[0].",".$_SESSION["region"].",".$masid.",".$estado.",3,1)";
			mysql_query($sql);
		}
	}
	fclose($gestor);
}

}
// echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";
}

// LEEMOS EL ARCHIVO DE LOS PRODUCTOS
if(isset($_FILES["productoscsv"]) && $_FILES["productoscsv"]["error"] == 0)
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
			$datos = fgetcsv($gestor,100,';');
			while (($datos = fgetcsv($gestor,1000,',')) !== FALSE) {
			$numero = count($datos); //NUMERO DE COLUMNAS DEL CSV
			$file++;

		for ($i=0; $i < $numero; $i++) { 
			$explode = explode(';', $datos[$i]);
			$sql = "INSERT INTO bode_detoc2 (doc_prod_id, doc_especificacion,doc_cantidad,doc_conversion,doc_mas_id) VALUES 
			(".$explode[0].",'".$explode["1"]."',".$explode[2].",".$explode[3].",".$masid.")";
			mysql_query($sql);
		}
	}
	fclose($gestor);
}

}
echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";
}

// LEEMOS EL ARCHIVO DE LOS PRODUCTOS
if(isset($_FILES["distribucioncsv"]) && $_FILES["distribucioncsv"]["error"] == 0)
{
	// CANTIDAD DE CARDIJES
	$tj = "SELECT COUNT(oc_id) FROM bode_orcom2 WHERE oc_mas_id = ".$masid;
	echo $tj;
	exit();
	// EXTRAEMOS LA EXTENSION DEL ARCHIVO SUBIDO
	$extencion = pathinfo($_FILES["distribucioncsv"]["name"],PATHINFO_EXTENSION);
	if($extencion === "csv")
	{
		$start = 1;
		$filePath = $_FILES["distribucioncsv"]["tmp_name"];
		$fila = 1;
		$estado = 100;
		if(($gestor = fopen($filePath,"r")) !== FALSE)
		{
			$datos = fgetcsv($gestor,100,';');
			while (($datos = fgetcsv($gestor,1000,',')) !== FALSE) {
			$numero = count($datos); //NUMERO DE COLUMNAS DEL CSV
			$file++;

		for ($i=0; $i < $numero; $i++) { 
			$explode = explode(';', $datos[$i]);
			
		}
	}
	fclose($gestor);
}

}
exit();
echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";
}

/**********************************/
/*
// Verificamos si existen registros en acti_compra_temportal
$sqlTemportal = "SELECT count(*) as total FROM acti_compra_temporal";
$sqlTemportalResp = mysql_query($sqlTemportal);
$respTemporal = mysql_fetch_array($sqlTemportalResp);
$respTemporal = intval($respTemporal["total"]);

// Verificamos si existen registros en acti_compra_temportal

if ($respTemporal >= 1) {

	$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra_temporal";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$compra_id = intval($row["compra_id"] + 1);


} else {
	$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$compra_id = intval($row["compra_id"] + 1);

}
*/

//$compra_bruto_unitario = round($total / $cantidad);
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

/*
$sqlLast = "SELECT max(oc_id) as maximo FROM bode_orcom where oc_mas_id=$masid ";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$maximo = intval($row["maximo"]);

$sql = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_unit,doc_moneda,doc_valor_moneda,doc_conversion, doc_mas_id)
		                select   '$maximo',       '0',     doc_especificacion,      '0',  doc_valor_unit, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_unit,doc_moneda,doc_valor_moneda,doc_conversion, doc_mas_id from bode_detoc where doc_mas_id=$masid group by doc_especificacion ;";

//       echo $sql."<br>";
//		exit();
		mysql_query($sql);


*/
/*
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
  // $var22=$var2[$cont2];
   if ($var1<>"" ) {
       $folios.=$var1.",";
       $sql = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_recibidos, doc_region)
                               VALUES ( '$ultimo', '0',               '$var1',    '$var33',       '$var22',         '0',        '$var44');";

//        echo $sql."<br>";

        mysql_query($sql,$dbh);


   }
   $j++;
}

*/

//exit();

echo "<script>location.href='bode_inv_indexguia3.php?ori=3&ok=1&masid=$masid';</script>";
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
?>

























