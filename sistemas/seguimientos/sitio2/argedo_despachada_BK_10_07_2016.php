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

}

//-->



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

//	include 'conexion.php';

//	conectar();

	$consulta=mysql_query("SELECT id, opcion FROM area");

    //echo $consulta;

//	desconectar();



	// Voy imprimiendo el primer select compuesto por los paises

	echo "<select name='tipo' id='tipo'>";

	echo "<option value='0'>Seleccione...</option>";

	while($registro=mysql_fetch_row($consulta))

	{

		echo "<option value='".$registro[1]."'>".$registro[1]."</option>";

	}
  generaRegiones();
  echo "<option value='Municipalidad'>Municipalidad</option>";
  echo "<option value='Ministerio'>Ministerio</option>";
  echo "<option value='Isapres'>Isapres</option>";
  echo "<option value='Suceso'>Suceso</option>";
  echo "<option value='Proveedor'>Proveedor</option>";
  echo "<option value='Instituciones'>Instituciones</option>";
  echo "<option value='Caja de compensaci&oacute;n'>Caja de compensaci&oacute;n</option>";
  echo "<option value='Contralor&iacute;a General de la Rep&uacute;blica'>Contralor&iacute;a General de la Rep&uacute;blica</option>";
  echo "<option value='Subsecretaria'>Subsecretaria</option>";
  echo "<option value='Otros'>Otros</option>";
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

                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE EXPEDIENTE</span></td>

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

  $campo="fol_reg".$regionsession."_5";

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

                    

					<table width="488" border="0" cellspacing="0" cellpadding="0">

				  <form name="form1" action="argedo_grabadespachada.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">



<tr class="Estilo8"><td colspan="4">PASO 1: INGRESO DE DOCUMENTO<td></tr>





<tr>

                             <td  valign="center" class="Estilo1">FECHA RECEPCIÓN OfICINA DE PARTES</td>

                             <td class="Estilo1" valign="center">

<input type="hidden" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" ><? echo $date_in ?>



                             </td>

                           </tr>

                          <tr><td><br></td><tr>

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

                            <tr><td><br></td><tr>

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



                      <tr>

                       <td><hr></td><td><hr></td>

                            <tr>

                             <td  valign="center" class="Estilo1">AREA <font color="#FF0000">* </font></td>

				             <td><?php generaPaises(); ?>
                             </td>

                           </tr>

<!--

                           <tr>

                             <td valign="center" class="Estilo1">SUBAREA <font color="#FF0000">* </font></td>

                             <td>

					            <select disabled="disabled" name="estados" id="estados">

  						          <option value="0">Seleccione...</option>

					            </select>



                             </td>

                           </tr>

-->

                            <tr>

                             <td  valign="center" class="Estilo1"><br>DESTINATARIO  </td>

                             <td class="Estilo1" colspan=3><br>

                              <textarea name="destinatario" rows="2" cols="50" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1"><br>NÚMERO EXTERNO  </td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="text" name="numero" class="Estilo2" size="11" onkeyup="this.value=this.value.toUpperCase()" >

                             </td>

                           </tr>
  
  <tr>

                             <td  valign="center" class="Estilo1"><br>NÚMERO INTERNO  </td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="text" name="origen" class="Estilo2" size="11" onkeyup="this.value=this.value.toUpperCase()" >

                             </td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1" >MATERIA  <font color="#FF0000">* </font></td>

                             <td class="Estilo1" colspan=3><br>

                             <textarea name="materia" rows="3" cols="50" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">TIPO DE DOCUMENTO</td>

                             <td class="Estilo1" colspan=4>

                                <select name="tipodoc" class="Estilo1">

                                    <option value="">Seleccione...</option>



                                 <?

                                  $sql2 = "Select * from argedo_tipodoc order by tipodoc_nombre ";

                                  $res2 = mysql_query($sql2);



                                   while($row2 = mysql_fetch_array($res2)){



                                 ?>

                                    <option value="<? echo $row2["tipodoc_nombre"] ?>"><? echo $row2["tipodoc_nombre"] ?></option>



                                 <?

                                   }

                                 ?>





                               </select>



                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">REMITE  </td>

                             <td class="Estilo1" colspan=3><br>

                              <textarea name="remite" rows="2" cols="50" class="Estilo2" onkeyup="this.value=this.value.toUpperCase()" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>

                             </td>

                           </tr>

<!--

                            <tr>

                             <td  valign="center" class="Estilo1">TIPO DESPACHO  </td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="text" name="tipodes" class="Estilo2" size="40"  onkeyup="this.value=this.value.toUpperCase()" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; ">

                             </td>

                           </tr>

