<?php 
$qryDel = "DELETE FROM bode_detoc2 WHERE doc_id = ".$doc_id." AND doc_mas_id = ".$masid;
mysql_query($qryDel);
echo "<script type='text/javascript'>
window.location.href='bode_inv_indexguia3.php?ori=3&masid=".$masid."';
</script>";
?>