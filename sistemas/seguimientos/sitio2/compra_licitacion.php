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
.Estilo3a {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: left;
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
	text-align: left;
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

    <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />

  
<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--



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
//-->

</script>

<body>
<?

?>

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
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE LICITACIONES</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">
                         
<?

if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Registros insertados con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Registros NO insertados !";
}
if (isset($_GET["ori"])) {
    $ori=$_GET["ori"];
}


?>
                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
<?
$sql21="select max(folio1_folio) as foliomio from dpp_folio1 where folio1_region='$regionsession'  ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $foliomio=$row21["foliomio"];
  $foliomio2=$foliomio+1;
  
$sql22="select count(eta_id) as totaldevueltos from dpp_etapas where eta_estado=12 and eta_region='$regionsession' ";
//  echo $sql21;
  $result22=mysql_query($sql22);
  $row22=mysql_fetch_array($result22);
  $totaldevueltos=$row22["totaldevueltos"];

if ($ori==2) {
    $volver="compra_orden.php";

} else {
    $volver="compra_menuoc.php";

}
?>
                       <tr>
                       <td><a href="<? echo $volver; ?>" class="link" >Volver</a></td>
                      </tr>



                   <tr>
             			<td height="50" colspan="3">
                      </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_grabalicitacion.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="4"><br>  </td>
                           </tr>



                    </table>
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1">Numero  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="numero" class="Estilo2" size="60" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nombre Licitación</td>
                             <td class="Estilo1" colspan=3>
                             <textarea name="nombre" rows="3" cols="60" class="Estilo2"  ></textarea>
                             </td>
                           </tr>



                            <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==0) {
                                    $sql2 = "Select * from regiones order by codigo";
                                    echo '<option value="">Select...</option>';
                                  } else
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["codigo"] ?>"><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Publicación</td>
                          <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly="1">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c1",
        trigger    : "f_trigger_c1",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>
                      </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Adjudicación</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" readonly="1">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />


   <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c2",
        trigger    : "f_trigger_c2",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>



                             </td>
                      </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Estado</td>
                             <td class="Estilo1">
                                <select name="estado" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
                                    $sql2 = "Select * from compra_subcat  where subcat_cat_id =7";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["subcat_nombre"] ?>"  <? if ($row2["subcat_nombre"]==$estado) echo 'selected=selected'  ?> ><? echo $row2["subcat_nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>
                        <tr>
                             <td  valign="center" class="Estilo1" width="79"> Archivo</td>
                             <td class="Estilo1" colspan=3>
                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>
                             </td>
                        </tr>







<tr>
                       <td><hr></td><td><hr></td>


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

                           <tr>
                             <input type="hidden" name="ori" value="<? echo $ori ?>"  >
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR     " > </td>
                           </tr>



                        </form>

                      </td>


                       <tr>
                       <td></td><td></td><td></td><td></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">



                      <table border=1>
<tr></tr>


<br>
<tr class="Estilo8"></tr>

                        <tr>
                         <td class="Estilo3c">Nº </td>
                         <td class="Estilo3c">Nombre </td>
                         <td class="Estilo3c">Region</td>
                         <td class="Estilo3c">Fecha Publi.</td>
                         <td class="Estilo3c">Fecha Adju.</td>
                         <td class="Estilo3c">Archivo</td>
                         <td class="Estilo3c">Estado</td>
                        </tr>
<?

  $sql="select * from compra_licitacion  order by lici_id desc LIMIT 0 , 10 ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){

?>


                       <tr>
  	 <td class="Estilo3c"><? echo $row3["lici_numero"] ?> </td>
     <td class="Estilo3d" ><? echo $row3["lici_nombre"]  ?></td>
     <td class="Estilo3d" ><? echo $row3["lici_region"]  ?></td>
     <td class="Estilo3d" ><? echo $row3["lici_fechapub"]  ?></td>
     <td class="Estilo3d" ><? echo $row3["lici_fechaadju"]  ?></td>
     <td class="Estilo3d" ><a href="../../archivos/docfac/<? echo $row3["lici_archivo"]; ?>" class="link" target="_blank"><? echo $row3["lici_archivo"]; ?></a></td>
     <td class="Estilo3d" ><? echo $row3["lici_estado"]  ?></td>
     

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
