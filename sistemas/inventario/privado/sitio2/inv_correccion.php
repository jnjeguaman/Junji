<?php
session_start();
ini_set("display_errors", 0);
require("inc/config.php");
extract($_POST);
extract($_GET);
$esteanno=date('Y');
$estemes=date('m');
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

</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<div style="width:600px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">ORDEN DE COMPRA</td>
			</tr>
		</table>
		<form name="form1" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
			<table border="0" width="50%">
				<tr>
					<td class="Estilo1">ORDEN DE COMPRA</td>
					<td class="Estilo1"><input type="text" name="oc" id="oc" class="Estilo2" value="<?php echo $_POST["oc"] ?>" /></td>
				</tr>

				<tr>
					<td class="Estilo1"></td>
					<td class="Estilo1"><input type="submit" name="submit" class="Estilo2" value="  Buscar  " ></td>
				</tr>
				<input type="hidden" name="buscar" value="1">
			</table>
		</form>

		<?php 
		$sql = "SELECT * FROM acti_compra WHERE oc_numero = '".$oc."'";
		$sql = mysql_query($sql);

		$sql2 = "SELECT a.inv_nro_rece, a.inv_bien,a.inv_devengofecha,a.inv_costo,SUM(a.inv_costo) AS valor, a.inv_oc, a.inv_vutil FROM acti_inventario a INNER JOIN acti_compra b ON a.inv_oc = b.oc_numero WHERE a.inv_oc = '".$oc."' GROUP BY inv_nro_rece";
		$sql2 = mysql_query($sql2);

		?>
		<?php if (count($sql) > 0 && intval($buscar) === 1): ?>
			
			<hr>
			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="10">RESULTADO</td>
				</tr>

				<tr>
					<td class="Estilo1mc">ORDEN DE COMPRA</td>
					<td class="Estilo1mc">ITEM</td>
					<td class="Estilo1mc">VALOR TOTAL</td>
					<td class="Estilo1mc">CORREGIR</td>
				</tr>

				<?php while($row = mysql_fetch_array($sql2))  { ?>
				<tr>
					<td class="Estilo1mc"><?php echo $row["inv_oc"] ?></td>
					<td class="Estilo1mc"><?php echo $row["inv_bien"] ?></td>
					<td class="Estilo1mc">$<?php echo number_format($row["valor"],0,".",".") ?></td>
					<td class="Estilo1mc"><a href="?action=corregir&oc=<?php echo $oc ?>&rc=<?php echo $row["inv_nro_rece"] ?>">Corregir</a></td>
				</tr>
				<?php  } ?>
			</table>
		<?php endif ?>

		<?php 
		//$sql = "SELECT * FROM acti_compra WHERE oc_estado = 'OK'";
		$sql = "SELECT a.inv_nro_rece, a.inv_bien,a.inv_devengofecha,a.inv_costo,SUM(a.inv_costo) AS valor, a.inv_oc, a.inv_vutil FROM acti_inventario a INNER JOIN acti_compra b ON a.inv_oc = b.oc_numero WHERE a.inv_devengofecha <> '' GROUP BY inv_nro_rece";
		$sql = mysql_query($sql);
		?>

		<hr>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">LISTA</td>
			</tr>

			<tr>
				<td class="Estilo1mc">ORDEN DE COMPRA</td>
				<td class="Estilo1mc">ITEM</td>
				<td class="Estilo1mc">VALOR TOTAL</td>
				<td class="Estilo1mc">CORREGIR</td>
			</tr>

			<?php while($row = mysql_fetch_array($sql))  { ?>
			<tr>
				<td class="Estilo1mc"><?php echo $row["inv_oc"] ?></td>
				<td class="Estilo1mc"><?php echo $row["inv_bien"] ?></td>
				<td class="Estilo1mc">$<?php echo number_format($row["valor"],0,".",".") ?></td>
				<td class="Estilo1mc"><a href="?action=corregir&oc=<?php echo $row["inv_oc"] ?>&rc=<?php echo $row["inv_nro_rece"] ?>">Corregir</a></td>
			</tr>
			<?php  } ?>
		</table>
	</div>

	<?php if ($action == "corregir"): ?>
		<div style="width:740px; background-color:#E0F8E0; position:absolute; top:120px; left:605px;" id="div2">
			
			<?php 
			$sql = "SELECT YEAR(inv_devengofecha) AS YEAR, MONTH(inv_devengofecha) AS MONTH, DAY(inv_devengofecha) AS DAY,SUM(inv_costo) AS valor, inv_vutil FROM acti_inventario WHERE inv_nro_rece = '".$rc."' LIMIT 1";
			$sql = mysql_query($sql,$dbh);
			$sql = mysql_fetch_array($sql);

			$dia = $sql["DAY"];
			$mes = $sql["MONTH"];
			$anno = $sql["YEAR"];
			?>

			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="10">CORRECION MONETARIA</td>
				</tr>
			</table>

			<table border="0" width="100%">
				<thead>
					<tr>
						<th class="Estilo1mc">Año</th>
						<th class="Estilo1mc">Precio Compra</th>
						<th class="Estilo1mc">Factor</th>
						<th class="Estilo1mc">Monto Actualizado</th>
						<th class="Estilo1mc">Acumulado</th>
						<th class="Estilo1mc">Actualizada</th>
						<th class="Estilo1mc">Vida util</th>
						<th class="Estilo1mc">Utilizado</th>
						<th class="Estilo1mc">Util Resto</th>
						<th class="Estilo1mc">Depreciacion </th>

					</tr>
				</thead>
				<tbody>
					<?php 
					$inicio=1;
					$annoinicio=$anno;

					/* INICIO PRIMER WHILE */
					while ($annoinicio<=$esteanno) {
						if ($mes=='01') {
							$mescampo="indi_ene";
							$mesconsulta="indi_item='ene'";
							$mesp="ene";
							$vutil=12-1;
						}
						if ($mes=='02') {
							$mescampo="indi_feb";
							$mesconsulta="indi_item='feb'";
							$mesp="feb";
							$vutil=12-2;
						}
						if ($mes=='03') {
							$mescampo="indi_mar";
							$mesconsulta="indi_item='mar'";
							$mesp="mar";
							$vutil=12-3;
						}
						if ($mes=='04') {
							$mescampo="indi_abr";
							$mesconsulta="indi_item='abr'";
							$mesp="abr";
							$vutil=12-4;
						}
						if ($mes=='05') {
							$mescampo="indi_may";
							$mesconsulta="indi_item='may'";
							$mesp="may";
							$vutil=12-5;
						}
						if ($mes=='06') {
							$mescampo="indi_jun";
							$mesconsulta="indi_item='jun'";
							$mesp="jun";
							$vutil=12-6;
						}
						if ($mes=='07') {
							$mescampo="indi_jul";
							$mesconsulta="indi_item='jul'";
							$mesp="jul";
							$vutil=12-7;
						}
						if ($mes=='08') {
							$mescampo="indi_ago";
							$mesconsulta="indi_item='ago'";
							$mesp="ago";
							$vutil=12-8;
						}
						if ($mes=='09') {
							$mescampo="indi_sep";
							$mesconsulta="indi_item='sep'";
							$mesp="sep";
							$vutil=12-9;
						}
						if ($mes=='10') {
							$mescampo="indi_oct";
							$mesconsulta="indi_item='oct'";
							$mesp="oct";
							$vutil=12-10;
						}
						if ($mes=='11') {
							$mescampo="indi_nov";
							$mesconsulta="indi_item='nov'";
							$mesp="nov";
							$vutil=12-11;
						}
						if ($mes=='12') {
							$mescampo="indi_dic";
							$mesconsulta="indi_item='dic'";
							$mesp="dic";
							$vutil=12-12;
						}

						if ($inicio==1) {

							$consulta2="select indi_dic from indicador where indi_anno=$anno and indi_item='$mesp' ";
							$res2=mysql_query($consulta2,$dbh);
							$arr2=mysql_fetch_array($res2);

							$factor = str_replace(',',".",$arr2[0]);
							$monto2=$sql["valor"]*$factor/100;
							$monto2=$monto2+$sql["valor"];
							$monto3=$monto2/$sql["inv_vutil"]*$vutil;
							$inicio=0;
							$acumulado=0;
							$actualizado=0;
							$restoutil=$sql["inv_vutil"]-$vutil;
							$preciocompra=$sql["valor"];
						}

						if ($annoinicio!=$esteanno and $annoinicio!=$anno) {

							$preciocompra=$monto2;
							$restoutil2=$restoutil;
							$restoutil=$restoutil-12;
							$acumulado=$acumulado+$monto3;

							$vutil=$vutil+12;
							$consulta2="select indi_dic from indicador where indi_anno=$annoinicio and indi_item='inicial' ";
							$res2=mysql_query($consulta2,$dbh);
							$arr2=mysql_fetch_array($res2);


							$factor = str_replace(',',".",$arr2[0]);
							$monto2=$preciocompra*$factor/100;
							$monto2=$monto2+$preciocompra;
							$inicio=0;
							$actualizado=($acumulado*$factor/100)+$acumulado;
							$monto3=($monto2-$actualizado)/$restoutil2*12;

						}

						if ($annoinicio==$esteanno) {

							$preciocompra=$monto2;
							$restoutil2=$restoutil;
							$restoutil=$restoutil-12;
							$acumulado=$acumulado+$monto3;

							$vutil=$vutil+12;
							$consulta2="select $mescampo from indicador where indi_anno=$esteanno and indi_item='inicial' ";
							$res2=mysql_query($consulta2,$dbh);
							$arr2=mysql_fetch_array($res2);

							$factor = str_replace(',',".",$arr2[0]);
							$monto2=$preciocompra*$factor/100;
							$monto2=$monto2+$preciocompra;
							$inicio=0;
							$actualizado=($acumulado*$factor/100)+$acumulado;
							$monto3=($monto2-$actualizado)/$restoutil2*12;

						}

						?>
						<tr>
							<td class="Estilo1mc"><? echo $annoinicio; ?></td>
							<td class="Estilo1mc">$<? echo number_format($preciocompra,0,',','.'); ?></td>
							<td class="Estilo1mc"><? echo $arr2[0]; ?></td>
							<td class="Estilo1mc">$<? echo number_format($monto2,0,',','.'); ?></td>
							<td class="Estilo1mc">$<? echo number_format($acumulado,0,',','.'); ?></td>
							<td class="Estilo1mc">$<? echo number_format($actualizado,0,',','.'); ?></td>
							<td class="Estilo1mc"><? echo $sql["inv_vutil"];?></td>
							<td class="Estilo1mc"><? echo $vutil; ?></td>
							<td class="Estilo1mc"><? echo $restoutil; ?></td>
							<td class="Estilo1mc"><? echo number_format($monto3,0,',','.'); ?></td>
						</tr>
						<?php
						$annoinicio++;
					}/* FIN PRIMER WHILE */
					?>

				</tbody>
			</table> 
		</div>
	<?php endif ?>
</body>
</html>