<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_GET);
extract($_POST);
extract($_SESSION);

if (!isset($_POST['frmEnviado'])) {
	$frmEnviado="";
}
if (!isset($_POST['frmFraccionar'])) {
	$frmFraccionar="";
}

// Combobox
// Obtener las bodegas
$bodegas = "SELECT * FROM bode_ubicacion WHERE ubi_estado = 1 AND ubi_region = ".$_SESSION["region"]." ORDER BY ubi_glosa ASC";
$bodegas = mysql_query($bodegas);
$arrBode = array();
while($rowBode = mysql_fetch_array($bodegas))
{
	$arrBode[] = $rowBode;
}

//$ubicacion = "SELECT * FROM bode_detingreso, bode_detoc WHERE ding_ing_id = ".$id." AND doc_id = ".$prod_id;
$ubicacion = "SELECT * FROM bode_detingreso, bode_detoc WHERE ding_id = ".$ding_id." AND doc_id = ".$prod_id;
//echo $ubicacion;
$ubicacion = mysql_query($ubicacion,$dbh);
$ubicacion = mysql_fetch_array($ubicacion);

//$historial = "SELECT * FROM bode_detalle_ubicacion WHERE det_ubi_ing_id = ".$id." ORDER BY det_ubi_id DESC";
$historial = "SELECT * FROM bode_detalle_ubicacion WHERE det_ubi_ing_id = ".$ding_id." ORDER BY det_ubi_id DESC";
$historial = mysql_query($historial,$dbh);

$historialFrac = "SELECT * FROM bode_det_frac a INNER JOIN bode_detoc b ON b.doc_id = a.det_frac_doc_id WHERE det_frac_doc_id = ".$prod_id;
$historialFrac = mysql_query($historialFrac);

$detalle = "SELECT * FROM bode_detingreso WHERE ding_id = ".$ding_id;
$detalle = mysql_query($detalle);
$detalle = mysql_fetch_array($detalle);
if(intval($frmEnviado) === 1 )
{
	//$update = "UPDATE bode_detingreso SET ding_ubicacion = '".$nuevaUbicacion."' WHERE ding_ing_id = ".$id;
	$update = "UPDATE bode_detingreso SET ding_ubicacion = '".strtoupper($nuevaUbicacion)."' WHERE ding_id = ".$ding_id;
	//echo $update;
	mysql_query($update);
	echo "<script>opener.location.reload(); window.location.href='bode_nueva_ubicacion.php?id=".$id."&prod_id=".$prod_id."&ding_id=".$ding_id."';</script>";

	//$ingreso = "INSERT INTO bode_detalle_ubicacion VALUES (null,".$id.",'".$ubicacion["ding_ubicacion"]."','".$nuevaUbicacion."','".$nom_user."','".Date("Y-m-d")."','".Date("H:i:s")."','".$ubicacion["doc_numerooc"]."')";
	$ingreso = "INSERT INTO bode_detalle_ubicacion VALUES (null,".$ding_id.",'".strtoupper($ubicacion["ding_ubicacion"])."','".strtoupper($nuevaUbicacion)."','".$nom_user."','".Date("Y-m-d")."','".Date("H:i:s")."','".$ubicacion["doc_numerooc"]."')";
	//echo "<br>".$ingreso;
	mysql_query($ingreso);
	echo "<script>opener.location.reload(); window.location.href='bode_nueva_ubicacion.php?id=".$id."&prod_id=".$prod_id."&ding_id=".$ding_id."';</script>";

}

