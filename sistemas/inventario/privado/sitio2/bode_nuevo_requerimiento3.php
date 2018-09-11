    <script>
    	<!--

    	function nuevoAjax()
    	{
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }

	return xmlhttp;
}
function traerDatos333()  {
	alert("entra");
}
function traerDatos3()  {
	var ajax=nuevoAjax();
	tipoDato1=document.form1.numerooc1.value;
	tipoDato2=document.form1.numerooc2.value;
	tipoDato3=document.form1.numerooc3.value;
	tipoDato3=tipoDato3.toUpperCase();
//     alert("entra");
codigo2=document.form1.codigo.value;
codigo=tipoDato1+"-"+tipoDato2+"-"+tipoDato3;

if (tipoDato2!='' && tipoDato3!='' && codigo!=codigo2 ) {
//    alert (" dato "+codigo);
ajax.open("POST", "buscaorden.php", true);
ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
ajax.send("d="+tipoDato1+"&e="+tipoDato2+"&f="+tipoDato3);

ajax.onreadystatechange=function()	{
	if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
			//b=ajax.responseText;
			if (ajax.responseText == 0) {
				alert (" No Existe ");
			}
			if (ajax.responseText == 1) {
				alert ("Numero de Orden de Compra Existe 1");
				document.form1.para.value='1';
				document.form1.numerooc2.value='';
				document.form1.numerooc3.value='';
				document.form1.nombreoc.value='';
				document.form1.obs.value='';
				document.form1.monto.value='';
				document.form1.codigo.value='';
				document.form1.rut.value='';
				document.form1.dig.value='';
				document.form1.nombre.value='';
				document.form1.direccion.value='';
				document.form1.telefono.value='';
				return ajax.responseText;
			}
			if (ajax.responseText == "Se ha producido un error||||||||") {
				alert ("Numero de Orden No Existe ");
				document.form1.para.value='1';
				document.form1.numerooc2.value='';
				document.form1.numerooc3.value='';
				document.form1.nombreoc.value='';
				document.form1.obs.value='';
				document.form1.monto.value='';
				document.form1.codigo.value='';
				document.form1.rut.value='';
				document.form1.dig.value='';
				document.form1.nombre.value='';
				document.form1.direccion.value='';
				document.form1.telefono.value='';
				return ajax.responseText;
			}

			if (ajax.responseText != 1) {
//                  alert ("Numero de Orden de Completado "+ajax.responseText);
var Date = ajax.responseText;
var elem = Date.split('|');
document.form1.total.value=elem[1];

//                  document.form1.nombreoc.value=elem[8];
//                  document.form1.montob.value=elem[1];
//                  document.form1.codigo.value=elem[2];
//                  document.form1.obs.value=elem[4];
//                  document.form1.monedatraida.value=elem[7];
//                document.form1.obs.value=elem[8];
if (document.form1.monedatraida.value!='CLP') {
	document.form1.monto.value="";
	document.form1.montob.value="";
}


var Date2 = elem[6];
//                alert(Date2);
var elem2 = Date2.split('-');
document.form1.rut.value=elem2[0];
document.form1.dig.value=elem2[1];

traerDatos(elem2[0]);

}

}
}
}

}

-->
</script>

