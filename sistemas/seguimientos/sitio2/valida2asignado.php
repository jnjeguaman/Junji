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
	<title>Defensoria</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/estilos.css" rel="stylesheet" type="text/css">
  <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>

  <script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
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
    function abrirVentana(fac_id){
      miPopup = window.open("compra_documentos.php?fac_id="+fac_id,"miwin","width=700,height=500,scrollbars=yes,toolbar=0")
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
  			alert ("No ha seleccionado una Acci�n ");
  			return false;
  		}
  		if (document.form1.dos.value=='no' && document.form1.justifica.value=='') {
  			alert ("No ha Justificado ");
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
  							<td height="20" colspan="2"><span class="Estilo7">GESTI�N Y CONTROL DE DOCUMENTOS</span></td>
  						</tr>

              <tr>
                <td><a href="menuadministracion2.php" class="link">VOLVER</a></td>
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
               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                <form name="form1" action="grabavalida2.php" method="post" enctype="multipart/form-data" onSubmit="return valida()">
                 <?
                 if ($regionsession==15 and 1==2){
                  ?>
                  <tr>
                   <td  valign="center" class="Estilo1">&nbsp;&nbsp;&nbsp;Acci�n </td>
                   <td class="Estilo1" colspan=3>
                    <select name="dos" class="Estilo1" onchange="muestra();">
                     <option value="">Seleccione...</option>
                     <option value="si">Derivar a Aprobaci�n Pago</option>
                   </select>
                   <div id="seccion1" style="display:none">
                     Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
                   </div>

                   <td>

                   </tr>
                   <tr>
                     <td  valign="center" class="Estilo1" colspan=4 align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="boton" class="Estilo2" value="  Acepta Acci�n "> </td>


                   </tr>
                   <?
                 }
                 ?>



               </td>


               <tr>
                 <td class="Estilo1" colspan=4>
                  <table border="1" class="table table-striped">

                    <tr>
                      <td class="Estilo1d">Folio</td>
                      <td class="Estilo1d">Tipo Documento</td>
                      <td class="Estilo1d">N� Documento</td>
                      <td class="Estilo1d">Proveedor</td>
                      <td class="Estilo1d">Rut</td>
                      <td class="Estilo1d">Valor Documento</td>
                      <td class="Estilo1d">Recepci�n en Of de Partes</td>
                      <td class="Estilo1d">Documentos</td>
                      <td class="Estilo1d">D�as Transcurridos</td>
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


                    if ($regionsession==0) {
                      $sql="select * from dpp_etapas where eta_estado=2 or eta_estado=3  order by eta_folio desc";
                    } else {
                      $sql="select * from dpp_etapas where (eta_estado=2 or eta_estado=3)  and eta_region=$regionsession and eta_asignado='$usuario' order by eta_folio desc";
                    }


//$sql="select * from dpp_etapas where eta_estado=2 or eta_estado=3  order by eta_folio desc";
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
                        $vartipodoc="N.D�bito";
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
                   <td class="Estilo1d"><? echo $row3["eta_folio"]  ?> </td>
                   <td class="Estilo1d"><? echo $vartipodoc  ?> </td>
                   <td class="Estilo1c"><? echo $row3["eta_numero"]  ?></td>
                   <td class="Estilo1d"><? echo $row3["eta_cli_nombre"]  ?> </td>
                   <td class="Estilo1d" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                   <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                   <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>
                   <td class="Estilo1d">
                     <a href="#" onClick="abrirVentana('<?php echo $fac_id ?>')">VER</a>
                   </td>
                   <td class="<?php echo $clase ?>"><? echo $diff   ?> </td>
                   <td class="Estilo1d"><a href="facturasarchivos.php?id=<? echo $viene_id ?>&id1b=<? echo $row3["eta_id"] ?>" class="link" >VER</a></td>
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
        <hr>
        <?php 
        $sql2 = "SELECT * FROM dpp_etapas WHERE eta_asignado = '".$usuario."' AND eta_destinatario2 <> ''";
        $res2 = mysql_query($sql2,$dbh);
        ?>
        <table border="1" width="100%" class="table table-striped">
          <tr>
            <td colspan="10" class="Estilo1"><h4>MIS ENVIOS</h4></td>
          </tr>

          <tr>
            <td class="Estilo1d">Folio</td>
            <td class="Estilo1d">Tipo Documento</td>
            <td class="Estilo1d">N� Documento</td>
            <td class="Estilo1d">Proveedor</td>
            <td class="Estilo1d">Rut</td>
            <td class="Estilo1d">Valor Documento</td>
            <td class="Estilo1d">Recepci�n en Of de Partes</td>
            <td class="Estilo1d">Documentos</td>
            <td class="Estilo1d">D�as Transcurridos</td>
          </tr>

          <?php while($row2 = mysql_fetch_array($res2)) { 
            $fechahoy = $date_in;
            $dia1 = strtotime($fechahoy);
            $fechabase =$row2["eta_fecha_recepcion"];
            $dia2 = strtotime($fechabase);
            $diff=$dia1-$dia2;
            $diff=intval($diff/(60*60*24));
            if ($etapa2a>=$diff)
             $clase="Estilo1cverde";
           if ($etapa2a<$diff and $etapa2b>=$diff )
             $clase="Estilo1camarrillo";
           if ( $etapa2b<$diff)
             $clase="Estilo1crojo";

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
              $vartipodoc="N.Credito";
            if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
              $vartipodoc="N.D�bito";
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


        ?>
        <tr>
          <td class="Estilo1d"><?php  echo $row2["eta_folio"] ?></td>
          <td class="Estilo1d"><?php echo $vartipodoc ?></td>
          <td class="Estilo1c"><? echo $row2["eta_numero"]  ?></td>
          <td class="Estilo1d"><? echo $row2["eta_cli_nombre"]  ?> </td>
          <td class="Estilo1d" title="<? echo $row2["eta_cli_nombre"]  ?>"><? echo $row2["eta_rut"]  ?>-<? echo $row2["eta_dig"]  ?> </td>
          <td class="Estilo1c"><? echo number_format($row2["eta_monto"],0,',','.')  ?> </td>
          <td class="<? echo $clase ?>"><? echo substr($row2["eta_fecha_recepcion"],8,2)."-".substr($row2["eta_fecha_recepcion"],5,2)."-".substr($row2["eta_fecha_recepcion"],0,4)   ?></td>
          <td class="Estilo1d">
            <a href="#" onClick="abrirVentana('<?php echo $fac_id ?>')">VER</a>
          </td>
          <td class="Estilo1c"><? echo $diff   ?> </td>
        </tr>
        <?php } ?>
      </table>
      <img src="images/pix.gif" width="1" height="10">
    </body>
    </html>
    <?
//require("inc/func.php");
    ?>
