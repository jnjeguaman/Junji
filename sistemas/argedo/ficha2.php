<?
include("conex.php");
$link=conectarse();
$op=$_GET["op"];
if ($op==2) {
    $titulo="Resoluciones & Oficios";
}
if ($op==3) {
    $titulo="Correspondencia Recibida (Exceptuando facturas y documentos valorados)";
}
if ($op==4) {
    $titulo="Correspondencia Despachada";
}

$read1= rand(0,1000000);
$read2= rand(0,1000000);
$read3= rand(0,1000000);
$read4= rand(0,1000000);

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML dir=ltr xmlns:o = "urn:schemas-microsoft-com:office:office"><HEAD><TITLE><? echo $titulo ?></TITLE>
<META content="MSHTML 6.00.6000.16890" name=GENERATOR>
<META content=SharePoint.WebPartPage.Document name=progid>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META http-equiv=Expires content=0>
<META content=NOHTMLINDEX name=ROBOTS><LINK href="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/core.css" type=text/css rel=stylesheet>
<SCRIPT language=javascript 
src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/init.js" type=text/javascript></SCRIPT>




<META content="SharePoint Team Web Site" name=CollaborationServer>
    <link href="librerias/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>
</HEAD>
<BODY>
    
<?

include("inc/encabezado.php");

?>



<TABLE class=ms-main height="100%" cellSpacing=0 cellPadding=0 width="100%" 
border=0>
  <TBODY>
  <TR>
    <TD>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=ms-globalbreadcrumb colSpan=4><SPAN id=TurnOnAccessibility 
            style="DISPLAY: none"><A class=ms-skip 
            onclick="SetIsAccessibilityFeatureEnabled(true);UpdateAccessibilityUI();return false;" 
            href="#">Activar el
            modo de accesibilidad</A> </SPAN><A class=ms-skip accessKey=J 
            onclick="javascript:this.href='#mainContent';" 
            href="javascript:;">Saltar al contenido principal</A> 
            <TABLE class=ms-globalleft height="100%" cellSpacing=0 
cellPadding=0>
              <TBODY>
              <TR>
                <TD class=ms-globallinks style="PADDING-TOP: 2px" vAlign=center 
                height="100%">
                </TD></TR></TBODY></TABLE>
            <TABLE class=ms-globalright height="100%" cellSpacing=0 
            cellPadding=0>
              <TBODY>
              <TR>
                <TD class=ms-globallinks 
                style="PADDING-RIGHT: 6px; PADDING-LEFT: 3px" 
vAlign=center></TD>
                <TD class=ms-globallinks vAlign=center><SPAN 
                  style="DISPLAY: none">
</SPAN><SPAN
                  title="Abrir men">
                  </SPAN>
                  <SCRIPT language=javascript type=text/javascript>var _spUserId=20;</SCRIPT>
                </TD>
                <TD class=ms-globallinks 
                style="PADDING-RIGHT: 3px; PADDING-LEFT: 1px"></TD>
                <TD class=ms-globallinks vAlign=center>
                  <TABLE cellSpacing=0 cellPadding=0>
                    <TBODY>
                    <TR>
                      <TD class=ms-globallinks></TD>
                      <TD class=ms-globallinks>
                        <TABLE>
                          <TBODY>
                          <TR>
                            <TD class=ms-globallinks><SPAN 
                              id=ctl00_PlaceHolderGlobalNavigation_ctl08_MyLinksMenu><SPAN 
                              style="DISPLAY: none">
                              <MENU 
                              id=ctl00_PlaceHolderGlobalNavigation_ctl08_MyLinksMenuMenuTemplate 
                              type=ServerMenu 
                              largeIconMode="true"></MENU></SPAN><SPAN 
                              title="Abrir men"></SPAN></SPAN></TD>
                            <TD 
                    class=ms-globallinks></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
                </TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD class=ms-globalTitleArea>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=ms-titleimagearea id=GlobalTitleAreaImage><IMG 
            id=ctl00_onetidHeadbnnr0 
            style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px" 
            alt="" 
            src="junji.png"></TD>
          <TD class=ms-sitetitle width="100%">
            <H1 class=ms-sitetitle><A 
            id=ctl00_PlaceHolderSiteName_onetidProjectPropertyTitle 
            href="#"><? echo $titulo ?></A></H1></TD>
          <TD style="PADDING-TOP: 8px" vAlign=top></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD class=ms-bannerContainer id=onetIdTopNavBarContainer width="100%">
      <TABLE class=ms-bannerframe cellSpacing=0 cellPadding=0 width="100%" 
      border=0>
        <TBODY>
        <TR>
          <TD vAlign=center noWrap></TD>
          <TD class=ms-banner id=HBN100 noWrap width="99%">
            <TABLE 
            class="ms-topNavContainer zz1_TopNavigationMenu_5 zz1_TopNavigationMenu_2" 
            id=zz1_TopNavigationMenu cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
