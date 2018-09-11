<?php
session_start();
require("inc/config.php");
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$fechamia2=date('d-m-Y');
$hora=date("H:i");
extract($_GET);
extract($_POST);
?>
<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
	<?php
	include("inc/menu_1b.php");
	?>
</div>
<script type="text/javascript">
	function apruebaConforme(ding_id,doc_id,ing_id,cantidad,total)
	{
		if(confirm(' ¿ ESTÁ SEGURO DE APROBAR EL INGRESO DE LA RECEPCION CONFORME ? '))
		{
			location.href='bode_grabafinal.php?id='+ding_id+'&doc_id='+doc_id+'&id_ing='+ing_id+'&ori=6&cantidad='+cantidad+'&total='+total;
		}
	}

	function rechazaConforme(ding_id,doc_id,ing_id,cantidad,total)
	{
		if(confirm(' ¿ ESTÁ SEGURO DE RECHAZAR EL INGRESO DE LA RECEPCION CONFORME ? '))
		{
			$.ajax({
				type:"POST",
				url:"bode_rechazafinal.php?id="+ding_id+"&doc_id="+doc_id+"&id_ing="+ing_id+"&ori=6&cantidad="+cantidad+"&total="+total,
				dataType:"JSON",
				beforeSend : function(){
					// blockUI();
				},
				success : function ( response ) {
					if(response.Respuesta)
					{
						alert(response.Mensaje);
						location.href='bode_inv_indexoc2.php?id='+ding_id+'&doc_id='+doc_id+'&id_ing='+ing_id+'&ori=6';
					}else{
						alert(response.Mensaje);
					}
				},
				complete : function(){
					// unBlockUI();
				}
			});
		}
	}
</script>
<div  style="width:700px;background-color:#E0F8E0; position:absolute; top:120px; left:810px;" id="div2">

		<!-- Recupera los INGRESOS PARA HACER LA RECEPCION TECNICA	-->

		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">Recepcion Final de la OC : <? echo $oc_id ?></td>
			</tr>
			<tr>
				<td class="Estilo1mc">Id Ing. </td>
				<td class="Estilo1mc">N° Guia </td>
				<td class="Estilo1mc">Cantidad </td>
				<td class="Estilo1mc">Nro. OC</td>
				<td class="Estilo1mc">Glosa</td>
				<td class="Estilo1mc">Aprobar</td>
				<td class="Estilo1mc">Rechazar</td>
				<td class="Estilo1mc">Recepción Técnica</td>
			</tr>
			<?
			$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where y.ing_oc_id = $oc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and x.ding_userf='' AND x.ding_cantidad >0 AND a.doc_id = x.ding_prod_id AND (y.ing_estado = 1 OR y.ing_estado = 2)";
			$res2 = mysql_query($sql2);
			$sw_color=0;
			$cont = 0;
			while ($row2 = mysql_fetch_array($res2)) {

				$v_ing_id           = $row2['ing_id'];	
				$v_ing_guia	        = $row2['ing_guia'];
				$v_ing_oc_id        = $row2['ing_oc_id'];	
				$v_ing_fecha        = $row2['ing_fecha'];	
				$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];
				$v_ing_guianumerotc = $row2["ing_guianumerotc"];

				$v_ding_cantidad    = $row2['ding_cantidad']-$row2['ding_cant_rechazo'];
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
				$v_pro_glosa            = $row2['pro_glosa'];

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
					<td class="<? echo $estilo2 ?>"><? echo $v_ding_cantidad    ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo $v_oc_id2   ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo $row2["doc_especificacion"] ?> </td>
					<td class="<? echo $estilo2 ?>"><a href="#" onClick="apruebaConforme(<? echo $v_ding_id ?>,<? echo $doc_id ?>,<? echo $v_ing_id ?>,<? echo  $v_ding_cantidad ?>,<?php echo $cont ?>)" class="link"><i class="fa fa-check"></i></a></td>
					<td class="<? echo $estilo2 ?>"><a href="#" onClick="rechazaConforme(<? echo $v_ding_id ?>,<? echo $doc_id ?>,<? echo $v_ing_id ?>,<? echo  $v_ding_cantidad ?>,<?php echo $cont ?>)" class="link"><i class="fa fa-ban"></i></a></td>
					<td class="<?php echo $estilo2 ?>">
						<?php if($v_ing_guianumerotc == 0): ?>
							<a href="bode_inv_indexoc2.php?ori=4&oc_id=<?php echo $v_ing_oc_id?>&ing_id=<?php echo $v_ing_id ?>" title="Falta realizar la recepción tecnica"><font color="red"><i class="fa fa-warning fa-lg"></i></font></a>
						<?php else: ?>
							<font color="#09d206"><i class="fa fa-check fa-lg" title="Recepcion Técnica N° <?php echo $v_ing_guianumerotc ?>"></i></font>
						<?php endif ?>
					</td>
				</tr>
				<? $cont++; } ?>
			</table>