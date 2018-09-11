	<?php $user = $_SESSION["nom_user"];

/*
	if (!isset($_COOKIE['id'])) {
		$id="";
	}
	if (!isset($_COOKIE['oc'])) {
		$oc="";
	}
	if (!isset($_COOKIE['gd'])) {
		$gd="";
	}
*/
	?>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<div id="seccion1" style="background-color:#E0F8E0;" >

		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">ULTIMAS ORDENES DE COMPRA</td>
			</tr>

			<tr>
				<td  class="Estilo1mc">ID<i class="fa fa-eye"></i></td>
				<td  class="Estilo1mc">Orden de Compra</td>
				<td  class="Estilo1mc">VER</td>
				<td  class="Estilo1mc">EDITAR</td>
				<td  class="Estilo1mc">ESTADO</td>
				<?php if($_SESSION["Acceso"]["acc_anular_oc"] == 1 && 1==2): ?>
					<td class="Estilo1mc">ANULAR</td>
				<?php endif ?>
			</tr>

			<?
			//echo $oc;
			// 542657
			if($oc <> "")
			{
				// $sql2 = "SELECT * FROM bode_orcom y, bode_detoc x WHERE y.oc_region = ".$_SESSION["region"]."  and  y.oc_id=x.doc_oc_id and (x.doc_estadocierre=0 OR x.doc_estadocierre = 1) AND y.oc_estado = 1 AND y.oc_id2 LIKE '%".$oc."%'group by y.oc_id ORDER by oc_id desc limit 0,20";
				if($_SESSION["region"] == 16)
				{
					$sql2 = "SELECT * FROM bode_orcom WHERE (oc_region = 16 OR oc_region = 13) AND oc_tipo = 0 AND oc_estado = 1 AND oc_id2 LIKE '%".$oc."%'";
				}else{
					$sql2 = "SELECT * FROM bode_orcom WHERE oc_region = ".$_SESSION["region"]." AND oc_tipo = 0 AND oc_estado = 1 AND oc_id2 LIKE '%".$oc."%'";
				}
			}else if($gd <> ''){
				$sql2 = "SELECT * FROM bode_orcom WHERE oc_region = ".$_SESSION["region"]." AND oc_tipo = 1 AND oc_estado = 1 AND oc_folioguia LIKE '%".$gd."%'";
				// $sql2 = "SELECT * FROM bode_orcom y, bode_detoc x WHERE y.oc_region = ".$_SESSION["region"]."  and  y.oc_id=x.doc_oc_id and (x.doc_estadocierre=0 OR x.doc_estadocierre = 1) AND y.oc_estado = 1 group by y.oc_id ORDER by oc_id desc limit 0,20";
			}else{
				$sql2 = "SELECT * FROM bode_orcom WHERE oc_region = ".$_SESSION["region"]." AND oc_tipo = 0 AND oc_estado = 1 ORDER BY oc_id DESC LIMIT 20";
			}
			 
			 //echo $sql2;
		                                //$sql2 = "SELECT * FROM bode_orcom y, bode_detoc x WHERE (y.oc_region = ".$_SESSION["region"]."  or y.oc_id2 like '599%')  and  y.oc_id=x.doc_oc_id and (x.doc_estadocierre=0 OR x.doc_estadocierre = 1) group by y.oc_id ORDER by oc_id desc limit 0,200";
			
