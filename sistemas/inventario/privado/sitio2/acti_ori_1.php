<?php 
session_start();
require("inc/config.php");
extract($_GET);
extract($_POST);

$sql = "SELECT * FROM acti_inventario WHERE inv_id = ".$_REQUEST["id"];
//$sql = "SELECT * FROM acti_inventario, acti_compra WHERE inv_id = ".$_REQUEST["id"]." AND oc_numero = inv_oc LIMIT 1";
$sqlResp = mysql_query($sql);
$row = mysql_fetch_array($sqlResp);
?>

<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
<div  style="background-color:#E0F8E0;" id="div2">
		<table border="0" width="100%">
			<tr>
				<td  class="Estilo2titulo"><center>DETALLE</center></td>
			</tr>
		</table>
		<hr>
		<table border="0" width="100%">
			<tr>
				<td  class="Estilo1">RES. ALTA</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["inv_altares"] ?>"></td>

				<td  class="Estilo1">RES. BAJA / TRASLADO</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["inv_baja"] ?>"></td>

			</tr>

			<tr>
				<td  class="Estilo1">CALIDAD ADMINISTRATIVA</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["inv_calidad"] ?>"></td>

				<td  class="Estilo1">VIDA UTIL</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["inv_vutil"] ?> Año(s)"></td>

			</tr>

			<tr>
				<td  class="Estilo1">FECHA DEVENGADO</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["inv_devengofecha"] ?>"></td>

				<td  class="Estilo1">VIDA UTIL CONSUMIDA</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["inv_vutilconsumida"] ?> Año(s)"></td>

			</tr>

			<tr>
				<td  class="Estilo1">ESTADO</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["inv_estadocosto"] ?>"></td>

				<td  class="Estilo1">RESPONSABLE</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["inv_responsable"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">CORRELATIVO</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_corre"] ?>"></td>

				<td class="Estilo1">CODIGO</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_codigo"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">BIEN</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_bien"] ?>"></td>

				<td class="Estilo1">COSTO UNITARIO</td>
				<td class="Estilo1"><input type="text" disabled value="$<?php echo number_format($row["inv_costo"],0,".",".") ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">CENTRO RESPONSABLE</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_cresponsable"] ?>"></td>

				<td class="Estilo1">CENTRO DE COSTO</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_ccosto"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">AÑO ADQUISICIÓN</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_anno"] ?>"></td>

				<td class="Estilo1">ORDEN DE COMPRA</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_oc"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">FECHA DE RECEPCIÓN</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_recepcionfecha"] ?>"></td>

				<td class="Estilo1">DIRECCION</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_direccion"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">ZONA</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_zona"] ?>"></td>

				<td class="Estilo1">PROGRAMA</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["inv_programa"] ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1">NUMERO SOLICITUD</td>
				<td class="Estilo1"><input type="text" disabled value="<?php echo $row["solicitud_numero"] ?>"></td>
			</tr>
		</table>
</div>