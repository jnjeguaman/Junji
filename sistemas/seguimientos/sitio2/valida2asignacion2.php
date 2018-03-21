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

<!DOCTYPE html>
<html>
<head>
  <title>SIGEJUN</title>
  <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->
  <meta charset="UTF-8">
  <link href="css/estilos.css" rel="stylesheet" type="text/css">
  <!-- <link rel="stylesheet" href="librerias/DataTables/media/css/jquery.dataTables.min.css"> -->
  
  <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="select_dependientes.css">

  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="select_dependientes.js"></script>
  <script type="text/javascript" src="ajaxclient.js"></script>
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="librerias/calendar.js"></script>
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

  <SCRIPT LANGUAGE ="JavaScript">

    function abrirVentana(fac_id){
      miPopup = window.open("compra_documentos.php?fac_id="+fac_id,"miwin","width=700,height=500,scrollbars=yes,toolbar=0")
      miPopup.focus()
    }

    function abrirVentana2(eta_id){
      miPopup = window.open("compra_detalle.php?eta_id="+eta_id,"miwin","width=700,height=500,scrollbars=yes,toolbar=0")
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

  <style type="text/css">
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
    </style>
  </head>
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
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="20" colspan="2"><span class="Estilo7">GESTI&Oacute;N DE SET DE PAGOS</span></td>
              </tr>

              <tr>
                <?php
                if ($nivel == 5) {
                  ?>
                  <td><a href="menuadministracion.php" class="link">VOLVER</a></td>
                  <?php
                }
                if ($nivel == 8) {
                  ?>
                  <td><a href="menuadministracion2.php" class="link">VOLVER</a></td>
                  <?php
                }
                ?>
              </tr>

              <tr>
                <td><hr></td>
              </tr>

              <tr>
                <td>
                  <center>
                    <table border="0" class="text-center">

                      <tr>

                        <td width="230px" class="alert alert-info">
                          <?php
                          date_default_timezone_set('America/Santiago');
                          $anno = date('Y');

                          $sqlCount1 = "SELECT COUNT(eta_id) AS contador FROM dpp_etapas WHERE (eta_fecha_recepcion2 <> '0000-00-00' OR eta_fecha_recepcion2 <> '') AND (eta_fechaguia2 = '0000-00-00 00:00:00' OR eta_fechaguia2 = '') AND eta_region = ".$regionsession." AND eta_fecha_recepcion2 >= '2017-02-01' AND (eta_estado = 2 OR eta_estado = 3)";
                          $resCount1 = mysql_query($sqlCount1, $dbh);

                          while($rowCount1 = mysql_fetch_array($resCount1)){

                            $count1 = $rowCount1['contador'];
                          }
                          ?>
                          <? echo $count1; ?><br>Pendientes Seguimiento y Control
                        </td>

                        <td width="50px"></td>

                        <td width="230px" class="alert alert-warning">
                          <?php
                          $sqlCount2 = "SELECT COUNT(eta_id) AS contador FROM dpp_etapas WHERE (eta_fechaguia2 <> '0000-00-00' OR eta_fechaguia2 <> '') AND (eta_fechaguia3 = '0000-00-00' OR eta_fechaguia3 = '' OR eta_fechaguia3 IS NULL) AND eta_region = ".$regionsession." AND YEAR(eta_fecha_ing) >= 2017";
                          $resCount2 = mysql_query($sqlCount2, $dbh);

                          while($rowCount2 = mysql_fetch_array($resCount2)){

                            $count2 = $rowCount2['contador'];
                          }
                          ?>
                          <? echo $count2; ?><br>Pendientes Contabilidad
                        </td>

                        <td width="50px"></td>

                        <td width="230px" class="alert alert-success">
                          <?php
                          // $sqlCount3 = "SELECT COUNT(eta_id) AS contador FROM dpp_etapas WHERE (eta_fechaguia3 <> '0000-00-00' OR eta_fechaguia3 <> '') AND (eta_fecha_cheque = '0000-00-00' OR eta_fecha_cheque = '' OR eta_fecha_cheque IS NULL) AND eta_region = ".$regionsession." AND YEAR(eta_fecha_ing) >= 2017";
                          $sqlCount3 = "select count(eta_id) as contador from dpp_etapas where eta_estado = 5 and eta_fechaguia3 <> '0000-00-00 00:00:00' and eta_region = ".$regionsession." and eta_destinatario3 <> ''";
                          $resCount3 = mysql_query($sqlCount3, $dbh);
                          while($rowCount3 = mysql_fetch_array($resCount3)){

                            $count3 = $rowCount3['contador'];
                          }
                          ?>
                          <? echo $count3; ?><br>Pendientes Tesorer&iacute;a
                        </td>

                        <td width="50px"></td>

                        <td width="230px" class="alert alert-danger">
                          <?php
                          // "
                          // $sqlCount4 = "SELECT COUNT(eta_id) AS contador FROM dpp_etapas WHERE  eta_region = ".$regionsession." AND eta_estado=4 AND YEAR(eta_fecha_recepcion2) >= '2017-02-01'";
                          $sqlCount4 = "SELECT COUNT(eta_id) AS contador FROM dpp_etapas WHERE eta_estado=4 and eta_region=".$regionsession." and (eta_rechaza_motivo4 = '' or eta_rechaza_motivo4 is null) and (eta_rechaza_motivo3 = '' or eta_rechaza_motivo3 is null) and eta_fecha_recepcion2 >= '2017-02-01'";
                          $resCount4 = mysql_query($sqlCount4, $dbh);

                          while($rowCount4 = mysql_fetch_array($resCount4)){
                            $count4 = $rowCount4['contador'];
                          }
                          ?>
                          <? echo $count4; ?><br>
                          Pendientes de Despacho
                        </td>
                        
                        <td width="50px"></td>
                        <?
                        $sql00="SELECT * FROM dpp_etapas WHERE ((eta_estado=2) or (eta_estado=1 and eta_folioguia=0)) AND eta_fechaguia2='0000-00-00 00:00:00' AND eta_region=$regionsession AND eta_rechaza_motivo4 <> ''";
                        $res00 = mysql_query($sql00);
                        if (mysql_num_rows($res00)>0) {
                          ?>
                          <td width="230px" class="alert alert-danger">
                            <?php
                            $sqlCount5 = "SELECT COUNT(eta_id) AS contador FROM dpp_etapas WHERE ((eta_estado=2) or (eta_estado=1 and eta_folioguia=0)) AND eta_fechaguia2='0000-00-00 00:00:00' AND eta_region=$regionsession AND eta_rechaza_motivo4 <> ''";
                            $resCount5 = mysql_query($sqlCount5, $dbh);

                            while($rowCount5 = mysql_fetch_array($resCount5)){
                              $count5 = $rowCount5['contador'];
                            }
                            ?>
                            <? echo $count5; ?><br>
                            Devueltos
                          </td>
                          <?
                        }
                        ?>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
              <tr>
                <td><hr></td>
                <td><hr></td>
              </tr>
            </table>

            <?
            $region=$_GET["region"];
            $fecha1=$_GET["fecha1"];
            $fecha2=$_GET["fecha2"];
            $rut=$_GET["rut"];
            $item=$_GET["item"];
            $consolidado=$_GET["consolidado"];
            ?>
            <form name="form1" action="grabavalida2asignacion.php" method="post" enctype="multipart/form-data" onSubmit="return valida()">

              <table width="100%" border="0" class="table table-striped table-bordered table-hover">
                <?
                /*if ( 1==1){
                  ?>
                  <tr>
                    <td  valign="center" colspan="4" class="Estilo1">Asignar</td>
                    <td class="Estilo1" colspan="8">
                      <select name="dos" class="Estilo1" onchange="muestra();">
                        <option value="">Seleccione...</option>
                        <?

                        $sql4="select * from usuarios where (atributo1=8 or atributo1=7 or atributo1 = 38) and region = ".$regionsession." and sistema = 1";
                        $res4 = mysql_query($sql4);
                        while($row4 = mysql_fetch_array($res4)){
                          ?>
                          <option value="<? echo $row4["nombre"]; ?>" ><? echo $row4["nombrecom"]; ?></option>

                          <?
                        }
                        ?>


                      </select>
                      <div id="seccion1" style="display:none">
                        Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
                      </div>

                    </td>

                  </tr>
                  <tr>
                    <td  valign="center" class="Estilo1" colspan=12 align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="boton" class="Estilo2" value="  Acepta Acci&oacute;n "> </td>
                  </tr>
                  <?
                }*/
                ?>
              </table>
              <table width="100%" border="0">
                <tr>
                  <td class="Estilo1"><h4>ENV&Iacute;OS PENDIENTES</h4></td>
                </tr>
              </table>
              <table border="0" width="100%" class="table table-striped table-bordered"  id="example1">
                <thead>
                  <tr>
                    <!--<th class="Estilo1">Op</th>-->
                    <th class="Estilo1">Folio</th>
                    <th class="Estilo1">Asignado</th>
                    <th class="Estilo1">Tipo Documento</th>
                    <th class="Estilo1">N&deg; Documento</th>
                    <th class="Estilo1">Proveedor</th>
                    <th class="Estilo1">Rut</th>
                    <th class="Estilo1">Valor Documento</th>
                    <th class="Estilo1">Recepci&oacute;n en Of de Partes</th>
                    <th class="Estilo1">Documentos</th>
                    <th class="Estilo1">D&iacute;as Transcurridos</th>
                    <!--<th class="Estilo1">FICHA</th>-->
                  </tr>
                </thead>
                <tfoot style="display: table-header-group;">
                  <tr>
                    <!--<td class="Estilo1">Op</td>-->
                    <th class="Estilo1">Folio</th>
                    <th class="Estilo1">Asignado</th>
                    <th class="Estilo1">Tipo Documento</th>
                    <th class="Estilo1">N&deg; Documento</th>
                    <th class="Estilo1">Proveedor</th>
                    <th class="Estilo1">Rut</th>
                    <th class="Estilo1">Valor Documento</th>
                    <th class="Estilo1">Recepci&oacute;n en Of de Partes</th>
                    <td class="Estilo1">Documentos</td>
                    <th class="Estilo1">D&iacute;as Transcurridos</th>
                    <!--<td class="Estilo1">FICHA</td>-->
                  </tr>
                </tfoot>
                <tbody>
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


                  if ($regionsession==0) {
                    $sql="select * from dpp_etapas where (eta_estado=2 or eta_estado=3) order by eta_folio desc";
                  } else {
                    $sql="select * from dpp_etapas where (eta_estado=2 or eta_estado=3) and eta_region=$regionsession and eta_destinatario2 = '' and eta_fecha_recepcion2 >='2017-02-01' order by eta_folio desc";
                  }


//$sql="select * from dpp_etapas where eta_estado=2 or eta_estado=3  order by eta_folio desc";
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
                    if ($etapa2a>=$diff)
                      $clase="Estilo1cverde";
                    if ($etapa2a<$diff and $etapa2b>=$diff )
                      $clase="Estilo1camarrillo";
                    if ( $etapa2b<$diff)
                      $clase="Estilo1crojo";

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
                        $vartipodoc="N.Crédito";
                      if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
                        $vartipodoc="N.Débito";
                      if ($vartipodoc2=="bh" or $vartipodoc2=="BH" )
                        $vartipodoc="Honorario";
                    }
                    if ($vartipodoc1=='Honorario') {
                      $vartipodoc="Honorario";
                    }

                    if ($row3["eta_tipo_doc"]=="Factura") {
                      $archivo="facturasarchivos.php";
                      $eta_id=$row3["eta_id"];
                      $sql5="select * from dpp_facturas where fac_eta_id=$eta_id";
                                // echo $sql5."<br>";
                      $res5 = mysql_query($sql5);
                      $row5=mysql_fetch_array($res5);
                      $viene_id=$row5["fac_id"];
                    }
                    $fac_id = $viene_id;

                    ?>
                    <tr>
                      <!--<td class="Estilo1"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" > </td>-->
                      <td class="Estilo1"><? echo $row3["eta_folio"]  ?> </td>
                      <td class="Estilo1"><? echo $row3["eta_asignado"]  ?> </td>
                      <td class="Estilo1"><? echo $vartipodoc  ?> </td>
                      <td class="Estilo1"><? echo $row3["eta_numero"]  ?></td>
                      <td class="Estilo1"><? echo $row3["eta_cli_nombre"]  ?> </td>
                      <td class="Estilo1" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                      <td class="Estilo1"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                      <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>
                      <td class="Estilo1">
                        <a href="#" onClick="abrirVentana('<?php echo $fac_id ?>')">VER</a>
                      </td>
                      <td class="Estilo1"><? echo $diff   ?> </td>
                      <!--<td class="Estilo1"><a href="<? echo $archivo ?>?id=<? echo $viene_id ?>&id1b=<? echo $row3["eta_id"] ?>" class="link" >VER</a></td>-->
                    </tr>
                    <?
                    $cont++;
                  }
                  ?>
                </tbody>
                <input type="hidden" name="cont" value="<? echo $cont ?>" >
              </table>
            </form>
            
            <?php 
            $sql2 = "SELECT * FROM dpp_etapas WHERE eta_destinatario2 <> '' AND eta_region = ".$regionsession." and eta_fechaguia2 >='2017-02-01 00:00:00' ORDER BY eta_fecha_ing ASC";
