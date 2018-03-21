<?php 
session_start();
require_once("inc/config.php");
$sql3 = "SELECT * FROM dpp_facturas_antecedente WHERE ant_usuario = '".$_SESSION["nom_user"]."' AND ant_region = '".$_SESSION["region"]."' AND ant_eta_id IS NULL AND ant_estado = 1";
                                // echo $sql3;
$res3 = mysql_query($sql3,$dbh);
if(mysql_num_rows($res3) > 0) {
	?>
	<table border="1" style="border-collapse: collapse;" width="100%">
		<tr>
			<td class="Estilo1c" style="text-align: center;">NOMBRE</td>
			<td class="Estilo1c" style="text-align: center;">ARCHIVO</td>
			<td class="Estilo1c" style="text-align: center;">ELIMINAR</td>
		</tr>

		<?php while($row3=mysql_fetch_array($res3)) { ?>
		<tr>
			<td class="Estilo1c" style="text-align: center;"><?php echo $row3["ant_nombre"] ?></td>
			<td class="Estilo1c" style="text-align: center;"><a href="../../archivos/docfac/<?php echo $row3["ant_ruta"] ?>" target="_blank">VER</a></td>
			<td class="Estilo1c" style="text-align: center;"><a href="facturas_antecedente_borrar.php?id=<?php echo $row3["ant_id"] ?>" onclick="return confirm('¿ESTÁ SEGURO DE ELIMINAR LA DOCUMENTACION ADJUNTA SELECCIONADA?')"><img src="imagenes/b_drop.png"></a></td>
		</tr>
		<?php } ?> 
	</table>

	<?php }else{  ?>
	<div class="alert alert-danger">
		NO SE HA SUBIDO ANTECEDENTES
	</div>
	<?php } ?>