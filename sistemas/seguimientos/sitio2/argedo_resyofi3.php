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
$annomio=date("Y");
$ti=$_GET["ti"];
?>
<html>
<head>
<title>Argedo</title>
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
    text-transform: uppercase;
}
.Estilo1b {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
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
<script type="text/javascript" src="select_dependientesargedo.js"></script>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
    <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />


<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
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

function peso(tipoDato,c)  {
	var ajax=nuevoAjax();
//    alert (" dato "+tipoDato);
 	ajax.open("POST", "peso.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("d="+tipoDato);

	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
//			document.form1.nombre.value=ajax.responseText;
//            nombre2.innerText=ajax.responseText;
              var nn=ajax.responseText;
//              alert(nn);
              if (nn=='1')  {
                  alert("Archivo muy grande");
                  document.getElementById(c).value ="1";
              }
              if (nn=='0')  {
                    document.getElementById(c).value ="0";
              }


		}
	}
}


function limpiar(a) {

//  alert("limpiar");
//    document.form1.dig.value="";
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
	ajax.onreadystatechange=function()	{
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

function traerDatos2(tipoDato)  {
	var ajax=nuevoAjax();
 	ajax.open("POST", "buscaclient.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("d="+tipoDato);
	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
            var Date =ajax.responseText;
            var elem = Date.split('/');
            document.form1.nombre2.value=elem[0];
            document.form1.calidad2.value=elem[4];
            document.form1.estamento2.value=elem[5];
            document.form1.grado.value=elem[6];
            document.form1.cargo.value=elem[7];
            document.form1.region2.value=elem[8];
            document.form1.unidad.value=elem[9];

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


function valida() {
  var33=document.form1.peso1.value;
  if (document.form1.peso1.value=='1') {
      alert ("Archivo 1 presenta problemas ");
      return false;
  }
  if (document.form1.peso2.value=='1') {
      alert ("Archivo 2 presenta problemas ");
      return false;
  }
  if (document.form1.peso3.value=='1') {
      alert ("Archivo 3 presenta problemas ");
      return false;
  }
  if (document.form1.peso4.value=='1') {
      alert ("Archivo 4 presenta problemas ");
      return false;
  }


  if (document.form1.fecha2.value=='') {
      alert ("Fecha Dcoumento presenta problemas ");
      return false;
  }

  
<?
 if ($ti==1) {
?>

  if (document.form1.tramite[0].checked == '' && document.form1.tramite[1].checked == '' ) {
      alert ("Tramite presenta problemas ");
      return false;
  }
  if (document.form1.op1[0].checked != '' && document.form1.materia.value=='' ) {
      alert ("Materia presenta problemas ");
      return false;
  }
  
  if ((document.form1.op1[1].checked !='' || document.form1.op1[2].checked !='') && document.form1.nombre1.value=='' ) {
      alert ("Nombre Funcionario presenta problemas ");
      return false;
  }
  if ((document.form1.op1[1].checked !='' || document.form1.op1[2].checked !='') && document.form1.fechaini1.value=='' ) {
      alert ("Fecha Inicio presenta problemas ");
      return false;
  }
  if ((document.form1.op1[1].checked !='' || document.form1.op1[2].checked !='') && document.form1.fechater1.value=='' ) {
      alert ("Fecha Termino presenta problemas ");
      return false;
  }

  if (document.form1.op1[3].checked !='' && document.form1.nombre222.value=='' ) {
      alert ("Nombre Funcionario presenta problemas ");
      return false;
  }

  if (document.form1.op1[3].checked !='' && document.form1.destino2.value=='' ) {
      alert ("Destino presenta problemas ");
      return false;
  }
  
  if (document.form1.op1[3].checked !='' && document.form1.fechaini2.value=='' ) {
      alert ("Fecha Inicio presenta problemas ");
      return false;
  }
  
  if (document.form1.op1[3].checked !='' && document.form1.fechater2.value=='' ) {
      alert ("Fecha Termino presenta problemas ");
      return false;
  }
//  if (document.form1.op1[4].checked !='' && (document.form1.archivo1.value!='' || document.form1.archivo2.value!='' || document.form1.archivo3.value!='' || document.form1.archivo4.value!='')) {
//      alert ("Documento reservado no pueden llevar archivo ");
//      return false;
//  }

<?
}
if ($ti==2 or $ti==3 ) {
?>
  if (document.form1.ti.value == 2 && document.form1.materia.value=='' ) {
      alert ("Materia presenta problemas ");
      return false;
  }
  if (document.form1.ti.value == 3 && document.form1.materia.value=='' ) {
      alert ("Materia presenta problemas ");
      return false;
  }

<?
}
?>


}



function mostrar() {
       document.form1.materia.value="";
    if (document.form1.op1[0].checked!='')  {
       seccion3.style.display="";
       seccion1.style.display="none";
       seccion2.style.display="none";
       seccion4.style.display="none";
       seccion5.style.display="none";

       document.form1.nombre1.value='';
       document.form1.rut.value='';
       document.form1.dig.value='';

       document.form1.nombre2.value='';
       document.form1.rut2.value='';
       document.form1.dig2.value='';
       document.form1.materia2.value='';

    }

    if (document.form1.op1[1].checked!='')  {
       seccion1.style.display="";
       seccion2.style.display="none";
       seccion3.style.display="none";
       seccion4.style.display="none";
       seccion5.style.display="none";
       
       document.form1.nombre2.value='';
       document.form1.rut2.value='';
       document.form1.dig2.value='';
       document.form1.materia2.value='';



    }
    if (document.form1.op1[2].checked!='')  {
       seccion1.style.display="";
       seccion2.style.display="none";
       seccion3.style.display="none";
       seccion4.style.display="none";
       seccion5.style.display="none";
       
       document.form1.nombre2.value='';
       document.form1.rut2.value='';
       document.form1.dig2.value='';
       document.form1.materia2.value='';

    }

    if (document.form1.op1[3].checked!='') {
       seccion1.style.display="none";
       seccion2.style.display="";
       seccion3.style.display="none";
       seccion4.style.display="none";
       seccion5.style.display="none";
       
       document.form1.nombre1.value='';
       document.form1.rut.value='';
       document.form1.dig.value='';
       document.form1.materia2.value='';
    }
//    if (document.form1.op1[4].checked!='') {
//       seccion1.style.display="none";
//       seccion2.style.display="none";
//       seccion3.style.display="none";
//       document.form1.materia.value="RESERVADO"
//    document.getElementById("piso2").style.visibility="hidden";
//    document.getElementById("checkbox3").style.visibility="visible";
//    }
    if (document.form1.op1[4].checked!='')  {
       seccion1.style.display="none";
       seccion2.style.display="none";
       seccion3.style.display="none";
       seccion4.style.display="";
       seccion5.style.display="none";
       
       document.form1.materia2.value="APRUEBA CONTRATO PARA PRESTACION DE SERVICIOS DE PERITAJE N°";
       document.form1.materia.value="";
    }

    if (document.form1.op1[5].checked!='')  {
       seccion1.style.display="";
       seccion2.style.display="none";
       seccion3.style.display="none";
       seccion4.style.display="none";
       seccion5.style.display="none";
       
       
       document.form1.nombre2.value='';
       document.form1.rut2.value='';
       document.form1.dig2.value='';
       document.form1.materia2.value='';

    }
    if (document.form1.op1[6].checked!='')  {
       seccion3.style.display="";
       seccion1.style.display="none";
       seccion2.style.display="none";
       seccion4.style.display="none";
       seccion5.style.display="none";

       document.form1.nombre1.value='';
       document.form1.rut.value='';
       document.form1.dig.value='';

       document.form1.nombre2.value='';
       document.form1.rut2.value='';
       document.form1.dig2.value='';
       document.form1.materia2.value='';

    }
    if (document.form1.op1[7].checked!='')  {
       seccion1.style.display="";
       seccion2.style.display="none";
       seccion3.style.display="none";
       seccion4.style.display="none";
       seccion5.style.display="none";

       document.form1.nombre2.value='';
       document.form1.rut2.value='';
       document.form1.dig2.value='';
       document.form1.materia2.value='';

    }
    if (document.form1.op1[8].checked!='')  {
       seccion1.style.display="none";
       seccion2.style.display="none";
       seccion3.style.display="none";
       seccion4.style.display="none";
       seccion5.style.display="";

       document.form1.nombre2.value='';
       document.form1.rut2.value='';
       document.form1.dig2.value='';
       document.form1.materia2.value='';

    }

}
function llenar() {
     document.form1.materia2.value="APRUEBA CONTRATO PARA PRESTACION DE SERVICIOS DE PERITAJE N° "+document.form1.numerop.value+", "+document.form1.nombrep.value;
}



  function aparece2(){
     if (document.form1.cantidad.value == 1) {
       seccion12.style.display="none";
       seccion13.style.display="none";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";

     }
     if (document.form1.cantidad.value == 2) {
       seccion12.style.display="";
       seccion13.style.display="none";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
//       seccion110.style.display="none";
//       seccion111.style.display="none";
//       seccion112.style.display="none";
//       seccion113.style.display="none";
//       seccion114.style.display="none";
//       seccion115.style.display="none";


     }
     if (document.form1.cantidad.value == 3) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";


     }
     if (document.form1.cantidad.value == 4) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="none";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula4();
     }
     if (document.form1.cantidad.value == 5) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula5();

     }
     if (document.form1.cantidad.value == 6) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula6();
     }
     if (document.form1.cantidad.value == 7) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula7();
     }
     if (document.form1.cantidad.value == 8) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula8();
     }
     if (document.form1.cantidad.value == 9) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula9();
     }
     if (document.form1.cantidad.value == 10) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula10();
     }
     if (document.form1.cantidad.value == 11) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula11();
     }
     if (document.form1.cantidad.value == 12) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula12();
     }
     if (document.form1.cantidad.value == 13) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="";
       seccion113.style.display="";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula13();
     }
     if (document.form1.cantidad.value == 14) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="";
       seccion113.style.display="";
       seccion114.style.display="";
       seccion115.style.display="none";
       calcula14();
     }
     if (document.form1.cantidad.value == 15) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="";
       seccion113.style.display="";
       seccion114.style.display="";
       seccion115.style.display="";
       calcula15();
     }



 }


