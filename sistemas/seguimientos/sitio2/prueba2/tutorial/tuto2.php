<?php
require('../fpdf.php');

class PDF extends FPDF
{
//Cabecera de página
function Header()
{
	//Logo
	$this->Image('logo_pbre2.JPG',10,8,63);
	//Arial bold 15
	//$this->SetFont('Arial','B',15);
	//Movernos a la derecha
	//$this->Cell(180);
	//Título
	//$this->Cell(30,10,'Titulo de la cancion',1,0,'C');
	//Salto de línea
	$this->Ln(40);
}

//Pie de página
function Footer()
{
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Número de página
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//for($i=1;$i<=1;$i++)
	$pdf->Cell(0,10,'logo_pbre2.png'.$i,0,1);
 	$pdf->Cell(0,10,'logo_pbre2.png'.$i,0,1);



$pdf->Output();
?>
