
<?php
require("inc/config.php");
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"paises2"=>"tipodocumento2",
"estados2"=>"documento2"
);

function validaSelect2($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) {
      return true;
    }
	else {
      echo "no existe";
      return false;
      
    }
}

function validaOpcion2($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return true;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"]; $ocid=$_GET["ocid"];
//echo "--->".$selectDestino."--".$opcionSeleccionada;
if(validaSelect2($selectDestino) && validaOpcion2($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
//	include 'conexion.php';
//	conectar();
    $sql="SELECT subcat_id,subcat_nombre FROM compra_subcat where subcat_cat_id='$opcionSeleccionada' order by subcat_nombre";
//	echo $sql;
	$consulta=mysql_query($sql) or die(mysql_error());
//	desconectar();
//	echo $sql;
	// Comienzo a imprimir el select
	echo "<select name='estados2' id='estados2' onChange='cargaContenido2b(this.id)' class='Estilo1'>";
	echo "<option value=''>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		// $registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
	echo "<option value='".$registro[0]."'>".substr($registro[1],0,47)."</option>";
	}			
	echo "</select>";


  $occompraid=$ocid;
  $sql22="select * from compra_subcat where subcat_id=$occompraid ";
//  echo $sql22;
  $result22=mysql_query($sql22);
  $row22=mysql_fetch_array($result22);
  $compranombre2=$row22["subcat_nombre"];
  if ($occompraid<>'') {
    echo "<br>".$compranombre2."<br>&nbsp;";
  }

 

}
?>
