<?php
session_start();
extract($_GET);
extract($_POST);
require("inc/config.php");
//unset($_SESSION["Actualizacion"]);
/* BUSQUEDA POR FILTRO */

$sqlZona = "SELECT * FROM acti_zona WHERE zona_region = ".$_SESSION["region"];
$sqlZonaResp = mysql_query($sqlZona);

$regiones = "SELECT * FROM acti_region";
$regiones = mysql_query($regiones);

$sqlGrupo = "SELECT * FROM acti_categoria WHERE cat_estado = 1";
$sqlGrupoRes = mysql_query($sqlGrupo);

if($submit == "avanzada")
{

if($a_cinventario <> "")
{
$where.=" AND inv_codigo LIKE '%".$a_cinventario."%'";
}
if($a_fresponsable <> "")
{
$where.=" AND inv_responsable LIKE '%".$a_fresponsable."%'";
}
if($a_direccion <> "")
{
$where.=" AND inv_direccion LIKE '%".$a_direccion."%'";
}
if($a_zona <> "")
{
$where.=" AND inv_zona LIKE '%".$a_zona."%'";
}
if($a_ccontable <> "")
{
$where.=" AND inv_ccontable LIKE '%".$a_ccontable."%'";
}
if($a_oc <> "")
{
$where.=" AND inv_oc LIKE '%".$a_oc."%'";
}
if($a_adevengo <> "")
{
$where.=" AND YEAR(inv_devengofecha) = ".$a_adevengo;
}
if($a_mdevengo <> "")
{
$data = explode("/", $a_mdevengo);
$where.=" AND YEAR(inv_devengofecha) = ".$data[1]." AND MONTH(inv_devengofecha) = ".$data["0"];
}
if($a_estado <> "")
{
$where.=" AND inv_estadocosto LIKE '%".$a_estado."%'";
}
if($a_bien <> "")
{
$where.=" AND inv_bien LIKE '%".$a_bien."%'";
}
if($a_programa <> "")
{
$where.=" AND inv_programa LIKE '%".$a_programa."%'";
}
if($a_res_baja <> "")
{
$where.=" AND inv_baja LIKE '%".$a_res_baja."%'";
}

if($a_nro_rc <> "")
{
	$where.=" AND inv_nro_rece = ".$a_nro_rc;
}
$consulta = "SELECT * FROM acti_inventario WHERE (inv_estado2 = 1 OR inv_estado2 = 0) $where AND inv_region = ".$_SESSION["region"]." AND inv_visible = 1 ORDER BY inv_id DESC";
$resultado = mysql_query($consulta);
}

if ($filtro <> "" && $submit == "BUSCAR")
{		
	/* CODIGO DE INVENTARIO */
	if($filtro == 1){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_codigo LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";
	}

	/* FUNCIONARIO RESPONSABLE */
	if($filtro == 2){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_responsable LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";
	}

	/* DIRECCION */
	if($filtro == 3){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_direccion LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";
	}

	/* ZONA */
	if($filtro == 4){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_zona LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";

		/* CUENTA CONTABLE */
	}if($filtro == 5){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_ccontable LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";

		/* AÑO DE DEVENGO */
	}if($filtro == 6){
		$consulta = "SELECT * FROM acti_inventario WHERE $where YEAR(inv_devengofecha) = ".$clave." AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";

		/* MES DE DEVENGO */
	}if($filtro == 7){
		$params = explode("/", $clave);
		$mes = intval($params[0]);
		$anno = intval($params[1]);
		$consulta = "SELECT * FROM acti_inventario WHERE $where MONTH(inv_devengofecha) = ".$mes." AND YEAR(inv_devengofecha) = ".$anno." AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";


		/* ORDEN DE COMPRA */
	}if($filtro == 8){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_oc LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";

		/* ESTADO */
	}if($filtro == 9){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_estadocosto = '".$clave."' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";

		/* BIEN */
	}if($filtro == 10){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_bien LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";

		/* PROGRAMA */
	}if($filtro == 11){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_programa LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1";

		/* RESOLUCION DE BAJA */
	}if($filtro == 12){
		$consulta = "SELECT * FROM acti_inventario WHERE $where inv_baja LIKE '%".$clave."%' AND inv_region = ".$_SESSION["region"]." AND (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_visible = 1";
	}
	$resultado = mysql_query($consulta);
}

