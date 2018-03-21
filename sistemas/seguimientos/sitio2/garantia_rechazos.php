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
.linkrojo {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #CC0000;
	text-decoration:none;
	text-transform:uppercase;
}
.Estilo4 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif; 
font-size: 14px; font-weight: bold; }
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

if (digito == 11) {
	digito = 0;
}
if (digito == 10) {
	digito = "k";
}
if (dig!=digito) {
  alert('Rut incorrecto, es  '+digito);
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
            

            var Date = document.form1.nombre.value;
            var elem = Date.split('/');
			document.form1.nombre.value=elem[0];
            nombre2.innerText=elem[0];
//            document.form1.fpago.value = elem[1];


		}
	}
}

function traerDatos2(a,b,c)  {
	var ajax=nuevoAjax();
    tipoDato1=a;
    tipoDato2=b;
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
                  alert ("Numero de Boleta Existe Para esta proveedor "+c);
//                  document.form1.nboleta1.value=ajax.responseText;
                    document.getElementById(c).value =ajax.responseText;
//                    document.getElementById(c).value =0;

            }

		}
	}

}


function valida() {

   if (document.form1.nrogarantia.value=='') {
      alert ("Vacio Nº Documento ");
      return false;
  }
   if (document.form1.emisora.value=='') {
      alert ("Vacio Emisora ");
      return false;
  }
   if (document.form1.monto.value=='') {
      alert ("Vacio Monto ");
      return false;
  }
   if (document.form1.monto.value=='') {
      alert ("Vacio Monto ");
      return false;
  }
   if (document.form1.fecha2.value=='' && document.form1.tipo2.value != "VALE VISTA") {
      alert ("Vacio Fecha Vencimiento ");
      return false;
  }
   if (document.form1.fecha3.value=='') {
      alert ("Vacio Fecha Emision");
      return false;
  }
   if (document.form1.rut.value=='') {
      alert ("Vacio Rut");
      return false;
  }
   if (document.form1.dig.value=='') {
      alert ("Vacio Digito");
      return false;
  }
   if (document.form1.nombre.value=='') {
      alert ("Vacio Razon Social");
      return false;
  }
   if (document.form1.glosa.value=='') {
      alert ("Vacio Glosa");
      return false;
  }

  if(document.form1.nombre.value == 'Proveedor No Existe')
  {
    alert("El proveedor no existe");
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

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">GARANTÍAS RECHAZADAS</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1">
                         
<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Éxito !";
?>
                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>


                   <tr>
                    <td height="50" colspan="3">
                     </table>

                         <table border=1 class="table table-striped">
                             <tr>
                               <td class="Estilo1">Folio</td><td class="Estilo1">Rut</td><td class="Estilo1" width="10">Nombre</td>
                               <td class="Estilo1" width="30">Monto</td><td class="Estilo1">Número</td><td class="Estilo1">Fecha_Recepción</td>
                               <td class="Estilo1">Rechazo</td>
                               <td class="Estilo1">Fecha Rechazo</td>
                              </tr>

                              <?

                                  if ($regionsession==0) {
                                     $sql2 = "Select * from dpp_boletasg WHERE boleg_estado=9 order by boleg_folio desc limit 0,100";

                                  } else {
                                    $sql2 = "Select * from dpp_boletasg  where boleg_reg='$regionsession' and  boleg_estado=9 order by boleg_folio desc limit 0,500";
                                    //$sql2 = "Select * from regiones where codigo=$regionsession";
                                  }
                                  //$sql2 = "Select * from dpp_boletasg  order by boleg_id desc limit 0,100";
                                  //echo $sql2;
                                  $res2 = mysql_query($sql2);
                                   $cont=1;
                                   while($row2 = mysql_fetch_array($res2)){
                                      $boleg_sw=$row2["boleg_sw"];
                                      if ($boleg_sw==0) {
                                          $estilo="linkrojo";
                                      } else {
                                          $estilo="link";
                                      }
                                      $read1= rand(0,1000000);
                              ?>
                                  <tr>

                                  <td class="Estilo1">
                                  <? echo $row2["boleg_folio"] ?>
                                       <a href="../../archivos/docgarantia/<? echo $row2["boleg_archivo"]; ?>?read1=<? echo $read1 ?>" class="<? echo $estilo ?>" target="_blank"><img src="images/attach.gif" width="8" height="14"></a>
                                  </td>
                                  <td class="Estilo1"><? echo $row2["boleg_rut"] ?></td>
                                  <td class="Estilo1"><? echo $row2["boleg_nombre"] ?></td>
                                  <td class="Estilo1"><? echo $row2["boleg_monto"] ?></td>
                                  <td class="Estilo1"><? echo $row2["boleg_numero"] ?></td>
                                  <td class="Estilo1"><? echo substr($row2["boleg_fecha_recep"],8,2)."-".substr($row2["boleg_fecha_recep"],5,2)."-".substr($row2["boleg_fecha_recep"],0,4) ?></td>
                                  <td class="Estilo1"><? echo $row2["boleg_rechazo"] ?></td>
                                  <td class="Estilo1"><? echo substr($row2["boleg_fecha_rech"],8,2)."-".substr($row2["boleg_fecha_rech"],5,2)."-".substr($row2["boleg_fecha_rech"],0,4) ?></td>
                              <?
                                    $cont++;
                                  }
                              ?>

                              </tr>
                         </table>


                      </tr>

                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>



</td>
  </tr>
 
 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
