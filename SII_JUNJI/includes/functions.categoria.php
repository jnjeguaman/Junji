<?php
require_once("inc/class.categoria.php");

function getCategorias()
{
	$objCategorias = new Categorias();
	return $objCategorias->getCategorias();
}
?>