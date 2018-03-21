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
$date_in=date("d-m-Y");
?>
<html>
<head>
<title>CONTABILIDAD</title>
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
	font-size: 10px;
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
.Estilo1crojoc {
	font-family: Verdana;
	font-weight: bold;
	font-size: 12px;
	color: #CC0000;
	text-align: center;
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
font-weight: bold;
text-align: center; }

}
.Estilo8 {font-family: Geneva, Arial, Helvetica, sans-serif; 
font-size: 10px; font-weight: bold; text-align: left; 
color: #009900;}

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
  
<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--

function valida() {

   if (document.form1.region.value==0 ) {
      alert ("Region presenta problemas ");
      return false;
  }
   if (document.form1.anno.value=='') {
      alert ("Fecha Documento presenta problemas ");
      return false;
  }
   if (!document.form1.producto[0].checked && !document.form1.producto[1].checked && !document.form1.producto[2].checked && !document.form1.producto[3].checked) {
      alert ("Producto presenta problemas ");
      return false;
  }
  if (document.form2.mes.value=='') {
      alert ("Mes presenta problemas ");
      return false;
  }

   if (document.form2.archivo1.value=='') {
      alert ("Documento Adjunto presenta problemas ");
      return false;
  }

}


function abreVentana2(a,b,c){
//    alert("entra");
    var numero=a;
    var mesp=b;
    var annop=c;
	miPopup = window.open("consolidacion_subirarchivo.php?numero="+numero+"&mesp="+mesp+"&annop="+annop,"miwin","width=500,height=200,scrollbars=yes,toolbar=0")
	miPopup.focus()
}



//-->

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

                    <div class="dash-unit2"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">RESUMEN GENERAL</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">

<?


$sql2 = "Select * from concilia_parametros";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$mesp=$row2["para_mes"];
$annop=$row2["para_anno"];

echo "Periodo : ".$mesp."-".$annop;
$region=$_POST["region"];
if ($usuario=='cantilef' or $nivel==23) {
  $regionsession=$region;
}

if (isset($_GET["sw"])) {
    $sw=$_GET["sw"];
    if ($sw==1) {

    /*
        $sql6="update concilia_sigfe x, concilia_indice  y set sigfe_estado=1 where x.sigfe_mesp='$mesp' and x.sigfe_annop='$annop' and x.sigfe_region='$regionsession' and x.sigfe_id=y.indi_sigfe_id";
//        $sql6="delete x,y from concilia_sigfe x, concilia_indice  y  where x.sigfe_mesp='$mesp' and x.sigfe_annop='$annop' and x.sigfe_region='$regionsession' and x.sigfe_id=y.indi_sigfe_id";
        echo $sql6;
        exit();
        mysql_query($sql6);
*/


        $sql6="delete x,y from concilia_sigfe x, concilia_indice  y  where x.sigfe_mesp='$mesp' and x.sigfe_annop='$annop' and x.sigfe_region='$regionsession' and x.sigfe_id=y.indi_sigfe_id";
        mysql_query($sql6);
        
        $sql6="delete from concilia_sigfe where sigfe_mesp='$mesp' and sigfe_annop='$annop' and sigfe_region='$regionsession'";
//echo $sql6;
//exit();
        mysql_query($sql6);

    }
}

   $arr1[1]='ENERO';
   $arr1[2]='FEBRERO';
   $arr1[3]='MARZO';
   $arr1[4]='ABRIL';
   $arr1[5]='MAYO';
   $arr1[6]='JUNIO';
   $arr1[7]='JULIO';
   $arr1[8]='AGOSTO';
   $arr1[9]='SEPTIEMBRE';
   $arr1[10]='OCTUBRE';
   $arr1[11]='NOVIEMBRE';
   $arr1[12]='DICIEMBRE';



?>
                         </td>
                      </tr>

                    <tr>
                         <td width="487" valign="top" class="Estilo1c">

<?

if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Archivo Procesado con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Archivo Procesado Anteriormente !";
}

    $sql2 = "Select * from regiones where codigo=$regionsession";
    //echo $sql;
    $res2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($res2);
    $activo4=$row2["activo4"];


    $numero=$_POST["numero"];
    if (isset($_GET["numero"])) {
      $numero=$_GET["numero"];
    }
?>
                         </td>
                      </tr>

<?
             if ($nivel<>23) {
?>

                      <tr>
                        <td><a href="consolidacion_menu.php" class="link" > Volver </a></td>
                      </tr>

<?
             }
