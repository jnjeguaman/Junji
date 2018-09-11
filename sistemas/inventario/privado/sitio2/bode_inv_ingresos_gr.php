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
$nombrecom = $_SESSION["nombrecom"];
extract($_POST);
$f_guia    = $_POST['f_guia'];
$f_region  = $_POST['f_region'];
$f_doc_id  = $_POST['f_doc_id'];
$f_cant    = $_POST['f_cant'];
$f_cont    = $_POST['f_cont'];
$id_oc     = $_POST['id_oc'];
$ori     = $_POST['ori'];
$lentrega = $_POST["lentrega"];
$gesparvu = trim(str_replace("JI ","",$_POST["gesparvu"]));
// echo $ori;
// echo $oc_tipo;
/*
OC TIPO
1 : GUIA DE DESPACHO
0 : ORDEN DE COMPRA
*/
// exit();

//echo "guia:",$f_guia," cont :",$f_cont," oc:",$id_oc;

// Graba el encabezado del ingreso ==========================

if($lentrega == 1 || $lentrega == 3)
{
$consulta="INSERT INTO  `bode_ingreso` (`ing_id` ,`ing_guia` ,`ing_oc_id` ,`ing_fecha` ,`ing_recib_usu_id`,`ing_estado`,`ing_clasificacion`,`ing_region`)
VALUES (NULL ,  '$f_guia',  '$id_oc',  '$fechamia',  '$ses_usu_id',2,0,'$regionsession')";
}else{
$consulta="INSERT INTO  `bode_ingreso` (`ing_id` ,`ing_guia` ,`ing_oc_id` ,`ing_fecha` ,`ing_recib_usu_id`,`ing_estado`,`ing_clasificacion`,`ing_region`)
VALUES (NULL ,  '$f_guia',  '$id_oc',  '$fechamia',  '$ses_usu_id',1,0,'$regionsession')";
}

mysql_query($consulta);

$rs=mysql_query("select @@identity as id");
if ($row=mysql_fetch_row($rs)) {
	$id_ultimo = trim($row[0]);
}

if($oc_tipo == 1)
{
$consulta = "UPDATE bode_ingreso SET ing_aprobado = '".$nombrecom."' WHERE ing_id = ".$id_ultimo;
mysql_query($consulta);
}

if($oc_tipo == 1)
{
	$consulta = "UPDATE bode_ingreso SET ing_clasificacion = 1 WHERE ing_id = ".$id_ultimo;
	mysql_query($consulta);
}

// ==========================================================	 
$horaSys = Date("H:i:s");

// Grabo el detalle del ingreso

for ($i=1;$i<=$f_cont;$i++){
	if($var1[$i] <> ""){

		$consulta="select * from bode_detoc where doc_id =  '$f_doc_id[$i]' ";
		$res=mysql_query($consulta);
		while ($arr=mysql_fetch_array($res)){
			
			$v_doc_prod_id   = $arr['doc_id'];
//	      $v_doc_prod_id   = $arr['doc_prod_id'];
			$v_doc_cantidad  = $arr['doc_cantidad'];
			$v_doc_recibidos = $arr['doc_recibidos'];
			$v_doc_estado    = $arr['doc_estado'];
			$v_doc_umedida   = $arr["doc_umedida"];
			$v_doc_cantidad = $arr["doc_cantidad"];
		  // UNIDAD DE MEDIDA
			$v_doc_umedida    = $arr["doc_umedida"];
			$v_doc_factor     = $arr["doc_factor"];
		}

		if($oc_tipo == 1)
		{
			$consulta="INSERT INTO bode_detingreso (ding_id, ding_ing_id, ding_prod_id, `ding_cantidad` ,`ding_region_id` ,`ding_recep_tecnica` ,`ding_cant_conf` ,`ding_cant_despacho` ,`ding_cant_final` ,`ding_cant_rechazo` ,`ding_glosa_rechazo`, `ding_ubicacion`,`ding_fentrega`,ding_umedida,ding_factor,ding_recep_conforme,ding_unidad,ding_clasificacion)
			VALUES                                    (NULL ,     '$id_ultimo',  '$v_doc_prod_id',  '$f_cant[$i]',  '$regionsession',  'A',  '$f_cant[$i]',  '0',  '$f_cant[$i]',  '$f_cant[$i]',  '','$f_ubica[$i]','$f_fentrega','$v_doc_umedida',$v_doc_factor,'C',ding_cantidad,'".$var2[$i]."')";
		}else{
			if($lentrega == 1 || $lentrega == 3)
			{
				$lugarEntrega = ($gesparvu <> "") ? $gesparvu : $direccionRegional;
				$consulta="INSERT INTO bode_detingreso (ding_id, ding_ing_id, ding_prod_id, `ding_cantidad` ,`ding_region_id` ,`ding_recep_tecnica` ,`ding_cant_conf` ,`ding_cant_despacho` ,`ding_cant_final` ,`ding_cant_rechazo` ,`ding_glosa_rechazo`, `ding_ubicacion`,`ding_fentrega`,ding_umedida,ding_factor,ding_recep_conforme,ding_unidad)
				VALUES                                    (NULL ,     '$id_ultimo',  '$v_doc_prod_id',  '$f_cant[$i]',  '$regionsession',  '0',  '$f_cant[$i]',  '0',  '$f_cant[$i]',  '0',  '','$lugarEntrega','$f_fentrega','$v_doc_umedida',$v_doc_factor,'C',ding_cantidad)";
			}else{
				$consulta="INSERT INTO bode_detingreso (ding_id, ding_ing_id, ding_prod_id, `ding_cantidad` ,`ding_region_id` ,`ding_recep_tecnica` ,`ding_cant_conf` ,`ding_cant_despacho` ,`ding_cant_final` ,`ding_cant_rechazo` ,`ding_glosa_rechazo`, `ding_ubicacion`,`ding_fentrega`,ding_umedida,ding_factor)
				VALUES (NULL ,     '$id_ultimo',  '$v_doc_prod_id',  '$f_cant[$i]',  '$regionsession',  '0',  '0',  '0',  '$f_cant[$i]',  '0',  '','$f_ubica[$i]','$f_fentrega','$v_doc_umedida',$v_doc_factor)";
			}
		}
		mysql_query($consulta);
    //echo $consulta."<br>";

		if (($v_doc_recibidos +  $f_cant[$i]) >= $v_doc_cantidad){
			$v_doc_estado = "CO";
		}
		     // $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos+'$f_cant[$i]', doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
		if($oc_tipo == 1)
		{
			$consulta="UPDATE bode_detoc set doc_stock = doc_stock + $f_cant[$i], doc_recibidos = doc_recibidos+'$f_cant[$i]', doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
		}else{
			if($lentrega == 1 || $lentrega == 3)
			{
				$consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos+'$f_cant[$i]', doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
			}else{
				$consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos+'$f_cant[$i]', doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
			}
			
		}
		mysql_query($consulta);

		if($oc_tipo == 1)
		{
			$consulta="UPDATE bode_detoc set doc_tecnicos = 0, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
		}else{
			if($lentrega == 1 || $lentrega == 3)
			{
				$consulta="UPDATE bode_detoc set doc_tecnicos = doc_tecnicos + $f_cant[$i], doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
			}else{
				$consulta="UPDATE bode_detoc set doc_tecnicos = doc_tecnicos+'$f_cant[$i]', doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
			}
		}
		mysql_query($consulta);

		$log = "INSERT INTO log VALUES(NULL,".$v_doc_prod_id.",".$f_cant[$i].",'INGRESO PRODUCTO BODEGA','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','INGRESO BODEGA')";
		mysql_query($log);

	// =============================================

//	echo "cont : ",$i,"f_doc_id :", $f_doc_id[$i]," f_cant:", $f_cant[$i]," f_region:",$f_region[$i],"<br>";
	}

}
// ACTUALIZA ORDEN DE COMPRA
	// VERIFICA SI ESTA COMPLETADA
