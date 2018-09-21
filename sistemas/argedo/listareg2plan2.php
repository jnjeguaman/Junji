<?
include("conex.php");
$link=conectarse();
include("../seguimientos/sitio2/Includes/FusionCharts.php");
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


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML dir=ltr xmlns:o = "urn:schemas-microsoft-com:office:office"><HEAD><TITLE><? echo $titulo ?></TITLE>
<META content="MSHTML 6.00.6000.16890" name=GENERATOR>
<META content=SharePoint.WebPartPage.Document name=progid>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META http-equiv=Expires content=0>
<META content=NOHTMLINDEX name=ROBOTS>

<LINK href="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/core.css" type=text/css rel=stylesheet>
<SCRIPT language=javascript src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/init.js" type=text/javascript></SCRIPT>
<SCRIPT language=javascript src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/core.js" type=text/javascript></SCRIPT>
<SCRIPT language=javascript src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/portal.js" type=text/javascript></SCRIPT>

<SCRIPT LANGUAGE="Javascript" SRC="../seguimientos/sitio2/grafico/FusionCharts.js"></SCRIPT>

<style type="text/css">
.Estilo1c{
    text-align:center;
    font-style:italic;
    font-family:"Times New Roman", Times;
    font-size:10px;
}
.Estilo1i{
    text-align:left;
    font-style:italic;
    font-family:"Times New Roman", Times;
    font-size:10px;
}
.Estilo1d{
    text-align:right;
    font-style:italic;
    font-family:"Times New Roman", Times;
    font-size:12px;
}
.Estilo2mc {
	font-family: Verdana;

	font-size: 10px;
	color: #003063;
    background-color:#E0F8F7;
    text-transform:uppercase;
}
.Estilo2mcblanco {
	font-family: Verdana;

	font-size: 10px;
	color: #003063;
    background-color:#FFFFFF;
    text-transform:uppercase;

}
.link {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #00659C;
	text-decoration:none;
	text-transform:uppercase;
}
.link:over {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #0000cc;
	text-decoration:none;
	text-transform:uppercase;
}


</style>

</HEAD>
<BODY>
<FORM id=aspnetForm name=aspnetForm onSubmit="javascript:return WebForm_OnSubmit();" action=default.aspx method=post>


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
            src="logo.png"></TD>
          <TD class=ms-sitetitle width="100%">
            <H1 class=ms-sitetitle><A 
            id=ctl00_PlaceHolderSiteName_onetidProjectPropertyTitle 
            href="#"><? echo $titulo ?></A></H1></TD>
<TD class=ms-vb style="PADDING-LEFT: 15px; PADDING-BOTTOM: 12px"><A onfocus=OnLink(this) href="../seguimientos/" target="_blank">Usuario</A>&nbsp;&nbsp;&nbsp;</TD></TR></TBODY></TABLE></TD></TR>
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

$unidad=$_GET["unidad"];
$compraid=$_GET["compraid"];
$orden=$_GET["orden"];
$ocnumero=$_GET["ocnumero"];
$anno=$_GET["anno"];

if (isset($_GET["periodo"])) {
   $anno=$_GET["periodo"];
}

$reg=$_GET["reg"];
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
//echo "-----------".$clase3;


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
                        href="estayopera.php">Estadística y Operación</A></TD></TR></TBODY></TABLE></TD>
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
                              href="resyoficio.php">Resoluciones &amp; Oficios</A></TD></TR></TBODY></TABLE>
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
                              href="correrecibida.php">Correspondencia Recibida</A></TD></TR></TBODY></TABLE>
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
                              href="correemitida.php">Correspondencia Despachada</A></TD></TR></TBODY></TABLE>
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
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3"
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"

                              href="facturas.php">Facturas,
                              Boletas y Doc.
