<?php
session_start();
require_once("inc/config.php");
extract($_POST);
extract($_GET);


if(isset($_POST["submit"]) && $_POST["submit"] == "submit")
{
	$sql = "UPDATE dpp_etapas SET eta_fdevengo = '".$eta_fdevengo."' WHERE eta_id = ".$_POST["eta_id"];
	$res = mysql_query($sql);
	echo "<script>
	alert('La fecha de egreso ha sido actualizada a : ".$eta_fdevengo."');
	opener.location.href='verdocedit.php?id2=".$_POST["eta_id"]."';
	window.close();
	</script>";
}

$sql = "SELECT * FROM dpp_etapas WHERE eta_id = ".$_GET["eta_id"];
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

?>
<!DOCTYPE html>
<html>
<head>
	<title>FECHA DE EGRESO</title>
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
  <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-body">
	<form name="frm" method="POST" onSubmit="return valida()">

		<table border="0" width="100%" class="table table-stripped">
			<tr>
				<td  valign="top" class="Estilo1">FECHA DE EGRESO</td>
				<td class="Estilo1" valign="center">
					<input type="text" name="eta_fdevengo" class="Estilo2" size="12" value="<?php echo $row["eta_fdevengo"] ?>" id="f_date_c1" readonly style="background: #c6c6c6;">
					<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

					<script type="text/javascript">
						Calendar.setup({
							inputField : "f_date_c1",
							trigger    : "f_trigger_c1",
							onSelect   : function() { this.hide() },
							showTime   : 12,
							dateFormat : "%Y-%m-%d"
						});
					</script>
				</td>
			</tr>

			<tr>
				<td colspan="2" align="center"><button type="submit" name="submit" value="submit" class="btn btn-danger btn-xs">ACTUALIZAR</button></td>
			</tr>
		</table>
		<input type="hidden" name="eta_id" value="<?php echo $_GET["eta_id"] ?>">
	</form>
	</div>
	</div>
	</div>
</body>

<script type="text/javascript">
	function valida()
	{
		var hoy = '<?php echo date("Y-m-d") ?>';
		if(document.frm.eta_fdevengo.value == "" || document.frm.eta_fdevengo.value == "0000-00-00")
		{
			alert("Seleccione la fecha de egreso");
			document.getElementById("f_trigger_c1").focus();
			return false;
		}else if(document.frm.eta_fdevengo.value > hoy){
			alert("Por favor seleccione una fecha inferior a "+document.frm.eta_fdevengo.value);
			return false;
		}else{
			return confirm('¿ESTA SEGURO DE PROCEDER CON LA CARGA DE DATOS?');
		}
	}
</script>
</html>
