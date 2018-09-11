<?php
$encabezado = "SELECT * FROM bode_folios WHERE folio_despacho = ".$_GET["folio"];
$encabezado = mysql_query($encabezado);
$encabezado = mysql_fetch_array($encabezado);
$fecha = explode("-",$encabezado["folio_fecha"]);
?>
<div class="encabezado">
		<table id="encabezado">
		<tr>
				<td><img src="../junji_logo.png"></td>
				<td align="center">
					<p id="texto1">JUNTA NACIONAL DE JARDINES INFANTILES</p>
					<p id="texto2">RESUMEN DE GUIAS</p>
					<p id="texto2">FOLIO N&deg; <?php echo $_GET["folio"] ?></p>
				</td>
				<td>
					<ul>
						<li>FECHA EMISION : <?php echo $fecha[2]."-".$fecha[1]."-".$fecha[0] ?></li>
						<li>HOJA N&deg; <?php echo $i+1 ?> / <?php echo $hojas ?></li>
					</ul>
				</td>
				</tr>
		</table>
	</div>