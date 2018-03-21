<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$date_in=date("Y-m-d");
$read1= rand(0,1000000);
$read2= rand(0,1000000);
$read3= rand(0,1000000);
$read4= rand(0,1000000);

?>
<html>
<head>
<title>Facturas y/o Boletas</title>
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
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo1r {
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
.Estilo5 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif;
font-size: 14px;
font-weight: bold; }
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
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">FICHA: FACTURA Y/O RECIBOS</span></td>
                  </tr>
                       <tr>

<?

$id=$_GET["id"];
$id2=$_GET["id2"];
$idcont=$_GET["idcont"];
$ori=$_GET["ori"];
$nrocomprobante=$_GET["nrocomprobante"];


if ($ori==''){
    $origen="consultasgenerales.php";
}
if ($ori=='2'){
    $origen="vercontrato8.php";
}
if ($ori=='3'){
    $origen="verdoctrans.php";
}
if ($ori=='4'){
    $origen="vercontrato8b.php";
}

?>
<tr>
<td>

                   <a href="<? echo $origen ?>?id2=<? echo $idcont ?>&nrocomprobante=<? echo $nrocomprobante ?>&cotrananno=<?php echo $_GET["cotrananno"] ?>" class="link">VOLVER</a>
</td>
</tr>
<td><hr></td><td><hr></td>
                      </tr>
                   



 <tr>
                         <td width="487" valign="top" class="Estilo1">

<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";


if ($id<>"") {
  $sql5="select * from dpp_facturas x, dpp_etapas y where x.fac_id=$id and x.fac_eta_id=y.eta_id";
}
if ($id2<>"") {
      $sql5="select * from dpp_facturas x, dpp_etapas y where fac_eta_id=$id2 and x.fac_eta_id=y.eta_id";
}

//echo $sql5;
$res5 = mysql_query($sql5);
$row5=mysql_fetch_array($res5);
//$archivo5=$row5["fac_"];



?>
                         </td>
                      </tr>


<tr>
                    <td height="50" colspan="3">
     </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <form name="form1" action="grabafacturaarchivo2.php" method="post" >
					<tr>
                             <td  valign="center" class="Estilo1">FOLIO</td>
                             <td class="Estilo1" colspan=3><? echo $row5["eta_folio"] ?>

                             </td>
                     </tr>
<?
 $vartipodoc1=$row5["eta_tipo_doc"];
 if ($vartipodoc1=='Factura') {
     $vartipodoc2=$row5["eta_tipo_doc2"];
   if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
     $vartipodoc="Factura";
   if ($vartipodoc2=="b")
     $vartipodoc="Boleta Servicio";
   if ($vartipodoc2=="r")
     $vartipodoc="Recibo";
   if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
     $vartipodoc="N.Credito";
   if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
     $vartipodoc="N.Débito";

 }
 if ($vartipodoc1=='Honorario') {
     $vartipodoc="Honorario";
 }


?>
					<tr>
                             <td  valign="center" class="Estilo1">TIPO DOCUMENTO</td>
                             <td class="Estilo1" colspan=3><? echo $vartipodoc ?>

                             </td>
                     </tr>


					<tr>
                             <td  valign="center" class="Estilo1">Fecha Recepción</td>
                             <td class="Estilo1" valign="center">
                                <?
                                     $a=$row5["fac_fecha_recepcion"];
                                     //echo $a."-";
                                     echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);

                                    ?>



                             </td>
                           </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Factura</td>
                             <td class="Estilo1">

                                <?
                                     $a=$row5["fac_fecha_fac"];
                                     //echo $a."-";
                                     echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);

                                    ?>


                             </td>
                           </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
                                 <?
                                    $region=$row5["fac_region"];
                                    $sql2 = "Select * from regiones where codigo='$region'";
                                    //echo $sql;
                                    $res2 = mysql_query($sql2);
                                    $row2 = mysql_fetch_array($res2);
                                    $region2=$row2["nombre"];
                                    echo $region2;

                                 ?>



                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3><? echo $row5["fac_rut"]."-".$row5["fac_dig"]; ?>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Nombre  </td>
                             <td class="Estilo1" colspan=3><? echo $row5["fac_cli_nombre"] ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nº Factura  </td>
                             <td class="Estilo1" colspan=3><? echo $row5["fac_numero"] ?>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nº Orden Compra </td>
                             <td class="Estilo1" colspan=3><? echo $row5["fac_nroorden"] ?>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"></td>
                             <td class="Estilo1" colspan=3>
                               <table border=1>
<?
//if ($regionsession==15) {
   $idetapa=$row5["eta_id"];
   $sql7="select * from compra_orden where oc_eta_id=$idetapa ";
//echo $sql;
   $res7 = mysql_query($sql7);
   $cont11=1;
   while($row7 = mysql_fetch_array($res7)){
       if ($cont11==1 or $cont11==4 or $cont11==7 or $cont11==10 or $cont11==13 or $cont11==16 or $cont11==19 or $cont11==21 or $cont11==24 ) {
           echo "<tr>";
       }
?>

                                 <td>
                                   <a href="../../archivos/docfac/<? echo $row7["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row7["oc_numero"]; ?></a>
                                </td>


<?
       $cont11++;
   }