Valorados</A></TD></TR></TBODY></TABLE>
                      </TD>
                      <TD style="WIDTH: 0px"></TD>
                      <TD style="WIDTH: 0px"></TD>
                      <TD>

                        <TABLE class="ms-topnav zz1_TopNavigationMenu_4"
                        cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD style="WHITE-SPACE: nowrap"><A class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3 ms-topnavselected zz1_TopNavigationMenu_9"
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
                      </TD>

                      
                      
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
                      <TD class=ms-siteactionsmenu id=siteactiontd><SPAN 
                        style="DISPLAY: none">
                       </SPAN>
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
                               <TABLE class=ms-summarycustombody >
                                <TBODY>
                                
<?



 $sql="select * from regiones where codigo=$reg ";
// echo $sql;
 $result=mysql_query($sql,$link);
 $row=mysql_fetch_array($result);
 $nombre=$row["nombre"];
 $inicio=$row["inicio"];
 $dirargedo=$row["argedo"];
// $anno=date("Y");
 $anno2=2011;
?>

                                
                                <TR>
                                <TD class=ms-vb style="PADDING-BOTTOM: 5px">&nbsp;</TD>
                                <TD class=ms-vb
                                style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px"><? echo $nombre ?></TD></TR>

                                


                                <TR>
                                <TD class=ms-vb style="PADDING-BOTTOM: 5px"><IMG
                                alt=""
                                src="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/square.gif">&nbsp;</TD>
                                <TD class=ms-vb
                                style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px">
                                 <A onfocus=OnLink(this) href="listareg2plan2.php?reg=<? echo $reg ?>&op=<? echo $op ?>&periodo=2013">2013</A>


                                </TD></TR>
                             <tr><td><br><br><br><br></td></tr>

<?
  $sql2="select max(folio1_folio) maximo from dpp_folio1 where folio1_region=$reg ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
 if (1==2) {
?>
                                
                            <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0>
                                <TBODY>
                                <TR class=ms-WPHeader>
                                <TD id=WebPartTitleWPQ2 title="Últimos Correlativos" style="WIDTH: 100%">
                                <H3
                                class="ms-standardheader ms-WPTitle"><NOBR><SPAN>Últimos Correlativos</SPAN><SPAN id=WebPartCaptionWPQ2></SPAN></NOBR></H3></TD>
                                <TD style="PADDING-RIGHT: 2px" align=right>
                                </TD></TR></TBODY></TABLE></TD></TR>



 <?

}
 ?>

 

                                </TBODY></TABLE></TD></TR></TBODY></TABLE>
                                <TABLE id=ECBItems style="DISPLAY: none" 
                                height=0 width=0>
                                <TBODY>
                                <TR>
                                <TD>Editar en explorador</TD>
                                <TD>/_layouts/images/icxddoc.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/formserver.aspx?XsnLocation={ItemUrl}&amp;OpenIn=Browser</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>FileType</TD>
                                <TD>xsn</TD>
                                <TD>255</TD></TR>
                                <TR>
                                <TD>Editar en explorador</TD>
                                <TD>/_layouts/images/icxddoc.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/formserver.aspx?XmlLocation={ItemUrl}&amp;OpenIn=Browser</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>ProgId</TD>
                                <TD>InfoPath.Document</TD>
                                <TD>255</TD></TR>
                                <TR>
                                <TD>Editar en explorador</TD>
                                <TD>/_layouts/images/icxddoc.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/formserver.aspx?XmlLocation={ItemUrl}&amp;OpenIn=Browser</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>ProgId</TD>
                                <TD>InfoPath.Document.2</TD>
                                <TD>255</TD></TR>
                                <TR>
                                <TD>Editar en explorador</TD>
                                <TD>/_layouts/images/icxddoc.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/formserver.aspx?XmlLocation={ItemUrl}&amp;OpenIn=Browser</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>ProgId</TD>
                                <TD>InfoPath.Document.3</TD>
                                <TD>255</TD></TR>
                                <TR>
                                <TD>Editar en explorador</TD>
                                <TD>/_layouts/images/icxddoc.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/formserver.aspx?XmlLocation={ItemUrl}&amp;OpenIn=Browser</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>ProgId</TD>
                                <TD>InfoPath.Document.4</TD>
                                <TD>255</TD></TR>
                                <TR>
                                <TD>Ver en el Explorador Web</TD>
                                <TD>/_layouts/images/ichtmxls.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/xlviewer.aspx?listguid={ListId}&amp;itemid={ItemId}&amp;DefaultItemOpen=1</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>FileType</TD>
                                <TD>xlsx</TD>
                                <TD>255</TD></TR>
                                <TR>
                                <TD>Ver en el Explorador Web</TD>
                                <TD>/_layouts/images/ichtmxls.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/xlviewer.aspx?listguid={ListId}&amp;itemid={ItemId}&amp;DefaultItemOpen=1</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>FileType</TD>
                                <TD>xlsb</TD>
                                <TD>255</TD></TR>
                                <TR>
                                <TD>Instantnea en Excel</TD>
                                <TD>/_layouts/images/ewr134.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/xlviewer.aspx?listguid={ListId}&amp;itemid={ItemId}&amp;Snapshot=1</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>FileType</TD>
                                <TD>xlsx</TD>
                                <TD>256</TD></TR>
                                <TR>
                                <TD>Instantnea en Excel</TD>
                                <TD>/_layouts/images/ewr134.gif</TD>
                                <TD>/Resoluciones-Oficios/_layouts/xlviewer.aspx?listguid={ListId}&amp;itemid={ItemId}&amp;Snapshot=1</TD>
                                <TD>0x0</TD>
                                <TD>0x1</TD>
                                <TD>FileType</TD>
                                <TD>xlsb</TD>
                                <TD>256</TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE>
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

