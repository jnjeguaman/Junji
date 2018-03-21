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
    $folio=$_GET["folio"];
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
    $this->Cell(20,10,$folio,0);
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
	//Número de página
    $regionsession = $_SESSION["region"];
	$this->Cell(35,5,'Registro: SEGFAC ',1,0,'C');
	$this->Cell(80,5,'Sistema de Seguimiento de Garantias - '.$regionsession,1,0,'C');
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




  $sql3="update dpp_boletasg set boleg_sw=1 where boleg_id=$guia";
  mysql_query($sql3);


  $sql3="Select * from dpp_boletasg  where boleg_id=$guia";
  $res3 = mysql_query($sql3);
  $row3 = mysql_fetch_array($res3);


$destinatario=$row3["eta_destinatario"];
$fecha=$row3["eta_fechaguia"];
$dia=substr($row3["boleg_fecha_ing"],8,2);
$mes=substr($row3["boleg_fecha_ing"],5,2);
$anno=substr($row3["boleg_fecha_ing"],0,4);
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
    $pdf->Cell(40,35,"Origen ");
    $pdf->Cell(2,35,":");
    $pdf->Cell(45,35,"Oficina de Partes - $nombreregion");
    $pdf->Ln(5);
    $pdf->Cell(40,35,"Destinatario ");
    $pdf->Cell(2,35,":");
//    $pdf->Cell(45,35,$destinatario);
    $pdf->Cell(45,35,"OFICINA DE TESORERIA");
    $pdf->Ln(5);
    $pdf->Cell(40,35,"Fecha");
    $pdf->Cell(2,35,":");
    $pdf->Cell(45,35,$dia."/".$mes."/".$anno);



    $pdf->Ln(25);
    $pdf->Cell(15,4,"Item",1,0,'C');
    $pdf->Cell(140,4,"Detalle",1,0,'C');
    
  $sql31="Select * from dpp_boletasg  where boleg_id=$guia";
  $res31 = mysql_query($sql31);
  $cont=1;
  while ($row31 = mysql_fetch_array($res31)) {
    $pdf->Ln(4);
    $pdf->Cell(15,56,$cont,1,0,'C');
    $pdf->Cell(40,4,"FOLIO",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["boleg_folio"],1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"FECHA RECEPCION",1,0,'L',false);
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,substr($row31["boleg_fecha_recep"],8,2)."-".substr($row31["boleg_fecha_recep"],5,2)."-".substr($row31["boleg_fecha_recep"],0,4),1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"HORA RECEPCION",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["boleg_hora_recep"],1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"TIPO GARANTIA",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["boleg_tipo"],1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"NOMBRE EMPRESA",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,trim($row31["boleg_nombre"]),1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"NUMERO O SERIE",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["boleg_numero"],1,0,'L');
    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"MONTO",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,$row31["boleg_monto"],1,0,'L');

    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"RUT EMPRESA",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,number_format($row31["boleg_rut"],0,".",".")."-".$row31["boleg_dig"],1,0,'L');

    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"BANCO",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,strtoupper($row31["boleg_emisora"]),1,0,'L');

    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"TIPO MONEDA",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,strtoupper($row31["boleg_tipomoneda"]),1,0,'L');

    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"ID LICITACIÓN",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,strtoupper($row31["boleg_idlicitacion"]),1,0,'L');

    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"TIPO DOCUMENTO",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,strtoupper($row31["boleg_tipo2"]),1,0,'L');

    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"FECHA EMISION",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,strtoupper($row31["boleg_fecha_emision"]),1,0,'L');

    $pdf->Ln(4);
    $pdf->Cell(15,4,"",0,0,'C');
    $pdf->Cell(40,4,"FECHA VENCIMIENTO",1,0,'L');
    $pdf->Cell(2,4,":",1,0,'C');
    $pdf->Cell(98,4,strtoupper($row31["boleg_fecha_vence"]),1,0,'L');


    $cont++;
}



$pdf->Ln(5);
$pdf->Cell(75,30,"Saluda atentamente a usted,",0,0,'C');

    $pdf->Ln(25);
    $pdf->Cell(70);
    $pdf->Cell(90,50,"__________________________________",0,0,'C');
    $pdf->Ln(5);
    $pdf->Cell(80);
    $pdf->Cell(-20,50,"FIRMA DE OFICINA DE PARTES ".$nombreregion);

       $pdf->Ln(20);
    $pdf->Cell(85);
    $pdf->Cell(-20,50,"RECEPCIÓN CONFORME ".$nombreregion);

    $pdf->Ln(20);
    $pdf->Cell(70);
    $pdf->Cell(90,50,"__________________________________",0,0,'C');
    $pdf->Ln(5);
    $pdf->Cell(80);
    $pdf->Cell(-20,50,"FIRMA OFICINA DE TESORERIA ".$nombreregion);




$pdf->Output();

?> 
