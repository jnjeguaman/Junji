<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$perfil_user=$_SESSION["pfl_user"];
if($_SESSION["nom_user"] == ""){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
?>
<html>
<head>
<title>DAF</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
.Estilo2 {
	font-family: Verdana;
	font-size: 10px;
	text-align: left;
}
.Estilo3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #FFFFFF;
}
.link {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #00659C;
	text-decoration:none;
	text-transform:uppercase;
}
.link:hover {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #0000cc;
	text-decoration:none;
	text-transform:uppercase;
}
-->
</style></head>

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
<?
if ($perfil_user==15 or $perfil_user==9 or 1==1) {
?>
                <tr>
                  <td >




<br>
<br>
 En esta aplicación los Encargados del Fondo Fijo tendrán la posibilidad de: <br><br>



<li> Registrar los gastos de rendiciones en un sólo sistema de fácil acceso y consulta.
<li> Centralizar la información de los fondos asignados en una base de datos.
<li> Control de los saldos disponibles en cada caja chica.
<li> Validar en línea la pertinencia del gasto rendido.
<li> Emisión automática de reportes.
<li> Control de los anticipos.
<li> Solicitud de reposición.
<li> Monitorear el estado de fondo fijo.
<br>
<br>


<?
} else {
?>
<!--

            <tr>
              <td align="center" background="images/tabfon.gif"><table width="502" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="Estilo2">
                  El Sistema de Seguimiento de Facturas y Boletas es una herramienta desarrollada internamente por el Departamento de Administración y Finanzas de la Defensoría Nacional, con la finalidad de apoyar la gestión de los documentos valorados en las diferentes etapas de revisión y aprobación antes del pago de éstas.

<br>
<br>

Esta aplicación tiene disponible:<br>
<li> Ingresar información de los documentos valorados (Facturas, Boletas de Servicios, Boletas de Honorarios y Boletas de Garantías).
<li> Realizar el seguimiento de los documentos valorados.
<li> Automatizar la secuencia de acciones, actividades o tareas utilizadas para el correcto flujo de documentos valorados.
<li> Agilizar el proceso de intercambio de información y agilizar la toma de decisiones de la  institución con respecto a los documentos valorados.
<li> Generar Consultas.
<li> Imprimir Reportes.
<br>
-->

<?
}
?>
<br>


                  </td>
                </tr>
              </table>


</body>
</html>
