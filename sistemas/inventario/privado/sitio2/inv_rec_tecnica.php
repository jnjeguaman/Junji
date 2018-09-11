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



;
/*

$proveedor = "SELECT * FROM inv_proveedor WHERE proveedor_estado = 1";
$proveedor_resp = mysql_query($proveedor);

*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>SISTEMA DE INVENTARIO - JUNJI</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
 
     <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />

</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php
		include("inc/menu_1b.php");
		?>
	</div>
	
	<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >
	
	    <!-- Recupera los INGRESOS PARA HACER LA RECEPCION TECNICA	-->
		
		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">Ingresos Recibidos de la OC : <? echo $id ?></td>
			</tr>
			<tr>
			    <td class="Estilo2">Id Ing. </td>
				<td class="Estilo2">N° Guia </td>
				<td class="Estilo2">Cantidad </td>
				<td class="Estilo2">Nro. OC</td>
				<td class="Estilo2">Glosa</td>
				<td class="Estilo2">Sel</td>
			</tr>
	    <?
		   
		    $sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = '0' ";
//		    $sql2 = "SELECT * FROM bode_ingreso x, bode_detoc, bode_orcom where ing_oc_id = $oc_id ";
			echo $sql2;
			$res2 = mysql_query($sql2);
			$sw_color=0;
			while ($row2 = mysql_fetch_array($res2)) {
			
			$v_ing_id           = $row2['ing_id'];	
			$v_ing_guia	        = $row2['ing_guia'];
			$v_ing_oc_id        = $row2['ing_oc_id'];	
			$v_ing_fecha        = $row2['ing_fecha'];	
			$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];
   
   			$v_ding_cantidad          = $row2['ding_cantidad'];
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
				<td class="<? echo $estilo2 ?>"><? echo $v_oc_nombre_oc ?> </td>
				<td class="<? echo $estilo2 ?>">
				      <a href="inv_indexoc2.php?id=<? echo $v_ding_id ?>&doc_id=<? echo $doc_id ?>&id_ing=<? echo $v_ing_id ?>&ori=5" class="link"><i class="fa fa-check"></i></a>
			    </td>
			</tr>
			
			
		
		<? } ?>
			


				

		</table>
	

		

		
		
	</div>
 <hr>
 <!--
 
</div>
-->

	

	


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
