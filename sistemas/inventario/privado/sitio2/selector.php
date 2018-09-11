<?php session_start() ?>
<style type="text/css">
	.centrado{
		padding: 0;
		margin: 0;
		display: flex;
		align-items: center;
		justify-content: center;
		min-height: 100vh;
	}
</style>

<div class="centrado">
	<table border="0">
		<!-- SI ES DE INVENTARIO Y LOGISTICA (DIRECCION NACIONAL)-->
		<?php if ($_SESSION["pfl_user"] == 50): ?>
			<tr>
				<td>
					<form action="inicio.php" method="POST">
						<input type="image" src="Inventario.png" name="perfil" value="35" height="170px">
					</form>
				</td>

				<td>
					<form action="inicio.php" method="POST">
						<input type="image" src="Logistica.png" name="perfil" value="37" height="170px">
					</form>
				</td>
			</tr>
		<?php endif ?>
		
		<!-- SI ES DE INVENTARIO Y LOGISTICA (REGIONES)-->
		<?php if ($_SESSION["pfl_user"] == 48): ?>
			<tr>
				<td>
					<form action="inicio.php" method="POST">
						<input type="image" src="Inventario.png" name="perfil" value="38" height="170px">
					</form>
				</td>

				<td>
					<form action="inicio.php" method="POST">
						<input type="image" src="Logistica.png" name="perfil" value="39" height="170px">
					</form>
				</td>
			</tr>
		<?php endif ?>
	</table>
</div>