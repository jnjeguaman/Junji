<?php $sql2 = "SELECT * FROM acti_compra_temporal WHERE id = ".$id ?>
<?php $sql2Resp = mysql_query($sql2) ?>
<?php while($row = mysql_fetch_array($sql2Resp)) { ?>
<div  style="width:540px; height:280px; background-color:#E0F8E0; position:absolute; top:405px; left:805px;" id="div2">
	<form name="form2" action="inv_graba_datosunidad.php" method="post"   onSubmit="return validar2()"  enctype="multipart/form-data">
		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">DATOS DE LA UNIDAD REQUIRENTE</td>
			</tr>

			<tr>
				<td  class="Estilo1">CANTIDAD TOTAL</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["compra_cantidad"] ?>">
				</td>

				<td  class="Estilo1">P BRUTO UNITARIO S/C</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="$ <?php echo number_format($row["compra_bruto_unitario"],0,".",".") ?>">
				</td>

			</tr>

			<tr>
				<td  class="Estilo1">UNIDAD O SECCION</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["compra_dpto"] ?>">
				</td>

				<td  class="Estilo1">SOLICITANTE</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["compra_responsable"] ?>">
				</td>
			</tr>

			<tr>
				<td  class="Estilo1">CENTRO RESPONSA</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["compra_direccion"] ?>">
				</td>

				<td  class="Estilo1">ZONA</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["compra_zona"] ?>">
				</td>
			</tr>

		</table>

	</form>
</div>
<?php } ?>