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
		.Estilo1b {
			font-family: Verdana;
			font-weight: bold;
			font-size: 8px;
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
		.Estilo2 {
			font-family: Verdana;
			font-size: 10px;
			text-align: left;
		}

		.Estilo2r {
			font-family: Verdana;
			font-size: 10px;
			text-align: right;
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
		}
		.Estilo7c {font-family: Geneva, Arial, Helvetica, sans-serif;
			font-size: 12px;
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
  
  <script>
  	<!--
  	function exenta() {
  		document.getElementById("neto1").innerHTML="NETO";
  		document.getElementById("iva1").innerHTML="IVA";
  		document.getElementById("total1").innerHTML="TOTAL";

  		if (document.form1.neto.value!=0) {
  			document.form1.iva.value='0';
  			document.form1.monto.value=document.form1.monto.value;
  			document.form1.exento.value=document.form1.monto.value;
  			document.form1.neto.value='0';
  		}
  	}
  	function noexenta() {
  		document.getElementById("neto1").innerHTML="NETO";
  		document.getElementById("iva1").innerHTML="IVA";
  		document.getElementById("total1").innerHTML="TOTAL";

//    if (document.form1.neto.value==0) {
	document.form1.neto.value=Math.round(document.form1.monto2.value/1.19);
	document.form1.iva.value=Math.round(document.form1.neto.value*0.19);
	document.form1.monto.value=Math.round(document.form1.neto.value)+Math.round(document.form1.iva.value);
	document.form1.exento.value=0;

	if (document.form1.swfreserva.checked==true) {
		document.form1.freserva.value=Math.round(document.form1.monto.value*0.04);
		document.form1.montonuevo.value=Math.round(document.form1.monto.value-document.form1.freserva.value);

	}

}

function hono1() {


	document.getElementById("neto1").innerHTML="LIQUIDO A PAGAR";
	document.getElementById("iva1").innerHTML="RETENCION";
	document.getElementById("total1").innerHTML="BRUTO";
	document.form1.neto.value=document.form1.monto2.value;
	document.form1.iva.value=Math.round(document.form1.monto2.value*10/90);
//      alert(document.form1.iva.value);
document.form1.monto.value=Math.round(document.form1.iva.value)+Math.round(document.form1.neto.value);

document.form1.exento.value=0;
if (document.form1.swfreserva.checked==true) {
//          alert("entra 2 :"+document.form1.iva.value);
document.form1.freserva.value=Math.round(document.form1.monto.value*0.04);
document.form1.montonuevo.value=Math.round(document.form1.monto.value-document.form1.freserva.value-document.form1.iva.value);

}

}


function hono2() {
	document.getElementById("neto1").innerHTML="NETO";
	document.getElementById("iva1").innerHTML="IVA";
	document.getElementById("total1").innerHTML="TOTAL";


	document.form1.neto.value=0;
	document.form1.iva.value=0;
	document.form1.monto.value=document.form1.monto2.value;
	document.form1.exento.value=0;


}

function hono3() {


	document.getElementById("neto1").innerHTML="LIQUIDO A PAGAR";
	document.getElementById("iva1").innerHTML="RETENCION";
	document.getElementById("total1").innerHTML="BRUTO";


}


-->
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
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="20" colspan="2"><span class="Estilo7">FICHA: FACTURA Y/O BOLETAS</span></td>
						</tr>
						<tr>
							<?
							$ori=$_GET["ori"];
							if ($ori=='') {
								$volver="valida5.php";
							}
							if ($ori=='2') {
								$volver="cambioestado.php";
							}
							?>

							<tr>
								<td>

									<a href="<? echo $volver; ?>" class="link">VOLVER</a>
								</td>
							</tr>
							<td><hr></td><td><hr></td>
						</tr>

						<tr>
							<td width="487" valign="top" class="Estilo1">

								<?

								if (isset($_GET["llave"]))
									echo "<p>Registros insertados con Exito !";

								$id=$_GET["id"];
								$id2=$_GET["id2"];


								if ($ori==11) {
									$sql6="update dpp_etapas set eta_estado=3 where eta_id=$id2";
									mysql_query($sql6);
									echo "<script>location.href='valida6.php';</script>";

								}



								if ($id<>"") {
									$sql5="select * from dpp_facturas x, dpp_etapas y where x.fac_id=$id and x.fac_eta_id=y.eta_id";
								}
								if ($id2<>"") {
									$sql5="select * from dpp_facturas x, dpp_etapas y where fac_eta_id=$id2 and x.fac_eta_id=y.eta_id";
								}


//echo $sql5;
								$res5 = mysql_query($sql5);
								$row5=mysql_fetch_array($res5);
								$id=$row5["fac_id"];
								$tipodoc2=$row5["eta_tipo_doc2"];
								$etarut=$row5["eta_rut"];
								$etanumero=$row5["eta_numero"];
								$id1b=$row5["eta_id"];
//$archivo5=$row5["fac_"];

								?>
								<?

//    require_once('inc2/nusoap.php');
//    $cliente2 = new nusoap_client('http://10.16.25.62/sistemas/servicios/atencion/servicio5.php');
//    $cliente2 = new nusoap_client('http://10.17.5.183/sdi/atencion/servicio5.php');
//    $resultado2 = $cliente2->call('busca55', array('x' => $etarut, 'y' => $etanumero, 'operacion' => 'multiplica'));


//    echo "-->".$resultado2."<br>";


								?>



							</td>
						</tr>


						<tr>
							<td height="50" colspan="3">
							</table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<form name="form1" action="grabaverdocedit.php" method="post" enctype="multipart/form-data" >
									<tr>
										<td  valign="center" class="Estilo1">FOLIO</td>
										<td class="Estilo7c" colspan=3><? echo $row5["eta_folio"] ?>

										</td>
									</tr>
									<?
									$a=$row5["fac_fecha_recepcion"];
                                     //echo $a."-";


									?>

									<tr>
										<td  valign="center" class="Estilo1">Fecha Recepción</td>
										<td class="Estilo1" valign="center">
											<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4); ?>" id="f_date_c2" readonly="1">
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
<?
$a=$row5["fac_fecha_fac"];
                                     //echo $a."-";


?>

<tr>
	<td  valign="center" class="Estilo1">Fecha Factura</td>
	<td class="Estilo1" valign="center">
		<input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4); ?>" id="f_date_c3" readonly="1">
		<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
		onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

		<script type="text/javascript">
			Calendar.setup({
        inputField     :    "f_date_c3",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>



</td>
</tr>



<tr>
	<td  valign="center" class="Estilo1">Fecha Factura</td>
	<td class="Estilo1">



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

<tr>
	<td  valign="center" class="Estilo1">Rut  </td>
	<td class="Estilo1" colspan=3><? echo $row5["fac_rut"]."-".$row5["fac_dig"]; ?>
	</td>
</tr>

<tr>
	<td  valign="center" class="Estilo1">Nombre  </td>
	<td class="Estilo1" colspan=3><? echo $row5["fac_cli_nombre"] ?>
	</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1">Nº Factura  </td>
	<td class="Estilo1" colspan=3><? echo $row5["fac_numero"] ?>

	</td>
</tr>


<tr>
	<td  valign="center" class="Estilo1">Imagen Factura </td>
	<td class="Estilo1" colspan=3>
		<a href="../../archivos/docfac/<? echo $row5["fac_archivo"] ?>" class="link" target="_blank" ><? echo $row5["fac_archivo"] ?></a>
	</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1">Imagen Orden de Compra </td>
	<td class="Estilo1" colspan=3>
		<a href="../../archivos/docfac/<? echo $row5["fac_doc1"] ?>" class="link" target="_blank"><? echo $row5["fac_doc1"] ?></a>
	</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1"></td>
	<td class="Estilo1" colspan=3>
		<table border=1>
			<?
//if ($regionsession==15) {
			$idetapa=$row5["eta_id"];
			$sql7="select * from compra_orden where oc_eta_id=$idetapa ";
//echo $sql;
			$res7 = mysql_query($sql7);
			$cont11=1;
			while($row7 = mysql_fetch_array($res7)){
				if ($cont11==1 or $cont11==4 or $cont11==7 or $cont11==10 or $cont11==13 or $cont11==16 or $cont11==19 or $cont11==21 or $cont11==24 ) {
					echo "<tr>";
				}
				?>

				<td>
					<a href="../../archivos/docfac/<? echo $row7["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row7["oc_numero"]; ?></a>
				</td>


				<?
				$cont11++;
			}

//}

			?>
		</table>
	</td>
</tr>

<?
$verfac='';
$nuevo=$row5["fac_doc2"];
//echo $nuevo;
if ($nuevo<>'') {
	$buscar='archivos/docargedo/fileargedo';
	$pos = strpos($nuevo,$buscar );
	if ($pos !== FALSE) {

	}  else {
		$nuevo="../../archivos/docfac/".$row5["fac_doc2"];
	}

	$verfac="Ver Resolución";
}
?>

<tr>
	<td  valign="center" class="Estilo1">Imagen Recepción Conforme</td>
	<td class="Estilo1" colspan=3>
		<a href="<? echo $nuevo ?>?read4=<? echo $read4 ?>" class="link" target="_blank"><? echo $verfac; ?></a>
		<!--                               <a href="../../archivos/docfac/<? echo $vtodos ?>?read4=<? echo $read4 ?>" class="link" target="_blank" > <? echo $v9; ?></a> -->

	</td>
</tr>
<tr>
	<tr>
		<td><hr></td><td><hr></td>
	</tr>
	<tr>
		<td  valign="center" class="Estilo1">Depto. Aprobación </td>
		<td class="Estilo1" colspan=3>
			<? echo $row5["eta_depto_aprobacion"] ?>
		</td>
	</tr>
	<tr>
		<td  valign="center" class="Estilo1">Aprobador</td>
		<td class="Estilo1" colspan=3>
			<? echo $row5["eta_usu_aprobacionok"] ?>
		</td>
	</tr>
	<tr>
		<td  valign="center" class="Estilo1">Fecha VºBº </td>
		<td class="Estilo1" colspan=3>
			<? echo $row5["eta_fecha_aprobacionok"] ?>
		</td>
	</tr>

	<tr>
		<td><hr></td><td><hr></td>
	</tr>

	<tr>
		<td class="Estilo1cen" colspan=6 >
			<?
			if ($resultado2<>'' ) {
				?>
				<a href="javascript:void(0)" onclick="window.open('listaperitaje.php?rut=<? echo $etarut; ?>&id=<? echo $id; ?>&id1b=<? echo $id1b ?>','','width=700,height=600,scrollbars=1,location=1')"   class="link">Lista de Peritaje</a>

				<?
			}
			?>


		</td>
	</tr>


	<tr>
		<td><hr></td><td><hr></td>
	</tr>

	<tr>
		<td  valign="center" class="Estilo1">Monto a Pagar</td>
		<td class="Estilo1" colspan=3>
			<input type="text" name="monto2" class="Estilo2" size="10" value="<? echo $row5["eta_monto"]; ?>"  >
		</td>
	</tr>

	<tr>
		<td  valign="center" class="Estilo1">Subtítulo</td>
		<td class="Estilo1" colspan=3>
			<input type="text" name="item" class="Estilo2" size="10" value="<? echo $row5["eta_item"]; ?>"  >
		</td>
	</tr>
	<?
	$a=$row5["eta_fecha_aprobacionok"];

	?>


	<tr>
		<td  valign="center" class="Estilo1">Fecha VºBº</td>
		<td class="Estilo1" valign="center">
			<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo  substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);?>" id="f_date_c1" readonly="1">
			<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
			onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

			<script type="text/javascript">
				Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>



</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1">Descripción del Servicio </td>
	<td class="Estilo1" colspan=3>
		<textarea name="servicio" rows="3" cols="30"><? echo $row5["eta_servicio_final"]; ?></textarea>
	</td>
</tr>

<tr>
	<td  valign="center" class="Estilo1">Fecha Cheque</td>
	<td class="Estilo1" colspan=3>
		<?
		$a=$row5["eta_fechache"];
		echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);
		?>
	</td>
