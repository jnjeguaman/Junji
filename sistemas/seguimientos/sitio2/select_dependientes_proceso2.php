
<?php
require("inc/config.php");
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"paises"=>"tipodocumento",
"estados"=>"documento"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) {
      return true;
    }
	else {
//      echo "no existe";
      return false;
      
    }
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return true;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"]; $ocid=$_GET["ocid"];
//echo "--->".$selectDestino."--".$opcionSeleccionada;
if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
    list($depto, $anno) = split('/', $opcionSeleccionada);

	$tabla=$listadoSelects[$selectDestino];
//	include 'conexion.php';
//	conectar();
    $sql="SELECT compra_id,compra_nombre, compra_depto FROM compra_compra where compra_depto='$depto' and compra_estado<>'CUMPLIDA' and compra_anno=$anno order by compra_nombre";
//  $sql="SELECT compra_id,compra_nombre, compra_depto FROM compra_compra where compra_depto='$opcionSeleccionada' and compra_estado<>'CUMPLIDA' and compra_anno=2013 order by compra_nombre";
	$consulta=mysql_query($sql) or die(mysql_error());
//	desconectar();
//	echo $sql;
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido2(this.id)' class='Estilo1'>";
	echo "<option value=''>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities(utf8_encode($registro[1]));
		// Imprimo las opciones del select
	echo "<option value='".$registro[0]."'>".substr($registro[1],0,60)."</option>";
	}			
	echo "</select>";


  $occompraid=$ocid;
  $sql22="select * from compra_compra where compra_id=$occompraid ";
//  echo $sql22;
  $result22=mysql_query($sql22);
  $row22=mysql_fetch_array($result22);
  $compranombre2=$row22["compra_nombre"];
  if ($occompraid<>'') {
//    echo "<br>".$compranombre2."<br>&nbsp;";
  }

 

}
?>
