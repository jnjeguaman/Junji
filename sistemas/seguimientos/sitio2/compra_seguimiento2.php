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
$date_in2=date("Y-m-d");
?>
<html>
<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
<title>Compras</title>
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
.Estilo1b {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: center;
}

.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right;
}
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 12px;
	color: #003063;
	text-align: center;
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
  <script type="text/javascript" src="librerias/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--

function ChequearTodos(chkbox)
{
  for (var i=0;i < document.forms[0].elements.length;i++){
      var elemento = document.forms[0].elements[i];
      alert("aqui "+chkbox);
      if (elemento.type == "checkbox"){
          elemento.checked = chkbox.checked
      }
  }
}

function valida() {

    if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
      blockUI();
    }
    else{
      return false;
    }

   if (document.form1.rut.value==0 || document.form1.rut.value=='') {
      alert ("Rut presenta problemas ");
      return false;
  }
   if (document.form1.dig.value=='') {
      alert ("Dig presenta problemas ");
      return false;
  }
   if (document.form1.region.value==0 || document.form1.region.value=='') {
      alert ("Region presenta problemas ");
      return false;
  }

   if (document.form1.nombre.value=='' || document.form1.nombre.value=='Proveedor No Existe') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.nombre.value=='' || document.form1.nombre.value=='Proveedor No Existe') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.numero.value=='0' || document.form1.numero.value=='') {
      alert ("Número Factura presenta problemas ");
      return false;
  }
   if (document.form1.numero.value <= 0) {
      alert ("Número Factura debe ser positivo ");
      return false;
  }

   if (document.form1.monto.value=='0' || document.form1.monto.value=='') {
      x=document.form1.numero.value;
      alert ("Total factura presenta problemas "+ x);
      return false;
  }
   if (document.form1.tipodoc[0].checked=='' && document.form1.tipodoc[1].checked==''  && document.form1.tipodoc[2].checked=='' && document.form1.tipodoc[3].checked=='' && document.form1.tipodoc[4].checked=='') {
      alert ("No ha seleccionado Tipo de Documento ");
      return false;
  }



  
}

function valida2() {
   if (document.form22.estado.value=='CUMPLIDA' && document.form22.mesprograma.value=='') {
      alert ("Debe Seleccionar mes de Cumplimiento ");
      return false;
  }

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }
}


//-->


function validaGrabar() {

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }
}

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
                    <td height="20" colspan="2"><span class="Estilo7">CAMBIO ESTADO ACTIVIDAD</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">
                         
<?

$id=$_GET["id"];
$sw=$_GET["sw"];
$id2=$_GET["id2"];
if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Registros insertados con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Registros NO insertados !";
}

?>
                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
<?
if ($sw==1) {

   $sql="delete from compra_ordengestion where orges_id ='$id2' ";
   //echo $sql;
   mysql_query($sql);

}


$sql21="select * from compra_compra where compra_id='$id'  ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $totaldevueltos=$row21["compra_fecha"];
?>

                       <tr>
                       <td><a href="compra_seguimiento.php" class="link" >Volver</a></td>
                      </tr>


                   <tr>
             			<td height="50" colspan="3">
                   </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">

                           <tr>
                             <td  valign="top" class="Estilo1" colspan="4"><br>  </td>
                           </tr>



