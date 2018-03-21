<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);
//echo $fecha1."<br>";
$fecha1=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


$archivo1 = $_FILES["archivo1"]["name"];
$archivo2 = $_FILES["archivo2"]["name"];
$archivo3 = $_FILES["archivo3"]["name"];
$archivo4 = $_FILES["archivo4"]["name"];
$archivo5 = $_FILES["archivo5"]["name"];
$archivo6 = $_FILES["archivo6"]["name"];

//echo $monto."---->".$rut."--->".$archivo1;
//exit();



if ($nombre<>"" and $cargo<>"") {

   $sql1="INSERT INTO concilia_antecedente (ante_fecha, ante_user, ante_cc_id,ante_nombre,ante_cargo)
                                    VALUES ('$fecha1', '$usuario','$id','$nombre','$cargo')";
//   echo $sql1."<br>";
// exit();
    mysql_query($sql1);
 

   $sql1="select max(ante_id) as maximo from concilia_antecedente where ante_user='$usuario'";
// echo $sql1;
// exit();
   $res1=mysql_query($sql1);
   $row1=mysql_fetch_array($res1);
   $maximo=$row1["maximo"];


    if ($archivo1 != "") {
        $archivo1="Ant_1_".$regionsession."_".$maximo.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docconciliacion/antecedentes/".$archivo1;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update concilia_antecedente set ante_archivo1='$archivo1' where ante_id=$maximo ";
//            echo $sql2;
            mysql_query($sql2);


        }
    }
    
    if ($archivo2 != "") {
        $archivo2="Ant_2_".$regionsession."_".$maximo.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docconciliacion/antecedentes/".$archivo2;
        if (copy($_FILES['archivo2']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update concilia_antecedente set ante_archivo2='$archivo2' where ante_id=$maximo ";
//            echo $sql2;
            mysql_query($sql2);


        }
    }

    if ($archivo3 != "") {
        $archivo3="Ant_3_".$regionsession."_".$maximo.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docconciliacion/antecedentes/".$archivo3;
        if (copy($_FILES['archivo3']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update concilia_antecedente set ante_archivo3='$archivo3' where ante_id=$maximo ";
//            echo $sql2;
            mysql_query($sql2);


        }
    }

    if ($archivo4 != "") {
        $archivo4="Ant_4_".$regionsession."_".$maximo.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docconciliacion/antecedentes/".$archivo4;
        if (copy($_FILES['archivo4']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update concilia_antecedente set ante_archivo4='$archivo4' where ante_id=$maximo ";
//            echo $sql2;
            mysql_query($sql2);


        }
    }
    if ($archivo5 != "") {
        $archivo5="Ant_5_".$regionsession."_".$maximo.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docconciliacion/antecedentes/".$archivo5;
        if (copy($_FILES['archivo5']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update concilia_antecedente set ante_archivo5='$archivo5' where ante_id=$maximo ";
//            echo $sql2;
            mysql_query($sql2);


        }
    }
    if ($archivo6 != "") {
        $archivo6="Ant_6_".$regionsession."_".$maximo.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docconciliacion/antecedentes/".$archivo6;
        if (copy($_FILES['archivo6']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update concilia_antecedente set ante_archivo6='$archivo6' where ante_id=$maximo ";
//            echo $sql2;
            mysql_query($sql2);


        }
    }
}


//exit();
echo "<script>location.href='consolidacion_corriente3.php?llave=1&id=$id';</script>";


?>


