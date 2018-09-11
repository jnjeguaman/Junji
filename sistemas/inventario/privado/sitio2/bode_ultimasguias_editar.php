<div style="width:430px;background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">
	<form action="bode_ultimasguias_editar_gr.php" method="POST" onSubmit="return valida()">
		<table border="1" width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="4">GUIAS SELECCIONADAS</td>
			</tr>
			<tr>
				<td class="Estilo1mc">OC ID</td>
				<td class="Estilo1mc">DESTINO</td>
				<td class="Estilo1mc">FECHA ENVIO</td>
			</tr>

			<?php $contador = 0;for($i=1;$i<=$totalLineas;$i++) { $contador++;?>
				<?php if($var1[$i] <> ""): ?>
				<tr>
					<input type="hidden" name="var1[<?php echo $i ?>]" value="<?php echo $var1[$i]?>">
					<td class="Estilo1mc"><?php echo $var1[$i]?></td>
					<td class="Estilo1mc"><?php echo $var2[$i]?></td>
					<td class="Estilo1mc"><?php echo $var3[$i]?></td>
				</tr>
			<?php endif ?>
			<?php } ?>
		</table>
		<hr>
		<?
		if (!isset($_GET['fentrega']) || !isset($_POST['fentrega'])) {
			$fentrega="";
		}

		?>
		<table border="1" width="100%">
			<tr>
				<td class="Estilo1mc">FECHA DE DESPACHO</td>
				<td class="Estilo1mc">
					<input type="text" readonly class="bloqueado" name="fentrega" id="fentrega" value="<?php echo $fentrega ?>" placeholder="YYYY-MM-DD">
					<i class="fa fa-calendar fa-lg link" id="f_trigger_c2" style="cursor:pointer;" title="Seleccionar Fecha"></i>
					<script type="text/javascript">
						Calendar.setup({
        inputField     :    "fentrega",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
</td>
</tr>

<tr>
	<td colspan="2"><center><button>Actualizar <i class="fa fa-refresh"></i></button></center></td>
</tr>
</table>
<input type="hidden" name="totalLineas" value="<?php echo $totalLineas ?>">
</form>
</div>

<script type="text/javascript">
	function valida()
	{
		var fentrega = document.getElementById("fentrega").value;
		if(fentrega == "")
		{
			alert("DEBE INGRESAR LA FECHA DE DESPACHO");
			return false;
		}else{
			return true;
		}
	}
</script>