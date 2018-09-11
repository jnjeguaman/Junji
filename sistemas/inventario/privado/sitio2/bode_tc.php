<?
error_reporting(0);
//$usuario=$_SESSION["nom_user"];
require("inc/config.php");
//require "conversor.php";

$numguia=$_GET["numguia"];
$doc_id=$_GET["doc_id"];

/*
$sql="select * from compra_orden where oc_id=$id ";
//echo $sql;
$res3 = mysql_query($sql);
$row3 = mysql_fetch_array($res3);
$ocfechacompra=$row3["oc_fechacompra"];
$ocmoneda=$row3["oc_moneda"];
$swiva=$row3["oc_swiva"];
$octotal=$row3["oc_total"];
$ocretencion=$row3["oc_retencion"];

$ocfechacompra=substr($ocfechacompra,8,2)."-".substr($ocfechacompra,5,2)."-".substr($ocfechacompra,0,4);
*/


?>
<style type="text/css">
	body{
		margin: 15px 40px;
	}
	table{
		text-align:center;
	}
	th{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:8px;
	}
	.Estilo1{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:7px;
	}
	.Estilo1b{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:10px;
	}
	.Estilo1c{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:10px;
	}
	.Estilo1c3{
		text-align:right;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:12px;
	}

	.Estilo1b2{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:10px;
	}
	.Estilo1b3{
		text-align:left;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:12px;
	}


	h1{
		color:#0033CC;
		text-align:center;
		/*font-style:italic;*/
		font-weight:bold;
		border-bottom:#003366 solid 3px;
	}


</style>
<body>
	<table border="0"   width="500">
		<tr>
			<td rowspan="4" align="left"><img src="oficialjunji.png" width="140" heigth="80" border="0"></td>
			<td rowspan="4" valign="MIDDLE" align="center" width="350">
				JUNTA NACIONAL DE JARDINES INFANTILES <br>
				CONTROL DE CALIDAD <br>
				COMPROBANTE DE RECEPCION TECNICA<br>
				N&deg; Guia : <? echo $tipo2; ?> N&deg;: <? echo $numguia; ?>
			</td>
		</tr>
	</table>

	<?

//$sql5="SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc='$numguia' group by y.ing_guianumerotc";
//$sql5="SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc='$numguia'";
	$sql5="SELECT SUM(ding_cantidad) as ding_cantidad, ding_cant_rechazo,doc_especificacion, doc_region, ding_fentrega,oc_proveenomb, oc_id2, oc_prog, ing_guiaemisortc,ing_guia,oc_monto,doc_unit,doc_umedida,ding_recep_tecnica,ing_aprobado,ing_region,ding_ubicacion FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc='$numguia' AND a.doc_id = x.ding_prod_id AND x.ding_estado = 1 GROUP BY a.doc_especificacion";
// echo $sql5;
	$res5 = mysql_query($sql5);
	$row5 = mysql_fetch_array($res5);
//$fechaguia=substr($row5["ing_guiafechatc"],8,2)."-".substr($row5["ing_guiafechatc"],5,2)."-".substr($row5["ing_guiafechatc"],0,4);
		//$fechaguia = $row5["ding_fentrega"];
       $fechas = explode("-", $row5["ding_fentrega"]);
       $fechaguia=$fechas[2]."-".$fechas[1]."-".$fechas[0];

	$ocid=$row5["oc_id"];
	if ($row5["ding_recep_tecnica"]=='A') {
		$guiaestado="ACEPTADA";
	} else {
		$guiaestado="RECHAZADA";
	}

	?>

	<br>
	<br>

	<table width="500" border="1">
		<tr>
			<td class="Estilo1b3" width="150">Fecha Recepci&oacute;n</td>
			<td class="Estilo1b3"><? echo $fechaguia ?></td>
		</tr>
		<tr>
			<td class="Estilo1b3" >Estado</td>
			<td class="Estilo1b3"><? echo $guiaestado ?></td>
		</tr>

		<tr>
			<td class="Estilo1b3" width="150">Proveedor</td>
			<td class="Estilo1b3"><? echo $row5["oc_proveenomb"]; ?></td>
		</tr>
		<tr>
			<td class="Estilo1b3">Orden de Compra</td>
			<td class="Estilo1b3"><? echo $row5["oc_id2"]; ?> </td>
		</tr>
		<tr>
			<td class="Estilo1b3">Programa</td>
			<td class="Estilo1b3"><? echo $row5["oc_prog"]; ?> </td>
		</tr>
		<tr>
			<td class="Estilo1b3">Revisado por</td>
			<td class="Estilo1b3"><? echo utf8_decode($row5["ing_guiaemisortc"]); ?> </td>
		</tr>

		<tr>
			<td class="Estilo1b3">Numero guia Proveedor</td>
			<td class="Estilo1b3"><? echo $row5["ing_guia"]; ?> </td>
		</tr>

	</table>
	<br>
	<br>
	<table  border="1" width="100%">
		<tr height="20">
			<th class="Estilo1b3">REGION</th>
			<th class="Estilo1b3">DESCRIPCION DEL BIEN</th>
			<th class="Estilo1b3">UBICACION</th>
			<th class="Estilo1b3">U.M.</th>
			<th class="Estilo1b3">CANT.</th>
		</tr>


		<?
   //$sql4 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc w where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc<>0 and x.ding_prod_id = w.doc_id";
		$sql4 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc w where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc = '$numguia' and x.ding_prod_id = w.doc_id";
   //echo $sql4;
