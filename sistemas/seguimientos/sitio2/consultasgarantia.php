<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
  ?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("Y-m-d");
?>
<html>
<head>
<title>Defensoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
  margin-left: 0px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
}
.Estilo1 {
  font-family: Verdana;
  font-weight: bold;
  font-size: 10px;
  color: #003063;
  text-align: left;
}
.Estilo1b {
  font-family: Verdana;
  font-weight: bold;
  font-size: 8px;
  color: #003063;
  text-align: center;
}
.Estilo1c {
  font-family: Verdana;
  font-weight: bold;
  font-size: 8px;
  color: #003063;
  text-align: right;
}
.Estilo2 {
  font-family: Verdana;
  font-size: 10px;
  text-align: left;
}
.Estilo2b {
  font-family: Verdana;
  font-size: 9px;
  text-align: left;
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
.Estilo4 {
  font-size: 10px;
  font-weight: bold;
}
.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif; 
font-size: 14px; font-weight: bold; }
-->
</style>
<link rel="stylesheet" type="text/css" href="select_dependientes.css">
<script type="text/javascript" src="select_dependientes.js"></script>
<script type="text/javascript" src="ajaxclient.js"></script>
</head>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  

<body>
    <div class="navbar-nav ">

    <div class="container">

        <div class="navbar-header">







    <?

    require("inc/top.php");

    ?>



   </div>

</div>

</div>





   <div class="container">

         <div class="row">

          <div class="col-sm-2 col-lg-2">

            <div class="dash-unit2">



      <?

      require("inc/menu_1.php");

      ?>



            </div>

      </div>



        <div class="col-sm-10 col-lg-10">

                   <div class="dash-unit2">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">CONSULTAS GARANTÍA</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$rut=$_GET["rut"];
$documento=$_GET["documento"];
$nombre=$_GET["nombre"];
$glosa=$_GET["glosa"];
$folio=$_GET["folio"];
$estado=$_GET["estado"];
$licitacion=$_GET["licitacion"];

?>




     </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped bbyss">
       <form name="form1" action="consultasgarantia.php" method="get">
                         <tr>
                             <td  valign="top" class="Estilo1">Región</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==0) {
                                    $sql2 = "Select * from regiones ";
                                    echo '<option value="0">Todas</option>';
                                  } else
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["codigo"] ?>" <? if ($row2["codigo"]==$region) echo "selected=selected" ?> ><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Fechas de Recepción</td>
                             <td colspan=3 class="Estilo1">
                                  <input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c2" readonly="1">
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

                                  a
                                  <input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha2 ?>" id="f_date_c3" readonly="1">
<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c3",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

                              </td>

                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Rut Proveedor </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>"  onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"   > * Rut sin puntos, sin Digito verificador
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Nombre Proveedor </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="40" value="<? echo $nombre ?>">
                             </td>
                           </tr>

                            <tr>
                             <td  valign="top" class="Estilo1">Nro. Documento  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="documento" class="Estilo2" size="11" value="<? echo $documento ?>">
                             </td>
                           </tr>

                           <tr>
                             <td  valign="top" class="Estilo1">Id Licitación  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="licitacion" class="Estilo2" size="11" value="<? echo $licitacion ?>">
                             </td>
                           </tr>

                            <tr>
                             <td  valign="top" class="Estilo1">Glosa </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="glosa" class="Estilo2" size="40" value="<? echo $glosa ?>">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Folio  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="folio" class="Estilo2" size="11" value="<? echo $folio ?>">
                             </td>
                           </tr>
          <tr>
                             <td  valign="top" class="Estilo1">Estado  </td>
                             <td class="Estilo1" colspan=3>
                              <select name="estado" class="Estilo1">
                                 <option value="">Seleccione...</option>
                                 <option value="1">1.- Recepción</option>
                                 <option value="2">2.- Custodia</option>
                                 <option value="3">3.- Administración</option>
                                 <option value="4">4.- Por Devolver</option>
                                 <option value="5">5.- Devuelto</option>
                                 <option value="9">6.- Rechazado</option>
                                 <option value="7">7.- Cobrado</option>
                                 <option value="8">8.- Por Cobrar</option>
                               </select>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="consultasgarantia.php"> Limpiar </a> </td>
                             

                           </tr>

                        </form>

                      </td>
                      
                      </table>
                      <table border=1 class="table table-striped bbyss table-hover">
                      <tr>
                      <td class="Estilo1" colspan=11><a href="reportesexcel2.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&documento=<? echo $documento ?>&nombre=<? echo $nombre ?>&glosa=<? echo $glosa ?>&nombre=<? echo $nombre ?>&folio=<? echo $folio ?>&estado=<? echo $estado ?>&licitacion=<?php echo $licitacion ?>" class="link" > Exportar a Excel</a>
                      </td>
                      </tr>
                        <tr>
                         <td class="Estilo1b">Nun</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Id Licitacion</td>
                         <td class="Estilo1b">Recep.</td>
                         <td class="Estilo1b">Monto</td>
                         <td class="Estilo1b">Nro. Doc.</td>
                         <td class="Estilo1b">Folio</td>
                         <td class="Estilo1b">Estado</td>
                         <td class="Estilo1b">Fecha Vencimiento</td>
                         <td class="Estilo1b">Ver </td>
                        </tr>

