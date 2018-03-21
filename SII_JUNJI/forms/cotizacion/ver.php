<?php
require_once("includes/functions.cotizacion.php");
$regionSession = $_SESSION["sii"]["usuario_region"];
$cotizaciones = getCotizaciones($regionSession);
?>
<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
		</div><!-- panel-btns -->
		<h4 class="panel-title">COTIZACIONES PENDIENTES</h4>
	</div><!-- panel-heading -->
	<div class="panel-body">

		<table class="table table-striped table-bordered responsive" id="basicTable">
			<thead>
				<th>#</th>
				<th>CLIENTE</th>
				<th>TOTAL</th>
				<th>G/D</th>
				<th>FE</th>
				<th>ACCION</th>
			</thead>

			<tbody>
				<?php foreach ($cotizaciones as $key => $value): ?>
					<tr>
						<td><?php echo $value["cotizacion_id"] ?></td>
						<td><?php echo $value["cliente_empresa"] ?></td>
						<td>$<?php echo number_format($value["cotizacion_total"],0,".",".") ?></td>
						<td><?php echo ($value["cotizacion_gd"] == 1) ? "<span class='label label-success'><i class='fa fa-check'></i></span>" : "<span class='label label-warning'><i class='fa fa-warning'></i></span>" ?></td>
						<td><?php echo ($value["cotizacion_fe"] == 1) ? "<span class='label label-success'><i class='fa fa-check'></i></span>" : "<span class='label label-warning'><i class='fa fa-warning'></i></span>" ?></td>
						<td>
							<div class="btn-group mr5">
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Accion <span class="caret"></span></button>
								<ul class="dropdown-menu" role="menu">

								<?php if ($value["cotizacion_fe"] == ""): ?>
									<li><a href="?pagina=cotizacion&action=facturar&id=<?php echo $value["cotizacion_id"] ?>"><i class="fa fa-file-o"></i> Facturar</a></li>
								<?php endif ?>
								
								<?php if ($value["cotizacion_gd"] == ""): ?>
									<li><a href="?pagina=cotizacion&action=gd&id=<?php echo $value["cotizacion_id"] ?>"><i class="fa fa-book"></i> Guía de Despacho</a></li>
								<?php endif ?>
									<!-- <li class="divider"></li> -->
									<!-- <li><a href="#">Separated link</a></li> -->
								</ul>
							</div><!-- btn-group -->
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>	
		</table>

	</div>
</div>