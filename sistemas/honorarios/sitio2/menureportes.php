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
          <div class="col-sm-2 col-lg-2">
            <div class="dash-unit2">

          <?
          require("inc/menu_1.php");
          ?>

                </div>
          </div>

            <div class="col-sm-10 col-lg-10">
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

     <table width="488" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
       <form name="form1" action="reportes.php" method="get">


                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="reportes.php" class="link" > Reporte Consolidado Por Rut</a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>
                            
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="reporte2.php" class="link" > Reporte Consolidado Por Region</a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>

                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="consultas2.php" class="link" > Reporte SII</a>  </td>
                          </tr>
                            <tr>
                              <td><br></td>
                            </tr>

                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="consultas3.php" class="link" > Reporte SII (consolidado)</a>  </td>
                          </tr>

                            <tr>
                              <td><br></td>
                            </tr>

                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="consultas4.php" class="link" > Reporte Libro de Retenciones</a>  </td>
                          </tr>
                            <tr>
                              <td><br></td>
                            </tr>

                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="reportes3.php" class="link" > Reporte Completo</a>  </td>
                          </tr>
                            <tr>
                              <td><br></td>
                            </tr>


                        </form>

                      </td>



 
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