// echo $sql2;
            $res2 = mysql_query($sql2,$dbh);
            ?>
            <hr>  
            <table>
              <tr>
                <td class="Estilo1"><h4>ENV&Iacute;OS REALIZADOS</h4></td>
              </tr>

              <tr>
                <!--<td lign="right"><a href="compra_excel.php" class="link Estilo1" target="_blank">EXPORTAR A EXCEL</a></td>-->
              </tr>
            </table>
            <hr>
            <table border="0" width="100%" class="table table-striped table-hover table-bordered" id="example">

              <thead>
                <tr>
                  <td class="Estilo1">Folio</td>
                  <td class="Estilo1">D&iacute;as Transcurridos OP</td>
                  <td class="Estilo1">Ejecutivo Asignado</td>
                  <td class="Estilo1">Estado Set Pago</td>
                  <td class="Estilo1">O/C Asociada</td>
                  <td class="Estilo1">S/C Asociada</td>
                  <td class="Estilo1">Unidad Requirente</td>
                  <td class="Estilo1">&Iacute;tem Presupuestario</td>
                  <td class="Estilo1">Programa</td>
                  <td class="Estilo1">Proveedor</td>
                  <td class="Estilo1">Rut</td>
                  <td class="Estilo1">N&deg; Pagos Asociados</td>
                  <td class="Estilo1">Saldo O/C</td>
                  <td class="Estilo1">Tipo Documento</td>
                  <td class="Estilo1">N&deg; Documento</td>
                  <td class="Estilo1">Valor Documento</td>
                  <td class="Estilo1">Fecha Emision Factura</td>
                  <td class="Estilo1">Recepci&oacute;n en Of de Partes</td>
                  <td class="Estilo1">Recepci&oacute;n en SYC</td>
                  <td class="Estilo1">Fecha Env&iacute;o Contabilidad</td>
                  <td class="Estilo1">Fecha Env&iacute;o Tesorer&iacute;a</td>
                  <td class="Estilo1">Fecha Pago</td>
                  <td class="Estilo1">Observaciones</td>
                  <td class="Estilo1">Documentos</td>
                  <!--<td class="Estilo1">Ficha</td>-->
                </tr>
              </thead>
              <tfoot style="display: table-header-group;">
                <tr>
                  <th class="Estilo1d">Folio</th>
                  <th class="Estilo1d">D&iacute;as Transcurridos OP</th>
                  <th class="Estilo1d">Ejecutivo Asignado</th>
                  <th class="Estilo1d">Estado Set Pago</th>
                  <th class="Estilo1d">O/C Asociada</th>
                  <th class="Estilo1d">S/C Asociada</th>
                  <th class="Estilo1d">Unidad Requirente</th>
                  <th class="Estilo1d">&Iacute;tem Presupuestario</th>
                  <th class="Estilo1d">Programa</th>
                  <th class="Estilo1d">Proveedor</th>
                  <th class="Estilo1d">Rut</th>
                  <th class="Estilo1d">N&deg; Pagos Asociados</th>
                  <th class="Estilo1d">Saldo O/C</th>
                  <th class="Estilo1d">Tipo Documento</th>
                  <th class="Estilo1d">N&deg; Documento</th>
                  <th class="Estilo1d">Valor Documento</th>
                  <th class="Estilo1d">Fecha Emision Factura</th>
                  <th class="Estilo1d">Recepci&iacute;n en Of de Partes</th>
                  <th class="Estilo1d">Recepci&iacute;n en SYC</th>
                  <th class="Estilo1d">Fecha Env&iacute;o Contabilidad</th>
                  <th class="Estilo1d">Fecha Env&iacute;o Tesorer&iacute;a</th>
                  <th class="Estilo1d">Fecha Pago</th>
                  <th class="Estilo1d">Observaciones</th>
                  <td class="Estilo1d">Documentos</td>
                  <!--<td class="Estilo1d">Ficha</td>-->
                </tr>
              </tfoot>
              <tbody>
                
                <?php while($row2 = mysql_fetch_array($res2)) { 
                  $vartipodoc1=$row2["eta_tipo_doc"];
                  if ($vartipodoc1=='Factura') {
                    $vartipodoc2=$row2["eta_tipo_doc2"];
                    if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
                      $vartipodoc="Factura";
                    if ($vartipodoc2=="b")
                      $vartipodoc="Boleta Servicio";
                    if ($vartipodoc2=="r")
                      $vartipodoc="Recibo";
                    if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
                      $vartipodoc="N.Crédito";
                    if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
                      $vartipodoc="N.Débito";
                    if ($vartipodoc2=="bh" or $vartipodoc2=="BH" )
                      $vartipodoc="Honorario";
                  }
                  if ($vartipodoc1=='Honorario') {
                    $vartipodoc="Honorario";
                  }

                  if ($row2["eta_tipo_doc"]=="Factura") {
                    $archivo="facturasarchivos.php";
                    $eta_id=$row2["eta_id"];
                    $sql5="select * from dpp_facturas where fac_eta_id=$eta_id";
        // echo $sql5."<br>";
                    $res5 = mysql_query($sql5);
                    $row5=mysql_fetch_array($res5);
                    $viene_id=$row5["fac_id"];
                  }
                  $fac_id = $viene_id;

                  // $fechahoy = (row2["eta_fechache"] <> "0000-00-00") ? $row2["eta_fechache"] : $date_in;
                  if($row2["eta_fechache"] <> "0000-00-00")
                  {
                    $fechahoy =  $row2["eta_fechache"];
                  }else{
                    $fechahoy = $date_in;
                  }
                  $dia1 = strtotime($fechahoy);
                  $fechabase =$row2["eta_fecha_recepcion"];
                  $dia2 = strtotime($fechabase);
                  $diff2=$dia1-$dia2;
                  $diff2=intval($diff2/(60*60*24));


                  $sql6 = "SELECT * FROM compra_orden WHERE upper(oc_numero) = upper('".$row2["eta_nroorden"]."')";
                  $res6 = mysql_query($sql6);
                  $row6 = mysql_fetch_array($res6);

                  $sql7 = "SELECT COUNT(eta_id) as TotalFacturas, SUM(eta_monto) as TotalMonto FROM dpp_etapas WHERE eta_nroorden = '".$row2["eta_nroorden"]."' AND eta_nroorden <> ''";
                  $res7 = mysql_query($sql7);
                  $row7 = mysql_fetch_array($res7);

    $fecha1 = $row2["eta_fechaguia2"]; //ENVIADO A CONTABILIDAD
    $fecha2 = $row2["eta_fechaguia3"]; //ENVIADO A TESORERIA
    $fecha3 = $row2["eta_fechache"]; // FECHA DE PAGO

    if($fecha1 <> '0000-00-00 00:00:00' && $fecha2 == '0000-00-00 00:00:00' && $fecha3 == '0000-00-00')
    {
      $estado = "ENVIADO A CONTABILIDAD";
    }else if($fecha1 <> '0000-00-00 00:00:00' && $fecha2 <> '0000-00-00 00:00:00' && $fecha3 == '0000-00-00')
    {
      $estado = "ENVIADO A TESORER&Iacute;A";
    }else if($fecha1 <> '0000-00-00 00:00:00' && $fecha2 <> '0000-00-00 00:00:00' && $fecha3 <> '0000-00-00')
    {
      $estado = "PAGADO";
    }else if($row2["eta_rechaza_motivo4"] <> ""){
      $estado = "DEVUELTO POR CONTABILIDAD";
    }else{
      $estado = "N/A";
    }

    ?>
    <tr>
      <td class="Estilo1d"><a href="#" onClick="abrirVentana2(<?php echo $row2["eta_id"] ?>)"><?php echo $row2["eta_folio"] ?></a></td>
      <td class="Estilo1d"><? echo $diff2 ?> </td>
      <td class="Estilo1d"><?php echo $row2["eta_asignado"] ?></td>
      <td class="Estilo1d"><?php echo $estado ?></td>
      <td class="Estilo1d"><?php echo strtoupper($row2["eta_nroorden"]); ?></td>
      <td class="Estilo1d"><?php echo $row6["oc_sc"] ?></td>
      <td class="Estilo1d">N/A</td>
      <td class="Estilo1d"><?php echo $row2["eta_item"].".".$row2["eta_item2"].".".$row2["eta_asig"] ?></td>
      <td class="Estilo1d"><?php echo $row2["eta_prog"] ?></td>
      <td class="Estilo1d"><?php echo $row2["eta_cli_nombre"] ?></td>
      <td class="Estilo1d"><?php echo number_format($row2["eta_rut"],0,".",".")."-".$row2["eta_dig"] ?></td>
      <td class="Estilo1d"><?php echo $row7["TotalFacturas"] ?></td>
      <td class="Estilo1d"><?php echo ($row6["oc_monto"] <> '') ? "$ ".number_format(($row6["oc_monto"] - $row7["TotalMonto"]),0,".",".") : "N/A" ?></td>
      <td class="Estilo1d"><?php echo $vartipodoc ?></td>
      <td class="Estilo1d"><?php echo $row2["eta_numero"] ?></td>
      <td class="Estilo1d">$<?php echo number_format($row2["eta_monto"],0,".",".") ?></td>
      <td class="Estilo1d"><?php echo $row5["fac_fecha_fac"] ?></td>
      <td class="Estilo1d"><? echo substr($row2["eta_fecha_recepcion"],8,2)."-".substr($row2["eta_fecha_recepcion"],5,2)."-".substr($row2["eta_fecha_recepcion"],0,4)   ?></td>
      <td class="Estilo1d"><?php echo ($row2["eta_fecha_recepcion2"] <> '' && $row2["eta_fecha_recepcion2"] <> '0000-00-00') ? $row2["eta_fecha_recepcion2"] : "RECEPCI&Oacute;N PENDIENTE SYC" ?></td>
      <td class="Estilo1d"><?php echo ($row2["eta_fechaguia2"] <> '' && $row2["eta_fechaguia2"] <> '0000-00-00') ? $row2["eta_fechaguia2"] : "ENV&Iacute;O PENDIENTE" ?></td>
      <td class="Estilo1d"><?php echo ($row2["eta_fechaguia3"] <> '' && $row2["eta_fechaguia3"] <> '0000-00-00') ? $row2["eta_fechaguia3"] : "ENV&Iacute;O PENDIENTE" ?></td>
      <td class="Estilo1d"><?php echo ($row2["eta_fechache"] <> '' && $row2["eta_fechache"] <> '0000-00-00' && $row2["eta_fechache"] <> NULL) ? $row2["eta_fechache"] : "PAGO PENDIENTE" ?></td>
      <td class="Estilo1d"><?php echo $row2["eta_obs"] ?></td>
      <td class="Estilo1d">
        <a href="#" onClick="abrirVentana('<?php echo $fac_id ?>')">VER</a>
        <!-- <a href="#"  data-toggle="modal" data-target="#recupera<? echo $eta_id  ?>" data-book-id="1" class="link" > VER </a> -->
        <?php //include("compra_modal.php") ?>
      </td>
      <!--<td class="Estilo1d"><a href="<? echo $archivo ?>?id=<? echo $fac_id ?>&id1b=<? echo $row2["eta_id"] ?>" class="link" >VER</a></td>-->
    </tr>
    <?php } ?>
