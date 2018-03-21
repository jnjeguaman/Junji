<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$nivel = $_SESSION["pfl_user"];

$regionsession = $_SESSION["region"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}



$date_in=date("d-m-Y");

$read1= rand(0,1000000);

$read2= rand(0,1000000);

$read3= rand(0,1000000);

$read4= rand(0,1000000);

$fechamia2 = date("d-m-Y");



?>

<html>

<head>

	<title>Facturas y/o Boletas</title>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<link href="css/estilos.css" rel="stylesheet" type="text/css">

	<script src="../../inventario/privado/sitio2/librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
	<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">

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

		.Estilo1cen {

			font-family: Verdana;

			font-weight: bold;

			font-size: 10px;

			color: #003063;

			text-align: center;

		}

		.Estilo1c {

			font-family: Verdana;

			font-weight: bold;

			font-size: 10px;

			color: #009900;

			text-align: right;

		}

		.Estilo2 {

			font-family: Verdana;

			/*font-size: 14px;*/

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

		.link2 {

			font-family: Geneva, Arial, Helvetica, sans-serif;

			font-size: 10px;

			font-weight: bold;

			color: #FF0000;

			text-decoration:none;

			text-transform:uppercase;

		}

		.link2:over {

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

			font-weight: bold;}

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

  

  

  <script src="librerias/js/jscal2.js"></script>

  <script src="librerias/js/lang/es.js"></script>

  <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />

  <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />

  <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />



  

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
	// VALIDACION EXTENCION ARCHIVO CESION DE FACTURAS
	var ant1 = document.form1.ant1.value;
	if(ant1 != "")
	{
		var extension = ant1.split(".").pop().toUpperCase();
		if(extension != "PDF" && extension != "PNG" && extension != "JPEG")
		{
			alert("La extension permitida es : .PDF .PNG .JPEG");
			document.form1.ant1.focus();
			return false;
		}
	}

	if(document.form1.vb.value=='')

	{

		alert("Tipo presenta problemas");

		return false;

	}



	if (document.form1.servicio.value=='') {

		alert ("Descripcion Servicio presenta problemas ");

		return false;

	}

	if(document.form1.item.value == "")

	{

		alert("Subtítulo presenta problemas");

		document.form1.item.focus();

		return false;

	}

  //  if ((document.form1.item[0].checked=='' && document.form1.item[1].checked==''  && document.form1.item[2].checked=='' && document.form1.item[3].checked=='' && document.form1.item[4].checked=='' && document.form1.item[5].checked=='')) {

  //     alert ("Descripcion Item presenta problemas ");

  //     return false;

  // }

  if (document.form1.modalidad.value=='' ) {

  	alert ("Descripcion modalidad presenta problemas ");

  	return false;

  }

  if (document.form1.modalidad.value=='' ) {

 //     alert ("Descripcion Departamento presenta problemas ");

 //     return false;

}

if (document.form1.archivo1.value=='' && document.form1.archivo111.value=='') {

	alert ("Imagen de la Factura presenta problemas ");

	return false;

}

if (document.form1.archivo2.value=='' && document.form1.archivo222.value=='') {

	alert ("Imagen de la Orden de Compra presenta problemas ");

	return false;

}



}

function valida2() {

	

	if (document.form22.accion.value=='' ) {

		alert ("Accion presenta problemas");

		return false;

	}



	if (document.form22.fechavb.value=='' ) {

		alert ("Fecha V°B° presenta problemas");

		return false;

	}



	if(document.form22.vb.value == "SERVICIO")

	{

		if(document.form22.dias.value=='')

		{

			alert("Dias presenta problemas");

			return false;

		}

	}



	if (document.form22.comentario.value=='' && (document.form22.accion.value==10 || document.form22.accion.value==99)) {

		alert ("Justificacion Presenta Problemas");

		return false;

	}

	if (document.form22.accion.value==10 ) {

		if (confirm('¿ Seguro que Desea Rechazar ?')) {

			return true

		} else {

			return false

		}



	}



	if ( document.form22.accion.value==99 ) {

		if (confirm('¿ Seguro que Desea Rechazar ?')) {

			return true

		} else {

			return false

		}





	}







}

function validaGrabar() {

	if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    	blockUI();
  	}
  	else{
    	return false;
  	}
}


function muestra() {



	if (document.form22.accion.value==99 ) {

		seccion1.style.display="";

		seccion2.style.display="";

	} else {

		seccion1.style.display="none";

		seccion2.style.display="none";

	}

			 if (document.form22.accion.value == 3) {

		       seccion.style.display="";

		       $("#justifica").attr("required",true);


		     } else {

		       seccion.style.display="none";

		       $("#justifica").attr("required",false);

		     }



}





function abreVentana(tipores){

	miPopup = window.open("compra_listaresolucion.php?id=<? echo $id ?>&id2=<? echo $id2 ?>&tipores="+tipores,"miwin","width=500,height=500,scrollbars=yes,toolbar=0")

	miPopup.focus()

}


function abreVentana0(eta_id,rut,dig){

	miPopup = window.open("compra_asocia_nc.php?id="+eta_id+"&id2=<? echo $id2 ?>&rut="+rut+"&dig="+dig,"miwin","width=850,height=300,scrollbars=yes,toolbar=0")

	miPopup.focus()

}

function abreVentana1(eta_id,rut,dig){

	miPopup = window.open("compra_asocia_nd.php?id="+eta_id+"&id2=<? echo $id2 ?>&rut="+rut+"&dig="+dig,"miwin","width=850,height=300,scrollbars=yes,toolbar=0")

	miPopup.focus()

}




function abreVentana2(oc,eta_id){

	miPopup = window.open("compra_asocia_rc.php?id="+eta_id+"&id2=<? echo $id2 ?>&oc="+oc,"miwin","width=850,height=300,scrollbars=yes,toolbar=0")

	miPopup.focus()

}



function abreVentana3(oc,eta_id){

	miPopup = window.open("compra_asocia_rt.php?id="+eta_id+"&id2=<? echo $id2 ?>&oc="+oc,"miwin","width=850,height=300,scrollbars=yes,toolbar=0")

	miPopup.focus()

}



