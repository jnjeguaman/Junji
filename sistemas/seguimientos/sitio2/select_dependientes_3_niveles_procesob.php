<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: left;
}
-->
</style>
<?php
require("inc/config.php");
require("inc/querys.php");
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelectsb=array(
"select1b"=>"select_1",
"select2b"=>"select_2",
"select3b"=>"select_3"
);

function validaSelectb($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelectsb;
	if(isset($listadoSelectsb[$selectDestino])) return true;
	else return false;
}

function validaOpcionb($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaSelectb($selectDestino) && validaOpcionb($opcionSeleccionada))
{
	$tabla=$listadoSelectsb[$selectDestino];
//	include 'conexion.php';
//	conectar();
	$consulta=mysql_query("SELECT id, opcion FROM $tabla WHERE relacion='$opcionSeleccionada'") or die(mysql_error());
//	desconectar();
	
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenidob(this.id)' class='Estilo1'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".substr($registro[1],0,25)."</option>";
	}			
	echo "</select>";
}
?>
