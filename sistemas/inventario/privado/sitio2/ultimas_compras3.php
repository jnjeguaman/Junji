<div style="width:706px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<div id="seccion1" style="background-color:#E0F8E0;" >
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="11">RECEPCIONES PENDIENTES</td>
			</tr>

			<tr>
				<td class="Estilo1mc">ID</td>
				<td class="Estilo1mc">OC</td>
				<td class="Estilo1mc">SC</td>
				<td class="Estilo1mc">GLOSA</td>
				<td class="Estilo1mc">REGION</td>
				<td class="Estilo1mc">CANTIDAD</td>
				<td class="Estilo1mc">ITEM</td>
				<td class="Estilo1mc">VER</td>
				<td class="Estilo1mc">EDITAR</td>
				<td class="Estilo1mc">ESTADO</td>
				<?php if ($_SESSION["pfl_user"] <> 23): ?>
					<td class="Estilo1mc">ELIMINAR</td>
				<?php endif ?>
			</tr>

			<?
			if($atributo === 23)
			{
			$sql2 = "SELECT * FROM acti_compra WHERE (compra_estado = 0 OR compra_estado = 1)  AND compra_region_id = ".$_SESSION["region"]." ORDER BY compra_id ASC LIMIT 0,20";
			}else{
			$sql2 = "SELECT * FROM acti_compra WHERE compra_estado = 0 AND compra_region_id = ".$_SESSION["region"]." ORDER BY compra_id ASC LIMIT 0,20";	
			}
			
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
				$estilo2="Estilo1mc";
				
				$background = "style='background:lightgreen;'";
				?>
				<tr class="trh <?php echo $estilo2 ?>" <?php if($row2["id"] === $id){echo $background;} ?>>
					<td style="text-align: center;"><? echo $row2["compra_id"] ?></td>
					<td style="text-align: center;"><? echo $row2["oc_numero"] ?></td>
					<td style="text-align: center;"><? echo $row2["solicitud_numero"] ?></td>
					<td style="text-align: center;"><? echo $row2["compra_glosa"] ?></td>
					<td style="text-align: center;"><?php echo $row2["compra_region"] ?></td>
					<td style="text-align: center;"><? echo $row2["compra_cantidad"] ?></td>
					<td style="text-align: center;"><? echo $row2["compra_item"] ?></td>
					<?php if (intval($row2["compra_estado"]) === 1): ?>
						<td style="text-align: center;"><a href="inv_recepcion.php?ori=5&id=<? echo $row2["id"] ?>&compra_id=<?php echo $row2["compra_id"] ?>" class="link"><i class="fa fa-eye"></i></a></td>
						<td style="text-align: center;"></td>
						<td style="text-align: center;"><i class="fa fa-check fa-lg"></i></a></td>
					<?php else: ?>
						<td style="text-align: center;"><a href="inv_recepcion.php?ori=5&id=<? echo $row2["id"] ?>&compra_id=<?php echo $row2["compra_id"] ?>" class="link"><i class="fa fa-eye"></i></a></td>
						<?php if ($atributo != 23): ?>
						<!--<td class="<? echo $estilo2 ?>"><a href="inv_recepcion.php?ori=6&id=<? echo $row2["id"] ?>&compra_id=<?php echo $row2["compra_id"] ?>" class="link"><i class="fa fa-pencil-square"></i></a></td>!-->
						<td style="text-align: center;"><a href="inv_recepcion.php?ori=6&cod=11&id=<? echo $row2["id"] ?>&compra_id=<?php echo $row2["compra_id"] ?>&ing_id=<?php echo $row2["compra_ing_id"] ?>&compra_ding_id=<?php echo $row2["compra_ding_id"] ?>" class="link"><i class="fa fa-pencil-square"></i></a></td>
							<?php else: ?> 
								<td style="text-align: center;" class="<? echo $estilo2 ?>"></td>
						<?php endif ?>
						<td style="text-align: center;"><i class="fa fa-warning fa-lg"></i></td>
					<?php endif ?>
					<?php if ($_SESSION["pfl_user"] <> 23): ?>
						<td style="text-align: center;"><a href="inv_recepcion_borrar.php?id=<?php echo $row2["id"]?>" onClick="return confirm('¿ ESTÁ SEGURO DE ELIMINAR LA RECEPCION INDICADA ?')"><i class="fa fa-trash link fa-lg"></i></td>
					<?php endif ?>
				</tr>

				<?
				$cont++;
			}
			?>

		</table>
	</div>
</div>

<script type="text/javascript">
	function eliminarItem(input) {
		var data = ({cmd : "eliminarItem", compra_id : input});

		$.ajax({
			type:"POST",
			url:"inv_eliminar_compra.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success : function ( response ) {
				console.log(response);
			}
		});
	}
</script>
