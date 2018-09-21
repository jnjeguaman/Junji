<?
//header("Content-Type: application/vnd.ms-excel; name='listador'");
//header("Content-Disposition: attachment; filename=reportes.xls");

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
if ($op==5) {
    $titulo="Correspondencia Despachada";
}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML dir=ltr xmlns:o = "urn:schemas-microsoft-com:office:office"><HEAD><TITLE><? echo $titulo ?></TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META http-equiv=Expires content=0>

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



<TABLE class=ms-main height="100%" cellSpacing=0 cellPadding=0 width="100%"  border=0>
  <TBODY>
  <TR>
    <TD>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=ms-globalbreadcrumb colSpan=4>
            <TABLE class=ms-globalleft height="100%" cellSpacing=0 cellPadding=0>
              <TBODY>
              <TR>
                <TD class=ms-globallinks style="PADDING-TOP: 2px" vAlign=center height="100%">
                </TD></TR></TBODY></TABLE>
            <TABLE class=ms-globalright height="100%" cellSpacing=0 cellPadding=0>
              <TBODY>
              <TR>
                <TD class=ms-globallinks style="PADDING-RIGHT: 6px; PADDING-LEFT: 3px" vAlign=center></TD>
                <TD class=ms-globallinks vAlign=center><SPAN style="DISPLAY: none">


                </TD>
                <TD class=ms-globallinks style="PADDING-RIGHT: 3px; PADDING-LEFT: 1px"></TD>
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
                            <TD
                    class=ms-globallinks></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
                </TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD class=ms-globalTitleArea>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD class=ms-titleimagearea id=GlobalTitleAreaImage><IMG id=ctl00_onetidHeadbnnr0 style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"
            alt="" 
            src="logo.png"></TD>
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
          <TD class=ms-bodyareacell vAlign=top>
            <TABLE class=ms-propertysheet id=MSO_ContentTable height="100%"  cellSpacing=0 cellPadding=0 width="100%" border=0>
              <td width="100%"><TBODY>
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
                              <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                                <TBODY>
                                <TR>
                                <TD id=MSOZoneCell_WebPartWPQ1 vAlign=top>
                                <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 TOPLEVEL>
                                <TBODY>
                                <TR>
                                <TD vAlign=top>
                                <DIV id=WebPartWPQ1 allowExport="false" allowDelete="false" width="100%" HasPers="false" >
                                <TABLE class=ms-summarycustombody style="MARGIN-BOTTOM: 5px" cellSpacing=0 cellPadding=0 summary=Defensorias border=0 width="100%">
                                <TBODY>
                                <TR><TD>
                                  <A onfocus=OnLink(this) href="listadoc2.php?reg=<? echo $reg ?>&op=<? echo $op ?>&periodo=<? echo $periodo ?>">VOLVER</a>
                                </TD></TR>
                                
                                <TR><TD>
                                <br>
                                </TD></TR>
                                <TR>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px">
                                <? echo $nombre ?>
                                </TD></TR>

                                
                               </table>
                               <TABLE cellSpacing=0 cellPadding=0 width="70%" border=0 TOPLEVEL>
                                
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
$transparencia=$_GET["transparencia"];

?>
                                
</form>
                                <TR>
<form method="get" action="listadoc3.php">
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" valing="middle">FECHA DOCUMENTO</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" colspan="3">
<input type="text" name="fecha1" size="12" value="<? echo $fecha1 ?>" id="f_date_c1" readonly="1" class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

                                a
<input type="text" name="fecha2" size="12" value="<? echo $fecha2 ?>" id="f_date_c2" readonly="1" class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<input type="hidden" name="reg" value="<? echo $reg ?>" >
<input type="hidden" name="op" value="<? echo $op ?>" >
<input type="hidden" name="periodo" value="<? echo $periodo ?>" >

                                </TD></TR>
                                <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >MATERIA</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" ><input type="text" name="materia" class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" size="70" value="<? echo $materia ?>">
                                </tr>
                                <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >FOLIO</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" ><input type="text" name="folio" class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" size="40" value="<? echo $folio ?>">
                                </tr>
                                
                                <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >TRANSPARENCIA</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >
                                   <input type="checkbox" name="transparencia"  value="1" <? if ($transparencia=='1') echo 'checked' ?> > SI
                                </td>
                                </tr>
                                
                               <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >ARCHIVO ADJUNTO</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >
                                   <input type="radio" name="adju"  value="SI" <? if ($adju=='SI') echo 'checked' ?> > SI
                                   <input type="radio" name="adju"  value="NO" <? if ($adju=='NO') echo 'checked' ?> > NO
                                </td>
                                </tr>


