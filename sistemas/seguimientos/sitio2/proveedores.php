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

?>

<html>

<head>

  <title>Facturas y/o Boletas</title>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
  <!-- <link rel="stylesheet" href="../../bootstrap/font/ionicons.min.css"> -->
  <!-- <link rel="stylesheet" href="../../bootstrap/dist/css/AdminLTE.min.css"> -->
    <!-- <link rel="stylesheet" href="../../../bootstrap/dist/css/skins/_all-skins.min.css"> -->
  <script src="librerias/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="librerias/js/jscal2.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="librerias/js/css/jscal2.css" /> -->
    <script src="librerias/js/lang/es.js"></script>
  <link href="css/estilos.css" rel="stylesheet" type="text/css">
  <script src="../../inventario/privado/sitio2/librerias/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.min.css">

  <script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>

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

    function limpiar() {

      document.form1.dig.value="";

    }

    function verificador() {

      var rut = document.form1.rut.value;

      var dig = document.form1.dig.value;

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

      document.form1.dig.value=''

      document.form1.dig.focus();

    } else {
      var data = ({cmd:"valp",rut:rut});
      $.ajax({
        type:"POST",
        url:"valp.php",
        data:data,
        dataType:"JSON",
        success : function(response)
        {
          if(response == 1)
          {
            alert("EL PROVEEDOR CON EL RUT " + rut + " YA SE ENCUENTRA REGISTRADO");
            traerDatos(rut);
            $("#rut").val("");
            $("#rut").focus();
          }else{

          }
        }
      });
//  alert('estoy en el else');

//  llamado();



}

//form.dig.value = digito;

}



function llamado() {

  alert('llamando al un alerta de otra funcion');

}



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



function traerDatos(tipoDato)  {

  var ajax=nuevoAjax();

//    alert (" dato "+tipoDato);

ajax.open("POST", "buscaclient.php", true);

ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

ajax.send("d="+tipoDato);



ajax.onreadystatechange=function()  {

  if (ajax.readyState==4) {

      // Respuesta recibida. Coloco el texto plano en la capa correspondiente

      //capa.innerHTML=ajax.responseText;

      document.form1.nombre.value=ajax.responseText;

      nombre2.innerText=ajax.responseText;



    }

  }

}



