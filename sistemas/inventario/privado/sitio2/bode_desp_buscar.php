<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
	<table border="1" width="100%" cellpadding="3">
		<tr>
			<td  class="Estilo2titulo" colspan="4">BUSCADOR DE GUÍAS</td>
		</tr>

		<tr>
			<td class="Estilo1">N° GUÍA</td>
			<td class="Estilo1"><input type="text" name="guia" id="guia" value="<?php echo $guia ?>" class="Estilo1"></td>

			<td class="Estilo1">N° FOLIO INTERNO</td>
			<td class="Estilo1"><input type="text" name="finterno" id="finterno" value="<?php echo $finterno ?>" class="Estilo1"></td>

		</tr>
	
	<tr>
			<td class="Estilo1">N° MATRIZ</td>
			<td class="Estilo1"><input type="text" name="nmatriz" id="nmatriz" value="<?php echo $nmatriz ?>" class="Estilo1"></td>


		</tr>

		<tr>
			<td colspan="4" align="center"><button>BUSCAR</button></td>
		</tr>
	</table>
	<input type="hidden" name="cod" value="<?php echo $cod ?>">
</form>

<?php

$consulta="";

if($guia <> "")
{
	$consulta .= "oc_folioguia = ".$guia." AND ";
}

if($finterno <> "")
{
	$consulta .= "oc_despacho_folio = ".$finterno." AND ";	
}

if($nmatriz <> "")
{
	$consulta .= "oc_mas_id = ".$nmatriz." AND ";	
}

if($consulta <> "")
{

	$sql = "SELECT * FROM bode_orcom WHERE ".$consulta." oc_tipo = 1";
	$res = mysql_query($sql);
	if(mysql_num_rows($res) > 0)
	{

		?>
		<hr>
		<table border="1" width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="6">RESULTADO</td>
			</tr>

			<tr>
				<td class="Estilo1mc">#</td>
				<td class="Estilo1mc">FOLIO INTERNO</td>
				<td class="Estilo1mc">FOLIO GUIA</td>
				<td class="Estilo1mc">EMISOR</td>
				<td class="Estilo1mc">FECHA DESPACHO</td>
				<td class="Estilo1mc">VER GUIA</td>
			</tr>

			<?php
			$contador = 1;
			while($row = mysql_fetch_array($res)) {
			// $sqlInterno = "SELECT * FROM bode_folios WHERE folio_despacho = ".$row["oc_despacho_folio"]." LIMIT 1";
			// $resInterno = mysql_query($sqlInterno);
			// $rowInterno = mysql_fetch_array($resInterno);
			// $total = mysql_num_rows($resInterno);
			// if($total > 0){
			if($row["oc_despacho_folio"] <> ""){
			?>
				<tr class="trh">
					<td class="Estilo1mc"><?php echo $contador ?></td>
					<td class="Estilo1mc"><?php echo $row["oc_despacho_folio"] ?></td>
					<td class="Estilo1mc"><?php echo $row["oc_folioguia"] ?></td>
					<td class="Estilo1mc"><?php echo $row["oc_usu"] ?></td>
					<td class="Estilo1mc"><?php echo $row["oc_fecha"] ?></td>
					<td class="Estilo1mc"><a href="reporte/reporte2.php?folio=<?php echo $row["oc_despacho_folio"] ?>" target="_blank"><i class="fa fa-file link fa-lg"></i></a></td>
				</tr>
				<?php $contador++;} } ?>
			</table>
			<?php } } ?>