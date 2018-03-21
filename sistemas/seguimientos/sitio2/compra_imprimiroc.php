<?
session_start();

//$usuario=$_SESSION["nom_user"];
require("inc/config.php");
require "conversor.php";
$regionsession = $_SESSION["region"];

$id=$_GET["id"];
$tipo=$_GET["tipo"];

$sql="select * from compra_orden where oc_id=$id ";
//echo $sql;
$res3 = mysql_query($sql);
$row3 = mysql_fetch_array($res3);
$ocfechacompra=$row3["oc_fechacompra"];
$ocmoneda=$row3["oc_moneda"];
$swiva=$row3["oc_swiva"];
$octotal=$row3["oc_total"];
$ocretencion=$row3["oc_retencion"];

$ocfechacompra=substr($ocfechacompra,8,2)."-".substr($ocfechacompra,5,2)."-".substr($ocfechacompra,0,4);

if ($tipo=='Reembolso') {
    $tipo2="REEMBOLSO";
    $tipo2b="Reembolso";
    $tipo2c="N° Resolucion: ".$row3["oc_nroresolucion"];
} else {
    $tipo2="PAGO";
    $tipo2b="Pago";
    $tipo2c="Itemppto.: ".$row3["oc_itemppto"];
}


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
font-size:7px;
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
font-size:10px;
}
.Estilo1c3{
text-align:right;
font-style:italic;
font-family:"Times New Roman", Times;
font-size:12px;
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
font-size:12px;
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
   <td rowspan="4" valign="MIDDLE" align="center" width="350">ORDEN DE <? echo $tipo2; ?> N°: <? echo $row3["oc_numero"]; ?></td>
 </tr>
</table>

<?
$sql5="select * from regiones where codigo=$regionsession ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$direccionreg=$row5["direccion"];
$telefonoreg=$row5["telefono"];
$nombrereg=$row5["nombre"];

?>


					<table width="500" border="0">
                         <tr>
                             <td class="Estilo1b3" width="250">Rut: 61.941.900-6</td>
                             <td class="Estilo1b3">Demandante: DEFENSORIA PENAL PUBLICA</td>
                         </tr>
                         <tr>
                             <td class="Estilo1b3">Dirección: <? echo $direccionreg ?></td>
                             <td class="Estilo1b3">Unidad de Compra: <? echo $nombrereg ?></td>
                         </tr>
                         <tr>
                             <td class="Estilo1b3">Teléfono/Fax: <? echo $telefonoreg ?></td>
                             <td class="Estilo1b3">Fecha O.C.: <? echo $ocfechacompra; ?> </td>
                         </tr>
                    </table>
                    <br>
                    Datos Proveedor:
					<table width="500" border="1">
                    <tr><td class="Estilo1b3">
                             Señor (es): <? echo $row3["oc_rsocial"]; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rut : <? echo $row3["oc_rut"]; ?>-<? echo $row3["oc_dig"]; ?> <br>
                             Dirección: <? echo $row3["oc_direccion"]; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fono/Fax: <? echo $row3["oc_fono"]; ?>  <br>


                    </td></tr></table>
                    <br>
                    Descripción:
					<table width="500" border="1">
                    <tr><td class="Estilo1b3" >
					     Nombre Orden de <? echo $tipo2b ?>: <? echo $row3["oc_nombre"]; ?>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <? echo $tipo2c; ?>   <br>
                         Forma de Pago: <? echo $row3["oc_fpago"]; ?>     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           Emitida por: <? echo $row3["oc_emitidapor"]; ?>    <br>
                         Centro de Costo: <? echo $row3["oc_ccosto"]; ?>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         Tipo de Pago: <? echo $row3["oc_modalidad"]; ?>    <br>
                         Certificado: <? echo $row3["oc_certificado"]; ?>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            <br>
                    </td></tr></table>
                    <br>
                    <br>
                    Detalle Orden de Compra:
					<table width="500" border="1" height="300">
                          <tr height="20">
                             <th class="Estilo1b3" width="30" >Item</th>
                             <th class="Estilo1b3" width="30">Cantidad</th>
                             <th class="Estilo1b3" width="300">Detalle Producto o Servicio</th>
                             <th class="Estilo1b3" width="50">Valor Unitario</th>
                             <th class="Estilo1b3" width="50">Valor Total</th>
                           </tr>


<?
   $where.= " ocdet_oc_id=$id or ";
   $sql4="select * from compra_ordendet where ocdet_oc_id=$id ";
//   echo $sql4;
   $res4 = mysql_query($sql4);
   while ($row4 = mysql_fetch_array($res4)) {
?>
                           <tr>
                             <td class="Estilo1b3"> <? echo $row4["ocdet_item"]; ?></td>
                             <td class="Estilo1b3"> <? echo $row4["ocdet_ctda"]; ?></td>
                             <td class="Estilo1b3"> <? echo $row4["ocdet_detalle"]; ?></td>
                             <td class="Estilo1c3"> <? echo number_format($row4["ocdet_unitario"],0,',','.'); ?></td>
                             <td class="Estilo1c3"> <? echo number_format($row4["ocdet_total"],0,',','.'); ?></td>
                           </tr>
                           
<?
   $suma=$suma+$row4["ocdet_total"];
   }
   if ($swiva==1) {
     $iva=$suma*0.19;
     $iva=number_format($iva,0,'','');
     $bruto=$suma+$iva;
   } else {
     $iva=0;
     $bruto=$suma;
   }

   $resultado=convertir($bruto);
   
   if ($ocretencion==0) {

?>

                          <tr height="20">
                             <td class="Estilo1b3" colspan="3" rowspan=3></td>
                             <td class="Estilo1b3">Neto</td>
                             <td class="Estilo1c3"><? echo number_format($suma,0,',','.'); ?></td>
                           </tr>
                          <tr height="20">
                             <td class="Estilo1b3">IVA</td>
                             <td class="Estilo1c3"><? echo number_format($iva,0,',','.'); ?></td>
                           </tr>
                          <tr height="20">
                             <td class="Estilo1b3">Total</td>
                             <td class="Estilo1c3"><? echo number_format($bruto,0,',','.') ?></td>
                           </tr>
                        </table>
       					<table width="500" border="0">
                             <tr>
                               <td class="Estilo1b3">Son: <? echo $resultado ?> <? echo $ocmoneda; ?></td>
                           </tr>
                        </table>

<?
} else {
    $bruto=$octotal;
    $resultado=convertir($bruto);

?>

                          <tr height="20">
                             <td class="Estilo1b3" colspan="3" rowspan=3></td>
                             <td class="Estilo1b3">Retencion</td>
                             <td class="Estilo1c3"><? echo number_format($ocretencion,0,',','.'); ?></td>
                           </tr>
                          <tr height="20">
                             <td class="Estilo1b3">Total</td>
                             <td class="Estilo1c3"><? echo number_format($bruto,0,',','.') ?></td>
                           </tr>
                        </table>
       					<table width="500" border="0">
                             <tr>
                               <td class="Estilo1b3">Son: <? echo $resultado ?> <? echo $ocmoneda; ?></td>
                           </tr>
                        </table>


<?
}
?>




					<table width="500" border="0">
                             <tr>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                               <th class="Estilo1b"><br></th>
                              </tr>
                             <tr>
                               <td class="Estilo1b3" colspan=4>Obs.:<? echo $row3["oc_obs"]; ?></td>
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
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b">__________________</th>
                              </tr>

                             <tr>
                               <th class="Estilo1b">VºBº Administracion</th>
                               <th class="Estilo1b">VºBº Jefe <br>Administracion</th>
                               <th class="Estilo1b">VºBº Compromiso</th>
                               <th class="Estilo1b">Nº Id <br> Compromiso </th>
                               <th class="Estilo1b">Jefe(a) Admin y Finanzas </th>
                              </tr>
                              
<?
} else {
?>
                             <tr>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b">__________________</th>
                               <th class="Estilo1b">__________________</th>
                              </tr>

                             <tr>
                               <th class="Estilo1b">VºBº Administracion</th>
                               <th class="Estilo1b">Nº Id / VºBº <br> Compromiso </th>
                               <th class="Estilo1b">VºBº Encargado Area</th>
                               <th class="Estilo1b">Director Admin. Regional </th>
                              </tr>


<?
}
?>
                       <tr>
                       <td colspan="10"><hr></td>
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
if ($row3["oc_modalidad"]=='Reembolso') {
?>
                             <tr>
                               <th class="Estilo1b" colspan=10>

<table boerder="0">
<tr><td>

<table border="1">
                             <tr>
                               <th class="Estilo1b">Des. Presupuestario</th>
                               <th class="Estilo1b">Codigo</th>
                               <th class="Estilo1b">Monto</th>
                              </tr>

<?
$where.=" 1=2 ";
$sql3="select ocdet_tipo as nombre, ocdet_tipocodigo as codigo ,sum(ocdet_total) as monto from compra_ordendet where $where group by ocdet_tipocodigo ";
//echo $sql3;
$result3=mysql_query($sql3);
while ($row3=mysql_fetch_array($result3)) {
?>
          <tr>
            <td class="Estilo1c3"><? echo $row3["nombre"] ?></td>
            <td class="Estilo1c"><? echo $row3["codigo"] ?></td>
            <td class="Estilo1c"><? echo number_format($row3["monto"],0,',','.'); ?></td>
          </tr>

<?
}
?>
          <tr>
            <td class="Estilo1c3" colspan=3>_______________________________</td>
          </tr>

          <tr>
            <td class="Estilo1c3" colspan=2>Monto Rendicion</td>
            <td class="Estilo1c"><? echo number_format($octotal,0,',','.'); ?></td>
          </tr>


</table>

</td>
<td width="80"></td>
<td>



<table border="1">
                             <tr>
                               <th class="Estilo1b">Des. Contabilidad</th>
                               <th class="Estilo1b">Codigo</th>
                               <th class="Estilo1b">Monto</th>
                              </tr>

<?
//$where.=" 1=2 ";
//$sql3="select detgasto_tipo as nombre, SUBSTRING(detgasto_tipocodigo2,1,6) as codigo ,sum(detgasto_monto) as monto from ff_detgasto where $where group by SUBSTRING(detgasto_tipocodigo2,1,6)  ";
$sql3="select ocdet_tipo as nombre, ocdet_tipocodigo2 as codigo ,sum(ocdet_total) as monto from compra_ordendet where $where group by ocdet_tipocodigo2  ";
//echo $sql3;
$result3=mysql_query($sql3);
while ($row3=mysql_fetch_array($result3)) {
?>
          <tr>
            <td class="Estilo1c3"><? echo $row3["nombre"] ?></td>
            <td class="Estilo1c"><? echo $row3["codigo"] ?></td>
            <td class="Estilo1c"><? echo number_format($row3["monto"],0,',','.'); ?></td>
          </tr>

<?
}
?>
          <tr>
            <td class="Estilo1c3" colspan=3>________________________________</td>
          </tr>

          <tr>
            <td class="Estilo1c3" colspan=1>Monto Rendicion</td>
            <td class="Estilo1c"><? echo number_format($octotal,0,',','.'); ?></td>
          </tr>


</table>





                               </th>

                              </tr>
<?
}
?>

</table>





</body>
