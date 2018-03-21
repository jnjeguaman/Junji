<?
header("content-type: text/html; charset=iso-8859-1");
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
	<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
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
		.Estilo1d {
			font-family: Verdana;
			font-weight: bold;
			font-size: 8px;
			color: #003063;
			text-align: center;

		}
		.Estilo1ce {
			font-family: Verdana;
			font-weight: bold;
			font-size: 8px;
			color: #003063;
			text-align: center;
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
			font-size: 14px; font-weight: bold; }




			.ir-arriba {
				display:none;
				padding:20px;
				background:#024959;
				font-size:20px;
				color:#fff;
				cursor:pointer;
				position: fixed;
				bottom:20px;
				right:20px;
			}


		-->
	</style>
	<link rel="stylesheet" type="text/css" href="select_dependientes.css">
	<script type="text/javascript" src="select_dependientes.js"></script>
	<link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
  <!-- <script src="librerias/jquery-1.11.3.min.js"></script> -->


  <script type="text/javascript">

  	$(document).ready(function(){

  		$('.ir-arriba').click(function(){
  			$('body, html').animate({
  				scrollTop: '0px'
  			}, 300);
  		});

  		$(window).scroll(function(){
  			if( $(this).scrollTop() > 0 ){
  				$('.ir-arriba').slideDown(300);
  			} else {
  				$('.ir-arriba').slideUp(300);
  			}
  		});

  	});

  	$(document).ready(function(){

  		$('.ir-arriba').click(function(){
  			$('body, html').animate({
  				scrollTop: '0px'
  			}, 300);
  		});

  		$(window).scroll(function(){
  			if( $(this).scrollTop() > 0 ){
  				$('.ir-arriba').slideDown(300);
  			} else {
  				$('.ir-arriba').slideUp(300);
  			}
  		});

  	});


  </script>



  <SCRIPT LANGUAGE ="JavaScript">

  	function abrirVentana5(eta_id,eta_folio)
  	{
  		miPopup = window.open("historialdevueltos.php?eta_id="+eta_id+"&eta_folio="+eta_folio,"miwin","width=1000,height=500,scrollbars=yes,toolbar=0")

  		miPopup.focus()
  	}
  	function abrirVentana(eta_id)
  	{
  		miPopup = window.open("contabilidad_fdevengo.php?eta_id="+eta_id,"miwin","width=550,height=400,scrollbars=yes,toolbar=0")
  		miPopup.focus()
  	}
  	function abrirVentana2(fac_id){

  		miPopup = window.open("compra_documentos.php?fac_id="+fac_id,"miwin","width=700,height=500,scrollbars=yes,toolbar=0")

  		miPopup.focus()

  	}
