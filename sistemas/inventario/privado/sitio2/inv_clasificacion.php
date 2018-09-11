<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<style type="text/css">
		/*ul{
			padding: 0;
			list-style-type: none;
			text-align: center;
		}

		li {
			text-decoration: none;
			padding: .1em;
			color: #fff;
			display: inline;
		}
		a{
			text-decoration: none;
		}*/
	</style>
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

	<div style="width:700px;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
		<?php
		
		session_start();
		extract($_POST);
		extract($_GET);
		extract($_SESSION);

		$limite = 50;
		if(isset($submit) AND $submit == "normal")
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
				$where3 = "AND a.ing_aprobado LIKE '%".$clave."%'";
			}

			if($filtro == 4)
			{
				$where4 = "AND b.oc_grupo LIKE '%".$clave."%'";
			}

			if($filtro == 5)
			{
				// $where5 = "AND b.oc_region = ".$clave;
				$where5 = "AND a.ing_region = ".$clave;
			}else{
				// $where5 = "AND b.oc_region = ".$_SESSION["region"];
				$where5 = "AND a.ing_region = ".$_SESSION["region"];
			}

			if($_SESSION["nom_user"] <> "pcastaneda")
			{
				$query = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 $where1 $where2 $where3 $where4 AND a.ing_aprobado <> '' AND (a.ing_estado = 1 OR a.ing_estado = 2 OR a.ing_estado = 3) AND b.oc_fecha_recep >= '2016-04-06' AND (b.oc_tipo = 0) AND (a.ing_clasificacion = 0 OR a.ing_clasificacion = '') AND b.oc_estado = 1 AND a.ing_region = ".$_SESSION["region"]." ORDER BY a.ing_id DESC LIMIT ".$limite;
			}else{
				$query = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 $where1 $where2 $where3 $where4 $where5 AND a.ing_aprobado <> '' AND (a.ing_estado = 1 OR a.ing_estado = 2 OR a.ing_estado = 3) AND b.oc_fecha_recep >= '2016-04-06' AND (b.oc_tipo = 0) AND (a.ing_clasificacion = 0 OR a.ing_clasificacion = '') AND b.oc_estado = 1  ORDER BY a.ing_id DESC LIMIT ".$limite;
			}
			// $resc = mysql_query($query);
			// $results = mysql_num_rows($resc);
		}else{

			if($_SESSION["nom_user"] <> "pcastaneda")
			{
				$query = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 AND a.ing_aprobado <> '' AND (a.ing_estado = 1 OR a.ing_estado = 2 OR a.ing_estado = 3) AND b.oc_fecha_recep >= '2016-04-06' AND (b.oc_tipo = 0) AND (a.ing_clasificacion = 0 OR a.ing_clasificacion = '') AND b.oc_estado = 1 AND a.ing_region = ".$_SESSION["region"]." ORDER BY a.ing_id DESC LIMIT ".$limite;
			}else{
				$query = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 AND a.ing_aprobado <> '' AND (a.ing_estado = 1 OR a.ing_estado = 2 OR a.ing_estado = 3) AND b.oc_fecha_recep >= '2016-04-06' AND (b.oc_tipo = 0) AND (a.ing_clasificacion = 0 OR a.ing_clasificacion = '') AND b.oc_estado = 1 ORDER BY a.ing_id DESC LIMIT ".$limite;
			}
		}
		$resc = mysql_query($query);
		$results = mysql_num_rows($resc);

		if(isset($submit) AND $submit == "avanzada")
		{
			if($oc <> "")
			{
				$where.="AND b.oc_id2 LIKE '".$oc."' ";
			}
			if($nguia <> "")
			{
				$where.="AND a.ing_guia LIKE '%".$nguia."%' ";
			}
			if($aprobado <> "")
			{
				$where.="AND a.ing_aprobado LIKE '%".$aprobado."%' ";
			}
			if($_GET["region"] <> "" AND $_GET["region"] <> 17)
			{
				$where.="AND a.ing_region = ".$_GET["region"]." ";
			}
			if($grupo <> "")
			{
				$where.="AND b.oc_grupo LIKE '%".$grupo."%' ";
			}
			if ($_SESSION["region"] == 16) {
				if($region == 17)
				{
					$query = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 $where AND (a.ing_estado = 1 OR a.ing_estado = 2) AND b.oc_fecha_recep >= '2016-04-07' AND (b.oc_tipo = 0) AND (a.ing_clasificacion = 0 OR a.ing_clasificacion = '') and b.oc_estado = 1 AND a.ing_aprobado <> '' ORDER BY a.ing_id DESC LIMIT ".$limite;
				}else{
					$query = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 $where AND (a.ing_estado = 1 OR a.ing_estado = 2) AND b.oc_fecha_recep >= '2016-04-07' AND (b.oc_tipo = 0)  AND (a.ing_clasificacion = 0 OR a.ing_clasificacion = '') and b.oc_estado = 1 AND a.ing_aprobado <> '' ORDER BY a.ing_id DESC LIMIT ".$limite;
				}
			}else{
				$query = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON a.ing_oc_id = b.oc_id WHERE a.ing_guianumerotc <> 0 AND a.ing_guianumerorc <> 0 $where AND (a.ing_estado = 1 OR a.ing_estado = 2) AND b.oc_fecha_recep >= '2016-04-07' AND b.oc_tipo = 0 AND a.ing_region = ".$region." AND (a.ing_clasificacion = 0 OR a.ing_clasificacion = '') and b.oc_estado = 1 ORDER BY a.ing_id DESC LIMIT ".$limite;
			}
			
			$resc = mysql_query($query);
			$results = mysql_num_rows($resc);
		}


		if($submit == "actualizar")
		{
			for ($i=1; $i <=$total; $i++) {
				if($clasificacion[$i] == 1)
				{
					$update = "UPDATE acti_compra_temporal SET compra_clasificacion = ".$clasificacion[$i].", compra_visible = 1, compra_region_id = ".$var4[$i]."  WHERE compra_ing_id =".$var1[$i]." AND compra_ding_id = ".$var2[$i]." AND id = ".$compra_id[$i];
					$update2 = "UPDATE bode_detingreso SET ding_clasificacion = ".$clasificacion[$i]." WHERE ding_ing_id = ".$ing_id." AND ding_prod_id = ".$var6[$i];
					$update3 = "UPDATE bode_ingreso SET ing_clasificacion = 1 WHERE ing_id = ".$var3;
					$log = "INSERT INTO log VALUES(NULL,".$var2[$i].",0,'CLASIFICACION DE BIENES','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','INVENTARIO','CLASIFICACION')";
					mysql_query($update,$dbh);
					mysql_query($update2,$dbh);
					mysql_query($update3,$dbh);
					mysql_query($log,$dbh);
				}else{
					$update = "UPDATE acti_compra_temporal SET compra_clasificacion = ".$clasificacion[$i].", compra_visible = 0, compra_region_id = ".$var4[$i]."  WHERE compra_ing_id =".$var1[$i]." AND compra_ding_id = ".$var2[$i]." AND id = ".$compra_id[$i];
					$update2 = "UPDATE bode_detingreso SET ding_clasificacion = ".$clasificacion[$i]." WHERE ding_ing_id = ".$ing_id." AND ding_prod_id = ".$var6[$i];
					$update3 = "UPDATE bode_ingreso SET ing_clasificacion = 1 WHERE ing_id = ".$var3;
					$log = "INSERT INTO log VALUES(NULL,".$var2[$i].",0,'CLASIFICACION DE BIENES','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','INVENTARIO','CLASIFICACION')";
					mysql_query($update,$dbh);
					mysql_query($update2,$dbh);
					mysql_query($update3,$dbh);
					mysql_query($log,$dbh);
				}
				
			}

				// INTEGRACION CON WMS - OPEN BOX
				if(1==1){
				if($_SESSION["region"] == 16 || $_SESSION["region"] == 13)
				{
				// GENERACION DE CSV INTERFACE WMS
				// echo "<script>window.open('bode_wms_recepcion_csv.php?ing_id=".$ing_id."');</script>";
					require_once("bode_wms_recepcion_csv.php");
				}
			}
			// FIN INTEGRACION
			
			echo "<script>window.location.href='inv_clasificacion.php?cod=45';</script>";
		}
		?>
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
			<table border="1" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="10">BUSQUEDA <?php if($ori==1){echo"AVANZADA";}?></td>
				</tr>
				<?php if ($ori == 1): ?>
					<?php include("inv_clasificacion_ori1.php") ?>
				<?php else: ?>
					<?php include("inv_clasificacion_ori2.php") ?>
				<?php endif ?>
			</table>
		</form>

		<hr>
		<?php if ($results > 0): ?>
			<table border="1" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
				<tr class="Estilo1mc">
					<td></td>
					<td>ORDEN DE COMPRA</td>
					<td>REGION</td>
					<td>GRUPO</td>
					<td>NOMBRE ORDEN DE COMPRA</td>
					<td>N° GUIA PROVEEDOR</td>
					<td>APROBADO POR</td>
					<td>RT</td>
					<td>RC</td>
					<td>DETALLE</td>
				</tr>

				<?php
				$cont=1;
				while($row = mysql_fetch_array($resc)) {

					$estilo=$cont%2;
					if ($estilo==0) {
						$estilo2="Estilo1mc";
					} else {
						$estilo2="Estilo1mcblanco";
					}

					if($row["ing_id"] == $ing_id){
						$stylo = "style='background-color: red; color: white;'";
					}else{
						$stylo = "";
					}
					?>
					<tr class="trh <?php echo $estilo2 ?>" <?php echo $stylo ?>>
						<td><?php echo $cont ?></td>
						<td><?php echo $row["oc_id2"] ?></td>
						<td><?php echo $row["ing_region"] ?></td>
						<td><?php echo $row["oc_grupo"] ?></td>
						<td><?php echo $row["oc_nombre_oc"] ?></td>
						<td><?php echo $row["ing_guia"] ?></td>
						<td><?php echo $row["ing_aprobado"] ?></td>
						<td><?php echo $row["ing_guianumerotc"] ?></td>
						<td><?php echo $row["ing_guianumerorc"] ?></td>
						<td><a href="<?php echo $_SERVER["REQUEST_URI"]."&ing_id=" .$row["ing_id"] ?>&ori=<?php echo $ori?>"><i class="fa fa-eye link"></i></td>
					</tr>
					<?php $cont++;} ?>
				</table>
			</table>
		<?php else: ?>
			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="10">NO SE HAN ENCONTRADO RESULTADOS</td>
				</tr>
			</table>
		<?php endif ?>
	</div>

	<?php if (isset($ing_id) && is_numeric($ing_id) && $ing_id > 0): ?>
		<?php include("inv_clasificacion_ori3.php") ?>
	<?php endif ?>
	<script type="text/javascript">
		jQuery('.popup').click(function(e){
			e.preventDefault();
			window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=800, height=400, top=100, left=200');
		});
	</script>
</body>
</html>