function abreVentana4(id,numerooc,id2,ori){

	miPopup = window.open("bitacora_subirarchivoo.php?id="+id+"&numerooc="+numerooc+"&id2="+id2+"&ori="+ori,"miwin","width=600,height=300,scrollbars=yes,toolbar=0")

	miPopup.focus()

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



			<div class="col-sm-9 col-lg-9">

				<div class="dash-unit2">

					<table width="100%" border="0" cellspacing="0" cellpadding="0">

						<tr>

							<td height="20" colspan="2"><span class="Estilo7">CREAR SET DE PAGO</span></td>

						</tr>

						<tr>

							<td><hr></td><td><hr></td>

						</tr>



						<?

						if (isset($_GET["llave"]))

							echo "<p>Registros insertados con Éxito !";



						$id=$_GET["id"];

						$id2=$_GET["id2"];

						$id1b=$_GET["id1b"];

						$nroorden2=$_GET["nroorden2"];

						if ($id2<>'') {

							$sql5="select * from dpp_facturas x, dpp_etapas y where eta_id=$id1b and fac_eta_id=eta_id ";

						} else {

							$sql5="select * from dpp_facturas x, dpp_etapas y where fac_id=$id and fac_eta_id=eta_id ";

						}

// echo $sql5;

						$res5 = mysql_query($sql5);

						$row5=mysql_fetch_array($res5);

//$archivo5=$row5["fac_"];

						$idetapa=$row5["eta_id"];

						$etaporroid=$row5["eta_prorro_id"];

						$etanumero=$row5["eta_numero"];

						$etarut=$row5["eta_rut"];

						$eta_nroorden=$row5["eta_nroorden"];



//BUSQUEDA DE LA OC

// $oc = "SELECT count(oc_id) as Total FROM compra_orden a INNER JOIN compra_detoc b ON b.doc_compra_id = a.oc_id WHERE oc_numero = '".$eta_nroorden."'";

						$oc = "SELECT count(oc_id) as Total,oc_id,oc_tipo2,oc_solicitud_archivo,oc_numero,oc_compromiso_archivo,oc_sc,oc_obs FROM compra_orden WHERE oc_numero = '".$eta_nroorden."'";

						$ocRes = mysql_query($oc);

						$rowRes = mysql_fetch_array($ocRes);

//$etanumero=214;

//$etarut=76096016;



//echo "$etanumero $etarut <br>";



						if ($nroorden2<>'') {

							$sql9="update compra_orden set oc_estado='RECEPCION CONFORME' where oc_eta_id ='$nroorden2' ";

//    echo $sql9;

							mysql_query($sql9);



						}





						?>

						<tr>

							<td width="487" valign="top" class="Estilo1">
								
								<?php if ($_SESSION["pfl_user"] == 7): ?>
									<?php if ($_GET["ori"] == 1): ?>
										<a href="verdevueltos2.php" class="link">VOLVER</a>
									<?php else: ?> 
										<a href="valida2asignacion.php" class="link">VOLVER</a>
									<?php endif ?>

								<?php else: ?>
									
									<?php if ($_GET["ori"] == 1): ?>
										<a href="verdevueltos2.php" class="link">VOLVER</a>
									<?php else: ?>
										<a href="valida2asignado.php" class="link">VOLVER</a>
									<?php endif ?>
									
								<?php endif ?>

								/

								<a href="dpp_plantilla2.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>" class="link">Asociar Plantilla</a> /

								<?

								if ($etaporroid<>0) {

									?>

									<a href="dpp_plantillaficha2.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&id2=<? echo $etaporroid ?>&ori=3" class="link">Plantilla Asociada</a>

									<?

								}

								?>





								<br>

							</tr>

							<tr>

								<td><hr></td><td><hr></td>

							</tr>

							<tr>



								<tr>

									<td width="487" valign="top" class="Estilo1">

										<br>

									</tr>

									<tr>

										<td width="487" valign="top" class="Estilo1">



											<?





											?>



										</td>

									</tr>

								</table>

								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								
							<?php if (!isset($_GET["ori"])): ?>


									<form name="form22" action="cambiaestado.php" method="post"  onSubmit="return valida2()"  enctype="multipart/form-data">




										

											<tr>

												<td  valign="top" class="Estilo1">Acción  </td>

												<td class="Estilo1" colspan=3>

													<select name="accion" class="Estilo1" onchange="muestra();">

														<?

														if ($regionsession==15 and 1==2){

															?>

															<option value='2' <? if ($row5["eta_estado"]==2) echo "selected=selected";  ?> >1.- Derivación A VºBº </option>

															<option value='99' <? if ($row5["eta_estado"]==99) echo "selected=selected";  ?> >2.- Eliminar Documento</option>

															<?

														}

														if ($regionsession<>15 or 1==1) {

															?>

															<option value="">Seleccione...  </option>                              

															<option value='4' <? if ($row5["eta_estado"]==4) echo "selected=selected";  ?>>1.- Enviar a: "Envíos Set de Pagos"</option>

															<?
															if ($nivel == 7) {
																?>
																<option value="3">2.- Devolver a OF. Partes</option>
																<?
															}
															?>

															<option value='99' <? if ($row5["eta_estado"]==99) echo "selected=selected";  ?> >3.- Eliminar Documento</option>

															<?

														}

														?>

													</select>

												</td>

											</tr>



											<?

											if ($regionsession<>15 or 1==1) {



												if  ($row5["eta_fecha_aprobacionok"]=='0000-00-00') {

													$fecha6=$fechamia2;

												} else {

													$fecha6=substr($row5["eta_fecha_aprobacionok"],8,2)."-".substr($row5["eta_fecha_aprobacionok"],5,2)."-".substr($row5["eta_fecha_aprobacionok"],0,4);

												}

												?>

												<tr>

													<td  valign="top" class="Estilo1">Fecha V°B° </td>

													<td class="Estilo1" valign="center">

														<input type="text" name="fechavb" class="Estilo2" size="12" value="<? echo $fecha6 ?>" id="f_date_c1" readonly="1">

														<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"

														onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />







    <script type="text/javascript">//<![CDATA[

    	Calendar.setup({

    		inputField : "f_date_c1",

    		trigger    : "f_trigger_c1",

    		onSelect   : function() { this.hide() },

    		showTime   : 12,

    		dateFormat : "%d-%m-%Y"

    	});

    	//]]></script>









    	<?

    }

    ?>
    <div id="seccion" style="display:none">

		Justificar Devolucion <br>

		<input type="text" name="justifica" id="justifica" class="Estilo2" size="60">

	</div>

    <div id="seccion2" style="display:none">



    	Justificación del Rechazo<br>

    	<input type="text" name="comentario" class="Estilo2" size="40" value="<? echo $row5["eta_rechaza_motivo1"] ?>" >

    </div>

</td>

</tr>



                            <!-- <tr id="SERVICIO">

                            <td class="Estilo1">Días</td>

                            <td class="Estilo1"><input type="number" min="0" max="30" name="dias" value="<?php echo $row5["eta_dias"] ?>"></td>

                        </tr> -->

                        <?



//    $cliente2 = new nusoap_client('http://10.16.25.62/sistemas/servicios/atencion/servicio5.php');



 //   require_once('inc2/nusoap.php');



// -     $cliente = new nusoap_client('http://10.16.25.62/sistemas/servicios/atencion/servicio2.php');

// -    $resultado = $cliente->call('busca2', array('x' => $etarut, 'y' => $etanumero, 'operacion' => 'multiplica'));



//    $cliente = new nusoap_client('http://10.17.5.183/sdi/atencion/servicio2.php');

//    echo "-->".$resultado."<br>";

                        $codigo2 = explode("|", $resultado);

//    echo "-->".$codigo2[4];

                        $codigo3 =$codigo2[1];







// -    $cliente2 = new nusoap_client('http://10.16.25.62/sistemas/servicios/atencion/servicio5.php');

// -    $resultado2 = $cliente2->call('busca55', array('x' => $etarut, 'y' => $etanumero, 'operacion' => 'multiplica'));



//    echo "-->".$resultado2."<br>";

                        if ($resultado2<>'') {

                        	?>

                        	<a href="javascript:void(0)" onclick="window.open('listaperitaje.php?rut=<? echo $etarut; ?>&id=<? echo $id; ?>&id1b=<? echo $id1b ?>','','width=700,height=600,scrollbars=1,location=1')"></a>



                        	<?

                        }

                        $codigo22 = explode("|", $resultado2);

//    echo ".";

//    echo "-->".$codigo22[4];

//    $codigo32 =$codigo22[1];





                        ?>

                        <tr>

                        	<td>



                        	</td>

                        </tr>



                        <?

                        $a0=$row5["eta_estado"];

                        $a1=$row5["fac_servicio"];

                        $a2=$row5["eta_item"];

                        $a3=$row5["fac_archivo"];
                        if ($a1<>"" and $a2<>"" and $a3<>"" )   {



                        	?>

                        	<tr>

                        		<td  valign="top" class="Estilo1" colspan=4>
                        			<?php if ($row5["eta_fechaguia2"] == '0000-00-00 00:00:00' || $row5["eta_fecha_aprobacionok"] == '0000-00-00'): ?>
                        				<input type="submit" class="Estilo2" value="Grabar Acción " >
                        			<?php endif ?>
	<!--
                        			<?

                        			if ($codigo3>=104 or $codigo3=='' ) {

                        				?>

                        				<input type="submit" class="Estilo2" value="Grabar Acción " >

                        				<?

                        			} else {

                        				echo "¡ Documento en espera de aprobación SIGDP ! ";

                        			}

                        			?>
                        			!-->
                        		</td>

                        	</tr>

                        	<div id="seccion1" style="display:none">

                        	</div>

                        	<?

                        } else {

                        	?>

                        	<tr>

                        		<td  valign="top" class="Estilo1" colspan=4>

                        			<div id="seccion1" style="display:none">

                        				<input type="submit" class="Estilo2" value="Grabar Acción 2" >

                        			</div>

                        		</td>

                        	</tr>

                        	<?

                        }

                        ?>



                    <?php endif ?>






                    <tr>

                    	<td  valign="center" class="Estilo1" colspan=8><hr></td>

                    </tr>

                    <input type="hidden" name="id" value="<? echo $id  ?>">

                    <input type="hidden" name="id2" value="<? echo $row5["eta_id"];  ?>">
                </form>

                <!-- <form name="form1" action="grabafacturaarchivo.php" method="post"  enctype="multipart/form-data"  onSubmit="return valida()"> -->
                <form name="form1" action="grabafacturaarchivo.php" method="post"  enctype="multipart/form-data" onsubmit="return validaGrabar()">

                	<?

                	$facfolio=$row5["fac_folio"];

                	if ($row5["eta_rechaza_motivo2"]<>"") {

                		?>

                		<tr>

                			<td  align="center" class="Estilo1c" colspan="4"><a href="grabaaceptarechazo2.php?id=<? echo $row5["eta_id"] ?>" class="link">ACEPTA RECHAZO</a> <br></td>

                		</tr>

                		<tr>

                			<td  align="center" class="Estilo1c" colspan="4"><? echo $row5["eta_rechaza_motivo2"] ?> <br></td>

                		</tr>

                		<?

                	}

                	?>



                	<tr>

                		<td  valign="center" class="Estilo1">Folio</td>

                		<td class="Estilo1" colspan=3><? echo $row5["fac_folio"]; ?>

                		</td>

                	</tr>



                	<tr>

                		<td  valign="center" class="Estilo1">Nº Factura </td>

                		<td class="Estilo1" colspan=3><? echo $row5["fac_numero"] ?>



                		</td>

                	</tr>



                	<tr>

                		<td  valign="center" class="Estilo1">Fecha Factura</td>

                		<td class="Estilo1">



                			<?

                			$a=$row5["fac_fecha_fac"];

                                     //echo $a."-";

                			echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);



                			?>





                		</td>

                	</tr>



                	<tr>

                		<td  valign="center" class="Estilo1">Monto </td>

                		<td class="Estilo1" colspan=3><? echo $row5["fac_monto"] ?>



                		</td>

                	</tr>



                	<tr>

                		<td  valign="center" class="Estilo1">Nombre Proveedor </td>

                		<td class="Estilo1" colspan=3><? echo $row5["fac_cli_nombre"] ?>

                		</td>

                	</tr>



                	<tr>

                		<td  valign="center" class="Estilo1">Rut Proveedor </td>

                		<td class="Estilo1" colspan=3><? echo $row5["fac_rut"]."-".$row5["fac_dig"]; ?>

                		</td>

                	</tr>









                	<tr>

                		<td  valign="center" class="Estilo1">Fecha Recepción</td>

                		<td class="Estilo1" valign="center">

                			<?

                			$a=$row5["fac_fecha_recepcion"];

                                     //echo $a."-";

                			echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);



                			?>







                		</td>

                	</tr>





                	<tr>

                		<td  valign="center" class="Estilo1">Regi&oacute;n</td>

                		<td class="Estilo1">

                			<?

                			$region=$row5["fac_region"];

                			$sql2 = "Select * from regiones where codigo='$region'";

                                    //echo $sql;

                			$res2 = mysql_query($sql2);

                			$row2 = mysql_fetch_array($res2);

                			$region2=$row2["nombre"];

                			echo $region2;



                			?>







                		</td>

                	</tr>

                	<?php if($rowRes["Total"] == 1) { ?>

                	<tr>

                		<td class="Estilo1">Recepcion Conforme</td>

                		<td class="Estilo1"><a href="pdf.php?id=<?php echo $rowRes["oc_id"] ?>" target="_blank">PDF</a></td>

                	</tr>

                	<?php } ?>















                	<tr>

                		<td colspan=6><br></td>

                	</tr>



                	<tr>

                		<td colspan=6>

                			<table border=1 width="100%" class="table table-striped">

                				<tr>









                					<?

