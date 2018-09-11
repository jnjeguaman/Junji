<?php
require_once("inc/config.php");
extract($_GET);
//$query = "SELECT * FROM bode_orcom x, bode_detoc y WHERE x.oc_id=".$_REQUEST["id"]." and x.oc_id=y.doc_oc_id";
//$query = "SELECT * FROM bode_orcom x, bode_detoc y, bode_detingreso z WHERE x.oc_id=".$_REQUEST["id"]." and x.oc_id=y.doc_oc_id AND y.doc_origen_id = z.ding_prod_id and y.doc_estado <> 'ELIMINADO'";
//$query = "SELECT * FROM bode_orcom x, bode_detoc y, bode_detingreso z WHERE x.oc_id=".$_REQUEST["id"]." and x.oc_id=y.doc_oc_id AND y.doc_origen_id = z.ding_prod_id and y.doc_estado <> 'ELIMINADO'";
//$query="select * from bode_detoc a, bode_orcom b where doc_oc_id = '$id' AND b.oc_id = a.doc_oc_id";
//OK $query="select * from bode_detoc a, bode_orcom b where doc_oc_id = '$id' AND b.oc_id = a.doc_oc_id AND a.doc_estado <> 'ELIMINADO'";
//$query="select * from bode_detoc a, bode_orcom b, bode_detingreso c where doc_oc_id = '$id' AND c.ding_id = a.doc_id AND b.oc_id = a.doc_oc_id AND a.doc_estado <> 'ELIMINADO'";
$query="select * from bode_detoc a, bode_orcom b, bode_detingreso c where doc_oc_id = '$id' AND c.ding_id = a.doc_id AND b.oc_id = a.doc_oc_id AND a.doc_estado <> 'ELIMINADO'";
//echo $query;
$limite = 22;

$datos = mysql_query($query);
$datos = mysql_fetch_array($datos);

$query = mysql_query($query,$dbh);
$contador = 1;
$total = 0;
$oc_tipo_guia = intval($datos["oc_tipo_guia"]);

if($oc_tipo_guia === 1) 
{
	$consulta = "SELECT * FROM acti_region WHERE region_id = ".$datos["oc_guiadestina"];
	$consulta = mysql_query($consulta,$dbh);
	$consulta = mysql_fetch_array($consulta);
}

if($oc_tipo_guia === 2) 
{
	$consulta = "SELECT * FROM acti_zona WHERE zona_glosa = '".$datos["oc_guiadestina"]."'";
	$consulta = mysql_query($consulta,$dbh);
	$consulta = mysql_fetch_array($consulta);
}

if($oc_tipo_guia === 3) 
{
	$consulta = "SELECT * FROM jardines WHERE jardin_codigo = '".$datos["oc_guiadestina"]."'";
	$consulta = mysql_query($consulta,$dbh);
	$consulta = mysql_fetch_array($consulta);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<style type="text/css">
		html{
			font-size: 10px;
			font-weight: bold;
		}

		textarea{
			border: none;
			font-size: 10px;
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
			<td colspan="2"><?php echo $datos["oc_guiaabaste"] ?></td>
		</tr>

		<tr> 
			<td colspan="2">&nbsp;</td>
		</tr>
		
		<tr> 
			<td>
				<?php
				if($oc_tipo_guia === 1)
				{
					echo $consulta["region_glosa"];
				}

				if($oc_tipo_guia === 2)
				{
					echo $consulta["zona_glosa"];
				}	

				if($oc_tipo_guia === 3)
				{
					echo $datos["oc_guiadestina"];
				}

				?>
			</td>
			<?php $fechas = explode("-", $datos["oc_fecha"]) ?>
			<td align="center"><?php echo $fechas[2]."-".$fechas[1]."-".$fechas[0] ?></td>
		</tr>

		<tr> 
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr>
			<?php if($oc_tipo_guia === 1){ ?>
				<td><?php echo $consulta["region_dir_bodega"] ?></td>
				<td><?php echo $consulta["region_ciudad"] ?></td>
				<?php } ?>

				<?php if($oc_tipo_guia === 2){ ?>
				<td><?php echo $consulta["zona_glosa"] ?></td>
				<td><?php echo $consulta["zona_comuna"] ?></td>
				<?php } ?>

				<?php if($oc_tipo_guia === 3){ ?>
				<td><?php echo $consulta["jardin_direccion"] ?></td>
				<td><?php echo $consulta["jardin_comuna"] ?></td>
				<?php } ?>
		</tr>

	</table>

	<br>
	<br>
	<br>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">

		<?php  while ($row3 = mysql_fetch_array($query)) { 
			$suma+= $row3["doc_conversion"] * $row3["doc_cantidad"];
			$oc_prog = "SELECT oc_prog FROM bode_orcom WHERE oc_id2 = '".$row3["doc_numerooc"]."'";
			$oc_prog = mysql_query($oc_prog);
			$oc_prog = mysql_fetch_array($oc_prog);
			?>
			<tr>
				<td align="center"><?php echo ($contador++) ?></td>
				<td align="center"><?php echo $oc_prog["oc_prog"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row3["ding_ubicacion"] ?></td>
				<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row3["doc_especificacion"] ?></td>
				<td align="left"><?php echo $row3["doc_cantidad"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td align="left">UD</td>
				<td align="left">$</td>
				<td align="left"><?php echo number_format($row3["doc_conversion"],0,".",".") ?></td>
				<td align="left">$</td>
				<td align="left"><?php echo number_format(($row3["doc_conversion"] * $row3["doc_cantidad"]),0,".",".") ?></td>
			</tr>
			<?php } 
			$restante = $limite - $total
			?>

			<?php for ($i=0; $i < $restante; $i++) { ?>
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
			<?php } ?>
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
				<td colspan="9"><center><textarea style="margin: 0px; height: 122px; width: 700px;"><?php echo $datos["oc_obs"] ?></textarea></center></td>
			</tr>

			<tr>
				<td colspan="9" align="left"><?php echo $datos["oc_usu"] ?></td>
			</tr>
		</table>
	</body>
	</html>