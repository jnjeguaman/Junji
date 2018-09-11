<?
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
$ses_usu_id = $_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
extract($_POST);

$sql2 = "SELECT * FROM bode_orcom where  oc_id = '$id'";
//        $sql2 = "SELECT * FROM bode_orcom,bode_proveedor where oc_pro_id = pro_id and oc_id = '$id_oc'";
//echo $sql2;
$res2 = mysql_query($sql2);
$sw_color=0;
$oc_id=$id;
$row2 = mysql_fetch_array($res2);
$v_oc_id              = $row2['oc_id'];
$v_oc_id2             = $row2['oc_id2'];
$v_oc_region          = $row2['oc_region'];
$v_oc_nombre_oc         = $row2['oc_nombre_oc'];
// $v_oc_prog_id         = $row2['oc_prog_id'];
$v_oc_fecha             = $row2['oc_fecha'];
$v_oc_fecha_recep     = $row2['oc_fecha_recep'];
// $v_oc_recibido_usu_id = $row2['oc_recibido_usu_id'];
$v_oc_pro_id          = $row2['oc_pro_id'];
$v_oc_observaciones     = $row2['oc_observaciones'];
$v_oc_estado            = $row2['oc_estado'];

$v_pro_rut              = $row2['oc_proveerut'];
// $v_pro_glosa            = $row2['pro_glosa'];


$j=0;
//echo "$j $totallinea";
while ($j<=$totallinea) {
	$var11=$var1[$j];
	$var22=$var2[$j];
	$var33=$var3[$j];
	$var44=$var4[$j];
	$var55=$var5[$j];
	$var66=$var6[$j];
  	// $var22=$var2[$cont2];
	if ($var11<>"" ) {

		$doc_id = "SELECT * FROM bode_detingreso WHERE ding_id = ".$var11;
		$doc_id = mysql_query($doc_id);
		$doc_id = mysql_fetch_array($doc_id);
		$doc_id = $doc_id["ding_prod_id"];

		$datos = "SELECT * FROM bode_detoc WHERE doc_id = ".$doc_id;
		$datos = mysql_query($datos);
		$datos = mysql_fetch_array($datos);

		//$folios.=$var1.",";
		$sql = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_unit,doc_moneda,doc_valor_moneda,doc_conversion,doc_umedida,doc_factor,doc_especificacion2,doc_item,doc_activo,doc_gasto,doc_clasificacion,doc_id_mercado_publico)
		VALUES ( '$id',       '0',            '$datos[doc_especificacion]',       '$var22',       '$var55',       '0',        '$v_oc_region', '$var11', '$var66','$datos[doc_conversion]','$datos[doc_moneda]',$datos[doc_valor_moneda],$var55,'UNIDAD',1,'$datos[doc_especificacion]','".$datos["doc_item"]."','".$datos["doc_activo"]."','".$datos["doc_gasto"]."','".$datos["doc_clasificacion"]."','".$datos["doc_id_mercado_publico"]."');";

        //echo $sql."<br>";
		//exit();
		mysql_query($sql);


		$consulta="UPDATE bode_detoc set doc_stock = doc_stock-$var22 where doc_id = $doc_id";
     	//echo $consulta."<br>";

     	// Prueba
		$update = "UPDATE bode_detingreso SET ding_unidad = ding_unidad - $var22,ding_cant_despacho	= ding_cant_despacho + $var22 WHERE ding_id = ".$var11;
     	//echo $update;
     	//exit();
		mysql_query($update);
		//exit();
		//mysql_query($consulta);
	}
	$j++;
}
//exit();
?>

<script>location.href='bode_inv_indexoc3.php?ori=<? echo $ori ?>&id=<? echo $id ?>&tipo=<?php echo $tipo?>&numoc=<?php echo $numoc ?>&grupo=<?php echo $grupo ?>&ubicacion=<?php echo $ubicacion ?>&especificacion=<?php echo $especificacion ?>';</script>
