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

     $id=$_GET["id"];
     $idante=$_GET["idante"];

?>
<html>
<head>
<title>CONCILIACION</title>
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
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--
function valida() {

   if (document.form1.region.value==0 ) {
      alert ("Region presenta problemas ");
      return false;
  }

}
//-->

</script>

<body>
<img src="images/pix.gif" width="1" height="10">
<table width="752" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
  <tr>
    <td width="1009">
	  <?
	  require("inc/top.php");      
	  ?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="165" valign="top">
		  <?
		  require("inc/menu_1.php");
		  ?>		  </td>
          <td valign="top">           <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="530" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">FICHA DETALLE ANTECEDENTES CUENTAS CORRIENTE</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">

<?


?>
                         </td>
                      </tr>
                      <tr>
                        <td><a href="consolidacion_corriente3.php?id=<? echo $id ?>" class="link" > Volver </a></td>
                      </tr>

                       <tr>
                       <td><br></td>


                      </tr>

                   <tr>
             			<td height="50" colspan="3">
                
                         <table border=1>
                             <tr>
                               <td class="Estilo1">NUMERO</td>
                               <td class="Estilo1">DESCRIPCION</td>
                              </tr>
                              
<?

     
     $sql="select * from concilia_cc where cc_region='$regionsession' and cc_id=$id order by cc_id desc";
//     echo $sql;
     $res2 = mysql_query($sql);
     while ($row2 = mysql_fetch_array($res2)) {

?>
    <tr>
      <td  class="Estilo1"><? echo $row2["cc_numero"]; ?></td>
      <td  class="Estilo1"><? echo $row2["cc_descripcion"]; ?></td>
    </tr>
 <?
}
 ?>




                         </table>
<?

          $sql="select * from concilia_antecedente where ante_id='$idante' ";
//     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $row2 = mysql_fetch_array($res2);


?>

                    
                    <br>
					<table width="488" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="consolidacion_grabacorriente3.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Cuenta</td>
                             <td class="Estilo1" valign="center">
                             <? echo $row2["ante_fecha"]; ?>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nombre</td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row2["ante_nombre"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Cargo</td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row2["ante_cargo"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">RUT(Cédula de Identidad)</td>
                             <td class="Estilo1" colspan=3>
                                <a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo1"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo1"]; ?></a>
                                                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">N° Póliza de Fianza</td>
                             <td class="Estilo1" colspan=3>
                                <a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo2"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo2"]; ?></a>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Auorización Oficio Contraloría</td>
                             <td class="Estilo1" colspan=3>
                                <a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo3"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo3"]; ?></a>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Registro de Firma Cuenta Corriente</td>
                             <td class="Estilo1" colspan=3>
                                <a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo4"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo4"]; ?></a>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Anexo de Contrato Transferencias</td>
                             <td class="Estilo1" colspan=3>
                                <a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo5"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo5"]; ?></a>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Otros</td>
                             <td class="Estilo1" colspan=3>
                                <a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo6"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo6"]; ?></a>
                             </td>
                           </tr>
<?
         $anteestado=$row2["ante_estado"];
         if ($anteestado==1) {
             $estado="Vigente";
         }
         if ($anteestado==2) {
             $estado="Desactivado";
         }
?>
                            <tr>
                             <td  valign="center" class="Estilo1">Estado</td>
                             <td class="Estilo1" colspan=3>
                              <? echo $estado; ?>
                             </td>
                           </tr>



                       <tr>

                    </table>
                     <tr>
                       <td><Br></td>
                      </tr>





                          <input type="hidden" name="id" value="<? echo $id ?>">

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>

</table>
                      
                      <tr>
                      <td colspan="8">

                      <table border=1>
<tr></tr>



                      <tr>

                        





</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>


