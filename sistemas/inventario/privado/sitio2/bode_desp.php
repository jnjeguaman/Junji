<?php
require("inc/config.php");
extract($_POST);
extract($_GET);
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<style type="text/css">
		/*ul{
			padding: 0;
			list-style-type: none;
			text-align: center;
		}

		li {
			text-decoration: none;
			padding: .1em;
			color: #fff;
			display: inline;
		}
		a{
			text-decoration: none;
		}*/
	</style>
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php
		include("inc/menu_1b.php");
		?>
	</div>
	<?php if ($cod==46): ?>
		<?php include("bode_desp_ori1.php") ?>
		<?php include("bode_desp_ori2.php") ?>
	<?php elseif($ori==3): ?>
		<?php include("bode_desp_ori1.php") ?>
		<?php include("bode_desp_ori3.php") ?>
	<?php endif ?>

</body>
<script type="text/javascript">
	function getPatente(input)
	{
		var data = ({empresa_id : input, cmd : "getPatente"});
		$.ajax({
			type:"POST",
			url:"getPatente.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {

				var patentes = "";
				var choferes = "";
				patentes += "<option value=''>Seleccionar...</option>";
				choferes += "<option value=''>Seleccionar...</option>";
				$.each(response.Patentes,function(key,value){
					patentes += "<option value='"+value.patente_glosa+"'>"+value.patente_glosa+"</option>";
				});

				$.each(response.Choferes,function(key,value){
					choferes += "<option value='"+value.chofer_nombre+"'>"+value.chofer_nombre+"</option>";
				});

				$("#chofer").html(choferes);
				$("#patente").html(patentes);

		}//Success

	});// Ajax
	}//Funcion

	function valida()
	{

		if($("#empresa_id").val() == "")
		{
			alert("DEBE SELECCIONAR UN PROVEEDOR");
			$("#empresa_id").focus();
			return false;

		}else if($("#chofer").val() == "")
		{

			alert("DEBE SELECCIONAR UN CHOFER");
			$("#chofer").focus();
			return false;

		}else if($("#patente").val() == "")
		{
			alert("DEBE SELECCIONAR LA PATENTE DEL VEHICULO");
			$("#patente").focus();
			return false;
		}else if($("#obs").val() == "")
		{
			alert("INGRESE UNA OBSERVACION");
			$("#obs").focus();
			return false;
		}else{
			if(confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?"))
			{
				return true;
			}else{
				return false;
			}
		}
	}

	function valida2()
	{
		if($("#bulto").val() == "")
		{
			alert("SELECCIONE LA CANTIDAD DE BULTOS");
			$("#bulto").focus();
			return false;
		}else{
			if(confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?")){
				return true;
			}else{
				return false;
			}
		}
	}

	$("#toggle").click(function(event)
	{
		if($("#toggle").is(":checked"))
		{
			$(':checkbox').each(function() {
				this.checked = true;                        
			});
		}else{
			$(':checkbox').each(function() {
				this.checked = false;                        
			});
		}
	});


</script>
</html>