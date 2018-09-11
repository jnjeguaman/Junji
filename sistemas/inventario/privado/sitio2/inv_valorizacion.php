<?php
session_start();
require_once("inc/config.php");
extract($_GET);
extract($_POST);

/*
MODALIDAD 
1 ANTIGUO : DESDE BODEGA
2 NUEVO : SOLO BIENES DE INVENTARO
*/
if($valorizacion_f_devengo <> "")
	{
		$devengoFecha = explode("-", $valorizacion_f_devengo);
		$where.= "YEAR(inv_devengofecha) = ".$devengoFecha[0]." AND MONTH(inv_devengofecha) = ".$devengoFecha[1]." AND ";
	}

	if($valorizacion_oc <> "")
	{
		$where.="inv_oc LIKE '%".$valorizacion_oc."%' AND ";
	}

	if($valorizacion_rc <> "")
	{
		if($modalidad == 1)
		{
			$where.="inv_nro_rece LIKE '%".$valorizacion_rc."%' AND ";
		}else{
			$where.="b.rc_numero LIKE '%".$valorizacion_rc."%' AND ";
		}
	}
if(isset($submit) && $submit == "buscar")
{

	if($modalidad == 1)
	{
		$query = "SELECT inv_oc,inv_nro_rece FROM acti_inventario a INNER JOIN acti_compra b ON b.oc_numero = a.inv_oc WHERE ".$where."  inv_region = ".$_SESSION["region"]." and inv_visible = 1 AND b.compra_ing_id <> 0 GROUP BY inv_nro_rece";
	}
	if($modalidad == 2)
	{
		// $query = "SELECT a.inv_oc,b.compra_monto,b.rc_numero,b.rc_numero as inv_nro_rece,b.id as oc_id,b.compra_devengado FROM acti_inventario a INNER JOIN acti_compra b ON b.oc_numero = a.inv_oc WHERE ".$where." inv_region = ".$_SESSION["region"]." and inv_visible = 1 AND (b.compra_ing_id = 0 OR b.compra_ing_id IS NULL) GROUP BY b.rc_numero";
		   $query = "SELECT a.inv_oc,b.compra_monto,b.rc_numero,b.rc_numero as inv_nro_rece,b.id as oc_id,b.compra_devengado FROM acti_inventario a INNER JOIN acti_compra b ON b.oc_numero = a.inv_oc WHERE ".$where." inv_region = ".$_SESSION["region"]." and inv_visible = 1 AND (b.compra_ing_id = 0 OR b.compra_ing_id IS NULL) GROUP BY b.rc_numero";
		   // echo $query;
	}
}else if($ori==2)
{
	$devengoFecha = explode("-", $clave);
	if($modalidad == 1)
	{
		$query = "SELECT inv_oc,inv_nro_rece FROM acti_inventario WHERE ".$where." inv_region = ".$_SESSION["region"]." and inv_visible = 1 GROUP BY inv_nro_rece";
	}
	if($modalidad == 2)
	{
		$query = "SELECT a.inv_oc,b.compra_monto,b.rc_numero,b.rc_numero as inv_nro_rece,b.id as oc_id,b.compra_devengado FROM acti_inventario a INNER JOIN acti_compra b ON b.oc_numero = a.inv_oc  WHERE ".$where." inv_region = ".$_SESSION["region"]." and inv_visible = 1 GROUP BY b.rc_numero";
	}

}else{
	$devengoFecha = explode("-", $clave);
	if($modalidad == 1)
	{
		$query = "SELECT inv_oc,inv_nro_rece FROM acti_inventario WHERE ".$where." inv_region = ".$_SESSION["region"]." and inv_visible = 1 GROUP BY inv_nro_rece";
	}

	if($modalidad == 2)
	{
		$query = "SELECT inv_oc FROM acti_inventario WHERE ".$where." inv_region = ".$_SESSION["region"]." and inv_visible = 1 GROUP BY inv_oc";
	}
}
// echo $query;
$resQuery = mysql_query($query,$dbh);
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<script src="librerias/jquery.blockUI.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<div style="width:700px;background-color:#E0F8E0; position:absolute; top:160px; left:0px;" id="div1">
		<form name="form1" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" onSubmit="return validar()">
			<table border="1" width="100%">
				<tr>
					<td class="Estilo1">FECHA DE DEVENGO</td>
					<td class="Estilo1"><input type="text" name="valorizacion_f_devengo" id="valorizacion_f_devengo" class="Estilo2" placeholder="YYYY-MM" value="<?php echo $valorizacion_f_devengo ?>" >
						<i class="fa fa-calendar fa-lg link" id="f_trigger_c1" style="cursor:pointer;" title="Seleccionar Fecha"></i>
						<script type="text/javascript">
							Calendar.setup({
								inputField     :    "valorizacion_f_devengo",
								ifFormat       :    "%Y-%m",
								button         :    "f_trigger_c1",
								align          :    "Bl",
								singleClick    :    true
							});
						</script>
					</td>
				</tr>

				<tr>
					<td class="Estilo1">ORDEN DE COMPRA</td>
					<td class="Estilo1"><input type="text" class="Estilo1" name="valorizacion_oc" id="valorizacion_oc" value="<?php echo $valorizacion_oc ?>"></td>
				</tr>

				<tr>
					<td class="Estilo1">N° RECEPCIÓN CONFORME</td>
					<td class="Estilo1"><input type="text" class="Estilo1" name="valorizacion_rc" id="valorizacion_rc" value="<?php echo $valorizacion_rc ?>"></td>
				</tr>

				<tr>
					<td class="Estilo1">MODALIDAD</td>
					<td class="Estilo1">
						<select class="Estilo1" name="modalidad" id="modalidad" required>
							<option value="">Seleccionar...</option>
							<option value="1" <?php if($modalidad == 1){echo"selected";}?>>DESDE LOGISTICA</option>
							<option value="2" <?php if($modalidad == 2){echo"selected";}?>>DESDE INVENTARIO</option>
						</select>
					</td>
				</tr>

				<tr>
					<td class="Estilo1" colspan="2"><center><button type="submit" name="submit" value="buscar">BUSCAR <i class="fa fa-search"></i></button></center></td>
				</tr>
			</table>
		</form>
		<?php if (intval(mysql_num_rows($resQuery)) > 0): ?>
			<?php include("inv_valorizacion_ori1.php") ?>
		<?php endif ?>
	</div>

	<?php if ($ori == 2): ?>
		<?php include("inv_valorizacion_ori2.php") ?>
	<?php endif ?>

	<script type="text/javascript">
		function validar()
		{
			var clave = $("#valorizacion_f_devengo").val();
			if(clave != "" && clave.length != 7)
			{
				alert("INGRESE LA FECHA DE DEVENGO A BUSCAR (YYYY-MM)");
				$("#clave").focus();
				return false;
			}else{
				blockUI();
				return true;
			}
		}
	</script>
</body>
</html>