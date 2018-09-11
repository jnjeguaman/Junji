<?php
session_start();
require("inc/config.php");

mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
//include("Includes/FusionCharts.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$fechamia2=date('d-m-Y');
$hora=date("H:i");
$id_ing=$_GET['ing_id'];
$id = $_GET['id'];


// Recupera ingreso

$consulta="select * from bode_ingreso, bode_orcom where ing_oc_id = oc_id and ing_oc_id = '$oc_id' and ing_id=$ing_id";
//$consulta="select * from bode_ingreso, bode_orcom, bode_proveedor where ing_oc_id = oc_id and oc_pro_id = pro_id and  ing_id = '$id_ing'";

//echo $consulta;
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
	$v_pro_glosa            = $arr['oc_proveenomb'];

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
	<form name="form1" method="POST" action="bode_inv_rec_tecnica_gr.php" onsubmit="return oculta2()">
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
		</table>
		<br><br>
		<?php
		//echo $ing_id;
		//$sql22 = "SELECT * FROM bode_ingreso a INNER JOIN bode_detingreso b ON a.ing_id = b.ding_ing_id INNER JOIN bode_orcom c ON a.ing_oc_id = c.oc_id INNER JOIN bode_detoc d ON d.doc_id = b.ding_prod_id WHERE a.ing_id = ".$ing_id." AND b.ding_cantidad > 0";
		$sql22 = "SELECT * FROM bode_detingreso a, bode_detoc b where a.ding_ing_id='$ing_id' and a.ding_recep_tecnica != 'A' AND ding_cantidad > 0 AND b.doc_id = a.ding_prod_id";
		$sql22 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc w where y.ing_oc_id = $oc_id and x.ding_ing_id=y.ing_id and  w.doc_id = x.ding_prod_id and x.ding_recep_tecnica = '0' and y.ing_oc_id=z.oc_id AND x.ding_cantidad >0 AND x.ding_ing_id = ".$ing_id;
		$sql22 = mysql_query($sql22);

		?>

		
		<table border="1" cellpadding="0" cellspacing="0">
			
			<tr>
				<td class="Estilo2">Id  </td>
				<td class="Estilo2">Cantidad </td>
				<td class="Estilo2">Region</td>
				<td class="Estilo2">Recepción</td>
				<td class="Estilo2 Rechaza">Motivo</td>
				<td class="Estilo2 Rechaza">Cantidad</td>
			</tr>
			<?
			$cont = 0;
			while ($row5 = mysql_fetch_array($sql22)) {
				$sql2 = "SELECT * FROM bode_detingreso where ding_id='$id_ing' and ding_recep_tecnica != 'A'";
			//echo $sql2;
//		    $sql2 = "SELECT * FROM bode_detingreso where ding_ing_id='$id' and ding_recep_tecnica != 'A'";
//			echo $sql2;
//		    $sql2 = "SELECT * FROM bode_detingreso, bode_producto where ding_prod_id = prod_id  and ding_ing_id=  '$id_ing' and ding_recep_tecnica != 'A'";

				$res2 = mysql_query($sql2);
				$sw_color=0;
				//$cont=0;
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
				//$cont++;





				if ($sw_color==0){
					$estilo2 = "Estilo1mc";
					$sw_color = 1;
				}else{
					$estilo2 = "Estilo1mcblanco";
					$sw_color = 0;
				}

				?>

				<tr>
					<td class="<? echo $estilo2 ?>"><? echo $row5["doc_id"]?> </td>
					<td class="<? echo $estilo2 ?>"><? echo $row5["ding_cantidad"]?></td>
					<td class="<? echo $estilo2 ?>"><? echo $row5["ding_region_id"]?></td>
					<td class="<? echo $estilo2 ?>"> 
						<input type="hidden" name="id_ding[<? echo $cont ?>]" value="<? echo $row5["ding_id"] ?>">
						<input type="radio" name="f_aprueba[<? echo $cont ?>]" id="f_aprueba_<?php echo $cont ?>" value="A" onChange="mostrarRechazo(this.value,<?php echo $cont?>)" checked> Aprueba
						<input type="radio" name="f_aprueba[<? echo $cont ?>]" id="f_aprueba_<?php echo $cont ?>" value="R" onChange="mostrarRechazo(this.value,<?php echo $cont?>)"> Rechaza
					</td>
					<td class="<? echo $estilo2 ?> Rechaza_<?php echo $cont?>"><textarea id="f_motivo_<?php echo $cont ?>" name="f_motivo[<?php echo $cont ?>]" style="margin: 0px; width: 277px; height: 40px;"></textarea></td>
					<td class="<? echo $estilo2 ?> Rechaza_<?php echo $cont?>"> <input type="number" id="f_cantidad_<?php echo $cont ?>" name="f_cantidad[<?php echo $cont ?>]" min="0" max="<?php echo $row5["ding_cantidad"] ?>" value="0"> </td>
				</tr>

				<input type="hidden" name="doc_id[<?php echo $cont ?>]" value="<? echo $row5["doc_id"] ?>">
				<input type="hidden" name="cantidad[<?php echo $cont ?>]" value="<? echo $row5["ding_cantidad"] ?>">
				<input type="hidden" name="factor[<?php echo $cont ?>]" value="<? echo $row5["doc_factor"] ?>">
				<input type="hidden" name="ing_id" value="<? echo $ing_id ?>">
				<?php 
				$cont++;
			} ?>
		</table>

		<table border=0>
			<tr>
				<td colspan=5>
					<input type="hidden" name="f_cont" value="<? echo $cont ?>">
					<input type="hidden" name="id_ing" value="<? echo $_REQUEST["ing_id"] ?>">
					<input type="hidden" name="id" value="<? echo $_REQUEST["oc_id"] ?>">
					<input type="submit" value="Grabar" id="btnGrabaTc" > </td>
					<input type="hidden" name="doc_id2" id="doc_id2" value="<?php echo $doc_id ?>">
				</tr>
			</table>
		</form>
		<hr>
		<table border="0"  width="100%">

		</div>
	</div>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".Rechaza").hide();
			var total = "<? echo $cont ?>";
			for (var i = 0; i < total; i++) {

				$(".Rechaza_"+i).hide();

			};
		})
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

		function mostrarRechazo(input,id){
			if(input === "R")
			{
				$(".Rechaza").fadeIn("slow");
				$(".Rechaza_"+id).fadeIn("slow");
			}else{
				
				$(".Rechaza_"+id).fadeOut("slow");
				$(".Rechaza").fadeOut("slow");
				$("#f_motivo_"+id).val("");
				$("#f_cantidad_"+id).val(0);
			}
		}

		function oculta2(){
			$("#btnGrabaTc").hide();
			return true;
		}
	</script>

</body>
</html>
