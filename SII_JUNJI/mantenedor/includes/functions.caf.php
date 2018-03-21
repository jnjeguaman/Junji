<?php
require_once("inc/class.caf.php");
function getDocumentos()
{
	$objCAF = new CAF();
	return $objCAF->getDocumentos();
}

function insertarCAF($archivo,$tipo,$inicio,$fin,$region,$fichero,$folio_umbral,$folio_umbral2,$folio_umbral3)
{
	$objCAF = new CAF();
	return $objCAF->insertarCAF($archivo,$tipo,$inicio,$fin,$region,$fichero,$folio_umbral,$folio_umbral2,$folio_umbral3);
}

function getCAF()
{
	$objCAF = new CAF();
	return $objCAF->getCAF();
}
?>