<tr>
                             <td  valign="center" class="Estilo1">Fecha Compra</td>
                             <td class="Estilo1" valign="center"><? echo substr($row21["compra_fecha"],8,2)."-".substr($row21["compra_fecha"],5,2)."-".substr($row21["compra_fecha"],0,4)   ?>



                             </td>
                           </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
                                <? echo $row2["nombre"] ?>

                                 <?
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                        echo $row2["nombre"];
                                  }

                                 ?>





                             </td>
                      </tr>
                      <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nombre Servicio  </td>
                             <td class="Estilo1" colspan=3><? echo $row21["compra_nombre"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Descripcion Servicio  </td>
                             <td class="Estilo1" colspan=3><? echo $row21["compra_descip"]; ?>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">$ Programado</td>
                             <td class="Estilo1" colspan=3><? echo number_format($row21["compra_total"],0,',','.'); ?>
                             </td>
                           </tr>
				  <form name="form1" action="compra_grabavigente2.php" method="post" onsubmit="return validaGrabar()">
                            <tr>
                             <td  valign="center" class="Estilo1">$ Efectivo</td>
                             <td class="Estilo1" colspan=3>
                             <input type="text" name="vigente" class="Estilo2" value="<? echo $row21["compra_vigente"]; ?>" size="10">
                             <input type="submit" value="GRABAR" >
                             </td>
                           </tr>
                     <input type="hidden" name="id" value="<? echo $id ?>" >
                     <input type="hidden" name="ori2" value="1" >
                  </form>
                           
                            <tr>
                             <td  valign="center" class="Estilo1">Nº Meses </td>
                             <td class="Estilo1" colspan=3><? echo $row21["compra_meses"]; ?>

                             </td>
                           </tr>
<?
$compratipo=$row21["compra_tipo2"];

if (is_numeric($compratipo)  ) {
  $sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$compratipo";
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $compratipo2=$registro["cat_nombre"];
} else  {
  $compratipo2=$row21["compra_tipo2"];
}

//echo  $compratipo;
if ($compratipo=='') {
  $compratipo2=$row21["compra_tipo"];
}


?>


                          <tr>
                             <td  valign="center" class="Estilo1">Tipo Adquisicion</td>
                             <td class="Estilo1"><? echo $compratipo2; ?>
                              </td>
                          </tr>

                          <tr>
                             <td  valign="center" class="Estilo1">Mes Programado</td>
                             <td class="Estilo1"><? echo $row21["compra_mes"]; ?>
                             </td>
                          </tr>
                          <tr>
                             <td  valign="center" class="Estilo1">Centro de Costo</td>
                             <td class="Estilo1">
                                 <? echo $row21["compra_ccosto"]; ?>
                             </td>
                      </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Unidad Responsable</td>
                             <td class="Estilo1"><? echo $row21["compra_depto"]; ?>
                             </td>
                      </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Responsable </td>
                             <td class="Estilo1" colspan=3>
                               <? echo $row21["compra_responsable"]; ?>
                             </td>
                           </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Item</td>
                             <td class="Estilo1">
                                     <? echo $row21["compra_item"]; ?>
                             </td>
                         </tr>
                         <tr>
                             <td  valign="center" class="Estilo1" colspan="4"><hr></td>
                         </tr>
                         <tr>
                             <td  class="Estilo1b" colspan="4">PRESUPUESTO <? echo $row21["compra_anno"] ?></td>
                         </tr>

                      
                            <tr>
                             <td  valign="center" class="Estilo1">Presupuesto <? echo $row21["compra_anno"] ?> </td>
                             <td class="Estilo1" colspan=3>
                                     <? echo number_format($row21["compra_totalpre"],0,',','.'); ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">N° Meses a Pagar</td>
                             <td class="Estilo1" colspan=3>
                                     <? echo $row21["compra_pagarmes"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Estado</td>
                             <td class="Estilo1" colspan=3>
                                     <? echo $row21["compra_estado"]; ?>
                             </td>
                           </tr>


<tr>


                      </tr>
                    </table>

                    <hr>
                    <br>
<!--
					<table width="488" border="1" cellspacing="0" cellpadding="0">
                       <tr>
                         <td colspan=5 align="center" valign="center" class="Estilo1d">
                           <b>PLANIFICACION PRESUPUESTARIA</b>
                         </td>
                        </tr>
                        
                        
                       <tr>
                         <td class="Estilo1" >Año </td>
                         <td class="Estilo1" >Monto Estimado  </td>
                         <td class="Estilo1" >Presupuesto Vigente</td>
                         <td class="Estilo1" >Meses Ejecucion </td>
                         <td class="Estilo1" >Editar </td>
                        </tr>

<?
                                 $sql2 = "Select * from compra_vigentedet  where cvig_compra_id =$id";
                                 //echo $sql2;
                                 $res2 = mysql_query($sql2);

                                 while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                 <tr>
                                   <td class="Estilo1c"><? echo $row2["cvig_anno"] ?></td>
                                   <td class="Estilo1c"><? echo number_format($row2["cvig_total"],0,'.','.') ?></td>
                                   <td class="Estilo1c"><? echo number_format($row2["cvig_vigente"],0,'.','.') ?></td>
                                   <td class="Estilo1c"><? echo number_format($row2["cvig_meses"],0,'.','.') ?></td>
                                   <td class="Estilo1"><a href="compra_vigente.php?id2=<? echo $row2["cvig_id"]  ?>&id=<? echo $id ?>&ori=1" class="link" >Editar</a></td>
                                 </tr>

                                 <?
                                   }
                                 ?>


                    </table>
-->

					<table width="488" border="0" cellspacing="0" cellpadding="0">
				  <form name="form22" action="compra_grabaseguimiento2.php" method="post"  onSubmit="return valida2()">
                         <tr>
                             <td  class="Estilo1b" colspan="4">CAMBIO DE ESTADO</td>
                         </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Estado</td>
                             <td class="Estilo1">
                                <select name="estado" class="Estilo1">
                                   <option value="">Seleccione...</option>
                                   <option value="PENDIENTE" <? if ($row21["compra_estado"]=='PENDIENTE') { echo "selected=selected"; } ?>>PENDIENTE</option>
                                   <option value="CUMPLIDA" <? if ($row21["compra_estado"]=='CUMPLIDA') { echo "selecte=selected"; } ?>>CUMPLIDA</option>
<?
if ($regionsession==15 or $row21["compra_estado"]=='CANCELADA') {
?>
                                   <option value="CANCELADA" <? if ($row21["compra_estado"]=='CANCELADA') { echo "selected=selected"; } ?>>CANCELADA</option>
<?
}
?>

                               </select>
                             </td>

                             <td class="Estilo1"> Mes Cumplimiento
                                <select name="mesprograma" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
                                    $sql2 = "Select * from compra_subcat  where subcat_cat_id =1";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["subcat_nombre"] ?>" <? if (trim($row2["subcat_nombre"])==$row21["compra_mescumple"]) { echo "selected=selected"; } ?> ><? echo $row2["subcat_nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>

                      </tr>
                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
<?
if ($regionsession==15 or $row21["compra_estado"]!='CANCELADA') {
?>
                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR ESTADO     " > </td>
                           </tr>
<?
}
?>

                            <input type="hidden" name="id" value="<? echo $id ?>" >
                   </form>
                    </table>
                    

                           <tr>
                            <td  valign="center" class="Estilo1b" colspan=6><hr>  </td>
                              </tr>

					<table width="488" border="0" cellspacing="0" cellpadding="0">
               <table>
               <tr><td>
				  <form name="form1" action="compra_grabaseguimiento2.php" method="post"  onSubmit="return valida()">

                           <tr>
                               <td  valign="center" class="Estilo1b" colspan=6>AGREGAR GESTION  </td>
                           </tr>

                      
                   <tr>
                             <td  valign="center" class="Estilo1">Fecha</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly="1">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        singleClick    :    true,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)

    });