<div style="width:800px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<?
	if(intval($ok) === 1 && $nivel == 45)
	{
		echo "<script>alert('ORDEN DE COMPRA INGRESADA  EXITOSAMENTE AL SISTEMA')</script>";
	}
	if ($nivel<>40 && $nivel <> 47) {
		?>
		<!--
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">INGRESO NUEVO REQUERIMIENTO</td>
			</tr>
		</table>
!-->
		<?
		$prefijos = array(1 => 845,2 => 1573,3 => 846,4 => 1574,5 => 847,6 => 1575,7 => 848,8 => 1576,9 => 852,10 => 853,11 => 854,12 => 855,13 => 856,14 => 5538,15 => 1572,16 => 599);
		$para1 = $prefijos[$regionsession];
 /*
 if ($regionsession==17) {
     $para1="523524";
 }
 if ($regionsession==18) {
     $para1="523522";
 }
 */

 ?>
<!--
 <table>
 	<form name="form11" action="bode_inv_indexoc2.php" method="post" onsubmit="return validarrr()">
 		<tr>
 			<td  valign="center" class="Estilo1">N&uacute;mero O/C </td>
 			<td class="Estilo1" colspan=3>
 				<?php if ($nivel == 45): ?>
 				<input type="hidden" name="numerooc1" id="numerooc1" value="<? echo $para1 ?>"   ><? echo $para1 ?> -
 			<?php elseif($regionsession == 16): ?>
 			<select name="numerooc1" id="numerooc1">
 				<option value="">Seleccionar...</option>
 				<option value="599" <?php if($numerooc1 == 599){echo"selected";}?>>599</option>
 				<option value="856" <?php if($numerooc1 == 856){echo"selected";}?>>856</option>
 			</select>
 		<?php else: ?>
 		<input type="hidden" name="numerooc1" id="numerooc1" value="<? echo $para1 ?>"   ><? echo $para1 ?> -
 	<?php endif ?>
 	<input type="text" name="numerooc2" id="numerooc2" class="Estilo2" size="7"  value="<? echo $numerooc2 ?>"> -
 	<input type="text" name="numerooc3" id="numerooc3" class="Estilo2" size="7" value="<? echo $numerooc3 ?>" >
 	<input type="hidden" name="codigo" class="Estilo2" size="7" >
 	<input type="hidden" name="cod" value="20" >
 	<?php if($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54):?>
 	<input type="submit" name="boton" id="boton" class="Estilo2" value="OK" >
 <?php endif ?>
</td>
</tr>
</form>
</table>
!-->
<?
if ($numerooc3<>'') {
	include("bode_buscaorden2.php");
	$error = $xmlObject->ListSummary->OrdersQuantity;
	$oc_estado = $xmlObject->OrdersList->Order->OrderSummary->SummaryNote;
	$error = $xmlObject->ListSummary->OrdersQuantity.".<br>".$xmlObject->ListSummary->OrdersTotalAmount;
	$oc_nombre = $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->QuoteReference->RefNum;
	$oc 	   = $xmlObject->OrdersList->Order->OrderHeader->OrderNumber->BuyerOrderNumber;
	$sc        = $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->ListOfCostCenter->CostCenter->CostCenterNumber;
	$sc = explode(" ", $sc);
	$sc = trim(str_replace(".","",$sc[1]));
	$emisionOC = substr($xmlObject->OrdersList->Order->OrderHeader->OrderDates->PromiseDate, 0,10);
}
	// $file = fopen("archivo.xml","w");
 	// fwrite($file, $contenido);
 	// fclose($file);
?>
<hr>
<?php
if($_SESSION["pfl_user"] == 45 && ($oc_estado == "OC Aceptada" || $oc_estado == "OC Enviada a Proveedor" || $oc_estado == "OC en Proceso" || $oc_estado=="Recepción Conforme"))
{
	$proceder = "SI";
}else if(($_SESSION["pfl_user"] == 37 || $_SESSION["pfl_user"] == 39 || $_SESSION["pfl_user"] == 41 || $_SESSION["pfl_user"] == 48 || $_SESSION["pfl_user"] == 51) && ($oc_estado == "OC Aceptada" || $oc_estado == "OC Enviada a Proveedor" || $oc_estado=="Recepción Conforme"))
{
	$proceder = "SI";
}else if(strlen($error) > 0){
	$proceder == "NO";
}else{
	$proceder == "NO";
}
?>

<?php 
if($proceder == "SI") { ?>

	<table border="0" width="100%">
		<tr>
			<td class="Estilo1">REGION</td>
			<td class="Estilo1">
				<?php if ($_SESSION["region"] <> 16): ?>
				<select class="Estilo1" name="selReg" id="selReg">
					<option value="">Seleccionar...</option>
					<?php if ($_SESSION["region"] == 1): ?>
					<option value="1">I REGION</option>
				<?php endif ?>

				<?php if ($_SESSION["region"] == 2): ?>
				<option value="2">II REGION</option>
			<?php endif ?>

			<?php if ($_SESSION["region"] == 3): ?>
			<option value="3">III REGION</option>
		<?php endif ?>

		<?php if ($_SESSION["region"] == 4): ?>
		<option value="4">IV REGION</option>
	<?php endif ?>

	<?php if ($_SESSION["region"] == 5): ?>
	<option value="5">V REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 6): ?>
	<option value="6">VI REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 7): ?>
	<option value="7">VII REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 8): ?>
	<option value="8">VIII REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 9): ?>
	<option value="9">IX REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 10): ?>
	<option value="10">X REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 11): ?>
	<option value="11">XI REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 12): ?>
	<option value="12">XII REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 13): ?>
	<option value="13">REGION METROPOLITANA</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 14): ?>
	<option value="14">XIV REGION</option>
