<?php
$folios = getCAF();
?>

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
			<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
		</div><!-- panel-btns -->
		<h4 class="panel-title">LISTADO DE CLIENTES</h4>
	</div><!-- panel-heading -->
	<div class="panel-body">

		<table class="table table-striped table-bordered responsive table-hover" id="basicTable">
			<thead>
				<th>#</th>
				<th>REGION</th>
				<th>TIPO DOCUMENTO</th>
				<th>FOLIO INICIO</th>
				<th>FOLIO FIN</th>
				<th>RANGO</th>
				<th>ÚLTIMO FOLIO USADO</th>
				<th>FOLIOS DISPONIBLES</th>
				<th>FOLIOS USADOS</th>
				<th>ESTADO</th>
				<th>1° AVISO</th>
				<th>2° AVISO</th>
				<th>3° AVISO</th>
			</thead>

			<tbody>
				<?php foreach ($folios as $key => $value): ?>
					<tr>
						<td><?php echo $value["folio_id"] ?></td>
						<td><?php echo $value["folio_region"] ?></td>
						<td><?php echo "(".$value["folio_tipo"].") : ".$value["dcto_glosa"] ?></td>
						<td><?php echo $value["folio_inicio"] ?></td>
						<td><?php echo $value["folio_fin"] ?></td>
						<td><?php echo ($value["folio_fin"] - ($value["folio_inicio"] - 1)) ?></td>
						<td><?php echo $value["folio_actual"] ?></td>
						<td><?php echo ($value["folio_fin"] - $value["folio_actual"]) ?></td>
						<td><?php echo ($value["folio_fin"] - ($value["folio_inicio"] - 1)) - ($value["folio_fin"] - $value["folio_actual"]) ?></td>
						<td><?php echo ($value["folio_estado"] == 1) ? "<i class='fa fa-check fa-2x'></i>" : "<i class='fa fa-ban fa-2x'></i>" ?></td>
						<td><?php echo $value["folio_umbral"] ?></td>
						<td><?php echo $value["folio_umbral_2"] ?></td>
						<td><?php echo $value["folio_umbral_3"] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>	
		</table>

	</div>
</div>