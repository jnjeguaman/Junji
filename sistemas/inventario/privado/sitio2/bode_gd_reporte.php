<?php
$filename = "reporte".Date("YmdHis");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");
// REPORTE DE LAS GUIAS DE DESPACHO EN FORMATO EXCEL
include_once("inc/config.php");
extract($_POST);

//OBTENEMOS EL LISTADO DE LAS GUIAS 
$guias = array(); // Almacenaremos el resultado
$sql = trim(str_replace(" ORDER by y.oc_folioguia DESC LIMIT 50","",$qry));

$res = mysql_query($sql);

while($row = mysql_fetch_array($res))
{
	$guias[] = array("ID" => $row["oc_id"],"FOLIO" => $row["oc_folioguia"]);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>REPORTE</title>

	<style type="text/css">
	#tableTitulo{
		width: 100%;
		height: 50px;
		background-color: #4CAF50;
    	color: white;
    	text-align: center;
    	border: 1px solid black;
	}

	#tableTitulo2{
		width: 100%;
		height: 50px;
		
    	
    	text-align: center;
    	border: 1px solid black;
	}

	#tableDetalle{
		width: 100%;
		border: 1px solid black;
		margin-bottom: 10px;
		margin-top: 10px;
	}

#numeroGuia{
	border-bottom: 1px solid #ddd;
	padding-bottom: 10px;
	padding-top: 10px;
}

#espacio{
	padding: 5px;
	text-align: center;
}

	</style>
</head>
<body>
<table id="tableTitulo">
	<tr>
		<td>DETALLE</td>
	</tr>
</table>
<?php foreach ($guias as $key => $value): ?>
	<table id="tableDetalle">
		<tr>
			<td colspan="5" id="numeroGuia">GUIA DE DESPACHO N&deg; <?php echo $value["FOLIO"] ?></td>
		</tr>

		<tr>
			<tr  id="tableTitulo2">
				<td>PRODUCTO</td>
				<td>DESTINO</td>
				<td>CANTIDAD</td>
				<td>VALOR UNITARIO</td>
				<td>ORDEN DE COMPRA</td>

			</tr>
			<?php 
		//Obtenemos el detalle de la guia
			// $sql = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b on b.oc_id = a.doc_oc_id WHERE a.doc_oc_id = ".$value["ID"]." AND a.doc_estado <> 'ELIMINADO'";
			$res = mysql_query($sql);
			while($row = mysql_fetch_array($res))
			{

				?>
				<!-- Mostramos el resultado obtenido !-->
				
				<tr>
					<td id="espacio"><?php echo $row["doc_especificacion"] ?></td>
					<td id="espacio"><?php echo $row["oc_guiadestina"] ?></td>
					<td id="espacio"><?php echo $row["doc_cantidad"] ?></td>
					<td id="espacio">$<?php echo number_format($row["doc_conversion"],0,".",".") ?></td>
					<td id="espacio"><?php echo $row["doc_numerooc"] ?></td>
				</tr>

				<?php } ?>
			</tr>
		<?php endforeach ?>
	</table>
</body>
</html>