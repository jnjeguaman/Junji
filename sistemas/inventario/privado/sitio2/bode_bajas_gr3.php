<?php
// Agrega productos a la lista
require_once("inc/config.php");
extract($_POST);
extract($_GET);

for ($i=0; $i < $totalItems; $i++)
{ 

	if($var1[$i] <> '')
	{
		$total = "SELECT COUNT(doc_id) as Total FROM bode_detoc WHERE doc_origen_id = ".$var1[$i]." AND doc_oc_id = ".$ocid;
		$total = mysql_query($total);
		$total = mysql_fetch_array($total);
		$total = intval($total["Total"]);
		if($total == 0)
		{
			$info = "SELECT * FROM bode_detoc a INNER JOIN bode_detingreso b on a.doc_id = b.ding_prod_id WHERE a.doc_id = ".$var1[$i];
			$info = mysql_query($info);
			$info = mysql_fetch_array($info);

			$query4 = "INSERT INTO bode_detoc (doc_oc_id,doc_especificacion,doc_numerooc,doc_origen_id) VALUES (".$ocid.",'".$info["doc_especificacion"]."','".$info["doc_numerooc"]."',".$var1[$i].")";
			mysql_query($query4);
		}
	}	
}
?>
<script type="text/javascript">
	window.location.href="bode_inv_indexoc4.php?cmd=Bajas&ori=2&ocid=<?php echo $ocid ?>";
</script>