//}

?>
                         </table>
                         </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Total a Pagar </td>
                             <td class="Estilo1" colspan=3>
                              $<? echo number_format($row5["eta_monto"],'0',',','.') ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Descripción Servicio </td>
                             <td class="Estilo1" colspan=3>
                             <? echo $row5["eta_servicio_final"] ?>
                             </td>
                           </tr>
                           
                          <tr>
                             <td  valign="center" class="Estilo1">Numero Resolución</td>
                             <td class="Estilo1" colspan=3>
                             <? echo $row5["eta_nroresolucion"] ?>
                             </td>
                           </tr>
<?
if ($row5["eta_estado"]==99) {
?>
                          <tr>
                             <td  valign="center" class="Estilo1">Motivo de Rechazao</td>
                             <td class="Estilo1" colspan=3>
                             <? echo $row5["eta_rechaza_motivo"]." ".$row5["eta_rechaza_motivo1"]." ".$row5["eta_rechaza_motivo2"]." ".$row5["eta_rechaza_motivo3"] ?>
                             </td>
                           </tr>

<?
}
?>

                            <tr>
                             <td  valign="center" class="Estilo1">Imagen Factura </td>
                             <td class="Estilo1" colspan=3>
                               <a href="../../archivos/docfac/<? echo $row5["fac_archivo"] ?>?read1=<? echo $read1 ?>" class="link" target="_blank" ><? echo $row5["fac_archivo"] ?></a>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Imagen Otros Antecedentes</td>
                             <td class="Estilo1" colspan=3>
                               <a href="../../archivos/docfac/<? echo $row5["fac_doc3"] ?>?read2=<? echo $read2 ?>" class="link" target="_blank"><? echo $row5["fac_doc3"] ?></a>
                             </td>
                           </tr>
<?
$verfac='';
$nuevo=$row5["fac_doc2"];
//echo $nuevo;
   if ($nuevo<>'') {
   $buscar='archivos/docargedo/fileargedo';
   $pos = strpos($nuevo,$buscar );
   if ($pos !== FALSE) {

   }  else {
       $nuevo="../../archivos/docfac/".$row5["fac_doc2"];
   }

   $verfac="Ver Resolución";
}
?>
                            <tr>
                             <td  valign="center" class="Estilo1">Imagen Orden de Compra </td>
                             <td class="Estilo1" colspan=3>
                              <a href="../../archivos/docfac/<? echo $row5["fac_doc1"] ?>?read3=<? echo $read3 ?>" class="link" target="_blank"><? echo $row5["fac_doc1"] ?></a>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Imagen Resolución </td>
                             <td class="Estilo1" colspan=3>
                              <a href="<? echo $nuevo ?>?read4=<? echo $read4 ?>" class="link" target="_blank"><? echo $verfac; ?></a>
<!--                               <a href="../../archivos/docfac/<? echo $vtodos ?>?read4=<? echo $read4 ?>" class="link" target="_blank" > <? echo $v9; ?></a>  -->

                             </td>
                           </tr>

                            <tr>
                             <tr>
                               <td><hr></td><td><hr></td>
                             </tr>
                            

<?                                 $deptoaprobacion=$row5["eta_depto_aprobacion"];
                                   $sql4="select * from dpp_deptos where depto_id=$deptoaprobacion";

//                                   echo $sql4;
                                   //echo $sql;
                                   $res4 = mysql_query($sql4);
                                   $row=mysql_fetch_array($res4);
                                    $deptonombre=$row["depto_nombre"];
?>

			              <tr>
                             <td  valign="center" class="Estilo1">Depto. Aprobación </td>
                             <td class="Estilo1" colspan=3>
                               <? echo  $deptonombre ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Aprobador</td>
                             <td class="Estilo1" colspan=3>
                                 <? echo $row5["eta_usu_aprobacionok"] ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Fecha VºBº </td>
                             <td class="Estilo1" colspan=3>
                             <? 
				$a=$row5["eta_fecha_aprobacionok"];
                                     //echo $a."-";
                                     echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);

                                    ?>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Item</td>
                             <td class="Estilo1" colspan=3>
                                 <? echo $row5["eta_item"] ?>
                             </td>
                           </tr>
                            
                            <tr>
                               <td><hr></td><td><hr></td>
                             </tr>
                             
                           </tr>
