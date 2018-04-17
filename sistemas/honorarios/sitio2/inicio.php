<?
session_start();
require("inc/config.php");
require("inc/querys.php");
if($_SESSION["nom_user"] == "" and 1==2){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
?>
<html>
<head>
<title>Honorarios</title>
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
   .Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif; 
    font-size: 15px; font-weight: bold; }

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

            <div class="col-sm-9 col-lg-9">
               <div class="dash-unit2">

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                       <td height="20" colspan="2"><span class="Estilo7">PAGINA PRINCIPAL</span></td>
                  </tr>
                   <tr>
                      <td><hr></td><td><hr></td>
                   </tr>
                  <tr>
                    <td align="center">
                     <table width="" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="">
                        El Sistema de Apoyo Honorarios es una herramienta desarrollada internamente por la Junta Nacional de Jardines Infantiles, con la finalidad de apoyar la gesti&oacute;n Regional y Defensor&iacute;a Nacional en materias de honorarios.<br>
                        <br>
                        En esta aplicaci&oacute;n los funcionarios tendr&aacute;n la posibilidad de:<br>
                        <li> Ingresar los montos cancelados por concepto de Honorarios</li>
                        <li> Generar Consulta</li>
                        <li> Imprimir Reportes</li>
                        <br>
                        <br>
                        El sistema tiene por objetivo centralizar la informaci&oacute;n de todos los honorarios cancelados por la defensor&iacute;a en todo el pa&iacute;s. Tambi&eacute;n es facilitar la gesti&oacute;n de los impuestos retenidos a nuestros prestadores, funcionarios y peritos para la OPERACI&Oacute;N RENTA DE CADA A&Ntilde;O.

                        </td>
                        
                      </tr>

                      <tr>


                         <td align="center"><br><img src="images/imagen2.jpg" width="313" height="220"></td>

                      </tr>

                     </table>

                    </td>

                  </tr>

                </table>

                <br>

                <br>

                <? require("inc/pie.php"); ?>


                <img src="images/pix.gif" width="1" height="10">

              </div>

          </div>

        </div>

    </div>


</body>

</html>
