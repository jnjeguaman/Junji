<?php
session_start();
require_once("inc/config.php");
extract($_GET);
extract($_POST);
$regionSession = $_SESSION["region"];
$nom_user = $_SESSION["nom_user"];
$sql="SELECT * FROM dpp_etapas WHERE eta_estado=1 AND eta_folioguia<>0 AND eta_region=$regionSession AND (eta_rut='$rut' AND eta_dig='$dig') AND eta_fecha_recepcion >= '2017-02-01' AND eta_tipo_doc2 = 'd' ORDER BY eta_folio DESC";
//$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b on b.ing_oc_id = a.oc_id WHERE a.oc_id2 = '".$oc."'";
//echo $sql;
$res = mysql_query($sql,$dbh);
$contador = 0;
?>
<form action="compra_asocia_nd.php" method="POST">
<table border="0" width="100%" style="border:1px solid #000;border-radius: 10px;border-collapse: collapse;text-align: center;">
	<tr>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;background-color: #bdd4ff;"></td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">N&deg; FOLIO</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">N&deg; RUT PROVEEDOR</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">PROVEEDOR</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">TIPO DOCUMENTO</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">FECHA DOCUMENTO</td>
		<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;background-color: #bdd4ff;">MONTO</td>
	</tr>
	<?php 
	while($row = mysql_fetch_array($res)) { 
		$tipodoc2=$row["eta_tipo_doc2"];
		if ($tipodoc2=="d") {
        $tipodoc3="Nota de D&eacute;bito";
	    }
	    if ($tipodoc2=="n") {
	        $tipodoc3="Nota de Cr&eacute;dito";
	    }
		$sql2="SELECT * FROM dpp_etapas_nota WHERE nota_estado=1 AND nota_eta_id2='".$row["eta_id"]."'";
		$res2=mysql_query($sql2);
		$row2=mysql_fetch_array($res2);
		?>		
<?php 
if(!isset($row2['nota_id'])) {
?>
<tr>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;">

			<input type="checkbox" name="var1[<?php echo $contador ?>]" value="<?php echo $row["eta_id"] ?>">

	</td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $row["eta_folio"] ?></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $row["eta_rut"]."-".$row["eta_dig"] ?></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $row["eta_cli_nombre"] ?></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $tipodoc3 ?></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo substr($row["eta_fecha_fac"],8,2)."-".substr($row["eta_fecha_fac"],5,2)."-".substr($row["eta_fecha_fac"],0,4) ?></td>
	<td style="font-size: 0.8em;border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo number_format($row["eta_monto"],0,',','.'); ?></td>
	<input type="hidden" name="var2[<?php echo $contador ?>]" value="<?php echo $row["eta_rut"] ?>">
	<input type="hidden" name="var3[<?php echo $contador ?>]" value="<?php echo $row["eta_dig"] ?>">
</tr>			
<?php
}
?>
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
$fechamia = date("Y-m-d H:i:s");

if($enviado == 1)
{
	for ($i=0; $i < $totalElementos ; $i++) { 
		if($var1[$i] <> 0)
		{
			$sql2 = "INSERT INTO dpp_etapas_nota VALUES ('','".$id."','".$var1[$i]."','".$var2[$i]."','".$var3[$i]."','ND','".$nom_user."','".$fechamia."','".$regionSession."',1)";
			mysql_query($sql2,$dbh);
		}
	}
echo "<script>opener.location.reload();window.close();</script>";
	
}

?>