</tr>


<tr>
	<td  valign="center" class="Estilo1">Número de Cheque </td>
	<td class="Estilo1" colspan=3>
		<? echo $row5["eta_ncheque"] ?>
	</td>
</tr>


<tr>
	<td><br></td>
</tr>


<tr>
	<td  valign="center" class="Estilo7c">DESGLOSE LIBRO DE COMPRAS:</td>

</td>
</tr>
<tr>
	<td><hr></td><td><hr></td>
</tr>

<tr>
	<td  valign="center" class="Estilo1" id="neto1">NETO</td>
	<td class="Estilo1" colspan=3>
		<input type="text" name="neto" class="Estilo2r" size="10" value="<? echo $row5["eta_neto"]; ?>"  > <? echo number_format($row5["eta_neto"],0,',','.') ?>
	</td>
</tr>


<tr>
	<td  valign="center" class="Estilo1" id="iva1">IVA</td>
	<td class="Estilo1" colspan=3>
		<input type="text" name="iva" class="Estilo2r" size="10" value="<? echo $row5["eta_iva"]; ?>"  > <? echo number_format($row5["eta_iva"],0,',','.') ?>
	</td>
</tr>



<tr>
	<td  valign="center" class="Estilo1" id="total1">TOTAL</td>
	<td class="Estilo1" colspan=3>
		<input type="text" name="monto" class="Estilo2r" size="10" value="<? echo $row5["eta_monto2"] ?>"  > <? echo number_format($row5["eta_monto2"],0,',','.') ?>
	</tr>
	<script>
		<!--
		function reserva() {
    //alert("Reserva");
    if (document.form1.swcontrato.value=='No') {
    	alert("No tiene contrato Asociado");
    	document.form1.swfreserva.checked=false;
    	document.form1.freserva.value=0;
    	document.form1.montonuevo.value=0;
    	document.form1.freserva.disabled=true;
    	document.form1.montonuevo.disabled=true;
    	return false;

    }
    document.form1.freserva.disabled=!document.form1.freserva.disabled;
    document.form1.montonuevo.disabled=!document.form1.montonuevo.disabled;
    
    document.form1.freserva.value=Math.round(document.form1.monto.value*0.04);
    document.form1.montonuevo.value=Math.round(document.form1.monto.value-document.form1.freserva.value);
//    alert("Reserva 2");
if (document.form1.montonuevo.disabled) {
	document.form1.freserva.value=0;
	document.form1.montonuevo.value=0;
}

//    alert("Reserva 2 "+document.form1.tipodoc3[10].value);
if (document.form1.swfreserva.checked==true && document.form1.tipodoc3[10].checked) {
	alert("Reserva 2");
	document.form1.freserva.value=Math.round(document.form1.monto.value*0.04);
	document.form1.montonuevo.value=Math.round(document.form1.monto.value-document.form1.freserva.value-document.form1.iva.value);

}

}
-->
</script>

