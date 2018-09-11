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

<div style="width:800px; height:530px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">INGRESO NUEVO REQUERIMIENTO</td>
		</tr>
	</table>

 <?
  if ($regionsession==1) {
     $para1="845";
 }
 if ($regionsession==2) {
     $para1="1573";
 }
 if ($regionsession==3) {
     $para1="846";
 }
 if ($regionsession==4) {
     $para1="1574";
 }
 if ($regionsession==5) {
     $para1="847";
 }
 if ($regionsession==6) {
     $para1="1575";
 }
 if ($regionsession==7) {
     $para1="848";
 }
 if ($regionsession==8) {
     $para1="1576";
 }
 if ($regionsession==9) {
     $para1="852";
 }
 if ($regionsession==10) {
     $para1="853";
 }
 if ($regionsession==11) {
     $para1="854";
 }
  if ($regionsession==16) {
     $para1="599";
 }
 if ($regionsession==12) {
     $para1="855";
 }
 if ($regionsession==13) {
     $para1="856";
 }
 if ($regionsession==14) {
     $para1="5538";
 }
 if ($regionsession==15) {
     $para1="1572";
 }
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
	<form name="form11" action="inv_indexoc2.php" method="post" onsubmit="return validarrr()">
                               <tr>
                             <td  valign="center" class="Estilo1">Número O/C </td>
                             <td class="Estilo1" colspan=3>
                              <input type="hidden" name="numerooc1" value="<? echo $para1 ?>"   ><? echo $para1 ?> -
                              <input type="text" name="numerooc2" class="Estilo2" size="7"  value="<? echo $numerooc2 ?>"> -
                              <input type="text" name="numerooc3" class="Estilo2" size="7" value="<? echo $numerooc3 ?>" >
                              <input type="hidden" name="codigo" class="Estilo2" size="7" >
                              <input type="hidden" name="cod" value="20" >
                              <input type="submit" name="boton" class="Estilo2" value="OK" >
                              

                             </td>
                           </tr>
    </form>
</table>
 
<?
if ($numerooc3<>'') {
  include("buscaorden2.php");
}
?>
<table border="0" width="100%">
                           <tr>
                             <td  valign="center" class="Estilo1">Region</td>
                             <td  valign="center" class="Estilo1">Descripcion</td>
                             <td  valign="center" class="Estilo1">Cantidad</td>

                             <td  valign="center" class="Estilo1">Total</td>
                           </tr>

	<form name="form1" action="inv_grabaindexoc2.php" method="post" onsubmit="return validaree()">
 <?
 $i=0;


 while ($i<$totallinea) {
//  $totallinea=$xmlObject->OrdersList->Order->OrderSummary->NumberOfLines;
      
//    /OrdersResults/OrdersList/Order/OrderDetail/ListOfItemDetail/ItemDetail[1]/PricingDetail/LineItemTotal/MonetaryAmount
//     /OrdersResults/OrdersList/Order/OrderDetail/ListOfItemDetail/ItemDetail[1]/BaseItemDetail/ItemIdentifiers/ItemDescription

        $cantidad2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->BaseItemDetail->TotalQuantity->QuantityValue;
        $total2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->PricingDetail->LineItemTotal->MonetaryAmount;
        $descrip2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->BaseItemDetail->ItemIdentifiers->ItemDescription;
?>
                           <tr>
                             <td class="Estilo1" colspan=1>
                             
                    <select name="var4[<? echo $i ?>]" id="region2" class="Estilo2" >
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
                              <input type="text" name="var[<? echo $i ?>]" class="Estilo2" size="40"  value="<? echo $descrip2 ?>" >

                             </td>
                             <td class="Estilo1" colspan=1>
                              <input type="text" name="var2[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $total2 ?>" >
                             </td>
                             <td class="Estilo1" colspan=1>
                              <input type="text" name="var3[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $cantidad2 ?>" >
                             </td>

                            </tr>
<?
     $montototal=$montototal+$cantidad2;
     $i++;
}

// /OrdersResults/OrdersList/Order/OrderSummary/OrderTotal/MonetaryAmount
        $cantidadtotal=$xmlObject->OrdersList->Order->OrderSummary->OrderTotal->MonetaryAmount;
?>

