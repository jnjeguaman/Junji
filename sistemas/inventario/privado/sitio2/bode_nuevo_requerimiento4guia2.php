   <?php
   $sqlj = "SELECT COUNT(oc_id) as Total FROM bode_orcom2 WHERE oc_mas_id =".$_GET["masid"];
   $resj = mysql_query($sqlj);
   $rowj =mysql_fetch_array($resj);

   $sqlp = "SELECT COUNT(doc_id) as Total FROM bode_detoc2 WHERE doc_mas_id =".$_GET["masid"];
   $resp = mysql_query($sqlp);
   $rowp =mysql_fetch_array($resp);

   ?> 
   <script type="text/javascript" src="librerias/select2/dist/js/select2.full.min.js"></script>
   <link rel="stylesheet" type="text/css" href="librerias/select2/dist/css/select2.min.css">
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

function traerDatos()  {
	var ajax=nuevoAjax();
	bodega=document.frmjardinmatriz.bodega.value;
//    alert("Entra 1"+bodega);
if (bodega!=''  ) {
//    alert (" dato "+codigo);
ajax.open("POST", "bode_buscajardin.php", true);
ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
ajax.send("d="+bodega);

ajax.onreadystatechange=function()	{
	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			   // Respuesta recibida. Coloco el texto plano en la capa correspondiente
			   //capa.innerHTML=ajax.responseText;

			   var separar = ajax.responseText;
//               alert(separar);
var elem = separar.split('/');
jnombre.innerText=elem[0];
jcomuna.innerText=elem[1]+"\n"+elem[2];
//               document.form1.nombre.value=elem[0];
//               document.form1.fpago.value = elem[1];
}
}
}
}
}



-->
</script>

