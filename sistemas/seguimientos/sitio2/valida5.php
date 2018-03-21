<?
header("content-type: text/html; charset=iso-8859-1");
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
  <title>Defensoria</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="css/estilos.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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




.ir-arriba {
  display:none;
  padding:20px;
  background:#024959;
  font-size:20px;
  color:#fff;
  cursor:pointer;
  position: fixed;
  bottom:20px;
  right:20px;
}


    -->
  </style>
  <link rel="stylesheet" type="text/css" href="select_dependientes.css">
  <script type="text/javascript" src="select_dependientes.js"></script>
  <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
  <!-- <script src="librerias/jquery-1.11.3.min.js"></script> -->


<script type="text/javascript">
    
$(document).ready(function(){

  $('.ir-arriba').click(function(){
    $('body, html').animate({
      scrollTop: '0px'
    }, 300);
  });

  $(window).scroll(function(){
    if( $(this).scrollTop() > 0 ){
      $('.ir-arriba').slideDown(300);
    } else {
      $('.ir-arriba').slideUp(300);
    }
  });

});

$(document).ready(function(){
 
  $('.ir-arriba').click(function(){
    $('body, html').animate({
      scrollTop: '0px'
    }, 300);
  });
 
  $(window).scroll(function(){
    if( $(this).scrollTop() > 0 ){
      $('.ir-arriba').slideDown(300);
    } else {
      $('.ir-arriba').slideUp(300);
    }
  });
 
});


</script>



  <SCRIPT LANGUAGE ="JavaScript">

  function abrirVentana5(eta_id,eta_folio)
  {
    miPopup = window.open("historialdevueltos.php?eta_id="+eta_id+"&eta_folio="+eta_folio,"miwin","width=1000,height=500,scrollbars=yes,toolbar=0")

    miPopup.focus()
  }
    function abrirVentana(eta_id)
    {
      miPopup = window.open("contabilidad_fdevengo.php?eta_id="+eta_id,"miwin","width=550,height=400,scrollbars=yes,toolbar=0")
      miPopup.focus()
    }
    function abrirVentana2(fac_id){

      miPopup = window.open("compra_documentos.php?fac_id="+fac_id,"miwin","width=700,height=500,scrollbars=yes,toolbar=0")

      miPopup.focus()

    }
