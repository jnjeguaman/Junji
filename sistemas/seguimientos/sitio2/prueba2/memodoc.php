<?php
session_start();
require("inc/config.php");
require("inc/querys.php");
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
	$this->Image('logo_pbre2.JPG',10,8,63);
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
$pdf->SetFont('Times','',12);
$pdf->SetMargins(30, 25 , 30);
$pdf->SetAutoPageBreak(true,25);
//for($i=1;$i<=40;$i++)
//	$pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
//$pdf->Output();



$id2=$_GET["id2"];


if ($id2<>"") {
  $sql5="select * from dpp_memo where memo_id=$id2";
}


$res5 = mysql_query($sql5);
$row5=mysql_fetch_array($res5);
$valor=$row5["memo_valor"];
$mes=$row5["memo_mes"];
if ($mes==1)
 $mes1="Enero";
if ($mes==2)
 $mes1="Febrero";
if ($mes==3)
 $mes1="Marzo";
if ($mes==4)
 $mes1="Abril";
if ($mes==5)
 $mes1="Mayo";
if ($mes==6)
 $mes1="Junio";
if ($mes==7)
 $mes1="Julio";
if ($mes==8)
 $mes1="Agosto";
if ($mes==9)
 $mes1="Septiembre";
if ($mes==10)
 $mes1="Octubre";
if ($mes==11)
 $mes1="Noviembre";
if ($mes==12)
 $mes1="Diciembre";
$anno=$row5["memo_anno"];

    $pdf->Ln(1);
    $pdf->Cell(45,30,"                                                          MEMO DAF Nº :________________________/");
    $pdf->Ln(5);
    $pdf->Cell(45,30,"                                                          ANT.:                  No hay");
    $pdf->Ln(5);
    $pdf->Cell(45,30,"                                                          MAT.:                  Control Pago Proveedores, mes ".$mes1);
    $pdf->Ln(5);
    $pdf->Cell(45,30,"                                                                                       Santiago,");
    $pdf->Ln(10);
    $pdf->Cell(45,40,"DE:      VICTOR VARAS PALMA");
    $pdf->Ln(4);
    $pdf->Cell(45,40,"            JEFE DEPTO. ADMINISTRACIÓN Y FINANZAS");
    $pdf->Ln(8);
    $pdf->Cell(45,40,"A :       LUIS DELGADO VALLEDOR");
    $pdf->Ln(4);
    $pdf->Cell(45,40,"            DIRECTOR ADMINISTRATIVO NACIONAL");



    $pdf->Ln(35);
    $pdf->MultiCell(150,6,"Conforme a lo comprometido en el convenio de desempeño colectivo, por medio de la presente, adjunto remito a usted, planilla de control de pagos a proveedores correspondiente al mes de ".$mes1." del año ".$anno,0,'j');

    $pdf->Ln(5);
    $pdf->MultiCell(150,6,"Al respecto cabe señalar, que este departamento ha dado cumplimiento a la meta de desempño colectivo año 2009 denominada \"Efectuar el pago del 90% de las facturas a proveedores dentro de los 30 dias siguientes a la fecha de ingreso en Oficina de Partes \" toda vez que el ".$valor."% de los proveedores recibió su pago dentro de los 30 dias definidos.",0,'j');

    $pdf->Ln(5);
    $pdf->Cell(45,6,"Saluda atentamente a usted,");

    $pdf->Ln(30);
    $pdf->Cell(45,30,"                                                   VICTOR VARAS PALMA");
    $pdf->Ln(4);
    $pdf->Cell(45,30,"                                   JEFE DEPTO. ADMINISTRACIÓN Y FINANZAS");


   // $pdf->Ln(1);
    $pdf->Ln(10);
    $pdf->Cell(45,30,"JM/grp");






	





$pdf->Output();

?> 
