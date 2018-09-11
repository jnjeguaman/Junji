<?php
session_start();
require("inc/config.php");

if(isset($_REQUEST["cmd"]))
{
	$cmd = htmlspecialchars($_REQUEST["cmd"]);
	$cmd = htmlentities($cmd);

	switch ($cmd) {
		case 'getVU':
			echo json_encode(getVU($_POST));
			break;
		
		default:
			# code...
			break;
	}
}


function getVU($input)
{
	$sql = "SELECT catsub_vu from acti_catsub WHERE catsub_cat_id = ".$input["grupo"]." AND catsub_nombre = '".$input["subgrupo"]."'";
	$sql = mysql_query($sql);
	$sql = mysql_fetch_array($sql);
	return $sql["catsub_vu"];
}
?>