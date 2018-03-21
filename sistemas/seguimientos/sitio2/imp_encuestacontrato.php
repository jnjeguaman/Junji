<?php
session_start();
require("inc/config.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$guia=$_GET["guia"];
$id=$_GET["id2"];
$id3=$_GET["id3"];
$id4=$_GET["id4"];

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
	$this->MultiCell(65,5,"",0,'C');
   	$this->Cell(100);
    $this->Cell(20,10,"");
    $this->Cell(20,10,"",0);
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
	$this->Cell(35,5,'Registro: SEGC ',1,0,'C');
	$this->Cell(80,5,'Sistema de Gestion de Contratos -'.$regionsession,1,0,'C');
    $this->Cell(30,5,'Pagina '.$this->PageNo().' de {nb}',1,0,'C');
  }
}

$pdf=new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);
$pdf->SetMargins(30, 25 , 30);
$pdf->SetAutoPageBreak(true,25);
//for($i=1;$i<=40;$i++)
//	$pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
//$pdf->Output();







//  $sql3="select * from dpp_cont_evaext where contevaext_cont_id=$id and contevaext_encu_id=$id3";
  $sql3="select * from dpp_contratos where cont_id=$id";
  $res3 = mysql_query($sql3);
  $row3 = mysql_fetch_array($res3);


$destinatario=$row3["eta_destinatario2"];
$fecha=$row3["eta_fechaguia"];
$dia=substr($row3["eta_fechaguia2"],8,2);
$mes=substr($row3["eta_fechaguia2"],5,2);
$anno=substr($row3["eta_fechaguia2"],0,4);
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
$empresa=$row3["cont_nombre"];
$rut=$row3["cont_rut"];
$servicio=$row3["cont_nombre1"];
    $pdf->Ln(1);
    $pdf->Cell(40,30,"Defensoría");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,"$nombreregion");
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Tipo de Encuesta  ");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30," Externa");
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Empresa");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$empresa);
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Rut");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$rut);
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Servicio");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$servicio);



    $pdf->Ln(10);

//  $sql31="select * from dpp_etapas where eta_region='$regionsession' and eta_folioguia2=$guia order by eta_folio desc";
  $sql31="select * from dpp_cont_evaext where contevaext_cont_id=$id and contevaext_encu_id=$id3";

  $res31 = mysql_query($sql31);
  $cont=1;
  
  while ($row31 = mysql_fetch_array($res31)) {

    $pdf->Ln(4);
    $pdf->Cell(15,28,"Pregunta ".$cont,0,0,'C');
    $pdf->Cell(15,28,$row31["contevaext_nombre"],0,0,'L');

    $id31=$row31["contevaext_id"];
    $sql32 = "select * from dpp_contevaext_item  where contevaexti_contevaext_id =$id31";
    $res32 = mysql_query($sql32);
    $cont2=1;
    while ($row32 = mysql_fetch_array($res32)) {
      $pdf->Ln(4);
      $pdf->Cell(15,28,"(".$cont2.")",0,0,'C');
      $pdf->Cell(90,28,$row32["contevaexti_nombre"],0,0,'L');

      $cont2++;

    }
    
    
    $cont++;

}
    



$pdf->AddPage();
$pdf->SetFont('Arial','',7);
$pdf->SetMargins(30, 25 , 30);
$pdf->SetAutoPageBreak(true,25);
//for($i=1;$i<=40;$i++)
//	$pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
//$pdf->Output();







  $sql3="select * from dpp_cont_evaext where contevaext_cont_id=$id and contevaext_encu_id=$id3";


  $res3 = mysql_query($sql3);
  $row3 = mysql_fetch_array($res3);


