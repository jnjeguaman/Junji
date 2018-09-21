<?
include("conex.php");
$link=conectarse();
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$fech1=$fecha1;
$fech2=$fecha2;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0048)http://grus:81/Resoluciones-Oficios/default.aspx -->
<HTML dir=ltr xmlns:o = "urn:schemas-microsoft-com:office:office"><HEAD><TITLE>Estadística y Operación</TITLE>

<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<LINK href="Inicio%20-%20Resoluciones%20&amp;%20Oficios_archivos/core.css" type=text/css rel=stylesheet>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>


</HEAD>
<BODY>



<TABLE class=ms-main height="100%" cellSpacing=0 cellPadding=0 width="100%" 
border=0>
  <TBODY>
  <TR>
    <TD>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=ms-globalbreadcrumb colSpan=4><SPAN id=TurnOnAccessibility 
            style="DISPLAY: none"> </SPAN>
            <TABLE class=ms-globalleft height="100%" cellSpacing=0 cellPadding=0>
              <TBODY>
              <TR>
                <TD class=ms-globallinks style="PADDING-TOP: 2px" vAlign=center height="100%">
                  </TD></TR></TBODY></TABLE>
            <TABLE class=ms-globalright height="100%" cellSpacing=0 cellPadding=0>
              <TBODY>
              <TR>
                <TD class=ms-globallinks style="PADDING-RIGHT: 6px; PADDING-LEFT: 3px" vAlign=center></TD>
                <TD class=ms-globallinks vAlign=center>
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
                            <TD class=ms-globallinks></TD>
                            <TD class=ms-globallinks></TD></TR>
                          </TBODY>
                         </TABLE>
                       </TD>
                      </TR>
                      </TBODY>
                    </TABLE>
                   </TD>
                <TD class=ms-globallinks vAlign=center>
        </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
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
            href="#">Estadística y Operación</A></H1></TD>
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
              <TR>
                <TD id=zz1_TopNavigationMenun0 onkeyup=Menu_Key(this) 
                onmouseover=Menu_HoverRoot(this) 
                  onmouseout=Menu_Unhover(this)><TABLE 
                  class="ms-topnav zz1_TopNavigationMenu_4" cellSpacing=0 
                  cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                    
                      <TD style="WHITE-SPACE: nowrap"><A
                        class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3 ms-topnavselected zz1_TopNavigationMenu_9"
                        style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"
                        href="estayopera.php">Estadística y Operación </A></TD>


                        </TR></TBODY></TABLE></TD>
                <TD style="WIDTH: 0px"></TD>
                <TD>
                  <TABLE class=zz1_TopNavigationMenu_5 cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD style="WIDTH: 0px"></TD>
                      <TD id=zz1_TopNavigationMenun1 onkeyup=Menu_Key(this) 
                      onmouseover=Menu_HoverStatic(this) 
                      onmouseout=Menu_Unhover(this)>
                        <TABLE class="ms-topnav zz1_TopNavigationMenu_4"
                        cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD style="WHITE-SPACE: nowrap"><A
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3"
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"
                              href="resyoficio.php">Resoluciones &amp; Oficios</A></TD></TR></TBODY></TABLE>
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
                              class="zz1_TopNavigationMenu_1 ms-topnav zz1_TopNavigationMenu_3"
                              style="FONT-SIZE: 1em; BORDER-TOP-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-BOTTOM-STYLE: none"
                              href="correemitida.php">Correspondencia Despachada</A></TD></TR></TBODY></TABLE>
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
                              href="facturas.php">Facturas,
                              Boletas y Doc. 
Valorados</A></TD></TR></TBODY></TABLE>
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
                                <tr>
                                <td>
                                Estadística y Operación <br>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                 <br>
                                </td>
                                </tr>

                                
                                <TR>
<form method="get" action="estayopera.php">
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" colspan="8">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c1" readonly="1">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

                                a
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha2 ?>" id="f_date_c2" readonly="1">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A onfocus=OnLink(this) href="http://grus:81/Paginas/Default.aspx" target="_blank">Informes Históricos</A>
</form>
                                </TD></TR>

                                <DIV id=WebPartWPQ1 allowExport="false" 
                                allowDelete="false" width="100%" HasPers="false" 
                                WebPartID="3ab7d2df-d206-4683-b9b8-5f0f4d74f092">
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                                border=0>

                                <TBODY>
                                <TR>
                                <TD>
