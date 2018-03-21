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
$date_in=date("Y-m-d");

?>
<html>
<head>
<title>Defensoría</title>
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
	text-align: center;
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
	text-align: center;
}
.Estilo1camarrillo {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #CCCC00;
	text-align: center;
}
.Estilo1crojo {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #CC0000;
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
function muestra() {
     if (document.form1.dos.value == 2) {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
     }
}
function valida() {
   if (document.form1.dos.value==0 || document.form1.dos.value=='') {
      alert ("No ha seleccionado una Acción ");
      return false;
  }
   if (document.form1.dos.value=='no' && document.form1.justifica.value=='') {
      alert ("No ha Justificado ");
      return false;
  }
}

</script>
<body>
<img src="images/pix.gif" width="1" height="10">
<table width="850" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
  <tr>
    <td width="1000">
	  <?
	  require("inc/top.php");
	  ?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="265" valign="top">
		  <?
		  require("inc/menu_1.php");
		  ?>		  </td>
          <td valign="top"><strong>
            <img src="images/pix.gif" width="1" height="10">
                    </strong>            <table width="630" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="630" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfonre.gif"><table width="630" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">DESPACHO DOCUMENTO</span></td>
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

     <table width="588" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="grabaasignaguia.php" method="post" enctype="multipart/form-data" onSubmit="return valida()">

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Generar Guía "> </td>


                           </tr>

                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      <td class="Estilo1" colspan=4>
                      <table border=1>
                             <tr>
                               <td class="Estilo1c">FOLIO</td>
                               <td class="Estilo1c">UNIDAD DESTINO</td>
                               <td class="Estilo1c">FECHA CREACION</td>
                               <td class="Estilo1c">FECHA ENTREGA</td>
                               <td class="Estilo1c">REVISADO POR</td>
 				               <td class="Estilo1c">TIPO DOC.</td>
                               <td class="Estilo1c">MATERIA___DEL__DOCUMENTO</td>
                               <td class="Estilo1c">ESTADO FINAL</td>
                               <td class="Estilo1c">VER</td>
                              </tr>

<?
                                  if ($regionsession==0) {
                                     $sql2 = "Select * from dpp_etapas where eta_estado=4  order by eta_id desc ";
                                  } else {
                                    $sql2 = "Select * from dpp_etapas  where (eta_estado=4 or eta_estado=5) and eta_folioguia=0 and eta_region='$regionsession'  ";
                                  }




                                  //echo "--->".$sql2;
                                  $res2 = mysql_query($sql2);
                                   $cont=1;
                                   while($row2 = mysql_fetch_array($res2)){
                                                $uni_id=$row2["eta_unidad"];
                                                $uni_id2=$row2["eta_unidad2"];
                                                $tipo_id=$row2["eta_tipo"];
                                                $doc_id=$row2["eta_documento"];
                                                $req_id=$row2["eta_requerimiento"];
                                                $estadodoc_id=$row2["eta_estadodoc"];
                                                $dias=$row2["eta_plazo"];

    $sql5="select * from dpp_plazos where pla_dias=$dias ";
    //echo $sql;
    $res5 = mysql_query($sql5);
    $row5 = mysql_fetch_array($res5);
    $etapa1a=$row5["pla_etapa1a"];
    $etapa1b=$row5["pla_etapa1b"];

                                                
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row2["eta_fecha_pla"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24));
    $diff=$diff*-1;
    $clase="Estilo1c";
    $etapaplazo=$row2["eta_plazo"];
    if ($etapaplazo<>0) {
 //    echo $etapa1a."-".$etapa1b;
      if ($etapa1a>=$diff)
        $clase="Estilo1crojo";
      if ($etapa1a<$diff and $etapa1b>=$diff )
        $clase="Estilo1camarrillo";
      if ( $etapa1b<$diff)
        $clase="Estilo1cverde";
    }





                                     $sql3 = "Select * from dpp_deptos2 where depto_id=$uni_id  ";
                                     //echo $sql;
                                     $res3 = mysql_query($sql3);
                                     $row3 = mysql_fetch_array($res3);
                                     $uni_nombre=$row3["depto_nombre"];
                                     
                                     $sql3 = "Select * from dpp_deptos2 where depto_id=$uni_id2  ";
                                     //echo $sql;
                                     $res3 = mysql_query($sql3);
                                     $row3 = mysql_fetch_array($res3);
                                     $uni_nombre2=$row3["depto_nombre"];


                                     $sql3 = "Select * from tipodocumento  where id=$tipo_id  ";
                                     //echo $sql;
                                     $res3 = mysql_query($sql3);
                                     $row3 = mysql_fetch_array($res3);
                                     $tipo_nombre=$row3["opcion"];

                                     $sql3 = "Select * from documento  where id=$doc_id  ";
                                     //echo $sql;
                                     $res3 = mysql_query($sql3);
                                     $row3 = mysql_fetch_array($res3);
                                     $doc_nombre=$row3["opcion"];


                                     $sql3 = "Select * from dpp_requerimiento where req_id=$req_id  ";
                                     //echo $sql;
                                     $res3 = mysql_query($sql3);
                                     $row3 = mysql_fetch_array($res3);
                                     $req_nombre=$row3["req_nombre"];

                                     $sql3 = "Select * from dpp_estadodoc where estdoc_id=$estadodoc_id  ";
                                     //echo $sql;
                                     $res3 = mysql_query($sql3);
                                     $row3 = mysql_fetch_array($res3);
                                     $estdoc_nombre=$row3["estdoc_nombre"];





                              ?>
                                  <tr>
                                  <td class="Estilo1c"><? echo $row2["eta_folio"] ?></td>
                                  <td class="Estilo1c"><? echo $uni_nombre2 ?></td>
                                  <td class="Estilo1c"><? echo substr($row2["eta_fecha1"],8,2)."-".substr($row2["eta_fecha1"],5,2)."-".substr($row2["eta_fecha1"],0,4)   ?></td>
                                  <td class="<? echo $clase ?>"><? echo substr($row2["eta_fecha_pla"],8,2)."-".substr($row2["eta_fecha_pla"],5,2)."-".substr($row2["eta_fecha_pla"],0,4)   ?></td>
                                  <td class="Estilo1c"><? echo $row2["eta_asignado"] ?></td>
                  				  <td class="Estilo1c"><? echo $doc_nombre ?></td>
				                  <td class="Estilo1b"><? echo $row2["eta_materia"] ?></td>
                                  <td class="Estilo1c"><? echo $estdoc_nombre ?></td>
<?
                            if ($uni_nombre2=="") {
?>
                                  <td class="Estilo1c"><a href="despachar.php?id=<? echo $row2["eta_id"]?>&ori=3" class="link" >Ver</a></td>
                              <?
}
                                    $cont++;
              }

