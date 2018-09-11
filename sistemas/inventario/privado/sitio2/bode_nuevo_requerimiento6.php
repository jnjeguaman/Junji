   <div style="width:800px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
   	<table border="0" width="100%">
   		<tr>
   			<td class="Estilo2titulo" colspan="10">CREAR TOMA DE INVENTARIO</td>
   		</tr>
   	</table>

    <?
    if (!isset($_POST['tipo'])) {
      $tipo="";
    }
    if (!isset($_GET['ori'])) {
      $ori="";
    }
    if (!isset($_GET['codigo']) || !isset($_POST['codigo'])) {
      $codigo="";
    }


    ?>

   	<form name="form11" action="bode_inv_indexoc6.php?cod=<?php echo $cod ?>" method="POST" onsubmit="return validaree()">
   		<table border="0" width="100%">
   			<tr>
   				<td class="Estilo1">TIPO DE INVENTARIO</td>
   				<td class="Estilo1">
   					<input type="radio" name="tipo" class="Estilo2 tipo" value="Aleatorio" onclick="this.form.submit();" <? if ($tipo=="Aleatorio") { echo "checked"; }  ?> > Aleatorio
   					<input type="radio" name="tipo" class="Estilo2 tipo" value="Completo" onclick="this.form.submit();" <? if ($tipo=="Completo") { echo "checked"; }  ?>> Completo
   				</td>
   			</tr>
   			<input type="hidden" name="ori" value="<? echo $ori ?>"  >
   		</form>

   		<form name="form12" action="bode_inv_grabaindexoc6.php" method="post" onsubmit="return validaree()">
   			<?
   			if ($tipo=="Aleatorio") {
   				?>

   				<table border="0" width="100%">
   					<tr>
   						<td class="Estilo1">FORMA DE TOMA</td>
   						<td class="Estilo1">
   							<input type="radio" name="forma" class="Estilo2" value="Visible" onClick="checkToma(this.value)" checked > Visible
   							<input type="radio" name="forma" class="Estilo2" value="Oculto" onClick="checkToma(this.value)"> Oculto
   						</td>
   					</tr>
   					<tr class="cantidad">
   						<td class="Estilo1">CANTIDAD</td>
   						<td class="Estilo1" colspan=1>
   							<input type="text" name="cantidad" id="cantidad" class="Estilo2" size="6" >
   						</td>

   					</tr>
   					<tr>
   						<td  valign="center" class="Estilo1">FECHA INVENTARIO</td>
   						<td class="Estilo1" valign="center">
   							<input type="text" name="fecha_orden_compra" class="Estilo2" size="12" id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)">
   							<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
   							onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

   							<script type="text/javascript">
   								Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

</td>
</tr>

</table>

<?
}
?>

<?
if ($tipo=="Completo") {
	?>

	<table border="0" width="100%">
  <tr>
              <td class="Estilo1">FORMA DE TOMA</td>
              <td class="Estilo1">
                <input type="radio" name="forma" class="Estilo2" value="Visible" onClick="checkToma(this.value)" checked > Visible
                <input type="radio" name="forma" class="Estilo2" value="Oculto" onClick="checkToma(this.value)"> Oculto
              </td>
            </tr>

		<tr>
			<td  valign="center" class="Estilo1">FECHA INVENTARIO</td>
			<td class="Estilo1" valign="center">
				<input type="text" name="fecha_orden_compra" class="Estilo2" size="12" id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)">
				<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
				onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

				<script type="text/javascript">
					Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

</td>
</tr>

</table>



<?
}
?>


<table border="0" width="100%">
	<tr>
		<td class="Estilo1c">
			<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
			<input type="hidden" name="tipo" value="<? echo $tipo ?>"  >
			<input type="submit" name="submit" class="Estilo2" size="11" value="  Crear Toma de Inventario  ">
    <?php if ($_SESSION["region"] == 16): ?>
      <button onClick="descargarInventario(<?php echo $_SESSION["region"]?>)"><i class="fa fa-cloud-download"></i></button>
    <?php endif ?>
		</td>

	</tr>
</table>
        <input type="hidden" name="cod" value="<?php echo $cod ?>">

</form>
<hr>
<?php include("bode_ultimasinventario.php") ?>
<hr>
</div>

<script type="text/javascript">

	function validaree()
	{
		var cantidad = $("#cantidad").val();
		var fecha = $("#f_date_c2").val();

		if(cantidad == "")
		{
			alert("INGRESE LA CANTIDAD  A TOMAR");
			$("#cantidad").focus();
			return false;
		}else if(fecha == "")
		{
			alert("INGRESE LA FECHA DE LA TOMA DE INVENTARIO");
			$("#f_date_c2").focus();
			return false;
		}else{
			return true;
		}
	}

  function checkToma(input)
  {
    if(input == "Oculto")
    {
      $(".cantidad").hide();
      $("#cantidad").val(0);
    }else{
      $(".cantidad").show();
    }
  }

  function descargarInventario(region)
  {
    window.open("bode_inventario.php?region="+region);
  }
</script>
