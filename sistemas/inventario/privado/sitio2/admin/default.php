<?php
require_once("includes/config.php");
extract($_GET);
$paginasPermitidas = array("categorias","subcategorias","zonas","subzonas","usuarios","jardines","estadistica","carga","configuracion","encargados","encargados2","gd","clasificacion","oc","rtrc","parametros","guiasinventariables","devengo");

if(isset($page))
{
  if(in_array($page, $paginasPermitidas))
  {
    $page = $page;
  }else{
    $page = "404";
  }
}else{
  $page = "404";
}

$rutas = array(
  "categorias" => "paginas/categoria/index.php",
  "subcategorias" => "paginas/subcategorias/index.php",
  "zonas" => "paginas/zonas/index.php",
  "subzonas" => "paginas/subzonas/index.php",
  "usuarios" => "paginas/usuarios/index.php",
  "404" => "paginas/404/index.php",
  "jardines" => "paginas/jardines/index.php",
  "estadistica" => "paginas/estadistica/index.php",
  "carga" => "paginas/carga/index.php",
  "configuracion" => "paginas/configuracion/index.php",
  "encargados" => "paginas/encargados/index.php",
  "encargados2" => "paginas/encargados2/index.php",
  "gd" => "paginas/gd/index.php",
  "clasificacion" => "paginas/clasificacion/index.php",
  "oc" => "paginas/oc/index.php",
  "rtrc" => "paginas/rtrc/index.php",
  "parametros" => "paginas/parametros/index.php",
  "guiasinventariables" => "paginas/guiasinventariables/index.php",
  "devengo" => "paginas/devengo/index.php"
);
include($rutas[$page]);
?>
