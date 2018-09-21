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
          <TD class=ms-globalbreadcrumb colSpan=4>
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
            src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/titlegraphic.gif"></TD>
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



if ($op==5) {
//    $select=" despa_id, despa_archivo, despa_folio, despa_defensoria, despa_area, despa_subarea, despa_destinatario, despa_tipodoc, despa_fecha_doc, despa_fecha_recep, despa_numero, despa_materia,  despa_remitente, despa_obs,  despa_fechasys, despa_tipodes, despa_anno,      despa_archivo, despa_horamod , despa_fechamod";
//    $tabla=" argedo_despachada ";
    $sql="select * from dpp_etapas where eta_id=$id";
}

// echo $sql;
 $result=mysql_query($sql,$link);
 $row=mysql_fetch_array($result);
 $nombre=$row["nombre"];
 $fecha1=substr($row["eta_fecha_ing"],8,2)."-".substr($row["eta_fecha_ing"],5,2)."-".substr($row["eta_fecha_ing"],0,4);

 $a=$row["eta_fecha_fac"];
 $fecha2=substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);
 
 if ($row[eta_tipo_doc]=='Factura') {
   $sql2 = "Select * from dpp_facturas  where fac_eta_id=$row[0]  ";
//   echo $sql2;
   $res2 = mysql_query($sql2);
   $row2 = mysql_fetch_array($res2);
   $archivo=$row2["fac_archivo"];
   $archivo2=$row2["fac_doc1"];
   $archivo3=$row2["fac_doc2"];
   $archivo4=$row2["fac_doc3"];
}


if ($row[eta_tipo_doc]=='Honorario') {
   $sql2 = "Select * from dpp_honorarios where hono_eta_id=$row[0]  ";
   //echo $sql2;
   $res2 = mysql_query($sql2);
   $row2 = mysql_fetch_array($res2);
   $archivo=$row2["hono_archivo"];
   $archivo2=$row2["hono_doc1"];
   $archivo3=$row2["hono_doc2"];
   $archivo4=$row2["hono_doc3"];
}


