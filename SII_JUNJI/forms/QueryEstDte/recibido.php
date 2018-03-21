<?php
$getClientes = getClientesGlobal();
$getDocumentos = getDocumentos();
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
$getEmpresa = getEmpresa($regionSession);
?>

<form class="form-horizontal" id="frmConsulta">
	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">DETALLE DEL DOCUMENTO RECIBIDO</h4>
			<p>El objetivo de este servicio es informar el Estado de un DTE.</p>
		</div>

		<div class="panel-body">

			<div class="form-group">
				<label class="col-sm-3 control-label">CLIENTE <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="receptor_id" id="receptor_id" onChange="getClienteDetalle(this.value)" required>
						<option value="">Seleccionar...</option>
						<?php foreach ($getClientes as $key => $value): ?>
							<option value="<?php echo $value["cliente_rut"]."-".$value["cliente_dv"] ?>"><?php echo $value["cliente_empresa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="sii_tipo_dcto" id="sii_tipo_dcto">
						<option value="">Seleccionar...</option>
						<?php foreach ($getDocumentos as $key => $value): ?>
							<option value="<?php echo $value["dcto_codigo"] ?>" <?php if($dcto_codigo == $value["dcto_codigo"]){echo "selected";} ?>><?php echo $value["dcto_glosa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FOLIO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="dcto_folio" id="dcto_folio" value="<?php echo $dcto_folio ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FECHA EMISION <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<!-- <input type="text" class="form-control" value="<?php echo $dcto_fecha_emision ?>" readonly> -->
					<div class="input-group">
						<span class="input-group-addon" id="eventoCalendario"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control"  name="dcto_fecha_emision" id="dcto_fecha_emision" readonly>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">MONTO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="dcto_monto" id="dcto_monto" value="<?php echo $dcto_monto ?>" />
				</div>
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="submit" class="btn btn-dark mr5">Consultar</button>
						<?php if ($id <> "" && is_numeric($id)): ?>
							<!-- <button type="button" class="btn btn-info mr5" onClick="verEstado(<?php echo $getEmpresa[1]["empresa_dv"] ?>,<?php echo $detalleDTE[1]["cliente_dv"] ?>,<?php echo $getEmpresa[1]["empresa_rut"] ?>,<?php echo $getEmpresa[1]["empresa_dv"] ?>,<?php echo $detalleDTE[1]["cliente_rut"] ?>,<?php echo $detalleDTE[1]["cliente_dv"] ?>,<?php echo $detalleDTE[1]["dcto_codigo"] ?>,<?php echo $detalleDTE[1]["dte_folio"] ?>,<?php echo $fecha ?>,<?php echo $detalleDTE[1]["dte_total"] ?>)">S.I.I.</button> -->
						<?php endif ?>
					</div>
				</div>
			</div>

		</div>

	</div>
	<!-- ACCION QUE SE DESEA REALIZAR -->
	<input type="hidden" name="command" value="QueryEstDte">
	<!-- RUT PERSONA QUE REALIZA LA CONSULTA AL S.I.I. -->
	<input type="hidden" name="consultante_rut" id="consultante_rut" value="<?php echo $rut[0] ?>">
	<input type="hidden" name="consultante_dv" id="consultante_dv" value="<?php echo $rut[1] ?>">
	<!-- RUT EMPRESA EMISORA DEL DOCUMENTO -->
	<input type="hidden" name="rutEmisor" id="rutEmisor">
	<input type="hidden" name="dvEmisor" id="dvEmisor">
	<!-- RUT EMPRESA RECEPTORA DEL DOCUMENTO -->
	<input type="hidden" name="receptor_rut" id="receptor_rut" value="<?php echo $getEmpresa[1]["empresa_rut"]?>">
	<input type="hidden" name="receptor_dv" id="receptor_dv" value="<?php echo $getEmpresa[1]["empresa_dv"]?>">
</form>


<script type="text/javascript">
	function getClienteDetalle(input)
	{
		var rut = input.split("-");
		$("#rutEmisor").val(rut[0]);
		$("#dvEmisor").val(rut[1]);
	}

	$("#frmConsulta").validate({
		rules : {
			receptor_id : {required : true},
			sii_tipo_dcto : { required : true},
			dcto_folio : { required : true},
			dcto_fecha_emision : { required : true},
			dcto_monto : { required : true}
			
		},
		submitHandler : function ( form ) {
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.consulta.php",
				data:data,
				dataType:"JSON",
				beforeSend : function()
				{
					blockUI();
				},
				success : function ( response ) {

					var rutConsulta = $("#consultante_rut").val();
					var dvConsulta  = $("#consultante_dv").val();
					var rutQuery    = $("#rutEmisor").val();
					var dvQuery     = $("#dvEmisor").val();
					var tipoDTE     = $("#sii_tipo_dcto").val();
					var folioDTE    = $("#dcto_folio").val();
					var _url        = 'https://palena.sii.cl/cgi_dte/UPL/QValidaDTE?rutConsulta='+rutConsulta+'&dvConsulta='+dvConsulta+'&rutQuery='+rutQuery+'&dvQuery='+dvQuery+'&tipoDTE='+tipoDTE+'&folioDTE='+folioDTE;
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
						// window.open(_url,null,"height=500,width=800,status=yes,toolbar=no,menubar=no,location=no");
						// setTimeout(function(){
						// 	window.location.href='?pagina=factura&ori=ver';
						// },1500);
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
				complete : function()
				{
					unBlockUI();
				}
			});
		}
	});
</script>