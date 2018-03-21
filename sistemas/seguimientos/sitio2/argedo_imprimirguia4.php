<?php
session_start();
require("inc/config.php");
require_once('TCPDF-master/tcpdf.php');
$guia=$_GET["guia"];
$regionsession = $_SESSION["region"];


$sql2="SELECT * FROM argedo_doc_internos WHERE inte_region='$regionsession' AND inte_numguia=$guia AND inte_estado='2' GROUP BY inte_numguia ORDER BY inte_numguia DESC";
//echo $sql2;
$result2=mysql_query($sql2);
$row2=mysql_fetch_array($result2);

$destinatario2=$row2["inte_destinatario2"];
$fechaguia=$row2["inte_fechaguia"];
$region=$row2["inte_region"];
$otransporte=$row2["inte_ord_transporte"];
$observacion=$row2["inte_observacion"];

//region destino
$sql22="SELECT * FROM regiones WHERE orden='$destinatario2'";
$result22=mysql_query($sql22);
$row22=mysql_fetch_array($result22);
$ordenregion =$row22["orden"];
$nombreregion =$row22["nombre"];

//region origen
$sql23="SELECT * FROM regiones WHERE orden='$regionsession'";
$result23=mysql_query($sql23);
$row23=mysql_fetch_array($result23);
$nombreregion2 =$row23["nombre"];
$fechaguia=substr($fechaguia,8,2)."-".substr($fechaguia,5,2)."-".substr($fechaguia,0,4);

$dia=substr($row2["inte_fechaguia"],8,2);
$mes=substr($row2["inte_fechaguia"],5,2);
$anno=substr($row2["inte_fechaguia"],0,4);

$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SIGEJUN');
$pdf->SetTitle('GUIA DE DESPACHO - CARTOLA DE CORRESPONDENCIA');
$pdf->SetSubject('GUIA DE DESPACHO - CARTOLA DE CORRESPONDENCIA');
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
$pdf->Ln(-22);

// ENCABEZADO
$html.='

<table border="0" width="100%">

  <tr>
  <td width="20%"><img src="images/junji_logo.png" style="width:130px;"></td>

    <td width="60%">
    <br>
     <br>
     <br>
     <br>  
      <table border="0" width="100%">

        <tr>
          <td width="15%"></td>
          <td width="70%" align="center" style="font-size:1.5em;text-decoracion:underline;"> '.utf8_encode($nombreregion).' </td>
          <td width="15%"></td>
        </tr>
        <tr>
          <td width="15%"></td>
          <td width="70%" align="center" style="font-size:1.1em;text-decoracion:underline;"> CARTOLA DE DESPACHO REGIONAL</td>
          <td width="15%"></td>
        </tr>

        <tr>
          <td width="15%"></td>
          <td width="70%" align="center" style="font-size:1.3em;text-decoracion:underline;">GU&Iacute;A N&deg; '.$_GET["guia"].'</td>
          <td width="15%"></td>
        </tr>
      </table>
    </td>

    <td width="20%"></td>
  </tr>

  

</table>';


// FECHA, ORDEN DE TRANSPORTE, REGION DE ORIGEN
$html.='
<br><br>
<table border="0" width="100%">

  <tr>
    <td width="25%" style="font-size:1.3em;">FECHA: '.$dia.' - '.$mes.' - '.$anno.'</td>
    <td width="50%" style="font-size:0.8em;"> </td>
    <td width="25%" style="font-size:1.3em;">O. T N&deg; '.utf8_encode($otransporte).'</td>
  </tr>  
  <tr>
    <td></td>
    <td><br></td>
    <td></td>
  </tr>  
  <tr>
    <td style="font-size:1.3em;">REGI&Oacute;N DE ORIGEN: </td>
    <td colspan="2" style="font-size:1.0em;">'.utf8_encode($nombreregion2).'</td>
  </tr>

</table>

';

// DETALLE
$html.='

