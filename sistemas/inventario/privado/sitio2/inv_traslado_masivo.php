<?php
session_start();
include_once("inc/config.php");
extract($_POST);
// OBTENEMOS LA ULTIMA GUIA INGRESADA AL SISTEMA
$ultimaGuia = "SELECT max(guia_numero) as Ultimo,guia_origen as Origen FROM inv_guia_despacho_encabezado WHERE guia_origen = 1 AND guia_region_origen = ".$_SESSION["region"];
$ultimaGuia = mysql_query($ultimaGuia);
$ultimaGuia = mysql_fetch_array($ultimaGuia);
$Origen = intval($ultimaGuia["Origen"]);
$ultimaGuia = intval($ultimaGuia["Ultimo"]);

// RESCATAMOS EL ULTIMO FOLIO DE LA REGION
$folio = mysql_query("SELECT max(folio_reg_".$_SESSION["region"].") as Folio from inv_folio_traslado");
$folio = mysql_fetch_array($folio);
$folio = intval($folio["Folio"])+1;

// OBTENEMOS EL LISTADO DE LAS ZONAS SEGUN LA REGION DE DESTINO
$zonas = "SELECT * FROM acti_zona WHERE zona_region = ".$traslado_region." AND zona_estado = 1 AND NOT zona_glosa LIKE 'JI%'";
$zonas = mysql_query($zonas);

// LISTADO DE LAS REGIONES
$regiones = array(1=>"I REGION",2=>"II REGION",3=>"III REGION",4=>"IV REGION",5=>"V REGION",6=>"VI REGION",7=>"VII REGION",8=>"VIII REGION",9=>"IX REGION",10=>"X REGION",11=>"XI REGION",12=>"XII REGION",13=>"REGION METROPOLITANA",14=>"XIV REGION",15=>"XV REGION",16=>"DIRECCION NACIONAL");

