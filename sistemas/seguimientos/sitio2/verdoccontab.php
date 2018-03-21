<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$fecha_termino = date("Ymd");
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$date_in=date("Y-m-d");
?>
<html>
<head>
  <title>Facturas y/o Boletas</title>
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
   .Estilo1c {
     font-family: Verdana;
     font-weight: bold;
     font-size: 8px;
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
    font-weight: bold; }

  }
  .Estilo7c {font-family: Geneva, Arial, Helvetica, sans-serif;
    font-size: 12px;text-align: left;
    font-weight: bold; }



  -->
</style>



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
  
  <script src="librerias/js/jscal2.js"></script>
  <script src="librerias/js/lang/es.js"></script>
  <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />

  <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />

  <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />

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
            <!-- CONTENIDO -->
    <table width="500" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="20" colspan="2"><span class="Estilo7">FICHA: FACTURA Y/O RECIBOS</span></td>
                    </tr>
                    <tr>

                      <tr>
                        <td>

                         <a href="valida7.php" class="link">VOLVER</a>
                       </td>
                     </tr>
                     <td><hr></td><td><hr></td>
                   </tr>
                   



                   <tr>
                     <td width="487" valign="top" class="Estilo1">

                      <?

                      if (isset($_GET["llave"]))
                       echo "<p>Registros insertados con Exito !";

                     $id=$_GET["id"];
                     $id2=$_GET["id2"];

                     if ($id<>"") {
                      $sql5="select * from dpp_facturas x, dpp_etapas y where x.fac_id=$id and x.fac_eta_id=y.eta_id";
                    }
                    if ($id2<>"") {
                      $sql5="select * from dpp_facturas x, dpp_etapas y where fac_eta_id=$id2 and x.fac_eta_id=y.eta_id";
                    }

//echo $sql5;
                    $res5 = mysql_query($sql5);
                    $row5=mysql_fetch_array($res5);
