<?php
session_start();
require_once("inc/config.php");
extract($_GET);

$encabezado = "SELECT * FROM inv_guia_despacho_encabezado WHERE guia_id = ".$guia." AND guia_origen = ".$guia_origen." AND guia_region_origen = ".$_SESSION["region"];
$encabezado = mysql_query($encabezado);
$encabezado = mysql_fetch_array($encabezado);

$partes = explode(" ", $encabezado["guia_direccion"]);
// var_dump($partes);
if($partes[0] == "JI")
{

$direccion = mysql_query("SELECT * FROM jardines WHERE jardin_codigo = ".$partes[1]." LIMIT 1");
$direccion = mysql_fetch_array($direccion);
$direccion = $direccion["jardin_direccion"];
}

// $detalle = "SELECT * FROM inv_guia_despacho_detalle WHERE detalle_guia_numero =".$guia;
$detalle = "SELECT * FROM inv_guia_despacho_detalle WHERE detalle_guia_numero =".$encabezado["guia_id"];
$detalle = mysql_query($detalle);

$productos = array();
$limite = 22;
while($row=mysql_fetch_array($detalle))
{
	$productos[]=$row;
}

$restante = $limite - sizeof($productos);
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<style type="text/css">
		html{
			font-size: 11px;
			font-family: Helvetica;
			font-weight: bold;
		}

		textarea{
			border: none;
			font-size: 11px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<table border="0" cellpadding="0" cellspacing="0" width="75%" align="center">


		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="2"><?php echo $encabezado["guia_abastece"] ?></td>
		</tr>

		<tr>
			<td></td>
			<td align="center"><?php echo $encabezado["guia_numero"] ?></td>
		</tr>

		<tr>
			<td><?php echo $encabezado["guia_destinatario"] ?></td>
			<td align="center"><?php echo $encabezado["guia_emision"] ?></td>
		</tr>

		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr>
			<td><?php if($partes[0] == "JI"){echo $encabezado["guia_direccion"]." / ".$direccion;}else{echo $encabezado["guia_direccion"];} ?></td>
			<td><?php echo $encabezado["guia_comuna"] ?></td>
		</tr>

	</table>

	<br>
	<br>
	<br>
	<br>

	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
	<?php $i=0;foreach ($productos as $key => $value): ?>
		<?php
		$nombre = "SELECT * FROM acti_inventario WHERE inv_codigo = ".$value["detalle_inv_codigo"];
		$nombre = mysql_query($nombre);
		$nombre = mysql_fetch_array($nombre);
		$suma+=$nombre["inv_costo"];
		?>

		<tr>
						<td align="center"><?php echo ($i+1) ?></td>
						<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value["detalle_inv_codigo"] ?></td>
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nombre["inv_bien"] ?></td>
						<td align="left">1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UD</td>
						<td align="left"></td>
						<td align="left">$</td>
						<td align="left"><?php echo number_format($nombre["inv_costo"],0,".",".") ?></td>
						<td align="left">$</td>
						<td align="left"><?php echo number_format($nombre["inv_costo"],0,".",".") ?></td>
					</tr>
					<?php $i++; ?>
	<?php endforeach ?>
	<?php for($i=0;$i<$restante;$i++): ?>
		<tr>
						<td>&nbsp;</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
	<?php endfor ?>

	<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="left"><?php  echo number_format($suma,0,".",".") ?></td>
		</tr>

		<tr>
			<td colspan="9">&nbsp;</td>
		</tr>


		<tr>
			<td colspan="9"><center><textarea style="margin: 0px; height: 122px; width: 700px;"><?php echo $encabezado["guia_obs"] ?></textarea></center></td>
		</tr>

		<tr>
			<td colspan="9" align="left"><?php echo $encabezado["guia_emisor"] ?></td>
		</tr>
	</table>
</body>

</html>
