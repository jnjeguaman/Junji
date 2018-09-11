<?php
extract($_GET);
extract($_POST);
$regiones = array();
$region = "SELECT * FROM acti_region WHERE region_estado = 1";
$resRegiones = mysql_query($region,$dbh);
while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

if($_POST["region"] <> "")
{
	$where.='oc_region2 = '.$_POST["region"]." AND ";
}

if($_POST["folio"] <> "")
{
	$where.="oc_folioguia LIKE '%".$_POST["folio"]."%' AND ";
}

$sqlGetGuias = "SELECT * FROM bode_orcom WHERE oc_tipo = 1 AND ".$where." oc_region <> 'NULO' ORDER BY oc_id DESC";
$resGetGuias = mysql_query($sqlGetGuias,$dbh);


if($_POST["cmd"] == "anularFolio")
{
mysql_query("INSERT INTO bode_orcom (
oc_id2, 
oc_region, 
oc_region2, 
oc_nombre_oc, 
oc_prog, 
oc_fecha, 
oc_cantidad, 
oc_monto, 
oc_descuento, 
oc_fecha_recep, 
oc_usu, 
oc_pro_id, 
oc_observaciones, 
oc_proveerut, 
oc_proveedig, 
oc_proveenomb, 
oc_swdespacho, 
oc_folioguia, 
oc_grupo, 
oc_umedida, 
oc_guiafecha, 
oc_guiaabaste, 
oc_guiadestina, 
oc_guiaemisor, 
oc_estado, 
oc_numerooc, 
oc_tipo_guia, 
oc_obs, 
oc_tipo, 
oc_mas_id, 
oc_sc, 
oc_envio_fecha, 
oc_rutatc, 
oc_archivotc, 
oc_chofer, 
oc_patente, 
oc_conversion, 
oc_despacho_folio, 
oc_aperturado)

SELECT  
oc_id2, 
oc_region, 
oc_region2, 
oc_nombre_oc, 
oc_prog, 
oc_fecha, 
oc_cantidad, 
oc_monto, 
oc_descuento, 
oc_fecha_recep, 
oc_usu, 
oc_pro_id, 
oc_observaciones, 
oc_proveerut, 
oc_proveedig, 
oc_proveenomb, 
oc_swdespacho, 
oc_folioguia, 
oc_grupo, 
oc_umedida, 
oc_guiafecha, 
oc_guiaabaste, 
oc_guiadestina, 
oc_guiaemisor, 
oc_estado, 
oc_numerooc, 
oc_tipo_guia, 
oc_obs, 
oc_tipo, 
oc_mas_id, 
oc_sc, 
oc_envio_fecha, 
oc_rutatc, 
oc_archivotc, 
oc_chofer, 
oc_patente, 
oc_conversion, 
oc_despacho_folio, 
oc_aperturado
from bode_orcom where oc_id = ".$_POST["oc_id"],$dbh);

$ultimo = mysql_insert_id();

//CAMBIAMOS LOS PRODUCTOS
mysql_query("UPDATE bode_detoc SET doc_oc_id = ".$ultimo." WHERE doc_oc_id = ".$_POST["oc_id"],$dbh);

//ANULAMOS EL LA GUIA ORIGINAL
mysql_query("UPDATE bode_orcom SET oc_region = 'NULO', oc_guiadestina = 'NULO' WHERE oc_id = ".$_POST["oc_id"],$dbh);

//ACTUALIZAMOS LA NUEVA FECHA Y FOLIO
mysql_query("UPDATE bode_orcom SET oc_fecha = '".$_POST["oc_fecha"]."', oc_folioguia = ".$_POST["oc_folioguia"]." WHERE oc_id = ".$ultimo,$dbh);
echo "<script>alert('FOLIO ANULADO');window.location.href='?page=gd&action=anularfolio';</script>";
}

?>