<?
$sw=0;

   $sql="select * from dpp_boletasg where ";
   if($licitacion <> "")
   {
    $sql.=" boleg_idlicitacion LIKE '%".$licitacion."%' and ";
    $sw=1;
   }
if ($region<>"") {
    if ($region==0)
        $sql.=" boleg_reg<>'' and ";
    else
        $sql.=" boleg_reg=$region and ";
    $sw=1;
}
if ($fecha1<>"" and $fecha2<>"" ) {
    $sql.=" ( boleg_fecha_recep>='$fecha1' and boleg_fecha_recep<='$fecha2' ) and ";
    $sw=1;
}
if ($rut<>"") {
    $sql.=" boleg_rut like '%$rut%' and ";
    $sw=1;
}
if ($documento<>"") {
    $sql.=" boleg_numero like '%$documento%' and ";
    $sw=1;
}
if ($nombre<>"") {
    $sql.=" boleg_nombre like '%$nombre%' and ";
    $sw=1;
}
if ($folio<>"") {
    $sql.=" boleg_folio='$folio' and ";
    $sw=1;
}
if ($glosa<>"") {
    $sql.=" boleg_glosa like '%$glosa%' and ";
    $sw=1;
}
if ($estado<>"") {
    $sql.=" boleg_estado like '$estado' and ";
    $sw=1;
}

if ($sw==1){
    $sql.=" 1=1 order by boleg_folio desc";
}
if ($sw==0){
    $sql.=" 1=2";
}



// echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
while($row3 = mysql_fetch_array($res3)){



?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_rut"]  ?>-<? echo $row3["boleg_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_nombre"]  ?> </td>
                         <td class="Estilo1b"><?php echo $row3["boleg_idlicitacion"] ?></td>
                         <td class="Estilo1b"><? echo substr($row3["boleg_fecha_recep"],8,2)."-".substr($row3["boleg_fecha_recep"],5,2)."-".substr($row3["boleg_fecha_recep"],0,4)   ?></td>
                         <td class="Estilo1c"><? echo number_format($row3["boleg_monto"],0,',','.')  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_numero"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_folio"]  ?> </td>
                         <td class="Estilo1b">
                            <? 

                            if ($row3["boleg_estado"] == 1) {
                              echo "Recepción";
                            }
                            if ($row3["boleg_estado"] == 2) {
                              echo "Custodia";
                            }

                            if ($row3["boleg_estado"] == 3) {
                              echo "Administración";
                            }
                            if ($row3["boleg_estado"] == 4) {
                              echo "Por Devolver";
                            }
                            if ($row3["boleg_estado"] == 5) {
                              echo "Devuelto";
                            }
                            if ($row3["boleg_estado"] == 9) {
                              echo "Rechazado";
                            }
                            if ($row3["boleg_estado"] == 7) {
                              echo "Cobrado";
                            }
                            if ($row3["boleg_estado"] == 8) {
                              echo "Por Cobrar";
                            }
                            if ($row3["boleg_estado"] == 0) {
                              echo "Anulado por Sistema";
                            }
                            
                            ?>
                              
                         </td>


  <td class="Estilo1c"><?php echo ($row3["boleg_fecha_vence"] <> "0000-00-00") ?  $row3["boleg_fecha_vence"] : "N/A" ?></td>
                         <td class="Estilo1c"><a href="fichagarantia.php?id=<? echo $row3["boleg_id"] ?>" class="link" >VER</a> </td>
                       </tr>

                        


<?

   $sumab=$sumab+$row3["hono_bruto"];
   $sumar=$sumar+$row3["hono_retencion"];
   $sumal=$sumal+$row3["hono_liquido"] ;
   $cont++;
   $cont1++;
}
?>
                





</td>
  </tr>

 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