//		                                $sql2 = "SELECT * FROM bode_orcom y, bode_detoc x WHERE (y.oc_region = ".$_SESSION["region"]."  or y.oc_id2 like '599%')  and oc_swdespacho='1' and  oc_guiafecha<>'0000-00-00' and y.oc_id=x.doc_oc_id and x.doc_estadocierre=0 group by y.oc_id ORDER by oc_id desc limit 0,200";
//                                         echo $sql2."<br>";
//		                                $sql4 = "SELECT * FROM bode_orcom x WHERE x.oc_region = ".$_SESSION["region"]." or x.oc_id2 like '599%' and 0=( SELECT doc_estadocierre FROM bode_detoc y WHERE y.doc_estadocierre = 0 and x.oc_id=y.doc_oc_id group by x.oc_id)  ORDER by x.oc_id desc limit 0,200";
//                                         echo $sql4."<br>";
//										$sql2 = "SELECT * FROM acti_compra_temporal WHERE (estado = 0 or estado=1) ORDER by compra_id desc limit 0,20";
			// echo $sql2;
			$res2 = mysql_query($sql2);
			$cont=1;
			while ($row2 = mysql_fetch_array($res2)) {
				$estilo=$cont%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}

				// //COMPROBAMOS SI LA OC ESTA COMPLETA
				// $sql1 = "SELECT b.doc_id,SUM(b.doc_cantidad) as Suma, COUNT(b.doc_id) as Items FROM bode_orcom a INNER JOIN bode_detoc b ON a.oc_id = b.doc_oc_id GROUP BY b.doc_especificacion";
				// $sql1res = mysql_query($sql1);
				// $ti = 0;
				// $ti2 = 0;
				// while($sql1row = mysql_fetch_array($sql1res))
				// {
				// 	$ti += $sql1row["Items"];
				// 	//RECORREMOS EL RESULTADO ANTERIOR
				// 	$sql2 = "SELECT SUM(ding_cantidad - ding_cant_rechazo) as Suma FROM bode_detingreso WHERE ding_prod_id = ".$sql1row["doc_id"]." AND ding_recep_tecnica = 'A'";
				// 	$sql2res = mysql_query($sql2);
				// 	$sql2row = mysql_fetch_array($sql2res);
				// 	if($sql2row["Suma"] == $sql1row["Suma"])
				// 	{
				// 		$ti2++;
				// 	}
				// }
				// echo $ti."-".$ti2."<br>";
				// if($ti == $ti2)
				// {
				// 	$icon = "fa-check";
				// }else{
				// 	$icon = "fa-warning";
				// }

				


				$background = "style='background:lightgreen;'";
				?>
				<tr class="trh <?php echo $estilo2 ?>" <?php if($row2["oc_id"] === $id){echo $background;} ?>>
					<td><? echo $row2["oc_id"] ?></td>
					<td><? echo $row2["oc_id2"] ?></td>
					<td><a href="bode_inv_indexoc2.php?ori=1&id=<? echo $row2["oc_id"] ?>" class="link"><i class="fa fa-eye"></i></a></td>
					<td><a href="bode_inv_indexoc2.php?ori=2&id=<? echo $row2["oc_id"] ?>" class="link"><i class="fa fa-pencil-square"></i></a></td>
					<?php if (intval($row2["oc_estado"]) === 1): ?>
						<td><i class="fa fa-check fa-lg"></i></a></td>
					<?php else: ?>
						<td><i class="fa fa-warning fa-lg"></i></td>
					<?php endif ?>

					<?php if($_SESSION["Acceso"]["acc_anular_oc"] == 1 && 1==2): ?>
						<td>
							<a href="#" onClick="anularOC(<?php echo $row2["oc_id"] ?>)" class="link"><i class="fa fa-remove"></i></a>
						</td>
					<?php endif ?>

				</tr>

				<?
				$cont++;
			}
			?>

		</table>
	</div>

	<script type="text/javascript">
		function anularOC(input){
			if(confirm("¿ ESTÁ SEGURO DE ELIMINAR LA ORDEN DE COMPRA ?")){
				var data = ({cmd : "Anular", oc_id : input});
				$.ajax({
					type:"POST",
					url:"bode_anular_oc.php",
					data:data,
					dataType:"JSON",
					success : function ( response ) {
						console.log(response);

						if(response == 1)
						{
							alert("LA ORDEN DE COMPRA TIENE PRODUCTOS DESPACHADOS");
							return false;
						}

						if(response == 2)
						{
							alert("LA ORDEN DE COMPRA TIENE INGRESOS ASOCIADOS");
							return false;
						}

						if(response == 3)
						{
							alert("LA ORDEN DE COMPRA HA SIDO ELIMINADA DEL SISTEMA");
							window.location.href="bode_inv_indexoc2.php?cod=<?php echo $_GET['cod'] ?>";
						}
						// if(response){
						// 	alert("LA OC HA SIDO ELIMINADA DEL SISTEMA");
						// 	window.location.href="bode_inv_indexoc2.php?cod=<?php echo $_GET['cod'] ?>";
						// }else{
						// 	alert("ESTA OC TIENE PRODUCTOS DESPACHADOS.")
						// }
					}
				});
			}else{
				return false;
			}
			
		}
	</script>