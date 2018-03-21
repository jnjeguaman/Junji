<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
$rut=$_GET["rut"];
$id=$_GET["id"];
$id1b=$_GET["id1b"];
//echo $rut;
$date_in=date("d-m-Y");
$fechamia=date('Y-m-d');

$numero=$_GET["numero"];
?>
<html>
<head>
<title>Conciliacion</title>
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
<link href="css/stylo_defensoriapenal2.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="jquery/jquery-1.6.4.js"></script>
<style type="text/css">
<!--
  .Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right !important;;
}
-->
</style>

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
function cierre2(num,id,fecha,archivo){
//    alert("-- "+fecha);
   opener.document.form1.nroresolucion.value=num;
   opener.document.form1.idargedo.value=id;
   opener.document.form1.fecha4.value=fecha;
   opener.document.getElementById("linkarchivo").href+="../../archivos/docargedo/"+archivo;
   opener.document.getElementById('verlink').innerHTML=archivo;
   window.close();
//alert('cerrando');
}
function enviarnumero(num){
//    alert("-- "+num);
   opener.document.form1.servicio.value=opener.document.form1.servicio.value+", N° "+num;
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

<div  style="width:550px; height:530px; background-color:#EEEEEE; position:absolute; top:53px; left:0px;border-right-style: ridge;border-top-style: ridge;border-left-style: ridge;border-bottom-style: ridge" id="div1">


<table border=0 width="100%">
  <tr>
   <td  class="Estilo2titulo" colspan="10">Sigfe, Cheques girados y no cobrados por el banco </td>
 </tr>
</table>

<table border=0 width="100%">
    <thead>
        <tr class="">
        <th></th>
        <th>Fecha</th>
        <th>N°</th>
        <th>Descripcion</th>
        <th>Cargo</th>
        <th>Abono</th>
    </tr>
	</thead>
    <tbody>




<?

//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' order by sigfe_fecha";
     $sql=" select sigfe_fecha, sigfe_bene, sigfe_numdoc, sum(sigfe_abono) AS sigfe_abono, count(sigfe_id) as total from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and sigfe_cargo='0' GROUP BY sigfe_bene, sigfe_numdoc having total>1 order by sigfe_fecha";
//     echo $sql."<br><br>";
     $res2 = mysql_query($sql);
     $cont=1;
     $wherenumdoc=" sigfe_numdoc in ( ";
     $wherebene=" sigfe_bene in ( ";

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
//       echo $row2["sigfe_numdoc"]." ".$row2["sigfe_bene"]."<br>";
       $wherenumdoc.= $row2["sigfe_numdoc"].",";
       $wherebene.= "'".$row2["sigfe_bene"]."',";

       $wheretodos.= "( sigfe_numdoc='".$row2["sigfe_numdoc"]."' and sigfe_bene ='".$row2["sigfe_bene"]."') or ";


       $sumasigfeabono=$sumasigfeabono+$row2["sigfe_abono"];

?>

 <tr  class="">
   <td> <? echo $row2["total"] ?>
   <input id="d<? echo $cont ?>" type="hidden" name="va<? echo $cont ?>" value="<? echo $row2["sigfe_cargo"]; ?>">
   <input id="dd<? echo $cont ?>" type="hidden" name="va2<? echo $cont ?>" value="<? echo $row2["sigfe_abono"]; ?>">
   <input  type="hidden" name="var44[<? echo $cont ?>]" value="<? echo $row2["sigfe_id"]; ?>">
   <input  type="hidden" name="var45[<? echo $cont ?>]" value="<? echo $row2["sigfe_numdoc"]; ?>">
   <input  type="hidden" name="var46[<? echo $cont ?>]" value="<? echo $row2["sigfe_bene"]; ?>">
    <? echo $cont  ?></td>
   <td><? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td><? echo $row2["sigfe_numdoc"] ?></td>
   <td><? echo $row2["sigfe_bene"] ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_cargo"],0,',','.') ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_abono"],0,',','.') ?></td>

  </tr>

<?

     $cont++;

    }
     $wherenumdoc.=" 0 ) ";
     $wherebene.=" 'A' ) ";

