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
.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif; 
font-size: 15px; font-weight: bold; }
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
                    <td height="20" colspan="2"><span class="Estilo7">MODIFICA DOCUMENTOS</span></td>
                  </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1">
                       <a href="argedo_menu.php" class="link">VOLVER</a> <br>

                         </td>
                      </tr>

                       <tr>
                       <td><br></td><td><br></td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>

                   <tr>
                    <td height="50" colspan="3">
      </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">



                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_listaresyofi.php?ti=1&siaper=1" class="link" >1.- MODIFICA SIAPER </a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_listaresyofi.php?ti=1" class="link" >2.- MODIFICA RESOLUCION EXENTA </a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>
                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_listaresyofi.php?ti=2" class="link" >3.- MODIFICA RESOLUCION AFECTA CON TOMA</a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>
                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_listaresyofi.php?ti=3" class="link" >4.- MODIFICA OFICIOS ORDINARIO</a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>
                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_listaresyofi.php?ti=7" class="link" >5.- MODIFICA OFICIOS CIRCULAR</a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>

                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_listarecibida.php?ti=4" class="link" >6.-  MODIFICA CORRESPONDENCIA RECIBIDA</a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>

                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_listadespachada.php?ti=5" class="link" >7.- MODIFICA CORRESPONDENCIA DESPACHADA</a>  </td>
                          </tr>

                        </form>

                      </td>



 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
