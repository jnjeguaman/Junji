<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$date_in2=date("Y-m-d");
$annomio=date("Y");
$ti=$_GET["ti"];
?>
<html>
<head>
<title>Argedo</title>
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
    text-transform: uppercase;
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
    text-transform: uppercase;
}

.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
}
.Estilo1cverde {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #009900;
	text-align: right;
}
.Estilo1camarrillo {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #CCCC00;
	text-align: right;
}
.Estilo1crojo {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #CC0000;
	text-align: right;
}
.Estilo1crojoc {
	font-family: Verdana;
	font-weight: bold;
	font-size: 12px;
	color: #CC0000;
	text-align: center;
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
text-align: center; }

}
.Estilo8 {font-family: Geneva, Arial, Helvetica, sans-serif; 
font-size: 10px; font-weight: bold; text-align: left; 
color: #009900;}

-->
</style>



</head>
<script type="text/javascript" src="select_dependientesargedo.js"></script>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
    <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />


<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--

function ChequearTodos(chkbox)
{
  for (var i=0;i < document.forms[0].elements.length;i++){
      var elemento = document.forms[0].elements[i];
      alert("aqui "+chkbox);
      if (elemento.type == "checkbox"){
          elemento.checked = chkbox.checked
      }
  }
}




function mostrar() {
    document.form3.submit();
}

function mostrar2() {
    document.form2.submit();
}
function mostrar3() {
    document.form4.submit();
}
//-->

</script>
<?


?>
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
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE DOCUMENTOS RESOLUCION EXENTA</span></td>
                  </tr>

                    <tr>
                         <td width="487" valign="top" class="Estilo1">
                       <a href="argedo_menudocs.php" class="link">VOLVER</a> <br>

                         </td>
                      </tr>

                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">

                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>



                   <tr>
             			<td height="50" colspan="3">
				  <form name="form2" action="argedo_resyofi2.php" method="get"  >
                              <input type="hidden" name="ti" value="<? echo $ti; ?>" >
                              <input type="hidden" name="prefijo" value="<? echo $prefijo; ?>" >
                  </form>
				  <form name="form3" action="argedo_resyofi.php" method="get"  >
                              <input type="hidden" name="ti" value="<? echo $ti; ?>" >
                              <input type="hidden" name="prefijo" value="<? echo $prefijo; ?>" >
                  </form>
				  <form name="form4" action="argedo_resyofi3.php" method="get"  >
                              <input type="hidden" name="ti" value="<? echo $ti; ?>" >
                              <input type="hidden" name="prefijo" value="<? echo $prefijo; ?>" >
                  </form>
                  </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                             <td  valign="center" class="Estilo1" width="200">¿Tipo Resolución ?</td>
				             <td class="Estilo1">
                              <input type="radio" name="rrhh" class="Estilo2" value="1" onclick="mostrar2();"> SIAPER
                              <input type="radio" name="rrhh" class="Estilo2" value="2" onclick="mostrar();" > EXENTA
<!--
                              <input type="radio" name="rrhh" class="Estilo2" value="3" onclick="mostrar3();" > CIRCULAR
-->
                             </td>
                           </tr>
                    </table>
                



                      <tr>
                      <td colspan="8">

<br>



                 <tr>
                         <td class="Estilo1" colspan=4></td>
                        </tr>


                        <tr>
                         <td class="Estilo1" colspan=4>


              <tr>
                       <tr>
                       
                      </tr>



<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
