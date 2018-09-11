<?php
session_start();
require_once("inc/config.php");
$arrayName = array();
if(isset($_GET["guia"]))
{
	$detalle = "SELECT * FROM inv_guia_despacho_encabezado WHERE guia_numero = ".$_GET["guia"];
	$detalle = mysql_query($detalle);
	$detalle = mysql_fetch_array($detalle);

	$detalleGuia = "SELECT COUNT(detalle_guia_numero) as Total FROM inv_guia_despacho_detalle WHERE detalle_guia_numero = ".$_GET["guia"];
	$detalleGuia = mysql_query($detalleGuia);
	$detalleGuia = mysql_fetch_array($detalleGuia);
	$detalleGuia = $detalleGuia["Total"];

	for ($i=0; $i < 22; $i++) { 
		$query = "SELECT inv_bien, inv_costo FROM acti_inventario WHERE inv_id = ".$_SESSION["Actualizacion"][$i]["id"];
		$query = mysql_query($query);
		$arrayName[$i] = mysql_fetch_array($query);
	}

}else{

	for ($i=0; $i < 22; $i++) { 
		$query = "SELECT inv_bien, inv_costo FROM acti_inventario WHERE inv_codigo = ".$_SESSION["items"][$i]["inv_codigo"];
		$query = mysql_query($query,$dbh);
		$arrayName[$i] = mysql_fetch_array($query);
	}

}
$suma = 0;

//BUSCAMOS DETALLE DE LA DIRECCION DE DESTINO,
// VERIFICAMOS LA REGION DE DESTINO
if(isset($_GET["destino"]))
{
	if(intval($_GET["destino"]) <> 16)
	{
		//RECUPERAMOS EL CODIGO DEL JARDIN
		$partes = explode(" ", $detalle["guia_direccion"]);
		$codigo = trim($partes[1]);

		//BUSCAMOS LA INFORMACION DEL JARDIN
		$detalleJardin = "SELECT * FROM jardines WHERE jardin_codigo = ".$codigo." AND jardin_estado = 1";
		$detalleJardin = mysql_query($detalleJardin);
		$detalleJardin = mysql_fetch_array($detalleJardin);
		
	}else{
		$detalleJardin = "SELECT * FROM acti_zona WHERE zona_glosa = '".$detalle["guia_direccion"]."'";
		$detalleJardin = mysql_query($detalleJardin);
		$detalleJardin = mysql_fetch_array($detalleJardin);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<style type="text/css">
		html{
			font-size: 11px;
			font-family: Helvetica;
			font-weight: bold;
		}

		textarea{
			border: none;
			font-size: 11px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<table border="0" cellpadding="0" cellspacing="0" width="75%" align="center">


		<tr> 
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr> 
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr> 
			<td colspan="2"><?php echo isset($_GET["guia"]) ? $detalle["guia_abastece"]: $_SESSION["encabezado"]["abastece"] ?></td>
		</tr>

		<tr> 
			<td>&nbsp;</td>
			<td align="center"><?php echo isset($_GET["guia"]) ? $detalle["guia_numero"] : $_SESSION["encabezado"]["nro_guia"] ?></td>
		</tr>
		
		<tr> 
			<td><?php echo isset($_GET["guia"]) ? $detalle["guia_destinatario"] : $_SESSION["encabezado"]["destinatario"] ?></td>
			<td align="center"><?php echo Date("d-m-Y") ?></td>
		</tr>

		<tr> 
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr>
			<?php if (intval($_SESSION["encabezado"]["tipoDireccion"]) === 1): ?>

				<?php if (isset($_GET["guia"])): ?>
					<?php if ($_GET["destino"] <> 16): ?>
						<td><?php echo $detalleJardin["jardin_direccion"] ?> (<?php echo $detalle["guia_direccion"] ?>)</td>
						<td><?php echo $detalleJardin["jardin_comuna"] ?></td>
					<?php else: ?>
						<td><?php echo $detalleJardin["zona_glosa"] ?></td>
						<td><?php echo $detalleJardin["zona_comuna"] ?></td>
					<?php endif ?>
				<?php else: ?>
					<td><?php echo $_SESSION["encabezado"]["responsa"]." / ".$_SESSION["encabezado"]["responsa2"] ?></td>
					<td><?php echo $_SESSION["encabezado"]["comuna"] ?></td>
				<?php endif ?>
				
			<?php else: ?>
				<?php if (isset($_GET["guia"])): ?>
					<?php if ($_GET["destino"] <> 16): ?>
						<td><?php echo $detalleJardin["jardin_direccion"] ?> (<?php echo $detalle["guia_direccion"] ?>)</td>
						<td><?php echo $detalleJardin["jardin_comuna"] ?></td>
					<?php else: ?>
						<td><?php echo $detalleJardin["zona_glosa"] ?></td>
						<td><?php echo $detalleJardin["zona_comuna"] ?></td>
					<?php endif ?>
				<?php else: ?>
					<td><?php echo $_SESSION["encabezado"]["responsa2"] ?></td>
					<td><?php echo $_SESSION["encabezado"]["comuna2"] ?></td>
				<?php endif ?>
				
			<?php endif ?>
			
		</tr>

	</table>

	<br>
	<br>
	<br>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<?php for ($i=0; $i < count($arrayName); $i++): ?> 
			<?php $suma+= $arrayName[$i]["inv_costo"] ?>

			<?php if (isset($_GET["guia"])): ?>
				<?php if ($i > count($_SESSION["Actualizacion"]) - 1): ?>
					<tr>
						<td>&nbsp;</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				<?php else: ?>
					<tr>
						<td align="center"><?php echo ($i+1) ?></td>
						<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION["items"][$i]["inv_codigo"] ?></td>
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arrayName[$i]["inv_bien"] ?></td>
						<td align="left">1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UD</td>
						<td align="left"></td>
						<td align="left">$</td>
						<td align="left"><?php echo number_format($arrayName[$i]["inv_costo"],0,".",".") ?></td>
						<td align="left">$</td>
						<td align="left"><?php echo number_format($arrayName[$i]["inv_costo"],0,".",".") ?></td>
					</tr>
				<?php endif ?>
			<?php else: ?>
				<?php if ($i > count($_SESSION["items"]) - 1): ?>
					<tr>
						<td>&nbsp;</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				<?php else: ?>
					<tr>
						<td align="center"><?php echo ($i+1) ?></td>
						<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION["items"][$i]["inv_codigo"] ?></td>
						<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $arrayName[$i]["inv_bien"] ?></td>
						<td align="left">1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UD</td>
						<td align="left"></td>
						<td align="left">$</td>
						<td align="left"><?php echo number_format($arrayName[$i]["inv_costo"],0,".",".") ?></td>
						<td align="left">$</td>
						<td align="left"><?php echo number_format($arrayName[$i]["inv_costo"],0,".",".") ?></td>
					</tr>
				<?php endif ?>
			<?php endif ?>
			

		<?php endfor ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="left"><?php  echo number_format($suma,0,".",".") ?></td>
		</tr>

		<tr> 
			<td colspan="9">&nbsp;</td>
		</tr>


		<tr>
			<td colspan="9"><center><textarea style="margin: 0px; height: 122px; width: 700px;"><?php echo $_SESSION["encabezado"]["obs"] ?></textarea></center></td>
		</tr>

		<tr>
			<td colspan="9" align="left"><?php echo $_SESSION["nombrecom"] ?></td>
		</tr>
	</table>
</body>
</html>
<?php $_SESSION["items"] = array() ?>
<?php $_SESSION["Actualizacion"] = array() ?>