<?
           if ($fecha1<>'' and $fecha2<>'') {
?>
                                <TABLE class=ms-summarycustombody  style="MARGIN-BOTTOM: 5px" cellSpacing=0
                                cellPadding=0 summary=Defensorias border=1 width="1100">
                                <TBODY>
                                <TR>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5" colspan="9" align="center">RESUMEN DEL <? echo $fech1 ?> AL <? echo $fech2 ?> </TD>
                                </TR>

                                <TR>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">Defensoría </TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">Tiempo Promedio Ingreso (días) </TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">Resolución Exenta</TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">Resolución Afecta</TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">Oficio</TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">TOTAL Documentos Oficiales</TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">Correspondencia Recibida</TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">Correspondencia Despachada</TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5">Facturas</TD>
                                </TR>


<?

 $fechaini= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
 $fechater= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

 $sql="select * from regiones  where activo=1 order by orden ";
// echo $sql;
 $result=mysql_query($sql,$link);
 while ($row=mysql_fetch_array($result)) {
    $codigo=$row["codigo"];
//    $sql3="SELECT avg(docs_diferencia) as diferencia FROM argedo_documentos WHERE docs_defensoria = '$codigo' AND docs_documento <> '' and  (docs_fechaparte>=$fechaini and docs_fechaparte<=$fechater) ";
    $sql3="SELECT avg(docs_diferencia) as diferencia FROM argedo_documentos WHERE docs_defensoria = '$codigo' AND docs_documento <> '' and  (docs_fecha>='$fechaini' and docs_fecha<='$fechater')";
//     echo $sql3;
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $diferencia=$row3["diferencia"];

    $sql3="SELECT count(reci_defensoria) as totalreci FROM argedo_recibida WHERE reci_defensoria = '$codigo' AND reci_documento <> '' and  ( reci_fecha_doc>='$fechaini' and  reci_fecha_doc<='$fechater')  ";
    // echo $sql3;
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $totalreci=$row3["totalreci"];

    $sql3="SELECT count(despa_documento) as totaldespa FROM argedo_despachada WHERE despa_defensoria = '$codigo' AND despa_documento <> '' and (despa_fecha_doc>='$fechaini' and  despa_fecha_doc<='$fechater')  ";
    // echo $sql3;
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $totaldespa=$row3["totaldespa"];
    
    $sql3="SELECT count(eta_tipo_doc) as totalfactura FROM dpp_etapas WHERE eta_tipo_doc='Factura' and eta_region = '$codigo' and (eta_fecha_fac>='$fechaini' and  eta_fecha_fac<='$fechater')  ";
    // echo $sql3;
    $result3=mysql_query($sql3,$link);
    $row3=mysql_fetch_array($result3);
    $totalfactura=$row3["totalfactura"];



     ?>

                                <TR>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" bgcolor="#81DAF5"><? echo $row["nombre"]; ?> </TD>
                                  <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px"><? echo $diferencia ?> </TD>


     <?

    $sql2="SELECT docs_documento, count( docs_documento ) AS total FROM argedo_documentos WHERE docs_defensoria = '$codigo' AND docs_documento <> '' and  (docs_fecha>='$fechaini' and docs_fecha<='$fechater') GROUP BY docs_documento ORDER BY docs_documento ";
    // echo $sql2;
    $result2=mysql_query($sql2,$link);
    $cont1=1;
    while ($row2=mysql_fetch_array($result2)) {

?>

       <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px"><? echo $row2[1]; ?> </TD>
<?
        $suma1=$suma1+$row2[1];
   }
?>
       <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px"><? echo $suma1; ?> -</TD>
       <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px"><? echo $totalreci ?> </TD>
       <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px"><? echo $totaldespa ?> </TD>
       <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px"><? echo $totalfactura ?> </TD>
                                </TR>
                                


<?
$suma1=0;
}
?>
</TBODY></TABLE></TD></TR></TBODY></TABLE>

<?
}
?>

&nbsp;
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
