<?php
$categoria = getCategorias();
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
				<th>CATEGORIA</th>
				<th>ESTADO</th>
				<th>N° PRODUCTOS</th>
				<th>EDITAR</th>
			</thead>

			<tbody>
				<?php foreach ($categoria as $key => $value): ?>
					<tr>
						<td><?php echo $value["categoria_id"] ?></td>
						<td><?php echo $value["categoria_glosa"] ?></td>
						<td><?php echo ($value["categoria_estado"] == 1) ? "<i class='fa fa-check fa-2x'></i>" : "<i class='fa fa-ban fa-2x'></i>" ?></td>
						<td><?php echo $value["totalProductos"] ?></td>
						<td><a href="?pagina=categorias&ori=editar&id=<?php echo $value["categoria_id"] ?>" class="btn btn-sm btn-warning">EDITAR <i class="fa fa-pencil"></i></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>	
		</table>

	</div>
</div>