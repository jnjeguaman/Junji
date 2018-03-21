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
font-size:10px;
text-align:left;
}
.Estilo1b{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}
.Estilo1g{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:14px;
}
.Estilo1d{
text-align:right;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:14px;
}
.Estilo1i{
text-align:left;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:14px;
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
   <td rowspan="4" align="left">
<!--
   <img src="logo_pbre2-2.jpg" width="240" heigth="180" border="0">
-->
   </td>
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
                             <td class="Estilo1g" colspan=3><b>CONCILIACION BANCARIA CTA.CTE <? echo $numero ?> </b></td>
                         </tr>
                         <tr>
                             <td class="Estilo1g" colspan=3><b>PROCESO MES: <? echo $mesppalabra ?> AÑO <? echo $annop ?><b></td>
                         </tr>



                           <tr><td><br><br></td></tr>
                           </table>
 					       <table width="500" border="0" >

<?


    $idreg=$regionsession;
    include("consolidacion_procesocierre.php");

?>
    <tbody>
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
     </tr>
     <tr  class="">
       <td class="Estilo1">(+) Cheques girados y no cobrados por el banco</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalabono2,0,',','.'); ?> </td>
     </tr>
     <tr  class="">
       <td class="Estilo1">(-) Cargos no reconocidos por la contabilidad</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalacartocargo,0,',','.'); ?></td>
     </tr>
     <tr  class="">
       <td class="Estilo1">(+) Abonos no reconocidos por la contabilidad</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($totalacartoabono,0,',','.'); ?></td>
     </tr>
     <tr  class="">
       <td class="Estilo1">Saldo cartola</td>
       <td class="Estilo1">$</td>
       <td class="Estilo1d"><? echo number_format($saldocartola,0,',','.'); ?></td>
     </tr>



                       <tr>
                       <td colspan="10"><hr></td>
                      </tr>






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
                       <td colspan="10"><hr></td>
                      </tr>

</table>






</body>
