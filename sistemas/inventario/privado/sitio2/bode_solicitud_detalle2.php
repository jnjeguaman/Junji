<?php
$sql = "SELECT * FROM 
bode_solicitud a 
-- INNER JOIN bode_detoc3 b ON a.sp_id = b.doc_sp_id 
INNER JOIN jardines c ON c.jardin_codigo = a.sp_destino 
WHERE 
a.sp_tipo_destino = 3 
AND c.jardin_region = 13 
GROUP BY a.sp_destino DESC
ORDER BY c.jardin_sector ASC";
$res = mysql_query($sql);
?>
<div  style="width:770px; background-color:#E0F8E0; position:absolute; top:0px; left:710px;" id="div2">
	<table border="1" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="5">LISTADO DE PRODUCTOS</td>
		</tr>

		<tr>
			<td class="Estilo1mc">JARDIN</td>
			<td class="Estilo1mc">SECTOR</td>
			<td class="Estilo1mc">NOMBRE</td>
			<td class="Estilo1mc">PRODUCTOS</td>
		</tr>
		<?php while($row = mysql_fetch_array($res)) { ?>
		<tr>
			<td class="Estilo1mc"><?php echo $row["jardin_codigo"] ?></td>
			<td class="Estilo1mc"><?php echo $row["jardin_sector"] ?></td>
			<td class="Estilo1mc"><?php echo $row["jardin_nombre"] ?></td>
			<td class="Estilo1mc">
				<?php 
				$sql2 = "SELECT * FROM bode_solicitud a INNER JOIN bode_detoc3 b ON b.doc_sp_id = a.sp_id WHERE a.sp_destino = ".$row["sp_destino"];
				$res2 = mysql_query($sql2);
				while($row2 = mysql_fetch_array($res2)) { ?>
				<?php echo $row2["doc_especificacion"]." / ".$row2["doc_cantidad"]."<br>" ?>

				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>