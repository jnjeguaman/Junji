<?php
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
$numero=$_GET["numero"];
$mesp=$_GET["mesp"];
$annop=$_GET["annop"];

$region = mysql_query("SELECT nombre FROM regiones WHERE codigo = ".$regionsession);
$region = mysql_fetch_array($region);
$region = $region["nombre"];

if ($mesp==1) {
	$mesppalabra="ENERO";
}
if ($mesp==2) {
	$mesppalabra="FEBRERO";
}
if ($mesp==3) {
	$mesppalabra="MARZO";
}
if ($mesp==4) {
	$mesppalabra="ABRIL";
}
if ($mesp==5) {
	$mesppalabra="MAYO";
}
if ($mesp==6) {
	$mesppalabra="JUNIO";
}
if ($mesp==7) {
	$mesppalabra="JULIO";
}
if ($mesp==8) {
	$mesppalabra="AGOSTO";
}
if ($mesp==9) {
	$mesppalabra="SEPTIEMBRE";
}
if ($mesp==10) {
	$mesppalabra="OCTUBRE";
}
if ($mesp==11) {
	$mesppalabra="NOVIEMBRE";
}
if ($mesp==12) {
	$mesppalabra="DICIEMBRE";
}

$cuenta = mysql_query("SELECT * FROM concilia_cc WHERE cc_numero = ".$numero);
$cuenta = mysql_fetch_array($cuenta);

$titulares = mysql_query("SELECT * FROM concilia_titulares WHERE titular_estado = 1 AND titular_region = ".$regionsession);
$suplentes = mysql_query("SELECT * FROM concilia_suplentes WHERE suplente_estado = 1 AND suplente_region = ".$regionsession);
$encargados = mysql_query("SELECT * FROM concilia_encargados WHERE encargado_region = ".$regionsession);
$encargados = mysql_fetch_array($encargados);

$getOficio = mysql_query("SELECT * FROM concilia_oficio WHERE concilia_region = ".$regionsession);
$oficio = mysql_fetch_array($getOficio);

?>
<!DOCTYPE html>
<html>
<head>
	<title>REPORTE CONCILIACION BANCARIA</title>
	<meta charset="UTF-8">
