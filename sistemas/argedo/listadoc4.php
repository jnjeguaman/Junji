<?
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reportes.xls");

include("conex.php");
$link=conectarse();
$op=$_GET["op"];
if ($op==2) {
    $titulo="Resoluciones & Oficios";
}
if ($op==3) {
    $titulo="Correspondencia Recibida";
}
if ($op==4) {
    $titulo="Correspondencia Despachada";
}

?>



<HTML dir=ltr xmlns:o = "urn:schemas-microsoft-com:office:office"><HEAD><TITLE><? echo $titulo ?></TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META http-equiv=Expires content=0>



      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=ms-sitetitle width="100%">
            <H4 class=ms-sitetitle><? echo $titulo ?></H4></TD>
          <TD style="PADDING-TOP: 8px" vAlign=top></TD></TR>
          </TBODY>
          </TABLE>

<?
$op=$_GET["op"];
$reg=$_GET["reg"];
$periodo=$_GET["periodo"];
$pagina=$_GET["pagina"];
if (isset($_GET["reg1"])) {
  $reg1=$_GET["reg"];
  $reg=$_GET["reg1"];
//  echo "entra 1";
} else {
//  echo "entra 2";
  $reg1=$_GET["reg1"];
  $reg=$_GET["reg"];
}
  
//echo $reg."---->".$reg1;
$clase1="";
$clase2="";
$clase3="";
$clase4="";
$clase5="";
if ($op==1) {
  $clase1="ms-topnavselected zz1_TopNavigationMenu_9";
}
if ($op==2) {
  $clase2="ms-topnavselected zz1_TopNavigationMenu_9";
}
if ($op==3) {
  $clase3="ms-topnavselected zz1_TopNavigationMenu_9";
}
if ($op==4) {
  $clase4="ms-topnavselected zz1_TopNavigationMenu_9";
}
if ($op==5) {
  $clase5="ms-topnavselected zz1_TopNavigationMenu_9";
}


 $sql="select * from regiones where codigo=$reg ";
// echo $sql;
 $result=mysql_query($sql,$link);
 $row=mysql_fetch_array($result);
 $nombre=$row["nombre"];


?>
                              <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <TR><TD>
                                <br>
                                </TD></TR>
                                <TR>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px">
                                <? echo $nombre ?>
                                </TD></TR>

                                
                               </table>

                                
<?

$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$numero=$_GET["numero"];
$materia=$_GET["materia"];
$folio=$_GET["folio"];
$adju=$_GET["adju"];
$tramite=$_GET["tramite"];
$destinatario=$_GET["destinatario"];
$tipodoc=$_GET["tipodoc"];
$remite=$_GET["remite"];
$tipodoc1=$_GET["tipodoc1"];
$tipodoc2=$_GET["tipodoc2"];

?>
                                
                          <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 TOPLEVEL>


<?
if ($op==2) {
    $pre="docs";
    $select=" docs_id, docs_archivo, docs_folio, docs_materia, docs_documento, docs_fecha, docs_anno, docs_destinatario, docs_area, docs_subarea, docs_defensoria, docs_tramite, docs_obs, docs_fechasis, docs_diferencia, docs_servidor, docs_tipo";
?>
                                 <tr>
                                <TD class=ms-vb2 width="20"><DIV>Numero Documento</DIV></a></TD>
                                <TD class=ms-vb2 width="70">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Materia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></TD>
                                <TD class=ms-vb2>Tipo Documento</TD>
                                <TD class=ms-vb2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Documento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2><DIV>Año&nbsp;</DIV></TD>
                                <TD class=ms-vb2><NOBR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destinatario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</NOBR></TD>
                                <TD class=ms-vb2><NOBR>Area</NOBR></TD>
                                <TD class=ms-vb2>Subareas</TD>
                                <TD class=ms-vb2>Defensoria</TD>
                                <TD class=ms-vb2><SPAN>En tramite</SPAN></TD>
                                <TD class=ms-vb2>Observaciones</TD>
                                <TD class=ms-vb2>Creado</TD>
                                <TD class=ms-vb2>Diferencia</TD>
                                </TR>

<?
}
?>

<?
if ($op==3) {
      $pre="reci";
      $select=" reci_id, reci_archivo, reci_folio, reci_materia, reci_tipodoc, reci_numero, reci_obs,  reci_remite, reci_fecha_doc, reci_anno, reci_destinatario, reci_defensoria, reci_fechasys, reci_jornada ";
?>
                                 <tr>
                                <TD class=ms-vb2 width="20"><DIV>Numero Documento</DIV></a></TD>
                                <TD class=ms-vb2 width="70">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Materia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></TD>
                                <TD class=ms-vb2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo Documento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2>Numero_Externo</TD>
                                <TD class=ms-vb2 width="20"><DIV>Observacion</DIV></TD>
                                <TD class=ms-vb2><NOBR>Remitente</NOBR></TD>
                                <TD class=ms-vb2 width="50%">Fecha Documento</TD>
                                <TD class=ms-vb2 width="60">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Año&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2>Destinatario</TD>
                                <TD class=ms-vb2>Defensoria</TD>
                                <TD class=ms-vb2>Creado</TD>
                                <TD class=ms-vb2><NOBR>Jornada</NOBR></TD>
                                </TR>

<?
}