//------------------------ Asociacion de facturas con contratos ---------------

                					$fac_rut=$row5["fac_rut"];

                					$fac_id=$row5["fac_id"];

                					$sql21 = "Select * from dpp_contratos where cont_rut='$fac_rut' and cont_region='$regionsession'";

//                                    echo $sql21;

                					$res21 = mysql_query($sql21);

                					$row21 = mysql_fetch_array($res21);

                					$cont_nombre=$row21["cont_nombre"];

                					$cont_rut=$row21["cont_rut"];



                					$sql22 = "Select * from dpp_cont_fac where confa_fac_id='$fac_id'";

                                    //echo $sql;

                					$res22 = mysql_query($sql22);

                					$row22 = mysql_fetch_array($res22);

                					$confa_fac_id=$row22["confa_fac_id"];

                					$sw=0;

                					if ($confa_fac_id<>'')

                						$sw=1;



                					if ($cont_nombre<>'' and $confa_fac_id=='')

                						$sw=2;







                					if ($sw==2) {





                						?>

                						<tr>

                							<td  valign="center" class="Estilo1" width="50%"><a href="buscarcontratos.php?rut=<? echo $cont_rut ?>&numfac=<? echo $id ?>&id1b=<? echo $id1b ?>&ori2=f&monto=<? echo $row5["fac_monto"] ?>" class="link" >Asociar Contrato</a> </td>





                							<?

                						}



                						if ($sw==1) {





                							?>

                							<tr>

                								<td  valign="center" class="Estilo1" width="50%">Ya Asociada a Contrato &nbsp;&nbsp;&nbsp;<a href="descontrato.php?rut=<? echo $cont_rut ?>&numfac=<? echo $id ?>&id1b=<? echo $id1b ?>&ori2=f&monto=<? echo $row5["fac_monto"] ?>" class="link" onclick="return confirm('Seguro Desasociar el Contrato ?')" title="Desasociar"><img src="imagenes/b_drop.png" border=0></a></td>



                								<?

                							}



//------------------------ Asociacion de Facturas con O/C ---------------

                							$fac_rut=$row5["fac_rut"];

                							$fac_id=$row5["fac_id"];

                							$sw2=2;

                							$sql21 = "Select * from compra_orden where oc_rut='$fac_rut' and (oc_estado='ACEPTADO' or oc_estado='ENVIADA' ) and oc_region='$regionsession' ";

//                                   echo $sql21;

                							$res21 = mysql_query($sql21);

                							$row21 = mysql_fetch_array($res21);

                							$ocid=$row21["oc_id"];



                							$sql22 = "select * from compra_oceta where oceta_eta_id='$id1b'  ";

