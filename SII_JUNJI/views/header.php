<?php 
$usuario_id = $_SESSION["sii"]["usuario_id"];
$regionSession = $_SESSION["sii"]["usuario_region"];
?>
<header>
	<div class="headerwrapper">
		<div class="header-left">
			<a href="./" class="logo">
				<img src="images/logo.png" alt="SIGEJUN" style="height: 40px;"/> 
			</a>
			<div class="pull-right">
				<a href="" class="menu-collapse">
					<i class="fa fa-bars"></i>
				</a>
			</div>
		</div>

		<div class="header-right">
			<div class="pull-right">
				<div class="btn-group btn-group-option">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-caret-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li><a href="?pagina=perfil&id=<?php echo $usuario_id ?>"><i class="glyphicon glyphicon-user"></i> Mi Perfil</a></li>
						<!-- <li><a href="?pagina=empresa&region=<?php echo $regionSession ?>"><i class="glyphicon glyphicon-star"></i> Empresa</a></li> -->
						<!-- <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li> -->
						<!-- <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li> -->
						<li class="divider"></li>
						<li><a href="salir.php"><i class="glyphicon glyphicon-log-out"></i>Salir</a></li>
					</ul>
				</div>

			</div>

		</div>

	</div>
</header>