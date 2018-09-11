<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >
	
	    <!-- Recupera la ORDEN DE COMPRA SELECCIONADA Y LA MUESTRA 		-->
	    <?
		   
		    $sql2 = "SELECT * FROM bode_orcom where  oc_id = '$id'";
//		    $sql2 = "SELECT * FROM bode_orcom,bode_proveedor where oc_pro_id = pro_id and oc_id = '$id_oc'";
//            echo $sql2;
			$res2 = mysql_query($sql2);
			$sw_color=0;
            $oc_id=$id;
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
				
				$v_pro_rut              = $row2['oc_proveerut'];
				$v_pro_glosa            = $row2['pro_glosa'];
			}
		
		
		?>
	
		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">INGRESO A ORDEN DE COMPRA</td>
			</tr>
			<tr>
			    <td class="Estilo1c">Id OC </td>
				<td class="Estilo2"><? echo $v_oc_id ?> </td>
				<td class="Estilo1c">Nro. OC</td>
				<td  class="Estilo2"><? echo $v_oc_id2 ?></td>
			<tr>
			
			<tr>
			    <td class="Estilo1c">Proveedor </td>
				<td  class="Estilo2"><? echo $v_pro_rut ?> </td>
				<td colspan="2"  class="Estilo2"><? echo $v_pro_glosa ?></td>
				
			<tr>
			
			<tr>
			    <td class="Estilo1c">Fecha </td>
				<td  class="Estilo2"><? echo $v_oc_fecha ?> </td>
				<td class="Estilo1c">Region</td>
				<td  class="Estilo2"><? echo $v_oc_region ?></td>
			<tr>
			
			<tr>
			    <td class="Estilo1c">Nombre OC </td>
				<td colspan="3"  class="Estilo2"><? echo $v_oc_nombre_oc ?> </td>
				
			<tr>


				

		</table>
		<hr>
		
		<!-- COMIENZO DEL FORMULARIO -->
		
		
		<form name="f1" method="POST" action="inv_ingresos_gr.php">

		<table border="0"  width="100%">
		   <TR>
		       <td> Nro. Guia </td>
			   <td><input type="text" name="f_guia"></td>
		   </TR>
		
		</table>
 		<table border="0"  width="100%">
		     <tr>
			      <td  class="Estilo1mc">id</td>
				  <td  class="Estilo1mc">Producto</td>
				  <td  class="Estilo1mc">Especificacion</td>
				  <td  class="Estilo1mc">Cantidad</td>
				  <td  class="Estilo1mc">Valor Unit</td>
				  <td  class="Estilo1mc">Recibidos</td>
				  <td  class="Estilo1mc">Pendientes</td>
				  <td  class="Estilo1mc">Cant.Ingreso</td>
				  
		     </tr>
		<?
		   // Recupera las lineas de la Orden de COMPRA
		   
		   $consulta="select * from bode_detoc where doc_oc_id = '$id' and doc_region='$regionsession'";
//		   $consulta="select * from bode_detoc,bode_producto where doc_prod_id = prod_id and  doc_oc_id = '$id_oc'";
		   $res=mysql_query($consulta);
		   $sw_color=0;
		   $cont=0;
		   while ($arr=mysql_fetch_array($res)){
		        $v_doc_id	          = $arr['doc_id'];
				$v_doc_oc_id	      = $arr['doc_oc_id'];
				$v_doc_prod_id	      = $arr['doc_prod_id'];
				$v_doc_especificacion = $arr['doc_especificacion'];
				$v_doc_cantidad	      = $arr['doc_cantidad'];
				$v_doc_valor_unit	  = $arr['doc_valor_unit'];
				$v_doc_recibidos	  = $arr['doc_recibidos'];
				$v_doc_estado         = $arr['doc_estado'];
				
				$v_prod_nombre         = $arr['prod_nombre'];
				
				if ($sw_color==0){
				     $estilo2 = "Estilo1mc";
					 $sw_color = 1;
				}else{
					 $estilo2 = "Estilo1mcblanco";
					 $sw_color = 0;
				}
											
		        $cont++;
		 ?> 
		    <tr>
			      <td class="<? echo $estilo2 ?>"><? echo $v_doc_id ?></td>
				  <td class="<? echo $estilo2 ?>"><? echo $v_prod_nombre ?></td>
				  <td class="<? echo $estilo2 ?>"><? echo $v_doc_especificacion ?></td>
				  <td class="<? echo $estilo2 ?>"><? echo $v_doc_cantidad ?></td>
				  <td class="<? echo $estilo2 ?>"><? echo $v_doc_valor_unit ?></td>
				  <td class="<? echo $estilo2 ?>"><? echo $v_doc_recibidos ?></td>
				  <td class="<? echo $estilo2 ?>"><? echo $v_doc_cantidad - $v_doc_recibidos ?></td>
<!--
				  <td class="<? echo $estilo2 ?>">
				       <select name="f_region[<? echo $cont ?>]">
					        <option value=""> Seleccione región... </OPTION>
							<?
							    $con2="select * from `acti_region`";
								$res2=mysql_query($con2);
								while ($arr2=mysql_fetch_array($res2)){
                                       $v_region_id     = $arr2['region_id'];	
									   $v_region_glosa  = $arr2['region_glosa'];
									   
								
							?>
							<option value="<? echo $v_region_id ?>"> <? echo $v_region_glosa ?> </OPTION>
							<? } ?>
							
					   </select>

				  </td>
      -->
				  <td class="<? echo $estilo2 ?>">
				       <input type="hidden" name="f_doc_id[<? echo $cont ?>]" value="<? echo $v_doc_id ?>">
				       <input type="text" name="f_cant[<? echo $cont ?>]" size=10>
				  </td>
				  
		     </tr>
		 
		 <?
		   }
		?>
		    <tr>
			      
			      <td colspan="8">
				       <input type="hidden" name="f_cont" value="<? echo $cont ?>">
					   <input type="hidden" name="id_oc" value="<? echo $id ?>">
				       <input type="submit" value="Grabar">
			      </td>
				  
				  
		     </tr>
		</table>
		</form>
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
