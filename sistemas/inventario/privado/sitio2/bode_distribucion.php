<?php 
require_once("inc/config.php");
extract($_POST);
extract($_GET);
if(isset($_POST))
{
	$cmd = $accion;
	switch ($cmd) {
		case 'ACTUALIZAR':
		include("bode_mas_up.php");
		break;
		
		case 'GRABAR':
		include("bode_mas_gr.php");
		break;

		case 'del':
		include("bode_mas_dl.php");
		break;
	}
	
}

?>
<table border="1" width="100%">
	<form name="frmMatriz" id="frmMatriz" action="bode_inv_indexguia3.php?ori=3&masid=<?php echo $masid ?>" method="POST">
		<?php 
		//Jardines Asociados
		$sql2 = "SELECT * FROM bode_orcom2 x INNER JOIN jardines y on x.oc_region = y.jardin_codigo WHERE  x.oc_estado=100 and x.oc_mas_id=$masid AND y.jardin_estado = 1 ORDER BY x.oc_id";
		// echo $sql2;
		$res2 = mysql_query($sql2);
		$tJardines = mysql_num_rows($res2);
		$colspan = mysql_num_rows($res2);
		?>

		<tr>
			<td class="Estilo2titulo" colspan="<?php echo $colspan+5 ?>">GUIAS EN TRANSITO</td>
		</tr>

		<tr>
			<td colspan="2"></td>
			<td class="Estilo1mc" colspan="<?php echo $colspan+3 ?>">JARDIN</td>
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
						<? echo $row2["oc_region"] ?>
					</div>
					<br><a href="#" title="Eliminar jardin de la matriz" onClick="return eliminarJardin(<?php echo $row2["oc_id"] ?>)"><i class="fa fa-remove fa-lg link"></i></a>
				</td>

				<?
				$arrjandin[$cont]=$row2["oc_region"];
				$cont++;
			}
			?>
			<td class="Estilo1mc">Solicitado</td>
			<td class="Estilo1mc">Disponible</td>
			<td class="Estilo1mc">Estado</td>
		</tr>

		<?php
		// Productos
		$sql2 = "SELECT * FROM  bode_detoc2 x WHERE  x.doc_mas_id = $masid order by x.doc_id ASC";
		// echo $sql2;
		$res2 = mysql_query($sql2);
		$totalProductos = mysql_num_rows($res2);
		$cont2=1;
		$col=0;
		while ($row2 = mysql_fetch_array($res2)) {

			$nuevo=$row2["doc_especificacion"];

			if ($nuevo<>$antiguo) {
				$col++;
				$cont2=1;
			}
			$arrid[$col][$cont2]=$row2["doc_prod_id"];
			//$arrcantidad[$col][$cont2]=$row2["doc_cantidad"];
			//$arrcantidad[$col][$cont2]=$row2["doc_cantidad"];
			$antiguo=$row2["doc_especificacion"];
			$cont2++;
		}

		// $sql2 = "SELECT * FROM  bode_detoc2 x inner join bode_detingreso y on y.ding_id = x.doc_prod_id WHERE  x.doc_mas_id =$masid AND y.ding_recep_tecnica = 'A' ORDER BY x.doc_id ASC";
		$sql2 = "SELECT * FROM  bode_detoc2 x inner join bode_detingreso y on y.ding_id = x.doc_prod_id WHERE  x.doc_mas_id =$masid AND y.ding_recep_conforme = 'C' ORDER BY x.doc_id ASC";
		// echo $sql2;
		$res2 = mysql_query($sql2);
		$cont3=1;
		$errors = 0;

		// while ($row2 = mysql_fetch_array($res2) AND $cont3 < 24) {
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
				$solicitado = 0;
				for ($i=1;$i<$cont;$i++) {
					if($i <= $tJardines)
					{
						$solicitado += $arrcantidad[$cont3][$i];
					}
					
					?>
					<td  class="<? echo $estilo2 ?>">
						<input type="hidden" name="arrid[<? echo $cont3 ?>][<? echo $i ?>]" size=6 value="<? echo $row2["doc_prod_id"] ?>">
						<input type="hidden" name="arrjandin[<? echo $cont3 ?>][<? echo $i ?>]" size=6 value="<? echo $arrjandin[$i] ?>">
						<input type="number" min="0" max="10000" name="arrcantidad[<? echo $cont3 ?>][<? echo $i ?>]" size=6 value="<?php 
						
						//SI ES UN NUEVO ITEM, TODOS IGUALES
						if(isset($_GET["cmd"]) AND $_GET["cmd"] == "nuevo")
						{
							echo $row2["doc_cantidad"];
							/*if(empty($_SESSION["masiva"][$cont3][$i]))
							{
								echo $row2["doc_cantidad"];
							}else{
								echo $_SESSION["masiva"][$cont3][$i];
							}*/
							//Checkeamos si el elemento en la posicion x ya tiene datos
							/*if($arrcantidad[$cont3][$i] <> "")
							{
								//verificamos que esten en una sesion los datos
								if(isset($_SESSION["masiva"]) && count($_SESSION["masiva"]) > 0)
								{
									echo $_SESSION["masiva"][$cont3][$i];
							
								}else{
								echo $row2["doc_cantidad"];
								}
							}else{
								echo 999;
							}*/
						}else{
							if(isset($accion) AND $accion == "ACTUALIZAR")
							{
								/*if(intval($arrcantidad[$cont3][$i]) <> 0)
								{
									echo $arrcantidad[$cont3][$i];
								}else{
									if(isset($_SESSION["masiva"]) && count($_SESSION["masiva"]) > 0)
									{
										echo $_SESSION["masiva"][$cont3][$i];
									}else{
										echo $arrcantidad[$cont3][$i];
									}
									echo $arrcantidad[$cont3][$i];

								}*/
								echo $arrcantidad[$cont3][$i];
							}else{
								if(isset($_SESSION["masiva"]) && count($_SESSION["masiva"]) > 0)
								{
									echo $_SESSION["masiva"][$cont3][$i];
								}else{
									echo $row2["doc_cantidad"];
								}
							}
						}
						/*
						if($accion=="ACTUALIZAR")
						{
							if($arrcantidad[$cont3][$i] <> 0)
							{
								echo $arrcantidad[$cont3][$i];
							}else{
								if(isset($_SESSION["caca"]) && count($_SESSION["caca"]) > 0)
								{
									echo $_SESSION["caca"][$cont3][$i];
								}else{
									echo $arrcantidad[$cont3][$i];
								}
							}
						}else{
							if(isset($_SESSION["caca"]) && count($_SESSION["caca"]) > 0)
								{
									echo $_SESSION["caca"][$cont3][$i];
								}else{
									echo $row2["doc_cantidad"];
								}
						}
						*/

						?>">
					</td>

					<?

				}

				$extra ="<td class='".$estilo2."'>".$solicitado."</td>";
				$extra .="<td class='".$estilo2."'>".($row2["ding_unidad"] - $solicitado)."</td>";
				if($solicitado <= $row2["ding_unidad"])
				{
					$extra .="<td class='".$estilo2."'><i class='fa fa-check fa-lg'></i><a href=\"bode_inv_indexguia3.php?ori=3&masid=".$masid."&accion=del&doc_id=".$row2["doc_id"]."\" onClick=\"return confirm(' ESTA SEGURO DE ELIMINAR EL PRODUCTO  DE LA MATRIZ ?')\"><i class='fa fa-remove link fa-lg'></i></a></td>";
					// $extra .="<td><center><a href=\"bode_inv_indexguia3.php?ori=3&masid=".$masid."&accion=del&doc_id=".$row2["doc_id"]."\" onClick=\"return confirm(' ESTA SEGURO DE ELIMINAR EL PRODUCTO  DE LA MATRIZ ?')\"><i class='fa fa-remove'></i></a></center></td>";
				}else{
					$errors++;
					$extra .="<td><center><a href=\"bode_inv_indexguia3.php?ori=3&masid=".$masid."&accion=del&doc_id=".$row2["doc_id"]."\" onClick=\"return confirm(' ESTA SEGURO DE ELIMINAR EL PRODUCTO  DE LA MATRIZ ?')\"><i class='fa fa-remove'></i></a></center></td>";
				}
				echo $extra;
				$cont3++;
			}
			?>
		</tr>
		<tr>
			<td colspan="<?php echo $colspan+2 ?>"></td>
			<td class="Estilo1mc"><button type="submit" name="accion" class="accion" value="ACTUALIZAR"><i class="fa fa-refresh"></i></button></td>
			<?php if ($accion=="ACTUALIZAR" && $errors==0): ?>
				<td class="Estilo1mc"><button type="submit" name="accion" class="accion" value="GRABAR" onclick="return val()"><i class="fa fa-cloud-upload"></i></button></td>
			<?php else: ?>
				<td class="Estilo1mc"></td>
			<?php endif ?>
			
			<td></td>
		</tr>
		<input type="hidden" name="errors" id="errors" value="<? echo $errors ?>"  >
		<input type="hidden" name="masid" value="<? echo $masid ?>"  >
		<!-- <input type="text" name="nprod" value="<? echo $col ?>"  > -->
		<input type="hidden" name="nprod" value="<? echo $totalProductos ?>"  >
		<input type="hidden" name="njard" value="<? echo $tJardines ?>"  >
	</form>
</table>

<script type="text/javascript">
	
	$("button").click(function(){
		$("button").hide();
	})
	function val()
	{
		var errors = parseInt($("#errors").val());

		if(errors > 0)
		{
			alert("TIENE "+errors+" PRODUCTOS QUE VERIFICAR");
			return false;
		}else{
			blockUI();
			return true;
		}
	}

	function eliminarJardin(input)
	{
		if(confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA ELIMINACIÓN DEL JARIN ?"))
		{
			var data = ({oc_id : input});
		$.ajax({
			type:"POST",
			url:"bode_elimina_jardin.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
			if(response == true)
			{
				alert("Jardin eliminado");
				window.location.reload();
			}else{
				alert("No se ha podido eliminar el jardin de la matriz");
				return false;
			}
			}
		});
		}else{
			return false;
		}
	}
</script>