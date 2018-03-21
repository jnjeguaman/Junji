<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
//$rut=$_GET["rut"];
//$nacional=$_GET["nacional"];
extract($_POST);
extract($_GET);
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
function cierre2(rut,dig,nombre,argedo,ids,reg,nres){
//    alert("-- "+nres);
//   opener.document.form1.nroresolucion.value=num;

   opener.document.form1b.rut2.value=rut;
   opener.document.form1b.dig2.value=dig;
   opener.document.form1b.nombre2.value=nombre;
   opener.document.form1b.argedo2.value=argedo;
   opener.document.form1b.ids.value=ids;
   opener.document.form1b.reg2.value=reg;
   opener.document.form1b.nres2.value=nres;
   opener.document.form1b.submit();
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

<?

$cont=$_POST["cont"];
$var=$_POST["var"];
$var2=$_POST["var2"];
$var3=$_POST["var3"];

$cont2=1;

//echo "$cont2 $cont";
while ($cont2<=$cont) {

   $var1=$var[$cont2];
   $var22=$var2[$cont2];
   $var33=$var3[$cont2];
   $var44=$var4[$cont2];
  // $var22=$var2[$cont2];
   
   if ($var1<>"" ) {
       $folios.=$var1.",";
       $ids.=$var22.",";
       $nres.=$var44.",";
       if ($reg=='') {
         $reg=$var33;
       }
       
   }
   $cont2++;
}
//echo "--------".$folios;
//exit();
if ($folios<>'') {
  echo "<script>cierre2(".$rut.",'".$dig."','".$nombre."','".$folios."','".$ids."','".$reg."','".$nres."');</script>";
}
?>
<!--
<form action="compra_listaresolucion.php" name="buscar" method="get">




<table>
      <tr>
         <td  valign="center" class="Estilo1" colspan=2>Rut
            <input type="text" name="rut" class="Estilo2" size="12" value="<? echo $rut; ?>" >
         </td>
       </tr>
      <tr>
        <td  valign="top" class="Estilo1" colspan=2>Defensoría Nacional

         </td>
     </tr>
      <tr>
         <td  valign="center" class="Estilo1" colspan=2>
            <input type="submit" value="Buscar">
         </td>
       </tr>


</table>

</form>
-->
<?

if ($rut<>'') {
?>
                  <hr>
 <input type='button' onclick='cerrarventana()' value='Cerrar Ventana'>
 <br><br>

<form id="form1" action="compra_listaresolucionb.php"  method="post">
  <input type='submit' value='Aceptar'>
                  <table border=1>

<?
   if ($nacional==1) {
       $defnacional=" or docs_defensoria ='15' ";
   }

$sw=0;

$sql2 = "Select * from cometido_funcionario where come_rut='$rut' and come_swree=0 and ";
//$sql2 = "Select * from argedo_documentos where (docs_defensoria='$regionsession' $defnacional ) and docs_anno in ($annomio, $annomio2) and (docs_tipo=6 or docs_tipo=1) and  ";
if ($res<>"") {
    $sql2.=" docs_folio='$res' and ";
    $sw=1;
}
if ($sw==1){
    $sql2.=" 1=1 order by docs_id desc";
}
if ($sw==0){
    $sql2.=" 1=1 order by come_id desc";
}

//echo $sql2;
$res2 = mysql_query($sql2);
$cont=1;
while($row2 = mysql_fetch_array($res2)){


//$numdef=$row2["docs_defensoria"];
//$sql4="select * from regiones  where codigo=$numdef";
//echo $sql;
//$result4=mysql_query($sql4);
//$row4=mysql_fetch_array($result4);

//echo $nombre22:
if ($nombre22=='') {
   $nombre22=$row2["come_nombre"];
   $dig22=$row2["come_dig"];
}


?>
          <tr>
              <td class="Estilo1">
               <input type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row2["come_docs_id"] ?>" class="Estilo2" >
               <input type="hidden" name="var2[<? echo $cont ?>]" value="<? echo $row2["come_lugar"] ?>"  >
               <input type="hidden" name="var3[<? echo $cont ?>]" value="<? echo $row2["come_ccosto"] ?>"  >
               <input type="hidden" name="var4[<? echo $cont ?>]" value="<? echo $row2["come_nres"] ?>"  >
              </td>
              <td class="Estilo1"><? echo $row2["come_nombre"] ?></td>
              <td class="Estilo1"><? echo $row2["come_nres"] ?></td>
              <td class="Estilo1"><? echo $row2["come_fechares"] ?></td>
<!--
              <td class="Estilo1"><a href="#" class="link" onclick="cierre2('<? echo $row2["docs_folio"]  ?>','<? echo $row2["docs_id"]  ?>','<? echo$row2["docs_fecha"]  ?>','<? echo$row2["docs_archivo"]  ?>')"><? echo $row2["docs_materia"] ?></a></td>
-->

          </tr>

<?
  $cont++;
}
?>
</table>
 <input type='submit' value='Aceptar'>

                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                               <input type="hidden" name="rut" value="<? echo $rut ?>" >
                               <input type="hidden" name="dig" value="<? echo $dig22 ?>" >
                               <input type="hidden" name="nombre" value="<? echo $nombre22 ?>" >


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