if ($op==4) {
      $pre="despa";
      $select=" despa_id, despa_archivo, despa_folio, despa_materia, despa_tipodoc, despa_obs, despa_destinatario, despa_fecha_doc, despa_anno, despa_numero, despa_remitente, despa_area, despa_defensoria, despa_fechasys, despa_tipodes";
?>

                                 <tr>
                                <TD class=ms-vb2 width="20"><DIV>Numero Documento</DIV></a></TD>
                                <TD class=ms-vb2 width="70">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Materia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></TD>
                                <TD class=ms-vb2><DIV>Tipo Documento</DIV></TD>
                                <TD class=ms-vb2>Observacion</TD>
                                <TD class=ms-vb2><NOBR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destinatario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</NOBR></TD>
                                <TD class=ms-vb2>Fecha Documento</TD>
                                <TD class=ms-vb2><NOBR>Año</NOBR></TD>
                                <TD class=ms-vb2>Numero Propio</TD>
                                <TD class=ms-vb2>Remitente</TD>
                                <TD class=ms-vb2><SPAN>Area</SPAN></TD>
                                <TD class=ms-vb2>Defensoria</TD>
                                <TD class=ms-vb2>Creado</TD>
                                <TD class=ms-vb2><NOBR>Tipo Despacho </NOBR></TD>
                                </TR>

<?
}
?>



<?

 $registros=50;
if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}


//--------- consultas sql -------------

if (($fecha1<>'' and $fecha2<>'') and $op==2) {
    // $fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    // $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

    $consultasql.=" and (".$pre."_fecha>='$fecha1' and ".$pre."_fecha<='$fecha2') ";
}
if (($fecha1<>'' and $fecha2<>'') and ($op==3 or $op==4)) {
    // $fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    // $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

    $consultasql.=" and (".$pre."_fecha_doc>='$fecha1' and ".$pre."_fecha_doc<='$fecha2') ";
}

if ($folio<>'') {
    $consultasql.=" and ".$pre."_folio=$folio ";
}
if ($adju=='SI') {
    $consultasql.=" and ".$pre."_archivo<>'' ";
}
if ($adju=='NO') {
    $consultasql.=" and ".$pre."_archivo='' ";
}
if ($materia<>'') {
    $consultasql.=" and ".$pre."_materia like '%$materia%' ";
}
if ($tramite<>'') {
    $consultasql.=" and ".$pre."_tramite ='$tramite' ";
}
if ($destinatario<>'') {
    $consultasql.=" and ".$pre."_destinatario like '%$destinatario%' ";
}
if ($tipodoc<>'') {
    $consultasql.=" and ".$pre."_tipo  = '$tipodoc' ";
}
if ($remite<>'' and $op==3) {
    $consultasql.=" and ".$pre."_remite like '%$remite%' ";
}

if ($remite<>'' and $op==4) {
    $consultasql.=" and ".$pre."_remitente like '%$remite%' ";
}
if ($tipodoc1<>'' and ($op==4 or $op==3)) {
    $consultasql.=" and ".$pre."_tipodoc='$tipodoc1' ";
}
if ($tipodoc2<>'' and ($op==2 or $op==6)) {
    $consultasql.=" and ".$pre."_tipo='$tipodoc2' ";
}


if ($op==2) {
    $tabla=" argedo_documentos ";
    $sql="select $select from $tabla where docs_defensoria='$reg' and docs_anno='$periodo' $consultasql order by docs_id desc";
}
if ($op==3) {
    $tabla=" argedo_recibida ";
     $sql="select $select from $tabla where reci_defensoria='$reg' and reci_anno='$periodo' $consultasql order by reci_id desc";
}
if ($op==4) {
    $tabla=" argedo_despachada ";
     $sql="select $select from $tabla where despa_defensoria='$reg' and despa_anno='$periodo' $consultasql order by despa_id desc";
}
// $sql="select * from $tabla where  ";


$sql2=$sql;
$resultado=mysql_query($sql);
$total_registros = mysql_num_rows($resultado);

