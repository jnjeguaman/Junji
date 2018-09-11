<!DOCTYPE html>
<html>
<head>
	<title>SET DE PAGOS</title>
</head>
<body>


<?php
require_once("inc/config.php");
extract($_GET);
$sql = "SELECT * FROM dpp_etapas WHERE eta_nroorden = '".$oc."'";
$res = mysql_query($sql,$dbh2);
$etapas = array();
while($row = mysql_fetch_array($res))
{
	$etapas[] = $row["eta_id"];
}

$datos = array();

for($i=0;$i<count($etapas);$i++)
{
	$sql2 = "SELECT * FROM dpp_etapas a INNER JOIN dpp_facturas b ON b.fac_eta_id = a.eta_id WHERE a.eta_id = ".$etapas[$i];
	$res2 = mysql_query($sql2,$dbh2);
	$datos[] = mysql_fetch_array($res2);
}

?>

<?php if (count($etapas) > 0): ?>
	<table border="1" width="100%" style="border-collapse: collapse;">
		<tr align="center">
			<td>FOLIO</td>
			<td>N° DOCUMENTO</td>
			<td>VER</td>
		</tr>

		<?php for($x=0;$x<count($datos);$x++) { ?>
		<tr align="center">
			<td><?php echo $datos[$x]["eta_folio"] ?></td>
			<td><?php echo $datos[$x]["eta_numero"] ?></td>
			<td><a href="../../../seguimientos/sitio2/compra_documentos.php?fac_id=<?php echo $datos[$x]["fac_id"] ?>" target="_blank">VER</a></td>
		</tr>

		<?php } ?>
	</table>
	<?php else: ?>
		NO HAY SET DE PAGOS DISPONIBLES
<?php endif ?>
</body>
</html>