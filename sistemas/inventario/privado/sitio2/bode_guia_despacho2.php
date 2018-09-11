<?php
require_once("inc/config.php");

extract($_POST);
$query = $_POST["qry"];
$limite = 22;

$query = mysql_query($query,$dbh);
$contador = 1;
$total = 0;
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
			<td colspan="2"><?php echo $abastece ?></td>
		</tr>

		<tr> 
			<td colspan="2">&nbsp;</td>
		</tr>
		
		<tr> 
			<td><?php echo $destinatario ?></td>
			<td align="center"><?php echo Date("d-m-Y") ?></td>
		</tr>

		<tr> 
			<td colspan="2">&nbsp;</td>
		</tr>

		<tr>
			<td>DIRECCION</td>
			<td>COMUNA</td>
			
		</tr>

	</table>

	<br>
	<br>
	<br>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">

		<?php  while ($row3 = mysql_fetch_array($query)) { 
			$suma+= $row3["oc_monto"];

			?>
			<tr>
				<td align="center"><?php echo ($contador++) ?></td>
				<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $a ?></td>
				<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row3["oc_nombre_oc"] ?></td>
				<td align="left"><?php echo $row3["ding_cant_final"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td align="left">UD</td>
				<td align="left">$</td>
				<td align="left"><?php echo number_format($row3["oc_monto"],0,".",".") ?></td>
				<td align="left">$</td>
				<td align="left"><?php echo number_format($row3["oc_monto"] * $row3["ding_cant_final"]) ?></td>
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
				<td colspan="9"><center><textarea style="margin: 0px; height: 122px; width: 700px;"><?php echo $_SESSION["encabezado"]["obs"] ?></textarea></center></td>
			</tr>

			<tr>
				<td colspan="9" align="left"><?php echo $emisor ?></td>
			</tr>
		</table>
	</body>
	</html>