<?
if ($op==2) {
?>
                               <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >TRAMITE</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >
                                   <input type="radio" name="tramite"  value="SI" <? if ($tramite=='SI') echo 'checked' ?> > SI
                                   <input type="radio" name="tramite"  value="NO" <? if ($tramite=='NO') echo 'checked' ?> > NO
                                </td>
                                </tr>


<?
}
if ($op==3 or $op==4) {

?>
                              <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >REMITE</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >
                                    <input type="text" name="remite" class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" size="40" value="<? echo $remite ?>">
                                </td>
                                </tr>
                              <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >TIPO DOCUMENTO</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >
                                <select name="tipodoc1" class="Estilo1">
                                    <option value="">Seleccione...</option>

                                 <?
                                  $sql2 = "Select * from argedo_tipodoc order by tipodoc_nombre ";
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["tipodoc_nombre"] ?>" <? if ($row2["tipodoc_nombre"]==$tipodoc1) echo 'selected=selected'  ?> ><? echo $row2["tipodoc_nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>

                                </td>
                                </tr>



<?
}
?>

                               <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >DESTINATARIO</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" ><input type="text" name="destinatario" class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" size="40" value="<? echo $destinatario ?>">
                                </tr>
<?
if ($op==2) {
?>
                                <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" >TIPO DOCUMENTO</TD>
                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" colspan="6" >
                                   <input type="radio" name="tipodoc2"  value="1" <? if ($tipodoc2=='1') echo 'checked' ?>> RESOLUCION EXENTA
                                   <input type="radio" name="tipodoc2"  value="6" <? if ($tipodoc2=='6') echo 'checked' ?>> RES EX RR.HH (SIAPER)
                                   <input type="radio" name="tipodoc2"  value="2" <? if ($tipodoc2=='2') echo 'checked' ?>> RESOLUCION AFECTA CON TOMA
                                   <input type="radio" name="tipodoc2"  value="3" <? if ($tipodoc2=='3') echo 'checked' ?>> OFICIOS ORDINARIOS
                                   <input type="radio" name="tipodoc2"  value="7" <? if ($tipodoc2=='7') echo 'checked' ?>> OFICIO CIRCULAR
                                   
                                </tr>
<?
}
?>
                                <tr>
                                <td class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" colspan="4" >
                                <input type="submit" name="boton" class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px" value="   REALIZAR CONSULTA DOCUMENTOS ARGEDO AÑO <? echo $periodo ?>  ">
                                 <A onfocus=OnLink(this) href="listadoc3.php?reg=<? echo $reg ?>&op=<? echo $op ?>&periodo=<? echo $periodo ?>" class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px">LIMPIAR</a>
                                </TD>




                                <TR>
</form>

                                </TD></TR>
                                <tr><td colspan=3>
                                    <A onfocus=OnLink(this) href="listadoc4.php?reg=<? echo $reg ?>&op=<? echo $op ?>&periodo=<? echo $periodo ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&materia=<? echo $materia ?>&folio=<? echo $folio ?>&adju=<? echo $adju ?>&tramite=<? echo $tramite ?>&destinatario=<? echo $destinatario ?>&tipodoc1=<? echo $tipodoc1 ?>&tipodoc2=<? echo $tipodoc2 ?>" >EXPORTAR A EXCEL</a>
                                 <br><br>
                                 </td></tr>
                                <TD class=ms-vb2>
                                <TR>


                                <TD class=ms-vb style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px"></TD>
                                </TR>
                                    </table>
                                    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 TOPLEVEL>

                                 <tr class=ms-alternating>
                                <TD class=ms-vb2>
