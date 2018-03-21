<?php 

session_start();

require("inc/config.php");

require_once('TCPDF-master/tcpdf.php');

$guia=$_GET["guia"];

$regionsession = $_SESSION["region"];

$sql2 = "Select * from regiones where codigo=$regionsession";

    //echo $sql;

$res2 = mysql_query($sql2);

$row2 = mysql_fetch_array($res2);

$nombreregion=$row2["nombre"];

$anno=$_GET["anno"];



$sql3="select * from dpp_etapas where eta_region='$regionsession'and year(eta_fecha_ing)='$anno' and eta_folioguia3=$guia group by eta_folioguia3 order by eta_folio desc";



$res3 = mysql_query($sql3);

$row3 = mysql_fetch_array($res3);





$destinatario=$row3["eta_destinatario3"];

$fecha=$row3["eta_fechaguia"];

$dia=substr($row3["eta_fechaguia2"],8,2);

$mes=substr($row3["eta_fechaguia2"],5,2);

$anno=substr($row3["eta_fechaguia2"],0,4);





$sql31="select * from dpp_etapas where eta_region='$regionsession' and year(eta_fecha_ing)='$anno' and eta_folioguia3=$guia order by eta_folio desc";

$res31 = mysql_query($sql31);

$cont=1;



// create new PDF document

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information

$pdf->SetCreator(PDF_CREATOR);

$pdf->SetAuthor('SIGEJUN');

$pdf->SetTitle('GUIA DE DESPACHO INTERNA - CORREO');

$pdf->SetSubject('GUIA DE DESPACHO INTERNA - CORREO');

$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



// set default header data

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);



// set header and footer fonts

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));



// set default monospaced font

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



// set margins

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);



// set auto page breaks

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);



// set image scale factor

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// set some language-dependent strings (optional)

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

  require_once(dirname(__FILE__).'/lang/eng.php');

  $pdf->setLanguageArray($l);

}

$pdf->SetPrintHeader(false);

// ---------------------------------------------------------



// set font

$pdf->SetFont('dejavusans', '', 8);



// add a page

$pdf->AddPage();

$pdf->Ln(-20);













$html.='

<table border="0" width="100%">



  <tr>

    <td colspan="3"><img src="images/junji_logo.png" style="width:130px;"></td>

  </tr>



  <tr>

    <td width="15%"></td>

    <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">GUIA DE DESPACHO INTERNO</td>

    <td width="15%"></td>

  </tr>



  <tr>

    <td width="15%"></td>

    <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">DOCUMENTO VALORADO</td>

    <td width="15%"></td>

  </tr>



  <tr>

    <td width="15%"></td>

    <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">N&deg; '.$_GET["guia"].'</td>

    <td width="15%"></td>

  </tr>



</table>

<br><br>

<br><br>

<table border="1" width="100%" align="center" cellpadding="5">

  <tr>

    <td>ORIGEN</td>

    <td>CONTABILIDAD '.utf8_encode($nombreregion).'</td>

  </tr>



  <tr>

    <td>DESTINATARIO</td>

    <td>'.utf8_encode($destinatario).'</td>

  </tr>





  <tr>

    <td>FECHA</td>

    <td>'.$dia.' - '.$mes.' - '.$anno.'</td>

  </tr>



</table>

<br><br>

<br><br>

<table border="1" width="100%" align="center" cellpadding="5">

  <tr>

    <td style="font-size:8px;">&Iacute;TEM</td>

    <td style="font-size:8px;">FOLIO</td>

    <td style="font-size:8px;">FECHA PMG</td>

    <td style="font-size:8px;">TIPO DE DOCUMENTO</td>

    <td style="font-size:8px;">N&deg; DOCUMENTO</td>

    <td style="font-size:8px;">MONTO</td>

    <td style="font-size:8px;">RAZÓN SOCIAL PROVEEDOR</td>

    <td style="font-size:8px;">RUT PROVEEDOR</td>

  </tr>

  ';



while($row = mysql_fetch_array($res31))

{



  $vartipodoc1=$row["eta_tipo_doc"];

 if ($vartipodoc1=='Factura') {

     $vartipodoc2=$row["eta_tipo_doc2"];

     if($vartipodoc2=="FEL")
      $vartipodoc="Factura Electronica";
    if($vartipodoc2=="FELEX")
      $vartipodoc="Factura Exenta Electronica";

   if ($vartipodoc2=="f")

     $vartipodoc="Factura";

   if ($vartipodoc2=="b")

     $vartipodoc="Boleta Servicio";

   if ($vartipodoc2=="r")

     $vartipodoc="Recibo";

   if ($vartipodoc2=="n")

     $vartipodoc="N.Credito";

   if ($vartipodoc2=="d")

     $vartipodoc="N.Debito";

   if ($vartipodoc2=="bh" or $vartipodoc2=="BH")

     $vartipodoc="Honorario";



 }



 if ($vartipodoc1=='Honorario') {

     $vartipodoc="Honorario";

 }



  $html.='

  <tr>

    <td>'.$cont.'</td>

    <td>'.$row["eta_folio"].'</td>

    <td>'.Date("d-m-Y").'</td>

    <td>'.$vartipodoc.'</td>

    <td>'.$row["eta_numero"].'</td>

    <td>$'.number_format($row["eta_monto"],0,".",".").'</td>

    <td>'.utf8_encode($row["eta_cli_nombre"]).'</td>

    <td>'.$row["eta_rut"]."-".$row["eta_dig"].'</td>

  </tr>

  ';

  $cont++;

}



$html.='



</table>



<br><br><br><br>

<br><br><br><br>

<br><br><br><br>



<table border="1" width="60%" align="center">

<tr>



  <td colspan="2" style="font-size:15px;" align="center" height="24px">Recib&iacute; Conforme</td>

</tr>

<tr>

  <td style="font-size:14px;" height="22px">Nombre:</td>

  <td></td>

</tr>

<tr>

  <td style="font-size:14px;" height="22px">Fecha:</td>

  <td style="font-size:15px;">'.Date("d-m-Y").'</td>

</tr>

<tr>

  <td style="font-size:14px;"  height="100px"><br><br><br>Firma:</td>

  <td></td>

</tr>

</table>

';





// output the HTML content

  $pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page

  $pdf->lastPage();

// ---------------------------------------------------------



//Close and output PDF document

  $pdf->Output('doc.pdf', 'I');



//============================================================+

// END OF FILE

//============================================================+

  ?>