function abreVentana(){
	miPopup = window.open("argedo_docmaster.php?id=<? echo $id ?>&id2=<? echo $id2 ?>","miwin","width=500,height=500,scrollbars=yes,toolbar=0")
	miPopup.focus()
}


//-->

</script>
<?

function generaPaises()
{
//	include 'conexion.php';
//	conectar();
	$consulta=mysql_query("SELECT id, opcion FROM area");
    //echo $consulta;
//	desconectar();



	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='paises' id='paises' onChange='cargaContenido2(this.id)'>";
	echo "<option value='0'>Seleccione...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}



  if ($ti==1) {
   $prefijo="RESOLUCIÓN EXENTA";

  }
  if ($ti==2) {
   $prefijo="RESOLUCIÓN AFECTA";
  }
  if ($ti==3) {
   $prefijo="OFICIO";
  }
  if ($ti==6) {
   $prefijo="RESOLUCIÓN EXENTA";

  }
  if ($ti==7) {
   $prefijo="RESOLUCIÓN EXENTA";

  }


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
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE DOCUMENTOS (<? echo $prefijo ?> TRA)</span></td>
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
                         <td width="487" valign="top" class="Estilo1c">
                         
<?





if (isset($_GET["llave"])) {
 $llave=$_GET["llave"];
 if ($llave==0) {
   echo "<p>Registros insertados con Exito !";
 }
 if ($llave==1) {
//   echo "<p><font color='#FF0000'>Registros NO insertados, Problemas con Tamaño de Archivos !</font></p>";
 }
}

?>
                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
<?
  $campo="fol_reg".$regionsession."_6";
  $sql2="select $campo as folio from argedo_folios where fol_id=1 ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $foliomio=$row2["folio"];
  $foliomio2=$foliomio+1;


$sql22="select count(eta_id) as totaldevueltos from dpp_etapas where eta_estado=12 and eta_region='$regionsession' ";
//  echo $sql21;
  $result22=mysql_query($sql22);
  $row22=mysql_fetch_array($result22);
  $totaldevueltos=$row22["totaldevueltos"];
?>


                   <tr>
             			<td height="50" colspan="3">
                     </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="argedo_grabaresyofi.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">

<input type="hidden" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly="1">
                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1" width="340">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==0) {
                                    $sql2 = "Select * from regiones order by codigo";
                                    echo '<option value="">Select...</option>';
                                  } else
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["codigo"] ?>"><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>
                       <tr>
                             <td  valign="center" class="Estilo1">Fecha Documento <font color="#FF0000">* </font></td>
                             <td class="Estilo1">
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" >
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c2",
        trigger    : "f_trigger_c2",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>


                            </td>
                           </tr>

                      <tr>
                       <td><hr></td><td><hr></td>
                           <tr>
                             <td  valign="top" class="Estilo1">SIAPER TRA</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="codh" class="Estilo2" size="4" value="858" >
                              <input type="text" name="numh" class="Estilo2" size="4" value="" >
                              <input type="text" name="annoh" class="Estilo2" size="4" value="<? echo $annomio ?>" >  <br>  <br>
                             </td>
                           </tr>
