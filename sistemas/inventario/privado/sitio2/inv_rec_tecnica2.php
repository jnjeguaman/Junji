<?php
session_start();
require("inc/config.php");

 mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
//include("Includes/FusionCharts.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$fechamia2=date('d-m-Y');
$hora=date("H:i");
$id_ing=$_GET['id_ing'];
$id = $_GET['id'];


// Recupera ingreso

$consulta="select * from bode_ingreso, bode_orcom where ing_oc_id = oc_id and ing_oc_id = '$id'";

//$consulta="select * from bode_ingreso, bode_orcom, bode_proveedor where ing_oc_id = oc_id and oc_pro_id = pro_id and  ing_id = '$id_ing'";
$res=mysql_query($consulta);
while ($arr=mysql_fetch_array($res)){
    $v_ing_id           = $arr['ing_id'];	
	$v_ing_guia	        = $arr['ing_guia'];
	$v_ing_oc_id        = $arr['ing_oc_id'];	
	$v_ing_fecha        = $arr['ing_fecha'];	
	$v_ing_recib_usu_id = $arr['ing_recib_usu_id'];
	
	$v_oc_id	            = $arr['oc_id'];
	$v_oc_id2	            = $arr['oc_id2'];
	$v_oc_region	        = $arr['oc_region'];
	$v_oc_nombre_oc	        = $arr['oc_nombre_oc'];
	$v_oc_prog_id	        = $arr['oc_prog_id'];
	$v_oc_fecha	            = $arr['oc_fecha'];
	$v_oc_fecha_recep	    = $arr['oc_fecha_recep'];
	$v_oc_recibido_usu_id	= $arr['oc_recibido_usu_id'];
	$v_oc_pro_id	        = $arr['oc_pro_id'];
	$v_oc_observaciones	    = $arr['oc_observaciones'];
	$v_oc_estado            = $arr['oc_estado'];
		
	$v_pro_rut              = $arr['pro_rut'];
	$v_pro_glosa            = $arr['pro_glosa'];

}

;
/*

$proveedor = "SELECT * FROM inv_proveedor WHERE proveedor_estado = 1";
$proveedor_resp = mysql_query($proveedor);

*/

?>


	
<!--
<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">
-->
	<div id="seccion1" style="background-color:#E0F8E0;" >
	
	    <!-- Recupera los INGRESOS PARA HACER LA RECEPCION TECNICA	-->
		<form name="form1" method="POST" action="inv_rec_tecnica_gr.php">
		<table border="0"  width="100%">
		    		
			<tr>
				<td  class="Estilo2titulo" colspan="10">Recepción Técnica</td>
			</tr>
			<tr>
				<td class="Estilo2"> Id. Ingreso </td>
				<td class="Estilo2"> <? echo $v_ing_id ?> </td>
				<td class="Estilo2">Guia  </td>
				<td class="Estilo2"> <? echo $v_ing_guia ?> </td>
				<td class="Estilo2">  </td>
				<td class="Estilo2">  </td>
			</tr>
			<tr>
				<td class="Estilo2"> Proveedor </td>
				<td class="Estilo2" colspan="5"> <? echo $v_pro_glosa ?>  </td>
				
			</tr>
			<tr>
				<td class="Estilo2"> O.Compra </td>
				<td class="Estilo2"><? echo $v_oc_id2 ?>  </td>
				<td class="Estilo2">Glosa </td>
				<td class="Estilo2" colspan="3"> <? echo $v_oc_nombre_oc ?> </td>
				
			</tr>
			
			<tr>
			    <td class="Estilo2">Id  </td>
				<td class="Estilo2">Producto</td>
				<td class="Estilo2">Cantidad </td>
				<td class="Estilo2">Region</td>
				<td class="Estilo2">Recepción</td>
				<td class="Estilo2">Motivo</td>
			</tr>
	    <?
		   
		    $sql2 = "SELECT * FROM bode_detingreso where ding_id='$id' and ding_recep_tecnica != 'A'";
//		    $sql2 = "SELECT * FROM bode_detingreso where ding_ing_id='$id' and ding_recep_tecnica != 'A'";
			echo $sql2;
//		    $sql2 = "SELECT * FROM bode_detingreso, bode_producto where ding_prod_id = prod_id  and ding_ing_id=  '$id_ing' and ding_recep_tecnica != 'A'";
		
			$res2 = mysql_query($sql2);
			$sw_color=0;
			$cont=0;
			$arr = mysql_fetch_array($res2);
			     	$v_ding_id	            = $arr['ding_id'];
					$v_ding_ing_id	        = $arr['ding_ing_id'];
					$v_ding_producto      	= $arr['ding_producto'];
					$v_ding_cantidad	    = $arr['ding_cantidad'];
					$v_ding_region_id	    = $arr['ding_region_id'];
					$v_ding_recep_tecnica	= $arr['ding_recep_tecnica'];
					$v_ding_cant_conf	    = $arr['ding_cant_conf'];
					$v_ding_cant_despacho	= $arr['ding_cant_despacho'];
					$v_ding_cant_final	    = $arr['ding_cant_final'];
					$v_ding_cant_rechazo	= $arr['ding_cant_rechazo'];	
					$v_ding_glosa_rechazo   = $arr['ding_glosa_rechazo'];
					
					$v_prod_nombre           = $arr['prod_nombre'];
					$cont++;
					
					
					
				
			
					if ($sw_color==0){
						 $estilo2 = "Estilo1mc";
						 $sw_color = 1;
					}else{
						 $estilo2 = "Estilo1mcblanco";
						 $sw_color = 0;
					}
		
		?>
	
		    <tr>
			    <td class="<? echo $estilo2 ?>"><? echo $v_ding_id       ?> </td>
				<td class="<? echo $estilo2 ?>"><? echo $v_ding_producto     ?> </td>
				<td class="<? echo $estilo2 ?>"><? echo $v_ding_cantidad    ?> </td>
				<td class="<? echo $estilo2 ?>"><? echo $v_ding_region_id   ?> </td>
				<td class="<? echo $estilo2 ?>"> 
				    <input type="hidden" name="id_ding[<? echo $cont ?>]" value="<? echo $v_ding_id ?>">
				    <input type="radio" name="f_aprueba[<? echo $cont ?>]" value="A"> Aprueba
                    <input type="radio" name="f_aprueba[<? echo $cont ?>]" value="R"> Rechaza
				
				</td>
				<td class="<? echo $estilo2 ?>"> <input type="text" name="f_motivo"> </td>
				<td class="<? echo $estilo2 ?>">
				      <a href="inv_rec_tecnica2.php&id_ing=<? echo $v_ing_id ?>" class="link"><i class="fa fa-check"></i></a>
			    </td>
			</tr>
			
			
		


             <tr>
			     <td> 
				     <input type="hidden" name="f_cont" value="<? echo $cont ?>">
				     <input type="hidden" name="doc_id" value="<? echo $doc_id ?>">
				     <input type="hidden" name="id_ing" value="<? echo $id_ing ?>">
				     <input type="hidden" name="cantidad" value="<? echo $v_ding_cantidad ?>">
				     <input type="hidden" name="id" value="<? echo $id ?>">
					 <input type="submit" value="Grabar"> </td>
			 </tr>
				

		</table>
	     
		</form>
		
		
		
		
	</div>
</div>

	

	


<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
						<script type="text/javascript">

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
