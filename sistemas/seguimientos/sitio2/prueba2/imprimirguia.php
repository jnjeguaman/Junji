<?php
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$guia=$_GET["guia"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}


require('prueba2/fpdf.php');
$guia=$_GET["guia"];
class PDF extends FPDF {
//Cabecera de página
  function Header(){
    $guia=$_GET["guia"];
	//Logo
	$this->Image('logo_pbre2.JPG',10,8,63);
	//Arial bold 15
	$this->SetFont('Arial','B',15);
	//Movernos a la derecha
    $this->Ln(7);
	$this->Cell(100);
	//Título
	$this->MultiCell(65,5,"GUÍA DE DESPACHO INTERNO DOCUMENTO VALORADO",0,'C');
   	$this->Cell(100);
    $this->Cell(20,10,"Nº");
    $this->Cell(20,10,$guia,0);

	//Salto de línea
	$this->Ln(1);
}

  //Pie de página
  function Footer(){
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Número de página
	$this->Cell(35,5,'Registro: SEGFAC ',1,0,'C');
	$this->Cell(80,5,'Sistema de Seguimiento de Facturas - Defensoría Nacional',1,0,'C');
    $this->Cell(30,5,'Pagina '.$this->PageNo().' de {nb}',1,0,'C');
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







  $sql3="select * from dpp_etapas where eta_folioguia=$guia group by eta_folioguia";
  
  $res3 = mysql_query($sql3);
  $row3 = mysql_fetch_array($res3);


$destinatario=$row3["eta_destinatario"];
$fecha=$row3["eta_fechaguia"];
$dia=substr($row3["eta_fechaguia"],8,2);
$mes=substr($row3["eta_fechaguia"],5,2);
$anno=substr($row3["eta_fechaguia"],0,4);
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
//$anno=$row5["memo_anno"];

    $pdf->Ln(1);
    $pdf->Cell(40,30,"Origen / Defensoría");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,"Oficina de Partes - Defensoría Nacional");
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Destinatario ");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$destinatario);
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Fecha");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$dia."/".$mes."/".$anno);



    $pdf->Ln(25);
    $pdf->Cell(15,5,"Item",1,0,'C');
    $pdf->Cell(125,5,"Detalle",1,0,'C');
    
  $sql31="select * from dpp_etapas where eta_folioguia=$guia";
  $res31 = mysql_query($sql31);
  $cont=1;
  while ($row31 = mysql_fetch_array($res31)) {
    $pdf->Ln(5);
    $pdf->Cell(15,35,$cont,1,0,'C');
    $pdf->Cell(40,5,"FECHA DOCTO",1,0,'L',false);
    $pdf->Cell(2,5,":",1,0,'C');
    $pdf->Cell(83,5,substr($row31["eta_fecha_fac"],8,2)."-".substr($row31["eta_fecha_fac"],5,2)."-".substr($row31["eta_fecha_fac"],0,4),1,0,'L');
    $pdf->Ln(5);
    $pdf->Cell(15,5,"",0,0,'C');
    $pdf->Cell(40,5,"TIPO DOCTO",1,0,'L');
    $pdf->Cell(2,5,":",1,0,'C');
    $pdf->Cell(83,5,$row31["eta_tipo_doc"],1,0,'L');
    $pdf->Ln(5);
    $pdf->Cell(15,5,"",0,0,'C');
    $pdf->Cell(40,5,"NUMERO DOCTO",1,0,'L');
    $pdf->Cell(2,5,":",1,0,'C');
    $pdf->Cell(83,5,$row31["eta_numero"],1,0,'L');
    $pdf->Ln(5);
    $pdf->Cell(15,5,"",0,0,'C');
    $pdf->Cell(40,5,"MONTO PAGAR",1,0,'L');
    $pdf->Cell(2,5,":",1,0,'C');
    $pdf->Cell(83,5,$row31["eta_monto"],1,0,'L');
    $pdf->Ln(5);
    $pdf->Cell(15,5,"",0,0,'C');
    $pdf->Cell(40,5,"RUT PROVEEDOR",1,0,'L');
    $pdf->Cell(2,5,":",1,0,'C');
    $pdf->Cell(83,5,$row31["eta_rut"]."-".$row31["eta_dig"],1,0,'L');
    $pdf->Ln(5);
    $pdf->Cell(15,5,"",0,0,'C');
    $pdf->Cell(40,5,"NOMBRE PROVEE.",1,0,'L');
    $pdf->Cell(2,5,":",1,0,'C');
    $pdf->Cell(83,5,$row31["eta_cli_nombre"],1,0,'L');
    $pdf->Ln(5);
    $pdf->Cell(15,5,"",0,0,'C');
    $pdf->Cell(40,5,"DES. SERVICIO",1,0,'L');
    $pdf->Cell(2,5,":",1,0,'C');
    $pdf->Cell(83,5,$row31["eta_servicio_final"],1,0,'L');
    $cont++;
}






    $pdf->Ln(30);
    $pdf->Cell(70);
    $pdf->Cell(45,30,"V°B° Recibí Conforme");




$pdf->Output();

?> 