?>


                      <tr>

                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                           </form>


</td>
  </tr>

 
</table>

                      <table border=1>
<tr></tr>


<br>
<tr class="Estilo8"><td colspan="5">IMPRIMIR GUÍA DESPACHO INTERNO</td></tr>

                        <tr>
                         <td class="Estilo1b">Nº de Guía</td>
                         <td class="Estilo1b">Unidad</td>
                         <td class="Estilo1b">Fecha Guía</td>
                         <td class="Estilo1b">Ver Guía</td>
                        </tr>
<?

  $sql="select * from dpp_etapas where  eta_region='$regionsession' and eta_folioguia<>0 group by eta_folioguia order by eta_folioguia desc LIMIT 0 , 10 ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
    $uni2_id=$row3["eta_unidad2"];
    $sql3b = "Select * from dpp_deptos2 where depto_id=$uni2_id  ";
    //echo $sql;
    $res3b = mysql_query($sql3b);
    $row3b = mysql_fetch_array($res3b);
    $uni2_nombre=$row3b["depto_nombre"];

    
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

?>


                       <tr>
                         <td class="Estilo1b"><? echo $row3["eta_folioguia"] ?> </td>
                         <td class="Estilo1b"><? echo $uni2_nombre ?> </td>
                         <td class="Estilo1b" title="<? echo $row3["eta_fechaguia"]  ?>"><? echo $row3["eta_fechaguia"]  ?></td>
                         <td class="Estilo1c"><a href="imprimirguia.php?guia=<? echo $row3["eta_folioguia"] ?>" class="link" target="_blank">IMPRIMIR</a></td>

                       </tr>





<?

   $cont++;

}
?>




</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
