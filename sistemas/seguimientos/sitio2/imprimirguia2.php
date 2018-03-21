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



$sql3="select * from dpp_etapas where eta_region='$regionsession'and year(eta_fechaguia2)='$anno' and eta_folioguia2=$guia group by eta_folioguia2 order by eta_folio desc";



$res3 = mysql_query($sql3);

$row3 = mysql_fetch_array($res3);





$destinatario=$row3["eta_destinatario2"];

$fecha=$row3["eta_fechaguia"];

$dia=substr($row3["eta_fechaguia2"],8,2);

$mes=substr($row3["eta_fechaguia2"],5,2);

$anno=substr($row3["eta_fechaguia2"],0,4);





// $sql31="select * from dpp_etapas where eta_region='$regionsession' and year(eta_fecha_ing)='$anno' and eta_folioguia2=$guia order by eta_folio desc";
// $sql31="select * from dpp_etapas where eta_region='$regionsession' and eta_fechaguia2 = '".$row3["eta_fechaguia2"]."' and eta_folioguia2=$guia order by eta_folio desc";
$sql31="select * from dpp_etapas where eta_region='$regionsession' and year(eta_fechaguia2)='$anno' and eta_folioguia2=$guia order by eta_folio desc";

$res31 = mysql_query($sql31);

$cont=1;



// create new PDF document

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information

$pdf->SetCreator(PDF_CREATOR);

$pdf->SetAuthor('SIGEJUN');

$pdf->SetTitle('GUIA DE ENVIO - CONTABILIDAD');

$pdf->SetSubject('GUIA DE ENVIO - CONTABILIDAD');

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
    <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">GU&Iacute;A DE ENV&Iacute;O</td>
    <td width="15%"></td>
  </tr>

  <tr>
    <td width="15%"></td>
    <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">SET DE PAGOS</td>
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
    <td>SEGUIMIENTO Y CONTROL '.utf8_encode($nombreregion).'</td>
  </tr>

  <tr>
    <td>DESTINATARIO</td>
    <td>'.utf8_encode($destinatario).'</td>
  </tr>




</table>

<br><br>

<br><br>

<table border="1" width="100%" align="center" cellpadding="5">

  <tr>
    <td style="font-size:0.5em;" width="8%">&Iacute;TEM</td>
    <td style="font-size:0.5em;" width="8%">FOLIO</td>
    <td style="font-size:0.5em;">N&deg; DOCUMENTO</td>
    <td style="font-size:0.5em;">D&Iacute;AS TRANSCURRIDOS</td>
    <td style="font-size:0.5em;">TIPO DOCUMENTO</td>
    <td style="font-size:0.5em;" width="12%">MONTO DOCUMENTO</td>
    <td style="font-size:0.5em;">RAZ&Oacute;N SOCIAL PROVEEDOR</td>
    <td style="font-size:0.5em;">RUT PROVEEDOR</td>
    <td style="font-size:0.5em;">ORDEN DE COMPRA</td>
    <td style="font-size:0.5em;width:120px;">ADJUNTOS</td>
  </tr>
  ';

while($row = mysql_fetch_array($res31))
{

  $sql4 = "SELECT * FROM compra_orden WHERE oc_numero = '".$row["eta_nroorden"]."'";
  $res4 = mysql_query($sql4);
  $row4 = mysql_fetch_array($res4);
  $vartipodoc1=$row["eta_tipo_doc"];

 if ($vartipodoc1=='Factura') {

     $vartipodoc2=$row["eta_tipo_doc2"];

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

$dia1=substr($row["eta_fechaguia2"],8,2);

$mes1=substr($row["eta_fechaguia2"],5,2);

$anno1=substr($row["eta_fechaguia2"],0,4);


$dia2=substr($row["eta_fecha_recepcion"],8,2);

$mes2=substr($row["eta_fecha_recepcion"],5,2);

$anno2=substr($row["eta_fecha_recepcion"],0,4);



$fecha_inicio=$row["eta_fecha_recepcion"];
$fecha_final=Date("Y-m-d");


$dias_transcurridos = dias_transcurridos($fecha_inicio,$fecha_final);


  $html.='

  <tr>
    <td style="font-size:0.5em;">'.$cont.'</td>
    <td style="font-size:0.5em;">'.$row["eta_folio"].'</td>
    <td style="font-size:0.5em;">'.$row["eta_numero"].'</td>
    <td style="font-size:0.5em;">'.$dias_transcurridos.'</td>
    <td style="font-size:0.5em;">'.$vartipodoc.'</td>
    <td style="font-size:0.5em;">$'.number_format($row["eta_monto"],0,".",".").'</td>
    <td style="font-size:0.5em;">'.utf8_encode($row["eta_cli_nombre"]).'</td>
    <td style="font-size:0.5em;">'.number_format($row["eta_rut"],0,".",".")."-".$row["eta_dig"].'</td>
    <td style="font-size:0.5em;">'.utf8_encode($row["eta_nroorden"]).'</td>
    <td style="font-size:0.5em;width:120px;height: 60px;"></td>
  </tr>

  ';

  $cont++;

}



$html.='



</table>

<br><br><br><br>

<table border="0" width="100%">

    <tr>
    <td width="28%"></td>
      <td width="42%">

        <table border="0" width="260px" style="border:1px solid #454545;">

          <tr>

            <td height="3px"></td>

          </tr>
          <tr>

            <td align="center"><img src="images/timbre_syc.png" style="width:180px;"></td>

          </tr>

          <tr>

            <td align="center" height="20px" style="color: #646464; font-size:12px;">Enviado conforme el '.$dia.'-'.$mes.'-'.$anno.' </td>

          </tr>

        </table>

      </td>
      <td width="30%"></td>
    </tr>

</table>

';



function dias_transcurridos($fecha_i,$fecha_f)
{
  $dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
  $dias   = abs($dias); $dias = floor($dias);   
  return $dias;
}

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