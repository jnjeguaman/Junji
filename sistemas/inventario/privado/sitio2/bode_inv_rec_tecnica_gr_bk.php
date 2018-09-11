<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");

extract($_GET);
extract($_POST);

$usuario = $_SESSION["nom_user"];

$id_ding    = $_POST['id_ding'];
$f_aprueba  = $_POST['f_aprueba'];
$f_motivo   = $_POST['f_motivo'];
$f_cont     = $_POST['f_cont'];




 
// ==========================================================	 

// Grabo el detalle del ingreso

for ($i=1;$i<=$f_cont;$i++){
      $estado=$f_aprueba[$i];
      if ($cantidad>$f_cantidad) {
         $estado='A';
      }

    //$consulta="UPDATE   `bode_detingreso` set `ding_recep_tecnica`= '$f_aprueba[$i]',`ding_glosa_rechazo`='$f_motivo[$i]', ding_user='$usuario', ding_fecha='$fechamia' where ding_id = '$id_ding[$i]'";
      $consulta="UPDATE   `bode_detingreso` set `ding_recep_tecnica`= '$estado', ding_user='$usuario', ding_fecha='$fechamia', ding_glosa_rechazo = '$f_motivo', ding_cant_rechazo = '$f_cantidad' where ding_id = '$id_ding[$i]'";
//    $consulta="UPDATE   `bode_detingreso` set `ding_recep_tecnica`= '$estado', `ding_glosa_rechazo`='$f_motivo[$i]', ding_user='$usuario', ding_fecha='$fechamia', ding_cant_rechazo = '$f_cantidad' where ding_id = '$id_ding[$i]'";
//     echo $consulta."<br>";

     mysql_query($consulta);
	
	
if ($f_aprueba[$i]=='R') {
    if ($cantidad==$f_cantidad) {
		$consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$cantidad where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    mysql_query($consulta);
    }
    if ($cantidad>$f_cantidad) {
		$consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$f_cantidad, doc_rechazados=doc_rechazados+$f_cantidad where doc_id = '$doc_id'";
//        echo $consulta."<br>";
//        exit();
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    mysql_query($consulta);
       
       
		$consulta="UPDATE bode_detoc set doc_tecnicos = doc_tecnicos-$cantidad, doc_rechazados=doc_rechazados+$f_cantidad where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    mysql_query($consulta);

		$consulta="UPDATE bode_detoc set doc_final = doc_final+($cantidad-$f_cantidad) where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    mysql_query($consulta);

    }
}
//EXIT();
if ($f_aprueba[$i]!='R') {
//		$consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$cantidad where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
//  	    mysql_query($consulta);

/*
		$consulta="UPDATE bode_detoc set doc_stock = doc_stock+$cantidad where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    mysql_query($consulta);
       
*/
       
		$consulta="UPDATE bode_detoc set doc_tecnicos = doc_tecnicos-$cantidad where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    mysql_query($consulta);

		$consulta="UPDATE bode_detoc set doc_final = doc_final+$cantidad where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    mysql_query($consulta);
       
}



	
	
	
	// =============================================
	
	
	
	
}

//exit();
?>
<script>location.href='bode_inv_indexoc2.php?id=<? echo $id ?>&doc_id=<? echo $doc_id ?>&id_ing=<? echo $id_ing ?>&ori=4';</script>























