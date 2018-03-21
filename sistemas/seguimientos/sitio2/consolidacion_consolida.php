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
<img src="images/pix.gif" width="1" height="10">
<table width="752" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
  <tr>
    <td width="1009">
	  <?
	  require("inc/top.php");      
	  ?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="165" valign="top">
		  <?
		  require("inc/menu_1.php");
		  ?>		  </td>
          <td valign="top">           <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="530" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7"></span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">

<?
$se=$_GET["sw"];

$reg2=$_POST["region"];
$anno2=$_POST["anno"];
$prod2=$_POST["producto"];
$nac2=$_POST["nacional"];

   $sql="select max(ar_mes) as mes from eje_archivo where ar_region=$reg2 and ar_anno=$anno2 and ar_producto='$prod2'  order by ar_id ";
//   echo $sql;
   $res2 = mysql_query($sql,$dbh5);
   $row2 = mysql_fetch_array($res2);
   $inicio=$row2["mes"];

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
 echo "<p>Archivo Procesado Anteriormente !";}

?>
                         </td>
                      </tr>


                      <tr>
                        <td><a href="infopres_menu1.php" class="link" > Volver </a></td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
                      <tr>
                        <td><h3>Conciliación</h3></td>
                      </tr>


                   <tr>
             			<td height="50" colspan="3">
                
Conciliacion Monto
                         <table border=1>
                             <tr>
                               <td class="Estilo1">N°</td>
                               <td class="Estilo1">FECHA DOC.</td>
                               <td class="Estilo1">Benef.Sigfe</td>
                               <td class="Estilo1">Descrip.cartola</td>
                               <td class="Estilo1">Cartola</td>
                               <td class="Estilo1">Sigfe</td>
                               <td class="Estilo1">Monto C</td>
                               <td class="Estilo1">Monto S</td>
                               <td class="Estilo1">Estado</td>
                               <td class="Estilo1">VALIDAR</td>
                              </tr>

<?

$sw=1;
if ($sw==1 and 1==2) {
    $sql="select  (x.carto_descripcion) as carto, (x.carto_operacion) as a, (y.sigfe_numdoc) as b,  (x.carto_cargo) as m1,  (y.sigfe_monto) as m2,
                    (y.sigfe_bene) as c, (x.carto_fecha) as d
     from concilia_cartola x left join concilia_sigfe y  on x.carto_operacion=y.sigfe_numdoc  ";

} else {

     $sql="select (x.carto_descripcion) as carto,  (x.carto_operacion) as a, (y.sigfe_numdoc) as b,  (x.carto_cargo) as m1,  (y.sigfe_monto) as m2,
                    (y.sigfe_bene) as c, (x.carto_fecha) as d
     from concilia_cartola x, concilia_sigfe y where x.carto_cargo=y.sigfe_monto and x.carto_operacion=1720 ";
}
     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $si=0;
     while ($row2 = mysql_fetch_array($res2)) {
         if ($row2["m1"]==$row2["m2"]) {
              $imagen="green.png";
              $si=$si+1;

         } else {
              $imagen="red.png";
         }

?>
    <tr>
      <td  class="Estilo1"><? echo $cont; ?></td>
      <td  class="Estilo1" width="70"><? echo substr($row2["d"],8,2)."-".substr($row2["d"],5,2)."-".substr($row2["d"],0,4)   ?></td>
      <td  class="Estilo1">Transferencia</td>
      <td  class="Estilo1"><? echo $row2["carto"]; ?></td>
      <td  class="Estilo1"><? echo $row2["a"]; ?></td>
      <td  class="Estilo1"><? echo $row2["b"]; ?></td>
      <td  class="Estilo1"><? echo $row2["m1"]; ?></td>
      <td  class="Estilo1"><? echo $row2["m2"]; ?></td>
      <td  class="Estilo1"><img src="images/<? echo $imagen ?>" alt="CUMPLIDA" height="17" width="19" border=0></td>
      <td  class="Estilo1"><a href="infopres_validarprocesa.php?region=<? echo $row2["ar_region"]; ?>&mes=<?  echo $row2["ar_mes"]; ?>&anno=<? echo $row2["ar_anno"]; ?>&producto=<? echo $row2["ar_producto"]; ?>" class="link" >validar</a></td>
    </tr>
 <?
  $cont++;
}
//--- Regla 1 1720 son tranferencias los agrupados en la subida del sigfe por los numero correlativos de la cartola tranferencia
     $sql="update concilia_cartola x, concilia_sigfe y set x.carto_estado=2, y.sigfe_estado=2 where x.carto_operacion=1720 and x.carto_cargo=y.sigfe_monto ";
     echo $sql;
     mysql_query($sql);
     