/*    function abrirVentana3(eta_id){

      miPopup = window.open("fecha_devengo.php?eta_id="+eta_id,"miwin","width=400,height=250,scrollbars=yes,toolbar=0")

      miPopup.focus()

  }*/
  function abrirVentana4(eta_id){

  	miPopup = window.open("comprobante_egreso.php?eta_id="+eta_id,"miwin","width=800,height=400,scrollbars=yes,toolbar=0")

  	miPopup.focus()

  }
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
  	if (document.form1.uno.value == 2 || document.form1.uno.value == 3) {
  		seccion1.style.display="";
  	} else {
  		seccion1.style.display="none";
  	}
  }


  function muestra2() {
  	if (document.form2.uno22.value == 2 || document.form2.uno22.value == 3) {
  		seccion2.style.display="";
  	} else {
  		seccion2.style.display="none";
  	}
  }


  function valida() {
  	var numberOfChecked = $('input:checkbox:checked').length;
  	if(numberOfChecked == 0)
  	{
  		alert("Debe seleccionar al menos 1 documento.");
  		return false;
  	}

	if(confirm('\u00BF EST\u00c1 SEGURO DE PROCEDER CON LA ACCI\u00d3N ?')) {
    	blockUI();
  	}
  	else{
    	return false;
  	}


  	/*if (document.form1.uno.value==0 || document.form1.uno.value=='') {
  		alert ("No ha seleccionado una Accion ");
  		return false;
  	}
  	if (document.form1.uno.value==2 && document.form1.justifica.value=='') {
  		alert ("No ha Justificado ");
  		return false;
  	}
  	if (document.form1.uno.value==3 && document.form1.justifica.value=='') {
  		alert ("No ha Justificado ");
  		return false;
  	}*/

  	

  }



  function valida2() {
  	var numberOfChecked = $('input:checkbox:checked').length;
  	if(numberOfChecked == 0)
  	{
  		alert("Debe seleccionar al menos 1 documento.");
  		return false;
  	}

	if(confirm('\u00BF EST\u00c1 SEGURO DE PROCEDER CON LA ACCI\u00d3N ?')) {
    	blockUI();
  	}
  	else{
    	return false;
  	}

  	/*if (document.form2.uno22.value==0 || document.form2.uno22.value=='') {
  		alert ("No ha seleccionado una Accion ");
  		return false;
  	}
  	if (document.form2.uno22.value==2 && document.form2.justifica2.value=='') {
  		alert ("No ha Justificado ");
  		return false;
  	}
  	if (document.form2.uno22.value==3 && document.form2.justifica2.value=='') {
  		alert ("No ha Justificado ");
  		return false;
  	}*/


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

					if ($regionsession==0) {
						$sqlt="select count(eta_id) as Total from dpp_etapas where (eta_estado=5) order by eta_folio desc ";
					} else {
						if ($regionsession==15) {
							$sqlt="select * from dpp_etapas where (eta_estado=5) and eta_region=$regionsession order by eta_folio desc ";
						}
						if ($regionsession<>15) {
							$sqlt="select count(eta_id) as Total from dpp_etapas where (eta_estado=5) and eta_region=$regionsession and (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 = '0000-00-00') and eta_fechaguia2 >= '2017-02-01 00:00:00' order by eta_folio desc ";
						}
					}
   // echo $sqlt;
					$rest = mysql_query($sqlt);
					$rowt = mysql_fetch_array($rest);

					?>

				</div>
			</div>

			<div class="col-sm-10 col-lg-10">
				<div class="dash-unit2">

					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="20" colspan="2"><span class="Estilo7">ASIGNACI&Oacute;N SET DE PAGO</span></td>
						</tr>

						<tr>
							<td><a href="menucontabilidad.php" class="link">Volver</a></td>
						</tr>
						<tr>
							<td><hr></td><td><hr></td>
						</tr>
						<?
						$region=$_GET["region"];
						$fecha1=$_GET["fecha1"];
						$fecha2=$_GET["fecha2"];
						$rut=$_GET["rut"];
						$item=$_GET["item"];
						$consolidado=$_GET["consolidado"];


						ini_set('date.timezone','America/Santiago'); 
						$fecha_actual = date("Y-m-d");
						?>



						<tr>
							<td height="50" colspan="3">
							</table>

							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<form name="form1" action="grabavalida5asignacion.php" method="post" enctype="multipart/form-data" onSubmit="return valida()">

									<table width="100%" border="0" class="table table-striped table-bordered table-hover">
										<?
										if ( 1==1){
											?>
											<tr>
												<td  valign="center" colspan="4" class="Estilo1">Asignar</td>
												<td class="Estilo1" colspan="8">
													<select name="dos" class="Estilo1" onchange="muestra();">
														<option value="">Seleccione...</option>
														<?

												//$sql4="select * from usuarios where (atributo1=8 or atributo1=7 or atributo1 = 38) and region = ".$regionsession." and sistema = 1";
														$sql4="select * from usuarios where (atributo1=5 or atributo1=34) and region = ".$regionsession." and sistema = 1 and estado = 'A'";
														$res4 = mysql_query($sql4);
														while($row4 = mysql_fetch_array($res4)){
															?>
															<option value="<? echo $row4["nombre"]; ?>" ><? echo mb_convert_encoding($row4["nombrecom"],"ISO-8859-1"); ?></option>

															<?
														}
														?>


													</select>
													<div id="seccion1" style="display:none">
														Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
													</div>

												</td>

											</tr>
											<tr>
												<td  valign="center" class="Estilo1" colspan=12 align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="boton" class="Estilo2" value="  Acepta Acci&oacute;n "> </td>
											</tr>
											<?
										}
										?>
									</table>

									<table border="1" class="table">
										<tr>
											<td class="Estilo1ce">Prioridad</td>
											<td class="Estilo1ce">Op. </td>
											<td class="Estilo1ce">Folio</td>
											<td class="Estilo1ce">N&deg; Oc</td>
											<td class="Estilo1ce">Rut</td>
											<td class="Estilo1ce">Nombre</td>
											<td class="Estilo1ce">Tipo Doc.</td>
											<td class="Estilo1ce">A pagar</td>
											<td class="Estilo1ce">N&deg; Doc. </td>
											<td class="Estilo1d">Documentos</td>
											<td class="Estilo1ce">Fecha Recibido</td>
											<td class="Estilo1ce">Dias Transcurridos</td>
											<td class="Estilo1b">Historial</td>
											<td class="Estilo1b">Fecha Env&iacute;o SYC</td>
										</tr>

										<?

										$sql5="select * from dpp_plazos ";
//echo $sql;
										$res5 = mysql_query($sql5);
										$row5 = mysql_fetch_array($res5);
										$etapa5a=$row5["pla_etapa5a"];
										$etapa5b=$row5["pla_etapa5b"];

										if ($regionsession==0) {
											$sql="select * from dpp_etapas where (eta_estado=5)  order by eta_folio desc ";
										} else {
											if ($regionsession==15) {
												$sql="select * from dpp_etapas where (eta_estado=5) and eta_region=$regionsession order by eta_folio desc ";
											}
											if ($regionsession<>15) {
												$sql="SELECT *, DATEDIFF ('2017-03-12','$fecha_actual') AS diferencia FROM dpp_etapas WHERE (eta_estado=5) AND eta_region=$regionsession AND (eta_asignado2 = '' or eta_asignado2 is null) AND (eta_usu_recepcion22 = '' or eta_usu_recepcion22 is null) AND eta_fechaguia2 >= '2017-02-01 00:00:00' ORDER BY eta_urgencia DESC, diferencia DESC ";
											}
										}

// echo $sql;
										$res3 = mysql_query($sql);

										if (mysql_num_rows($res3)>0) {


											$cont=1;

											while($row3 = mysql_fetch_array($res3)){
												$fechahoy = $date_in;
												$dia1 = strtotime($fechahoy);
												$fechabase =$row3["eta_fecha_recepcion"];
												$dia2 = strtotime($fechabase);
												$diff=$dia1-$dia2;
												$diff=intval($diff/(60*60*24));
												if ($etapa5a>=$diff)
													$clase="Estilo1cverde";
												if ($etapa5a<$diff and $etapa5b>=$diff )
													$clase="Estilo1camarrillo";
												if ( $etapa5b<$diff)
													$clase="Estilo1crojo";


												$fechahoy = $row3["eta_fecha_aprobacionok"];
												$dia1 = strtotime($fechahoy);
												$fechabase =$row3["eta_fecha_recepcion"];
												$dia2 = strtotime($fechabase);
												$difff=$dia1-$dia2;
												$diff4=$dia2+$difff;
//    echo $diff."--";
												$diff2=intval($difff/(60*60*24));
												$diff2b=$diff2;
//    echo $diff2."<br>";
												$diff3= date('Y-m-d', $diff4);
												if ($diff2>8 ) {
													$diff5=8*24*60*60;
    //echo $diff5."<br>";
													$diff4=$dia2+$diff5;
													$diff3= date('Y-m-d', $diff4);
													$diff2b=8;
												}

												if($diff <= 10)
												{
              //VERDE
													$color="#139c06";
												}else if($diff > 10 && $diff <= 20)
												{
              //AZUL
													$color="#063bcc";
												}else{
              //ROJO
													$color="#f00";
												}

												$vartipodoc1=$row3["eta_tipo_doc"];
										if ($vartipodoc1=='Factura') {
											$vartipodoc2=$row3["eta_tipo_doc2"];
											if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
												$vartipodoc="Factura";
											if ($vartipodoc2=="b")
												$vartipodoc="Boleta Servicio";
											if ($vartipodoc2=="r")
												$vartipodoc="Recibo";
											if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
												$vartipodoc="N.Credito";
											if ($vartipodoc2=="bh" or $vartipodoc2=="BH" or $vartipodoc2=="BHS")
												$vartipodoc="Honorario";
											if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
												$vartipodoc="N.Débito";
										}
										if ($vartipodoc1=='Honorario') {
											$vartipodoc="Honorario";
										}

   //------------ Comienza la muestra de los archivos en el listado tanto para facturas como para honorarios. ------------

												$muestra1="X";
												if ($row3["eta_tipo_doc"]=="Factura") {
													$archivo="facturasarchivos.php";
													$eta_id=$row3["eta_id"];
													$sql5="select * from dpp_facturas where fac_eta_id=$eta_id";
        //echo $sql;
													$res5 = mysql_query($sql5);
													$row5=mysql_fetch_array($res5);
													$archivo5=$row5["fac_archivo"];
													$doc15=$row5["fac_doc1"];
													$doc25=$row5["fac_doc2"];
													$viene_id=$row5["fac_id"];
													if ($archivo5==""){
														$muestra1="X";
														$href1="#";
													}
													if ($archivo5<>"") {
														$muestra1="Ok";
														$href1="../../archivos/docfac/".$archivo5;
													}
													if ($doc15=="") {
														$muestra2="X";
														$href2="#";
													}
													if ($doc15<>"") {
														$muestra2="Ok";
          // $href2="../../archivos/docfac/".$doc15;
														$href2="../../archivos/docfac/".date("Y")."/".$doc15;
													}
													if ($doc25=="") {
														$muestra3="X";
														$href3="#";
													}
													if ($doc25<>"") {
														$muestra3="Ok";
          // $href3="../../archivos/docfac/".$doc25;
														$href3="../../archivos/docfac/".date("Y")."/".$doc25;
													}
												}
												if ($row3["eta_tipo_doc"]=="Honorario") {
													$archivo="honorarioarchivos.php";

													$eta_id=$row3["eta_id"];
													$sql5="select * from dpp_honorarios where hono_eta_id=$eta_id";
        //echo $sql;
													$res5 = mysql_query($sql5);
													$row5=mysql_fetch_array($res5);
													$archivo5=$row5["hono_archivo"];
													$doc15=$row5["hono_doc1"];
													$doc25=$row5["hono_doc2"];
													$viene_id=$row5["hono_id"];
													if ($archivo5==""){
														$muestra1="X";
														$href1="#";
													}
													if ($archivo5<>"") {
														$muestra1="Ok";
														$href1="../../archivos/docfac/".$archivo5;
													}
													if ($doc15=="") {
														$muestra2="X";
														$href2="#";
													}
													if ($doc15<>"") {
														$muestra2="Ok";
														$href2="../../archivos/docfac/".$doc15;
													}
													if ($doc25=="") {
														$muestra3="X";
														$href3="#";
													}
													if ($doc25<>"") {
														$muestra3="Ok";
														$href3="../../archivos/docfac/".$doc25;
													}

												}



												$read1= rand(0,1000000);
												$read2= rand(0,1000000);
												$read3= rand(0,1000000);
												$read4= rand(0,1000000);

												if($row3["eta_urgencia"] == 1)
												{
													$label = "<span class=\"label label-danger\">URGENTE!</span>";
												}
												else
												{
													$label = "<span class=\"label label-primary\">Normal</span>";
												}




												?>
												<tr>
													<td class="text-center"><?php echo $label; ?></td>
													<td class="Estilo1b">
														<?php //if ($row3["eta_fdevengo"] <> "0000-00-00" && $row3["eta_fdevengo"] <> ""): ?>
														<input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" >
														<input type="hidden" name="folio[<?php echo $cont ?>]" value="<?php echo $row3["eta_folio"] ?>">
														<?php// else: ?>
														<?php// endif ?>
													</td>
													<input alt="ok" type="hidden" name="var2[<? echo $cont ?>]" value="<? echo $row3["eta_tipo_doc"] ?>" class="Estilo2" >
													<td class="Estilo1ce"><? echo $row3["eta_folio"]  ?></td>

													<td class="Estilo1ce"><? echo $row3["eta_nroorden"]  ?></td>

													<td class="Estilo1c" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
													<td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>
													<td class="Estilo1ce"><? echo $vartipodoc ?> </td>

													<td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
													<td class="Estilo1c"><? echo $row3["eta_numero"]   ?> </td>


													<td class="Estilo1d">

														<a href="#" onClick="abrirVentana2('<?php echo $viene_id ?>')">VER</a>

														<!-- <a href="#"  data-toggle="modal" data-target="#recupera<? echo $viene_id ?>" data-book-id="1" class="link" > VER </a> -->

														<?php //include("compra_modal.php") ?>

													</td>


													<td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>

													<td class="Estilo1ce"><font color="<?php echo $color ?>"><? echo $diff ?></font></td>
													<td class="Estilo1c text-center"><a href="#" onClick="abrirVentana5('<?php echo $row3["eta_id"]; ?>','<?php echo $row3["eta_folio"]; ?>')" class="link" >VER</a></td>
													<td class="Estilo1c"><?php echo $row3["eta_fechaguia2"] ?></td>
												</tr>





												<?

												$cont++;

											}

										}
										else{
											?>

											<tr>
												<td colspan="15" class="Estilo1 text-center">&iexcl;No se han recepcionado set de pagos!</td>
											</tr>

											<?
										}

										?>
										<input type="hidden" name="cont" value="<? echo $cont ?>" >
									</form>



								</table>

								<!-- REASIGNACION SET DE PAGOS -->
								<hr>

		<form name="form1" action="grabavalida5asignacion2.php" method="post" enctype="multipart/form-data" onsubmit="return valida2()">
								<table width="100%" border="0" class="table table-striped table-bordered table-hover">
									<tr>
										<td  valign="center" colspan="4" class="Estilo1">Reasignar</td>
										<td class="Estilo1" colspan="8">
											<select name="dos" class="Estilo1" required>
												<option value="">Seleccione...</option>
												<?

                        //$sql4="select * from usuarios where (atributo1=8 or atributo1=7 or atributo1 = 38) and region = ".$regionsession." and sistema = 1";
												$sql4="select * from usuarios where (atributo1=5 or atributo1=34) and region = ".$regionsession." and sistema = 1 and estado = 'A'";
												$res4 = mysql_query($sql4);
												while($row4 = mysql_fetch_array($res4)){
													?>
													<option value="<? echo $row4["nombre"]; ?>" ><? echo strtoupper($row4["nombrecom"]) ?></option>

													<?
												}
												?>
											</select>
										</td>
									</tr>

									<tr>
										<td  valign="center" class="Estilo1" colspan=12 align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="boton" class="Estilo2" value="  Acepta Acci&oacute;n "> </td>
									</tr>

								</table>

								<table border="1" class="table">
									<tr>
										<td class="Estilo1ce">Prioridad</td>
										<td class="Estilo1ce">Op. </td>
										<td class="Estilo1ce">Ejecutivo Asignado</td>
										<td class="Estilo1ce">Folio</td>
										<td class="Estilo1ce">N&deg; Oc</td>
										<td class="Estilo1ce">Rut</td>
										<td class="Estilo1ce">Nombre</td>
										<td class="Estilo1ce">Tipo Doc.</td>
										<td class="Estilo1ce">A pagar</td>
										<td class="Estilo1ce">N&deg; Doc. </td>
										<td class="Estilo1d">Documentos</td>
										<td class="Estilo1ce">Fecha Recibido</td>
										<td class="Estilo1ce">Dias Transcurridos</td>
										<td class="Estilo1b">Historial</td>
										<td class="Estilo1b">Fecha Env&iacute;o SYC</td>
									</tr>


									<?php 
									$sql="SELECT *, DATEDIFF ('2017-03-12','$fecha_actual') AS diferencia
									FROM dpp_etapas 
									WHERE eta_estado=5 
									AND eta_region=$regionsession
									AND eta_asignado2 <> ''
									AND (eta_usu_recepcion22 <> '' || eta_usu_recepcion22 = '' || eta_usu_recepcion22 IS NULL)
									AND (eta_destinatario3 is null or eta_destinatario3 = '')
									AND (eta_fecha_recepcion3 is null or eta_fecha_recepcion3 = '' or eta_fecha_recepcion3 ='0000-00-00')
									AND (eta_fechaguia2 >= '2017-02-01 00:00:00')
									ORDER BY eta_urgencia DESC,diferencia DESC";
									// echo $sql;
									$res=mysql_query($sql);
									$contador=1;

									if(mysql_num_rows($res) > 0)
									{
										while($row = mysql_fetch_array($res)){ 
											$fechahoy = $date_in;
											$dia1 = strtotime($fechahoy);
											$fechabase =$row["eta_fecha_recepcion"];
											$dia2 = strtotime($fechabase);
											$diff=$dia1-$dia2;
											$diff=intval($diff/(60*60*24));
											if ($etapa5a>=$diff)
												$clase="Estilo1cverde";
											if ($etapa5a<$diff and $etapa5b>=$diff )
												$clase="Estilo1camarrillo";
											if ( $etapa5b<$diff)
												$clase="Estilo1crojo";

											$fechahoy = $row["eta_fecha_aprobacionok"];
											$dia1 = strtotime($fechahoy);
											$fechabase =$row["eta_fecha_recepcion"];
											$dia2 = strtotime($fechabase);
											$difff=$dia1-$dia2;
											$diff4=$dia2+$difff;
//    echo $diff."--";
											$diff2=intval($difff/(60*60*24));
											$diff2b=$diff2;
//    echo $diff2."<br>";
											$diff3= date('Y-m-d', $diff4);
											if ($diff2>8 ) {
												$diff5=8*24*60*60;
    //echo $diff5."<br>";
												$diff4=$dia2+$diff5;
												$diff3= date('Y-m-d', $diff4);
												$diff2b=8;
											}

											if($diff <= 10)
											{
              //VERDE
												$color="#139c06";
											}else if($diff > 10 && $diff <= 20)
											{
              //AZUL
												$color="#063bcc";
											}else{
              //ROJO
												$color="#f00";
											}

											$vartipodoc1=$row["eta_tipo_doc"];
										if ($vartipodoc1=='Factura') {
											$vartipodoc2=$row["eta_tipo_doc2"];
											if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
												$vartipodoc="Factura";
											if ($vartipodoc2=="b")
												$vartipodoc="Boleta Servicio";
											if ($vartipodoc2=="r")
												$vartipodoc="Recibo";
											if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
												$vartipodoc="N.Credito";
											if ($vartipodoc2=="bh" or $vartipodoc2=="BH" or $vartipodoc2=="BHS")
												$vartipodoc="Honorario";
											if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
												$vartipodoc="N.Débito";
										}
										if ($vartipodoc1=='Honorario') {
											$vartipodoc="Honorario";
										}

   //------------ Comienza la muestra de los archivos en el listado tanto para facturas como para honorarios. ------------

											$muestra1="X";
											if ($row["eta_tipo_doc"]=="Factura") {
												$archivo="facturasarchivos.php";
												$eta_id=$row["eta_id"];
												$sql5="select * from dpp_facturas where fac_eta_id=$eta_id";
        //echo $sql;
												$res5 = mysql_query($sql5);
												$row5=mysql_fetch_array($res5);
												$archivo5=$row5["fac_archivo"];
												$doc15=$row5["fac_doc1"];
												$doc25=$row5["fac_doc2"];
												$viene_id=$row5["fac_id"];
												if ($archivo5==""){
													$muestra1="X";
													$href1="#";
												}
												if ($archivo5<>"") {
													$muestra1="Ok";
													$href1="../../archivos/docfac/".$archivo5;
												}
												if ($doc15=="") {
													$muestra2="X";
													$href2="#";
												}
												if ($doc15<>"") {
													$muestra2="Ok";
          // $href2="../../archivos/docfac/".$doc15;
													$href2="../../archivos/docfac/".date("Y")."/".$doc15;
												}
												if ($doc25=="") {
													$muestra3="X";
													$href3="#";
												}
												if ($doc25<>"") {
													$muestra3="Ok";
          // $href3="../../archivos/docfac/".$doc25;
													$href3="../../archivos/docfac/".date("Y")."/".$doc25;
												}
											}
											if ($row["eta_tipo_doc"]=="Honorario") {
												$archivo="honorarioarchivos.php";

												$eta_id=$row3["eta_id"];
												$sql5="select * from dpp_honorarios where hono_eta_id=$eta_id";
        //echo $sql;
												$res5 = mysql_query($sql5);
												$row5=mysql_fetch_array($res5);
												$archivo5=$row5["hono_archivo"];
												$doc15=$row5["hono_doc1"];
												$doc25=$row5["hono_doc2"];
												$viene_id=$row5["hono_id"];
												if ($archivo5==""){
													$muestra1="X";
													$href1="#";
												}
												if ($archivo5<>"") {
													$muestra1="Ok";
													$href1="../../archivos/docfac/".$archivo5;
												}
												if ($doc15=="") {
													$muestra2="X";
													$href2="#";
												}
												if ($doc15<>"") {
													$muestra2="Ok";
													$href2="../../archivos/docfac/".$doc15;
												}
												if ($doc25=="") {
													$muestra3="X";
													$href3="#";
												}
												if ($doc25<>"") {
													$muestra3="Ok";
													$href3="../../archivos/docfac/".$doc25;
												}

											}



											$read1= rand(0,1000000);
											$read2= rand(0,1000000);
											$read3= rand(0,1000000);
											$read4= rand(0,1000000);

											if($row["eta_urgencia"] == 1)
											{
												$label = "<span class=\"label label-danger\">URGENTE!</span>";
											}
											else
											{
												$label = "<span class=\"label label-primary\">Normal</span>";
											}




											?>

											<tr>
												<td class="text-center"><?php echo $label; ?></td>
												<td class="Estilo1b">
													<?php //if ($row3["eta_fdevengo"] <> "0000-00-00" && $row3["eta_fdevengo"] <> ""): ?>
													<input alt="ok" type="checkbox" name="var[<? echo $contador ?>]" value="<? echo $row["eta_id"] ?>" class="Estilo2" >
													<input type="hidden" name="folio[<?php echo $contador ?>]" value="<?php echo $row["eta_folio"] ?>">
													<?php// else: ?>
													<?php// endif ?>
												</td>
												<input alt="ok" type="hidden" name="var2[<? echo $contador ?>]" value="<? echo $row["eta_tipo_doc"] ?>" class="Estilo2" >
												<td class="Estilo1ce"><?php echo $row["eta_asignado2"] ?></td>
												<td class="Estilo1ce"><? echo $row["eta_folio"]  ?></td>
												<td class="Estilo1ce"><? echo $row["eta_nroorden"]  ?></td>
												<td class="Estilo1c" title="<? echo $row["eta_cli_nombre"]  ?>"><? echo $row["eta_rut"]  ?>-<? echo $row["eta_dig"]  ?> </td>
												<td class="Estilo1b"><? echo $row["eta_cli_nombre"]  ?> </td>
												<td class="Estilo1ce"><? echo $vartipodoc ?> </td>

												<td class="Estilo1c"><? echo number_format($row["eta_monto"],0,',','.')  ?> </td>
												<td class="Estilo1c"><? echo $row["eta_numero"]   ?> </td>


												<td class="Estilo1d">

													<a href="#" onClick="abrirVentana2('<?php echo $viene_id ?>')">VER</a>

													<!-- <a href="#"  data-toggle="modal" data-target="#recupera<? echo $viene_id ?>" data-book-id="1" class="link" > VER </a> -->

													<?php //include("compra_modal.php") ?>

												</td>


												<td class="<? echo $clase ?>"><? echo substr($row["eta_fecha_recepcion"],8,2)."-".substr($row["eta_fecha_recepcion"],5,2)."-".substr($row["eta_fecha_recepcion"],0,4)   ?></td>

												<td class="Estilo1ce"><font color="<?php echo $color ?>"><? echo $diff ?></font></td>
												<td class="Estilo1c text-center"><a href="#" onClick="abrirVentana5('<?php echo $row["eta_id"]; ?>','<?php echo $row["eta_folio"]; ?>')" class="link" >VER</a></td>
												<td class="Estilo1c"><?php echo $row["eta_fechaguia2"] ?></td>
											</tr>
											<?php 
											$contador++;
										}

									}

									?>
								</table>
								<input type="hidden" name="contador" value="<? echo $contador ?>" >
								</form>
								<!-- FIN REASIGNACION -->

								<span class="ir-arriba"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></span>

								<!--Agregamos contenido para que aparezca la barra vertical del navegador-->



								<img src="images/pix.gif" width="1" height="10">
							</body>
							</html>

							<?
//require("inc/func.php");
							?>
