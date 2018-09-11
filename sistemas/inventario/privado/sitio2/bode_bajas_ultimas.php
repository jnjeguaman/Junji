<?php 
$query = "SELECT * FROM bode_orcom WHERE oc_estado = 99 AND oc_region = ".$_SESSION["region"];
$res = mysql_query($query);
$cont=1;
?>

<table border="0" width="100%">
	<tr>
		<td class="Estilo2titulo">GUIAS EN PROCESO</td>
	</tr>
</table>

<table border="1" width="100%">
	<tr>
		<td class="Estilo1mc"></td>
		<td class="Estilo1mc">ID</td>
		<td class="Estilo1mc">FECHA</td>
		<td class="Estilo1mc">AGREGAR</td>
	</tr>

	<?php 
	while($row = mysql_fetch_array($res))
	{
		$estilo=$cont%2;
		if ($estilo==0) {
			$estilo2="Estilo1mc";
		} else {
			$estilo2="Estilo1mcblanco";
		}
		?>
		<tr class="<?php echo $estilo2 ?> trh">
			<td><?php echo $cont ?></td>
			<td><?php echo $row["oc_id"] ?></td>
			<td><?php echo $row["oc_fecha"] ?></td>
			<td>
			<?php if ($_SESSION["pfl_user"] <> 53): ?>
			<a href="bode_inv_indexoc4.php?cmd=Bajas&ori=2&ocid=<?php echo $row["oc_id"] ?>"><i class="fa fa-plus fa-lg link"></i></a>
			<?php endif ?>
			</td>
		</tr>
		<?php $cont++;} ?>
	</table>