//   $sql4="SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc w where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and y.ing_guianumerotc='$numguia'  and y.ing_oc_id=z.oc_id and z.oc_id=w.doc_oc_id";
//   $sql4="SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc='$numguia' ";
//   echo $sql4;
		$res4 = mysql_query($sql5);
		while ($row4 = mysql_fetch_array($res4)) {
			$totallinea=$row4["ding_cantidad"]-$row4[1];
			?>
			<tr>
				<td class="Estilo1b3"><center><? echo $row4["doc_region"]; ?></center></td>
				<td class="Estilo1b3"><? echo utf8_decode($row4["doc_especificacion"]); ?></td>
				<td class="Estilo1b3"><center><? echo utf8_decode($row4["ding_ubicacion"]); ?></center></td>
				<td class="Estilo1b3"><center><? echo $row4["doc_umedida"]  ?></center></td>
				<td class="Estilo1c3"><center><? echo number_format($totallinea,0,',','.'); ?></center></td>
			</tr>

			<?
		}


  // $resultado=convertir($bruto);



		?>


	</table>



	<table width="500" border="0">

		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>

		</tr>
		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>

		</tr>
		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>

		</tr>
		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>

		</tr>
		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>

		</tr>
		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>

		</tr>

		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>

		</tr>
		<tr>
			<th class="Estilo1b">
				<?php if($row5["ing_aprobado"] <> "" AND $row5["ing_region"] == 16): ?>
                     				<img src="images/rc_tecnica.png" width="150px">
                     			<?php endif ?>
			</th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b">
				<?php if ($row5["ing_aprobado"] <> ''): ?>
					<?php if($row5["ing_region"] == 16):?>
                     					<img src="images/rc_cyf.png" width="150px">
                     				<?php else: ?>
                     					<img src="images/rc_tecnica.png" width="150px">
                     				<?php endif ?>
				<?php endif ?>
			</th>
		</tr>

		<tr>
			<th class="Estilo1b"><? echo utf8_decode($row5["ing_guiaemisortc"]) ?></th>
			<th class="Estilo1b">
				<?php if ($row5["ing_aprobado"] <> ''): ?>
					<?php echo utf8_decode($row5["ing_aprobado"]) ?>
				<?php endif ?>
			</th>
			<th class="Estilo1b"><br></th>
		</tr>

		<tr>
			<th class="Estilo1b">__________________________</th>
			<th class="Estilo1b">__________________________</th>
			<th class="Estilo1b">TIMBRE</th>
		</tr>

		<tr>
			<th class="Estilo1b"> DOCUMENTO REALIZADO POR</th>
			<th class="Estilo1b"> DOCUMENTO APROBADO POR</th>
			<th class="Estilo1b"  width="200"></th>
		</tr>

		<tr>
			<td colspan="10"><hr></td>
		</tr>
		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
		</tr>

		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
		</tr>
		<tr>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
			<th class="Estilo1b"><br></th>
		</tr>

		<?
		if ($row3["oc_modalidad"]=='Reembolso') {
			?>
			<tr>
				<th class="Estilo1b" colspan=10>

					<table boerder="0">
						<tr><td>

							<table border="1">
								<tr>
									<th class="Estilo1b">Des. Presupuestario</th>
									<th class="Estilo1b">Codigo</th>
									<th class="Estilo1b">Monto</th>
								</tr>

								<?
								$where.=" 1=2 ";
								$sql3="select ocdet_tipo as nombre, ocdet_tipocodigo as codigo ,sum(ocdet_total) as monto from compra_ordendet where $where group by ocdet_tipocodigo ";
//echo $sql3;
								$result3=mysql_query($sql3);
								while ($row3=mysql_fetch_array($result3)) {
									?>
									<tr>
										<td class="Estilo1c3"><? echo $row3["nombre"] ?></td>
										<td class="Estilo1c"><? echo $row3["codigo"] ?></td>
										<td class="Estilo1c"><? echo number_format($row3["monto"],0,',','.'); ?></td>
									</tr>

									<?
								}
								?>
								<tr>
									<td class="Estilo1c3" colspan=3>_______________________________</td>
								</tr>

								<tr>
									<td class="Estilo1c3" colspan=2>Monto Rendicion</td>
									<td class="Estilo1c"><? echo number_format($octotal,0,',','.'); ?></td>
								</tr>


							</table>

						</td>
						<td width="80"></td>
						<td>



							<table border="1">
								<tr>
									<th class="Estilo1b">Des. Contabilidad</th>
									<th class="Estilo1b">Codigo</th>
									<th class="Estilo1b">Monto</th>
								</tr>

								<?
//$where.=" 1=2 ";
//$sql3="select detgasto_tipo as nombre, SUBSTRING(detgasto_tipocodigo2,1,6) as codigo ,sum(detgasto_monto) as monto from ff_detgasto where $where group by SUBSTRING(detgasto_tipocodigo2,1,6)  ";
								$sql3="select ocdet_tipo as nombre, ocdet_tipocodigo2 as codigo ,sum(ocdet_total) as monto from compra_ordendet where $where group by ocdet_tipocodigo2  ";
//echo $sql3;
								$result3=mysql_query($sql3);
								while ($row3=mysql_fetch_array($result3)) {
									?>
									<tr>
										<td class="Estilo1c3"><? echo $row3["nombre"] ?></td>
										<td class="Estilo1c"><? echo $row3["codigo"] ?></td>
										<td class="Estilo1c"><? echo number_format($row3["monto"],0,',','.'); ?></td>
									</tr>

									<?
								}
								?>
								<tr>
									<td class="Estilo1c3" colspan=3>________________________________</td>
								</tr>

								<tr>
									<td class="Estilo1c3" colspan=1>Monto Rendicion</td>
									<td class="Estilo1c"><? echo number_format($octotal,0,',','.'); ?></td>
								</tr>


							</table>





						</th>

					</tr>
					<?
				}
				?>

			</table>





		</body>