//$archivo5=$row5["fac_"];
                    $fecha_inicio = date("Ymd", strtotime($row5["eta_fecha_fac"]));
                    ?>
                  </td>
                </tr>


                <tr>
                  <td height="50" colspan="3">

                   <table width="488" border="0" cellspacing="0" cellpadding="0">

                     <tr>
                       <td  valign="center" class="Estilo1">FOLIO</td>
                       <td class="Estilo7c" colspan=3><? echo $row5["eta_folio"] ?>

                       </td>
                     </tr>


                     <tr>
                       <td  valign="center" class="Estilo1">Fecha Recepción</td>
                       <td class="Estilo1" valign="center">
                        <?
                        $a=$row5["fac_fecha_recepcion"];
                                     //echo $a."-";
                        echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);

                        ?>



                      </td>
                    </tr>
                    <tr>
                     <td  valign="center" class="Estilo1">Fecha Factura</td>
                     <td class="Estilo1">

                      <?
                      $a=$row5["fac_fecha_fac"];
                                     //echo $a."-";
                      echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);

                      ?>


                    </td>
                  </tr>

                  <tr>
                   <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                   <td class="Estilo1">
                     <?
                     $region=$row5["fac_region"];
                     $sql2 = "Select * from regiones where codigo='$region'";
                                    //echo $sql;
                     $res2 = mysql_query($sql2);
                     $row2 = mysql_fetch_array($res2);
                     $region2=$row2["nombre"];
                     echo $region2;

                     ?>



                   </td>
                 </tr>

                 <tr>
                   <td  valign="center" class="Estilo1">Rut  </td>
                   <td class="Estilo1" colspan=3><? echo $row5["fac_rut"]."-".$row5["fac_dig"]; ?>
                   </td>
                 </tr>

                 <tr>
                   <td  valign="center" class="Estilo1">Nombre  </td>
                   <td class="Estilo1" colspan=3><? echo $row5["fac_cli_nombre"] ?>
                   </td>
                 </tr>
                 <tr>
                   <td  valign="center" class="Estilo1">Nº Factura  </td>
                   <td class="Estilo1" colspan=3><? echo $row5["fac_numero"] ?>

                   </td>
                 </tr>
                 <tr>
                   <td  valign="center" class="Estilo1">Total a Pagar </td>
                   <td class="Estilo1" colspan=3>
                    $<? echo number_format($row5["fac_monto"],'0',',','.') ?>
                  </td>
                </tr>
                <tr>
                 <td  valign="center" class="Estilo1">Descripción Servicio </td>
                 <td class="Estilo1" colspan=3>
                   <? echo $row5["eta_servicio_final"] ?>
                 </td>
               </tr>



               <tr>
                 <td  valign="center" class="Estilo1">Imagen Factura </td>
                 <td class="Estilo1" colspan=3>
                   <a href="../../archivos/docfac/<? echo $row5["fac_archivo"] ?>" class="link" target="_blank" ><? echo $row5["fac_archivo"] ?></a>
                 </td>
               </tr>
               <tr>
                 <td  valign="center" class="Estilo1">Imagen Orden de Compra </td>
                 <td class="Estilo1" colspan=3>
                   <a href="../../archivos/docfac/<? echo $row5["fac_doc1"] ?>" class="link" target="_blank"><? echo $row5["fac_doc1"] ?></a>
                 </td>
               </tr>
               <tr>
                 <td  valign="center" class="Estilo1">Imagen Resolución </td>
                 <td class="Estilo1" colspan=3>
                   <a href="../../archivos/docfac/<? echo $row5["fac_doc2"] ?>" class="link" target="_blank" ><? echo $row5["fac_doc2"] ?></a>

                 </td>
               </tr>
               <tr>
                 <tr>
                   <td><hr></td><td><hr></td>
                 </tr>
                 <tr>
                   <td  valign="center" class="Estilo1">Depto. Aprobación </td>
                   <td class="Estilo1" colspan=3>
                     <? echo $row5["eta_depto_aprobacion"] ?>
                   </td>
                 </tr>
                 <tr>
                   <td  valign="center" class="Estilo1">Aprobador</td>
                   <td class="Estilo1" colspan=3>
                     <? echo $row5["eta_usu_aprobacionok"] ?>
                   </td>
                 </tr>
                 <tr>
                   <td  valign="center" class="Estilo1">Fecha VºBº </td>
                   <td class="Estilo1" colspan=3>
                     <? echo $row5["eta_fecha_aprobacionok"] ?>
                   </td>
                 </tr>

                 <tr>
                   <td><hr></td><td><hr></td>
                 </tr>

               </tr>

               <tr>
                 <td  valign="center" class="Estilo1">Número de Cheque </td>
                 <td class="Estilo1" colspan=3>
                  <? echo $row5["eta_ncheque"] ?>
                </td>
              </tr>
              <?
              $forma=$row5["eta_ncheque"];
              ?>


              <tr>
               <td  valign="center" class="Estilo1">Fecha Cheque</td>
               <td class="Estilo1" colspan=3>
                <?
                $a=$row5["eta_fechache"];
                echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);
                ?>
              </td>
            </tr>
            <tr>
             <td  valign="center" class="Estilo1">Fecha Cobro </td>
             <td class="Estilo1" colspan=3>
              <?
              $a=$row5["eta_fecha_pagado"];
              echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);
              ?>
            </td>
          </tr>

          <tr>
           <td  valign="center" class="Estilo1">Forma de Cobro </td>
           <td class="Estilo1" colspan=3>
             <? echo $row5["eta_forma"] ?> _ <? echo $row5["eta_retira"] ?>
           </td>
         </tr>


         <tr>
           <td  valign="center" class="Estilo1">Número Egreso </td>
           <td class="Estilo1" colspan=3>
             <? echo $row5["eta_negreso"] ?>
           </td>
         </tr>


         <tr>
           <td  valign="center" class="Estilo1"><br><br><br>  </td>
           <td  valign="center" class="Estilo1"> </td>

         </tr>
         <tr>
          <td colspan="8"><hr></td>
        </tr>
        <form name="form1" action="documentos/grabavercontab1.php"    enctype="multipart/form-data"  method="post" >
          <tr>
           <td  valign="center" class="Estilo1">Doc. Egreso </td>
           <td class="Estilo1" colspan=3>
             <input type="file" name="archivo1" class="Estilo2"  > <br>
             <a href="../../archivos/docfac/<? echo $row5["eta_archivorecibo"] ?>" class="link" target="_blank" ><? echo $row5["eta_archivorecibo"] ?></a>
           </td>
         </tr>

