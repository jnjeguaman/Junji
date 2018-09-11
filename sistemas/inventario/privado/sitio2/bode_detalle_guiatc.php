<?php
extract($_GET);
$query = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where y.ing_guia = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id";
$query2 = "SELECT * FROM bode_ingreso WHERE ing_guia = $doc_id";

$resp2 = mysql_query($query2);
$row2 = mysql_fetch_array($resp2);
$resp = mysql_query($query);
?>
<div  style="background-color:#E0F8E0; position:absolute; top:120px; left:804px;" id="div2">
	<?php echo $query ?>
	<br>
	<?php  echo$query2 ?>
	<form action="bode_guia_despacho2.php" method="POST">
	<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
		<tr>
			<td  class="Estilo2titulo" colspan="10">GUIA N° <?php echo $doc_id?></td>
		</tr>

		<tr>
			<td class="Estilo1mc">FECHA EMISION</td>
			<td class="Estilo1mc"><?php echo $row2["ing_guiafechatc"]?></td>
		</tr>
		<tr>
			<td class="Estilo1mc">EMISOR</td>
			<td class="Estilo1mc"><?php echo $row2["ing_guiaemisortc"]?></td>
			<input type="hidden" name="emisor" value="<?php echo $row2["ing_guiaemisortc"]?>">
		</tr>

		<tr>
			<td class="Estilo1mc">ABASTECE</td>
			<td class="Estilo1mc"><?php echo $row2["ing_guiaabastetc"]?></td>
			<input type="hidden" name="abastece" value="<?php echo $row2["ing_guiaabastetc"]?>">

		</tr>
		<tr>
			<td class="Estilo1mc">DESTINATARIO</td>
			<td class="Estilo1mc"><?php echo $row2["ing_guiadestinatc"]?></td>
			<input type="hidden" name="destinatario" value="<?php echo $row2["ing_guiadestinatc"]?>">
		</tr>
	</table>
	
	<br>
	<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
		<tr>
			<td class="Estilo2titulo" colspan="10">DETALLE GUIA N° <?php echo $doc_id?></td>
		</tr>

		<tr>
			<td class="Estilo1mc">ITEM</td>
			<td class="Estilo1mc">CANTIDAD</td>
		</tr>

		<?php while($row = mysql_fetch_array($resp)) { ?>
		<tr>
			<td class="Estilo1mc"><?php echo $row["oc_nombre_oc"]?></td>
			<td class="Estilo1mc"><?php echo $row["ding_cant_final"]?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="2"><input type="submit" value="IMPRIMIR GUIA"></td>
		</tr>
</table>
<input type="hidden" name="qry" value="<?php echo $query?>">
<input type="hidden" name="nro_guia" value="<?php echo $doc_id ?>">
</form>
	</div>