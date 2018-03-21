<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
$deptosession = $_SESSION["depto"];
$res=$_GET["res"];
$nacional=$_GET["nacional"];
$date_in=date("d-m-Y");
$annomio=date("Y");
$annomio2=$annomio-1;

?>
<html>
<head>
<title>Unidades</title>
<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
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
	font-size: 10px;
	color: #003063;
	text-align: center;
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
	color: #003063;

}
.Estilo2c {
	font-family: Verdana;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo2d {
	font-family: Verdana;
	font-size: 10px;
	text-align: right;
	color: #003063;
}
.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	color: #003063;
}
.Estilo3 {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	font-weight: bold;
	color: #003063;
}
.Estilo3c {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: center;
	color: #003063;
}
.Estilo3d {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: right;
	color: #003063;
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
	font-size: 12px;
	font-weight: bold;
	color: #00659C;
	text-decoration:none;
	text-transform:uppercase;
}
.link:over {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
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


<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

<script>
function ponPrefijo(pref,aux) {
	opener.document.formul.codigo.value=pref
	opener.document.formul.pvp.value=aux
	window.close()
}

function cerrarventana(){
   window.close();
//alert('cerrando');
}
function cierre2(id,folio){
//    alert("-- "+id);
   opener.document.form1.iddocmaster.value=id;
   opener.document.form1.foliocmaster.value=folio;
//   opener.document.form1.fecha4.value=fecha;
//   opener.document.getElementById("linkarchivo").href+="../../archivos/docargedo/"+archivo;
//   opener.document.getElementById('verlink').innerHTML=archivo;
   
   
   window.close();
//alert('cerrando');
}

function ejecutar(){
   document.grabar.submit();
//alert('cerrando');
}
</script>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<br>
<form action="argedo_docmaster.php" name="buscar" method="get">




<table>
      <tr>
         <td  valign="center" class="Estilo1" colspan=2>N° Folio
            <input type="text" name="res" class="Estilo2" size="12" value="<? echo $res; ?>" >
         </td>
       </tr>
      <tr>
         <td  valign="center" class="Estilo1" colspan=2>
            <input type="submit" value="Buscar">
         </td>
       </tr>
</table>

</form>
<?
if ($res<>'' or 1==1) {
?>
                  <hr>
 <input type='button' onclick='cerrarventana()' value='Cerrar Ventana'>


                  <table border=1>

<?
   if ($nacional==1) {
       $defnacional=" or docs_defensoria ='15' ";
   }

$sw=0;


//$sql2 = "Select * from doc_recibida where reci_origenid ='$deptosession' and reci_estado=1 and  ";
if ($res<>"") {
    $where1.=" and reci_recif_id='$res'  ";
    $sw=1;
}
if ($sw==1){
    $sql2.=" 1=1 limit 0,20 ";
}
if ($sw==0){
    $sql2.=" 1=1  limit 0,20 ";
}

//$dbh66=mysql_connect("localhost", "docmaster", "docmaster.") or die ('I cannot connect to the database because: ' . mysql_error());
//mysql_select_db ("DOCMASTER",$dbh66);

//$deptosession=1524;
     $sql2 = "Select * from doc_recibida where  (IF( reci_origensw = 'C', reci_archivo <> '', (
reci_archivo <> ''
OR reci_archivo = ''
) ) ) and reci_estado=1 and reci_origenid='$deptosession' order by reci_recif_id desc ";



//$sql2 = "Select * from doc_recibida where (reci_archivo<>'' or reci_tipodoc='RESERVADO' or reci_reservado=1) and reci_estado=1 and reci_origenid='$deptosession' $where1 order by reci_recif_id desc ";
//echo $sql2;
$res2 = mysql_query($sql2, $dbh6) or die ("muere");
$cont=1;
while($row2 = mysql_fetch_array($res2)){


$numdef=$row2["docs_defensoria"];
$sql4="select * from regiones  where codigo=$numdef";
//echo $sql;
$result4=mysql_query($sql4);
$row4=mysql_fetch_array($result4);
$nombre2=$row4["nombre"];


?>
          <tr>
              <td class="Estilo1"><? echo $row2["reci_recif_id"] ?></td>
              <td class="Estilo1"><a href="#" class="link" onclick="cierre2('<? echo $row2["reci_id"]  ?>','<? echo $row2["reci_recif_id"]  ?>')"><? echo $row2["reci_materia"] ?></a></td>
              <td class="Estilo1"><? echo $nombre2 ?></td>
          </tr>

<?
}
?>
</table>
                               <input type="hidden" name="cont" value="<? echo $cont ?>" >


  <div align="center">
    <label>


    </label>
  </div>
</form>
<p align="center">&nbsp;</p>
</body>
</html>
<?
}
?>
