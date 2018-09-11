<?php
require_once("inc/config.php");
extract($_POST);

if(isset($_REQUEST["cmd"]))
{
	$cmd = htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch($cmd)
	{
		case 'getPasillo':
			getPasillo($bode_code);
			break;

			case 'getUbicacion':
				getUbicacion($ubi_pasillo,$bodega);
				break;
	}
}

function getPasillo($input){
	$sql = "SELECT DISTINCT(ubi_pasillo) FROM bode_ubicacion WHERE ubi_bode = '".$input."' AND ubi_estado = 1";
	$sql = mysql_query($sql);
	$response = "<option value='' selected>Seleccionar...</option>";
	while($row = mysql_fetch_array($sql)){
		$response .= "<option value='".$row["ubi_pasillo"]."'>".$row["ubi_pasillo"]."</option> ";
	}

	echo json_encode($response);
}


function getUbicacion($pasillo,$bodega){
	$sql = "SELECT ubi_ubi FROM bode_ubicacion WHERE  ubi_pasillo = '".$pasillo."' AND ubi_bode = '".$bodega."'  AND ubi_estado = 1 ORDER BY ubi_ubi ASC";
	$sql = mysql_query($sql);
	$response = "<option value='' selected>Seleccionar...</option>";
	while($row = mysql_fetch_array($sql)){
		$response .= "<option value='".$row["ubi_ubi"]."'>".$row["ubi_ubi"]."</option> ";
	}

	echo json_encode($response);
}

?>
