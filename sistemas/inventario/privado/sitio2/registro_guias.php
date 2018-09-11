<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="librerias/calendar.js"></script>
<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
<script type="text/javascript" src="librerias/calendar-setup.js"></script>
<?php
extract($_POST);
extract($_GET);
session_start();
$atributo = intval($_SESSION["pfl_user"]);
$filtros = array(
	"" => "Seleccionar...",
	1 => "NUMERO DE GUIA",
	2 => "CODIGO DE INVENTARIO",
	3 => "DIRECCION DE DESTINO",
	4 => "ABASTECE",
	5 => "DESTINATARIO",
	6 => "RESPONSABLE",
	7 => "EMISOR DE LA GUIA",
	8 => "MES EMISION (INGRESAR MM/AAAA)",
	9 => "FECHA EMISION (INGRESAR AAAA-MM-DD)",
	10 => "GUIAS NULAS");

require("inc/config.php");
$filtro = intval($_POST["filtro"]);
if($submit == "normal")
{
	if($filtro === 1){
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND a.guia_numero = ".$_POST["clave"]." AND guia_region_origen = ".$_SESSION["region"];
	}else if($filtro === 2)
	{
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND b.detalle_inv_codigo = ".$_POST["clave"]." AND guia_region_origen = ".$_SESSION["region"];

	}else if($filtro === 3)
	{
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND a.guia_direccion LIKE '%".$_POST["clave"]."%'"." AND guia_region_origen = ".$_SESSION["region"];
	}else if($filtro === 4)
	{
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND a.guia_abastece LIKE '%".$_POST["clave"]."%'"." AND guia_region_origen = ".$_SESSION["region"];
	}else if($filtro === 5)
	{
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND a.guia_destinatario LIKE '%".$_POST["clave"]."%'"." AND guia_region_origen = ".$_SESSION["region"];
	}else if($filtro === 6)
	{
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND a.guia_responsable LIKE '%".$_POST["clave"]."%'"." AND guia_region_origen = ".$_SESSION["region"];
	}else if($filtro === 7)
	{
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND a.guia_emisor LIKE '%".$_POST["clave"]."%'"." AND guia_region_origen = ".$_SESSION["region"];
	}else if($filtro === 8)
	{
		$clave = explode("/", $_POST["clave"]);
		$mes = $clave[0];
		$year = $clave[1];
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND YEAR(a.guia_emision) = ".$year." AND MONTH(a.guia_emision) = ".$mes." AND guia_region_origen = ".$_SESSION["region"];
	}else if($filtro === 9){
		$clave = explode("-", $clave);
		$year = $clave[0];
		$mes =  $clave[1];
		$dia = $clave[2];
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND YEAR(a.guia_emision) = ".$year." AND MONTH(a.guia_emision) = ".$mes." AND DAY(a.guia_emision) = ".$dia." AND guia_region_origen = ".$_SESSION["region"];

	}else if($filtro === 10){
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND a.guia_estado = 0 AND guia_region_origen = ".$_SESSION["region"];
	}else{
		$busqueda = "SELECT * FROM inv_guia_despacho_encabezado WHERE guia_origen = 0 AND guia_region_origen = ".$_SESSION["region"]." ORDER BY guia_id DESC LIMIT 50";
	}
}

