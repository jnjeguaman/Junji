<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$nivel = $_SESSION["pfl_user"];

$regionsession = $_SESSION["region"];

$usuario=$_SESSION["nom_user"];

$deptosession=$_SESSION["depto"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}

$date_in=date("d-m-Y");

$date_in2=date("Y-m-d");

$ti=$_GET["ti"];

?>

<html>

<head>

  <title>Argedo</title>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  <link href="css/estilos.css" rel="stylesheet" type="text/css">
  <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
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

  if (document.form1.paises.value=='') {

    alert ("Area presenta problemas "+var33);

    return false;

  }

  if (document.form1.contrato.value=='' && 1==2) {

    //  alert ("Subarea presenta problemas ");

   //   return false;

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

  



  if (document.form1.op1[1].checked !='' && (document.form1.archivo1.value!='' || document.form1.archivo2.value!='' || document.form1.archivo3.value!='' || document.form1.archivo4.value!='')) {

    alert ("Documento reservado no pueden llevar archivo ");

    return false;

  }



  <?

}

if ($ti==2 or $ti==3 or $ti==7) {

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

   document.form1.materia2.value="";

   document.form1.materia.value="";



 }



//    if (document.form1.op1[2].checked!='')  {

//       seccion3.style.display="";

//       seccion1.style.display="none";

//       seccion2.style.display="none";

//       seccion4.style.display="none";

//       document.form1.materia.value="DECLARESE NO AFECTO A COBRO DE ARANCEL POR SERVICIOS DE DEFENSA PENAL A LAS PERSONAS QUE INDICA";

//       document.form1.materia2.value="";

//    }



if (document.form1.op1[1].checked!='') {

 seccion1.style.display="none";

 seccion2.style.display="none";

 seccion3.style.display="none";

 seccion4.style.display="none";

 document.form1.materia.value="RESERVADO";

 document.form1.materia2.value="";

//    document.getElementById("piso2").style.visibility="hidden";

//    document.getElementById("checkbox3").style.visibility="visible";

}

if (document.form1.op1[2].checked!='') {

 seccion1.style.display="none";

 seccion2.style.display="none";

 seccion3.style.display="none";

 seccion4.style.display="none";

 document.form1.materia.value="SECRETA";

 document.form1.materia2.value="";

//    document.getElementById("piso2").style.visibility="hidden";

//    document.getElementById("checkbox3").style.visibility="visible";

}



}



function llenar() {

 document.form1.materia2.value=document.form1.materia2.value+" "

}



function abreVentana(){

	miPopup = window.open("argedo_docmaster.php?id=<? echo $id ?>&id2=<? echo $id2 ?>","miwin","width=500,height=500,scrollbars=yes,toolbar=0")

	miPopup.focus()

}





//-->



</script>

<?



function generaPaises()  {
$ti=$_GET["ti"];
$region=$_SESSION["region"];

if($ti==1)
{
  if($region == 14)
  {
    $consulta=mysql_query("SELECT id,opcion FROM area WHERE region=14");
  }else{
    $consulta=mysql_query("SELECT id,opcion FROM area WHERE region=15");
  }
}else if($ti==2)
{
  if($region==14)
  {
    $consulta=mysql_query("SELECT id,opcion FROM area WHERE region=14 AND opcion NOT LIKE '%Departamento%'");
  }else{
     $consulta=mysql_query("SELECT id,opcion FROM area WHERE region=15 AND opcion NOT LIKE '%Subdireccion%'");
  }
}else if($ti==3)
{
  if($region == 14)
  {
     $consulta=mysql_query("SELECT id,opcion FROM area WHERE region=14");
  }else{
    $consulta=mysql_query("SELECT id,opcion FROM area WHERE region=15");
  }
}else if($ti==7)
{
  if($region == 14)
  {
     $consulta=mysql_query("SELECT id,opcion FROM area WHERE region=14");
  }else{
    $consulta=mysql_query("SELECT id,opcion FROM area WHERE region=15");
  }
}
//	include 'conexion.php';

//	conectar();

	//$consulta=mysql_query("SELECT id, opcion FROM area");
    /*if($_SESSION["region"] == 14)
  {
    $consulta = mysql_query("select id,opcion from area where region=3");
  }else{
     $consulta = mysql_query("select id,opcion from area where region=4");
  }*/

    //echo $consulta;

//	desconectar();



	// Voy imprimiendo el primer select compuesto por los paises

//	echo "<select name='paises' id='paises' onChange='cargaContenido2(this.id)'>";

	echo "<select name='paises' id='paises'>";

	echo "<option value='0'>Seleccione...</option>";

	while($registro=mysql_fetch_row($consulta)) {

		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";

	}

	echo "</select>";

}