<?

if (($regionsession==15 or $regionsession==8) and 1==2) {
?>
                       
                           <tr>
                             <td  valign="center" class="Estilo1">N° Folio DocMaster</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="foliocmaster" class="Estilo2" size="18" value="" readonly>
                              <input type="hidden" name="iddocmaster" >
                                     <a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana()">Asociar DocMaster</a>
                             </td>
                           </tr>
<?
}
?>

                            <tr>
                             <td  valign="center" class="Estilo1">ÁREA <font color="#FF0000">* </font></td>
				             <td class="Estilo1">
<?
  if ($regionsession==15) {
?>
                               <input type="hidden" name="paises" class="Estilo2" size="40"  value="1" >DN Defensor Nacional
<?
} else {
?>
                               <input type="hidden" name="paises" class="Estilo2" size="40"  value="3" >DR Defensor Regional

<?
}
?>
                             </td>
                           <tr>
                             <td valign="center" class="Estilo1">SUBÁREA <font color="#FF0000">* </font></td>
                             <td class="Estilo1">
                               <input type="hidden" name="estados" class="Estilo2" size="40"  value="18" >RRHH Recursos Humanos

                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>EN TRÁMITE  <font color="#FF0000">* </font></td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="radio" name="tramite" class="Estilo2" value="SI" > Si
                              <input type="radio" name="tramite" class="Estilo2" value="NO" checked> No <br>
                             </td>
                           </tr>