if($submit == "avanzada")
{

	if($nguia <> "")
	{
		$where = "a.guia_numero LIKE '%".$nguia."%' AND ";
	}

	if($cinventario <> "")
	{
		$where .= "b.detalle_inv_codigo LIKE '%".$cinventario."%' AND ";
	}

	if($ddestino <> "")
	{
		$where .= "a.guia_direccion LIKE '%".$ddestino."%' AND ";
	}

	if($abastece <> "")
	{
		$where .= "a.guia_abastece LIKE '%".$abastece."%' AND ";
	}

	if($destinatario <> "")
	{
		$where .= "a.guia_destinatario LIKE '%".$destinatario."%' AND ";
	}

	if($responsable <> "")
	{
		$where .= "a.guia_responsable  LIKE '%".$responsable."%' AND ";
	}

	if($eguia <> "")
	{
		$where .= "a.guia_emisor LIKE '%".$eguia."%' AND ";
	}

	if($memision <> "")
	{
		$clave = explode("/", $memision);
		$mes = $clave[0];
		$year = $clave[1];
		$where .= "YEAR(a.guia_emision) = ".$year." AND MONTH(a.guia_emision) = ".$mes." AND ";
	}

	if($aemision <> "")
	{
		$clave = explode("-", $aemision);
		$year = $clave[0];
		$mes = $clave[1];
		$day = $clave[2];
		$where .= "YEAR(a.guia_emision) = ".$year." AND MONTH(a.guia_emision) = ".$mes." AND DAY(a.guia_emision) = ".$day." AND ";
	}

	if($gnulo == "on")
	{
		$where .="a.guia_estado = 0 AND ";
	}
	$busqueda = "SELECT * FROM inv_guia_despacho_encabezado a INNER JOIN inv_guia_despacho_detalle b ON a.guia_id = b.detalle_guia_numero INNER JOIN acti_inventario c ON b.detalle_inv_codigo = c.inv_codigo WHERE a.guia_origen = 0 AND $where a.guia_region_origen = ".$_SESSION["region"]." LIMIT 50";
}
if($submit <> "avanzada" && $submit <> "normal")
{
	$busqueda = "SELECT * FROM inv_guia_despacho_encabezado WHERE guia_origen = 0 AND guia_region_origen = ".$_SESSION["region"]." AND guia_origen = 0 ORDER BY guia_id DESC LIMIT 50";
}

$sqlFiltro = $busqueda;
$busqueda = mysql_query($busqueda);
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<script src="librerias/jquery-1.11.3.min.js"></script>

</head>

