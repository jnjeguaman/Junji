<?php
$color = 'style="background-color:greenyellow;"';
$color2 = 'style="background-color:khaki;"';
$color3 = 'style="background-color:lightgreen;"';
?>
<div  style="width:630px; background-color:#E0F8E0; position:absolute; top:120px; left:810px;" id="div2">
	<table border="1" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="7">SOLICITUDES DE PEDIDO PENDIENTES DE ENVÍO</td>
		</tr>

		<tr>
			<td class="Estilo1mc">ID</td>
			<td class="Estilo1mc">N° PEDIDO</td>
			<td class="Estilo1mc">N° IDENTIFICADOR MATRIZ</td>
			<td class="Estilo1mc">FECHA SOLICITUD</td>
			<td class="Estilo1mc">DESTINO</td>
			<td class="Estilo1mc">EDITAR</td>
			<td class="Estilo1mc">ELIMINAR</td>
		</tr>

		<?php 
		$sql = "SELECT * FROM bode_solicitud WHERE sp_estado = 0 AND sp_region = ".$regionsession." AND sp_usuario = '".$nom_user."'";
		$res = mysql_query($sql);
		while($row = mysql_fetch_array($res))
			{ ?>
		<tr <?php if($id==$row["sp_id"]){echo$color;} ?>>
			<td class="Estilo1mc"><?php echo $row["sp_id"] ?></td>
			<td class="Estilo1mc"><?php echo ($row["sp_folio"] == 0 || $row["sp_folio"] == "") ? "FOLIO SIN ASIGNAR" : "" ?></td>
			<td class="Estilo1mc"><?php echo($row["sp_matriz"] == NULL) ? "SIN MATRIZ" : $row["sp_matriz"] ?></td>
			<td class="Estilo1mc"><?php echo substr($row["sp_fecha"], 8,9)."-".substr($row["sp_fecha"], 5,2)."-".substr($row["sp_fecha"],0,4) ?></td>
			<td class="Estilo1mc"><?php echo $row["sp_destino"] ?> / <?php echo ($row["sp_tipo_destino"] == 2) ? "OFICINA" : "JARDIN INFANTIL" ?></td>
			<td class="Estilo1mc"><a href="bode_inv_indexoc7.php?ori=2&id=<?php echo $row["sp_id"] ?>&sp_matriz=<?php echo $row["sp_matriz"] ?>" class="link"><i class="fa fa-pencil"></i></a></td>
			<td class="Estilo1mc"><a href="bode_solicitud_eliminar.php?id=<?php echo $row["sp_id"] ?>" onClick="return confirm('¿ ESTÁ SEGURO DE ELIMINAR LA SOLICITID N° <?php echo $row["sp_id"] ?>  ?')"><i class="fa fa-trash link fa-lg"></i></a></td>
		</tr>
		<? } ?>
	</table>
<hr>
	<!-- SOLICITUDES ENVIADAS PERO PENDIENTES DE DESPACHO -->
	<table border="1" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="6">SOLICITUDES DE PEDIDO PENDIENTES DE DESPACHO</td>
		</tr>

		<tr>
			<td class="Estilo1mc">ID</td>
			<td class="Estilo1mc">N° PEDIDO</td>
			<td class="Estilo1mc">N° IDENTIFICADOR MATRIZ</td>
			<td class="Estilo1mc">FECHA SOLICITUD</td>
			<td class="Estilo1mc">DESTINO</td>
			<td class="Estilo1mc">VER</td>
		</tr>

		<?php 
		$sql = "SELECT * FROM bode_solicitud WHERE sp_estado = 1 AND sp_region = ".$regionsession." AND sp_usuario = '".$nom_user."'";
		$res = mysql_query($sql);
		while($row = mysql_fetch_array($res))
			{ ?>
		<tr <?php echo$color2 ?>>
			<td class="Estilo1mc"><?php echo $row["sp_id"] ?></td>
			<td class="Estilo1mc"><?php echo $row["sp_folio"] ?></td>
			<td class="Estilo1mc"><?php echo($row["sp_matriz"] == NULL) ? "SIN MATRIZ" : $row["sp_matriz"] ?></td>
			<td class="Estilo1mc"><?php echo substr($row["sp_fecha"], 8,9)."-".substr($row["sp_fecha"], 5,2)."-".substr($row["sp_fecha"],0,4) ?></td>
			<td class="Estilo1mc"><?php echo $row["sp_destino"] ?> / <?php echo ($row["sp_tipo_destino"] == 2) ? "OFICINA" : "JARDIN INFANTIL" ?></td>
			<td class="Estilo1mc"><a href="#" onClick="abrirVentana(<?php echo $row["sp_id"] ?>)"><i class="fa fa-eye fa-lg"></i></a></td>
		</tr>
		<? } ?>
	</table>

<hr>

	<!-- SOLICITUDES 100% DESPACHADA -->
	<table border="1" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="6">SOLICITUDES DE PEDIDO COMPLETADAS</td>
		</tr>

		<tr>
			<td class="Estilo1mc">ID</td>
			<td class="Estilo1mc">N° PEDIDO</td>
			<td class="Estilo1mc">N° IDENTIFICADOR MATRIZ</td>
			<td class="Estilo1mc">FECHA SOLICITUD</td>
			<td class="Estilo1mc">DESTINO</td>
			<td class="Estilo1mc">VER</td>
		</tr>

		<?php 
		$sql = "SELECT * FROM bode_solicitud WHERE sp_estado = 2 AND sp_region = ".$regionsession." AND sp_usuario = '".$nom_user."'";
		$res = mysql_query($sql);
		while($row = mysql_fetch_array($res))
			{ ?>
		<tr <?php if($id==$row["sp_id"]){echo$color;}else{echo$color3;} ?>>
			<td class="Estilo1mc"><?php echo $row["sp_id"] ?></td>
			<td class="Estilo1mc"><?php echo $row["sp_folio"] ?></td>
			<td class="Estilo1mc"><?php echo($row["sp_matriz"] == NULL) ? "SIN MATRIZ" : $row["sp_matriz"] ?></td>
			<td class="Estilo1mc"><?php echo substr($row["sp_fecha"], 8,9)."-".substr($row["sp_fecha"], 5,2)."-".substr($row["sp_fecha"],0,4) ?></td>
			<td class="Estilo1mc"><?php echo $row["sp_destino"] ?> / <?php echo ($row["sp_tipo_destino"] == 2) ? "OFICINA" : "JARDIN INFANTIL" ?></td>
			<td class="Estilo1mc"><a href="#" onClick="abrirVentana(<?php echo $row["sp_id"] ?>)"><i class="fa fa-eye fa-lg"></i></a></td>
		</tr>
		<? } ?>
	</table>
</div>

<script type="text/javascript">
	function abrirVentana(id)
	{
		window.open("bode_solicitud_popup_detalle.php?id="+id,"miwin","channelmode=0,directories=0,fullscreen=0,height=500,location=0,menubar=0,resizable=0,scrollbars=1,status=0,titlebar=0,toolbar=0,width=1000")
	}
</script>