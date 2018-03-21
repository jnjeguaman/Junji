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
$year=date("Y");
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
   .Estilo1bazul {
     font-family: Verdana;
     font-weight: bold;
     font-size: 8px;
     color: #0000FF;
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
    font-size: 15px; font-weight: bold;}
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
          <td height="20" colspan="2"><span class="Estilo7">CONSULTA CHEQUES PAGADOS</span></td>
        </tr>
        <tr>
         <td><hr></td><td><hr></td>
       </tr>
       <?

       $mes=($_GET["mes"] <> "") ? $_GET["mes"]: date("m");
       $anno=($_GET["anno"] <> "") ? $_GET["anno"] : date("Y");
       $region=$_GET["region"];
       $fecha1=$_GET["fecha1"];
       $fecha2=$_GET["fecha2"];
       $rut=$_GET["rut"];
       $item=$_GET["item"];
       $idegreso=$_GET["idegreso"];
       $ncheque=$_GET["ncheque"];
       $fpago=$_GET["fpago"];
       $consolidado=$_GET["consolidado"];

       ?>
       <tr>
        <td><a href="menucontabilidad3.php?rut=<? echo $rut ?>" class="link" > Volver </a></td>
      </tr>
      <tr>
       <td><hr></td><td><hr></td>
     </tr>



     <tr>
      <td height="50" colspan="3">

       <table width="488" border="0" cellspacing="0" cellpadding="0">
         <form name="form1" action="consultalibrocompra.php" method="get">
           <tr>
             <td  valign="top" class="Estilo1">Region</td>
             <td class="Estilo1">
              <select name="region" class="Estilo1">

               <?
               if ($regionsession==14) {
                $sql2 = "Select * from regiones where activo=1 ";
                echo '<option value="0">Todas</option>';
              } else
              $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
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
         <td  valign="top" class="Estilo1">Mes  </td>
         <td class="Estilo1" colspan=3>
           <select name="mes" class="Estilo1">
            <option value="">Seleccione...</option>
            <option value="01" <? if ($mes=='01') echo "selected=selected" ?>>Enero</option>
            <option value="02" <? if ($mes=='02') echo "selected=selected" ?>>Febrero</option>
            <option value="03" <? if ($mes=='03') echo "selected=selected" ?>>Marzo</option>
            <option value="04" <? if ($mes=='04') echo "selected=selected" ?>>Abril</option>
            <option value="05" <? if ($mes=='05') echo "selected=selected" ?>>Mayo</option>
            <option value="06" <? if ($mes=='06') echo "selected=selected" ?>>Junio</option>
            <option value="07" <? if ($mes=='07') echo "selected=selected" ?>>Julio</option>
            <option value="08" <? if ($mes=='08') echo "selected=selected" ?>>Agosto</option>
            <option value="09" <? if ($mes=='09') echo "selected=selected" ?>>Septiembre</option>
            <option value="10" <? if ($mes=='10') echo "selected=selected" ?>>Octubre</option>
            <option value="11" <? if ($mes=='11') echo "selected=selected" ?>>Noviembre</option>
            <option value="12" <? if ($mes=='12') echo "selected=selected" ?>>Diciembre</option>

          </select>
        </td>
      </tr>
      <tr>
       <td  valign="top" class="Estilo1">Año  </td>
       <td class="Estilo1" colspan=3>
         <select name="anno" class="Estilo1">
          <option value="">Seleccione...</option>
          <option value="2010" <? if ($anno==2010) echo "selected=selected" ?> >2010</option>
          <option value="2011" <? if ($anno==2011) echo "selected=selected" ?> >2011</option>
          <option value="2012" <? if ($anno==2012) echo "selected=selected" ?> >2012</option>
          <option value="2013" <? if ($anno==2013) echo "selected=selected" ?> >2013</option>
          <option value="2014" <? if ($anno==2014) echo "selected=selected" ?> >2014</option>
          <option value="2015" <? if ($anno==2015) echo "selected=selected" ?> >2015</option>
          <option value="2016" <? if ($anno==2016) echo "selected=selected" ?> >2016</option>
          <option value="2017" <? if ($anno==2017) echo "selected=selected" ?> >2017</option>
          <option value="2018" <? if ($anno==2018) echo "selected=selected" ?> >2018</option>
          <option value="2019" <? if ($anno==2019) echo "selected=selected" ?> >2019</option>
          <option value="2020" <? if ($anno==2020) echo "selected=selected" ?> >2020</option>
          <option value="2021" <? if ($anno==2021) echo "selected=selected" ?> >2021</option>

        </select>
      </td>
    </tr>


    <tr>
     <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="reportes3.php"> Limpiar </a> </td>


   </tr>

 </form>

</td>


<tr>
 <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
</tr>
<tr>
  <td class="Estilo1" colspan=1><a href="reportes5excel.php?mes=<? echo $mes ?>&anno=<? echo $anno ?>&region=<? echo $region ?>" class="link" > Libro Compras a Excel </a>
  </tr>

  <table border=1>
    <tr>
     <td class="Estilo1b">Folio</td>
     <td class="Estilo1b">Rut</td>
     <td class="Estilo1b">Nombre</td>
     <td class="Estilo1b">Tipo Doc</td>
     <td class="Estilo1b">Nº Doc</td>
     <td class="Estilo1b">Id Egreso</td>
     <td class="Estilo1b">Nº Cheque</td>
     <td class="Estilo1b">Fecha Cheque</td>
     <td class="Estilo1b">Fecha Pago</td>
     <td class="Estilo1b">Monto</td>
   </tr>

   <?
   $sw=0;