<div  style="width:200px; height:50px; background-color:#ffffff; position:absolute;  top:140px; left:153px; content:''; z-index:4; " id="div2">

</div>

<div  style="width:600px; height:350px; background-color:#E0F8F7; position:absolute;  top:140px; left:153px; content:''; z-index:1; " id="div2">
<!-- <div  style="width:1030px; height:400px; background-color:#E0F8F7; position:absolute; top:1px; left:710px; overflow: scroll " id="div2"> -->

<?php

     $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total from compra_compra x
     left join compra_detorden y on x.compra_id=y.detorden_plan
     where x.compra_region='$reg' and x.compra_anno='$anno'
     group by x.compra_depto ";


/*
     $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total
from compra_compra x left join compra_detorden y on x.compra_id=y.detorden_plan left join compra_orden z on y.detorden_oc_id=z.oc_id
and year(y.detorden_fecha)='$anno'
where x.compra_region='$reg' and x.compra_anno='$anno' and z.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA'  group by x.compra_depto ";

*/

/*
     $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total
from compra_compra x left join compra_detorden y on x.compra_id=y.detorden_plan left join compra_orden z on y.detorden_oc_id=z.oc_id
and year(y.detorden_fecha)='$anno'
where x.compra_region='$reg' and x.compra_anno='$anno' and z.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA'  group by x.compra_depto ";
*/

//     $sql2="select x.compra_depto as uno, sum(y.detorden_monto) as total from compra_compra x left join compra_detorden y on x.compra_id=y.detorden_plan where x.compra_region='$reg' and  x.compra_origen='1' and x.compra_anno='$anno' group by x.compra_depto  ";
//     $sql2="select x.compra_depto as uno, sum(y.oc_monto) as  total from compra_compra x left join compra_orden y on x.compra_id=y.oc_compra_id  where x.compra_region='$reg' group by x.compra_depto ";
//     $sql2="select x.compra_ccosto as uno, sum(y.oc_monto) as  total from compra_compra x left join compra_orden y on x.compra_id=y.oc_compra_id and x.compra_id<='147'  group by x.compra_ccosto";
//     $sql2="select compra_ccosto as uno, sum(compra_total) as total from compra_compra  group by compra_ccosto";
//   $sql2 = "select x.logro_id as uno, count(z.tarea_proye_id) as total from ae_logro x left join ae_proyecto as y on x.logro_id=y.proye_logro_id left join ae_tarea as z on y.proye_id=z.tarea_proye_id and z.tarea_estado=2 group by x.logro_id ";

 //  echo $sql2;
     $res2 = mysql_query($sql2);
     $i=0;
     while ($ors = mysql_fetch_array($res2)) {
        $arrData[$i][1] = $ors['uno'];
        $arrData2[$i][1] = $ors['uno'];
        $arrData[$i][2] = $ors['total'];
        $i++;
    }


       $sql2="select compra_depto  as uno, sum(compra_total) as total from compra_compra where compra_region='$reg' and compra_anno='$anno'  group by compra_depto ";
