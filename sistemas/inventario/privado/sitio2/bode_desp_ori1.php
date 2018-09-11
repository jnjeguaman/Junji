<?php

if (!isset($_GET['page'])) {
	$page="";
}
if (!isset($_POST['n_guia'])) {
	$n_guia="";
}
if (!isset($_POST['f_emision'])) {
	$f_emision="";
}
if (!isset($_POST['mes'])) {
	$mes="";
}
if (!isset($_POST['destino'])) {
	$destino="";
}
if (!isset($_POST['finicio'])) {
	$finicio="";
}
if (!isset($_POST['ftermino'])) {
	$ftermino="";
}
if (!isset($_POST['inicio'])) {
	$inicio="";
}
if (!isset($_POST['termino'])) {
	$termino="";
}
if (!isset($_POST['cont'])) {
	$cont="";
}
if (!isset($_POST['guia'])) {
	$guia="";
}
if (!isset($_POST['nmatriz'])) {
	$nmatriz="";
}
if (!isset($_POST['finterno'])) {
	$finterno="";
}
if (!isset($_POST['totalElementos'])) {
	$totalElementos="";
}
$where="";


if($submit == "lista")
{
	for ($i=1; $i <= $totalElementos; $i++) { 
		if($var1[$i] <> "")
		{
			if(existe($var1[$i])){
				// echo "Ya existe en la lista el id : ".$var1[$i].",correspondiente al folio n° : ".$var3[$i]."<br>";
			}else{
				// echo "Agregando id : ".$var1[$i].", correspondiente al folio n° : ".$var3[$i]."<br>";
				$_SESSION["lista"][] =  array("oc_id" => $var1[$i],"oc_folioguia" => $var3[$i],"oc_guiadestina" => $var2[$i]);
			}
		}
	}
	echo "<script>window.location.href='bode_desp.php?ori=3';</script>";
}

function existe($input)
{

	foreach ($_SESSION["lista"] as $key => $value) {

		if($value["oc_id"] == $input)
		{
			return true;
			break;
		}
	}
}
?>
<div style="width:800px;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
		<table border="1" width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="4">BUSCADOR DE GUIAS</td>
			</tr>
			<tr>
				<td class="Estilo1mc">N° GUIA</td>
				<td class="Estilo1mc"><input type="text" name="n_guia" value="<?php echo $n_guia ?>"></td>

				<td class="Estilo1mc">FECHA EMISION</td>
				<td class="Estilo1mc">
					<input type="text" name="f_emision" id="f_emision" placeholder="YYYY-MM-DD" value="<?php echo $f_emision ?>">
					<i class="fa fa-calendar fa-lg link" id="f_trigger_c1" style="cursor:pointer;" title="Seleccionar Fecha"></i>
					<script type="text/javascript">
						Calendar.setup({
							inputField     :    "f_emision",
							ifFormat       :    "%Y-%m-%d",
							button         :    "f_trigger_c1",
							align          :    "Bl",
							singleClick    :    true
						});
					</script>
				</td>
			</tr>

			<tr>

			</tr>

			<tr>
				<td class="Estilo1mc">MES</td>
				<td class="Estilo1mc">
					<input type="text" name="mes" id="mes" placeholder="YYYY-MM" value="<?php echo $mes ?>">
					<i class="fa fa-calendar fa-lg link" id="f_trigger_c2" style="cursor:pointer;" title="Seleccionar Fecha"></i>
					<script type="text/javascript">
						Calendar.setup({
							inputField     :    "mes",
							ifFormat       :    "%Y-%m",
							button         :    "f_trigger_c2",
							align          :    "Bl",
							singleClick    :    true
						});
					</script>
				</td>

				<td class="Estilo1mc">DESTINO</td>
				<td class="Estilo1mc"><input type="text" name="destino" value="<?php echo $destino ?>"></td>
			</tr>

			<tr>
				<td class="Estilo1mc">FECHA DE INICIO</td>
				<td class="Estilo1mc">
					<input type="text" name="finicio" id="finicio" placeholder="YYYY-MM-DD" value="<?php echo $finicio ?>">
					<i class="fa fa-calendar fa-lg link" id="f_trigger_c3" style="cursor:pointer;" title="Seleccionar Fecha"></i>
					<script type="text/javascript">
						Calendar.setup({
							inputField     :    "finicio",
							ifFormat       :    "%Y-%m-%d",
							button         :    "f_trigger_c3",
							align          :    "Bl",
							singleClick    :    true
						});
					</script>
				</td>


				<td class="Estilo1mc">FECHA DE TERMINO</td>
				<td class="Estilo1mc">
					<input type="text" name="ftermino" id="ftermino" placeholder="YYYY-MM-DD" value="<?php echo $ftermino ?>">
					<i class="fa fa-calendar fa-lg link" id="f_trigger_c4" style="cursor:pointer;" title="Seleccionar Fecha"></i>
					<script type="text/javascript">
						Calendar.setup({
							inputField     :    "ftermino",
							ifFormat       :    "%Y-%m-%d",
							button         :    "f_trigger_c4",
							align          :    "Bl",
							singleClick    :    true
						});
					</script>
				</td>

			</tr>


			<tr>
				<td class="Estilo1mc">DESDE</td>
				<td class="Estilo1mc"><input type="text" name="inicio" value="<?php echo $inicio ?>"></td>

				<td class="Estilo1mc">HASTA</td>
				<td class="Estilo1mc"><input type="text" name="termino" value="<?php echo $termino ?>"></td>
			</tr>

			<tr>
				<td colspan="4"><center><button type="submit" name="submit" value="buscar">BUSCAR <i class="fa fa-search"></i></button></center></td>
			</tr>
		</table>
		<input type="hidden" name="cod" value="46">
	</form>

	<hr>


	<table border="1" width="100%">
		<tr>
			<td  class="Estilo2titulo" colspan="10">GUIAS EN TRANSITO</td>
		</tr>

		<tr>
			<td  class="Estilo1mc" colspan="5" style="text-align:left"><input type="checkbox" name="toggle" id="toggle"> Seleccionar Todo</td>
			<td colspan="1"></td>
		</tr>

		<tr>
			<td class="Estilo1mc"></td>
			<td class="Estilo1mc">ID</td>
			<td class="Estilo1mc">N° GUIA</td>
			<td class="Estilo1mc">F.DESPACHO</td>
			<td class="Estilo1mc">DESTINO</td>
			<td class="Estilo1mc">DESTINATARIO</td>
			<!-- <td class="Estilo1mc">EDITAR</td> -->
		</tr>

		<form action="bode_desp.php" method="POST" onsubmit="return check()">
			<?php

