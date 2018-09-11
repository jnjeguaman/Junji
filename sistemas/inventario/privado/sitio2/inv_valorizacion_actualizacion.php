<!DOCTYPE html>
<html>
<head>

	<title> </title>
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script src="librerias/jquery.blockUI.js"></script>

	<script type="text/javascript">
		function blockUI() {
      $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
      },
      message:"Espere un momento porfavor <i class='fa fa-spinner fa-spin'></i>" });
    }


	</script>
</head>
<body onload="blockUI()">
<?php
include("inc/config.php");
extract($_POST);
echo "<script>blockUI();</script>";
for ($i=0; $i <= $totalElementos ; $i++) { 
	$sql = "UPDATE acti_inventario SET inv_costo = ".$var1[$i]." WHERE inv_id = ".$var2[$i];
	// echo $sql."<br>";
	mysql_query($sql);
}

?>
<script type="text/javascript">
	window.location.href="inv_valorizacion.php?ori=2&valorizacion_rc=<?php echo $_POST["rc"]?>&oc_id=<?php echo $_POST["oc_id"]?>&valorizacion_f_devengo=<?php echo $_POST["clave"]?>&modalidad=<?php echo $_POST["modalidad"]?>&valorizacion_oc=<?php echo $_POST["oc"]?>";
</script>
</body>
</html>

