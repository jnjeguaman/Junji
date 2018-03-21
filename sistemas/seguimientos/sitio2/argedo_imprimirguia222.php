<?
session_start();
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];


require("inc/config.php");

    $sql2 = "Select * from regiones where codigo=$regionsession";
//    echo $sql2;
    $res2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($res2);
    $nombreregion=$row2["nombre"];


$guia=$_GET["guia"];

//$sql2="select * from argedo_despachada where despa_defensoria='$regionsession' and despa_folioguia=$guia order by despa_folio desc";
$sql2="select * from argedo_despachada where despa_defensoria='$regionsession' and despa_folioguia=$guia group by despa_folioguia order by despa_folio desc";
//echo $sql2;
$result2=mysql_query($sql2);
$row2=mysql_fetch_array($result2);
$destinatario=$row2["despa_destinatario2"];
$fechaguia=$row2["despa_fechaguia"];
$fechaguia=substr($fechaguia,8,2)."-".substr($fechaguia,5,2)."-".substr($fechaguia,0,4);
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
.Estilo1{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:8px;
}
.Estilo1b{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:10px;
}
.Estilo1c{
text-align:center;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:6px;
}
.Estilo1c3{
text-align:left;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:7px;
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
   <td rowspan="4" valign="MIDDLE" align="center" width="350"><h5>GUÍA DE DESPACHO ARGEDO 2.0 <BR> CORRESPONDENCIA DESPACHADA</h5></td>
 </tr>
</table>




					<table width="250" border="0">
                         <tr>
                             <td class="Estilo1b3">Origen / Defensoría</td>
                             <td class="Estilo1b3" valign="center" >Oficina de Partes -
                                 <? echo $nombreregion; ?>
                             </td>
                           </tr>
                           <tr>
                             <td class="Estilo1b3">Destinatario</td>
                             <td class="Estilo1b3" colspan=3>
                              <? echo $destinatario; ?>
                              </td>
                           </tr>
                           <tr>
                             <td class="Estilo1b3">Fecha</td>
                             <td class="Estilo1b3" colspan=3>
                              <? echo $fechaguia; ?>
                              </td>
                           </tr>




                           </table>



 					       <table width="500" border="0" >


<?

//$sql3="select * from ff_opmovi x, ff_movimiento y where opmovi_op_id=$opid and opmovi_movi_id=movi_id";
$sql3="select * from argedo_despachada where despa_defensoria='$regionsession' and despa_folioguia=$guia order by despa_folio desc";
//echo $sql3;
$result3=mysql_query($sql3);
while ($row3=mysql_fetch_array($result3)) {
    $fechadespacho=substr($row3["despa_fecha_doc"],8,2)."-".substr($row3["despa_fecha_doc"],5,2)."-".substr($row3["despa_fecha_doc"],0,4)
?>
                             <tr>
                               <th class="Estilo1b2" colspan="8" align="center"><br><br></th>
                              </tr>

                              <tr>
                                <td colspan="10"><hr></td>
                             </tr>

                             <tr>
                               <th class="Estilo1b2" colspan="1">DESTINATARIO :</th>
                               <th class="Estilo1b3" colspan="4"> <? echo $row3["despa_destinatario"] ?>
                               </th>
                              </tr>

                             <tr>
                               <th class="Estilo1b" width="150">CODIGO</th>
                               <th class="Estilo1b" width="50">FOLIO</th>
                               <th class="Estilo1b" width="100">FECHA DOCTO</th>
                               <th class="Estilo1b" width="100">TIPO DOCTO.</th>
                               <th class="Estilo1b" width="100">REMITE</th>
                             </tr>
                             <tr>
                               <td class="Estilo1b"></td>
                               <td class="Estilo1b"><? echo $row3["despa_folio"] ?></td>
                               <td class="Estilo1b"><? echo $fechadespacho; ?></td>
                               <td class="Estilo1b"><? echo $row3["despa_tipodoc"] ?></td>
                               <td class="Estilo1b"><? echo $row3["despa_remitente"] ?></td>
                             </tr>
                             <tr>
                               <td class="Estilo1b" colspan="5"><br><br></td>
                             </tr>


<?
}

?>
                             <tr>
                               <td class="Estilo1b" colspan="5"><br></td>
                             </tr>






 
 
</table>




</body>