<table border="0" width="100%">

  <tr><td width="20%"></td><td width="80%"></td></tr>

  <tr><td></td><td></td></tr>
  ';



  $sql3a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Resolucion Exenta' AND inte_region='$region' AND inte_estado='2' ";
  $res3a=mysql_query($sql3a);

  if (mysql_num_rows($res3a)>0) {

    $sql3b="SELECT count(inte_id) AS contador FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Resolucion Exenta' AND inte_region='$region' AND inte_estado='2' ";
    $res3b=mysql_query($sql3b);
    $row3b = mysql_fetch_array($res3b);
    $cont1=$row3b['contador'];
    $cont2=1;

    $html.='
    <tr>
      <td style="font-size:1.3em;">RESOLUCION EX. :</td>
      <td style="font-size:1.2em;">';

        while ($row = mysql_fetch_array($res3a)) {
            $numdoc=$row['inte_num_doc'];
            $remite=$row['inte_remitente'];

            $html.=' N&deg;'.utf8_encode($numdoc).' <sup style="font-size:0.5em;">'.utf8_encode($remite).'</sup>';
              if($cont2<$cont1){
                $html.='<strong> - </strong>';
              }

            $cont2++;
        }

        $html.='
      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }




  $sql4a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Ordinario' AND inte_region='$region' AND inte_estado='2' ";
  $res4a=mysql_query($sql4a);

  if (mysql_num_rows($res4a)>0) {

    $sql4b="SELECT count(inte_id) AS contador FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Ordinario' AND inte_region='$region' AND inte_estado='2' ";
    $res4b=mysql_query($sql4b);
    $row4b = mysql_fetch_array($res4b);
    $cont1=$row4b['contador'];
    $cont2=1;

    $html.='
    <tr>
      <td style="font-size:1.3em;">ORDINARIOS:</td>
      <td style="font-size:1.2em;">';

        while ($row = mysql_fetch_array($res4a)) {
            $numdoc=$row['inte_num_doc'];
            $remite=$row['inte_remitente'];

            $html.=' N&deg;'.utf8_encode($numdoc).' <sup style="font-size:0.5em;">'.utf8_encode($remite).'</sup>';
              if($cont2<$cont1){
                $html.='<strong> - </strong>';
              }

            $cont2++;
        }

        $html.='
      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }



  $sql5a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Circular' AND inte_region='$region' AND inte_estado='2' ";
  $res5a=mysql_query($sql5a);

  if (mysql_num_rows($res5a)>0) {

    $sql5b="SELECT count(inte_id) AS contador FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Circular' AND inte_region='$region' AND inte_estado='2' ";
    $res5b=mysql_query($sql5b);
    $row5b = mysql_fetch_array($res5b);
    $cont1=$row5b['contador'];
    $cont2=1;

    $html.='
    <tr>
      <td style="font-size:1.3em;">CIRCULARES:</td>
      <td style="font-size:1.2em;">';

        while ($row = mysql_fetch_array($res5a)) {
            $numdoc=$row['inte_num_doc'];
            $remite=$row['inte_remitente'];

            $html.=' N&deg;'.utf8_encode($numdoc).' <sup style="font-size:0.5em;">'.utf8_encode($remite).'</sup>';
              if($cont2<$cont1){
                $html.='<strong> - </strong>';
              }

            $cont2++;
        }

        $html.='
      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }



  $sql7a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Res. Con Toma' AND inte_region='$region' AND inte_estado='2' ";
  $res7a=mysql_query($sql7a);

  if (mysql_num_rows($res7a)>0) {

    $sql7b="SELECT count(inte_id) AS contador FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Res. Con Toma' AND inte_region='$region' AND inte_estado='2' ";
    $res7b=mysql_query($sql7b);
    $row7b = mysql_fetch_array($res7b);
    $cont1=$row7b['contador'];
    $cont2=1;

    $html.='
    <tr>
      <td style="font-size:1.3em;">RES. CON TOMA:</td>
      <td style="font-size:1.2em;">';

        while ($row = mysql_fetch_array($res7a)) {
            $numdoc=$row['inte_num_doc'];
            $remite=$row['inte_remitente'];

            $html.=' N&deg;'.utf8_encode($numdoc).' <sup style="font-size:0.5em;">'.utf8_encode($remite).'</sup>';
              if($cont2<$cont1){
                $html.='<strong> - </strong>';
              }

            $cont2++;
        }

        $html.='
      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }



  $sql8a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='memorandum' AND inte_region='$region' AND inte_estado='2' ";
  $res8a=mysql_query($sql8a);

  if (mysql_num_rows($res8a)>0) {



    $sql8b="SELECT count(inte_id) AS contador FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='memorandum' AND inte_region='$region' AND inte_estado='2' ";
    $res8b=mysql_query($sql8b);
    $row8b = mysql_fetch_array($res8b);
    $cont1=$row8b['contador'];
    $cont2=1;



    $html.='
    <tr>
      <td style="font-size:1.3em;">MEMOR&Aacute;NDUM:</td>
      <td style="font-size:1.2em;">';

        while ($row = mysql_fetch_array($res8a)) {
            $numdoc=$row['inte_num_doc'];
            $remite=$row['inte_remitente'];

            $html.=' N&deg;'.utf8_encode($numdoc).' <sup style="font-size:0.5em;">'.utf8_encode($remite).'</sup>';
              if($cont2<$cont1){
                $html.='<strong> - </strong>';
              }

            $cont2++;
        }

        $html.='
      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }



  $sql9a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='reservado' AND inte_region='$region' AND inte_estado='2' ";
  $res9a=mysql_query($sql9a);

  if (mysql_num_rows($res9a)>0) {

    $sql9b="SELECT count(inte_id) AS contador FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='reservado' AND inte_region='$region' AND inte_estado='2' ";
    $res9b=mysql_query($sql9b);
    $row9b = mysql_fetch_array($res9b);
    $cont1=$row9b['contador'];
    $cont2=1;

    $html.='
    <tr>
      <td style="font-size:1.3em;">RESERVADOS:</td>
      <td style="font-size:1.2em;">';

        while ($row = mysql_fetch_array($res9a)) {
            $numdoc=$row['inte_num_doc'];
            $remite=$row['inte_remitente'];

            $html.=' N&deg;'.utf8_encode($numdoc).' <sup style="font-size:0.5em;">'.utf8_encode($remite).'</sup>';
              if($cont2<$cont1){
                $html.='<strong> - </strong>';
              }

            $cont2++;
        }

        $html.='
      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }



  $sql11a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Cartola' AND inte_region='$region' AND inte_estado='2' ";
  $res11a=mysql_query($sql11a);

  if (mysql_num_rows($res11a)>0) {

    $sql11b="SELECT count(inte_id) AS contador FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Otro' AND inte_region='$region' AND inte_estado='2' ";
    $res11b=mysql_query($sql11b);
    $row11b = mysql_fetch_array($res11b);
    $cont1=$row11b['contador'];
    $cont2=1;

    $html.='
    <tr>
      <td style="font-size:1.3em;">CARTOLA:</td>
      <td style="font-size:1.2em;">';

        while ($row = mysql_fetch_array($res11a)) {
            $numdoc=$row['inte_num_doc'];
            $remite=$row['inte_remitente'];

            $html.=' N&deg;'.utf8_encode($numdoc).' <sup style="font-size:0.5em;">'.utf8_encode($remite).'</sup>';
              if($cont2<$cont1){
                $html.='<strong> - </strong>';
              }

            $cont2++;
                  
        }

      $html.='


      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }



  $sql12a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Otro' AND inte_region='$region' AND inte_estado='2' ";
  $res12a=mysql_query($sql12a);

  if (mysql_num_rows($res12a)>0) {

    $sql12b="SELECT count(inte_id) AS contador FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Otro' AND inte_region='$region' AND inte_estado='2' ";
    $res12b=mysql_query($sql12b);
    $row12b = mysql_fetch_array($res12b);
    $cont1=$row12b['contador'];
    $cont2=1;

    $html.='
    <tr>
      <td style="font-size:1.3em;">OTRO:</td>
      <td style="font-size:1.2em;">';

        while ($row = mysql_fetch_array($res12a)) {
            $numdoc=$row['inte_num_doc'];
            $remite=$row['inte_remitente'];

            $html.=' N&deg;'.utf8_encode($numdoc).' <sup style="font-size:0.5em;">'.utf8_encode($remite).'</sup>';
              if($cont2<$cont1){
                $html.='<strong> - </strong>';
              }

            $cont2++;
        }

        $html.='
      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }



  $sql10a="SELECT * FROM argedo_doc_internos WHERE inte_numguia='$guia' AND inte_tipo_doc='Carta/Sobre' AND inte_region='$region' AND inte_estado='2' ";
  $res10a=mysql_query($sql10a);

  if (mysql_num_rows($res10a)>0) {

    $html.='
    <tr>
      <td style="font-size:1.3em;">CARTAS Y SOBRES:</td>
      <td>
        <table border="0" width="100%">
          
            ';

              while ($row = mysql_fetch_array($res10a)) {
                  $remitente=$row['inte_remitente'];
                  $destinatariob=$row['inte_destinatario'];

                  $html.='<tr> <td style="font-size:0.7em;"> DE: '.utf8_encode($remitente).' </td> <td style="font-size:0.7em;"> A: '.utf8_encode($destinatariob).'<br> </td> </tr>';
                  
              }

            $html.='
          
        </table>

      </td>

    </tr>

    <tr><td></td><td></td></tr>
    ';



  }




  $html.='

  <tr>

    <td style="font-size:1.3em;">OBSERVACIONES:</td>
    <td style="font-size:1.3em;">'.utf8_encode($observacion).'</td>

  </tr>

  <tr><td></td><td></td></tr>

</table>






  <br><br>
  <table border="0" width="100%">

    <tr>

      <td width="30%"></td>

      <td width="40%" align="center" height="200px">

        <table border="1" width="100%" align="center" cellpadding="5">

          <tr>

            <td colspan="2" style="font-size:1.2em;" align="center" height="24px">Recib&iacute; Conforme</td>

          </tr>

          <tr>

            <td style="font-size:1em;" height="22px">Nombre:</td>

            <td></td>

          </tr>

          <tr>

            <td style="font-size:1em;" height="22px">Fecha:</td>

            <td style="font-size:1em;">'.Date("d-m-Y").'</td>

          </tr>

          <tr>

            <td style="font-size:1em;"  height="60px"><br>Firma:</td>

            <td></td>

          </tr>

        </table>

      </td>

      <td width="30%"></td>

    </tr>

  </table>
  ';



// output the HTML content

  $pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page

  $pdf->lastPage();

// ---------------------------------------------------------



//Close and output PDF document

  $pdf->Output('CORRESPONDENCIA_EXPEDIENTE_'.$guia.'_'.$regionsession.'_'.$anno.'.pdf', 'I');



//============================================================+

// END OF FILE

//============================================================+
?>