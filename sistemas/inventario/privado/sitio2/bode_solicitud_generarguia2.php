<?php
session_start();
ini_set("display_errors", 0);
extract($_POST);
require_once("inc/config.php");
$regionSession = $_SESSION["region"];
$nombrecom = $_SESSION["nombrecom"];
$fechamia = date("Y-m-d");
$proveedor = "CENTRAL DE ABASTECIMIENTO";
/*
VAR 1 : si esta checkeado o no
VAR 2 : Cantidad Asociada
VAR 3 : Ubicacion original del producto (bode_detoc3) YA NO EXISTE
VAR 4 : id de la relacion
VAR 5 : ID del producto bode_detoc3
*/
// GENERAMOS LA GUIA A DESTINO

if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$totalGuiasUnicas = array();
// RECORREMOS LOS ID UNICOS
for($i = 1;$i <= count($distinctID);$i++)
{
	for($z=0;$z<$totalElementos;$z++)
	{
		if($var1[$z] <> "")
		{
			if($var6[$z] == $distinctID[$i])
			{
				// $totalGuiasUnicas[$i]++;
				$totalGuiasUnicas[$distinctID[$i]]++;
			}
		}
	}
}

// SE RECORRE LAS GUIAS UNICAS
foreach ($totalGuiasUnicas as $key => $value) {
	$sql = "INSERT INTO bode_orcom (oc_region,					oc_region2,		oc_fecha,		oc_usu,		oc_proveenomb,oc_swdespacho,oc_tipo_guia,				oc_tipo,oc_fecha_recep,oc_sp_id,oc_obs,oc_region_destino) 
							VALUES ('".$destino."','$regionSession',	 '$fechamia',	 '$nombrecom',  '$proveedor',   1,		'3', 1,'".$fechamia."','".$key."','".$solicitud_observacion."','".$region_destino."')";

	mysql_query($sql);
	$rs=mysql_query("select @@identity as id");
	if ($row=mysql_fetch_row($rs)) {
		$id_ultimo = trim($row[0]);
	}
	// RECORREMOS LOS PRODUCTOS
	for($x = 0;$x < $totalElementos; $x++)
	{
		// SE COMPRUEBA QUE EL DOC_SP_ID SEA IGUAL A DISTINCT_ID
		if($key == $var9[$x])
		{
			// VERIFICAMOS CUANTOS ELEMENTOS EXISTEN CON EL ID INDICADO
			if($var1[$x] <> "")
			{
				// $sql2 = "SELECT * FROM bode_detoc a inner join bode_detingreso b on b.ding_prod_id = a.doc_id inner join bode_orcom c on c.oc_id = a.doc_oc_id WHERE b.ding_id = ".$var3[$i];
				$sql2 = "SELECT * FROM bode_detoc3 WHERE doc_id = ".$var5[$x];
				$res2 = mysql_query($sql2);
				$row2 = mysql_fetch_array($res2);

				if(empty($row2["doc_especificacion"]))
				{
					$producto = $var7[$x];
				}else{
					$producto = $row2["doc_especificacion"];
				}

				$sql3 = "INSERT INTO bode_detoc(doc_oc_id,				doc_especificacion,			doc_cantidad,				doc_valor_unit,			doc_region,					doc_numerooc,					doc_unit,					doc_moneda,doc_valor_moneda,doc_conversion,doc_umedida,doc_factor,doc_activo,doc_gasto,doc_sp_rel_doc_id,doc_clasificacion) 
									VALUES	('$id_ultimo',	'".$producto."','$var2[$x]',			'".$row2["doc_valor_unit"]."',		'".$destino."', '".$row2["oc_id2"]."',  '".$row2["doc_unit"]."',	'".$row2["doc_moneda"]."','".$row2["doc_valor_moneda"]."','".$row2["doc_conversion"]."','".$row2["doc_umedida"]."','".$row2["doc_factor"]."','".$row2["doc_activo"]."','".$row2["doc_gasto"]."','".$var8[$x]."','".$var10[$x]."')";
				
				mysql_query($sql3);				
				$sql4 = "UPDATE bode_solicitud_rel SET sp_rel_estado = 2, sp_rel_despachado = sp_rel_cantidad,sp_rel_cantidad = 0 WHERE sp_rel_sp_id = ".$key." AND sp_rel_doc_id =".$var5[$x]." AND (sp_rel_cantidad <> '' OR sp_rel_cantidad <> NULL OR sp_rel_cantidad <> 0)";
				echo $sql4."<br>";
				mysql_query($sql4);

							// COMPROBACION
			// SELECCIONAMOS TODOS LOS PRODUCTOS DE LA SOLICITUD
			$sql10 = "SELECT * FROM bode_detoc3 where doc_sp_id = ".$key;
			$res10 = mysql_query($sql10);
			$contador = 0;
			while($row10 = mysql_fetch_array($res10))
			{
				$solicitado = intval($row10["doc_cantidad"]);
				// BUSCAMOS LO DESPACHADO
				$sql11 = "SELECT SUM(sp_rel_despachado) as Despachado FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row10["doc_id"];
				$res11 = mysql_query($sql11);
				$row11 = mysql_fetch_array($res11);
				$despachado = intval($row11["Despachado"]);
				if($solicitado == $despachado)
				{
					$contador++;
				}

			}
			if(mysql_num_rows($res10) == $contador)
			{
				mysql_query("UPDATE bode_solicitud SET sp_estado = 2 WHERE sp_id = ".$key);
			}

			}
		}
	}

}
/*
	// RECORREMOS LOS PRODUCTOS
	for($x = 0;$x < $totalElementos; $x++)
	{
		// SE COMPRUEBA QUE EL DOC_SP_ID SEA IGUAL A DISTINCT_ID
		if($distinctID[$i] == $var9[$x])
		{
			// VERIFICAMOS CUANTOS ELEMENTOS EXISTEN CON EL ID INDICADO
			if($var1[$x] <> "")
			{
				echo "Crear Guia ID : ".$distinctID[$i]."<br>";
				echo $var1[$x]." : ".$var7[$x]."<br>";
			}
		}
	}

*/
echo "<script>window.location.href='bode_inv_indexoc4.php?cmd=Solicitudes';</script>";
	exit;














	$sql = "INSERT INTO bode_orcom (oc_region,					oc_region2,		oc_fecha,		oc_usu,		oc_proveenomb,oc_swdespacho,oc_tipo_guia,				oc_tipo,oc_fecha_recep,oc_sp_id,oc_obs,oc_region_destino) 
	VALUES ('".$destino."','$regionSession',	 '$fechamia',	 '$nombrecom',  '$proveedor',   1,		'3', 1,'".$fechamia."','".$var6[1]."','".$solicitud_observacion."','".$region_destino."')";
	mysql_query($sql);
	$rs=mysql_query("select @@identity as id");
	if ($row=mysql_fetch_row($rs)) {
		$id_ultimo = trim($row[0]);
	}

	for($i=0;$i<$totalElementos;$i++)
	{
		if($var1[$i] <> "")
		{
			$sql2 = "SELECT * FROM bode_detoc a inner join bode_detingreso b on b.ding_prod_id = a.doc_id inner join bode_orcom c on c.oc_id = a.doc_oc_id WHERE b.ding_id = ".$var3[$i];
			$res2 = mysql_query($sql2);
			$row2 = mysql_fetch_array($res2);

			if(empty($row2["doc_especificacion"]))
			{
				$producto = $var7[$i];
			}else{
				$producto = $row2["doc_especificacion"];
			}

			$sql3 = "INSERT INTO bode_detoc(doc_oc_id,				doc_especificacion,			doc_cantidad,				doc_valor_unit,			doc_region,					doc_numerooc,					doc_unit,					doc_moneda,doc_valor_moneda,doc_conversion,doc_umedida,doc_factor,doc_activo,doc_gasto,doc_sp_rel_doc_id)
			VALUES	('$id_ultimo',	'".$producto."','$var2[$i]',			'".$row2["doc_valor_unit"]."',		'".$destino."', '".$row2["oc_id2"]."',  '".$row2["doc_unit"]."',	'".$row2["doc_moneda"]."','".$row2["doc_valor_moneda"]."','".$row2["doc_conversion"]."','".$row2["doc_umedida"]."','".$row2["doc_factor"]."','".$row2["doc_activo"]."','".$row2["doc_gasto"]."','".$var8[$i]."')";

			mysql_query($sql3);				
			$sql4 = "UPDATE bode_solicitud_rel SET sp_rel_estado = 2, sp_rel_despachado = sp_rel_cantidad,sp_rel_cantidad = 0 WHERE sp_rel_sp_id = ".$var6[$i]." AND sp_rel_doc_id =".$var5[$i]." AND (sp_rel_cantidad <> '' OR sp_rel_cantidad <> NULL OR sp_rel_cantidad <> 0)";
			mysql_query($sql4);

			// COMPROBACION
			// SELECCIONAMOS TODOS LOS PRODUCTOS DE LA SOLICITUD
			$sql10 = "SELECT * FROM bode_detoc3 where doc_sp_id = ".$var6[$i];
			$res10 = mysql_query($sql10);
			$contador = 0;
			while($row10 = mysql_fetch_array($res10))
			{
				$solicitado = intval($row10["doc_cantidad"]);
				// BUSCAMOS LO DESPACHADO
				$sql11 = "SELECT SUM(sp_rel_despachado) as Despachado FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row10["doc_id"];
				$res11 = mysql_query($sql11);
				$row11 = mysql_fetch_array($res11);
				$despachado = intval($row11["Despachado"]);
				if($solicitado == $despachado)
				{
					$contador++;
				}

			}
			if(mysql_num_rows($res10) == $contador)
			{
				mysql_query("UPDATE bode_solicitud SET sp_estado = 2 WHERE sp_id = ".$var6[$i]);
			}
// FIN COMPROBACION

		}
	}

/*
$sql10 = "SELECT * FROM bode_detoc3 where doc_sp_id = ".$var6[$i];
$res10 = mysql_query($sql10);
$contador = 0;
while($row10 = mysql_fetch_array($res10))
{
	$solicitado = intval($row10["doc_cantidad"]);
	// BUSCAMOS LO DESPACHADO
	$sql11 = "SELECT SUM(sp_rel_despachado) as Despachado FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row10["doc_id"];
	$res11 = mysql_query($sql11);
	$row11 = mysql_fetch_array($res11);
	$despachado = intval($row11["Despachado"]);
	if($solicitado == $despachado)
	{
		$contador++;
	}

}
if(mysql_num_rows($res10) == $contador)
{
	mysql_query("UPDATE bode_solicitud SET sp_estado = 2 WHERE sp_id = ".$var6[$i]);
}
*/
echo "<script>window.location.href='bode_inv_indexoc4.php?cmd=Solicitudes';</script>";
?>