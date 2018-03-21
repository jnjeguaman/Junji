<?

session_start();

require("inc/config.php");

$fechamia=date('Y-m-d');

$fechamia2=date('d-m-Y');

$idusuario=$_SESSION["pfl_id"];

$usuario=$_SESSION["nom_user"];

$deptosession=$_SESSION["depto"];

$deptonom=$_SESSION["deptonom"];

$date_in=date("d-m-Y");





extract($_POST);

extract($_GET);

$nombre=strtoupper($nombre);

$paterno=strtoupper($paterno);

$materno=strtoupper($materno);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<head>

  <script language="JavaScript" type="text/javascript" src="ajax4.js"></script>







  <title>Asignaciones</title>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>




  <link href="assets/css/main.css" rel="stylesheet">



  <script src="librerias/js/jscal2.js"></script>

  <script src="librerias/js/lang/es.js"></script>

  <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />

  <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />

  <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />











  <style type="text/css">

    body {

      padding-top: 60px;

    }
        .Estilo1b {

      font-family: Verdana;

      font-weight: bold;

      font-size: 8px;

      color: #003063;

      text-align: center;





    }
            .Estilo1b2 {

      font-family: Verdana;

      font-weight: bold;

      font-size: 16px;

      color: #003063;

      text-align: center;





    }

    .Estilo1c {

      font-family: Verdana;

      font-weight: bold;

      font-size: 9px;

      color: #003063;

      text-align: left;

      text-transform: uppercase;

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

  </style>





  <script>



    <!--

    function nuevoAjax()

    {

  /* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por

  lo que se puede copiar tal como esta aqui */

  var xmlhttp=false;

  try

  {

    // Creacion del objeto AJAX para navegadores no IE

    xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");

  }

  catch(e)

  {

    try

    {

      // Creacion del objet AJAX para IE

      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

    }

    catch(E) { xmlhttp=false; }

  }

  if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }



  return xmlhttp;

}





function cerrarse(){

 window.close()

}

function cierre2(a,b,c){

//   alert("--"+b);

opener.document.formmodi.nombre.value=a;

opener.document.formmodi.rut.value=b;

opener.document.formmodi.grado.value=c;

//   opener.document.form112.numdefensoria.value=b;

//   opener.document.form2.submit();

//   opener.document.form1.idargedo.value=id;

//   opener.document.form1.fecha4.value=fecha;

//   opener.document.getElementById("linkarchivo").href+="../../archivos/docargedo/"+archivo;

//   opener.document.getElementById('verlink').innerHTML=archivo;

window.close();

//alert('cerrando');

}

function cierre2b(){





 opener.document.formmodi.destinatario.value=document.formdestinatario.destino22.value;

//   opener.document.formmodi.destinatario.value=2222;

opener.document.formmodi.numdefensoria.value='1111';

window.close();



}



function mostrar() {

 seccion1.style.display="";

 document.form1.boton11.style.display="none";

 document.form1.boton22.style.display="";



}

function ocultar() {

 seccion1.style.display="none";

 document.form1.boton11.style.display="";

 document.form1.boton22.style.display="none";

}

function avisa() {

  alert("avisa");

  cierre2('A');

}





function verificador(a,b,c) {

//var rut1 = document.form1.rut.value;

//var dig1 = document.form1.dig.value;



//var rut2 = document.form1.rut2.value;

//var dig2 = document.form1.dig2.value;



var rut = a;

var dig = b;





//alert(rut+" "+dig);

var count = 0;

var count2 = 0;

var factor = 2;

var suma = 0;

var sum = 0;

var digito = 0;

count2 = rut.length - 1;

while(count < rut.length) {



  sum = factor * (parseInt(rut.substr(count2,1)));

  suma = suma + sum;

  sum = 0;



  count = count + 1;

  count2 = count2 - 1;

  factor = factor + 1;



  if(factor > 7) {

   factor=2;

 }



}

digito = 11 - (suma % 11);

digito2 = 11 - (suma % 11);



if (digito == 11) {

  digito = 0;

  digito2 = 0;

}

if (digito == 10) {

  digito = "k";

  digito2 = "K";

}

if (dig!=digito && dig!=digito2) {

  alert('Rut incorrecto, es  '+digito);

  document.form1["dig"+c+""].value='';

  document.form1["dig"+c+""].focus();

//  document.form1.dig.value='';

//  document.form1.dig.focus();

} else {

  if (rut!='') {

    traerDatos(rut,c);

  }

  if (rut!='' && 1==2) {

    traerDatos2(rut);

  }



//  alert('estoy en el else');

//  llamado();



}

//form.dig.value = digito;

}