</head>
<body>

	<table border="0" width="100%">
		<tr>
			<td><img src="images/junji_logo.png" height="130px" height="130px"></td>
		</tr>

		<tr>
			<td>
				<ul style="padding:0">
					<li style="list-style:none; font-size:13px;font-weight:bold;">JUNTA NACIONAL DE JARDINES INFANTILES</li>
					<li style="list-style:none; font-size:11px;">Departamento de Recursos Financieros y Físicos</li>
					<li style="list-style:none; font-size:11px;">Sección Contabilidad y Finanzas</li>
					<li style="list-style:none; font-size:11px;">Oficina de Contabilidad <?php echo $cuenta["cc_regionnombre"] ?></li>
				</ul>
			</td>
		</tr>
	</table>
	<br>
	<CENTER>
		CONCILIACIÓN BANCARIA DE LA CUENTA CORRIENTE<br>
		<u><?php echo $numero ?>  DEL BANCO DEL ESTADO DE CHILE</u><br>
		Programa <?php echo $cuenta["cc_programa"] ?><br><br>
	</CENTER>

	<br><br>
	<table border="0" width="80%" align="center">
		<tr>
			<td style="font-size:11px;">INSTITUCIÓN</td>
			<td>:</td>
			<td style="font-size:11px;">JUNTA NACIONAL DE JARDINES INFANTILES</td>
		</tr>

		<tr>
			<td style="font-size:11px;">N° CUENTA CORRIENTE</td>
			<td>:</td>
			<td style="font-size:11px;"><?php echo $numero ?></td>
		</tr>

		<tr>
			<td style="font-size:11px;">NOMBRE CUENTA CORRIENTE</td>
			<td>:</td>
			<td style="font-size:11px;"><?php echo $cuenta["cc_descripcion"] ?></td>
		</tr>

		<tr>
			<td style="font-size:11px;">OFICIO QUE AUTORIZA</td>
			<td>:</td>
			<td style="font-size:11px;"><?php echo $oficio["concilia_oficio"] ?></td>
		</tr>

		<tr>
			<td style="font-size:11px;">FIRMAS GIRADORAS TITULARES</td>
			<td>:</td>
			<td style="font-size:11px;">
				<?php while($row = mysql_fetch_array($titulares)) { ?>
				<?php echo $row["titular_nombre"] ?><br>
				<?php } ?>
			</td>
		</tr>

		<tr>
			<td style="font-size:11px;">&nbsp;</td>
			<td></td>
			<td style="font-size:11px;"></td>
		</tr>

		<tr>
			<td style="font-size:11px;">FIRMAS GIRADORAS SUPLENTES</td>
			<td>:</td>
			<td style="font-size:11px;">
			<?php while($row = mysql_fetch_array($suplentes)) { ?>
				<?php echo $row["suplente_nombre"] ?><br>
				<?php } ?>
			</td>
		</tr>

	</table>

	<br><br>
	<CENTER>
		<u>CONCILIACION BANCARIA MES DE  <? echo $mesppalabra ?>  AÑO <? echo $annop ?></u><br>
	</CENTER>

	<?
	$idreg=$regionsession;
	include("consolidacion_procesocierre.php");
	?>
	<table border="0" width="80%" align="center">
	<tr>
				<th style="font-size:11px;">&nbsp;</th>
				<th></th>
				<th style="font-size:11px;"></th>
			</tr>
		<tr>
			<td style="font-size:11px;">Saldo anterior: </td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($resumonto,0,',','.'); ?></td>
		</tr>

		<tr>
			<td style="font-size:11px;">Ingresos del mes (+)</td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($totalcargo,0,',','.'); ?></td>
		</tr>
		<tr>
			<td style="font-size:11px;">Ingresos Acumulados </td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($ingresoacumu,0,',','.'); ?></td>
		</tr>
		<tr>
			<td style="font-size:11px;">Gastos del mes (-)</td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($totalabono,0,',','.'); ?></td>
		</tr>

		<tr>
			<td style="font-size:11px;">Saldo disponible</td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($saldodisponible,0,',','.'); ?></td>
		</tr>
		<tr>
			<td style="font-size:11px;">(-) Cargos no reconocidos por el banco</td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($totalasigfecargo,0,',','.'); ?></td>
		</tr>
		<tr>
			<td style="font-size:11px;">(+) Cheques girados y no cobrados por el banco</td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($totalabono2,0,',','.'); ?> </td>
		</tr>
		<tr>
			<td style="font-size:11px;">(-) Cargos no reconocidos por la contabilidad</td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($totalacartocargo,0,',','.'); ?></td>
		</tr>
		<tr>
			<td style="font-size:11px;">(+) Abonos no reconocidos por la contabilidad</td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($totalacartoabono,0,',','.'); ?></td>
		</tr>

		<tr>
			<td style="font-size:11px;">Saldo cartola</td>
			<td style="font-size:11px;">$</td>
			<td style="font-size:11px;"><? echo number_format($saldocartola,0,',','.'); ?></td>
		</tr>

		<tr>
			<td style="font-size:11px;">&nbsp;</td>
			<td></td>
			<td style="font-size:11px;"></td>
		</tr>

		<tr>
			<td style="font-size:11px;">&nbsp;</td>
			<td></td>
			<td style="font-size:11px;"></td>
		</tr>
		</table>
	<br><br>
		<table border="0" width="80%" align="center">
		<?
		if ($regionsession==15) {
			?>

			<tr>
				<th style="font-size:11px;">______________________________________________________</th>
				<th style="font-size:11px;"></th>
				<th style="font-size:11px;">______________________________________________________</th>
			</tr>
			<tr>
				<th style="font-size:11px;">ENCARGADO ELABORACION CONCILIACION<br>OFICINA DE CONTABILIDAD</th>
				<th style="font-size:11px;"></th>
				<th style="font-size:11px;">ENCARGADA OFICINA DE CONTABILIDAD<br><?php echo $region ?></th>
			</tr>

			<tr>
				<th style="font-size:11px;">&nbsp;</th>
				<th></th>
				<th style="font-size:11px;"></th>
			</tr>
			<tr>
				<th style="font-size:11px;">&nbsp;</th>
				<th></th>
				<th style="font-size:11px;"></th>
			</tr>

			<tr>
				<th style="font-size:11px;">______________________________________________________</th>
				<th style="font-size:11px;"></th>
				<th style="font-size:11px;">______________________________________________________</th>
			</tr>
			<tr>
				<th style="font-size:11px;">ENCARGADO SECCION CONTABILIDAD Y FINANZAS<br><?php echo $region ?></th>
				<th style="font-size:11px;"></th>
				<th style="font-size:11px;">ENCARGADO OFICINA DE TESORERIA<br><?php echo $region ?></th>
			</tr>

			<?
		} else {
			?>
			<tr>
				<th style="font-size:11px;"><?php echo $encargados["encargado_1"] ?></th>
				<th style="font-size:11px;"></th>
				<th style="font-size:11px;"><?php echo $encargados["encargado_2"] ?></th>
			</tr>
			<tr>
				<th style="font-size:11px;">______________________________________________________</th>
				<th style="font-size:11px;"></th>
				<th style="font-size:11px;">______________________________________________________</th>
			</tr>
			<tr>
				<th style="font-size:10px;">ENCARGADO ELABORACION CONCILIACION<br>OFICINA DE CONTABILIDAD</th>
				<th style="font-size:10px;"></th>
				<th style="font-size:10px;">ENCARGADA OFICINA DE CONTABILIDAD<br><?php echo $region ?></th>
			</tr>

			<tr>
				<th style="font-size:11px;">&nbsp;</th>
				<th></th>
				<th style="font-size:11px;"></th>
			</tr>
			<tr>
				<th style="font-size:11px;">&nbsp;</th>
				<th></th>
				<th style="font-size:11px;"></th>
			</tr>
	
	<tr>
				<th style="font-size:11px;"><?php echo $encargados["encargado_3"] ?></th>
				<th style="font-size:11px;"></th>
				<th style="font-size:11px;"><?php echo $encargados["encargado_4"] ?></th>
			</tr>

			<tr>
				<th style="font-size:11px;">______________________________________________________</th>
				<th style="font-size:11px;"></th>
				<th style="font-size:11px;">______________________________________________________</th>
			</tr>
			<tr>
				<th style="font-size:10px;">ENCARGADO SECCION CONTABILIDAD Y FINANZAS<br><?php echo $region ?></th>
				<th style="font-size:10px;"></th>
				<th style="font-size:10px;">ENCARGADO OFICINA DE TESORERIA<br><?php echo $region ?></th>
			</tr>
			<?
		}
		?>

	</table>

</body>
</html>