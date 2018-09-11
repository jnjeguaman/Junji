<?php
session_start();
$nom_user = $_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
require_once("inc/config.php");
extract($_GET);
$nom_user = $_SESSION["nom_user"];

// BUSCAMOS LOS PRODUCTOS DE LA GUIA EN LA REGION DE DESTINO
$sql = "SELECT * FROM inv_guia_despacho_detalle WHERE detalle_guia_id = ".$id;
// echo $sql;
$res = mysql_query($sql);

if(mysql_num_rows($res) > 0) {
// OCULTAMOS LOS BIENES EN LA REGION DE DESTINO
	while($row = mysql_fetch_array($res))
	{
		$sql2 = "UPDATE acti_inventario SET inv_visible = 0 WHERE inv_codigo = '".$row["detalle_inv_codigo"]."' AND inv_region = ".$row["detalle_dest"];
		mysql_query($sql2);
		mysql_query("INSERT INTO log VALUES(NULL,".$row["detalle_inv_codigo"].",1,'ANULA PRE TRASLADO','".$nom_user."','".$fechamia."','".$horaSys."','INVENTARIO','REGISTRO GUIAS')");

	}
}
// ANULAMOS LA GUIA DE RESOLUCION
$sql3 = "UPDATE inv_guia_despacho_encabezado SET guia_estado = 0 WHERE guia_id = ".$id;
mysql_query($sql3);

mysql_query("INSERT INTO log VALUES(NULL,".$id.",1,'ANULA GUIA PRE TRASLADO','".$nom_user."','".$fechamia."','".$horaSys."','INVENTARIO','REGISTRO GUIAS')");

?>
<script type="text/javascript">
	window.location.href="registro_guias.php?cod=27";
</script>