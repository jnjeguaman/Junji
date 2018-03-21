<?php
$usuarios = getUsuarios();
$arraySistemas = [
1 => "SISTEMA DE FACTURACIÓN ELECTRÓNICA",
2 => "INEDIS - LOGISTICA",
3 => "INEDIS - INVENTARIO"
];
?>
<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">LISTADO DE USUARIOS</h4>
	</div>
	<div class="panel-body">

		<table class="table table-striped table-bordered responsive table-hover" id="basicTable">
			<thead>
				<th>#</th>
				<th>NOMBRE</th>
				<th>APELLIDO PATERNO</th>
				<th>APELLIDO MATERNO</th>
				<th>RUT</th>
				<th>ESTADO</th>
				<th>REGIÓN</th>
				<th>AUTORIZADO A FIRMAR</th>
				<th>DTE PERMITIDOS</th>
				<th>SISTEMA AUTORIZADO</th>
				<th>EDITAR</th>
			</thead>

			<tbody>
				<?php foreach ($usuarios as $key => $value): ?>
					<tr>
						<td><?php echo $value["usuario_id"] ?></td>
						<td><?php echo $value["usuario_nombre"] ?></td>
						<td><?php echo $value["usuario_apellido_paterno"] ?></td>
						<td><?php echo $value["usuario_apellido_materno"] ?></td>
						<td><?php echo number_format($value["usuario_rut"],0,".",".")."-".$value["usuario_dv"] ?></td>
						<td>
							<?php if ($value["usuario_estado"] == 1): ?>
								ACTIVO
							<?php else: ?>
								DESHABILITADO
							<?php endif ?>
						</td>
						<td><?php echo $value["usuario_region"] ?></td>
						<td><?php echo ($value["usuario_autorizado_firmar"] == 1) ? "<i class='fa fa-check fa-lg' style='color:#10B720'></i>" : "<i class='fa fa-ban' style='color:#CF1414'></i>" ?></td>
						<td>
							<ul>
								<li>FACTURA ELECTRÓNICA : <?php echo ($value["usuario_autorizado_33"] == 1) ? "<i class='fa fa-check fa-lg' style='color:#10B720'></i>" : "<i class='fa fa-ban' style='color:#CF1414'></i>" ?></li>
								<li>FACTURA NO AFECTA O EXENTA ELECTRÓNICA : <?php echo ($value["usuario_autorizado_34"] == 1) ? "<i class='fa fa-check fa-lg' style='color:#10B720'></i>" : "<i class='fa fa-ban' style='color:#CF1414'></i>" ?></li>
								<li>GUÍA DE DESPACHO ELECTRÓNICA : <?php echo ($value["usuario_autorizado_52"] == 1) ? "<i class='fa fa-check fa-lg' style='color:#10B720'></i>" : "<i class='fa fa-ban' style='color:#CF1414'></i>" ?></li>
								<li>NOTA DE DÉBITO ELECTRÓNICA : <?php echo ($value["usuario_autorizado_56"] == 1) ? "<i class='fa fa-check fa-lg' style='color:#10B720'></i>" : "<i class='fa fa-ban' style='color:#CF1414'></i>" ?></li>
								<li>NOTA DE CRÉDITO ELECTRÓNICA : <?php echo ($value["usuario_autorizado_61"] == 1) ? "<i class='fa fa-check fa-lg' style='color:#10B720'></i>" : "<i class='fa fa-ban' style='color:#CF1414'></i>" ?></li>
							</ul>
						</td>
						<td><?php echo $arraySistemas[$value["usuario_sistema"]] ?></td>
						<td>
							<a href="?pagina=usuario&ori=editar&id=<?php echo $value["usuario_id"] ?>" class="btn btn-danger"><i class="fa fa-pencil"></i> EDITAR </a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>	
		</table>

	</div>
</div>