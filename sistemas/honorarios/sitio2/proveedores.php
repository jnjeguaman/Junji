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

<link href="../../seguimientos/sitio2/librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="../../seguimientos/sitio2/librerias/bootstrap/js/bootstrap.min.js"></script>

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

  traerDatos(rut);

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



	ajax.onreadystatechange=function()	{

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



	ajax.onreadystatechange=function()	{

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

var opcion;

function aparece1(){

       seccion1.style.display="none";

       seccion2.style.display="";

       opcion=1;

}

function aparece2(){

       seccion1.style.display="";

       seccion2.style.display="none";

       opcion=2;

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

  if (document.form1.tipo.value=='') {

      alert ("Tipo presenta problemas ");

      return false;

  }

  if (document.form1.tipo.value=='') {

      alert ("Tipo presenta problemas ");

      return false;

  }


  if (opcion==1) {


    if (document.form1.nombren.value=='') {

        alert ("Nombre presenta problemas ");

        return false;

    }

    if (document.form1.paterno.value=='') {

        alert ("Apellido paterno presenta problemas ");

        return false;

    }

    if (document.form1.materno.value=='') {

        alert ("Apellido materno presenta problemas ");

        return false;

    }

  }
  else{

    if (opcion==2) {

      if (document.form1.nombrej.value=='') {

            alert ("Razon social presenta problemas ");

            return false;

        }

    }
  }


  if (document.form1.direccion.value=='') {

      alert ("Direccion presenta problemas ");

      return false;

  }

  /*if (document.form1.telefono.value=='') {

      alert ("Telefono presenta problemas ");

      return false;

  }*/

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
      blockUI();
  }
  else{
    return false;
  }

   /*if (document.form1.region.value==0 || document.form1.region.value=='') {

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
*/




  

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

                <table width="500" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE PROVEEDORES</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

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

                    

          <table width="488" border="0" cellspacing="0" cellpadding="0">

          <form name="form1" action="grabaproveedores.php" method="post"  onSubmit="return valida()">

                            <tr>

                             <td  valign="center" class="Estilo1">Rut  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" > -

                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()">  Rut sin puntos

                             </td>

                           </tr>



                       <td><hr></td><td><hr></td>



                            <tr>

                             <td  valign="center" class="Estilo1">Tipo</td>

                             <td class="Estilo1" colspan=3>

                              <input type="radio" name="tipo" class="Estilo2" value="Natural" onclick="aparece1();">Persona Natural<br>

                              <input type="radio" name="tipo" class="Estilo2" value="Juridica" onclick="aparece2();">Personalidad Juridica  <br>

                             </td>

                           </tr>

<tr>

                       <td><hr></td><td><hr></td>

                    </table>

                   <div id="seccion1" style="display:none">

                       <table border=0>

                          <tr>

                             <td  valign="center" class="Estilo1"><br>Razon Social  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nombrej" class="Estilo2" size="40" >

                             </td>

                           </tr>

                         </table>

                    </div>



                   <div id="seccion2" style="display:none">

                       <table border=0>

                          <tr>

                             <td  valign="center" class="Estilo1"><br>Nombre  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nombren" class="Estilo2" size="40" >

                             </td>

                           </tr>

                          <tr>

                             <td  valign="center" class="Estilo1"><br>Ap.Paterno  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="paterno" class="Estilo2" size="40" >

                             </td>

                           </tr>

                          <tr>

                             <td  valign="center" class="Estilo1"><br>Ap. Materno  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="materno" class="Estilo2" size="40" >

                             </td>

                           </tr>



                         </table>

                    </div>

                        <table border=0>

                          <tr>

                             <td  valign="center" class="Estilo1"><br>Direccion </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="direccion" class="Estilo2" size="40" >

                             </td>

                           </tr>

                          <tr>

                             <td  valign="center" class="Estilo1"><br>Telefono  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="telefono" class="Estilo2" size="40" >

                             </td>

                           </tr>

                          </table>



                     <tr>

                       <td><Br></td>

                      </tr>



                     <tr>

                       <td><Br></td>

                      </tr>





                           <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR PROVEEDOR    " > </td>

                           </tr>







                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      





                      <tr>

                      <td colspan="8">

                      <table border=1  class="table table-striped table-bordered">



                      <br>











                        <tr>

                         <td class="Estilo1">Rut </td>

                         <td class="Estilo1">Nombre o R.Social</td>

                         <td class="Estilo1">Tipo</td>

                         <td class="Estilo1">F. Pago</td>

                        </tr>



<?







  $sql="select* from dpp_proveedores order by provee_id desc LIMIT 0 , 10 ";



//echo $sql;

$res3 = mysql_query($sql);

$cont=1;



while($row3 = mysql_fetch_array($res3)){



           if ($row3["provee_cat_juri"] == 1)

             $variable="Natural";

           if ($row3["provee_cat_juri"] == 2)

             $variable="Juridica";







?>





                       <tr>

                         <td class="Estilo1"><? echo $row3["provee_rut"]  ?>-<? echo $row3["provee_dig"]  ?>  </td>

                         <td class="Estilo1"><? echo $row3["provee_nombre"]  ?>  </td>

                         <td class="Estilo1"><? echo $row3["provee_cat_juri"] ?> </td>

                         <td class="Estilo1"><? echo $row3["provee_fpago"]  ?>  </td>

                       </tr>











                        <?



                           $cont++;



                        }

                        ?>

                      </form>

                           </tr>







                      <tr>

                       <tr>

                       

                      </tr>





                      <table border=1>

                    <tr></tr>







                      <tr>

                       <input type="hidden" name="cont" value="<? echo $cont ?>" >



                        











                          </td>

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



<?



?>

