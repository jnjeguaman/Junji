<?php
require_once("inc/class.documentos.php");

function getDocumentos()
{
	$objDCTO = new Documentos();
	return $objDCTO->getDocumentos();
}

function getDocumentosDTE($input,$region,$periodo)
{
	$objDCTO = new Documentos();
	return $objDCTO->getDocumentosDTE($input,$region,$periodo);
}

function getDocumentosDTE2()
{
	$objDCTO = new Documentos();
	return $objDCTO->getDocumentosDTE2();
}

function getDocumentosDTE3()
{
	$objDCTO = new Documentos();
	return $objDCTO->getDocumentosDTE3();
}

function getDetalleDTE($input)
{
	$objDCTO = new Documentos();
	return $objDCTO->getDetalleDTE($input);
}

function getDocumentoDTE_52($input,$region,$periodo)
{
	$objDCTO = new Documentos();
	return $objDCTO->getDocumentoDTE_52($input,$region,$periodo);
}

?>