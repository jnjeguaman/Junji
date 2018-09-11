<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
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
	
	<div  style="width:630px; background-color:#E0F8E0; position:absolute; top:120px; left:810px;" id="div2">
	
	    <!-- Recupera los INGRESOS PARA HACER LA RECEPCION TECNICA	-->
		
		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">Producto a toma de inventario : <? echo $inv_id ?></td>
			</tr>
		</table>
			
			<table border="1"  width="100%">
			<tr>
				<td colspan="7" class="Estilo1"><a href="bode_realizatoma.php?inv_id=<? echo $inv_id ?>&forma=<? echo $forma ?>" target="_blank">Realizar toma</a></td>
			</tr>
			<tr>
				<td class="Estilo1mc">N° </td>
				<td class="Estilo1mc">DESCRIPCION </td>
				 <?php if ($forma != "Oculto"): ?>
				<td class="Estilo1mc">PRECIO</td>
				<td class="Estilo1mc">STOCK</td>
				<?php endif ?>
				<td class="Estilo1mc">TOMA</td>
				<td class="Estilo1mc">DIF.</td>
				<td class="Estilo1mc">UBICACION</td>
			</tr>
	    <?
		   
		    $sql2 = "SELECT * FROM bode_detoc_inv where doci_inv_id='$inv_id'  ";
//		    $sql2 = "SELECT * FROM bode_ingreso x, bode_detoc, bode_orcom where ing_oc_id = $oc_id ";
			//echo $sql2;
			$res2 = mysql_query($sql2);
			$sw_color=1;
			$cont=1;
			$dif=0;
			while ($row2 = mysql_fetch_array($res2)) {
			
			/*$v_ing_id           = $row2['ing_id'];	
			$v_ing_guia	        = $row2['ing_guia'];
			$v_ing_oc_id        = $row2['ing_oc_id'];	
			$v_ing_fecha        = $row2['ing_fecha'];	
			$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];*/

			
		    if ($sw_color==0){
				 $estilo2 = "Estilo1mc";
				 $sw_color = 1;
			}else{
				 $estilo2 = "Estilo1mcblanco";
				 $sw_color = 0;
			}
			if ( $row2['doci_diferencia']<>0) {
                $dif=$dif+1;
            }
		?>
	
		    <tr class="<? echo $estilo2 ?> trh">
			    <td><? echo  $cont  ?> </td>
			    <td><? echo  $row2['doci_especificacion']  ?> </td>
			    <?php if ($forma != "Oculto"): ?>
			    	<td>$<? echo  number_format($row2['doci_valor_unit'],0,".",".")  ?> </td>
			    <td><? echo  $row2['doci_stock']  ?> </td>
			    <?php endif ?>
			    
			    <td><? echo  $row2['doci_toma']  ?> </td>
			    <td><? echo  $row2['doci_diferencia']  ?> </td>
			    <td style="text-align: left;"><? echo  $row2['doci_ubi']  ?> </td>
			</tr>
			
			
		
		<? $cont++;} ?>
			
		</table>

		<table border="0" width="100%">
			<tr>
				<td class="Estilo1" colspan="5">Diferencias </td>
				<td class="Estilo1"><? echo $dif ?> </td>
			</tr>
		</table>
 <hr>
</div>

</body>
</html>
