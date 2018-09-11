<?php
$usuario_id = intval($_SESSION["idn"]);
$user = $_SESSION["nom_user"];
if ($sw==1) {
	$sql3 = "update bode_detoc set doc_estadocierre=1 where doc_id=$doc_id";
 	//echo $sql3."<br>";
	mysql_query($sql3);
	$aprobado = "UPDATE bode_ingreso SET ing_aprobado = '".$_SESSION["nombrecom"]."' WHERE ing_oc_id = ".$_REQUEST["oc_id"];
	//echo $aprobado;
	mysql_query($aprobado);

}
?>

<div id="seccion1" style="background-color:#E0F8E0;" >
	<table border=0 width="100%">
		<tr>
			<td  class="Estilo2titulo" colspan="10">RECEPCIONES PENDIENTES</td>
		</tr>

		<form method="get" action="bode_inv_indexoc2.php" name="filtrorecepcion">

			<tr>
				<td  class="Estilo2" colspan="10">
					Orden de Compra
					<input type="text" name="oc" value="<? echo $oc ?>" >
				</td>
			</tr>
			<tr>
				<td  class="Estilo2" colspan="10">
					Tipo de Filtro
					<input type="radio" name="swtipo" value="0" <? if ($swtipo=="0") { echo "checked"; } ?>> <label>Todos</label>
					<input type="radio" name="swtipo" value="1" <? if ($swtipo=="1") { echo "checked"; } ?>> <label>Negro Mayores a <? echo $plabode1 ?> Dias</label>
					<input type="radio" name="swtipo" value="2" <? if ($swtipo=="2") { echo "checked"; } ?>><font color="#088A08"> Verde Entre  <? echo $plabode1 ?> a <? echo $plabode2 ?> Dias   </font>
					<input type="radio" name="swtipo" value="3" <? if ($swtipo=="3") { echo "checked"; } ?>><font color="#2E2EFE"> Azul Entre <? echo $plabode2 ?> a <? echo $plabode3 ?> Dias </font>
					<input type="radio" name="swtipo" value="4" <? if ($swtipo=="4") { echo "checked"; } ?>><font color="#deaf00"> Rojo Entre 0 y <? echo $plabode3 ?> Dias </font>
					<input type="radio" name="swtipo" value="5" <? if ($swtipo=="5") { echo "checked"; } ?>><font color="#FE2E2E"> Fuera de plazo</font>
				</td>
			</tr>

			<tr>
				<td  class="Estilo2" colspan="10">
					<input type="submit" value="Realizar Busqueda" >
					<a href="bode_inv_indexoc2.php?cod=20&limpia=1" class="link" >Limpiar</i></a>
				</td>
			</tr>
			<input type="hidden" name="cod" value="20">

		</form>
		<tr>
			<td  class="Estilo2titulo" colspan="10"><hr></td>
		</tr>

		<tr>
			<td  class="Estilo1mc" colspan=7></td>
			<td  class="Estilo1mc" colspna=1>RECEPCION</td>
			<td  class="Estilo1mc" colspna=1>RECEPCION</td>
			<td  class="Estilo1mc"></td>
		</tr>
		<tr>
			<td  class="Estilo1mc">ID</td>
			<td  class="Estilo1mc">F.ENTREGA</td>
			<td  class="Estilo1mc">N OC / GUIA </td>
			<td  class="Estilo1mc">ESPECIFICACION</td>
			<td  class="Estilo1mc">CANT</td>
			<td  class="Estilo1mc">STOCK</td>
			<td  class="Estilo1mc">RECIBIDO</td>
			<td  class="Estilo1mc">TECNICA</td>
			<td  class="Estilo1mc">CONFORME</td>
			<td  class="Estilo1mc">EST</td>


		</tr>

		<?

		if ($nivel==40) {
			$wherenivel40="  and doc_tecnicos>0 ";
		}
		if ($oc<>'') {
			$whereoc="  and oc_id2 like '%$oc%' ";
		}

		if(intval($_SESSION["region"]) === 16)
		{
			$sql2 = "SELECT * FROM bode_detoc x, bode_orcom y  WHERE (x.doc_region = 16  OR x.doc_region = 13)and x.doc_oc_id=y.oc_id  and (x.doc_estado='' or  x.doc_estado='CO') and x.doc_estadocierre=0 $wherenivel40 $whereoc AND y.oc_estado = 1 AND y.oc_tipo = 0 /*AND x.doc_cantidad = x.doc_recibidos*/ ORDER by doc_id desc limit 0,100";
			//$sql2 = "SELECT * FROM bode_detoc X, bode_orcom Y, bode_ingreso z WHERE (x.doc_region = 16 OR x.doc_region = 13)AND x.doc_oc_id=y.oc_id AND (x.doc_estado='' OR x.doc_estado='CO') AND (x.doc_estadocierre=0 OR x.doc_estadocierre=1) AND z.ing_oc_id = y.oc_id ORDER BY doc_id DESC LIMIT 0,200";
			//$sql2 = "SELECT * FROM bode_detoc x, bode_orcom y, bode_ingreso z WHERE (x.doc_region = 16 OR x.doc_region = 13)AND x.doc_oc_id=y.oc_id AND (x.doc_estado='' OR x.doc_estado='CO') AND (x.doc_estadocierre=0 OR x.doc_estadocierre=1) ORDER BY doc_id DESC LIMIT 0,200";
			//$sql2 = "SELECT * FROM bode_detoc x, bode_orcom y, bode_ingreso z WHERE (x.doc_region = 16 OR x.doc_region = 13)AND x.doc_oc_id=y.oc_id AND (x.doc_estado='' OR x.doc_estado='CO') AND (x.doc_estadocierre=0 OR x.doc_estadocierre=1) GROUP BY x.doc_id DESC LIMIT 0,200";
			//$sql2 = "SELECT * FROM bode_detoc X, bode_orcom Y WHERE (x.doc_region = 16 OR x.doc_region = 13)AND x.doc_oc_id=y.oc_id AND (x.doc_estado='' OR x.doc_estado='CO') AND (x.doc_estadocierre=0 OR x.doc_estadocierre=1) ORDER BY x.doc_id DESC LIMIT 0,200";

			//echo $sql2;

		}else{
			$sql2 = "SELECT * FROM bode_detoc x, bode_orcom y  WHERE x.doc_region = ".$_SESSION["region"]." and x.doc_oc_id=y.oc_id  and (x.doc_estado='' or  x.doc_estado='CO') and x.doc_estadocierre=0 $wherenivel40 $whereoc  AND (y.oc_tipo = 0 OR y.oc_tipo = 1) ORDER by doc_id desc limit 0,100";
			/*$res1 = mysql_query($sql2);

			if(mysql_num_rows($res1) > 0)
			{
				$sql2 = "SELECT * FROM bode_detoc x, bode_orcom y, bode_ingreso z WHERE x.doc_region = ".$_SESSION["region"]." AND x.doc_oc_id=y.oc_id AND (x.doc_estado='' OR x.doc_estado='CO') AND (x.doc_estadocierre=0 OR x.doc_estadocierre=1) ORDER BY doc_id DESC LIMIT 0,200";
			}else{
				$sql2 = "SELECT * FROM bode_detoc x, bode_orcom y  WHERE x.doc_region = ".$_SESSION["region"]." and x.doc_oc_id=y.oc_id  and (x.doc_estado='' or  x.doc_estado='CO') and x.doc_estadocierre=0 $wherenivel40 $whereoc  ORDER by doc_id desc limit 0,200";
			}*/
		}