?>
                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>

                   <tr>
             			<td height="50" colspan="3">
                    
                        <table>
                        <form name="form1" action="consolidacion_reporte1.php" method="post"   >
<?
             if ($regionsession==14 or $nivel==23) {
?>
                         <tr>
                             <td  valign="top" class="Estilo1">REGION</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1" onchange="this.form.submit()">

                                 <?
                                  if ($regionsession==14 or $nivel==23) {
                                    $sql2 = "Select * from regiones where codigo<20 ";
                                    echo '<option value="0">Todas</option>';
                                  } else {
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  }
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
<?
  }
?>
                        
                           <tr>
                             <td  valign="top" class="Estilo1">CUENTA</td>
                             <td class="Estilo1">
                                <select name="numero" class="Estilo1" onchange="this.form.submit()">
                                   <option value="0">Seleccione...</option>
                                 <?
                                  // if ($usuario=='concilia' or $nivel==23) {
                                 if($region <> ""){
                                    $sql2 = "Select * from concilia_cc where cc_region=$region ";
                                  } else {
                                    $sql2 = "Select * from concilia_cc where cc_region=$regionsession ";
                                  }

//                                    $sql2 = "Select * from concilia_cc where cc_region=$regionsession ";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["cc_numero"] ?>" <? if ($row2["cc_numero"]==$numero) echo "selected=selected" ?> ><? echo $row2["cc_numero"] ?></option>

                                 <?
                                   }
                                 ?>
                               </select>
                             </td>
                           </tr>
                        </form>
                        </table>

                           <br>
<?

if ($activo4<>0 or 1==1) {


if ($numero<>'') {

if ($region<>'') {
    $idreg=$region;
}
    include("consolidacion_procesocierre.php");

?>
<a href="consolidacion_impreporte3a.php?numero=<? echo $numero ?>&mesp=<? echo $mesp ?>&annop=<? echo $annop ?>" class="link" target="_blank"> informe </a>
<table border=0 width="100%">
    <thead>
        <tr class="">
        <th class="Estilo1"></th>
        <th class="Estilo1"></th>
        <th class="Estilo1"></th>
    </tr>
	</thead>
    <tbody>
     <tr  class="">
       <td class="Estilo1">Saldo anterior: </td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($resumonto,0,',','.'); ?></td>
     </tr>
     
     <tr  class="">
       <td class="Estilo1">Ingresos del mes (+)</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalcargo,0,',','.'); ?></td>
     </tr>
     <tr  class="">
       <td class="Estilo1">Ingresos Acumulados </td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($ingresoacumu,0,',','.'); ?></td>
     </tr>
     <tr  class="">
       <td class="Estilo1">Gastos del mes (-)</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalabono,0,',','.'); ?></td>
     </tr>
     
     <tr  class="">
       <td class="Estilo1">Saldo disponible</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($saldodisponible,0,',','.'); ?></td>
     </tr>


     <tr  class="">
       <td class="Estilo1">(-) Cargos no reconocidos por el banco</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalasigfecargo,0,',','.'); ?></td>
       <td>
         <a href="javascript:void(0)" onclick="window.open('consolidacion_reporte2a.php?numero=<? echo $numero; ?>','','width=600,height=600,scrollbars=1,location=1')"   class="link">Ver</a>
         </td>
     </tr>
     <tr  class="">
       <td class="Estilo1">(+) Cheques girados y no cobrados por el banco</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalabono2,0,',','.'); ?> </td>
       <td>
         <a href="javascript:void(0)" onclick="window.open('consolidacion_reporte2b.php?numero=<? echo $numero; ?>','','width=600,height=600,scrollbars=1,location=1')"   class="link">Ver</a>
         </td>
     </tr>
     <tr  class="">
       <td class="Estilo1">(-) Cargos no reconocidos por la contabilidad</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalacartocargo,0,',','.'); ?></td>
       <td>
         <a href="javascript:void(0)" onclick="window.open('consolidacion_reporte2c.php?numero=<? echo $numero; ?>','','width=600,height=600,scrollbars=1,location=1')"   class="link">Ver</a>
         </td>
     </tr>
     <tr  class="">
       <td class="Estilo1">(+) Abonos no reconocidos por la contabilidad</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalacartoabono,0,',','.'); ?></td>
       <td>
         <a href="javascript:void(0)" onclick="window.open('consolidacion_reporte2d.php?numero=<? echo $numero; ?>','','width=600,height=600,scrollbars=1,location=1')"   class="link">Ver</a>
         </td>
     </tr>
     <tr  class="">
       <td class="Estilo1">Saldo cartola</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($saldocartola,0,',','.'); ?></td>
     </tr>




