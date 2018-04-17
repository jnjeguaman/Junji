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
	text-align: left;
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
.Estilo7 {font-size: 12px; font-weight: bold; }
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
  
<SCRIPT LANGUAGE ="JavaScript">
  function aparece(){


     if (document.form1.commodity.value == 'Other') {
       document.form1.specifications.style.display='';
     } else {
       document.form1.specifications.style.display='none';
     }
     if (document.form1.commodity.value == 'Fishmeal') {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
    }
     if (document.form1.commodity.value == 'Fishoil') {
       seccion2.style.display="";
     } else {
       seccion2.style.display="none";
    }
 }

</script>
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
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

          <?
          require("inc/menu_1.php");
          ?>

                </div>
          </div>

            <div class="col-sm-9 col-lg-9">
               <div class="dash-unit2">

                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">REPORTES</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$rut=$_GET["rut"];
$item=$_GET["item"];
$consolidado=$_GET["consolidado"];

?>



                   <tr>
                    <td height="50" colspan="3">

     <table width="488" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="reportes.php" method="get">
                         <tr>
                             <td  valign="top" class="Estilo1">Region</td>
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
                             <td  valign="center" class="Estilo1">Rango de Fechas</td>
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
                             <td  valign="top" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>">
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Sub Titulo  </td>
                             <td class="Estilo1" colspan=3>
                              21<input type="radio" name="item" class="Estilo2" value="21" <? if ($item==21) echo "checked" ?> >
                              22<input type="radio" name="item" class="Estilo2" value="22" <? if ($item==22) echo "checked" ?> >
                              24<input type="radio" name="item" class="Estilo2" value="24" <? if ($item==24) echo "checked" ?> >
                              Otro<input type="radio" name="item" class="Estilo2" value="24" <? if ($item==99) echo "checked" ?> >
                             </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Consolidado  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="checkbox" name="consolidado" class="Estilo2" value="21" <? if ($consolidado==21) echo "checked" ?> >
                             </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="reportes.php"> Limpiar </a> </td>
                             

                           </tr>

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      <td class="Estilo1" colspan=4><a href="reportesexcel.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item=<? echo $item ?>&consolidado=<? echo $consolidado ?>" class="link" > Exportar a Excel</a>
                      <table border=0 class="table table-striped table-bordered">
                        <tr>
                         <td class="Estilo1b">Nun</td>
                         <td class="Estilo1b" width="80px">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Bruto</td>
                         <td class="Estilo1b">Reten. </td>
                         <td class="Estilo1b">Neto </td>
                         <td class="Estilo1b">Consolidado </td>
                        </tr>

<?
$sw=0;
if ($consolidado<>"")
   $sql="select hono_nombre, hono_rut,hono_dig, count(hono_rut) as cuentarut, sum(hono_bruto) as hono_bruto, sum(hono_retencion) as hono_retencion, sum(hono_liquido) as hono_liquido from dpp_honorarios where ";
else
   $sql="select * from dpp_honorarios where ";
if ($region<>"") {
    if ($region==0)
        $sql.=" hono_region<>'' and ";
    else
        $sql.=" hono_region=$region and ";
    $sw=1;
}
if ($fecha1<>"" and $fecha2<>"" ) {
    $sql.=" ( hono_fecha1>='$fecha1' and hono_fecha1<='$fecha2' ) and ";
    $sw=1;
}
if ($rut<>"") {
    $sql.=" hono_rut like '%$rut%' and ";
    $sw=1;
}

if ($item<>"") {
    $sql.=" hono_item=$item and ";
    $sw=1;
}
if ($sw==1){
    if ($consolidado <>"")
      $sql.=" 1=1 group by trim(hono_nombre) order by trim(hono_nombre)";
    else
      $sql.=" 1=1 order by hono_nombre";
}
if ($sw==0){
    $sql.=" 1=2";
}
//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
$existedato=0;
while($row3 = mysql_fetch_array($res3)){

?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_rut"]  ?>-<? echo $row3["hono_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_nombre"]  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["hono_bruto"],0,',','.')  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["hono_retencion"],0,',','.')   ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["hono_liquido"],0,',','.')   ?> </td>
<?
    if ($consolidado<>"") {
?>
                             <td class="Estilo1c"><? echo number_format($row3["cuentarut"],0,',','.')   ?> </td>
<?
    }
    else {
      ?>
                             <td class="Estilo1c"> </td>
      <?
    }
?>

                        </tr>

                        



<?

   $sumab=$sumab+$row3["hono_bruto"];
   $sumar=$sumar+$row3["hono_retencion"];
   $sumal=$sumal+$row3["hono_liquido"] ;
   $cont++;
   $cont1++;
   $existedato++;
}
?>
       
        <?
        if ($existedato==0) {
                      ?>
                      <tr>
                        <td class="Estilo1b text-center" colspan="7">Sin registros</td>
                      </tr>
                      <?        

        }
        else{
                      ?>

                       <tr>
                          <td class="Estilo1b text-center" colspan="3">Total</td>
                         <!-- <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td> -->
                         <td class="Estilo1c"><? echo number_format($sumab,0,',','.')  ?> </td>
                         <td class="Estilo1c"><? echo number_format($sumar,0,',','.')  ?> </td>
                         <td class="Estilo1c"><? echo number_format($sumal,0,',','.') ?> </td>
                        </tr>


                        <?
        }
        ?>
                        </td>
                      </tr>
                      <tr>





                </td>
                  </tr>

                 
                </table>
                <br>

                <br>

                <? require("inc/pie.php"); ?>


                <img src="images/pix.gif" width="1" height="10">

              </div>

          </div>

        </div>

    </div>


</body>
</html>

<?
//require("inc/func.php");
?>
