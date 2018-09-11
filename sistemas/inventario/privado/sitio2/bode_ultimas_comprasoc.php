<div style="width:540px; height:280px; background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">ULTIMOS SOLICITUDES DE COMPRA</td>
			</tr>

			<tr>
				<td class="Estilo1mc">ID</td>
				<td class="Estilo1mc">GLOSA</td>
				<td class="Estilo1mc">REGION</td>
				<td class="Estilo1mc">CANTIDAD</td>
				<td class="Estilo1mc">ITEM</td>
				<td class="Estilo1mc">REGION</td>
				<td class="Estilo1mc">RC</td>
				<td class="Estilo1mc">ESTADO</td>
				<td class="Estilo1mc">Eliminar</td>
			</tr>

			<?
			$sql2 = "SELECT * FROM bod_orcom WHERE oc_region = ".$_SESSION["region"]." ORDER by oc_id desc limit 0,200";
   //1echo $sql;
			$res2 = mysql_query($sql2);
			$cont=1;
			while ($row2 = mysql_fetch_array($res2)) {
				$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
					if ($row2["soli_tipo"]=='Emergencias o Urgencias') {
						$estilo2="Estilo1mcRojo";
					}
				} else {
					$estilo2="Estilo1mcblanco";
					if ($row2["soli_tipo"]=='Emergencias o Urgencias') {
						$estilo2="Estilo1mcblancoRojo";
					}

				}

				

				?>
				<tr>
					<td class="<? echo $estilo2 ?>"><? echo $row2["compra_id"] ?></td>
					<td class="<? echo $estilo2 ?>"><? echo $row2["compra_glosa"] ?></td>
					<td class="<? echo $estilo2 ?>"><?php echo $row2["compra_region"] ?></td>
					<td class="<? echo $estilo2 ?>"><? echo $row2["compra_cantidad"] ?></td>
					<td class="<? echo $estilo2 ?>"><? echo $row2["compra_item"] ?></td>
					<td class="<? echo $estilo2 ?>"><? echo $row2["compra_region_id"] ?></td>
					<td  class="<? echo $estilo2 ?>"><a href="inv_index.php?ori=1&id_oc=<? echo $v_oc_id ?>" class="link"><i class="fa fa-check">555</i></a></td>
					
					<?php if (intval($row2["compra_estado"]) === 1): ?>
						<td class="<? echo $estilo2 ?>"><a href="#" class="link"><i class="fa fa-plus"></i></a></td>
						<td class="<? echo $estilo2 ?>"><i class="fa fa-check fa-lg"></i></a></td>
					<?php else: ?>
						<td class="<? echo $estilo2 ?>"><a href="inv_recepcion.php?ori=6&id=<? echo $row2["id"] ?>&compra_id=<?php echo $row2["compra_id"] ?>" class="link"><i class="fa fa-plus"></i></a></td>
						<td class="<? echo $estilo2 ?>"><i class="fa fa-warning fa-lg"></i></td>
					<?php endif ?>
					<td class="<? echo $estilo2 ?>"><a href="#" onClick="eliminarItem(<?php echo intval($row2["id"]) ?>,<?php echo intval($row2["compra_id"]) ?>)" class="link"><i class="fa fa-times"></i></a></td>
				</tr>

				<?
				$cont++;
			}
			?>

		</table>
</div>

<script type="text/javascript">
	function eliminarItem(id,compra_id) {
		var data = ({cmd : "eliminarItem", id : id, compra_id : compra_id});
		$.ajax({
			type:"POST",
			url:"inv_eliminar_compra.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success : function ( response ) {
				if(response == true) {
					window.location.reload();
				}
			}
		});
	}
</script>
