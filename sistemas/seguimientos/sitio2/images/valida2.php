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
function muestra() {
     if (document.form1.dos.value == 'no') {
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
            <table width="629" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="630" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif"><table width="600" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">&nbsp;&nbsp;&nbsp;DERIVACIÓN A V°B°</span></td>
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

     <table width="515" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="grabavalida2.php" method="post" enctype="multipart/form-data" onSubmit="return valida()">
                           <tr>
                             <td  valign="center" class="Estilo1">&nbsp;&nbsp;&nbsp;Acción </td>
                             <td class="Estilo1" colspan=3>
                                <select name="dos" class="Estilo1" onchange="muestra();">
                                   <option value="">Seleccione...</option>
                                   <option value="si">Derivar a Aprobación Pago</option>
                                   <option value="no">No Recepcionar</option>


                                </select>
                                <div id="seccion1" style="display:none">
                                   Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
                                </div>

                              <td>

                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="boton" class="Estilo2" value="  Acepta Acción "> </td>
                             

                           </tr>



                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      <td class="Estilo1" colspan=4>
                      <table border=1>
                        <tr>
                         <td class="Estilo1b" colspan="8"><input type='checkbox' name='checkbox11' value='checkbox' onClick='ChequearTodos(this);'>TODOS</td>
                         <td class="Estilo1b" colspan=3>Documentos</td>
                        </tr>

                        <tr>
				 <td class="Estilo1d">Folio</td>
                    	 <td class="Estilo1d">Estado</td>
                         <td class="Estilo1d">Rut_Proveed</td>
                         <td class="Estilo1d">Proveedor</td>
                         <td class="Estilo1d">Tipo</td>
                         <td class="Estilo1d">A pagar</td>
                         <td class="Estilo1d">N° Doc </td>
                         <td class="Estilo1d">Recepción</td>
                         <td class="Estilo1d">Fac</td>
                         <td class="Estilo1d">O.C.</td>
                         <td class="Estilo1d">Res</td>
                         <td class="Estilo1d">Días </td>
                         <td class="Estilo1d">FICHA</td>
                        </tr>

<?
$sql5="select * from dpp_plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa1=$row5["pla_etapa1"];
$etapa2a=$row5["pla_etapa2a"];
$etapa2b=$row5["pla_etapa2b"];
$etapa3=$row5["pla_etapa3"];
$etapa4=$row5["pla_etapa4"];
$etapa5=$row5["pla_etapa5"];

$sql="select * from dpp_etapas where eta_estado=2 or eta_estado=3  order by eta_folio desc";
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
    if ($etapa2a>=$diff)
      $clase="Estilo1cverde";
    if ($etapa2a<$diff and $etapa2b>=$diff )
      $clase="Estilo1camarrillo";
    if ( $etapa2b<$diff)
      $clase="Estilo1crojo";


    $muestra1="X";
    if ($row3["eta_tipo_doc"]=="Factura") {
        $archivo="facturasarchivos.php";
        $eta_id=$row3["eta_id"];
        $sql5="select * from dpp_facturas where fac_eta_id=$eta_id";
        //echo $sql;
        $res5 = mysql_query($sql5);
        $row5=mysql_fetch_array($res5);
        $archivo5=$row5["fac_archivo"];
        $doc15=$row5["fac_doc1"];
        $doc25=$row5["fac_doc2"];
        $viene_id=$row5["fac_id"];
        if ($archivo5==""){
          $muestra1="X";
          $href1="#";
        }
        if ($archivo5<>"") {
          $muestra1="Ok";
          $href1="documentos/files/".$archivo5;
        }
        if ($doc15=="") {
          $muestra2="X";
          $href2="#";
        }
        if ($doc15<>"") {
          $muestra2="Ok";
          $href2="documentos/files/".$doc15;
        }
        if ($doc25=="") {
          $muestra3="X";
          $href3="#";
        }
        if ($doc25<>"") {
          $muestra3="Ok";
          $href3="documentos/files/".$doc25;
        }
    }
    if ($row3["eta_tipo_doc"]=="Honorario") {
        $archivo="honorarioarchivos.php";

        $eta_id=$row3["eta_id"];
        $sql5="select * from dpp_honorarios where hono_eta_id=$eta_id";
        //echo $sql;
        $res5 = mysql_query($sql5);
        $row5=mysql_fetch_array($res5);
        $archivo5=$row5["hono_archivo"];
        $doc15=$row5["hono_doc1"];
        $doc25=$row5["hono_doc2"];
        $viene_id=$row5["hono_id"];
        if ($archivo5==""){
          $muestra1="X";
          $href1="#";
        }
        if ($archivo5<>"") {
          $muestra1="Ok";
          $href1="documentos/files/".$archivo5;
        }
        if ($doc15=="") {
          $muestra2="X";
          $href2="#";
        }
        if ($doc15<>"") {
          $muestra2="Ok";
          $href2="documentos/files/".$doc15;
        }
        if ($doc25=="") {
          $muestra3="X";
          $href3="#";
        }
        if ($doc25<>"") {
          $muestra3="Ok";
          $href3="documentos/files/".$doc25;
        }

    }

?>
                      

                       <tr>
				<td class="Estilo1d"><? echo $row3["eta_folio"]  ?> </td>

                       <?
                         if ($muestra1=="Ok" and $muestra2=="Ok" and $row3["eta_fecha_aprobacionok"]<>'0000-00-00' and $row3["eta_rechaza_motivo2"]=="") {
                       ?>
                         <td class="Estilo1b"><? echo $cont  ?><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" > </td>
                       <?
                        }
                        if ($row3["eta_rechaza_motivo2"]<>"") {
                       ?>
                         <td class="Estilo1b"><? echo $cont  ?> Rech. </td>
                       <?
                         }
                        if ($row3["eta_estado"]=="2") {
                        ?>
                         <td class="Estilo1b"><? echo $cont  ?> Sin</td>
                        <?
                        }
                        if ($row3["eta_estado"]=="3" and $row3["eta_subestado"]==0) {
                        ?>
                         <td class="Estilo1b"> <? echo $cont  ?> XAp. </td>
                        <?
                        }

                        ?>


                         <td class="Estilo1d" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                         <td class="Estilo1d"><? echo $row3["eta_cli_nombre"]  ?> </td>
                         <td class="Estilo1d"><? echo $row3["eta_tipo_doc"]  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                         <td class="Estilo1c"><? echo $row3["eta_numero"]  ?>(<? echo $row3["eta_estado"]  ?>) </td>
                         <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>
                         <td class="Estilo1d"><a href="<? echo $href1 ?>" class="link" target="_blank"><? echo $muestra1 ?></a> </td>
                         <td class="Estilo1d"><a href="<? echo $href2 ?>" class="link" target="_blank"><? echo $muestra2 ?></a> </td>
                         <td class="Estilo1d"><a href="<? echo $href3 ?>" class="link" target="_blank"><? echo $muestra3 ?></a> </td>
                         <td class="Estilo1c"><? echo $diff   ?> </td>
                         <td class="Estilo1d"><a href="<? echo $archivo ?>?id=<? echo $viene_id ?>&id1b=<? echo $row3["eta_id"] ?>" class="link" >VER</a></td>
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