$destinatario=$row3["eta_destinatario2"];
$fecha=$row3["eta_fechaguia"];
$dia=substr($row3["eta_fechaguia2"],8,2);
$mes=substr($row3["eta_fechaguia2"],5,2);
$anno=substr($row3["eta_fechaguia2"],0,4);
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
    $pdf->Cell(40,30,"Defensoría");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,"$nombreregion");
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Tipo de Encuesta  ");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30," Interna");
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Empresa");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$empresa);
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Rut");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$rut);
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Servicio");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$servicio);


    $pdf->Ln(10);

//  $sql31="select * from dpp_etapas where eta_region='$regionsession' and eta_folioguia2=$guia order by eta_folio desc";
//  $sql31="select * from dpp_cont_evaint where contevaint_cont_id=$id and contevaint_encu_id=$id3";
  $sql31="select * from dpp_cont_evaint where contevaint_cont_id=$id order by contevaint_nombre ";
  $res31 = mysql_query($sql31);
  $cont=1;

  while ($row31 = mysql_fetch_array($res31)) {

    $pdf->Ln(4);
    $pdf->Cell(15,28,"Pregunta ".$cont,0,0,'C');
    $pdf->Cell(15,28,$row31["contevaint_nombre"],0,0,'L');

    $id31=$row31["contevaint_id"];
    $sql32 = "select * from dpp_contevaint_item  where contevainti_contevaint_id =$id31";
    $res32 = mysql_query($sql32);
    $cont2=1;
    while ($row32 = mysql_fetch_array($res32)) {
      $pdf->Ln(4);
      $pdf->Cell(15,28,"(".$cont2.")",0,0,'C');
      $pdf->Cell(90,28,$row32["contevainti_nombre"],0,0,'L');
      $cont2++;

    }


    $cont++;

}



$pdf->AddPage();
$pdf->SetFont('Arial','',7);
$pdf->SetMargins(30, 25 , 30);
$pdf->SetAutoPageBreak(true,25);
//for($i=1;$i<=40;$i++)
//	$pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
//$pdf->Output();







  $sql3="select * from dpp_cont_evausu where contevausu_cont_id=$id and contevausu_encu_id=$id3";

  $res3 = mysql_query($sql3);
  $row3 = mysql_fetch_array($res3);


$destinatario=$row3["eta_destinatario2"];
$fecha=$row3["eta_fechaguia"];
$dia=substr($row3["eta_fechaguia2"],8,2);
$mes=substr($row3["eta_fechaguia2"],5,2);
$anno=substr($row3["eta_fechaguia2"],0,4);
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
    $pdf->Cell(40,30,"Defensoría");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,"$nombreregion");
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Tipo de Encuesta  ");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30," Usuario");
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Empresa");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$empresa);
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Rut");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$rut);
    $pdf->Ln(5);
    $pdf->Cell(40,30,"Servicio");
    $pdf->Cell(2,30,":");
    $pdf->Cell(45,30,$servicio);


    $pdf->Ln(10);

//  $sql31="select * from dpp_etapas where eta_region='$regionsession' and eta_folioguia2=$guia order by eta_folio desc";
  $sql31="select * from dpp_cont_evausu where contevausu_cont_id=$id and contevausu_encu_id=$id3";

  $res31 = mysql_query($sql31);
  $cont=1;

  while ($row31 = mysql_fetch_array($res31)) {

    $pdf->Ln(4);
    $pdf->Cell(15,28,"Pregunta ".$cont,0,0,'C');
    $pdf->Cell(15,28,$row31["contevausu_nombre"],0,0,'L');

    $id31=$row31["contevausu_id"];
    $sql32 = "select * from dpp_contevausu_item  where contevausui_contevausu_id =$id31";
    $res32 = mysql_query($sql32);
    $cont2=1;
    while ($row32 = mysql_fetch_array($res32)) {
      $pdf->Ln(4);
      $pdf->Cell(15,28,"(".$cont2.")",0,0,'C');
      $pdf->Cell(90,28,$row32["contevausui_nombre"],0,0,'L');

      $cont2++;

    }


    $cont++;

}













$pdf->Output();

?> 
