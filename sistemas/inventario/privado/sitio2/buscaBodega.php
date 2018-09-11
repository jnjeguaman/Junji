<?php
if(isset($_REQUEST["cmd"]))
{
	$cmd = htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch($cmd)
	{
		case 'buscaBodega':
			buscaBodega($_POST);
			break;
	}
}

function buscaBodega($input)
{
	require_once("inc/config.php");
	$sql = "SELECT * FROM acti_region WHERE region_id = ".$input["region_id"]." LIMIT 1";
	$sql = mysql_query($sql);
	$sql = mysql_fetch_array($sql);
	echo json_encode($sql);
}
?>