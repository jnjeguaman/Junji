<?php 
require("inc/config.php");
extract($_POST);
session_start();
ini_set("display_errors", 0);

if ($nivel==40) {
	$wherenivel40="  and doc_tecnicos>0 ";
}


//$consulta = "SELECT * FROM bode_detoc x, bode_orcom y, bode_ingreso z, bode_detingreso a  WHERE x.doc_region = ".$_SESSION["region"]." and x.doc_oc_id=y.oc_id  and (x.doc_estado='CO' or  x.doc_estado='CO') and (x.doc_estadocierre=1 or x.doc_estadocierre=0) $wherenivel40 and y.oc_id = z.ing_oc_id and a.ding_ing_id = z.ing_id ORDER by doc_id desc limit 0,200";
//$consulta = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON a.doc_oc_id = b.oc_id INNER JOIN bode_detingreso c ON a.doc_id = c.ding_prod_id WHERE a.doc_stock >= 0 AND a.doc_region = ".$_SESSION["region"];
//$consulta = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON a.doc_oc_id = b.oc_id INNER JOIN bode_detingreso c ON a.doc_id = c.ding_prod_id INNER JOIN bode_ingreso d ON d.ing_oc_id =b.oc_id WHERE c.ding_cantidad >= 0 AND c.ding_recep_conforme = 'C' GROUP BY d.ing_guia";

if($tipo == 1)
{

if($bodeFiltro == 1)
{
	// Orden de compra
	$consulta = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON a.ding_prod_id = b.doc_id INNER JOIN bode_ingreso c ON a.ding_ing_id = c.ing_id INNER JOIN bode_orcom d ON b.doc_oc_id = d.oc_id WHERE a.ding_recep_conforme = 'C' AND d.oc_id2 LIKE '%".$bodeClave."%'";
}

if($bodeFiltro == 2)
{
	// Numero de guia de proveedor
	$consulta = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON a.ding_prod_id = b.doc_id INNER JOIN bode_ingreso c ON a.ding_ing_id = c.ing_id INNER JOIN bode_orcom d ON b.doc_oc_id = d.oc_id WHERE a.ding_recep_conforme = 'C' AND c.ing_guia = ".$bodeClave;
}

if($bodeFiltro == 3)
{
	// proveedor
	$consulta = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON a.ding_prod_id = b.doc_id INNER JOIN bode_ingreso c ON a.ding_ing_id = c.ing_id INNER JOIN bode_orcom d ON b.doc_oc_id = d.oc_id WHERE a.ding_recep_conforme = 'C' AND d.oc_proveenomb LIKE '%".$bodeClave."%'";
}

if($bodeFiltro == 4)
{
	// Sin Stock
	$consulta = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON a.ding_prod_id = b.doc_id INNER JOIN bode_ingreso c ON a.ding_ing_id = c.ing_id INNER JOIN bode_orcom d ON b.doc_oc_id = d.oc_id WHERE a.ding_recep_conforme = 'C' AND a.ding_cant_final = 0";
}

if($bodeFiltro == 5)
{
	// Fecha de entrega
	$fechas = explode("/", $bodeFiltro);
}

if($bodeFiltro == 6)
{
	
}

if($bodeFiltro == 7)
{
	
}
}else if($tipo == 2)
{

}else{
	//$consulta = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON a.ding_prod_id = b.doc_id INNER JOIN bode_ingreso c ON a.ding_ing_id = c.ing_id INNER JOIN bode_orcom d ON b.doc_oc_id = d.oc_id WHERE a.ding_recep_conforme = 'C'";
	//$consulta = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON a.doc_oc_id = b.oc_id INNER JOIN bode_detingreso c ON a.doc_id = c.ding_prod_id INNER JOIN bode_ingreso d ON d.ing_oc_id =b.oc_id WHERE c.ding_cantidad >= 0 AND c.ding_recep_conforme = 'C' GROUP BY d.ing_guia";
	$consulta = "SELECT * FROM bode_detoc a INNER JOIN bode_detingreso b ON b.ding_prod_id = a.doc_id INNER JOIN bode_ingreso c ON c.ing_id = b.ding_ing_id INNER JOIN bode_orcom d ON d.oc_id = a.doc_oc_id LIMIT 300";

}
//echo $consulta;