// --- Regla 2 los directo numero de documento y nuemro de sigfe ademas el monto es todo lo mismo.
     $sql="update concilia_cartola x, concilia_sigfe y set x.carto_estado=2, y.sigfe_estado=2 where x.carto_operacion=y.sigfe_numdoc and (y.sigfe_estado2 <>'AJUSTADO' and y.sigfe_estado2 <>'AJUSTE')";
     echo $sql;
     mysql_query($sql);

//--- Regla 3 ajuste con ajustados sumatoria si cuadra todo se hace el updates de los ajustados con los ajustes
     $sql=" select sum(sigfe_monto) as m11 from concilia_sigfe where sigfe_estado2='AJUSTADO' and sigfe_estado=1 ";
     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m11=$row2["m11"];

     $sql=" select sum(sigfe_monto) as m22 from concilia_sigfe where sigfe_estado2='AJUSTE' and sigfe_estado=1 ";
     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m22=$row2["m22"];
     echo "      $m11----   $m22 <br> ";
     if ($m11==$m22) {
        $sql="update concilia_sigfe set sigfe_estado=2 where (sigfe_estado2='AJUSTADO' or sigfe_estado2 ='AJUSTE') and sifge_estado=1";
        mysql_query($sql);
     }


// --- Regla 4 los que cuadran por monto pero muy importante en cartola es el campo abono .
     $sql="update concilia_cartola x, concilia_sigfe y set x.carto_estado=2, y.sigfe_estado=2 where x.carto_abono=y.sigfe_monto and x.carto_estado=1 and y.sigfe_estado=1 ";
     echo $sql;
     mysql_query($sql);

 ?>




                         </table>
                              
 <?
$cont=$cont-1;
echo "total registros $cont <br>";
echo "total conciliados $si <br>";
$dif=$cont-$si;
echo "Resto  $dif <br>";

?>
                
                
Conciliacion Directa
                         <table border=1>
                             <tr>
                               <td class="Estilo1">N°</td>
                               <td class="Estilo1">FECHA DOC.</td>
                               <td class="Estilo1">Benef.Sigfe</td>
                               <td class="Estilo1">Descrip.cartola</td>
                               <td class="Estilo1">Cartola</td>
                               <td class="Estilo1">Sigfe</td>
                               <td class="Estilo1">Monto C</td>
                               <td class="Estilo1">Monto S</td>
                               <td class="Estilo1">Estado</td>
                               <td class="Estilo1">VALIDAR</td>
                              </tr>
<?