?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>INEDIS</title>
		<meta charset="UTF-8">
		<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<script src="librerias/jquery-1.11.3.min.js"></script>
	</head>
	<body>
		<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
			<?php
			include("inc/menu_1b.php");
			?>
		</div>

		<div style="background-color:#E0F8E0; position:absolute; top:120px; left:00px; width:100%" id="div1">

			<form action="inv_actualiza_traslado.php" method="POST" onSubmit="return valida()">
				<table border="1" width="100%">
					<tr>
						<td class="Estilo2titulo" colspan="4">GUIA DE DESPACHO TRASLADO MASIVO</td>
					</tr>

					<tr>
						<td class="Estilo1">ÚLTIMA GUIA </td>
						<?php if ($ultimaGuia === 0): ?>
							<td class="Estilo1">No se han emitido guias</td>
						<?php else: ?>
							<td class="Estilo1"><a href="/sistemas/inventario/privado/sitio2/imprimir2.php?guia=<?php echo $ultimaGuia ?>&guia_origen=<?php echo $Origen ?>" class="popup"><?php echo $ultimaGuia ?></a></td>
						<?php endif ?>

						<td class="Estilo1">RESOLUCION DE TRASLADO</td>
						<td class="Estilo1"><?php echo $traslado_resolucion ?></td>
					</tr>

					<tr>
						<td class="Estilo1">N° GUIA</td>
						<td class="Estilo1"><input type="text" name="nro_guia" id="nro_guia" class="Estilo1" value="<?php echo $folio ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>

						<td class="Estilo1">FECHA EMISION</td>
						<td class="Estilo1"><input type="text" name="fecha" id="fecha" class="Estilo1" value="<?php echo Date("Y-m-d") ?>" readonly style="background-color: rgb(235, 235, 228)"></td>
					</tr>

					<tr>
						<td class="Estilo1">ABASTECE</td>
						<td class="Estilo1"><input type="text" name="abastece" id="abastece" class="Estilo1" value="UNIDAD DE INVENTARIO <?php echo $regiones[$region] ?>" readonly style="background-color: rgb(235,235,228)"></td>
						<td class="Estilo1">DESTINATARIO</td>
						<td class="Estilo1"><input type="text" name="destinatario" id="destinatario" class="Estilo1" value="<?php echo $regiones[$traslado_region] ?>" readonly style="background-color: rgb(235,235,228)"></td>
					</tr>

					<tr>
						<td class="Estilo1">DIRECCION</td>
						<td class="Estilo1">
							<select class="Estilo1" name="responsa" id="responsa" onchange="getSubZona(this.value)">
								<option value="">Seleccionar...</option>
								<?php while($row = mysql_fetch_array($zonas)){ ?>
								<option value="<?php echo $row["zona_glosa"] ?>"><?php echo $row["zona_glosa"] ?></option>
								<?php } ?>
							</select>
						</td>
						<td class="Estilo1">ZONA</td>
						<td class="Estilo1">
							<select class="Estilo1" name="inv_zona" id="inv_zona">
								<option value="">Seleccionar...</option>
								</select>
							</td>
						</tr>

						<tr>
							<td class="Estilo1">OBSERVACION</td>
							<td class="Estilo1" colspan="3"><textarea name="obs" id="obs" style="margin: 0px; width: 648px; height: 116px;"></textarea></td>
						</tr>

						<tr>
							<td class="Estilo1">EMISOR</td>
							<td class="Estilo1" colspan="3"><?php echo $_SESSION["nombrecom"] ?></td>
						</tr>

						<tr>
							<td class="Estilo2titulo" colspan="4">LISTADO DE ITEMS</td>
						</tr>

						<tr>
							<td class="Estilo1mc" colspan="2">CODIGO DE INVENTARIO</td>
							<td class="Estilo1mc" colspan="2">NOMBRE DEL BIEN</td>
						</tr>
						<?php $cont=0; ?>
						<?php foreach ($_SESSION["Actualizacion"] as $key => $value): ?>
							<?php $cont++ ?>
							<tr>
								<td class="Estilo1mc" colspan="2"><?php echo $value["codigo"] ?></td>
								<input type="hidden" name="var1[<?php echo $cont ?>]" value="<?php echo $value["id"] ?>">
								<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $value["codigo"] ?>">
								<td class="Estilo1mc" colspan="2"><?php echo $value["bien"] ?></td>
							</tr>
						<?php endforeach ?>

						<tr>
							<td class="Estilo1" colspan="4"><center><button>PRE-CARGAR <i class="fa fa-cog"></i></button></center></td>
						</tr>
					</table>
					<input type="hidden" name="totalElementos" value="<?php echo $cont ?>">
					<input type="hidden" name="trasladoRegionDestino" value="<?php echo $traslado_region ?>">
					<input type="hidden" name="trasladoRegionOrigen" value="<?php echo $region ?>">
					<!-- <input thidden"text" name="trasladoFecha" value="<?php echo $traslado_fecha ?>"> -->
					<!-- <input type="text" name="trasladoResolucion" value="<?php echo $traslado_resolucion ?>"> -->
					<input type="hidden" name="emisor" value="<?php echo $_SESSION["nombrecom"] ?>">
				</form>

			</div>

			<script type="text/javascript">

			jQuery('.popup').click(function(e){
			e.preventDefault();
			window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=900, height=350, top=100, left=200, toolbar=1');
		});

				function valida()
				{
					if($("#responsa").val() == "")
					{
						alert("SELECCIONE EL CENTRO DE RESPONSABILIDAD");
						$("#responsa").focus();
						return false;

					}else if($("#inv_zona").val() == "")
					{
						alert("SELECCIONE LA ZONA");
						$("#inv_zona").focus();
						return false;

					}else if($("#nro_guia").val() == "")
					{
						alert("INGRESE EL NUMERO DE GUIA");
						$("#nro_guia").focus();
						return false;
					}else if($("#obs").val() == "")
					{
						alert("INGRESE UNA OBSERVACION");
						$("#obs").focus();
						return false;
					}else{
						if(confirm("¿ ESTA SEGURO DE PROCEDER CON LA CARGA DE DATOS ?"))
						{
							blockUI();
							return true;
						}else{
							return false;
						}
					}
				}

				function getSubZona(input) {

					var data = ({command : "getSubZona", zona_id : input});
					$.ajax({
						type:"POST",
						url:"inv_getsubzona.php",
						data:data,
						dataType:"JSON",
						cache:false,
						success:function(response) {
							console.log(response);
							$("#inv_zona").val(response[1].comuna);
							var resp = "";
							resp +="<option selected value=''>Seleccionar</option>";
							$.each(response,function(index,value){
								resp +="<option value='"+value.subzona+"'>"+value.subzona+"</option>";
							});
							$("#inv_zona").html(resp);
						}
				});
			}
		</script>
	</body>
	</html>