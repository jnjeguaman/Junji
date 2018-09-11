<?php
/*
if(!isset($doc_id))
{
$doc_id = "";
}

if(!isset($swtipo))
{
$swtipo = "";
}
*/
$user = $_SESSION["nom_user"];
if ($sw==1) {
	$sql3 = "update bode_detoc set doc_estadocierre=1 where doc_id=$doc_id";
 	//echo $sql3."<br>";
	mysql_query($sql3);
	$aprobado = "UPDATE bode_ingreso SET ing_aprobado = '".$_SESSION["nombrecom"]."' WHERE ing_oc_id = ".$_REQUEST["oc_id"];
	//echo $aprobado;
	mysql_query($aprobado);
}

// VERIFICAR SU INGRESO A EL SISTEMA
// SE VERIFICA SI EXISTE EN LOGISTICA
$estado="";
if($oc <> "")
{
  $oc1 = "SELECT COUNT(oc_id) as Total FROM bode_orcom WHERE oc_id2 = '".$oc."' AND oc_estado = 1 AND oc_tipo = 0";
  $res1 = mysql_query($oc1,$dbh);
  $row1 = mysql_fetch_array($res1);
  
  if($row1["Total"] == 1)
  {
    $estado = "<i class='fa fa-check'></i>";
  }else{
    // BUSCAMOS EN SIGEJUN
    $oc2 = "SELECT COUNT(oc_id) as Total,oc_tipo2 FROM compra_orden WHERE oc_numero = '".$oc."'";
    $res2 = mysql_query($oc2,$dbh2);
    $row22 = mysql_fetch_array($res2);
    if($row22["Total"] == 1)
    {
      $estado = "O/C ingresada como : ".$row22["oc_tipo2"];
    }else{
      $estado = "<font color='red'>La O/C no ha sido ingresada al sistema. Contactar a adquisiciones.</strong>";
    }
  }
}
?>

