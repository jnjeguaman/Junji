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

<div  style="width:700px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:810px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >
		
		<!-- Recupera los INGRESOS PARA HACER LA RECEPCION TECNICA	-->
		
		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">Ingresos Recibidos de la OC : <? echo $oc_id ?></td>
			</tr>
			<tr>
				<td class="Estilo2">Id Ing. </td>
				<td class="Estilo2">N° Guia </td>
				<td class="Estilo2">Cantidad </td>
				<td class="Estilo2">Nro. OC</td>
				<td class="Estilo2">Glosa</td>
				<td class="Estilo2">Ubicacion</td>
				<td class="Estilo2">Aprobar</td>
				<td class="Estilo2">Rechazar</td>
			</tr>
			<?
			//$ing = "SELECT MAX(ing_id) as ing_id FROM bode_ingreso WHERE ing_oc_id = ".$oc_id;
		   //echo $ing;
			//$ing = mysql_query($ing,$dbh);
			//$ing = mysql_fetch_array($ing);
			//$ing = $ing["ing_id"];
		   //echo $ing;

		    //$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = '0' and y.ing_oc_id=z.oc_id ";
	    	//$sql2 = "SELECT * FROM bode_ingreso a INNER JOIN bode_detingreso b ON a.ing_id = b.ding_ing_id INNER JOIN bode_orcom c ON a.ing_oc_id = c.oc_id INNER JOIN bode_detoc d ON d.doc_id = b.ding_prod_id WHERE a.ing_id = ".$ing." AND b.ding_cantidad > 0 AND b.ding_recep_tecnica = '0'";
			//$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where y.ing_oc_id = $oc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = '0' and y.ing_oc_id=z.oc_id AND x.ding_cantidad >0";
			$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where y.ing_oc_id = $oc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = '0' and y.ing_oc_id=z.oc_id AND x.ding_cantidad >0 AND a.doc_id = x.ding_prod_id AND (y.ing_estado = 1 OR y.ing_estado = 2)";
//		    $sql2 = "SELECT * FROM bode_ingreso x, bode_detoc, bode_orcom where ing_oc_id = $oc_id ";
//			echo $sql2;
			$res2 = mysql_query($sql2);
			$totalRegistros = mysql_num_rows($res2);
			//echo $totalRegistros;

			$sw_color=0;
			while ($row2 = mysql_fetch_array($res2)) {
				
				$v_ing_id           = $row2['ing_id'];	
				$v_ing_guia	        = $row2['ing_guia'];
				$v_ing_oc_id        = $row2['ing_oc_id'];	
				$v_ing_fecha        = $row2['ing_fecha'];	
				$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];
				
				$v_ding_cantidad    = $row2['ding_cantidad'];
				$v_ding_id          = $row2['ding_id'];
				$v_ding_ubi			=$row2["ding_ubicacion"];
				
				
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

				$v_glosa 				= $row2["doc_especificacion"];
				
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
					<td class="<? echo $estilo2 ?>"><? echo $v_glosa ?> </td>
					<td class="<? echo $estilo2 ?>"><? echo $v_ding_ubi ?> </td>
					<?php if ($totalRegistros != 0): ?>
						<td class="<? echo $estilo2 ?>">
							<!-- <a href="bode_inv_indexoc2.php?ori=5&oc_id=<?php echo $oc_id ?>&doc_id=<?php echo $doc_id ?>&ing_id=<?php echo $v_ing_id ?>"><i class="fa fa-check link fa-lg"></i></a> -->
							<a href="#" onClick="apruebaTecnico(<?php echo $oc_id ?>,<?php echo $doc_id ?>,<?php echo $v_ing_id ?>)"><i class="fa fa-check link fa-lg"></i>
							</td>
							<!-- <td class="<? echo $estilo2 ?>"><a href="bode_rechazatecnico.php?ori=5&oc_id=<?php echo $oc_id ?>&doc_id=<?php echo $doc_id ?>&ing_id=<?php echo $v_ing_id ?>" onClick="return confirm(' ¿ ESTÁ SEGURO DE RECHAZAR EL INGRESO DE LA RECEPCION TECNICA ? ')"><i class="fa fa-remove link fa-lg"></i></a></td> -->
							<td class="<? echo $estilo2 ?>">
								<a href="#" onClick="rechazaTecnico(<?php echo $oc_id ?>,<?php echo $doc_id ?>,<?php echo $v_ing_id ?>)"><i class="fa fa-remove link fa-lg"></i></a>
							</td>
						<?php endif ?>
					</tr>
					<? } ?>
				</table>

			</div>
			<hr>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="librerias/jquery.blockUI.js"></script>
<script type="text/javascript">

	function apruebaTecnico(id,doc_id,ing_id)
	{
		if(confirm(' ¿ ESTÁ SEGURO DE APROBAR EL INGRESO DE LA RECEPCION TECNICA ? '))
		{
			location.href='bode_inv_indexoc2.php?ori=5&oc_id='+id+'&doc_id='+doc_id+'&ing_id='+ing_id;
		}
	}

	function rechazaTecnico(id,doc_id,ing_id)
	{
		if(confirm(' ¿ ESTÁ SEGURO DE RECHAZAR EL INGRESO DE LA RECEPCION TECNICA ? '))
		{
			$.ajax({
				type:"POST",
				url:"bode_rechazatecnico.php?ori=5&oc_id="+id+"&doc_id="+doc_id+"&ing_id="+ing_id,
				dataType:"JSON",
				beforeSend : function(){
					blockUI();
				},
				success : function ( response ) {
					if(response.Respuesta)
					{
						alert(response.Mensaje);
						location.href='bode_inv_indexoc2.php?id='+id+'&doc_id='+doc_id+'&ori=4';
					}else{
						alert(response.Mensaje);
					}
				},
				complete : function(){
					unBlockUI();
				}
			});
		}
	}
	function getSubCat(input) {
		var data = ({command : "getSubCat", catsub_cat_id : input});
		$.ajax({
			type:"POST",
			url:"getsubcat.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success:function(response) {
				var resp = "";
				resp +="<option selected value=''>Seleccionar</option>";
				$.each(response,function(index,value){
					resp +="<option value='"+value+"'>"+value+"</option>";
				});
				$("#subgrupo").html(resp);

			}
		})

	}


	function getSubtitulo(input) {
		var data = ({command : "getSubtitulo", acti_subtitulo : input});
		$.ajax({
			type:"POST",
			url:"getsubtitulo.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success:function(response) {
				var resp = "";
				resp +="<option selected value=''>Seleccionar</option>";
				$.each(response,function(index,value){
					resp +="<option value='"+index+"'>"+value+"</option>";
				});
				$("#item").html(resp);

			}
		})
	}

	function getSubZona(input) {
		var data = ({command : "getSubZona", zona_id : input});
		$.ajax({
			type:"POST",
			url:"getsubzona.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success:function(response) {
				var resp = "";
				resp +="<option selected value=''>Seleccionar</option>";
				$.each(response,function(index,value){
					resp +="<option value='"+value+"'>"+value+"</option>";
				});
				$("#zona").html(resp);

			}
		})
	}

	function generarDistribucion()
	{
		console.log(frm4.document.getElementsById('region_distribucion').selectedValue);
	}

	function validar(){}
	function validar2(){}
</script>

</body>
</html>
