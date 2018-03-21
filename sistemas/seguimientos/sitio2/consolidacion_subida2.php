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
    <div class="col-sm-3 col-lg-3">
      <div class="dash-unit2">
        <?
        require("inc/menu_1.php");
        ?>
      </div>
    </div>

    <div class="col-sm-9 col-lg-9">
      <div class="dash-unit2">


       <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">SUBIDA DE ARCHIVO SIGFE</span></td>
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


if (isset($_GET["numero"])) {
    $numero=$_GET["numero"];
} else {
    $numero=$_POST["numero"];
}


if (isset($_GET["sw"])) {
    $sw=$_GET["sw"];
    if ($sw==1) {

        $sql6="update concilia_sigfe w set w.sigfe_estado=1 where w.sigfe_mesp='$mesp' and w.sigfe_annop='$annop' and w.sigfe_region='$regionsession' and w.sigfe_numero='$numero' and w.sigfe_estado=2";
//        echo $sql6;
//        exit();
        mysql_query($sql6);

        $sql6="delete x,y from concilia_sigfe x, concilia_indice  y  where x.sigfe_mesp='$mesp' and x.sigfe_annop='$annop' and x.sigfe_region='$regionsession' and x.sigfe_numero='$numero' and x.sigfe_id=y.indi_sigfe_id";
//        echo $sql6;
//        exit();
        mysql_query($sql6);
        
        $sql6="delete from concilia_sigfe where sigfe_mesp='$mesp' and sigfe_annop='$annop' and sigfe_region='$regionsession' and sigfe_numero='$numero'";
//echo $sql6;
//exit();
        mysql_query($sql6);
        
        
        $sql6="update concilia_sigfe w set w.sigfe_estado=1 where w.sigfe_region='$regionsession' and w.sigfe_numero='$numero' and w.sigfe_estado=2";
//        echo $sql6;
//        exit();
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


?>
                         </td>
                      </tr>


                      <tr>
                        <td><a href="consolidacion_menu2.php" class="link" > Volver </a></td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>
<?
if ($activo4<>0) {
?>

                      </tr>

                   <tr>
                  <td height="50" colspan="3">
                    
                        <table>
                        <form name="form1" action="consolidacion_subida2.php" method="post"   >
                              <tr>
                             <td  valign="center" class="Estilo1">Preriodo a procesar</td>
                             <td class="Estilo1" colspan=3> Mes : <? echo $mesp ?>, Año :<? echo $annop ?>

                             </td>
                           </tr>

                                                 <tr>
                             <td  valign="top" class="Estilo1">CUENTA</td>
                             <td class="Estilo1">
                                <select name="numero" class="Estilo1" onchange="this.form.submit()">
                                   <option value="0">Seleccione...</option>
                                 <?
                                    $sql2 = "Select * from concilia_cc where cc_region=$regionsession ";
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
<?
  if ($numero<>'') {
?>
                        <form name="form2" action="consolidacion_grabasubidasigfe.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">
                              <tr>
                             <td  valign="center" class="Estilo1">ARCHIVO</td>
                             <td class="Estilo1" colspan=3>
                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>
                              <a href="documentocaducado/<? echo $row3["provee_archivo1"]; ?>" class="link" target="_blank"><? echo $row3["provee_archivo1"]; ?></a>
                             </td>
                           </tr>



                    </table>
                     <tr>
                       <td><Br></td>
                      </tr>

                             <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    SUBIR ARCHIVO  " > </td>
                           </tr>

                          <input type="hidden"  name="region" value="<? echo $reg2 ?>" >
                          <input type="hidden"  name="anno" value="<? echo $anno2 ?>"  >
                          <input type="hidden"  name="producto" value="<? echo $prod2 ?>" >
                          <input type="hidden"  name="nacional" value="<? echo $nac2 ?>" >
                          <input type="hidden"  name="numero" value="<? echo $numero ?>" >

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      
                         <table border=0>
                         <tr>
                            <td><a href="consolidacion_subida2.php?sw=1&numero=<? echo $numero ?>" class="link" onclick="return confirm('Seguro que desea eliminar los registros ?')"> Eliminar Datos del Periodo en Curso </a></td>
                        </tr>



                         </table>

                           <br>
<table border=0 width="100%">
    <thead>
        <tr class="">
        <th class="Estilo1">OP</th>
        <th class="Estilo1">Fecha</th>
        <th class="Estilo1">N°</th>
        <th class="Estilo1">Descripcion</th>
        <th class="Estilo1">Cargo</th>
        <th class="Estilo1">Abono</th>
    </tr>
  </thead>
    <tbody>


<?
     $sql=" select * from concilia_sigfe where sigfe_mesp='$mesp' and sigfe_annop='$annop' and sigfe_region='$regionsession' and sigfe_numero='$numero'";
    echo $sql;
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
   <td class="Estilo1">
    <? echo $cont  ?></td>
   <td class="Estilo1"><? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td class="Estilo1"><? echo $row2["sigfe_numdoc"] ?></td>
   <td class="Estilo1"><? echo $row2["sigfe_bene"] ?></td>
   <td class="Estilo1"><? echo $row2["sigfe_abono"] ?></td>
   <td class="Estilo1"><? echo $row2["sigfe_cargo"] ?></td>

  </tr>

<?
     $cont++;
     }

    }
     $cont2=$cont;
} else {
    echo "<center>PERIODO CERRADO </center><br><br>";
}

?>
    </tbody>
</table>
</div>
</div>


<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>


