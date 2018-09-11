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
extract($_GET);

if($oc_wms <> "" && $origen_id == 0)
{
// BUSCAMOS EL DETALLE DEL PRODUCTO
  $sql = "SELECT * FROM bode_detoc WHERE doc_id = ".$doc_id;
  $res = mysql_query($sql);
  $row = mysql_fetch_array($res);

  $sql2 = "SELECT * FROM bode_detoc a inner join bode_detingreso b on a.doc_id = b.ding_prod_id where b.ding_ubicacion = 'CD - DIRNAC' AND a.doc_numerooc = '".$row["doc_numerooc"]."' LIMIT 1";
  $res2 = mysql_query($sql2);
  $row2 = mysql_fetch_array($res2);
  
  // MODIFICAMOS EL STOCK
  $sql3 = "UPDATE bode_detingreso SET ding_unidad = ding_unidad + ".$row["doc_cantidad"]." where ding_id = ".$row2["ding_id"];
  // echo $sql3;
  mysql_query($sql3);

  // BUSCAMOS LA POSICION DE ESE PRODUCTO EN LA BASE DE DATOS
  $sql4 = "update bode_detoc set doc_estado='ELIMINADO' where doc_id=$doc_id ";
  mysql_query($sql4);
}else{

//       $folios.=$var1.",";
       $sql = "update bode_detoc set doc_estado='ELIMINADO' where doc_id=$doc_id ";
       //echo $sql."<br>";
//exit();
        mysql_query($sql);
        
        $update = "UPDATE bode_detingreso SET ding_unidad = ding_unidad + $cantidad,ding_cant_despacho = ding_cant_despacho - $cantidad WHERE ding_id = ".$doc_id2;
        //echo $update."<br>";

        $doc_id = "SELECT ding_prod_id FROM bode_detingreso WHERE ding_id = ".$doc_id2;
    $doc_id = mysql_query($doc_id);
    $doc_id = mysql_fetch_array($doc_id);
    $doc_id = $doc_id["ding_prod_id"];
        //exit();
    $consulta="UPDATE bode_detoc set doc_stock = doc_stock+$cantidad where doc_id = '$doc_id'";
      //echo $consulta."<br>";
        //mysql_query($consulta);
        mysql_query($update);
//exit();

}

?>

 <script>location.href='bode_inv_indexoc3.php?ori=<? echo $ori ?>&id=<? echo $id ?>';</script>