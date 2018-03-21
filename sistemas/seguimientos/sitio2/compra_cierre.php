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
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

		  <?
		  require("inc/menu_1.php");
		  ?>

            </div>
      </div>

        <div class="col-sm-9 col-lg-9">
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">AÑO PROGRAMACCION PLAC  <? echo $anno3 ?></span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?


    $anno=$_POST["anno"];
    if ($anno<>'') {
        $sql6="update compra_compra set compra_cierre=0 where compra_anno=$anno ";
        mysql_query($sql6);
        
        $anno4=$anno+1;
        $sql6="update regiones set anno3=$anno4 where codigo<>''  ";
        mysql_query($sql6);

    }

    
$sql2 = "Select * from regiones where codigo=15";
//echo $sql2;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$anno3=$row2["anno3"];


if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";
?>
                         </td>
                      </tr>

                          <tr>
                      <td><a href="compra_menucierre.php" class="link" >Volver</a><br><br></td>
                      </tr>

                   <tr>
                    <td height="50" colspan="3">
                          </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
     <?
                   if ($regionsession==15) {
     ?>
					  <form name="form1" action="compra_cierre.php" method="post"  onSubmit="return valida()">
                         <tr>
                             <td  valign="top" class="Estilo1">Mes </td>
                             <td class="Estilo1">

                             <?

S

                                //$tot_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
                             ?>

                                <input type="text" name="anno" class="Estilo2" size="6" value="<? echo $anno3 ?>">

                                <input type="submit"  class="Estilo2"  value="    Cambio de  año <? echo $anno3 ?>" onclick="return confirm('Seguro que desea Cambiar el año ?')">
                             </td>
                           </tr>
                           

                                                          
                       </form>
                       <?
                        }
                       ?>


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