if ($ti==1) {

 $prefijo="RESOLUCI�N EXENTA";



}

if ($ti==2) {

 $prefijo="RESOLUCI�N AFECTA CON TOMA";

}

if ($ti==3) {

 $prefijo="ORDINARIO";

}



if ($ti==7) {

 $prefijo="OFICIO CIRCULAR";

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

                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE DOCUMENTOS (<? echo $prefijo ?>)</span></td>

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

//   echo "<p><font color='#FF0000'>Registros NO insertados, Problemas con Tama�o de Archivos !</font></p>";

                     }

                   }



                   ?>

                 </td>

               </tr>



               <tr>

                 <td><hr></td><td><hr></td>





               </tr>

               <?

               $campo="fol_reg".$regionsession."_".$ti;

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



                    <tr><td><br></td><tr>

                      <tr>

                       <td  valign="center" class="Estilo1">Fecha Recepci�n Oficina de Partes</td>

                       <td class="Estilo1" valign="center">

                        <input type="hidden" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" ><? echo $date_in ?>



                      </td>

                    </tr>

                    <tr><td><br></td><tr>



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

                 <tr><td><br></td><tr>

                   <tr>

                     <td  valign="center" class="Estilo1">Fecha Documento <font color="#FF0000">* </font></td>

                     <td class="Estilo1">

                      <input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" >

                      <img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"

                      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



                      <script type="text/javascript">

                        Calendar.setup({

                          inputField : "f_date_c2",

                          trigger    : "f_trigger_c2",

                          onSelect   : function() { this.hide() },

                          showTime   : 12,

                          dateFormat : "%d-%m-%Y"

                        });

                      </script>





                    </td>

                  </tr>

                  <?php if ($ti==2): ?>

                    <!-- INTERVENCION FREDDY !-->
                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Ingreso CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_feccontra" class="Estilo2" size="12" value="<? echo $date_in ?>" id="docs_feccontra" >
                        <img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_feccontra",
                            trigger    : "f_trigger_c3",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>

                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Toma Raz�n CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_fectoma" class="Estilo2" size="12" value="<? echo $date_in ?>" id="docs_fectoma" >
                        <img src="calendario.gif" id="f_trigger_c4" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_fectoma",
                            trigger    : "f_trigger_c4",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>

                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Ingreso JUNJI por CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_fecing" class="Estilo2" size="12" value="<? echo $date_in ?>" id="docs_fecing" >
                        <img src="calendario.gif" id="f_trigger_c5" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_fecing",
                            trigger    : "f_trigger_c5",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>

                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Devoluci�n desde CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_fecdevo" class="Estilo2" size="12" value="<? echo $date_in ?>" id="docs_fecdevo" >
                        <img src="calendario.gif" id="f_trigger_c6" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_fecdevo",
                            trigger    : "f_trigger_c6",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>

                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Retiro sin tramitar desde CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_fecaretiro" class="Estilo2" size="12" value="<? echo $date_in ?>" id="docs_fecaretiro" >
                        <img src="calendario.gif" id="f_trigger_c7" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_fecaretiro",
                            trigger    : "f_trigger_c7",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>
                    <!-- FIN INTERVENCION !-->
                  <?php endif ?>

                  <tr>

                   <td><hr></td><td><hr></td>

                   <?

                   if ($regionsession==15 or $regionsession==8 AND 1==2) {

                    ?>

                    <tr>

                     <td  valign="center" class="Estilo1">N� Folio DocMaster</td>

                     <td class="Estilo1" colspan=3>

                      <input type="text" name="foliocmaster" class="Estilo2" size="18" value="" readonly>

                      <input type="hidden" name="iddocmaster" >

                      <a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana()">Asociar DocMaster</a>

                    </td>

                  </tr>



                  <?

                }

                if ($ti==7) {

                  ?>

                  <tr>

                   <td  valign="center" class="Estilo1">�REA <font color="#FF0000">* </font></td>

                   <td>
                    <?php generaPaises(); ?>
                    <!--<input type="text" name="paises" class="Estilo2" size=35 value="DIRECTOR DIRECTORA REGIONAL" readonly>!-->



                  </td>

                </tr>

                <?

              } else {

                ?>

                <tr>

                 <td  valign="center" class="Estilo1">�REA <font color="#FF0000">* </font></td>

                 <td><?php generaPaises(); ?>

                  <input type="hidden" name="tipo" class="Estilo2" size="40" value="" >

                </td>

              </tr>

              <?

            }

            ?>





