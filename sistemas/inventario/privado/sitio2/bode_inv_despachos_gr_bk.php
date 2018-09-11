<?
session_start();
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
$v_oc_prog_id         = $row2['oc_prog_id'];
$v_oc_fecha             = $row2['oc_fecha'];
$v_oc_fecha_recep     = $row2['oc_fecha_recep'];
$v_oc_recibido_usu_id = $row2['oc_recibido_usu_id'];
$v_oc_pro_id          = $row2['oc_pro_id'];
$v_oc_observaciones     = $row2['oc_observaciones'];
$v_oc_estado            = $row2['oc_estado'];

$v_pro_rut              = $row2['oc_proveerut'];
$v_pro_glosa            = $row2['pro_glosa'];


$j=0;
//echo "$j $totallinea";
while ($j<=$totallinea) {
	$var11=$var1[$j];
	$var22=$var2[$j];
	$var33=$var3[$j];
	$var44=$var4[$j];
	$var55=$var5[$j];
	$var66=$var6[$j];
	$var77=$var7[$j]; //Clasificacion
	$var88=$var8[$j]; //Ding_ID
	$var99=$var9[$j]; //CODIGO DE INVENTARIO
	$var100=$var10[$j];//inv_id
  	// $var22=$var2[$cont2];
	if ($var11<>"" ) {


		//VERIFICAMOS EL TIPO DE CLASIFICACION
		if($var77 == 1)
		{
			$_SESSION["Inventario"][] = array("inv_id" =>$var100,"inv_codigo" =>$var99);
			$datos = "SELECT * FROM bode_detoc WHERE doc_id = ".$var77;
			$datos = mysql_query($datos);
			$datos = mysql_fetch_array($datos);

			//DISMINUIMOS EL STOCK
			$consulta="UPDATE bode_detoc set doc_stock = doc_stock-$var22 where doc_id = $var77";
			mysql_query($consulta);
			//DISMINUIMOS LA CANTIDAD RECIBIDA
			$update = "UPDATE bode_detingreso SET ding_unidad = ding_unidad - $var22 WHERE ding_id = ".$var88;
			mysql_query($update);
			//INGRESAMOS EL PRODUCTO A LA GUIA DE DESPACHO
			$sql = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_unit,doc_moneda,doc_valor_moneda,doc_conversion,doc_umedida,doc_factor,doc_especificacion2,doc_inv_codigo) VALUES ( '$id',       '0',            '$datos[doc_especificacion]',       '$var22',       '$var55',       '0',        '$v_oc_region', '$var11', '$var66',$datos[doc_unit],'$datos[doc_moneda]',$datos[doc_valor_moneda],'$datos[doc_conversion]','UNIDAD',1,'$datos[doc_especificacion]','$var99' );";
			mysql_query($sql);	
		}else{

			//BUSCAMOS EL DOC_ID
			$doc_id = "SELECT * FROM bode_detingreso WHERE ding_id = ".$var11;
			$doc_id = mysql_query($doc_id);
			$doc_id = mysql_fetch_array($doc_id);
			$doc_id = $doc_id["ding_prod_id"];

			//DETALLE DEL PRODUCTO
			$datos = "SELECT * FROM bode_detoc WHERE doc_id = ".$doc_id;
			$datos = mysql_query($datos);
			$datos = mysql_fetch_array($datos);

			//INGRESAMOS EL PRODUCTO A LA GUIA DE DESPACHO
			$sql = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_unit,doc_moneda,doc_valor_moneda,doc_conversion,doc_umedida,doc_factor,doc_especificacion2) VALUES ( '$id',       '0',            '$datos[doc_especificacion]',       '$var22',       '$var55',       '0',        '$v_oc_region', '$var11', '$var66',$datos[doc_unit],'$datos[doc_moneda]',$datos[doc_valor_moneda],$datos[doc_conversion],'UNIDAD',1,'$datos[doc_especificacion]' );";
			mysql_query($sql);
			//DISMINUIMOS EL STOCK
			$consulta="UPDATE bode_detoc set doc_stock = doc_stock-$var22 where doc_id = $doc_id";
     		mysql_query($consulta);
     		//DISMINUIMOS LA CANTIDAD RECIBIDA
			$update = "UPDATE bode_detingreso SET ding_unidad = ding_unidad - $var22 WHERE ding_id = ".$var11;
			mysql_query($update);
			
		}

	}
	$j++;
}
?>

<script>location.href='bode_inv_indexoc3.php?ori=<? echo $ori ?>&id=<? echo $id ?>';</script>