//		                                $sql2 = "SELECT * FROM bode_orcom WHERE oc_region = ".$_SESSION["region"]." ORDER by oc_id desc limit 0,200";
//                                         echo $sql2."<br>";
//										$sql2 = "SELECT * FROM acti_compra_temporal WHERE (estado = 0 or estado=1) ORDER by compra_id desc limit 0,20";
		$res2 = mysql_query($sql2);
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
                                           //echo " $plabode1>=$diff and $diff>$plabode2 ";
			$color="";


			$filtroplazo="";
			$swcolor=1;
//                                           echo "$plabode1>=$diff and $diff>$plabode2 <br>";
										if($plabode1>=$diff and $diff>$plabode2) {
                                              $color="#088A08";//Verde
                                              $swcolor=2;
//                                              $filtroplazo=" and ($plabode1>=DATEDIFF('$fechahoy','$fechabase') and $plabode2<=DATEDIFF('$fechahoy','$fechabase');
                                          }
                                          if($plabode2>=$diff and $diff>$plabode3) {
                                              $color="#2E2EFE";//Azul
                                              $swcolor=3;
                                          }
                                          if($plabode3>=$diff and $diff >= 0) {
                                              $color="#deaf00";//Marrón
                                              $swcolor=4;
                                          }

                                          if($diff <= -1)
                                          {
                                          	$color="#FE2E2E";//Rojo
                                          	$swcolor=5;
                                          }
                                          
											$background = "style='background:lightgreen;'";
                                            //echo $fechahoy."--".$fechabase." $diff <br>";
                                          if ($swcolor==$swtipo or $swtipo=='' or $swtipo=='0') {
                                          	?>
                                          	<tr class="trh <?php echo $estilo2 ?>" <?php if($row2["doc_id"] === $doc_id){echo $background;} ?>>
                                          		<td><font color="<? echo $color?>"> <? echo $row2["doc_id"] ?></font></td>
                                          		<td><font color="<? echo $color?>"><? echo $diff." ".$row2["oc_fecha"] ?></font></td>
                                          		<td><font color="<? echo $color?>"><? echo $row2["oc_tipo"] == 0 ? $row2["oc_id2"] : $row2["oc_folioguia"] ?></font></td>
                                          		<td><font color="<? echo $color?>"><? echo $row2["doc_especificacion"] ?></font></td>
                                          		<td><? echo $row2["doc_cantidad"] ?></td>
                                          		<td><? echo $row2["doc_stock"] ?></td>
                                          		<td>
                                          			<?
                                          			echo $row2["doc_recibidos"];
                                          			if ($row2["doc_stock"]< $row2["doc_cantidad"] and $nivel<>40 && $nivel <> 47)  {
                                          				?>
                                          				<?php if ($row2["doc_recibidos"] <> $row2["doc_cantidad"]): ?>
                                          					<a href="bode_inv_indexoc2.php?ori=3&id=<? echo $row2["oc_id"] ?>&total=<?php echo $row2["compra_cantidad"] ?>&doc_id=<? echo $row2["doc_id"] ?>" class="link"><i class="fa fa-plus"></i></a>
                                          				<?php endif ?>
                                          				<?
                                          			}
                                          			?>
                                          		</td>
                                          		<td  >
                                          			<?
                                          			echo $row2["doc_tecnicos"];
                                          			$ojo="";
                                          			//$sql2b = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = ".$row2["doc_id"]." and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 $filtroplazo ";
                                          			$sql2b = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = ".$row2["doc_id"]." and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id $filtroplazo ";
                                          			//echo $sql2b;
                                          			  //$sql2b = "SELECT * FROM bode_detoc x, bode_orcom y WHERE (x.doc_region = 16 OR x.doc_region = 13)AND x.doc_oc_id=y.oc_id AND (x.doc_estado='' OR x.doc_estado='CO') AND (x.doc_estadocierre=0 OR x.doc_estadocierre=1) ORDER BY x.doc_id DESC LIMIT 0,200";
//		echo $sql2b;
                                          			$res2b = mysql_query($sql2b);
                                          			$row2b = mysql_fetch_array($res2b);
                                          			$unob=$row2b['ing_guianumerotc'];
//        echo "-->".$unob;

                                          			if ($unob<'0' and $unob<>'') {
                                          				$ojo="<i class='fa fa-bars'></i>";
                                          			}
                                          			if ($unob=='0' /*AND $row2b["ing_recib_usu_id"] <> "INEDIS"*/) {
                                          				$ojo="<i class='fa fa-eye'></i>";
                                          			}

                                          			?>
                                          			<?php if($user == "fnmunoz" || $user = "sebastian" || $user == "mcantillana" || $user== "dvaldes" || $user == "casoto"): ?>
                                          				<?php if ($nivel <> 47): ?>
                                          					<a href="bode_inv_indexoc2.php?ori=4&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?>" class="link"><i class="fa fa-plus"></i> <? echo $ojo ?></a>
                                          				<?php endif ?>

                                          			<?php else: ?>
                                          				<a href="bode_inv_indexoc2.php?ori=4&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?>" class="link"><i class="fa fa-plus"></i> <? echo $ojo ?></a>
                                          			<?php endif ?>
                                          			<?
                                          			if ($row2["doc_rechazados"]<>0) {
                                          				echo $row2["doc_rechazados"];
                                          			}
                                          			?>

                                          		</td>
                                          		<td  >
                                          			<?php echo $row2["doc_final"]; ?>
                                          			<?php if ($_SESSION["region"] == 16): ?>
                                          				<?php if ($nivel<>40 AND $user == "sebastian" || $user == "mcantillana" || $user== "dvaldes" || $user == "paguirre" || $user == "casoto"): ?>
                                          					<?php if ($nivel <> 47): ?>
                                          						<a href="bode_inv_indexoc2.php?ori=6&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?>&total=<?php echo $row2["compra_cantidad"] ?>" class="link"><i class="fa fa-plus"></i></a>
                                          					<?php endif ?>

                                          				<?php endif ?>
                                          			<?php else: ?>
                                          				<a href="bode_inv_indexoc2.php?ori=6&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?>&total=<?php echo $row2["compra_cantidad"] ?>" class="link"><i class="fa fa-plus"></i></a>
                                          			<?php endif ?>
                                          		</td>
                                          		<?php
                                          		$totalrecibidos=$row2["doc_cantidad"];
//                                          		$totalrecibidos=$row2["doc_cantidad"]+$row2["doc_rechazados"];
                                          		//echo $totalrecibidos;
                                          		if ($row2["doc_recibidos"]==$totalrecibidos AND $row2["doc_cantidad"] == $row2["doc_stock"] and $row2["doc_tecnicos"]==0 and $row2["doc_final"]==0  AND ($user === "mcantillana" || $user=== "dvaldes" || $user === "sebastian")):
//                                          		if ($row2["doc_recibidos"]==$totalrecibidos AND $row2["doc_cantidad"] == $row2["doc_stock"] and $row2["doc_tecnicos"]==0 and $row2["doc_final"]==0  AND $usuario_id === 367 || $usuario_id=== 369 || $usuario_id === 47):
                                          			?>
                                          		<td  >
                                          			<a href="bode_inv_indexoc2.php?cod=20&sw=1&doc_id=<? echo $row2["doc_id"] ?>&oc_id=<?php echo $row2["doc_oc_id"] ?>" class="link" onClick="return confirm('Seguro que desea Cambiar Estado ?')" ><i class="fa fa-check"></i></a>
                                          		</td>
                                          	<?php else: ?>
                                          		<td  ><i class="fa fa-warning fa-lg"></i></td>
                                          	<?php endif ?>


                                          </tr>

                                          <?

                                          $cont++;
                                      }
                                  }
                                  ?>

                              </table>
                          </div>
