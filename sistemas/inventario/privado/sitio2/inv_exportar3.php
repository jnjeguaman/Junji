<?php
$filename = "regisroGuias_".Date("YmdHis");
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

include("inc/config.php");
$res = mysql_query(trim(str_replace("LIMIT 50","",$_POST["qry"])));
$cont = 1;
$colspan = 10;
if (stripos($_POST["qry"], "acti_inventario")) {
	$colspan = $colspan + 2;
}

$style = array(
	1 => "style='background:red;color:white'",
	2 => "");
?>
<table border="1" width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<th colspan="<?php echo $colspan ?>">REGISTRO DE GU&Iacute;AS</th>
	</tr>

	<tr>
		<td align="left">N&deg; GUIA</td>
		<?php if (stripos($_POST["qry"], "acti_inventario")): ?>
		<td align="left">CODIGO DE INVENTARIO</td>
		<td align="left">BIEN</td>
		<?php endif ?>
		<td align="left">ABASTECE</td>
		<td align="left">DESTINATARIO</td>
		<td align="left">FECHA DE EMISION</td>		<td align="left">DIRECCION</td>
		<td align="left">COMUNA</td>
		<td align="left">EMISOR</td>
		<td align="left">ESTADO</td>
		<td align="left">RESPONSABLE</td>
		<td align="left">REGION</td>
	</tr>

	<?php while($row = mysql_fetch_array($res)) { 
		?>
			<tr <?php echo ($row["guia_estado"] == 0) ? $style[1] : $style[2]  ?>>
				<td align="left"><?php echo $row["guia_numero"] ?></td>
				<?php if (stripos($_POST["qry"], "acti_inventario")): ?>
				<td align="left"><?php echo $row["inv_codigo"] ?></td>
				<td align="left"><?php echo $row["inv_bien"] ?></td>
				<?php endif ?>
				<td align="left"><?php echo $row["guia_abastece"] ?></td>
				<td align="left"><?php echo $row["guia_destinatario"] ?></td>
				<td align="left"><?php echo $row["guia_emision"] ?></td>
				<td align="left"><?php echo $row["guia_direccion"] ?></td>
				<td align="left"><?php echo $row["guia_comuna"] ?></td>
				<td align="left"><?php echo $row["guia_emisor"] ?></td>
				<td align="left">
					<?php if($row["guia_estado"] == 0): ?>
						<font color="red"><strong>NULO</strong></font>
						<?php else: ?>
						<font color="green"><strong>OK</strong></font>
					<?php endif ?>
				</td>
				<td align="left"><?php echo $row["guia_responsable"] ?></td>
				<td align="left"><?php echo $row["guia_region_origen"] ?></td>
			</tr>
	<?php } ?>
</table>