//                                   echo $sql21;

                							$res22 = mysql_query($sql22);

                							$row22 = mysql_fetch_array($res22);

                							$oceta_eta_id=$row22["oceta_eta_id"];





                							$sw2=0;

                							if ($ocid<>'')

                								$sw2=1;



                							if ($row5["eta_nroorden"]<>'' and $oceta_eta_id<>'')

                								$sw2=2;



                							if ($sw2==1 and $row5["eta_nroorden"]=='' or $oceta_eta_id=='') {



                								?>





                								<td  valign="center" class="Estilo1" width="50%"><a href="buscarordencompra.php?rut=<? echo $fac_rut ?>&numfac=<? echo $id ?>&id1b=<? echo $id1b ?>&ori2=f&monto=<? echo $row5["fac_monto"] ?>" class="link" >ASOCIAR ORDEN DE COMPRA</a> </td>









                								<?

                							}



                							if ($sw2==2) {

                								$facnroorden=$row5["fac_nroorden"];

                								$sql21b = "Select * from compra_orden where oc_numero='$facnroorden' and oc_region='$regionsession' ";

//                                      echo $sql21b;

                								$res21b = mysql_query($sql21b);

                								$row21b = mysql_fetch_array($res21b);

                								$ocestado=$row21b["oc_estado"];

                								$sw3=0;
                								$sw4=0;
                								if($row21b["oc_solicitud_archivo"] <> '')
                								{
                									$sw4=1;
                								}

                								if ($ocestado=='RECEPCION CONFORME' ) {

                									$sw3=1;

                								}





                								?>





                								<td  valign="center" class="Estilo1" width="50%">Ya Asociada a Orden Compra&nbsp;&nbsp;&nbsp;<a href="desordencompra.php?rut=<? echo $cont_rut ?>&numfac=<? echo $id ?>&id1b=<? echo $id1b ?>&ori2=f&monto=<? echo $row5["fac_monto"] ?>" class="link" onclick="return confirm('Seguro Desasociar la Orden Compra ?')" title="Desasociar"><img src="imagenes/b_drop.png" border=0></a></td>







                								<?

                							}





                							if ($resultado2<>'' ) {

                								?>

                								<td  valign="center" class="Estilo1" width="50%" >

                									<a href="javascript:void(0)" onclick="window.open('listaperitaje.php?rut=<? echo $etarut; ?>&id=<? echo $id; ?>&id1b=<? echo $id1b ?>','','width=700,height=600,scrollbars=1,location=1')"   class="link">Lista de Peritaje</a>

                								</td>

                								<?

                							}

                							?>


                							<?php if ($_SESSION["region"] == 14 || $_SESSION["region"] == 13): ?>
                								<td  valign="center" class="Estilo1" width="50%" >
                							<a href="facturasarchivos_copiar.php?rut=<?php echo $row5["eta_rut"] ?>&dv=<?php echo $row5["eta_dig"] ?>&region=<?php echo $regionsession ?>&id=<?php echo $id ?>&id1b=<?php echo $id1b ?>" class="link">Copiar Set Anterior</a>
                							</td>
                							<?php endif ?>


                						</tr>



                					</table>

                				</td>

                			</tr>





                			<tr>

                				<td colspan=6><br></td>

                			</tr>



                		</table>

                		<table border=1 width="100%" class="table table-striped">



                			<tr>

                				<td class="Estilo1">Tipo de Servicio</td>

                				<td class="Estilo1">

                					<input type="radio" name="vb" id="vb" value="BIEN" <?php if($rowRes["oc_tipo2"] == "BIEN" || $row5["eta_tipo"] == "BIEN"){echo"checked";} ?>>BIEN
                					<input type="radio" name="vb" id="vb" value="SERVICIO" <?php if($rowRes["oc_tipo2"] == "SERVICIO" || $row5["eta_tipo"] == "SERVICIO"){echo"checked";} ?>>SERVICIO

                				</td>

                			</tr>

                			<tr>
                				<td class="Estilo1">Urgencia</td>
                				<td class="Estilo1">
                					<input type="radio" name="eta_urgencia" id="eta_urgencia" value="1" <?php if($row5["eta_urgencia"] == 1){echo"checked";} ?>>SI
                					<input type="radio" name="eta_urgencia" id="eta_urgencia" value="0" <?php if($row5["eta_urgencia"] == 0){echo"checked";} ?>>NO
                				</td>
                			</tr>

                			<tr>

                				<td  valign="center" class="Estilo1">Total a Pagar </td>

                				<td class="Estilo1" colspan=3>

                					$<input type="text" name="monto" class="Estilo2" size="15" value="<? echo $row5["fac_monto"] ?>"  >

                				</td>

                			</tr>

                			<?

                			$etaitem=$row5["eta_item"];

                			$eta_item2=$row5["eta_item2"];

                			$eta_asig=$row5["eta_asig"];

                			$eta_prog=$row5["eta_prog"];

                			?>

                			<tr>

                				<td  valign="center" class="Estilo1">Subtítulo</td>

                				<td class="Estilo1" colspan=3>

                					<select name="item" class="Estilo2" required>

                						<option value="">Seleccionar...</option>

                						<option value="21" <? if ($etaitem=="21") { echo "selected"; } ?>>21</option>

                						<option value="22" <? if ($etaitem=="22") { echo "selected"; } ?>>22</option>

                						<option value="24" <? if ($etaitem=="24") { echo "selected"; } ?>>24</option>

                						<option value="29" <? if ($etaitem=="29") { echo "selected"; } ?>>29</option>

                						<option value="31" <? if ($etaitem=="31") { echo "selected"; } ?>>31</option>

                						<option value="34" <? if ($etaitem=="34") { echo "selected"; } ?>>34</option>

                						<option value="99" <? if ($etaitem=="99") { echo "selected"; } ?>>Otro</option>

                					</select>

                             <!-- <table>

                               <tr>

                                 <td class="Estilo1"><input type="radio" name="item" class="Estilo2" value="21" <? if ($etaitem=="21") { echo "checked"; } ?> >21 </td>

                                 <td class="Estilo1"><input type="radio" name="item" class="Estilo2" value="22" <? if ($etaitem=="22") { echo "checked"; } ?> >22 </td>

                                 <td class="Estilo1"><input type="radio" name="item" class="Estilo2" value="24" <? if ($etaitem=="24") { echo "checked"; } ?> >24 </td>

                                 <td class="Estilo1"><input type="radio" name="item" class="Estilo2" value="29" <? if ($etaitem=="29") { echo "checked"; } ?> >29 </td>

                               </tr>

                               <tr>

			                     <td class="Estilo1"><input type="radio" name="item" class="Estilo2" value="31" <? if ($etaitem=="31") { echo "checked"; } ?> >31 </td>

			                     <td class="Estilo1"><input type="radio" name="item" class="Estilo2" value="34" <? if ($etaitem=="34") { echo "checked"; } ?> >34 </td>

			                     <td class="Estilo1"><input type="radio" name="item" class="Estilo2" value="99" <? if ($etaitem=="99") { echo "checked"; } ?> >Otro </td>

                               </tr>

                           </table> -->





                       </td>

                   </tr>



                   <tr>

                   	<td  valign="center" class="Estilo1">Item</td>

                   	<td class="Estilo1" colspan=3>

                   		<select name="eta_item2" class="Estilo2">

                   			<option value="">Seleccionar...</option>

                   			<option value="01" <? if ($eta_item2=="01") { echo "selected"; } ?>>01</option>

                   			<option value="02" <? if ($eta_item2=="02") { echo "selected"; } ?>>02</option>

                   			<option value="03" <? if ($eta_item2=="03") { echo "selected"; } ?>>03</option>

                   			<option value="04" <? if ($eta_item2=="04") { echo "selected"; } ?>>04</option>

                   			<option value="05" <? if ($eta_item2=="05") { echo "selected"; } ?>>05</option>

                   			<option value="06" <? if ($eta_item2=="06") { echo "selected"; } ?>>06</option>

                   			<option value="07" <? if ($eta_item2=="07") { echo "selected"; } ?>>07</option>

                   			<option value="08" <? if ($eta_item2=="08") { echo "selected"; } ?>>08</option>

                   			<option value="09" <? if ($eta_item2=="09") { echo "selected"; } ?>>09</option>

                   			<option value="10" <? if ($eta_item2=="10") { echo "selected"; } ?>>10</option>

                   			<option value="11" <? if ($eta_item2=="11") { echo "selected"; } ?>>11</option>

                   			<option value="12" <? if ($eta_item2=="12") { echo "selected"; } ?>>12</option>

                   			<option value="99" <? if ($eta_item2=="99") { echo "selected"; } ?>>99</option>

                   		</select>

                   	</td>

                   </tr>



                   <tr>

                   	<td  valign="center" class="Estilo1">Asignación</td>

                   	<td class="Estilo1" colspan=3>

                   		<select name="eta_asig" class="Estilo2">

                   			<option value="">Seleccionar...</option>

                   			<option value="001" <? if ($eta_asig=="001") { echo "selected"; } ?>>001</option>

                   			<option value="002" <? if ($eta_asig=="002") { echo "selected"; } ?>>002</option>

                   			<option value="003" <? if ($eta_asig=="003") { echo "selected"; } ?>>003</option>

                   			<option value="004" <? if ($eta_asig=="004") { echo "selected"; } ?>>004</option>

                   			<option value="005" <? if ($eta_asig=="005") { echo "selected"; } ?>>005</option>

                   			<option value="006" <? if ($eta_asig=="006") { echo "selected"; } ?>>006</option>

                   			<option value="007" <? if ($eta_asig=="007") { echo "selected"; } ?>>007</option>

                   			<option value="008" <? if ($eta_asig=="008") { echo "selected"; } ?>>008</option>

                   			<option value="009" <? if ($eta_asig=="009") { echo "selected"; } ?>>009</option>

                   			<option value="010" <? if ($eta_asig=="010") { echo "selected"; } ?>>010</option>

                   			<option value="011" <? if ($eta_asig=="011") { echo "selected"; } ?>>011</option>

                   			<option value="012" <? if ($eta_asig=="012") { echo "selected"; } ?>>012</option>

                   			<option value="013" <? if ($eta_asig=="013") { echo "selected"; } ?>>013</option>

                   			<option value="014" <? if ($eta_asig=="014") { echo "selected"; } ?>>014</option>

                   			<option value="015" <? if ($eta_asig=="015") { echo "selected"; } ?>>015</option>
                   			<option value="999" <? if ($eta_asig=="999") { echo "selected"; } ?>>999</option>

                   		</select>

                   	</td>

                   </tr>



                   <tr>

                   	<td  valign="center" class="Estilo1">Programa</td>

                   	<td class="Estilo1" colspan=3>

                   		<select name="eta_prog" class="Estilo2">

                   			<option value="">Seleccionar...</option>

                   			<option value="P1" <? if ($eta_prog=="P1") { echo "selected"; } ?>>P1</option>

                   			<option value="P2" <? if ($eta_prog=="P2") { echo "selected"; } ?>>P2</option>

                   		</select>

                   	</td>

                   </tr>



                   <tr>

                   	<td  valign="center" class="Estilo1">Descripción del Servicio </td>

                   	<td class="Estilo1" colspan=3>

                   		<textarea name="servicio" rows="3" cols="30" requried><? echo ($row5["fac_servicio"] <> '') ? $row5["fac_servicio"]: $rowRes["oc_obs"] ; ?></textarea>

                   	</td>

                   </tr>







                   <?

                   $mod=$row5["fac_modalidad"];

                   ?>

                   <tr>

                   	<td  valign="center" class="Estilo1">Modalidad de Contratación </td>

                   	<td class="Estilo1" colspan=3>

                   		<select name="modalidad" class="Estilo1">

                   			<option value="">Seleccione...</option>

                   			<option value="Convenio Marco" <? if ($mod=="Convenio Marco") echo "selected=selected" ?> >Convenio Marco</option>

                   			<option value="Licitacion Publica"  <? if ($mod=="Licitacion Publica") echo "selected=selected" ?>  >Licitacion Publica</option>



                   			<option value="Contrato Directo"  <? if ($mod=="Contrato Directo") echo "selected=selected" ?>  >Contrato Directo</option>

                   			<option value="Compra menor a 3 UTM"  <? if ($mod=="Compra menor a 3 UTM") echo "selected=selected" ?>  >Compra menor a 3 UTM</option>

                   			<option value="Servicio General" <? if ($mod=="Servicio General") echo "selected=selected" ?> >Servicio General</option>

                   			<option value="Convenio Directo" <? if ($modalidad=="Convenio Directo") echo "selected=selected" ?> >Convenio Directo</option>



                   			<option value="Remuneración RPA"  <? if ($mod=="Remuneración RPA") echo "selected=selected" ?>  >Remuneración RPA</option>



                   		</select>

                   	</td>

                   </tr>






                   <tr>

                   	<td  valign="center" class="Estilo1">Nº Orden de Compra  </td>

                   	<td class="Estilo1" colspan=3>

                   		<input type="text" name="nroorden" class="Estilo2" size="15" value="<? echo $row5["eta_nroorden"]; ?>"  >

                   		<?

                   		if ($regionsession==15 or 1==1) {

                   			$facnroorden=$row5["fac_nroorden"];

                   			if ($facnroorden<>'' and $sw3!=1) {

                   				?>

                   				<a href="facturasarchivos.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&nroorden2=<? echo $row5["eta_id"] ?>" class="link" onclick="return confirm('Seguro que desea cerrar la orden de Compra?')"></a>

                   				<?

                   			}

                   			if ($facnroorden<>'' and $sw3==1) {

                   				?>

                   				Orden de Compra ya Cerrada

                   				<?

                   			}

                   		}

                   		?>



                   	</td>

                   </tr>

                   <tr>

                   	<td  valign="center" class="Estilo1">Archivo PDF Orden de Compra </td>

                   	<td class="Estilo1" colspan=3>

                   		<?

                   		if ($sw2!=2) {

                   			?>

                   			<input type="file" name="archivo2" class="Estilo2" size="20"  > <br>

                   			<?

                   		}

                   		?>

                   		<a href="../../archivos/docfac/<? echo $row5["fac_doc1"]; ?>?read3=<? echo $read3 ?>" class="link" target="_blank"><? echo $row5["fac_doc1"]; ?></a>
                   		<input type="hidden" name="archivo222" value="<? echo $row5["fac_doc1"]; ?>"  >

                   	</td>

                   </tr>

                   <tr>

                   	<td  valign="center" class="Estilo1">Nº Solicitud de Compra  </td>

                   	<td class="Estilo1" colspan=3>
                   		<input type="text" name="oc_sc" id="oc_sc" value="<?php echo $rowRes["oc_sc"]?>">

                   	</td>

                   </tr>

                   <tr>

                   	<td  valign="center" class="Estilo1"><font color="#FF0000">* </font>Archivo PDF Solicitud de Compra </td>

                   	<td class="Estilo1" colspan=3>

                   	<?php if ($sw4<>1): ?>
                   		<input type="file" name="archivo5" class="Estilo2" size="20"  > <br>
	                   	<input type="hidden" name="oc_solicitud" value="<?php echo $rowRes["oc_id"] ?>">
    	               	<input type="hidden" name="oc_numero_oc" value="<?php echo $rowRes["oc_numero"] ?>">
                   	<?php endif ?>
                   		<a href="../../archivos/docfac/<? echo $rowRes["oc_solicitud_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $rowRes["oc_solicitud_archivo"]; ?></a>
                   		<!-- <?
                   		if ($rowRes["oc_solicitud_archivo"]<>'') {

                   			?>
                   			<a href="borradocs3.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&doc=1&oc_id=<?php echo $rowRes["oc_id"] ?>" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a>
                   			<?
                   		}
                   		?> -->
                   	</td>


                   </tr>



                   <tr>

                   	<td  valign="center" class="Estilo1"><font color="#FF0000">* </font> Factura </td>

                   	<td class="Estilo1" colspan=3>

                   		<input type="file" name="archivo1" class="Estilo2" size="20"  > <br>

                   		<a href="../../archivos/docfac/<? echo $row5["fac_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["fac_archivo"]; ?></a>

                   		<input type="hidden" name="archivo111" value="<? echo $row5["fac_archivo"]; ?>"  >

                   		<?

                   		if ($row5["fac_archivo"]<>'') {

                   			?>

                   			<a href="borradocs.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&doc=1" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a>

                   			<?

                   		}

                   		?>

                   	</td>

                   </tr>


 <!-- <tr>

                 <td  valign="center" class="Estilo1">Cesión de Factura </td>

                 <td class="Estilo1" colspan=3>



                  <input type="file" name="ant6" class="Estilo2" size="20"  >  <br>



                  <a href="<? echo $row5["fac_ruta6"] ?><? echo $row5["fac_ant6"] ?>?read4=<? echo $read4 ?>" class="link" target="_blank"><? echo $row5["fac_ant6"]; ?></a>



                  <?

                  if ($row5["fac_ant6"]<>'') {

                    ?>



                    <a href="borradocs2.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&ant=6" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a> <br>

                  </td>

                </tr>

                <?

              }

              ?> -->


              <tr>

              	<td  valign="center" class="Estilo1"><font color="#FF0000">* </font>Consulta Cesión de Factura SII (IMEGEN Ó PDF)</td>

              	<td class="Estilo1" colspan=3>
              		<input type="file" name="ant1" class="Estilo2" size="20"  >  <br>
              		<a href="<? echo $row5["fac_ruta1"] ?><? echo $row5["fac_ant1"] ?>?read4=<? echo $read4 ?>" class="link" target="_blank"><? echo $row5["fac_ant1"]; ?></a>
              		<?
              		if ($row5["fac_ant1"]<>'') {
              			?>
              			<a href="borradocs2.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&ant=1" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a> <br>
              			<?

              		}

              		?>

              	</td>

              </tr>
              

          </td>

      </tr>






      <?

      if ($regionsession==15 or 1==1) {



      	?>

      	<tr>

      		<!-- <td  valign="center" class="Estilo1">Imagen Asociada </td> -->

      		<td></td>

      		<td class="Estilo1" colspan=3>

      			<table border=1>

      				<?

      				$sql7="select * from compra_orden where oc_eta_id=$idetapa ";

// echo $sql7;

      				$res7 = mysql_query($sql7);

      				$cont11=1;

      				while($row7 = mysql_fetch_array($res7)){

      					if ($cont11==1 or $cont11==4 or $cont11==7 or $cont11==10 or $cont11==13 or $cont11==16 ) {

      						echo "<tr>";

      					}

      					?>



      					<td>

      						<a href="../../archivos/docfac/<? echo $row7["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row7["oc_numero"]; ?></a>

      					</td>





      					<?

      					$cont11++;

      				}

      				echo "</table>";

      			}



      			$sql8="select * from argedo_documentos where docs_id=".$row5["fac_docs_id"];

                            // echo $sql8;

      			$res8 = mysql_query($sql8);

      			$row8 = mysql_fetch_array($res8);

      			$docsfecha=$row8["docs_fecha"];

      			if ($row8["docs_archivo"]<>'') {

      				$docsarchivo="../../archivos/docargedo/".$row8["docs_archivo"];

      			}

      			?>

      			<tr>

      				<td  valign="center" class="Estilo1">Resolución Aprueba Bases Administrativas</td>

      				<td class="Estilo1" colspan=3>

      					<input type="text" name="nroresolucion" class="Estilo2" size="15" value="<? echo $row5["fac_nroresolucion"]; ?>" >

      					<input type="hidden" name="idargedo" class="Estilo2" size="8" value="<? echo $row8["docs_id"] ?>" >

      					<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana(1)">Asociar Resolucion</a>

      					<a href="<? echo $docsarchivo ?>" class="link" id="linkarchivo" target="_blank">
      						<div id="verlink">
      							<? echo $row8["docs_archivo"] ?>
      							<?php if ($row8["docs_archivo"] <> ''): ?>
      								<a href="compra_elimina_res.php?id=<?php echo $id ?>&eta_id=<?php echo $id1b ?>&res=1" onClick="return confirm('¿ESTÁ SEGURO DE ELIMINAR LA ASOCIACION ?')"><img src="images/b_drop.png" alt=""></a>
      							<?php endif ?>                              
      						</div>
      					</a>

      				</td>

      			</tr>





      			<?

      			$sql9="select * from argedo_documentos where docs_id=".$row5["fac_doc_id2"];

                        // echo $sql9;

      			$res9 = mysql_query($sql9);

      			$row9 = mysql_fetch_array($res9);

      			$docsfecha=$row9["docs_fecha"];

      			if ($row9["docs_archivo"]<>'') {

      				$docsarchivo2="../../archivos/docargedo/".$row9["docs_archivo"];

      			}

      			?>

      			<tr>

      				<td  valign="center" class="Estilo1">Resolución Adjudica Licitación</td>

      				<td class="Estilo1" colspan=3>

      					<input type="text" name="nroresolucion2" class="Estilo2" size="15" value="<? echo $row5["fac_res2"]; ?>" >

      					<input type="hidden" name="idargedo2" class="Estilo2" size="8" value="<? echo $row9["docs_id"] ?>" >

      					<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana(2)">Asociar Resolucion</a>

      					<a href="<? echo $docsarchivo2 ?>" class="link" id="linkarchivo2" target="_blank">
      						<div id="verlink2">
      							<? echo $row9["docs_archivo"] ?>
      							<?php if ($row9["docs_archivo"] <> ''): ?>
      								<a href="compra_elimina_res.php?id=<?php echo $id ?>&eta_id=<?php echo $id1b ?>&res=2" onClick="return confirm('¿ESTÁ SEGURO DE ELIMINAR LA ASOCIACION ?')"><img src="images/b_drop.png" alt=""></a>
      							<?php endif ?>
      						</div></a>

      					</td>

      				</tr>





      				<?

      				$sql10="select * from argedo_documentos where docs_id=".$row5["fac_doc_id3"];

                      // echo $sql10;

      				$res10 = mysql_query($sql10);

      				$row10 = mysql_fetch_array($res10);

      				$docsfecha=$row10["docs_fecha"];

      				if ($row10["docs_archivo"]<>'') {

      					$docsarchivo3="../../archivos/docargedo/".$row10["docs_archivo"];

      				}

      				?>

      				<tr>

      					<td  valign="center" class="Estilo1">Resolución Aprueba Contrato</td>

      					<td class="Estilo1" colspan=3>

      						<input type="text" name="nroresolucion3" class="Estilo2" size="15" value="<? echo $row5["fac_res3"]; ?>" >

      						<input type="hidden" name="idargedo3" class="Estilo2" size="8" value="<?php echo $row10["docs_id"] ?>">

      						<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana(3)">Asociar Resolucion</a>

      						<a href="<? echo $docsarchivo3 ?>" class="link" id="linkarchivo3" target="_blank">
      							<div id="verlink3">
      								<? echo $row10["docs_archivo"] ?>
      								<?php if ($row10["docs_archivo"] <> ''): ?>
      									<a href="compra_elimina_res.php?id=<?php echo $id ?>&eta_id=<?php echo $id1b ?>&res=3" onClick="return confirm('¿ESTÁ SEGURO DE ELIMINAR LA ASOCIACION ?')"><img src="images/b_drop.png" alt=""></a>
      								<?php endif ?>
      							</div></a>

      						</td>

      					</tr>





      					<?

      					$sql11="select * from argedo_documentos where docs_id=".$row5["fac_doc_id4"];