?>
 <tr  class="">
   <td colspan=10> &nbsp;  </td>

  </tr>

<?

       $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ($wheretodos 1=2 and sigfe_Abono<>0 ) and sigfe_region='$regionsession' order by sigfe_fecha";
//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and (($wherenumdoc) and ($wherebene) and sigfe_cargo=0 ) order by sigfe_fecha";
//       $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ($wherenumdoc and $wherebene and sigfe_Abono<>0 ) order by sigfe_fecha";
//     $sql=" select *, sum(sigfe_abono) AS sigfe_abono, count(sigfe_id) as total from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' GROUP BY sigfe_bene, sigfe_numdoc having total>1 order by sigfe_fecha";
//     echo $sql."<br><br>";
     $res2 = mysql_query($sql);
//     $cont=1;
    $whereid=" sigfe_id in ( ";
     while ($row2 = mysql_fetch_array($res2)) {
         $whereid.=$row2["sigfe_id"].",";
     }

    $whereid.=" 0 ) ";



$wherefiltro='';
$sw=0;
if ($numsigfe<>'') {
   $wherefiltro.="  sigfe_numdoc='$numsigfe' and  ";
   $sw=1;
}
if ($descripsigfe<>'') {
   $wherefiltro.="  sigfe_bene like '%$descripsigfe%' and ";
   $sw=1;
}
if ($cargosigfe<>'') {
   $wherefiltro.="  sigfe_cargo='$cargosigfe' and ";
   $sw=1;
}
if ($abonosigfe<>'') {
   $wherefiltro.="  sigfe_abono='$abonosigfe' and ";
   $sw=1;
}
if ($sw==0) {
   $wherefiltro.=" 1=1 " ;
}
if ($sw==1) {
   $wherefiltro.=" 1=1 ";
}

//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero'  order by sigfe_fecha";
     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and (not $whereid) order by sigfe_fecha";
//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ( $wherefiltro ) order by sigfe_fecha";
//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ($wherenumdoc and $wherebene and sigfe_Abono<>0 ) order by sigfe_fecha";
//     $sql=" select *, sum(sigfe_abono) AS sigfe_abono, count(sigfe_id) as total from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' GROUP BY sigfe_bene, sigfe_numdoc having total>1 order by sigfe_fecha";
//     echo $sql."<br><br>";
     $res2 = mysql_query($sql);
//     $cont=1;
     $cont22=1;
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
   <td>
   <input id="d<? echo $cont ?>" type="hidden" name="va<? echo $cont ?>" value="<? echo $row2["sigfe_cargo"]; ?>">
   <input id="dd<? echo $cont ?>" type="hidden" name="va2<? echo $cont ?>" value="<? echo $row2["sigfe_abono"]; ?>">
     <input  type="hidden" name="var44[<? echo $cont ?>]" value="<? echo $row2["sigfe_id"]; ?>">
    <? echo $cont22  ?></td>
   <td><? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td><? echo $row2["sigfe_numdoc"] ?></td>
   <td><? echo $row2["sigfe_bene"] ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_cargo"],0,',','.') ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_abono"],0,',','.') ?></td>

  </tr>

<?
     $cont++;
     $cont22++;
     $sumasigfecargo=$sumasigfecargo+$row2["sigfe_cargo"];
     $sumasigfeabono=$sumasigfeabono+$row2["sigfe_abono"];


    }
     $cont2=$cont;
?>
   <tr  class="">
    <td class="Estilo1d" colspan=4>Totales</td>
    <td class="Estilo1d"><? echo number_format($sumasigfecargo,0,',','.') ?></td>
    <td class="Estilo1d"><? echo number_format($sumasigfeabono,0,',','.') ?></td>
   </tr>

    </tbody>
</table>

        <input id="cuenta1"  type="hidden" name="cont1" value="<? echo $cont1 ?>">
        <input id="cuenta2"  type="hidden" name="cont2" value="<? echo $cont2 ?>">
        <input id="numero"  type="hidden" name="numero" value="<? echo $numero ?>">
    </form>

 </div>

 <input type='button' onclick='cerrarventana()' value='Cerrar Ventana'>

</body>
</html>