<?
$op=$_GET["op"];
$reg=$_GET["reg"];
$periodo=$_GET["periodo"];
$id=$_GET["id"];
$ori=$_GET["ori"];
$pagina=$_GET["pagina"];
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

if ($ori==1) {
  $volver="listadoc2.php";
}
if ($ori==2) {
  $volver="listadoc3.php";
}


 $sql="select * from regiones where codigo=$reg ";
// echo $sql;
 $result=mysql_query($sql,$link);
 $row=mysql_fetch_array($result);
 $nombre2=$row["nombre"];


?>
              <TR>
                <TD id=zz1_TopNavigationMenun0 onkeyup=Menu_Key(this) 
                onmouseover=Menu_HoverRoot(this) 
                  onmouseout=Menu_Unhover(this)><TABLE 
                  class="ms-topnav zz1_TopNavigationMenu_4" cellSpacing=0 
                  cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD style="WHITE-SPACE: nowrap"><A 
                        class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3 <? echo $clase1 ?>"
                        style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none" 
                        accessKey=1 
                        href="estayopera.php" data-toggle="tooltip" data-placement="<? echo $posicion; ?>" title="<? echo $text1; ?>">Estadística y Operación</A></TD></TR></TBODY></TABLE></TD>
                <TD style="WIDTH: 0px"></TD>
                <TD>
                  <TABLE class=zz1_TopNavigationMenu_5 cellSpacing=0 
                  cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD style="WIDTH: 0px"></TD>
                      <TD id=zz1_TopNavigationMenun1 onkeyup=Menu_Key(this) 
                      onmouseover=Menu_HoverStatic(this) 
                      onmouseout=Menu_Unhover(this)>
                        <TABLE 
                  class="ms-topnav zz1_TopNavigationMenu_4" cellSpacing=0
                  cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD style="WHITE-SPACE: nowrap"><A
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3   <? echo $clase2 ?> "
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none" 
                              href="resyoficio.php" data-toggle="tooltip" data-placement="<? echo $posicion; ?>" title="<? echo $text2; ?>">Resoluciones &amp; Oficios</A></TD></TR></TBODY></TABLE>
                            </TD>
                      <TD style="WIDTH: 0px"></TD>
                      <TD style="WIDTH: 0px"></TD>
                      <TD id=zz1_TopNavigationMenun2 onkeyup=Menu_Key(this) 
                      onmouseover=Menu_HoverStatic(this) 
                      onmouseout=Menu_Unhover(this)>
                        <TABLE class="ms-topnav zz1_TopNavigationMenu_4" 
                        cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                          
                            <TD style="WHITE-SPACE: nowrap"><A
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3   <? echo $clase3 ?> "
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"
                              href="correrecibida.php" data-toggle="tooltip" data-placement="<? echo $posicion; ?>" title="<? echo $text3; ?>">Correspondencia Recibida</A></TD></TR></TBODY></TABLE>
                            </TD>

                      <TD style="WIDTH: 0px"></TD>
                      <TD style="WIDTH: 0px"></TD>
                      <TD id=zz1_TopNavigationMenun3 onkeyup=Menu_Key(this)
                      onmouseover=Menu_HoverStatic(this)
                      onmouseout=Menu_Unhover(this)>

                        <TABLE class="ms-topnav zz1_TopNavigationMenu_4"
                        cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>

                            <TD style="WHITE-SPACE: nowrap"><A
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3   <? echo $clase4 ?> "
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"
                              href="correemitida.php" data-toggle="tooltip" data-placement="<? echo $posicion; ?>" title="<? echo $text4; ?>">Correspondencia Despachada</A></TD></TR></TBODY></TABLE>
                            </TD>


                      <TD style="WIDTH: 0px"></TD>
                      <TD style="WIDTH: 0px"></TD>
                      <TD id=zz1_TopNavigationMenun3 onkeyup=Menu_Key(this) 
                      onmouseover=Menu_HoverStatic(this) 
                      onmouseout=Menu_Unhover(this)>
                      
                        <TABLE class="ms-topnav zz1_TopNavigationMenu_4" 
                        cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD style="WHITE-SPACE: nowrap"><A 
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3  <? echo $clase5 ?> "
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none" 
                              href="facturas.php" data-toggle="tooltip" data-placement="<? echo $posicion; ?>" title="<? echo $text5; ?>">Facturas,
                              Boletas y Doc. 
