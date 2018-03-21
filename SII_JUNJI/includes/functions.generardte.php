<?php
require_once("inc/33.php");
require_once("inc/34.php");
require_once("inc/52.php");
require_once("inc/56.php");
require_once("inc/61.php");
require_once("inc/class.acuse1.php");
require_once("inc/class.acuse2.php");
require_once("inc/class.acuse3.php");
require_once("inc/class.iecvventa.php");
require_once("inc/class.set.php");
require_once("inc/class.iecvcompra.php");
require_once("inc/class.librogd.php");

extract($_POST);
switch ($tipo_dcto) {
	case 33:
	facturaElectronica($_POST);
	break;

	case 34:
	facturaAfectaElectronica($_POST);
	break;

	case 52:
	guiaDespachoElectronica($_POST);
	break;
	
	case 56:
	notaDebito($_POST);
	break;

	case 61:
	notaCredito($_POST);
	break;

		case 'acuse_1':
		acuse_1($_POST);
		break;

		case 'acuse_2':
		acuse_2($_POST);
		break;

		case 'acuse_3':
		acuse_3($_POST);
		break;

		case "IECVCompra";
		IECVCompra($_POST);
		break;

		case "IECVVenta";
		IECVVenta($_POST);
		break;


		case 'generaSET':
			generaSET($_POST);
			break;

			case 'LibroGD':
			LibroGD($_POST);
			break;

	default:
		# code...
	break;
}

function facturaElectronica($input)
{
	$objProcesar = new FacturaElectronica($input);
	echo json_encode($objProcesar->GenerarXML());
}

function guiaDespachoElectronica($input)
{
	$objProcesar = new GuiaDespachoElectronica($input);
	echo json_encode($objProcesar->GenerarXML());	
}

function facturaAfectaElectronica($input)
{
	$objProcesar = new FacturaElectronicaAfecta($input);
	echo json_encode($objProcesar->GenerarXML());
}

function notaCredito($input)
{
	$objProcesar = new NotaCredito($input);
	echo json_encode($objProcesar->GenerarXML());
}

function notaDebito($input)
{
	$objProcesar = new NotaDebito($input);
	echo json_encode($objProcesar->GenerarXML());
}

function acuse_1($input)
{
	$objProcesar = new AcuseRecibo($input);
	echo json_encode($objProcesar->GenerarXML());
}

function acuse_2($input)
{
	$objProcesar = new AcuseReciboDoc($input);
	echo json_encode($objProcesar->GenerarXML());
}

function acuse_3($input)
{
	$objProcesar = new AcuseMercaderia($input);
	echo json_encode($objProcesar->GenerarXML());
}

function IECVCompra($input)
{
	$objProcesar = new IECVCompra();
	echo json_encode($objProcesar->GenerarXML($input));
}

function IECVVenta($input)
{
	$objProcesar = new IECVVenta();
	echo json_encode($objProcesar->GenerarXML($input));
}

function generaSET($input)
{
	$objProcesar = new SetDePrueba($input);
	echo json_encode($objProcesar->GenerarXML());
}

function LibroGD($input)
{
	$objProcesar = new LibroGD();
	echo json_encode($objProcesar->generarXML($input));
}
?>