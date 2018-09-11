<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");

$ses_usu_id = $_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);
$f_guia    = $_POST['f_guia'];
$f_region  = $_POST['f_region'];
$f_doc_id  = $_POST['f_doc_id'];
$f_cant    = $_POST['f_cant'];
$f_cont    = $_POST['f_cont'];
$id_oc     = $_POST['id_oc'];

//echo "guia:",$f_guia," cont :",$f_cont," oc:",$id_oc;

// Graba el encabezado del ingreso ==========================

     $consulta="INSERT INTO  `bode_ingreso` (`ing_id` ,`ing_guia` ,`ing_oc_id` ,`ing_fecha` ,`ing_recib_usu_id`)
                                     VALUES (NULL ,  '$f_guia',  '$id_oc',  '$fechamia',  '$ses_usu_id')";
     mysql_query($consulta);
  
     $rs=mysql_query("select @@identity as id");
	 if ($row=mysql_fetch_row($rs)) {
		$id_ultimo = trim($row[0]);
	 }
 
// ==========================================================	 

// Grabo el detalle del ingreso

for ($i=1;$i<=$f_cont;$i++){

    $consulta="select * from bode_detoc where doc_id =  '$f_doc_id[$i]' ";
	$res=mysql_query($consulta);
	while ($arr=mysql_fetch_array($res)){
	      $v_doc_prod_id   = $arr['doc_id'];
//	      $v_doc_prod_id   = $arr['doc_prod_id'];
		  $v_doc_cantidad  = $arr['doc_cantidad'];
		  $v_doc_recibidos = $arr['doc_recibidos'];
		  $v_doc_estado    = $arr['doc_estado'];
	}

    $consulta="INSERT INTO  `bode_detingreso` (`ding_id` ,`ding_ing_id` ,`ding_prod_id` ,`ding_cantidad` ,`ding_region_id` ,`ding_recep_tecnica` ,`ding_cant_conf` ,`ding_cant_despacho` ,`ding_cant_final` ,`ding_cant_rechazo` ,`ding_glosa_rechazo`)
                                       VALUES (NULL ,     '$id_ultimo',  '$v_doc_prod_id',  '$f_cant[$i]',  '$regionsession',  '0',  '0',  '0',  '$f_cant[$i]',  '0',  '')";
    mysql_query($consulta);
//    echo $consulta."<br>";
	

//    if (($v_doc_recibidos +  $f_cant[$i]) >= $v_doc_cantidad){
//	      $v_doc_estado = "CO";
//	}
	$consulta="UPDATE bode_detoc set doc_despachos = doc_recibidos+'$f_cant[$i]', doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
	mysql_query($consulta);


	
	
	// =============================================
	
	
	
//	echo "cont : ",$i,"f_doc_id :", $f_doc_id[$i]," f_cant:", $f_cant[$i]," f_region:",$f_region[$i],"<br>";
}

// exit();

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
	



?>



 <script>location.href='inv_indexoc2.php?ori=1&id_oc=<? echo $id_oc ?>';</script>























