<?php 
$res = mysql_query($sql);
$data = array();
$sumaBienes = 0;
$sumaValor = 0;
$contador = 1;
$sumaBienes = 0;
$sumas = 0;
while($row = mysql_fetch_array($res))
{
	$suma2 +=$row["Total"];
	$sumaBienes += 1;
	$sumaValor += $row["Total2"];
	$data[] = $row; 
}
$meses = array("01" => "Enero","02" => "Febrero","03" => "Marzo","04" => "Abril","05" => "Mayo","06" => "Junio","07" => "Julio","08" => "Agosto","09" => "Septiembre","10" => "Octubre","11" => "Noviembre","12" => "Diciembte");
$region = mysql_query("SELECT * FROM acti_region WHERE region_id = ".$_SESSION["region"]);
$region = mysql_fetch_array($region)
?>

<table border="0" width="<?php echo $porcentaje ?>%" align="center">
	<tr>
		<td><img src="../junji_logo.png"></td>
	</tr>

	<tr>
		<td align="right"><strong><?php echo $detalleJardin["jardin_comuna"] ?>, <?php echo Date("d") ?> de <?php echo $meses[Date("m")] ?> del <?php echo Date("Y") ?></strong></td>
	</tr>
</table>
<br>

<table border="0" width="<?php echo $porcentaje ?>%" align="center" style="margin-top:80px;">
	<tr>
		<td><h3><center>CERTIFICADO DE VALORIZACIÓN</center></h3></td>
	</tr>

	<tr>
		<td>
				<p style="text-align:justify;">Por el presente, la Junta Nacional de Jardines Infantiles, a través de la Subdirección de Recursos    Financieros, certifica que el Jardín Infantil "<strong><?php echo $detalleJardin["jardin_nombre"] ?></strong>", Código Gesparvu <strong><?php echo $detalleJardin["jardin_codigo"] ?></strong>, perteneciente a la <!-- <?php echo $detalleJardin["jardin_region"] ?> Región de  --><strong><?php echo $region["region_glosa"] ?></strong>, posee <strong><?php echo $suma2 ?></strong> cantidad de bienes que se encuentran valorizados por el monto total de <strong>$<?php echo number_format($sumaValor,0,".",".") ?></strong> pesos. Dicho monto, se encuentra desglosado de acuerdo a mobiliario y equipamiento en el <strong>"<i>Anexo Detalle de Valorización de Bienes</i>"</strong> adjunto</p>
		</td>
	</tr>
</table>


<table border="0" width="<?php echo $porcentaje ?>%" align="center" class="footer" style="margin-top:400px;">

<tr>
	<td align="center">____________________________</td>
	<td align="center">____________________________</td>
</tr>

<tr>
	<td align="center"><strong>DIRECTOR(A) REGIONAL</strong></td>
	<td align="center"><strong>SUBDIRECTOR</strong></td>
</tr>

<tr>
	<td></td>
	<td>&nbsp;</td>
</tr>

<tr>
	<td></td>
	<td align="center"><strong>RECURSOS FINANCIEROS</strong></td>
</tr>

</table>
