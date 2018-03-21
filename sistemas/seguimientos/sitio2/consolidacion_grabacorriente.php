<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);

$fecha1=$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


$archivo1 = $_FILES["archivo1"]["name"];

//echo $monto."---->".$rut."--->".$archivo1;
//exit();



if ($region<>"" and $numero<>"") {

   $sql1="INSERT INTO concilia_cc (cc_region, cc_numero, cc_descripcion, cc_usuario, cc_fecha)
                           VALUES ('$region', '$numero', '$obs', '$usuario', '$fecha1')";
//   echo $sql1;
// exit();
    mysql_query($sql1);
 
/*
   $sql1="select max(cadu_id) as maximo from dpp_caducado where cadu_user='$usuario'";
// echo $sql1;
// exit();
   $res1=mysql_query($sql1);
   $row1=mysql_fetch_array($res1);
   $maximo=$row1["maximo"];



    if ($archivo1 != "") {
        $archivo1="checadu".$regionsession."_".$maximo.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "documentoscaducado/".$archivo1;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update dpp_caducado set cadu_imagen='$archivo1' where cadu_id=$maximo ";
//            echo $sql2;
            mysql_query($sql2);


        }
    }
    
    
   $sql1="update dpp_etapas set eta_estado=9, eta_usu_pagado='$usuario', eta_fecha_pagado='$fechamia', eta_fecha_retira='$fechamia', eta_retira='CADUCADO', eta_forma='CADUCADO' where eta_rut='$rut' and eta_ncheque='$nrocheque'";
//      $sql1="update dpp_etapas set eta_estado=8,  eta_usu_pagado='$usuario', eta_fecha_pagado='$fechamia', eta_retira='$var12', eta_fecha_retira='$var13', eta_forma='$var15'  where eta_id=$var1 ";
//echo $sql1;
//exit();
   mysql_query($sql1);


*/
}


//exit();
echo "<script>location.href='consolidacion_corriente.php?llave=1';</script>";


?>