//       $sql2="select compra_depto  as uno, sum(compra_total) as total from compra_compra where compra_region='$reg' and compra_origen='1' and compra_anno='$anno' group by compra_depto ";
//       $sql2="select x.compra_ccosto as uno, sum(z.eta_monto) as     total from compra_compra x left join compra_orden y on x.compra_id=y.oc_compra_id left join dpp_etapas as z on y.oc_numero=z.eta_nroorden and z.eta_estado>=7 and year(eta_fechache)>=2013 group by x.compra_ccosto";
//     $sql2 = "select x.logro_id as uno, count(z.tarea_proye_id) as total from ae_logro x left join ae_proyecto as y on x.logro_id=y.proye_logro_id left join ae_tarea as z on y.proye_id=z.tarea_proye_id and z.tarea_estado=1 group by x.logro_id ";
//     echo "<br><br><br><br><br><br><br>".$sql2;
     $res2 = mysql_query($sql2);
     $i=0;
     while ($ors = mysql_fetch_array($res2)) {
        $arrData[$i][3] = $ors['total'];

        if ($arrData[$i][3]<$arrData[$i][2]) {
           $arrData[$i][3]=0;
        }
        if ($arrData[$i][3]>$arrData[$i][2]) {
           $arrData[$i][3]=$arrData[$i][3]-$arrData[$i][2];
        }

//        $arrData[$i][2] = $arrData[$i][2]-$ors['total'];
        $i++;
    }
                        //Initialize <chart> element
                        $strXML = "<chart palette='2' caption='Ejecucion Plan de Compra '  xAxisName='' yAxisName='Estado' numberPrefix='N°' showValues='10' stack100Percent='1' showPercentValues='0'>";
//                        $strXML = "<chart caption='Tareas Vigentes' labelDisplay='ROTATE' slantLabels='1'  numberPrefix='' formatNumberScale='0' rotateValues='1' placeValuesInside='0' decimals='0'  numberSuffix=' '>";
//                        $strXML .= "<set label='" . $ors['uno'] . "' value='" . $ors['total'] . "' link='" . urlencode("Detailed.php?FactoryId=" . $ors['FactoryId']) . "'/>";

                        //Initialize <categories> element - necessary to generate a multi-series chart
                        $strCategories = "<categories>";

                        //Initiate <dataset> elements
                        $strDataCurr = "<dataset seriesName='Ejecutada'>";
                        $strDataPrev = "<dataset seriesName='Pendiente'>";

                        //Iterate through the data
                        $j=0;
                        foreach ($arrData as $arSubData) {
                            //Append <category name='...' /> to strCategories
                            $strCategories .= "<category name='" . $arSubData[1] . "' />";
                            //Add <set value='...' /> to both the datasets
                            $strDataCurr .= "<set value='" . $arSubData[2] . "' link='" . urlencode("listareg2plan2.php?unidad=" . $arrData2[$j][1]) . "&reg=".$reg."&op=".$op."&periodo2=".$periodo. "&anno=".$anno."'/>";;
                            $strDataPrev .= "<set value='" . $arSubData[3] . "' link='" . urlencode("listareg2plan2.php?unidad=" . $arrData2[$j][1]) . "&reg=".$reg."&op=".$op."&periodo2=".$periodo. "&anno=".$anno."'/>";
                            $j++;
                        }


                        //Close <categories> element
                        $strCategories .= "</categories>";

                        //Close <dataset> elements
                        $strDataCurr .= "</dataset>";
                        $strDataPrev .= "</dataset>";

                        //Assemble the entire XML now
                        $strXML .= $strCategories . $strDataCurr . $strDataPrev . "</chart>";

                        //Create the chart - MS Column 3D Chart with data contained in strXML
                        echo renderChart("../seguimientos/sitio2/grafico/StackedBar3D.swf", "", $strXML, "productSales", 650, 350, false, false);
                        ?>

                    </div>
