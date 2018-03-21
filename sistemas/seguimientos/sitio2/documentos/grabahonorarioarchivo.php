<?
session_start();
require("../inc/config.php");
require("../inc/querys.php");
$fechamia=date('Y-m-d');
$regionsession = $_SESSION["region"];
$annomia=date('Y');
$usuario=$_SESSION["nom_user"];

$id=$_POST["id"];
$dos=$_POST["dos"];
$facfolio=$_POST["facfolio"];
$nroorden=$_POST["nroorden"];
$nroresolucion=$_POST["nroresolucion"];
$item=$_POST["item"];
$servicio=$_POST["servicio"];
$modalidad=$_POST["modalidad"];
$item=$_POST["item"];
$monto=$_POST["monto"];

$var1=$_POST["var1"];
$mail1=$_POST["mail1"];
$mail2=$_POST["mail2"];
$mail3=$_POST["mail3"];
$mail4=$_POST["mail4"];
$mail5=$_POST["mail5"];

$archivo1 = $_FILES["archivo1"]['name'];
$archivo2 = $_FILES["archivo2"]['name'];
$archivo3 = $_FILES["archivo3"]['name'];
$archivo4 = $_FILES["archivo4"]['name'];


        if ($dos<>"") {
            $sql1="update dpp_etapas set eta_estado=3, eta_item='$item', eta_usu_aprobacion='$usuario', eta_fecha_aprobacion='$fechamia', eta_depto_aprobacion='$dos', eta_item='$item'  where eta_id=$var1 ";
            echo $sql1;
            //exit();
            mysql_query($sql1);
        }

            $sql22="update dpp_honorarios set hono_mail1='$mail1',hono_mail2='$mail2',hono_mail3='$mail3',hono_mail4='$mail4',hono_mail5='$mail5' where hono_id=$id ";

            echo $sql22;
            mysql_query($sql22);
//           exit();


   $id1b=$var1;
   if ($nroorden<>"") {
            $sql2="update dpp_etapas set eta_nroorden='$nroorden' where eta_id=$id1b ";
//            echo $sql2;
            mysql_query($sql2);
    }
    if ($nroresolucion<>"") {
            $sql2="update dpp_etapas set eta_nroresolucion='$nroresolucion' where eta_id=$id1b ";
//            echo $sql2;
            mysql_query($sql2);
    }
    if ($servicio<>"") {
            $sql2="update dpp_etapas set eta_servicio_final='$servicio' where eta_id=$id1b ";
//            echo $sql2;
            mysql_query($sql2);
    }
    if ($modalidad<>"") {
            $sql2="update dpp_etapas set eta_modalidad='$modalidad' where eta_id=$id1b ";
//            echo $sql2;
            mysql_query($sql2);
    }
    if ($monto<>"") {
            $sql2="update dpp_honorarios set hono_liquido='$monto' where hono_id=$id ";
//            echo $sql2;
            mysql_query($sql2);
            $sql2="update dpp_etapas set eta_monto='$monto' where eta_id=$id1b ";
//            echo $sql2;
            mysql_query($sql2);
//            exit();
    }
    if ($item==21) {
            mysql_query($sql2);
            $sql2="update dpp_etapas set eta_estado=5 where eta_id=$id1b ";
//            echo $sql2;
//            exit();
//            mysql_query($sql2);

    }




    if ($archivo1 != "") {
        $archivo1="HON".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo1;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update dpp_honorarios set hono_archivo='$archivo1' where hono_id=$id ";
            echo $sql2;
            mysql_query($sql2);
        }
    }
    
    if ($archivo2 != "") {
        $archivo2="ORD".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo2;
        if (copy($_FILES['archivo2']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo2."</b>";
            $sql2="update dpp_honorarios set hono_doc1='$archivo2' where hono_id=$id ";
            echo $sql2;
            mysql_query($sql2);

            
        }
    }
    if ($archivo3 != "") {
        $archivo3="RES".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo3;
        if (copy($_FILES['archivo3']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo3."</b>";
            $sql2="update dpp_honorarios set hono_doc2='$archivo3' where hono_id=$id ";
//            echo $sql2;
            mysql_query($sql2);

        }
    }
    if ($archivo4 != "") {
        $archivo4="OTRO".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo4;
        if (copy($_FILES['archivo4']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo4."</b>";
            $sql2="update dpp_honorarios set hono_doc3='$archivo4' where hono_id=$id ";
//            echo $sql2;
            mysql_query($sql2);

        }
    }


       // exit();
echo "<script>location.href='../honorarioarchivos.php?llave=1&id=".$id."';</script>";


?>