//echo $sql8;

      					$res11 = mysql_query($sql11);

      					$row11 = mysql_fetch_array($res11);

      					$docsfecha=$row11["docs_fecha"];

      					if ($row11["docs_archivo"]<>'') {

      						$docsarchivo4="../../archivos/docargedo/".$row11["docs_archivo"];

      					}

      					?>



      					<tr>

      						<td  valign="center" class="Estilo1">Resolución de Trato Directo</td>

      						<td class="Estilo1" colspan=3>

      							<input type="text" name="nroresolucion4" class="Estilo2" size="15" value="<? echo $row5["fac_res4"]; ?>" >

      							<input type="hidden" name="idargedo4" class="Estilo2" size="8" value="<? echo $row11["docs_id"] ?>" >

      							<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana(4)">Asociar Resolucion</a>

      							<a href="<? echo $docsarchivo4 ?>" class="link" id="linkarchivo4" target="_blank">
      								<div id="verlink4">
      									<? echo $row11["docs_archivo"] ?>
      									<?php if ($row11["docs_archivo"] <> ''): ?>
      										<a href="compra_elimina_res.php?id=<?php echo $id ?>&eta_id=<?php echo $id1b ?>&res=4" onClick="return confirm('¿ESTÁ SEGURO DE ELIMINAR LA ASOCIACION ?')"><img src="images/b_drop.png" alt=""></a>
      									<?php endif ?>
      								</div></a>

      							</td>

      						</tr>                                                

                        <!-- <tr>

                         <td  valign="center" class="Estilo1">Fecha Resolución</td>

                         <td class="Estilo1" valign="center" colspan=3>

                          <input type="text" name="fecha4" value="<? echo $docsfecha ?>" class="Estilo2" size="12" value="" id="f_date_c4" >

                      </tr> -->















                      <?

                      $sql12="select * from argedo_documentos where docs_id=".$row5["fac_doc_id5"];

