<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
$user=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$fechamia=date("Y-m-d");

     require("inc/config.php");

header('Content-Type: text/html; charset=ISO-8859-1');
?>
<!--  leerfichero.php -->
<HTML>
<HEAD>
   <TITLE>Lectura de ficheros</TITLE>
</HEAD>
<BODY>
<?php


$archivo1 = $_FILES["archivo1"]['name'];

$trozos2=explode(".", $archivo1);
$anno=$trozos2[0];
$extension=$trozos2[1];

echo $archivo1."-----".$extension."<br>";



    if ($archivo1 != "") {
        $archivo1="car_".$regionsession.".".$extension;

        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docconciliacion/".$archivo1;
        echo $destino;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
//            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";
//            echo $sql2;
//            mysql_query($sql2);


        }
//exit();
            /** Clases necesarias */
            require_once('Classes/PHPExcel.php');
            require_once('Classes/PHPExcel/Reader/Excel2007.php');
            // Cargando la hoja de cÃ¡lculo
            $objReader = new PHPExcel_Reader_Excel2007();
            $objPHPExcel = $objReader->load($destino);
            $objFecha = new PHPExcel_Shared_Date();

            $highestRow =  $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();;
//            $highestRow =20;
            // Asignar hoja de excel activa
            $objPHPExcel->setActiveSheetIndex(0);
            //conectamos con la base de datos
             echo $highestRow;
            // Llenamos el arreglo con los datos  del archivo xlsx
            for ($i = 1; $i <= $highestRow; $i++) {
                $_DATOS_EXCEL[$i]['a1'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a2'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a3'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a4'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a5'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a6'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a7'] = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a8'] = $objPHPExcel->getActiveSheet()->getCell('H' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a9'] = $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a10'] = $objPHPExcel->getActiveSheet()->getCell('J' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a11'] = $objPHPExcel->getActiveSheet()->getCell('K' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a12'] = $objPHPExcel->getActiveSheet()->getCell('L' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a13'] = $objPHPExcel->getActiveSheet()->getCell('M' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a14'] = $objPHPExcel->getActiveSheet()->getCell('N' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a15'] = $objPHPExcel->getActiveSheet()->getCell('O' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a16'] = $objPHPExcel->getActiveSheet()->getCell('P' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a17'] = $objPHPExcel->getActiveSheet()->getCell('Q' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a18'] = $objPHPExcel->getActiveSheet()->getCell('R' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a19'] = $objPHPExcel->getActiveSheet()->getCell('S' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a20'] = $objPHPExcel->getActiveSheet()->getCell('T' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a21'] = $objPHPExcel->getActiveSheet()->getCell('U' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a22'] = $objPHPExcel->getActiveSheet()->getCell('V' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a23'] = $objPHPExcel->getActiveSheet()->getCell('W' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a24'] = $objPHPExcel->getActiveSheet()->getCell('X' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a25'] = $objPHPExcel->getActiveSheet()->getCell('Y' . $i)->getCalculatedValue();
                $_DATOS_EXCEL[$i]['a26'] = $objPHPExcel->getActiveSheet()->getCell('Z' . $i)->getCalculatedValue();
                
                
                $_DATOS_EXCEL[$i]['a1'] = str_replace("Â","",$_DATOS_EXCEL[$i]['a1']);
                $_DATOS_EXCEL[$i]['a2'] = str_replace("Â","",$_DATOS_EXCEL[$i]['a2']);
                $_DATOS_EXCEL[$i]['a3'] = str_replace("Â","",$_DATOS_EXCEL[$i]['a3']);
                $_DATOS_EXCEL[$i]['a4'] = str_replace("Â","",$_DATOS_EXCEL[$i]['a4']);
                $_DATOS_EXCEL[$i]['a5'] = str_replace("Â","",$_DATOS_EXCEL[$i]['a5']);
                $_DATOS_EXCEL[$i]['a6'] = str_replace("Â","",$_DATOS_EXCEL[$i]['a6']);
                $_DATOS_EXCEL[$i]['a7'] = str_replace("Â","",$_DATOS_EXCEL[$i]['a7']);
                $_DATOS_EXCEL[$i]['a8'] = str_replace("Â","",$_DATOS_EXCEL[$i]['a8']);
                echo $_DATOS_EXCEL[$i]['a26']."<br>";
                $_DATOS_EXCEL[$i]['a26'] = str_replace(",","",$_DATOS_EXCEL[$i]['a26']);
                $_DATOS_EXCEL[$i]['a26'] = str_replace(".","",$_DATOS_EXCEL[$i]['a26']);
                echo $_DATOS_EXCEL[$i]['a26']."<br>";
                $_DATOS_EXCEL[$i]['a26'] = str_replace("$","",$_DATOS_EXCEL[$i]['a26']);
                $fecha2=$_DATOS_EXCEL[$i]['a1'];