<body>
	<div style="background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<div style="width:100%; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">REGISTRO DE GUIAS</td>
			</tr>
		</table>
		<hr>
		<?php if ($ori == 1): ?>
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
				<table border="0" width="80%">
					<tr>
						<td class="Estilo1">NUMERO DE GUIA</td>
						<td class="Estilo1"><input type="text" name="nguia" value="<?php echo $nguia ?>"></td>

						<td class="Estilo1">CODIGO DE INVENTARIO</td>
						<td class="Estilo1"><input type="text" name="cinventario" value="<?php echo $cinventario ?>"></td>
					</tr>

					<tr>
						<td class="Estilo1">DIRECCION DE DESTINO</td>
						<td class="Estilo1"><input type="text" name="ddestino" value="<?php echo $ddestino ?>"></td>

						<td class="Estilo1">ABASTECE</td>
						<td class="Estilo1"><input type="text" name="abastece" value="<?php echo $abastece ?>"></td>
					</tr>

					<tr>
						<td class="Estilo1">DESTINATARIO</td>
						<td class="Estilo1"><input type="text" name="destinatario" value="<?php echo $destinatario ?>"></td>

						<td class="Estilo1">RESPONSABLE</td>
						<td class="Estilo1"><input type="text" name="responsable" value="<?php echo $responsable ?>"></td>
					</tr>

					<tr>
						<td class="Estilo1">EMISOR DE LA GUIA</td>
						<td class="Estilo1"><input type="text" name="eguia" value="<?php echo $eguia ?>"></td>

						<td class="Estilo1">MES DE EMISION (INGRESAR NÚMERO MM/AAAA)</td>
						<td class="Estilo1">
							<input type="text" name="memision" id="memision" value="<?php echo $memision ?>">
							<i class="fa fa-calendar fa-lg link" id="f_trigger_c2" style="cursor:pointer;" title="Seleccionar Fecha"></i>
							<script type="text/javascript">
								Calendar.setup({
									inputField     :    "memision",
									ifFormat       :    "%m/%Y",
									button         :    "f_trigger_c2",
									align          :    "Bl",
									singleClick    :    true
								});
							</script>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">FECHA DE EMISION (INGRESAR NÚMERO YYYY-MM-DD)</td>
						<td class="Estilo1">
							<input type="text" name="aemision" id="aemision" value="<?php echo $aemision ?>">
							<i class="fa fa-calendar fa-lg link" id="f_trigger_c3" style="cursor:pointer;" title="Seleccionar Fecha"></i>
							<script type="text/javascript">
								Calendar.setup({
									inputField     :    "aemision",
									ifFormat       :    "%Y-%m-%d",
									button         :    "f_trigger_c3",
									align          :    "Bl",
									singleClick    :    true
								});
							</script>
						</td>

						<td class="Estilo1">GUIAS NULAS</td>
						<td class="Estilo1">
							<input type="checkbox" name="gnulo" <?php if($gnulo == "on"){echo"checked";} ?>>
						</td>
					</tr>

					<tr>
						<td class="Estilo1" colspan="3" style="text-align:center;">
							<button type="submit" name="submit" value="avanzada">BUSCAR <i class="fa fa-search"></i></button>
							<a href="registro_guias.php?ori=1&cod=<?php echo $cod ?>">LIMPIAR</a> |
							<a href="registro_guias.php?cod=<?php echo $cod ?>">BUSQUEDA SIMPLE</a>
						</td>
					</tr>
				</table>
				<input type="hidden" name="ori" value="<?php echo $ori?>">
			</form>
		<?php else: ?>
			<table border="0" width="60%">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
					<tr>
						<td class="Estilo1">CLAVE</td>
						<td class="Estilo1"><input type="text" name="clave" id="clave" class="Estilo1" value="<?php echo $_POST["clave"] ?>"></td>

						<td class="Estilo1">FILTRO</td>
						<td class="Estilo1">
							<select class="Estilo1" name="filtro" id="filtro">
								<?php if (isset($_POST["filtro"])): ?>
									<option selected value="<?php echo $_POST["filtro"] ?>"><?php echo $filtros[$_POST["filtro"]] ?></option>
								<?php else: ?>
									<option selected value="">Seleccionar...</option>
								<?php endif ?>
								<option value="1">NUMERO DE GUIA</option>
								<option value="2">CODIGO DE INVENTARIO</option>
								<option value="3">DIRECCION DE DESTINO</option>
								<option value="4">ABASTECE</option>
								<option value="5">DESTINATARIO</option>
								<option value="6">RESPONSABLE</option>
								<option value="7">EMISOR DE LA GUIA</option>
								<option value="8">MES EMISION (INGRESAR MM/AAAA)</option>
								<option value="9">FECHA EMISION (INGRESAR AAAA-MM-DD)</option>
								<option value="10">GUIAS NULAS</option>
							</select>
						</td>

						<td class="Estilo1"></td>
						<td class="Estilo1">
							<button type="submit" name="submit" value="normal">BUSCAR <i class="fa fa-search"></i></button>
							<a href="registro_guias.php?ori=1&cod=<?php echo $cod ?>">BUSQUEDA AVANZADA</a> | <a href="registro_guias.php?cod=<?php echo $cod ?>">LIMPIAR</a>
						</td>
					</tr>
				</form>
			</table>
		<?php endif ?>
		<hr>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">RESULTADO</td>
			</tr>

			<tr>
				<td class="Estilo1mcR">
					<form action="inv_exportar3.php" method="POST" id="exportar">
						<input type="hidden" name="qry" id="qry" value="<?php echo $sqlFiltro ?>">
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
		<table border="0" width="100%">
			<tr>
				<td class="Estilo1mc"></td>
				<td class="Estilo1mc">NUMERO DE GUIA</td>
				<?php if ($submit == "avanzada" || $submit == "normal"): ?>
					<td class="Estilo1mc">CODIGO DE INVENTARIO</td>
					<td class="Estilo1mc">PRODUCTO</td>
				<?php endif ?>
				
				<td class="Estilo1mc">ABASTECE</td>
				<td class="Estilo1mc">DESTINATARIO</td>
				<td class="Estilo1mc">FECHA EMISION</td>
				<td class="Estilo1mc">DIRECCION</td>
				<td class="Estilo1mc">COMUNA</td>
				<td class="Estilo1mc">EMISOR</td>
				<td class="Estilo1mc">VER</td>
				<td class="Estilo1mc">ESTADO</td>
				<td class="Estilo1mc">IMPRIMIR</td>
			</tr>

			<?php $cont = 1;while($row = mysql_fetch_array($busqueda))  {
				$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
				} else {
					$estilo2="Estilo1mcblanco";
				}
				?>
				<tr class="<?php echo $estilo2 ?> trh">
					<td><?php echo $cont ?></td>
					<td><?php echo $row["guia_numero"] ?></td>
					<?php if ($submit == "avanzada" || $submit == "normal"): ?>
						<td><?php echo $row["detalle_inv_codigo"] ?></td>
						<td><?php echo $row["inv_bien"] ?></td>
					<?php endif ?>
					<td><?php echo $row["guia_abastece"] ?></td>
					<td><?php echo $row["guia_destinatario"] ?></td>
					<td><?php echo $row["guia_emision"] ?></td>
					<td><?php echo $row["guia_direccion"] ?></td>
					<td><?php echo $row["guia_comuna"] ?></td>
					<td><?php echo $row["guia_emisor"] ?></td>
					<td><a href="inv_guia_despacho_detalle.php?id=<?php echo $row["guia_id"] ?>&guia_origen=<?php echo $row["guia_origen"]?>" class="popup">DETALLES</a></td>
					<?php if ($row["guia_estado"] == 1): ?>
						<?php if ($atributo != 23): ?>
							<td><a href="#" onClick="anular(<?php echo $row["guia_id"] ?>,<?php echo $row["guia_origen"] ?>,<?php echo $row["guia_dte_id"] ?>)">ANULAR</a></td>
						<?php else: ?>
							<td></td>
						<?php endif ?>

					<?php else: ?>
						<td><font color="red">NULO</font></td>
					<?php endif ?>
					<td>
						<?php if ($row["guia_estado"] == 0): ?>
							<font color="red">NULO</font>
						<?php else: ?>
							<a href="imprimir2.php?guia=<?php echo $row["guia_id"]?>&guia_origen=<?php echo $row["guia_origen"]?>" target="_blank"><i class="fa fa-print fa-lg link"></i>
							<?php 
							if($row["guia_region_origen"] == 16)
							{
								$region = 14;
							}else if($row["guia_region_origen"] == 14)
							{
								$region = 14;
							}else{
								$region = $row["guia_region_origen"];
							}
							 ?>
							 <?php if ($row["guia_dte_id"] <> '' && $row["guia_dte_id"] <> 0): ?>
							 	<a href="../../../../SII_JUNJI/documento.php?dte_id=<?php echo $row["guia_dte_id"] ?>&regionSession=<?php echo $region ?>&origen=2" target="_blank"><i class="fa fa-file-pdf-o link"></i></a>
							 <?php endif ?>
							<?php endif; ?>
						</td>
					</tr>
					<?php $cont++;} ?>
				</table>


				<!-- TRASLADOS INTERNOS -->
				<hr>
				<?php