<div class="">

	<div class="page-title">
		<div class="title_left">
			<h3><?php echo $texto ?> > ANULAR FOLIO</h3>
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
		<div class="x_panel">
			<div class="x_title">REGION DE DESTINO</div>

			<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR REGION DESTINO <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control" name="region" id="region" >
							<option value="" selected>Seleccionar...</option>
							<?php foreach ($regiones as $key => $value): ?>
								<option value="<?php echo $value["region_id"] ?>" <?php if($_POST["region"] == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">FOLIO <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="folio" id="folio" class="form-control" value="<?php echo $_POST["folio"] ?>">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="submit" value="1" class="btn btn-success">Buscar</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>


	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				

				<?php if (isset($id)): ?>
					<?php

					$gd = mysql_query("SELECT * FROM bode_orcom WHERE oc_id = ".$id,$dbh);
					$gd = mysql_fetch_array($gd);


					if($gd["oc_mas_id"] <> "")
					{
						$matriz = mysql_query("SELECT * FROM bode_masiva WHERE mas_id = ".$gd["oc_mas_id"],$dbh);
						$matriz = mysql_fetch_array($matriz);
					}
					$productos = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$id;
					$productos = mysql_query($productos,$dbh);


					?>

					<div class="x_title">
						<h2>GUIA DE DESPACHO N° <?php echo $gd["oc_folioguia"] ?></h2>
						<div class="clearfix"></div>
					</div>
					<form class="form-horizontal form-label-left" >
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">DESTINO <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $gd["oc_guiadestina"] ?>" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">ABASTECE <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $gd["oc_guiaabaste"] ?>" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">EMISOR <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $gd["oc_usu"] ?>" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">FECHA DE DESPACHO <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $gd["oc_fecha"] ?>" readonly>
							</div>
						</div>

						<?php if ($gd["oc_mas_id"] <> 0): ?>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">MATRIZ N° <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["mas_id"] ?>" readonly>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">NOMBRE MATRIZ <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["mas_nombre"] ?>" readonly>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">SECTOR <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["mas_sector"] ?>" readonly>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">ADJUNTO <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<a href="../../../../<?php echo $matriz["mas_ruta"].$matriz["mas_archivo"] ?>" target="_blank"><i class="fa fa-download"></i></a>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">CREADOR MATRIZ <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["mas_user"] ?>" readonly>
								</div>
							</div>
							<?php endif ?>



						</div>
					</div>
				</div>
			</form>


			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">

						<div class="x_title">
							<h2>DETALLE DE PRODUCTOS GUIA DE DESPACHO N° <?php echo $gd["oc_folioguia"] ?></h2>
							<div class="clearfix"></div>
						</div>



						<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
							<thead>
								<th>PRODUCTO</th>
								<th>CANTIDAD</th>
								<th>VALOR UNITARIO</th>
							</thead>

							<tbody>
								<?php while($row=mysql_fetch_array($productos)) { ?>
								<tr>
									<td><?php echo $row["doc_especificacion"] ?></td>
									<td><?php echo $row["doc_cantidad"] ?></td>
									<td>$<?php echo number_format($row["doc_conversion"],0,".",".") ?></td>
								</tr>
								<?php } ?>
							</tbody>

						</table>

					</div>
				</div>
			</div>			


			<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">NUEVO FOLIO <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control col-md-7 col-xs-12" required name="oc_folioguia" id="oc_folioguia">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">FECHA DE ENTREGA <span class="required">*</span></label>
								<div class="col-md-2 col-sm-12 col-xs-12 form-group xdisplay_inputx">
									<input type="text" class="form-control has-feedback-left" id="oc_fecha" name="oc_fecha" aria-describedby="inputSuccess2Status4" readonly required>
									<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" class="btn btn-success">Crear</button>
								</div>
							</div>
						</div>
					</div>
				</div>		
				<input type="hidden" name="oc_id" value="<?php echo $id ?>">
				<input type="hidden" name="cmd" value="anularFolio">
			</form>

	<?php else: ?>
		<?php if ($_POST["region"] <> "" OR $_POST["folio"] <> ""): ?>
		<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
			<thead>
				<th>DESTINO</th>
				<th>EMISOR</th>
				<th>FOLIO</th>
				<th>FECHA EMISION</th>
				<th>EDITAR</th>
			</thead>

			<tbody>
				<?php while($row=mysql_fetch_array($resGetGuias)) { ?>
				<tr>
					<td><?php echo $row["oc_guiadestina"] ?></td>
					<td><?php echo $row["oc_usu"] ?></td>
					<td><?php echo $row["oc_folioguia"] ?></td>
					<td><?php echo $row["oc_fecha"] ?></td>
					<td class="dropdown">
					<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">ACCION <span class="fa fa-caret-down"></span></button>
								<ul role="menu" class="dropdown-menu">
									<li><a href="?page=gd&action=anularfolio&id=<?php echo $row["oc_id"] ?>&region=<?php echo $_POST["region"] ?>&folio=<?php echo $folio ?>"><i class="fa fa-pencil"></i> ANULAR FOLIO</a></li>
									<li><a href="paginas/gd/anular_guia.php?id=<?php echo $row["oc_id"] ?>&region=<?php echo $_POST["region"] ?>&folio=<?php echo $folio ?>" onClick="return confirm('¿ DESEA ANULAR LA G/D N° <?php echo $row['oc_folioguia']?> ? ')"><i class="fa fa-trash"></i> ANULAR GUIA</a></li>
								</ul>
					</td>
				</tr>
				<?php } ?>
			</tbody>

		</table>
		<?php endif ?>
	<?php endif ?>
</div>
</div>
</div>

</div>


<script type="text/javascript">
	$(function(){
		$("#oc_fecha").datepicker({
			dateFormat: "yy-mm-dd",
		});
	})
</script>