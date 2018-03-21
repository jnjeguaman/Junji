<?php
$regiones = getRegiones2();
?>
<form id="frmUsuario" class="form-horizontal">
	<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">AGREGAR USUARIOS</h4>
		</div>
		<div class="panel-body">

			<div class="form-group">
				<label class="col-sm-3 control-label">NOMBRE <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">APELLIDO PATERNO<span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="usuario_apellido_paterno" name="usuario_apellido_paterno">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">APELLIDO MATERNO<span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="usuario_apellido_materno" name="usuario_apellido_materno">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RUT <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="usuario_rut" name="usuario_rut">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">DV <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="usuario_dv" name="usuario_dv">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">ESTADO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="usuario_estado" id="usuario_estado" class="form-control">
						<option value="">Seleccionar...</option>
						<option value="1">ACTIVO</option>
						<option value="0">INACTIVO</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label">REGION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="usuario_region" id="usuario_region">
						<option value="" selected>Seleccionar...</option>
						<?php foreach ($regiones as $key => $value): ?>
							<option value="<?php echo $value["codigo"] ?>"><?php echo $value["nombre"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">SISTEMA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="usuario_sistema" id="usuario_sistema" required>
						<option value="" selected>Seleccionar...</option>
						<option value="1">FACTURA ELECTRÓNICA</option>
						<option value="2">INEDIS - LOGÍSTICA</option>
						<option value="3">INEDIS - INVENTARIO</option>
						<option value="4">INVENTARIO + LOGISTICA</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">CONTRASEÑA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="usuario_password" name="usuario_password">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">REPETIR CONTRASEÑA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="usuario_password2" name="usuario_password2">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">GENERAR CONTRASEÑA</label>
				<div class="col-sm-4">
					<a href="#" class="link-password btn btn-primary btn-sm" id="generate">Generar</a>
					<a href="#" class="link-password btn btn-danger btn-sm" id="confirm">Usar</a>
					<input readonly type="text" class="form-control" id="random" name="random">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="col-sm-3 control-label">CERTIFICADO DIGITAL</label>
				<div class="col-sm-9">
					<input type="file" class="form-control" id="usuario_certificado" name="usuario_certificado">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="col-sm-3 control-label">CONTRASEÑA CERTIFICADO DIGITAL</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="usuario_certificado_password" name="usuario_certificado_password">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="col-sm-3 control-label">USUARIO INEDIS</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="usuario_inedis" name="usuario_inedis" placeholder="Mismo usuario con que se conecta al sistema INEDIS">
					<p class="text-warning">COMPLETAR SÓLO SI EL USUARIO ES PARA INEDIS</p>
				</div>
			</div>


		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5">CREAR <i class="fa fa-plus"></i></button>
				</div>
			</div>
		</div>

	</div>
	<input type="hidden" name="cmd" value="crearUsuario">
</form>	

<script type="text/javascript">

	$('#usuario_rut').Rut({
		digito_verificador: '#usuario_dv',
		on_error: function(){ alert('Rut incorrecto');
		$("#usuario_rut").val("");
		$("#usuario_dv").val("");
		document.getElementById('usuario_rut').focus();}
	});


	$.extend({
		password: function (length, special) {
			var iteration = 0;
			var password = "";
			var randomNumber;
			if(special == undefined){
				var special = false;
			}
			while(iteration < length){
				randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
				if(!special){
					if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
					if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
					if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
					if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
				}
				iteration++;
				password += String.fromCharCode(randomNumber);
			}
			return password;
		}
	});

	$('.link-password').click(function(e){
		linkId = $(this).attr('id');
		if (linkId == 'generate'){
			password = $.password(12,true);
				//$('#random').empty().hide().append(password).fadeIn('slow');
				$("#random").val(password).fadeIn("slow");
				$('#confirm').fadeIn('slow');
			} else {
				$('#usuario_password').val(password);
				$('#usuario_password2').val(password);
				$('#random').empty();
				$(this).hide();
			}
			e.preventDefault();
		});


	$("#frmUsuario").validate({
		rules : {
			usuario_nombre : { required : true},
			usuario_apellido_paterno : { required : true},
			usuario_apellido_materno : { required : true},
			usuario_rut : { required : true},
			usuario_dv : { required : true},
			usuario_estado : { required : true},
			usuario_region : { required : true},
			usuario_password : { required : true},
			usuario_password2: {equalTo : "#usuario_password"},
			usuario_certificado : { required : true},
			usuario_certificado_password : { required : true}
		},
		submitHandler : function (form)
		{
			// var data = $(form).serializeArray();
			var data = new FormData(form);
			console.log(data);
			$.ajax({
				type:"POST",
				url:"includes/functions.usuario.php",
				data:data,
				mimeType: 'multipart/form-data',
				contentType: false,
				cache: false,
				processData:false,
				dataType:"JSON",
				
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
				}
			});
		}
	})
</script>