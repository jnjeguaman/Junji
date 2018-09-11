
<?php $sql2 = "SELECT * FROM acti_compra_temporal WHERE id = ".$id." LIMIT 1" ?>
<?php $sql2Resp = mysql_query($sql2) ?>
<?php while($row2 = mysql_fetch_array($sql2Resp)){ ?>
<div  style="width:540px; background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">

	<form name="form2" action="inv_graba_datosunidad.php" method="post" onSubmit="return validar2()"  enctype="multipart/form-data">
		<table border="0" width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">DATOS DE LA UNIDAD REQUIRENTE</td>
			</tr>
		</table>
		<table border="0" width="100%">
			<tr>
				<td  class="Estilo1">UNIDAD O SECCION</td>
				<td  class="Estilo1">
					<?php if ($row2["compra_dpto"] == ""): ?>
						<input type="text" name="unidad_o_seccion" id="unidad_o_seccion" class="Estilo2">
					<?php else: ?>
						<input type="text" name="unidad_o_seccion" id="unidad_o_seccion" class="Estilo2" value="<?php echo $row2["compra_dpto"] ?>">
					<?php endif ?>
				</td>

				<td  class="Estilo1">SOLICITANTE</td>
				<td  class="Estilo1">
					<input type="text" name="solicitante" id="solicitante" class="Estilo2" value="<?php echo $row2["compra_responsable"] ?>">
				</td>
			</tr>

			<tr>
				<td  class="Estilo1">CENTRO RESPONSA</td>
				<td  class="Estilo1">
					<select name="responsa" id="responsa" class="Estilo2" onchange="getSubZona(this.value)">
						
							<option selected value="">Seleccionar...</option>
							<?php while($row = mysql_fetch_array($sqlZonaResp)) { ?>
							<option value="<?php echo $row["zona_glosa"] ?>"<?php if($row["zona_glosa"] == $row2["compra_direccion"]){echo"selected";}?>><?php echo $row["zona_glosa"] ?></option>
							<?php } ?>
						
					</select>
				</td>

				<td  class="Estilo1">ZONA</td>
				<td  class="Estilo1">
					<select name="zona" id="zona" class="Estilo2">
						<?php if ($row2["compra_zona"] == ""): ?>
							<option selected value="">Seleccionar...</option>
						<?php else: ?>
							<option value="">Seleccione...</option>
							<option selected value="<?php echo $row2["compra_zona"] ?>"><?php echo $row2["compra_zona"] ?></option>
						<?php endif ?>
					</select>
				</td>
			</tr>

		</table>

		<table border="0" width="100%">
			<tr>
				<td  class="Estilo1c">
					<input type="submit" name="submit" class="Estilo2" size="11" value="    GRABAR    " >
				</td>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $_REQUEST["id"] ?>">
		<input type="hidden" name="compra_id" value="<?php echo $_REQUEST["compra_id"] ?>">
	</form>

	<?php } ?>
	<br>
	<hr>
	<?php $sql2 = "SELECT * FROM acti_compra_temporal WHERE id = ".$id ?>
	<?php $sql2Resp = mysql_query($sql2) ?>
	<?php while($row = mysql_fetch_array($sql2Resp)) { ?>
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
	<?php } ?>

</div>
<script type="text/javascript">
	function validar2(){
		if(document.getElementById("unidad_o_seccion").value == ""){
			alert("INGRESAR LA UNIDAD O SECCION");
			document.getElementById("unidad_o_seccion").focus();
			return false;
		}else if(document.getElementById("solicitante").value == ""){
			alert("INGRESAR EL SOLICITANTE");
			document.getElementById("solicitante").focus();
			return false;
		}else if(document.getElementById("responsa").value == ""){
			alert("SELECCIONAR EL CENTRO DE RESPONSA");
			document.getElementById("responsa").focus();
			return false;
		}else if(document.getElementById("zona").value == ""){
			alert("SELECCIONAR LA ZONA");
			document.getElementById("zona").focus();
			return false;
		}else{
			return true;
		}
	}
</script>






