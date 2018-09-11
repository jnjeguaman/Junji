<?php
require_once("inc/config.php");
extract($_GET);
extract($_SESSION);
if(isset($cmd))
{
	$require = htmlspecialchars($cmd);
	$require = htmlentities($require);
	switch ($require) {
		case 'Aprobaciones':
		$require = "bode_aprobaciones";
		break;

		case 'Rechazos':
		$require = "bode_rechazos";
		break;

		case 'Altas':
		$require = "bode_altas";
		break;

		case 'Contenedores':
		$require = "bode_contenedor";
		break;

		case 'Bajas':
		$require = "bode_bajas";
		break;

		case 'Ajustes':
		$require = "bode_ajustes";
		break;

		case 'Solicitudes':
			$require = "bode_solicitud";
		break;

		case 'WMS':
			$require = "bode_wms";
			break;

		default:
			# code...
		break;
	}
}else{
	$require = "404";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>

</head>

<body>
	<div style="background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<div style="width:100%;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
		<table border="0" align="center" cellpadding="0" cellspacing="0" >
			<tr>
					
					<?php if($_SESSION["Acceso"]["acc_ap"] == 1): ?>
					<td ><a href="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=Aprobaciones" class="button" id="Aprobaciones">Aprobaciones</a></td>
					<?php endif ?>	

					<?php if($_SESSION["Acceso"]["acc_re"] == 1): ?>
					<td ><a href="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=Rechazos" class="button" id="Rechazos">Rechazos</a></td>
					<?php endif ?>	

					<?php if($_SESSION["Acceso"]["acc_alt"] == 1): ?>
					<td ><a href="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=Altas" class="button" id="Altas">Altas</a></td>
					<?php endif ?>	

					<?php if($_SESSION["Acceso"]["acc_ba"] == 1): ?>
					<td ><a href="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=Bajas&ori=1" class="button" id="Bajas">Bajas</a></td>
					<?php endif ?>	

					<?php if($_SESSION["Acceso"]["acc_aju"] == 1): ?>
					<td ><a href="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=Ajustes" class="button" id="Ajustes">Ajustes</a></td>
					<?php endif ?>	

					<?php if($_SESSION["Acceso"]["acc_cont"] == 1): ?>
					<td><a href="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=Contenedores" class="button" id="Contenedores">Contenedores</a></td>
					<?php endif ?>	

					<td><a href="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=Solicitudes" class="button" id="Solicitudes">Solicitud de Pedido</a></td>
						<?php if ($_SESSION["nom_user"] == "pcastaneda" || $_SESSION["nom_user"] == "mzamora" || $_SESSION["nom_user"] == "mjgutierrez"  || $_SESSION["nom_user"] == "clobos" || $_SESSION["nom_user"] == "rfpacheco" || $_SESSION["nom_user"] == "shmoya" || $_SESSION["nom_user"] == "vanriquez" || $_SESSION["nom_user"] == "msalazar" || $_SESSION["nom_user"] == "yduran" || $_SESSION["nom_user"] == "INEDIS"): ?>
							<td><a href="<?php echo $_SERVER["PHP_SELF"] ?>?cmd=WMS" class="button" id="WMS">WMS</a></td>
						<?php endif ?>
			</tr>
		</table>
		<hr>
	</div>
	<?php require_once($require.".php") ?>

	<script type="text/javascript">
		$(function(){
			var url = "#<?php echo $cmd ?>";
			$(url).addClass("menu_junji");
		})
	</script>
</body>
</html>