<div id="seccion1" style="background-color:#E0F8E0;" >
	<table border=0 width="100%">
		<tr>
			<td  class="Estilo2titulo" colspan="10">RECEPCIONES PENDIENTES</td>
		</tr>

		<form method="get" action="bode_inv_indexoc2.php" name="filtrorecepcion">
			<tr>
				<td  class="Estilo1" colspan="10">ORDEN DE COMPRA <input type="text" name="oc" value="<? echo $oc ?>" >
        <?php echo $estado ?>
				</td>
			</tr>

			<tr>
				<td  class="Estilo1" colspan="10">GUIA DE DESPACHO <input type="text" name="gd" value="<? echo $gd ?>" >
				</td>
			</tr>

			<tr>
				<td  class="Estilo2" colspan="10">
					<table border="0" width="100%">
						<tr>
							<td><input type="radio" name="swtipo" value="0" <? if (isset($swtipo) && ($swtipo=="0" || $swtipo == '')) { echo "checked"; } ?>> <label>Todos</label></td>
							<td><input type="radio" name="swtipo" value="1" <? if (isset($swtipo) && $swtipo=="1") { echo "checked"; } ?>> <label>Negro Mayores a <? echo $plabode1 ?> Dias</label></td>
							<td><input type="radio" name="swtipo" value="2" <? if (isset($swtipo) && $swtipo=="2") { echo "checked"; } ?>><font color="#088A08"> Verde Entre  <? echo $plabode1 ?> a <? echo $plabode2 ?> Dias</font></td>
							<td><input type="radio" name="swtipo" value="3" <? if (isset($swtipo) && $swtipo=="3") { echo "checked"; } ?>><font color="#2E2EFE"> Azul Entre <? echo $plabode2 ?> a <? echo $plabode3 ?> Dias </font></td>
							<td><input type="radio" name="swtipo" value="4" <? if (isset($swtipo) && $swtipo=="4") { echo "checked"; } ?>><font color="#e65c00"> Marrón Entre 0 a <? echo $plabode3 ?> Dias </font></td>
							<td><input type="radio" name="swtipo" value="5" <? if (isset($swtipo) && $swtipo=="5") { echo "checked"; } ?>><font color="#FE2E2E"> Fuera de plazo</font></td>
						</tr>
					</table>

				</td>
			</tr>

			<tr>
				<td  class="Estilo2" colspan="10" style="text-align:center;">
					<button type="submit">BUSCAR <i class="fa fa-search"></i></button>
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
			<td  class="Estilo1mc" colspan=1>RECEPCION</td>
			<td  class="Estilo1mc" colspan=1>RECEPCION</td>
			<td  class="Estilo1mc"></td>
		</tr>
		<tr>
			<td  class="Estilo1mc">ID</td>
			<td  class="Estilo1mc">F.ENTREGA</td>
			<td  class="Estilo1mc">N° OC / GUIA </td>
			<td  class="Estilo1mc">ESPECIFICACION</td>
			<td  class="Estilo1mc">CANT</td>
			<td  class="Estilo1mc">STOCK</td>
			<td  class="Estilo1mc">RECIBIDO</td>
			<td  class="Estilo1mc">TECNICA</td>
			<td  class="Estilo1mc">CONFORME</td>
			<td  class="Estilo1mc">EST</td>


		</tr>

		<?
    $wherenivel40="";
    $whereoc="";
		if ($nivel==40) {
			$wherenivel40="  and doc_tecnicos>0 ";
		}
		if ($oc<>'') {
			$whereoc="  and oc_id2 like '%$oc%' ";
		}

		if($gd <> "")
		{
			$wheredg = "and oc_folioguia LIKE '%$gd%' ";
		}else{
      $wheredg = "and y.oc_tipo = 0";
    }
		if(intval($_SESSION["region"]) === 16)
		{
			$sql2 = "SELECT * FROM bode_detoc x, bode_orcom y  WHERE (x.doc_region = 16  OR x.doc_region = 13)and x.doc_oc_id=y.oc_id  and (x.doc_estado='' or  x.doc_estado='CO') and x.doc_estadocierre=0 $wherenivel40 $whereoc AND y.oc_estado = 1 AND y.oc_tipo = 0 AND oc_usu <> 'INEDIS' AND y.oc_estado = 1/*AND x.doc_cantidad = x.doc_recibidos*/ ORDER by doc_id desc limit 0,100";
			//echo $sql2;

		}else{
			$sql2 = "SELECT * FROM bode_detoc x, bode_orcom y  WHERE x.doc_region = ".$_SESSION["region"]." and x.doc_oc_id=y.oc_id  and (x.doc_estado='' or  x.doc_estado='CO') and x.doc_estadocierre=0 $wherenivel40 $whereoc $wheredg AND oc_usu <> 'INEDIS' AND y.oc_estado = 1 ORDER by doc_id desc limit 0,100";
		}
     //echo $sql2;
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
                                              $color="#088A08";     //Verde
                                              $swcolor=2;
