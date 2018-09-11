<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INEDIS</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<script src="librerias/jquery-1.11.3.min.js"></script>
</head>
<body>
	<?php
	session_start();
	$regionSession = $_SESSION["region"];
	extract($_GET);
	require_once("inc/config.php");

	if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

	// BUSCAMOS ID del producto original
	$sql = "SELECT * FROM bode_detingreso WHERE ding_id = ".$id;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$ding_prod_id = $row["ding_prod_id"];

	// BUSCAMOS TODAS LAS POSICIONES DEL PRODUCTO
	$sql2 = "SELECT * FROM bode_detingreso WHERE ding_prod_id = ".$ding_prod_id." AND ding_unidad > 0";
	$res2 = mysql_query($sql2);
	$contador = 1;

	$sql4 = "SELECT * FROM bode_detoc3 WHERE doc_id = ".$doc_id;
	$res4 = mysql_query($sql4);
	$row4 = mysql_fetch_array($res4);

	$sql6 = "SELECT * FROM bode_solicitud WHERE sp_id = ".$sp_id;
	$res6 = mysql_query($sql6);
	$row6 = mysql_fetch_array($res6);

	// $sql5 = "SELECT * FROM bode_detoc a inner join bode_detingreso b on b.ding_prod_id = a.doc_id inner join bode_orcom c on c.oc_id = a.doc_oc_id where a.doc_region = ".$row6["sp_region_destino"]." and b.ding_unidad > 0 AND MATCH(a.doc_especificacion) AGAINST('".$row4["doc_especificacion"]."') AND c.oc_tipo = 0 AND c.oc_estado = 1 AND b.ding_id NOT LIKE ".$id." LIMIT 10";
	if($id <> 0)
	{
		$sql5 = "SELECT * FROM bode_detoc a inner join bode_detingreso b on b.ding_prod_id = a.doc_id inner join bode_orcom c on c.oc_id = a.doc_oc_id where a.doc_region = ".$row6["sp_region_destino"]." and b.ding_unidad > 0 AND a.doc_especificacion LIKE '%".$row4["doc_especificacion"]."%' AND c.oc_tipo = 0 AND c.oc_estado = 1 AND b.ding_prod_id NOT LIKE ".$ding_prod_id." ORDER BY b.ding_ubicacion ASC LIMIT 10";
	}else{
		$sql5 = "SELECT * FROM bode_detoc a inner join bode_detingreso b on b.ding_prod_id = a.doc_id inner join bode_orcom c on c.oc_id = a.doc_oc_id where a.doc_region = ".$row6["sp_region_destino"]." and b.ding_unidad > 0 AND a.doc_especificacion LIKE '%".$row4["doc_especificacion"]."%' AND c.oc_tipo = 0 AND c.oc_estado = 1 ORDER BY b.ding_ubicacion ASC LIMIT 10";
	}
	$res5 = mysql_query($sql5);
	$cont = 1;



	$sql7 = "SELECT SUM(sp_rel_despachado) as Despachado, SUM(sp_rel_cantidad) as Acumulado FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$doc_id." AND sp_rel_sp_id = ".$sp_id;
	$res7 = mysql_query($sql7);
	$row7 = mysql_fetch_array($res7);

	$pendiente = ($row4["doc_cantidad"] - $row7["Despachado"] - $row7["Acumulado"]);
	?>
	<div class="container">	
		<div class="row">	
			<div class="panel panel-info">
				<div class="panel-heading">DETALLE SOLICITUD DE PEDIDO N° <strong><?php echo $row6["sp_folio"] ?></strong></div>
				<div class="panel-body">	
					<p>Producto : <?php echo $row4["doc_especificacion"] ?></p>
					<p>Cantidad Solicitada : <?php echo $row4["doc_cantidad"] ?></p>
					<p>Destino : <?php echo $row6["sp_destino"] ?></p>
					<p>Solicitante : <?php echo $row6["sp_usuario"] ?></p>
					<p>Solicitado : <?php echo $row4["doc_cantidad"] ?></p>
					<p>Total Despachado : <?php echo ($row7["Despachado"] == "") ? 0 : $row7["Despachado"] ?></p>
					<p>Pendiente : <?php echo ($row4["doc_cantidad"] - $row7["Despachado"] - $row7["Acumulado"]) ?></p>
					<p>Total Acumulado : <?php echo $row7["Acumulado"] ?></p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="panel panel-success">
				<div class="panel-heading">
					BIEN SOLICITADO Y OTRAS UBICACIONES<br>
					<p><strong>En esta seccion aparecerán las posibles ubicaciones del bien solicitado si asi lo hubiese (Siempre y cuando el producto haya sido ingresado desde el formulario Nota de Pedido)</strong></p>


				</div>
				<div class="panel-body">
					<form action="bode_solicitud_grabarel.php" method="POST" onSubmit="return valida()">

						<!-- <table class="table table-condensed table-hover table-striped table-responsive table-bordered"> -->
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<th>OP</th>
								<th>#</th>
								<th>PRODUCTO</th>
								<th>UBICACION</th>
								<th>ORDEN DE COMPRA</th>
								<th>STOCK BODEGA</th>
								<th>CANTIDAD A ASOCIAR</th>
								<th>CLASIFICACIÓN</th>
							</thead>
							
							<tbody>
								<?php while($row2 = mysql_fetch_array($res2)) { ?>
								<?php
								$sql3 = "SELECT * FROM bode_orcom a inner join bode_detoc b on b.doc_oc_id = a.oc_id where b.doc_id = ".$row2["ding_prod_id"];
								$res3 = mysql_query($sql3);
								$row3 = mysql_fetch_array($res3);

								?>
								<tr>
									<td><input type="checkbox" name="var1[<?php echo $contador ?>]" id="var1_<?php echo $contador ?>" value="<?php echo $row2["ding_id"] ?>" onClick="calcular()"></td>
									<td><?php echo $contador ?></td>
									<td><?php echo $row3["doc_especificacion"]?></td>
									<td><?php echo $row2["ding_ubicacion"] ?></td>
									<td><?php echo $row3["oc_id2"] ?></td>
									<td><?php echo $row2["ding_unidad"] ?></td>
									<td><input type="number" min="1" max="<?php echo $row2["ding_unidad"] ?>" name="var2[<?php echo $contador ?>]" id="var2_<?php echo $contador ?>" onChange="calcular()"></td>
									<td>
										<?php if($row2["ding_clasificacion"] == 1){echo"INVENTARIABLE";}else if($row2["ding_clasificacion"] == 0){echo"EXISTENCIA";} ?>
										<input type="hidden" name="var3[<?php echo $contador ?>]" id="var3_<?php echo $contador ?>" value="<?php echo $row2["ding_clasificacion"] ?>">
									</td>
								</tr>

								<?php $contador++;} ?>
							</tbody>

							<tfoot>
								<tr>
									<td colspan="8" align="right"><button class="btn btn-primary">ASOCIAR <i class="fa fa-link"></i></button></td>
								</tr>
							</tfoot>
						</table>
						<input type="hidden" name="totalElementos" value="<?php echo mysql_num_rows($res2) ?>">
						<input type="hidden" name="doc_id" value="<?php echo $doc_id ?>">
						<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $sp_id ?>">
						<input type="hidden" name="totalSeleccionado" id="totalSeleccionado">
					</form>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="panel panel-warning">
				<div class="panel-heading">PRODUCTOS SIMILARES</div>
				<div class="panel-body">
					<form action="bode_solicitud_grabarel2.php" method="POST" onSubmit="return valida2()">
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<th>OP</th>
								<th>#</th>
								<th>PRODUCTO</th>
								<th>ORDEN DE COMPRA</th>
								<th>STOCK DISPONIBLE</th>
								<th>CANTIDAD</th>
								<th>UBICACION</th>
								<th>CLASIFICACIÓN</th>
							</thead>

							<tbody>
								<?php while($row5 = mysql_fetch_array($res5)) { ?>
								<tr <?php if($cont == 1 || $cont == 2){echo"style='background-color:#33ff33;'";} ?>>
									<td><input type="checkbox" name="var11[<?php echo $cont ?>]" id="var11_<?php echo $cont ?>" value="<?php echo $row5["ding_id"] ?>"  onClick="calcular2()"></td>
									<td><?php echo $cont ?></td>
									<td><?php echo $row5["doc_especificacion"] ?></td>
									<td><?php echo $row5["oc_id2"] ?></td>
									<td><?php echo $row5["ding_unidad"] ?></td>
									<td><input type="number" min="1" max="<?php echo $row5["ding_unidad"] ?>" name="var22[<?php echo $cont ?>]" id="var22_<?php echo $cont ?>"  onChange="calcular2()"></td>
									<td><?php echo $row5["ding_ubicacion"] ?></td>
									<td>
										<?php if($row5["ding_clasificacion"] == 1){echo"INVENTARIABLE";}else if($row5["ding_clasificacion"] == 0){echo"EXISTENCIA";} ?>
										<input type="hidden" name="var33[<?php echo $cont ?>]" id="var33_<?php echo $cont ?>" value="<?php echo $row5["ding_clasificacion"] ?>">
									</td>
								</tr>

								<?php $cont++;} ?>
							</tbody>

							<tfoot>
								<tr>
									<td colspan="8" align="right"><button class="btn btn-warning">ASOCIAR <i class="fa fa-link"></i></button></td>
								</tr>
							</tfoot>
						</table>
						<input type="hidden" name="totalElementos" value="<?php echo mysql_num_rows($res5) ?>">
						<input type="hidden" name="doc_id" value="<?php echo $doc_id ?>">
						<input type="hidden" name="sp_id" id="sp_id" value="<?php echo $sp_id ?>">
						<input type="hidden" name="totalSeleccionado2" id="totalSeleccionado2">
					</form>
				</div>
			</div>
		</div>

	</div>

	<script type="text/javascript">

		function calcular()
		{
			var totalElementos = <?php echo $contador ?>;
			var suma = 0;

	// RECORRER TODOS LOS INPUT CON CHECKED
	for (var i = 0; i < totalElementos; i++) {
		if($("#var1_"+i).is(":checked"))
		{
			if($("#var2_"+i).val() != '')
				suma += parseInt($("#var2_"+i).val());
		}
	}
	$("#totalSeleccionado").val(suma);
}

