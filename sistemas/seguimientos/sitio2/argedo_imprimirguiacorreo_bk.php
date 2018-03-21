<?php
session_start();
require("inc/config.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$guia=$_GET["guia"];
$sw=$_GET["sw"];
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
	$this->Image('logo_pbre2.jpg',10,8,63);
	//Arial bold 10
	$this->SetFont('Arial','B',10);
	//Movernos a la derecha
 //
	$this->Cell(90);
	//Título
	$this->MultiCell(65,5,"GUÍA DE ENTREGA ARGEDO 2.0 CORREO",0,'C');
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
	$this->Cell(35,5,'Registro: ARGEDO 2.0 ',1,0,'C');
	$this->Cell(80,5, ' '.$nombreregion,1,0,'C');
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







  $sql3="select * from argedo_correo where corre_region='$regionsession' and corre_folioguia=$guia group by corre_folioguia order by corre_folioguia desc";
  $res3 = mysql_query($sql3);
  $row3 = mysql_fetch_array($res3);


$destinatario=$row3["corre_destinatario"];
$fecha=$row3["corre_fechaguia"];
$dia=substr($row3["corre_fechaguia"],8,2);
$mes=substr($row3["corre_fechaguia"],5,2);
$anno=substr($row3["corre_fechaguia"],0,4);
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

    $pdf->Ln(4);
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
    
  $sql31="select * from argedo_correo where corre_region='$regionsession' and corre_folioguia=$guia order by corre_folioguia desc";
  $res31 = mysql_query($sql31);
  $cont=1;
$x=30;
  $y=63;
  $x1=85;
  $y1=75;
  $suma=28;
  $total = 0;
 $pdf->Ln(4);
  while ($row31 = mysql_fetch_array($res31)) {
    $total += $row31["corre_total"];
      $vartipodoc1=$row31["corre_tipo"];
      $cantidad=strlen($row31["corre_materia"]);
      $materia=$row31["reci_materia"];
      $cantidad2=250-$cantidad;
      if ($cantidad2<=245){
         $cuenta=1;
         while ($cuenta<=$cantidad2) {
            $materia.=" ";
            $cuenta++;
         }
      }
      
      $cantidad=strlen($materia);



//     $pdf->SetXY($x,$y);


     $pdf->SetFont('Arial','B',8);
     $pdf->Cell(15,20,$cont,1,0,'C');
     $pdf->Cell(40,4,"FOLIO ",1,0,'L');
     $pdf->Cell(2,4,":",1,0,'C');
     $pdf->MultiCell(98,4,$row31["corre_folioguia"],1,'L');
     
     $pdf->Cell(15,4,"",0,0,'C');
     $pdf->Cell(40,4,"FECHA DOCTO.",1,0,'L',false);
     $pdf->Cell(2,4,":",1,0,'C');
     $pdf->MultiCell(98,4,substr($row31["corre_fecha"],8,2)."-".substr($row31["corre_fecha"],5,2)."-".substr($row31["corre_fecha"],0,4),1,'L');

     $pdf->Cell(15,4,"",0,0,'C');
     $pdf->Cell(40,4,"CANTIDAD",1,0,'L');
     $pdf->Cell(2,4,":",1,0,'C');
     $pdf->MultiCell(98,4,$row31["corre_cantidad"],1,'L');

     $pdf->Cell(15,4,"",0,0,'C');
     $pdf->Cell(40,4,"PRECIO",1,0,'L');
     $pdf->Cell(2,4,":",1,0,'C');
     $pdf->MultiCell(98,4,$row31["corre_precio"],1,'L');

     $pdf->Cell(15,4,"",0,0,'C');
     $pdf->Cell(40,4,"TOTAL",1,0,'L');
     $pdf->Cell(2,4,":",1,0,'C');
     $pdf->MultiCell(98,4,$row31["corre_total"],1,'L');
     $pdf->Ln(2);


//     $pdf->Ln($salto2);
//     $pdf->Ln(1);

      $cont++;
     $y=$y+28;
     
     if ($cont==8)
       $y=363;
}
$pdf->Cell(15,4,"",0,0,'C');
     $pdf->Cell(40,4,"TOTAL A PAGAR",1,0,'L');
     $pdf->Cell(2,4,":",1,0,'C');
$pdf->MultiCell(98,4,"$".number_format($total,0,".","."),1,'L');




    $pdf->Ln(25);
    $pdf->Cell(70);
    $pdf->Cell(45,30,"V°B° Recibí Conforme",0,0,'C');
    $pdf->Ln(5);
    $pdf->Cell(80);
    $pdf->Cell(45,30,"(".$date_in.")");






$pdf->Output();

?> 
