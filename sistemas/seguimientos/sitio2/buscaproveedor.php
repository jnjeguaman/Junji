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



function aparece1(){

       seccion1.style.display="none";

       seccion2.style.display="";

}

function aparece2(){

       seccion1.style.display="";

       seccion2.style.display="none";

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

      alert ("N�mero Factura presenta problemas ");

      return false;

  }

   if (document.form1.numero.value <= 0) {

      alert ("N�mero Factura debe ser positivo ");

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

                    <td height="20" colspan="2"><span class="Estilo7">FORMA PAGO</span></td>

                  </tr>

                      <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1c">



<?



if (isset($_GET["llave"]))

 echo "<p>Registros insertados con Exito !";



$rut=$_GET["rut"];

$nombre=$_GET["nombre"];

$fpago=$_GET["fpago"];



?>

                         </td>

                      </tr>

                      <tr>

                        <td><a href="menucontabilidad.php?rut=<? echo $rut ?>" class="link" > Volver </a></td>

                      </tr>



                       <tr>

                       <td><hr></td><td><hr></td>





                      </tr>



                   <tr>

                  <td height="50" colspan="3">

                    

          <table width="488" border="0" cellspacing="0" cellpadding="0">

          <form name="form1" action="buscaproveedor.php" method="get" >

                            <tr>

                             <td  valign="center" class="Estilo1">Rut  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>"> Rut sin puntos, sin Digito verificador

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Nombre  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nombre" class="Estilo2" size="40" value="<? echo $nombre ?>">

                             </td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Forma de Pago</td>

                             <td class="Estilo1" colspan=3>

                              <input type="radio" name="fpago" class="Estilo2" value="Cheque" <? if ($fpago=='Cheque') echo 'checked' ?>> Cheque

                              <input type="radio" name="fpago" class="Estilo2" value="Transferencia" <? if ($fpago=='Transferencia') echo 'checked' ?>> Transferencia  <br>



                              </td>

                           </tr>



                       <td><hr></td><td><hr></td>







                    </table>



                           <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    BUSCAR PROVEEDOR    " >  <a href="buscaproveedor.php" class="link" > Limpiar </a>  </td>

                           </tr>







                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      





                      <tr>

                      <td colspan="8">

                      <table border=1>



<br>



                        <tr>

                         <td class="Estilo1" colspan=4>







                        <tr>

                         <td class="Estilo1">Rut </td>

                         <td class="Estilo1">Nombre o R.Social</td>

                         <td class="Estilo1">F. Pago</td>

                         <td class="Estilo1">Editar</td>

                        </tr>



<?





  $sw=1;

  $sql="select* from dpp_proveedores where ";

  if ($rut<>'') {

      $sql.=" provee_rut like '%$rut%' and ";

      $sw=0;

  }

  if ($nombre<>'') {

      $sql.=" (provee_nombre like '%$nombre%' or provee_paterno like '%$nombre%' or provee_materno like '%$nombre%') and ";

      $sw=0;

  }

  if ($fpago<>'') {

      $sql.=" provee_fpago='$fpago' and ";

      $sw=0;

  }

  if ($sw==1) {

      $sql.="   1=2 ";

  }

  if ($sw==0) {

      $sql.="   1=1 order by provee_nombre";

  }





//echo $sql;

$res3 = mysql_query($sql);

$cont=1;



while($row3 = mysql_fetch_array($res3)){











?>





                       <tr>

                         <td class="Estilo1"><? echo $row3["provee_rut"]  ?>-<? echo $row3["provee_dig"]  ?>  </td>

                         <td class="Estilo1"><? echo $row3["provee_nombre"]." ".$row3["provee_paterno"]." ".$row3["provee_materno"]  ?>  </td>

                         <td class="Estilo1"><? echo $row3["provee_fpago"]  ?>  </td>

                         <td class="Estilo1"><a href="editproveedor.php?rut=<? echo $rut ?>&id=<? echo $row3["provee_id"] ?>" class="link" > Editar </a>  </td>

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


       <img src="images/pix.gif" width="1" height="10">






</body>

</html>



<?



?>