//echo $sql8;

                      $res12 = mysql_query($sql12);

                      $row12 = mysql_fetch_array($res12);

                      $docsfecha=$row12["docs_fecha"];

                      if ($row12["docs_archivo"]<>'') {

                      	$docsarchivo5="../../archivos/docargedo/".$row12["docs_archivo"];

                      }

                      ?>



                      <tr>

                      	<td  valign="center" class="Estilo1">Resolución Cesión de Fatura</td>

                      	<td class="Estilo1" colspan=3>

                      		<input type="text" name="nroresolucion5" class="Estilo2" size="15" value="<? echo $row5["fac_res5"]; ?>" >

                      		<input type="hidden" name="idargedo5" class="Estilo2" size="8" value="<? echo $row12["docs_id"] ?>" >

                      		<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana(5)">Asociar Resolucion</a>

                      		<a href="<? echo $docsarchivo5 ?>" class="link" id="linkarchivo5" target="_blank">
                      			<div id="verlink5">
                      				<? echo $row12["docs_archivo"] ?>
                      				<?php if ($row12["docs_archivo"] <> ''): ?>
                      					<a href="compra_elimina_res.php?id=<?php echo $id ?>&eta_id=<?php echo $id1b ?>&res=5" onClick="return confirm('¿ESTÁ SEGURO DE ELIMINAR LA ASOCIACION ?')"><img src="images/b_drop.png" alt=""></a>
                      				<?php endif ?>
                      			</div></a>

                      		</td>

                      	</tr>    





                      	<?

                      	$sql13="select * from argedo_documentos where docs_id=".$row5["fac_doc_id6"];

                      	$res13 = mysql_query($sql13);

                      	$row13 = mysql_fetch_array($res13);

                      	$docsfecha=$row13["docs_fecha"];

                      	if ($row13["docs_archivo"]<>'') {

                      		$docsarchivo6="../../archivos/docargedo/".$row13["docs_archivo"];

                      	}

                      	?>



                      	<tr>

                      		<td  valign="center" class="Estilo1">Resolución Aplica Multa</td>

                      		<td class="Estilo1" colspan=3>

                      			<input type="text" name="nroresolucion6" class="Estilo2" size="15" value="<? echo $row5["fac_res6"]; ?>" >

                      			<input type="hidden" name="idargedo6" class="Estilo2" size="8" value="<? echo $row13["docs_id"] ?>" >

                      			<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana(6)">Asociar Resolucion</a>

                      			<a href="<? echo $docsarchivo6 ?>" class="link" id="linkarchivo6" target="_blank">
                      				<div id="verlink6">
                      					<? echo $row13["docs_archivo"] ?>
                      					<?php if ($row13["docs_archivo"] <> ''): ?>
                      						<a href="compra_elimina_res.php?id=<?php echo $id ?>&eta_id=<?php echo $id1b ?>&res=6" onClick="return confirm('¿ESTÁ SEGURO DE ELIMINAR LA ASOCIACION ?')"><img src="images/b_drop.png" alt=""></a>
                      					<?php endif ?>
                      				</div></a>

                      			</td>

                      		</tr> 



                      		<tr>

                      			<td  valign="center" class="Estilo1"><font color="#FF0000">* </font>Imagen Compromiso Cierto</td>

                      			<td class="Estilo1" colspan=3>

                      				<input type="file" name="archivo6" class="Estilo2" size="20"> <br>

                      				<a href="../../archivos/docfac/<? echo $row5["eta_compromiso_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["eta_compromiso_archivo"]; ?></a>

                      				<?

                      				if ($row5["eta_compromiso_archivo"]<>'') {

                      					?>

                      					<a href="borradocs4.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&doc=1&oc_id=<?php echo $rowRes["oc_id"] ?>" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a>

                      					<?

                      				}

                      				?>

                      			</td>

                      			<!-- <input type="hidden" name="oc_solicitud" value="<?php echo $rowRes["oc_id"] ?>"> -->
                      			<!-- <input type="hidden" name="oc_numero_oc" value="<?php echo $rowRes["oc_numero"] ?>"> -->

                      		</tr>



                <!-- <tr>

                 <td  valign="center" class="Estilo1">Cesión de Factura </td>

                 <td class="Estilo1" colspan=3>



                  <input type="file" name="ant6" class="Estilo2" size="20"  >  <br>



                  <a href="<? echo $row5["fac_ruta6"] ?><? echo $row5["fac_ant6"] ?>?read4=<? echo $read4 ?>" class="link" target="_blank"><? echo $row5["fac_ant6"]; ?></a>



                  <?

                  if ($row5["fac_ant6"]<>'') {

                    ?>



                    <a href="borradocs2.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&ant=6" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a> <br>

                  </td>

                </tr>

                <?

              }

              ?> -->





              <?

              $verfac='';

              $nuevo=$row5["fac_doc2"];

