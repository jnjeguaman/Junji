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

$annomio=date("Y");

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

    font-weight: bold;}

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

              <td height="20" colspan="2"><span class="Estilo7">CONSULTAS DE FACTURAS</span></td>

            </tr>

            <tr>

             <td><hr></td><td><hr></td>

           </tr>
           <?
           // if(isset($_GET['region'])) {
           //      $region=$_GET['region'];
           //  }
           //  else{
           //    $region=$regionsession;
           //  }

           $region=$_GET["region"];

           $fecha1=$_GET["fecha1"];

           $fecha2=$_GET["fecha2"];

           $rut=$_GET["rut"];

           $documento=$_GET["documento"];

           $etapa=$_GET["etapa"];

           $item=$_GET["item"];

           $proveedor=$_GET["proveedor"];

           $folio=$_GET["folio"];

           $consolidado=$_GET["consolidado"];

           $year=$_GET["year"];

           $fpago=$_GET["fpago"];

           $noc=$_GET["noc"];



           if (!isset($year)) {

            $year=$annomio;

          }



          ?>



          <!-- <a href="menuadministracion.php" class="link">VOLVER</a> <br> -->





        </table>
 
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">

         <form name="form1" action="consultasgenerales.php" method="get">

           <tr>

             <td  valign="top" class="Estilo1">Región</td>

             <td  colspan=3 class="Estilo1">

              <select name="region" class="Estilo1">



               <?

               if ( ($regionsession==0 || $regionsession == 14) || $nivel==23) {

                $sql2 = "Select * from regiones where codigo<20";

                echo '<option value="0">Todas</option>';

              } else {

              // $sql2 = "Select * from regiones where codigo=$regionsession ";
                $sql2 = "Select * from regiones where codigo<20";
                echo '<option value="0">Todas</option>';
            }
                                  

              $res2 = mysql_query($sql2);



              while($row2 = mysql_fetch_array($res2)){



               ?>

               <option value="<? echo $row2["codigo"] ?>" <? if ($row2["codigo"]==$region) echo "selected=selected" ?> ><? echo $row2["nombre"] ?></option>



               <?

             }

             ?>





           </select>

         </td>

       </tr>

       <tr>

         <td  valign="center" class="Estilo1">Fechas de Recepción</td>

         <td colspan=3 class="Estilo1">

          <input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c2" readonly="1">

          <img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"

          onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



          <script type="text/javascript">

            Calendar.setup({

        inputField     :    "f_date_c2",     // id of the input field

        ifFormat       :    "%Y-%m-%d",      // format of the input field

        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)

        align          :    "Tl",           // alignment (defaults to "Bl")

        singleClick    :    true

      });

    </script>



    a

    <input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha2 ?>" id="f_date_c3" readonly="1">

    <img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"

    onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



    <script type="text/javascript">

      Calendar.setup({

        inputField     :    "f_date_c3",     // id of the input field

        ifFormat       :    "%Y-%m-%d",      // format of the input field

        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)

        align          :    "Tl",           // alignment (defaults to "Bl")

        singleClick    :    true

      });

    </script>



  </td>



</tr>

<tr>

 <td  valign="top" class="Estilo1">Rut  </td>

 <td class="Estilo1" colspan=3>

  <input type="text" name="rut" class="Estilo2" size="15" value="<? echo $rut ?>">

</td>

</tr>

<tr>

 <td  valign="top" class="Estilo1">Nro. Documento  </td>

 <td class="Estilo1" colspan=3>

  <input type="text" name="documento" class="Estilo2" size="15" value="<? echo $documento ?>">

</td>

</tr>

<tr>

 <td  valign="top" class="Estilo1">Nombre Proveedor  </td>

 <td class="Estilo1" colspan=3>

  <input type="text" name="proveedor" class="Estilo2" size="49" value="<? echo $proveedor ?>">

</td>

</tr>