<?php endif ?>

<?php if ($_SESSION["region"] == 15): ?>
	<option value="15">XV REGION</option>
<?php endif ?>
</select>
<?php else: ?>
	<select class="Estilo1" name="selReg" id="selReg">
		<option value="">Seleccionar...</option>
		<?php while($reg = mysql_fetch_array($sqlRegionResp)) { ?>
			<option value="<?php echo $reg["region_id"]?>"><?php echo $reg["region_glosa"]?></option>
			<?php } ?>
		</select>
	<?php endif ?>

</td>
<td class="Estilo1"><input type="checkbox" name="selTodo2" id="selTodo2">Seleccionar Todo</td>
<td><button type="button" onClick="selTodo()">IR</button></td>
</tr>

<tr>
	<td valign="center" class="Estilo1">NOMBRE O/C:</td>
	<td valign="center" class="Estilo1" colspan="3">

		<?php if($oc_estado == "OC Enviada a Proveedor") { echo "<font color='red'>La Orden De Compra '$oc' Ha sido enviada al proveedor</font>"; }?>
		<?php if($oc_estado == "OC Removida") { echo "<font color='red'>La Orden De Compra '$oc' Ha sido removida</font>"; }?>
		<?php if($oc_estado == "OC en Proceso"){ echo "<font color='red'>La Orden De Compra '$oc' Esta en proceso</font>"; }?>
		<?php if($oc_estado == "OC Cancelada"){ echo "<font color='red'>La Orden De Compra '$oc' ha sido cancelada</font>"; }?>
		<?php if($oc_estado == "OC Aceptada") { echo $oc_nombre;} ?>

	</td>
</tr>

<tr>
	<td valign="center" class="Estilo1">ESTADO O/C:</td>
	<td valign="center" class="Estilo1" colspan="3">
		<?php echo $oc_estado ?>
	</td>
</tr>

<tr>
	<td valign="center" class="Estilo1">S/C : </td>
	<td valign="center" class="Estilo1">
		<a href='http://abaco.junji.gob.cl/_layouts/FormServer.aspx?XmlLocation=/Solicitudes%20de%20Compra/SC%20n%C2%B0%20<?php echo $sc ?>.xml&ClientInstalled=false&ource=http%3A%2F%2Fabaco%2Ejunji%2Egob%2Ecl%2FSolicitudes%2520de%2520Compra%2FForms%2FPrincipal%&DefaultItemOpen=1' target="_blank" title="N° SOLICITUD DE COMPRA (ABACO)"><?php echo $sc ?></a>
	</td>
</tr>
</table>
<hr>

