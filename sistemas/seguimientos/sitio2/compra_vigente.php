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
?>
<html>
<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
<title>Compras</title>
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
	font-size: 10px;
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
}
.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
}
.Estilo2d {
	font-family: Verdana;
	font-size: 9px;
	text-align: right;
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
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  

  <script type="text/javascript">
    function validaGrabar() {

      if(confirm('\u00BF EST\u00c1 SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
        blockUI();
      }
      else{
        return false;
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

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">PRESUPUESTO VIGENTE</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">
                         
<?

$id=$_GET["id"];
$sw=$_GET["sw"];
$id2=$_GET["id2"];
$ori=$_GET["ori"];
$anno2=$_GET["anno2"];
if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Registros insertados con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Registros NO insertados !";
}
if ($ori==1) {
    $volver="compra_seguimiento2.php";
}
if ($ori==2) {
    $volver="compra_seguimiento2b.php";
}

?>
                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
<?
if ($sw==1) {

   $sql="delete from compra_ordengestion where orges_id ='$id2' ";
   //echo $sql;
   mysql_query($sql);

}


$sql21="select * from compra_compra where compra_id='$id'  ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $totaldevueltos=$row21["compra_fecha"];
?>

                       <tr>
                       <td><a href="<? echo $volver ?>?id=<? echo $id ?>" class="link" >Volver</a></td>
                      </tr>


                   <tr>
             			<td height="50" colspan="3">
                     </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">



<tr>


                      </tr>
                    </table>
                    <hr>
<?
                                 $sql2 = "Select * from compra_vigentedet  where cvig_id =$id2";
                                 //echo $sql2;
                                 $res2 = mysql_query($sql2);
                                 $row2 = mysql_fetch_array($res2);

?>


					<table width="488" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_grabavigente.php" method="post" onsubmit="return validaGrabar()" >

                           <tr>
                               <td  valign="center" class="Estilo1b" colspan=6>PLANIFICACION PRESUPUESTARIA <? echo $anno2 ?>  </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Estimado Comprometido  </td>
                             <td class="Estilo1" colspan=3>
                               <input type="text" name="total" class="Estilo2d" value="<? echo $row2["cvig_total"] ?>" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Compromiso Autorizado </td>
                             <td class="Estilo1" colspan=3>
                               <input type="text" name="vigente" class="Estilo2d" value="<? echo $row2["cvig_vigente"] ?>" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Meses Ejecucion</td>
                             <td class="Estilo1" colspan=3>
                               <input type="text" name="meses" class="Estilo2d" value="<? echo $row2["cvig_meses"] ?>" >
                             </td>
                           </tr>


                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR     " > </td>
                           </tr>

                            <input type="hidden" name="id" value="<? echo $id ?>" >
                            <input type="hidden" name="id2" value="<? echo $id2 ?>" >
                            <input type="hidden" name="ori" value="<? echo $ori ?>" >

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">








                        





</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>

