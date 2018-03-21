<?
session_start();
require("../inc/config.php");
require("../inc/querys.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$id=$_POST["id"];
$id1b=$_POST["id1b"];
$facfolio=$_POST["facfolio"];
$pagoid=$_POST["pagoid"];
$nroorden=$_POST["nroorden"];
$item=$_POST["item"];
$nroresolucion=$_POST["nroresolucion"];
$servicio=$_POST["servicio"];
$modalidad=$_POST["modalidad"];
$monto=$_POST["monto"];
$dos=$_POST["dos"];
$var1=$_POST["var1"];
$mail1=$_POST["mail1"];
$mail2=$_POST["mail2"];
$mail3=$_POST["mail3"];
$mail4=$_POST["mail4"];
$mail5=$_POST["mail5"];
$archivo1b=$_POST["archivo1"];
$archivo2b=$_POST["archivo2"];
$archivo3b=$_POST["archivo3"];
$archivo4b=$_POST["archivo4"];
//echo "----#-->".$archivo1b."-#-->".$archivo2b."-#-->".$archivo3b."-#-->".$archivo4b;



if(!($_FILES['archivo1']['size'])) {
//  echo "<a href='javascript:history.back(1)'>El Archivo de Factura Presenta problemas Volver</a>";
}

if(!($_FILES['archivo2']['size'])) {
//  echo "<a href='javascript:history.back(1)'>El Archivo de Orden de Compra Presenta problemas Volver</a>";
}
if(!($_FILES['archivo3']['size'])) {
//  echo "<a href='javascript:history.back(1)'>El Archivo de Resolucion Presenta problemas Volver</a>";
}

$archivo1 = $_FILES["archivo1"]["name"];
$archivo2 = $_FILES["archivo2"]['name'];
$archivo3 = $_FILES["archivo3"]['name'];
$archivo4 = $_FILES["archivo4"]['name'];

//echo "----#-->".$archivo1."-#-->".$archivo2."-#-->".$archivo3."-#-->".$archivo4;

        if ($dos<>"") {
            $sql1="update dpp_etapas set eta_estado=3, eta_usu_aprobacion='$usuario', eta_fecha_aprobacion='$fechamia', eta_depto_aprobacion='$dos', eta_item='$item', eta_pagoid='$pagoid'  where eta_id=$var1 ";
//            echo $sql1;
//            exit();
            mysql_query($sql1);
        }


            $sql22="update dpp_facturas set fac_mail1='$mail1',fac_mail2='$mail2',fac_mail3='$mail3',fac_mail4='$mail4',fac_mail5='$mail5' where fac_id=$id ";
//            echo $sql22;
//            exit();
            mysql_query($sql22);

    if ($nroorden<>"") {
            $sql2="update dpp_facturas set fac_nroorden='$nroorden' where fac_id=$id ";
//            echo $sql2;
            mysql_query($sql2);
            $sql2="update dpp_etapas set eta_nroorden='$nroorden' where eta_id=$id1b ";
//            echo $sql2;
            mysql_query($sql2);
    }
    if ($nroresolucion<>"") {
            $sql2="update dpp_facturas set fac_nroresolucion='$nroresolucion' where fac_id=$id ";
//            echo $sql2;
            mysql_query($sql2);
            $sql2="update dpp_etapas set eta_nroresolucion='$nroresolucion' where eta_id=$id1b ";
//            echo $sql2;
            mysql_query($sql2);
    }
    if ($servicio<>"") {
            $sql2="update dpp_facturas set fac_servicio='$servicio' where fac_id=$id ";
            //echo $sql2."<br>";
            mysql_query($sql2);
            $sql2="update dpp_etapas set eta_servicio_final='$servicio' where eta_id=$id1b ";
            //echo $sql2."<br>";
            mysql_query($sql2);

          $sql1b=str_replace("'","''",$sql2);
          $sql2="insert into log (obs,          user,      fecha,           hora,           modulo,                 relacion)
                          values ('$servicio, $sql1b', '$usuario', '$fechamia',    '$hora'        ,'grabafacturarchivo.php (servicio)', '$id1b') ";
           // echo "<br>".$sql2;
           // exit();
            mysql_query($sql2);

    }
    
    if ($modalidad<>"") {
            $sql2="update dpp_facturas set fac_modalidad='$modalidad' where fac_id=$id ";
//            echo $sql2;
            mysql_query($sql2);
            $sql2="update dpp_etapas set eta_modalidad='$modalidad' where eta_id=$id1b ";
//            echo $sql2;
            mysql_query($sql2);
    }
    if ($monto<>"") {
            $sql2="update dpp_facturas set fac_monto='$monto' where fac_id=$id ";
 //           echo $sql2;

            mysql_query($sql2);
            $sql2="update dpp_etapas set eta_monto='$monto' where eta_id=$id1b ";
//            echo $sql2;
//            exit();
            mysql_query($sql2);
    }

    if ($item==21) {
            mysql_query($sql2);
            $sql2="update dpp_etapas set eta_estado=5 where eta_id=$id1b ";
//            echo $sql2;
//            exit();
            mysql_query($sql2);

    }

    

//echo "----------->".$archivo1;
    if ($archivo1 != "") {
        $archivo1="doc".$annomia."/factura/DOC".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        
        $destino =  "../../../archivos/docfac/".$archivo1;
//        $destino =  "../../../archivos2/".$archivo1;
//        echo "<br>".$_FILES['archivo1']['tmp_name']."--".$archivo1."--".$destino;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";
//            echo "========".$sql2;
            mysql_query($sql2);
        }
    }
    
    if ($archivo2 != "") {
        $archivo2="doc".$annomia."/ORD".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo2;
        if (copy($_FILES['archivo2']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo2."</b>";
            $sql2="update dpp_facturas set fac_doc1='$archivo2' where fac_id=$id ";
//            echo $sql2;
            mysql_query($sql2);

            
        }
    }
    if ($archivo3 != "") {
        $archivo3="doc".$annomia."/RES".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo3;
//        $destino =  "../../../archivos/docfac/".$archivo3;
        if (copy($_FILES['archivo3']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo3."</b>";
            $sql2="update dpp_facturas set fac_doc2='$archivo3' where fac_id=$id ";
//            echo $sql2;
            mysql_query($sql2);

        }
    }
    
    if ($archivo4 != "") {
        $archivo4="doc".$annomia."/OTRO".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo4;
//        $destino =  "../../../archivos/docfac/".$archivo4;
        if (copy($_FILES['archivo4']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo4."</b>";
            $sql2="update dpp_facturas set fac_doc3='$archivo4' where fac_id=$id ";
//            echo $sql2;
            mysql_query($sql2);

        }
    }

    if ($item==21) {
         $sql1="update dpp_etapas set eta_estado=5  where eta_id=$var1 ";
         mysql_query($sql1);
    }


//        exit();
echo "<script>location.href='../facturasarchivos.php?llave=1&id=".$id."';</script>";


?>