// 
// 
// 
			if($submit == "buscar")
			{
				if($n_guia <> "")
				{
					$where.= "y.oc_folioguia LIKE '%".$n_guia."%' AND ";
				}
				if($f_emision <> "")
				{
					$where.= "y.oc_fecha = '".$f_emision."' AND ";
				}

				if($finicio <> "")
				{
					$where.="y.oc_fecha >= '".$finicio."' AND ";
				}

				if($ftermino <> "")
				{
					$where.="y.oc_fecha <= '".$ftermino."' AND ";
				}

				if($inicio <> "")
				{
					$where.="y.oc_folioguia >= ".$inicio." AND ";
				}

				if($termino <> "")
				{
					$where.="y.oc_folioguia <= ".$termino." AND ";
				}
				if($mes <> "")
				{
					$fecha = explode("-", $mes);
					$where.= "YEAR(y.oc_fecha) = ".$fecha[0]." AND MONTH(y.oc_fecha) = ".$fecha[1]." AND ";
				}
				if($destino <> "")
				{
					$where.= "y.oc_region = '".$destino."' AND ";
				}

				$sql2 = "SELECT * FROM bode_orcom y WHERE y.oc_region2 = ".$_SESSION["region"]." and $where y.oc_swdespacho='1' AND  y.oc_guiafecha<>'0000-00-00' AND y.oc_observaciones = '' AND y.oc_guiadestina <> 'NULO' ORDER by y.oc_folioguia DESC LIMIT 1500";
				$res2 = mysql_query($sql2);
				$cont=1;
				while ($row2 = mysql_fetch_array($res2)) {
					$estilo=$cont%2;
					if ($estilo==0) {
						$estilo2="Estilo1mc";
					} else {
						$estilo2="Estilo1mcblanco";
					}
					?>

					<tr class="<? echo $estilo2 ?> trh">
						<td><?php echo $cont?><input type="checkbox" name="var1[<?php echo $cont?>]" value="<?php echo $row2["oc_id"]?>"></td>
						<td><? echo $row2["oc_id"] ?></td>
						<td><? echo $row2["oc_folioguia"] ?></td>
						<td><? echo $row2["oc_fecha"] ?></td>
						<td><? echo $row2["oc_region"] ?></td>
						<td><? echo $row2["oc_guiadestina"] ?></td>
						<!--<td><a href="bode_desp.php?id=<? //echo $row2["oc_id"] ?>&ori=1" class="link"><i class="fa fa-pencil-square"></i></a></td>!-->
						<input type="hidden" name="var3[<?php echo $cont ?>]" value="<?php echo $row2["oc_folioguia"]?>">
						<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $row2["oc_guiadestina"]?>">
					</tr>
					<?
					$cont++;
				}
			}
			?>
			<tr>
				<td colspan="7" align="right">
					<?php if (COUNT($_SESSION["lista"]) > 0): ?>
						<button type="button" name="submit" value="ver" onClick="ver()">Ver</button>
					<?php endif ?>
						<button type="submit" name="submit" value="lista">Añadir</button></td>
				</tr>
			</table>
			<input type="hidden" name="totalElementos" value="<?php echo $cont ?>">
			<input type="hidden" name="cod" value="<?php echo $cod ?>">
		</form>
	</div>

	<script type="text/javascript">
		function ver()
		{
			window.location.href="bode_desp.php?ori=3";
		}

		function check()
		{
			var numberOfChecked = $('input:checkbox:checked').length;
			numberOfChecked = parseInt(numberOfChecked);
			if(numberOfChecked == 0)
			{
				alert("DEBE SELECCIONAR ALMENOS 1 GUIA DE LA LISTA");
				return false;
			}
		}
	</script>