<tr>
 <td colspan=4 align="center"> <input type="submit" value="    Subir Archivo   " > </td>
</tr>
<input type="hidden" name="id" value="<? echo $id ?>" >
<input type="hidden" name="id2" value="<? echo $id2 ?>" >
<input type="hidden" name="eta_numero" value="<? echo $row5["eta_numero"] ?>" >
<input type="hidden" name="eta_negreso" value="<? echo $row5["eta_negreso"]; ?>" >
<input type="hidden" name="eta_folio" value="<? echo $row5["eta_folio"] ?>" >
<input type="hidden" name="eta_tipo_doc" value="<? echo $row5["eta_tipo_doc"] ?>" >
<input type="hidden" name="fac_id" value="<? echo $_REQUEST["fac_id"] ?>" >
</form>
<tr>
  <td colspan="8"><hr></td>
</tr>
<form name="form1" action="grabaacciones.php" method="post"  onSubmit="return valida()">

 <tr>
  <td colspan="8" class="Estilo7" align="center">INGRESO GESTIONES</td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">Tipo de Gestión</td>
 <td class="Estilo1" colspan=3>
   <select name="tipo" class="Estilo1">
     <option value=''>Seleccione...</option>
     <option value='Mail'>Mail</option>
     <option value='Llamado'>Llamado</option>
     <option value='Otra Gestion'>Otra Gestión</option>
   </select>
 </td>
</tr>


<tr>
 <td  valign="center" class="Estilo1">Observación</td>
 <td class="Estilo1" colspan=3>
  <textarea name="obs" rows="3" cols="30"></textarea>
</td>
</tr>
<tr>
 <td colspan=4 align="center"> <input type="submit" value="    Grabar Gestión   " > </td>
</tr>
<input type="hidden" name="id" value="<? echo $id ?>" >
<input type="hidden" name="id2" value="<? echo $id2 ?>" >
<input type="hidden" name="sw" value="1" >
</form>





</td>


<tr>
 <td colspan="8"><hr></td>
</tr>
</table>
<table width="488" border="1" cellspacing="0" cellpadding="0">
 <tr>
  <td  valign="center" class="Estilo1c">Nº</td>
  <td  valign="center" class="Estilo1c">Fecha</td>
  <td  valign="center" class="Estilo1c">Tipo</td>
  <td  valign="center" class="Estilo1c">Obs</td>
  <td  valign="center" class="Estilo1c">Usuario</td>
</tr>

<?
$sql21 = "Select * from dpp_acciones where acc_eta_id='$id2' order by acc_id desc";
               //echo $sql;
$res21 = mysql_query($sql21);
$contador=1;
while ($row21 = mysql_fetch_array($res21)) {

  ?>
  <tr>

    <td  valign="center" class="Estilo1c"><? echo $contador; ?></td>
    <td  valign="center" class="Estilo1c"><? echo $row21["acc_fecha"]; ?></td>
    <td  valign="center" class="Estilo1c"><? echo $row21["acc_tipo"]; ?></td>
    <td  valign="center" class="Estilo1"><? echo $row21["acc_texto"]; ?></td>
    <td  valign="center" class="Estilo1c"><? echo $row21["acc_user"]; ?></td>
  </tr>
  <?
  $contador++;
}
?>







</td>
</tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
