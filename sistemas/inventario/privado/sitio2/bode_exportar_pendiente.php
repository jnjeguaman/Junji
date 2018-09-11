<table border=1 width="100%">
	<thead>
		<th>ORDEN DE COMPRA</th>
		<th>GLOSA</th>
		<th>PRODUCTO</th>
		<th>PROVEEDOR</th>
		<th>RUT</th>
		<th>FECHA DE ENTREGA</th>
		<th>DIAS</th>
	</thead>
	<?php
	$filename = "tomaInventario_".Date("YmdHis");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");
	require_once("inc/config.php");
	extract($_POST);

	$sql5="select * from plazos ";
	$res5 = mysql_query($sql5);
	$row5 = mysql_fetch_array($res5);
	$plabode1=$row5["pla_bode1"];
	$plabode2=$row5["pla_bode2"];
	$plabode3=$row5["pla_bode3"];

	$q = trim(str_replace("limit 0,100","",$qry));
	$res2 = mysql_query($q);
	$cont=1;
	while ($row2 = mysql_fetch_array($res2)) {
		$estilo=$cont%2;
		if ($estilo==0) {
			$estilo2="Estilo1mc";
		} else {
			$estilo2="Estilo1mcblanco";
		}

		$fechahoy = date('Y-m-d');;
		$dia1 = strtotime($fechahoy);
		$fechabase =$row2["oc_fecha"];
		$dia2 = strtotime($fechabase);
		$difff=$dia1-$dia2;
		$diff=intval($difff/(60*60*24))*-1;
		$color="";
		$filtroplazo="";
		$swcolor=1;
		if($plabode1>=$diff and $diff>$plabode2) {
			$color="#088A08";
			$swcolor=2;
		}
		if($plabode2>=$diff and $diff>$plabode3) {
			$color="#2E2EFE";
			$swcolor=3;
		}
		if($plabode3>=$diff and $diff >= 0) {
			$color="#e65c00";
			$swcolor=4;
		}
		if($diff <= -1)
		{
			$color="#FE2E2E";
			$swcolor=5;
		}
		if ($swcolor==$swtipo or $swtipo=='' or $swtipo=='0') {

			$sql3a = "SELECT * FROM bode_detingreso WHERE ding_prod_id = ".$row2["doc_id"]." AND ding_recep_conforme = 'C'";
			$sql3ares = mysql_query($sql3a);
			$suma = 0;
			$suma2 = 0;
			$suma3 = 0;
			while($resa = mysql_fetch_array($sql3ares))
			{
				$suma += $resa["ding_cantidad"] - $resa["ding_cant_rechazo"];
				$sql3ab = "SELECT * FROM bode_ingreso WHERE ing_id = ".$resa["ding_ing_id"];

				$sql3abres = mysql_query($sql3ab);
				$resab = mysql_fetch_array($sql3abres);
				if($resab["ing_archivotc"] == "")
				{
					$suma2++;
				}

				if($resab["ing_aprobado"] == "")
				{
					$suma3++;
				}
			}
			if($suma <> $row2["doc_cantidad"] OR $suma2 <> 0 OR $suma3 <> 0){ ?>
				<tr class="<?php echo $estilo2 ?>">
					<td><font color="<? echo $color?>"> <? echo $row2["oc_id2"] ?></font></td>
					<td><font color="<? echo $color?>"> <? echo strtoupper(utf8_decode($row2["oc_nombre_oc"])) ?></font></td>
					<td><font color="<? echo $color?>"> <? echo strtoupper(utf8_decode($row2["doc_especificacion"])) ?></font></td>
					<td><font color="<? echo $color?>"> <? echo $row2["oc_proveenomb"] ?></font></td>
					<td><font color="<? echo $color?>"> <? echo number_format($row2["oc_proveerut"],0,'.','.')."-".$row2["oc_proveedig"] ?></font></td>
					<td><font color="<? echo $color?>"><? echo $row2["oc_fecha"] ?></font></td>
					<td><font color="<? echo $color?>"><? echo $diff ?></font></td>
				</tr>

				<? } $cont++;}}?>