if($frmFraccionar == 1)
{
	//DESCONTAR DEL STOCK LO TRANSFERIDO
	$transferir = "UPDATE bode_detingreso SET 
	ding_cantidad = ding_cantidad - ".$cantidad.",
	ding_cant_conf = ding_cantidad,
	ding_cant_final = ".$cantidad.",
	ding_unidad = ding_unidad - ".$cantidad."
	WHERE ding_id = ".$ding_id;
	mysql_query($transferir,$dbh);

	//CREAR NUEVA LINEA
	$nuevaLinea = "INSERT INTO `bode_detingreso`(
	`ding_ing_id`,
	`ding_prod_id`,
	`ding_cantidad`,
	`ding_region_id`,
	`ding_recep_tecnica`,
	`ding_cant_conf`,
	`ding_cant_despacho`,
	`ding_cant_final`,
	`ding_cant_rechazo`,
	`ding_glosa_rechazo`,
	`ding_ubicacion`,
	`ding_user`,
	`ding_fecha`,
	`ding_userf`,
	`ding_fechaf`,
	`ding_fentrega`,
	`ding_recep_conforme`,
	`ding_umedida`,
	`ding_unidad`,
	`ding_factor`,
	`ding_clasificacion`,
	`ding_devengo`) VALUES (
	'".$detalle[ding_ing_id]."',
	'".$detalle[ding_prod_id]."',
	'".$cantidad."',
	'".$detalle[ding_region_id]."',
	'".$detalle[ding_recep_tecnica]."',
	'".$cantidad."',
	'".$detalle[ding_cant_despacho]."',
	'".$cantidad."',
	'0',
	'".$detalle[ding_glosa_rechazo]."',
	'".$nuevaUbicacion2."',
	'".$detalle[ding_user]."',
	'".$detalle[ding_fecha]."',
	'".$detalle[ding_userf]."',
	'".$detalle[ding_fechaf]."',
	'".$detalle[ding_fentrega]."',
	'".$detalle[ding_recep_conforme]."',
	'".$detalle[ding_umedida]."',
	'".$cantidad."',
	'".$detalle[ding_factor]."',
	'".$detalle[ding_clasificacion]."',
	'".$detalle[ding_devengo]."')";
	mysql_query($nuevaLinea,$dbh);

	mysql_query("INSERT INTO bode_det_frac VALUES (NULL,".$detalle["ding_prod_id"].",".$cantidad.",'".Date("Y-m-d")."','".Date("H:i:s")."','".$_SESSION["nom_user"]."','".$nuevaUbicacion2."')");
	$log = "INSERT INTO log VALUES(NULL,".$detalle["ding_prod_id"].",".$cantidad.",'FRACCIONAMIENTO PRODUCTO','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','STOCK')";
	mysql_query($log);

	//Restaurar guias de R/T y R/C
	// $restaurar = "update bode_detingreso SET ding_cantidad = ding_unidad, ding_cant_final = ding_unidad WHERE ding_prod_id = ".$detalle["ding_prod_id"];
	// mysql_query($restaurar);

	echo "<script>window.location.href='bode_nueva_ubicacion.php?id=".$id."&prod_id=".$prod_id."&ding_id=".$ding_id."&ok=1';opener.location.reload();</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS - NUEVA UBICACION</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<script type="text/javascript" src="librerias/jquery.printPage.js"></script>