-->





                            <tr>

                             <td  valign="center" class="Estilo1"><br>OBSERVACIÓN  </td>

                             <td class="Estilo1" colspan=3><br>

                             <textarea name="obs" rows="3" cols="50" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>

                             </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 1</td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="file" name="archivo1" class="Estilo2" size="40"  >

                             </td>

                           </tr>



                          <tr>

                            <td  valign="center" class="Estilo1" colspan="4"><BR><font color="#FF0000"> * CAMPOS OBLIGATORIOS </font></td>

                           </tr>







                      </tr>

                     <tr>

                       <td><br></td><td><br></td>





                      </tr>







                           <tr>

                               <td  valign="center" class="Estilo1"><br>  </td>

                               <td  valign="center" class="Estilo1"> </td>



                           </tr>



                           <tr>

                               <td  valign="center" class="Estilo1"><br> </td>

                               <td  valign="center" class="Estilo1"> </td>



                           </tr>

                           <tr>

                             <td colspan=4 align="center" class="Estilo7">Último Correlativo : <? echo $foliomio ?>, el próximo es : <? echo $foliomio2 ?> </td>

                           </tr>

                           <tr>

                               <td  valign="center" class="Estilo1"><br>  </td>

                               <td  valign="center" class="Estilo1"> </td>



                           </tr>



                           <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR DESPACHO    " > </td>

                           </tr>



                              <input type="hidden" name="ti" value="<? echo $ti; ?>" >

                              <!-- <input type="hidden" name="contrato" > -->



                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      





                      <tr>

                      <td colspan="8">

                      <table border=0>



<br>





<tr class="Estilo8">PASO 2: CONFECCIÓN GUÍA DESPACHO INTERNO</tr> 



<?



?>

                        <tr>

                         <td class="Estilo1" colspan=4></td>

                        </tr>

</table>



                        <tr>

                         <td class="Estilo1" colspan=4>

                      <form name="form2" action="argedo_grabaasignaguia2.php" method="post"  >

        <table border=1>

          <tr>

                             <td  valign="center" class="Estilo1" colspan=9>Destinatario

                                <input type="text" name="destinatario" class="Estilo2" size="50" >

                              <td>





                           </tr>







                        <tr>

                         <td class="Estilo1b">ITEM</td>
                         
                         <td class="Estilo1b">N° INTERNO</td>

                         <td class="Estilo1b">FOLIO</td>

                         <td class="Estilo1b">FECHA</td>

                         <td class="Estilo1b">TIPO</td>

                         <td class="Estilo1b">DESTINATARIO</td>

                         <td class="Estilo1b">MATERIA</td>

                        </tr>



<?







if ($regionsession==0) {

     $sql="select * from argedo_despachada where despa_estado=1 and despa_folioguia=0 order by despa_folio desc";

} else {

     $sql="select * from argedo_despachada where despa_estado=1 and despa_folioguia=0 and despa_defensoria ='$regionsession' order by despa_folio desc";

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

   

   $areaid=$row3["despa_area"];

   $subareaid=$row3["despa_subarea"];



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

                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["despa_id"] ?>" class="Estilo2" >  </td>

                         <td class="Estilo1b"><? echo $row3["despa_origen"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["despa_folio"]  ?> </td>

                         <td class="Estilo1b"><? echo substr($row3["despa_fecha_recep"],8,2)."-".substr($row3["despa_fecha_recep"],5,2)."-".substr($row3["despa_fecha_recep"],0,4)   ?></td>

                         <td class="Estilo1b"><? echo $row3["despa_tipodoc"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["despa_destinatario"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["despa_materia"]  ?> </td>



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

                         <td class="Estilo1b">Nº GUÍA</td>

                         <td class="Estilo1b">NOMBRE DESTINATARIO</td>

                         <td class="Estilo1b">FECHA GUÍA</td>

                         <td class="Estilo1b">VER GUÍA</td>

                        </tr>

<?

//  $sql="select * from argedo_despachada where despa_estado=1 and despa_folioguia=0 and despa_defensoria ='$regionsession' order by despa_folio desc";

  $sql="select * from argedo_despachada where despa_defensoria='$regionsession' and despa_folioguia<>0 group by despa_folioguia order by deSpa_folioguia desc LIMIT 0 , 10 ";



// echo $sql;

$res3 = mysql_query($sql);

$cont=1;



while($row3 = mysql_fetch_array($res3)){

    $fechahoy = $date_in;

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



?>





                       <tr>

                         <td class="Estilo1b"><? echo $row3["despa_folioguia"] ?> </td>

                         <td class="Estilo1b" title="<? echo $row3["despa_destinatario2"]  ?>"><? echo $row3["despa_destinatario2"]  ?></td>

                         <td class="Estilo1b" title="<? echo $row3["deapa_fechaguia"]  ?>"><? echo $row3["despa_fechaguia"]  ?></td>

                         <td class="Estilo1c"><a href="argedo_imprimirguia2a.php?guia=<? echo $row3["despa_folioguia"] ?>" class="link" target="_blank">IMPRIMIR</a></td>



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