//echo $nuevo;

              if ($nuevo<>'') {

              	$buscar='archivos/docargedo/fileargedo';

              	$pos = strpos($nuevo,$buscar );

              	if ($pos !== FALSE) {

//       $nuevo="../../archivos/docargedo/fileargedo".$resanno."/resexc/RE_".$row2["conres_numero"]."_".$resanno."_".$regionsession."_1.PDF";

//       $trozos = explode("/", $buscar);

//       $extension = end($trozos);

//       $nuevo="../../archivos/docfac/".$extension;



//      $nuevo = str_replace("../../../../", "../../", $nuevo);



//        $nuevo ="../../".$nuevo;



              	}  else {

              		$nuevo="../../archivos/docfac/".$row5["fac_doc2"];



              	}



   // $verfac="Ver Resolución";

              	$verfac=$row5["fac_doc2"];

              }





              ?>


	              <tr>

	              	<td  valign="center" class="Estilo1">Asociación Nota de Credito </td>

	              	<td class="Estilo1" colspan=3>

	              		<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana0('<?php echo $row5["eta_id"] ?>','<?php echo $row5["eta_rut"] ?>','<?php echo $row5["eta_dig"] ?>')">Asociar Nota de Credito</a>

	              		<?

	              		$sqlnc1 = "SELECT * FROM dpp_etapas_nota WHERE nota_eta_id = ".$id1b." AND nota_tipo_doc = 'NC' and nota_estado = 1";

	              		$resnc1 = mysql_query($sqlnc1);

	              		while($rownc1 = mysql_fetch_array($resnc1))

	              		{

	              			$sqlnc2 = "SELECT * FROM dpp_facturas WHERE fac_eta_id = ".$rownc1["nota_eta_id2"];
	              			$resnc2 = mysql_query($sqlnc2);
	              			$rownc2 = mysql_fetch_array($resnc2);


	              			echo '<br><a href="../../archivos/docfac/'.$rownc2["fac_archivo"].'" class="link" target="_blank">'.$rownc2["fac_archivo"].'</a>';
	 
	              			echo '<a href="borrar_nota.php?eta_id='.$id1b.'&nota_id='.$rownc1["nota_id"].'&id='.$id.'"><img src="imagenes/b_drop.png" border="0"></a>';

	              		}

	              		?>

	              	</td>

	              </tr>




	               <tr>

	              	<td  valign="center" class="Estilo1">Asociación Nota de Débito </td>

	              	<td class="Estilo1" colspan=3>

	              		<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana1('<?php echo $row5["eta_id"] ?>','<?php echo $row5["eta_rut"] ?>','<?php echo $row5["eta_dig"] ?>')">Asociar Nota de Débito</a>

	              		<?

	              		$sqlnd1 = "SELECT * FROM dpp_etapas_nota WHERE nota_eta_id = ".$id1b." AND nota_tipo_doc = 'ND' and nota_estado = 1";

	              		$resnd1 = mysql_query($sqlnd1);

	              		while($rownd1 = mysql_fetch_array($resnd1))

	              		{

	              			$sqlnd2 = "SELECT * FROM dpp_facturas WHERE fac_eta_id = ".$rownd1["nota_eta_id2"];
	              			$resnd2 = mysql_query($sqlnd2);
	              			$rownd2 = mysql_fetch_array($resnd2);


	              			echo '<br><a href="../../archivos/docfac/'.$rownd2["fac_archivo"].'" class="link" target="_blank">'.$rownd2["fac_archivo"].'</a>';
	 
	              			echo '<a href="borrar_nota.php?eta_id='.$id1b.'&nota_id='.$rownd1["nota_id"].'&id='.$id.'"><img src="imagenes/b_drop.png" border="0"></a>';

	              		}

	              		?>

	              	</td>

	              </tr>


              <tr>

              	<td  valign="center" class="Estilo1">Archivo Recepcion Conforme desde INEDIS </td>

              	<td class="Estilo1" colspan=3>

              		<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana2('<?php echo $rowRes["oc_numero"] ?>','<?php echo $row5["eta_id"] ?>')">Asociar Recepción Conforme</a>

              		<?

              		$rc = "SELECT * FROM compra_doc_inedis WHERE doc_etapa_id = ".$id1b." AND doc_tipo = 'RC' and doc_estado = 1";

              		$rc = mysql_query($rc,$dbh);

              		while($rowrc = mysql_fetch_array($rc))

              		{

              			$rcInedis = "SELECT * FROM bode_ingreso WHERE ing_id = ".$rowrc["doc_ing_id"];

              			$rcInedis = mysql_query($rcInedis,$dbh6);

              			$rcInedis = mysql_fetch_array($rcInedis);

              			echo '<br><a href="../../inventario/privado/sitio2/bode_imprimerca.php?numguia='.$rcInedis["ing_guianumerorc"].'" target="_blank">Recepcion N° '.$rcInedis["ing_guianumerorc"].'</a> ';

              			echo '<a href="borrar_rc.php?eta_id='.$id1b.'&doc_id='.$rowrc["doc_id"].'&id='.$id.'"><img src="imagenes/b_drop.png" border="0"></a>';

              		}

              		?>

              	</td>

              </tr>



              <tr>

              	<td  valign="center" class="Estilo1">Archivo Recepcion Técnica desde INEDIS</td>

              	<td class="Estilo1" colspan=3> 

              		<a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana3('<?php echo $rowRes["oc_numero"] ?>','<?php echo $row5["eta_id"] ?>')">Asociar Recepción Técnica</a>

              		<?

              		$rc = "SELECT * FROM compra_doc_inedis WHERE doc_etapa_id = ".$id1b." AND doc_tipo = 'RT' and doc_estado = 1";

              		$rc = mysql_query($rc,$dbh);

              		while($rowrc = mysql_fetch_array($rc))

              		{

              			$rcInedis = "SELECT * FROM bode_ingreso WHERE ing_id = ".$rowrc["doc_ing_id"];

              			$rcInedis = mysql_query($rcInedis,$dbh6);

              			$rcInedis = mysql_fetch_array($rcInedis);

              			echo '<br><a href="../../inventario/privado/sitio2/bode_tca.php?numguia='.$rcInedis["ing_guianumerotc"].'" target="_blank">Recepcion N° '.$rcInedis["ing_guianumerotc"].'</a> ';

              			echo '<a href="borrar_rc.php?eta_id='.$id1b.'&doc_id='.$rowrc["doc_id"].'&id='.$id.'"><img src="imagenes/b_drop.png" border="0"></a>';

              		}

              		?>

              	</td>

              </tr>



        <!-- <tr>

         <td  valign="center" class="Estilo1">Subir Imagen de Otros Antecedentes</td>

         <td class="Estilo1" colspan=3>

          <input type="file" name="archivo4" class="Estilo2" size="20"  > <br>

          <a href="../../archivos/docfac/<? echo $row5["fac_doc3"]; ?>?read2=<? echo $read3 ?>" class="link" target="_blank"><? echo $row5["fac_doc3"]; ?></a>

          <?

          if ($row5["fac_doc3"]<>'') {

            ?>

            <a href="borradocs.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&doc=2" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a>

            <?

          }

          ?>



        </td>

    </tr> -->

    <tr>

    	<td  valign="center" class="Estilo1">Archivo Guía de Recepción Conforme</td>

    	<td class="Estilo1" colspan=3>
    		<input type="file" name="ant2" class="Estilo2" size="20"  >  <br>
    		<a href="<? echo $row5["fac_ruta2"] ?><? echo $row5["fac_ant2"] ?>?read4=<? echo $read4 ?>" class="link" target="_blank"><? echo $row5["fac_ant2"]; ?></a>
    		<?
    		if ($row5["fac_ant2"]<>'') {
    			?>
    			<a href="borradocs2.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&ant=2" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a> <br>
    			<? 
    		}

    		?>

    	</td>

    </tr>


    <tr>

    	<td  valign="center" class="Estilo1">Otros Antecedentes</td>

    	<td class="Estilo1" colspan=3>

    		<a href="#" class="link" onclick='abreVentana4("<? echo $id ?>","2","<? echo $id1b ?>","<?php echo $_GET["ori"] ?>" )' >Subir Archivo</a>

    		<!-- <input type="file" name="ant1" class="Estilo2" size="20"  >  <br> -->



    		<!-- <a href="<? echo $row5["fac_ruta1"] ?><? echo $row5["fac_ant1"] ?>?read4=<? echo $read4 ?>" class="link" target="_blank"><? echo $row5["fac_ant1"]; ?></a> -->

    		<table border="0" width="100%">

    			<?

    			$sql27="Select * from compra_archivo where arch_eta_id=$id1b order by arch_id desc";

    			$sql27=mysql_query($sql27);

    			while ($row27 = mysql_fetch_array($sql27)) {

    				?>

    				<tr>

    					<td class="Estilo1"> <? echo $row27["arch_etiqueta"] ?></td>

    					<td><a href="../../<? echo $row27["arch_ruta"]; ?>/<? echo $row27["arch_archivo"]; ?>?read2=<? echo $read3 ?>" class="link" target="_blank">Ver </a></td>

    					<td class="Estilo1"> <a href="borradocs5.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&doc=1&id2=<? echo $row27["arch_id"]; ?>" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a></td>

    					<tr>

    						<!-- <a href="borradocs2.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&ant=1" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a> <br> -->



    						<?

    					}

    					?>



    				</table>

    			</td>

    		</tr>



    		<tr>

    			<td  valign="center" class="Estilo1">Observaciones</td>

    			<td class="Estilo1" colspan=3>

    				<textarea name="eta_obs" id="eta_ob" cols="30" rows="10" style="margin: 0px; width: 556px; height: 168px;"><?php echo $row5["eta_obs"] ?></textarea>

    			</td>

    		</tr>

    		<tr>
    			<td class="Estilo1">Comprobante Contable (Devengo)</td>
    			<td>
    				<table class="table">
    					<thead>
    						<th class="Estilo1">Fecha Devengo</th>
    						<th class="Estilo1">N&deg; Comprobante</th>
    						<th class="Estilo1">Documento</th>
    					</thead>
    					<tr>
    						<td class="Estilo1"><?php echo ($row5["eta_fdevengo"] <> '') ? date("d-m-Y",strtotime($row5["eta_fdevengo"])) : "POR DEVENGAR"?></td>
    						<td class="Estilo1"><?php echo ($row5["fac_nro_contable"] <> '') ? $row5["fac_nro_contable"] : "POR DEVENGAR" ?></td>
    						<td class="Estilo1"><?php echo ($row5["fac_devengo_archivo"] <> '') ? "<a href='../../archivos/docfac/".$row5["fac_devengo_archivo"]."' target='_blank'>".$row5["fac_devengo_archivo"]."</a>" : "POR DEVENGAR" ?></td>
    					</tr>
    				</table>
    			</td>
    		</tr>

    		<tr>
    			<td class="Estilo1">Comprobante Egreso</td>
    			<td>
    				<table class="table">
    					<thead>
    						<th class="Estilo1">Fecha Egreso</th>
    						<th class="Estilo1">N&deg; Egreso</th>
    						<th class="Estilo1">Documento</th>
    					</thead>
    					<tr>
    						<td class="Estilo1"><?php echo ($row5["eta_fecha_egreso"] <> '') ? date("d-m-Y",strtotime($row5["eta_fecha_egreso"])) : "POR DEVENGAR"?></td>
    						<td class="Estilo1"><?php echo ($row5["eta_num_egreso"] <> '') ? $row5["eta_num_egreso"] : "POR DEVENGAR" ?></td>
    						<td class="Estilo1"><?php echo ($row5["eta_doc_egreso"] <> '') ? "<a href='../../archivos/docfac/".$row5["eta_doc_egreso"]."' target='_blank'>".$row5["eta_doc_egreso"]."</a>" : "POR DEVENGAR" ?></td>
    					</tr>
    				</table>
    			</td>
    		</tr>

    		<?php if ($regionsession == 14): ?>
    			<tr>
    				<td class="Estilo1">Otros Antecedentes (Oficina de Partes)</td>
    				<td>
    					<?php
    					$sql3 = "SELECT * FROM dpp_facturas_antecedente WHERE ant_eta_id = '".$id1b."' AND ant_region = '".$_SESSION["region"]."' AND ant_estado = 1";
    					