//                                              $filtroplazo=" and ($plabode1>=DATEDIFF('$fechahoy','$fechabase') and $plabode2<=DATEDIFF('$fechahoy','$fechabase');
                                          }
                                          if($plabode2>=$diff and $diff>$plabode3) {
                                              $color="#2E2EFE";    //Azul
                                              $swcolor=3;
                                          }
                                          if($plabode3>=$diff and $diff >= 0) {
                                              $color="#e65c00";     //Marron
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

                                          	$sql3a = "SELECT * FROM bode_detingreso WHERE ding_prod_id = ".$row2["doc_id"]." AND ding_recep_conforme = 'C' AND ding_estado = 1";
                                          	$sql3ares = mysql_query($sql3a);
                                          	$suma = 0; //SUMA DE LA CANTIDAD RECIBIDA
                                          	$suma2 = 0; //SUMA DE INGRESOS CON ARCHIVO ADJUNTO
                                          	$suma3 = 0; //SUMA DE APROBACIONES
                                          	while($resa = mysql_fetch_array($sql3ares))
                                          	{
                                          		$suma += $resa["ding_cantidad"] - $resa["ding_cant_rechazo"];
                                          		$sql3ab = "SELECT * FROM bode_ingreso WHERE ing_estado = 1 AND ing_id = ".$resa["ding_ing_id"];

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
                                            $numeroOC = explode("-",$row2["oc_id2"]);
                                            $prefijo = $numeroOC[0];
                                          	if($suma <> $row2["doc_cantidad"] OR $suma2 <> 0 OR $suma3 <> 0){
                                          		?>
                                          		<tr class="trh <?php echo $estilo2 ?>" <?php if($row2["doc_id"] === $doc_id){echo $background;} ?>>
                                          			<td><font color="<? echo $color?>"> <? echo $row2["doc_id"] ?></font></td>
                                          			<td><font color="<? echo $color?>"><? echo $diff." | ".$row2["oc_fecha"] ?></font></td>
                                          			<td><font color="<? echo $color?>"><? echo $row2["oc_tipo"] == 0 ? $row2["oc_id2"] : $row2["oc_folioguia"] ?></font></td>
                                          			<td><font color="<? echo $color?>"><? echo $row2["doc_especificacion"] ?></font></td>
                                          			<td><? echo $row2["doc_cantidad"] ?></td> <!--CANTIDAD POR RECIBIR DE LA OC!-->
                                          			<td><? echo $row2["doc_stock"] ?></td><!-- CANTIDADES RECEPCIONADAS SATISFACTORIAMENTE !-->
                                          			<td>
                                          				<?
                                                // CANTIDAD RECIBIDA DEL PRODUCTO
                                          				echo ($row2["oc_tipo"] == 0) ? $row2["doc_recibidos"] : $row2["doc_cantidad"];
                                          				if ($row2["doc_stock"] < $row2["doc_cantidad"] and $nivel<>40 && $nivel <> 47)  {
                                          					?>
                                          					<?php if ($row2["doc_recibidos"] <> $row2["doc_cantidad"]): ?>
                                          					<?php if($_SESSION["Acceso"]["acc_recibido"] == 1): ?>
                                          					<?php if ($prefijo != "DTT"): ?>
                                                        <a href="bode_inv_indexoc2.php?ori=3&id=<? echo $row2["oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?>" class="link"><i class="fa fa-plus"></i></a>
                                                    <?php endif ?>
                                          				<?php endif ?>
                                          			<?php endif ?>
                                          			<?
                                          		}
                                          		?>
                                          	</td>
                                          	<td>
                                          		<?
                                                // CANTIDAD QUE ESTA EN REVISION TECNICA
                                          		echo $row2["doc_tecnicos"];
                                          		$ojo="";
                                          			//$sql2b = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = ".$row2["doc_id"]." and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerotc=0 $filtroplazo ";
                                          		$sql2b = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = ".$row2["doc_id"]." and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id $filtroplazo and (y.ing_estado = 1 OR y.ing_estado = 2)";
                                          			// echo $sql2b;
                                          			  //$sql2b = "SELECT * FROM bode_detoc x, bode_orcom y WHERE (x.doc_region = 16 OR x.doc_region = 13)AND x.doc_oc_id=y.oc_id AND (x.doc_estado='' OR x.doc_estado='CO') AND (x.doc_estadocierre=0 OR x.doc_estadocierre=1) ORDER BY x.doc_id DESC LIMIT 0,200";
//		echo $sql2b;
                                          		$res2b = mysql_query($sql2b);
                                          		$row2b = mysql_fetch_array($res2b);
                                          		$unob=$row2b['ing_guianumerotc'];
//        echo "-->".$unob;

                                          		if ($unob<'0' and $unob<>'') {
                                          			$ojo="<i class='fa fa-bars'></i>";
                                          		}
                                          		if ($unob=='0' && $row2b["oc_tipo"] == 0/*AND $row2b["ing_recib_usu_id"] <> "INEDIS"*/) {
                                          			$ojo="<i class='fa fa-eye'></i>";
                                          		}
                                          		?>
                                          		<?php if($_SESSION["Acceso"]["acc_rt"] == 1): ?>

                                          		<?php if ($nivel <> 47): ?>
                                          		<?php if($row2b["oc_tipo"] == 0) :?>
                                                <?php if ($prefijo != "DTT"): ?>
                                          		<a href="bode_inv_indexoc2.php?ori=4&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?><? echo ($row2b["ding_ing_id"] <> 0) ? "&ing_id=".$row2b["ding_ing_id"] : "" ?>" class="link"><i class="fa fa-plus"></i> <? echo $ojo ?></a>
                                            <?php endif ?>
                                          	<?php else: ?>
                                          	<a href="#" class="link"><i class="fa fa-plus"></i> <? echo $ojo ?></a>
                                          <?php endif ?>
                                      <?php endif ?>
                                  <?php endif ?>
                                  <?
                                  if ($row2["doc_rechazados"]<>0) {
                                  	echo $row2["doc_rechazados"];
                                  }
                                  ?>

                              </td>
                              <td><!-- CANTIDAD QUE ESTAN EN LA REVISION FINAL !-->
                              	<?php echo $row2["doc_final"]; ?>
                              	<?php if($_SESSION["Acceso"]["acc_rc"] == 1): ?>
                              	<?php if ($nivel <> 47): ?>
                              	<?php if($row2b["oc_tipo"] == 0) :?>
                                  <?php if ($prefijo != "DTT"): ?>
                              	<a href="bode_inv_indexoc2.php?ori=6&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?>" class="link"><i class="fa fa-plus"></i></a>
                      <?php endif ?>
                              <?php else: ?>
                              <a href="#" class="link"><i class="fa fa-plus"></i> <? echo $ojo ?></a>
                          <?php endif ?>
                      <?php endif ?>

                  <?php endif ?>
              </td>
              <td><font color="red"><i class="fa fa-warning fa-lg"></i></font></td>
          </tr>

          <?
      }else{
      	$color='darkgreen';
      	?>
      	<?php if($oc <> ""): ?>
      	<tr class="trh <?php echo $estilo2 ?>" <?php if($row2["doc_id"] === $doc_id){echo $background;} ?>>
      		<td><font color="<? echo $color?>"> <? echo $row2["doc_id"] ?></font></td>
      		<td><font color="<? echo $color?>"><? echo $diff." | ".$row2["oc_fecha"] ?></font></td>
      		<td><font color="<? echo $color?>"><? echo $row2["oc_tipo"] == 0 ? $row2["oc_id2"] : $row2["oc_folioguia"] ?></font></td>
      		<td><font color="<? echo $color?>"><? echo $row2["doc_especificacion"] ?></font></td>
      		<td><? echo $row2["doc_cantidad"] ?></td>
      		<td><? echo $row2["doc_stock"] ?></td>
      		<td><?php echo $row2["doc_recibidos"]?> </td>
      		<td><a href="bode_inv_indexoc2.php?ori=4&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?><? echo ($row2b["ding_ing_id"] <> 0) ? "&ing_id=".$row2b["ding_ing_id"] : "" ?>" class="link"><i class="fa fa-plus"></i> <? echo $ojo ?></a></td>
      		<td><a href="bode_inv_indexoc2.php?ori=6&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?>" class="link"><i class="fa fa-plus"></i></a></td>
      		<td><font color="<?php echo $color?>"<i class="fa fa-check fa-lg"></i></font></td>
      	</tr>
      <?php endif ?>
      <?php 
  }
  $cont++;
}
}
?>

<tr>
	<td colspan="10" align="right">
		<form action="bode_exportar_pendiente.php" method="POST" id="exportar">
			<input type="hidden" name="qry" id="qry" value="<?php echo $sql2 ?>">
			<input type="hidden" name="swtipo" value="<?php echo $swtipo ?>">
			<input type="hidden" name="swcolor" value="<?php echo $swcolor ?>">
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
</table>
</div>
