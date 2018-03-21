<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
?>
<html>
<head>
<title>Unidades</title>
<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
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
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: center;
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
	color: #003063;

}
.Estilo2c {
	font-family: Verdana;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo2d {
	font-family: Verdana;
	font-size: 10px;
	text-align: right;
	color: #003063;
}
.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	color: #003063;
}
.Estilo3 {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	font-weight: bold;
	color: #003063;
}
.Estilo3c {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: center;
	color: #003063;
}
.Estilo3d {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: right;
	color: #003063;
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
	font-size: 12px;
	font-weight: bold;
	color: #00659C;
	text-decoration:none;
	text-transform:uppercase;
}
.link:over {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
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

<script src="../../inventario/privado/sitio2/librerias/jquery-1.11.3.min.js"></script>
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
<script>
  function validarSiNumero(numero){
    if (!/^([0-9])*$/.test(numero))
      alert("¡Introdusca un valor numerico!");
  }


function ejecutar(){
   document.grabar.submit();
//alert('cerrando');
}
</script>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
	<br>


	<?
	$nivel = $_SESSION["pfl_user"];
	$eta_id = $_GET["eta_id"];
	$sql = "SELECT * FROM dpp_etapas WHERE eta_id = '$eta_id' ";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$fecha_devengo=$row['eta_fdevengo'];
		$numero_egreso=$row['eta_num_egreso'];
		$fecha_egreso=$row['eta_fecha_egreso'];
		$doc_egreso = $row["eta_doc_egreso"];
		
		
	}

	if  ($fecha_devengo != '0000-00-00' && $fecha_devengo != null && $fecha_devengo != '') {

		$date1 = DateTime::createFromFormat('Y-m-d', $fecha_devengo);
		$fdevengo = $date1->format('d-m-Y');

	} 
	else{
		$fdevengo="";

	}







	if  ($fecha_egreso != '0000-00-00' && $fecha_egreso != null && $fecha_egreso != '') {

		$date2 = DateTime::createFromFormat('Y-m-d', $fecha_egreso);
		$f_egreso = $date2->format('d-m-Y');

	} 
	else{
		$f_egreso="";

	}


	ini_set('date.timezone','America/Santiago'); 
	$fecha_actual = date("Ymd");

	?>

	<form action="graba_comprobante_egreso.php" name="form" method="POST" enctype="multipart/form-data">
		<table>
		
			<input type="hidden" name="id" value="<?php echo $eta_id; ?>">
			<?php if ($nivel == 5 || $nivel == 34): ?>
				
			<tr>
	      	 <td  valign="top" class="Estilo1">Fecha Devengo</td>

	         <td  valign="top" class="Estilo1">

				<input type="text" name="fechaDevengo" class="Estilo2" size="12" value="<? echo $fdevengo; ?>" id="f_date_c1" readonly="1" required>
			 </td>
			 <td  valign="" class="Estilo1">
				<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" /> 

				<script type="text/javascript">//<![CDATA[

		    	Calendar.setup({

		    		inputField : "f_date_c1",

		    		trigger    : "f_trigger_c1",

		    		onSelect   : function() { this.hide() },

		    		max: <? echo $fecha_actual; ?>,

		    		showTime   : 12,

		    		dateFormat : "%d-%m-%Y"

		    	});

		    	//]]></script>

	         </td>
	       </tr>
			<?php endif ?>
			<?php if ($nivel == 31): ?>
				
	       
	       <?
	       if ($numero_egreso == 0) {
	       	$numero_egreso="";
	       }
	       ?>
		  <tr>
		  	 <td valign="top" class="Estilo1">Numero Egreso</td>
		  	 <td valign="top" class="Estilo1">
		  	 	<input type="number" min="0" name="numEgreso" class="Estilo2" size="12" value="<? echo $numero_egreso; ?>" onChange="validarSiNumero(this.value);" required>
		  	 </td>
		  </tr>

		  <tr>
		  	<td class="Estilo1">Documento Egreso</td>
		  	<td class="Estilo1">
		  	<input type="file" name="eta_doc_egreso" id="eta_doc_egreso" required>
		  	<br>
		  	<?php if ($doc_egreso <> ""): ?>
		  		<a href="../../archivos/docfac/<?php echo $doc_egreso ?>" class="link" target="_blank"><?php echo $doc_egreso ?></a>
		  	<?php endif ?>
		  	</td>
		  </tr>

	      <tr>
	      	 <td valign="top" class="Estilo1">Fecha Comprobante Egreso</td>

	         <td valign="top" class="Estilo1">

				<input type="text" name="fechaEgreso" class="Estilo2" size="12" value="<? echo $f_egreso; ?>" id="f_date_c2" readonly="1" style="background-color: lightgray" required>
			 </td>
			 <td valign="" class="Estilo1">
				<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" /> 

				<script type="text/javascript">//<![CDATA[

		    	Calendar.setup({

		    		inputField : "f_date_c2",

		    		trigger    : "f_trigger_c2",

		    		onSelect   : function() { this.hide() },

		    		max: <? echo $fecha_actual; ?>,

		    		showTime   : 12,

		    		dateFormat : "%d-%m-%Y"

		    	});

		    	//]]></script>

	         </td>
	      </tr>
			<?php endif ?>



	      <tr>
	         <td  valign="center" class="Estilo1" colspan=2>
	            <input type="submit" value="Aceptar">
	         </td>
	       </tr>
		</table>
	</form>
</body>
</html>

