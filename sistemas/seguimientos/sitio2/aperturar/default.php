<?php
require_once("../inc/config.php");
extract($_GET);
$paginasPermitidas = array("oc");

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
  "oc" => "/paginas/oc/index.php"
);
include($rutas[$page]);
?>