<?
if ($op==2) {
    $pre="docs";
    $select=" docs_id, docs_archivo, docs_folio, docs_materia, docs_documento, docs_fecha, docs_anno, docs_destinatario, docs_area, docs_subarea, docs_defensoria, docs_tramite, docs_obs, docs_fechasis, docs_diferencia, docs_servidor, docs_tipo";
?>

                                <TABLE class=ms-unselectedtitle >
                                   <TBODY><TR><TD class=ms-vb width="100%">Adjunto </TD> </TR></TBODY>
                                </TABLE>
                                </TD>
                                <TD class=ms-vb2 width="20"><DIV>Numero Documento</DIV></a></TD>
                                <TD class=ms-vb2 width="70">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Materia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></TD>
                                <TD class=ms-vb2>Tipo Documento</TD>
                                <TD class=ms-vb2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Documento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2><DIV>Año&nbsp;</DIV></TD>
                                <TD class=ms-vb2><NOBR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destinatario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</NOBR></TD>
                                <TD class=ms-vb2><NOBR>Area</NOBR></TD>
                                <TD class=ms-vb2>Subareas</TD>
                                <TD class=ms-vb2>Region</TD>
                                <TD class=ms-vb2><SPAN>En tramite</SPAN></TD>
                                <TD class=ms-vb2>Observaciones</TD>
                                <TD class=ms-vb2>Creado</TD>
                                <TD class=ms-vb2>Diferencia</TD>
                                <TR class="">
                                 <TD class=ms-vb2>
<?
}
?>

<?
if ($op==3) {
      $pre="reci";
      $select=" reci_id, reci_archivo, reci_folio, reci_materia, reci_tipodoc, reci_numero, reci_obs,  reci_remite, reci_fecha_doc, reci_anno, reci_destinatario, reci_defensoria, reci_fechasys, reci_jornada ";
?>

                                <TABLE class=ms-unselectedtitle >
                                   <TBODY><TR><TD class=ms-vb width="100%">Adjunto </TD> </TR></TBODY>
                                </TABLE>
                                </TD>
                                <TD class=ms-vb2 width="20"><DIV>Numero Documento</DIV></a></TD>
                                <TD class=ms-vb2 width="70">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Materia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></TD>
                                <TD class=ms-vb2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo Documento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2>Numero_Externo</TD>
                                <TD class=ms-vb2 width="20"><DIV>Observacion</DIV></TD>
                                <TD class=ms-vb2><NOBR>Remitente</NOBR></TD>
                                <TD class=ms-vb2 width="50%">Fecha Documento</TD>
                                <TD class=ms-vb2 width="60">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Año&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
                                <TD class=ms-vb2>Destinatario</TD>
                                <TD class=ms-vb2>Region</TD>
                                <TD class=ms-vb2>Creado</TD>
                                <TD class=ms-vb2><NOBR>Jornada</NOBR></TD>
                                <TR class="">
                                 <TD class=ms-vb2>
<?
}