<?

if ($unidad<>'') {
?>
<div  style="width:530px; height:600px; background-color:#ffffff; position:absolute;  top:140px; left:810px; " id="div4">


<img src="../seguimientos/sitio2/images/red.png" alt="PENDIENTE" height="17" width="19" border=0> PENDIENTE    &nbsp;&nbsp;&nbsp;&nbsp;
<img src="../seguimientos/sitio2/images/green.png" alt="CUMPLIDA" height="17" width="19" border=0> CUMPLIDA
&nbsp;&nbsp;&nbsp;&nbsp;
<img src="../seguimientos/sitio2/images/yellow.png" alt="CANCELADA" height="17" width="19" border=0> CANCELADA

<table id="tablesorter-demo2" class="tablesorter" border="1" cellpadding="0" cellspacing="1">
 <thead>
 <tr>
   <td class="Estilo2mc" colspan=9 align="center">PLAN DE COMPRA DE <? echo $unidad; ?></td>
 </tr>
 <tr>
   <th class="Estilo2mc">N°</th>
   <th class="Estilo2mc" ><a href="compra_grafico.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=1&anno=<? echo $anno; ?>" class="link"  >Nombre</a></th>
   <th class="Estilo2mc"><a href="compra_grafico.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=2&anno=<? echo $anno; ?>" class="link"  >Total</a></th>
   <th class="Estilo2mc">Vigente</th>
   <th class="Estilo2mc">Monto OC</th>
   <th class="Estilo2mc">Saldo</th>
   <th class="Estilo2mc" width="40">% OC</th>
   <th class="Estilo2mc"><a href="compra_grafico.php?unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=3&anno=<? echo $anno; ?>" class="link"  >Mes</a></th>
   <th class="Estilo2mc">Est.</th>
   <th class="Estilo2mc">Prog.</th>
 </tr>
</thead>
<tbody>

<?
    $order='';
    if ($orden==1) {
        $order=" order by compra_nombre";
     }
     if ($orden==2) {
        $order=" order by compra_total";
     }
     if ($orden==3) {
        $order=" order by compra_mes2";
     }

     $cont=1;
     $sql3="select * from compra_compra where compra_depto='$unidad' and compra_anno=$anno  $order ";
//     $sql3="select * from compra_compra where compra_depto='$unidad' and compra_region='$reg' and compra_anno=$anno $order ";
//     $sql3="select * from compra_compra where compra_ccosto='$unidad' and compra_id<='147'";
//   echo $sql3;
     $res3 = mysql_query($sql3);
     $i=0;
     while ($ors = mysql_fetch_array($res3)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo2mc";
       } else {
          $estilo2="Estilo2mcblanco";
       }
     $compraid2=$ors['compra_id'];
     $suma=0;

     if ($ors['compra_estado']=='PENDIENTE') {
         $imagen="red.png";
         $imagen2="PENDIENTE";
     }
     if ($ors['compra_estado']=='CUMPLIDA') {
         $imagen="green.png";
         $imagen2="CUMPLIDA";
     }
     if ($ors['compra_estado']=='CANCELADA') {
         $imagen="yellow.png";
         $imagen2="CANCELADA";
     }
     
     if ($ors['compra_origen']=='1') {
         $origen="SI";
     }
     if ($ors['compra_origen']=='0') {
         $origen="NO";
     }


     $sql3b="select sum(y.detorden_monto) as total2, count(x.oc_compra_id) as suma from compra_orden x, compra_detorden y where y.detorden_plan ='$compraid2' and x.oc_id=y.detorden_oc_id  and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' ";
//     $sql3b="select sum(oc_monto) as total2,count(oc_compra_id) as suma from compra_orden where oc_compra_id='$compraid2' and oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' ";
//     echo $sql3b;
     $res3b = mysql_query($sql3b);
     $i=0;
     $orsb = mysql_fetch_array($res3b);
     $suma=$orsb['suma'];
     $total2=$orsb['total2'];
     $porce2= $total2*100/$ors['compra_vigente'];
     $total31=$total31+$ors['compra_vigente'];


?>
 <tr>
   <td class="<? echo $estilo2 ?>"><? echo $cont; ?></td>
   <td class="<? echo $estilo2 ?>"><a href="listareg2plan2.php?reg=<? echo $reg; ?>&unidad=<? echo $unidad; ?>&compraid=<? echo $ors['compra_id']; ?>&orden=<? echo $orden; ?>&anno=<? echo $anno; ?>" class="link"  ><? echo $ors['compra_nombre']; ?></a></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($ors['compra_total']),0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($ors['compra_vigente']),0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($total2),0,',','.'); ?>&nbsp;</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($ors['compra_vigente']-$total2),0,',','.'); ?>&nbsp;</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format(trim($porce2),0,',','.'); ?>%</td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['compra_mes']; ?></td>
   <td class="<? echo $estilo2 ?>"><img src="../seguimientos/sitio2/images/<? echo $imagen ?>" alt="<? echo $imagen2 ?>" height="17" width="19" border=0> (<? echo $suma ?>)</td>
   <td class="<? echo $estilo2 ?>"><? echo $origen; ?></td>

 </tr>