<table border="0" width="100%">
	<tr>
		<td  valign="center" class="Estilo1">Region</td>
		<td  valign="center" class="Estilo1">Descripcion</td>
		<td  valign="center" class="Estilo1">Cantidad</td>

		<td  valign="center" class="Estilo1">Total Neto</td>
		<td  valign="center" class="Estilo1">Unitario</td>
	</tr>
	<form name="form1" action="bode_inv_grabaindexoc2.php" method="post" onsubmit="return validaree()" enctype="multipart/form-data">

		<?



		$i=0;
		while ($i<$totallinea) {
//  $totallinea=$xmlObject->OrdersList->Order->OrderSummary->NumberOfLines;

//    /OrdersResults/OrdersList/Order/OrderDetail/ListOfItemDetail/ItemDetail[1]/PricingDetail/LineItemTotal/MonetaryAmount
//     /OrdersResults/OrdersList/Order/OrderDetail/ListOfItemDetail/ItemDetail[1]/BaseItemDetail/ItemIdentifiers/ItemDescription

			$cantidad2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->BaseItemDetail->TotalQuantity->QuantityValue;
			$total2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->PricingDetail->LineItemTotal->MonetaryAmount;
			$descrip2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->BaseItemDetail->ItemIdentifiers->ItemDescription;
			$unit = $xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->PricingDetail->ListOfPrice->Price->UnitPrice->UnitPriceValue;
			$moneda = $xmlObject->OrdersList->Order->OrderSummary->OrderTotal->Currency->CurrencyCoded;
			?>
			<tr>
				<td class="Estilo1" colspan=1>

					<select name="var4[<? echo $i ?>]" id="region2_<?php echo $i?>" class="Estilo2" >
						<option value="">Seleccionar...</option>
						<?php
						$j=1;
						while($j<$ii) {
							?>
							<option value="<? echo  $regionN[$j] ?>" > <? echo $regionG[$j] ?></option>
							<?php
							$j++;
						}
						?>
					</select>
				</td>

				<td class="Estilo1" colspan=1>
					<input type="text" required name="var[<? echo $i ?>]" class="Estilo2" size="40"  value="<? echo $descrip2 ?>" >

				</td>
				<td class="Estilo1" colspan=1>
					<input type="text" name="var3[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $cantidad2 ?>" readonly style="background-color: rgb(235, 235, 235)" >
				</td>
				<td class="Estilo1" colspan=1>
					<input type="text" name="var2[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $total2 ?>" readonly style="background-color: rgb(235, 235, 235)">
				</td>

				<td class="Estilo1" colspan=1>
					<input type="text" name="var5[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $unit ?>" readonly style="background-color: rgb(235, 235, 235)">
				</td>


			</tr>
			<?
			$montototal=$montototal+$cantidad2;
			$i++;
 		}// Fin while

// /OrdersResults/OrdersList/Order/OrderSummary/OrderTotal/MonetaryAmount
 		$cantidadtotal=$xmlObject->OrdersList->Order->OrderSummary->OrderTotal->MonetaryAmount;
 		?>


 	</table>
 	<hr>
 	<table border="0" width="100%">
 		<tr>

 			<td valign="center" class="Estilo1">GRUPO</td>
 			<td class="Estilo1">
 				<select name="grupo" id="grupo" class="Estilo2">
 					<option  value="" selected>Seleccionar...</option>
 					<?php foreach ($grupos as $key => $value): ?>
 					<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
 				<?php endforeach ?>
 			</select>
 		</td>
 		<td  valign="center" class="Estilo1">FECHA ENTREGA</td>
 		<td class="Estilo1" valign="center">
 			<input type="text" name="fecha_orden_compra" class="Estilo2" size="12"  id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)">
 			<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
 			onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 			<script type="text/javascript">
 				Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
 			</script>
 		</td>

 	</tr>

 	<tr>
 		<td class="Estilo1">CANTIDAD TOTAL</td>
 		<td class="Estilo1">
 			<input type="text" name="cantidad" id="cantidad" class="Estilo2" readonly size="12" value="<? echo $montototal ?>" reaadonly style="background-color: rgb(235, 235, 235)">
 		</td>

 		<td class="Estilo1">MONTO TOTAL C / IVA</td>
 		<td class="Estilo1" colspan="3">
 			<input type="text" name="total" id="total" class="Estilo2" size="8" value="<? echo $cantidadtotal ?>" readonly style="background-color: rgb(235, 235, 235)">
 		</td>

 	</tr>

 	<tr>
 		<td class="Estilo1">PROGRAMA</td>
 		<td class="Estilo1">
 			<select name="programa" id="programa" class="Estilo2">
 				<option  value="" selected>Seleccionar...</option>
 				<?php foreach ($programas as $key => $value): ?>
 				<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
 			<?php endforeach ?>
 		</select>
 	</td>

 	<td class="Estilo1">TIPO CAMBIO</td>
 	<td class="Estilo1">
 		<select name="moneda" id="moneda" class="Estilo2" onChange="tipoCambio(this.value)">
 			<?php if ($moneda == "CLP"): ?>
 			<option value="PESO" selected>PESO</option>
 		<?php elseif($moneda == "USD"): ?>
 		<option value="DOLAR" selected>DOLAR</option>
 	<?php elseif($moneda == "UF"): ?>
 	<option value="UF" selected>UF</option>
 <?php endif ?>
