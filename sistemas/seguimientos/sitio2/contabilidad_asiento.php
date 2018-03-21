<?
session_start();
extract($_POST);
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];

if($regionsession == 14)
{
	$regionsession = 16;
}else if($regionsession == 16)
{
	$regionsession = 14;
}else{
	$regionsession = $_SESSION["region"];
}
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("Y-m-d");

// 
$sql = "SELECT DISTINCT(CONCAT(cuenta_item,'.',cuenta_subitem,'.',cuenta_asignacion)) AS item_presupuestario FROM compra_cuentas WHERE cuenta_subitem <> '' AND cuenta_asignacion <> ''";
$res = mysql_query($sql);
$itemPresupuestario = array();

$sql2 = "SELECT * FROM regiones";
$res2 = mysql_query($sql2);
while($row = mysql_fetch_array($res))
{
	$itemPresupuestario[] = $row;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>SIGEJUN</title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
	}
	.Estilo1 {
		font-family: Verdana;
		font-weight: bold;
		font-size: 10px;
		color: #003063;
		text-align: left;
	}
	.Estilo1b {
		font-family: Verdana;
		font-weight: bold;
		font-size: 8px;
		color: #003063;
		text-align: left;
	}
	.Estilo1c {
		font-family: Verdana;
		font-weight: bold;
		font-size: 8px;
		color: #003063;
		text-align: right;
	}
	.Estilo2 {
		font-family: Verdana;
		font-size: 10px;
		text-align: left;
	}
	.Estilo2b {
		font-family: Verdana;
		font-size: 9px;
		text-align: left;
	}
	.link {
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		font-weight: bold;
		color: #00659C;
		text-decoration:none;
		text-transform:uppercase;
	}
	.link:over {
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #0000cc;
		text-decoration:none;
		text-transform:uppercase;
	}
	.Estilo4 {
		font-size: 10px;
		font-weight: bold;
	}
	.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif; 
		font-size: 15px; font-weight: bold; }
	</style>
	<body>
		<div class="navbar-nav ">
			<div class="container">
				<div class="navbar-header">
					<?
					require("inc/top.php");
					?>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-lg-2">
					<div class="dash-unit2">
						<?
						require("inc/menu_1.php");
						?>

					</div>
				</div>

				<div class="col-sm-10 col-lg-10">
					<div class="dash-unit2">
						<!-- CONTENIDO -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="20" colspan="2"><span class="Estilo7">ASIENTO CONTABLE</span>
									<br>
									<?php if ($_SESSION["pfl_user"] == 31): ?>
										<a href="menutesoreria.php?cod=124" class="link">Volver</a>
										<?php else: ?>
											<a href="menucontabilidad.php?cod=7" class="link">Volver</a>
									<?php endif ?>
								</td>
							</tr>
							<tr>
								<td><hr></td><td><hr></td>
							</tr>
						</table>	
						<form method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>"> 
							<table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr>
									<td class="Estilo1">Item Presupuestario</td>
									<td class="Estilo1">
										<select class="Estilo1" name="item" onChange="getCtaActivoGasto(this.value)" required>
											<option value="">Seleccionar...</option>
											<?php foreach ($itemPresupuestario as $key => $value): ?>
												<option value="<?php echo $value["item_presupuestario"] ?>" <?php if($value["item_presupuestario"] == $item){echo"selected";} ?>><?php echo $value["item_presupuestario"] ?></option>
											<?php endforeach ?>
											<option value="Resumen" <?php if($item == "Resumen"){echo"selected";}?>>Resumen General</option>
										</select>
									</td>
									<td rowspan="9" width="60%">
											<p id="cuentas" style="font-size: 0.8em;"></p>

									</td>
								</tr>

								<tr>
									<td colspan="2"><br></td>
								</tr>

								<?php if ($_SESSION["region"] == 14): ?>
									<tr>
									<td class="Estilo1">Region</td>
									<td class="Estilo1">
										<select name="region" id="region" class="Estilo1" required>
											<option value="" selected>Seleccionar...</option>
											<?php while($row2 = mysql_fetch_array($res2)) { ?>
											<option value="<?php echo $row2["codigo"] ?>" <?php if($region == $row2["codigo"]){echo"selected";}?>><?php echo $row2["nombre"] ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>

								<tr>
									<td colspan="2"><br></td>
								</tr>
							<?php else: ?>
								<input type="hidden" name="region" value="<?php echo $_SESSION["region"] ?>">
								<?php endif ?>

								<tr>
									<td class="Estilo1">Mes</td>
									<td class="Estilo1">
										<select name="mes" id="mes" class="Estilo1" required>
											<option value="" selected>Seleccionar...</option>
											<option value="1" <?php if($mes == 1){echo"selected";}?> >Enero</option>
											<option value="2" <?php if($mes == 2){echo"selected";}?> >Febrero</option>
											<option value="3" <?php if($mes == 3){echo"selected";}?> >Marzo</option>
											<option value="4" <?php if($mes == 4){echo"selected";}?> >Abril</option>
											<option value="5" <?php if($mes == 5){echo"selected";}?> >Mayo</option>
											<option value="6" <?php if($mes == 6){echo"selected";}?> >Junio</option>
											<option value="7" <?php if($mes == 7){echo"selected";}?> >Julio</option>
											<option value="8" <?php if($mes == 8){echo"selected";}?> >Agosto</option>
											<option value="9" <?php if($mes == 9){echo"selected";}?> >Septiembre</option>
											<option value="10" <?php if($mes == 10){echo"selected";}?> >Octubre</option>
											<option value="11" <?php if($mes == 11){echo"selected";}?> >Noviembre</option>
											<option value="12" <?php if($mes == 12){echo"selected";}?> >Diciembre</option>											
										</select>
									</td>
								</tr>

								<tr>
									<td colspan="2"><br></td>
								</tr>

								<tr>
									<td class="Estilo1">A&ntilde;o</td>
									<td class="Estilo1">
										<select name="annio" id="annio" class="Estilo1" required>
											<option value="" selected>Seleccionar...</option>
											<option value="2017" <?php if($annio == 2017){echo"selected";}?>>2017</option>
										</select>
									</td>
								</tr>

								<tr>
									<td colspan="2"><br></td>
								</tr>

								<tr>
									<td></td>
									<td><button class="btn btn-success btn-sm" type="submit">Buscar</button></td>
								</tr>


							</table>
							<input type="hidden" name="buscar" value="1">
						</form>
						<!-- FIN CONTENIDO -->

						<?php if ($buscar): ?>
							<?php require_once("contabilidad_asiento2.php") ?>
						<?php endif ?>

					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function getCtaActivoGasto(input)
			{
				// var data = ({cmd : "getCtaActivoGasto",imputacion : input});
				// $.ajax({
				// 	type:"POST",
				// 	url:"compra_obtener_cuentas.php",
				// 	data:data,
				// 	dataType:"JSON",
				// 	success : function ( response ) {
				// 		if(response[0] != '' || response[1] != ''){
				// 			var tabla='<table width="100%" border="0">';
				// 			tabla+='<tr>';
				// 			tabla+='<td class="Estilo1b" width="20%">DESCRIPCION</td>';
				// 			tabla+='<td class="Estilo1b" width="3%">:</td>';
				// 			tabla+='<td class="Estilo1b" width="80%">'+response[2]+'</td>';
				// 			tabla+='</tr>';

				// 			tabla+='<tr>';
				// 			tabla+='<td class="Estilo1b" width="20%">CUENTA ACTIVO</td>';
				// 			tabla+='<td class="Estilo1b" width="3%">:</td>';
				// 			tabla+='<td class="Estilo1b" width="80%">'+response[1]+'</td>';
				// 			tabla+='</tr>';

				// 			tabla+='<tr>';
				// 			tabla+='<td class="Estilo1b" width="20%">CUENTA GASTO</td>';
				// 			tabla+='<td class="Estilo1b" width="3%">:</td>';
				// 			tabla+='<td class="Estilo1b" width="80%">'+response[0]+'</td>';
				// 			tabla+='</tr>';

				// 			tabla+='</table>';
				// 			// $("#cuentas").html("Descripcion : "+response[2]+"<br>Cuenta Activo : "+response[0]+"<br>Cuenta Gasto : "+response[1]);
				// 			$("#cuentas").html(tabla);
				// 			$("#oc_activo").val(response[0]);
				// 			$("#oc_gasto").val(response[1]);
				// 		}else{
				// 			$("#cuentas").html("");
				// 		}

				// 	}
				// });
			}
		</script>
	</body>
	</html>