function traerDatos(tipoDato,c)  {

  var ajax=nuevoAjax();

  ajax.open("POST", "buscaclient.php", true);

  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  ajax.send("d="+tipoDato);

  ajax.onreadystatechange=function()  {

    if (ajax.readyState==4) {

      // Respuesta recibida. Coloco el texto plano en la capa correspondiente

      //capa.innerHTML=ajax.responseText;

      var Date =ajax.responseText;

      var elem = Date.split('/');

//            var c= document.form22["var["+b+"]"].checked;

//            alert(elem[0]);

document.form1["nombre"+c+""].value=elem[0];

//            document.form1.nombre1.value=elem[0];

if (c==222) {

  document.form1.calidad222.value=elem[4];

  document.form1.estamento222.value=elem[5];

  document.form1.grado222.value=elem[6];

  document.form1.cargo222.value=elem[7];

  document.form1.region222.value=elem[8];

  document.form1.unidad222.value=elem[9];

}





}

}

}



function BorraAjax(a) {

// alert("borrar"+a);

var ajax=nuevoAjax();

// alert("borrar 2 "+a);

ajax.open("POST", "argedo_borrarfuncionario.php", true);

ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

ajax.send("id="+a);

ajax.onreadystatechange=function()  {

  if (ajax.readyState==4) {

      // Respuesta recibida. Coloco el texto plano en la capa correspondiente

      //capa.innerHTML=ajax.responseText;

      b=ajax.responseText;

//   alert("borrado "+b);

//            document.getElementById(b).innerHTML = ajax.responseText;

//            document.form1["var6["+a+"]"].value=ajax.responseText;

//          document.getElementById(c).value =ajax.responseText;

//          document.getElementById(c).value =0;







}

}

}





-->

</script>

<script src="argedo_lista.js"></script>





<?

if ($nombre<>'' and $rut<>'' ) {

//if ($id<>'' and $id<>'1' ) {

//if ($id<>'' and $id<>'1' and  1==2) {



  //consulta todos los empleados



 $sql4="update dpp_proveedores set provee_unidad='$deptonom', provee_unidadnum='$deptosession' where provee_id=$id ";

 $res2 = mysql_query($sql4);

//   echo $sql4;

//   exit();

 echo "<script>cierre2('".$nombre."','".$rut."','".$grado."')</script>";

//    echo "<script>avisa()</script>";

}





$sw=1;

?>









</head>



<body>



  <div class="framemail">

   <div  class="window text-center">

    <p class="sender Estilo1b2">ASIGNADO</p> </td>

  </div>
<br>
  <center>
  
  <a href="#" data-target="#myModal"  data-toggle="modal" class="btn btn-sm btn-danger">Crear Funcionario</a>
  <button type="button" onclick="cerrarse();" class="btn btn-sm btn-default">Cerrar Ventana</button>

  </center>
  <br><br>

