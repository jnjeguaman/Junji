<?php
session_start();
extract($_GET);
require_once("inc/config.php");
$sql = "SELECT * FROM bode_solicitud WHERE sp_id = ".$id;
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
	<title>DETALLE PEDIDO N° <?php echo $row["sp_folio"] ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<p>DETALLE NOTA DE PEDIDO N° <?php echo $row["sp_folio"] ?></p>
						<p>SOLICITANTE : <?php echo $row["sp_usuario"] ?></p>
						<p>DESTINO : <?php echo $row["sp_destino"] ?></p>
						<p>FECHA SOLICITUD : <?php echo date("d/m/Y",strtotime($row["sp_fecha"]))." : ".$row["sp_hora"] ?></p>
					</div>
					<div class="panel-body">
						<p>PRODUCTOS SOLICITADOS</p>
					</div>
					
					<?php 
					// $sql2 = "SELECT a.doc_especificacion,SUM(sp_rel_despachado) as Despachado FROM bode_detoc3 a INNER JOIN bode_solicitud_rel b on a.doc_sp_id = b.sp_rel_sp_id WHERE a.doc_sp_id = ".$row["sp_id"]." GROUP BY a.doc_id";
					$sql2 = "SELECT a.doc_especificacion AS Producto, SUM(sp_rel_despachado) AS Despachado, a.doc_cantidad AS Solicitado FROM bode_detoc3 a LEFT JOIN bode_solicitud_rel b ON a.doc_id = b.sp_rel_doc_id  WHERE a.doc_sp_id = ".$row["sp_id"]."  GROUP BY a.doc_especificacion,a.doc_id";
					$res2 = mysql_query($sql2);
					$contador = 1;
					?>
					<!-- Table -->
					<table class="table">
						<thead>
							<th>#</th>
							<th>PRODUCTO</th>
							<th>CANTIDAD SOLICITADA</th>
							<th>CANTIDAD DESPACHADA</th>
							<th>SALDO POR DESPACHAR</th>
						</thead>

						<tbody>
							<?php while($row2 = mysql_fetch_array($res2)) {  ?>
						<tr>
							<td><?php echo $contador ?></td>
							<td><?php echo $row2["Producto"] ?></td>
							<td><?php echo $row2["Solicitado"] ?></td>
							<td><?php echo $row2["Despachado"] ?></td>
							<td><?php echo ($row2["Solicitado"] - $row2["Despachado"]) ?></td>
						</tr>
							<?php $contador++; } ?>
						</tbody>

						<tfoot>
							<tr>
								<td colspan="5" align="center"><button onclick="window.close()" class="btn btn-primary">CERRAR</button></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>

		<?php
		$sql3 = "SELECT  * FROM bode_orcom WHERE oc_sp_id = ".$id;
		$res3 = mysql_query($sql3);
		?>
		<?php if (mysql_num_rows($res3) > 0): ?>
		<div class="panel panel-default">
		<div class="panel-heading">GUIAS DE DESPACHO RELACIONADAS</div>
			<table class="table table-hover">
			<thead>
					<th>FOLIO</th>
					<th>FECHA EMISION</th>
					<th>EMISOR</th>
 			</thead>	
			
			<tbody>
 				<?php while($row3 = mysql_fetch_array($res3)) { ?>
				<tr>
					<td><?php echo ($row3["oc_folioguia"] == 0) ? "EN PREPARACIÓN" : $row3["oc_folioguia"] ?></td>
					<td><?php echo $row3["oc_guiafecha"] ?></td>
					<td><?php echo $row3["oc_usu"] ?></td>
				</tr>
 				<?php } ?>
 				</tbody>
			</table>
		</div>
	</div>
		<?php else: ?>
			<div class="alert alert-danger" role="alert">
				<i class="fa fa-warning"></i>Estimado/a <?php echo $_SESSION["nom_user"] ?>, de momento no se han generado guias de despacho en relacion a la solicitud de pedido indicada. Por favor verifique más tarde.
			</div>
		<?php endif ?>




</body>
</html>