//                if ($fecha2<>'')
//                   $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
                $sql="insert into concilia_sigfetmp  (blanco1,dato1,blanco2,dato2,blanco3,dato3,blanco4,dato4,blanco5,dato5,blanco6,dato6,blanco7,dato7,blanco8,dato8,blanco9,dato9,blanco10,dato10,blanco11,dato11,blanco12,dato12,blanco13)
                                              values ('".$_DATOS_EXCEL[$i]['a2']."','".$_DATOS_EXCEL[$i]['a3']."','".$_DATOS_EXCEL[$i]['a4']."','".$_DATOS_EXCEL[$i]['a5']."','".$_DATOS_EXCEL[$i]['a6']."','".$_DATOS_EXCEL[$i]['a7']."','".$_DATOS_EXCEL[$i]['a8']."','".$_DATOS_EXCEL[$i]['a9']."','".$_DATOS_EXCEL[$i]['a10']."','".$_DATOS_EXCEL[$i]['a11']."','".$_DATOS_EXCEL[$i]['a12']."','".$_DATOS_EXCEL[$i]['a13']."','".$_DATOS_EXCEL[$i]['a14']."','".$_DATOS_EXCEL[$i]['a15']."','".$_DATOS_EXCEL[$i]['a16']."','".$_DATOS_EXCEL[$i]['a17']."','".$_DATOS_EXCEL[$i]['a18']."','".$_DATOS_EXCEL[$i]['a19']."','".$_DATOS_EXCEL[$i]['a20']."','".$_DATOS_EXCEL[$i]['a21']."','".$_DATOS_EXCEL[$i]['a22']."','".$_DATOS_EXCEL[$i]['a23']."','".$_DATOS_EXCEL[$i]['a24']."','".$_DATOS_EXCEL[$i]['a25']."','".$_DATOS_EXCEL[$i]['a26']."') ";
//                echo $sql."<br>";
//                mysql_query($sql);


            }
        }
        //si por algo no cargo el archivo bak_
        else {
            echo "Necesitas primero importar el archivo";
        }
        $errores = 0;

        echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
        //una vez terminado el proceso borramos el archivo que esta en el servidor el bak_
        unlink($destino);
        

/*
        $sql="select max(carto_loto) as maximo from concilia_cartola where carto_region=$regionsession ";
        echo $sql."<br>";
        $res=mysql_query($sql);
        $row = mysql_fetch_array($res);
        $maximo=$row["maximo"]+1;

*/
        
//        INSERT INTO `factura2`.`concilia_cartola` (`carto_id`, `carto_fecha`, `carto_sucursal`, `carto_operacion`, `carto_descripcion`, `carto_cargo`, `carto_abono`, `carto_saldo`, `carto_lote`, `carto_region`, `carto_user`, `carto_fechasis`, `carto_estado`) VALUES (NULL, '2014-05-14', '', '', '', '', '', '', '', '', '', '', '1');
        
        $sql="INSERT INTO concilia_sigfe (sigfe_anno,sigfe_area,sigfe_cbancaria,sigfe_ccontable,sigfe_tipo,sigfe_fecha,sigfe_sigfe,sigfe_estado2,sigfe_tesoreria,sigfe_numdoc,sigfe_rut,sigfe_bene,sigfe_monto,sigfe_fechasis,sigfe_user)
                                          select blanco1,blanco2,blanco3,blanco4,blanco5,blanco6,blanco7,blanco8,blanco9,blanco10,blanco11,blanco12,blanco13,'','sys' from concilia_sigfetmp where LENGTH(blanco1)=4 ";
//  select CONCAT(SUBSTRING(a2,7,4),'-',SUBSTRING(a2,4,2),'-',SUBSTRING(a2,1,2)),a4,a5,a6,a7,a8,a9,$maximo,'$regionsession','$user','$fechamia' from concilia_cartolatmp where a10='$fechamia' and a11='$user' and a2 like '%-%-%' ";
        echo $sql."<br><br>";
        mysql_query($sql);
        
        $sql="delete from concilia_cartolatmp where a10='$fechamia' and a11='$user'  ";
        echo $sql."<br>";
        $res=mysql_query($sql);





   exit();
   echo "<script>location.href='consolidacion_subida2.php?llave=1';</script>";
?>
</BODY>
</HTML>


