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

  <title>Documentos Intenos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  <link href="css/estilos.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
  <link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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

     text-transform: uppercase;



   }

   .Estilo1b {

     font-family: Verdana;

     font-weight: bold;

     font-size: 8px;

     color: #003063;

     text-align: center;

     text-transform: uppercase;

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

     text-transform: uppercase;

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

   .Estilo7 {
    font-family: Geneva, Arial, Helvetica, sans-serif;

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

<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />



<!-- main calendar program -->

<script type="text/javascript" src="librerias/calendar.js"></script>



<!-- language for the calendar -->

<script type="text/javascript" src="librerias/js/lang/calendar-es.js"></script>



  <!-- the following script defines the Calendar.setup helper function, which makes

  adding a calendar a matter of 1 or 2 lines of code. -->

  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

  

  <script src="librerias/js/jscal2.js"></script>

  <script src="librerias/js/lang/es.js"></script>

  <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />

  <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />

  <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />
  <script language="javascript">
    <!--
    function valida() {

      if (document.form1.fecha2.value=='') {
        alert ("Fecha Dcoumento presenta problemas ");
        return false;
      }

      if (document.form1.tipo.value==0) {
        alert ("Area presenta problemas ");
        return false;
      }

      if (document.form1.destinatario.value=='') {
        alert ("Destinatario presenta problemas ");
        return false;
      }

      if (document.form1.numero.value=='') {
        alert ("Numero externo presenta problemas ");
        return false;
      }

      if (document.form1.origen.value=='') {
        alert ("Numero interno presenta problemas ");
        return false;
      }


      if (document.form1.materia.value=='') {
        alert ("Materia presenta problemas ");
        return false;
      }

      if (document.form1.tipodoc.value=='') {
        alert ("Tipo de documento presenta problemas ");
        return false;
      }

      if (document.form1.remite.value=='') {
        alert ("Remite presenta problemas ");
        return false;
      }

      if (document.form1.obs.value=='') {
        alert ("Observacion presenta problemas ");
        return false;
      }

      if (document.form1.archivo1.value=='') {
        alert ("Seleccione un archivo");
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


    function validaGeneraguia() {

      if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA GENERACIÓN DE GUÍA ?')) {
        blockUI();
      }
      else{
        return false;
      }
    }

    function tipoReset(seleccion) {

      var select1 = document.getElementById("remitente");
      var select2 = document.getElementById("destinatario");

      if (seleccion.value!="Carta/Sobre"){

        select1.selectedIndex = 0;
        select2.selectedIndex = 0;

        if (select1.value != "otro") {
          var input = document.getElementById("input_oculto_R");
          input.style.display = "none";
          input.required=false;
        }
        //----------------------------
        if (select2.value != "otro") {
          var input = document.getElementById("input_oculto_D");
          input.style.display = "none";
          input.required=false;
        }

      }
      else {

        if (select1.value == "otro") {
          var input = document.getElementById("input_oculto_R");
          input.style.display = "";
          input.required=true;
        }
        //-------------------------
        if (select2.value == "otro") {
          var input = document.getElementById("input_oculto_D");
          input.style.display = "";
        }
      }

    }

    function mostraInputR(seleccion) {

      var tipodoc = document.getElementById("tipodoc");

      if (tipodoc.value=="Carta/Sobre"){

        if (seleccion.value=="otro"){
          var input = document.getElementById("input_oculto_R");
          input.style.display = "";
          input.required=true;
          input.focus();
        }
        else {
          var input = document.getElementById("input_oculto_R");
          input.style.display = "none";
          input.required=false;
        }

      } 

    }

    function mostraInputD(seleccion) {

      var tipodoc = document.getElementById("tipodoc");

      if (tipodoc.value=="Carta/Sobre"){

        if (seleccion.value=="otro"){
          var input = document.getElementById("input_oculto_D");
          input.style.display = "";
                  //input.required=true;
                  input.focus();
                }
                else {
                  var input = document.getElementById("input_oculto_D");
                  input.style.display = "none";
                  //input.required=false;
                }

              }
            }
          </script>
          <?


          function generaRegiones()
          {
            $consulta=mysql_query("SELECT codigo, nombre FROM regiones");
            while($registro=mysql_fetch_row($consulta))
            {
             echo "<option value='".$registro[1]."'>".$registro[1]."</option>";
           }
         }
         function generaPaises()

         {

          $consulta = mysql_query("SELECT * FROM regiones WHERE nombre not like '%XVI%'");
  /*
  <option value='Depto. Tecnico Pedagogico'>Depto. Tecnico Pedagogico</option>
  <option value='Depto. De Calidad Y Control Normativo'>Depto. De Calidad Y Control Normativo</option>
  <option value='Depto. Jutidico'>Depto. Jutidico</option>
  <option value='Depto. De Planificacion'>Depto. De Planificacion</option>
  <option value='Depto. De Recursos Financieros'>Depto. De Recursos Financieros</option>
  */
  //	include 'conexion.php';

  //	conectar();
    // $consulta = mysql_query("SELECT distinct(opcion) FROM area ORDER BY opcion ASC"); consulta original
  	// if($_SESSION["region"] == 14)
   //  {
   //    $consulta=mysql_query("SELECT id, opcion FROM area WHERE codigo = 'CE'");
   //  }else{
   //    $consulta=mysql_query("SELECT id, opcion FROM area WHERE codigo = 'CEREG'");
   //  }

      //echo $consulta;

  //	desconectar();



  	// Voy imprimiendo el primer select compuesto por los paises

  echo "<select name='tipo' id='tipo'>";

  echo "<option value='0'>Seleccione...</option>";

  while($registro=mysql_fetch_row($consulta))

  {

    echo "<option value='".$registro[1]."'>".$registro[1]."</option>";

  }
  echo "<option value='Depto. Tecnico Pedagogico'>Depto. Tecnico Pedagogico</option>";
  echo "<option value='Depto. De Calidad Y Control Normativo'>Depto. De Calidad Y Control Normativo</option>";
  echo "<option value='Depto. Jutidico'>Depto. Jutidico</option>";
  echo "<option value='Depto. De Planificacion'>Depto. De Planificacion</option>";
  echo "<option value='Depto. De Recursos Financieros'>Depto. De Recursos Financieros</option>";
    // generaRegiones();
    // echo "<option value='Municipalidad'>Municipalidad</option>";
    // echo "<option value='Ministerio'>Ministerio</option>";
    // echo "<option value='Isapres'>Isapres</option>";
    // echo "<option value='Suceso'>Suceso</option>";
    // echo "<option value='Proveedor'>Proveedor</option>";
    // echo "<option value='Instituciones'>Instituciones</option>";
    // echo "<option value='Caja de compensaci&oacute;n'>Caja de compensaci&oacute;n</option>";
    // echo "<option value='Contralor&iacute;a General de la Rep&uacute;blica'>Contralor&iacute;a General de la Rep&uacute;blica</option>";
    // echo "<option value='Subsecretaria'>Subsecretaria</option>";
    // echo "<option value='Otros'>Otros</option>";
  echo "</select>";

}

$ti=$_GET["ti"];

?>

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

            <td height="20" colspan="2"><span class="Estilo7">INGRESO DE CARTOLA REGIONAL</span></td>

          </tr>

          <tr>

            <td width="487" valign="top" class="Estilo1">

              <a href="argedo_menudocs.php" class="link">VOLVER</a> <br>

            </td>

          </tr>

          <tr>

            <td></td><td></td>

          </tr>

          <tr>

            <td></td><td></td>

          </tr>

          <tr>

            <td width="487" valign="top" class="Estilo1c">

              <?


              if (isset($_GET["llave"]))

                echo "<p>Registros insertados con Exito !";

              ?>

            </td>

          </tr>

          <tr>

            <td><hr></td><td><hr></td>

          </tr>


          <tr>

            <td height="50" colspan="3">



              <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <form name="form1" action="argedo_grabadocscartola.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">

                  <tr class="Estilo8"><td colspan="2">PASO 1: INGRESO DE DOCUMENTO<td></tr>

                  <tr><td><br></td></tr>

                  <tr>

                    <td width="250px" valign="center" class="Estilo1"> FECHA DE RECEPCI&Oacute;N DE CARTOLA</td>

                    <td class="Estilo1">



                      <input type="text" name="fecha_recepcion" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly>

                <!-- <img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"

                onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" /> -->


                    <script type="text/javascript">//<![CDATA[

                      Calendar.setup({

                        inputField : "f_date_c1",

                        trigger    : "f_trigger_c1",

                        onSelect   : function() { this.hide() },

                        dateFormat : "%d-%m-%Y",

                        max        : <?echo date("Ymd")?>

                      });

                    </script>


                  </td>

                </tr>


                <tr><td><br></td><tr>


                  <tr>

                    <td  valign="center" class="Estilo1"> N&deg; DOCUMENTO </td>

                    <td class="Estilo1" colspan=3>

                      <input type="text" name="numero_doc" class="Estilo2" required>

                    </td>

                  </tr>

                  <tr><td><br></td></tr>

                  <tr>

                    <td  valign="center" class="Estilo1"> TIPO DE DOCUMENTO </td>

                    <td class="Estilo1" colspan=4>

                      <select name="tipodoc" id="tipodoc" class="Estilo1" onChange="tipoReset(this)" required>

                        <option value="" readonly>Seleccione...</option>
                        <option value="Resolucion Exenta">Resoluci&oacute;n Exenta</option>
                        <option value="Ordinario">Ordinario</option>
                        <option value="Circular">Circular</option>
                        <option value="Res. Con Toma">Res. Con Toma</option>
                        <option value="Memorandum">Memor&aacute;ndum</option>
                        <option value="Reservado">Reservado</option>
                        <option value="Carta/Sobre">Carta/Sobre</option>
                        <option value="Cartola">Cartola</option>
                        <option value="Otro">Otro</option>
                      </select>

                    </td>

                  </tr>


                  <tr><td><br></td></tr>

                  <tr>

                    <td  valign="center" class="Estilo1"> REMITE </td>

                    <td class="Estilo1" colspan=4>
                      <?
                      if ($regionsession != 14) {
                        ?>
                        <select name="remitente" id="remitente" class="Estilo1" onChange="mostraInputR(this)" required>
                          <option value="">Seleccione...</option>
                          <option value="Director(a) Regional"> Director(a) Regional </option>
                          <option value="Subdireccion Tecnico Pedagogico"> Subdirecci&oacute;n T&eacute;cnico Pedag&oacute;gico </option>
                          <option value="Subdireccion de Fiscalia y Asesoria Juridica"> Subdirecci&oacute;n de Fiscal&iacute;a y Asesor&iacute;a Jur&iacute;dica </option>
                          <option value="Subdireccion de Calidad y Control Normativo"> Subdirecci&oacute;n de Calidad y Control Normativo </option>
                          <option value="Subdireccion de Planificacion"> Subdirecci&oacute;n de Planificacion </option>
                          <option value="Subdireccion de Recursos Humanos"> Subdirecci&oacute;n de Recursos Humanos </option>
                          <option value="Subdireccion de Recursos Financieros"> Subdirecci&oacute;n de Recursos Financieros </option>
                          <option value="Meta Presidencial"> Meta Presidencial </option>
                          <option value="otro"> OTRO </option>
                        </select>
                        <input id="input_oculto_R" style="display:none;" type="text" name="remitente_b" placeholder="Ingrese Remitente Aqui" size="30">
                        <?
                      } 
                      else {
                        ?>
                        <select name="remitente" id="remitente" class="Estilo1" onChange="mostraInputR(this)" required>
                          <option value="">Seleccione...</option>
                          <option value="VICEPRESIDENTA EJECUTIVA"> VICEPRESIDENTA EJECUTIVA </option>
                          <option value="DEPARTAMENTO DE RECURSOS FINANCIEROS"> DEPARTAMENTO DE RECURSOS FINANCIEROS </option>
                          <option value="DEPARTAMENTO DE RECURSOS HUMANOS"> DEPARTAMENTO DE RECURSOS HUMANOS </option>
                          <option value="DEPARTAMENTO DE FISCALIA Y ASESORIA JURIDICA"> DEPARTAMENTO DE FISCALIA Y ASESORIA JURIDICA </option>
                          <option value="DEPARTAMENTO TECNICO PEDAGOGICO"> DEPARTAMENTO TECNICO PEDAGOGICO </option>
                          <option value="DEPARTAMENTO DE CALIDAD Y CONTROL NORMATIVO"> DEPARTAMENTO DE CALIDAD Y CONTROL NORMATIVO </option>
                          <option value="DEPARTAMENTO DE PLANIFICACION"> DEPARTAMENTO DE PLANIFICACION </option>
                          <option value="DIRECCION REGIONAL METROPOLITANA"> DIRECCION REGIONAL METROPOLITANA </option>
                          <option value="GABINETE"> GABINETE </option>
                          <option value="COMUNICACIONES"> COMUNICACIONES </option>
                          <option value="AUDITORIA INTERNA"> AUDITORIA INTERNA </option>
                          <option value="RELACIONES INTERNACIONALES"> RELACIONES INTERNACIONALES </option>
                          <option value="ATENCION CIUDADANA, PARTICIPACIONES Y RELACIONES GREMIALES"> ATENCION CIUDADANA, PARTICIPACIONES Y RELACIONES GREMIALES </option>
                          <option value="EDITORIAL"> EDITORIAL </option>
                          <option value="PREVENCION DE RIESGOS Y SEGURIDAD"> PREVENCION DE RIESGOS Y SEGURIDAD </option>
                          <option value="UPAB"> UPAB </option>
                          <option value="META PRESIDENCIAL"> META PRESIDENCIAL </option>
                          <option value="TECNOLOGIAS DE LA INFORMACION"> TECNOLOGIAS DE LA INFORMACION </option>
                          <option value="SECCION DESARROLLO CURRICULAR"> SECCION DESARROLLO CURRICULAR </option>
                          <option value="SECCION TRANSVERSALIDAD EDUCATIVA"> SECCION TRANSVERSALIDAD EDUCATIVA </option>
                          <option value="SECCION DE EVALUACION Y PROYECTOS"> SECCION DE EVALUACION Y PROYECTOS </option>
                          <option value="SECCION PROGRAMA DE ALIMENTACION"> SECCION PROGRAMA DE ALIMENTACION </option>
                          <option value="SECCION COMPRAS Y CONTRATACIONES PUBLICAS"> SECCION COMPRAS Y CONTRATACIONES PUBLICAS</option>
                          <option value="SECCION DE ESTUDIOS Y PRONUNCIAMIENTO"> SECCION DE ESTUDIOS Y PRONUNCIAMIENTO</option>
                          <option value="SECCION PROCESOS DISCIPLINARIOS Y JUICIOS"> SECCION PROCESOS DISCIPLINARIOS Y JUICIOS</option>
                          <option value="SECCION TRANSPARENCIA Y LEY DEL LOBBY"> SECCION TRANSPARENCIA Y LEY DEL LOBBY</option>
                          <option value="SECCION DE GESTION DE CALIDAD"> SECCION DE GESTION DE CALIDAD </option>
                          <option value="SECCION DE CONTROL NORMATIVO"> SECCION DE CONTROL NORMATIVO </option>
                          <option value="SECCION TRANSFERENCIA DE FONDOS DE OPERACIONES"> SECCION TRANSFERENCIA DE FONDOS DE OPERACIONES </option>
                          <option value="SECCION DE ESTUDIOS Y DESARROLLO INSTITUCIONAL"> SECCION DE ESTUDIOS Y DESARROLLO INSTITUCIONAL </option>
                          <option value="SECCION CONTROL Y MONITOREO INSTITUCIONAL"> SECCION CONTROL Y MONITOREO INSTITUCIONAL </option>
                          <option value="SECCION INFRAESTRUCTURA Y COBERTURA"> SECCION INFRAESTRUCTURA Y COBERTURA </option>
                          <option value="SERVICIO BIENESTAR"> SERVICIO BIENESTAR </option>
                          <option value="SECCION DE SEGUIMIENTO Y CONTROL INTERNO"> SECCION DE SEGUIMIENTO Y CONTROL INTERNO </option>
                          <option value="SECCION DE ADMINISTRACION DE PERSONAL"> SECCION DE ADMINISTRACION DE PERSONAL </option>
                          <option value="SECCION DE DESARROLLO DE PERSONAS"> SECCION DE DESARROLLO DE PERSONAS </option>
                          <option value="SECCION DE CONTABILIDAD Y FINANZAS"> SECCION DE CONTABILIDAD Y FINANZAS </option>
                          <option value="SECCION DE SEGUIMIENTO Y CONTROL"> SECCION DE SEGUIMIENTO Y CONTROL </option>
                          <option value="SECCION DE LOGISTICA Y ABASTECIMIENTO"> SECCION DE LOGISTICA Y ABASTECIMIENTO </option>
                          <option value="SECCION DE RECURSOS FISICOS"> SECCION DE RECURSOS FISICOS </option>
                          <option value="otro"> OTRO </option>
                        </select>
                        <?
                      }
                      ?>

                      <input id="input_oculto_R" style="display:none;text-transform:uppercase;" type="text" name="remitente_b" placeholder="Ingrese Remitente Aqui" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();" >


                    </td>


                  </tr>

                  <tr><td><br></td></tr>

                  <tr>

                    <td  valign="center" class="Estilo1"> DESTINATARIO </td>

                    <td class="Estilo1" colspan=4>
                      <?
                      if ($regionsession != 14) {
                        ?>
                        <select name="destinatario" id=destinatario class="Estilo1" onChange="mostraInputD(this)">
                          <option value="">Seleccione...</option>
                          <option value="Director(a) Regional">Director(a) Regional</option>
                          <option value="Subdireccion Tecnico Pedagogico">Subdireccion Tecnico Pedagogico</option>
                          <option value="Subdireccion de Fiscalia y Asesoria Juridica">Subdireccion de Fiscalia y Asesoria Juridica</option>
                          <option value="Subdireccion de Calidad y Control Normativo">Subdireccion de Calidad y Control Normativo</option>
                          <option value="Subdireccion de Planificacion">Subdireccion de Planificacion</option>
                          <option value="Subdireccion de Recursos Humanos">Subdireccion de Recursos Humanos</option>
                          <option value="Subdireccion de Recursos Financieros">Subdireccion de Recursos Financieros</option>
                          <option value="Meta Presidencial">Meta Presidencial</option>
                          <option value="otro"> OTRO </option>
                        </select>
                        <input id="input_oculto_D" style="display:none;" type="text" name="destinatario_b" placeholder="Ingrese Destinatario Aqui" size="30">
                        <?
                      } 
                      else {
                        ?>
                        <select name="destinatario" id="destinatario" class="Estilo1" onChange="mostraInputD(this)">
                          <option value="">Seleccione...</option>
                          <option value="VICEPRESIDENTA EJECUTIVA">VICEPRESIDENTA EJECUTIVA</option>
                          <option value="DEPARTAMENTO DE RECURSOS FINANCIEROS">DEPARTAMENTO DE RECURSOS FINANCIEROS</option>
                          <option value="DEPARTAMENTO DE RECURSOS HUMANOS">DEPARTAMENTO DE RECURSOS HUMANOS</option>
                          <option value="DEPARTAMENTO DE FISCALIA Y ASESORIA JURIDICA">DEPARTAMENTO DE FISCALIA Y ASESORIA JURIDICA</option>
                          <option value="DEPARTAMENTO TECNICO PEDAGOGICO">DEPARTAMENTO TECNICO PEDAGOGICO</option>
                          <option value="DEPARTAMENTO DE CALIDAD Y CONTROL NORMATIVO">DEPARTAMENTO DE CALIDAD Y CONTROL NORMATIVO</option>
                          <option value="DEPARTAMENTO DE PLANIFICACION">DEPARTAMENTO DE PLANIFICACION</option>
                          <option value="DIRECCION REGIONAL METROPOLITANA"> DIRECCION REGIONAL METROPOLITANA </option>
                          <option value="GABINETE">GABINETE</option>
                          <option value="COMUNICACIONES">COMUNICACIONES</option>
                          <option value="AUDITORIA INTERNA">AUDITORIA INTERNA</option>
                          <option value="RELACIONES INTERNACIONALES">RELACIONES INTERNACIONALES</option>
                          <option value="ATENCION CIUDADANA, PARTICIPACIONES Y RELACIONES GREMIALES">ATENCION CIUDADANA, PARTICIPACIONES Y RELACIONES GREMIALES</option>
                          <option value="EDITORIAL">EDITORIAL</option>
                          <option value="PREVENCION DE RIESGOS Y SEGURIDAD">PREVENCION DE RIESGOS Y SEGURIDAD</option>
                          <option value="UPAB">UPAB</option>
                          <option value="META PRESIDENCIAL">META PRESIDENCIAL</option>
                          <option value="TECNOLOGIAS DE LA INFORMACION">TECNOLOGIAS DE LA INFORMACION</option>
                          <option value="SECCION DESARROLLO CURRICULAR">SECCION DESARROLLO CURRICULAR</option>
                          <option value="SECCION TRANSVERSALIDAD EDUCATIVA">SECCION TRANSVERSALIDAD EDUCATIVA</option>
                          <option value="SECCION DE EVALUACION Y PROYECTOS">SECCION DE EVALUACION Y PROYECTOS</option>
                          <option value="SECCION PROGRAMA DE ALIMENTACION">SECCION PROGRAMA DE ALIMENTACION</option>
                          <option value="SECCION COMPRAS Y CONTRATACIONES PUBLICAS">SECCION COMPRAS Y CONTRATACIONES PUBLICAS</option>
                          <option value="SECCION DE ESTUDIOS Y PRONUNCIAMIENTO">SECCION DE ESTUDIOS Y PRONUNCIAMIENTO</option>
                          <option value="SECCION PROCESOS DISCIPLINARIOS Y JUICIOS">SECCION PROCESOS DISCIPLINARIOS Y JUICIOS</option>
                          <option value="SECCION TRANSPARENCIA Y LEY DEL LOBBY">SECCION TRANSPARENCIA Y LEY DEL LOBBY</option>
                          <option value="SECCION DE GESTION DE CALIDAD">SECCION DE GESTION DE CALIDAD</option>
                          <option value="SECCION DE CONTROL NORMATIVO">SECCION DE CONTROL NORMATIVO</option>
                          <option value="SECCION TRANSFERENCIA DE FONDOS DE OPERACIONES">SECCION TRANSFERENCIA DE FONDOS DE OPERACIONES</option>
                          <option value="SECCION DE ESTUDIOS Y DESARROLLO INSTITUCIONAL">SECCION DE ESTUDIOS Y DESARROLLO INSTITUCIONAL</option>
                          <option value="SECCION CONTROL Y MONITOREO INSTITUCIONAL">SECCION CONTROL Y MONITOREO INSTITUCIONAL</option>
                          <option value="SECCION INFRAESTRUCTURA Y COBERTURA">SECCION INFRAESTRUCTURA Y COBERTURA</option>
                          <option value="SERVICIO BIENESTAR">SERVICIO BIENESTAR</option>
                          <option value="SECCION DE SEGUIMIENTO Y CONTROL INTERNO">SECCION DE SEGUIMIENTO Y CONTROL INTERNO</option>
                          <option value="SECCION DE ADMINISTRACION DE PERSONAL">SECCION DE ADMINISTRACION DE PERSONAL</option>
                          <option value="SECCION DE DESARROLLO DE PERSONAS">SECCION DE DESARROLLO DE PERSONAS</option>
                          <option value="SECCION DE CONTABILIDAD Y FINANZAS">SECCION DE CONTABILIDAD Y FINANZAS</option>
                          <option value="SECCION DE SEGUIMIENTO Y CONTROL">SECCION DE SEGUIMIENTO Y CONTROL</option>
                          <option value="SECCION DE LOGISTICA Y ABASTECIMIENTO">SECCION DE LOGISTICA Y ABASTECIMIENTO</option>
                          <option value="SECCION DE RECURSOS FISICOS">SECCION DE RECURSOS FISICOS</option>
                          <option value="otro"> OTRO </option>
                        </select>
                        <input id="input_oculto_D" style="display:none;text-transform:uppercase;" type="text" name="destinatario_b" placeholder="Ingrese Destinatario Aqui" size="30" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <?
                      }
                      ?>

                    </td>

                  </tr>

              <!-- <tr><td><br></td><tr>

              <tr>

                <td  valign="center" class="Estilo1"> FECHA DERIVACI&Oacute;N </td>

                <td class="Estilo1">

                
                
                <input type="text" name="fecha_derivacion" class="Estilo2" size="12" value="" id="f_date_c2" readonly="1">

                <img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"

                  onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />


                    <script type="text/javascript">//<![CDATA[

                      Calendar.setup({

                        inputField : "f_date_c2",

                        trigger    : "f_trigger_c2",

                        onSelect   : function() { this.hide() },

                        dateFormat : "%d-%m-%Y"

                      });

                    </script>


                </td>

              </tr> -->


              <!-- <tr><td><br></td></tr>

              <tr>

                <td  valign="center" class="Estilo1"> A </td>

                <td class="Estilo1" colspan=4>

                  <select name="destinatario" class="Estilo1">

                    <option value="">Seleccione...</option>

                    <?

                    $sql4 = "SELECT distinct(opcion) FROM area ORDER BY opcion ASC ";

                    $res4 = mysql_query($sql4);

                    while($row4 = mysql_fetch_array($res4)){

                      ?>

                      <option value="<? echo $row4["opcion"] ?>"><? echo $row4["opcion"] ?></option>

                        <?

                      }

                      ?>
                  </select>

                </td>

              </tr>
            -->           

            <tr><td><br></td></tr>

            <tr>

              <td  valign="top" class="Estilo1" > MATERIA </td>

              <td class="Estilo1" colspan=3>

                <textarea name="materia" rows="3" cols="50" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; " ></textarea>

              </td>

            </tr>

              <!-- <tr><td><br></td></tr>

              <tr>

                <td  valign="top" class="Estilo1" > OBSERVACI&Oacute;N </td>

                <td class="Estilo1" colspan=3>

                  <textarea name="observacion" rows="3" cols="50" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>

                </td>

              </tr>

              <tr><td><br></td></tr>

              <tr>

                <td  valign="top" class="Estilo1" > EN TRAMITE </td>

                <td class="Estilo1" colspan=3>

                  <input type="checkbox" name="tramite" value="1" checked>

                </td>

              </tr> -->
              <!--
              <tr>

                <td  valign="center" class="Estilo1" > Orden de tranporte </td>

                <td class="Estilo1" colspan=3><br>

                  <input type="text" name="otransporte" class="Estilo2" size="11" >

                </td>

              </tr>
            -->

            <tr><td><br></td></tr>
            <tr><td><br></td></tr>

            <tr>

              <tr>

                <td colspan=4 align="center"> <input type="submit" value="    GRABAR    " > </td>

              </tr>




            </form>



          </td>

        </tr>
        

        <tr>

          <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

        </tr>
        <!--</tr></tr></td></td></tr></form>-->
      </table>



      <br>









      <form name="form2" action="argedo_grabaasignaguia4.php" method="post" onsubmit="return validaGeneraguia()" >

        <table border="0" width="100%">

          <tr class="Estilo8">PASO 2: CONFECCI&Oacute;N GU&Iacute;A DESPACHO INTERNO<br></tr> 

          <tr><td><br></td></tr>

          <tr>

            <td  valign="center" class="Estilo1"> REGI&Oacute;N DE DESTINO </td>

            <td class="Estilo1" colspan=6>

              <select name="destinatario2" class="Estilo1" required>
                <option value="">Seleccione...</option>
                <?
                $sqlReg="SELECT * FROM regiones";
                $resReg=mysql_query($sqlReg);

                while ($rowReg = mysql_fetch_array($resReg)) {
                  $nombreRegion =$rowReg["nombre"];
                  $ordenRegion =$rowReg["orden"];
                  ?>
                  <option value="<? echo $ordenRegion ?>"><? echo $nombreRegion ?></option>
                  <?
                }
                ?>
              </select>

            </td>



          </tr>

          <tr><td><br></td></tr>

          <tr>

            <td  valign="center" class="Estilo1"> ORDEN DE TRANSPORTE </td>

            <td class="Estilo1" colspan=3>

              <input type="text" name="otransporte" class="Estilo2" required>

            </td>


          </tr>

          <tr><td><br></td></tr>

          <tr>

            <td  valign="top" class="Estilo1" > OBSERVACI&Oacute;N </td>

            <td class="Estilo1" colspan=3>

              <textarea name="observacion" rows="3" cols="50" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; " required></textarea>

            </td>

          </tr>

          <tr><td><br></td></tr>

        </table>

        <table border="1" width="100%">




          <P class="Estilo1">SELECCIONE DOCUMENTO(S)</P>

          <tr>

            <td class="Estilo1b">&Iacute;TEM</td>

            <td class="Estilo1b">FECHA RECEPCI&Oacute;N</td>

            <td class="Estilo1b">TIPO DOCUMENTO</td>

            <td class="Estilo1b">N&deg; DOCUMENTO</td>

            <td class="Estilo1b">REMITENTE</td>

            <td class="Estilo1b">DESTINATARIO</td>

            <td class="Estilo1b">MATERIA</td>

            <td class="Estilo1b">ELIMINAR</td>

          </tr>


          <?
          if ($regionsession==0) {

            $sql="SELECT * FROM argedo_doc_internos WHERE inte_estado=2 AND inte_numguia=0 ORDER BY inte_fecha_ing DESC";

          } else {

            $sql="SELECT * FROM argedo_doc_internos WHERE inte_region ='$regionsession' AND inte_estado=2 AND inte_numguia=0 ORDER BY inte_fecha_ing DESC";

          }


                  //echo $sql;

          $res3 = mysql_query($sql);

          $cont=1;
          $cont_b=1;



          while($row3 = mysql_fetch_array($res3)){
            $inte_id =$row3["inte_id"];
            $inte_fecha_recepcion =$row3["inte_fecha_recepcion"]; 
            $inte_tipo_doc =$row3["inte_tipo_doc"]; 
            $inte_num_doc =$row3["inte_num_doc"];
            $inte_remitente =$row3["inte_remitente"];
            $inte_destinatario =$row3["inte_destinatario"];
            $inte_materia =$row3["inte_materia"];
            $inte_ord_transporte =$row3["inte_ord_transporte"];
            ?>

            <tr>

              <td class="Estilo1b">
                <input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $inte_id ?>" class="Estilo2" > 
                <input type="hidden" name="var_b[<? echo $cont_b ?>]" value="<? echo $inte_tipo_doc ?>">
              </td>

              <td class="Estilo1b"> <? echo $inte_fecha_recepcion  ?> </td>

              <td class="Estilo1b"> <? echo $inte_tipo_doc  ?> </td>

              <td class="Estilo1b"> <? echo $inte_num_doc   ?></td>

              <td class="Estilo1b"> <? echo $inte_remitente  ?> </td>

              <td class="Estilo1b"> <? echo $inte_destinatario  ?> </td>

              <td class="Estilo1b"> <? echo $inte_materia  ?> </td>

              <td class="Estilo1b"><a href="argedo_eliminadocscartola.php?id=<?php echo $inte_id ?>"><img src="imagenes/b_drop.png" alt="Eliminar" onclick="return confirm('¿ESTÁ SEGURO DE ELIMINAR EL DOCUMENTO?')"></a></td>

            </tr>

            <?



            $cont++;
            $cont_b++;


          }

          ?>

          <tr>

            <td valign="center" class="Estilo1" colspan="8" align="center"><input type="submit" name="boton" class="Estilo2" value="  Generar Gu&iacute;a "> </td>


            <input type="hidden" name="cont2" value="<? echo $cont ?>" >

            <input type="hidden" name="sw2" value="1" >

          </form>

        </tr>

      </table>
      <br><br>

      <form action="argedo_cartolaregional.php" method="POST">
        <table width="100%" border="1">
          <tr align="center">
            <td class="Estilo8" colspan="4">BUSCADOR DE GUIAS INTERNAS</td>
          </tr>

          <tr>
            <td class="Estilo1b">FECHA DESDE</td>
            <td class="Estilo1">
              <input type="text" name="carto_fecha_desde" id="carto_fecha_desde" value="<?php echo $_POST["carto_fecha_desde"] ?>" readonly style="background: #E3E3E3">
              <i class="fa fa-calendar fa-lg" id="f_trigger_b" style="cursor: pointer;"></i>
              <script type="text/javascript">
                Calendar.setup({
                  inputField   :  "carto_fecha_desde",
                  trigger     :  "f_trigger_b",
              onSelect   : function() { this.hide() }, //NUEVO
              dateFormat    :  "%Y-%m-%d",
              max : <?php echo date("Ymd") ?>,
              showTime   : 12,
            });
          </script>
        </td>
        <td class="Estilo1b">FECHA HASTA</td>
        <td class="Estilo1">
          <input type="text" name="carto_fecha_hasta" id="carto_fecha_hasta" value="<?php echo $_POST["carto_fecha_hasta"] ?>" readonly style="background: #E3E3E3">
          <i class="fa fa-calendar fa-lg" id="f_trigger_c" style="cursor: pointer;"></i>
          <script type="text/javascript">
            Calendar.setup({
              inputField   :  "carto_fecha_hasta",
              trigger     :  "f_trigger_c",
              onSelect   : function() { this.hide() }, //NUEVO
              dateFormat    :  "%Y-%m-%d",
              max : <?php echo date("Ymd") ?>,
              showTime   : 12,
            });
          </script>
        </td>
      </tr>



      <tr>
        <td class="Estilo1b">FOLIO DESDE</td>
        <td class="Estilo1"><input type="number" name="carto_folio_desde" value="<?php echo $_POST["carto_folio_desde"] ?>"></td>
        <td class="Estilo1b">FOLIO HASTA</td>
        <td class="Estilo1"><input type="number" name="carto_folio_hasta" value="<?php echo $_POST["carto_folio_hasta"] ?>"></td>
      </tr>

      <tr>

      <td class="Estilo1b"> REGI&Oacute;N DE DESTINO </td>

        <td class="Estilo1">

          <select name="carto_region_destino" class="Estilo1">
            <option value="">Seleccione...</option>
            <?
            $sqlReg="SELECT * FROM regiones";
            $resReg=mysql_query($sqlReg);

            while ($rowReg = mysql_fetch_array($resReg)) {
              $nombreRegion =$rowReg["nombre"];
              $ordenRegion =$rowReg["orden"];
              ?>
              <option value="<? echo $ordenRegion ?>" <?php if($_POST["carto_region_destino"] == $ordenRegion){echo"selected";} ?>><? echo $nombreRegion ?></option>
              <?
            }
            ?>
          </select>

        </td>
        <td  valign="center" class="Estilo1b"> ORDEN DE TRANSPORTE </td>

        <td class="Estilo1">

          <input type="text" name="carto_orden_transporte" class="Estilo2" value="<?php echo $_POST["carto_orden_transporte"] ?>">

        </td>


      </tr>

      <tr>
        <td colspan="4" align="center">
          <button type="submit" name="cartola" value="1" class="btn btn-xs btn-primary">BUSCAR</button>
          <a href="argedo_cartolaregional.php" class="btn btn-xs btn-danger">LIMPIAR</a>
        </td>
      </tr>
    </table>
  </form>

  <table border=1>

    <tr></tr>


    <br>

    <tr class="Estilo8">PASO 3: IMPRIMIR GU&Iacute;A DESPACHO INTERNO</tr> <br><br>

    <tr>

      <td class="Estilo1b">N&deg; GU&Iacute;A</td>

      <td class="Estilo1b">REGI&Oacute;N DE DESTINO</td>

      <td class="Estilo1b">ORDEN DE TRANSPORTE</td>

      <td class="Estilo1b">FECHA GU&Iacute;A</td>

      <td class="Estilo1b">VER GU&Iacute;A</td>

    </tr>

    <?
//  $sql="select * from argedo_despachada where despa_estado=1 and despa_folioguia=0 and despa_defensoria ='$regionsession' order by despa_folio desc";
    if(isset($_POST) && $_POST["cartola"])
    {
      $where = "";
      if($_POST["carto_fecha_desde"] <> "")
      {
        $where.="inte_fechaguia >= '".$_POST["carto_fecha_desde"]."' AND ";
      }

      if($_POST["carto_fecha_hasta"] <> "")
      {
        $where.="inte_fechaguia <= '".$_POST["carto_fecha_hasta"]."' AND ";
      }

      if($_POST["carto_folio_desde"] <> "")
      {
        $where.="inte_numguia >= '".$_POST["carto_folio_desde"]."' AND ";
      }

      if($_POST["carto_folio_hasta"] <> "")
      {
        $where.="inte_numguia <= '".$_POST["carto_folio_hasta"]."' AND ";
      }

      if($_POST["carto_region_destino"] <> "")
      {
        $where.="inte_destinatario2 = ".$_POST["carto_region_destino"]." AND ";
      }

      if($_POST["carto_orden_transporte"] <> "")
      {
        $where.="inte_ord_transporte LIKE '%".$_POST["carto_orden_transporte"]."%' AND ";
      }


      $sql="SELECT * FROM argedo_doc_internos WHERE inte_region='$regionsession' AND inte_numguia<>0 AND $where inte_estado='2' GROUP BY inte_numguia ORDER BY inte_numguia DESC";
    }else{
      $sql="SELECT * FROM argedo_doc_internos WHERE inte_region='$regionsession' AND inte_numguia<>0 AND inte_estado='2' GROUP BY inte_numguia ORDER BY inte_numguia DESC LIMIT 0 , 10 ";
    }

// echo $sql;

    $res3 = mysql_query($sql);

    $cont=1;



    while($row3 = mysql_fetch_array($res3)){

      $regionDestino=$row3["inte_destinatario2"];

                        /*$fechahoy = $date_in;

                        $dia1 = strtotime($fechahoy);

                        $fechabase =$row3["eta_fecha_recepcion"];

                        $dia2 = strtotime($fechabase);

                        $diff=$dia1-$dia2;

                        $diff=intval($diff/(60*60*24));

                        if ($etapa1a>=$diff)

                          $clase="Estilo1cverde";

                        if ($etapa1a<$diff and $etapa1b>=$diff )

                          $clase="Estilo1camarrillo";

                        if ( $etapa1b<$diff)

                        $clase="Estilo1crojo";*/



                        ?>





                        <tr>

                         <td class="Estilo1b"><? echo $row3["inte_numguia"] ?> </td>

                         <td class="Estilo1b" title="<? echo $row3["inte_destinatario2"]  ?>">
                          <? 
                          
                          $sql6="SELECT nombre FROM regiones WHERE orden='$regionDestino'";
                          $res6=mysql_query($sql6);
                          while($row6 = mysql_fetch_array($res6)){ $regionDestino2=$row6["nombre"]; }

                          echo $regionDestino2  

                          ?>

                        </td>

                        <td class="Estilo1b" title="<? echo $row3["inte_ord_transporte"]  ?>"><? echo $row3["inte_ord_transporte"]  ?></td>

                        <td class="Estilo1b" title="<? echo $row3["inte_fechaguia"]  ?>"><? echo $row3["inte_fechaguia"]  ?></td>

                        <td class="Estilo1c"><a href="argedo_imprimirguia4.php?guia=<? echo $row3["inte_numguia"] ?>" class="link" target="_blank">IMPRIMIR</a></td>



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

