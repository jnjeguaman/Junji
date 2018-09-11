<?php
session_start();
require("inc/config.php");

mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
//include("Includes/FusionCharts.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$fechamia2=date('d-m-Y');
$hora=date("H:i");
extract($_GET);
extract($_POST);



?>

<script>
	<!--
	function abreVentana2(id,numerooc,ori,doc_id){
		miPopup = window.open("bode_subirarchivo2.php?id="+id+"&numerooc="+numerooc+"&ori="+ori+"&doc_id="+doc_id,"miwin","width=500,height=200,scrollbars=yes,toolbar=0")
		miPopup.focus()
	}

-->
</script>
<div id="seccion1" style="background-color:#E0F8E0;" >
	
	<!-- Recupera los INGRESOS PARA HACER LA RECEPCION TECNICA	-->
	<?
	
		//$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 ";
			//$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_ing_id = $ing_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 ";
	$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_ing_id = $ing_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id AND (y.ing_guianumerotc=0 OR x.ding_cant_rechazo > 0)";
	$res2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($res2);
	$uno=$row2['ing_id'];

	/* Prueba */
			//echo "<br>";
	$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where x.ding_ing_id = $ing_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and a.doc_id = x.ding_prod_id and y.ing_guianumerotc = ''";
	//echo $sql2;
	$sql2 = mysql_query($sql2);
		  //echo mysql_num_rows($sql2);
	/**********/
	if ($ing_id<>'' AND mysql_num_rows($sql2) > 0) {
		?>

		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">Generacion de guia </td>
			</tr>
			<tr>
				<td class="Estilo2">Id Ing. </td>
				<td class="Estilo2">N° Guia </td>
				<td class="Estilo2">Especificacion </td>
				<td class="Estilo2">Cantidad </td>
				<td class="Estilo2">Nro. OC</td>
				<td class="Estilo2">Glosa</td>
				<td class="Estilo2">Sel</td>
			</tr>
			<?

			$ing = "SELECT MAX(ing_id) as ing_id FROM bode_ingreso WHERE ing_oc_id = ".$oc_id;
		   //echo $ing;
			$ing = mysql_query($ing,$dbh);
			$ing = mysql_fetch_array($ing);
			$ing = $ing["ing_id"];
		   //echo $ing;

			//echo "<br>";
			//$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where y.ing_oc_id = $oc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0";
			$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where y.ing_oc_id = $oc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 AND a.doc_id = x.ding_prod_id AND (y.ing_estado = 1 OR y.ing_estado = 2)";
			//echo $sql2;
//			$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where x.ding_ing_id = $ing and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and a.doc_id = x.ding_prod_id and y.ing_guianumerotc=0 ";
		  //$sql2 = "SELECT * FROM bode_ingreso a INNER JOIN bode_detingreso b ON a.ing_id = b.ding_ing_id INNER JOIN bode_orcom c ON a.ing_oc_id = c.oc_id INNER JOIN bode_detoc d ON d.doc_id = b.ding_prod_id WHERE a.ing_id = ".$ing_id." AND b.ding_cantidad > 0";
//		    $sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = 8 and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and x.ding_userf='' and ding_region_id='$regionsession'	";
//		    $sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = '0' and y.ing_oc_id=z.oc_id ";
//		    $sql2 = "SELECT * FROM bode_ingreso x, bode_detoc, bode_orcom where ing_oc_id = $oc_id ";
			//echo $sql2;
			$res2 = mysql_query($sql2);
			$sw_color=0;
			while ($row2 = mysql_fetch_array($res2)) {

				$v_ing_id           = $row2['ing_id'];	
				$v_ing_guia	        = $row2['ing_guia'];
				$v_ing_oc_id        = $row2['ing_oc_id'];	
				$v_ing_fecha        = $row2['ing_fecha'];	
				$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];

				$v_ding_cantidad          = $row2['ding_cantidad']-$row2['ding_cant_rechazo'];
				$v_ding_id          = $row2['ding_id'];


				$v_oc_id	            = $row2['oc_id'];
				$v_oc_id2	            = $row2['oc_id2'];
				$v_oc_region	        = $row2['oc_region'];
				$v_oc_nombre_oc	        = $row2['oc_nombre_oc'];
				$v_oc_prog_id	        = $row2['oc_prog_id'];
				$v_oc_fecha	            = $row2['oc_fecha'];
				$v_oc_fecha_recep	    = $row2['oc_fecha_recep'];
				$v_oc_recibido_usu_id	= $row2['oc_recibido_usu_id'];
				$v_oc_proveerut	        = $row2['oc_proveerut'];
				$v_oc_proveedig         = $row2['oc_proveedig'];
				$v_oc_observaciones	    = $row2['oc_observaciones'];
				$v_oc_estado            = $row2['oc_estado'];

				$v_pro_rut              = $row2['pro_rut'];
				$v_pro_glosa            = $row2['oc_proveenomb'];

				$v_fentrega				= $row2["ding_fentrega"];
				$v_doc_glosa			= $row2["doc_especificacion"];

				if ($sw_color==0){
					$estilo2 = "Estilo1mc";
					$sw_color = 1;
				}else{
					$estilo2 = "Estilo1mcblanco";
					$sw_color = 0;
				}

				?>

				<tr>
					<td class="<? echo $estilo2 ?>"><? echo $v_ing_id       ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo $v_ing_guia     ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo $v_doc_glosa    ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo $row2["ding_cant_final"]   ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo $v_oc_id ?> </td>
				</tr>



				<? } ?>

			</table>

			<br>
			<form action="bode_guia_despacho_gr2.php" method="POST">
				<table border="0">
					<tr>
						<td class="Estilo1">FECHA EMISION</td>
						<td colspan="2" class="Estilo1"><input type="text" readonly name="emision" id="emision" size="8" value="<?php echo $v_fentrega ?>" style="background-color: rgb(235, 235, 228)"></td>
					</tr>
					<tr>
						<td class="Estilo1">EMISOR</td>
						<td colspan="2" class="Estilo1"><input type="text" name="emisor" id="destinatario"  value="<?php  echo $_SESSION["nombrecom"] ?>" size="40" readonly style="background-color: rgb(235, 235, 235)"/></td></td>
					</tr>
					<tr>
					<td></td>
						<td><input type="submit" value="Cerrar guia" id="btnCerrar" onClick="oculta()"></td>
					</tr>
				</table>
				<input type="hidden" name="id" value="<?php echo $_REQUEST["oc_id"] ?>">
				<input type="hidden" name="ing_id" value="<?php echo $v_ing_id ?>">
				<input type="hidden" name="guianumerotc" value="<?php echo $maximo ?>"> 
			</form>
			<hr>
			<?
		}
		?>

		<table border="0"  width="100%">
			<?php
			$ultimas = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc<>'0' AND (y.ing_estado = 1 OR y.ing_estado = 2) group by y.ing_guianumerotc ";