Valorados</A></TD></TR></TBODY></TABLE>
                      </TD>
                      <TD style="WIDTH: 0px"></TD>
                      <TD style="WIDTH: 0px"></TD>
                      <!-- <TD>

                        <TABLE class="ms-topnav zz1_TopNavigationMenu_4"
                        cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD style="WHITE-SPACE: nowrap"><A
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3"
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"
                              href="plancompra.php">Plan de Compras</A></TD></TR></TBODY></TABLE>
                      </TD>

                      <TD style="WIDTH: 0px"></TD>
                      <TD style="WIDTH: 0px"></TD>
                      <TD>

                        <TABLE class="ms-topnav zz1_TopNavigationMenu_4"
                        cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD style="WHITE-SPACE: nowrap"><A
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3"
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"
                              href="docmaster1.php">DocMaster
</A></TD></TR></TBODY></TABLE>
                      </TD> -->
                      
                      
                      <TD 
            style="WIDTH: 0px"></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
          <TD class=ms-banner>&nbsp;&nbsp;</TD>
          <TD style="LEFT: 0px; BOTTOM: 0px; POSITION: relative" vAlign=bottom 
          align=right>
            <TABLE cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD>
                  <TABLE class=ms-siteaction height="100%" cellSpacing=0 
                  cellPadding=0>
                    <TBODY>
                    <TR>
                      <TD class=ms-siteactionsmenu id=siteactiontd>
                        <DIV>
                        <DIV><SPAN title="Abrir men">
                   </SPAN></DIV></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
  <TR height="100%">
    <TD>
      <TABLE height="100%" cellSpacing=0 cellPadding=0 width="100%">
        <TBODY>
        <TR>
          <TD class=ms-titlearealeft id=TitleAreaImageCell vAlign=center 
            noWrap><DIV class=ms-titleareaframe style="HEIGHT: 100%"><IMG 
            height=1 alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=1></DIV></TD>
          <TD class=ms-titleareaframe id=TitleAreaFrameClass>
            <DIV class=ms-titleareaframe><IMG height="100%" alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=1></DIV></TD>
          <TD class=ms-pagetitleareaframe id=onetidPageTitleAreaFrame vAlign=top 
          noWrap>
            <TABLE id=onetidPageTitleAreaTable cellSpacing=0 cellPadding=0 
            width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=ms-titlearea vAlign=top></TD></TR>
              <TR>
                <TD class=ms-pagetitle id=onetidPageTitle vAlign=top 
                height="100%">
                  <H2 class=ms-pagetitle><LABEL class=ms-hidden>Resoluciones 
                  &amp; Oficios</LABEL> </H2></TD></TR></TBODY></TABLE></TD>
          <TD class=ms-titlearearight>
            <DIV class=ms-titleareaframe style="HEIGHT: 100%"><IMG height=1 
            alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=1></DIV></TD></TR>
        <TR>
          <TD class=ms-leftareacell id=LeftNavigationAreaCell vAlign=top 
          height="100%">
            <TABLE class=ms-nav height="100%" cellSpacing=0 cellPadding=0 
            width="100%">
              <TBODY>
              <TR>
                <TD>
                  <TABLE class=ms-navframe height="100%" cellSpacing=0 
                  cellPadding=0 border=0>
                    <TBODY>
                    <TR vAlign=top>
                      <TD width=4><IMG height=1 alt="" 
                        src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
                        width=4></TD>
                      <TD vAlign=top width="100%"></TD></TR>
                    <TR>
                      <TD colSpan=2><IMG height=1 alt="" 
                        src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
                        width=138></TD></TR></TBODY></TABLE></TD>
                <TD></TD></TR></TBODY></TABLE></TD>
          <TD>
            <DIV class=ms-pagemargin><IMG height=1 alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=10></DIV></TD>
          <TD class=ms-bodyareacell vAlign=top><PLACEHOLDER 
            id=ctl00_MSO_ContentDiv>
            <TABLE class=ms-propertysheet id=MSO_ContentTable height="100%" 
            cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class=ms-bodyareaframe vAlign=top height="100%"><A 
                  name=mainContent></A>
                  <TABLE cellSpacing=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD class=ms-pagebreadcrumb></TD></TR>
                    <TR>
                      <TD class=ms-webpartpagedescription></TD></TR>
                    <TR>
                      <TD>
                        <TABLE 
                        style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 5px" 
                        cellSpacing=0 cellPadding=0 width="100%">
                          <TBODY>
                          <TR>
                            <TD vAlign=top width="70%">
                              <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                                <TBODY>
                                <TR>
                                <TD id=MSOZoneCell_WebPartWPQ1 vAlign=top>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                                border=0 TOPLEVEL>
                                <TBODY>
                                <TR>
                                <TD vAlign=top>
                                <DIV id=WebPartWPQ1 allowExport="false" 
                                allowDelete="false" width="100%" HasPers="false" 
                                WebPartID="3ab7d2df-d206-4683-b9b8-5f0f4d74f092">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>

                                <TBODY>
                                <TR>
                                <TD>
                                <TABLE  border=0>
                                <TBODY>
                                