<?
if ($ti==1 or $ti==6 or $ti==7) {
?>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>TIPO RESOLUCIÓN EXENTA</td>
                             <td class="Estilo1" colspan=4>
                               <table border=1>
                                 <tr>
                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="NORMAL" checked onclick="mostrar();">Res. Exenta "Normal RR.HH."</td>
                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="PERMISO ADMINISTRATIVO" onclick="mostrar();">Res. Exenta "Permiso Administrativo"</td>
                                 </tr>
                                 <tr>
                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="FERIADO LEGAL" onclick="mostrar();">Res. Exenta "Feriado Legal"</td>
                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="COMETIDO FUNCIONARIO" onclick="mostrar();">Res. Exenta "Cometido Funcionario"</tr>
                                 </tr>
                                 <tr>
                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="APRUEBA CONTRATO PERITAJE" onclick="mostrar();">Aprueba contrato peritaje</td>
                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="POSTERGUESE FERIADO LEGAL" onclick="mostrar();"  >Res. Exenta "Posterguese Feriado Legal"</td>
                                 </tr>
                                 <tr>
                                  <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="RESERVADO" onclick="mostrar();" disabled="disabled"></td>

<!--                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="POSTERGUESE" onclick="mostrar();" >Posterguese</td>  -->
                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="COMPENSACION HORARIA" onclick="mostrar();" >Compensacion Horaria</td>
                                 </tr>
                                 <tr>
                                   <td class="Estilo1c"><input type="radio" name="op1" class="Estilo2" value="CONTRATO A HONORARIOS" onclick="mostrar();">Contrato a Honorarios</td>
                                   <td class="Estilo1c"></td>
                                 </tr>
                               </table>
                             </td>
                           </tr>
                     </table>
                  <div id="seccion5" style="display:none">
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1"><br>RUT FUNCIONARIO 555</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="rut555" class="Estilo2" size="11" onchange="limpiar(222)" > -
                              <input type="text" name="dig555" class="Estilo2" size="2" onChange="verificador(document.form1.rut555.value,document.form1.dig555.value,555)">  Rut sin puntos
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>NOMBRE FUNCIONARIO.</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="nombre555" class="Estilo2" size="40"  onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>
                              <input type="hidden" name="calidad555" class="Estilo2" size="40" >
                              <input type="hidden" name="estamento555" class="Estilo2" size="40"  >
                              <input type="hidden" name="grado555" >
                              <input type="hidden" name="cargo555" >
                              <input type="hidden" name="region555" >
                              <input type="hidden" name="unidad555" >
                    </table>
                    </div>

                     
                    <div id="seccion1" style="display:none">
					<table width="620" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                             <td  valign="top" class="Estilo1"> Cantidad</td>
                             <td class="Estilo1">
                                <select name="cantidad" class="Estilo1" onChange="aparece2()" >
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 <option value="6">6</option>
                                 <option value="7">7</option>
                                 <option value="8">8</option>
                                 <option value="9">9</option>
                                 <option value="10">10</option>
                               </select>
                             </td>
                            </tr>
                            
                            <tr>
                            
                             <td  valign="center" class="Estilo1"><br>RUT FUNCIONARIO 1</td>
                             <td  valign="center" class="Estilo1"><br>NOMBRE FUNCIONARIO 1</td>
                             <td  valign="center" class="Estilo1"><br>FECHA INICIO</td>
                             <td  valign="center" class="Estilo1"><br>FECHA TÉRMINO</td>
                            </tr>
                            <tr>
                             <td><input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar(2)" >-<input type="text" name="dig" class="Estilo2" size="2" onChange="verificador(document.form1.rut.value,document.form1.dig.value,1)">  </td>
                             <td><input type="text" name="nombre1" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" ></td>
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
    //]]></script>

                             </td>
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
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >
                             <input type="hidden" name="estamento" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >
                     </tr>
          </table>
<!--- DOS   -->
                 <div id="seccion12" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut2" class="Estilo2" size="11" onchange="limpiar(2)" >-<input type="text" name="dig2" class="Estilo2" size="2" onChange="verificador(document.form1.rut2.value,document.form1.dig2.value,2)">  </td>
                             <td><input type="text" name="nombre2" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini2a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2a" >
<img src="calendario.gif" id="f_trigger_c2a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c2a",
        trigger    : "f_trigger_c2a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater2b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2b" >
<img src="calendario.gif" id="f_trigger_c2b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c2b",
        trigger    : "f_trigger_c2b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad2" class="Estilo2" size="40"  >
                             <input type="hidden" name="estamento2" class="Estilo2" size="40" >
                     </tr>

                                </table>
                                </div>

<!--- tres   -->
                                <div id="seccion13" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut3" class="Estilo2" size="11" onchange="limpiar(2)" >-<input type="text" name="dig3" class="Estilo2" size="2" onChange="verificador(document.form1.rut3.value,document.form1.dig3.value,3)">  </td>
                             <td><input type="text" name="nombre3" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini3a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c3a" >
<img src="calendario.gif" id="f_trigger_c3a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c3a",
        trigger    : "f_trigger_c3a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater3b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c3b" >
<img src="calendario.gif" id="f_trigger_c3b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c3b",
        trigger    : "f_trigger_c3b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad3" class="Estilo2" size="40"  >
                             <input type="hidden" name="estamento3" class="Estilo2" size="40" >
                     </tr>
                                
                                </table>
                                </div>
                                
<!--- Cuatro   -->
                                <div id="seccion14" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut4" class="Estilo2" size="11" onchange="limpiar(4)" >-<input type="text" name="dig4" class="Estilo2" size="2" onChange="verificador(document.form1.rut4.value,document.form1.dig4.value,4)">  </td>
                             <td><input type="text" name="nombre4" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini4a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c4a" >
<img src="calendario.gif" id="f_trigger_c3a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c4a",
        trigger    : "f_trigger_c4a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater4b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c4b" >
<img src="calendario.gif" id="f_trigger_c4b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c4b",
        trigger    : "f_trigger_c4b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad4" class="Estilo2" size="40"  >
                             <input type="hidden" name="estamento4" class="Estilo2" size="40" >
                     </tr>
                                                                </table>
                                </div>
<!--- Cinco   -->
                                <div id="seccion15" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut5" class="Estilo2" size="11" onchange="limpiar(5)" >-<input type="text" name="dig5" class="Estilo2" size="2" onChange="verificador(document.form1.rut5.value,document.form1.dig5.value,5)">  </td>
                             <td><input type="text" name="nombre5" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini5a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c5a" >
<img src="calendario.gif" id="f_trigger_c5a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c5a",
        trigger    : "f_trigger_c5a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater5b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c5b" >
<img src="calendario.gif" id="f_trigger_c5b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c5b",
        trigger    : "f_trigger_c5b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad5" class="Estilo2" size="40"  >
                             <input type="hidden" name="estamento5" class="Estilo2" size="40" >
                     </tr>

                                </table>
                                </div>
                                
<!--- Seis   -->
                                <div id="seccion16" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut6" class="Estilo2" size="11" onchange="limpiar(6)" >-<input type="text" name="dig6" class="Estilo2" size="2" onChange="verificador(document.form1.rut6.value,document.form1.dig6.value,6)">  </td>
                             <td><input type="text" name="nombre6" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini6a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c6a" >
<img src="calendario.gif" id="f_trigger_c6a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c6a",
        trigger    : "f_trigger_c6a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater6b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c6b" >
<img src="calendario.gif" id="f_trigger_c6b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c6b",
        trigger    : "f_trigger_c6b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad6" class="Estilo2" size="40"  >
                             <input type="hidden" name="estamento6" class="Estilo2" size="40" >
                     </tr>



                                </table>
                                </div>
<!--- Siete   -->
                                <div id="seccion17" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut7" class="Estilo2" size="11" onchange="limpiar(7)" >-<input type="text" name="dig7" class="Estilo2" size="2" onChange="verificador(document.form1.rut7.value,document.form1.dig7.value,7)">  </td>
                             <td><input type="text" name="nombre7" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini7a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c7a" >
<img src="calendario.gif" id="f_trigger_c7a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c7a",
        trigger    : "f_trigger_c7a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater7b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c7b" >
<img src="calendario.gif" id="f_trigger_c7b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c7b",
        trigger    : "f_trigger_c7b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad7" class="Estilo2" size="40"  >
                             <input type="hidden" name="estamento7" class="Estilo2" size="40" >
                     </tr>



                                </table>
                                </div>
<!--- Ocho   -->
                                <div id="seccion18" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut8" class="Estilo2" size="11" onchange="limpiar(8)" >-<input type="text" name="dig8" class="Estilo2" size="2" onChange="verificador(document.form1.rut8.value,document.form1.dig8.value,8)">  </td>
                             <td><input type="text" name="nombre8" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini8a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c8a" >
<img src="calendario.gif" id="f_trigger_c8a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c8a",
        trigger    : "f_trigger_c8a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater8b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c8b" >
<img src="calendario.gif" id="f_trigger_c8b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c8b",
        trigger    : "f_trigger_c8b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad8" class="Estilo2" size="40"  >
                             <input type="hidden" name="estament8" class="Estilo2" size="40" >
                     </tr>

                                </table>
                                </div>

<!--- Nueve   -->
                                <div id="seccion19" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut9" class="Estilo2" size="11" onchange="limpiar(9)" >-<input type="text" name="dig9" class="Estilo2" size="2" onChange="verificador(document.form1.rut9.value,document.form1.dig9.value,9)">  </td>
                             <td><input type="text" name="nombre9" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini9a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c9a" >
<img src="calendario.gif" id="f_trigger_c9a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c9a",
        trigger    : "f_trigger_c9a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater9b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c9b" >
<img src="calendario.gif" id="f_trigger_c9b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c9b",
        trigger    : "f_trigger_c9b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad9" class="Estilo2" size="40"  >
                             <input type="hidden" name="estamento9" class="Estilo2" size="40" >
                     </tr>



                                </table>
                                </div>
<!--- Diez   -->
                                <div id="seccion110" style="display:none">
          <table width="620" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                             <td><input type="text" name="rut10" class="Estilo2" size="11" onchange="limpiar(10)" >-<input type="text" name="dig10" class="Estilo2" size="2" onChange="verificador(document.form1.rut10.value,document.form1.dig10.value,10)">  </td>
                             <td><input type="text" name="nombre10" class="Estilo2" size="40"  ></td>
                             <td class="Estilo1" colspan=1>
<input type="text" name="fechaini10a" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c10a" >
<img src="calendario.gif" id="f_trigger_c10a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c10a",
        trigger    : "f_trigger_c10a",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                             <td class="Estilo1" colspan=3>
<input type="text" name="fechater10b" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c10b" >
<img src="calendario.gif" id="f_trigger_c10b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c10b",
        trigger    : "f_trigger_c10b",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                              <input type="hidden" name="calidad10" class="Estilo2" size="40"  >
                             <input type="hidden" name="estamento10" class="Estilo2" size="40" >
                     </tr>

                                </table>
                                </div>
<!--- Once   -->
                    <div id="seccion111" style="display:none">
                                

                  </div>
<!--- Doce   -->
                                <div id="seccion112" style="display:none">
                                <table border=1>


                                </table>
                                </div>
<!--- Trece   -->
                                <div id="seccion113" style="display:none">
                                <table border=1>


                                </table>
                                </div>
<!--- Catorce   -->
                                <div id="seccion114" style="display:none">
                                <table border=1>


                                </table>
                                </div>
<!--- Quince   -->
                                <div id="seccion115" style="display:none">
                                <table border=1>


                                </table>
                                </div>
                                
                                
                                
                                
                                
                    </div>
                <div id="seccion2" style="display:none">
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1"><br>RUT FUNCIONARIO </td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="rut222" class="Estilo2" size="11" onchange="limpiar(222)" > -
                              <input type="text" name="dig222" class="Estilo2" size="2" onChange="verificador(document.form1.rut222.value,document.form1.dig222.value,222)">  Rut sin puntos
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>NOMBRE FUNCIONARIO.</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="nombre222" class="Estilo2" size="40"  onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>NUMERO DE DIAS</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="ndias" class="Estilo2" size="40"  onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>

                              <input type="hidden" name="calidad222" class="Estilo2" size="40" >
                              <input type="hidden" name="estamento222" class="Estilo2" size="40"  >
                              <input type="hidden" name="grado222" >
                              <input type="hidden" name="cargo222" >
                              <input type="hidden" name="region222" >
                              <input type="hidden" name="unidad222" >


                            <tr>
                             <td  valign="center" class="Estilo1"><br>DESTINO COMETIDO</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="destino22" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>FECHA INICIO</td>
                             <td class="Estilo1" colspan=3><br>
<input type="text" name="fechaini2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c5" >
<img src="calendario.gif" id="f_trigger_c5" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c5",
        trigger    : "f_trigger_c5",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>FECHA TÉRMINO</td>
                             <td class="Estilo1" colspan=3><br>
<input type="text" name="fechater2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c6" >
<img src="calendario.gif" id="f_trigger_c6" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c6",
        trigger    : "f_trigger_c6",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>

                             </td>
                           </tr>



                    </table>
                    </div>
                    
                    <div id="seccion3" style="display:visibility">
   					<table width="588" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1" width="152"><br>MATERIA 1 <font color="#FF0000">* </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                             <td class="Estilo1" colspan=1 width=""><br>
                             <textarea name="materia" rows="3" cols="70" class="Estilo2" onkeyup="this.value=this.value.toUpperCase()"  onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>
                             </td>
                           </tr>
                   </table>
                   </div>
                    <div id="seccion4" style="display:none">
   					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1" ><br>MATERIA 2 <font color="#FF0000">* </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                             <td class="Estilo1" colspan=3><br>
                             <textarea name="materia2" rows="3" cols="63" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br> NUMERO PERITAJE</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="numerop" class="Estilo2" size="40"  onKeyUp="llenar();">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br> NOMBRE PERITO</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="nombrep" class="Estilo2" size="40"  onKeyUp="llenar();">
                             </td>
                           </tr>


                   </table>
                   </div>


        
  					<table width="488" border="0" cellspacing="0" cellpadding="0">
                           
<?


} else {
?>
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                             <td  valign="center" class="Estilo1" ><br>MATERIA 2<font color="#FF0000">* </font> </td>
                             <td class="Estilo1" colspan=3><br>
                             <textarea name="materia" rows="3" cols="40" class="Estilo2" onkeyup="this.value=this.value.toUpperCase()" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>
                             </td>
                           </tr>


<?
}
if ($ti==3) {
?>
                            <tr>
                             <td  valign="center" class="Estilo1">Tipo de Documento</td>
                             <td class="Estilo1" colspan=4>
<?
if ($regionsession==15) {

?>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DN" > Oficio DN <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DAN" > Oficio DAN  <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DEPTO" > Oficio DEPTO  <br>
<?
} else {
?>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DEPTO" > Oficio DEPTO  <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DAR" > Oficio DAR  <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DR" > Oficio DR  <br>
<?
}
?>
                          </td>

<?
}
?>
                            <tr>
                             <td  valign="center" class="Estilo1" width="340"><br>DESTINATARIO  </td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="destinatario" class="Estilo2" size="65" onkeyup="this.value=this.value.toUpperCase()" >
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1" width="340"><br>OBSERVACIÓN  </td>
                             <td class="Estilo1" colspan=3><br>
                             <textarea name="obs" rows="3" cols="40" onkeyup="this.value=this.value.toUpperCase()" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 1</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo1" class="Estilo2" size="40" onchange="peso(document.form1.archivo1.value,'peso1')" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 2</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo2" class="Estilo2" size="40" onchange="peso(document.form1.archivo2.value,'peso2')" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 3</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo3" class="Estilo2" size="40" onchange="peso(document.form1.archivo3.value,'peso3')" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 4</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo4" class="Estilo2" size="40" onchange="peso(document.form1.archivo4.value,'peso4')">
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1" colspan="4"><BR><font color="#FF0000"> * CAMPOS OBLIGATORIOS </font></td>
                           </tr>


                      </tr>
                     <tr>
                       <td><hr></td><td><hr></td>


                      </tr>


                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