//		$ultimas = "SELECT DISTINCT(ing_guia),ing_guiaabastetc,ing_guiadestinatc,ing_guiaemisortc,ing_guia FROM bode_ingreso WHERE ing_guiafechatc <> ''";

//		echo $ultimas;
			$respUltimas = mysql_query($ultimas,$dbh);
			?>

			<tr>
				<td  class="Estilo2titulo" colspan="10">ÚLTIMAS GUÍAS INGRESADAS</td>
			</tr>
		</table>

		<table border="1" cellpadding="1" cellspacing="1" width="100%">
			<tbody>
				<th class="Estilo1mc">NUMERO GUIA</th>
				<th class="Estilo1mc">FECHA</th>
				<th class="Estilo1mc">EMISOR</th>
				<th class="Estilo1mc">VER</th>
				<th class="Estilo1mc">ARCHIVO</th>
			</tbody>

			<tbody>
				<?php
				while($rowUltimas = mysql_fetch_array($respUltimas)) {
                 //$fechaguia=substr($rowUltimas["ing_guiafechatc"],8,2)."-".substr($rowUltimas["ing_guiafechatc"],5,2)."-".substr($rowUltimas["ing_guiafechatc"],0,4);
					$fechaguia = $rowUltimas["ding_fentrega"];

					if ($rowUltimas["ing_archivotc"]=='') {
						$imagen="punt_rojo.jpg";
						$titulo="Subir Archivo";
						$href="<a href='#' class='link' onclick='abreVentana2(".$rowUltimas["ing_id"].",".$rowUltimas["oc_id"].",".$ori.",".$doc_id.")' title='".$titulo."'>";
					} else {
						$imagen="punt_verde.jpg";
						$titulo="Ver Archivo";
						$href="<a href='../../../".$rowUltimas["ing_rutatc"]."/".$rowUltimas["ing_archivotc"]."' class='link' target='_blank' title='".$titulo."'>";
					}

					?>
					<tr>
						<td class="Estilo1mc"><?php echo $rowUltimas["ing_guianumerotc"] ?></td>
						<td class="Estilo1mc"><?php echo $fechaguia ?></td>
						<td class="Estilo1mc"><?php echo $rowUltimas["ing_guiaemisortc"] ?></td>
						<td class="Estilo1mc"><a href="bode_tca.php?doc_id=<? echo $doc_id ?>&numguia=<?php echo $rowUltimas["ing_guianumerotc"]?>" target="_blank">IMPRIMIR</td>
						<td class="Estilo1mc"><? echo $href ?><img src="images/<? echo $imagen ?>" width="20" height="20" border=0></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>



			<hr>


			<table border="0"  width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="10">Rechazados </td>
				</tr>
				<tr>
					<td class="Estilo2">Id Ing. </td>
					<td class="Estilo2">N° Guia </td>
					<td class="Estilo2">Cantidad </td>
					<td class="Estilo2">Nro. OC</td>
					<td class="Estilo2">Glosa</td>
					<td class="Estilo2">Motivo</td>
					<td class="Estilo2">PDF</td>
				</tr>
				<?
			//$ing = "SELECT MAX(ing_id) as ing_id FROM bode_ingreso WHERE ing_oc_id = ".$oc_id;
		   //echo $ing;
			//$ing = mysql_query($ing,$dbh);
			//$ing = mysql_fetch_array($ing);
			//$ing = $ing["ing_id"];
		   //echo $ing;

		//$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and (x.ding_recep_tecnica = 'A' or x.ding_recep_tecnica = 'R') and x.ding_cant_rechazo>0  and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 ";
		//$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where x.ding_ing_id = ".$_REQUEST["id_ing"]." and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 and a.doc_id = x.ding_prod_id AND a.doc_rechazados <> '0'";
//		   $sql2 = "SELECT * FROM bode_detoc a, bode_orcom b, bode_ingreso c WHERE a.doc_oc_id = ".$oc_id." AND a.doc_rechazados <> 0 AND b.oc_id = a.doc_oc_id AND c.ing_oc_id = b.oc_id";
				$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where  x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and (x.ding_recep_tecnica = 'A' or x.ding_recep_tecnica = 'R') and y.ing_oc_id=z.oc_id and a.doc_id = x.ding_prod_id and x.ding_cant_rechazo <> '0' ";
	//	echo $sql2;
				$res2 = mysql_query($sql2);
				$sw_color=0;
				while ($row2 = mysql_fetch_array($res2)) {

					$v_ing_id           = $row2['ing_id'];
					$v_ing_guia	        = $row2['ing_guia'];
					$v_ing_oc_id        = $row2['ing_oc_id'];
					$v_ing_fecha        = $row2['ing_fecha'];
					$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];

					$v_ding_cantidad          = $row2['ding_cantidad'];
					$v_ding_id          = $row2['ding_id'];


					$v_oc_id	            = $row2['oc_id'];
					$v_oc_id2	            = $row2['oc_id2'];
					$v_oc_region	        = $row2['oc_region'];
					$v_oc_nombre_oc	        = $row2['oc_nombre_oc'];
					$v_oc_prog_id	        = $row2['oc_prog_id'];
					$v_oc_fecha	            = $row2['oc_fecha'];
					$v_oc_fecha_recep	    = $row2['oc_fecha_recep'];
					$v_oc_recibido_usu_id	= $row2['oc_recibido_usu_id'];
					$v_oc_proveerut	        = $row2['oc_proveerut'];
					$v_oc_proveedig         = $row2['oc_proveedig'];
					$v_oc_observaciones	    = $row2['oc_observaciones'];
					$v_oc_estado            = $row2['oc_estado'];

					$v_pro_rut              = $row2['pro_rut'];
					$v_pro_glosa            = $row2['oc_proveenomb'];

					$v_fentrega				= $row2["ding_fentrega"];

					if ($sw_color==0){
						$estilo2 = "Estilo1mc";
						$sw_color = 1;
					}else{
						$estilo2 = "Estilo1mcblanco";
						$sw_color = 0;
					}

					?>

					<tr>
						<td class="<? echo $estilo2 ?>"><? echo $v_ing_id       ?> </td>
						<td class="<? echo $estilo2 ?>"><? echo $v_ing_guia     ?> </td>
						<td class="<? echo $estilo2 ?>"><? echo $row2['ding_cant_rechazo']   ?> </td>
						<td class="<? echo $estilo2 ?>"><? echo $v_oc_id2   ?> </td>
						<td class="<? echo $estilo2 ?>"><? echo $row2["doc_especificacion"] ?> </td>
						<td class="<? echo $estilo2 ?>"><? echo $row2['ding_glosa_rechazo']   ?> </td>
						<td class="<? echo $estilo2 ?>"><a href="bode_imprimerechazo.php?numguia=<?php echo $row2["ing_guianumerorrchzo"] ?>" target ="_blank">IMPRIMIR</a> </td>
					</tr>



					<? } ?>

				</table>



			</body>
			<script type="text/javascript">
				function oculta(){
					blockUI();
					$("#btnCerrar").hide();
				}
			</script>

			</html>
