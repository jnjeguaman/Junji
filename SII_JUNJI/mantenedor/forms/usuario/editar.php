<?php
extract($_GET);
$detalleUsuario = getDetalleUsuario($id);
$region = getRegiones2();
?>
<?php if (count($detalleUsuario) === 1): ?>
	<?php $autorizaciones = getAutorizaciones($detalleUsuario[1]["usuario_rut"]) ?>
	<div class="row">
		<div class="col-md-6">
			<form id="frmUsuario" class="form-horizontal">
				<div class="panel panel-dark">
					<div class="panel-heading">
						<h4 class="panel-title">EDITAR PERFIL</h4>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<label class="col-sm-3 control-label">NOMBRE <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" value="<?php echo $detalleUsuario[1]["usuario_nombre"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">APELLIDO PATERNO<span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usuario_apellido_paterno" name="usuario_apellido_paterno" value="<?php echo $detalleUsuario[1]["usuario_apellido_paterno"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">APELLIDO MATERNO<span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usuario_apellido_materno" name="usuario_apellido_materno" value="<?php echo $detalleUsuario[1]["usuario_apellido_materno"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">RUT <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usuario_rut" name="usuario_rut" value="<?php echo $detalleUsuario[1]["usuario_rut"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">DV <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usuario_dv" name="usuario_dv" value="<?php echo $detalleUsuario[1]["usuario_dv"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">ESTADO <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<select name="usuario_estado" id="usuario_estado" class="form-control">
									<option value="">Seleccionar...</option>
									<option value="1" <?php if($detalleUsuario[1]["usuario_estado"] == 1){echo"selected";} ?> >ACTIVO</option>
									<option value="0" <?php if($detalleUsuario[1]["usuario_estado"] == 0){echo"selected";} ?> >INACTIVO</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">REGION <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<!-- <input type="text" class="form-control" id="usuario_region" name="usuario_region" value="<?php echo $detalleUsuario[1]["usuario_region"] ?>"> -->
								<select class="form-control" id="usuario_region" name="usuario_region">
									<option value="">Seleccionar...</option>
									<?php foreach ($region as $key => $value): ?>
										<option value="<?php echo $value["codigo"] ?>" <?php if($value["codigo"] == $detalleUsuario[1]["usuario_region"]){echo"selected";} ?> ><?php echo $value["nombre"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group">
				<label for="" class="col-sm-3 control-label">USUARIO INEDIS</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="usuario_inedis" name="usuario_inedis" value="<?php echo $detalleUsuario[1]["usuario_user"] ?>">
					<p class="text-warning">COMPLETAR SÓLO SI EL USUARIO ES PARA INEDIS</p>
				</div>
			</div>

					</div>

					<div class="panel-footer">
						<div class="row">
							<div class="col-sm-9 col-sm-offset-3">
								<button class="btn btn-dark mr5">ACTUALIZAR <i class="fa fa-refresh"></i></button>
							</div>
						</div>
					</div>

				</div>
				<input type="hidden" name="cmd" value="actualizarUsuario">
				<input type="hidden" name="usuario_id" value="<?php echo $detalleUsuario[1]["usuario_id"] ?>">
			</form>
		</div>

		<div class="col-md-6">
			<div class="panel panel-dark">
				<div class="panel-heading">
					<h4 class="panel-title">CAMBIO DE CONTRASEÑA</h4>
				</div>
				
				<form id="frmPassword" class="form-horizontal">
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">CONTRASEÑA <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="usuario_password" name="usuario_password">
							</div>
						</div>


					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-sm-9 col-sm-offset-3">
								<button class="btn btn-dark mr5">ACTUALIZAR <i class="fa fa-refresh"></i></button>
							</div>
						</div>
					</div>
					<input type="hidden" name="usuario_id" value="<?php echo $detalleUsuario[1]["usuario_id"] ?>">
					<input type="hidden" name="cmd" value="actualizarPassword">
				</form>
			</div>
		</div>

		<div class="col-md-6">
			<form id="frmCertificado" class="form-horizontal">
				<div class="panel panel-dark">
					<div class="panel-heading">
						<h4 class="panel-title">CAMBIO DE CERTIFICADO</h4>
					</div>

					<div class="panel-body">

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

					</div>

					<div class="panel-footer">
						<div class="row">
							<div class="col-sm-9 col-sm-offset-3">
								<button class="btn btn-dark mr5">ACTUALIZAR <i class="fa fa-refresh"></i></button>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" class="form-control" id="usuario_rut" name="usuario_rut" value="<?php echo $detalleUsuario[1]["usuario_rut"] ?>">
					<input type="hidden" class="form-control" id="usuario_dv" name="usuario_dv" value="<?php echo $detalleUsuario[1]["usuario_dv"] ?>">
				<input type="hidden" name="usuario_id" value="<?php echo $detalleUsuario[1]["usuario_id"] ?>">
				<input type="hidden" name="cmd" value="actualizarCertificado">
				<input type="hidden" name="usuario_region" value="<?php echo $detalleUsuario[1]["usuario_region"] ?>">
			</form>
		</form>
	</div>

	<div class="col-md-6">

		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">ESTADO FIRMAR DTE</h4>
			</div>

			<div class="panel-body">
				<form id="frmAutorizacionEstado" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-7 control-label">HABILITADO PARA FIRMAR</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_estado" id="autorizado_estado" <?php if($detalleUsuario[1]["usuario_autorizado_firmar"] == 1){echo "checked";} ?> onChange="actualizarAutorizacionEstado(<?php echo $detalleUsuario[1]["usuario_id"] ?>,this.value)" value="1"> SI 
							<input type="radio" name="autorizado_estado" id="autorizado_estado" <?php if($detalleUsuario[1]["usuario_autorizado_firmar"] == ""){echo "checked";} ?> onChange="actualizarAutorizacionEstado(<?php echo $detalleUsuario[1]["usuario_id"] ?>,this.value)" value="0"> NO 
						</div>
					</div>

					<input type="hidden" name="usuario_id" value="<?php echo $detalleUsuario[1]["usuario_id"] ?>">
					<input type="hidden" name="cmd" value="actualizarCertificado">
				</form>
			</form>
		</div>
	</div>	
	<?php if ($detalleUsuario[1]["usuario_autorizado_firmar"]): ?>

		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">DTE AUTORIZADOS A EMITIR</h4>
			</div>
			<div class="panel-body">
				<form id="frmUsuario" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-7 control-label">FACTURA ELECTRÓNICA</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_33" id="autorizado_33" <?php if($detalleUsuario[1]["usuario_autorizado_33"] == 1){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,33,this.value)" value="1"> SI 
							<input type="radio" name="autorizado_33" id="autorizado_33" <?php if($detalleUsuario[1]["usuario_autorizado_33"] == ""){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,33,this.value)" value="0"> NO 
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-7 control-label">FACTURA NO AFECTA O EXENTA ELECTRÓNICA</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_34" id="autorizado_34" <?php if($detalleUsuario[1]["usuario_autorizado_34"] == 1){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,34,this.value)" value="1"> SI 
							<input type="radio" name="autorizado_34" id="autorizado_34" <?php if($detalleUsuario[1]["usuario_autorizado_34"] == ""){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,34,this.value)" value="0"> NO 
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-7 control-label">GUÍA DE DESPACHO ELECTRÓNICA</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_52" id="autorizado_52" <?php if($detalleUsuario[1]["usuario_autorizado_52"] == 1){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,52,this.value)" value="1"> SI 
							<input type="radio" name="autorizado_52" id="autorizado_52" <?php if($detalleUsuario[1]["usuario_autorizado_52"] == ""){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,52,this.value)" value="0"> NO 
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-7 control-label">NOTA DE DÉBITO ELECTRÓNICA</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_56" id="autorizado_56" <?php if($detalleUsuario[1]["usuario_autorizado_56"] == 1){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,56,this.value)" value="1"> SI 
							<input type="radio" name="autorizado_56" id="autorizado_56" <?php if($detalleUsuario[1]["usuario_autorizado_56"] == ""){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,56,this.value)" value="0"> NO 
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-7 control-label">NOTA DE CRÉDITO ELECTRÓNICA</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_61" id="autorizado_61" <?php if($detalleUsuario[1]["usuario_autorizado_61"] == 1){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,61,this.value)" value="1"> SI 
							<input type="radio" name="autorizado_61" id="autorizado_61" <?php if($detalleUsuario[1]["usuario_autorizado_61"] == ""){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,61,this.value)" value="0"> NO 
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-7 control-label">LIBRO DE VENTA ELECTRÓNICA</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_libro_venta" id="autorizado_libro_venta" <?php if($detalleUsuario[1]["usuario_autorizado_libro_venta"] == 1){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,'libro_venta',this.value)" value="1"> SI 
							<input type="radio" name="autorizado_libro_venta" id="autorizado_libro_venta" <?php if($detalleUsuario[1]["usuario_autorizado_libro_venta"] == ""){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,'libro_venta',this.value)" value="0"> NO 
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-7 control-label">LIBRO DE COMPRA ELECTRÓNICA</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_libro_compra" id="autorizado_libro_compra" <?php if($detalleUsuario[1]["usuario_autorizado_libro_compra"] == 1){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,'libro_compra',this.value)" value="1"> SI 
							<input type="radio" name="autorizado_libro_compra" id="autorizado_libro_compra" <?php if($detalleUsuario[1]["usuario_autorizado_libro_compra"] == ""){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,'libro_compra',this.value)" value="0"> NO 
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-7 control-label">LIBRO DE GUÍA ELECTRÓNICA</label>
						<div class="col-sm-3 control-label">
							<input type="radio" name="autorizado_libro_guia" id="autorizado_libro_guia" <?php if($detalleUsuario[1]["usuario_autorizado_libro_guia"] == 1){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,'libro_guia',this.value)" value="1"> SI 
							<input type="radio" name="autorizado_libro_guia" id="autorizado_libro_guia" <?php if($detalleUsuario[1]["usuario_autorizado_libro_guia"] == ""){echo "checked";} ?> onChange="actualizarAutorizacion(<?php echo $detalleUsuario[1]["usuario_id"] ?>,'libro_guia',this.value)" value="0"> NO 
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>	
<?php endif ?>
</div>
</div>
<?php endif ?>

<script type="text/javascript">

	$("#frmPassword").validate({
		rules : {
			usuario_password : {required : true}
		},
		submitHandler : function (form)
		{
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.usuario.php",
				data:data,
				dataType:"JSON",
				beforeSend : function (){
					blockUI();
				},
				success : function ( response ) {
				// console.log(response);
				if(response)
				{
					jQuery.gritter.add({
						title: 'Exito!',
						text: response.Mensaje,
						class_name: 'growl-success',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
					setTimeout(function(){
						window.location.reload();
					},1500);
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
	});

	$('#usuario_rut').Rut({
		digito_verificador: '#usuario_dv',
		on_error: function(){ alert('Rut incorrecto');
		$("#usuario_rut").val("");
		$("#usuario_dv").val("");
		document.getElementById('usuario_rut').focus();}
	});

	$("#frmCertificado").validate({
		rules : {
			usuario_certificado : { required:true},
			usuario_certificado_password : {required:true}
		},
		submitHandler : function(form){
			var data = new FormData(form);
			$.ajax({
				type:"POST",
				url:"includes/functions.usuario.php",
				data:data,
				dataType:"JSON",
				mimeType: 'multipart/form-data',
				contentType: false,
				cache: false,
				processData:false,
				success : function ( response ) {
					console.log(response);
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
	
	$("#frmUsuario").validate({
		rules : {
			usuario_nombre : { required : true},
			usuario_apellido_paterno : { required : true},
			usuario_apellido_materno : { required : true},
			usuario_rut : { required : true},
			usuario_dv : { required : true},
			usuario_estado : { required : true},
		},
		submitHandler : function (form)
		{
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.usuario.php",
				data:data,
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
						setTimeout(function(){
							window.location.reload();
						},1500);
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

	function actualizarAutorizacion(usuario_id,tipo,estado)
	{
		var data = ({cmd : "actualizarAutorizacion",usuario_id : usuario_id,autorizado_tipo : tipo,estado : estado});
		$.ajax({
			type:"POST",
			url:"includes/functions.autorizacion.php",
			data:data,
			dataType:"JSON",
			beforeSend : function ()
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
                        //  window.location.href='?pagina=factura&ori=ver';
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
                complete : function (){
                	unBlockUI();
                }
            });
	}

	function actualizarAutorizacionEstado(usuario_id,estado)
	{
		var data = ({cmd : "actualizarAutorizacionEstado",usuario_id : usuario_id,estado : estado});
		$.ajax({
			type:"POST",
			url:"includes/functions.autorizacion.php",
			data:data,
			dataType:"JSON",
			beforeSend : function ()
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
					setTimeout(function(){
						window.location.reload();
					},1500);
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
			complete : function (){
				unBlockUI();
			}
		});
	}
</script>