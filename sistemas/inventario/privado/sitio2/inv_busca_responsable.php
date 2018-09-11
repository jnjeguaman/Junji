<?php
session_start();
require("inc/config.php");
extract($_GET);
extract($_POST);
$atributo = intval($_SESSION["pfl_user"]);

$zonas = array();
$subzonas = array();
$sqlZona = "SELECT * FROM acti_zona WHERE zona_region = ".$_SESSION["region"];
$sqlZonaResp = mysql_query($sqlZona);

while($row=mysql_fetch_array($sqlZonaResp))
{
	$zonas[] = $row;
}

$sqlSZona = "SELECT * FROM acti_subzona WHERE acti_subzona_region = ".$_SESSION["region"];
$sqlSZonaResp = mysql_query($sqlSZona);
while($row=mysql_fetch_array($sqlSZonaResp))
{
	$subzonas[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>SISTEMA DE INVENTARIO - JUNJI</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<script type="text/javascript" src="librerias/jquery.printPage.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php
		include("inc/menu_1b.php");
		?>
	</div>

	<!-- INVENTARIO !-->
	<div  style="width:800px; background-color:#E0F8E0; position:absolute; top:120px; left:00px;" id="div1">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td  class="Estilo2titulo" colspan="10">BÚSQUEDA DE RESPONSABLE</td>
			</tr>
		</table>
		<br>
		<form action="inv_busca_responsable.php" method="POST">
			<table border="1" width="100%">
				<tr>
					<td  class="Estilo1">NOMBRE RESPONSABLE</td>
					<td  class="Estilo1"><input type="text" name="responsable" id="responsable" class="Estilo2" value="<?php echo $responsable ?>" /></td>

					<td class="Estilo1">DIRECCION</td>
					<td class="Estilo1">
						<select class="Estilo1" id="direccion" name="direccion">
							<option value="">Seleccionar...</option>
							<?php foreach ($zonas as $key => $value): ?>
								<option value="<?php echo $value["zona_glosa"]?>" <?php if($direccion == $value["zona_glosa"]){echo"selected";}?>><?php echo $value["zona_glosa"]?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				
				<tr>
					<td class="Estilo1">ZONA</td>
					<td class="Estilo1">
						<select class="Estilo1" name="zona" id="zona">
							<option value="">Seleccionar...</option>
							<?php foreach ($subzonas as $key => $value): ?>
								<option value="<?php echo $value["acti_subzona_glosa"]?>" <?php if($zona == $value["acti_subzona_glosa"]){echo"selected";}?>><?php echo $value["acti_subzona_glosa"]?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>

				<tr>
					<td  class="Estilo1" colspan="4" style="text-align:center"><input type="submit" name="submit" class="Estilo2" value="    Buscar    " ></td>
				</tr>
			</table>
		</form>
		<br>
		<hr>
		

			<?
			if($atributo === 23)
			{
				$sql2 = "SELECT * FROM acti_inventario WHERE  inv_responsable LIKE '%".$responsable."%' AND inv_estado2 = 1 ORDER by inv_id desc limit 400";
			}else{

				if($responsable <> "")
				{
					$where.="AND inv_responsable LIKE '%".$responsable."%' ";
				}

				if($direccion <> "")
				{
					$where.="AND inv_direccion LIKE '%".$direccion."%' ";
				}
				if($zona <> "")
				{
					$where.="AND inv_zona LIKE '%".$zona."' ";
				}

				// $sql2 = "SELECT * FROM acti_inventario WHERE  inv_region = ".$_SESSION["region"]." AND inv_responsable LIKE '%".$busca_responsable."%' ORDER by inv_id desc limit 50";
				$sql2 = "SELECT * FROM acti_inventario WHERE inv_region = ".$_SESSION["region"]." $where AND inv_estado2 = 1 LIMIT 400";
			}
			$res2 = mysql_query($sql2);

			$cont=1;
			?>
			<table border="0" width="100%">
			<tr>
				<td  class="Estilo2titulo" >RESUMEN DE PRODUCTOS</td>
			</tr>
		</table>
		<br>
		<table border="0" width="100%">
	<tr>
		<td class="Estilo1mcR" colspan="8">
			<form action="inv_pmural_reporte.php" method="POST" id="exportar">
				<input type="hidden" name="qry" id="qry" value="<?php echo $sql2 ?>">
				<a href="#" onClick="exportar()" class="link">EXPORTAR A EXCEL</a>
				<script type="text/javascript">
					function exportar()
					{
						document.getElementById("exportar").submit();
					}
				</script>
			</form>
		</td>
	</tr>
			<tr>
				<td  class="Estilo1mc">CODIGO</td>
				<td  class="Estilo1mc">BIEN</td>
				<td  class="Estilo1mc">COSTO</td>
				<td  class="Estilo1mc">DIRECCION</td>
				<td  class="Estilo1mc">ZONA</td>
				<td  class="Estilo1mc">RESPONSABLE</td>
				<td  class="Estilo1mc">Ver</td>
				<td  class="Estilo1mc">Editar</td>
			</tr>

			<?php
			while ($row2 = mysql_fetch_array($res2)) {
				$p = $row2["inv_responsable"];
				$z = $row2["inv_zona"];
				$d = $row2["inv_direccion"];
				$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
					if ($row2["soli_tipo"]=='Emergencias o Urgencias') {
						$estilo2="Estilo1mcRojo";
					}
				} else {
					$estilo2="Estilo1mcblanco";
					if ($row2["soli_tipo"]=='Emergencias o Urgencias') {
						$estilo2="Estilo1mcblancoRojo";
					}

				}

				

				?>
				<tr class="<?php echo $estilo2 ?> trh">
					<td ><? echo $row2["inv_codigo"] ?></td>
					<td ><? echo $row2["inv_bien"] ?></td>
					<td >$ <? echo number_format($row2["inv_costo"],0,".",".") ?></td>
					<td ><?php echo $row2["inv_direccion"] ?></td>
					<td ><? echo $row2["inv_zona"] ?></td>
					<td ><a href="inv_busca_responsable.php?busca_responsable=<?php echo $row2["inv_responsable"] ?>"><?php echo $row2["inv_responsable"] ?></a></td>
					<td class='Estilo1mc'><a href='/sistemas/inventario/privado/sitio2/acti_ori_1.php?id=<?php echo $row2["inv_id"] ?>' class='ver link'><i class='fa fa-eye'></i></a></td>
					<?php if ($atributo != 23): ?>
						<td class='Estilo1mc'><a href='/sistemas/inventario/privado/sitio2/acti_ori_2.php?id=<?php echo $row2["inv_id"] ?>' class='editar link'><i class='fa fa-pencil-square'></i></a></td>
					<?php else: ?> 
						<td ></td>	
					<?php endif ?>
				</tr>

				<?
				$cont++;
			}
			?>

		</table>
	</div>
</div>
<!-- FIN !-->

<div  style="width:540px; background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">
	<?php $sql = "SELECT COUNT(inv_codigo) AS Total,inv_estadocosto, inv_codigo, inv_bien, inv_costo, inv_obs FROM acti_inventario WHERE inv_region = '".$_SESSION["region"]."' $where GROUP BY inv_bien";
	$sql = mysql_query($sql);
	$mysql_affected_rows = mysql_affected_rows();
	?>
	<?php if ($mysql_affected_rows === 0): ?>
		<table border="1" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td  class="Estilo2titulo" colspan="10"><i class="fa fa-warning"></i> No se han encontrado resultados.</td>
			</tr>
		</table>
	<?php else: ?> 
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td  class="Estilo2titulo" colspan="10">PLANILLA MURAL DE INVENTARIO</td>
			</tr>
		</table>
		<br>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<th class="Estilo1mc">CANTIDAD</th>
				<th class="Estilo1mc">BIEN</th>
				<th class="Estilo1mc">COSTO ADQUISICION</th>
			</thead>

			<tbody>
				<?php $cont = 1;  while ($row = mysql_fetch_array($sql)) { 
						$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
				} else {
					$estilo2="Estilo1mcblanco";
				}
					?>
				<tr class="<?php echo $estilo2 ?> trh">
					<td><?php echo $row["Total"] ?></td>
					<td><?php echo $row["inv_bien"] ?></td>
					<td>$<?php echo number_format($row["inv_costo"],0,".",".") ?></td>

				</tr>
				<?php $cont++;} ?>
				
			</tbody>
		</table>
		<br>
		<?php if ($atributo != 23): ?>
			
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<form action="formulario/index.php" method="POST" target="_blank" onSubmit="return planilla()">
					<tr>
						<td class="Estilo1mc">DEPTO/SECCIÓN/OFICINA</td>
						<td class="Estilo1mc"><input type="text" name="depto" id="depto" class="Estilo1"></td>

						<td class="Estilo1mc">JEFATURA</td>
						<td class="Estilo1mc"><input type="text" name="jefatura" id="jefatura" class="Estilo1"></td>

					</tr>
					<tr>
						<td class="Estilo1mc" colspan="1">DEPENDENCIA</td>
						<td class="Estilo1mc"> 
							<select name="responsa" id="responsa" class="Estilo1">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($zonas as $key => $value): ?>
								<option value="<?php echo $value["zona_glosa"]?>" <?php if($direccion == $value["zona_glosa"]){echo"selected";}?>><?php echo $value["zona_glosa"]?></option>
							<?php endforeach ?>
							</select>
						</td>

						<td class="Estilo1mc">ZONA</td>
						<td class="Estilo1mc">
							<select name="zonas" id="zonas" class="Estilo1">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($subzonas as $key => $value): ?>
								<option value="<?php echo $value["acti_subzona_glosa"]?>" <?php if($zona == $value["acti_subzona_glosa"]){echo"selected";}?>><?php echo $value["acti_subzona_glosa"]?></option>
							<?php endforeach ?>
							</select>
						</td>

					</tr>
					<tr>
						<td class="Estilo1mc" colspan="4">
							<input type="submit" name="grabar" value="GENERAR">
						</td>
					</tr>
					<input type="hidden" name="busca_responsable" value="<?php echo $where ?>">
					<input type="hidden" name="qry" value="<?php echo $sql2 ?>">
					<input type="hidden" name="responsable" value="<?php echo $p ?>">
					<input type="hidden" name="zona" value="<?php echo $z ?>">
					<input type="hidden" name="direccion" value="<?php echo $d ?>">

				</form>
			</table>
		<?php endif ?>

	<?php endif ?>

	<!--!-->
