<?php 
require_once("inc/config.php");
extract($_POST);
// RESOLUCION APRUEBA BASES ADMINISTRATIVAS
if($doc_1 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_docs_id = '".$var1[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
// RESOLUCION ADJUDICA LICITACION
if($doc_2 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_doc_id2 = '".$var2[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
// RESOLUCION APRUEBA CONTRATO
if($doc_3 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_doc_id3 = '".$var3[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
// RESOLUCION TRATO DIRECTO
if($doc_4 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_doc_id4 = '".$var4[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
// FACTURA
if($doc_5 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_archivo = '".$var5[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}

// VERIFICAR LA SOLICITUD DE COMPRA (doc_6)

// IMAGENN CONSULTA CESION DE FACTURA
if($doc_7 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_ant1 = '".$var7[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}

// IMAGEN COMPROMISO CIERTO
if($doc_8 <> "")
{
	$sql = "UPDATE dpp_etapas SET eta_compromiso_archivo = '".$var8[0]."' WHERE eta_id = ".$eta_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
// RESOLUCION CESION DE FACTURA
if($doc_9 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_doc_id5 = '".$var9[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
// RESOLUCION APLICA MULTA
if($doc_10 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_doc_id6 = '".$var10[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
// ORDEN DE COMPRA
if($doc_11 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_doc1 = '".$var11[0]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
// ARCHIVO RECEPCION CONFORME
if($doc_12 <> "")
{
	$sql = "UPDATE dpp_facturas SET fac_ruta2 = '".$var12[0]."', fac_ant2 = '".$var12[1]."' WHERE fac_id = ".$fac_id_destino;
	echo $sql."<br>";
	mysql_query($sql);
}
 ?>

 <script type="text/javascript">
 window.close();
 	opener.location.href='facturasarchivos.php?id=<?php echo $fac_id_destino ?>&id1b=<?php echo $eta_id_destino ?>';
 </script>