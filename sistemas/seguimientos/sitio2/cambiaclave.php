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

	text-align: right;

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

  

<SCRIPT LANGUAGE ="JavaScript">





function ChequearTodos(chkbox)

{

  for (var i=0;i < document.forms[0].elements.length;i++){

      var elemento = document.forms[0].elements[i];

      if (elemento.type == "checkbox"){

          elemento.checked = chkbox.checked

      }

  }

}

function muestra() {

     if (document.form1.uno.value == 2) {

       seccion1.style.display="";

     } else {

       seccion1.style.display="none";

     }

}

function valida() {

   if (document.form1.antigua.value==0 || document.form1.antigua.value=='') {

      alert ("Vacio clave antigua");

      return false;

  }

   if (document.form1.nueva1.value==0 || document.form1.nueva1.value=='') {

      alert ("Vacia clave nueva");

      return false;

  }

   if (document.form1.nueva2.value==0 || document.form1.nueva2.value=='') {

      alert ("Vacio la repetecion clave ");

      return false;

  }

  if (document.form1.nueva2.value!=document.form1.nueva1.value) {

      alert ("Claves distintas ");

      return false;

  }



}

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



            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td height="20" colspan="2"><span class="Estilo7">CAMBIO DE CLAVE</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

<?

if (isset($_GET["llave"]))

  $llave=$_GET["llave"];

if ($llave==1){
echo "<script>window.location.href='salir.php';</script>";
 // echo "<p>Registro modificado con Exito !";
}
if ($llave==2){
 echo "<p>Contraseña antiguia no es la correcta !";
}




$fecha1=$_GET["fecha1"];

$fecha2=$_GET["fecha2"];

$rut=$_GET["rut"];

$item=$_GET["item"];

$consolidado=$_GET["consolidado"];



?>



                   <tr>

                     <td><? //echo $llave ?> </td>

                   </tr>



                   <tr>

                   

                    <td height="50" colspan="3">

     </table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">

       <form name="form1" action="grabacambiaclave.php" method="post"  onSubmit="return valida()">

                           <tr>

                             <td  valign="center" class="Estilo1">Usuario</td>

                             <td class="Estilo1" colspan=3 width="70%">

                               <? echo $_SESSION["nom_user"]; ?>

                             <td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Contraseña Actual</td>

                             <td class="Estilo1" colspan=3>

                               <input type="password" name="antigua" class="Estilo2" size="20" >

                             <td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Contraseña Nueva </td>

                             <td class="Estilo1" colspan=3>

                               <input type="password" name="nueva1" class="Estilo2" size="20" >

                             <td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Repetir Contraseña </td>

                             <td class="Estilo1" colspan=3>

                               <input type="password" name="nueva2" class="Estilo2" size="20" >

                             <td>

                           </tr>





                           <tr>

                             <td  valign="center" class="Estilo1" colspan=4 align="center">
                             <!-- <input type="submit" name="boton" class="Estilo2" value=" Grabar Cambio"> -->
                             <button type="submit" class="btn btn-info btn-sm">Grabar Cambios</button>
                             </td>

                             



                           </tr>







                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      <tr>



  </tr>



 

</table>



<img src="images/pix.gif" width="1" height="10">

</body>

</html>



<?

//require("inc/func.php");

?>

