<?php 
require_once("inc/config.php");
extract($_GET);

$query = "DELETE FROM bode_detoc WHERE doc_id = ".$pid;
mysql_query($query);
?>
<script type="text/javascript">
	window.location.href="bode_inv_indexoc4.php?cmd=Bajas&ori=2&ocid=<?php echo $ocid ?>";
</script>