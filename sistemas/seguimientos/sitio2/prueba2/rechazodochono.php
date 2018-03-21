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


$id=$_GET["id"];
$id2=$_GET["id2"];
if ($id<>"") {
  $sql5="select * from dpp_honorarios x, dpp_etapas y where x.hono_id=$id and x.fac_hono_id=y.eta_id";
}
if ($id2<>"") {
  $sql5="select * from dpp_honorarios x, dpp_etapas y where x.hono_eta_id=$id2 and x.hono_eta_id=y.eta_id";
}


$res5 = mysql_query($sql5);
$row5=mysql_fetch_array($res5);
$fecha_carta=$row5["eta_fecarta_final"];
$dia=substr($row5["eta_fecarta_final"],8,2);
$mes=substr($row5["eta_fecarta_final"],5,2);
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
$anno=substr($row5["eta_fecarta_final"],0,4);

    $pdf->Ln(1);
    $pdf->Cell(10,0,"                                                                                          Santiago   ".$dia."  de   ".$mes1."    de   ".$anno);

   $rut=$row5["eta_rut"];
   $sql51="select * from dpp_proveedores where provee_rut=$rut ";
   $res51 = mysql_query($sql51);
   $row51=mysql_fetch_array($res51);

//    $pdf->Cell(60);
    $pdf->Ln(2);
    $pdf->Cell(45,40,"Señores:            ");
    $pdf->Ln(4);
    $pdf->Cell(45,40,$row51["provee_nombre"]);
    $pdf->Ln(4);
    $pdf->Cell(45,40,$row51["provee_dir"]." ".$row51["provee_numero"]);
    $pdf->Ln(4);
    $pdf->Cell(45,40,$row51["provee_comuna"]);


$dia=substr($row5["fac_fecha1"],8,2);
$mes=substr($row5["fac_fecha1"],5,2);
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
$anno=substr($row5["fac_fecha1"],0,4);

    $pdf->Ln(3);
    $pdf->Cell(45,60,"Adjunto encontraran  la boleta de honorarios N° ".$row5["hono_nro_boleta"]." de fecha ".$dia." de ".$mes1." de ".$anno);

    $pdf->Ln(4);
    $pdf->Cell(45,65,"correspondiente al servicio de ".$row5["eta_servicio_final"]);

    $pdf->Ln(5);
//    $pdf->MultiCell(120,6,'',0, L, J);
//    $pdf->Cell(45,75,"  Este documento se devuelve, por: ".$row5["eta_motivo_final"],0,0,'L');
    $pdf->Ln(35);
    $pdf->MultiCell(150,6,"Este documento se devuelve, por: ".$row5["eta_motivo_final"],0,'j');

   // $pdf->Ln(1);
    $pdf->Cell(45,65,"Saluda atentamente a usted,");
    $pdf->Ln(38);
    $pdf->Cell(45,65,"                                                                        Victor Varas Palma");
    $pdf->Ln(4);
    $pdf->Cell(45,65,"                                                          Jefe Depto. Administración y Finanzas ");
    $pdf->Ln(4);
    $pdf->Cell(45,65,"                                                                      Defensoría Penal Pública ");
    $pdf->Ln(48);
    $pdf->Cell(45,65,"/aep");
    $pdf->Ln(4);
    $pdf->Cell(45,65,"c.c.: ");
    $pdf->Ln(4);
    $pdf->Cell(45,65,"-Archivo");





	





$pdf->Output();

?> 
