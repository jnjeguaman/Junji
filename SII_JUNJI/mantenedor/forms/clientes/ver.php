<?php
$clientes = getClientes();
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

		<table class="table table-striped table-bordered responsive" id="basicTable">
			<thead>
				<th>#</th>
				<th>RAZON SOCIAL</th>
				<th>RUT</th>
				<th>ESTADO</th>
				<th>ACCION</th>
			</thead>

			<tbody>
				<?php foreach ($clientes as $key => $value): ?>
					<tr>
						<td><?php echo $value["cliente_id"] ?></td>
						<td><?php echo $value["cliente_empresa"] ?></td>
						<td><?php echo number_format($value["cliente_rut"],0,".",".")."-".$value["cliente_dv"] ?></td>
						<td><?php echo ($value["cliente_estado"] === 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?></td>
						<td><a href="?pagina=clientes&ori=editar&id=<?php echo $value["cliente_id"] ?>" class="btn btn-sm btn-warning">EDITAR <i class="fa fa-pencil"></i></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>	
		</table>

	</div>
</div>