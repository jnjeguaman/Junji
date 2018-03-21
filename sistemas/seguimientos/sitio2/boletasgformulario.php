<?php
session_start();
require("inc/config.php");

$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

require('prueba2/fpdf.php');

class PDF extends FPDF {
//Cabecera de página
  function Header(){
	//Logo
	$this->Image('images/junji_logo.png',10,8,43);
	//Arial bold 15
	//$this->SetFont('Arial','B',15);
	//Movernos a la derecha
	//$this->Cell(80);
	//Título
	//$this->Cell(30,10,'Title',1,0,'C');
	//Salto de línea
	$this->Ln(20);
}

  //Pie de página
  function Footer(){
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Número de página
	//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

$pdf=new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);
$pdf->SetMargins(30, 25 , 30);
$pdf->SetAutoPageBreak(true,25);
//for($i=1;$i<=40;$i++)
//	$pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
//$pdf->Output();


$id=$_GET["id"];
$sql5="select * from dpp_boletasg where boleg_id=$id";
// echo $sql5;

$res5 = mysql_query($sql5);
$row5=mysql_fetch_array($res5);
$fecha_ing=substr($row5["boleg_fecha_ing"],8,2)."-".substr($row5["boleg_fecha_ing"],5,2)."-".substr($row5["boleg_fecha_ing"],0,4);
$fecha_recepcion=substr($row5["boleg_fecha_recep"],8,2)."-".substr($row5["boleg_fecha_recep"],5,2)."-".substr($row5["boleg_fecha_recep"],0,4);
$fecha_vencimiento=substr($row5["boleg_fecha_vence"],8,2)."-".substr($row5["boleg_fecha_vence"],5,2)."-".substr($row5["boleg_fecha_vence"],0,4);
$fecha_emision=substr($row5["boleg_fecha_emision"],8,2)."-".substr($row5["boleg_fecha_emision"],5,2)."-".substr($row5["boleg_fecha_emision"],0,4);
$hora_recepcion=$row5["boleg_hora_recep"];


    $pdf->Ln(12);
    $pdf->Cell(50,0,"                            ANEXO Nº 1: REGISTRO Y CONTROL DE GARANTÍA ");
    $pdf->Ln(10);
    $pdf->Cell(50,0,"                                                                                                                  FORMULARIO Nº ".$row5["boleg_folio"]);
      
    $pdf->Ln(12);
    $pdf->Cell(70,0,"1. INDIVIDUALIZACIÓN DE LA GARANTÍA");

   $rut=$row5["eta_rut"];
//   $sql51="select * from dpp_proveedores where provee_rut=$rut ";
//   $res51 = mysql_query($sql51);
//   $row51=mysql_fetch_array($res51);

//    $pdf->Cell(60);
    $pdf->Ln(2);
    $pdf->Cell(70,5,"Fecha y hora de la recepción ",1);
    $pdf->Cell(91,5,$fecha_recepcion." -- ".$hora_recepcion." hrs.",1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Motivo ",1);
    $pdf->Cell(91,5,$row5["boleg_tipo"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Tipo de Garantía ",1);
    $pdf->Cell(91,5,$row5["boleg_tipo2"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Nombre Empresa ",1);
    $pdf->Cell(91,5,$row5["boleg_nombre"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Domicilio",1);
    $pdf->Cell(91,5,$row5["boleg_direccion"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"RUT Empresa ",1);
    $pdf->Cell(91,5,number_format($row5["boleg_rut"],0,",",".")."-".$row5["boleg_dig"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Fono y Correo Electrónico ",1);
    $pdf->Cell(91,5,$row5["boleg_fono2"]."/".$row5["boleg_correo"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Glosa de la Garantía",1);
    $pdf->MultiCell(91,5,$row5["boleg_glosa"],1,'j');
//    $pdf->Cell(91,5,"",1,0,"C");
//    $pdf->Ln(5);
    $pdf->Cell(70,5,"Nombre Depto. o Unidad de Contacto ",1);
    $pdf->Cell(91,5,$row5["boleg_unidad"],1,0,"C");
    
    $pdf->Ln(18);
    $pdf->Cell(70,0,"2.CUSTODIA DE LA GARANTÍA");
    $pdf->Cell(71,0,"",0,0,"C");
    $pdf->Ln(2);
    $pdf->Cell(70,5,"Fecha de Recepción ",1);
    $pdf->Cell(91,5,$fecha_recepcion,1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Nombre Responsable de la Custodia ",1);
    $pdf->Cell(91,5,$_SESSION["nom_user"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Serie o Número ",1);
    $pdf->Cell(91,5,$row5["boleg_numero"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Institución Emisora",1);
    $pdf->Cell(91,5,$row5["boleg_emisora"],1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Fecha de Emisión",1);
    $pdf->Cell(91,5,$fecha_emision,1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Fecha de Vencimiento",1);
    $pdf->Cell(91,5,$fecha_vencimiento,1,0,"C");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Monto en ".$row5["boleg_tipomoneda"],1);
    $pdf->Cell(91,5,number_format($row5["boleg_monto"],2,",","."),1,0,"C");


    $pdf->Ln(18);
    $pdf->Cell(70,0,"3.DEVOLUCIÓN DE LA GARANTÍA");
    $pdf->Cell(71,0,"",0,0,"L");
    $pdf->Ln(2);
    $pdf->Cell(70,5,"Fecha de Devolución ",1);
    $pdf->Cell(91,5,"",1,0,"L");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Nombre del Habilitado que Retira ",1);
    $pdf->Cell(91,5,"",1,0,"L");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"RUT del Habilitado que Retira ",1);
    $pdf->Cell(91,5,"",1,0,"L");
    $pdf->Ln(5);
    $pdf->Cell(70,20,"Firma del Habilitado que Retira",1);
    $pdf->Cell(91,20,"",1,0,"L");
    
    $pdf->Ln(30);
    $pdf->Cell(70,0,"4.COBRO DE LA GARANTÍA");
    $pdf->Cell(71,0,"",0,0,"L");
    $pdf->Ln(2);
    $pdf->Cell(70,5,"Fecha",1);
    $pdf->Cell(91,5,"",1,0,"L");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Motivo",1);
    $pdf->Cell(91,5,"",1,0,"L");
    $pdf->Ln(5);
    $pdf->Cell(70,5,"Antecedentes de Respaldo",1);
    $pdf->Cell(91,5,"",1,0,"L");








	





$pdf->Output();

?> 