$etafpago=$row["eta_fpago"];
//echo "----->".$etafpago;
if ($etafpago=='Transferencia') {
   $etancheque1=$row["eta_ncheque"];
   $cotrananno=substr($row["eta_fechache"],0,4);
   $sql2 = "Select * from dpp_comprobantetrans where cotran_nrocomprobante='$etancheque1' and year(cotran_fecha)='$cotrananno' and cotran_region='$reg' ";
//   echo $sql2;
   $res2 = mysql_query($sql2);
   $row2 = mysql_fetch_array($res2);
   $cotranarchivo1=$row2["cotran_archivo1"];
   $etancheque= "<a href='../seguimientos/sitio2/documentostrans/".$cotranarchivo1."' class='link' target='_blank' >".$cotranarchivo1."</a>";


} else {
   $etancheque="<a href='../archivos/docfac/".$row["eta_archivorecibo"]."' class='link' target='_blank'>".$row["eta_archivorecibo"]."</a>";

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
                                <tr>
                                  <td align="right" colspan=2>
                                    <form method="get" action="listadoc3f.php">
                                      <input type="submit" value="        Cerrar         ">
                                      <input type="hidden" name="reg" value="<? echo $reg ?>"  >
                                      <input type="hidden" name="op" value="<? echo $op ?>"  >
                                      <input type="hidden" name="periodo" value="<? echo $periodo ?>"  >
                                    </form>
                                  </td>
                                <tr>

                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap width=165>
                                <H3 class=ms-standardheader>FOLIO</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice   vAlign=top width=450><? echo $row["eta_folio"]; ?> </TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>FECHA CREACION</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $fecha1; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>FECHA FACTURA</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $fecha2; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>RUT</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo  number_format($row["eta_rut"],0,',','.')."-".$row["eta_dig"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>NOMBRE</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_cli_nombre"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>Nº DOCUMENTO</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_numero"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>Nº ORDEN COMPRA</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_nroorden"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>TOTAL A PAGAR</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_monto"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>DESCRIPCIÓN SERVICIO</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_servicio_final"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>IMAGEN FACTURA</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450>
                                        <a href='../archivos/docfac/<? echo $archivo ?>' target="_blank"> <? echo $archivo; ?></A>

                                </TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>IMAGEN ORDEN DE COMPRA</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450>
                                     <a href='../archivos/docfac/<? echo $archivo2 ?>' target="_blank"> <? echo $archivo2; ?></A>
                                </TD></TR>
                                

                            <tr>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader></H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450>

                               <table border=1>
<?

   $idetapa=trim($row["eta_id"]);
   $sql77="select * from compra_orden where oc_eta_id ='$idetapa' ";
//   $sql77="select * from compra_orden where oc_eta_id ='10' ";

//   echo $sql77;
   $res77 = mysql_query($sql77) or die ("muere");
   $cont11=1;

   while($row7 = mysql_fetch_array($res77)){

       if ($cont11==1 or $cont11==4 or $cont11==7 or $cont11==10 or $cont11==13 or $cont11==16 or $cont11==19 or $cont11==21 or $cont11==24 ) {
           echo "<tr>";
       }
?>

                                 <td class=ms-formlabel vAlign=top noWrap>
                                   <a href="../archivos/docfac/<? echo $row7["oc_archivo"]; ?>" class="link" target="_blank"><? echo $row7["oc_numero"]; ?></a>
                                </td>


<?
       $cont11++;
   }



?>
                         </table>
                         </td>
                           </tr>

<?
//   echo "--->".$archivo3;

   list($v1, $v2, $v3, $v4, $v5, $v6, $v7, $v8, $v9) = split('[/]', $archivo3);
   if ($v1=="..") {
     $vtodos=$v3."/".$v4."/".$v5."/".$v6."/".$v7."/".$v8."/".$v9;
     $v9="Ver";
   } else {
//     $vtodos="../archivos/docfac/".$archivo3;
     $vtodos="../archivos/docfac/".$archivo3;
     $v9="Ver";
   }

?>
                                
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>IMAGEN RESOLUCION</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450>
                                        <a href='<? echo $vtodos ?>' target="_blank"> <? echo $v9 ?> </A>
                                  </TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>IMAGEN OTROS ANTECEDENTES</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450>
                                        <a href='../archivos/docfac/<? echo $archivo4 ?>' target="_blank"> <? echo $archivo4; ?></A>
                                  </TD></TR>

                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>MOTIVO RECHAZO</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_motivo_final"] ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>DEPTO APROBACIÓN</H3></TD>
<?
                                 $deptoaprobacion=$row["eta_depto_aprobacion"];
                                   $sql4="select * from dpp_deptos where depto_id=$deptoaprobacion";

//                                   echo $sql4;
                                   //echo $sql;
                                   $res4 = mysql_query($sql4);
                                   $row22=mysql_fetch_array($res4);
                                    $deptonombre=$row22["depto_nombre"];
?>

                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $deptonombre; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>APROBADOR</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_usu_aprobacionok"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>FECHA VºBº</H3></TD>
                             <?
 				                    $a=$row["eta_fecha_aprobacionok"];
                                     //echo $a."-";


                                    ?>

                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4); ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>ITEM</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_item"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>NÚMERO EGRESO</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_negreso"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>NÚMERO CHEQUE</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_ncheque"]; ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>FECHA CHEQUE</H3></TD>
                              <?
                                 $a=$row["eta_fechache"];

                              ?>

                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4); ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>FECHA COBRO</H3></TD>
                              <?
                                 $a=$row["eta_fecha_retira"];

                              ?>

                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4); ?></TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>FORMA COBRO</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450><? echo $row["eta_forma"] ?> _ <? echo $row["eta_retira"]; ?> </TD></TR>
                                <TR>
                                <TD class=ms-formlabel vAlign=top noWrap  width=165><H3 class=ms-standardheader>IMAGEN DEL PAGO</H3></TD>
                                <TD class=ms-formbody id=SPFieldChoice  vAlign=top width=450>
                                    <? echo $etancheque ?>                                   </TD></TR>
                                </TD></TR>



                                <tr>
                                  <td align="right" colspan=2>
                                    <form method="get" action="listadoc3f.php">
                                      <input type="submit" value="        Cerrar         ">
                                      <input type="hidden" name="reg" value="<? echo $reg ?>"  >
                                      <input type="hidden" name="op" value="<? echo $op ?>"  >
                                      <input type="hidden" name="periodo" value="<? echo $periodo ?>"  >
                                    </form>
                                  </td>
                                <tr>







                                </TD></TR></TBODY></TABLE>









</DIV></TD></TR></TBODY></TABLE>
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