</select>
</td>

<td class="Estilo1">
	<?php if ($moneda == "USD" || $moneda == "UF"): ?>
	<input type="text" name="tipo_cambio" id="tipo_cambio" class="Estilo2" maxlength="6" size="5">
<?php endif ?>

<?php if ($moneda == "CLP"): ?>
	<input type="hidden" name="tipo_cambio" id="tipo_cambio" class="Estilo2" maxlength="1" size="2" value="1">
<?php endif ?>

</td>

</tr>

<tr>
	<td class="Estilo1">PROVEEDOR RUT</td>
	<td class="Estilo1">
		<input type="text" name="proveedor" id="proveedor" class="Estilo2" size="12" value="<? echo $rut ?>" readonly style="background-color: rgb(235, 235, 235)"> -
		<input type="text" name="proveedor2" id="proveedor2" class="Estilo2" size="1" value="<? echo $dig ?>" readonly style="background-color: rgb(235, 235, 235)">
	</td>

	<?php if ($nivel <> 45): ?>
	<td class="Estilo1">UNIDAD DE MEDIDA</td>
	<td class="Estilo1" colspan="3">
		<select name="tipo_compra" id="tipo_compra" class="Estilo2">
			<option value="" selected>Seleccionar...</option>
			<?php foreach ($uMedida as $key => $value): ?>
			<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
		<?php endforeach ?>
	</select>
</td>
<?php endif ?>


</tr>
<tr>
	<td class="Estilo1">PROVEEDOR NOMBRE</td>
	<td class="Estilo1">
		<input type="text" name="proveedornomb" id="proveedornomb" class="Estilo2" size="40" value="<? echo $nombreproveedor ?>" readonly style="background-color: rgb(235, 235, 235)">
	</td>
	<?php if (45 == $nivel): ?>
	<td class="Estilo1">DISTRIBUCION</td>
	<td class="Estilo1"><input type="file" name="distribucion" id="distribucion"></td>
<?php endif ?>

</tr>
</table>

<table border="0" width="100%">
	<tr>
		<td class="Estilo1c">
			<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
			<input type="hidden" name="totallinea" id="totallinea" value="<? echo $totallinea ?>" >
			<input type="hidden" name="descuento" value="<? echo $descuento ?>" >
			<input type="hidden" name="nombreoc" value="<? echo $nombreoc ?>" >
			<input type="hidden" name="sc" value="<? echo $sc ?>" >
			<input type="hidden" name="f_oc" value="<? echo $emisionOC ?>" >
			<input type="submit" name="submit" class="Estilo2" size="11" value="  Grabar  " id="boton2">
			<?php if ($nivel == 45): ?>
			<input type="hidden" name="origen" value="compras">
		<?php else: ?>
		<input type="hidden" name="origen" value="bodega">
	<?php endif ?>
</td>

</tr>
</table>
</form>
<hr>
<?php }else{
	if($oc_estado == "OC Cancelada"){ echo "<font color='red' class='Estilo2'><strong>La Orden De Compra '$oc' ha sido cancelada</font></strong>"; }
	if(strlen($error) > 0){ echo "<font color='red' class='Estilo2'><strong>".$error."</font></strong>"; }
} ?>
<!--<?
} // Fin While
?>!-->
<?php if ($nivel <> 45): ?>
	<?php include("bode_ultimasoc2.php") ?>
	<hr>
<?php endif ?>


<?
if ($nivel<>40 && $nivel <> 45 && $nivel <> 47) {
	?>
	<?php include("bode_ultimasoc.php") ?>
	<?
}
?>
</div>