<?
/*
     $sql=" select * from concilia_sigfe where sigfe_mesp='$mesp' and sigfe_annop='$annop' and sigfe_region='$regionsession' ";
//     echo $sql2;
     $res2 = mysql_query($sql);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo1mc";
          $estilo2d="Estilo1mcd";
          $estilo2i="Estilo1mci";
       } else {
          $estilo2="Estilo1mcblanco";
          $estilo2d="Estilo1mcblancod";
          $estilo2i="Estilo1mcblancoi";
       }

?>
 <tr  class="">
   <td class="Estilo1"></td>
   <td class="Estilo1"><? echo $row2["sigfe_abono"] ?></td>
   <td class="Estilo1"><? echo $row2["sigfe_cargo"] ?></td>
 </tr>

<?
     $cont++;

    }
*/
}
     $cont2=$cont;
} else {
    echo "PERIODO CERRADO";
}


?>
    </tbody>
</table>

<hr>
<br><br>
Informes<br><br>
<table width="488" border="1" cellspacing="0" cellpadding="0">
   <tr>
      <td  valign="top" class="Estilo1"> Mes  </td>
      <td  valign="top" class="Estilo1"> Año  </td>
      <td  valign="top" class="Estilo1"> Conciliación </td>
      <td  valign="top" class="Estilo1"> Anexos1 </td>
      <td  valign="top" class="Estilo1"> Anexos2 </td>
      <td  valign="top" class="Estilo1"> Subir PDF</td>
   </tr>
<?





     $sql=" select * from concilia_resumen where resu_numero='$numero' and resu_descripcion<>'Saldo anterior' and resu_mesp<>0 GROUP BY resu_annop, resu_mesp order by resu_fechasis desc";
   //  echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
//         $row2["sigfe_numdoc"]

if ($row2["resu_archivo"]=='') {
    $imagen="punt_rojo.jpg";
    $titulo="Subir Archivo";
    $href="<a href='#' class='link' onclick='abreVentana2(".$numero.",".$row2['resu_mesp'].",".$row2['resu_annop'].")' title='".$titulo."'>";
} else {
    $imagen="punt_verde.jpg";
    $titulo="Ver Archivo";
    $href="<a href='../../archivos/docconciliacion/reportes/".$row2["resu_archivo"]."' class='link' target='_blank' title='".$titulo."'>";
}
$imprimir="&nbsp;";
if ($row2["resu_mesp"]==$mesp and $row2["resu_annop"]==$annop) {
    $imprimir="Imprimir";
}

?>
   <tr>
      <td class="Estilo1"><? echo $row2["resu_mesp"] ?></td>
      <td class="Estilo1"><? echo $row2["resu_annop"] ?></td>
      <td  valign="top" class="Estilo1">
       <a href="consolidacion_impreporte3a.php?numero=<? echo $numero ?>&mesp=<? echo $mesp ?>&annop=<? echo $annop ?>" class="link" target="_blank"><? echo $imprimir ?></a>
       <a href="consolidacion_impreporte1a.php?numero=<? echo $numero ?>&mesp=<? echo $row2["resu_mesp"] ?>&annop=<? echo $row2["resu_annop"] ?>" class="link" ></a>
      </td>
      <td  valign="top" class="Estilo1"><a href="consolidacion_impreporte21.php?numero=<? echo $numero ?>&mesp=<? echo $row2["resu_mesp"] ?>&annop=<? echo $row2["resu_annop"] ?>" class="link" target="_blank"> <? echo $imprimir ?>  </a></td>
      <td  valign="top" class="Estilo1"><a href="consolidacion_impreporte22.php?numero=<? echo $numero ?>&mesp=<? echo $row2["resu_mesp"] ?>&annop=<? echo $row2["resu_annop"] ?>" class="link" target="_blank"> <? echo $imprimir ?>  </a></td>
      <td class="Estilo3c"><? echo $href ?><img src="images/<? echo $imagen ?>" width="20" height="20" border=0></a></td>

   </tr>


<?
     }
?>
</table>



<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>