$res3 = mysql_query($sql3,$dbh);
if(mysql_num_rows($res3) > 0) {
	?>
	<table border="1" style="border-collapse: collapse;" width="100%">
		<tr>
			<td class="Estilo1c" style="text-align: center;">NOMBRE</td>
			<td class="Estilo1c" style="text-align: center;">ARCHIVO</td>
			<td class="Estilo1c" style="text-align: center;">ELIMINAR</td>
		</tr>

		<?php while($row3=mysql_fetch_array($res3)) { ?>
		<tr>
			<td class="Estilo1c" style="text-align: center;"><?php echo $row3["ant_nombre"] ?></td>
			<td class="Estilo1c" style="text-align: center;"><a href="../../archivos/docfac/<?php echo $row3["ant_ruta"] ?>" target="_blank">VER</a></td>
			<td class="Estilo1c" style="text-align: center;"><a href="facturas_antecedente_borrar.php?id=<?php echo $row3["ant_id"] ?>" onclick="return confirm('¿ESTÁ SEGURO DE ELIMINAR LA DOCUMENTACION ADJUNTA SELECCIONADA?')"><img src="imagenes/b_drop.png"></a></td>
		</tr>
		<?php } ?> 
	</table>

	<?php }else{  ?>
	<div class="alert alert-danger">
		NO SE HA SUBIDO ANTECEDENTES
	</div>
	<?php } ?>


    					
    				</td>
    			</tr>
    		<?php endif ?>
    		

    		<?

    		$mailuno=$row5["fac_mail1"];

    		if ($mailuno=="" and $regionsession==15 and 1==2) {

    			$mailprimero="aramirez@dpp.cl";

    		}else {

    			$mailprimero=$row5["fac_mail1"];



    		}

    		if ($regionsession==15 and 1==2) {

    			?>



    			<tr>

    				<td  valign="top" class="Estilo1">Email 1 </td>

    				<td class="Estilo1" colspan=3>

    					<input type="text" name="mail1" class="Estilo2" size="40" value="<? echo $mailprimero ?>">

    				</td>

    			</tr>

    			<tr>

    				<td  valign="top" class="Estilo1">Email 2 </td>

    				<td class="Estilo1" colspan=3>

    					<input type="text" name="mail2" class="Estilo2" size="40" value="<? echo $row5["fac_mail2"] ?>">

    				</td>

    			</tr>

    			<tr>

    				<td  valign="top" class="Estilo1">Email 3 </td>

    				<td class="Estilo1" colspan=3>

    					<input type="text" name="mail3" class="Estilo2" size="40" value="<? echo $row5["fac_mail3"] ?>">

    				</td>

    			</tr>

    			<tr>

    				<td  valign="top" class="Estilo1">Email 4 </td>

    				<td class="Estilo1" colspan=3>

    					<input type="text" name="mail4" class="Estilo2" size="40" value="<? echo $row5["fac_mail4"] ?>">

    				</td>

    			</tr>

    			<tr>

    				<td  valign="top" class="Estilo1">Email 5 </td>

    				<td class="Estilo1" colspan=3>

    					<input type="text" name="mail5" class="Estilo2" size="40" value="<? echo $row5["fac_mail5"] ?>">

    				</td>

    			</tr>

    			<tr>

    				<td  valign="center" class="Estilo1"><br> </td>

    				<td  valign="center" class="Estilo1"> </td>



    			</tr>

    			<?

    		}

    		if ($a0<>4) {

    			?>

    			<tr>

    				<td colspan=4 align="center"> <input type="submit" value="    GRABAR DATOS    " > </td>

    			</tr>

    			<?

    		}

    		?>
    		<input type="hidden" name="var1" value="<? echo $row5["fac_eta_id"] ?>" >
    		<input type="hidden" name="id" value="<? echo $id ?>" >
    		<input type="hidden" name="id1b" value="<? echo $id1b ?>" >
    		<input type="hidden" name="idetapa" value="<? echo $idetapa ?>" >
    		<input type="hidden" name="facfolio" value="<? echo $facfolio ?>" >
    		<input type="hidden" name="pagoid" value="<? echo $codigo2[4] ?>" >
    		<input type="hidden" name="ori" id="ori" value="<?php echo $_GET["ori"] ?>">
    	</form>

    </td>

    <?

    if ($regionsession==15 and 2==1) {

    	?>


    	<form name="form2" action="mail1etapa2.php" method="post"  onSubmit="return valida()"  >

    		<table>

    			<tr>

    				<td  valign="center" class="Estilo1" colspan=8></td>

    			</tr>



    			<tr>

    				<td  valign="top" class="Estilo1c" colspan="4">NOTA: Antes de enviar e-mail, se debe grabar información</td>

    			</td>

    		</tr>





    		<tr>

    			<td  valign="top" class="Estilo1">Email 1 </td>

    			<td class="Estilo1" colspan=3>

    				<input type="checkbox" name="envia1" class="Estilo2" value="1">

    				<input type="hidden" name="mail1" class="Estilo2" size="40" value="<? echo $row5["fac_mail1"] ?>"><? echo $row5["fac_mail1"] ?>

    			</td>

    		</tr>

    		<tr>

    			<td  valign="top" class="Estilo1">Email 2 </td>

    			<td class="Estilo1" colspan=3>

    				<input type="checkbox" name="envia2" class="Estilo2" value="1">

    				<input type="hidden" name="mail2" class="Estilo2" size="40" value="<? echo $row5["fac_mail2"] ?>"><? echo $row5["fac_mail2"] ?>

    			</td>

    		</tr>

    		<tr>

    			<td  valign="top" class="Estilo1">Email 3 </td>

    			<td class="Estilo1" colspan=3>

    				<input type="checkbox" name="envia3" class="Estilo2" value="1">

    				<input type="hidden" name="mail3" class="Estilo2" size="40" value="<? echo $row5["fac_mail3"] ?>"><? echo $row5["fac_mail3"] ?>

    			</td>

    		</tr>

    		<tr>

    			<td  valign="top" class="Estilo1">Email 4 </td>

    			<td class="Estilo1" colspan=3>

    				<input type="checkbox" name="envia4" class="Estilo2" value="1">

    				<input type="hidden" name="mail4" class="Estilo2" size="40" value="<? echo $row5["fac_mail4"] ?>"><? echo $row5["fac_mail4"] ?>

    			</td>

    		</tr>

    		<tr>

    			<td  valign="top" class="Estilo1">Email 5 </td>

    			<td class="Estilo1" colspan=3>

    				<input type="checkbox" name="envia5" class="Estilo2" value="1">

    				<input type="hidden" name="mail5" class="Estilo2" size="40" value="<? echo $row5["fac_mail5"] ?>"><? echo $row5["fac_mail5"] ?>

    			</td>

    		</tr>



    		<tr>

    			<td  valign="center" class="Estilo1"><br><br><br> </td>

    			<td  valign="center" class="Estilo1"> </td>



    		</tr>



    		<tr>

    			<input type="hidden" name="id" value="<? echo $id ?>" >

    			<input type="hidden" name="id1b" value="<? echo $id1b ?>" >

    			<input type="hidden" name="sw" value="1">

    			<input type="hidden" name="idetapa" value="<? echo $idetapa ?>" >

    			<?

    			if ($row5["fac_archivo"]<>"" and $row5["fac_doc1"]<>"" and $row5["eta_depto_aprobacion"]<>"0") {

    				?>

    				<td colspan=4 align="center"> <input type="submit" value="    Enviar Mail " > </td>

    				<?

    			}

    			?>

    		</tr>

    		<?

    	}

    	?>

    </table>

</form>









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



				<img src="images/pix.gif" width="1" height="10">

			</body>

			</html>



			<?



			?>