<?
session_start();
require("../inc/config.php");
require("../inc/querys.php");

$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$id=$_POST["id"];
$id1b=$_POST["id1b"];
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];

$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];
$fecha3=$_POST["fecha3"];
$folio=$_POST["folio"];
$hora=$_POST["hora"];
$min=$_POST["min"];
$hora=$hora.":".$min;
$tipo=$_POST["tipo"];
$tipo2=$_POST["tipo2"];
$monto=$_POST["monto"];
$rut=$_POST["rut"];
$dig=$_POST["dig"];
$nombre=$_POST["nombre"];
$nrogarantia=$_POST["nrogarantia"];
$emisora=$_POST["emisora"];
$glosa=$_POST["glosa"];
$direccion=$_POST["direccion"];
$fono2=$_POST["fono2"];
$correo=$_POST["correo"];
$unidad=$_POST["unidad"];
$depto=$_POST["depto"];
$sw=$_POST["sw"];


$mail1=$_POST["mail1"];
$mail2=$_POST["mail2"];
$mail3=$_POST["mail3"];
$mail4=$_POST["mail4"];
$mail5=$_POST["mail5"];

$envia1=$_POST["envia1"];
$envia2=$_POST["envia2"];
$envia3=$_POST["envia3"];
$envia4=$_POST["envia4"];
$envia5=$_POST["envia5"];

$archivo1 = $_FILES["archivo1"]['name'];
$archivo2 = $_FILES["archivo2"]['name'];

if ($sw==1) {
    $sql2="update dpp_boletasg set boleg_fecha_recep='$fecha1', boleg_fecha_emision='$fecha2', boleg_fecha_vence='$fecha3', boleg_hora_recep='$hora', boleg_tipo='$tipo', boleg_tipo2='$tipo2', boleg_numero='$nrogarantia', boleg_emisora='$emisora', boleg_monto='$monto', boleg_rut='$rut', boleg_dig='$dig', boleg_nombre='$nombre', boleg_glosa='$glosa', boleg_direccion='$direccion', boleg_fono2='$fono2', boleg_correo='$correo', boleg_unidad='$unidad', boleg_mail1='$mail1', boleg_mail2='$mail2', boleg_mail3='$mail3', boleg_mail4='$mail4', boleg_mail5='$mail5' where boleg_id=$id ";
//    echo "-------".$sql2."<br><br>";
//    exit();

    mysql_query($sql2);

}
if ($sw==2) {
    $sql2="update dpp_boletasg set boleg_mail1='$mail1', boleg_mail2='$mail2', boleg_mail3='$mail3', boleg_mail4='$mail4', boleg_mail5='$mail5' where boleg_id=$id ";
//    echo "-------".$sql2."<br><br>";
//    exit();
      mysql_query($sql2);
}
    

    if ($archivo1 != "") {
        // guardamos el archivo a la carpeta files
        $archivo1="garantia_folio".$id."_".$regionsession.".PDF";
        $destino =  "../../../archivos/docgarantia/".$archivo1;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update dpp_boletasg set boleg_archivo='$archivo1' where boleg_id=$id ";
//            echo $sql2;
//            exit();
            mysql_query($sql2);

            
        }
    }
    if ($archivo2 != "") {
        // guardamos el archivo a la carpeta files
        $archivo2="formulario_folio".$id."_".$regionsession.".PDF";
        $destino =  "../../../archivos/docgarantia/".$archivo2;
        if (copy($_FILES['archivo2']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo2."</b>";
            $sql2="update dpp_boletasg set boleg_archivo2='$archivo2' where boleg_id=$id ";
//            echo $sql2;
//            exit();
            mysql_query($sql2);


        }
    }




//       exit();
if ($sw==1) {
  echo "<script>location.href='../boletasgarchivos.php?llave=1&id=".$id."';</script>";
}
if ($sw==2) {
  echo "<script>location.href='../boletasgarchivos2.php?llave=1&id=".$id."';</script>";
}
if ($sw==3) {
  echo "<script>location.href='../boletasgarchivos3.php?llave=1&id=".$id."';</script>";
}


?>