// resultados por pagina
				$limite = 50; 
				
					if($page <> "" && is_numeric($page))
					{
						$page = $page;
					}else{
						$page = 1;
					}
					$start = ($page - 1) * $limite;

				// TRASLADOS INTERNOS COMPLETADOS
				$ti = "SELECT * FROM inv_guia_despacho_encabezado WHERE guia_origen = 1 AND guia_region_origen = ".$_SESSION["region"]." AND guia_estado = 1";
				// TRASLADOS INTERNOS PENDIENTES
				$tip = "SELECT * FROM inv_guia_despacho_encabezado WHERE guia_origen = 1 AND guia_region_origen = ".$_SESSION["region"]." AND guia_estado = 2";

				$numRows1 = mysql_num_rows(mysql_query($ti));
				$numRows2 = mysql_num_rows(mysql_query($tip));

				$paginas1 = ceil($numRows1 / $limite);
				$paginas2 = ceil($numRows2 / $limite);

				$ti = mysql_query($ti.=" LIMIT $start,$limite");
				$tip = mysql_query($tip.=" LIMIT $start,$limite");

				?>

				<table border="0" width="100%">
					<tr>
						<td class="Estilo2titulo" colspan="10">G/D TRASLADO INTERNO</td>
					</tr>
				</table>
				<hr>
				<table border="0" width="100%">
					<tr>
						<td class="Estilo1mc">#</td>
						<td class="Estilo1mc">NUMERO DE GUIA</td>
						<td class="Estilo1mc">ABASTECE</td>
						<td class="Estilo1mc">DESTINATARIO</td>
						<td class="Estilo1mc">FECHA EMISION</td>
						<td class="Estilo1mc">DIRECCION</td>
						<td class="Estilo1mc">EMISOR</td>
						<td class="Estilo1mc">VER</td>
						<td class="Estilo1mc">IMPRIMIR</td>
					</tr>

					<?php $cont = 1;while($row = mysql_fetch_array($ti))  {
						$estilo=$cont%2;
						if ($estilo==0) {
							$estilo2="Estilo1mc";
						} else {
							$estilo2="Estilo1mcblanco";
						}
						?>
						<tr class="<?php echo $estilo2 ?> trh">
							<td><?php echo $cont ?></td>
							<td><?php echo $row["guia_numero"] ?></td>
							<td><?php echo $row["guia_abastece"] ?></td>
							<td><?php echo $row["guia_destinatario"] ?></td>
							<td><?php echo $row["guia_emision"] ?></td>
							<td><?php echo $row["guia_direccion"] ?></td>
							<td><?php echo $row["guia_emisor"] ?></td>
							<td><a href="inv_guia_despacho_detalle.php?id=<?php echo $row["guia_id"] ?>&guia_origen=<?php echo $row["guia_origen"]?>" class="popup">DETALLES</a></td>
							<td>
							<a href="imprimir2.php?guia=<?php echo $row["guia_id"]?>&guia_origen=<?php echo $row["guia_origen"]?>" target="_blank"><i class="fa fa-print fa-lg link"></i>
								<?php 
									if($row["guia_region_origen"] == 16)
									{
										$region = 14;
									}else if($row["guia_region_origen"] == 14)
									{
										$region = 16;
									}else{
										$region = $row["guia_region_origen"];
									}
								?>
								<?php if ($row["guia_dte_id"] <> ''): ?>
									<a href="../../../../SII_JUNJI/documento.php?dte_id=<?php echo $row["guia_dte_id"] ?>&regionSession=<?php echo $region ?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
								<?php endif ?>
							</td>
						</tr>
						<?php $cont++;} ?>
						<tr>
							<td colspan="9">
								<?php 
								$paginator ="<ul class='pagination pull-right'>";
								$paginator .="<li><a href='registro_guias.php?cod=27&origen=TRASLADO&page=1'><i class='fa fa-angle-double-left'></i></a></li>";

								if($page - 1 == 0)
								{
								}else if($page - 1 < 1){
									$paginator .="<li><a href='registro_guias.php?cod=27&origen=TRASLADO&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
								}else{
									$paginator .="<li><a href='registro_guias.php?cod=27&origen=TRASLADO&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
								}

								for ($i=1; $i<=$paginas1; $i++) { 
									$paginator .="<li class='pagination_".$i."'><a href='registro_guias.php?cod=27&origen=TRASLADO&page=".$i."'>".$i."</a></li>"; 
								}; 

								if($page + 1 > $paginas1)
								{

								}else{
									$paginator .="<li><a href='registro_guias.php?cod=27&origen=TRASLADO&page=".($page+1)."'><i class='fa fa-angle-right'></i></a></li>";
								}
