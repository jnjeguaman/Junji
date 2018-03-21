<?
session_start();
require("inc/config.php");
require("inc/querys.php");
date_default_timezone_set('America/Santiago');
$fechamia=date('Y-m-d');
$fechamia2=date('d-m-Y');
$horamia=date('H:i:s');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];
$nivelmio = $_SESSION["pfl_user"];
$id=$_POST["id"];
$id2=$_POST["id2"];
$folio=$_POST["folio"];
$accion=$_POST["accion"];
$justifica=$_POST["justifica"];
$comentario=$_POST["comentario"];
$fechavb=$_POST["fechavb"];
$fechavb= substr($fechavb,6,4)."-".substr($fechavb,3,2)."-".substr($fechavb,0,2);

if($_POST["vb"] <> "")
{
mysql_query("UPDATE dpp_etapas SET eta_tipo = '".$_POST["vb"]."' WHERE eta_id = '$id2'");

if($_POST["vb"] == "SERVICIO")
{
  mysql_query("UPDATE dpp_etapas SET eta_dias = ".$_POST["dias"]." WHERE eta_id = '$id2'");
}
}

//echo $accion;
if ($accion=="2" ) {

  $sql3="  update dpp_etapas set eta_subestado=1, eta_fecha_aprobacionok='$fechavb' where eta_id='$id2' ";
  //echo $sql3;
//  exit();
  mysql_query($sql3);

}


if ($accion=="3" ) {

      $sql1="update dpp_etapas set eta_estado=12, eta_destinatario2 = '', eta_rechaza_motivo4='',  eta_usu_recepcion2='$usuario', eta_fecha_recepcion2='$fechamia', eta_rechaza_motivo='$justifica' where eta_id=$id2 ";
      //echo $sql1;
      mysql_query($sql1);

      $sql2="insert into dpp_etapa_log (log_usr,log_fechasys,log_horasys,log_dpp_eta_id,log_origen,log_destino,log_motivo,log_estado,log_folio) values ('$usuario','$fechamia2','$horamia','$id2','$nivelmio','3','$justifica','Devuelto','$folio')";
      mysql_query($sql2);
    //echo $sql2;
}

if ($accion=="4" ) {

  $sql3="  update dpp_etapas set eta_estado=$accion, eta_fecha_aprobacionok='$fechavb', eta_fecha_adminok='$fechamia' where eta_id='$id2' ";
// echo $sql3;
// exit();
  mysql_query($sql3);

}



if ($accion=="10" ) {

  $sql3="  update dpp_etapas set eta_estado='$accion', eta_rechaza_motivo1='$comentario', eta_fecha_aprobacionok='$fechavb' where eta_id='$id2' ";
//  echo $sql3;
// exit();
  mysql_query($sql3);

}

if ($accion==99) {

      $sql1="update dpp_etapas set eta_rechaza_motivo1='$comentario', eta_estado=99, eta_usu_recepcion2='$usuario',  eta_fecha_recepcion2='$fechamia', eta_numero=concat(eta_folio,eta_numero)  where eta_id=$id2 ";
      //echo $sql1."<br>";
      mysql_query($sql1);
      

      
      $sql1="update dpp_facturas set fac_estado=99, fac_numero =concat(fac_folio,fac_numero)  where fac_eta_id=$id2 ";
//      echo $sql1."<br>";
      mysql_query($sql1);



}

//exit();
// echo "<script>location.href='facturasarchivos.php?llave=2&id=$id';</script>";
echo "<script>location.href='valida4reg.php';</script>";


?>