/*    function abrirVentana3(eta_id){

      miPopup = window.open("fecha_devengo.php?eta_id="+eta_id,"miwin","width=400,height=250,scrollbars=yes,toolbar=0")

      miPopup.focus()

    }*/
    function abrirVentana4(eta_id){

      miPopup = window.open("comprobante_egreso.php?eta_id="+eta_id,"miwin","width=800,height=400,scrollbars=yes,toolbar=0")

      miPopup.focus()

    }
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
    if (document.form1.uno.value == 2 || document.form1.uno.value == 3) {
     seccion1.style.display="";
   } else {
     seccion1.style.display="none";
   }
 }


  function muestra2() {
    if (document.form2.uno22.value == 2 || document.form2.uno22.value == 3) {
     seccion2.style.display="";
   } else {
     seccion2.style.display="none";
   }
 }


 function valida() {
  var numberOfChecked = $('input:checkbox:checked').length;
  if(numberOfChecked == 0)
  {
   alert("Debe seleccionar al menos 1 documento.");
   return false;
 }
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


  if(confirm('\u00BF EST\u00c1 SEGURO DE PROCEDER CON LA ACCI\u00d3N ?')) {
    blockUI();
  }
  else{
    return false;
  }

}



 function valida2() {
  var numberOfChecked = $('input:checkbox:checked').length;
  if(numberOfChecked == 0)
  {
   alert("Debe seleccionar al menos 1 documento.");
   return false;
 }
 if (document.form2.uno22.value==0 || document.form2.uno22.value=='') {
   alert ("No ha seleccionado una Accion ");
   return false;
 }
 if (document.form2.uno22.value==2 && document.form2.justifica2.value=='') {
   alert ("No ha Justificado ");
   return false;
 }
 if (document.form2.uno22.value==3 && document.form2.justifica2.value=='') {
   alert ("No ha Justificado ");
   return false;
 }

 if(confirm('\u00BF EST\u00c1 SEGURO DE PROCEDER CON LA ACCI\u00d3N ?')) {
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

     if ($regionsession==0) {
      $sqlt="select count(eta_id) as Total from dpp_etapas where (eta_estado=5) order by eta_folio desc ";
    } else {
      if ($regionsession==15) {
       $sqlt="select * from dpp_etapas where (eta_estado=5) and eta_region=$regionsession order by eta_folio desc ";
     }
     if ($regionsession<>15) {
       $sqlt="select count(eta_id) as Total from dpp_etapas where (eta_estado=5) and eta_region=$regionsession and (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 = '0000-00-00') and eta_fechaguia2 >= '2017-02-01 00:00:00' order by eta_folio desc ";
     }
   }
   // echo $sqlt;
   $rest = mysql_query($sqlt);
   $rowt = mysql_fetch_array($rest);

   ?>

 </div>
</div>

<div class="col-sm-10 col-lg-10">
  <div class="dash-unit2">

   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td height="20" colspan="2"><span class="Estilo7">1.- RECEPCI&Oacute;N DEL SET DE PAGO</span></td>
   </tr>

   <tr>
     <td><a href="menucontabilidad.php" class="link">Volver</a></td>
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
   $usuario=$_SESSION["nom_user"];


    ini_set('date.timezone','America/Santiago'); 
    $fecha_actual = date("Y-m-d");
   ?>



   <tr>
     <td height="50" colspan="3">
     </table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <form name="form1" action="grabavalida5.php" method="post" onSubmit="return valida()">
                       <!-- <tr>
                         <td></td><td class="Estilo1" colspan=100> <a href="valida6.php" class="link">2.-  ADMINISTRACIÓN PAGO PROVEEDORES</a> | <a href="valida7.php" class="link">3.- ENTREGA PAGO A PROVEEDORES </a>

                       </tr> -->
                       <?php if($rowt["Total"] > 0): ?>
                          
                        <tr>
                         <td  valign="center" class="Estilo1" colspan=3>Acci&oacute;n </td>
                         <td class="Estilo1" colspan=8>
                          <select name="uno" class="Estilo1" onchange="muestra();">
                           <option value="">Seleccione...</option>
                           <option value="1">1.- RECEPCIONAR DOCUMENTO</option>
                           <option value="2">2.- DEVOLVER A SEGUIMIENTO Y CONTROL</option>
                           <!-- <option value="3">3.- RECHAZAR(sacar ciclo/no se paga)</option> -->
                         </select>
                         <div id="seccion1" style="display:none">
                           Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
                         </div>
                         <td>


                         </tr>

                         <tr>
                           <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Grabar Acci&oacute;n "> </td>
                         </tr>

                         <tr>
                           <td><hr></td>
                         </tr>
                       <?php endif ?>
                       <tr>

                        <table border="1" class="table">

                         <tr>
                         <td class="Estilo1ce">Prioridad</td>
                          <td class="Estilo1ce">Op. </td>
                          <td class="Estilo1ce">Folio</td>
                          <td class="Estilo1ce">Rut</td>
                          <td class="Estilo1ce">Nombre</td>
                          <td class="Estilo1ce">Tipo Doc.</td>
                          <td class="Estilo1ce">A pagar</td>
                          <td class="Estilo1ce">N&deg; Doc. </td>
                          <td class="Estilo1d">Documentos</td>
                          <td class="Estilo1ce">Fecha Recibido</td>
                          <td class="Estilo1ce">Dias Transcurridos</td>
                          <td class="Estilo1b">Historial</td>
                          <td class="Estilo1b">Fecha Env&iacute;o SYC</td>


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

                            if ($regionsession == 14 || $regionsession ==13) {
                              $sql="SELECT *, DATEDIFF ('2017-03-12','$fecha_actual') AS diferencia FROM dpp_etapas WHERE (eta_estado=5) AND eta_region=$regionsession AND eta_asignado2='$usuario' AND (eta_usu_recepcion22 = '' or eta_usu_recepcion22 is null) AND eta_fechaguia2 >= '2017-02-01 00:00:00' ORDER BY eta_urgencia DESC, diferencia DESC ";
                            }else{

                              $sql="SELECT *, DATEDIFF ('2017-03-12','$fecha_actual') AS diferencia FROM dpp_etapas WHERE (eta_estado=5) AND eta_region=$regionsession AND (eta_usu_recepcion22 = '' or eta_usu_recepcion22 is null) AND eta_fechaguia2 >= '2017-02-01 00:00:00' ORDER BY eta_urgencia DESC, diferencia DESC ";
                            }

                         }
                       }

 //echo $sql;
                       $res3 = mysql_query($sql);

        if (mysql_num_rows($res3)>0) {


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

                       if($diff <= 10)
                       {
              //VERDE
                         $color="#139c06";
                       }else if($diff > 10 && $diff <= 20)
                       {
              //AZUL
                         $color="#063bcc";
                       }else{
              //ROJO
                         $color="#f00";
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
          // $href2="../../archivos/docfac/".$doc15;
                        $href2="../../archivos/docfac/".date("Y")."/".$doc15;
                      }
                      if ($doc25=="") {
                        $muestra3="X";
                        $href3="#";
                      }
                      if ($doc25<>"") {
                        $muestra3="Ok";
          // $href3="../../archivos/docfac/".$doc25;
                        $href3="../../archivos/docfac/".date("Y")."/".$doc25;
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

                  if($row3["eta_urgencia"] == 1)
                  {
                    $label = "<span class=\"label label-danger\">URGENTE!</span>";
                  }
                  else
                  {
                    $label = "<span class=\"label label-primary\">Normal</span>";
                  }
                  ?>
                  <tr>
                  <td class="text-center"><?php echo $label; ?></td>
                   <td class="Estilo1b">
                    <?php //if ($row3["eta_fdevengo"] <> "0000-00-00" && $row3["eta_fdevengo"] <> ""): ?>
                     <input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" >
                     <input type="hidden" name="folio[<?php echo $cont ?>]" value="<?php echo $row3["eta_folio"] ?>">
                   <?php// else: ?>
                   <?php// endif ?>
                 </td>
                 <input alt="ok" type="hidden" name="var2[<? echo $cont ?>]" value="<? echo $row3["eta_tipo_doc"] ?>" class="Estilo2" >
                 <td class="Estilo1ce"><? echo $row3["eta_folio"]  ?></td>
                 <td class="Estilo1c" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                 <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>
                 <td class="Estilo1ce"><? echo $vartipodoc ?> </td>

                 <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                 <td class="Estilo1c"><? echo $row3["eta_numero"]   ?> </td>


                 <td class="Estilo1d">

                   <a href="#" onClick="abrirVentana2('<?php echo $viene_id ?>')">VER</a>

                   <!-- <a href="#"  data-toggle="modal" data-target="#recupera<? echo $viene_id ?>" data-book-id="1" class="link" > VER </a> -->

                   <?php //include("compra_modal.php") ?>

                 </td>


                 <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>

                 <td class="Estilo1ce"><font color="<?php echo $color ?>"><? echo $diff ?></font></td>
                <td class="Estilo1c text-center"><a href="#" onClick="abrirVentana5('<?php echo $row3["eta_id"]; ?>','<?php echo $row3["eta_folio"]; ?>')" class="link" >VER</a></td>
                <td class="Estilo1c"><?php echo $row3["eta_fechaguia2"] ?></td>
               </tr>





               <?

               $cont++;

             }

        }
        else{
            ?>

              <tr>
                <td colspan="15" class="Estilo1 text-center">&iexcl;No se han recepcionado set de pagos!</td>
              </tr>

          <?
        }

        ?>
          <input type="hidden" name="cont" value="<? echo $cont ?>" >
        </form>



      </table>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>
           <td><hr></td><td><hr></td>
         </tr>
          <tr>
           <td height="20" colspan="2"><span class="Estilo7"> SET DE PAGO PENDIENTES</span></td>
         </tr>
         <tr>
           <td><hr></td><td><hr></td>
         </tr>

        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <form name="form2" action="grabavalida5_2.php" method="post" onSubmit="return valida2()">
                        <!--<tr>
                         <td></td><td class="Estilo1" colspan=100> <a href="valida6.php" class="link">2.-  ADMINISTRACIÓN PAGO PROVEEDORES</a> | <a href="valida7.php" class="link">3.- ENTREGA PAGO A PROVEEDORES </a>

                       </tr> -->
                       <?php if($rowt["Total"] > 0): ?>
                          
                        <tr>
                         <td  valign="center" class="Estilo1" colspan=3>Acci&oacute;n </td>
                         <td class="Estilo1" colspan=8>
                          <select name="uno22" class="Estilo1" onchange="muestra2();">
                           <option value="">Seleccione...</option>
                           <!--<option value="1">1.- RECEPCIONAR DOCUMENTO</option>-->
                           <option value="2">1.- DEVOLVER A SEGUIMIENTO Y CONTROL</option>
                           <!-- <option value="3">2.- RECHAZAR(sacar ciclo/no se paga)</option> -->
                         </select>
                         <div id="seccion2" style="display:none">
                           Justificar <input type="text" name="justifica2" class="Estilo2" size="60" >
                         </div>
                         <td>


                         </tr>

                         <tr>
                           <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton2" class="Estilo2" value="  Grabar Acci&oacute;n "> </td>
                         </tr>

                         <tr>
                           <td><hr></td>
                         </tr>
                       <?php endif ?>
           
              </table>
              <div class="alert alert-warning" role="alert">
              	<p style="font-size: 0.8em;">Estimad@ <strong><?php echo $_SESSION["nombrecom"] ?></strong>, debido a cambios realizados ultimamente en el sistema <strong>SIGEJUN</strong> se informa que a partir del dia <strong>Viernes 19 de Mayo del 2017</strong> para enviar un set de pago a Tesorer&iacute;a 
              	debe completarse el <strong>Devengo</strong> y <strong>Libro de Compras</strong> en el caso de que no lo tuviese.<br>
	Una vez completada la informacion requerida, se habilitar&aacute; un bot&oacute;n (<i class="fa fa-check"></i>) el cual aprobar&aacute; el set y quedar&aacute; disponible para ser enviado a Tesorer&iacute;a.

	<br><br>Recuerde que para devengar los documentos debe hacerse desde el modulo <strong><u><a href="contabilidad_devengo.php">Devengos</a></u></strong>
	<br><br><strong>IMPORTANTE: Puede darse el caso de que los set que est&aacute;n listos para ser aprobados, est&eacute;n tambi&eacute;n disponibles para su env&iacute;o a Tesorer&iacute;a, favor de corroborar dicha informaci&oacute;n antes de enviar.</strong>
	<br><br>Atentamente, Administrador de Sistemas
              	</p>

              </div>

            <table border="1" class="table">

                         <tr>
                         <td class="Estilo1ce">Prioridad</td>
                         <td class="Estilo1ce">Op. </td>
                          <td class="Estilo1ce">Folio</td>
                          <td class="Estilo1ce">Rut</td>
                          <td class="Estilo1ce">Nombre</td>
                          <td class="Estilo1ce">Tipo Doc.</td>
                          <td class="Estilo1ce">A pagar</td>
                          <td class="Estilo1ce">N&deg; Doc. </td>
                          <td class="Estilo1d">Documentos</td>
                          <td class="Estilo1ce">Fecha Recibido</td>
                          <td class="Estilo1ce">Dias Transcurridos</td>
                          <td class="Estilo1ce">Fecha Devengo</td>
                          <!-- <td class="Estilo1ce">N° Egreso</td> -->
                          <!-- <td class="Estilo1ce">Fecha Egreso</td> -->
                          <td class="Estilo1ce">Libro de Compras</td>
                          <td class="Estilo1ce">Aprobar</td>

                        </tr>

                        <?


                        $sql5="select * from dpp_plazos ";
