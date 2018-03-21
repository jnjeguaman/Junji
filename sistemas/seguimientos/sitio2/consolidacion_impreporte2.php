<?
session_start();
//$usuario=$_SESSION["nom_user"];
require("inc/config.php");
$regionsession = $_SESSION["region"];

$numero=$_GET["numero"];
$mesp=$_GET["mesp"];
$annop=$_GET["annop"];




?>
<style type="text/css">
body{
margin: 15px 40px;
}
table{
text-align:center;
}
th{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:8px;
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
	text-align: ;
}


.Estilo1{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:7px;
}
.Estilo1b{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}
.Estilo1d{
text-align:right;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}
.Estilo1i{
text-align:left;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}
.Estilo1c{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}
.Estilo1c3{
text-align:left;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}

.Estilo1b2{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}
.Estilo1b3{
text-align:left;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}


h1{
color:#0033CC;
text-align:center;
font-style:italic;
font-weight:bold;
border-bottom:#003366 solid 3px;
}


</style>
<body>
<table border="0"   width="500">
 <tr>
   <td rowspan="4" align="left"><img src="logo_pbre2-2.jpg" width="240" heigth="180" border="0"></td>
   <td rowspan="4" valign="MIDDLE" align="center" width="350"></td>
   <td rowspan="4" valign="MIDDLE" align="center" width="350" class="Estilo1b"><? echo $date_in=date("d-m-Y"); ?></td>

 </tr>
</table>


<?
if ($mesp==1) {
    $mesppalabra="ENERO";
}
if ($mesp==2) {
    $mesppalabra="FEBRERO";
}
if ($mesp==3) {
    $mesppalabra="MARZO";
}
if ($mesp==4) {
    $mesppalabra="ABRIL";
}
if ($mesp==5) {
    $mesppalabra="MAYO";
}
if ($mesp==6) {
    $mesppalabra="JUNIO";
}
if ($mesp==7) {
    $mesppalabra="JULIO";
}
if ($mesp==8) {
    $mesppalabra="AGOSTO";
}
if ($mesp==9) {
    $mesppalabra="SEPTIEMBRE";
}
if ($mesp==10) {
    $mesppalabra="OCTUBRE";
}
if ($mesp==11) {
    $mesppalabra="NOVIEMBRE";
}
if ($mesp==12) {
    $mesppalabra="DICIEMBRE";
}
?>



	<table width="400" border="0">
          <tr>
              <td class="Estilo1b" colspan=3>CONCILIACION BANCARIA CTA.CTE <? echo $numero ?> </td>
          </tr>
          <tr>
              <td class="Estilo1b" colspan=3>PROCECESO MES: <? echo $mesppalabra ?> AÑO <? echo $annop ?></td>
          </tr>
          <tr>
              <td><br><br></td>
          </tr>
    </table>
                               Cheques girados y no cobrados por el banco
    <table width="500" border="0" >
    
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
     $sql=" select *, sum(sigfe_abono) AS sigfe_abono, count(sigfe_id) as total from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and sigfe_cargo='0' GROUP BY sigfe_bene, sigfe_numdoc having total>1 order by sigfe_fecha";
//     echo $sql;
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

       $wherenumdoc.= $row2["sigfe_numdoc"].",";
       $wherebene.= "'".$row2["sigfe_bene"]."',";

       $sumasigfeabono=$sumasigfeabono+$row2["sigfe_abono"];

?>

 <tr  class="">
   <td class="Estilo1i"> <? echo $row2["total"] ?>
   <input id="d<? echo $cont ?>" type="hidden" name="va<? echo $cont ?>" value="<? echo $row2["sigfe_cargo"]; ?>">
   <input id="dd<? echo $cont ?>" type="hidden" name="va2<? echo $cont ?>" value="<? echo $row2["sigfe_abono"]; ?>">
    <? echo $cont  ?></td>
   <td class="Estilo1i"><? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td class="Estilo1i"><? echo $row2["sigfe_numdoc"] ?></td>
   <td class="Estilo1i"><? echo $row2["sigfe_bene"] ?></td>
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


     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ($wherenumdoc and $wherebene and sigfe_cargo=0 ) order by sigfe_fecha";
//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ($wherenumdoc and $wherebene and sigfe_Abono<>0 ) order by sigfe_fecha";
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


//     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and ( $wherefiltro ) order by sigfe_fecha";
     $sql=" select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and (not $whereid) order by sigfe_fecha";
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
   <td class="Estilo1i">
    <? echo $cont22  ?></td>
   <td class="Estilo1i"><? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td class="Estilo1i"><? echo $row2["sigfe_numdoc"] ?></td>
   <td class="Estilo1i"><? echo $row2["sigfe_bene"] ?></td>
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


