<?
require("inc/config.php");
    $id2=$_POST['id2'];
    $tipodoc=$_POST['tipodoc'];
//consulta todos los empleados
if  ($tipodoc==2) {
  $sql5="select * from dpp_honorarios x, dpp_etapas y where eta_id=$id2 and hono_eta_id=eta_id ";
//echo "---->".$sql5;
  $res=mysql_query($sql5);
  $row = mysql_fetch_array($res);
  echo $row['eta_folio']."|".$row['eta_servicio_final']."|".$row['eta_numero']."|".$row['eta_fechache']."|".$row['eta_rut']."-".$row['eta_dig']."|".$row['hono_archivo']."|".$row['eta_cli_nombre']."|".$row['hono_doc1']."|".$row['eta_monto']."|".$row['hono_doc2']."|".$row['eta_neto']."|".$row['eta_monto2'];
}
if  ($tipodoc==1) {
  $sql5="select * from dpp_facturas x, dpp_etapas y where eta_id=$id2 and fac_eta_id=eta_id ";
//echo "---->".$sql5;
  $res=mysql_query($sql5);
  $row = mysql_fetch_array($res);
  echo $row['eta_folio']."|".$row['fac_servicio']."|".$row['eta_numero']."|".$row['eta_fechache']."|".$row['eta_rut']."-".$row['eta_dig']."|".$row['fac_archivo']."|".$row['eta_cli_nombre']."|".$row['fac_doc1']."|".$row['eta_monto']."|".$row['fac_doc2']."|".$row['eta_neto']."|".$row['eta_monto2'];
//    $a=$row['apellido'];
}
?>


