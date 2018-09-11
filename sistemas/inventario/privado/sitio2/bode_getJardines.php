<?php
if(isset($_REQUEST["cmd"]))
{
	$cmd = htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch($cmd)
	{
		case 'getJardinesRegion':
		getJardinesRegion($_POST);
		break;
	}
}

function getJardinesRegion($input)
{
	require_once("inc/config.php");
	$query = "SELECT * FROM jardines WHERE jardin_region = ".$input["region_id"]. " AND jardin_estado = 1";
	$query = mysql_query($query,$dbh);
	$options = "";
	$options .= "<option value=''>Seleccionar...</option>";
	while($row = mysql_fetch_array($query)) {
		$options .= "<option value='".$row["jardin_codigo"]."'>".$row["jardin_codigo"]." : ".$row["jardin_nombre"]."</option>";
	}
	echo json_encode($options);
}
?>