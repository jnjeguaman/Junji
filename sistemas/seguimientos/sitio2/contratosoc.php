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
$year=date("Y");
?>
<html>
<head>
<title>CONTRATOS</title>
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
<script type="text/javascript" src="select_dependientes_3_nivelesa.js"></script>
<script type="text/javascript" src="select_dependientes_3_nivelesb.js"></script>
<script type="text/javascript" src="select_dependientes_3_nivelesc.js"></script>
<script type="text/javascript" src="select_dependientes_3_nivelesd.js"></script>
<script type="text/javascript" src="select_dependientes.js"></script>
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





<script language="javascript">
<!--





//-->

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
                    <td height="20" colspan="2"><span class="Estilo7">ORDENES DE COMPRA CON POSIBLIDAD DE CONTRATOS</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                         <td width="480" valign="top" class="Estilo1">

<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";

$id=$_GET["id"];
$id2=$_GET["id2"];
$sw=$_GET["sw"];

if ($sw==1) {
  $sql="update compra_contrato set ccont_estado=99 where ccont_id=$id";
  //echo $sql;
  mysql_query($sql);
  echo "<script>location.href='contratosoc.php';</script>";
}
?>



                   <tr>
                    <td height="50" colspan="3">
                    
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
					  <form name="form1" action="grabacontrato.php" method="post"  onSubmit="return valida()">



                        </form>


                   </table>



                         <table border=1 class="table table-striped" width="100%">
                             <tr>
                               <td class="Estilo1">Nº</td><td class="Estilo1">Id</td><td class="Estilo1">OC Numero</td><td class="Estilo1" width="10">Nombre Proveedor</td><td class="Estilo1" width="10">Monto</td>
                              </tr>

                              <?
                                   $sql2 = "Select * from compra_contrato where ccont_region='$regionsession' and ccont_estado=1 order by ccont_id desc";

                                  //echo "--->".$sql2;
                                  $res2 = mysql_query($sql2);
                                   $cont=1;
                                   while($row2 = mysql_fetch_array($res2)){
                                       $ccontocid=$row2["ccont_oc_id"];
                                       $sql3 = "Select * from compra_orden where oc_id=$ccontocid ";
                                     //  echo "--->".$sql3;
                                       $res3 = mysql_query($sql3);
                                       $row3 = mysql_fetch_array($res3);


                              ?>
                                  <tr>
                                  <td class="Estilo1"><? echo $cont ?></td>
                                  <td class="Estilo1"><? echo $row2["ccont_id"] ?> </td>
                                  <td class="Estilo1"><? echo $row2["ccont_ocnumero"] ?></td>
                                  <td class="Estilo1"><? echo $row3["oc_rsocial"]; ?></td>
                                  <td class="Estilo1"><? echo number_format($row3["oc_monto"],0,',','.'); ?></td>
                                  <td class="Estilo1"><a href="compra_fichaorden2.php?id=<? echo $row3["oc_id"]; ?>" class="link" target="_blank" >Ver</a></td>
                                  <td class="Estilo1"><a href="contratos.php?id=<? echo $row2["ccont_id"]; ?>&id2=<? echo $row3["oc_id"]; ?>" class="link" >Crear Contrato</a></td>
                                  <td class="Estilo1"><a href="contratosoc.php?id=<? echo $row2["ccont_id"]; ?>&id2=<? echo $row3["oc_id"]; ?>&sw=1" class="link" onclick="return confirm('Seguro que desea Eliminar ?')">Eliminar</a></td>
                                  
                                  

                              <?
                                    $cont++;
                                  }
                              ?>

                              </tr>
                         </table>
                      <tr>
                      <td><br></tr>
                      </tr>

                      <tr>



</td>
  </tr>
 
 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
