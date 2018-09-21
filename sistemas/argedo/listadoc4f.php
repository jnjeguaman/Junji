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
if ($op==5) {
    $titulo="Facturas, Boletas y Doc. Valorados";
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
$servicio=$_GET["servicio"];
$folio=$_GET["folio"];
$adju=$_GET["adju"];
$proveedor=$_GET["proveedor"];
$rutproveedor=$_GET["rutproveedor"];
$nrodoc=$_GET["nrodoc"];

?>
                                
                          <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 TOPLEVEL>

                                 <tr class=ms-alternating>
                                <TD class=ms-vb2>
<?
if ($op==5) {
    $pre="docs";
    $select=" eta_id, eta_archivorecibo, eta_folio, eta_tipo_doc2, eta_fecha_recepcion, eta_numero,  $periodo, eta_rut, eta_dig , eta_cli_nombre, eta_nroorden, eta_nroresolucion, eta_servicio_final, eta_tipo_doc";
?>
                                </TD>
                                <TD class=ms-vb2 width="20"><DIV>Folio</DIV></a></TD>
                                <TD class=ms-vb2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo Documento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Recepcion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nº Documento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2><DIV>Año&nbsp;</DIV></TD>
                                <TD class=ms-vb2><NOBR>Rut Proveedor</NOBR></TD>
                                <TD class=ms-vb2><NOBR>Nombre Proveedor</NOBR></TD>
                                <TD class=ms-vb2>Nº O/C</TD>
                                <TD class=ms-vb2>Nº Resolucion</TD>
                                <TD class=ms-vb2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Servicio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2></TD>
                                <TR class="">
                                 <TD class=ms-vb2>
<?
}

 $registros=50;
if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
}
else {
    $inicio = ($pagina - 1) * $registros;
}


//--------- consultas sql -------------

if (($fecha1<>'' and $fecha2<>'') and $op==5) {
    $fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

    $consultasql.=" and (eta_fecha_recepcion>='$fecha1' and eta_fecha_recepcion<='$fecha2') ";
}

if ($folio<>'') {
    $consultasql.=" and eta_folio=$folio ";
}


if ($servicio<>'') {
    $consultasql.=" and eta_nroorden like '%$servicio%' ";
}
if ($proveedor<>'') {
    $consultasql.=" and eta_cli_nombre like '%$proveedor%' ";
}
if ($rutproveedor<>'') {
    $consultasql.=" and eta_rut like '%$rutproveedor%' ";
}
if ($nrodoc<>'') {
    $consultasql.=" and eta_numero like '%$nrodoc%' ";
}


if ($op==5) {
    $tabla=" dpp_etapas ";
     $sql="select $select from $tabla where eta_estado<=20 and eta_region='$reg' and year(eta_fecha_recepcion)='$periodo' $consultasql order by eta_id desc";
}

// $sql="select * from $tabla where  ";
// echo $sql;

$resultado=mysql_query($sql);
//$total_registros = mysql_num_rows($resultado);
//$v_limite=" LIMIT $inicio, $registros ";
//$sql .= $v_limite;
//$total_paginas = ceil($total_registros / $registros);
// echo $sql;

 $result=mysql_query($sql,$link);
 $sw=0;
 while ($row=mysql_fetch_array($result)) {
 $nombre=$row["nombre"];
 $archivo=$row["1"];
  $row[4]=substr($row[4],8,2)."-".substr($row[4],5,2)."-".substr($row[4],0,4);
 $tipodoc=$row["3"];



 if ($tipodoc=='f') {
     $row[3]="Factura ";
 }
 if ($tipodoc=='b') {
     $row[3]="Boleta Servicio ";
 }
 if ($tipodoc=='r') {
     $row[3]="Recibo ";
 }
 if ($tipodoc=='n') {
     $row[3]="Nota de Crédito ";
 }
 if ($tipodoc=='d') {
     $row[3]="Nota de Débito ";
 }
 if ($tipodoc=='') {
     $row[3]="Honorario ";
 }



 if ($sw==0) {
  $estilo="ms-alternating";
  $sw=1;
 } else {
  $estilo="";
  $sw=0;

 }
//   eta_tipo_doc
if ($row[eta_tipo_doc]=='Factura') {
   $sql2 = "Select * from dpp_facturas  where fac_eta_id=$row[0]  ";
//   echo $sql2;
   $res2 = mysql_query($sql2);
   $row2 = mysql_fetch_array($res2);
   $archivo=$row2["fac_archivo"];
}


if ($row[eta_tipo_doc]=='Honorario') {
   $sql2 = "Select * from dpp_honorarios where hono_eta_id=$row[0]  ";
   //echo $sql2;
   $res2 = mysql_query($sql2);
   $row2 = mysql_fetch_array($res2);
   $archivo=$row2["hono_archivo"];
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



?>
                                </TD>
                                <TD class=ms-vb2 width="60">
                                <DIV><? echo $row["2"]; ?><font color="<? echo $color?>"><? echo $nuevo ?></font></DIV></TD>
                                <TD class=ms-vb2 width="170">
                                <DIV><? echo $row["3"]; ?></DIV></TD>
                                <TD class=ms-vb2><? echo $row["4"]; ?></TD>
                                <TD class=ms-vb2><DIV><? echo $row["5"]; ?></DIV></TD>
                                <TD class=ms-vb2><? echo $row["6"]; ?></TD>
                                <TD class=ms-vb2 width="170"><div><? echo $row["eta_rut"]."-".$row["eta_dig"]; ?></div></TD>
                                <TD class=ms-vb2 ><? echo $row["eta_cli_nombre"]; ?></TD>
                                <TD class=ms-vb2 ><? echo $row["eta_nroorden"]; ?></TD>
                                <TD class=ms-vb2><? echo $row["eta_nroresolucion"]; ?></TD>
                                <TD class=ms-vb2><? echo $row["eta_servicio_final"]; ?></TD>
                                <TR class="<? echo $estilo ?>">
                                <TD class=ms-vb2>
<?
}
?>