<!--
                           <tr>
                             <td colspan=4 align="center" class="Estilo7">Último Correlativo : <? echo $foliomio ?>, el próximo es : <? echo $foliomio2 ?> </td>
                           </tr>
-->
                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR <? echo $prefijo ?>    " > </td>
                           </tr>

                              <input type="hidden" name="peso1" value="" >
                              <input type="hidden" name="peso2" value="" >
                              <input type="hidden" name="peso3" value="" >
                              <input type="hidden" name="peso4" value="" >
                              
                              <input type="hidden" name="ti" value="7" >
                              <input type="hidden" name="prefijo" value="<? echo $prefijo; ?>" >
                              <input type="hidden" name="contrato" >
                              <input type="hidden" name="grado" >
                              <input type="hidden" name="cargo" >
                              <input type="hidden" name="region2" >
                              <input type="hidden" name="unidad" >

                        </form>

                      </td>





                      <tr>
                      <td colspan="8">
                      <table border=1>

<br>




<?
  $sql21="select max(eta_folioguia) as foliomio from dpp_etapas where eta_region='$regionsession' ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $foliomio=$row21["foliomio"];
  $foliomio=$foliomio+1;
  

?>
                        <tr>
                         <td class="Estilo1" colspan=4></td>
                        </tr>


                        <tr>
                         <td class="Estilo1" colspan=4>


                        <tr>
                         <td class="Estilo1b">FOLIO</td>
                         <td class="Estilo1b">TIPO DOCUMENTO</td>
                         <td class="Estilo1b">FECHA DOCUMENTO</td>
                         <td class="Estilo1b">MATERIA</td>
                         <td class="Estilo1b">AREA</td>
                         <td class="Estilo1b">SUBAREA</td>
                         <td class="Estilo1b">TRAMITE</td>
                         <td class="Estilo1b">FICHA</td>

                        </tr>

