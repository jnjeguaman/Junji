<?php
require_once("inc/config.php");
session_start();
extract($_POST);

$id = $mas_id;

// VERIFICAMOS EL ESTADO DE LA MATRIZ

$estado = "SELECT * FROM bode_masiva WHERE mas_id = ".$id." LIMIT 1";
$estado = mysql_query($estado);
$estado = mysql_fetch_array($estado);

/*
mas_estado  = 1 (AGREGAN MAS PRODUCTOS) : 0 CERRADA
mas_publico = 1 PUBLICADA : 0 NO PUBLICADA
*/
if($estado["mas_estado"] == 1)
{
	$TotalJardines = mysql_query("SELECT COUNT(oc_id) as TotalJardines FROM bode_orcom2 WHERE oc_mas_id = ".$estado["mas_id"]);
	$TotalJardines = mysql_fetch_array($TotalJardines);
	$TotalJardines = $TotalJardines["TotalJardines"];


	$TotalProductos = mysql_query("SELECT COUNT(doc_id) as TotalProductos FROM bode_detoc2 WHERE doc_mas_id = ".$estado["mas_id"]);
	$TotalProductos = mysql_fetch_array($TotalProductos);
	$TotalProductos = $TotalProductos["TotalProductos"];

	if($TotalJardines <> 0 || $TotalProductos <> 0)
	{
		echo json_encode(array("Respuesta" => false,"Mensaje" => "Esta matriz no se puede eliminar. Tiene : ".$TotalJardines." Jardines creados con ".$TotalProductos." productos"));
	}else{
		if(mysql_query("UPDATE bode_masiva SET mas_visible = 0 WHERE mas_id = ".$id))
		{
			mysql_query("INSERT INTO log VALUES(NULL,".$id.",0,'ELIMINA MATRIZ','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','MATRIZ')");
			
			echo json_encode(array("Respuesta" => true));
		}else{
			echo json_encode(array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al eliminar."));
		}
	}

}else{
	// $TotalProductos = mysql_query("SELECT COUNT(ddoc_id) as TotalProductos FROM bode_detoc_2 WHERE ddoc_mas_id = ".$id);
	// $TotalProductos = mysql_fetch_array($TotalProductos);
	// $TotalProductos = $TotalProductos["TotalProductos"];
	mysql_query("DELETE FROM bode_detoc_2 WHERE ddoc_mas_id = ".$id);
	mysql_query("DELETE FROM bode_orcom2 WHERE oc_mas_id = ".$id);
	mysql_query("DELETE FROM bode_detoc2 WHERE doc_mas_id = ".$id);
	mysql_query("UPDATE bode_masiva SET mas_visible = 0 WHERE mas_id = ".$id);
	mysql_query("INSERT INTO log VALUES(NULL,".$id.",0,'ELIMINA MATRIZ','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','MATRIZ')");
	echo json_encode(array("Respuesta" => true,"Mensaje" => "Matriz eliminada"));
}

?>