<tr>

 <td  valign="top" class="Estilo1">AÑO </td>

 <td class="Estilo1" colspan=3>

   <select name="year" class="Estilo1" >

    <option value="">Seleccione...</option>

    <option value="2010" <? if ($year==2010) echo "selected=selected" ?> >2010</option>

    <option value="2011" <? if ($year==2011) echo "selected=selected" ?> >2011</option>

    <option value="2012" <? if ($year==2012) echo "selected=selected" ?> >2012</option>

    <option value="2013" <? if ($year==2013) echo "selected=selected" ?> >2013</option>

    <option value="2014" <? if ($year==2014) echo "selected=selected" ?> >2014</option>

    <option value="2015" <? if ($year==2015) echo "selected=selected" ?> >2015</option>

    <option value="2016" <? if ($year==2016) echo "selected=selected" ?> >2016</option>

    <option value="2017" <? if ($year==2017) echo "selected=selected" ?> >2017</option>

    <option value="2018" <? if ($year==2018) echo "selected=selected" ?> >2018</option>

    <option value="2019" <? if ($year==2019) echo "selected=selected" ?> >2019</option>

    <option value="2020" <? if ($year==2020) echo "selected=selected" ?> >2020</option>

    <option value="2021" <? if ($year==2021) echo "selected=selected" ?> >2021</option>



  </select>



</td>

</tr>



<tr>

 <td  valign="top" class="Estilo1">Folio </td>

 <td class="Estilo1" colspan=3>

  <input type="text" name="folio" class="Estilo2" size="15" value="<? echo $folio ?>">

</td>

</tr>

<tr>

 <td  valign="top" class="Estilo1">N° Orden de Compra </td>

 <td class="Estilo1" colspan=3>

  <input type="text" name="noc" class="Estilo2" size="15" value="<? echo $noc ?>">

</td>

</tr>



<tr>

 <td  valign="top" class="Estilo1">Etapa  </td>

 <td class="Estilo1" colspan=3>

  <select name="etapa" class="Estilo1">

   <option value="">Todas</option>

<!--    <option value="1">ETAPA 1: INGRESO OFICINA DE PARTES</option>

   <option value="2">ETAPA 2: PENDIENTE ADMINISTRACIÓN</option>

   <option value="3">ETAPA 3: EN PROCESO SIGFE</option>

   <option value="6">ETAPA 6: PENDIENTE CONTABILIDAD </option>

   <option value="7">ETAPA 7: PENDIENTE PAGO A PROVEEDOR</option>

   <option value="8">ETAPA 8: PAGADOS </option>

   <option value="9">ETAPA 9: CHEQUES CADUCADOS </option>

   <option value="99">ETAPA : RECHAZADOS </option> -->


   <option value="1" <? if ($etapa==1) echo "selected=selected" ?> >OF. PARTES (INGRESO DE DOCUMENTOS)</option>

   <option value="2" <? if ($etapa==2) echo "selected=selected" ?> >SEGUIMIENTO Y CONTROL (PENDIENTES DE RECEPCION)</option>

   <option value="3" <? if ($etapa==3) echo "selected=selected" ?> >SEGUIMIENTO Y CONTROL (PENDIENTE DE DESPACHO)</option>

   <option value="4" <? if ($etapa==4) echo "selected=selected" ?> >CONTABILIDAD (PENDIENTES DE RECEPCION)</option>

   <option value="5" <? if ($etapa==5) echo "selected=selected" ?> >CONTABILIDAD (PENDIENTE DE DESPACHO)</option>

   <option value="6" <? if ($etapa==6) echo "selected=selected" ?> >TESORERIA (PENDIENTES DE RECEPCION)</option>

   <option value="7" <? if ($etapa==7) echo "selected=selected" ?> >TESORERIA (PENDIENTES DE PAGO A PROVEEDORES)</option>

   <option value="77" <? if ($etapa==77) echo "selected=selected" ?> >TESORERIA (PAGO CON CHEQUE EN PROCESO A PROVEEDOR)</option>
   
   <option value="8" <? if ($etapa==8) echo "selected=selected" ?> >PAGADOS</option>

   <option value="99" <? if ($etapa==99) echo "selected=selected" ?> >ANULADOS</option>

 </select>



</td>

</tr>

<tr>

 <td  valign="center" class="Estilo1">Forma de Pago</td>

 <td class="Estilo1" colspan=3>

  <input type="radio" name="fpago" class="Estilo2" value="Cheque" <? if ($fpago=='Cheque') echo 'checked' ?>> Cheque

  <input type="radio" name="fpago" class="Estilo2" value="Transferencia" <? if ($fpago=='Transferencia') echo 'checked' ?>> Transferencia  <br>