<div style="width:800px; height:650px;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">AGREGAR JARDIN A DISTRIBUCION</td>
		</tr>
	</table>

	<form name="frmjardinmatriz" id="frmJardinMatriz" action="bode_inv_grabaindexguia3.php" method="post" onsubmit="return validaNO()" enctype="multipart/form-data">
		<input type="hidden" value="3" name="tipo_guia">
		<table border="1" width="100%">
		<?php if ($_SESSION["region"] == 16): ?>
			
			<tr>
				<td class="Estilo1">SELECCIONAR REGION</td>
				<td class="Estilo1" colspan="1">
					<select id="jardin_region" class="Estilo2" onChange="getJardinesRegion(this.value)">
						<option value="">Seleccionar...</option>
						<?php
						$listaRegion = "SELECT * FROM acti_region";
						$listaResp = mysql_query($listaRegion,$dbh);
						while($regiones = mysql_fetch_array($listaResp)) {
							?>
							<option value="<?php echo $regiones["region_id"] ?>"><?php echo $regiones["region_glosa"] ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr>
					<td class="Estilo1">JARDIN DESTINO</td>
					<td class="Estilo1" colspan="1">
						<select name="bodega" id="region2" class="Estilo2 select2"  onChange="traerDatos();" style="width:200px;" tabindex="1">
							<option value="">Seleccionar...</option>
						</select>
					</td>
				</tr>
		<?php endif ?>
				
				<?php if ($_SESSION["Acceso"]["acc_mj"] == 1): ?>
					<tr>
						<td class="Estilo1">MATRIZ JARDINES <a href="librerias/matriz_jardines.csv" title="Descargar formato Jardines"><i class="fa fa-download fa-lg link"></i></a>
							<?php if ($rowj["Total"] > 0): ?>
								| <a href="bode_mas_del.php?tipo=jardines&masid=<?php echo $_GET["masid"] ?>" title="Eliminar Carga" onClick="return confirm('¿ ESTÁ SEGURO DE ELIMINAR LA MATRIZ DE LOS JARDINES ?')"><i class="fa fa-trash fa-lg link"></i></a>
							<?php endif ?>
						</td>
						<td class="Estilo1"><input type="file" name="jardincsv" id="jardincsv"></td>
					</tr>
				<?php endif ?>
				
				<?php if ($_SESSION["Acceso"]["acc_mp"] == 1): ?>
					<tr>
						<td class="Estilo1">MATRIZ PRODUCTOS <a href="librerias/matriz_productos.csv" title="Descargar formato Productos"><i class="fa fa-download fa-lg link"></i></a>
							<?php if ($rowp["Total"] > 0): ?>
								| <a href="bode_mas_del.php?tipo=productos&masid=<?php echo $_GET["masid"] ?>" title="Eliminar Carga" onClick="return confirm('¿ ESTÁ SEGURO DE ELIMINAR LA MATRIZ DE LOS PRODUCTOS ?')"><i class="fa fa-trash fa-lg link"></i></a>
							<?php endif ?>
						</td>
						<td class="Estilo1"><input type="file" name="productoscsv" id="productoscsv"></td>
					</tr>
				<?php endif ?>
				
				<?php if ($_SESSION["Acceso"]["acc_md"] == 1): ?>
					<tr>
						<td class="Estilo1">MATRIZ DISTRIBUCION <a href="librerias/matriz_distribucion.csv" title="Descargar formato Distribución"><i class="fa fa-download fa-lg link"></i></a></td>
						<td class="Estilo1"><input type="file" name="distribucioncsv" id="distribucioncsv"></td>
					</tr>
				<?php endif ?>

				<?php if ($_SESSION["Acceso"]["acc_mbs"] == 1): ?>
					<tr>
						<td class="Estilo1">BAJAR STOCK</td>
						<td class="Estilo1"><a href="matrizStock.php" title="Descargar stock disponible" target="_blank"><i class="fa fa-download fa-lg link"></i></a></td>
					</tr>
				<?php endif ?>
				
				<!-- SUBIR ACRCHIVO CSV JARDINES -->
				<tr>
					<td class="Estilo1">MATRIZ EXCEL <a href="librerias/matriz_excel.xlsx" title="Descargar formato Distribución"><i class="fa fa-download fa-lg link"></i></a></td>
					<td class="Estilo1"><input type="file" name="excel" id="excel"></td>
				</tr>
				<!-- SUBIR ARCHIVO CSV PRODUCTOS -->
			</table>
			<table  width="100%" border=1>
				<tr>
					<td width="50%">Nombre</td>
					<td width="50%">Ubicacion</td>
				</tr>
				<tr>
					<td id="jnombre"  width="50%"></td>
					<td id="jcomuna"  width="50%"></td>
				</tr>
			</table>

			<?php if ($_SESSION["region"] <> 16): ?>
				<table border="0" width="100%">
				<tr>
					<td class="Estilo1">JARDIN DESTINO</td>
					<td class="Estilo1" colspan=1>

						<select name="bodega" id="region2" class="Estilo2 select2" onChange="traerDatos();" >
							<option value="">Seleccionar...</option>
							<?php
							$sqlZona = "SELECT * FROM jardines where jardin_region='$regionsession' and jardin_estado = 1 order by jardin_codigo";
							$sqlZonaResp = mysql_query($sqlZona);
							while ($row2 = mysql_fetch_array($sqlZonaResp)) {
								?>
								<option value="<? echo  $row2["jardin_codigo"] ?>" > <? echo  $row2["jardin_codigo"]." : ".$row2["jardin_nombre"] ?></option>
								<?php
								$j++;
							}
							?>
						</select>
					</td>
				</tr>
			</table>
			<table  width="100%" border=1>
				<tr>
					<td width="50%">Nombre</td>
					<td width="50%">Ubicacion</td>
				</tr>

				<tr>
					<td id="jnombre"  width="50%"></td>
					<td id="jcomuna"  width="50%"></td>
				</tr>
			</table>
			<?php endif ?>

			<table border="0" width="100%">
				<tr>
					<td class="Estilo1c">
						<input type="hidden" name="masid" value="<? echo $masid ?>"  >
						<input type="submit" name="submit" class="Estilo2" size="11" value="  AGREGAR A LA MATRIZ  ">
					</td>

				</tr>
			</table>
		</form>
		<hr>
	</div>
	<div style="width:100%; background-color:#E0F8E0; position:absolute; top:790px; left:0px;" id="div1">
		<?php include("bode_distribucion.php") ?>
	</div>

	<script type="text/javascript">
		function validaNO()
		{
			// if($("#jardin_region").val() == "")
			// {
			// 	alert("SELECCIONE UNA REGION")
			// 	$("#jardin_region").focus();
			// 	return false;
			// }else if($("#region2").val() == "")
			// {
			// 	alert("SELECCIONE UN JARDIN DE DESTINO");
			// 	$("#region2").focus();
			// 	return false;
			// }else{
			// 	return valJardin();
			// }
			// return false;
		}

		function valJardin()
		{
			var jardin = $("#region2").val();
			var masid = <?php echo $masid ?>;
			var data = ({cmd : "valJardin", jardin : jardin,masid : masid});
			$.ajax({
				type:"POST",
				url:"validaOrden.php",
				data:data,
				dataType:"JSON",
				sync: true,
				success : function ( response ) {
					return response;
						/*if(response)
						{
							$("#frmjardinmatriz").submit();
							return false;
						}else{
							alert("EL JARDIN '"+input+"' YA ESTA EN LA LISTA")
							return false;
						}*/
					}
				});
		}
		function getJardinesRegion(input){
			var data = ({cmd : "getJardinesRegion", region_id : input});
			$.ajax({
				type:"POST",
				url:"bode_getJardines.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					$("#region2").html(response);
				}
			});
		}

		$(function(){
			$(".select2").select2();
		})

	</script>
