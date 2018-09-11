<?php
require_once("inc/config.php");
extract($_GET);
extract($_POST);

$sql = "SELECT * FROM acti_compra_temporal WHERE compra_ing_id = ".$ing_id." AND compra_ding_id = ".$ding_id;
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

$sqlCategoria = "SELECT * FROM acti_categoria ORDER BY cat_nombre";
$sqlCategoriaResp = mysql_query($sqlCategoria);

$sqlSubtitulo = "SELECT DISTINCT(acti_subtitulo),acti_subtitulo_dec_item FROM acti_subtitulo";
$sqlSubtituloResp = mysql_query($sqlSubtitulo);

$detalleProducto = "SELECT * FROM bode_detoc a INNER JOIN bode_detingreso b WHERE b.ding_id = ".$ding_id." AND a.doc_id = ".$doc_id;
$detalleProducto = mysql_query($detalleProducto);
$detalleProducto = mysql_fetch_array($detalleProducto);
$ocMonto = $row["compra_cantidad"] * $detalleProducto["doc_conversion"];
if($submit == "actualizar")
{
	$update = "UPDATE acti_compra_temporal SET compra_monto = '".$monto."', compra_grupo = '".$grupo."', compra_glosa = '".$subgrupo."', compra_item = '".$item."', compra_tipo_compra = '".$tipo_compra."', rc_subtitulo = '".$subtitulo."' WHERE compra_ing_id = ".$ing_id." AND compra_ding_id = ".$ding_id." AND id = ".$id;
	$update2 = "UPDATE bode_detoc SET doc_especificacion2 = '".$subgrupo."' WHERE doc_id = ".$doc_id;
	mysql_query($update);
	mysql_query($update2);
	echo "<script>opener.location.reload(); window.close();</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>
	<div style="width:100%; background-color:#E0F8E0; position:absolute; top:0px; left:0px;" id="div2">
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" onsubmit="return validar()">
			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo">DETALLE PRODUCTO A INVENTARIAR</td>
				</tr>
			</table>

			<hr>
			<table border="1" width="100%">
				<tr>
					<td class="Estilo1">GRUPO</td>
					<td class="Estilo1">
						<select name="grupo" id="grupo" class="Estilo1" onChange="getSubCat(this.value)">
							<option selected value="">Seleccionar...</option>
							<?php
							while($row = mysql_fetch_array($sqlCategoriaResp)) {
								?>
								<option value="<?php echo $row["cat_id"] ?>"><?php echo utf8_decode($row["cat_nombre"]) ?></option>
								<?php } ?>
							</select>
						</td>

						<td class="Estilo1">SUB-GRUPO</td>
						<td class="Estilo1">
							<select name="subgrupo" id="subgrupo" class="Estilo1" readonly>
								<option value="">Seleccionar...</option>
							</select>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">SUBTITULO</td>
						<td class="Estilo1">
							<select name="subtitulo" id="subtitulo" class="Estilo1" onChange="getSubtitulo(this.value)">
								<option selected value="">Seleccionar...</option>
								<?php
								while($row = mysql_fetch_array($sqlSubtituloResp)) {
									?>
									<option value="<?php echo $row["acti_subtitulo"] ?>"><?php echo $row["acti_subtitulo"]." : ".$row["acti_subtitulo_dec_item"] ?></option>
									<?php } ?>
								</select>
							</td>

							<td class="Estilo1">ITEM</td>
							<td class="Estilo1">
								<select name="item" id="item" class="Estilo1">
									<option selected value="">Seleccionar...</option>
								</select>
							</td>
						</tr>

						<tr>
							<td class="Estilo1">TIPO COMPRA</td>
							<td class="Estilo1">
								<select name="tipo_compra" id="tipo_compra" class="Estilo1">
									<option selected value="">Seleccionar...</option>
									<?php foreach ($tCompras as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
								<?php endforeach ?>
								</select>
							</td>

							<td class="Estilo1">MONTO TOTAL C / IVA</td>
							<td class="Estilo1"><input type="text" name="monto" id="monto" value="<?php echo $ocMonto ?>"></td>
						</tr>

						<tr>
							<td class="Estilo1mc" colspan="4"><button type="submit" name="submit" value="actualizar">ACTUALIZAR <i class="fa fa-refresh"></i></button></td>
						</tr>
					</table>
					<input type="hidden" name="ing_id" value="<?php echo $ing_id ?>">
					<input type="hidden" name="ding_id" value="<?php echo $ding_id ?>">
					<input type="hidden" name="doc_id" value="<?php echo $doc_id ?>">
					<input type="hidden" name="id" value="<?php echo $id ?>">
				</form>
			</div>

			<script type="text/javascript">

				function validar(){
					var grupo = $("#grupo").val();
					var subgrupo = $("#subgrupo").val();
					var subtitulo = $("#subtitulo").val();
					var item = $("#item").val();
					var tipo_compra = $("#tipo_compra").val();
					var monto = $("#monto").val();

					if(grupo == "")
					{
						alert("SELECCIONE UN GRUPO");
						$("#grupo").focus();
						return false;
					}else if(subgrupo == "")
					{
						alert("SELECCIONE UN SUB-GRUPO");
						$("#subgrupo").focus();
						return false;
					}else if(subgrupo == "")
					{
						alert("SELECCIONE UN SUBTITULO");
						$("#subtitulo").focus();
						return false;
					}else if(item == "")
					{
						alert("SELECCIONE UN ITEM");
						$("#item").focus();
						return false;
					}else if(tipo_compra == "")
					{
						alert("SELECCIONE EL TIPO DE COMPRA");
						$("#tipo_compra").focus();
						return false;
					}else if(monto == "")
					{
						alert("INGRESE EL MONTO TOTAL DE LA COMPRA");
						$("#monto").focus();
						return false;
					}else{
						if(confirm("¿ DESEA REALIZAR LA CARGA DE DATOS ?"))
						{
							return true;
						}else{
							return false;
						}
					}
				}
				function getSubCat(input) {
					var data = ({command : "getSubCat", catsub_cat_id : input});
					$.ajax({
						type:"POST",
						url:"inv_getsubcat.php",
						data:data,
						dataType:"JSON",
						cache:false,
						success:function(response) {
							var resp = "";
							resp +="<option selected value=''>Seleccionar</option>";
							$.each(response,function(index,value){
								resp +="<option value='"+value+"'>"+value+"</option>";
							});
							$("#subgrupo").html(resp);

						}
					})

				}

				function getSubtitulo(input) {
					var data = ({command : "getSubtitulo", acti_subtitulo : input});
					$.ajax({
						type:"POST",
						url:"inv_getsubtitulo.php",
						data:data,
						dataType:"JSON",
						cache:false,
						success:function(response) {
							var resp = "";
							resp +="<option selected value=''>Seleccionar...</option>";
							$.each(response,function(index,value){
								resp +="<option value='"+value.Subtitulo+"'>"+value.Subtitulo+" : "+value.Descripcion+"</option>";
							});
							$("#item").html(resp);

						}
					})
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
		</body>
		</html>
