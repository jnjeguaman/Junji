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
?>
<html>
<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
<title>Defensoria</title>
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
	font-size: 8px;
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
	font-size: 8px;
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
font-weight: bold; }
-->
</style>
<link rel="stylesheet" type="text/css" href="select_dependientes.css">
<script type="text/javascript" src="select_dependientes.js"></script>
<script type="text/javascript" src="ajaxclient.js"></script>
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


  <script type="text/javascript">
    
    function validaGrabar() {

      if(confirm('� EST� SEGURO DE PROCEDER CON LA ACCI�N ?')) {
        blockUI();
      }
      else{
        return false;
      }

    
    }
  </script>
  

<body>
  <div class="navbar-nav">
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">REQUISITOS TECNICOS</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$rut=$_GET["rut"];
$id=$_GET["id"];
$res=$_GET["res"];
$nacional=$_GET["nacional"];
$ori=$_GET["ori"];

$sql="select * from dpp_contratos where cont_id=$id";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$evaluara=$row["cont_evaluara"];


?>
                       <tr>
                       <td><a href="contratosadjuntos.php?id=<? echo $id ?>&rut=<? echo $rut ?>" class="link" >volver</a></td>
                      </tr>
                       <tr>
                       <td><br></td>
                      </tr>



                   <tr>
                    <td height="50" colspan="3">

     <table width="480" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1">Rut Empresa  </td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row["cont_rut"]; ?> -<? echo $row["cont_dig"]; ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Proveedor Adjudicado </td>
                             <td class="Estilo1" colspan=3><? echo $row["cont_nombre"]; ?>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Descripci�n Contrato </td>
                             <td class="Estilo1" colspan=3><? echo $row["cont_descripcion"]; ?>
                             </td>
                           </tr>

              <tr>
              <td colspan=10>
                <HR>
              </td>
             </tr>
       <form name="form1" action="contrato_grabatecnica1.php" method="post"  enctype="multipart/form-data" onsubmit="return validaGrabar()">
       
                            <tr>
                             <td  valign="top" class="Estilo1">Nombre Supervisor  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="super" class="Estilo2" size="30" value="<? echo $row["cont_supervisor"] ?>">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Nombre Administrador  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="admin" class="Estilo2" size="30" value="<? echo $row["cont_admin"] ?>">
                             </td>
                           </tr>

    <tr>
       <td class="Estilo1" ><br> </td>

    </tr>

    <tr>
       <td class="Estilo1" >Archivo </td>
        <td class="Estilo1" >
                              <input type="file" name="archivo1" class="Estilo2" size="20"  >
                              <br>
                              <a href="<? echo $row["cont_ruta"]; ?><? echo $row["cont_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row["cont_archivo"]; ?></a>
       </td>
    </tr>
                             
                           <tr>
                            <tr>
                            <td>&nbsp;</td>
                             <td class="Estilo1" colspan=3>
                              <input type="submit" name="boton" class="Estilo2" value="  Grabar  ">
                             </td>
                           </tr>
                           <tr>


                           </tr>
                            <input type="hidden" name="rut" value="<? echo $rut ?>" >
                            <input type="hidden" name="id" value="<? echo $id ?>" >
                            <input type="hidden" name="ori" value="<? echo $ori ?>" >
                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      <td class="Estilo1" colspan=4><a href="contrato_imptecnicoa.php?id=<? echo $id ?>" class="link" target="_blank">Imprimir </a>
                  <form name="form1" action="contrato_grabatecnica2.php" method="post" onsubmit="return validaGrabar()" >
<?
$sql2="select * from contra_tecnico where ctec1_cont_id=$id";
//echo $sql;
$result2=mysql_query($sql2);
$row2=mysql_fetch_array($result2);
$row2["ctec1_preg1"];
?>


                      <table border=1 width=100%>
                            <tr>
                             <td  valign="top" class="Estilo1" width=70%>a) Reuni�n de Coordinaci�n  </td>
                             <td class="Estilo1" colspan=1>
                              <input type="radio" name="preg1" class="Estilo2" size="30" value="Si" <? if ($row2["ctec1_preg1"]=='Si') { echo "checked"; } ?>> Si
                              <input type="radio" name="preg1" class="Estilo2" size="30" value="No"  <? if ($row2["ctec1_preg1"]=='No') { echo "checked"; } ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">b) Capacitaci�n: asociado a preparaci�n del personal que prestar� servicios en la DPP </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="preg2" class="Estilo2" size="30" value="Si"  <? if ($row2["ctec1_preg2"]=='Si') { echo "checked"; } ?>> Si
                              <input type="radio" name="preg2" class="Estilo2" size="30" value="No"  <? if ($row2["ctec1_preg2"]=='No') { echo "checked"; } ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">c) Asesoramiento t�cnico o Mesa de Ayuda. Verificar personal comprometido   </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="preg3" class="Estilo2" size="30" value="Si"  <? if ($row2["ctec1_preg3"]=='Si') { echo "checked"; } ?>> Si
                              <input type="radio" name="preg3" class="Estilo2" size="30" value="No"  <? if ($row2["ctec1_preg3"]=='No') { echo "checked"; } ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">d) Mantenci�n Preventiva </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="preg4" class="Estilo2" size="30" value="Si"  <? if ($row2["ctec1_preg4"]=='Si') { echo "checked"; } ?>> Si
                              <input type="radio" name="preg4" class="Estilo2" size="30" value="No"  <? if ($row2["ctec1_preg4"]=='No') { echo "checked"; } ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">e) Mantenci�n correctiva  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="preg5" class="Estilo2" size="30" value="Si"  <? if ($row2["ctec1_preg5"]=='Si') { echo "checked"; } ?>> Si
                              <input type="radio" name="preg5" class="Estilo2" size="30" value="No"  <? if ($row2["ctec1_preg5"]=='No') { echo "checked"; } ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">f) Reporte Estado de Avance de funcionamiento (cuando se requiere informar estado de avance de puesta en marcha del contrato)  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="preg6" class="Estilo2" size="30" value="Si"  <? if ($row2["ctec1_preg6"]=='Si') { echo "checked"; } ?>> Si
                              <input type="radio" name="preg6" class="Estilo2" size="30" value="No"  <? if ($row2["ctec1_preg6"]=='No') { echo "checked"; } ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">g) Otro requisito  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="preg7" class="Estilo2" size="30" value="Si"  <? if ($row2["ctec1_preg7"]=='Si') { echo "checked"; } ?>> Si
                              <input type="radio" name="preg7" class="Estilo2" size="30" value="No"  <? if ($row2["ctec1_preg7"]=='No') { echo "checked"; } ?>> No
                             </td>
                           </tr>
                      </table>
                           <tr>
                            <td>&nbsp;</td>
                           </tr>
                         <table border=0 width=100%>
                            <tr>
                             <td  valign="middle" class="Estilo1" width=20% >Observacion </td>
                             <td class="Estilo1" colspan=2>
                              <textarea rows="4" cols="55" name="obs"><? echo $row2["ctec1_obs"] ?> </textarea>
                             </td>
                           </tr>
                      </table>
                      
                           <tr>
                            <td>&nbsp;</td>
                             <td class="Estilo1" colspan=2>
                              <input type="submit" name="boton" class="Estilo2" value="  Grabar  ">
                             </td>
                           </tr>


                            <input type="hidden" name="rut" value="<? echo $rut ?>" >
                            <input type="hidden" name="id" value="<? echo $id ?>" >
                            <input type="hidden" name="ori" value="<? echo $ori ?>" >

            </form>

</td>
  </tr>

 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