if ($op==4) {
      $pre="despa";
      $select=" despa_id, despa_archivo, despa_folio, despa_materia, despa_tipodoc, despa_obs, despa_destinatario, despa_fecha_doc, despa_anno, despa_numero, despa_remitente, despa_area, despa_defensoria, despa_fechasys, despa_tipodes ";
?>

                                <TABLE class=ms-unselectedtitle >
                                   <TBODY><TR><TD class=ms-vb width="100%">Adjunto</TD> </TR></TBODY>
                                </TABLE>
                                </TD>
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
                                <TD class=ms-vb2>Region</TD>
                                <TD class=ms-vb2>Creado</TD>
                                <TD class=ms-vb2><NOBR>Tipo Despacho </NOBR></TD>
                                <TR class="">
                                 <TD class=ms-vb2>
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
    $fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

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
if ($transparencia<>'') {
    $consultasql.=" and ".$pre."_transparencia='$transparencia' ";
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
//    $sql="select $select from $tabla where docs_defensoria='$reg' $consultasql order by docs_fecha desc, docs_folio desc";
    $sql="select $select from $tabla where docs_defensoria='$reg' and docs_anno='$periodo' $consultasql order by docs_fecha desc, docs_folio desc";
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
// echo $sql;

$sql2=$sql;
$resultado=mysql_query($sql);
$total_registros = mysql_num_rows($resultado);
$v_limite=" LIMIT $inicio, $registros ";
$sql .= $v_limite;
$total_paginas = ceil($total_registros / $registros);
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

    $row[13]=substr($row[13],8,2)."-".substr($row[13],5,2)."-".substr($row[13],0,4);

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



 if ($archivo<>''){
  $docsservidor=$row["1"];
    $prefijoarch="../archivos/docargedo/";
    if ($docsservidor==1) {
    $prefijoarch="../archivos/docargedo/";
    }
    if ($docsservidor==2) {
        $prefijoarch="";
    }

//echo "--------------->".$prefijoarch;
?>

                                
                                <TABLE class=ms-unselectedtitle >
                                   <TBODY><TR><TD class=ms-vb width="100%"><a href='<? echo $prefijoarch ?><? echo $row["1"]; ?>' target="_blank"><IMG height=14 alt="" src="attach.gif" width=8 border="0"></A> </TD> </TR></TBODY>
                                </TABLE>
<?
} else {
?>

                                <TABLE class=ms-unselectedtitle >
                                   <TBODY><TR><TD class=ms-vb width="100%"></TD> </TR></TBODY>
                                </TABLE>

<?
}
$var16='';
if ($row["16"]==6) {
  $var16='RR.HH';
}
if ($row["16"]==1 or $row["16"]==2 or $row["16"]==3) {
  $var16='Normal';
}

?>
                                </TD>
                                <TD class=ms-vb2 width="60"><A onfocus=OnLink(this) href="ficha2.php?reg=<? echo $reg ?>&op=<? echo $op ?>&periodo=<? echo $periodo ?>&id=<? echo $row["0"]; ?>&ori=2&pagina=<? echo $pagina ?>">
                                <DIV><? echo $row["2"]; ?><font color="<? echo $color?>"><? echo $nuevo ?></font></DIV></a></TD>
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


                                <TR class="<? echo $estilo ?>">
                                <TD class=ms-vb2>
<?
}
?>



<?

		echo "<tr><td colspan=8 class=ms-vb2><center>";

//		for ($i=1; $i<=$total_paginas; $i++)

if ($sw==1 or 1==1) {
  $inicio=1;
  $fin=$total_paginas;
  $limitesuperior=$pagina+5;
}


if ($total_paginas>=10 and $pagina>=5 and $limitesuperior<=$total_paginas) {
// echo "entra1";
 $fin=$pagina+5;
 $inicio=$pagina-5;
}
$limitesuperior2=$pagina+10;
if (($pagina>=1 and $pagina<=5) and $limitesuperior2<=$total_paginas ) {
 $fin=$limitesuperior2-$pagina;
 $inicio=1;
}

$limitesuperior3=$pagina+5;
if ($limitesuperior3>=$total_paginas and $total_paginas<>0 and $pagina>5) {
// echo "entra 3";
 $fin=$total_paginas;
 $total=10-($total_paginas-$pagina);
 if ($total<=$pagina) {
   $inicio=$pagina-(10-($total_paginas-$pagina));
 }

}





		if(($pagina - 1) > 0) {
			   echo "<a href='listadoc3.php?pagina=".($pagina-1)."&dos=$dos&numero=$numero&reg1=".$reg."&op=$op&periodo=$periodo&fecha1=$fecha1&fecha2=$fecha2&materia=$materia&folio=$folio&adju=$adju&tramite=$tramite&destinatario=$destinatario&tipodoc1=$tipodoc1&tipodoc2=$tipodoc2'>< Anterior</a> ";
		}



		for ($i=$inicio; $i<=$fin; $i++)
        {
			if ($pagina == $i)
				echo "<big>".$pagina."</big> ";
			else
				echo "<a href='listadoc3.php?pagina=$i&dos=$dos&numero=$numero&reg1=".$reg."&op=$op&periodo=$periodo&fecha1=$fecha1&fecha2=$fecha2&materia=$materia&folio=$folio&adju=$adju&tramite=$tramite&destinatario=$destinatario&tipodoc1=$tipodoc1&tipodoc2=$tipodoc2'>$i</a> ";
		}

		if(($pagina + 1)<=$total_paginas) {
 			    echo " <a href='listadoc3.php?pagina=".($pagina+1)."&dos=$dos&numero=$numero&reg1=$reg&op=$op&periodo=$periodo&fecha1=$fecha1&fecha2=$fecha2&materia=$materia&folio=$folio&adju=$adju&tramite=$tramite&destinatario=$destinatario&tipodoc1=$tipodoc1&tipodoc2=$tipodoc2'>Siguiente ></a>";
		}

		echo "</center></td></tr>";
        echo "<tr><td class=ms-vb2 colspan=4>Nº Paginas: $total_paginas, Total Registros: $total_registros </td></tr>";

 ?>


</TD></TR></TBODY></TABLE>&nbsp;
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