<?



if ($regionsession==0) {
     $sql="select * from argedo_documentos where  eta_estado=1 and eta_folioguia=0 order by docs_id desc limit 0,10";
} else {
     $sql="select * from argedo_documentos where docs_estado=1 and docs_folioguia=0 and docs_defensoria ='$regionsession' and docs_tipo='7'  order by docs_id desc, docs_fecha desc limit 0,20";
}


//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
    $fechahoy = $date_in2;
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
      $clase="Estilo1crojo";


   $sql5="select * from dpp_plazos ";
   //echo $sql;
   $res5 = mysql_query($sql5);
   $row5 = mysql_fetch_array($res5);
   $etapa1a=$row5["pla_etapa1a"];
   $etapa1b=$row5["pla_etapa1b"];
   
   $areaid=$row3["docs_area"];
   $subareaid=$row3["docs_subarea"];
   
   $sql6="select * from area where id=$areaid ";
//   echo $sql6;
   $res6 = mysql_query($sql6);
   $row6 = mysql_fetch_array($res6);
   $areanombre=$row6["opcion"];

   $sql7="select * from subarea where id=$subareaid ";
//   echo $sql7;
   $res7 = mysql_query($sql7);
   $row7 = mysql_fetch_array($res7);
   $subareanombre=$row7["opcion"];



?>


                       <tr>
                         <td class="Estilo1b"><? echo $row3["docs_folio"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["docs_documento"]  ?> </td>
                         <td class="Estilo1b"><? echo substr($row3["docs_fecha"],8,2)."-".substr($row3["docs_fecha"],5,2)."-".substr($row3["docs_fecha"],0,4)   ?></td>
                        
                         <td class="Estilo1b"><? echo $row3["docs_materia"]  ?> </td>
                         <td class="Estilo1b"><? echo $areanombre  ?> </td>
                         <td class="Estilo1b"><? echo $subareanombre ?> </td>
                         <td class="Estilo1b"><? echo $row3["docs_tramite"]  ?> </td>
                         <td class="Estilo1b"><a href="argedo_ficharesyofi.php?id=<? echo $row3["docs_id"]; ?>&ti=<? echo $ti; ?>&ori=4" class="link" > VER  </a> </td>



                       </tr>





<?

   $cont++;

}
?>




                      <tr>
                       <tr>
                       
                      </tr>



<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
