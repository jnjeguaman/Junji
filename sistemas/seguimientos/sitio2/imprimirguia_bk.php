<?php
session_start();
require("inc/config.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$guia=$_GET["guia"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$sql2 = "Select * from regiones where codigo=$regionsession";
//echo $sql;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombreregion=$row2["nombre"];

$date_in=date("d-m-Y");
require('prueba2/fpdf.php');
$guia=$_GET["guia"];
class PDF extends FPDF {
//Cabecera de página
  function Header(){
    $guia=$_GET["guia"];
	//Logo
	$this->Image('images/junji_logo.png',10,8,35);
	//Arial bold 10
	$this->SetFont('Arial','B',10);
	//Movernos a la derecha
 //
	$this->Cell(90);
	//Título
	$this->MultiCell(65,5,"GUÍA DE DESPACHO INTERNO DOCUMENTO VALORADO",0,'C');
   	$this->Cell(100);
    $this->Cell(20,10,"Nº");
    $this->Cell(20,10,$guia,0);
    $this->Ln(7);

	//Salto de línea
	$this->Ln(1);
}

  //Pie de página
  function Footer(){
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
    $regionsession = $_SESSION["region"];
    $sql2 = "Select * from regiones where codigo=$regionsession";
    //echo $sql;
    $res2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($res2);
    $nombreregion=$row2["nombre"];
	//Número de página
	$this->Cell(35,5,'Registro: SEGFAC ',1,0,'C');
	$this->Cell(80,5,'Sistema de Seguimiento de Facturas - '.$regionsession,1,0,'C');
    $this->Cell(30,5,'Pagina '.$this->PageNo().' de {nb}',1,0,'C');
  }
}

$pdf=new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetMargins(30, 25 , 30);
$pdf->SetAutoPageBreak(true,25);
//for($i=1;$i<=40;$i++)
//	$pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
//$pdf->Output();







  $sql3="select * from dpp_etapas where eta_region='$regionsession' and eta_folioguia=$guia group by eta_folioguia order by eta_folio desc";
  
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
    $pdf->Cell(40,30,"Origen");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,"Oficina de Partes - $nombreregion");
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Destinatario ");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$destinatario);
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Fecha");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$dia."/".$mes."/".$anno);



    $pdf->Ln(25);
    $pdf->Cell(15,4,"Item",1,0,'C');
    $pdf->Cell(140,4,"Detalle",1,0,'C');
    
  $sql31="select * from dpp_etapas where eta_region='$regionsession' and eta_folioguia=$guia order by eta_folio desc";
  $res31 = mysql_query($sql31);
  $cont=1;
  while ($row31 = mysql_fetch_array($res31)) {
   $vartipodoc1=$row31["eta_tipo_doc"];
 if ($vartipodoc1=='Factura') {
     $vartipodoc2=$row31["eta_tipo_doc2"];
   if ($vartipodoc2=="f")
     $vartipodoc="Factura";
   if ($vartipodoc2=="b")
     $vartipodoc="Boleta Servicio";
   if ($vartipodoc2=="r")
     $vartipodoc="Recibo";
   if ($vartipodoc2=="n")
     $vartipodoc="N.Crédito";
   if ($vartipodoc2=="d")
     $vartipodoc="N.Débito";
   if ($vartipodoc2=="bh" or $vartipodoc2=="BH")
     $vartipodoc="Honorario";

 }

 if ($vartipodoc1=='Honorario') {
     $vartipodoc="Honorario";
 }
    $pdf->Ln(4);
    $pdf->Cell(15,28,$cont,1,0,'C');
    $pdf->Cell(40,4,"FOLIO",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["eta_folio"],1,0,'L');

    
    
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');

    $pdf->Cell(40,4,"FECHA DOCTO",1,0,'L',false);
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,substr($row31["eta_fecha_fac"],8,2)."-".substr($row31["eta_fecha_fac"],5,2)."-".substr($row31["eta_fecha_fac"],0,4),1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"TIPO DOCTO",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$vartipodoc,1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"NUMERO DOCTO",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["eta_numero"],1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"MONTO PAGAR",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["eta_monto"],1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"RUT PROVEEDOR",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["eta_rut"]."-".$row31["eta_dig"],1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"NOMBRE PROVEE.",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["eta_cli_nombre"],1,0,'L');

    $cont++;
}






    $pdf->Ln(25);
    $pdf->Cell(70);
    $pdf->Cell(45,30,"V°B° Recibí Conforme",0,0,'C');
    $pdf->Ln(5);
    $pdf->Cell(80);
    $pdf->Cell(45,30,"(".$date_in.")");






$pdf->Output();

?> 