</td>

</tr>







<tr>

 <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="consultasgenerales.php"> Limpiar </a> </td>





</tr>



</form>



</td>







<tr>


    <table border=1 class="table table-striped table-hover">
  <tr>
  <td class="Estilo1" colspan="19"><a href="reportesexcel.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&documento=<? echo $documento ?>&consolidado=<? echo $region ?>&consolidado=<? echo $region ?>&etapa=<? echo $etapa ?>" class="link" > Exportar a Excel</a>
    
  </tr>
      <tr>

       <td width="50" class="Estilo1b">Folio</td>

       <td width="41" class="Estilo1b">Rut</td>

       <td class="Estilo1b" width="310">Nombre</td>

       <td width="50" class="Estilo1b">Fecha Recepcion</td>

       <td width="35" class="Estilo1b">Líquido</td>

       <td width="44" class="Estilo1b">Tipo Doc.</td>

       <td width="44" class="Estilo1b">Nro. Doc.</td>
       <td width="44" class="Estilo1b">Nro. OC</td>

       <td width="25" class="Estilo1b">Etapa</td>
       <td width="25" class="Estilo1b">Asignado Seguimieto y control</td>
       <td width="25" class="Estilo1b">Asignado Contabilidad</td>
       <td width="25" class="Estilo1b">F. Devengo</td>
       <td width="25" class="Estilo1b">Dias</td>
       <td width="25" class="Estilo1b">F. Pago</td>
       <td width="25" class="Estilo1b">Dias</td>
       <td width="24" class="Estilo1b">Ver </td>
       <td width="24" class="Estilo1b">Region Destino</td>
       <td width="24" class="Estilo1b">Item Presupuestario</td>
       <td width="24" class="Estilo1b">Programa</td>

     </tr>







     <?

     $sw=0;



     $sql="select * from dpp_etapas where ";

     if ($region<>"") {

      if ($region==0)

        $sql.=" eta_region<>'' and ";

      else

        $sql.=" eta_region=$region and ";

      $sw=1;

    }

    if ($fecha1<>"" and $fecha2<>"" ) {

      $sql.=" ( eta_fecha_recepcion>='$fecha1' and eta_fecha_recepcion<='$fecha2' ) and ";

      $sw=1;

    }

    if ($rut<>"") {

      $sql.=" eta_rut like '%$rut%' and ";

      $sw=1;

    }

    if ($documento<>"") {

      $sql.=" eta_numero like '%$documento%' and ";

      $sw=1;

    }

    if ($proveedor<>"") {

      $sql.=" eta_cli_nombre like '%$proveedor%' and ";

      $sw=1;

    }

    if ($noc<>"") {

      $sql.=" eta_nroorden like '%$noc%' and ";

      $sw=1;

    }

    if ($year<>"") {

      $sql.=" year(eta_fecha_recepcion)='$year' and ";



    }

    if ($fpago<>"") {

      $sql.=" eta_fpago='$fpago' and ";



    }









    if ($folio<>"") {

      $sql.=" eta_folio like '%$folio%' and ";

      $sw=1;

    }

    if ($etapa<>"") {

      if ($etapa==1) {
        //select * from dpp_etapas x, dpp_facturas y where x.eta_estado=1 and x.eta_folioguia=0 and x.eta_region='$regionsession' and x.eta_id=y.fac_eta_id
        $sql.=" (eta_estado='$etapa' and eta_folioguia=0) and";

      }
      if ($etapa==2) {
        //select * from dpp_etapas where eta_estado=1 and eta_folioguia<>0 and eta_region=$regionsession and eta_fecha_recepcion >= '2017-02-01'
        $sql.=" (eta_estado=1 and eta_folioguia<>0) and ";

      }
      if ($etapa==3) {
        //select * from dpp_etapas where (eta_estado=2 or eta_estado=3) and eta_region=$regionsession and eta_destinatario2 = '' and eta_fecha_recepcion2 >='2017-02-01'
        $sql.=" ( (eta_estado=2 or eta_estado=3) and eta_destinatario2 = '' ) and ";

      }
      if ($etapa==4) {
        //select count(eta_id) as Total from dpp_etapas where (eta_estado=5) and eta_region=$regionsession and (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 = '0000-00-00')
        $sql.=" ( (eta_estado=5) and (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 = '0000-00-00') ) and ";

      }
      if ($etapa==5) {
        //SELECT *, DATEDIFF ('2017-03-12','$fecha_actual') AS diferencia FROM dpp_etapas WHERE (eta_estado=5) AND eta_region=$regionsession AND eta_asignado2='$usuario' AND (eta_usu_recepcion22 <> '') AND (eta_destinatario3 is null or eta_destinatario3 = '') AND (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 ='0000-00-00') AND (eta_fechaguia2 >= '2017-02-01 00:00:00') OR (eta_fdevengo = '' AND eta_fdevengo is null AND eta_fdevengo = '0000-00-00') OR (eta_num_egreso = '' AND eta_num_egreso is null AND eta_num_egreso = '0') OR (eta_fecha_egreso = '' AND eta_fecha_egreso is null AND eta_fecha_egreso = '0000-00-00') OR (eta_tipo_doc3 = '' AND eta_tipo_doc3 is null)
        $sql.=" ( (eta_estado=5) AND (eta_usu_recepcion22 <> '') AND (eta_destinatario3 is null or eta_destinatario3 = '') AND (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 ='0000-00-00') OR (eta_fdevengo = '' AND eta_fdevengo is null AND eta_fdevengo = '0000-00-00') OR (eta_num_egreso = '' AND eta_num_egreso is null AND eta_num_egreso = '0') OR (eta_fecha_egreso = '' AND eta_fecha_egreso is null AND eta_fecha_egreso = '0000-00-00') OR (eta_tipo_doc3 = '' AND eta_tipo_doc3 is null) ) ";

      }
      if ($etapa==6) {
        //select * from dpp_etapas where eta_estado = 5 and eta_fechaguia3 <> '0000-00-00 00:00:00'  and eta_region = ".$regionsession." and eta_destinatario3 <> ''
        $sql.=" (eta_estado = 5 and eta_fechaguia3 <> '0000-00-00 00:00:00' and eta_destinatario3 <> '') and ";

      }
       //select * from dpp_etapas where eta_estado=7 and eta_region=$regionsession 
      if ($etapa==77) {

        $sql.=" (eta_estado='7') and ";

      }

      if ($etapa==7) {

        $sql.=" (eta_estado='6') and ";

      }
      if ($etapa==8) {

        $sql.=" (eta_estado='8') and ";

      }
      if ($etapa==99) {

        $sql.=" (eta_estado='99' OR eta_estado='98') and ";
        
      }


      // $sw = 1;
      

    }
    if ($sw==1){

      $sql.=" eta_estado <> 0 and 1=1 order by eta_folio desc ";

    }

    if ($sw==0){

      $sql.=" 1=2";

    }