<!--

                           <tr>

                             <td valign="center" class="Estilo1">SUB�REA <font color="#FF0000">* </font></td>

                             <td>

					            <select disabled="disabled" name="estados" id="estados">

  						          <option value="0">Seleccione...</option>

					            </select>

                             </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1"><br>EN TR�MITE  <font color="#FF0000">* </font></td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="radio" name="tramite" class="Estilo2" value="SI" > Si<br>

                              <input type="radio" name="tramite" class="Estilo2" value="NO" checked> No <br>

                             </td>

                           </tr>

                         -->

                         <?



                         if ($ti==1) {

                          ?>



                          <tr>

                           <td  valign="center" class="Estilo1"><br>LEY TRANSPARENCIA  </td>

                           <td class="Estilo1" colspan=3><br>

                            <input type="checkbox" name="transparencia" class="Estilo2" value="1" > Si<br>



                          </td>

                        </tr>







                        <tr>

                         <td  valign="center" class="Estilo1"><br>TIPO RESOLUCI�N EXENTA</td>

                         <td class="Estilo1" colspan=3><br>

                          <input type="radio" name="op1" class="Estilo2" value="NORMAL" checked onclick="mostrar();">Res. Exenta "Normal"<br>

                          <input type="radio" name="op1" class="Estilo2" value="RESERVADO" onclick="mostrar();">Res. Exenta "Reservado"<br>

                          <input type="radio" name="op1" class="Estilo2" value="SECRETA" onclick="mostrar();">Res. Exenta "Secreta"<br>

<!--

                              <input type="radio" name="op1" class="Estilo2" value="ARANCEL PAGO CERO" onclick="mostrar();">Arancel Pago Cero<br>

                            -->

                          </td>

                        </tr>

                      </table>

                      <div id="seccion1" style="display:none">

                       <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                         <td  valign="center" class="Estilo1"><br>NOMBRE FUNCIONARIO</td>

                         <td class="Estilo1" colspan=3><br>

                          <input type="text" name="nombre1" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >

                        </td>

                      </tr>

                      <tr>

                       <td  valign="center" class="Estilo1"><br>FECHA INICIO</td>

                       <td class="Estilo1" colspan=3><br>



                        <input type="text" name="fechaini1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c3" >

                        <img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"

                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



                        <script type="text/javascript">

                          Calendar.setup({

                            inputField : "f_date_c3",

                            trigger    : "f_trigger_c3",

                            onSelect   : function() { this.hide() },

                            showTime   : 12,

                            dateFormat : "%d-%m-%Y"

                          });

                        </script>



                      </td>

                    </tr>

                    <tr>

                     <td  valign="center" class="Estilo1"><br>FECHA T�RMINO</td>

                     <td class="Estilo1" colspan=3><br>

                      <input type="text" name="fechater1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c4" >

                      <img src="calendario.gif" id="f_trigger_c4" style="cursor: pointer; border: 1px solid red;" title="Date selector"

                      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



                      <script type="text/javascript">

                        Calendar.setup({

                          inputField : "f_date_c4",

                          trigger    : "f_trigger_c4",

                          onSelect   : function() { this.hide() },

                          showTime   : 12,

                          dateFormat : "%d-%m-%Y"

                        });

                      </script>





                    </td>

                  </tr>







                </table>

              </div>

              <div id="seccion2" style="display:none">

               <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>

                 <td  valign="center" class="Estilo1"><br>NOMBRE FUNCIONARIO</td>

                 <td class="Estilo1" colspan=3><br>

                  <input type="text" name="nombre2" class="Estilo2" size="40"  onkeyup="this.value=this.value.toUpperCase()" >

                </td>

              </tr>

              <tr>

               <td  valign="center" class="Estilo1"><br>DESTINO COMETIDO</td>

               <td class="Estilo1" colspan=3><br>

                <input type="text" name="destino2" class="Estilo2" size="40" onkeyup="this.value=this.value.toUpperCase()" >

              </td>

            </tr>



            <tr>

             <td  valign="center" class="Estilo1"><br>FECHA INICIO</td>

             <td class="Estilo1" colspan=3><br>

              <input type="text" name="fechaini2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c5" >

              <img src="calendario.gif" id="f_trigger_c5" style="cursor: pointer; border: 1px solid red;" title="Date selector"

              onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



              <script type="text/javascript">

                Calendar.setup({

                  inputField : "f_date_c5",

                  trigger    : "f_trigger_c5",

                  onSelect   : function() { this.hide() },

                  showTime   : 12,

                  dateFormat : "%d-%m-%Y"

                });

              </script>



            </td>

          </tr>

          <tr>

           <td  valign="center" class="Estilo1"><br>FECHA T�RMINO</td>

           <td class="Estilo1" colspan=3><br>

            <input type="text" name="fechater2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c6" >

            <img src="calendario.gif" id="f_trigger_c6" style="cursor: pointer; border: 1px solid red;" title="Date selector"

            onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



            <script type="text/javascript">

              Calendar.setup({

                inputField : "f_date_c6",

                trigger    : "f_trigger_c6",

                onSelect   : function() { this.hide() },

                showTime   : 12,

                dateFormat : "%d-%m-%Y"

              });

            </script>



          </td>

        </tr>







      </table>

    </div>

    <div id="seccion3" style="display:visibility">

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

         <td  valign="center" class="Estilo1" ><br>MATERIA 1 <font color="#FF0000">* </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

         <td class="Estilo1" colspan=1><br>

           <textarea name="materia" rows="3" cols="63" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>

         </td>

       </tr>

     </table>

   </div>

   <div id="seccion4" style="display:none">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

       <td  valign="center" class="Estilo1" ><br>MATERIA 2 <font color="#FF0000">* </font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

       <td class="Estilo1" colspan=1><br>

         <textarea name="materia2" rows="3" cols="63" class="Estilo2"  onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>

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





<table width="100%" border="0" cellspacing="0" cellpadding="0">



  <?





} else {

  ?>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>

     <td  valign="center" class="Estilo1" ><br>MATERIA 2<font color="#FF0000">* </font> </td>

     <td class="Estilo1" colspan=3><br>

       <textarea name="materia" rows="3" cols="40" class="Estilo2" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>

     </td>

   </tr>





   <?

 }

 if ($ti==3 or $ti==7 ) {

  ?>

<!--

                            <tr>

                             <td  valign="center" class="Estilo1">Tipo de Documento</td>

                             <td class="Estilo1" colspan=4>

                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DEPTO" > Oficio DEPTO  <br>

                              </td>

                           </tr>

                         -->

                         <?

                       }

                       ?>

                       <tr>

                         <td  valign="center" class="Estilo1" width="340"><br>DESTINATARIO  </td>

                         <td class="Estilo1" colspan=3><br>

                          <input type="text" name="destinatario" class="Estilo2" size="55" id="destinatario" onkeyup="this.value=this.value.toUpperCase()" ><a href="#" data-target="#myModal"  data-toggle="modal">Seleccionar</a>

                        </td>

                      </tr>



                      <tr>

                       <td  valign="center" class="Estilo1" width="340"><br>OBSERVACI�N  </td>

                       <td class="Estilo1" colspan=3><br>

                         <textarea name="obs" id="obs" rows="3" cols="40" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea><p></p>

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

           <?php if ($ti==2): ?>
            <tr>
             <td  valign="center" class="Estilo1">Derivado a <font color="#FF0000">* </font></td>
             <td><input type="text" name="docs_derivado" id="docs_derivado" class="Estilo2"></td>
           </tr>

           <tr>
             <td  valign="center" class="Estilo1">Fecha Derivaci�n <font color="#FF0000">* </font></td>
             <td><input type="text" name="docs_derivadofec" id="docs_derivadofec" class="Estilo2" value="<? echo $date_in ?>">
              <img src="calendario.gif" id="f_trigger_c8" style="cursor: pointer; border: 1px solid red;" title="Date selector"
              onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
              <script type="text/javascript">
                Calendar.setup({
                  inputField : "docs_derivadofec",
                  trigger    : "f_trigger_c8",
                  onSelect   : function() { this.hide() },
                  showTime   : 12,
                  dateFormat : "%d-%m-%Y"
                });
              </script>
            </td>
          </tr>

          <tr>
           <td  valign="center" class="Estilo1">Observaciones <font color="#FF0000">* </font></td>
           <td class="Estilo1">

            <textarea name="docs_obs2" id="docs_obs2" rows="3" cols="40" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea><p></p>

           </td>
         </tr>

         <tr>
           <td  valign="center" class="Estilo1">Fecha Observacions <font color="#FF0000">* </font></td>
           <td><input type="text" name="docs_obs2fecha" id="docs_obs2fecha" class="Estilo2" value="<? echo $date_in ?>">
            <img src="calendario.gif" id="f_trigger_c9" style="cursor: pointer; border: 1px solid red;" title="Date selector"
            onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
            <script type="text/javascript">
              Calendar.setup({
                inputField : "docs_obs2fecha",
                trigger    : "f_trigger_c9",
                onSelect   : function() { this.hide() },
                showTime   : 12,
                dateFormat : "%d-%m-%Y"
              });
            </script>
          </td>
        </tr>
      <?php endif ?>
      <!--<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
      <script type="text/javascript">
        Calendar.setup({
          inputField : "docs_feccontra",
          trigger    : "f_trigger_c3",
          onSelect   : function() { this.hide() },
          showTime   : 12,
          dateFormat : "%d-%m-%Y"
        });
      </script>!-->


      <tr>

       <td  valign="center" class="Estilo1"><br>  </td>

       <td  valign="center" class="Estilo1"> </td>



     </tr>



     <tr>

       <td  valign="center" class="Estilo1"><br> </td>

       <td  valign="center" class="Estilo1"> </td>



     </tr>

     <tr>

       <td colspan=4 align="center" class="Estilo7">�ltimo Correlativo : <? echo $foliomio ?>, el pr�ximo es : <? echo $foliomio2 ?> </td>

     </tr>

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



     <input type="hidden" name="ti" value="<? echo $ti; ?>" >

     <input type="hidden" name="prefijo" value="<? echo $prefijo; ?>" >

     <input type="hidden" name="contrato" >



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

       <td class="Estilo1b">FOLIO</td>

       <td class="Estilo1b">TIPO DOCUMENTO</td>

       <td class="Estilo1b">FECHA DOCUMENTO</td>

       <td class="Estilo1b">MATERIA</td>

       <td class="Estilo1b">AREA</td>

       <td class="Estilo1b">TRAMITE</td>

       <td class="Estilo1b">FICHA</td>



     </tr>



     <?







     if ($regionsession==0) {

       $sql="select * from argedo_documentos where  eta_estado=1 and eta_folioguia=0 order by eta_folio desc limit 0,10";

     } else {

       $sql="select * from argedo_documentos where docs_estado=1 and docs_folioguia=0 and docs_defensoria ='$regionsession' and docs_tipo='$ti'  order by docs_fecha desc, docs_folio desc limit 0,10";

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

    if ($areanombre=='') {

      $areanombre=$row3["docs_area"];

    }



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

     <td class="Estilo1b"><? echo $row3["docs_tramite"]  ?> </td>

     <td class="Estilo1b"><a href="argedo_ficharesyofi.php?id=<? echo $row3["docs_id"]; ?>&ti=<? echo $ti; ?>&ori=1" class="link" > VER  </a> </td>







   </tr>











   <?



   $cont++;



 }

 ?>









 <tr>

   <tr>



   </tr>







   <img src="images/pix.gif" width="1" height="10">

   <!-- Modal -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">SELECCIONE EL O LOS DESTINATARIO(S)</h4>
        </div>
        <div class="modal-body">
          <center>
            <select class="regiones" id="regiones" multiple style="width: 70%; height:100px;">
              <option selected value="">Seleccionar...</option>
             <?php 

             if($_GET["ti"]==1)
{
  if($_SESSION["region"] == 14)
  {
    $sql="SELECT id,opcion FROM area WHERE region=14";
  }else{
    $sql="SELECT id,opcion FROM area WHERE region=15";
  }
}else if($_GET["ti"] == 2)
{
  if($_SESSION["region"] == 14)
  {
    $sql = "SELECT id,opcion FROM area WHERE region=14 AND opcion NOT LIKE '%Vice%'";
  }else{
    $sql = "SELECT id,opcion FROM area WHERE region=15 AND opcion NOT LIKE '%Directora%'";
  }
}else if($_GET["ti"] == 3)
{
if($_SESSION["region"] == 14)
  {
    $sql = "SELECT id,opcion FROM area WHERE region=14 AND opcion NOT LIKE '%Vice%'";
  }else{
     $sql = "SELECT id,opcion FROM area WHERE region=14 AND opcion NOT LIKE '%Directora%'";
  }
}else if($_GET["ti"] == 7)
              {
                $sql ="SELECT * from regiones";
              }
              //$sql = "SELECT * FROM regiones";
             /*if($ti == 7)
             {
              $sql = "SELECT * FROM regiones";
            }else{
              if($_SESSION["region"] == 14)
              {
                $sql = "SELECT * from area where region = 1";
              }else{
                $sql = "SELECT * from area where region = 2";
              }
            }*/
              $res = mysql_query($sql,$dbh);
              $cont=0;
              while($row = mysql_fetch_array($res)){
               ?>
               <option value="<?php echo ($ti==7) ? $row["nombre"] : $row["opcion"] ?>"><?php echo ($ti==7) ? $row["nombre"] : $row["opcion"] ?></option>
               <?php $cont++;} ?>
               <?php if ($ti==3): ?>
                 <option value="Otro">Otro</option>
               <?php endif ?>

               <?php if ($ti==2): ?>
                <?php if ($_SESSION["region"] == 14): ?>
                 <option value="Contraloria General de la Republica">Contraloria General de la Republica</option>
                <?php endif ?>
               <?php endif ?>
             </select>
           </center>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onClick="getRegiones()">Aplicar</button>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    
    $('#obs').keypress(function(e) {
      var tval = $('#obs').val(),
      tlength = tval.length,
      set = 10,
      remain = parseInt(set - tlength);
      $('p').text("Caracteres restantes: "+remain);
      if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('#obs').val((tval).substring(0, tlength - 1))
      }
    })

$('#docs_obs2').keypress(function(e) {
      var tval = $('#docs_obs2').val(),
      tlength = tval.length,
      set = 10,
      remain = parseInt(set - tlength);
      $('p').text("Caracteres restantes: "+remain);
      if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('#docs_obs2').val((tval).substring(0, tlength - 1))
      }
    })

    function getRegiones()
    {
      var regionesSeleccionadas="";
      var totalElementos = $("#regiones :selected").length;
      console.log($("#regiones :selected").length);
      var contador = 1;
      $('#regiones :selected').each(function(i, selected){ 
        if(contador == totalElementos)
        {
          regionesSeleccionadas+=$(selected).val();
        }else{
          regionesSeleccionadas+=$(selected).val()+",";
        }
        contador++;
      });
      $("#destinatario").val(regionesSeleccionadas);
      $("#myModal").modal("hide");
    }
  </script>
</body>

</html>



<?



?>

