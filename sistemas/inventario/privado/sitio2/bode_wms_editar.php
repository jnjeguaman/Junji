<?php
session_start();
require_once("inc/config.php");
extract($_GET);
extract($_POST);
$contador = 0;
$sql = "SELECT * FROM bode_orcom WHERE oc_id2 = '".$oc."' AND oc_estado = 1 AND oc_tipo = 0 AND (oc_region = 16 OR oc_region = 13)";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

if(isset($_POST) && $_POST["submit"] === "submit")
{
	for($i=0;$i<$totalElementos;$i++)
	{
		if($var[$i] <> "")
		{
			// echo $var[$i]." : ".$var2[$i]."<br>";
			$sql3 = "UPDATE bode_detoc SET doc_id_mercado_publico = '".$var[$i]."' WHERE doc_id = '".$var2[$i]."'";
			mysql_query($sql3);
			$log = "INSERT INTO log VALUES(NULL,'".$var2[$i]."','1','".$var3[$i]." -> ".$var[$i]."','".$_SESSION["nom_user"]."','".date("Y-m-d")."','".date("H:i:s")."','BODEGA','WMS - CARGA GUIA')";
			mysql_query($log);
		}
	}
	echo "<script>alert('Informacion actualizada con exito'); window.close();</script>";
}

$sql2 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$row["oc_id"]." AND (doc_region = 16 OR doc_region = 13)";
$res2 = mysql_query($sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>INEDIS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../../seguimientos/sitio2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
	
	<div class="container-fluid">
	<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">

	<form action="bode_wms_editar.php" method="POST" onsubmit="return valida()">
	<table border="1" width="100%" class="table table-striped table-hover">
			<thead>
			<tr align="center">
				<th colspan="3">DETALLE ORDEN DE COMPRA <strong><?php echo $oc ?></strong></th>
			</tr>

			<tr>
				<th>PRODUCTO</th>
				<th>ID MERCADO PUBLICO</th>
				<th>NUEVO ID</th>
			</tr>
			</thead>

		
			<tbody>
			<?php while($row2 = mysql_fetch_array($res2)) { ?>
			<tr>
				<td><?php echo $row2["doc_especificacion"] ?></td>
				<td><span class="label label-danger" style="font-size: 1.0em"><?php echo $row2["doc_id_mercado_publico"] ?></span></td>
				<td>
					<input type="text" name="var[<?php echo $contador ?>]" class="form-control">
					<input type="hidden" name="var2[<?php echo $contador ?>]" value="<?php echo $row2["doc_id"] ?>">
					<input type="hidden" name="var3[<?php echo $contador ?>]" value="<?php echo $row2["doc_id_mercado_publico"] ?>">
				</td>
			</tr>
			<?php $contador++;} ?>
			<tr>
				<td colspan="3" align="right"><button type="submit" class="btn btn-primary">GRABAR</button></td>
			</tr>
			</tbody>
		</table>
		<input type="hidden" name="submit" value="submit">
		<input type="hidden" name="oc" value="<?php echo $oc ?>">
		<input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
	</form>
</div>
<div class="col-md-1"></div>
</div>
</div>
</body>
</html>

<script type="text/javascript">
	function valida()
	{
		if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?'))
		{
			return true;
		}else{
			return false;
		}
	}
</script>