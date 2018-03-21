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
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
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
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

		  <?
		  require("inc/menu_1.php");
		  ?>

            </div>
      </div>

        <div class="col-sm-9 col-lg-9">
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
$ori=$_GET["ori"];
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
$sql21="select * from compra_compra where compra_id='$id'  ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $totaldevueltos=$row21["compra_fecha"];
  
if ($ori==1) {
   $volver="compra_ingresa.php";
}
if ($ori==2) {
   $volver="compra_ingresa.php";
}
if ($ori==3) {
   $volver="compra_ingresa.php";
}

?>

                       <tr>
                       <td><a href="<? echo $volver ?>" class="link" >Volver</a></td>
                      </tr>


                   <tr>
             			<td height="50" colspan="3">
                     </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_grabaseguimiento2.php" method="post"  onSubmit="return valida()">
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="4"><br>  </td>
                           </tr>



<tr>
                             <td  valign="center" class="Estilo1">Fecha Compra</td>
                             <td class="Estilo1" valign="center"><? echo $row21["compra_fecha"]; ?>



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
                             <td  valign="center" class="Estilo1">Monto </td>
                             <td class="Estilo1" colspan=3><? echo $row21["compra_total"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nº Meses </td>
                             <td class="Estilo1" colspan=3><? echo $row21["compra_meses"]; ?>

                             </td>
                           </tr>
<?
$compratipo=$row21["compra_tipo2"];

if (is_numeric($compratipo) ) {
  $sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$compratipo";
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $compratipo2=$registro["cat_nombre"];
} else  {
  $compratipo2=$row21["compra_tipo2"];
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
                       <td><hr></td><td><hr></td>


                         <tr>
                             <td  valign="center" class="Estilo1">Saldo</td>
                        </tr>


                         <tr>
                             <td  valign="center" class="Estilo1">Estado</td>
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
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>


                            <input type="hidden" name="id" value="<? echo $id ?>" >

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">



                      <table border=1>
<tr></tr>


<br>
<tr class="Estilo8"></tr>
                        <tr>
                         <td class="Estilo1c" colspan="5">ORDENES DE COMPRA</td>
                        </tr>

                        <tr>
                         <td class="Estilo1">NºOC </td>
                         <td class="Estilo1">Fecha</td>
                         <td class="Estilo1">Rut</td>
                         <td class="Estilo1">Proveedor</td>
                         <td class="Estilo1">Estado</td>
                        </tr>
<?

  $sql="select * from compra_seguimiento where segui_compra_id='$id'  order by segui_id desc ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){

?>


                       <tr>
                         <td class="Estilo1" ><? echo $row3["segui_idchile"]  ?></td>
                         <td class="Estilo1" ><? echo $row3["segui_ejemes"]  ?></td>
                         <td class="Estilo1" ><? echo $row3["segui_resultado"]  ?></td>
                         <td class="Estilo1" ><? echo $row3["segui_ejemonto"]  ?></td>
                         <td class="Estilo1" ><? echo $row3["segui_saldo"]  ?></td>
                         <td class="Estilo1" ><? echo $row3["segui_justifica"]  ?></td>
                         <td class="Estilo1" ><? echo $row3["segui_estado"]  ?></td>

                       </tr>





<?

   $cont++;

}
?>


                      <tr>
                       <input type="hidden" name="cont" value="<? echo $cont ?>" >

                        





</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
