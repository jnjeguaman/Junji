<?php
require_once("../inc/config.php");
$sql = "SELECT * FROM bode_orcom WHERE oc_id = ".$_GET["id"];
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$datos = $row;
$fecha = explode("-", $row["oc_fecha"]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>GUIA DE CONSUMO INTERNO <?php echo $datos["oc_guiaabaste"] ?></title>
	<link rel="stylesheet" type="text/css" href="estilo.css">

	<style type="text/css">
		.Estilo1b{
			text-align:center;
			/*font-style:italic;*/
			font-family:"Times New Roman", Times;
			font-size:10px;
		}
	</style>
</head>
<body>

	<div class="encabezado">
		<table id="encabezado">
			<tr>
				<td><img src="../junji_logo.png"></td>
				<td align="center">
					<p id="texto1">JUNTA NACIONAL DE JARDINES INFANTILES</p>
					<p id="texto2">CONSUMO INTERNO</p>
					<p id="texto2">FOLIO N° <?php echo $row["oc_folioguia"] ?></p>
				</td>
				<td>
					<ul>
						<li>FECHA EMISION : <?php echo $fecha[2]."-".$fecha[1]."-".$fecha[0] ?></li>
					</ul>
				</td>
			</tr>
		</table>
	</div>

	<div class="datos">
		<table id="datos">
			<tr>
				<td colspan="3" align="center"><strong>ENCABEZADO</strong></td>
			</tr>

			<tr>
				<td>EMISOR</td>
				<td>:</td>
				<td><?php echo $row["oc_usu"] ?></td>
			</tr>

			<tr>
				<td>DESTINATARIO</td>
				<td>:</td>
				<td><?php echo $row["oc_guiadestina"] ?></td>
			</tr>

			<tr>
				<td>OBSERVACIONES</td>
				<td>:</td>
				<td><?php echo $row["oc_obs"] ?></td>
			</tr>

		</table>
	</div>

	<div class="resumenGuias">
		<table>
			<tr>
				<td colspan="2" align="center"><strong>LISTADO DE GUIAS</strong></td>
			</tr>
		</table>
		
		<?php 
		$productos = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$_GET["id"]." AND doc_estado <> 'ELIMINADO'";
		$productos = mysql_query($productos);	
		?>
		<table id="resumenGuias" cellpadding="0" cellspacing="0" style="border: 1px solid black">
			<tr bgcolor="#4CAF50">
				<td align="left"><b>N°</b></td>
				<td align="left"><b>PRODUCTO</b></td>
				<td align="left"><b>CANTIDAD</b></td>
			</tr>

			<?php
			$contador = 1;
			while($row = mysql_fetch_array($productos)) {

				if($contador % 2 == 0)
				{
					$class = "fondo1";
				}else{
					$class = "fondo2";
				}

				?>
				<tr class="<?php echo $class ?>">
					<td align="left"><?php echo $contador ?></td>
					<td align="left"><?php echo $row["doc_especificacion"] ?></td>
					<td align="left"><?php echo $row["doc_cantidad"] ?></td>
				</tr>

				<?php 
				$contador++;
			} 
			?>
		</table>

		<table border="0" style="padding-top: 150px;width: 700px">

			<tr>
				<th class="Estilo1b"></th>
				<th class="Estilo1b"></th>
				<th class="Estilo1b">
					<?php if ($datos["oc_region2"] == 16): ?>
						<img src="../images/rc_cyf.png" width="150px">
					<?php else: ?>
						<img src="../images/rc_conforme.png" width="150px">
					<?php endif ?>
				</th>
			</tr>

			<tr>
				<th class="Estilo1b"><?php echo $datos["oc_usu"]?></th>
				<th class="Estilo1b"></th>
				<th class="Estilo1b"></th>
			</tr>

			<tr>
				<th class="Estilo1b">______________________________________________________</th>
				<th class="Estilo1b"></th>
				<th class="Estilo1b">______________________________________________________</th>
			</tr>

			<tr>
				<th class="Estilo1b">DOCUMENTO REALIZADO POR</th>
				<th class="Estilo1b"></th>
				<th class="Estilo1b"><?php echo $datos["oc_guiaabaste"] ?></th>
			</tr>
		</table>

	</body>
	</html>