</head>
<body>
	<div  style="background-color:#E0F8E0;" id="div2">
		<table border="0" width="100%">
			<tr>
				<td  class="Estilo2titulo"><center>DETALLE DE UBICACION</center></td>
			</tr>
		</table>

		<table border="1" width="100%">
			<tr>
				<td class="Estilo1">UNICACION ACTUAL</td>
				<td class="Estilo1"><?php echo $ubicacion["ding_ubicacion"] ?></td>
			</tr>

			<tr>
				<td class="Estilo1">PRODUCTO</td>
				<td class="Estilo1"> <?php echo $ubicacion["doc_especificacion"] ?></td>
			</tr>
			
			<?php if ($_SESSION["pfl_user"] <> 54 && $_SESSION["pfl_user"] <> 53): ?>
				<tr>
					<td class="Estilo1">NUEVA UBICACION</td>
					<td class="Estilo1">
						<form action="<?php echo $_SERVER["PHP_SELF"]?>?id=<?php echo $id ?>&prod_id=<?php echo $prod_id?>&ding_id=<?php echo $ding_id ?>" method="POST" onSubmit="return valida()">
							<table border="0">
								<?php if ($_SESSION["region"] == 16 || $_SESSION["region"] == 2): ?>
									<tr>
										<td>
											<select class="Estilo1" name="nuevaUbicacion" id="nuevaUbicacion">
												<option value="" selected>Seleccionar...</option>
												<?php foreach ($arrBode as $key => $value): ?>
													<option value="<?php echo $value["ubi_glosa"] ?>"><?php echo $value["ubi_glosa"] ?></option>
												<?php endforeach ?>
											</select>
										</td>


									</tr>
								<?php else: ?>
									<td><input type="text" name="nuevaUbicacion" id="nuevaUbicacion" class="Estilo1"></td>
								<?php endif ?>
								<td><input type="submit" value="ACTUALIZAR" id="actualizar"></td>
							</table>
							<input type="hidden" name="frmEnviado" value="1">

						</form>
					</td>
				</tr>
			<?php endif ?>

		</table>

		<hr>
		<form action="<?php echo $_SERVER["PHP_SELF"]?>?id=<?php echo $id ?>&prod_id=<?php echo $prod_id?>&ding_id=<?php echo $ding_id ?>" method="POST" onSubmit="return valida2()">

			<table border="0" width="100%">
				<tr>
					<td  class="Estilo2titulo"><center>FRACCIONAMIENTO</center></td>
				</tr>
			</table>

			<table border="1" width="100%">
				<tr>
					<td class="Estilo1">DISPONIBLE</td>
					<td class="Estilo1"><?php echo $detalle["ding_unidad"] ?></td>
				</tr>
				
				<?php if ($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54): ?>
					<tr>
						<td class="Estilo1">NUEVA UBICACION</td>
						<td class="Estilo1">
							<?php if ($_SESSION["region"] == 16 || $_SESSION["region"] == 2): ?>
								<select class="Estilo1" name="nuevaUbicacion2" id="nuevaUbicacion2">
									<option value="" selected>Seleccionar...</option>
									<?php foreach ($arrBode as $key => $value): ?>
										<option value="<?php echo $value["ubi_glosa"] ?>"><?php echo $value["ubi_glosa"] ?></option>
									<?php endforeach ?>
								</select>
							<?php else: ?>
								<input type="text" name="nuevaUbicacion2" id="nuevaUbicacion2" class="Estilo1">
							<?php endif ?>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">NUEVA CANTIDAD</td>
						<td class="Estilo1"><input type="number" name="cantidad" id="cantidad" min="0" max="<?php echo $detalle["ding_unidad"] ?>"></td>
					</tr>

					<tr>
						<td class="Estilo1" colspan="2"><center><button id="fraccionar">FRACCIONAR <i class="fa fa-plus"></i></button></center></td>
					</tr>
				<?php endif ?>
			</table>
			<input type="hidden" name="frmFraccionar" value="1">
		</form>

		<hr>
		<table border="1" width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="6"><center>HISTORIAL DE UBICACIONES</center></td>
			</tr>

			<tr>
				<td class="Estilo1">ORDEN DE COMPRA</td>
				<td class="Estilo1">ANTERIOR</td>
				<td class="Estilo1">NUEVO</td>
				<td class="Estilo1">FECHA</td>
				<td class="Estilo1">HORA</td>
				<td class="Estilo1">USUARIO</td>
			</tr>

			<?php while($row = mysql_fetch_array($historial))  { ?>
				<tr>
					<td class="Estilo1"><?php echo $row["det_ubi_orcom"] ?></td>
					<td class="Estilo1"><?php echo $row["det_ubi_ant"] ?></td>
					<td class="Estilo1"><?php echo $row["det_ubi_nuevo"] ?></td>
					<td class="Estilo1"><?php echo $row["det_ubi_fecha"] ?></td>
					<td class="Estilo1"><?php echo $row["det_ubi_hora"] ?></td>
					<td class="Estilo1"><?php echo $row["det_ubi_usr"] ?></td>
				</tr>
				<?php } ?>
			</table>

			<hr>
			<table border="1" width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="6"><center>HISTORIAL DE FRACCIONAMIENTO</center></td>
				</tr>

				<tr>
					<td class="Estilo1">ORDEN DE COMPRA</td>
					<td class="Estilo1">CANTIDAD</td>
					<td class="Estilo1">UBICACION</td>
					<td class="Estilo1">FECHA</td>
					<td class="Estilo1">HORA</td>
					<td class="Estilo1">USUARIO</td>
				</tr>

				<?php while($row = mysql_fetch_array($historialFrac))  { ?>
					<tr>
						<td class="Estilo1"><?php echo $row["doc_numerooc"] ?></td>
						<td class="Estilo1"><?php echo $row["det_frac_cant"] ?></td>
						<td class="Estilo1"><?php echo $row["det_frac_ubi"] ?></td>
						<td class="Estilo1"><?php echo $row["det_frac_fecha"] ?></td>
						<td class="Estilo1"><?php echo $row["det_frac_hora"] ?></td>
						<td class="Estilo1"><?php echo $row["det_frac_user"] ?></td>
					</tr>
					<?php } ?>
				</table>

			</div>

			<script type="text/javascript">
				function valida(){

					if($("#nuevaUbicacion").val() == ""){
						alert("SELECCIONE LA NUEVA UBUCACION");
						$("#nuevaUbicacion").focus();
						return false;
					}else{
						if(confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?"))
						{
							$("#actualizar").hide();
							return true;
						}else{
							return false;
						}
						
					}
				}

				function valida2(){

					if($("#nuevaUbicacion2").val() == ""){
						alert("SELECCIONE LA NUEVA UBUCACION");
						$("#nuevaUbicacion2").focus();
						return false;
					}else if($("#cantidad").val() == 0 || $("#cantidad").val() == ""){
						alert("INGRESE LA CANTIDAD A TRANSFERIR");
						$("#cantidad").focus();
						return false;
					}else{
						if(confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?"))
						{
							$("#fraccionar").hide();
							return true;
						}else{
							return false;	

						}
					}
				}

			</script>
		</body>
		</html>