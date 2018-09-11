<?php
session_start();
require_once("inc/config.php");
extract($_GET);
//$query = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b ON a.oc_id = b.doc_oc_id inner join bode_detingreso c on c.ding_prod_id = b.doc_origen_id WHERE a.oc_id = ".$bid." AND c.ding_recep_tecnica = 'A'";


$orcom = "SELECT * FROM bode_orcom WHERE oc_id = ".$bid;
$resCom = mysql_query($orcom);

$prod = "SELECT * FROM bode_detoc a inner join bode_detingreso b on a.doc_origen_id = b.ding_prod_id WHERE b.ding_recep_tecnica = 'A' AND a.doc_oc_id = ".$bid;
$resProd = mysql_query($prod);

$datos = mysql_fetch_array($resCom);
$restante = 23 - mysql_num_rows($resProd);
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
			<td><?php echo $datos["oc_guiadestina"] ?></td>
			<td align="center"><?php echo $datos["oc_fecha"] ?></td>
		</tr>

		<tr> 
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr>
			<td>SALVADOR ALLENDE #105</td>
			<td>JAN JOAQUÍN</td>
			
		</tr>

	</table>

	<br>
	<br>
	<br>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">

			<?php 
			$cont = 1;
			while($row = mysql_fetch_array($resProd))
			{
			?>
			<tr>
				<td align="center"><?php echo ($cont) ?></td>
				<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["ding_ubicacion"] ?></td>
				<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row["doc_especificacion"] ?></td>
				<td align="left"><?php echo $row["ding_unidad"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td align="left">UD</td>
				<td align="left">$</td>
				<td align="left"><?php echo number_format($row["doc_conversion"],0,".",".") ?></td>
				<td align="left">$</td>
				<td align="left"><?php echo number_format(($row["doc_conversion"] * $row["doc_cantidad"]),0,".",".") ?></td>
			</tr>
		<?php $cont++;} ?>

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