</script>



                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Importante </td>
                             <td class="Estilo1" colspan=3>
                               <input type="checkbox" name="importante" class="Estilo2" value="SI" >Si
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Gestion </td>
                             <td class="Estilo1" colspan=3>
                               <textarea name="gestion" rows="3" class="Estilo2" cols="64"></textarea>
                             </td>
                           </tr>



                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR GESTION     " > </td>
                           </tr>

                            <input type="hidden" name="id" value="<? echo $id ?>" >

                        </form>


                      <table border=1>

                        <tr>
                         <td class="Estilo1b" colspan=9>Gestiones </td>
                        </tr>

                        <tr>
                         <td class="Estilo1b">Id </td>
                         <td class="Estilo1b">Fecha</td>
                         <td class="Estilo1b">Gestion</td>
                         <td class="Estilo1b">Importante</td>
                         <td class="Estilo1b">Usuario</td>
                        </tr>
<?

  $sql="select * from compra_ordengestion where orges_compra_id ='$id'  order by orges_id desc ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){


?>


                       <tr>
                         <td class="Estilo1" ><? echo $row3["orges_id"]  ?></td>
                         <td class="Estilo1" ><? echo substr($row3["orges_fecha"],8,2)."-".substr($row3["orges_fecha"],5,2)."-".substr($row3["orges_fecha"],0,4)   ?></td>
                         <td class="Estilo1" ><? echo $row3["orges_gestion"]  ?></td>
                         <td class="Estilo1" ><? echo $row3["orges_importante"]  ?></td>
                         <td class="Estilo1" ><? echo $row3["orges_user"]  ?></td>
                         <td class="Estilo3c"><a href="compra_seguimiento2.php?id=<? echo $id ?>&id2=<? echo $row3["orges_id"] ?>&sw=1" class="link" onclick="return confirm('Seguro que desea Borrar ?')"><img src="imagenes/b_drop.png" border=0></a></td>
                       </tr>





