<?php
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
?>
<form action="forms/dteRecibidos/carga_archivo.php" method="post" enctype="multipart/form-data">
	<div class="panel panel-dark">
		<div class="panel-heading">

			<h4 class="panel-title">CARGAR DTE RECIBIDO</h4>
			<p>Esta opcion permite cargar el contenido de un archivo XML para dar el la aprobacion comercial y acuse de recibo de los bienes y/o servicios</p>
		</div><!-- panel-heading -->
		<div class="panel-body">

			<!-- CONTENIDO -->
			<div class="form-group">
				<label class="col-sm-3 control-label">Archivo XML <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="file" name="archivo" id="archivo" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Tipo de Carga <span class="asterisk">*</span></label>
				<div class="col-sm-9">
				<select name="tipo_carga" id="tipo_carga" class="form-control" required>
						<option value="" selected>Seleccionar...</option>
						<option value="0">NORMAL</option>
						<option value="1">XML DE SII</option>
					</select>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5">CARGAR</button>
				</div>
			</div>

		</div>
	</div>
<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
</form>