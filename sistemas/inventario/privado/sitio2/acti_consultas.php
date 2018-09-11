<?php
session_start();
extract($_GET);
extract($_POST);
require("inc/config.php");
$atributo = intval($_SESSION["pfl_user"]);

?>


<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<style type="text/css">
		ul{
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
		}
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
	<?php if ($ori == 1): ?>
		<?php require_once("acti_ori_1.php") ?>
	<?php elseif($ori ==2): ?>
		<?php require_once("acti_ori_2.php") ?>
	<?php else: ?>

	<?php endif ?>
	<div style="background-color:#E0F8E0; position:absolute; top:120px; left:00px; width:100%" id="div1">
		<?php 
		$filtroNombre = array(
			6 => "",
			7 => "MES DEVENGO (INGRESAR NÚMERO MM/AAAA)",
			9 => "ESTADO",
			);
			?>
			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="10">BÚSQUEDA</td>
				</tr>
			</table>
			<br>
			<form name="form1" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">


				<?
				if($atributo === 23) {

					?>
					<table border="0" width="40%">
						<tr>
							<td class="Estilo1">REGION</td>
							<td class="Estilo1">
								<select name="region2" id="filtro" class="Estilo1">
									<option  value="">Seleccionar...</option>

									<?
									$sqlRegion = "SELECT * FROM acti_region order by region_id";
									$sqlRegionResp = mysql_query($sqlRegion);
									while($row = mysql_fetch_array($sqlRegionResp)) {


										?>
										<option value="<? echo  $row["region_id"] ?>" <? if ( $row["region_id"]==$region2) { echo "selected=selected"; } ?> ><? echo $row["region_glosa"] ?></option>
										<?
									}
									?>
								</select>
							</td>

						</tr>
					</table>
					<?
					$region3=$region2;
				} else {
					$region3=$_SESSION["region"];
				}
				?>
				<table border="0" width="40%">
					<tr>
						<td class="Estilo1">ORDEN DE COMPRA</td>
						<td class="Estilo1">
							<input type="text" name="oc" id="clave" class="Estilo2" value="<?php echo $oc ?>" />
						</td>
					</tr>
					
					<tr>
						<td class="Estilo1">CODIGO INVENTARIO</td>
						<td class="Estilo1">
							<input type="text" name="codigo" id="clave" class="Estilo2" value="<?php echo $codigo ?>" />
						</td>
					</tr>
					<tr>
						<td class="Estilo1">PRODUCTO</td>
						<td class="Estilo1">
							<input type="text" name="bien" id="clave" class="Estilo2" value="<?php echo $bien ?>" />
						</td>
					</tr>
					<tr>
						<td class="Estilo1">PROGRAMA</td>
						<td class="Estilo1">
							<input type="text" name="programa" id="clave" class="Estilo2" value="<?php echo $programa ?>" />
						</td>
					</tr>

					<tr>
						<td class="Estilo1">FUNCIONARIO RESPONSABLE</td>
						<td class="Estilo1">
							<input type="text" name="fresponsable" id="clave" class="Estilo2" value="<?php echo $fresponsable ?>" />
						</td>
					</tr>

					<tr>
						<td class="Estilo1">DIRECCION</td>
						<td class="Estilo1">
							<input type="text" name="direccion" id="clave" class="Estilo2" value="<?php echo $direccion ?>" />
						</td>
					</tr>

					<tr>
						<td class="Estilo1">ZONA</td>
						<td class="Estilo1">
							<input type="text" name="zona" id="clave" class="Estilo2" value="<?php echo $zona ?>" />
						</td>
					</tr>

					<tr>
						<td class="Estilo1">CUENTA CONTABLE</td>
						<td class="Estilo1">
							<input type="text" name="ccontable" id="clave" class="Estilo2" value="<?php echo $ccontable ?>" />
						</td>
					</tr>

					<tr>
						<td class="Estilo1">AÑO DEVENGO (INGRESAR NÚMERO AAAA)</td>
						<td class="Estilo1">
							<input type="text" name="adevengo" id="clave" class="Estilo2" value="<?php echo $adevengo ?>" />
						</td>
					</tr>

					<tr>
						<td class="Estilo1">MES DEVENGO (INGRESAR NÚMERO MM/AAAA)</td>
						<td class="Estilo1">
							<input type="text" name="mdevengo" id="clave" class="Estilo2" value="<?php echo $mdevengo ?>" />
						</td>
					</tr>

					<tr>
						<td class="Estilo1">ESTADO</td>
						<td class="Estilo1">
							<input type="text" name="estado" id="clave" class="Estilo2" value="<?php echo $estado ?>" />
						</td>
					</tr>

					<tr>
						<td class="Estilo1">N° RES/BAJA</td>
						<td class="Estilo1">
							<input type="text" name="baja" id="baja" class="Estilo2" value="<?php echo $baja ?>" />
						</td>
					</tr>

					<?php if ($_SESSION["region"] == 16): ?>
						<tr>
							<td class="Estilo1">TIPO REPORTE</td>
							<td class="Estilo1">

								<select name="region2" id="filtro" class="Estilo1">
									<option  value="">Seleccionar...</option>

									<?
									$sqlRegion = "SELECT * FROM acti_region order by region_id";
									$sqlRegionResp = mysql_query($sqlRegion);
									while($row = mysql_fetch_array($sqlRegionResp)) {
										?>
										<option value="<? echo  $row["region_id"] ?>" <? if ( $row["region_id"]==$region2) { echo "selected=selected"; } ?> ><? echo $row["region_glosa"] ?></option>
										<?
									}

									?>
									<option value="17" <?php if($region2 == 17 ){echo"selected";} ?>>NACIONAL</select>
									</select>
								</td>
							</tr>
						<?php else: ?>
							<?php $region2 = $_SESSION["region"] ?>
						<?php endif ?>


					</td>
					<td class="Estilo1"><input type="submit" name="submit" class="Estilo2" value="  Buscar  " ></td>
					<td class="Estilo1"><a href="acti_consultas.php">Limpiar</a></td>
				</tr>
			</table>
		</form>
		<br>

		<?php
		if ($oc<>'') {
			$where1=" inv_oc like '%$oc%' and ";
		}
		if ($codigo<>'') {
			$where2=" inv_codigo like '%$codigo%' and ";
		}
		if ($bien<>'') {
			$where3=" inv_bien like '%$bien%' and ";
		}
		if ($programa<>'') {
			$where4=" inv_programa like '%$programa%' and ";
		}

		if ($fresponsable<>'') {
			$where5=" inv_responsable like '%$fresponsable%' and ";
		}

		if ($direccion<>'') {
			$where6=" inv_direccion like '%$direccion%' and ";
		}
		if ($zona<>'') {
			$where7=" inv_zona like '%$zona%' and ";
		}

		if ($ccontable<>'') {
			$where8=" inv_ccontable = $ccontable and ";
		}

		if ($adevengo<>'') {
			$where9=" YEAR(inv_devengofecha) = $adevengo and ";
		}

		if ($mdevengo<>'') {
			$clave = explode("/", $mdevengo);
			$where10=" YEAR(inv_devengofecha) = ".$clave[1]." and MONTH(inv_devengofecha) = ".$clave[0]." and ";
		}

		if ($estado<>'') {
			$where11=" inv_estadocosto = '".$estado."' and ";
		}

		if ($baja<>'') {
			$where12=" inv_baja = '".$baja."' and ";
		}

		if($region2 <>'')
		{
			if($region2 == 17)
			{
				$where13 = "";
			}else{
				$where13 = "inv_region = ".$region2." AND ";
			}
		}

		$sqlFiltro = "SELECT * FROM acti_inventario WHERE $where1 $where2 $where3 $where4 $where5 $where6 $where7 $where8 $where9 $where10 $where11 $where12 $where13 (inv_estado2 = 1 or inv_estado2 = 0) ORDER by inv_id DESC LIMIT 400";
		//echo $sqlFiltro;
		$consulta = $sqlFiltro;
		$sqlFiltro = mysql_query($sqlFiltro);
		?>
		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
			<tr>
				<td class="Estilo1mcR">
					<!--<form action="exportar3.php" method="POST">
						<input type="hidden" name="consulta" value="<?php echo $consulta ?>">
						<!--<input type="submit" value="Enviar">!-->
						<!--<button type="submit"><i class='fa fa-file-excel-o fa-lg'></i></button>
					</form>
					!-->
					<form action="exportar3.php" method="POST" id="exportar">
					<input type="hidden" name="consulta" id="consulta" value="<?php echo $consulta ?>">
						<a href="#" onClick="exportar()" class="link">EXPORTAR A EXCEL</a>
						<script type="text/javascript">
							function exportar()
							{
								document.getElementById("exportar").submit();
							}
						</script>
					</form>
				</td>
			</tr>
		</table>

		<hr>

		<table border='0' width='100%'>
			<tr>
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
				<th class='Estilo1mc'>VER</th>
				<th class='Estilo1mc'>EDITAR</th>
			</tr>
			<?php while($row = mysql_fetch_array($sqlFiltro)){ 
					$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
				} else {
					$estilo2="Estilo1mcblanco";
				}
				?>
				<tr class="<?php echo $estilo2 ?> trh">
				<td><?php echo $row["inv_oc"] ?></td>
				<td><?php echo $row["inv_codigo"] ?></td>
				<td><?php echo $row["inv_bien"] ?></td>
				<td><?php echo $row["inv_programa"] ?></td>
				<td><?php echo $row["inv_estadocosto"] ?></td>
				<td>$<?php echo number_format($row["inv_costo"],0,".",".") ?></td>

				<?php if (intval($_SESSION["region"]) === 16) { ?>
					<td><?php echo $row["inv_direccion"] ?></td>
				<?php } else { ?>
					<td><a href='/sistemas/inventario/privado/sitio2/getJardin.php?codigo=<?php echo $row["inv_direccion"] ?>' class='jardin'><?php echo $row["inv_direccion"] ?></a></td>
				<?php } ?>

				<td><?php echo $row["inv_zona"] ?></td>
				<td><a href='inv_busca_responsable.php?busca_responsable=<?php echo $row["inv_responsable"] ?>'><?php echo $row["inv_responsable"] ?></td>
				<td><?php echo $row["inv_ccontable"] ?></td>
				<td><?php echo $row["inv_devengofecha"] ?></td>
				<td><?php echo $row["inv_num_factura"] ?></td>
				<td><?php echo $row["inv_comprobante_egreso"] ?></td>
				<td><a href='/sistemas/inventario/privado/sitio2/acti_ori_1.php?id=<?php echo $row["inv_id"] ?>' class='ver link'><i class='fa fa-eye'></i></a></td>
				<td><a href='/sistemas/inventario/privado/sitio2/acti_ori_2.php?id=<?php echo $row["inv_id"] ?>' class='editar link'><i class='fa fa-pencil-square'></i></a></td>
				</tr>
			<?php $cont++;} ?>
		</div>
	</body>

	<script type="text/javascript">

		jQuery('.popup').click(function(e){
			e.preventDefault();
			window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=700, height=350, top=100, left=200, toolbar=1');
		});

		jQuery('.jardin').click(function(e){
			e.preventDefault();
			window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=700, height=350, top=100, left=200, toolbar=1');
		});

		jQuery('.ver').click(function(e){
			e.preventDefault();
			window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=600, height=350, top=100, left=200, toolbar=1');
		});

		jQuery('.editar').click(function(e){
			e.preventDefault();
			window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=600, height=600, top=100, left=200, toolbar=1');
		});

		function valBusqueda(){
			if($("#clave").val() == "")
			{
				alert("INGRESE EL CONTENIDO A BUSCAR");
				document.getElementById("clave").focus();
				return false;
			}else if($("#filtro").val() == ""){
				alert("SELECCIONE UN FILTRO");
				document.getElementById("filtro").focus();
				return false;
			}else{
				return true;
			}
		}
	</script>
	</html>