$consulta="select * from bode_detoc where doc_id =  '$f_doc_id[$i]' ";
$res=mysql_query($consulta);
$estado="CO";
while ($arr=mysql_fetch_array($res)){
	$v_doc_prod_id   = $arr['doc_id'];
//	      $v_doc_prod_id   = $arr['doc_prod_id'];
	$v_doc_cantidad  = $arr['doc_cantidad'];
	$v_doc_recibidos = $arr['doc_recibidos'];
	$v_doc_estado    = $arr['doc_estado'];

	if ($v_doc_estado=="PE"){
		$estado="PE";
	}
}

if ($estado == "C"){
	$consulta="UPDATE orcom set oc_estado = 'CO' where oc_id = '$id_oc'";
	mysql_query($consulta);
}


if($lentrega == 1 || $lentrega == 3)
{
	$folio = mysql_query("SELECT max(folio_numero) as Folio FROM bode_folio");
	$folio = mysql_fetch_array($folio);
	$folio = $folio["Folio"] + 1;
	mysql_query("UPDATE bode_folio SET folio_numero = ".$folio);

	$lugarEntrega = ($gesparvu <> '') ? $gesparvu : $direccionRegional;

	if(mysql_query("INSERT INTO bode_orcom (oc_id2,oc_fecha,oc_folioguia,oc_region,oc_tipo,oc_usu,oc_guiadestina,oc_guiaabaste,oc_tipo_guia) 
		VALUES (".$id_oc.",'".Date("Y-m-d")."',".$folio.",".$_SESSION["region"].",1,'".$_SESSION["nombrecom"]."','".$lugarEntrega."','".$_POST["proveedor"]."',4)"))
	{

		$rs=mysql_query("select @@identity as id");
		if ($row=mysql_fetch_row($rs)) {
			$oc_id = trim($row[0]);
		}
		
		$q = mysql_query("SELECT * FROM bode_detingreso WHERE ding_ing_id = ".$id_ultimo);
		while($rd = mysql_fetch_array($q))
		{	
			$prodet = mysql_query("SELECT * FROM bode_detoc WHERE doc_id = ".$rd["ding_prod_id"]);
			$prodet = mysql_fetch_array($prodet);
			$s = "INSERT INTO bode_detoc (doc_oc_id,     doc_origen_id,     doc_cantidad,                     doc_especificacion,         doc_conversion) 
			VALUES (".$oc_id.",".$rd["ding_prod_id"].",".$rd["ding_cantidad"].",'".$prodet["doc_especificacion"]."',".$prodet["doc_conversion"].")";
			mysql_query($s);
		}

	}else{
		echo "ERROR : ".mysql_errno();
	}
}
?>



<script>location.href='bode_inv_indexoc2.php?cod=20&id_oc=<? echo $id_oc ?>';</script>