</tbody>
</table>
<script type="text/javascript" src="librerias/DataTables/media/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="librerias/DataTables/media/css/dataTables.material.min.css">
<script type="text/javascript" src="librerias/DataTables/media/js/dataTables.material.min.js"></script>
<script>
  $(function(){
    $('#example tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
    } );
    
    $('#example1 tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="'+title+'" />' );
        //$(this).html( '<input type="text" placeholder="Buscar..." />' );
    } );

    // DataTable

    var table2 = $('#example1').DataTable({
      "language": {
        "autoWidth": "false",
        "lengthMenu": "Mostrar _MENU_ registros por p&aacute;gina",
        "zeroRecords": "Sin resultados.",
        "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
        "infoEmpty": "Sin informaci&oacute;n disponible",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "paginate":{
          "first": "Primero",
          "last": "&Uacute;ltimo",
          "next": "Siguiente",
          "previous" : "Anterior"
        },
        "search": "Buscar"
      },
      "columns": [
    { "width": "100%" },
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null
  ]
    });

    var table = $('#example').DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por p&aacute;gina",
        "zeroRecords": "Sin resultados.",
        "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
        "infoEmpty": "Sin informaci&oacute;n disponible",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "paginate":{
          "first": "Primero",
          "last": "&Uacute;ltimo",
          "next": "Siguiente",
          "previous" : "Anterior"
        },
        "search": "Buscar"
      }
    });
    
    // Apply the search
    table.columns().every( function () {
      var that = this;
      
      $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
          that
          .search( this.value )
          .draw();
        }
      } );
    } );

    table2.columns().every( function () {
      var that = this;
      
      $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
          that
          .search( this.value )
          .draw();
        }
      } );
    } );

})
</script>
</div>
</div>
</div>
</body>
</html>