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
                    <td height="20" colspan="2"><span class="Estilo7">RECHAZADOS HISTORICO, CON CARTA DE AVISO </span></td>
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

     <table width="488" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="rechazos2.php" method="get">
                           <tr>
                             <td  valign="center" class="Estilo1">Rut <input type="text" name="rut" class="Estilo2" size="10" value="<? echo $rut ?>" > </td>
                             <td class="Estilo1" colspan=3>Fecha Recepcion
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c1" readonly="1">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>



                              <td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=6 align="center"><input type="submit" name="boton" class="Estilo2" value="  Buscar ">  <a href="rechazos2.php"> Limpiar </a> </td>
                             

                           </tr>

                            </form>


                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      <td class="Estilo1" colspan=4>
                      <table border=1>
                        <tr>
                         <td class="Estilo1b">Nº</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Tipo Doc.</td>
                         <td class="Estilo1b">Motivo_Final</td>
                         <td class="Estilo1b">Ficha</td>
                         <td class="Estilo1b">NºDoc</td>
                         <td class="Estilo1b">Recepcion </td>
                         <td class="Estilo1b">Dias </td>
                        </tr>

<?



//echo $sql5;

$sql5="select * from dpp_plazos";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa1=$row5["pla_etapa1"];
$etapa2=$row5["pla_etapa2"];
$etapa3=$row5["pla_etapa3"];
$etapa4=$row5["pla_etapa4"];
$etapa5=$row5["pla_etapa5"];


$sql="select * from dpp_etapas where ";
$sw=0;
if ($rut<>"") {
   $sql.=" eta_rut like '%$rut%' and ";
   $sw=1;
}
if ($fecha1<>"") {
   $sql.=" eta_fecha_recepcion  = '$fecha1' and ";
   $sw=1;
}
if ($sw==1) {
    $sql.=" eta_estado=15  ";
}
if ($sw==0) {
    $sql="select * from dpp_etapas where eta_estado=15 order by eta_fecha_final";
}

//$sql="select * from dpp_etapas where eta_estado=15 order by eta_fecha_recepcion";
//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fecha_recepcion"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24));
    if ($etapa1<=$diff)
      $clase="Estilo1crojo";
    if ($etapa1>$diff)
      $clase="Estilo1camarrillo";
    if ( 0 > $diff)
      $clase="Estilo1cverde";

    if ($row3["eta_tipo_doc"]=="Factura") {
        $archivo="rechazodoc.php";
    }
    if ($row3["eta_tipo_doc"]=="Honorario") {
        $archivo="rechazodochono.php";
    }

    $eta_id=$row3["eta_id"];
    
    $sql5="select * from dpp_facturas where fac_eta_id=$eta_id";
//    echo $sql5;
    $res5 = mysql_query($sql5);
    $row5=mysql_fetch_array($res5);
    $viene_id=$row5["fac_id"];




?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1b" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_tipo_doc"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["eta_motivo_final"]  ?> </td>
                         <td class="Estilo1c"><a href="<? echo $archivo ?>?id2=<? echo $row3["eta_id"] ?>" class="link" target="_blank">VER</a></td>
                         <td class="Estilo1c"><? echo $row3["eta_numero"]  ?> </td>
                         <td class="<? echo $clase ?>"><? echo $row3["eta_fecha_recepcion"]  ?> </td>
                         <td class="Estilo1c"><? echo $diff   ?> </td>
                       </tr>

                        



<?

   $cont++;

}
?>


                      <tr>

                               <input type="hidden" name="cont" value="<? echo $cont ?>" >



</td>
  </tr>

 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
