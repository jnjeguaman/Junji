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
font-size: 14px; font-weight: bold;}
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
                    <td height="20" colspan="2"><span class="Estilo7">MENU ARGEDO 2016</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_menu.php" class="link" >volver</td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><br></td>
                           </tr>



                   <tr>
                    <td height="50" colspan="3">
<?
 $sql="select * from regiones where codigo=$regionsession ";
// echo $sql;
 $result=mysql_query($sql);
 $row=mysql_fetch_array($result);
 $nombre=$row["nombre"];
 $inicio=$row["inicio"];
 $dirargedo=$row["argedo"];
// $anno=date("Y");
// $anno2=2011;

?>
       </table>
       
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="reportes.php" method="get">



                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_ingresoant.php?cod=29" class="link" >1. AGREGAR DOCUMENTO ANTERIOR AL 2012</a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>
                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_consulta2.php" class="link" >2. MODIFICAR DOCUMENTO ANTERIOR AL 2012</a>  </td>
                           </tr>
                            <tr>
                              <td><br></td>
                            </tr>

                            <tr>
                              <td><br></td>
                            </tr>

                            <tr>
                              <td><hr></td>
                            </tr>
<?
  $reg=$regionsession;
  $campo1="fol_reg".$reg."_1";
  $campo2="fol_reg".$reg."_2";
  $campo3="fol_reg".$reg."_3";
  $campo4="fol_reg".$reg."_4";
  $campo5="fol_reg".$reg."_5";
  $sql2="select $campo1, $campo2, $campo3, $campo4, $campo5 from argedo_folios where fol_id=1 ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $folio1=$row2["0"];
  $folio2=$row2["1"];
  $folio3=$row2["2"];
  $folio4=$row2["3"];
  $folio5=$row2["4"];
  


?>



                            <tr>
                              <td><br></td>
                            </tr>


                            <tr>
                              <td><br></td>
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
