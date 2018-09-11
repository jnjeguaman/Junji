<?php
session_start();
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
extract($_GET);
require_once("inc/config.php");
// $sql = "SELECT * FROM bode_detoc3 WHERE doc_origen_id = ".$doc_origen_id." AND doc_sp_id = ".$doc_sp_id;
$sql = "SELECT * FROM bode_solicitud_rel a INNER JOIN bode_detoc3 b ON b.doc_id = a.sp_rel_doc_id WHERE a.sp_rel_doc_id = ".$doc_id." AND a.sp_rel_cantidad > 0";
$res = mysql_query($sql);
$contador = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INEDIS</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<form action="bode_solicitud_grabadesasociar.php" method="POST">
		<div class="container"> 

			<div class="row"> 
				<table class="table table-condensed table-stripped table-hover"> 
					<thead>	
						<th>OP</th>
						<th>#</th>
						<th>PRODUCTO</th>
						<th>CANTIDAD ASOCIADA</th>
					</thead>

					<tbody>
						<?php while($row = mysql_fetch_array($res)) { ?>
						<tr>
							<td><input type="checkbox" name="var1[<?php echo $contador ?>]" value="<?php echo $row["sp_rel_id"] ?>"></td>
							<input type="hidden" name="var2[<?php echo $contador ?>]" value="<?php echo $row["sp_rel_cantidad"] ?>">
							<td><?php echo $contador ?></td>
							<td><?php echo $row["doc_especificacion"] ?></td>
							<td><?php echo $row["sp_rel_cantidad"] ?></td>
						</tr>
						<?php $contador++;} ?>
					</tbody>

					<tfoot>
						<tr>
							<td colspan="4" align="right"><button class="btn btn-danger">DESASOCIAR</button></td>
						</tr>
					</tfoot>
				</table>
			</div>	
		</div>
		<input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
	</form>
</body>
</html>