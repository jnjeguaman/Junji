<?php 
$sql = "SELECT * FROM acti_region";
$res = mysql_query($sql,$dbh);
?>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>ENCARGADOS INVENTARIO > EDITAR</h3>
		</div>

		<div class="title_right">
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>


	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel" >
				<div class="x_title">
					<h2>Plain Page</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a>
								</li>
								<li><a href="#">Settings 2</a>
								</li>
							</ul>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<!-- CONTENIDO DE LAS PAGINAS !-->
				<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
					<thead>
						<th>REGION</th>
						<th>ENCARGADO</th>
						<th>EDITAR</th>
					</thead>

					<tbody>
						<?php while($row=mysql_fetch_array($res)) { ?>
							<tr>
								<td><?php echo $row["region_glosa"] ?></td>
								<td><?php echo $row["region_envinv"] ?></td>
								<td><a href="?page=encargados&action=edit&id=<?php echo $row["region_id"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>

					</table>
					<!-- CONTENIDO DE LAS PAGINAS !-->
				</div>
			</div>
		</div>


	</div>