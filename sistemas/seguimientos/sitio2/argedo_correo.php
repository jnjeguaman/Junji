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
<title>Facturas y/o Boletas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">

<script>
  function actualizar(input)
  {
    var cantidad = document.getElementById("cantidad").value;
    var precio = document.getElementById("precio").value;
     var total = cantidad * precio;
    document.getElementById("total").value = total;
     document.getElementById("total1").value = total;
  }
</script>
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

<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">
<!--


function nuevoAjax(){
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
  if (rut!='') {
    traerDatos(rut);
  }


}

}




function valida() {
  if (document.form1.tipodoc1.value=='') {
      alert ("Tipo Documento presenta problemas ");
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

</script>
<?




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
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE COMPROBANTES DE PAGO CORREOS</span></td>
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
<?
  $campo="fol_reg".$regionsession."_4";
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
					<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="table table-striped">
				  <form name="form1" action="argedo_grabacorreo.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">

<tr class="Estilo8"><td colspan="4">PASO 1: INGRESO DE DOCUMENTO<td></tr>


<tr>
                             <td  valign="center" class="Estilo1"  width="190">FECHA RECEPCIÓN OFICINA DE PARTES</td>
                             <td class="Estilo1" valign="center">
<input type="hidden" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" ><? echo $date_in ?>



                             </td>
                           </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
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

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


                            </td>
                           </tr>

                             <td  valign="center" class="Estilo1">TIPO DOCUMENTO.</td>
                             <td class="Estilo1" colspan=4>
                              <input type="radio" name="tipodoc" class="Estilo2" value="Carta" checked>Carta <br>

                             </td>
                           </tr>


                            <tr>
                             <td  valign="center" class="Estilo1" width="200">DEPENDENCIA DE RECEPCION </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="dependencia" class="Estilo2" size="30" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1" width="200">Cantidad </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="cantidad" id="cantidad" class="Estilo2" size="30" onChange="actualizar(this.value)">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1" width="200">Precio </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="precio" id="precio" class="Estilo2" size="30" value="50" onChange="actualizar(this.value)">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1" width="200">Total </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="total1" id="total1" class="Estilo2" size="30" disabled>
                              <input type="hidden" name="total" id="total" class="Estilo2">
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1" width="200">Responsable </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="responsable" class="Estilo2" size="30" >
                             </td>
                           </tr>
                           <!-- <tr>
                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 1 </td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="file" name="archivo1" class="Estilo2" size="40"  >
                             </td>
                           </tr> -->
                            <tr>
                             <td  valign="center" class="Estilo1" colspan="4"><BR><font color="#FF0000"> * CAMPOS OBLIGATORIOS </font></td>
                           </tr>




                      </table>




                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR    " > </td>
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


<tr class="Estilo8">PASO 2: CONFECCIÓN GUÍA DESPACHO INTERNO</tr> 

<?
  $sql21="select max(corre_folioguia) as foliomio from argedo_correo where corre_region='$regionsession' ";
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
                      <form name="form2" action="argedo_grabaasignacorreo.php" method="post" onsubmit="return validaGeneraguia()" >

          <tr>
                             <td  valign="center" class="Estilo1" colspan=8>Destinatario
                                <input type="text" name="destinatario" class="Estilo2" size="50" required>
                              <td>


                           </tr>



                        <tr>
                         <td class="Estilo1b">ITEM</td>
                         <td class="Estilo1b">FECHA</td>
                         <td class="Estilo1b">DEPENDENCIA</td>
                         <td class="Estilo1b">CANTIDAD</td>
                         <td class="Estilo1b">PRECIO</td>
                         <td class="Estilo1b">TOTAL</td>
                         <td class="Estilo1b">RESPONSABLE</td>
                         <td class="Estilo1b">TIPO</td>
                        </tr>

<?
     $sql="select * from argedo_correo where corre_region ='$regionsession' and corre_folioguia=0 order by corre_id desc";
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
?>
                       <tr>
                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["corre_id"] ?>" class="Estilo2" >  </td>
                         <td class="Estilo1b"><? echo substr($row3["corre_fecha"],8,2)."-".substr($row3["corre_fecha"],5,2)."-".substr($row3["corre_fecha"],0,4)   ?></td>
                         <td class="Estilo1b"><? echo $row3["corre_dependencia"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["corre_cantidad"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["corre_precio"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["corre_total"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["corre_responsable"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["corre_tipo"]  ?> </td>
                       </tr>

<?
   $cont++;
}
?>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Generar Guía "> </td>


                       <input type="hidden" name="cont" value="<? echo $cont ?>" >
                       <input type="hidden" name="sw2" value="1" >
                      </form>
                           </tr>



                      <tr>
                       <tr>
                       
                      </tr>


                      <table border=1>
<tr></tr>


<br>
<tr class="Estilo8">PASO 3: IMPRIMIR GUÍA DESPACHO INTERNO</tr> 

                        <tr>
                         <td class="Estilo1b">Nº de Guía</td>
                         <td class="Estilo1b">Nombre Destinatario</td>
                         <td class="Estilo1b">Fecha Guía</td>
                         <td class="Estilo1b">Ver Guía</td>
                        </tr>
<?
//  $sql="select * from argedo_recibida where reci_estado=1 and reci_folioguia=0 and reci_defensoria ='$regionsession' order by reci_folio desc";
  $sql="select * from argedo_correo where  corre_region ='$regionsession' and corre_folioguia<>0 group by corre_folioguia order by corre_folioguia desc LIMIT 0 , 20 ";


// echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){


?>


                       <tr>
                         <td class="Estilo1b"><? echo $row3["corre_folioguia"] ?> </td>
                         <td class="Estilo1b" title="<? echo $row3["corre_destinatario"]  ?>"><? echo $row3["corre_destinatario"]  ?></td>
                         <td class="Estilo1b" title="<? echo $row3["corre_fechaguia"]  ?>"><? echo $row3["corre_fechaguia"]  ?></td>
                         <td class="Estilo1c"><a href="argedo_imprimirguiacorreo.php?guia=<? echo $row3["corre_folioguia"] ?>" class="link" target="_blank">IMPRIMIR</a></td>

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