/* AGREGAR PRODUCTOS A LA LISTA */
if($submit == "AGREGAR")
{
	for ($i=1; $i <= $totalLinea; $i++) { 
		if($var[$i] <> "")
		{
			if(!existeCodigo($var[$i]))
			{
				$max = count($_SESSION["Actualizacion"]);
				$_SESSION["Actualizacion"][] = array("codigo" => $var[$i], "bien" => $var2[$i],"id" => $var3[$i]);
			}
		}
	}
}

function existeCodigo($input)
{
	foreach ($_SESSION["Actualizacion"] as $key => $value) {
		if($value["codigo"] == $input)
		{
			return true;
			break;
		}
	}
}

/* ELIMINAR DE LA LISTA */
if($action == "Eliminar")
{
	foreach ($_SESSION["Actualizacion"] as $key => $value) {
		if($value["codigo"] == $inv_codigo)
		{
			unset($_SESSION["Actualizacion"][$key]);
		}
	}
}

if($action == "Vaciar")
{
	unset($_SESSION["Actualizacion"]);
}


/* ACTUALIZAR PRODUCTOS */
if($submit == "ACTUALIZAR")
{
	foreach ($_SESSION["Actualizacion"] as $key => $value) {

		if($inv_calidad <> "")
		{
			$edit1 = "inv_calidad = '".$inv_calidad."',";
		}

		if($inv_estadocosto <> "")
		{
			$edit2 = "inv_estadocosto = '".$inv_estadocosto."', ";
		}

		if($inv_responsable <> "")
		{
			$inv_responsable = str_replace(["Ñ","Á","É","Í","Ó","Ú","Ü","°","\""],["N","A","E","I","O","U","U","",""], $inv_responsable);
			$edit3 = "inv_responsable = '".$inv_responsable."',";
		}

		if($responsa <> "")
		{
			$edit4 = "inv_direccion = '".$responsa."',";
		}

		if($inv_zona <> "")
		{
			$edit5 = "inv_zona = '".$inv_zona."',";
		}

		if($inv_comprobante_egreso <> "")
		{
			$edit6 = "inv_comprobante_egreso = '".$inv_comprobante_egreso."',";
		}

		if($inv_devengofecha <> "")
		{
			$edit7 = "inv_devengofecha = '".$inv_devengofecha."',";
		}

		if($inv_cta_contable <> "")
		{
			$edit8 = "inv_ccontable = '".$inv_cta_contable."',";
		}

		if($inv_num_factura)
		{
			$edit9 = "inv_num_factura = '".$inv_num_factura."',";
		}

		if($inv_fecha_factura)
		{
			$edit10 = "inv_fecha_factura = '".$inv_fecha_factura."',";
		}

		if($inv_anno <> "")
		{
			$edit11 = "inv_anno = '".$inv_anno."',";
		}

		if($inv_altares <> "")
		{
			$edit12 = "inv_altares = '".$inv_altares."',";
		}

		if($inv_altafecha <> "")
		{
			$edit13 = "inv_altafecha = '".$inv_altafecha."',";
		}

		if($inv_baja <> "")
		{
			$edit14 = "inv_baja = '".$inv_baja."', inv_estado2 = 0,";
		}

		if($inv_bajafecha <> "")
		{
			$edit15 = "inv_bajafecha = '".$inv_bajafecha."',";	
		}

		if($subgrupo <> "")
		{
			$edit16 = "inv_bien = '".$subgrupo."',";
		}
		if($observacion <> "")
		{
			$edit17 = "inv_obs = '".$observacion."',";
		}
		$actualizar = "UPDATE acti_inventario SET $edit1$edit2$edit3$edit4$edit5$edit6$edit7$edit8$edit9$edit10$edit11$edit12$edit13$edit14$edit15$edit16$edit17 WHERE inv_id = '".$value["id"]."'";
		$actualizar = str_replace(", WHERE", " WHERE", $actualizar);
		mysql_query($actualizar);
	}
	unset($_SESSION["Actualizacion"]);
	echo "<script>window.location.href='inv_actualizacion.php';</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<script type="text/javascript" src="librerias/jquery.printPage.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php
		include("inc/menu_1b.php");
		?>
	</div>

	<div style="background-color:#E0F8E0; position:absolute; top:120px; left:00px; width:800px" id="div1">
		<form action="inv_actualizacion.php" name="frmActualizacion" method="POST">

		<?php if ($ori==1): ?>
			<?php  include("inv_actualizacion_1.php") ?>
			<?php else: ?> 
				<?php  include("inv_actualizacion_2.php") ?>
		<?php endif ?>
</form>
		<?php if (mysql_num_rows($resultado) > 0): ?>
			<form action="inv_actualizacion.php" method="POST" onSubmit="return valRes()">
				<hr>
				<table border='1' cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td class="Estilo2titulo" colspan="15">RESULTADO BUSQUEDA</td>
					</tr>

					<tr>
						<td class="Estilo1" colspan="15">
							<input type="checkbox" name="toggle" id="toggle">Seleccionar Todo
							<input type="checkbox" name="despacho" id="despacho">G/D
						</td>
					</tr>

					<tr>
						<th></th>
						<th></th>
						<th class='Estilo1mc'>OC</th>
						<th class='Estilo1mc'>CODIGO</th>
						<th class='Estilo1mc'>BIEN</th>
						<th class='Estilo1mc'>PROGRAMA</th>
						<th class='Estilo1mc'>ESTADO</th>
						<th class='Estilo1mc'>COSTO</th>
						<th class='Estilo1mc'>DIRECCION</th>
						<th class='Estilo1mc'>ZONA</th>
						<th class='Estilo1mc'>RESPONSABLE</th>
						<th class='Estilo1mc'>C. CONTABLE</th>
						<th class='Estilo1mc'>DEVENGO</th>
						<th class='Estilo1mc'>N° FACTURA</th>
						<th class='Estilo1mc'>N° DEVENGO</th>
					</tr>

					<?php 
					$cont = 0;
					$cont2 = 1;
					while($rowRes = mysql_fetch_array($resultado)) { 
						$estilo=$cont%2;
						if ($estilo==0) {
							$estilo2="Estilo1mc";
						} else {
							$estilo2="Estilo1mcblanco";
						}
						$cont++;?>
						<tr class="<?php echo $estilo2 ?> trh">
							<td><?php echo $cont ?></td>
							<td align="center"><input type="checkbox" name="var[<?php echo $cont ?>]" id="var1_<?php echo $cont ?>" value="<?php echo $rowRes["inv_codigo"] ?>"></td>
							<td><?php echo $rowRes["inv_oc"] ?></td>
							<td><?php echo $rowRes["inv_codigo"] ?></td>
							<td><input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $rowRes["inv_bien"] ?>"><?php echo $rowRes["inv_bien"] ?></td>
							<td><?php echo $rowRes["inv_programa"] ?></td>
							<td><?php echo $rowRes["inv_estadocosto"] ?></td>
							<td>$<?php echo number_format($rowRes["inv_costo"],0,".",".")?></td>
							<td><?php echo $rowRes["inv_direccion"] ?></td>
							<td><?php echo $rowRes["inv_zona"] ?></td>
							<td><?php echo $rowRes["inv_responsable"] ?></td>
							<td><?php echo $rowRes["inv_ccontable"] ?></td>
							<td><?php echo $rowRes["inv_devengofecha"] ?></td>
							<td><?php echo $rowRes["inv_num_factura"] ?></td>
							<td><?php echo $rowRes["inv_comprobante_egreso"] ?></td>
							<input type="hidden" name="var3[<?php echo $cont ?>]" value="<?php echo $rowRes["inv_id"] ?>">
						</tr>
						<?php $cont2++;} ?>
						<tr>
							<td class="Estilo1" colspan="15"><button type="submit" name="submit" value="AGREGAR">AGREGAR</button></td>
						</tr>
					</table>
					<input type="hidden" name="totalLinea" value="<?php echo $cont ?>">
				</form>
			<?php else: ?>
				<hr>
				<table border="0" width="100%">
	<tr>
		<td class="Estilo2titulo" colspan="10">NO SE ENCONTRARON RESULTADOS</td>
	</tr>
</table>
			<?php endif ?>

			<?php if (count($_SESSION["Actualizacion"]) > 0): ?>
				<hr>

				<table border="1" width="100%">
					<tr>
						<td class="Estilo2titulo" colspan="10">PRODUCTOS AÑADIDOS</td>
					</tr>

					<tr>
						<th class="Estilo1mc">N°</th>
						<th class="Estilo1mc">CODIGO DE INVENTARIO</th>
						<th class="Estilo1mc">BIEN</th>
						<th class="Estilo1mc">ACCION</th>
					</tr>
					<?php $cont = 1; ?>
					<?php foreach ($_SESSION["Actualizacion"] as $key => $value): ?>
						<?php
						$estilo=$cont%2;
						if ($estilo==0) {
							$estilo2="Estilo1mc";
						} else {
							$estilo2="Estilo1mcblanco";
						}
						?>
						<tr class="<?php echo $estilo2 ?> trh">
							<td><?php echo $cont ?></td>
							<td><?php echo $value["codigo"] ?></td>
							<td><?php echo $value["bien"] ?></td>
							<td><a href="inv_actualizacion.php?inv_codigo=<?php echo $value["codigo"] ?>&action=Eliminar"><i class="fa fa-remove link fa-lg"></i></a></td>
						</tr>
						<?php $cont++; ?>
					<?php endforeach ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="Estilo1mc"><a href="inv_actualizacion.php?action=Vaciar" title="Vaciar listado"><i class="fa fa-trash fa-lg link"></i></a></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="Estilo1mc">
							<form action="inv_actualizacion.php" method="POST">
								<input type="radio" name="tipo" class="Estilo2 tipo" value="Actualizacion" onclick="this.form.submit();" <? if ($tipo=="Actualizacion") { echo "checked"; }  ?> >Actualizacion
								<input type="radio" name="tipo" class="Estilo2 tipo" value="Traslado" onclick="this.form.submit();" <? if ($tipo=="Traslado") { echo "checked"; }  ?> >Traslado
								<input type="hidden" name="cod" value="<?php echo $cod ?>">
							</form>
						</td>
					</tr>
				</table>
			</div>
			<?php if ($tipo == "Actualizacion"): ?>
				<?php include("inv_actualizacion_ori1.php") ?>
			<?php endif ?>

			<?php if ($tipo == "Traslado"): ?>
				<?php include("inv_actualizacion_ori2.php") ?>
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

		$("#despacho").click(function(event){

			if($("#despacho").is(":checked"))
			{
				for (var i = 1; i <= 22; i++) {
					$("#var1_"+i).prop("checked",true);
				}
			}else{
				$(':checkbox').each(function() {
					this.checked = false;                        
				});
			}

		});

		function valRes()
		{
			var numberOfChecked = $('input:checkbox:checked').length;
			numberOfChecked = parseInt(numberOfChecked);

			if(numberOfChecked == 0)
			{
				alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA");
				return false;
			}else{
				if(confirm("¿ ESTÁ SEGURO DE AÑADIR EL(LOS) SIGUIENTES ELEMENTOS ?"))
				{
					return true;
				}else{
					return false;
				}
			}
		}

		function getSubZona(input) {
			$("#inv_direccion").val($("#responsa option:selected").text());
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
					$("#inv_zona").html(resp);

				}
			})
		}

		function validar()
		{
			var inv_calidad = $("#inv_calidad").val();
			var inv_estadocosto = $("#inv_estadocosto").val();
			var inv_responsable = $("#inv_responsable").val();
			var responsa = $("#responsa").val();
			var inv_zona = $("#inv_zona").val();
			var inv_comprobante_egreso = $("#inv_comprobante_egreso").val();
			var inv_devengofecha = $("#inv_devengofecha").val();
			var inv_cta_contable = $("#inv_cta_contable").val();
			var inv_num_factura = $("#inv_num_factura").val();
			var inv_fecha_factura = $("#inv_fecha_factura").val();
			var inv_anno = $("#inv_anno").val();
			var inv_altares = $("#inv_altares").val();
			var inv_altafecha = $("#inv_altafecha").val();
			var inv_baja = $("#inv_baja").val();
			var inv_bajafecha = $("#inv_bajafecha").val();

			/*if(inv_calidad == "")
			{
				alert("SELECCIONE LA CALIDAD ADMINISTRATIVA");
				$("#inv_calidad").focus();
				return false;
			}else if(inv_estadocosto == "")
			{
				alert("SELECCIONE EL ESTADO DE LOS PRODUCTOS");
				$("#inv_estadocosto").focus();
				return false;
			}else if(inv_responsable == "")
			{
				alert("INGRESE EL FUNCIONARIO RESPONSABLE");
				$("#inv_responsable").focus();
				return false;
			}else if(responsa == "")
			{
				alert("SELECCIONE EL CENTRO DE RESPONSA");
				$("#responsa").focus();
				return false;
			}else if(inv_zona == "")
			{
				alert("SELECCIONE LA ZONA");
				$("#inv_zona").focus();
				return false;
			}else if(inv_comprobante_egreso == "")
			{
				alert("INGRESE EL COMPROBANTE DE EGRESO");
				$("#inv_comprobante_egreso").focus();
				return false;
			}else if(inv_devengofecha == "")
			{
				alert("INGRESE LA FECHA DE DEVENGO");
				$("#inv_devengofecha").focus();
				return false;
			}else if(inv_cta_contable == "")
			{
				alert("SELECCIONE LA CUENTA CONTABLE");
				$("#inv_cta_contable").focus();
				return false;
			}else if(inv_num_factura == "")
			{
				alert("INGRESE EL NUMERO DE FACTURA");
				$("#inv_num_factura").focus();
				return false;
			}else if(inv_fecha_factura == "")
			{
				alert("INGRESE LA FECHA DE LA FACTURA");
				$("#inv_fecha_factura").focus();
				return false;
			}else if(inv_anno == "")
			{
				alert("INGRESE EL AÑO DE ADQUISICION DEL BIEN");
				$("#inv_anno").focus();
				return false;
			}else if(inv_altares == "")
			{
				alert("INGRESE LA RESOLUCION DE ALTA");
				$("#inv_altares").focus();
				return false;
			}else if(inv_altafecha == "")
			{
				alert("INGRESE LA FECHA DE LA RESOLUCION DE ALTA");
				$("#inv_altafecha").focus();
				return false;
			}else if(inv_baja == "")
			{
				alert("INGRESE LA RESOLUCION DE BAJA/TRASLADO");
				$("#inv_baja").focus();
				return false;
			}else if(inv_bajafecha == "")
			{
				alert("INGRESE LA FECHA DE LA RESOLUCION DE BAJA/TRASLADO");
				$("#inv_bajafecha").focus();
				return false;
			}else{
				if(confirm("¿ ESTÁ SEGURO DE MODIFICAR ESTOS PRODUCTOS ?"))
				{
					return true;
				}else{
					return false;
				}
			}*/
			blockUI();
			return true;
		}

		function validarTraslado()
		{
			var traslado_region = $("#traslado_region").val();
			var traslado_fecha = $("#traslado_fecha").val();
			var traslado_resolucion = $("#traslado_resolucion").val();
			var totalElementos = $("#totalElementos").val();
			var limite = 200;

			if(totalElementos > limite)
			{
				alert("SE HA SUPERADO EL LIMITE DE "+limite+" ELEMENTOS.");
				return false;
			}else if(traslado_region == "")
			{
				alert("SELECCIONE UNA REGION DE DESTINO");
				$("#traslado_region").focus();
				return false;
			}else if(traslado_fecha == "")
			{
				alert("INGRESE LA FECHA DE TRASLADO");
				$("#traslado_fecha").focus();
				return false;
			}else if(traslado_resolucion == "")
			{
				alert("INGRESE UNA RESOLUCION DE TRASLADO");
				$("#traslado_resolucion").focus();
				return false;
			}else{
				blockUI();
				return true;
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
	</script>
</body>
</html>	