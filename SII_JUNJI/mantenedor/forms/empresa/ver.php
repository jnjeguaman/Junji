<?php
require_once("includes/functions.empresa.php");
$empresas = getEmpresas();
$usabilidad = [
1 => "<span class='label label-success'>INEDIS - LOGÍSTICA</span>",
2 => "<span class='label label-danger'>INEDIS - INVENTARIO</span>",
"" => "<span class='label label-warning'>SISTEMA DE FACTURACIÓN ELECTRÓNICA</span>",
// "" => "<span class='label label-danger'>SIN ASIGNAR</span>"
];
?>
<div class="alert alert-info" role="alert">
	<strong>INFORMACIÓN <i class="fa fa-info-circle">	</i></strong>
	<p>En esta sección usted encontrará las direcciones de origen oficiales de los documentos tributarios electrónicos (DTE) emitidos por los sistemas <strong>INEDIS</strong> y <strong>SIGEJUN</strong>.</p>
</div>
<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">LISTADO DIRECCIONES OFICIALES DEL S.I.I.</h4>
	</div>
	<div class="panel-body">

		<table class="table table-striped table-bordered responsive table-hover" id="basicTable">
			<thead>
				<th>#</th>
				<th>REGION</th>
				<th>COMUNA</th>
				<th>CIUDAD</th>
				<th>DIRECCION</th>
				<th>USABILIDAD</th>
				<th>EDITAR</th>
				
			</thead>

			<tbody>
				<?php foreach ($empresas as $key => $value): ?>
					<tr>
						<td><?php echo $value["empresa_id"] ?></td>
						<td><?php echo $value["empresa_region"] ?></td>
						<td><?php echo $value["empresa_comuna"] ?></td>
						<td><?php echo $value["empresa_ciudad"] ?></td>
						<td><?php echo $value["empresa_direccion"] ?></td>
						<td><?php echo $usabilidad[$value["empresa_origen"]] ?></td>
						<td><a href="?pagina=empresa&ori=editar&id=<?php echo $value["empresa_id"] ?>" class="btn btn-danger"><i class="fa fa-pencil"></i> EDITAR </a></td>
					</tr>
					<?php endforeach ?>
			</tbody>
		</table>
		</div>
		</div>			