function calcular2()
{
	var totalElementos = <?php echo $cont ?>;
	var suma = 0;

	// RECORRER TODOS LOS INPUT CON CHECKED
	for (var i = 0; i < totalElementos; i++) {
		if($("#var11_"+i).is(":checked"))
		{
			if($("#var22_"+i).val() != '')
				suma += parseInt($("#var22_"+i).val());
		}
	}
	$("#totalSeleccionado2").val(suma);
}

function valida()
{

	var totalSeleccionado = parseInt($("#totalSeleccionado").val());
	var totalPendiente = parseInt(<?php echo $pendiente ?>);

	if( isNaN(totalSeleccionado) )
	{
		alert("Por favor marque al menos 1 item e indique la cantidad");
		return false;
	}
	if(totalSeleccionado == 0)
	{
		alert("Por favor marque al menos 1 item e indique la cantidad");
		return false;
	}

	if(totalSeleccionado > totalPendiente){
		alert("Lo sentimos, la cantidad total seleccionada ["+totalSeleccionado+"] no puede superar la cantidad pendiente ["+totalPendiente+"]")
		return false;
	}else{
		return confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?");
	}
}

function valida2()
{

	var totalSeleccionado = parseInt($("#totalSeleccionado2").val());
	var totalPendiente = parseInt(<?php echo $pendiente ?>);


	if( isNaN(totalSeleccionado) )
	{
		alert("Por favor marque al menos 1 item e indique la cantidad");
		return false;
	}
	if(totalSeleccionado == 0)
	{
		alert("Por favor marque al menos 1 item e indique la cantidad");
		return false;
	}

	if(totalSeleccionado > totalPendiente){
		alert("Lo sentimos, la cantidad total seleccionada ["+totalSeleccionado+"] no puede superar la cantidad pendiente ["+totalPendiente+"]")
		return false;
	}else{
		return confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?");
	}
}

</script>
</body>
</html>