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
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #003063;
	text-align: center;

}
.Estilo1ce {
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
font-size: 14px; font-weight: bold; }
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
function abrirVentana2(fac_id){

      miPopup = window.open("compra_documentos.php?fac_id="+fac_id,"miwin","width=700,height=500,scrollbars=yes,toolbar=0")

      miPopup.focus()

}
function muestra() {
     if (document.form1.uno.value == 2 || document.form1.uno.value == 3) {
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
   if (document.form1.uno.value==3 && document.form1.justifica.value=='') {
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
                    <td height="20" colspan="2"><span class="Estilo7">1.- RECEPCIÓN FÍSICA DOCUMENTOS PARA PAGO </span></td>
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
       <form name="form1" action="grabavalida5b.php" method="post" onSubmit="return valida()">
                       <tr>
                         <td></td><td class="Estilo1" colspan=100> <a href="valida6.php" class="link">2.-  ADMINISTRACIÓN PAGO PROVEEDORES</a> | <a href="valida7.php" class="link">3.- ENTREGA PAGO A PROVEEDORES </a>

                       </tr>
                                               <tr>
                       <td><hr></td>
                      </tr>   

			<tr>
                             <td  valign="center" class="Estilo1" colspan=3>Acción </td>
                             <td class="Estilo1" colspan=8>
                                <select name="uno" class="Estilo1" onchange="muestra();">
                                   <option value="">Seleccione...</option>
                                   <option value="1">1.- RECEPCIONAR DOCUMENTO</option>
                                   <option value="2">2.- DEVOLVER A CONTABILIDAD</option>
                                   <option value="3">3.- RECHAZAR(sacar ciclo/no se paga)</option>
                                </select>
                                <div id="seccion1" style="display:none">
                                   Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
                                </div>
                              <td>
                              

                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Grabar Acción "> </td>
                             

                           </tr>



                      </td>


                       <tr>
                       <td><hr></td>
                      </tr>
                      <tr>

                      <table border=1 class="table table-striped table-hover">

                        <tr>
                         <td class="Estilo1ce">Op. </td>
                         <td class="Estilo1ce">Folio</td>
                         <td class="Estilo1ce">Rut</td>
                         <td class="Estilo1ce">Nombre</td>
                         <td class="Estilo1ce">Tipo Doc.</td>
                         <td class="Estilo1ce">A pagar</td>
                         <td class="Estilo1ce">N° Doc. </td>
                         <td class="Estilo1ce">Descripción Servicio</td>
                         <td class="Estilo1d">Documentos</td>
                         <td class="Estilo1ce">Fecha V°B°</td>
                         <td class="Estilo1ce">Fecha PMG</td>


                        </tr>

<?

$sql5="select * from dpp_plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa5a=$row5["pla_etapa5a"];
$etapa5b=$row5["pla_etapa5b"];

if ($regionsession==0) {
    $sql="select * from dpp_etapas where (eta_estado=5)  order by eta_folio desc ";
} else {
    if ($regionsession==15) {
       $sql="select * from dpp_etapas where (eta_estado=5) and eta_region=$regionsession order by eta_folio desc ";
    }
    if ($regionsession<>15) {
       // $sql="select * from dpp_etapas where (eta_estado=5) and eta_region=$regionsession and eta_usu_recepcion22 <> '' and eta_destinatario3 <> '' order by eta_folio desc ";
      $sql = "select * from dpp_etapas where eta_estado = 5 and eta_fechaguia3 <> '0000-00-00 00:00:00'  and eta_region = ".$regionsession." and eta_destinatario3 <> '' order by eta_folio desc";
    }
}

// echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fecha_recepcion"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24));
    if ($etapa5a>=$diff)
      $clase="Estilo1cverde";
    if ($etapa5a<$diff and $etapa5b>=$diff )
      $clase="Estilo1camarrillo";
    if ( $etapa5b<$diff)
      $clase="Estilo1crojo";
      
      
    $fechahoy = $row3["eta_fecha_aprobacionok"];
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fecha_recepcion"];
    $dia2 = strtotime($fechabase);
    $difff=$dia1-$dia2;
    $diff4=$dia2+$difff;
//    echo $diff."--";
    $diff2=intval($difff/(60*60*24));
    $diff2b=$diff2;
//    echo $diff2."<br>";
    $diff3= date('Y-m-d', $diff4);
   if ($diff2>8 ) {
    $diff5=8*24*60*60;
    //echo $diff5."<br>";
    $diff4=$dia2+$diff5;
    $diff3= date('Y-m-d', $diff4);
    $diff2b=8;
   }


$vartipodoc1=$row3["eta_tipo_doc"];
 if ($vartipodoc1=='Factura') {
     $vartipodoc2=$row3["eta_tipo_doc2"];
   if ($vartipodoc2=="f")
     $vartipodoc="Factura";
   if ($vartipodoc2=="b")
     $vartipodoc="Boleta Servicio";
   if ($vartipodoc2=="r")
     $vartipodoc="Recibo";
   if ($vartipodoc2=="n")
     $vartipodoc="N.Credito";
   if ($vartipodoc2=="bh" or $vartipodoc2=="BH" or $vartipodoc2=="BHS")
     $vartipodoc="Honorario";
 }
 if ($vartipodoc1=='Honorario') {
     $vartipodoc="Honorario";
 }

   //------------ Comienza la muestra de los archivos en el listado tanto para facturas como para honorarios. ------------
   
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
          $href1="../../archivos/docfac/".$archivo5;
        }
        if ($doc15=="") {
          $muestra2="X";
          $href2="#";
        }
        if ($doc15<>"") {
          $muestra2="Ok";
          $href2="../../archivos/docfac/".$doc15;
        }
        if ($doc25=="") {
          $muestra3="X";
          $href3="#";
        }
        if ($doc25<>"") {
          $muestra3="Ok";
          $href3="../../archivos/docfac/".$doc25;
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
          $href1="../../archivos/docfac/".$archivo5;
        }
        if ($doc15=="") {
          $muestra2="X";
          $href2="#";
        }
        if ($doc15<>"") {
          $muestra2="Ok";
          $href2="../../archivos/docfac/".$doc15;
        }
        if ($doc25=="") {
          $muestra3="X";
          $href3="#";
        }
        if ($doc25<>"") {
          $muestra3="Ok";
          $href3="../../archivos/docfac/".$doc25;
        }

    }



$read1= rand(0,1000000);
$read2= rand(0,1000000);
$read3= rand(0,1000000);
$read4= rand(0,1000000);



?>
                      

                       <tr>
                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" >
                         <input type="hidden" name="folio[<?php echo $cont ?>]" value="<?php echo $row3["eta_folio"] ?>"> </td>
                         <input alt="ok" type="hidden" name="var2[<? echo $cont ?>]" value="<? echo $row3["eta_tipo_doc"] ?>" class="Estilo2" >
                         <td class="Estilo1ce"><? echo $row3["eta_folio"]  ?> </td>
                         <td class="Estilo1c" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>
                         <td class="Estilo1ce"><? echo $row3["eta_tipo_doc2"]   ?> </td>

                         <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                         <td class="Estilo1c"><? echo $row3["eta_numero"]   ?> </td>
                         <td class="Estilo1ce"><? echo $row3["eta_servicio_final"]  ?> </td>

                         <td class="Estilo1d">

                                   <a href="#" onClick="abrirVentana2('<?php echo $viene_id ?>')">VER</a>

                                   <!-- <a href="#"  data-toggle="modal" data-target="#recupera<? echo $viene_id ?>" data-book-id="1" class="link" > VER </a> -->

                                   <?php //include("compra_modal.php") ?>

                                 </td>


                         <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_aprobacionok"],8,2)."-".substr($row3["eta_fecha_aprobacionok"],5,2)."-".substr($row3["eta_fecha_aprobacionok"],0,4)   ?></td>
                         
                         <td class="Estilo1ce"><? echo substr($diff3,8,2)."-".substr($diff3,5,2)."-".substr($diff3,0,4)   ?></td>

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