<?

   $cont++;

}
?>



                        


                     </table>
                        <br><br>

                      <table>
                      <tr>
                      <td colspan="8">


                      <table border=1>

                        <tr>
                         <td class="Estilo1b" colspan=9>Ordenes de Compra Asociadas </td>
                        </tr>

                        <tr>
                         <td class="Estilo1b">N°</td>
                         <td class="Estilo1b">Numero</td>
                         <td class="Estilo1b">Tipo</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">R.Social</td>
                         <td class="Estilo1b">Monto</td>
                         <td class="Estilo1b">Estado</td>
                         <td class="Estilo1b">Ver</td>
                           </tr>
<?


    $sql="select * from compra_orden x, compra_detorden y where  y.detorden_plan='$id' and y.detorden_oc_id=x.oc_id and x.oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA'";
//  $sql="select * from compra_orden where oc_compra_id='$id'  order by oc_id desc ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$suma=0;
while($row3 = mysql_fetch_array($res3)){

  $sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =".$row3["oc_tipo"];
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $compratipo2b=$registro["cat_nombre"];

if ($row3["oc_estado"]<>'CANCELADA/ELIMINADA/RECHAZADA') {
  $suma=$suma+$row3["oc_monto"];
}
$estilonuevo="Estilo1";
if ($row3["oc_estado"]=='CANCELADA/ELIMINADA/RECHAZADA') {
  $estilonuevo="Estilo1crojo";
}
?>


                       <tr>
                         <td class="Estilo1" ><? echo $cont;  ?></td>
                         <td class="Estilo1" ><? echo $row3["oc_numero"]  ?></td>
                         <td class="Estilo1" ><? echo $compratipo2b;  ?></td>
                         <td class="Estilo1" ><? echo $row3["oc_rut"]."-".$row3["oc_dig"];  ?></td>
                         <td class="Estilo1" ><? echo $row3["oc_rsocial"]  ?></td>
                         <td class="Estilo1" ><? echo number_format($row3["oc_monto"],0,',','.');  ?></td>
                         <td class="<? echo $estilonuevo ?>" ><? echo substr($row3["oc_estado"],0,10)  ?></td>
                         <td class="Estilo1"><a href="compra_fichaorden2.php?id=<? echo $row3["oc_id"]  ?>&id2=<? echo $id ?>&ori=5" class="link" >ver</a></td>
<!--
                         <td class="Estilo1"><a href="#?id=<? echo $row3["oc_id"]  ?>" class="link" ><? echo $row3["oc_nrofactura"]  ?></a></td>
-->
                       </tr>





<?

   $cont++;

}
?>
                       <tr>
                         <td class="Estilo1" colspan=5></td>
                         <td class="Estilo1" colspan=1><? echo number_format($suma,0,',','.');  ?></td>
                       </tr>

</table>





                        





</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
