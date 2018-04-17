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
<title>Reporte</title>
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
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
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
                    <td height="20" colspan="2"><span class="Estilo7">REPORTE CONSOLIDADO POR REGION</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>

                         </td>
                      </tr>
<?
$anno=$_GET["anno"];
$mes=$_GET["mes"];
$region=$_GET["region"];
?>


                   <tr>
                    <td height="50" colspan="3">
                    
          <table width="488" border="0" cellspacing="0" cellpadding="0">
                      <form name="form1" action="reporte2.php" method="get">
                         <tr>
                             <td width="200px" valign="top" class="Estilo1">A&ntilde;o</td>
                             <td class="Estilo1" width="380">
                                <select name="anno" class="Estilo1">
                                    <option value="">Seleccione...</option>
                                 <?
                                    $sql2 = "Select year(hono_fecha1) as anno from dpp_honorarios group by year(hono_fecha1) order by hono_fecha1";
                                    //echo $sql2;
                                    $res2 = mysql_query($sql2);
                                    while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                      <option value="<? echo $row2["anno"] ?>" <? if ($row2["anno"]==$anno) echo "selected=selected" ?> > <? echo $row2["anno"] ?> </option>

                                 <?
                                     }
                                 ?>
                               </select>


                             </td>
                           </tr>
                         <tr>
                             <td  valign="top" class="Estilo1">Mes</td>
                             <td class="Estilo1" width="380">
                                <select name="mes" class="Estilo1">
                                    <option value="">Seleccione...</option>
                                      <option value="01" <? if ($mes=='01') echo "selected=selected" ?> > 01 </option>
                                      <option value="02" <? if ($mes=='02') echo "selected=selected" ?> > 02 </option>
                                      <option value="03" <? if ($mes=='03') echo "selected=selected" ?> > 03 </option>
                                      <option value="04" <? if ($mes=='04') echo "selected=selected" ?> > 04 </option>
                                      <option value="05" <? if ($mes=='05') echo "selected=selected" ?> > 05 </option>
                                      <option value="06" <? if ($mes=='06') echo "selected=selected" ?> > 06 </option>
                                      <option value="07" <? if ($mes=='07') echo "selected=selected" ?> > 07 </option>
                                      <option value="08" <? if ($mes=='08') echo "selected=selected" ?> > 08 </option>
                                      <option value="09" <? if ($mes=='09') echo "selected=selected" ?> > 09 </option>
                                      <option value="10" <? if ($mes=='10') echo "selected=selected" ?> > 10 </option>
                                      <option value="11" <? if ($mes=='11') echo "selected=selected" ?> > 11 </option>
                                      <option value="12" <? if ($mes=='12') echo "selected=selected" ?> > 12 </option>
                               </select>


                             </td>
                           </tr>
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
                                    <option value="<? echo $row2["codigo"] ?>" <? if ($region==$row2["codigo"]) echo "selected=selected" ?>  ><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center">
                             <input type="submit" name="boton" class="Estilo2" value="  Consultar  ">
                              </form>
                               <a href="reporte2.php"> Limpiar </a>

                             </td>

                           </tr>
                             </form>
                          <tr>
                           <td colspan="8"><hr></td>
                          </tr>
                         <tr>

                             <td class="Estilo1" colspan="8">
                                 <table border=0 class="table table-striped table-bordered">
                                   <tr>
                                    <td class="Estilo1">Num</td>
                                    <td class="Estilo1">Region</td>
                                    <td class="Estilo1">Cantidad</td>
                                    <td class="Estilo1">Suma</td>
                                   <tr>
                                 <?

//                                    $sql2 = "Select count(codigo) as suma, nombre, codigo from regiones group by codigo order by codigo";
                                     if ($anno<>'' and $mes<>'' and $region<>'') {
                                      $sql2 = "Select count(x.hono_region) as suma, sum(hono_bruto) as suma2, nombre, codigo from dpp_honorarios x, regiones y where year(x.hono_fecha1)='$anno' and month(x.hono_fecha1)='$mes' and x.hono_region='$region' and x.hono_region=y.codigo group by hono_region order by y.codigo";
                                     } else {
                                      $sql2 = "Select count(x.hono_region) as suma, sum(hono_bruto) as suma2, nombre, codigo from dpp_honorarios x, regiones y where x.hono_region=y.codigo group by hono_region order by y.codigo";
                                     }
                                    $res2 = mysql_query($sql2);
                                   $suma=0;
                                   while($row2 = mysql_fetch_array($res2)){
                                       $idregion=$row2["codigo"];
                                       $suma=$suma+$row2["suma"];
                                       $suma2=$suma2+$row2["suma2"];

                                 ?>
                                    <tr>
                                    <td class="Estilo1"><? echo $row2["codigo"] ?></td>
                                    <td class="Estilo1"> <? echo $row2["nombre"] ?></td>
                                    <td class="Estilo1d"> <? echo $row2["suma"] ?></td>
                                    <td class="Estilo1d"> <? echo number_format($row2["suma2"],0,",",".") ?></td>

                                    

                                 <?
                                    }

                                 ?>
                                  <tr>
                                   <td class="Estilo1c" colspan="2">TOTAL</td>
                                   <td class="Estilo1d"><? echo $suma ?> </td>
                                   <td class="Estilo1d"><? echo number_format($suma2,0,",",".") ?> </td>
                                  </tr>


                             </td>
                           </tr>





                      </td>


                      





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

?>