<?



if ($op==2) {
    $select=" docs_id, docs_archivo, docs_folio, docs_defensoria, docs_area, docs_subarea, docs_documento,  docs_tramite, docs_fecha, docs_materia, docs_obs,  docs_destinatario, docs_anno, docs_diferencia, docs_fechasis,  docs_archivo, docs_archivo2, docs_archivo3, docs_archivo4, docs_horamodi, docs_fechamodi ";
    $tabla=" argedo_documentos ";
    $sql="select $select from $tabla where docs_id='$id' ";
}
if ($op==3) {
    $select=" reci_id, reci_archivo, reci_folio,  reci_defensoria, reci_tipodoc, reci_numero, reci_fecha_doc, reci_fecha_recep, reci_materia, reci_remite, reci_destinatario, reci_obs,  reci_fecha_recep, reci_jornada,  reci_anno,   reci_archivo, reci_horamod, reci_fechamod ";
    $tabla=" argedo_recibida ";
    $sql="select $select from $tabla where reci_id='$id' ";
}
if ($op==4) {
    $select=" despa_id, despa_archivo, despa_folio, despa_defensoria, despa_area, despa_subarea, despa_destinatario, despa_tipodoc, despa_fecha_doc, despa_fecha_recep, despa_numero, despa_materia,  despa_remitente, despa_obs,  despa_fechasys, despa_tipodes, despa_anno,      despa_archivo, despa_horamod , despa_fechamod";
    $tabla=" argedo_despachada ";
    $sql="select $select from $tabla where despa_id='$id' ";
}

// echo $sql;
 $result=mysql_query($sql,$link);
 $row=mysql_fetch_array($result);
 $nombre=$row["nombre"];
 
