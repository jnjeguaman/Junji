<?
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
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3  <? echo $clase5 ?> "
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
                            <TD style="WHITE-SPACE: nowrap"><A
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3"
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"
                              href="plancompra.php">Plan de Compras</A></TD></TR></TBODY></TABLE>
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
 $anno=date("Y");
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
<?
                          while ($inicio<=$anno and $op==2 ) {
                               if ($op==2 and $anno<=2008 ) {
                                   $link="http://grus:81/Resoluciones-Oficios/Lists/".$dirargedo."/".$anno.".aspx";
                               }
                               if ($op==2 and $anno>2011 and $reg<>15) {
                                   $link="listadoc2.php?reg=$reg&op=$op&periodo=$anno";
                               }
                               if ($op==2 and $anno>2009 and $reg==15) {
                                   $link="listadoc2.php?reg=$reg&op=$op&periodo=$anno";
                               }
                               if ($op==2 and $anno==2009 and $reg==15) {
                                   $link="listadoc2.php?reg=$reg&op=$op&periodo=$anno";
                               }


                               if ($op==2 and $anno==2009 and $dirargedo!='DN00' and $reg<>15) {
                                   $link="http://grus:81/Resoluciones-Oficios/".$dirargedo."/Lists/ResolucionesOficios/".$anno.".aspx";
                               }
                               if ($op==2 and $anno==2009 and $dirargedo=='DN00' and $reg==15) {
                                   $link="http://grus:81/".$anno."/default.aspx";
                               }
                               if ($op==2 and $anno==2010 and $reg<>15) {
                                   $link="http://grus:81/Resoluciones-Oficios/".$dirargedo."/Lists/ResolucionesOficios/".$anno.".aspx";
                               }
                               if ($op==2 and $anno==2011 and $reg<>15) {
                                   $link="http://grus:81/Resoluciones-Oficios/".$dirargedo."/Lists/ResolucionesOficios/".$anno.".aspx";
                               }


//http://grus:81/2009/default.aspx
?>
                                 <A onfocus=OnLink(this) href="<? echo $link ?>"><? echo $anno ?></A> -
<?
                             $anno--;
                          }
                          if ($op==3) {

                                   $link="listadoc2.php?reg=$reg&op=$op&periodo=$anno";
?>
                                   <A onfocus=OnLink(this) href="<? echo $link ?>"><? echo $anno ?></A>-
<?
                                   $link="http://grus:81/Correspondencia/".$dirargedo."/Lists/CorrespondenciaRecibida/AllItems.aspx";
?>
                                 <A onfocus=OnLink(this) href="<? echo $link ?>">2011</A>
<?

                          }
                          if ($op==4) {

                                   $link="listadoc2.php?reg=$reg&op=$op&periodo=$anno";
?>
                                   <A onfocus=OnLink(this) href="<? echo $link ?>"><? echo $anno ?></A>-
<?
                                   $link="http://grus:81/Correspondencia/".$dirargedo."/Lists/CorrespondenciaDespachada/AllItems.aspx";

?>
                                 <A onfocus=OnLink(this) href="<? echo $link ?>">2011</A>
<?


                          }

?>


                                </TD></TR>
                             <tr><td><br><br><br><br></td></tr>