//echo $sql;
                        $res5 = mysql_query($sql5);
                        $row5 = mysql_fetch_array($res5);
                        $etapa5a=$row5["pla_etapa5a"];
                        $etapa5b=$row5["pla_etapa5b"];

                        /*if ($regionsession==0) {
                          $sql="select * from dpp_etapas where (eta_estado=5)  order by eta_folio desc ";
                        } else {
                          if ($regionsession==15) {
                           $sql="select * from dpp_etapas where (eta_estado=5) and eta_region=$regionsession order by eta_folio desc ";
                         }*/
                         if ($regionsession<>15) {

                          


                           $sql=" SELECT *, DATEDIFF ('2017-03-12','$fecha_actual') AS diferencia
                                  FROM dpp_etapas 
                                  WHERE (eta_estado=5) 
                                  AND eta_region=$regionsession
                                  AND eta_asignado2='$usuario'
                                  AND (eta_usu_recepcion22 <> '')
                                  AND (eta_destinatario3 is null or eta_destinatario3 = '')
                                  AND (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 ='0000-00-00')
                                  AND (eta_fechaguia2 >= '2017-02-01 00:00:00')
                                  OR (eta_fdevengo = '' AND eta_fdevengo is null AND eta_fdevengo = '0000-00-00') 
                                  OR (eta_num_egreso = '' AND eta_num_egreso is null AND eta_num_egreso = '0') 
                                  OR (eta_fecha_egreso = '' AND eta_fecha_egreso is null AND eta_fecha_egreso = '0000-00-00')
                                  OR (eta_tipo_doc3 = '' AND eta_tipo_doc3 is null)
                                  ORDER BY eta_urgencia DESC, diferencia DESC ";
                         }
                       //}