<!-- SE LISTA CARTOLA -->
   Cartola
    <table width="500" border="0" >

    <thead>
     <tr class="">
        <th></th>
        <th>Fecha</th>
        <th>N°</th>
        <th>Descripcion</th>
        <th>Cargo</th>
        <th>Abono</th>
    </tr>
    </tr>
	</thead>
    <tbody>
<?
     $sql=" select * from concilia_cartola where carto_mesp='$mesp' and carto_annop='$annop' and carto_numero='$numero' order by carto_fecha  ";
//     echo $sql2;
     $res2 = mysql_query($sql);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
?>

 <tr  class="">
   <td class="Estilo1i"><? echo $cont; ?>   </td>
   <td class="Estilo1i"><? echo substr($row2["carto_fecha"],8,2)."-".substr($row2["carto_fecha"],5,2)."-".substr($row2["carto_fecha"],0,4) ?></td>
   <td class="Estilo1i"><? echo $row2["carto_operacion"] ?></td>
   <td class="Estilo1i"><? echo $row2["carto_descripcion"] ?></td>
   <td class="Estilo1d"><? echo number_format($row2["carto_cargo"],0,',','.') ?></td>
   <td class="Estilo1d"><? echo number_format($row2["carto_abono"],0,',','.') ?></td>
  </tr>

 <?
 
     $sumacartolacargo=$sumacartolacargo+$row2["carto_cargo"];
     $sumacartolaabono=$sumacartolaabono+$row2["carto_abono"];
     $cont++;

     }
 ?>
 
  <tr  class="">
    <td class="Estilo1d" colspan=4>Totales</td>
    <td class="Estilo1d"><? echo number_format($sumacartolacargo,0,',','.') ?></td>
    <td class="Estilo1d"><? echo number_format($sumacartolaabono,0,',','.') ?></td>
 </tr>

    </tbody>
</table>



<!-- SE LISTA CARTOLA -->
   Sigfe
    <table width="540" border="0" >

    <thead>
     <tr class="">
        <th></th>
        <th>Fecha</th>
        <th>N°</th>
        <th>Rut</th>
        <th>Descripcion</th>
        <th>Cargo</th>
        <th>Abono</th>
    </tr>
    </tr>
	</thead>
    <tbody>
<?
     $sql=" select * from concilia_sigfe where sigfe_mesp='$mesp' and sigfe_annop='$annop' and sigfe_numero='$numero' order by sigfe_fecha";
//     echo $sql2;
     $res2 = mysql_query($sql);
     $cont=1;
     $sumasigfecargo=0;
     $sumasigfeabono=0;
     while ($row2 = mysql_fetch_array($res2)) {
?>

 <tr  class="">
   <td class="Estilo1i"><? echo $cont; ?>   </td>
   <td class="Estilo1i"> <? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td class="Estilo1i"><? echo $row2["sigfe_numdoc"] ?></td>
   <td class="Estilo1i"><? echo $row2["sigfe_rut"] ?></td>
   <td class="Estilo1i"><? echo $row2["sigfe_bene"] ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_cargo"],0,',','.') ?></td>
   <td class="Estilo1d"><? echo number_format($row2["sigfe_abono"],0,',','.') ?></td>
  </tr>

 <?

     $sumasigfecargo=$sumasigfecargo+$row2["sigfe_cargo"];
     $sumasigfeabono=$sumasigfeabono+$row2["sigfe_abono"];
     $cont++;

     }
 ?>

  <tr  class="">
    <td class="Estilo1d" colspan=5>Totales</td>
    <td class="Estilo1d"><? echo number_format($sumasigfecargo,0,',','.') ?></td>
    <td class="Estilo1d"><? echo number_format($sumasigfeabono,0,',','.') ?></td>
 </tr>

    </tbody>
</table>


					<table width="500" border="0">
                             <tr>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                              </tr>

                             <tr>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                              </tr>
                             <tr>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                              </tr>
                             <tr>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                              </tr>
                             <tr>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                              </tr>
                             <tr>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                              </tr>

<?
  if ($regionsession==15) {
?>

                             <tr>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b"></th>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b"></th>
                               <th class="Estilo1b">__________________</th>
                              </tr>
                             <tr>
                               <th class="Estilo1b">Encargado Contable</th>
                               <th class="Estilo1b"></th>
                               <th class="Estilo1b">Encargado Area</th>
                               <th class="Estilo1b"></th>
                               <th class="Estilo1b">Jefe(a) DAF </th>
                              </tr>

<?
} else {
?>
                             <tr>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b"></th>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b"></th>
                               <th class="Estilo1b">__________________</th>
                              </tr>
                             <tr>
                               <th class="Estilo1b">Encargado Contable</th>
                               <th class="Estilo1b"></th>
                               <th class="Estilo1b">Encargado Area</th>
                               <th class="Estilo1b"></th>
                               <th class="Estilo1b">Director Adm. Regional </th>
                              </tr>


<?
}
?>
                       <tr>
                       <td colspan="10"></td>


                      </tr>
                      
</table>







</body>
