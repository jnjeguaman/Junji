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
<title>Cierres</title>
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
font-size: 14px;
font-weight: bold;
text-align: center;}
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
                    <td height="20" colspan="2"><span class="Estilo7">CIERRE POR REGIÓN PARA LIBRO DE COMPRAS</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?

$sql2 = "Select * from parametros";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$mes=$row2["para_mes"];
$ano=$row2["para_anno"];


if (isset($_POST["mes"])) {
    $mes=$_POST["mes"];
    $anno=$_POST["anno"];
        $sql6="update parametros set para_mes='$mes', para_anno='$anno' where para_id=1";
        mysql_query($sql6);
        $sql6="update regiones set activo2=1 ";
        mysql_query($sql6);
        
/*
        $sql22 = "Select * from dpp_honorarios2";
        //echo $sql22;
        $res22 = mysql_query($sql22);
        while($row22 = mysql_fetch_array($res22)){
          $etaid=$row22["hono2_eta_id"];
          $sql23 = "update dpp_etapas set eta_swhono='3' where eta_id=$etaid";
          //echo $sql22;
          //exit();
          mysql_query($sql23,$dbh2);
        }
        $sql24 = "delete from dpp_honorarios2";
        //echo $sql24;
        $res24 = mysql_query($sql24);
*/
}


if (isset($_GET["sw1"])) {
  $region = $_GET["idreg"];
echo "<script>window.open('librocompra_respaldo.php?region=".$region."&mes=".$mes."&ano=".$ano."');</script>";
    $sw1=$_GET["sw1"];
    $idreg=$_GET["idreg"];
    if ($sw1==1) {
        $sql6="update regiones set activo2=0 where codigo=$idreg";
        mysql_query($sql6);
        
        $sql6="update dpp_etapas set eta_cierresii=1 where month(eta_fechache)='$mes' and year(eta_fechache)='$ano' and eta_region='$idreg' ";
//        echo $sql6;
        mysql_query($sql6);

        
    }
    if ($sw1==2) {
        $sql6="update regiones set activo2=1 where codigo=$idreg";
        mysql_query($sql6);
        
    }
    if ($sw1==3) {
        $sql6="update regiones set activo2=0 ";
        mysql_query($sql6);

        $sql6="update dpp_etapas set eta_cierresii=1 where month(eta_fechache)='$mes' and year(eta_fechache)='$ano' and eta_region='$regionsession' ";
//        echo $sql6;
        mysql_query($sql6);


    }


    
}
if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";
?>
                         </td>
                      </tr>

                          <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="menucontabilidad3.php" class="link" >VOLVER </a>  </td>
                          </tr>
                          <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><BR>  </td>
                          </tr>


                   <tr>
                    <td height="50" colspan="3">
                    </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                             <td  valign="top" class="Estilo1">Mes En Curso :<? echo $mes ?> </td>
                             <td class="Estilo1"></td>
                          </tr>
                         <tr>
                             <td  valign="top" class="Estilo1">Año En Curso :<? echo $ano ?> </td>
                             <td class="Estilo1"></td>
                          </tr>


     <?
                   if ($regionsession==14) {
     ?>
					  <form name="form1" action="cierres.php" method="post"  onSubmit="return valida()">
                         <tr>
                             <td  valign="top" class="Estilo1">Mes </td>
                             <td class="Estilo1">

                             <?

//                                $mes=date("m");
//                                $ano=date("Y");
                                


                                //$tot_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
                             ?>

                                <input type="text" name="mes" class="Estilo2" size="6" value="<? echo $mes ?>">-<input type="text" name="anno" class="Estilo2" size="6" value="<? echo $ano ?>">
                                <input type="submit"  class="Estilo2"  value="    Cambiar datos de Fecha">
                             </td>
                           </tr>
                           
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="8"> Importante al hacer cambio de mes todas las regiones quedaran activas </td>
                           </tr>
                           <tr>
                            <td><br></td>
                           </tr>

                            <!-- <tr>
                                <td  valign="center" class="Estilo1" colspan="8"><a href="cierres.php?sw1=3" >Cerrar Todos</a> </td>
                            </tr> -->
                           <tr>
                            <td><br></td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="8"> Rojo: Cerrado <br>Verde: Abierto</td>
                           </tr>

                                                          
                       </form>
                       <?
                        }
                       ?>
                          <tr>
                           <td colspan="8"><hr></td>
                          </tr>
                         <tr>
                             <td class="Estilo1" colspan="8">
                                 <table border=1>
                                   <tr>
                                    <td class="Estilo1">Num</td><td class="Estilo1">Regi&oacute;n</td><td class="Estilo1">Estado</td><td class="Estilo1">Cerrar</td><td class="Estilo1">Abrir</td>
                                   <tr>
                                 <?
                                  if ($regionsession==14) {
                                    $sql2 = "Select * from regiones where codigo<20 order by codigo";
                                  } else
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){
                                       $idregion=$row2["codigo"];

                                 ?>
                                    <tr>
                                    <td class="Estilo1"><? echo $row2["codigo"] ?></td>
                                    <td class="Estilo1"> <? echo $row2["nombre"] ?></td>
                                    <td class="Estilo1"> <? if ($row2["activo2"]==1) { ?><img src="images/punt_verde.jpg"  width="15" height="15" /> <? } else { ?><img src="images/punt_rojo.jpg"  width="15" height="15" /><? } ?></td>
                                    <td class="Estilo1"><a href="cierres.php?sw1=1&idreg=<? echo $idregion; ?>" >Cerrar</a></td>
                                 <?
                                    if ($regionsession==14) {
                                 ?>
                                    <!-- <td class="Estilo1"><a href="cierres.php?sw1=2&idreg=<? echo $idregion ?>" >Abrir</a></td> -->
                                    

                                 <?
                                    }
                                   }
                                 ?>





                             </td>
                           </tr>





                      </td>


                       <tr>
                       <td colspan=8><hr></td>
                      </tr>
                      





</td>
  </tr>
 
 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
