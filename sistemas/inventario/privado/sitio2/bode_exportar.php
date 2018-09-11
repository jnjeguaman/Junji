<?php
session_start();
$filename = "STOCK_BODEGA ".Date("Y-m-d H.i.s");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

extract($_POST);
require("inc/config.php");
$sql = str_replace("LIMIT 200", "", $qry);
$consulta = mysql_query($sql);

function getWorkingDays($startDate, $endDate)
{
	$begin = strtotime($startDate);
	$end   = strtotime($endDate);
	if ($begin > $end) {
		// echo "startdate is in the future! <br />";

		return 0;
	} else {
		$no_days  = 0;
		$weekends = 0;
		while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
            	$weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}
$color = "#16FF3C";
?>
<!DOCTYPE html>
<html>
<head>
	<title>EXCEL</title>
</head>
<body>

	<table border="1" width="100%" cellpadding="0" cellspacing="0">

		<tr>
			<td style="background-color: <?php echo $color ?>">ID UBICACION</td>
			<td style="background-color: <?php echo $color ?>">ID PRODUCTO</td>
			<td style="background-color: <?php echo $color ?>">ORDEN DE COMPRA</td>
			<td style="background-color: <?php echo $color ?>">BIEN</td>
			<td style="background-color: <?php echo $color ?>">RECEPCIONADO</td>
			<td style="background-color: <?php echo $color ?>">STOCK DISPONIBLE</td>
			<td style="background-color: <?php echo $color ?>">PROVEEDOR</td>
			<td style="background-color: <?php echo $color ?>">FECHA ENTREGA</td>
			<td style="background-color: <?php echo $color ?>">VALOR UNITARIO NETO</td>
			<td style="background-color: <?php echo $color ?>">UBICACION</td>
			<td style="background-color: <?php echo $color ?>">PROGRAMA</td>
			<?php if ($_SESSION["region"] == 16): ?>
				<td style="background-color: <?php echo $color ?>">ESTADISTICA</td>
				<td style="background-color: <?php echo $color ?>">ID MERCADO PUBLICO</td>
			<?php endif ?>
			<td style="background-color: <?php echo $color ?>">N&deg; GUIA / FACTURA</td>
			<td style="background-color: <?php echo $color ?>">GRUPO</td>
			<td style="background-color: <?php echo $color ?>">N&deg; RECEPCI&Oacute;N CONFORME</td>
			<td style="background-color: <?php echo $color ?>">REGI&Oacute;N RECEPCI&Oacute;N CONFORME</td>
		</tr>

		<tbody>
			<?php while($row = mysql_fetch_array($consulta)) { ?>

			<?php

			$v_ing_aprueba = $row["ing_aprobado"];
			$v_fentrega = $row["ding_fentrega"];
			$diasHabiles = getWorkingDays($v_fentrega,Date("Y-m-d"));
			$v_ding_unidad = $row["ding_unidad"];

			?>
			<tr>
				<td><?php echo $row["ding_id"] ?></td>
				<td><?php echo $row["doc_id"] ?></td>
				<td><?php echo $row["oc_id2"] ?></td>
				<td><?php echo mb_convert_encoding($row["doc_especificacion"],"ISO-8859-1") ?></td>
				<td><?php echo $row["ding_cantidad"] ?></td>
				<td><?php echo $row["ding_unidad"] ?></td>
				<td><?php echo $row["oc_proveenomb"] ?></td>
				<td><?php echo $row["ding_fentrega"] ?></td>
				<td>$<?php echo number_format($row["doc_conversion"],0,".",".") ?></td>
				<td><?php echo $row["ding_ubicacion"] ?></td>
				<td><?php echo $row["oc_prog"] ?></td>

				<?php if($_SESSION["region"] == 16): ?>
					<td>
						<?php if ($v_fentrega >= "2016-04-01"): ?>

							<?php if ($v_ing_aprueba == ""): ?>
								<font color="red"><strong>FALTA APROBACIÓN</strong></font>
							<?php elseif($v_ding_unidad > 0 && $diasHabiles >= 5 && $v_ing_aprueba <> ""): ?>
								<font color="red"><strong><?php echo $diasHabiles ?></strong></font>
							<?php elseif($v_ding_unidad > 0 && $diasHabiles < 5 && $v_ing_aprueba <> ""): ?>
								<font color="green"><strong><?php echo $diasHabiles ?></strong></font>
							<?php elseif($v_ding_unidad == 0 && $v_ing_aprueba <> ""): ?>
								<font color="green"><strong>OK</strong></font>
							<?php endif ?>
						<?php endif ?>
					</td>
					<td><?php echo $row["doc_id_mercado_publico"] ?></td>
				<?php endif ?>
				<td><?php echo $row["ing_guia"]?></td>
				<td><?php echo $row["oc_grupo"]?></td>
				<td><?php echo $row["ing_guianumerorc"] ?></td>
				<td><?php echo $row["doc_region"] ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>