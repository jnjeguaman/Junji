	<?php
	$ultimo = "SELECT MAX(oc_id2) as Ultimo FROM bode_orcom WHERE oc_tipo_guia = 4";
	$ultimo = mysql_query($ultimo);
	$ultimo = mysql_fetch_array($ultimo);
	$ultimo = intval($ultimo["Ultimo"] + 1);
	?>
	<div style="width:750px;background-color:#E0F8E0; position:absolute; top:160px; left:0px;" id="div1">
		<!-- INSTANCIA DE LA GUIA DE DESPACHO !-->
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo">INGRESO NUEVO REQUERIMIENTO</td>
			</tr>
		</table>
		<hr>
		<form id="frm1" name="frm2" method="POST" action="bode_bajas_gr1.php" onsubmit="return valFormulario()">
			<table border="0" cellpadding="0" cellspacing="0" width="60%">
				<tr>
					<td class="Estilo1">FECHA DESPACHO</td>
					<td class="Estilo1"><input type="text" name="fecha" id="fecha"  readonly="1" style="background-color: rgb(235, 235, 235)">
						<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
						<script type="text/javascript">
							Calendar.setup({
								inputField     :    "fecha",
								ifFormat       :    "%Y-%m-%d",
								button         :    "f_trigger_c2",
								align          :    "Bl",
								singleClick    :    true
							});
						</script>
					</td>
				</tr>
				
				<?php if ($_SESSION["pfl_user"] <> 53): ?>
					<tr>
					<td></td>
					<td><button type="submit">Crear Guia</button></td>
				</tr>
				<?php endif ?>
				
			</table>
			<input type="hidden" name="ultimo" value="<?php echo $ultimo ?>">
		</form>
		<!-- FIN INSTANCIA DE LA GUIA DE DESPACHO !-->
		<hr>
		<?php include("bode_bajas_ultimas.php") ?>
		<hr>
		<?php include("bode_bajas_ultimas2.php") ?>
	</div>