<!--
                           <tr>
                             <td class="Estilo1" colspan=1>
                              <input type="text" name="numerooc2" class="Estilo2" size="7"  value="<? echo $cantidadtotal ?>" >
                             </td>

                            </tr>


       </table>
-->
<!--
       <table border="0" width="100%">
                   <tr>
                             <td  valign="center" class="Estilo1">Fecha Compra</td>
                             <td class="Estilo1" valign="center">
      <input type="text" name="fecha_orden_compra" class="Estilo2" size="12" value="<? echo $fechamia2; ?>" id="f_date_c2" readonly="1">
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
				<td valign="center" class="Estilo1">GRUPO</td>
				<td class="Estilo1">
					<select name="grupo" id="grupo" class="Estilo2" onChange="getSubCat(this.value)">
						<option selected value="">Seleccionar...</option>
						<?php
						while($row = mysql_fetch_array($sqlCategoriaResp)) {
							?>
							<option value="<?php echo $row["cat_id"] ?>"><?php echo utf8_decode($row["cat_nombre"]) ?></option>
							<?php } ?>
						</select>
					</td>

					<td valign="center" class="Estilo1">SUB-GRUPO</td>
					<td class="Estilo1" colspan="3">
						<select name="subgrupo" id="subgrupo" class="Estilo2" readonly>
							<option value="">Seleccionar...</option>
						</select>
					</td>
				</tr>


					<tr> 
						<td class="Estilo1">CANTIDAD TOTAL</td>
						<td class="Estilo1">
							<input type="text" name="cantidad" id="cantidad" class="Estilo2" size="12" value="<? echo $montototal ?>">
						</td>

						<td class="Estilo1">MONTO TOTAL C / IVA</td>
						<td class="Estilo1" colspan="3">
							<input type="text" name="total" id="total" class="Estilo2" size="8" value="<? echo $cantidadtotal ?>">
						</td>

					</tr>

					<tr> 
						<td class="Estilo1">PROGRAMA</td>
						<td class="Estilo1">
							<select name="programa" id="programa" class="Estilo2">
								<option selected value="">Seleccionar...</option>
								<option value="P1">P1</option>
								<option value="P2">P2</option>
								<option value="CECI">CECI</option>
								<option value="PMI">PMI</option>
								<option value="CASH">CASH</option>
							</select>
						</td>

						<td class="Estilo1">TIPO CAMBIO</td>
						<td class="Estilo1">
							<select name="moneda" id="moneda" class="Estilo2" onChange="tipoCambio(this.value)">
								<option selected value="">Seleccionar...</option>
								<option value="PESO">PESO</option>
								<option value="DOLAR">DOLAR</option>
								<option value="EURO">EURO</option>
							</select>	
						</td>

						<td class="Estilo1">
							<input type="text" name="tipo_cambio" id="tipo_cambio" class="Estilo2" maxlength="3" size="2">
						</td>

					</tr>

					<tr>
						<td class="Estilo1">PROVEEDOR RUT</td>
						<td class="Estilo1">
							<input type="text" name="proveedor" id="proveedor" class="Estilo2" size="12" value="<? echo $rut ?>"> -
							<input type="text" name="proveedor2" id="proveedor2" class="Estilo2" size="1" value="<? echo $dig ?>">
						</td>
								
								<td class="Estilo1">TIPO COMPRA</td>
								<td class="Estilo1" colspan="3">
									<select name="tipo_compra" id="tipo_compra" class="Estilo2">
										<option selected value="">Seleccionar...</option>
										<option value="TRATO DIRECTO">TRATO DIRECTO</option>
										<option value="CONVENIO MARCO">CONVENIO MARCO</option>
										<option value="LICITACION">LICITACION</option>
									</select>
								</td>

							</tr>
					<tr>
						<td class="Estilo1">PROVEEDOR Nombre</td>
						<td class="Estilo1">
							<input type="text" name="proveedornomb" id="proveedornomb" class="Estilo2" size="40" value="<? echo $nombreproveedor ?>">
						</td>


							</tr>



						</table>
