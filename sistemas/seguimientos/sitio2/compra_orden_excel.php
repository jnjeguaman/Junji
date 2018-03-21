<?php
session_start();
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=REPORTE_ORDEN_DE_COMPRA.xls");

extract($_GET);
require_once("inc/config.php");

if(isset($_GET["f_inicio"]) && $_GET["f_inicio"] <> "")
{
	$where.="oc_fechacompra >= '".$_GET["f_inicio"]."' AND ";
}

if(isset($_GET["f_termino"]) && $_GET["f_termino"] <> "")
{
	$where.="oc_fechacompra <= '".$_GET["f_termino"]."' AND ";
}

if($_GET["f_inicio"] == "" && $_GET["f_termino"] == "")
{
	$where.="oc_fechacompra <= '".date("Y-m-d")."' AND ";
}

if(isset($_GET["clasificador"]) && $_GET["clasificador"] <> "")
{
	$where.="oc_tipo2 = '".$_GET["clasificador"]."' AND ";
}

if(isset($_GET["mis_ordenes"]) && $_GET["mis_ordenes"] <> 0)
{
	$where.="oc_user = '".$_SESSION["nom_user"]."' AND ";
}

$sql="select * from compra_orden where oc_region=".$region." and ".$where." oc_fpago='' and  oc_emitidapor='' and oc_nombre<>'' and year(oc_fechacompra)='$anno2' and (oc_monto<>'0' or (oc_estado='CANCELADA/ELIMINADA/RECHAZADA' and oc_monto='0' )) order by oc_id desc";

?>

<table border="1" style="border-collapse: collapse;" width="100%">
	<tr>
		<th style="background: #BFBFBF">N&deg;</th>
		<th style="background: #BFBFBF">N&deg; O.C. </th>
		<th style="background: #BFBFBF">Nombre</th>
		<th style="background: #BFBFBF">Fecha </th>
		<th style="background: #BFBFBF">Tipo Contrataci&oacute;n</th>
		<th style="background: #BFBFBF">Nombre Proveedor</th>
		<th style="background: #BFBFBF">Monto</th>
		<th style="background: #BFBFBF">Moneda</th>
		<th style="background: #BFBFBF">Estado</th>
		<th style="background: #BFBFBF">Tipo</th>
	</tr>

	<?
	$res3 = mysql_query($sql);
	$cont=1;
	$cont2=mysql_num_rows($res3);

	while($row3 = mysql_fetch_array($res3)){
		$octipo=$row3["oc_tipo"];
		if ($octipo>=14 and $octipo<=19) {
			$sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$octipo";
			$consulta=mysql_query($sql33);
			$registro=mysql_fetch_array($consulta);
			$octipo2=$registro["cat_nombre"];
		} else {
			$octipo2=$octipo;
		}
		?>
		<tr>
			<td><? echo $cont2 ?> </td>
			<td><? echo $row3["oc_numero"] ?> </td>
			<td><? echo utf8_decode($row3["oc_nombre"])  ?></td>
			<td><? echo substr($row3["oc_fechacompra"],8,2)."-".substr($row3["oc_fechacompra"],5,2)."-".substr($row3["oc_fechacompra"],0,4)   ?></td>
			<td><? echo $octipo2 ?> </td>
			<td><? echo $row3["oc_rsocial"]  ?></td>
			<td>$<? echo number_format($row3["oc_monto"],0,',','.');  ?></td>
			<td><?php echo $row3["oc_moneda"] ?></td>
			<td><? echo substr($row3["oc_estado"],0,6);  ?></td>
			<td><?php echo $row3["oc_tipo2"] ?></td>

		</tr>
		<?
		$cont++;
		$cont2--;
	}

	?>
</table>