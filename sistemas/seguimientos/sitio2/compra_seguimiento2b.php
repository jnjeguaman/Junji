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
//-->


    function validaGrabar() {

      if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA ACCIÓN ?')) {
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
                    <td height="20" colspan="2"><span class="Estilo7">GESTION PLAN DE COMPRA</span></td>
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
                       <td><a href="compra_ingresab.php" class="link" >Volver</a></td>
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
                             <td  valign="center" class="Estilo1">Monto del Contrato</td>
                             <td class="Estilo1" colspan=3><? echo number_format($row21["compra_total"],0,',','.'); ?>
                             </td>
                           </tr>
				  <form name="form1" action="compra_grabavigente2.php" method="post" onsubmit="return validaGrabar()">
                            <tr>
                             <td  valign="center" class="Estilo1">Monto Real</td>
                             <td class="Estilo1" colspan=3>
                             <input type="text" name="vigente" class="Estilo2" value="<? echo $row21["compra_vigente"]; ?>" size="10">
                             <input type="submit" value="GRABAR" >
                             </td>
                           </tr>
                     <input type="hidden" name="id" value="<? echo $id ?>" >
                     <input type="hidden" name="ori2" value="2" >
                  </form>


                            <tr>
                             <td  valign="center" class="Estilo1">Nº Meses </td>
                             <td class="Estilo1" colspan=3><? echo $row21["compra_meses"]; ?>

                             </td>
                           </tr>

<?
$sql2 = "Select * from compra_categoria  where cat_id ='".$row21["compra_tipo2"]."'";
//echo $sql;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombretipo=$row2["cat_nombre"];

$sql2 = "Select * from compra_subcat  where subcat_id ='".$row21["compra_modalidad"]."'";
//echo $sql;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremodalidad=$row2["subcat_nombre"];
 ?>



                          <tr>
                             <td  valign="center" class="Estilo1">Tipo Contratacion</td>
                             <td class="Estilo1"><? echo $nombretipo; ?>
                              </td>
                          </tr>
                          <tr>
                             <td  valign="center" class="Estilo1">Modalidad</td>
                             <td class="Estilo1"><? echo $nombremodalidad; ?>
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
                             <td  valign="center" class="Estilo1">Total Presupuesto </td>
                             <td class="Estilo1" colspan=3>
                                     <? echo $row21["compra_totalpre"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nro Meses</td>
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
					<table width="488" border="1" cellspacing="0" cellpadding="0">
                       <tr>
                         <td colspan=5 align="center">
                           PLANIFICACION
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
                                   <td class="Estilo1"><a href="compra_vigente.php?id2=<? echo $row2["cvig_id"]  ?>&id=<? echo $id ?>&ori=2" class="link" >Editar</a></td>
                                 </tr>

                                 <?
                                   }
                                 ?>

                    </table>
                    <br>
                    <hr>











</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