<?
$facid=$row5["fac_id"];
$sql22 = "Select * from dpp_cont_fac x, dpp_contratos y where x.confa_fac_id=$facid and x.confa_cont_id=y.cont_id ";
                                  //  echo $sql22;
$res22 = mysql_query($sql22);
$row22 = mysql_fetch_array($res22);
$confa_fac_id=$row22["confa_fac_id"];
$confa_cont_id=$row22["confa_cont_id"];
if ($confa_cont_id=='') {
	echo "Contrato No";
	$swcontrato="No";
} else {
	echo "Contrato Si";
	$swcontrato="Si";
}

$tipomoneda2=$row22["cont_tipo2"];
$sql2 = "Select * from dpp_monedas where mone_id=$tipomoneda2";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda2=$row2["mone_tipo"];



?>
<tr>
	<td><hr></td><td><hr></td>
</tr>
<tr>
	<td  valign="center" class="Estilo1">
		<input type="checkbox" name="swfreserva" class="Estilo2" size="10" value="1" onclick="reserva()" <? if ($row5["eta_freserva"]<>0) {  echo "checked"; }  ?>>
		Fondo Reserva (4%)</td>
		<td class="Estilo1" colspan=3>
			<input type="text" name="freserva" class="Estilo2r" size="10" value="<? echo $row5["eta_freserva"]; ?>"  <? if ($row5["eta_freserva"]==0) {  echo "disabled"; }  ?> >
			<input type="text" name="montonuevo" class="Estilo2r" size="10" value="<? echo $row5["eta_monto"] ?>"  <? if ( $row5["eta_freserva"]==0) {  echo "disabled"; }  ?> >
			<a href="verdocedit.php?id2=<? echo $id2 ?>&ori=11" class="link" title="Volver a Administracion" onclick="return confirm('Seguro que decea Volver a Administracion ?')"><img src="imagenes/volver2.jpg" width="20" height="20" border=0></a>
		</td>
	</tr>
	<tr >
		<td colspan=5>
			<br>
			<table border=1>
				<tr>
					<td class="Estilo1b">FECHA VENCIMIENTO</td>
					<td class="Estilo1b">MONTO TOTAL CONTRATO</td>
					<td class="Estilo1b">MONEDA</td>
					<td class="Estilo1b">SERVICIO</td>
				</tr>
				<tr>
					<td class="Estilo1b"><? echo substr($row22["cont_vence"],8,2)."-".substr($row22["cont_vence"],5,2)."-".substr($row22["cont_vence"],0,4)   ?></td>
					<td class="Estilo1b"><? echo number_format($row22["cont_total"],0,',','.')  ?></td>
					<td class="Estilo1b"><? echo $nombremoneda2  ?> </td>
					<td class="Estilo1b"><? echo $row22["cont_nombre1"]  ?> </td>
				</tr>

			</table>


		</td>
	</tr>
	<tr>
		<td><hr></td><td><hr></td>
	</tr>



	<tr>
		<td  valign="center" class="Estilo1">IMPUESTO ESPECIFICO COMBUSTIBLE</td>
		<td class="Estilo1" colspan=3>
			<input type="text" name="impuesto1" class="Estilo2r" size="10" value="<? echo $row5["eta_impuesto1"]; ?>"  > <? echo number_format($row5["eta_impuesto1"],0,',','.') ?>
		</td>
	</tr>
	<tr>
		<td  valign="center" class="Estilo1">EXENTO</td>
		<td class="Estilo1" colspan=3>
			<input type="text" name="exento" class="Estilo2r" size="10" value="<? echo $row5["eta_exento"]; ?>"  > <? echo number_format($row5["eta_exento"],0,',','.') ?>
		</td>
	</tr>




	<tr>
		<td  valign="center" class="Estilo1">IMPUESTO ADICIONAL</td>
		<td class="Estilo1" colspan=3>
			<input type="text" name="impuesto2" class="Estilo2r" size="10" value="<? echo $row5["eta_impuesto2"]; ?>"  > <? echo number_format($row5["eta_impuesto2"],0,',','.') ?>
		</td>
	</tr>
	<tr>
		<td><hr></td><td><hr></td>
	</tr>
	<tr>
		<td  valign="center" class="Estilo1">TIPO DE DOCUMENTO A DECLARAR SII</td>
		<td class="Estilo1" colspan=4>
			<input type="radio" name="tipodoc3" class="Estilo2" value="FAF" <? if($row5["eta_tipo_doc3"]=='FAF') echo 'checked' ?> onclick="noexenta();">Factura Afecta<br>
			<input type="radio" name="tipodoc3" class="Estilo2" value="FEX" <? if($row5["eta_tipo_doc3"]=='FEX') echo 'checked' ?> onclick="exenta();">Factura Exenta<br>
			<input type="radio" name="tipodoc3" class="Estilo2" value="FEL" <? if($row5["eta_tipo_doc3"]=='FEL') echo 'checked' ?> onclick="noexenta();">Factura Electrónica<br>
			<input type="radio" name="tipodoc3" class="Estilo2" value="FELEX" <? if($row5["eta_tipo_doc3"]=='FELEX') echo 'checked' ?>  onclick="exenta();">Factura Electrónica Exenta<br>
			<input type="radio" name="tipodoc3" class="Estilo2" value="NC" <? if($row5["eta_tipo_doc3"]=='NC') echo 'checked' ?> onclick="noexenta();">Nota de Crédito<br>
			<input type="radio" name="tipodoc3" class="Estilo2" value="NCEL" <? if($row5["eta_tipo_doc3"]=='NCEL') echo 'checked' ?> onclick="noexenta();">Nota de Crédito Electronica<br>
			<input type="radio" name="tipodoc3" class="Estilo2" value="ND" <? if($row5["eta_tipo_doc3"]=='ND') echo 'checked' ?> onclick="noexenta();">Nota de Débito<br>
			<input type="radio" name="tipodoc3" class="Estilo2" value="NDEL" <? if($row5["eta_tipo_doc3"]=='NDEL') echo 'checked' ?> onclick="noexenta();">Nota de Débito Electrónica<br>
		</td>
	</tr>




	<?
	$forma=$row5["eta_ncheque"];
	?>



	<tr>

		<tr>
			<td colspan="8"><hr></td>
		</tr>

		<tr>
			<td  valign="center" class="Estilo1">OTRO TIPO DE DOCUMENTO</td>
			<td class="Estilo1" colspan=4>
				<input type="radio" name="tipodoc3" class="Estilo2" value="r" <? if($row5["eta_tipo_doc3"]=='r') echo 'checked' ?> >Recibo<br>
				<input type="radio" name="tipodoc3" class="Estilo2" value="b" <? if($row5["eta_tipo_doc3"]=='b') echo 'checked' ?> >Boleta Servicio<br>
				<input type="radio" name="tipodoc3" class="Estilo2" value="BH" <? if($row5["eta_tipo_doc3"]=='BH') echo 'checked' ?> onclick="hono1();">Boleta de Honorarios<br>
				<input type="radio" name="tipodoc3" class="Estilo2" value="BHS" <? if($row5["eta_tipo_doc3"]=='BHS') echo 'checked' ?> onclick="hono2();">Boleta de Honorarios sin Retencion<br>
			</td>
		</tr>
		<tr>
			<td colspan="8"><hr></td>
		</tr>

		<?php
		$sql8 = "SELECT * FROM dpp_facturas WHERE fac_eta_id = ".$id2;
		$res8 = mysql_query($sql8);
		$row8 = mysql_fetch_array($res8);
		$fdevengo = $row5["eta_fdevengo"];
		$adevengo = $row8["fac_devengo_archivo"];
		$ndevengo = $row8["fac_nro_contable"];
		?>
		<?php if ($fdevengo == NULL || $adevengo == NULL || $ndevengo == NULL || $ori == 2): ?>
			
			<tr>
				<td  valign="center" class="Estilo1">INFORMACION DE DEVENGO</td>
				<td class="Estilo1" colspan=4>
					<table width="100%">
						<tr>
							<td class="Estilo1">Fecha de Devengo</td>
							<td class="Estilo1">
								<input type="text" name="eta_fdevengo" id="eta_fdevengo" style="background-color: lightgray" readonly required value="<?php echo $fdevengo ?>">
								<img src="calendario.gif" id="f_trigger_c4" style="cursor:pointer;" title="Seleccionar Fecha">
								<script type="text/javascript">
									Calendar.setup({
                            inputField     :    "eta_fdevengo",     // id of the input field
                            ifFormat       :    "%Y-%m-%d",      // format of the input field
                            button         :    "f_trigger_c4",  // trigger for the calendar (button ID)
                            align          :    "Bl",           // alignment (defaults to "Bl")
                            singleClick    :    true
                        });
                    </script>
                </td>
            </tr>
            <tr>
            	<td class="Estilo1">N° Comprobante Contable</td>
            	<td class="Estilo1"><input type="number" required name="fac_nro_contable" id="fac_nro_contable" value="<?php echo $ndevengo ?>"></td>
            </tr>
            <tr>
            	<td class="Estilo1">Comprobante Contable</td>
            	<td class="Estilo1">
            		<input type="file" name="fac_devengo_archivo" id="fac_devengo_archivo">
            		<?php if ($adevengo <> NULL): ?>
            			<a href="../../archivos/docfac/<?php echo $row8["fac_devengo_archivo"] ?>" target="_blank">VER</a>
            		<?php endif ?>
            	</td>
            </tr>
        </table>
    </td>
</tr>

<tr>
	<td colspan="8"><hr></td>
</tr>

<?php endif ?>

<tr>
	<td colspan=4 align="center"> <input type="submit" value="    Grabar Datos    " > </td>
</tr>


<input type="hidden" name="id" value="<? echo $id ?>" >
<input type="hidden" name="id2" value="<? echo $id2 ?>" >
<input type="hidden" name="ori" value="<? echo $ori ?>" >
<input type="hidden" name="confa_cont_id" value="<? echo $confa_cont_id ?>" >
<input type="hidden" name="etarut" value="<? echo $etarut ?>" >
<input type="hidden" name="swcontrato" value="<? echo $swcontrato ?>" >
<input type="hidden" name="sw" value="1" >
<input type="hidden" name="ori" value="<?php echo $ori ?>" >

</form>

</td>




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
	if ($tipodoc2=='bh' or $tipodoc2=='BH') {
		echo "<script>hono3();</script>";
	}

	?>
