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
      $region=$_GET["region"];
      $fecha1=$_GET["fecha1"];
      $fecha2=$_GET["fecha2"];
      $rut=$_GET["rut"];
      $item=$_GET["item"];
      $estado=$_GET["estado"];

?>
<html>
<head>
<title>Honorarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"">
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
.Estilo4 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif;
font-size: 14px;
font-weight: bold; }
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
  function aparece(){
     if (document.form1.commodity.value == 'Other') {
       document.form1.specifications.style.display='';
     } else {
       document.form1.specifications.style.display='none';
     }
     if (document.form1.commodity.value == 'Fishmeal') {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
    }
     if (document.form1.commodity.value == 'Fishoil') {
       seccion2.style.display="";
     } else {
       seccion2.style.display="none";
    }
 }
 
  function aparece2(){
     if (document.form1.cantidad.value == 1) {
       seccion12.style.display="none";
       seccion13.style.display="none";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";
     }
     if (document.form1.cantidad.value == 2) {
       seccion12.style.display="";
       seccion13.style.display="none";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";

     }
     if (document.form1.cantidad.value == 3) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";

     }
     if (document.form1.cantidad.value == 4) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
     }
     if (document.form1.cantidad.value == 5) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="none";

     }
     if (document.form1.cantidad.value == 6) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";

     }

 }
 function calcula1(){
     document.form1.retencion1.value=Math.round(document.form1.bruto1.value * 10 / 100) ;
     document.form1.liquido1.value= Math.round(document.form1.bruto1.value)- Math.round(document.form1.retencion1.value);
 }
 function calcula2(){
     document.form1.retencion2.value=Math.round(document.form1.bruto2.value * 10 / 100) ;
     document.form1.liquido2.value= Math.round(document.form1.bruto2.value)- Math.round(document.form1.retencion2.value);
 }
 function calcula3(){
     document.form1.retencion3.value=Math.round(document.form1.bruto3.value * 10 / 100) ;
     document.form1.liquido3.value= Math.round(document.form1.bruto3.value)- Math.round(document.form1.retencion3.value);
 }
 function calcula4(){
     document.form1.retencion4.value=Math.round(document.form1.bruto4.value * 10 / 100) ;
     document.form1.liquido4.value= Math.round(document.form1.bruto4.value)- Math.round(document.form1.retencion4.value);
 }
 function calcula5(){
     document.form1.retencion5.value=Math.round(document.form1.bruto5.value * 10 / 100) ;
     document.form1.liquido5.value= Math.round(document.form1.bruto5.value)- Math.round(document.form1.retencion5.value);
 }
 function calcula6(){
     document.form1.retencion6.value=Math.round(document.form1.bruto6.value * 10 / 100) ;
     document.form1.liquido6.value= Math.round(document.form1.bruto6.value)- Math.round(document.form1.retencion6.value);
 }


 

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
    //alert('llamando al un alerta de otra funcion');
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

		}
	}
}

function traerDatos2(a,b,c)  {
	var ajax=nuevoAjax();
    tipoDato1=a;
    tipoDato2=b;
    rut=document.form1.rut.value;
    //alert (" dato "+a);
 	ajax.open("POST", "buscaclient2.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//ajax.send("d="+tipoDato,"e="+rut);
    ajax.send("d="+tipoDato1+"&e="+tipoDato2);

	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
			//b=ajax.responseText;
            //alert(ajax.responseText);
            if (ajax.responseText == 1) {
               //  alert (" No Existe "+b);
            }
            if (ajax.responseText == 0) {
                  alert ("Numero de Boleta Existe Para esta proveedor ");
//                  document.form1.nboleta1.value=ajax.responseText;
                  document.getElementById(c).value =ajax.responseText;

            }

		}
	}

}