if ($op==2) {
//    $select=" docs_id, docs_archivo, docs_folio, docs_defensoria, docs_area, docs_subarea, docs_tipodoc,  docs_tramite, docs_fecha, docs_materia, docs_obs,  docs_destinatario, docs_anno, 'diferencia', docs_fechasis,  docs_archivo, docs_archivo2, docs_archivo3, docs_archivo4 ";

    $tit[0]="id";
    $tit[1]="Datos Adjuntos";
    $tit[2]="Folio";
    $tit[3]="Defensoria";
    $tit[4]="Area";
    $tit[5]="Subareas";
    $tit[6]="Tipo de Documento";
    $tit[7]="En tramite";
    $tit[8]="Fecha del Documento";
    $tit[9]="Materia";
    $tit[10]="Observaciones";
    $tit[11]="Destinatario";
    $tit[12]="A&ntilde;o";
    $tit[13]="Diferencia";
    $tit[14]="Creado";
    $tit[15]="Datos Adjuntos";

    $dat[0]=$row["0"];
    $dat[1]=$row["1"];
    $dat[2]=$row["2"];
    $dat[3]=$row["3"];
    $dat[4]=$row["4"];
    $dat[5]=$row["5"];
    $dat[6]=$row["6"];
    $dat[7]=$row["7"];
    $dat[8]=$row["8"];
    $dat[8]=substr($dat[8],8,2)."-".substr($dat[8],5,2)."-".substr($dat[8],0,4);
    $dat[9]=$row["9"];
    $dat[10]=$row["10"];
    $dat[11]=$row["11"];
//    $dat[11]=substr($dat[11],8,2)."-".substr($dat[11],5,2)."-".substr($dat[11],0,4);
    $dat[12]=$row["12"];
    $dat[13]=$row["13"];
    $dat[14]=$row["14"];
    $dat[15]="<a href='../archivos/docargedo/".$row["15"]."?read1=".$read1."' target='_blank'>Ver Archivo 1</a>";
    $dat[16].="<BR><a href='../archivos/docargedo/".$row["16"]."?read2=".$read2."' target='_blank'>".$row["16"]."</a>";
    $dat[17].="<BR><a href='../archivos/docargedo/".$row["17"]."?read3=".$read3."' target='_blank'>".$row["17"]."</a>";
    $dat[18].="<BR><a href='../archivos/docargedo/".$row["18"]."?read4=".$read4."' target='_blank'>".$row["18"]."</a>";
    $dat[30]=$row["19"];
    $dat[31]=$row["20"];
    $dat[31]=substr($dat[31],8,2)."-".substr($dat[31],5,2)."-".substr($dat[31],0,4);
    

    $sql2="select * from area where id='$dat[4]' ";
    $result2=mysql_query($sql2,$link);
    $row2=mysql_fetch_array($result2);
    $dat[4]=$row2["opcion"];

    $sql3="select * from subarea where id='$dat[5]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $dat[5]=$row3["opcion"];

    $sql3="select * from regiones where codigo='$dat[3]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $dat[3]=$row3["nombre"];


}
if ($op==3) {
//    $select=" reci_id, reci_archivo, reci_folio,  reci_defensoria, reci_tipodoc, reci_numero, reci_fecha_doc, reci_fecha_recep, reci_materia, reci_remite, reci_destinatario, reci_obs,  reci_fecha_recep, reci_jornada,  reci_anno,   reci_archivo ";
    $tit[0]="id";
    $tit[1]="archivo";
    $tit[2]="Folio";
    $tit[3]="Defensoria";
    $tit[4]="Tipo Documento";
    $tit[5]="Numero_Externo";
    $tit[6]="Fecha Documento";
    $tit[7]="Fecha Recepcion Of. Parte";
    $tit[8]="Materia";
    $tit[9]="Remitente";
    $tit[10]="Destinatario";
    $tit[11]="Observacion";
    $tit[12]="Fecha Recepcion";
    $tit[13]="Jornada";
    $tit[14]="Año";
    $tit[15]="Datos Adjuntos";
    

    $dat[0]=$row["0"];
    $dat[1]=$row["1"];
    $dat[2]=$row["2"];
    $dat[3]=$row["3"];
    $dat[4]=$row["4"];
    $dat[5]=$row["5"];
    $dat[6]=$row["6"];
    $dat[6]=substr($dat[6],8,2)."-".substr($dat[6],5,2)."-".substr($dat[6],0,4);
    $dat[7]=$row["7"];
    $dat[7]=substr($dat[7],8,2)."-".substr($dat[7],5,2)."-".substr($dat[7],0,4);
    $dat[8]=$row["8"];
    $dat[9]=$row["9"];
    $dat[10]=$row["10"];
    $dat[11]=$row["11"];
    $dat[12]=$row["12"];
    $dat[12]=substr($dat[12],8,2)."-".substr($dat[12],5,2)."-".substr($dat[12],0,4);
    $dat[13]=$row["13"];
    $dat[14]=$row["14"];
    $dat[15]=$row["15"];
    $dat[15]="<a href='../archivos/docargedo/".$row["15"]."?read=".$read1."' target='_blank'>Ver Archivo</a>";
    $dat[30]=$row["16"];
    $dat[31]=$row["17"];
    $dat[31]=substr($dat[31],8,2)."-".substr($dat[31],5,2)."-".substr($dat[31],0,4);

    $sql3="select * from regiones where codigo='$dat[3]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $dat[3]=$row3["nombre"];



}
if ($op==4) {
//    $select=" despa_id, despa_archivo, despa_folio, despa_defensoria, despa_area, despa_subarea, despa_destinatario, despa_tipodoc, despa_fecha_doc, despa_fecha_recep, despa_numero, despa_materia,  despa_remitente, despa_obs,  despa_fechasys, despa_tipodes, despa_anno,      despa_archivo";
    $tit[0]="id";
    $tit[1]="adjunto";
    $tit[2]="Folio";
    $tit[3]="Defensoria";
    $tit[4]="Area";
//    $tit[5]="Subarea";
    $tit[6]="Destinatario";
    $tit[7]="Tipo Despacho";
    $tit[8]="Fecha del Documento";
    $tit[9]="Fecha Recepcion Of. Parte";
    $tit[10]="Numero Propio del Documento";
    $tit[11]="Materia";
    $tit[12]="Remitente";
    $tit[13]="Observacion";
    $tit[14]="Fecha Despacho";
    $tit[15]="Tipo Despacho";
    $tit[16]="Año";
    $tit[17]="Datos Adjuntos";

    $dat[0]=$row["0"];
    $dat[1]=$row["1"];
    $dat[2]=$row["2"];
    $dat[3]=$row["3"];
    $dat[4]=$row["4"];
//    $dat[5]=$row["5"];
    $dat[6]=$row["6"];
    $dat[7]=$row["7"];
    $dat[8]=$row["8"];
    $dat[8]=substr($dat[8],8,2)."-".substr($dat[8],5,2)."-".substr($dat[8],0,4);
    $dat[9]=$row["9"];
    $dat[9]=substr($dat[9],8,2)."-".substr($dat[9],5,2)."-".substr($dat[9],0,4);
    $dat[10]=$row["10"];
    $dat[11]=$row["11"];
    $dat[12]=$row["12"];
    $dat[13]=$row["13"];
    $dat[14]=$row["14"];
    $dat[14]=substr($dat[14],8,2)."-".substr($dat[14],5,2)."-".substr($dat[14],0,4);
    $dat[15]=$row["15"];
    $dat[16]=$row["16"];
    $dat[17]=$row["17"];
    $dat[17]="<a href='../archivos/docargedo/".$row["17"]."?read=".$read2."' target='_blank'>Ver Archivo</a>";
    $dat[30]=$row["18"];
    $dat[31]=$row["19"];
    $dat[31]=substr($dat[31],8,2)."-".substr($dat[31],5,2)."-".substr($dat[31],0,4);

    $sql2="select * from area where id='$dat[4]' ";
    $result2=mysql_query($sql2,$link);
    $row2=mysql_fetch_array($result2);
    $dat[4]=$row2["opcion"];

    $sql3="select * from subarea where id='$dat[5]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $dat[5]=$row3["opcion"];
    
    $sql3="select * from regiones where codigo='$dat[3]' ";
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $dat[3]=$row3["nombre"];




}

 
 
 
 
 
 
 
 
 
 
 
 
 
?>


                                <TR>
                                <TD class=ms-toolbar noWrap></TD></TR></TBODY></TABLE></TD>
                                <TD class=ms-toolbar noWrap width="99%"><IMG
                                height=18 alt=""
                                src="DefensorÃ­a%20Nacional%20Resoluciones%20&amp;%20Oficios%20-%202904_archivos/blank.gif"
                                width=1></TD></TR></TBODY></TABLE>
                                <TABLE class=ms-formtable style="MARGIN-TOP: 8px" cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <TBODY>
                               <TR>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" colspan="16">
                                <? echo $nombre2 ?>
                                </TD>
                                </TR>

                                <tr>
                                  <td align="right" colspan=2>
                                    <form method="get" action="<? echo $volver ?>">
                                      <input type="submit" value="        Cerrar         ">
                                      <input type="hidden" name="reg" value="<? echo $reg ?>"  >
                                      <input type="hidden" name="op" value="<? echo $op ?>"  >
                                      <input type="hidden" name="pagina" value="<? echo $pagina ?>"  >
                                      <input type="hidden" name="periodo" value="<? echo $periodo ?>"  >
                                    </form>
                                  </td>
                                <tr>

                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap width=165>
                                <H3 class=ms-standardheader><? echo $tit[2] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice   vAlign=top width=450><? echo $dat[2]; ?> </TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[3] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[3]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[4] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[4]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[5] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[5]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[6] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[6]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[7] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[7]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[8] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[8]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[9] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[9]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[10] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[10]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[11] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[11]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[12] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[12]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[13] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[13]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[14] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[14]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[15] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[15]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[16] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[16]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[17] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[17]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader><? echo $tit[18] ?></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $dat[18]; ?></TD>
                                </TR>

                                </TD></TR>

