<?php
session_start();
require_once("inc/config.php");
extract($_GET);
extract($_POST);
$regionSession = $_SESSION["region"];
$nom_user = $_SESSION["nom_user"];

if($_SESSION["region"] == 14)
{
	$region = 16;
}else if($_SESSION["region"] == 16)
{
	$region = 14;
}else{
	$region = $_SESSION["region"];
}

$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b on b.ing_oc_id = a.oc_id WHERE a.oc_id2 = '".$oc."' AND b.ing_guianumerorc <> 0 AND b.ing_region = ".$region." AND b.ing_aprobado <> ''";
$res = mysql_query($sql,$dbh6);
$contador = 0;
?>
<form action="compra_asocia_rc.php" method="POST">
<table border="0" width="100%" style="border:1px solid #000;border-radius: 10px;border-collapse: collapse;text-align: center;">
	<tr>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;background-color: #bdd4ff;"></td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">N&deg; INGRESO</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">N&deg; RECEPCION CONFORME</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">RECEPCTION CONFORME</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">APROBADOO CONTABLEMENTE POR</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;background-color: #bdd4ff;">ADJUNTO</td>
	</tr>
	<?php while($row = mysql_fetch_array($res)) { ?>
<tr>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;">
<?php if ($row["ing_aprobado"] <> ""): ?>
		<input type="checkbox" name="var1[<?php echo $contador ?>]" value="<?php echo $row["ing_id"] ?>">
	<?php else: ?>
		<i class="fa fa-warning" style="color: tomato;" title="FALTA APROBACIÓN DE LOGISTICA"></i>
<?php endif ?>
	</td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $row["ing_id"] ?></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $row["ing_guianumerorc"] ?></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><a href="../../inventario/privado/sitio2/bode_imprimerca.php?numguia=<?php echo $row["ing_guianumerorc"] ?>" target="_blank" style="text-decoration: none;">VER</a></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $row["ing_aprobado"] ?></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;"><?php echo ($row["ing_rutatc"] <> "" && $row["ing_archivotc"] <> "") ? "<a href='../../".$row["ing_rutatc"].$row["ing_archivotc"]."' target='_blank' style='text-decoration: none;'>VER</a>" : "SIN ADJUNTO" ?></td>
</tr>
	<?php $contador++; } ?>
	<tr>
		<td colspan="6"><button>ASOCIAR</button></td>
	</tr>
</table>
<input type="hidden" name="oc" value="<?php echo $oc ?>">
<input type="hidden" name="enviado" value="1">
<input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
</form>

<?php
$fechamia = date("Y-m-d");
$horamia = date("H:i:s");
if($enviado == 1)
{
	for ($i=0; $i < $totalElementos ; $i++) { 
		if($var1[$i] <> 0)
		{
			$sql2 = "INSERT INTO compra_doc_inedis VALUES ('','".$id."','".$regionSession."','".$nom_user."','".$fechamia."','".$horamia."','RC','".$var1[$i]."',1)";
			mysql_query($sql2,$dbh);
		}
	}
echo "<script>opener.location.reload();window.close();</script>";
	
}

?>