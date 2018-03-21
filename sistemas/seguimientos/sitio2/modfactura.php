<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}


$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];
$fecha3=$_POST["fecha3"];



//$folio=$_POST["folio"];
//$region=$_POST["region"];
//$rut=$_POST["rut"];
//$dig=$_POST["dig"];
//$nombre=$_POST["nombre"];
$monto=$_POST["monto"];
//$depto=$_POST["depto"];
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);

$tipodoc=$_POST["tipodoc"];
$numero1=$_POST["numero"];
$id=$_POST["id"];
$archivo1 = $_FILES["archivo1"]["name"];
//$tipodoc=$_POST["tipodoc"];



//echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);




if ($numero1<>"" and $monto<>"") {
  $sql21="update dpp_facturas set fac_fecha_fac='$fecha2', fac_numero='$numero1',fac_monto='$monto', fac_fecha_recepcion='$fecha1' where fac_eta_id=$id  ";
//  echo $sql21."<br>";
//  exit();
  mysql_query($sql21);

  
  $sql1b=str_replace("'","''",$sql21);
  $sql2="insert into log (obs,          user,      fecha,           hora,           modulo,                 relacion)
                      values ('$sql1b', '$usuario', '$fechamia',    '$hora'        ,'modifactura.php (modifica)', '$id2') ";
   mysql_query($sql2);



//  exit();

  $sql22="update dpp_etapas set eta_fecha_fac='$fecha2', eta_numero='$numero1',eta_monto='$monto', eta_tipo_doc2='$tipodoc', eta_fecha_recepcion='$fecha1' where eta_id=$id  ";
//  echo $sql22."<br>";
  mysql_query($sql22);


  $sql1b=str_replace("'","''",$sql21);
  $sql2="insert into log (obs,          user,      fecha,           hora,           modulo,                 relacion)
                      values ('$sql1b', '$usuario', '$fechamia',    '$hora'        ,'modifactura.php (modifica)', '$id') ";
   mysql_query($sql2);

//       exit();

  //     echo "--> $archivo1";
    if ($archivo1 != "") {
        $archivo1="doc".$annomia."/factura/".$regionsession."_".$id."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files

        $destino =  "../../archivos/docfac/".$archivo1;
     //   $destino =  "../../../archivos2/".$archivo1;
//        echo "<br>".$_FILES['archivo1']['tmp_name']."--".$archivo1."--".$destino;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_eta_id=$id  ";
 //           echo "========".$sql2;
            mysql_query($sql2);
        } else {
//            echo "Error en archivo no copiado ";
        }
    }

}




//exit();
echo "<script>location.href='facturasedit.php?llave=1&id2=$id';</script>";


?>