<?
if ($dat[30]<>'' ) {
?>
                                <tr>
                                <td class=ms-formlabel colspan="3">
                                 Fecha de la ultima modificacion <? echo $dat[31] ?>  y hora <? echo $dat[30] ?>
                                </td>
                                </tr>
<?
}
?>

<?
    $sql4="select * from cometido_funcionario where come_docs_id=".$dat[0];
//    echo $sql4;
    $result4=mysql_query($sql4,$link);
    $row4=mysql_fetch_array($result4);
//    $dat[3]=$row4["come_fechacontable"];
//echo "---".$row4["come_id"]."-->>".$row4["come_fechacontable"]."<<--<br>";
//echo  "($op==2 and ".$row4["come_fechacontable"]."<>'0000-00-00')";


if ($op==2 and $row4["come_fechacontable"]<>'') {
//if ($op==2 and $row4["come_fechacontable"]<>'0000-00-00' and $row4["come_fechacontable"]<>'') {


if ($row4["come_fechacontable"]=='0000-00-00') {
    $estado="En proceso Contable";
}
if ($row4["come_fechacontable"]<>'0000-00-00'  ) {
    $estado="Pagado, con certificado: ".$row4["come_certificado"];
}
$fechacontable=substr($row4["come_fechacontable"],8,2)."-".substr($row4["come_fechacontable"],5,2)."-".substr($row4["come_fechacontable"],0,4);

?>
                                <tr>
                                <td class=ms-formlabel colspan="3">
                                 VIATICO / COMETIDO
                                </td>
                                </tr>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>Estado</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row4["come_tipo"].", ".$estado; ?></TD>
                                </TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>Monto</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo number_format($row4["come_total"],'0',',','.'); ?></TD>
                                </TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>Fecha Pago</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $fechacontable; ?></TD>
                                </TR>


<?
}
?>



                                <tr>
                                  <td align="right" colspan=2>
                                    <form method="get" action="<? echo $volver ?>">
                                      <input type="submit" value="        Cerrar         ">
                                      <input type="hidden" name="reg" value="<? echo $reg ?>"  >
                                      <input type="hidden" name="op" value="<? echo $op ?>"  >
                                      <input type="hidden" name="periodo" value="<? echo $periodo ?>"  >
                                      <input type="hidden" name="pagina" value="<? echo $pagina ?>"  >
                                    </form>
                                  </td>
                                <tr>







                                </TD></TR></TBODY></TABLE>










                                <DIV 
                                class=ms-PartSpacingVertical></DIV></TD></TR>
                                <TR>
                                <TD id=MSOZoneCell_WebPartWPQ2 vAlign=top>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                                border=0 TOPLEVEL>
                                <TBODY>
                                </TBODY></TABLE></TD></TR></TBODY></TABLE>&nbsp;
                            </TD>
                            <TD>&nbsp;</TD>
                            <TD vAlign=top width="30%">&nbsp; </TD>
                            <TD>&nbsp;</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></PLACEHOLDER></TD>
          <TD class=ms-rightareacell>
            <DIV class=ms-pagemargin><IMG height=1 alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=10></DIV></TD></TR>
        <TR>
          <TD class=ms-pagebottommarginleft><IMG height=10 alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=1></TD>
          <TD class=ms-pagebottommargin><IMG height=10 alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=1></TD>
          <TD class=ms-bodyareapagemargin><IMG height=10 alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=1></TD>
          <TD class=ms-pagebottommarginright><IMG height=10 alt="" 
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/blank.gif" 
            width=1></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><INPUT 
style="DISPLAY: none" size=1 name=__spDummyText1> <INPUT style="DISPLAY: none" 
size=1 name=__spDummyText2>

 </FORM>
<STYLE type=text/css>.ms-bodyareaframe {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px
}
</STYLE>

<STYLE type=text/css>TD.ms-titleareaframe {
	HEIGHT: 10px
}
.ms-pagetitleareaframe {
	HEIGHT: 10px
}
DIV.ms-titleareaframe {
	HEIGHT: 100%
}
.ms-pagetitleareaframe TABLE {
	BACKGROUND: none transparent scroll repeat 0% 0%; HEIGHT: 10px
}
</STYLE>
</BODY></HTML>
