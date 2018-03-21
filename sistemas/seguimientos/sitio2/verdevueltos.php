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
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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
.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif;
font-size: 14px;
font-weight: bold;
text-align: center; }

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
function muestra() {
     if (document.form1.uno.value == 2) {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
     }
}
function valida() {
   if (document.form1.uno.value==0 || document.form1.uno.value=='') {
      alert ("No ha seleccionado una Accion ");
      return false;
  }
   if (document.form1.uno.value==2 && document.form1.justifica.value=='') {
      alert ("No ha Justificado ");
      return false;
  }

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA ACCIÓN ?')) {
      blockUI();
  }
  else{
    return false;
  }


}
  function abrirVentana(eta_id,eta_folio){

    miPopup = window.open("historialdevueltos.php?eta_id="+eta_id+"&eta_folio="+eta_folio,"miwin","width=1000,height=500,scrollbars=yes,toolbar=0")

    miPopup.focus()

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
                    <td height="20" colspan="2"><span class="Estilo7">DEVUELTOS DE RECEPCIÓN ADMINISTRATIVA</span></td>
                  </tr>
<tr>
                             <td  valign="top" class="Estilo1" colspan="4"><a href="facturas.php" class="link" >VOLVER </a><br>  </td>
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
         </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="grabaverdevueltos.php" method="post"  onSubmit="return valida()">
                           <tr>
                             <td  valign="center" class="Estilo1">Acción </td>
                             <td class="Estilo1" colspan=3>
                                <select name="uno" class="Estilo1" onchange="muestra();">
                                   <option value="">Seleccione...</option>
                                   <option value="1">Enviar a Seguimiento y Control</option>
                                   <option value="2">Anular Folio</option>
                                </select>
                                <div id="seccion1" style="display:none">
                                   Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
                                </div>
                              <td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  GRABAR ACCIÓN "> </td>


                           </tr>




                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>

                      <table border=1 width="100%">
                        <tr>
                         <td class="Estilo1b">Folio</td>
                         <td class="Estilo1b">OP</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Tipo Doc.</td>
                         <td class="Estilo1b">A pagar</td>
                         <td class="Estilo1b">N° Doc</td>
                         <td class="Estilo1b">Recepcion </td>
                         <td class="Estilo1b">Dias </td>
                         <td class="Estilo1b">Motivo de Rechazo</td>
                         <td class="Estilo1b">Historial</td>
                        </tr>

<?

$sql5="select * from dpp_plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa1a=$row5["pla_etapa1a"];
$etapa1b=$row5["pla_etapa1b"];
$etapa2a=$row5["pla_etapa2a"];
$etapa2b=$row5["pla_etapa2b"];


$sql="select * from dpp_etapas where ((eta_estado=12) or (eta_estado=1 and eta_folioguia=0)) and eta_region=$regionsession order by eta_fecha_recepcion";
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
    if ($etapa1a>=$diff)
      $clase="Estilo1cverde";
    if ($etapa1a<$diff and $etapa1b>=$diff )
      $clase="Estilo1camarrillo";
    if ( $etapa1b<$diff)
      $clase="Estilo1crojo";
      
    if ($row3["eta_tipo_doc"]=="Honorario") {
        $archivo="honorarioedit.php";
    }
    if ($row3["eta_tipo_doc"]=="Factura") {
        $archivo="facturasedit.php";
    }

?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $row3["eta_folio"] ?> </td>
                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" > </td>
                         <td class="Estilo1b" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_tipo_doc"]  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_numero"]  ?> </td>
                         <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>
                         <td class="Estilo1c"><? echo $diff   ?> </td>
                         <td class="Estilo1c"><?php echo $row3["eta_rechaza_motivo"] ?></td>
                         <td class="Estilo1c text-center"><a href="#" onClick="abrirVentana('<?php echo $row3["eta_id"]; ?>','<?php echo $row3["eta_folio"]; ?>')" class="link" >VER</a></td>
                         <td class="Estilo1c"><a href="<? echo $archivo ?>?id=<? echo $viene_id ?>&id2=<? echo $row3["eta_id"]; ?>" class="link" >Editar</a></td>
                       </tr>

                        



<?

   $cont++;

}
?>


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
