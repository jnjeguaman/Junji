<div  style="width:630px; height:280px; background-color:#E0F8E0; position:absolute; top:120px; left:50px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >
		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">Ordenes de Compra Pendiente</td>
			</tr>
			
			<tr>
			    <form name="form1" method="post" action="inv_nueva_oc.php">
				<td  class="Estilo2titulo" colspan="10">
				     Agregar Nueva Orden de Compra 
					 <input type="text" name="f_oc">
					 <input type="submit" value="Recuperar">
				</td>
				</form>
			</tr>

			<tr>
				<td class="Estilo1mc">ID</td>
				<td class="Estilo1mc">Numero</td>
				<td class="Estilo1mc">Nombre OC</td>
				<td class="Estilo1mc">Fecha</td>
				<td class="Estilo1mc">Estado</td>
				
				<td class="Estilo1mc">Sel.</td>
				

			</tr>

			<?
			$sql2 = "SELECT * FROM bode_orcom where oc_estado = 'PE'";
			$res2 = mysql_query($sql2);
			$sw_color=0;
			while ($row2 = mysql_fetch_array($res2)) {
				$v_oc_id	            = $row2['oc_id'];
				$v_oc_id2	            = $row2['oc_id2'];
				$v_oc_region	        = $row2['oc_region'];
				$v_oc_nombre_oc	        = $row2['oc_nombre_oc'];
				$v_oc_prog_id	        = $row2['oc_prog_id'];
				$v_oc_fecha	            = $row2['oc_fecha'];
				$v_oc_fecha_recep	    = $row2['oc_fecha_recep'];
				$v_oc_recibido_usu_id	= $row2['oc_recibido_usu_id'];
				$v_oc_pro_id	        = $row2['oc_pro_id'];
				$v_oc_observaciones	    = $row2['oc_observaciones'];
				$v_oc_estado            = $row2['oc_estado'];
				
				if ($sw_color==0){
				     $estilo2 = "Estilo1mc";
					 $sw_color = 1;
				}else{
					 $estilo2 = "Estilo1mcblanco";
					 $sw_color = 0;
				}
														

				?>
				<tr>
					<td  class="<? echo $estilo2 ?>">  <? echo $v_oc_id ?>         </td>
					<td  class="<? echo $estilo2 ?>">  <? echo $v_oc_id ?>         </td>
					<td  class="<? echo $estilo2 ?>">  <? echo $v_oc_nombre_oc ?>  </td>
					<td  class="<? echo $estilo2 ?>">  <? echo $v_oc_fecha ?>      </td>
					<td  class="<? echo $estilo2 ?>">  <? echo $v_oc_estado ?>     </td>
					<td  class="<? echo $estilo2 ?>">  <a href="inv_index.php?ori=1&id_oc=<? echo $v_oc_id ?>" class="link"><i class="fa fa-check"></i></a></td>
					
					</tr>

				<?
				
			}
			?>

		
	</div>
</div>

<script type="text/javascript">
	function eliminarItem(input) {
		var data = ({cmd : "eliminarItem", compra_id : input});

		$.ajax({
			type:"POST",
			url:"inv_eliminar_compra.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success : function ( response ) {
				console.log(response);
			}
		});
	}
</script>