//echo $sql;
                       $res3 = mysql_query($sql);


        if (mysql_num_rows($res3)>0) {


                       $cont22=1;

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

$sql5 = "select * from dpp_facturas where fac_eta_id = ".$row3["eta_id"];
// echo $sql5;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$viene_id2 = $row5["fac_id"];


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

                       if($diff <= 10)
                       {
              //VERDE
                         $color="#139c06";
                       }else if($diff > 10 && $diff <= 20)
                       {
              //AZUL
                         $color="#063bcc";
                       }else{
              //ROJO
                         $color="#f00";
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

                     $viene_id3=$row3["eta_id"];
                     $devengo=$row3["eta_fdevengo"];
                     $negreso=$row3["eta_num_egreso"];
                     $fegreso=$row3["eta_fecha_egreso"];
                     $doc3=$row3["eta_tipo_doc3"];


                    if ($devengo=="" || $devengo==null){
                      $muestra1="X";
                      //$href1="#";
                    }
                    if ($devengo<>"") {
                      $muestra1="Ok";
                      //$href1="#";
                    }

                    if ($negreso=="0" || $negreso=="" || $negreso==null) {
                      $muestra2="X";
                      //$href2="#";
                    }
                    if ($negreso>"0") {
                      $muestra2="Ok";
                      //$href2="#";
                    }
                    if ($fegreso=="" || $fegreso==null) {
                      $muestra3="X";
                      //$href3="#";
                    }
                    if ($fegreso<>"") {
                      $muestra3="Ok";
                      //$href3="#";
                    }
                    if ($doc3=="" || $doc3==null) {
                      $muestra4="X";
                      $href4="verdocedit.php?id2=".$viene_id3."&ori=1";
                    }
                    if ($doc3<>"") {
                      $muestra4="Ok";
                      // $href4="verdocedit.php?id2=".$viene_id3;
                      $href4="#";
                    }

                  



                  $read1= rand(0,1000000);
                  $read2= rand(0,1000000);
                  $read3= rand(0,1000000);
                  $read4= rand(0,1000000);


                  if($row3["eta_urgencia"] == 1)
                  {
                    $label = "<span class=\"label label-danger\">URGENTE!</span>";
                  }
                  else
                  {
                    $label = "<span class=\"label label-primary\">Normal</span>";
                  }

                  if($row3["eta_peritaje"] == 0){
                  ?>
                  <tr>
                  <td class="text-center"><?php echo $label; ?></td>
                  <td class="Estilo1b">
                    <?php //if ($row3["eta_fdevengo"] <> "0000-00-00" && $row3["eta_fdevengo"] <> ""): ?>
                     <input alt="ok" type="checkbox" name="var11[<? echo $cont22 ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" >
                     <input type="hidden" name="folio2[<?php echo $cont22 ?>]" value="<?php echo $row3["eta_folio"] ?>">
                   <?php// else: ?>
                   <?php// endif ?>
                 </td>
                 <input alt="ok" type="hidden" name="var22[<? echo $cont22 ?>]" value="<? echo $row3["eta_tipo_doc"] ?>" class="Estilo2" >

                 <td class="Estilo1ce"><? echo $row3["eta_folio"]  ?></td>
                 <td class="Estilo1c" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                 <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>
                 <td class="Estilo1ce"><? echo $vartipodoc ?> </td>

                 <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                 <td class="Estilo1c"><? echo $row3["eta_numero"]   ?> </td>


                 <td class="Estilo1d">

                   <a href="#" onClick="abrirVentana2('<?php echo $viene_id2 ?>')">VER</a>

                   <!-- <a href="#"  data-toggle="modal" data-target="#recupera<? echo $viene_id2 ?>" data-book-id="1" class="link" > VER </a> -->

                   <?php //include("compra_modal.php") ?>

                 </td>


                 <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>

                 <td class="Estilo1ce"><font color="<?php echo $color ?>"><? echo $diff ?></font></td>

                 <td class="Estilo1c text-center"><a href="#" onClick="abrirVentana4('<?php echo $viene_id3 ?>')"><? echo $muestra1 ?></a></td>

                 <!-- <td class="Estilo1c text-center"><a href="#" onClick="abrirVentana4('<?php echo $viene_id3 ?>')"><? echo $muestra2 ?></a></td> -->
                 <!-- <td class="Estilo1c text-center"><a href="#" onClick="abrirVentana4('<?php echo $viene_id3 ?>')"><? echo $muestra3 ?></a></td> -->
                 <td class="Estilo1c text-center"><a href="<? echo $href4; ?>"><? echo $muestra4 ?></a></td>
                  <td class="Estilo1c link text-center">
                  <?php if ($row3["eta_fdevengo"] <> "" && $row3["eta_tipo_doc3"] <> ""): ?>
                  	<a href="contabilidad_aprobar.php?id=<?php echo $row3["eta_id"] ?>" class="link"><i class="fa fa-check fa-lg"></i></a>
                  <?php else: ?>
                  	<i class="fa fa-warning fa-lg"></i>
                  <?php endif ?>
                  </td>
               </tr>





               <?


               $cont22++;
               }

             }


        }
        else{
            ?>

              <tr>
                <td colspan="15" class="Estilo1 text-center">&iexcl;No hay set de pagos pendientes!</td>
              </tr>

          <?
        }

             ?>


               <input type="hidden" name="cont22" value="<? echo $cont22 ?>" >
            </form> 




      </table>










  <span class="ir-arriba"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></span>
 
<!--Agregamos contenido para que aparezca la barra vertical del navegador-->



      <img src="images/pix.gif" width="1" height="10">
    </body>
    </html>

    <?
//require("inc/func.php");
    ?>