</div>
<?php if ($ori == 1): ?>
	<?php require_once("acti_ori_1.php") ?>
<?php elseif($ori ==2): ?>
	<?php require_once("acti_ori_2.php") ?>
<?php else: ?>

<?php endif ?>
</body>

<script type="text/javascript">
	$(function(){
		$('input').keyup(function()
		{
			$(this).val($(this).val().toUpperCase());
		});
		$(".btnPrint").printPage();
	})

	function getSubZona(input) {
		var data = ({command : "getSubZona", zona_id : input});
		$.ajax({
			type:"POST",
			url:"inv_getsubzona.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success:function(response) {
				var resp = "";
				resp +="<option selected value=''>Seleccionar</option>";
				$.each(response,function(index,value){
					resp +="<option value='"+value.subzona+"'>"+value.subzona+"</option>";
				});
				$("#zonas").html(resp);

			}
		})
	}

	jQuery('.ver').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=600, height=350, top=100, left=200, toolbar=1');

		window.popup.onload = function() {
			window.popup.onbeforeunload = function(){
				window.href.reload();
			}
		}
	});

	jQuery('.editar').click(function(e){
		e.preventDefault();
		window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=600, height=600, top=100, left=200, toolbar=1');
		window.popup.onload = function() {
			window.popup.onbeforeunload = function(){
				window.reload();
			}
		}
	});

	function planilla(){

		if($("#depto").val() == ""){
			alert("INGRESE DEPTO / SECCION / OFICINA");
			document.getElementById("depto").focus();
			return false;
		}else if($("#jefatura").val() == ""){
			alert("INGRESE LA JEFATURA");
			document.getElementById("jefatura").focus();
			return false;
		}else if($("#responsa").val() == ""){
			alert("SELECCIONE LA DEPENDENCIA");
			document.getElementById("responsa").focus();
			return false;
		}else if($("#zonas").val() == ""){
			alert("SELECCIONE LA ZONA");
			document.getElementById("zonas").focus();
			return false;
		}else{
			return confirm("¿ESTÁ SEGURO DE ENVIAR ESTOS DATOS?");
		}
	}
</script>
</html>
