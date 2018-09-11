<?php
ini_set("display_errors", 0);
session_start();
extract($_GET);
extract($_POST);
$atributo = intval($_SESSION["pfl_user"]);
$region2 = $_SESSION["region"];
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
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<div style="background-color:#E0F8E0; position:absolute; top:120px; left:00px; width:100%" id="div1">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">BÚSQUEDA</td>
			</tr>
		</table>
		<hr>
		<?php if ($ori==1): ?>
			<?php include("acti_inv_ori1.php") ?>
		<?php else: ?>
			<?php include("acti_inv_ori2.php") ?>
		<?php endif ?>
		<?php
		if($submit <> "normal" && $submit <> "avanzada")
		{
			// AUDITOR
			if($atributo == 23)
			{
				$sqlFiltro = "SELECT * FROM acti_inventario WHERE (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_visible = 1 AND inv_region = ".$_SESSION["region"]." ORDER by inv_id DESC";
			}else{
				$sqlFiltro = "SELECT * FROM acti_inventario WHERE inv_estado2 = 1 AND inv_region = ".$_SESSION["region"]." AND inv_visible = 1 ORDER by inv_id DESC";
			}
		}
		$totalRegistros = mysql_query($sqlFiltro);
		$numRows = mysql_num_rows($totalRegistros);

		$limite = 400;
		
		if($page <> "")
		{
			$page = $page;
		}else{
			$page = 1;
		}
		$start = ($page -1 ) * $limite;
		$paginas = ceil ($numRows / $limite);

		if($submit <> "normal" && $submit <> "avanzada")
		{
			// AUDITOR
			if($atributo == 23)
			{
				$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE (inv_estado2 = 1 OR inv_estado2 = 0) AND inv_visible = 1 AND inv_region = ".$_SESSION["region"]." ORDER by inv_id DESC LIMIT $start,$limite";
			}else{
				$sqlFiltro2 = "SELECT * FROM acti_inventario WHERE inv_estado2 = 1 AND inv_region = ".$_SESSION["region"]." AND inv_visible = 1 ORDER by inv_id DESC LIMIT $start,$limite";
			}
		}
		$res = mysql_query($sqlFiltro2);

		?>

		<?php if (mysql_num_rows($res) > 0): ?>
			<table border='0' cellpadding='0' cellspacing='0' width='100%'>
				<tr> 
					<td class="Estilo1">Total registros : <?php echo $numRows ?></td>
				</tr>
				<?php if ($_SESSION["pfl_user"] <> 23): ?>
					<tr>

						<td class="Estilo1mcR" colspan="10">
							<form action="inv_exportar2.php" method="POST" id="exportar">
								<input type="hidden" name="qry" id="qry" value="<?php echo $sqlFiltro ?>">
								<a href="#" onClick="exportar()" class="link">EXPORTAR A EXCEL</a>
								<script type="text/javascript">
									function exportar(){document.getElementById("exportar").submit();}
								</script>
							</form>
						</td>
					</tr>
				<?php endif ?>

			</table>
			<hr>

			<table border='0' width='100%'>
				<tr>
					<th class='Estilo1mc'>OC</th>
					<th class='Estilo1mc'>CODIGO</th>
					<th class='Estilo1mc'>BIEN</th>
					<?php if ($_SESSION["pfl_user"] <> 23): ?>
						<th class='Estilo1mc'>PROGRAMA</th>
						<th class='Estilo1mc'>ESTADO</th>
						<th class='Estilo1mc'>COSTO</th>
					<?php endif ?>
					<th class='Estilo1mc'>DIRECCION</th>
					<?php if ($_SESSION["pfl_user"] <> 23): ?>
						<th class='Estilo1mc'>ZONA</th>
						<th class='Estilo1mc'>RESPONSABLE</th>
						<th class='Estilo1mc'>C. CONTABLE</th>
						<th class='Estilo1mc'>DEVENGO</th>
						<th class='Estilo1mc'>N° FACTURA</th>
						<th class='Estilo1mc'>N° DEVENGO</th>
						<th class='Estilo1mc'>VER</th>
						<th class='Estilo1mc'>EDITAR</th>
					<?php endif ?>
					<?php if($_SESSION["Acceso"]["acc_del_inv"] == 1): ?>
						<th class='Estilo1mc'>ELIMINAR</th>
					<?php endif ?>
				</tr>

				<?php $cont = 1; while($row = mysql_fetch_array($res)) {
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
						<?php if ($_SESSION["pfl_user"] <> 23): ?>
							<td><?php echo $row["inv_programa"] ?></td>
							<td><?php echo $row["inv_estadocosto"] ?></td>
							<td>$<?php echo number_format($row["inv_costo"],0,".",".")?></td>
						<?php endif ?>
						<td>
							<?php
							$prefix = explode(" ", $row["inv_direccion"]);
							?>
							<?php if ($prefix[0] == "JI" || $prefix[0] == "BR" || $prefix[0] == "DR" || $prefix[0] == "OP"): ?>
								<a href='/sistemas/inventario/privado/sitio2/getJardin.php?codigo=<?php echo $row["inv_direccion"] ?>' class='jardin'><?php echo $row["inv_direccion"] ?></a>
							<?php else: ?>
								<?php echo $row["inv_direccion"] ?>
							<?php endif ?>
						</td>
						<?php if ($atributo <> 23): ?>
							<td><?php echo $row["inv_zona"] ?></td>
							<td><a href='pmural.php?responsable=<?php echo $row["inv_responsable"] ?>'><?php echo $row["inv_responsable"] ?></a></td>
							<td><?php echo $row["inv_ccontable"] ?></td>
							<td><?php echo $row["inv_devengofecha"] ?></td>
							<td><?php echo $row["inv_num_factura"] ?></td>
							<td><?php echo $row["inv_comprobante_egreso"] ?></td>
							<td><a href='/sistemas/inventario/privado/sitio2/acti_ori_1.php?id=<?php echo $row["inv_id"] ?>' class='ver link'><i class='fa fa-eye'></i></a></td>
							<td><a href='/sistemas/inventario/privado/sitio2/acti_ori_2.php?id=<?php echo $row["inv_id"] ?>' class='editar link'><i class='fa fa-pencil-square'></i></a></td>
							<?php if($_SESSION["Acceso"]["acc_del_inv"] == 1): ?>
								<td><a href="inv_borrar.php?inv_id=<?php echo $row["inv_id"] ?>" onclick="return confirm('¿ DESEA ELIMINAR ESTE ITEM DE INVENTARIO ?')"><i class="fa fa-trash fa-lg link"></i></a></td>
							<?php endif ?>

						<?php endif ?>
					</tr>

					<?php $cont++;} ?>
					<?php 
					echo "<tr><td colspan='16'>";
					$paginator ="<ul class='pagination pull-right'>";
					$paginator .="<li><a href='acti_inv.php?cod=24&page=".$page."&ori=".$ori."&oc=".$oc."&submit=".$submit."&codigo=".$codigo."&bien=".$bien."&programa=".$programa."&fresponsable=".$fresponsable."&direccion=".$direccion."&zona=".$zona."&ccontable=".$ccontable."&adevengo=".$adevengo."&mdevengo=".$mdevengo."&estado=".$estado."&baja=".$baja."&region2=".$region2."&filtro=".$filtro."&clave=".$clave."'><i class='fa fa-angle-double-left'></i></a></li>";

					if($page - 1 == 0)
					{
					}else if($page - 1 < 1){
						$paginator .="<li><a href=''acti_inv.php?cod=24&page=".($page - 1)."&ori=".$ori."&oc=".$oc."&submit=".$submit."&codigo=".$codigo."&bien=".$bien."&programa=".$programa."&fresponsable=".$fresponsable."&direccion=".$direccion."&zona=".$zona."&ccontable=".$ccontable."&adevengo=".$adevengo."&mdevengo=".$mdevengo."&estado=".$estado."&baja=".$baja."&region2=".$region2."&filtro=".$filtro."&clave=".$clave."'><i class='fa fa-angle-left'></i></a></li>";
					}else{
						$paginator .="<li><a href=''acti_inv.php?cod=24&page=".($page - 1)."&ori=".$ori."&oc=".$oc."&submit=".$submit."&codigo=".$codigo."&bien=".$bien."&programa=".$programa."&fresponsable=".$fresponsable."&direccion=".$direccion."&zona=".$zona."&ccontable=".$ccontable."&adevengo=".$adevengo."&mdevengo=".$mdevengo."&estado=".$estado."&baja=".$baja."&region2=".$region2."&filtro=".$filtro."&clave=".$clave."'><i class='fa fa-angle-left'></i></a></li>";
					}

					for ($j=1; $j<=$paginas; $j++) { 
						$paginator .="<li id='pagination_".$j."'><a href='acti_inv.php?cod=24&page=".$j."&ori=".$ori."&oc=".$oc."&submit=".$submit."&codigo=".$codigo."&bien=".$bien."&programa=".$programa."&fresponsable=".$fresponsable."&direccion=".$direccion."&zona=".$zona."&ccontable=".$ccontable."&adevengo=".$adevengo."&mdevengo=".$mdevengo."&estado=".$estado."&baja=".$baja."&region2=".$region2."&filtro=".$filtro."&clave=".$clave."'>".$j."</a></li>"; 
					}; 

					if($page + 1 > $paginas)
					{

					}else{
						$paginator .="<li><a href='acti_inv.php?cod=24&page=".($page + 1)."&ori=".$ori."&oc=".$oc."&submit=".$submit."&codigo=".$codigo."&bien=".$bien."&programa=".$programa."&fresponsable=".$fresponsable."&direccion=".$direccion."&zona=".$zona."&ccontable=".$ccontable."&adevengo=".$adevengo."&mdevengo=".$mdevengo."&estado=".$estado."&baja=".$baja."&region2=".$region2."&filtro=".$filtro."&clave=".$clave."'><i class='fa fa-angle-right'></i></a></li>";
					}
												$paginator .="<li><a href='acti_inv.php?cod=24&page=".$paginas."&ori=".$ori."&oc=".$oc."&submit=".$submit."&codigo=".$codigo."&bien=".$bien."&programa=".$programa."&fresponsable=".$fresponsable."&direccion=".$direccion."&zona=".$zona."&ccontable=".$ccontable."&adevengo=".$adevengo."&mdevengo=".$mdevengo."&estado=".$estado."&baja=".$baja."&region2=".$region2."&filtro=".$filtro."&clave=".$clave."'><i class='fa fa-angle-double-right'></i></a></li></ul>"; // Goto last page
												echo $paginator;
												echo "</td></tr>";
												?>
											</table>
										<?php else: ?>
											<hr>
											<table border="0" width="100%">
												<tr>
													<td class="Estilo2titulo"><i class="fa fa-warning fa-lg"></i> NO SE ENCONTRARON RESULTADOS</td>
												</tr>
											</table>
										<?php endif ?>
									</div>

									<script type="text/javascript">
										$(function(){
											$("#pagination_<? echo  $page ?>").addClass("active");
										})
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
								</body>
								</html>
