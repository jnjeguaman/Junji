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
$annomio=date("Y");
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
font-size: 14px;
font-weight: bold;}
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
                    <td height="20" colspan="2"><span class="Estilo7">COMPRAS SUBPARAMETROS</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                                               <td class="Estilo1c"><a href="compra_parametro.php" class="link" >volver</a> </td>
                      </tr>
<?
$region=$_GET["region"];
$id=$_GET["id"];

?>



                   <tr>
                    <td height="50" colspan="3">
                 </table>
     <table width="488" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="compra_grabaparametro2.php" method="post">
                         <tr>
                             <td  valign="top" class="Estilo1">SubCategoria Nueva</td>
                             <td class="Estilo1">
                              <input type="text" name="categoria" class="Estilo2" size="15" value="<? echo $folio ?>">
                              <input type="hidden" name="id" class="Estilo2" size="15" value="<? echo $id ?>">
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Crear Nueva SubCategoria  "> <a href="compra_parametro.php"> Limpiar </a> </td>


                           </tr>

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      <table border=1>
                        <tr>
                         <td class="Estilo1b">Num</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Ver </td>
                        </tr>



<?
$sw=0;

   $sql="select * from compra_subcat where subcat_cat_id=$id and subcat_estado=1";


//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
while($row3 = mysql_fetch_array($res3)){





?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $row3["subcat_id"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["subcat_nombre"]  ?> </td>
                         <td class="Estilo1c"><a href="compra_parametro3.php?id=<? echo $row3["subcat_id"] ?>" class="link" >VER</a> </td>
                       </tr>

                        



<?

   $sumab=$sumab+$row3["hono_bruto"];
   $sumar=$sumar+$row3["hono_retencion"];
   $sumal=$sumal+$row3["hono_liquido"] ;
   $cont++;
   $cont1++;
}
?>

                       <tr>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         
                        </tr>
                        </td>
                      </tr>
                      <tr>





</td>
  </tr>

 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
