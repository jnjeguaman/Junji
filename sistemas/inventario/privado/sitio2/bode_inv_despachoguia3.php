<?php 
require_once("inc/config.php");
extract($_GET);
?>
<div style="width:100%; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
<table border="1" width="100%">
<?php 
		//Jardines Asociados
		$sql2 = "SELECT * FROM bode_orcom2 x INNER JOIN jardines y on x.oc_region = y.jardin_codigo inner join bode_masiva c on c.mas_id = x.oc_mas_id WHERE  x.oc_estado=100 and x.oc_mas_id=$masid";
		$res2 = mysql_query($sql2);
		$tJardines = mysql_num_rows($res2);
		$colspan = mysql_num_rows($res2);
		?>
		<tr>
			<td class="Estilo2titulo" colspan="10">GUIAS EN TRANSITO</td>
		</tr>

		<tr>
			<td colspan="2"></td>
			<td class="Estilo1mc" colspan="<?php echo $colspan ?>">JARDIN</td>
		</tr>

		<tr>
			<td colspan="2" class="Estilo1mc">PRODUCTO</td>
			<?php
			$cont=1;
			while ($row2 = mysql_fetch_array($res2)) {
				$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
				} else {
					$estilo2="Estilo1mcblanco";
				}
				?>

				<td  class="<? echo $estilo2 ?>" title="<?php echo $row2["jardin_nombre"]." - ".$row2["jardin_provincia"] ?>">
					<div style="width: 10px; word-wrap: break-word; text-align: center">
						<? //echo $row2["oc_id"] ?>
						<? echo $row2["oc_region"] ?></a>
					</div>
				</td>

				<?
				$arrjandin[$cont]=$row2["oc_region"];
				$cont++;
			}
			?>
			<td class="Estilo1mc">Solicitado</td>
		</tr>

		<?php
		// Productos
		//$sql2 = "SELECT * FROM  bode_detoc2 x WHERE  x.doc_mas_id = $masid order by doc_id desc";
		$sql2 = "SELECT * from bode_detoc_2 a inner join bode_detoc2 b on b.doc_prod_id = a.ddoc_prod_id where a.ddoc_mas_id = ".$masid."";
		$res2 = mysql_query($sql2);
		$cont2=1;
		$col=0;
		while ($row2 = mysql_fetch_array($res2)) {

			$nuevo=$row2["doc_especificacion"];

			if ($nuevo<>$antiguo) {
				$col++;
				$cont2=1;
			}
			$arrid[$col][$cont2]=$row2["ddoc_cantidad"];
			$arrcantidad[$col][$cont2]=$row2["ddoc_cantidad"];
			//$arrcantidad[$col][$cont2]=$row2["doc_cantidad"];
			$antiguo=$row2["doc_especificacion"];
			$cont2++;
		}

		//$sql2 = "SELECT * FROM  bode_detoc2 x inner join bode_detingreso y on y.ding_prod_id = x.doc_origen_id WHERE  x.doc_mas_id =$masid AND y.ding_recep_tecnica = 'A' /*group by x.doc_especificacion*/ ";
		//echo $sql2;
		$res2 = mysql_query($sql2);
		$cont3=1;
		while ($row2 = mysql_fetch_array($res2)) {
			$estilo=$cont2%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}

			?>
			<tr>
				<td  class="<? echo $estilo2 ?>" colspan="2">
					<? echo $row2["oc_id"] ?>
					<? echo $row2["doc_especificacion"] ?>
				</td>
				<?
				$erros = 0;
				$solicitado = 0;
				for ($i=1;$i<$cont;$i++) {
					if($i <= $tJardines)
					{
						$solicitado += $arrcantidad[$cont3][$i];
					}
					
					?>
					<td  class="<? echo $estilo2 ?>">
						<input disabled type="text" size="1" name="arrcantidad[<? echo $cont3 ?>][<? echo $i ?>]" size=6 value="<?php if($arrcantidad[$cont3][$i] == 0) {echo $row2["ddoc_cantidad"];}else{ echo $arrcantidad[$cont3][$i];} ?>">
					</td>

					<?

				}

				$extra ="<td class='".$estilo2."'>".$solicitado."</td>";
				
				echo $extra;
				$cont3++;
			}
			?>
		</tr>
		<tr>
			<td colspan="<?php echo $colspan ?>"></td>
			<td class="Estilo1mc"><button><i class='fa fa-refresh fa-lg'></i></button></td>
			<td class="Estilo1mc"><button><i class='fa fa-pencil fa-lg'></i></button></td>
			<td class="Estilo1mc"><button><i class='fa fa-remove fa-lg'></i></button></td>
		</tr>
</table>
</div>