//   $sql="select hono_nombre, hono_rut,hono_dig, count(hono_rut) as cuentarut, sum(hono_bruto) as hono_bruto, sum(hono_retencion) as hono_retencion, sum(hono_liquido) as hono_liquido from dpp_honorarios where ";
   $sql="select * from dpp_etapas where eta_estado<10 and eta_tipo_doc='Factura'  and (eta_tipo_doc3<>'R' and eta_tipo_doc3<>'B'  and eta_tipo_doc3<>'BH' and eta_tipo_doc3<>'BHS') and ";

  $sql = "select * from dpp_etapas where eta_estado<10 and eta_tipo_doc='Factura'  and (eta_tipo_doc3<>'R' and eta_tipo_doc3<>'B'  and eta_tipo_doc3<>'BH' and eta_tipo_doc3<>'BHS') and eta_fdevengo <> '' and ";
  
   if ($region<>"") {
    if ($region==0)
      $sql.=" eta_region<>'' and ";
    else
      $sql.=" eta_region=$region and ";
    $sw=1;
  }

  if ($mes<>"") {
    // $sql.=" month(eta_fechache)='$mes' and ";
    $sql.=" month(eta_fdevengo)='$mes' and ";
    $sw=1;
  }
  if ($anno<>"" ) {
    // $sql.=" year(eta_fechache)='$anno' and ";
    $sql.=" year(eta_fdevengo)='$anno' and ";
    $sw=1;
  }

$sql.=" 1 = 1";

  // if ($sw==1){
  //   $sql.=" 1=1 and (eta_estado=8  or eta_estado = 7)";
  // }
  // if ($sw==0){
  //   $sql.=" 1=2 ";
  // }
// echo $sql;

  $res3 = mysql_query($sql);
  $cont=1;
  while($row3 = mysql_fetch_array($res3)){

    ?>


    <tr>
     <td class="Estilo1b"><? echo $row3["eta_folio"]  ?> </td>
     <td class="Estilo1b"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
     <td class="Estilo1b"><? echo $row3["eta_cli_nombre"];  ?> </td>
     <td class="Estilo1b"><? echo $row3["eta_tipo_doc"]  ?> </td>
     <td class="Estilo1b"><? echo $row3["eta_numero"]  ?> </td>
     <td class="Estilo1b"><? echo $row3["eta_negreso"]  ?> </td>
     <td class="Estilo1b"><? echo $row3["eta_ncheque"]  ?> </td>
     <td class="Estilo1b"><? echo substr($row3["eta_fechache"],8,2)."-".substr($row3["eta_fechache"],5,2)."-".substr($row3["eta_fechache"],0,4)   ?></td>
     <td class="Estilo1b"><? echo substr($row3["eta_fecha_retira"],8,2)."-".substr($row3["eta_fecha_retira"],5,2)."-".substr($row3["eta_fecha_retira"],0,4)   ?></td>
     <td class="Estilo1c"><? echo number_format($row3["eta_monto2"],0,',','.')   ?> </td>
   </tr>





   <?


   $cont++;

 }

 if ($region==0) {
   $sql="select * from ff_factura where month(fffac_fecharendicion)='$mes' and year(fffac_fecharendicion)='$anno'  ";
 } else {
   $sql="select * from ff_factura where month(fffac_fecharendicion)='$mes' and year(fffac_fecharendicion)='$anno' and fffac_region=$region ";
 }
//    echo $sql;
 $res3 = mysql_query($sql);
 while($row3 = mysql_fetch_array($res3)){

  ?>
  <tr>
   <td class="Estilo1bazul"><? echo $row3["fffac_id"]  ?> </td>
   <td class="Estilo1bazul"><? echo $row3["fffac_rut"]  ?>-<? echo $row3["fffac_dig"]  ?> </td>
   <td class="Estilo1bazul"><? echo $row3["fffac_nombre"];  ?> </td>
   <td class="Estilo1bazul"><? echo "Factura";  ?> </td>
   <td class="Estilo1bazul"><? echo $row3["fffac_numero"]  ?> </td>
   <td class="Estilo1bazul"><? echo $row3["fffac_idtesoreria"]  ?> </td>
   <td class="Estilo1bazul"><? echo $row3["fffac_nrocheque"]  ?> </td>
   <td class="Estilo1bazul"><? echo substr($row3["fffac_fecharendicion"],8,2)."-".substr($row3["fffac_fecharendicion"],5,2)."-".substr($row3["fffac_fecharendicion"],0,4)   ?></td>
   <td class="Estilo1bazul"><? echo substr($row3["fffac_fecharendicion"],8,2)."-".substr($row3["fffac_fecharendicion"],5,2)."-".substr($row3["fffac_fecharendicion"],0,4)   ?></td>
   <td class="Estilo1bazul"><? echo number_format($row3["fffac_total"],0,',','.')   ?> </td>
 </tr>



 <?
}
?>

<tr>





</td>
</tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
