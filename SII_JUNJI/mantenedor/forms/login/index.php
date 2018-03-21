<body class="signin">
	<section>

		<div class="panel panel-signin">
			<div class="panel-body">
				<div class="logo text-center">
					<img src="images/logo.png" alt="SIGEJUN" >
				</div>
				<br />
				<!-- <h4 class="text-center mb5">Already a Member?</h4> -->
				<!-- <p class="text-center">Sign in to your account</p> -->

				<div class="mb30"></div>

				<form id="frmLogin">
					<div class="input-group mb15">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="usuario_rut" id="usuario_rut" class="form-control" placeholder="Username" value="16473220">
					</div><!-- input-group -->
					<div class="input-group mb15">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="usuario_password" id="usuario_password" class="form-control" placeholder="Password" value="123">
					</div><!-- input-group -->

					<div class="clearfix">
						<!-- <div class="pull-left">
							<div class="ckbox ckbox-primary mt10">
								<input type="checkbox" id="rememberMe" value="1">
								<label for="rememberMe">Remember Me</label>
							</div>
						</div> -->
						<div class="pull-right">
							<button type="submit" class="btn btn-success">Entrar <i class="fa fa-angle-right ml5"></i></button>
						</div>
					</div>
					<input type="hidden" name="cmd" value="login">
				</form>

			</div>
			<!-- <div class="panel-footer">
				<a href="signup" class="btn btn-primary btn-block">Not yet a Member? Create Account Now</a>
			</div> -->
		</div><!-- panel -->

	</section>
</body>

<script type="text/javascript">
	$("#frmLogin").validate({
		rules : {
			usuario_rut : { required : true},
			usuario_password : { required : true}
		},

		submitHandler : function (form)
		{
			var data = $(form).serializeArray();
			console.log(data);

			$.ajax({
				type:"POST",
				url:"includes/functions.login.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
				if(response.Respuesta == true)
				{
					alert(response.Mensaje);
					window.location.reload();
				}else{
					alert(response.Mensaje);
					return false;
				}
				}
			});

		}

	});
</script>