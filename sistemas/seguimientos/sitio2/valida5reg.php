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

    function abrirVentana(fac_id){

      miPopup = window.open("compra_documentos.php?fac_id="+fac_id,"miwin","width=700,height=500,scrollbars=yes,toolbar=0")

      miPopup.focus()

    }

    function aparece(){


     if (document.form1.commodity.value == 'Other') {
       document.form1.specifications.style.display='';
     } else {
       document.form1.specifications.style.display='none';
     }
     if (document.form1.commodity.value == 'Fishmeal') {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
     }
     if (document.form1.commodity.value == 'Fishoil') {
       seccion2.style.display="";
     } else {
       seccion2.style.display="none";
     }
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


  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON EL ENVÍO ?')) {
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
  <div class="col-sm-3 col-lg-3">
    <div class="dash-unit2">

      <?
      require("inc/menu_1.php");
      ?>

    </div>
  </div>

  <div class="col-sm-9 col-lg-9">
    <div class="dash-unit2">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="20" colspan="2"><span class="Estilo7">GENERA GUÍA PARA TESORERÍA</span></td>
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
       $id=$_GET["id"];
       $ori=$_GET["ori"];
       if ($ori==1) {
         $sql2 = "update dpp_etapas set eta_estado=2 where eta_id=$id";
//    echo $sql2;
         mysql_query($sql2);

       }

       ?>


       
       <tr>
        <td height="50" colspan="3">
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <form name="form1" action="grabavalida5reg.php" method="post" enctype="multipart/form-data"  onSubmit="return valida()">
           <tr>
             <td  valign="center" class="Estilo1"></td>
             <td class="Estilo1" colspan=3>
               <input type="hidden" name="uno" value="1" >
               <div id="seccion1" style="display:none">
                 Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
               </div>
               <td>
               </tr>
               <tr>
                 <td valign="center" class="Estilo1">Destinatario
                   <td class="Estilo1" colspan=3> <input type="text" name="destinatario" class="Estilo2" size="40" required>


                     <tr>
                       <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Enviar a Tesoreria "> </td>
                       

                     </tr>



                   </td>


                   <tr>
                     <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                   </tr>
                   <tr>
                    <td class="Estilo1" colspan=4>

                      <table border="1" width="100%">
                        <tr>
                         <td class="Estilo1b" colspan="11"><input type='checkbox' name='checkbox11' value='checkbox' onClick='ChequearTodos(this);'>TODOS</td>
                         
                       </tr>

                       <tr>
                         <td class="Estilo1c">Op. </td>
                         <td class="Estilo1c">Folio</td>
                         <td class="Estilo1c">Rut</td>
                         <td class="Estilo1c">Nombre</td>
                         <td class="Estilo1c">N° Docto.</td>
                         <td class="Estilo1c">Tipo Doc.</td>
                         <td class="Estilo1c">A pagar</td>
                         <td class="Estilo1c">Recepción </td>
                         <td class="Estilo1c">Documentos</td>
                         <td class="Estilo1c">Días </td>
                         <!-- <td class="Estilo1c">Volver </td> -->
                       </tr>

                       <?
                       $sql5="select * from dpp_plazos ";
//echo $sql;
                       $res5 = mysql_query($sql5);
                       $row5 = mysql_fetch_array($res5);
                       $etapa4a=$row5["pla_etapa4a"];
                       $etapa4b=$row5["pla_etapa4b"];


                       if ($regionsession==0) {
                        $sql="select * from dpp_etapas where eta_estado=5 order by eta_fecha_recepcion";
                      } else {
                        // $sql="select * from dpp_etapas where eta_estado=5 and eta_region=$regionsession and eta_usu_recepcion22 <> '' and (eta_destinatario3 is null or eta_destinatario3 = '') and eta_fdevengo <> '0000-00-00' and eta_num_egreso <> '' and eta_fecha_egreso <> '0000-00-00' and eta_tipo_doc3 <> '' order by eta_fecha_recepcion";
                        $sql="select * from dpp_etapas where eta_estado=5 and eta_region=$regionsession and eta_usu_recepcion22 <> '' and (eta_destinatario3 is null or eta_destinatario3 = '') and eta_fdevengo <> '0000-00-00' AND (eta_peritaje = 1 or eta_peritaje = 0) and eta_tipo_doc3 <> '' order by eta_fecha_recepcion";
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
                        if ($etapa4a>=$diff)
                          $clase="Estilo1cverde";
                        if ($etapa4a<$diff and $etapa4b>=$diff )
                          $clase="Estilo1camarrillo";
                        if ( $etapa4b<$diff)
                          $clase="Estilo1crojo";

                        $muestra1="X";
                        if ($row3["eta_tipo_doc"]=="Factura") {
                          $archivo="verdoc.php";
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
                          $archivo="verdoc2.php";

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
                        
                        $archivo6 = $row3["eta_nroresolucion"];
                        if($archivo6 == "")
                        {
                          $muestra4="X";
                          $href4="#";
                        }

                        if($archivo6 <> "")
                        {
                          $muestra4="Ok";
                          $sql_f4 = mysql_query("SELECT docs_archivo FROM argedo_documentos WHERE docs_folio = ".$archivo6." AND docs_defensoria = ".$_SESSION["region"]);
                          $sql_f4 = mysql_fetch_array($sql_f4);
                          $href4="../../archivos/docargedo/".$sql_f4["docs_archivo"];
                        }  

                        $vartipodoc1=$row3["eta_tipo_doc"];
                        if ($vartipodoc1=='Factura') {
                         $vartipodoc2=$row3["eta_tipo_doc2"];
                         if ($vartipodoc2=="f")
                           $vartipodoc="Factura";
                         if ($vartipodoc2=="FEL")
                           $vartipodoc="Factura";
                         if ($vartipodoc2=="b")
                           $vartipodoc="Boleta Servicio";
                         if ($vartipodoc2=="r")
                           $vartipodoc="Recibo";
                         if ($vartipodoc2=="n")
                           $vartipodoc="N.Credito";
                         if ($vartipodoc2=="bh")
                           $vartipodoc="Honorario";
                       }
                       if ($vartipodoc1=='Honorario') {
                         $vartipodoc="Honorario";
                       }

                       ?>
                       

                       <tr>
                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" > </td>
                         <td class="Estilo1b"><? echo  $row3["eta_folio"] ?> </td>
                         <td class="Estilo1b" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_numero"]  ?> </td>
                         <td class="Estilo1b"><? echo $vartipodoc  ?> </td>
                         <td class="Estilo1b"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                         <td class="<? echo $clase ?>"><? echo $row3["eta_fecha_recepcion"]  ?> </td>
                         <td class="Estilo1b"><a href="#" onClick="abrirVentana('<?php echo $viene_id ?>')">VER</a> </td>
                         <td class="Estilo1b"><? echo $diff ?> </td>
                         <!-- <td class="Estilo3c"><a href="valida4reg.php?id=<? echo $row3["eta_id"] ?>&ori=1" class="link" onclick="return confirm('Seguro que desea volver el Documento a V°B°?')">Volver</a></td> -->
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
               <br>
               <table border=1>
                <tr class="Estilo8"><td colspan=4> GUÍA DESPACHO INTERNO</tr>

                <tr>
                 <td class="Estilo1b">Nº de Guía</td>
                 <td class="Estilo1b">Nombre Destinatario</td>
                 <td class="Estilo1b">Fecha Guía</td>
                 <td class="Estilo1b">Ver Guía</td>
               </tr>
               <?

               $sql="select * from dpp_etapas where  eta_region='$regionsession' and eta_folioguia3<>0 AND eta_fechaguia3 >= '2017-02-01 00:00:00' group by eta_fechaguia3, eta_folioguia3 order by eta_fechaguia3 desc, eta_folioguia3 desc LIMIT 0 , 100 ";

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
                
                $anno=substr($row3["eta_fechaguia3"],0,4);

                ?>


                <tr>
                 <td class="Estilo1b"><? echo $row3["eta_folioguia3"] ?> </td>
                 <td class="Estilo1b" title="<? echo $row3["eta_destinatario3"]  ?>"><? echo $row3["eta_destinatario3"]  ?></td>
                 <td class="Estilo1b" title="<? echo $row3["eta_fechaguia3"]  ?>"><? echo $row3["eta_fechaguia3"]  ?></td>
                 <td class="Estilo1c"><a href="imprimirguia3.php?guia=<? echo $row3["eta_folioguia3"] ?>&anno=<? echo $anno ?>" class="link" target="_blank">IMPRIMIR</a></td>

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
