<style type="text/css">
	.active > a {
		color:white;
	}
	.active{
		background-color: #c3c3c3;
		border-radius: 10px;
	}

	.pagination {
		margin: auto auto;
	}

	.pagination > li {
		display: inline-block;
		padding: 5px;
		font-size: 10px;
		font-weight: bold;
		text-align: center;
		font-family: sans-serif;
	}

	.pagination > li > a{
		color: black;
	}

</style>

<div style="width:100%;background-color:#E0F8E0; position:absolute; top:160px; left:0px;" id="div1">
	<?php
	$limite = 40;
	extract($_SESSION);
	extract($_GET);
	extract($_POST);

	if (!isset($_GET['filtro'])) {
		$filtro="";
	}
	if (!isset($_GET['clave'])) {
		$clave="";
	}
	if (!isset($_GET['page'])) {
		$page="";
	}

	if($page <> "" AND is_numeric($page))
	{
		$page = $page;
	}else{
		$page = 1;
	}

	$start = ($page -1 ) * $limite;

	if(isset($enviar) && $enviar == "BUSCAR")
	{
		if($filtro == 1)
		{
			$where1 = "AND b.oc_id2 LIKE '%".$clave."%'";
		}

		if($filtro == 2)
		{
			$where2 = "AND a.ing_guia LIKE '%".$clave."%'";
		}
		if($filtro == 3)
		{
			$where3 = "AND a.ing_aprobado = ''";
		}
		if($filtro == 4)
		{
			$where4 = "AND a.ing_aprobado LIKE '%".$clave."%'";
		}

		$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 $where1 $where2 $where3 $where4 AND  a.ing_region = ".$_SESSION["region"]." AND (a.ing_estado = 1 OR a.ing_estado = 2 OR a.ing_estado = 3) AND b.oc_estado = 1 GROUP BY a.ing_id ORDER BY ing_id DESC";
		$sql1 = $sql;
	}else{
		$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 AND  a.ing_region = ".$_SESSION["region"]." AND (a.ing_estado = 1 OR a.ing_estado = 2 OR a.ing_estado = 3) AND b.oc_estado = 1 GROUP BY a.ing_id ORDER BY ing_id DESC";
		$sql1 = $sql;
	}

		// echo $sql;
			// $sql.=" LI"
	$sql = mysql_query($sql.=" LIMIT $start,$limite");

	$numRows = mysql_num_rows(mysql_query($sql1));
	$paginas = ceil($numRows / $limite);

	if(isset($ing_id) && intval($ing_id) && $ing_wms == "")
	{
		$datos = mysql_query("SELECT * FROM bode_ingreso WHERE ing_id = ".$ing_id);
		$datos = mysql_fetch_array($datos);

		$oc = mysql_query("SELECT * FROM bode_orcom WHERE oc_id = ".$datos["ing_oc_id"]);
		$oc = mysql_fetch_array($oc);
		$aprobado = "UPDATE bode_ingreso SET ing_aprobado = '".$nombrecom."' WHERE ing_id = ".$ing_id;
		mysql_query($aprobado);

		$ing_estado = $datos["ing_estado"];
		if($ing_estado == 3){
		mysql_query("UPDATE bode_ingreso SET ing_estado = 1 WHERE ing_id = ".$ing_id);
		//INSERTAR DATOS EN COMPRA_TEMPORAL PARA CLASIFICACION (INVENTARIO)
			$regiones = array(
				1 => "I REGION",
				2 => "II REGION",
				3 => "III REGION",
				4 => "IV REGION",
				5 => "V REGION",
				6 => "VI REGION",
				7 => "VII REGION",
				8 => "VIII REGION",
				9 => "IX REGION",
				10 => "X REGION",
				11 => "XI REGION",
				12 => "XII REGION",
				13 => "REGION METROPOLITANA",
				14 => "XIV REGION",
				15 => "XV REGION",
				16 => "DIRECCION NACIONAL");

			/* PRODUCTOS A INGRESAR */
			$productos = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b on a.ding_prod_id = b.doc_id WHERE a.ding_ing_id = ".$ing_id;
			$productos = mysql_query($productos);
			$rowProductos = array();
			while($row = mysql_fetch_array($productos))
			{
				$rowProductos[] = $row;
			}

			/* OBTENEMOS EL OC_ID */
			$oc_id = "SELECT ing_oc_id as OC FROM bode_ingreso WHERE ing_id = ".$ing_id;
			$oc_id = mysql_query($oc_id);
			$oc_id = mysql_fetch_array($oc_id);
			$oc_id = $oc_id["OC"];

			/* INFO DE LA OC */
			$oc = "SELECT * FROM bode_orcom WHERE oc_id = ".$oc_id;
			$oc = mysql_query($oc);
			$oc = mysql_fetch_array($oc);

			/* VERIFICA SI EXISTE LA OC EN INVENTARIO */
			$existe = "SELECT count(id) as Total FROM acti_compra_temporal WHERE oc_numero ='".$oc["oc_id2"]."'";
			$existe = mysql_query($existe);
			$existe = mysql_fetch_array($existe);
			$existe = $existe["Total"];

			if($existe > 0)
			{
				/* OBTENEMOS LA COMPRA ID */
				$ultima = "SELECT compra_id as Maximo FROM acti_compra_temporal WHERE oc_numero = '".$oc["oc_id2"]."'";
				$ultima = mysql_query($ultima);
				$ultima = mysql_fetch_array($ultima);
				$ultima = $ultima["Maximo"];
				$hoy = Date("Y-m-d H:i:s");

				foreach ($rowProductos as $key => $value) {
		//$ocBruto = $value["doc_valor_unit"] / $value["ding_cantidad"];
					$ocBruto = $value["doc_conversion"];
					$ingresa = "INSERT INTO acti_compra_temporal (compra_id,compra_proveedor,compra_glosa,compra_region,compra_cantidad,compra_programa,compra_moneda,compra_tipo_cambio,oc_numero,compra_estado,compra_region_id,compra_ing_id,compra_ding_id,compra_clasificacion,compra_monto,solicitud_estado,oc_estado,rc_estado,compra_bruto_unitario,compra_plazo_entrega,compra_fecha_registro,solicitud_bruto_sc,solicitud_cantidad_entregado,oc_bruto_oc,oc_cantidad_entregado,compra_doc_id,compra_rc) VALUES (".$ultima.",'".$oc["oc_proveenomb"]."','".$value["doc_especificacion"]."','".$regiones[$value["doc_region"]]."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$oc["oc_prog"]."','".$value["doc_moneda"]."',".$value["doc_valor_moneda"].",'".$oc["oc_id2"]."',0,".$value["doc_region"].",".$ing_id.",".$value["ding_id"].",0,'".($value["doc_conversion"] * ($value["ding_cantidad"] - $value["ding_cant_rechazo"]))."','PENDIENTE','PENDIENTE','PENDIENTE','".$ocBruto."','".$oc["oc_fecha"]."','".$hoy."','".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",".$value["doc_id"].",'".$guianumerorc."')";
					mysql_query($ingresa);
				}

			}else{
				/* AGREGA LINEA DE COMPRA */
				$ultima = "SELECT MAX(compra_id) as Maximo FROM acti_compra_temporal";
				$ultima = mysql_query($ultima);
				$ultima = mysql_fetch_array($ultima);
				$ultima = $ultima["Maximo"] + 1;
				$hoy = Date("Y-m-d H:i:s");

				/* va dentro de un while segun los productos */
				foreach ($rowProductos as $key => $value) {
		//$ocBruto = $value["doc_valor_unit"] / $value["ding_cantidad"];
					$ocBruto = $value["doc_conversion"];
					$ingresa = "INSERT INTO acti_compra_temporal (compra_id,compra_proveedor,compra_glosa,compra_region,compra_cantidad,compra_programa,compra_moneda,compra_tipo_cambio,oc_numero,compra_estado,compra_region_id,compra_ing_id,compra_ding_id,compra_clasificacion,compra_monto,solicitud_estado,oc_estado,rc_estado,compra_bruto_unitario,compra_plazo_entrega,compra_fecha_registro,solicitud_bruto_sc,solicitud_cantidad_entregado,oc_bruto_oc,oc_cantidad_entregado,compra_doc_id,compra_rc) VALUES (".$ultima.",'".$oc["oc_proveenomb"]."','".$value["doc_especificacion"]."','".$regiones[$value["doc_region"]]."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$oc["oc_prog"]."','".$value["doc_moneda"]."',".$value["doc_valor_moneda"].",'".$oc["oc_id2"]."',0,".$value["doc_region"].",".$ing_id.",".$value["ding_id"].",0,'".($value["doc_conversion"] * ($value["ding_cantidad"] - $value["ding_cant_rechazo"]))."','PENDIENTE','PENDIENTE','PENDIENTE','".$ocBruto."','".$oc["oc_fecha"]."','".$hoy."','".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",".$value["doc_id"].",'".$guianumerorc."')";
					mysql_query($ingresa);
				}
			}

		
		}
		// FIN INVENTARIO

		$fechamia=date('Y-m-d');
		$horaSys = Date("H:i:s");
		$log = "INSERT INTO log VALUES(NULL,".$ing_id.",0,'APROBACION','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTO - APROBACIONES')";
		mysql_query($log);

		echo "<script>window.location.href='bode_inv_indexoc4.php?cmd=Aprobaciones';</script>";
	}else if($ing_wms <> "")
	{
			// echo "WMS";
			// WMS
			$regiones = [
			1 => "I REGION",
			2 => "II REGION",
			3 => "III REGION",
			4 => "IV REGION",
			5 => "V REGION",
			6 => "VI REGION",
			7 => "VII REGION",
			8 => "VIII REGION",
			9 => "IX REGION",
			10 => "X REGION",
			11 => "XI REGION",
			12 => "XII REGION",
			13 => "REGION METROPOLITANA",
			14 => "XIV REGION",
			15 => "XV REGION",
			16 => "DIRECCION NACIONAL"
			];

			/* PRODUCTOS A INGRESAR */
			$productos = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b on a.ding_prod_id = b.doc_id WHERE a.ding_ing_id = ".$ing_id;
			$productos = mysql_query($productos);
			$rowProductos = array();
			while($row = mysql_fetch_array($productos))
			{
				$rowProductos[] = $row;
			}

			/* OBTENEMOS EL OC_ID */
			$oc_id = "SELECT ing_oc_id as OC FROM bode_ingreso WHERE ing_id = ".$ing_id;
			$oc_id = mysql_query($oc_id);
			$oc_id = mysql_fetch_array($oc_id);
			$oc_id = $oc_id["OC"];

			/* INFO DE LA OC */
			$oc = "SELECT * FROM bode_orcom WHERE oc_id = ".$oc_id;
			$oc = mysql_query($oc);
			$oc = mysql_fetch_array($oc);

			/* VERIFICA SI EXISTE LA OC EN INVENTARIO */
			$existe = "SELECT count(id) as Total FROM acti_compra_temporal WHERE oc_numero ='".$oc["oc_id2"]."'";

			$existe = mysql_query($existe);
			$existe = mysql_fetch_array($existe);
			$existe = $existe["Total"];

			if($existe > 0)
			{
				/* OBTENEMOS LA COMPRA ID */
				$ultima = "SELECT compra_id as Maximo FROM acti_compra_temporal WHERE oc_numero = '".$oc["oc_id2"]."'";
				$ultima = mysql_query($ultima);
				$ultima = mysql_fetch_array($ultima);
				$ultima = $ultima["Maximo"];
				$hoy = Date("Y-m-d H:i:s");

				foreach ($rowProductos as $key => $value) {
		//$ocBruto = $value["doc_valor_unit"] / $value["ding_cantidad"];
					$ocBruto = $value["doc_conversion"];
					$ingresa = "INSERT INTO acti_compra_temporal (compra_id,compra_proveedor,compra_glosa,compra_region,compra_cantidad,compra_programa,compra_moneda,compra_tipo_cambio,oc_numero,compra_estado,compra_region_id,compra_ing_id,compra_ding_id,compra_clasificacion,compra_monto,solicitud_estado,oc_estado,rc_estado,compra_bruto_unitario,compra_plazo_entrega,compra_fecha_registro,solicitud_bruto_sc,solicitud_cantidad_entregado,oc_bruto_oc,oc_cantidad_entregado,compra_doc_id,compra_rc) VALUES (".$ultima.",'".$oc["oc_proveenomb"]."','".$value["doc_especificacion"]."','".$regiones[$value["doc_region"]]."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$oc["oc_prog"]."','".$value["doc_moneda"]."',".$value["doc_valor_moneda"].",'".$oc["oc_id2"]."',0,".$value["doc_region"].",".$ing_id.",".$value["ding_id"].",0,'".($value["doc_conversion"] * ($value["ding_cantidad"] - $value["ding_cant_rechazo"]))."','PENDIENTE','PENDIENTE','PENDIENTE','".$ocBruto."','".$oc["oc_fecha"]."','".$hoy."','".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",".$value["doc_id"].",'".$guianumerorc."')";
					mysql_query($ingresa);
				}

			}else{
				/* AGREGA LINEA DE COMPRA */
				$ultima = "SELECT MAX(compra_id) as Maximo FROM acti_compra_temporal";
				$ultima = mysql_query($ultima);
				$ultima = mysql_fetch_array($ultima);
				$ultima = $ultima["Maximo"] + 1;
				$hoy = Date("Y-m-d H:i:s");

				/* va dentro de un while segun los productos */
				foreach ($rowProductos as $key => $value) {
		//$ocBruto = $value["doc_valor_unit"] / $value["ding_cantidad"];
					$ocBruto = $value["doc_conversion"];
					$ingresa = "INSERT INTO acti_compra_temporal (compra_id,compra_proveedor,compra_glosa,compra_region,compra_cantidad,compra_programa,compra_moneda,compra_tipo_cambio,oc_numero,compra_estado,compra_region_id,compra_ing_id,compra_ding_id,compra_clasificacion,compra_monto,solicitud_estado,oc_estado,rc_estado,compra_bruto_unitario,compra_plazo_entrega,compra_fecha_registro,solicitud_bruto_sc,solicitud_cantidad_entregado,oc_bruto_oc,oc_cantidad_entregado,compra_doc_id,compra_rc) VALUES (".$ultima.",'".$oc["oc_proveenomb"]."','".$value["doc_especificacion"]."','".$regiones[$value["doc_region"]]."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$oc["oc_prog"]."','".$value["doc_moneda"]."',".$value["doc_valor_moneda"].",'".$oc["oc_id2"]."',0,".$value["doc_region"].",".$ing_id.",".$value["ding_id"].",0,'".($value["doc_conversion"] * ($value["ding_cantidad"] - $value["ding_cant_rechazo"]))."','PENDIENTE','PENDIENTE','PENDIENTE','".$ocBruto."','".$oc["oc_fecha"]."','".$hoy."','".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",'".$ocBruto."',".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].",".$value["doc_id"].",'".$guianumerorc."')";
					mysql_query($ingresa);
				}
			}
	}

	?>

	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">BUSCADOR</td>
		</tr>
	</table>
	<form action="bode_inv_indexoc4.php" method="GET">
		<table border="0" width="30%">
			<tr >
				<td class="Estilo1">CLAVE</td>
				<td><input type="text" name="clave" id="clave" value="<?php echo $clave ?>" class="Estilo1"></td>
				<td>
					<select id="filtro" name="filtro" class="Estilo1">
						<option value="">Seleccionar...</option>
						<option value="1" <?php if($filtro == 1) { echo "selected"; } ?>>ORDEN DE COMPRA</option>
						<option value="2" <?php if($filtro == 2) { echo "selected"; } ?>>N° GUIA PROVEEDOR</option>
						<option value="3" <?php if($filtro == 3) { echo "selected"; } ?>>PENDIENTES</option>
						<option value="4" <?php if($filtro == 4) { echo "selected"; } ?>>APROBADO POR</option>
					</select>
				</td>
				<td><input type="submit" name="enviar" id="enviar" value="BUSCAR"></td>

			</tr>
		</table>
		<input type="hidden" name="cmd" value="Aprobaciones">
	</form>

	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">APROBACIONES PENDIENTES</td>
		</tr>
	</table>

	<table border="1" cellpadding="0" cellspacing="0" width="100%">
		<tr class="Estilo1mc">
			<td>#</td>
			<td>ORDEN DE COMPRA</td>
			<td>NOMBRE ORDEN DE COMPRA</td>
			<td>N° GUIA PROVEEDOR</td>
			<td>RT</td>
			<td>RC</td>
			<td>FECHA RC</td>
			<td>APROBADO POR</td>
			<td>RT</td>
			<td>RC</td>
			<td>ESTADO</td>
			<td>RECHAZAR</td>
			<td>ADJUNTO</td>
		</tr>
		<?php 
		$cont=1;
		while($row = mysql_fetch_array($sql)) {

			$estilo=$cont%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}

			if($row["ing_aprobado"] == ''){
				$stylo = "style='background-color: #FF0000; color: white;'";
			}else{
				$stylo = "";
			}
			if($row["ing_rutatc"] <> "" && $row["ing_archivotc"] <> "")
			{
				$link = "../../../".$row["ing_rutatc"].$row["ing_archivotc"];
			}else{
				$link = "#";
			}
			?>
			<tr class="trh <?php echo $estilo2 ?>" <?php echo $stylo ?>>
				<td><?php echo $cont ?></td>
				<td><?php echo $row["oc_id2"] ?></td>
				<td><?php echo $row["oc_nombre_oc"] ?></td>
				<td><?php echo $row["ing_guia"] ?></td>
				<td><a href="bode_tca.php?numguia=<?php echo $row["ing_guianumerotc"] ?>" target="_blank"><i class="fa fa-download fa-lg"></i></a></td>
				<td><a href="bode_imprimerca.php?numguia=<?php echo $row["ing_guianumerorc"] ?>" target="_blank"><i class="fa fa-download fa-lg"></i></a></td>
				<td><?php echo $row["ding_fentrega"] ?></td>

				<td><?php echo $row["ing_aprobado"] ?></td>
				<td><?php echo $row["ing_guianumerotc"] ?></td>
				<td><?php echo $row["ing_guianumerorc"] ?></td>

				<td>
					<?php if ($row["ing_aprobado"] <> ''): ?>
						<font color="green"><i class="fa fa-check fa-lg"></i></font>
					<?php else: ?> 
						<?php if($_SESSION["pfl_user"] <> 53):?>
							<?php if($_SESSION["Acceso"]["acc_aprueba_ing"] == 1):?>
								<a href="<?php echo $_SERVER["REQUEST_URI"] ?>&ing_id=<?php echo $row["ing_id"] ?>" onClick="return confirma1();"><i class="fa fa-warning  fa-lg"></i></a>
							<?php else:?>
								NO TIENE PERMISOS
							<?php endif ?>
						<?php endif ?>
					<?php endif ?>
				</td>

				<td>
					<?php if($row["ing_aprobado"] <> ""): ?>
						<i class="fa fa-remove fa-lg"></i>
					<?php else: ?>
						<?php if($_SESSION["Acceso"]["acc_rchz_ing"] == 1):?>
							<!-- <a href="bode_rechazar_ingreso.php?ing_id=<?php echo $row["ing_id"]?>" target="_blank" onClick="return(confirm('¿ ESTÁ SEGURO DE ANULAR EL INGRESO N° <?php echo $row["ing_id"] ?>. RT N° <?php echo $row["ing_guianumerotc"] ?>. RC <?php echo $row["ing_guianumerorc"] ?>'))"><i class="fa fa-warning fa-lg"></i></a> -->
							<a href="#" onClick="rechazarIngreso(<?php echo $row["ing_id"] ?>,<?php echo $row["ing_guianumerotc"] ?>,<?php echo $row["ing_guianumerorc"] ?>)"><i class="fa fa-warning fa-lg"></i></a>
						<?php else: ?>
							NO TIENE PERMISOS
						<?php endif ?>
					<?php endif ?>
				</td>
				<td><a href="<?php echo $link ?>" <?php if($link <> "#"){echo 'target="_blank"';} ?> ><i class="fa fa-cloud-download  fa-lg"></i></a></td>
			</tr>
			<?php $cont++;} ?>

			<tr>
				<td colspan="13">
					<?php 
					$paginator ="<ul class='pagination pull-right'>";
					$paginator .="<li><a href='bode_inv_indexoc4.php?cmd=Aprobaciones&filtro=$filtro&clave=$clave&enviar=BUSCAR&page=1'><i class='fa fa-angle-double-left'></i></a></li>";

					if($page - 1 == 0)
					{
					}else if($page - 1 < 1){
						$paginator .="<li><a href='bode_inv_indexoc4.php?cmd=Aprobaciones&filtro=$filtro&clave=$clave&enviar=BUSCAR&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
					}else{
						$paginator .="<li><a href='bode_inv_indexoc4.php?cmd=Aprobaciones&filtro=$filtro&clave=$clave&enviar=BUSCAR&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
					}

					for ($i=1; $i<=$paginas; $i++) { 
						$paginator .="<li id='pagination_".$i."'><a href='bode_inv_indexoc4.php?cmd=Aprobaciones&filtro=$filtro&clave=$clave&enviar=BUSCAR&page=".$i."'>".$i."</a></li>"; 
					}; 

					if($page + 1 > $paginas)
					{

					}else{
						$paginator .="<li><a href='bode_inv_indexoc4.php?cmd=Aprobaciones&filtro=$filtro&clave=$clave&enviar=BUSCAR&page=".($page+1)."'><i class='fa fa-angle-right'></i></a></li>";
					}