$consulta = mysql_query($consulta,$dbh);

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
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php
		include("inc/menu_1b.php");
		?>
	</div>

	<div style="background-color:#E0F8E0; position:absolute; top:120px; left:00px; width:100%" id="div1">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="Estilo2titulo" colspan="9"><center>CONSULTAS</center></td>
			</tr>
		</table>

		<div id="Consulta">
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
		<table border="0" cellpadding="0" cellspacing="0" width="60%">
			<tr>
				<td class="Estilo1">CLAVE</td>
				<td class="Estilo1"><input type="text" name="bodeClave" id="bodeClave" class="Estilo1" value="<?php echo $bodeClave ?>"></td>
				<td class="Estilo1mc">
					<select name="bodeFiltro" class="Estilo1">
						<option selected value="">Seleccionar</option>
						<option value="1" <?php if($bodeFiltro == 1) { echo "selected";} ?>>ORDEN DE COMPRA</option>
						<option value="2" <?php if($bodeFiltro == 2) { echo "selected";} ?>>NUMERO DE GUIA</option>
						<option value="3" <?php if($bodeFiltro == 3) { echo "selected";} ?>>PROVEEDOR</option>
						<option value="4" <?php if($bodeFiltro == 4) { echo "selected";} ?>>SIN STOCK</option>
						<option value="5" <?php if($bodeFiltro == 5) { echo "selected";} ?>>FECHA DE ENTREGA (YYYY/MM/DD)</option>
						<option value="6" <?php if($bodeFiltro == 6) { echo "selected";} ?>>UBICACION</option>
						<option value="7" <?php if($bodeFiltro == 7) { echo "selected";} ?>>PROGRAMA</option>
					</select>
				</td>
				<td class="Estilo1"><input type="submit" value="CONSULTAR"><input type="hidden" name="tipo" value="1"><input type="checkbox" name="avanzada" id="avanzada" value="1" onClick="getAvanzada()"> Búsqueda Avanzada</td>
			</tr>
		</table>
		</form>
		</div>

		<div class="Avanzada">
			
		</div>

		<br>
		<br>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="Estilo2titulo" colspan="9"><center>STOCK</center></td>
			</tr>

			<tr>
				<td colspan="9"><a href='bode_exportar.php' target='_blank'><i class='fa fa-file-excel-o fa-lg'></i></center></a></td>
			</tr>
		
			<tr>
				<td class="Estilo1mc">ORDEN DE COMPRA</td>
				<td class="Estilo1mc">N° GUIA</td>
				<td class="Estilo1mc">BIEN</td>
				<td class="Estilo1mc">STOCK DISPONIBLE</td>
				<td class="Estilo1mc">PROVEEDOR</td>
				<td class="Estilo1mc">FECHA ENTREGA</td>
				<td class="Estilo1mc">VALOR UNITARIO NETO</td>
				<td class="Estilo1mc">UBICACION</td>
				<td class="Estilo1mc">PROGRAMA</td>
			</tr>
			<?php while ($row = mysql_fetch_array($consulta)) { ?>
			
			<tr>
				<td class="Estilo1mc"><?php echo $row["doc_numerooc"] ?></td>
				<td class="Estilo1mc"><?php echo $row["ing_guia"] ?></td>
				<td class="Estilo1mc"><?php echo $row["doc_especificacion"] ?></td>
				<td class="Estilo1mc"><?php echo $row["doc_stock"] ?></td>
				<td class="Estilo1mc"><?php echo $row["oc_proveenomb"] ?></td>
				<td class="Estilo1mc"><?php echo $row["ding_fentrega"] ?></td>
				<td class="Estilo1mc">$<?php echo number_format($row["doc_unit"],0,".",".") ?></td>
				<td class="Estilo1mc"><a href="/sistemas/inventario/privado/sitio2/bode_nueva_ubicacion.php?id=<?php echo $row["ing_id"]?>&prod_id=<?php echo $row["doc_id"] ?>" class="nuevaUbicacion"><?php echo $row["ding_ubicacion"] ?></a></td>
				<td class="Estilo1mc"><?php echo $row["oc_prog"] ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>

	<script type="text/javascript">
		jQuery('.nuevaUbicacion').click(function(e){
			e.preventDefault();
			window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=600, height=600, top=100, left=200, toolbar=1');

		});

		function getAvanzada()
		{
			if($("#avanzada").is(":checked"))
			{
				console.log("checkeado");
				$("#Consulta").fadeOut("slow");
			}else{
				console.log("..");
			}
		}
	</script>
</body>
</html>
<!--<script>opener.location.reload(); window.close();</script>";!-->