<script type="text/javascript">

	function validarrr()
	{

		if(document.getElementById("numerooc1").value == "")
		{
			alert("SELECCIONE EL PREFIJO DE SU REGION");
			document.getElementById("numerooc1").focus();
			return false;
		}else if(document.getElementById("numerooc2").value == ""){
			alert("INGRESE EL CORRELATIVO DE LA ORDEN DE COMPRA");
			document.getElementById("numerooc2").focus();
			return false;
		}else if(document.getElementById("numerooc3").value == ""){
			alert("INGRESE EL SUFIJO DE LA ORDEN DE COMPRA");
			document.getElementById("numerooc3").focus();
			return false;
		}else{
			var oc = $("#numerooc1").val()+"-"+$("#numerooc2").val()+"-"+$("#numerooc3").val();
			var resp = validaOrdenCompra(oc);
			return false;

		}
		return false;
	}

	function validaOrdenCompra(input)
	{
		var data = ({cmd : "validaOC", oc : input});
		$.ajax({
			type:"POST",
			url:"validaOrden.php",
			data:data,
			cache:true,
			dataType:"JSON",
			success : function ( response ) {
				if(response)
				{
					alert("LA ORDEN DE COMPRA '"+input+"' YA SE ENCUENTRA REGISTRADA");
					document.getElementById("numerooc2").value='';
					document.getElementById("numerooc3").value='';
				}else{
					$("#boton").hide();
					document.form11.submit();
				}

			}
		});
	}

	function validaree()
	{

		if($("#numerooc2").val() == "")
		{
			alert("INGRESE NUMERO OC");
			document.getElementById("numerooc2").focus();
			return false;
		}else if($("#numerooc3").val() == "")
		{
			alert("INGRESE NUMERO OC ");
			document.getElementById("numerooc3").focus();
			return false;
		}else if($("#f_date_c2").val() == "")
		{
			alert("INGRESE LA FECHA");
			document.getElementById("f_date_c2").focus();
			return false;
		}else if($("#grupo").val() == "")
		{
			alert("SELECCIONE UN GRUPO");
			document.getElementById("grupo").focus();
			return false;
		}else if($("#programa").val() == "")
		{
			alert("SELECCIONE UN PROGRAMA");
			document.getElementById("programa").focus();
			return false;
		}else if($("#moneda").val() == "")
		{
			alert("SELECCIONE UN TIPO DE CAMBIO");
			document.getElementById("moneda").focus();
			return false;
		}else if($("#tipo_cambio").val() == "")
		{
			alert("INGRESE EL VALOR DEL CAMBIO");
			document.getElementById("tipo_cambio").focus();
			return false;
		}else if($("#tipo_compra").val() == ""){
			alert("SELECCIONE LA UNIDAD DE MEDIDA");
			document.getElementById("tipo_compra").focus();
			return false;
		}else if($("#cantidad").val() == ""){
			alert("INGRESE LA CANTIDAD TOTAL");
			document.getElementById("cantidad").focus();
			return false;
		}else if($("#total").val() == ""){
			alert("INGRESE EL TOTAL DE LA COMPRA");
			document.getElementById("total").focus();
			return false;
		}else if($("#proveedor").val() == ""){
			alert("INGRESE EL RUT");
			document.getElementById("proveedor").focus();
			return false;
		}else if($("#proveedor2").val() == ""){
			alert("INGRESE EL DV");
			document.getElementById("proveedor2").focus();
			return false;
		}else if($("#proveedornomb").val() == ""){
			alert("INGRESE EL PROVEEDOR");
			document.getElementById("proveedornomb").focus();
			return false;
		}else if($("#distribucion").val() == "")
		{
			alert("INGRESE EL ARCHIVO DE DISTRIBUCION");
			document.getElementById("distribucion").focus();
			return false;
		}else{

			var x = "<?php echo count($totallinea)?>";
			if(x == 0)
			{
				alert("FALTAN DATOS POR COMPLETAR");
				return false;
			}else{
				if(confirm("¿ ESTA SEGURO DE PROCEDER CON LA CARGA DE DATOS ?")){
					$("#boton2").hide();
					blockUI();
					return true;
				}else{
					return false;
				}
			}
		}
		return false;
	}

	function selTodo(){
		var reg = $("#selReg option:selected").val();
		var regText = $("#selReg option:selected").text();
		var totallinea = $("#totallinea").val();

		if($("#selTodo2").is(":checked")){

			for(i=0;i<totallinea;i++){
				$("#region2_"+i+" option:selected").text(regText);
				$("#region2_"+i+" option:selected").val(reg);
			}
		}
	}
</script>