<?
$etafpago=$row5["eta_fpago"];
$etaregion=$row5["eta_region"];
$fechache=substr($row5["eta_fechache"],0,4);
//echo $etafpago;
if ($etafpago=='Transferencia') {
   $etancheque1=$row5["eta_ncheque"];
   $sql2 = "Select * from dpp_comprobantetrans where cotran_nrocomprobante='$etancheque1' and cotran_region='$etaregion' and year(cotran_fecha)='$fechache' ";
//   echo $sql2;
   $res2 = mysql_query($sql2);
   $row2 = mysql_fetch_array($res2);
   $cotranarchivo1=$row2["cotran_archivo1"];
   $etancheque= "<a href='../../archivos/documentostrans/".$cotranarchivo1."' class='link' target='_blank' >".$cotranarchivo1."</a>";
  

} else {
   $etancheque="<a href='../../archivos/docfac/".$row5["eta_archivorecibo"]."' class='link' target='_blank'>".$row5["eta_archivorecibo"]."</a>";

}
?>
                            <tr>
                             <td  valign="center" class="Estilo1">Número Egreso </td>
                             <td class="Estilo1" colspan=3>
                             <? echo $row5["eta_negreso"] ?>
                             </td>
                           </tr>
			
			<tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Nº Cheque/Transferencia </td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row5["eta_ncheque"]; ?>
                             </td>
                           </tr>
<?
                           $forma=$row5["eta_ncheque"];
                           ?>

	                      <tr>
                             <td  valign="center" class="Estilo1">Fecha Cheque/Transferencia</td>
                             <td class="Estilo1" colspan=3>
                              <?
                                 $a=$row5["eta_fechache"];
                                 echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);
                              ?>
                             </td>
                           </tr>
	                      <tr>
                             <td  valign="center" class="Estilo1">Forma de Pago</td>
                             <td class="Estilo1" colspan=3>
                              <?
                                 echo $row5["eta_fpago"];

                              ?>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Fecha Cobro </td>
                             <td class="Estilo1" colspan=3>
                              <?
                                 $a=$row5["eta_fecha_retira"];
                                 echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);
                              ?>
                             </td>
                           </tr>
                            
  		                  <tr>
                             <td  valign="center" class="Estilo1">Forma de Cobro </td>
                             <td class="Estilo1" colspan=3>
                             <? echo $row5["eta_forma"] ?> _ <? echo $row5["eta_retira"] ?>
                             </td>
                           </tr>
                                  
                           
			
			<tr>
                             <td  valign="center" class="Estilo1">Imagen del Pago </td>
                             <td class="Estilo1" colspan=3>
                               <?  echo $etancheque ?>
                             </td>
                           </tr>
                    </table>
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                               <td  valign="center" class="Estilo1" colspan=10><hr>  </td>
                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1c" colspan=10 >DETALLE LIBRO DE COMPRA  </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1" width="200">Neto</td>
                             <td class="Estilo1r" colspan=1 >
                              <? echo number_format($row5["eta_neto"],0,',','.') ?>
                             </td>
                             <td  valign="center" class="Estilo1" width="180"></td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Iva</td>
                             <td class="Estilo1r" colspan=1>
                               <? echo number_format($row5["eta_iva"],0,',','.') ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Total a Pagar</td>
                             <td class="Estilo1r" colspan=1>
                               <? echo number_format($row5["eta_monto2"],0,',','.') ?>

                           </tr>
                           <tr>
                               <td colspan="3"><hr></td>
                             </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Impuesto Especifico Combustible</td>
                             <td class="Estilo1r" colspan=1>
                                <? echo number_format($row5["eta_impuesto1"],0,',','.') ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Exento</td>
                             <td class="Estilo1r" colspan=1>
                               <? echo number_format($row5["eta_exento"],0,',','.') ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Impuesto Adicional</td>
                             <td class="Estilo1r" colspan=1>
                               <? echo number_format($row5["eta_impuesto2"],0,',','.') ?>
                             </td>
                           </tr>


                           

			<tr>
                               <td  valign="center" class="Estilo1"><br><br><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>



                            <input type="hidden" name="id" value="<? echo $id2 ?>" >
                           <input type="hidden" name="sw" value="1" >
                        </form>

                      </td>		

                       <tr>
                       <td colspan="8"><hr></td>
		<tr>
                    <td height="15" colspan="2"><span class="Estilo7">GESTIONES DEL PAGO</span></td>
                  </tr>

                      </tr>
                      </table>
                   <table width="488" border="1" cellspacing="0" cellpadding="0">
                     <tr>
                        <td  valign="center" class="Estilo5">Nº</td>
                        <td  valign="center" class="Estilo5">Fecha</td>
                        <td  valign="center" class="Estilo5">Tipo</td>
                        <td  valign="center" class="Estilo5">Descripción</td>
                        <td  valign="center" class="Estilo5">Usuario</td>
                      </tr>

<?
               $sql21 = "Select * from dpp_acciones where acc_eta_id='$id2' order by acc_id desc";
               //echo $sql;
               $res21 = mysql_query($sql21);
               $contador=1;
               while ($row21 = mysql_fetch_array($res21)) {

?>
                      <tr>

                        <td  valign="center" class="Estilo5"><? echo $contador; ?></td>
                        <td  valign="center" class="Estilo5"><? echo $row21["acc_fecha"]; ?></td>
                        <td  valign="center" class="Estilo1"><? echo $row21["acc_tipo"]; ?></td>
                        <td  valign="center" class="Estilo1"><? echo $row21["acc_texto"]; ?></td>
                        <td  valign="center" class="Estilo5"><? echo $row21["acc_user"]; ?></td>
                      </tr>
<?
                  $contador++;
               }
?>







</td>
  </tr>
 
 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