<?
  $campo1="fol_reg".$reg."_1";
  $campo2="fol_reg".$reg."_2";
  $campo3="fol_reg".$reg."_3";
  $campo4="fol_reg".$reg."_4";
  $campo5="fol_reg".$reg."_5";
  $campo6="fol_reg".$reg."_6";
  $sql2="select $campo1, $campo2, $campo3, $campo4, $campo5, $campo6 from argedo_folios where fol_id=1 ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $folio1=$row2["0"];
  $folio2=$row2["1"];
  $folio3=$row2["2"];
  $folio4=$row2["3"];
  $folio5=$row2["4"];
  $folio6=$row2["5"];

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
if ($op==2) {
?>

                                <TR>
                                <TD class=ms-WPBorder vAlign=top>


                                
                                <DIV id=WebPartWPQ2 allowDelete="false" width="100%" HasPers="false" WebPartID="80174e08-b45a-4705-90ac-6ae2d5fca922">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 >
                                <TBODY>
                                <TR>
                                <TD>
                                <TABLE class=ms-listviewtable dir=none cellSpacing=0 cellPadding=1  width="100%" border=0 >
                                <TBODY>
                                <TR class=ms-viewheadertr vAlign=top><IFRAME
                                id=I4 title="Marco oculto para filtrar lista."
                                style="DISPLAY: none" name=I4
                                src="javascript:false;" width=0 height=0
                                FilterLink=""></IFRAME>
                                <TH class=ms-vh2 scope=col noWrap>&nbsp;
                                &nbsp;<SPAN class=style2>Resoluciones
                                Exentas</SPAN></TH></TR>
                                <TR class="">
                                <TD
                                class=style1><STRONG><? echo $folio1 ?></STRONG></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE>
                                <DIV
                                class=ms-PartSpacingVertical></DIV></TD></TR>
                                <TR>
                                <TD id=MSOZoneCell_WebPartWPQ3 vAlign=top>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 TOPLEVEL>
                                <TBODY>
                                <TR>
                                <TD class=ms-WPBorderBorderOnly vAlign=top>
                                
                                <DIV id=WebPartWPQ2 allowDelete="false" width="100%" HasPers="false" WebPartID="80174e08-b45a-4705-90ac-6ae2d5fca922">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 >
                                <TBODY>
                                <TR>
                                <TD>
                                <TABLE class=ms-listviewtable dir=none cellSpacing=0 cellPadding=1  width="100%" border=0 >
                                <TBODY>
                                <TR class=ms-viewheadertr vAlign=top><IFRAME
                                id=I4 title="Marco oculto para filtrar lista."
                                style="DISPLAY: none" name=I4
                                src="javascript:false;" width=0 height=0
                                FilterLink=""></IFRAME>
                                <TH class=ms-vh2 scope=col noWrap>&nbsp;
                                &nbsp;<SPAN class=style2>Resoluciones
                                Exentas (RR.HH.)</SPAN></TH></TR>
                                <TR class="">
                                <TD
                                class=style1><STRONG><? echo $folio6 ?></STRONG></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE>
                                <DIV
                                class=ms-PartSpacingVertical></DIV></TD></TR>
                                <TR>
                                <TD id=MSOZoneCell_WebPartWPQ3 vAlign=top>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 TOPLEVEL>
                                <TBODY>
                                <TR>
                                <TD class=ms-WPBorderBorderOnly vAlign=top>

                                
                                <DIV id=WebPartWPQ3 allowDelete="false" width="100%" HasPers="false" WebPartID="aa91eb31-a10d-4318-8901-6c24267b08f8">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 >

                                <TBODY>
                                <TR>
                                <TD>

                                <TABLE class=ms-listviewtable width="100%"
                                border=0 >
                                <TBODY>
                                <TR class=ms-viewheadertr vAlign=top><IFRAME
                                id=I5 title="Marco oculto para filtrar lista."
                                style="DISPLAY: none" name=I5
                                src="javascript:false;" width=0 height=0
                                FilterLink=""></IFRAME>
                                <TH class=ms-vh2 scope=col noWrap>&nbsp;
                                &nbsp;<SPAN class=style2>Resoluciones
                                Afectas</SPAN></TH></TR>
                                <TR class="">
                                <TD
                                class=style1><STRONG><? echo $folio2 ?></STRONG></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE>
                                <DIV
                                class=ms-PartSpacingVertical></DIV></TD></TR>
                                <TR>
                                <TD id=MSOZoneCell_WebPartWPQ1 vAlign=top>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 TOPLEVEL>
                                <TBODY>
                                <TR>
                                <TD class=ms-WPBorderBorderOnly vAlign=top>
                                <DIV id=WebPartWPQ1 allowDelete="false"
                                width="100%" HasPers="false"
                                WebPartID="d569422e-8654-4f45-8b60-a8d85fae9e2d">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 >

                                <TBODY>
                                <TR>
                                <TD>
                                <TABLE class=ms-listviewtable width="100%" border=0 >
                                <TBODY>
                                <TR class=ms-viewheadertr vAlign=top><IFRAME
                                id=I3 title="Marco oculto para filtrar lista."
                                style="DISPLAY: none" name=I3
                                src="javascript:false;" width=0 height=0
                                FilterLink=""></IFRAME>
                                <TH class=ms-vh2 scope=col
                                noWrap>&nbsp;&nbsp;<SPAN
                                class=style2>Oficios</SPAN></TH></TR>
                                <TR class="">
                                <TD
                                class=style1><STRONG><? echo $folio3 ?></STRONG></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>&nbsp;
                            </TD>

<?
}
if ($op==3) {
?>




                                <TR>
                                <TD id=MSOZoneCell_WebPartWPQ1 vAlign=top>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 TOPLEVEL>
                                <TBODY>
                                <TR>
                                <TD class=ms-WPBorderBorderOnly vAlign=top>
                                <DIV id=WebPartWPQ1 allowDelete="false"
                                width="100%" HasPers="false"
                                WebPartID="d569422e-8654-4f45-8b60-a8d85fae9e2d">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 >

                                <TBODY>
                                <TR>
                                <TD>
                                <TABLE class=ms-listviewtable width="100%" border=0 >
                                <TBODY>
                                <TR class=ms-viewheadertr vAlign=top><IFRAME
                                id=I3 title="Marco oculto para filtrar lista."
                                style="DISPLAY: none" name=I3
                                src="javascript:false;" width=0 height=0
                                FilterLink=""></IFRAME>
                                <TH class=ms-vh2 scope=col
                                noWrap>&nbsp;&nbsp;<SPAN
                                class=style2>Correspondencia Recibida</SPAN></TH></TR>
                                <TR class="">
                                <TD
                                class=style1><STRONG><? echo $folio4 ?></STRONG></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>&nbsp;
                            </TD>

<?
}
if ($op==4) {
?>




                                <TR>
                                <TD id=MSOZoneCell_WebPartWPQ1 vAlign=top>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 TOPLEVEL>
                                <TBODY>
                                <TR>
                                <TD class=ms-WPBorderBorderOnly vAlign=top>
                                <DIV id=WebPartWPQ1 allowDelete="false"
                                width="100%" HasPers="false"
                                WebPartID="d569422e-8654-4f45-8b60-a8d85fae9e2d">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%"
                                border=0 >

                                <TBODY>
                                <TR>
                                <TD>
                                <TABLE class=ms-listviewtable width="100%" border=0 >
                                <TBODY>
                                <TR class=ms-viewheadertr vAlign=top><IFRAME
                                id=I3 title="Marco oculto para filtrar lista."
                                style="DISPLAY: none" name=I3
                                src="javascript:false;" width=0 height=0
                                FilterLink=""></IFRAME>
                                <TH class=ms-vh2 scope=col
                                noWrap>&nbsp;&nbsp;<SPAN
                                class=style2>Correspondencia Despachada</SPAN></TH></TR>
                                <TR class="">
                                <TD
                                class=style1><STRONG><? echo $folio5 ?></STRONG></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>&nbsp;
                            </TD>

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
