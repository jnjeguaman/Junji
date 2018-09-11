<?php
session_start();
require("inc/config.php");

mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$fechamia2=date('d-m-Y');
$hora=date("H:i");
extract($_GET);
extract($_POST);
$sql2 = "SELECT * FROM bode_detoc_inv where doci_inv_id=".$inv_id;
?>

<!DOCTYPE html>
<html>
<head>
	<title>TOMA DE INVENTARIO N° : <?php echo $inv_id ?></title>
	<script src="librerias/jquery-1.11.3.min.js"></script>
</head>
<body>
	<table border="0"  width="100%">
		<tr>
			<td  class="Estilo2titulo" colspan="10">Producto a toma de inventario : <? echo $inv_id ?></td>
		</tr>
	</table>
	<hr>

	<form name="form12" action="bode_toma_exportar.php" method="post" onsubmit="return validareeno()">
		<input type="hidden" name="forma" id="forma" value="<? echo $forma ?>" >
		<input type="hidden" name="qry" id="qry" value="<?php echo $sql2 ?>">
		<button type="submit">EXPORTAR EXCEL</button>
	</form>

	<form name="form12" action="bode_grabarealizatoma.php" method="post" onsubmit="return validareeno()">
		<table border="0"  width="100%">
			<tr>
				<td colspan="8">
					<input type="submit"  value="Grabar" >
				</td>
			</tr>

			<tr>
				<td class="Estilo2">N° </td>
				<td class="Estilo2">INPUT</td>
				<td class="Estilo2">DESCRIPCION </td>
				<?php if ($forma != "Oculto"): ?>
					<td class="Estilo2">PRECIO</td>
					<td class="Estilo2">STOCK</td>
				<?php endif ?>
				<td class="Estilo2">TOMA</td>
				<td class="Estilo2">DIF.</td>
				<td class="Estilo2">UBI.</td>
			</tr>

			<?php
			$res2 = mysql_query($sql2);
			$sw_color=0;
			$cont=1;
			$dif=0;
			while ($row2 = mysql_fetch_array($res2)) {

				/*$v_ing_id           = $row2['ing_id'];	
				$v_ing_guia	        = $row2['ing_guia'];
				$v_ing_oc_id        = $row2['ing_oc_id'];	
				$v_ing_fecha        = $row2['ing_fecha'];	
				$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];*/

				if ($sw_color==0){
					$estilo2 = "Estilo1mc";
					$sw_color = 1;
				}else{
					$estilo2 = "Estilo1mcblanco";
					$sw_color = 0;
				}

				if ( $row2['doci_diferencia']<>0) {
					$dif=$dif+1;
				}
				?>

				<tr>
					<td class="<? echo $estilo2 ?>"><? echo  $cont  ?> </td>
					<td class="<? echo $estilo2 ?>">
						<input type="text" name="var2[<? echo  $cont  ?>]"  value="<? echo  $row2['doci_toma']  ?>" size=7>
						<input type="hidden" name="var[<? echo  $cont  ?>]"  value="<? echo  $row2['doci_id']  ?>" size=7>
					</td>
					<td class="<? echo $estilo2 ?>"><? echo  $row2['doci_especificacion']  ?> </td>
					<?php if ($forma != "Oculto"): ?>
						<td class="<? echo $estilo2 ?>"><? echo  $row2['doci_valor_unit']  ?> </td>
						<td class="<? echo $estilo2 ?>"><? echo  $row2['doci_stock']  ?> </td>
					<?php endif ?>
					<td class="<? echo $estilo2 ?>"><? echo  $row2['doci_toma']  ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo  $row2['doci_diferencia']  ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo  $row2['doci_ubi']  ?> </td>
				</tr>



				<?php
				$cont++;
			}
			?>

			<tr>
				<td colspan="8">
					<input type="submit"  value="Grabar" >
				</td>
			</tr>

		</table>


		<table border="0"  width="100%">
			<tr>
				<td class="Estilo2">Diferencias </td>
				<td class="Estilo2"><? echo $dif ?> </td>

			</tr>
		</table>

		<input type="hidden" name="inv_id"  value="<? echo $inv_id ?>" >
		<input type="hidden" name="cont"  value="<? echo $cont ?>" >
		

	</form>

</body>
</html>