<?
      $cont++;
    }

?>


</tbody>
</table>



</div>

<?
}

if ($compraid<>'' ) {
?>



<div  style="width:610px; height:600px; background-color:#ffffff; position:absolute;  top:510px; left:180px; " id="div4">
<table border="1"   width="100%">
<thead>
<?
    $sql3c="select * from compra_compra where compra_id='$compraid'";
//     echo $sql3c;
     $res3c = mysql_query($sql3c);
     $orsc = mysql_fetch_array($res3c);
     $nombrecompra=$orsc['compra_nombre'];
?>
 <tr>
   <td class="Estilo2mc" colspan=7 align="center">ORDENES DE COMPRA "<? echo $nombrecompra ?>"</td>
 </tr>

 <tr>
   <td class="Estilo2mc" >N°</td>
   <td class="Estilo2mc" >Nombre</td>
   <td class="Estilo2mc">N° OC</td>
   <td class="Estilo2mc">Monto OC</td>
   <td class="Estilo2mc">Monto Eje</td>
   <td class="Estilo2mc">% Eje</td>
   <td class="Estilo2mc">Estado</td>
 </tr>
</thead>
<tbody>
<?
     $cont=1;
     $sql3="select * from compra_orden x, compra_detorden y where  y.detorden_plan='$compraid' and y.detorden_oc_id=x.oc_id and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA'";
//     $sql3="select * from compra_orden where oc_compra_id='$compraid'";
//   echo $sql3;
     $res3 = mysql_query($sql3);
     $i=0;
     while ($ors = mysql_fetch_array($res3)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo2mc";
       } else {
          $estilo2="Estilo2mcblanco";
       }
       
       
     $sumaoc=$sumaoc+$ors['detorden_monto'];

     $ocnumero2=$ors['oc_numero'];
     $ocetaid=$ors['oc_eta_id'];
     $sql3b="select sum(eta_monto) as total2,count(eta_nroorden) as suma from dpp_etapas where eta_nroorden='$ocnumero2' and eta_estado=8";
//     echo $sql3b."<br>";
     $res3b = mysql_query($sql3b);
     $i=0;
     $orsb = mysql_fetch_array($res3b);
     $total2=$orsb['total2'];

     $compramontototal=$ors['oc_monto'];
     $porcentaje=$ors['detorden_monto']*100/$compramontototal;
     $asterisco="";
     if ($ors['oc_monto']>$ors['detorden_monto']) {
         $asterisco="*";
         $total2=$total2*50/100;
     }  else {
//         $total2=$orsb['total2'];
     }

     $suma=$orsb['suma'];
     $sumaoc2=$sumaoc2+$total2;
     $porce1=$total2*100/$ors['detorden_monto'];


?>
 <tr>
   <td class="<? echo $estilo2 ?>"><? echo $cont; ?></td>
   <td class="<? echo $estilo2 ?>"><a href="listareg2plan2.php?reg=<? echo $reg; ?>&unidad=<? echo $unidad; ?>&compraid=<? echo $compraid; ?>&orden=<? echo $orden; ?>&ocnumero=<? echo $ors['oc_numero']; ?>&anno=<? echo $anno; ?>" class="link"  ><? echo $ors['oc_nombre']; ?></a></td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['oc_numero']; ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($ors['detorden_monto'],0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($total2,0,',','.'); ?><? echo $asterisco ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($porce1,0,',','.'); ?>%</td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['oc_estado']; ?>(<? echo $suma; ?>)</td>

 </tr>


<?
      $cont++;
    }

?>
 <tr>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>">Total</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($sumaoc,0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($sumaoc2,0,',','.'); ?></td>
 </tr>

  </tbody>
</table>
<hr>
<?
if ($ocnumero<>'') {




?>
<table border="1"   width="100%">
<thead>
 <tr>
   <td class="Estilo2mc" colspan=7 align="center">FACTURAS O/C N° <? echo $ocnumero; ?></td>
 </tr>
 <tr>
   <td class="Estilo2mc">N°</td>
   <td class="Estilo2mc">Proveedor</td>
   <td class="Estilo2mc">Rut</td>
   <td class="Estilo2mc">Numero</td>
   <td class="Estilo2mc">Fecha Pago</td>
   <td class="Estilo2mc">Monto </td>
   <td class="Estilo2mc">Estado</td>
 </tr>
</thead>
<tbody>
<?
     $cont=1;
     $sql3="select * from dpp_etapas where eta_nroorden='$ocnumero'";
//   echo $sql3;
     $res3 = mysql_query($sql3);
     $i=0;
     while ($ors = mysql_fetch_array($res3)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo2mc";
       } else {
          $estilo2="Estilo2mcblanco";
       }
     $sumaeta=$sumaeta+$ors['eta_monto'];
     $estado=$ors['eta_estado'];

     if ($estado==1) {
         $estadotxt="OF. DE PARTES";
     }
     if ($estado==2) {
         $estadotxt="ADMINISTRACIÓN";
     }
     if ($estado==3) {
         $estadotxt="PROCESO SIGFE";
     }
     if ($estado==5) {
         $estadotxt="CONTABILIDAD";
     }
     if ($estado==6) {
         $estadotxt="CONTABILIDAD";
     }
     if ($estado==7) {
         $estadotxt="PAGO PROVEEDOR";
     }
     if ($estado==8) {
         $estadotxt="PAGADO";
     }
     if ($estado==9) {
         $estadotxt="CADUCADO";
     }
     if ($estado==15) {
         $estadotxt="RECHAZADO";
     }

     $periodo=substr($ors['eta_fecha_fac'],0,4);
     $region=$ors['eta_region'];
?>
 <tr>
   <td class="<? echo $estilo2 ?>"><? echo $cont; ?></td>
   <td class="<? echo $estilo2 ?>"><a href="../argedo/ficha2f.php?reg=<? echo $reg; ?>&op=5&periodo=<? echo $periodo; ?>&id=<? echo $ors['eta_id'] ?>" class="link"  target="_blank"><? echo $ors['eta_cli_nombre']; ?></a></td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['eta_rut']; ?>-<? echo $ors['eta_dig']; ?></td>
   <td class="<? echo $estilo2 ?>"><? echo $ors['eta_numero']; ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo $ors['eta_fechache']; ?></td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format( $ors['eta_monto'],0,',','.'); ?></td>
   <td class="<? echo $estilo2 ?>"><? echo $estadotxt; ?></td>
 </tr>


<?
      $cont++;
    }

?>
 <tr>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>"></td>
   <td class="<? echo $estilo2 ?>">Total</td>
   <td class="<? echo $estilo2 ?>" align="right"><? echo number_format($sumaeta,0,',','.'); ?></td>

 </tr>

  </tbody>
</table>
<?
}
?>


</div>

<?
}
?>

