<?php 
session_start();

extract($_POST);

if(isset($_REQUEST["cmd"]))
{
	$cmd = htmlspecialchars($_REQUEST["cmd"]);
	$cmd = htmlentities($cmd);

	switch ($cmd) {
		case 'eliminarCompra':
		echo json_encode(eliminarCompra($_POST));
		break;
		
		default:
			# code...
		break;
	}
}

function eliminarCompra($input){
	require("inc/config.php");
	$sql = "UPDATE acti_compra_temporal SET compra_visible = 0 WHERE id = ".$input["compra_id"];
	if(mysql_query($sql,$dbh))
	{
		$fechamia=date('Y-m-d');
		$horaSys = Date("H:i:s");
		$log = "INSERT INTO log VALUES(NULL,".$input["compra_id"].",0,'ELIMINA COMPRA/PRODUCTO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','NUEVA COMPRA')";
		mysql_query($log);
		return true;
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}

}

?>
