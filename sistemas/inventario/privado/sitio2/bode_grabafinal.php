<?
session_start();
if($_SESSION["nom_user"] =="" ){

  ?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
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

// Obtencion de los productos a actualizar
$sql = "SELECT * FROM bode_ingreso a, bode_detingreso b, bode_detoc c WHERE b.ding_ing_id = a.ing_id AND b.ding_prod_id = c.doc_id AND a.ing_id = ".$_REQUEST["id_ing"];
//echo $sql."<br><br>";
$sql = mysql_query($sql);

while ($row = mysql_fetch_array($sql)) {
	//var_dump($row);
	$cantidad = $row["ding_cantidad"] - $row["ding_cant_rechazo"];
	 
	 $consulta="UPDATE   `bode_detingreso` set ding_userf='$usuario', ding_fechaf='$fechamia' where ding_id = '".$row["ding_id"]."'";
     //echo $consulta."<br>";
     mysql_query($consulta);

     if($row["ing_estado"] <> 2)
     {
     	$consulta="UPDATE bode_detoc set doc_stock = doc_stock+$cantidad where doc_id = '".$row["doc_id"]."'";
     }
     //echo $consulta."<br>";
     mysql_query($consulta);

      $consulta="UPDATE bode_detoc set doc_final = doc_final-$cantidad where doc_id = '".$row["doc_id"]."'";
      //echo $consulta."<br>";
      mysql_query($consulta);
}

   

    //$consulta="UPDATE   `bode_detingreso` set ding_userf='$usuario', ding_fechaf='$fechamia', ding_recep_conforme = 'C' where ding_id = '$id'";
     //echo $consulta."<br>";
     //mysql_query($consulta);
	

//--- Se procede a la actualizacion del stock
		//$consulta="UPDATE bode_detoc set doc_stock = doc_stock+$cantidad where doc_id = '$doc_id'";
        //echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    //mysql_query($consulta);
       


//--- Se procede a la actualizacion del la recepcion final o conforme
		//$consulta="UPDATE bode_detoc set doc_final = doc_final-$cantidad where doc_id = '$doc_id'";
     	//echo $consulta."<br>";
//	    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
  	    //mysql_query($consulta);
       




	
	
	
	// =============================================
	
	
	
	

//exit();
?>
<script>location.href='bode_inv_indexoc2.php?id=<? echo $id ?>&doc_id=<? echo $doc_id ?>&id_ing=<? echo $id_ing ?>&ori=6';</script>






