// echo $sql;

 $result=mysql_query($sql,$link);
 $sw=0;
 while ($row=mysql_fetch_array($result)) {
 $nombre=$row["nombre"];
 $archivo=$row["1"];
 if ($sw==0) {
  $estilo="ms-alternating";
  $sw=1;
 } else {
  $estilo="";
  $sw=0;

 }

if ($op==2) {
    $sql2="select * from area where id='$row[8]' ";
    $result2=mysql_query($sql2,$link);
    $row2=mysql_fetch_array($result2);
    $row[8]=$row2["opcion"];

    $sql3="select * from subarea where id='$row[9]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $row[9]=$row3["opcion"];

    $sql3="select * from regiones where codigo='$row[10]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $row[10]=$row3["nombre"];
    
    $row[5]=substr($row[5],8,2)."-".substr($row[5],5,2)."-".substr($row[5],0,4);
    $fechabase=$row["13"];
    $fechadoc=$row["5"];
    
    $diferencia=$row["14"];
    if ($diferencia==0) {
        $imagen="green.png";
    }
    if ($diferencia>=1 and $diferencia<=2) {
        $imagen="yellow.png";
    }
    if ($diferencia>2) {
        $imagen="red.png";
    }
    
    $row["14"]=$row["14"]." <img  alt='' src='".$imagen."' width=19 height=17 border='0'>";

    
}


if ($op==3) {

    $sql3="select * from regiones where codigo='$row[11]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $row[11]=$row3["nombre"];
    $row[8]=substr($row[8],8,2)."-".substr($row[8],5,2)."-".substr($row[8],0,4);
    $row[12]=substr($row[12],8,2)."-".substr($row[12],5,2)."-".substr($row[12],0,4);
    $fechabase=$row["12"];
    $fechadoc=$row["5"];
}

if ($op==4) {
    $sql2="select * from area where id='$row[11]' ";
    $result2=mysql_query($sql2,$link);
    $row2=mysql_fetch_array($result2);
    $row[11]=$row2["opcion"];

//    $sql3="select * from subarea where id='$row[12]' ";
//    $result3=mysql_query($sql3,$link);
//    $row3=mysql_fetch_array($result3);
//    $row[12]=$row3["opcion"];

    $sql3="select * from regiones where codigo='$row[12]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $row[12]=$row3["nombre"];

    $row[13]=substr($row[13],8,2)."-".substr($row[13],5,2)."-".substr($row[13],0,4);
    $row[7]=substr($row[7],8,2)."-".substr($row[7],5,2)."-".substr($row[7],0,4);
    $fechabase=$row["13"];
    $fechadoc=$row["7"];
}


 $fechahoy = date("Y-m-d");
 $dia1 = strtotime($fechahoy);
 $fechabase =$fechabase;
 $dia2 = strtotime($fechabase);
 $diff=$dia2-$dia1;
// echo "$fechahoy -- $fechabase $diff <br>";
 $diff=(intval($diff/(60*60*24)))*-1;
 
 
//  echo "$fechahoy-$fechabase $diff<br>";
 if ($diff<=1) {
     $nuevo="¡Nuevo!";
     $color="#31B404";
 } else {
      $nuevo="";
 }

 $fechahoy = $fechadoc;
 $dia1 = strtotime($fechahoy);
// $fechabase =$fechabase;
 $dia2 = strtotime($fechabase);
 $diff=$dia2-$dia1;
// echo "$fechahoy -- $fechabase $diff <br>";
 $diff2=(intval($diff/(60*60*24)))*-1;
 if ($diff2==0 and $op==2) {
     $imagen="";
//     $row["14"]=$diff2;
 }

$var16='';
if ($row["16"]==6) {
  $var16='RR.HH';
}
if ($row["16"]==1 or $row["16"]==2 or $row["16"]==3) {
  $var16='Normal';
}


?>
                                <Tr>
                                <TD class=ms-vb2 width="60"><? echo $row["2"]; ?></TD>
                                <TD class=ms-vb2 width="170">
                                <DIV><? echo $row["3"]; ?></DIV></TD>
                                <TD class=ms-vb2><? echo $row["4"]; ?></TD>
                                <TD class=ms-vb2><DIV><? echo $row["5"]; ?></DIV></TD>
                                <TD class=ms-vb2><? echo $row["6"]; ?></TD>
                                <TD class=ms-vb2 width="170"><div><? echo $row["7"]; ?></div></TD>
                                <TD class=ms-vb2 ><? echo $row["8"]; ?></TD>
                                <TD class=ms-vb2 ><? echo $row["9"]; ?></TD>
                                <TD class=ms-vb2 ><SPAN><? echo $row["10"]; ?></SPAN></TD>
                                <TD class=ms-vb2><? echo $row["11"]; ?></TD>
                                <TD class=ms-vb2><? echo $row["12"]; ?></TD>
                                <TD class=ms-vb2><? echo $row["13"]; ?></TD>
                                <TD class=ms-vb2><? echo $row["14"]; ?></TD>
                                <TD class=ms-vb2><? echo $var16; ?></TD>
                                </Tr>
<?
}
?>




