<?php
require_once("includes/functions.estadistica.php");
$consumoFolio = getConsumoFolio();
?>
<div class="panel panel-primary-head">
	<div class="panel-heading">
		<h4 class="panel-title">Basic Configuration</h4>
		<p>Searching, ordering, paging etc goodness will be immediately added to the table, as shown in this example.</p>
	</div><!-- panel-heading -->

	<table id="basicTable" class="table table-striped table-bordered responsive">
		<thead>
			<th>TIPO DOCUMENTO</th>
			<th>DTE REALIZADOS</th>
			<th>RANGO DE FOLIOS</th>
			<th>N° FOLIOS SOLICITADOS</th>
			<th>ÚLTIMO FOLIO</th>
			<th>DISPONIBLES</th>
			<th>%</th>
		</thead>

		<tbody>
			<?php foreach ($consumoFolio as $key => $value): ?>
				<?php
				$total = (($value["folio_fin"] - $value["folio_inicio"]) + 1);
				$total2 = $value["Total"] * 100;
				$total3 = $total2/$total;
				?>
				<tr>
					<td><?php echo $value["dcto_glosa"] ?></td>
					<td><?php echo $value["Total"] ?></td>
					<td><?php echo $value["folio_inicio"]." - ".$value["folio_fin"] ?></td>
					<td><?php echo ($value["folio_fin"] - $value["folio_inicio"])+1 ?></td>
					<td><?php echo $value["folio_actual"] ?></td>
					<td><?php echo (($value["folio_fin"] - $value["folio_inicio"]) + 1) - $value["Total"] ?></td>
					<td><?php echo($total3)  ?>%</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

</div>