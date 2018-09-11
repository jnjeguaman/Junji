<?php 
session_start();
require("inc/config.php");

if(isset($_REQUEST["cmd"]))
{
	$cmd = htmlspecialchars($_REQUEST["cmd"]);
	$cmd = htmlentities($cmd);

	switch ($cmd) {
		case 'eliminarItem':
		echo json_encode(eliminarItem($_POST));
		break;
	}
}

function eliminarItem($input)
{

	$sql = "DELETE FROM acti_compra WHERE id = ".$input["compra_id"];
	if(mysql_query($sql,$dbh))
	{
		return true;
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}

}

?>