$paginator .="<li><a href='bode_inv_indexoc4.php?cmd=Aprobaciones&filtro=$filtro&clave=$clave&enviar=BUSCAR&page=$paginas'><i class='fa fa-angle-double-right'></i></a></li></ul>"; // Goto last page
echo $paginator;
?>
</td>
</tr>
</table>
</div>

<script type="text/javascript">
	$(function(){
		$("#pagination_<? echo  $page ?>").addClass("active");
	})
	function confirma1()
	{
		if(confirm('¿ SEGURO QUE DESEA APROBAR ESTE INGRESO ?'))
		{
			blockUI();
			return true;
		}else{
			return false;
		}
	}

	function rechazarIngreso(id,rt,rc)
	{
		if(confirm('¿ ESTÁ SEGURO DE ANULAR EL INGRESO N° '+id+'. RT N° '+rt+'. RC '+rc))
		{
			$.ajax({
				type:"POST",
				url:"bode_rechazar_ingreso.php?ing_id="+id,
				dataType:"JSON",
				beforeSend : function(){
					blockUI();
				},
				success : function ( response ) {
					if(response.Respuesta)
					{
						alert(response.Mensaje);
						window.location.reload();
					}else{
						alert(response.Mensaje);
					}
				},
				complete : function(){
					unBlockUI();
				}
			});
		}
	}
</script>

