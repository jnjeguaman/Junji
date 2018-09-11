<?php
require_once("inc/config.php");
extract($_POST);
extract($_GET);
?>
<?php if ($ori == 1): ?>
	<?php include("bode_bajas_nuevo.php") ?>
<?php endif ?>

<?php if ($ori == 2): ?>
	<?php include("bode_bajas_nuevo.php") ?>
	<?php include("bode_bajas_ori2.php") ?>
<?php endif ?>

<?php if ($ori == 3): ?>
	<?php include("bode_bajas_nuevo.php") ?>
	<?php include("bode_bajas_ori3.php") ?>
<?php endif ?>
</div>


<script type="text/javascript">

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

	function valOri2()
	{
		var numberOfChecked = $('input:checkbox:checked').length;
		numberOfChecked = parseInt(numberOfChecked);

		if(numberOfChecked == 0)
		{
			alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA");
			return false;
		}else{
			if(confirm("¿ ESTÁ SEGURO DE DAR DE BAJA EL(LOS) SIGUIENTES ELEMENTOS ?"))
			{
				return true;
			}else{
				return false;
			}
		}
	}

	function valFormulario()
	{
		var fecha = $("#fecha").val();
		var abastece = $("#abastece").val();
		var destinatario = $("#destinatario").val();
		var obs	 = $("#obs").val();

		if(fecha == "")
		{
			alert("INGRESE LA FECHA DE DESPACHO");
			$("#fecha").focus();
			return false;
		}else{
			if(confirm("¿ ESTA SEGURO DE CREAR LA GUIA ?"))
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
	function validaUpload()
	{
		var totalLineas = $("#cont3").val();
		totalLineas = parseInt(totalLineas);
		
		if($("#abastece").val() == "")
		{
			alert("ABASTECE");
			$("#abastece").focus();
			return false;
		}else if($("#folio").val() == "")
		{
			alert("FOLIO");
			$("#folio").focus();
			return false;
		}else if($("#destinatario").val() == "")
		{
			alert("DESTINA");
			$("#destinatario").focus();
			return false;
		}else if($("#obs").val() == "")
		{
			alert("OBS");
			$("#obs").focus();
			return false
		}else{
			if(totalLineas > 23){
				alert("HA SUPERADO EL LIMITE DE 22 ELEMENTOS PERMITIDOS");
				return false;
			}else{
				if(confirm("¿SEGURO DE PROCEDER ?"))
				{
					return true;
				}else{
					return false;
				}
			}
		}
		
	}

</script>