-->

	<form name="form1" action="inv_grabaindexoc3.php" method="post" onsubmit="return validaree()">
						<table border="0" width="100%">
							<tr>
								<td class="Estilo1c">
        <input type="hidden" name="oc" value="<? echo $codigo ?>"  >
        <input type="hidden" name="totallinea" value="<? echo $totallinea ?>" >
									<input type="submit" name="submit" class="Estilo2" size="11" value="  Crear Guia  ">
								</td>

							</tr>
						</table>
						<input type="hidden" name="compra_id" id="compra_id">
					</form>
					<hr>
					<?php include("ultimasguias.php") ?>
					<hr>
					<?php include("ultimasoc3.php") ?>
                    <hr>
					<?php include("ultimasoc.php") ?>
				</div>

				<script type="text/javascript">

					jQuery('.popup').click(function(e){
						e.preventDefault();
						window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=500, height=200, top=100, left=200, toolbar=1');

						window.popup.onload = function() {
							window.popup.onbeforeunload = function(){
							getProveedores();
								
							}
						}

					});

					function getProveedores()
					{
						var data = ({cmd : "getProveedores"});
						$.ajax({
							type:"POST",
							url:"proveedor.php",
							data:data,
							dataType:"JSON",
							success : function ( response ) {
								var proveedor = "<option selected value=''>Seleccionar...</option>";
								$.each(response,function(index,value){
										proveedor += "<option value="+value+">"+value+"</option>";
								})
								$("#proveedor").html(proveedor);
							}
						})
					}

					$(function(){
						$("#tipo_cambio").hide();
					})

					function nuevoProducto(region_id)
					{
						var data = ({cmd : "ultimaCompra", region_id : region_id});
									// Buscamos la ultima de la region
									$.ajax({
										type:"POST",
										url:"ultimaCompra.php",
										data:data,
										dataType:"JSON",
										cache:false,
										success : function ( response ) {
											$("#compra_id").val(response.compra_id);
											$("#programa").val(response.compra_programa);
											$("#proveedor").val(response.compra_proveedor);
											$("#tipo_compra").val(response.compra_tipo_compra);
											$("#plazo_entrega").val(response.compra_plazo_entrega);
										}
									});
								}
								function tipoCambio(input) {
									if(input === "PESO") {
										$("#tipo_cambio").val(1);
										$("#tipo_cambio").fadeOut("slow");

									}else if(input === "") {
										$("#tipo_cambio").fadeOut("slow");
									}else{
										$("#tipo_cambio").fadeIn("slow");
									}
								}

								function validar(){
									if(document.getElementById("grupo").value == ""){
										alert("Seleccione un grupo");
										document.getElementById("grupo").focus();
										return false;
									}else if(document.getElementById("subgrupo").value == ""){
										alert("Seleccione un subgrupo");
										document.getElementById("subgrupo").focus();
										return false;
									}else if(document.getElementById("subtitulo").value == ""){
										alert("Seleccione un subtitulo");
										document.getElementById("subtitulo").focus();
										return false;
									}else if(document.getElementById("item").value == ""){
										alert("Seleccione un item");
										document.getElementById("item").focus();
										return false;
									}else if(document.getElementById("cantidad").value == ""){
										alert("Seleccione un cantidad");
										document.getElementById("cantidad").focus();
										return false;
									}else if(document.getElementById("total").value == ""){
										alert("Seleccione un total");
										document.getElementById("total").focus();
										return false;
									}else if(document.getElementById("programa").value == ""){
										alert("Seleccione un programa");
										document.getElementById("programa").focus();
										return false;
									}else if(document.getElementById("moneda").value == ""){
										alert("Seleccione un moneda");
										document.getElementById("moneda").focus();
										return false;
									}else if(document.getElementById("tipo_cambio").value == ""){
										alert("Seleccione un tipo_cambio");
										document.getElementById("tipo_cambio").focus();
										return false;
									}else if(document.getElementById("proveedor").value == ""){
										alert("Seleccione un proveedor");
										document.getElementById("proveedor").focus();
										return false;
									}else if(document.getElementById("tipo_compra").value == ""){
										alert("Seleccione un tipo_compra");
										document.getElementById("tipo_compra").focus();
										return false;
									}else if(document.getElementById("plazo_entrega").value == ""){
										alert("Seleccione un plazo_entrega");
										document.getElementById("plazo_entrega").focus();
										return false;
									}else if(document.getElementById("tipo_activo").value == ""){
										alert("Seleccione un tipo_activo");
										document.getElementById("tipo_activo").focus();
										return false;
									}else{
										return true;
									}
								}
							</script>