$sw=1;


     $sql="select (x.carto_id) as idcarto, (x.carto_descripcion) as carto,  (x.carto_operacion) as a, (y.sigfe_numdoc) as b,  (x.carto_cargo) as m1,  (y.sigfe_monto) as m2,
                    (y.sigfe_bene) as c, (x.carto_fecha) as d
     from concilia_cartola x, concilia_sigfe y where x.carto_operacion=y.sigfe_numdoc and (y.sigfe_estado2 <>'AJUSTADO' and y.sigfe_estado2 <>'AJUSTE') and x.carto_cargo=y.sigfe_monto ";

     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $si=0;
     while ($row2 = mysql_fetch_array($res2)) {
         if ($row2["m1"]==$row2["m2"]) {
              $imagen="green.png";
              $si=$si+1;
//              $sql="update concilia_cartola x, concilia_sigfe y set x.carto_estado=2, y.sigfe_estado=2 where x.carto_operacion=1720 and x.carto_cargo=y.sigfe_monto ";
//              echo $sql;
//             mysql_query($sql);

              
              
         } else {
              $imagen="red.png";
         }

?>
    <tr>
      <td  class="Estilo1"><? echo $cont; ?></td>
      <td  class="Estilo1" width="70"><? echo substr($row2["d"],8,2)."-".substr($row2["d"],5,2)."-".substr($row2["d"],0,4)   ?></td>
      <td  class="Estilo1"><? echo $row2["c"]; ?></td>
      <td  class="Estilo1"><? echo $row2["carto"]; ?></td>
      <td  class="Estilo1"><? echo $row2["a"]; ?></td>
      <td  class="Estilo1"><? echo $row2["b"]; ?></td>
      <td  class="Estilo1"><? echo $row2["m1"]; ?></td>
      <td  class="Estilo1"><? echo $row2["m2"]; ?></td>
      <td  class="Estilo1"><img src="images/<? echo $imagen ?>" alt="CUMPLIDA" height="17" width="19" border=0></td>
      <td  class="Estilo1"><a href="infopres_validarprocesa.php?region=<? echo $row2["ar_region"]; ?>&mes=<?  echo $row2["ar_mes"]; ?>&anno=<? echo $row2["ar_anno"]; ?>&producto=<? echo $row2["ar_producto"]; ?>" class="link" >validar</a></td>
    </tr>
 <?
  $cont++;
}
 ?>




                         </table>
                         
Conciliacion Ajustes
                         <table border=1>
                             <tr>
                               <td class="Estilo1">N°</td>
                               <td class="Estilo1">FECHA DOC.</td>
                               <td class="Estilo1">Benef.Sigfe</td>
                               <td class="Estilo1">Descrip.cartola</td>
                               <td class="Estilo1">Cartola</td>
                               <td class="Estilo1">Sigfe</td>
                               <td class="Estilo1">Monto C</td>
                               <td class="Estilo1">Monto S</td>
                               <td class="Estilo1">Estado</td>
                               <td class="Estilo1">VALIDAR</td>
                              </tr>
<?

$sw=1;


    $sql="select (x.carto_id) as idcarto, (x.carto_descripcion) as carto,  (x.carto_operacion) as a, (y.sigfe_numdoc) as b,  (x.carto_abono) as m1,  (y.sigfe_monto) as m2,
                    (y.sigfe_bene) as c, (x.carto_fecha) as d
     from concilia_cartola x, concilia_sigfe y where x.carto_abono=y.sigfe_monto and x.carto_estado=1 and y.sigfe_estado=1  ";

     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $si=0;
     while ($row2 = mysql_fetch_array($res2)) {
         if ($row2["m1"]==$row2["m2"]) {
              $imagen="green.png";
              $si=$si+1;

         } else {
              $imagen="red.png";
         }

?>
    <tr>
      <td  class="Estilo1"><? echo $cont; ?></td>
      <td  class="Estilo1" width="70"><? echo substr($row2["d"],8,2)."-".substr($row2["d"],5,2)."-".substr($row2["d"],0,4)   ?></td>
      <td  class="Estilo1"><? echo $row2["c"]; ?></td>
      <td  class="Estilo1"><? echo $row2["carto"]; ?></td>
      <td  class="Estilo1"><? echo $row2["a"]; ?></td>
      <td  class="Estilo1"><? echo $row2["b"]; ?></td>
      <td  class="Estilo1"><? echo $row2["m1"]; ?></td>
      <td  class="Estilo1"><? echo $row2["m2"]; ?></td>
      <td  class="Estilo1"><img src="images/<? echo $imagen ?>" alt="CUMPLIDA" height="17" width="19" border=0></td>
      <td  class="Estilo1"><a href="infopres_validarprocesa.php?region=<? echo $row2["ar_region"]; ?>&mes=<?  echo $row2["ar_mes"]; ?>&anno=<? echo $row2["ar_anno"]; ?>&producto=<? echo $row2["ar_producto"]; ?>" class="link" >validar</a></td>
    </tr>
 <?
  $cont++;
}
 ?>




                         </table>


<?
$cont=$cont-1;
echo "total registros $cont <br>";
echo "total conciliados $si <br>";
$dif=$cont-$si;
echo "Resto  $dif <br>";

?>





<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>