$paginator .="<li><a href='registro_guias.php?cod=27&origen=TRASLADO&page=$paginas'><i class='fa fa-angle-double-right'></i></a></li></ul>"; // Goto last page
echo $paginator;
?>
</td>
</tr>
</table>


<hr>

<table border="0" width="100%">
	<tr>
		<td class="Estilo2titulo" colspan="10">PENDIENTE N° RESOLUCION</td>
	</tr>
</table>
<hr>
<table border="0" width="100%">
	<tr>
		<td class="Estilo1mc">#</td>
		<td class="Estilo1mc">NUMERO DE GUIA</td>
		<td class="Estilo1mc">ABASTECE</td>
		<td class="Estilo1mc">DESTINATARIO</td>
		<td class="Estilo1mc">FECHA EMISION</td>
		<td class="Estilo1mc">DIRECCION</td>
		<td class="Estilo1mc">EMISOR</td>
		<td class="Estilo1mc">VER</td>
		<td class="Estilo1mc">EDITAR</td>
		<td class="Estilo1mc">ANULAR</td>
	</tr>

	<?php 
	$cont = 1;while($row = mysql_fetch_array($tip))  {
		$estilo=$cont%2;
		if ($estilo==0) {
			$estilo2="Estilo1mc";
		} else {
			$estilo2="Estilo1mcblanco";
		}
		?>
		<tr class="<?php echo $estilo2 ?> trh">
			<td><?php echo $cont ?></td>
			<td><?php echo $row["guia_numero"] ?></td>
			<td><?php echo $row["guia_abastece"] ?></td>
			<td><?php echo $row["guia_destinatario"] ?></td>
			<td><?php echo $row["guia_emision"] ?></td>
			<td><?php echo $row["guia_direccion"] ?></td>
			<td><?php echo $row["guia_emisor"] ?></td>
			<td><a href="inv_guia_despacho_detalle.php?id=<?php echo $row["guia_id"] ?>&guia_origen=<?php echo $row["guia_origen"]?>" class="popup">DETALLES</a></td>
			<td><a href="inv_traslado_editar.php?guia=<?php echo $row["guia_id"]?>&guia_origen=<?php echo $row["guia_origen"]?>" ><i class="fa fa-pencil fa-lg link"></i></td>
			<td><a href="inv_guia_anular_resolucion.php?id=<?php echo $row["guia_id"] ?>" onclick="return anularPreTraslado(<?php echo $row["guia_numero"] ?>)">ANULAR</td>
		</tr>
		<?php $cont++;} ?>
		<tr>
			<td colspan="9">
				<?php 
				$paginator ="<ul class='pagination pull-right'>";
				$paginator .="<li><a href='registro_guias.php?cod=27&origen=PENDIENTE&page=1'><i class='fa fa-angle-double-left'></i></a></li>";

				if($page - 1 == 0)
				{
				}else if($page - 1 < 1){
					$paginator .="<li><a href='registro_guias.php?cod=27&origen=PENDIENTE&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
				}else{
					$paginator .="<li><a href='registro_guias.php?cod=27&origen=PENDIENTE&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
				}

				for ($i=1; $i<=$paginas2; $i++) { 
					$paginator .="<li class='pagination_".$i."'><a href='registro_guias.php?cod=27&origen=PENDIENTE&page=".$i."'>".$i."</a></li>"; 
				}; 

				if($page + 1 > $paginas2)
				{

				}else{
					$paginator .="<li><a href='registro_guias.php?cod=27&origen=PENDIENTE&page=".($page+1)."'><i class='fa fa-angle-right'></i></a></li>";
				}
