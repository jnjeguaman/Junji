<?php

if (isset($_REQUEST["cmd"])) {
	$cmd = htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch ($cmd) {
		case 'getProveedores':
		getProveedores();
		break;
		
	}
}

function getProveedores()
{
require("inc/config.php");
	$query = "SELECT proveedor_glosa FROM acti_proveedor ORDER BY proveedor_glosa ASC";
	$query = mysql_query($query,$dbh);
	$arrayName = array();
	$max = 0;
	while($row = mysql_fetch_array($query))
	{
		$max++;
		$arrayName[$max] = utf8_encode($row["proveedor_glosa"]);

	}
	echo json_encode($arrayName);
}

?>