//echo $sql;

    $res3 = mysql_query($sql);

    $cont=1;

    $cont1=0;

    $sumab=0;

    $sumar=0;

    $sumal=0;

    while($row3 = mysql_fetch_array($res3)){

      if ($row3["eta_tipo_doc"]=="Factura") {

        $archivo="verdoc.php";

      }

      if ($row3["eta_tipo_doc"]=="Honorario") {

        $archivo="verdoc2.php";

      }





      $vartipodoc1=$row3["eta_tipo_doc"];

      if ($vartipodoc1=='Factura') {

       $vartipodoc2=$row3["eta_tipo_doc2"];

       if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")

         $vartipodoc="Factura";

       if ($vartipodoc2=="b")

         $vartipodoc="Boleta Servicio";

       if ($vartipodoc2=="r")

         $vartipodoc="Recibo";

       if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")

         $vartipodoc="N.Credito";

       if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )

         $vartipodoc="N.Débito";

       if ($vartipodoc2=="bh" or $vartipodoc2=="BH" )

         $vartipodoc="Honorario";





     }

     if ($vartipodoc1=='Honorario') {

       $vartipodoc="Honorario";

     }






     $dia1 = strtotime($row3["eta_fdevengo"]);
     $fechabase =$row3["eta_fecha_recepcion"];
     $dia2 = strtotime($fechabase);
     $diff=$dia1-$dia2;
     $diff=intval($diff/(60*60*24));

     $dia11 = strtotime($row3["eta_fechache"]);
     $fechabase1 =$row3["eta_fecha_recepcion"];
     $dia22 = strtotime($fechabase1);
     $diff2=$dia11-$dia22;
     $diff2=intval($diff2/(60*60*24));
     $date1 = date_create($row3["eta_fecha_recepcion"]);
     $date2 = date_create($row3["eta_fechache"]);
     $diff2 = date_diff($date1,$date2)->days;

     ?>





     <tr>

       <td height="24" class="Estilo1b"><? echo $row3["eta_folio"]  ?> </td>

       <td class="Estilo1b"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>

       <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>

       <td class="Estilo1b"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>

       <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>

       <td class="Estilo1b"><? echo $vartipodoc  ?> </td>





       <td class="Estilo1b"><? echo $row3["eta_numero"]  ?> </td>
       <td class="Estilo1b"><? echo $row3["eta_nroorden"]  ?> </td>



       <td class="Estilo1b">
          <?
          //oficina de partes

          //select * from dpp_etapas x, dpp_facturas y where x.eta_estado=1 and x.eta_folioguia=0 and x.eta_region='$regionsession' and x.eta_id=y.fac_eta_id
          if ($row3["eta_estado"] == 1 AND $row3["eta_folioguia"] == 0) {
              echo "OF. PARTES (INGRESO DE DOCUMENTOS)";
          }
          //select * from dpp_etapas where ((eta_estado=12) or (eta_estado=1 and eta_folioguia=0)) and eta_region=$regionsession
          if ( $row3["eta_estado"] == 12 ) {
              echo "OF. PARTES (DEVUELTOS)";
          }



          //seguimiento y control

          //select * from dpp_etapas where eta_estado=1 and eta_folioguia<>0 and eta_region=$regionsession and eta_fecha_recepcion >= '2017-02-01'
          if ($row3["eta_estado"] == 1 && $row3["eta_folioguia"] != 0) {
              echo "SEGUIMIENTO Y CONTROL (PENDIENTES DE RECEPCION)";
          }
          //select * from dpp_etapas where eta_estado=4 and eta_region=$regionsession and (eta_rechaza_motivo4 = '' or eta_rechaza_motivo4 is null) and (eta_rechaza_motivo3 = '' or eta_rechaza_motivo3 is null)
          if ($row3["eta_estado"] == 4 && ($row3["eta_rechaza_motivo4"] == "" OR $row3["eta_rechaza_motivo4"] == null) && ($row3["eta_rechaza_motivo3"] == "" OR $row3["eta_rechaza_motivo3"] == null)) {
              echo "SEGUIMIENTO Y CONTROL (ENVIOS SET DE PAGO)";//-------NO
          }

          /*if ($row3["eta_estado"] == 4 && $row3["eta_rechaza_motivo4"] != "" && $row3["eta_fechaguia2"] == "0000-00-00 00:00:00") {
              echo "PERDIDO"; //---NO
          }*/

          //select * from dpp_etapas where (eta_estado=2 or eta_estado=3) and eta_region=$regionsession and eta_destinatario2 = '' and eta_fecha_recepcion2 >='2017-02-01'
          if ( ($row3["eta_estado"] == 2 OR $row3["eta_estado"] == 3)  && $row3["eta_destinatario2"] == "" ) {
              echo "SEGUIMIENTO Y CONTROL (PENDIENTE DE DESPACHO)";
          }
          //select * from dpp_etapas where ((eta_estado=2) or (eta_estado=1 and eta_folioguia=0)) and eta_fechaguia2='0000-00-00 00:00:00' and eta_region=$regionsession AND eta_rechaza_motivo4 <> ''
          if (  (  ($row3["eta_estado"] == 2) OR ($row3["eta_estado"] == 1 AND $row3["eta_folioguia"] == 0) )  && $row3["eta_fechaguia2"] == "0000-00-00 00:00:00"  && $row3["eta_rechaza_motivo4"] != "") {
              echo "SEGUIMIENTO Y CONTROL (DEVUELTOS)";
          }




          //contabilidad

          //SELECT *, DATEDIFF ('2017-03-12','$fecha_actual') AS diferencia FROM dpp_etapas WHERE (eta_estado=5) AND eta_region=$regionsession AND (eta_asignado2 = '' or eta_asignado2 is null) AND (eta_usu_recepcion22 = '' or eta_usu_recepcion22 is null)
          if (($row3["eta_estado"] == 5 && ($row3["eta_asignado2"] == "" OR $row3["eta_asignado2"] == null) && ($row3["eta_usu_recepcion22"] == "" OR $row3["eta_usu_recepcion22"] == null))) {
              echo "CONTABILIDAD (ASIGNACION DE EJECUTIVO)";//-----NO
          }

          //select count(eta_id) as Total from dpp_etapas where (eta_estado=5) and eta_region=$regionsession and (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 = '0000-00-00')
          if ($row3["eta_estado"] == 5 && ($row3["eta_fecha_recepcion3"] == null AND $row3["eta_fecha_recepcion3"] == "" AND $row3["eta_fecha_recepcion3"] == "0000-00-00") ) {
              echo "CONTABILIDAD (PENDIENTES DE RECEPCION)";
          }
          //SELECT *, DATEDIFF ('2017-03-12','$fecha_actual') AS diferencia FROM dpp_etapas WHERE (eta_estado=5) AND eta_region=$regionsession AND eta_asignado2='$usuario' AND (eta_usu_recepcion22 <> '') AND (eta_destinatario3 is null or eta_destinatario3 = '') AND (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 ='0000-00-00') AND (eta_fechaguia2 >= '2017-02-01 00:00:00') OR (eta_fdevengo = '' AND eta_fdevengo is null AND eta_fdevengo = '0000-00-00') OR (eta_num_egreso = '' AND eta_num_egreso is null AND eta_num_egreso = '0') OR (eta_fecha_egreso = '' AND eta_fecha_egreso is null AND eta_fecha_egreso = '0000-00-00') OR (eta_tipo_doc3 = '' AND eta_tipo_doc3 is null)
          if ($row3["eta_estado"] == 5 && ($row3["eta_usu_recepcion22"] != null OR $row3["eta_usu_recepcion22"] != "") &&  ($row3["eta_destinatario3"] == null OR $row3["eta_destinatario3"] == "") && ($row3["eta_fecha_recepcion3"] == null OR $row3["eta_fecha_recepcion3"] == "" OR $row3["eta_fecha_recepcion3"] == "0000-00-00") && ($row3["eta_fdevengo"] == null OR $row3["eta_fdevengo"] == "" OR $row3["eta_fdevengo"] == "0000-00-00") && ($row3["eta_num_egreso"] == null OR $row3["eta_num_egreso"] == "" OR $row3["eta_num_egreso"] == "0") && ($row3["eta_fecha_egreso"] == null OR $row3["eta_fecha_egreso"] == "" OR $row3["eta_fecha_egreso"] == "0000-00-00") && ($row3["eta_tipo_doc3"] == null OR $row3["eta_tipo_doc3"] == "")) {
              echo "CONTABILIDAD (PENDIENTE DE DESPACHO)";
          }
          //select * from dpp_etapas where eta_estado=5 and eta_region=$regionsession and eta_usu_recepcion22 <> '' and (eta_destinatario3 is null or eta_destinatario3 = '') and eta_fdevengo <> '0000-00-00' AND (eta_peritaje = 1 or eta_peritaje = 0) and eta_tipo_doc3 <> ''
          if ($row3["eta_estado"] == 5 && ($row3["eta_usu_recepcion22"] != null OR $row3["eta_usu_recepcion22"] != "") && ($row3["eta_destinatario3"] == null OR $row3["eta_destinatario3"] == "") && ($row3["eta_fdevengo"] != null OR $row3["eta_fdevengo"] != "0000-00-00") && ($row3["eta_peritaje"] == 1 OR $row3["eta_peritaje"] == 0) && ($row3["eta_tipo_doc3"] != null OR $row3["eta_tipo_doc3"] != "") ) {
              echo "CONTABILIDAD (ENVIOS SET DE PAGOS)";//------NO
          }
          //SELECT * from dpp_etapas where eta_estado = 4 AND eta_rechaza_motivo3 <> ''
          if ( $row3["eta_estado"] == 4 && ($row3["eta_rechaza_motivo3"] != "" OR $row3["eta_rechaza_motivo3"] != null) )  {
              echo "CONTABILIDAD (DEVUELTOS)";
          }


          //tesoreria

          //select * from dpp_etapas where eta_estado = 5 and eta_fechaguia3 <> '0000-00-00 00:00:00'  and eta_region = ".$regionsession." and eta_destinatario3 <> ''
          if ( $row3["eta_estado"] == 5 && ($row3["eta_fechaguia3"] != "") && $row3["eta_destinatario3"] != "" )  {
              echo "TESORERIA (PENDIENTES DE RECEPCION)";
          }
          //select * from dpp_etapas where eta_estado=6 and eta_region=$regionsession 
          if ( $row3["eta_estado"] == 6)  {
              echo "TESORERIA (PENDIENTES DE PAGO A PROVEEDORES)";
          }
          //select * from dpp_etapas where eta_estado=7 and eta_region=$regionsession 
          if ($row3["eta_estado"] == 7) {
              echo "TESORERIA (PAGO CON CHEQUE EN PROCESO A PROVEEDOR)";
          }



          //select * from dpp_etapas where eta_estado=8 and eta_region=$regionsession 
          if ($row3["eta_estado"] == 8) {
              echo "PAGADOS";
          }

          if ($row3["eta_estado"] == 9) {
              echo "CHEQUES CADUCADOS";
          }
          if ($row3["eta_estado"] == 99 || $row3["eta_estado"] == 98) {
              echo "ANULADOS";
          }

          $sql_eta_fac_id = "SELECT * FROM dpp_facturas WHERE fac_eta_id = ".$row3["eta_id"];
          $res_eta_fac_id = mysql_query($sql_eta_fac_id);
          $row_eta_fac_id = mysql_fetch_array($res_eta_fac_id);
          ?>
       </td>
       <td class="Estilo1b"><? echo ($row3["eta_asignado"] == '') ? "N/A" : $row3["eta_asignado"] ?> </td>
       <td class="Estilo1b"><? echo ($row3["eta_asignado2"] == '') ? "N/A" : $row3["eta_asignado2"] ?> </td>
       <td class="Estilo1b"><? echo $row3["eta_fdevengo"]  ?> </td>
       <td class="Estilo1b"><? echo ($diff < 0) ? "N/A" : $diff  ?> </td>

       <td class="Estilo1b"><? echo ($row3["eta_fechache"] == "0000-00-00") ? "N/A" : $row3["eta_fechache"]  ?> </td>
       <td class="Estilo1b"><? echo ($diff2 < 0) ? "N/A" : $diff2  ?> </td>

       <td class="Estilo1c"><a href="<? echo $archivo ?>?id2=<? echo $row3["eta_id"] ?>" class="link" >VER</a> 

/
<a href="javascript:void(0)" class="link" onclick='window.open("compra_documentos.php?fac_id=<?php echo $row_eta_fac_id["fac_id"] ?>","miwin","width=700,height=500,scrollbars=yes,toolbar=0")'>Set de Pago</a>

       </td>
       <td class="Estilo1c"><?php echo $row3["eta_region"] ?></td>

       <td class="Estilo1b">
         
         <?php
         $item = NULL;
         if($row3["eta_item"] <> "")
         {
          $item.=$row3["eta_item"];
         }

         if($row3["eta_item2"] <> "")
         {
          $item.=".".$row3["eta_item2"];
         }

         if($row3["eta_asig "] <> "")
         {
          $item.=".".$row3["eta_asig "];
         }
echo $item;
         ?>

       </td>

       <td class="Estilo1b"><?php echo $row3["eta_prog"] ?></td>

     </tr>
     <?



     $sumab=$sumab+$row3["hono_bruto"];

     $sumar=$sumar+$row3["hono_retencion"];

     $sumal=$sumal+$row3["hono_liquido"] ;

     $cont++;

     $cont1++;

   }

   ?>





 </td>

</tr>

<tr>











</td>

</tr>





</table>





</body>

</html>



<?

//require("inc/func.php");

?>


