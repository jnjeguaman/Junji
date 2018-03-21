<link href="../../css/style.default.css" rel="stylesheet">
<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/jquery.validate.min.js"></script>
<!-- MODAL TIPO DE ANULACION GUIA DE DESPACHO -->
<form class="form-horizontal" id="frmAnulacion">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">ESTADO DE ANULACIÓN DE LA GUIA DE DESPACHO</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">ESTADO <span class="asterisk">*</span></label>
					<div class="col-sm-6">
						<select class="form-control" name="dte_gd_tipo_anulacion" id="dte_gd_tipo_anulacion">
							<option value="" selected>Seleccionar...</option>
							<option value="1">Anulado Previo a su Envio al SII</option>
							<option value="2">Anulado Posterior a su Envio al SII</option>
							<option value="3">Productos Recibidos Parcialmente</option>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-dark">Anular</button>
			</div>
		</div>
	</div>
	<input type="hidden" name="dte_id" id="dte_id">
</form>

<!-- FIN MODAL -->

<script type="text/javascript">
	$("#frmAnulacion").validate({
        rules : {
            dte_gd_tipo_anulacion : { required : true}
        },
        submitHandler : function (form){
            var data = $(form).serializeArray();
            console.log(data);
            return false;
        }
    });
</script>