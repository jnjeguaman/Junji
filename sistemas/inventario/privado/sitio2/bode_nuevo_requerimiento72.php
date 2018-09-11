<link rel="stylesheet" type="text/css" href="librerias/jqueryui/jquery-ui.css">
<script src="librerias/jqueryui/jquery-ui.js"></script>
<?php
$sql = "SELECT * FROM bode_solicitud WHERE sp_id = ".$id;
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$fechaSolicitud = substr($row["sp_fecha"], 8,9)."-".substr($row["sp_fecha"], 5,2)."-".substr($row["sp_fecha"],0,4);
?>
<div style="width:800px;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<table border="1" width="100%">
		<tr>
			<td colspan="2" class="Estilo2titulo" align="center">SOLICITUD DE PEDIDO</td>
		</tr>

		<tr>
			<td class="Estilo1">Solicitante</td>
			<td class="Estilo1"><?php echo $row["sp_usuario"] ?></td>
		</tr>
		<tr>
			<td class="Estilo1">Fecha Solicitud</td>
			<td class="Estilo1"><?php echo $fechaSolicitud ?> a las <?php echo $row["sp_hora"] ?></td>
		</tr>

		<tr>
			<td class="Estilo1">Destino</td>
			<td class="Estilo1">
				<?php if ($row["sp_tipo_destino"] == 2): ?>
					<?php 
					// ECHO $sql3 = "SELECT * FROM acti_zona WHERE zona_glosa = '".$row["sp_destino"]."'";
					echo $row["sp_destino"];
					?>
				<?php else: ?>
					<?php 
					$sql3 = "SELECT * FROM jardines WHERE jardin_codigo = ".$row["sp_destino"];
					$res3 = mysql_query($sql3);
					$row3 = mysql_fetch_array($res3);
					echo $row3["jardin_nombre"]." / ".$row3["jardin_codigo"];
					?>
				<?php endif ?>
			</td>
		</tr>

		<tr>
			<td class="Estilo1">Unidad Requirente</td>
			<td class="Estilo1"><?php echo $row["sp_unidad_requirente"] ?></td>
		</tr>

		<tr>
			<td class="Estilo1">Tipo de Solicictud</td>
			<td class="Estilo1"><?php echo ($row["sp_tipo_bien"] == 1) ? "INVENTARIABLE" : "EXISTENCIA" ?></td>
		</tr>
	</table>
	<hr>
	<form action="bode_inv_grabaindexoc72.php" method="POST" onsubmit="return validar();">
		<table border="1" width="100%">
			<tr>
				<td class="Estilo1">Producto a solicitar</td>
				<td><input type="text" name="item" id="item" size="70"></td>
			</tr>

			<tr>
				<td class="Estilo1">Cantidad a solicitar</td>
				<td><input type="number" min="1" name="cantidad" id="cantidad"></td>
			</tr>

			<tr>
				<td></td>
				<td><button class="btn btn-black">Añadir</button></td>
			</tr>

		</table>
		<input type="hidden" name="region" id="region" value="<?php echo $regionsession ?>"><br>
		<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $id ?>"><br>
		<input type="hidden" name="sp_region_destino" id="sp_region_destino" value="<?php echo $row["sp_region_destino"] ?>"><br>
		<input type="hidden" name="ding_clasificacion" id="ding_clasificacion">
		<input type="hidden" name="doc_conversion" id="doc_conversion">
		<input type="hidden" name="doc_item" id="doc_item">
		<input type="hidden" name="doc_gasto" id="doc_gasto">
		<input type="hidden" name="doc_factor" id="doc_factor">
		<input type="hidden" name="doc_activo" id="doc_activo">
	</form>
	<hr>
	<table border="1" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="5">PRODUCTOS SOLICITADOS</td>
		</tr>

		<tr>
			<td class="Estilo1mc">#</td>
			<td class="Estilo1mc">PRODUCTO</td>
			<td class="Estilo1mc">CANTIDAD SOLICITADA</td>
			<td class="Estilo1mc">ELIMINAR</td>
			<td class="Estilo1mc">MODIFICAR</td>
		</tr>

		<?php 
		$contador = 1;
		if($sp_matriz <> "")
		{
			$sql2 = "SELECT * FROM bode_detoc3 a INNER JOIN bode_solicitud b on a.doc_sp_id = b.sp_id WHERE b.sp_matriz = ".$sp_matriz." AND a.doc_estado <> 'ELIMINADO'";
		}else{
			$sql2 = "SELECT * FROM bode_detoc3 WHERE doc_sp_id = ".$id." AND doc_estado <> 'ELIMINADO'";
		}
		// echo $sql2;
		$res2 = mysql_query($sql2);
		while($row2 = mysql_fetch_array($res2)) {
			?>
			<tr>
				<td class="Estilo1mc"><?php echo $contador ?></td>
				<td class="Estilo1mc"><?php echo $row2["doc_especificacion"] ?></td>
				<td class="Estilo1mc"><input type="number" min="1" value="<?php echo $row2["doc_cantidad"] ?>" id="var1_<?php echo $contador ?>"></td>
				<td class="Estilo1mc"><a href="bode_inv_grabaindexoc72.php?action=1&id=<?php echo $row2["doc_id"] ?>&np_id=<?php echo $row2["doc_sp_id"] ?>" class="link" onClick="return confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA SOLICITUD ?')">Eliminar</a></td>
				<td class="Estilo1mc"><a href="#" onClick="actualizarCantidad(<?php echo $contador ?>,<?php echo $row2["doc_sp_id"] ?>,<?php echo $row2["doc_id"] ?>)"><i class="fa fa-refresh link fa-2x"></i></a></td>
			</tr>
			<?php $contador++;} ?>
			<?php if (mysql_num_rows($res2) <> 0): ?>
				<form action="bode_inv_grabaindexoc72.php" method="POST">
					<tr>
						<td colspan="5" align="right"><button class="btn btn-blue">Enviar Solicitud</button></td>
					</tr>

					<input type="hidden" name="action" value="2">
					<input type="hidden" name="sp_id" value="<?php echo $id ?>">
					<input type="hidden" name="sp_matriz" value="<?php echo $sp_matriz ?>">
				</form>
			<?php endif ?>

		</table>
	</div>

	<script type="text/javascript">
		$(function(){
			$("#item").keyup(function(event2){
				var texto = $("#item").val();
				var region = $("#region").val();
				var destino = $("#sp_region_destino").val();
				var tipo_bien = <?php echo $row["sp_tipo_bien"] ?>;

				$("#item").autocomplete({
					minLength: 1,
					source : "buscar_articulo.php?s="+texto+"&region="+region+"&sp_region_destino="+destino+"&tipo_bien="+tipo_bien,
					select: function (event, ui){

						event.preventDefault();
						$("#item").val(ui.item.label);
						$("#ding_clasificacion").val(ui.item.clasificacion);
						$("#cantidad").attr("max",ui.item.Stock);
						$("#doc_conversion").val(ui.item.unitario);
						$("#doc_item").val(ui.item.item);
						$("#doc_gasto").val(ui.item.gasto);
						$("#doc_factor").val(ui.item.factor);
						$("#doc_activo").val(ui.item.activo);
					}
				})
			})
		})

		function validar()
		{
			var item = document.getElementById("item").value;
			var cantidad = document.getElementById("cantidad").value;
			if(item == "")
			{
				alert("Porfavor ingrese el producto");
				document.getElementById("item").focus();
				return false;
			}else if(cantidad == 0 || cantidad == "")
			{
				alert("Ingrese la cantidad");
				$("#cantidad").focus();
				return false;
			}else{
				return true;
			}
		}

		function actualizarCantidad(contador,solicitud_id,producto_id)
		{

			var cantidad = $("#var1_"+contador).val();
			var data = ({cantidad : cantidad,solicitud_id : solicitud_id, producto_id : producto_id});
			$.ajax({
				type:"POST",
				url:"bode_solicitud_actualiza_cantidad.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
				if(response)
				{
					window.location.reload();
				}
				}
			});
		}
	</script>