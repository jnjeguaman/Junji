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
     $para1="856";
 }
 if ($regionsession==12) {
     $para1="855";
 }
 if ($regionsession==13) {
     $para1="599";
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


 
<?

?>


					<hr>
					<?php include("bode_ultimasoc25.php") ?>
     <hr>
					<?php //include("bode_ultimasoc.php") ?>
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

								function validarrr()
								{

									if(document.getElementById("numerooc1").value == "")
									{
										alert("Seleccione un prefijo");
										document.getElementById("numerooc1").focus();
										return false;
									}else if(document.getElementById("numerooc2").value == ""){
										alert("INGRESE OC2");
										document.getElementById("numerooc2").focus();
										return false;
									}else if(document.getElementById("numerooc3").value == ""){
										alert("INGRESE OC3");
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
									}else{

										var x = "<?php echo count($totallinea)?>";
										if(x == 0)
										{
											alert("FALTAN DATOS POR COMPLETAR");
											return false;
										}else{
											return true;
										}
									}
									return false;
								}
							</script>