<form name="form1" action="argedo_grabaagregafuncionario.php" method="post">



 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="">

   <tr>

     <td  valign="center" class="Estilo1c"><br>RUT FUNCIONARIO 1</td>

     <td><input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar(2)" >-<input type="text" name="dig" class="Estilo2" size="1" onChange="verificador(document.form1.rut.value,document.form1.dig.value,1)">  </td>

   </tr>

   <tr>

     <td  valign="center" class="Estilo1c"><br>NOMBRE FUNCIONARIO 1</td>

     <td><input type="text" name="nombre1" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" ></td>

   </tr>

   <tr>

     <td  valign="center" class="Estilo1c"><br>FECHA INICIO</td>

     <td class="Estilo1" colspan=1>

        <input type="text" name="fechaini1a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1a" >

        <img src="calendario.gif" id="f_trigger_c1a" style="cursor: pointer; border: 1px solid red;" title="Date selector"

        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



          <script type="text/javascript">//<![CDATA[

            Calendar.setup({

              inputField : "f_date_c1a",

              trigger    : "f_trigger_c1a",

              onSelect   : function() { this.hide() },

              showTime   : 12,

              dateFormat : "%d-%m-%Y"

            });

          </script>

       </td>

   </tr>
   
   <tr>

     <td  valign="center" class="Estilo1c"><br>FECHA TÉRMINO</td>

     <td class="Estilo1" colspan=3>

        <input type="text" name="fechater1b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1b" >

        <img src="calendario.gif" id="f_trigger_c1b" style="cursor: pointer; border: 1px solid red;" title="Date selector"

        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



        <script type="text/javascript">//<![CDATA[

          Calendar.setup({

            inputField : "f_date_c1b",

            trigger    : "f_trigger_c1b",

            onSelect   : function() { this.hide() },

            showTime   : 12,

            dateFormat : "%d-%m-%Y"

          });

        </script>


     </td>

   </tr>

   <tr>

   <tr>

      <td colspan="2" class="text-center">

       <button type="submit" class="btn btn-primary">agregar</button>

      </td>

   </tr>

 <input type="hidden" name="calidad" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >

 <input type="hidden" name="estamento" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >

</tr>



</table>

</form>



<br>

<div  id="resultado">

 <?php //include('argedo_listafuncionario.php');?>

</div>









</div>

</body>

</html>

<html>

<title>Refresca un div tag sin necesidad de refrescar toda la pagina</title>

<head>

  <script src="ajax.js"></script>

</head>

<body>



  <div id="contenido">

    <h3>Refrescar una div tag con Ajax</h3>

    // Aqui el Div en el que se coloca el contenido de Tiempo.php

    <div name="timediv" id="timediv">

    </div>

  </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">AGREGAR NUEVO FUNCIONARIO</h4>
        </div>
        <div class="modal-body">
          <!-- FORMULARIO !-->
          <form class="form-horizontal" id="frmNuevoFuncionario" action="argedo_grabafuncionario.php" onsubmit="return valida()" method="POST">
            
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Rut Funcionario</label>
              <div class="col-sm-5">
                <input type="text" name="rut" class="form-control" id="inputEmail3" placeholder="11111111-1">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Primer Nombre</label>
              <div class="col-sm-5">
                <input type="text" name="p_nombre" class="form-control" id="inputEmail3" placeholder="Primer Nombre">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Segundo Nombre</label>
              <div class="col-sm-5">
                <input type="text" name="s_nombre" class="form-control" id="inputEmail3" placeholder="Segundo Nombre">
              </div>
            </div>


            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Apellido Paterno</label>
              <div class="col-sm-5">
                <input type="text" name="apaterno" class="form-control" id="inputEmail3" placeholder="Apellido Paterno">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Apellido Materno</label>
              <div class="col-sm-5">
                <input type="text" name="amaterno" class="form-control" id="inputEmail3" placeholder="Apellido Materno">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" name="email" class="col-sm-4 control-label">Correo Electrónico</label>
              <div class="col-sm-5">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Correo Electrónico">
              </div>
            </div>

            <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Crear</button>
        </div>
          </form>
          <!-- FIN FORMULARIO !-->
        </div>
        
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function valida()
    {
      return true;
    }
  </script>
</body>

</html>





