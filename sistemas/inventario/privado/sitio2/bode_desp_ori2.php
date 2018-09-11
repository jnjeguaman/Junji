<!-- ULTIMOS DOCUMENTOS GENERADOS -->
<div  style="width:730px; background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">
<?php include("bode_desp_buscar.php") ?>
<br>
	<table border="1" width="100%" cellpadding="3">
		<?php
		$limite = 20;
		if($page <> '' AND is_numeric($page))
		{
			$page = $page;
		}else{
			$page = 1;
		}
		$start = ($page - 1) * $limite;

		$ultimosDespachos = "SELECT * FROM bode_folios WHERE folio_tipo = '0' AND folio_estado = 1 AND folio_region = ".$_SESSION["region"]." ORDER BY folio_id DESC";
		$resUltimosDespachos = mysql_query($ultimosDespachos);
		$numRows = mysql_num_rows($resUltimosDespachos);
		$paginas = ceil($numRows / $limite);
		$ultimosDespachos = "SELECT * FROM bode_folios WHERE folio_tipo = '0' AND folio_estado = 1 AND folio_region = ".$_SESSION["region"]." ORDER BY folio_id DESC LIMIT $start,$limite";	
		$resUltimosDespachos = mysql_query($ultimosDespachos);
		?>
		<tr>
			<td  class="Estilo2titulo" colspan="6">ULTIMOS DOCUMENTOS GENERADOS</td>
		</tr>

		<tr>
			<td class="Estilo1mc">FOLIO</td>
			<td class="Estilo1mc">FECHA CREACION</td>
			<td class="Estilo1mc">HORA CREACION</td>
			<td class="Estilo1mc">USUARIO</td>
			<td class="Estilo1mc">VER GUIA</td>
		</tr>

		<?php while($rowUltimosDespachos = mysql_fetch_array($resUltimosDespachos)) { ?>
		<tr class="trh">
			<td class="Estilo1mc"><?php echo $rowUltimosDespachos["folio_despacho"] ?></td>
			<td class="Estilo1mc"><?php echo $rowUltimosDespachos["folio_fecha"] ?></td>
			<td class="Estilo1mc"><?php echo $rowUltimosDespachos["folio_hora"] ?></td>
			<td class="Estilo1mc"><?php echo $rowUltimosDespachos["folio_usr"] ?></td>
			<td class="Estilo1mc"><a href="reporte/reporte2.php?folio=<?php echo $rowUltimosDespachos["folio_despacho"] ?>" target="_blank"><i class="fa fa-file link fa-lg"></i></a></td>
		</tr>
		<?php } ?>

		<?php 
		mysql_free_result($resUltimosDespachos);
		$paginator ="<ul class='pagination pull-right'>";
		$paginator .="<li><a href='bode_desp.php?cod=46&page=1'><i class='fa fa-angle-double-left'></i></a></li>";

		if($page - 1 == 0)
		{
		}else if($page - 1 < 1){
			$paginator .="<li><a href='bode_desp.php?cod=46&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
		}else{
			$paginator .="<li><a href='bode_desp.php?cod=46&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
		}

		for ($i=1; $i<=$paginas; $i++) { 
			$paginator .="<li id='pagination_".$i."'><a href='bode_desp.php?cod=46&page=".$i."'>".$i."</a></li>"; 
		}; 

		if($page + 1 > $paginas)
		{

		}else{
			$paginator .="<li><a href='bode_desp.php?cod=46&page=".($page+1)."'><i class='fa fa-angle-right'></i></a></li>";
		}
$paginator .="<li><a href='bode_desp.php?cod=46&page=$paginas'><i class='fa fa-angle-double-right'></i></a></li></ul>"; // Goto last page
?>

<tr>
	<td colspan="5"><?php echo $paginator ?></td>
</tr>
</table>
</div>

<script type="text/javascript">
	$(function(){
		$("#pagination_<? echo  $page ?>").addClass("active");
	})
	
</script>