function valida() {

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA ACCIÓN ?')) {
      blockUI();
  }
  else{
    return false;
  }

   if (document.form1.rut.value==0 || document.form1.rut.value=='') {
      alert ("Rut presenta problemas ");
      return false;
  }
   if (document.form1.nboleta1.value==0 || document.form1.nboleta1.value=='') {
      alert ("Numero de Boleta 1 Presenta problemas ");
      return false;
  }

   if (document.form1.codigo.value==0 || document.form1.codigo.value=='') {
      alert ("Egreso presenta problemas ");
      return false;
  }
   if (document.form1.dia.value==0 || document.form1.dia.value=='') {
      alert ("dia presenta problemas ");
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
  traerDatos2(document.form1.nboleta1.value,document.form1.rut.value,'nboleta1');


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
                    <td height="20" colspan="2"><span class="Estilo7">EDICION BOLETA HONORARIO</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                        
<?

if (isset($_GET["llave"]))
 echo "<p>Registro Modificado con Exito !";
?>
                         </td>
                      </tr>

                      <tr>
                       <td><hr></td><td><hr></td>
                      </tr>


                   <tr>
                    <td height="50" colspan="3">
<?

                                $sql25 = "Select * from parametros";
                                $res25 = mysql_query($sql25);
                                $row25 = mysql_fetch_array($res25);
                                $mes25=$row25["para_mes"];
                                $anno25=$row25["para_anno"];


      $id=$_GET["id"];
      $sql22 = "Select * from dpp_honorarios2 where hono2_id=$id";
      //echo $sql22;
      $res22 = mysql_query($sql22);
      while($row22 = mysql_fetch_array($res22)){
          $fechabase=$row22["hono2_fecha1"];
          $fechache=$row22["hono2_fechache"];
          $fecha1=$row22["hono2_fecha1"];
          $diabase=substr($fechabase,8,2);
          //echo "----".$diabase;
          $hono2rut=$row22["hono2_rut"];
          $hono2nroboleta=$row22["hono2_nro_boleta"];
          $etaid=$row22["hono2_eta_id"];

          $sql23 = "Select * from dpp_honorarios where hono_nro_boleta=$hono2nroboleta and hono_rut=$hono2rut ";
          //echo $sql23;
          $res23 = mysql_query($sql23);
          $row23 = mysql_fetch_array($res23);
          $rutexiste=$row23["hono_rut"];

          if ($rutexiste<>"") {
              echo "ya existe <br>";
              echo "<a href='borrarduplicado.php?etaid=".$etaid."&id=".$id."' class='link' >Borrar Registro</a>";
          }

          
          

?>

					<table width="488" border="0" cellspacing="0" cellpadding="0">
					  <form name="form1" action="grabahonorarios3.php" method="post"  onSubmit="return valida()">
       <?
        if ($rutexiste=="") {
                 if ($row22["hono2_estado"]==1 and substr($row22["hono2_fecha1"],5,2)==$mes25 ) {
       ?>
                        
                            <tr>
                             <td  valign="top" class="Estilo1">FOLIO
                             <td class="Estilo1" colspan=3>
                              <? echo $row22["hono2_folio"] ?>
                              </td>
                           </tr>

                            <tr>
                             <td  valign="top" class="Estilo1">Fecha Boleta</td>
                             <td class="Estilo1" colspan=3>
                              <? echo substr($row22["hono2_fecha1"],8,2)."-".substr($row22["hono2_fecha1"],5,2)."-".substr($row22["hono2_fecha1"],0,4)   ?>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="top" class="Estilo1">Fecha Cheque</td>
                             <td class="Estilo1" colspan=3>
                              <? echo substr($row22["hono2_fechache"],8,2)."-".substr($row22["hono2_fechache"],5,2)."-".substr($row22["hono2_fechache"],0,4)   ?>
                             </td>
                           </tr>



<?
  }  else {
?>
                            <tr>
                             <td  valign="top" class="Estilo1">Fecha</td>
                             <td class="Estilo1" colspan=3>
                              <? echo substr($row22["hono2_fecha1"],8,2)."-".substr($row22["hono2_fecha1"],5,2)."-".substr($row22["hono2_fecha1"],0,4)   ?>
                             </td>
                           </tr>
<?
  }
?>
                            <tr>
                             <td  valign="top" class="Estilo1">Egreso</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="codigo" class="Estilo2" size="11" value="<? echo $row22["hono2_codigo"] ?>" >
                             </td>
                           </tr>
                           
                         <tr>
                             <td  valign="top" class="Estilo1">Región</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==0) {
                                    $sql2 = "Select * from regiones order by codigo";
                                    echo '<option value="0">Select...</option>';
                                  } else
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["codigo"] ?>" <?  if ( $row2["codigo"]==$row22["hono2_region"]) echo "selected=selected" ?>><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>

                            <tr>
                             <td  valign="top" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" value="<? echo $row22["hono2_rut"] ?>"> -
                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()" value="<? echo $row22["hono2_dig"] ?>">
                             </td>
                           </tr>

                           <tr>
                             <td  valign="top" class="Estilo1">Nombre  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="40" value="<? echo $row22["hono2_nombre"] ?>">
                             </td>
                           </tr>
                           <tr>
                            <td  valign="top" class="Estilo1">Detalles  </td>
                            <td  valign="top" class="Estilo1" colspan=3>
                              <table border=1>
                                <tr>
                                  <td class="Estilo1">NºBoleta</td><td class="Estilo1">Bruto</td><td class="Estilo1">Retencion</td><td class="Estilo1">Liquido</td>
                                </tr>
<?
$liquido=$row22["hono2_liquido"];
$retencion=$liquido*10/90;
$retencion=number_format($retencion,0,"","");
$bruto=$liquido+$retencion;
?>
                                <tr>
                                   <td class="Estilo1" >1
                                    <input type="text" name="nboleta1" class="Estilo2" size="10" value="<? echo $row22["hono2_nro_boleta"] ?>" onchange="traerDatos2(document.form1.nboleta1.value,document.form1.rut.value,'nboleta1')" >
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="bruto1" class="Estilo2" size="10" value="<? echo $bruto ?>" onChange="calcula1()">
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="retencion1" class="Estilo2" size="10" value="<? echo $retencion ?>" >
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="liquido1" class="Estilo2" size="10" value="<? echo $row22["hono2_liquido"] ?>" >
                                  </td>
                                </tr>
                                </table>


                            </td>
                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1">  </td>
                               <td  valign="center" class="Estilo1">Los Valores no deben ser ingresados con puntos y comas </td>

                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Sub Titulo  </td>
                             <td class="Estilo1" colspan=3>
                              21<input type="radio" name="item" class="Estilo2" value="21" <? if ($row22["hono2_item"]==21) echo "checked" ?> >
                              22<input type="radio" name="item" class="Estilo2" value="22" <? if ($row22["hono2_item"]==22) echo "checked" ?> >
                              24<input type="radio" name="item" class="Estilo2" value="24" <? if ($row22["hono2_item"]==24) echo "checked" ?> >
                              29<input type="radio" name="item" class="Estilo2" value="29" <? if ($row22["hono2_item"]==29) echo "checked" ?> >
                              31<input type="radio" name="item" class="Estilo2" value="31" <? if ($row22["hono2_item"]==31) echo "checked" ?> >
                              34<input type="radio" name="item" class="Estilo2" value="34" <? if ($row22["hono2_item"]==34) echo "checked" ?> >
                              Otro<input type="radio" name="item" class="Estilo2" value="99" <? if ($row22["hono2_item"]==99) echo "checked" ?> >
                              <br>
                             </td>

                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1"><br><br><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
                           <?
                           //echo "$mes25 $anno25  ".$row22["hono2_fecha1"];
                           if ($row22["hono2_estado"]==1 and substr($row22["hono2_fecha1"],5,2)==$mes25 and substr($row22["hono2_fecha1"],0,4)==$anno25 or 1==1) {
                           ?>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    AGREGAR BOLETA    " > </td>
                           </tr>
                           <?
                          }
                           ?>


                           <input type="hidden" name="id" value="<? echo $id ?>">
                           <input type="hidden" name="region2" value="<? echo $region ?>">
                           <input type="hidden" name="fecha1" value="<? echo $fecha1 ?>">
                           <input type="hidden" name="fecha22" value="<? echo $fecha2 ?>">
                           <input type="hidden" name="fechache" value="<? echo $fechache ?>">
                           <input type="hidden" name="rut2" value="<? echo $rut ?>">
                           <input type="hidden" name="item2" value="<? echo $item?>">
                           <input type="hidden" name="estado2" value="<? echo $estado ?>">
                        </form>
                        <?
}
}
?>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
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
                      <td><br></tr>
                      </tr>
                      <tr>



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
