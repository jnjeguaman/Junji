<?php 
require_once("inc/config.php");
extract($_POST);
$cont = 0;
?>
<div style="width:750px;background-color:#E0F8E0; position:absolute; top:160px; left:0px;" id="div1">
<table border="0" width="100%">
	<tr>
		<td class="Estilo2titulo">BUSCAR PRODUCTO</td>
	</tr>
</table>

<!-- FORMULARIO DE BUSQUEDA !-->
<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
	<table border="0" width="50%">
		<tr class="Estilo1">
			<td>ORDEN DE COMPRA</td>
			<td><input type="text" name="oc" id="oc" value="<?php echo $oc; ?>"></td>
		</tr>

		<tr class="Estilo1">
			<td <?php echo $class ?>>BIEN</td>
			<td><input type="text" name="bien" id="bien" value="<?php echo $bien; ?>"></td>
		</tr>

		<tr>
			<td></td>
			<td><input type="submit" name="submit"value="BUSCAR"></td>
		</tr>

	</table>
</form>
<!-- FIN FORMULARIO !-->
</div>
<?php
if(isset($submit) && $submit == "BUSCAR")
{
	if($_SESSION["region"] == 16)
	{
		$wherer = "(b.doc_region = 16 or b.doc_region = 13) AND ";
	}else{
		$wherer = "b.doc_region = ".$_SESSION["region"]." AND ";
	}
	if($oc <> '')
	{
		$where = "a.oc_id2 LIKE '%".$oc."%' AND ";
	}

	if($bien <> '')
	{
		$where2 = "b.doc_especificacion LIKE '%".$bien."%' AND ";
	}
	$query = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b ON a.oc_id = b.doc_oc_id INNER JOIN bode_detingreso c ON c.ding_prod_id = b.doc_id INNER JOIN bode_ingreso d on d.ing_id = c.ding_ing_id WHERE $wherer $where $where2 (a.oc_tipo = 0 OR a.oc_tipo = 1) AND c.ding_recep_tecnica = 'A' AND c.ding_recep_conforme = 'C'  AND b.doc_estado <> 'B' AND d.ing_estado = 1";

	echo $query;
	$res = mysql_query($query);
	$totalRegistros = mysql_num_rows($res);
}
?>
<?php if ($submit == "BUSCAR"): ?>
<div  style="width:750px; background-color:#E0F8E0; position:absolute; top:160px; left:755px;" id="div2">
	<!-- RESULTADO !-->
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo">RESULTADO</td>
		</tr>
	</table>
<?php if ($totalRegistros > 0): ?>
	<form action="bode_ajustes_gr.php" method="POST" onSubmit="return validar()">
		<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr class="Estilo1mc">
			<td colspan="6" align="left"><input type="checkbox" name="toggle" id="toggle">Seleccionar Todo</td>
		</tr>
			<tr class="Estilo1mc">
				<td></td>
				<td>ORDEN DE COMPRA</td>
				<td>BIEN</td>
				<td>UNIDAD DE MEDIDA</td>
				<td>STOCK</td>
				<td>NUEVO</td>
			</tr>

			<?php while($row = mysql_fetch_array($res)) { ?>
			<tr class="Estilo1mc trh" >
				<td>
					<input type="hidden" name="var4[<?php echo $cont ?>]" value="<?php echo $row["doc_id"] ?>">
					<input type="checkbox" name="var1[<?php echo $cont ?>]" id="var1_<?php echo $cont ?>" value="<?php echo $row["ding_id"] ?>">
				</td>
				<td><?php echo $row["oc_id2"] ?></td>
				<td><?php echo $row["doc_especificacion"] ?></td>
				<td><?php echo $row["ding_umedida"] ?></td>
				<td><input type="hidden" name="var3[<?php echo $cont ?>]" value="<?php echo $row["ding_unidad"] ?>"><?php echo $row["ding_unidad"] ?></td>
				<td><input type="number" name="var2[<?php echo $cont ?>]" min="0" value="<?php echo $row["ding_unidad"] ?>"></td>
			</tr>
			<?php $cont++ ?>
			<?php } ?>
			<tr>
				<td colspan="6" align="right"><button type="submit" value="AJUSTAR">AJUSTAR</button></td>
			</tr>
		</table>
		<input type="hidden" name="totalItems" value="<?php echo $cont ?>">
		<input type="hidden" name="oc" value="<?php echo $oc ?>">
		<input type="hidden" name="bien" value="<?php echo $bien ?>">
		
	</form>
	<?php else: ?>
<p class="Estilo2titulo"><i class="fa fa-warning fa-2x"></i> No se encontraron resultados.</p>
<ul>
<li style="list-style: none;">Posibles Causas : </li>
<li style="list-style: none;"><i class="fa fa-arrow-circle-right"></i> Entrega directamente a jardin infantil</li>
<li style="list-style: none;"><i class="fa fa-arrow-circle-right"></i> Entrega directamente a oficina</li>
<li style="list-style: none;"><i class="fa fa-arrow-circle-right"></i> Orden de compra y/o bien erroneos</li>

 </ul>
<?php endif ?>
<?php endif ?>
</div>

<script type="text/javascript">

$("#toggle").click(function(event)
	{
		if($("#toggle").is(":checked"))
		{
			$(':checkbox').each(function() {
				this.checked = true;                        
			});
		}else{
			$(':checkbox').each(function() {
				this.checked = false;                        
			});
		}
	});

	function validar()
	{
		var numberOfChecked = $('input:checkbox:checked').length;
		numberOfChecked = parseInt(numberOfChecked);
		
		if(numberOfChecked == 0)
		{
			alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA");
			return false;
		}else{
			if(confirm("¿ ESTA SEGURO DE MODIFICAR LOS ELEMENTOS SELECCIONADOS ?"))
			{
				return true;
			}else{
				return false;
			}
		}
	}
</script>