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
	font-size: 8px;
	color: #003063;
	text-align: center;



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
font-weight: bold; }
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


function ChequearTodos(chkbox)
{
  for (var i=0;i < document.forms[0].elements.length;i++){
      var elemento = document.forms[0].elements[i];
      if (elemento.type == "checkbox"){
          elemento.checked = chkbox.checked
      }
  }
}

</script>
<body>
<img src="images/pix.gif" width="1" height="10">
<table width="752" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
  <tr>
    <td width="1009">
	  <?
	  require("inc/top.php");
	  ?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="165" valign="top">
		  <?
		  require("inc/menu_1.php");
		  ?>		  </td>
          <td valign="top"><strong>
            <img src="images/pix.gif" width="1" height="10">
                    </strong>            <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="530" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">FICHA DE PRORRATEO</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$id=$_GET["id"];
$id1b=$_GET["id1b"];
$id2=$_GET["id2"];
$ori=$_GET["ori"];

$sql="select * from dpp_prorroteo where prorro_id=$id2  ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

$row3 = mysql_fetch_array($res3);
if ($ori==1) {
    $volver="dpp_plantilla.php";
}
if ($ori==2) {
    $volver="dpp_plantilla2.php?id=$id&id1b=$id1b";
}



?>
                  <tr><td>
                  <a href="<? echo $volver ?>" class="link" >volver </a><br><br>
                  </td></tr>

                   <tr>
                    <td height="50" colspan="3">

     <table width="488" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                             <td  valign="center" class="Estilo1">Plantilla :
                                <? echo $row3["prorro_nombre"]; ?>
                            <td>
                           </tr>


                      </td>

                      <tr>

                      <table border=1>
                        <tr>
                         <td> </td>
                        </tr>

                        <tr>
                         <td class="Estilo1b">Op. </td>
                         <td class="Estilo1b">Unidades</td>
                         <td class="Estilo1b">Valor</td>
                         <td class="Estilo1b">%</td>
                        </tr>

<?
$sql4="select sum(prorrodet_numero) as suma from dpp_prorroteodet where prorrodet_prorro_id=$id2  ";

//echo $sql4;
$res3 = mysql_query($sql4);
$row3 = mysql_fetch_array($res3);
$suma2=$row3["suma"];



$sql4="select * from dpp_prorroteodet where prorrodet_prorro_id=$id2  ";

//echo $sql4;
$res3 = mysql_query($sql4);
$cont=1;

while($row3 = mysql_fetch_array($res3)){


?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1"><? echo $row3["prorrodet_unidadnombre"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["prorrodet_numero"]  ?> </td>
                         <td class="Estilo1b"><? echo number_format($row3["prorrodet_numero"]*100/$suma2,0,',','.')  ?> %</td>
                       </tr>

                        



<?
   $suma=$suma+$row3["prorrodet_numero"];
   $cont++;

}
?>

                       <tr>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"></td>
                         <td class="Estilo1b"><? echo $suma ?> </td>
                         <td class="Estilo1b"> </td>
                       </tr>

                      <tr>


                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                           </form>


</td>
  </tr>
  
  


 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
