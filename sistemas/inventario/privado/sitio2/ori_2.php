<?php
require("inc/config.php");
$sqlZona = "SELECT * FROM acti_zona WHERE zona_region = ".$_SESSION["region"];
$sqlZonaResp = mysql_query($sqlZona);
$sql22 = "SELECT * FROM acti_compra WHERE id = ".$_REQUEST["id"]." LIMIT 1";
$sql22Resp = mysql_query($sql22);
$row5 = mysql_fetch_array($sql22Resp);
?>


<?php if ($row5["compra_dpto"] == "" || $row5["compra_responsable"] == "" || $row5["compra_direccion"] == "" || $row5["compra_zona"] == ""): ?>
<form name="form2" action="inv_graba_datosunidad.php" method="post" onSubmit="return validar4()"  enctype="multipart/form-data">
		<table border="0" width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">DATOS DE LA UNIDAD REQUIRENTE</td>
			</tr>
		</table>
		<hr>
		<table border="0" width="100%">
			<tr>
				<td  class="Estilo1">UNIDAD O SECCION</td>
				<td  class="Estilo1">
					<?php if ($row5["compra_dpto"] == ""): ?>
						<input type="text" name="unidad_o_seccion" id="unidad_o_seccion" class="Estilo2">
					<?php else: ?>
						<input type="text" name="unidad_o_seccion" id="unidad_o_seccion" class="Estilo2" value="<?php echo $row5["compra_dpto"] ?>">
					<?php endif ?>
				</td>

				<td  class="Estilo1">SOLICITANTE</td>
				<td  class="Estilo1">
					<input type="text" name="solicitante" id="solicitante" class="Estilo2" value="<?php echo $row5["compra_responsable"] ?>">
				</td>
			</tr>

			<tr>
				<td  class="Estilo1">CENTRO RESPONSA</td>
				<td  class="Estilo1">
					<select name="responsa" id="responsa" class="Estilo2" onchange="getSubZona(this.value)">
						
							<option selected value="">Seleccionar...</option>
							<?php while($row1 = mysql_fetch_array($sqlZonaResp)) { ?>
							<option value="<?php echo $row1["zona_glosa"] ?>"<?php if($row1["zona_glosa"] == $row5["compra_direccion"]){echo"selected";}?>><?php echo $row1["zona_glosa"] ?></option>
							<?php } ?>
						
					</select>
				</td>

				<td  class="Estilo1">ZONA</td>
				<td  class="Estilo1">
					<select name="zona" id="zona" class="Estilo2">
						<?php if ($row5["compra_zona"] == ""): ?>
							<option selected value="">Seleccionar...</option>
						<?php else: ?>
							<option value="">Seleccione...</option>
							<option selected value="<?php echo $row5["compra_zona"] ?>"><?php echo $row5["compra_zona"] ?></option>
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
		<input type="hidden" name="ing_id" value="<?php echo $_REQUEST["ing_id"] ?>">
		<input type="hidden" name="compra_ding_id" value="<?php echo $_REQUEST["compra_ding_id"] ?>">
	</form>
	<hr>
<?php else: ?>

		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">DATOS DE LA UNIDAD REQUIRENTE</td>
			</tr>
		</table>
		<hr>
		<table border=0 width="100%">	
			<tr>
				<td  class="Estilo1">CANTIDAD TOTAL</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row5["compra_cantidad"] ?>">
				</td>

				<td  class="Estilo1">P BRUTO UNITARIO S/C</td>
				<td  class="Estilo1"><input type="text" class="Estilo2" disabled value="$ <?php echo number_format($row5["compra_bruto_unitario"],0,".",".") ?>"></td>
			</tr>

			<tr>
				<td  class="Estilo1">UNIDAD O SECCION</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row5["compra_dpto"] ?>">
				</td>

				<td  class="Estilo1">SOLICITANTE</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row5["compra_responsable"] ?>">
				</td>
			</tr>

			<tr>
				<td  class="Estilo1">CENTRO RESPONSA</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row5["compra_direccion"] ?>">
				</td>

				<td  class="Estilo1">ZONA</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row5["compra_zona"] ?>">
				</td>
			</tr>
		</table>
		<hr>
<?php endif ?>

<script type="text/javascript">
	function validar4(){
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
			blockUI();
			return true;;
		}
	}

	function getSubZona(input) {
			var data = ({command : "getSubZona", zona_id : input});
			$.ajax({
				type:"POST",
				url:"inv_getsubzona.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+value.subzona+"'>"+value.subzona+"</option>";
					});
					$("#zona").html(resp);

				}
			})
		}
</script>