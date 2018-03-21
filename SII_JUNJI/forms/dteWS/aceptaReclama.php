<?php
$detalleDocumento = getDetalleDocumento($id);
$historial = getHistorial($id);
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
$tipos = [
"ACD" => "ACEPTA CONTENIDO DEL DOCUMENTO",
"RCD" => "RECLAMO AL CONTENIDO DEL DOCUMENTO",
"ERM" => "OTORGA RECIBO DE MERCADERÍAS O SERVICIOS",
"RFP" => "RECLAMO POR FALTA PARCIAL DE MERCADERÍAS",
"RFT" => "RECLAMO POR FALTA TOTAL DE MERCADERÍAS"
];
?>
<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">ACEPTACIÓN / RECHAZO DTE RECIBIDO</h4>
		<p>Tipo de Documento : <?php echo $detalleDocumento[1]["dcto_glosa"] ?></p>
		<p>Proveedor : <?php echo $detalleDocumento[1]["recibido_razon"] ?></p>
		<p>Fecha de Emisión : <?php echo $detalleDocumento[1]["recibido_emision"] ?></p>
		<p>Fecha Recepcion S.I.I. : <?php echo $detalleDocumento[1]["recibido_recepcion"] ?></p>
		<p>Monto : $<?php echo number_format($detalleDocumento[1]["recibido_monto"],0,".",".") ?></p>
		<p>Folio : <?php echo $detalleDocumento[1]["recibido_folio"] ?></p>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" id="frmAceptaReclama">

			<div class="form-group">
				<label class="col-sm-3 control-label">ACCION <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<select name="recibido_accion" id="recibido_accion" class="form-control">
						<option value="" selected>Seleccionar...</option>
						<option value="ACD">ACEPTA CONTENIDO DEL DOCUMENTO</option>
						<option value="RCD">RECLAMO AL CONTENIDO DEL DOCUMENTO</option>
						<option value="ERM">OTORGA RECIBO DE MERCADERÍAS O SERVICIOS</option>
						<option value="RFP">RECLAMO POR FALTA PARCIAL DE MERCADERÍAS</option>
						<option value="RFT">RECLAMO POR FALTA TOTAL DE MERCADERÍAS</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-3 col-sm-offset-3">
					<button class="btn btn-success" type="submit">ENVÍAR <i class="fa fa-search"></i></button>
					<!-- <button type="reset" class="btn btn-dark">Reset</button> -->
				</div>
			</div>
			<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
			<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
			<input type="hidden" name="proveedor_rut" id="proveedor_rut" value="<?php echo $detalleDocumento[1]["recibido_rut"] ?>">
			<input type="hidden" name="proveedor_dv" id="proveedor_dv" value="<?php echo $detalleDocumento[1]["recibido_dv"] ?>">
			<input type="hidden" name="proveedor_folio" id="proveedor_folio" value="<?php echo $detalleDocumento[1]["recibido_folio"] ?>">
			<input type="hidden" name="proveedor_tipo" id="proveedor_tipo" value="<?php echo $detalleDocumento[1]["recibido_tipo"] ?>">
			<input type="hidden" name="proveedor_id" id="proveedor_id" value="<?php echo $detalleDocumento[1]["recibido_id"] ?>">
			<input type="hidden" name="cmd" id="cmd" value="ingresarAceptacionReclamoDoc">

		</form>
	</div>
</div>

<?php if (sizeof($historial) > 0): ?>
	<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">HISTÓRICO</h4>

		</div>
		<div class="panel-body">

			<table id="basicTable" class="table table-striped table-bordered">
				<thead class="">
					<tr>
						<th>ID</th>
						<th>ACCION</th>
						<th>DESCRIPCIÓN</th>
						<th>FECHA ACCIÓN</th>
						<th>HORA ACCIÓN</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($historial as $key => $value): ?>
						<tr>
							<td><?php echo $value["histo_id"] ?></td>
							<td><?php echo $value["histo_tipo"] ?></td>
							<td><?php echo $tipos[$value["histo_tipo"]] ?></td>
							<td><?php echo $value["histo_fecha"] ?></td>
							<td><?php echo $value["histo_hora"] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>

		</div>
	</div>
<?php endif ?>
<script type="text/javascript">
	$("#frmAceptaReclama").validate({
		rules : {
			recibido_accion : {required:true}
		},
		submitHandler : function(form)
		{
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.dtews.php",
				data:data,
				dataType:"JSON",
				beforeSend : function(){
					blockUI();
				},
				success : function ( response ) {
					if(response.Respuesta)
					{
						jQuery.gritter.add({
							title: 'Exito!',
							text: response.Mensaje,
							class_name: 'growl-success',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
					}else{
						jQuery.gritter.add({
							title: 'Ha ocurrido un error!',
							text: response.Mensaje,
							class_name: 'growl-danger',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
					}
				},
				complete : function(){
					unBlockUI();
				}
			});
		}
	})
</script>