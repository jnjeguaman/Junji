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

$consulta="select * from bode_ingreso, bode_orcom where ing_oc_id = oc_id and ing_oc_id = '$oc_id' ";

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

	$v_fentrega				= $arr["ding_fentrega"];

}

;
/*

$proveedor = "SELECT * FROM inv_proveedor WHERE proveedor_estado = 1";
$proveedor_resp = mysql_query($proveedor);

*/

?>
<script>
	<!--
	function abreVentana2(id,numerooc,ori,doc_id){
		miPopup = window.open("bode_subirarchivo2.php?id="+id+"&numerooc="+numerooc+"&ori="+ori+"&doc_id="+doc_id,"miwin","width=500,height=200,scrollbars=yes,toolbar=0")
		miPopup.focus()
	}

-->
</script>


<!--
<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">
-->
<div id="seccion1" style="background-color:#E0F8E0;" >
	
	<!-- Recupera los INGRESOS PARA HACER LA RECEPCION TECNICA	-->

 		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">Ultimas Recepciones Aceptadas</td>
			</tr>
			<tr>
			    <td class="Estilo2">Id Ing. </td>
				<td class="Estilo2">N° Guia </td>
				<td class="Estilo2">Cantidad </td>
				<td class="Estilo2">Nro. OC</td>
				<td class="Estilo2">Glosa</td>
			</tr>
	    <?

		    $sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and x.ding_userf<>'' and y.ing_guianumerorc=0 ";
//		    $sql2 = "SELECT * FROM bode_ingreso x, bode_detoc, bode_orcom where ing_oc_id = $oc_id ";
//			echo $sql2;
			$res2 = mysql_query($sql2);
			$sw_color=0;
			while ($row2 = mysql_fetch_array($res2)) {

			$v_ing_id           = $row2['ing_id'];
			$v_ing_guia	        = $row2['ing_guia'];
			$v_ing_oc_id        = $row2['ing_oc_id'];
			$v_ing_fecha        = $row2['ing_fecha'];
			$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];

   			$v_ding_cantidad          = $row2['ding_cantidad']-$row2['ding_cant_rechazo'];
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

			$v_fentrega				= $row2["ding_fentrega"];

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
			</tr>



		<? } ?>





		</table>



	<form action="bode_guia_despacho_gr3.php" method="POST">
 
 
 	<?php if ($v_fentrega <> ''): ?>
 		<table>

				<tr>
					<td class="Estilo1">FECHA EMISION</td>
					<td colspan="2" class="Estilo1"><input type="text" readonly name="emision" id="emision" size="8" value="<?php echo $v_fentrega ?>" style="background-color: rgb(235, 235, 228)"></td>
				</tr>
<?
		$sql3 = "SELECT max(ing_guianumerorc) as maximo FROM bode_ingreso";
		//echo $sql3;
		$res3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($res3);
        $maximo=$row3["maximo"]+1;
?>


				<tr>
					<td class="Estilo1">NUMERO DE GUIA</td>
					<td colspan="2" class="Estilo1"><input type="text" name="nro_guia" id="nro_guia" size="8" value="<? echo $maximo ?>" readonly style="background-color: rgb(235, 235, 235)"></td>
				</tr>

				<tr>
					<td class="Estilo1">EMISOR</td>
					<td colspan="2" class="Estilo1">
                    <input type="text" name="emisor" id="destinatario"  value="<?php  echo $_SESSION["nombrecom"] ?>" readonly style="background-color: rgb(235, 235, 235)"/></td>
                   </td>
				</tr>
				<tr>
					<td colspan="3"><input type="submit" value="Cerrar guia" id="btnCerrar" onClick="oculta()">
					</td>
				</tr>
			</table>
			<input type="hidden" name="doc_id" value="<?php echo $doc_id ?>">
   			<input type="hidden" name="id" value="<?php echo $oc_id ?>">
   			<input type="hidden" name="ing_id" value="<?php echo $v_ing_id ?>">
			<input type="hidden" name="guianumerorc" value="<?php echo $maximo ?>">
		</form>
</table>
 	<?php endif ?>
			
		<hr>

		<table border="0"  width="100%">
		<?php
		$ultimas = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerorc<>0 AND (y.ing_estado = 1 OR y.ing_estado = 2) group by y.ing_guianumerorc ";
//		$ultimas = "SELECT DISTINCT(ing_guia),ing_guiaabasterc,ing_guiadestinarc,ing_guiaemisorrc,ing_guia FROM bode_ingreso WHERE ing_guiafecharc <> ''";
//		echo $ultimas;
		$respUltimas = mysql_query($ultimas,$dbh);
		?>
		<tr>
			<td  class="Estilo2titulo" colspan="10">ÚLTIMAS GUÍAS INGRESADAS</td>
		</tr>
		</table>

		<table border="1" cellpadding="1" cellspacing="1" width="100%">
			<tbody>
				<th class="Estilo1mc">NUMERO GUIA</th>
				<th class="Estilo1mc">FECHA</th>
				<th class="Estilo1mc">EMISOR</th>
				<th class="Estilo1mc">VER</th>
				<th class="Estilo1mc">ARCHIVO</th>
			</tbody>

			<tbody>
				<?php
              while($rowUltimas = mysql_fetch_array($respUltimas)) {

              	/* NUEVO */
              	if ($rowUltimas["ing_archivotc"]=='') {
				$imagen="punt_rojo.jpg";
				$titulo="Subir Archivo";
				$href="<a href='#' class='link' onclick='abreVentana2(".$rowUltimas["ing_id"].",".$rowUltimas["oc_id"].",".$ori.",".$doc_id.")' title='".$titulo."'>";
			} else {
				$imagen="punt_verde.jpg";
				$titulo="Ver Archivo";
				$href="<a href='../../../".$rowUltimas["ing_rutatc"]."/".$rowUltimas["ing_archivotc"]."' class='link' target='_blank' title='".$titulo."'>";
			}
              	/* FIN NUEVO */
                  //$fechaguia=substr($rowUltimas["ing_guiafecharc"],8,2)."-".substr($rowUltimas["ing_guiafecharc"],5,2)."-".substr($rowUltimas["ing_guiafecharc"],0,4);
              	$fechaguia = $rowUltimas["ding_fentrega"];
                ?>
				<tr>
					<td class="Estilo1mc"><?php echo $rowUltimas["ing_guianumerorc"] ?></td>
					<td class="Estilo1mc"><?php echo $fechaguia ?></td>
					<td class="Estilo1mc"><?php echo $rowUltimas["ing_guiaemisorrc"] ?></td>
					<td class="Estilo1mc"><a href="bode_imprimerca.php?doc_id=<? echo $doc_id ?>&numguia=<?php echo $rowUltimas["ing_guianumerorc"]?>" target="_blank">IMPRIMIR</td>
					<td class="Estilo1mc">
					<? echo $href ?><img src="images/<? echo $imagen ?>" width="20" height="20" border=0></a>
					<?php if($rowUltimas["ing_rutatc"] != ""): ?>
					| <a href="bode_inv_rec_final2_deldoc.php?ing_id=<?php echo $rowUltimas["ing_id"]?>&oc_id=<?php echo $_GET["oc_id"] ?>&doc_id=<?php echo $_GET["doc_id"]?>" title="Eliminar Documento" target="_blank" onClick="return confirm('¿ ESTÁ SEGURO DE ELIMINAR EL DOCUMENTO ADJUNTO ?')"><i class="fa fa-trash link fa-2x"></i></a>	
					<?php endif ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		
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

	function oculta(){
				$("#btnCerrar").hide();
			}
</script>

</body>
</html>