$paginator .="<li><a href='registro_guias.php?cod=27&origen=PENDIENTE&page=$paginas'><i class='fa fa-angle-double-right'></i></a></li></ul>"; // Goto last page
echo $paginator;
?>
</td>
</tr>
</table>

</div>

<script type="text/javascript">

	jQuery('.popup').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=900, height=350, top=100, left=200, toolbar=1');
	});

	function anular(input,origen,dte_id){
		if(confirm("¿ESTÁ SEGURO DE ANULAR LA GUIA NUMERO '"+input+"'?")){
			var data = ({cmd : "anularGuia", guia_numero : input,"origen":origen,guia_dte_id:dte_id});
			$.ajax({
				type:"POST",
				url:"inv_guia_despacho_anular.php",
				data:data,
				dataType:"JSON",
				beforeSend : function()
				{
					blockUI();
				},
				success : function ( response ) {
					if(response == true){
						alert("GUIA ANULADA");
						window.location.reload();
					}
				},
				complete : function()
				{
					unBlockUI();
				}

			});
		}else{
			return false;
		}
	}
</script>

<script type="text/javascript">
	$(function(){
		$(".pagination_<? echo  $page ?>").addClass("active");
	})
	function confirma1()
	{
		if(confirm('¿ Seguro que desea Cambiar Estado ?'))
		{
			blockUI();
			return true;
		}else{
			return false;
		}
	}

	function anularPreTraslado(numero)
	{
		if(confirm('¿ESTÁ SEGURO DE ANULAR LA GUIA N° '+numero)){
			blockUI();
		}else{
			return false;
		}
	}
</script>
</body>
</html>
