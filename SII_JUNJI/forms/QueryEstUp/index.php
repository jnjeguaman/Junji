<?php
extract($_GET);
require_once("includes/functions.empresa.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.cliente.php");
if($tipo == "dte")
{	
	$detalleDTE = getDetalleDTE($id);
}

$regionSession = $_SESSION["sii"]["usuario_region"];
$getEmpresa = getEmpresa($regionSession);
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
$proveedoresGlobal = array();
$proveedores = getClientesGlobal();
$tmp_proveedores = array();

$mis_clientes = getMisClientes();
$tmp_mis_clientes = array();

foreach ($proveedores as $key => $value) {
	$tmp_proveedores[] = [
	"Rut" =>  $value["cliente_rut"],
	"Dv" =>   $value["cliente_dv"],
	"Proveedor" => $value["cliente_empresa"]
	];
}

foreach ($mis_clientes as $key => $value) {
	$tmp_mis_clientes[] = [
	"Rut" =>  $value["cliente_rut"],
	"Dv" =>   $value["cliente_dv"],
	"Proveedor" => $value["cliente_empresa"]
	];
}
$proveedoresGlobal = array_merge($tmp_mis_clientes,$tmp_proveedores);
?>

<?php if ($id <> "" && $tipo == "dte"): ?>
	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">DETALLE DEL DOCUMENTO</h4>
			<p>
				Tipo de Documento : (<?php echo $detalleDTE[1]["dcto_codigo"] ?>) <?php echo $detalleDTE[1]["dcto_glosa"] ?>
				<br>Folio : <?php echo $detalleDTE[1]["dte_folio"] ?>
				<br>Fecha de Emision : <?php echo substr($detalleDTE[1]["dte_fecha"], 8,2)."-".substr($detalleDTE[1]["dte_fecha"], 5,2)."-".substr($detalleDTE[1]["dte_fecha"], 0,4) ?>
			</p>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">CLIENTE</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="<?php echo $detalleDTE[1]["cliente_empresa"] ?>" disabled>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">NETO</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="$<?php echo number_format($detalleDTE[1]["dte_neto"],0,".",".") ?>" disabled>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">IVA</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="$<?php echo number_format($detalleDTE[1]["dte_iva"],0,".",".") ?>" disabled>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">EXENTO</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="$<?php echo number_format($detalleDTE[1]["dte_exento"],0,".",".") ?>" disabled>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">TOTAL</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" value="$<?php echo number_format($detalleDTE[1]["dte_total"],0,".",".") ?>" disabled>
				</div>
			</div>
		</div>
	</div>

<?php endif ?>

<form class="form-horizontal" id="frmConsulta">

	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
			</div>
			<h4 class="panel-title">CONSULTA ESTADO UPLOAD</h4>
			<p>El objetivo de este servicio es informar el Estado de un archivo DTE, enviado mediante Upload</p>

		</div>
		<div class="panel-body">

			<?php if ($id == ""): ?>
				<div class="form-group">
				<label class="col-sm-3 control-label">CLIENTE <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="receptor_id" id="receptor_id" onChange="getClienteDetalle(this.value)" required>
						<option value="">Seleccionar...</option>
						<?php foreach ($proveedoresGlobal as $key => $value): ?>
							<option value="<?php echo $value["Rut"]."-".$value["Dv"] ?>"><?php echo $value["Proveedor"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<?php endif ?>

			<input type="hidden" class="form-control" name="consultante_rut" id="consultante_rut" value="<?php echo $rut[0] ?>" />
			<input type="hidden" class="form-control" name="consultante_dv" id="consultante_dv" value="<?php echo $rut[1] ?>" />
			<div class="form-group">
				<label class="col-sm-3 control-label">TRACK ID <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="consulta_trackid" id="consulta_trackid" value="<?php echo ($detalleDTE[1]["dte_tracking"] <> '') ? $detalleDTE[1]["dte_tracking"] : $_GET["tracking"] ?>" />
				</div>
			</div>

			<input type="hidden" name="command" value="QueryEstUp">
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-dark mr5">Consultar</button>
				</div>
			</div>
		</div>

	</div>
	<input type="hidden" name="tipo" value="<?php echo $tipo ?>">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<input type="hidden" name="receptor_rut" id="receptor_rut" value="<?php echo $getEmpresa[1]["empresa_rut"] ?>">
	<input type="hidden" name="receptor_dv" id="receptor_dv" value="<?php echo $getEmpresa[1]["empresa_dv"] ?>">
	
</form>

<script type="text/javascript">
	$(function(){
		$(".alert-info").hide();
	})
	$("#frmConsulta").validate({
		rules : {
			dcto_trackid : { required : true}
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

	function getClienteDetalle(input)
	{
		var rut = input.split('-');
		console.log(rut);
		$("#receptor_rut").val(rut[0]);
		$("#receptor_dv").val(rut[1]);
	}
</script>