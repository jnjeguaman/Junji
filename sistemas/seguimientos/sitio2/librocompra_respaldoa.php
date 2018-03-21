<?php 
extract($_GET);
require_once("inc/config.php");
// GENERA RESPALDO DEL LIBRO DE COMPRAS EN FORMATO PDF

$sql="select * from dpp_etapas where eta_estado<10 and eta_tipo_doc='Factura'  and (eta_tipo_doc3<>'R' and eta_tipo_doc3<>'B'  and eta_tipo_doc3<>'BH' and eta_tipo_doc3<>'BHS') and eta_region=$region and month(eta_fdevengo)='$mes' and year(eta_fdevengo)='$ano' and 1=1 and eta_estado<10 and eta_item<>21 order by eta_fdevengo ASC";
$res = mysql_query($sql);
?>

<table border="0" width="100%" align="center">

<tr>
	<td colspan="15" style="font-size: 0.6em">Libro de Compras</td>
</tr>

<tr>
	<td style="font-size: 0.6em">Mes</td>
	<td style="font-size: 0.6em"><?php echo $mes ?></td>
</tr>

<tr>
	<td style="font-size: 0.6em">A&ntilde;o</td>
	<td style="font-size: 0.6em"><?php echo $ano ?></td>
</tr>

<tr>
	<td style="font-size: 0.6em">Region</td>
	<td style="font-size: 0.6em"><?php echo $region ?></td>
</tr>
</table>
<br>
<hr>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">

	<tr>
		<td style="font-size: 0.5em">TIPO</td>
		<td style="font-size: 0.5em">FOLIO</td>
		<td style="font-size: 0.5em">REGION</td>
		<td style="font-size: 0.5em">NUMERO</td>
		<td style="font-size: 0.5em">FECHA DEL DOCUMENTO</td>
		<td style="font-size: 0.5em">RUT</td>
		<td style="font-size: 0.5em">DV</td>
		<td style="font-size: 0.5em">NOMBRE</td>
		<td style="font-size: 0.5em">EXENTO</td>
		<td style="font-size: 0.5em">NETO</td>
		<td style="font-size: 0.5em">IVA</td>
		<td style="font-size: 0.5em">COMBUSTIBLE</td>
		<td style="font-size: 0.5em">OTROS IMPTOS</td>
		<td style="font-size: 0.5em">TOTAL</td>
		<td style="font-size: 0.5em">N&deg; EGRESO</td>
	</tr>

	<?php 

	while($row = mysql_fetch_array($res)) { 

		$vartipodoc1=$row["eta_tipo_doc"];
 if ($vartipodoc1=='Factura') {
     $vartipodoc2=$row["eta_tipo_doc2"];
     if($vartipodoc2=="FEL")
     	$vartipodoc="Factura Electronica";
     if($vartipodoc2=="FELEX")
     	$vartipodoc="Factura Exenta Electronica";
   if ($vartipodoc2=="f")
     $vartipodoc="Factura";
   if ($vartipodoc2=="b")
     $vartipodoc="Boleta Servicio";
   if ($vartipodoc2=="r")
     $vartipodoc="Recibo";
   if ($vartipodoc2=="n")
     $vartipodoc="N.Credito";
   if ($vartipodoc2=="bh" or $vartipodoc2=="BH" )
     $vartipodoc="Honorario";
 }
 if ($vartipodoc1=='Honorario') {
     $vartipodoc="Honorario";
 }

	?>
	<tr>
		<td style="font-size: 0.5em"><?php echo $vartipodoc ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_folio"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_region"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_numero"] ?></td>
		<td style="font-size: 0.5em"><?php echo date("d-m-Y",strtotime($row["eta_fecha_fac"])) ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_rut"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_dig"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_cli_nombre"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_exento"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_neto"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_iva"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_impuesto1"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_impuesto2"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_monto2"] ?></td>
		<td style="font-size: 0.5em"><?php echo $row["eta_negreso"] ?></td>
	</tr>
	<?php } ?>

</table>