function traerDatos2()  {

  var ajax=nuevoAjax();

  tipoDato1=document.form1.numero.value;

  tipoDato2=document.form1.rut.value;

  rut=document.form1.rut.value;

    //alert (" dato "+c);

    ajax.open("POST", "buscaclient2.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  //ajax.send("d="+tipoDato,"e="+rut);

  ajax.send("d="+tipoDato1+"&e="+tipoDato2);



  ajax.onreadystatechange=function()  {

    if (ajax.readyState==4) {

      // Respuesta recibida. Coloco el texto plano en la capa correspondiente

      //capa.innerHTML=ajax.responseText;

      //b=ajax.responseText;

      if (ajax.responseText == 1) {

               //  alert (" No Existe "+b);

             }

             if (ajax.responseText == 0) {

              alert ("Numero de Boleta Existe Para esta proveedor ");

              document.form1.numero.value=ajax.responseText;

//                    document.getElementById(c).value =ajax.responseText;

//                    document.getElementById(c).value =0;



}



}

}



}



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



function aparece1(){

 seccion1.style.display="none";

 seccion2.style.display="";

}

function aparece2(){

 seccion1.style.display="";

 seccion2.style.display="none";

}



function valida() {



 if (document.form1.rut.value.length==0 || document.form1.rut.value=='') {

  alert ("Rut presenta problemas ");

  return false;

}


if (document.form1.dig.value=='' || document.form1.dig.length==0) {

  alert ("Dig presenta problemas ");

  return false;

}

if(document.form1.tipo[0].checked=='' && document.form1.tipo[1].checked == '')
{
  alert("Seleccione un tipo");
  return false;
}

if($("#seccion1").css("display") == "none")
{
  if (document.form1.nombren.value=='') {
    alert ("Nombre presenta problemas ");
    return false;
  }

  if (document.form1.paterno.value=='') {
    alert ("Apellido paterno problemas ");
    return false;
  }

  if (document.form1.materno.value=='') {
    alert ("Apellido materno problemas ");
    return false;
  }
}else{
  if(document.form1.nombrej.value=='')
  {
    alert("Razon social presenta problemas");
    return false;
  }
  // if(document.form1.emailj.value=='')
  // {
  //   alert("Correo electronico presenta problemas");
  //   return false;
  // }
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

if (document.form1.tipodoc[0].checked=='' && document.form1.tipodoc[1].checked==''  && document.form1.tipodoc[2].checked=='') {

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

    <div class="col-sm-2 col-lg-2">

      <div class="dash-unit2">



        <?

        require("inc/menu_1.php");

        ?>



      </div>

    </div>



    <div class="col-sm-10 col-lg-10">
     <div class="dash-unit2">

      <ul class="nav nav-tabs" role="tablist" >
                <li role="presentation" class="active"><a  href="#crear" aria-controls="crear" onclick="ususase()" role="tab" data-toggle="tab">Crear Proveedor</a></li>
                <li role="presentation" ><a href="#buscar" onclick="ususcon()" aria-controls="buscar" role="tab" data-toggle="tab">Buscar Proveedor</a></li>
                </ul>
      <div id="crear" style="display: block;"> 
      <div class="row">
<div class="col-sm-6 col-md-12">
    <div class="thumbnail">
      <div class="caption">
      <div class="col-md-12">
          <span>INGRESO DE PROVEEDORES Y FUNCIONARIOS</span>
      </div>
          <?
          if (isset($_GET["llave"]))

           echo "<p>Registros insertados con Exito !";

         ?>

        <form name="form1" action="grabaproveedores.php" method="post"  onSubmit="return valida()">
          
        <div class="col-md-12">
        <br>
        
        <div class="col-md-2">
           Rut
        </div>
        <div class="col-md-4">
            <input type="text" name="rut" id="rut" class="form-control" onchange="limpiar()" maxlength="8" onkeypress="return justNumbers(event);">
        </div>
        <div class="col-md-1">
            <input type="text" name="dig" class="form-control" onChange="verificador()" maxlength="1">
        </div>
            <br>
            </br> 
        </div>
        <div class="col-md-12">
        <div class="col-md-2">
    Correo electrónico
    </div>
        <div class="col-md-5">
      <input type="email" name="emailj" class="form-control" size="40" >
      </div>
      <br></br>
      </div>

        <div class="col-md-12">
      <br>
        <div class="col-md-2">
        Tipo
        </div>
        <div class="col-md-3">
      <input type="radio" name="tipo" value="1" onclick="aparece1();">Persona Natural
      </div>
      <div class="col-md-3">
      <input type="radio" name="tipo" value="2" onclick="aparece2();">Personalidad Juridica
      </div>
      <br></br>
      </div>

 <div id="seccion1" style="display:none">
        <div class="col-md-12">
        <div class="col-md-2">
    Razon Social
    </div>
        <div class="col-md-5">
      <input type="text" name="nombrej" class="form-control" size="40" >
   <br></br>
   </div>
   </div>
</div>



<div id="seccion2" style="display:none">
    <div class="col-md-12">
    <div class="col-md-2">
   Nombre
   </div>
   <div class="col-md-5">
    <input type="text" name="nombren" class="form-control">
    </div>
      <br></br>
    </div>

    <div class="col-md-12">
    <div class="col-md-2">
    Ap.Paterno
    </div>
    <div class="col-md-5">
  <input type="text" name="paterno" class="form-control">
  </div>
      <br></br>
      </div>
      <div class="col-md-12">
      <div class="col-md-2">
 Ap. Materno
 </div>
 <div class="col-md-5">
  <input type="text" name="materno" class="form-control" size="40" >
  </div>
      <br>
      </div>
</div>
   <input type="submit" value="    GRABAR PROVEEDOR    " class="btn btn-success" style="text-align: center;"> 
</form>

</div>
</div>
</div>
</div>
</div>



<div id="buscar" style="display: none">
<div class="row">
<div class="col-sm-6 col-md-12">
    <div class="thumbnail">
      <div class="caption">
<span class="Estilo7">BUSCAR PROVEEDOR</span>

  <form name="form5">
  <br>
  <div class="col-md-12">
  <div class="col-md-2">
  Rut :
  </div>
  <div class="col-md-4">
    <input type="text" name="rut" class="form-control" size="11" maxlength="8" onkeypress="return justNumbers(event);">
  </div>
  <div class="col-md-1"> 
    <input type="text" name="dig" class="form-control" size="2" maxlength="1">
    </div>
  </div>
    <input type="text" name="test" hidden="hidden">
  </form>
    <a data-toggle='modal' onclick="mostrarDatos()" href='#myModal'><button class="btn btn-success" value="BUSCAR">BUSCAR</button></a>
</div>
</div>
</div>

</div>
</div>

</div>
</div>

<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="col-md-12">
                                 <div id="contedifoEditar"></div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div>
                        </div>
                    </div>

<script type="text/javascript">
function mostrarDatos(){
                    var rut = document.form5.rut.value;
                    var ajax=nuevoAjax();

                    ajax.open("POST", "buscarProveedor.php", true);

                    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    ajax.send("rut="+rut);

                    ajax.onreadystatechange=function()  {

                      if (ajax.readyState==4) {
                        $("#contedifoEditar").empty();
                        document.form5.test.value=ajax.responseText;
                        var Date = document.form5.test.value;
                        var elem = Date.split('/');
                        if (elem != "Proveedor No Existe") {
                        var hola = '<span class="Estilo7">DATOS DEL PROVEEDOR</span><form name="form1" action="editarProveedor.php" method="post"><br><br><div class="col-md-12"><div class="col-md-4">Nombre </div><div class="col-md-12"><input type="text" name="nom" class="form-control" size="40" value="'+elem[2]+'"><br></div></div>';
                        if (elem[7] == 1) {
                          hola += '<div class="col-md-12"><div class="col-md-4">Ap.Paterno</div><div class="col-md-12"><input type="text" name="paterno" class="form-control" size="30" value="'+elem[0]+'"><br></div></div><div class="col-md-12"><div class="col-md-4">Ap.Materno </div><div class="col-md-12"><input type="text" name="materno" class="form-control" size="30" value="'+elem[1]+'"><br></div><div>';
                        }
                        if (elem[7] == "") {
                          hola+= '<div class="col-md-12"><div class="col-md-4">Razon Social </div><div class="col-md-12"><input type="text" name="rs" class="form-control" size="30" value="'+elem[5]+'"><br></div><div>';
                        }
                        hola+='<div class="col-md-12"><div class="col-md-4">Direcci<?="&oacute"?>n </div><div class="col-md-12"><input type="text" name="dir" class="form-control" size="30" value="'+elem[3]+'"><br></div></div><div class="col-md-12"><div class="col-md-4">Tel<?="&eacute"?>fono </div><div class="col-md-12"><input type="text" name="tel" class="form-control" size="15" value="'+elem[4]+'"><br></div></div><div class="col-md-12"><div class="col-md-4">Correo </div><div class="col-md-12"><input type="email" name="correo" class="form-control" size="20" value="'+elem[6]+'"><br></div></div><input type="text" name="id" hidden="hidden" value="'+elem[8]+'"><br></br><div class="col-md-12" style="text-align:center"><br><input type="submit" value="EDITAR" class="btn btn-success"></div></form>';

                        $("#contedifoEditar").append(hola);
                      }else{
                        $("#contedifoEditar").append("Proveedor No Existe");
                      }
                      } 

                    }
                    }

  function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }
  function ususase(sel) {
    document.getElementById("crear").style.display="block";
    document.getElementById("buscar").style.display="none";
}

function ususcon(sel) {
    document.getElementById("crear").style.display="none";
    document.getElementById("buscar").style.display="block";

}
</script>

 <img src="images/pix.gif" width="1" height="10">

</body>

</html>


<?



?>
