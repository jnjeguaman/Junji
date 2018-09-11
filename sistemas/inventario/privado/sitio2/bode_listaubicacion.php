<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
$id=$_GET["id"];
$nacional=$_GET["nacional"];
$date_in=date("d-m-Y");
$annomio=date("Y");
$annomio2=$annomio-1;
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
  	function ponPrefijo(pref,aux) {
  		opener.document.formul.codigo.value=pref
  		opener.document.formul.pvp.value=aux
  		window.close()
  	}

  	function cerrarventana(){
  		window.close();
//alert('cerrando');
}
function cierre2(num,id,fecha,archivo){
 //   alert("-- "+id);
 opener.document.form1.nroresolucion.value=num;

 opener.document.form1.idargedo.value=id;
 opener.document.form1.fecha4.value=fecha;
 opener.document.getElementById("linkarchivo").href+="../../archivos/docargedo/"+archivo;
 opener.document.getElementById('verlink').innerHTML=archivo;


 window.close();
//alert('cerrando');
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
	<form action="compra_listaresolucion.php" name="buscar" method="get">



<!--
<table>
      <tr>
         <td  valign="center" class="Estilo1" colspan=2>N° Resolucion
            <input type="text" name="res" class="Estilo2" size="12" value="<? echo $res; ?>" >
         </td>
       </tr>
      <tr>
        <td  valign="top" class="Estilo1" colspan=2>Defensoría Nacional
              <input type="checkbox" name="nacional" class="Estilo2" size="11" value="1" <? if ($nacional=='1') { echo "checked"; } ?>>
         </td>
     </tr>
      <tr>
         <td  valign="center" class="Estilo1" colspan=2>
            <input type="submit" value="Buscar">
         </td>
       </tr>


</table>
-->
</form>
<?

?>
<hr>
<input type='button' onclick='cerrarventana()' value='Cerrar Ventana'>
<form action="infopres_grabadecreto.php" name="grabar" method="post">

	<table border=1>
		<tr>
			<td>Ubicacion</td>
			<td>Cantidad</td>
		</tr>

		<?


		$sw=0;

		$sql2 = "Select * from bode_detingreso where ding_prod_id='$id' and ding_userf<> '' AND ding_recep_tecnica = 'A'";
//$sql2 = "Select * from bode_detingreso where ding_ubicacion<>''";

//echo $sql2;
		$res2 = mysql_query($sql2);
		$cont=1;
		while($row2 = mysql_fetch_array($res2)){


			$numdef=$row2["docs_defensoria"];
			$sql4="select * from regiones  where codigo=$numdef";
//echo $sql;
			$result4=mysql_query($sql4);
			$row4=mysql_fetch_array($result4);
			$nombre2=$row4["nombre"];


			?>
			<tr>

				<td class="Estilo1"><? echo $row2["ding_ubicacion"]; ?></td>
				<td class="Estilo1"><? echo $row2["ding_unidad"]; ?></td>
				<!--<td class="Estilo1"><a href="#" class="link" onclick="cierre2('<? echo $row2["docs_folio"]  ?>')"><? echo $row2["docs_materia"] ?></a></td>
				<td class="Estilo1"><? echo $nombre2 ?></td>!-->
			</tr>

			<?
		}
		?>
	</table>
	<input type="hidden" name="cont" value="<? echo $cont ?>" >


	<div align="center">
		<label>


		</label>
	</div>
</form>
<p align="center">&nbsp;</p>
</body>
</html>

