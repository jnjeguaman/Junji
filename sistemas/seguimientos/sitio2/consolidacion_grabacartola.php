<?
session_start();

     require("inc/config.php");
     require("inc/querys.php");

?>
<!--  leerfichero.php -->
<HTML>
<HEAD>
   <TITLE>Lectura de ficheros</TITLE>
</HEAD>
<BODY>
<?php
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
$numero=$_POST["numero"];
$fechamia=date("Y-m-d");
//echo $numero,"<<----";
//exit();
$archivo2=$archivo1;

$archivo1 = $_FILES["archivo1"]['name'];
/*
$trozos = explode("_", $archivo1);
$region=$trozos[0];
$producto=$trozos[1];
$mes=$trozos[2];
$anno=$trozos[3];
$trozos2=explode(".", $anno);
$anno=$trozos2[0];
$extension=$tcrozos2[1];

$archivo1="arc".$producto."_".$region."_".$mes."_".$anno;
$sql="select * from eje_archivo where  ar_archivo='$archivo1' ";
echo $sql;
$res=mysql_query($sql,$dbh5);
$row=mysql_fetch_array($res);
$ararchivo=$row["ar_archivo"];
echo "----".$ararchivo;
if ($ararchivo<>'') {

   echo "<script>location.href='infopres_subida.php?llave=2';</script>";
   exit();
}
*/


//echo $producto."_".$region."_".$mes."_".$anno;
//exit();


    if ($archivo1 != "") {
        $archivo1="arc".$producto."_".$region."_".$mes."_".$anno;
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docconciliacion/".$archivo1;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
//            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";
//            echo $sql2;
//            mysql_query($sql2);


        }
    }

    define('NOMBRE_FICHERO', "../../archivos/docconciliacion/".$archivo1);
   // Se abre el fichero de ejemplo
   $fichero = fopen(NOMBRE_FICHERO, 'r') or die('Error de apertura el ARCHIO NO EXISTE');


   // Se inicializa el contador de líneas

//     mysql_query("delete from eje_acu_cla where ejeac_region='$region' and ejeac_mes='$mes' and ejeac_anno='$anno' and ejeac_producto='$producto'",$dbh5);
   // Mientras queden líneas por leer

//     echo '<!--', NOMBRE_FICHERO, "-->\n";
   //  echo $fichero;
       $lineas=1;
   while (!feof($fichero) ) {
      $buffer = fgetss($fichero, 4096, '<BODY> <HR>');
      $buffer=trim($buffer);
//       echo $buffer;
      list($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $a21, $a22, $a23, $a24, $a25, $a26, $a27, $a28, $a29, $a30, $a31, $a32, $a33, $a34, $a35, $a36, $a37, $a38, $a39, $a40, $a41 ) = split(';', $buffer);
//      echo "$a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $a21, $a22, $a23, $a24, $a25, $a26, $a27, $a28, $a29, $a30, $a31, $a32, $a33, $a34, $a35, $a36, $a37, $a38, $a39, $a40, $a41 ";
      $a13=substr($a12,4,4).substr($a12,2,2).substr($a12,0,2);
      $sql="insert into concilia_cartolatmp  (a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,a13,a14,a15,a16)
                                      values ('$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11','$a12','$fechamia','$usuario',$a13) ";
      mysql_query($sql);
//      echo $sql."<br>";
      $lineas++;
   }



$sql2 = "Select * from concilia_parametros";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$mesp=$row2["para_mes"];
$annop=$row2["para_anno"];



$sql2 = "Select max(carto_fecha) as carto_fecha from concilia_cartola where carto_numero='$numero'";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$cartofecha=$row2["carto_fecha"];
$cartofecha=substr($cartofecha,0,4).substr($cartofecha,5,2).substr($cartofecha,8,2);
//echo "--->".$cartofecha;
//exit();
      $sql="INSERT INTO concilia_cartola (carto_fecha, carto_sucursal, carto_operacion, carto_descripcion, carto_cargo, carto_abono, carto_saldo, carto_lote, carto_region, carto_user, carto_fechasis, carto_numero, carto_mesp, carto_annop)
                                    select CONCAT(SUBSTRING(a13,5,4),'-',SUBSTRING(a13,3,2),'-',SUBSTRING(a13,1,2)),a6,a4,a9, CASE WHEN a7='C' THEN a10 ELSE '0' END ,CASE WHEN a7='A' THEN a10 ELSE '0' END,a11,'1','$regionsession','$usuario','$fechamia', '$numero', '$mesp', '$annop'
                                    from concilia_cartolatmp
                                    where a14='$fechamia' and a15='$usuario' and a2<>'' and a16>'$cartofecha' ";
//                                    select CONCAT(SUBSTRING(a13,5,4),'-',SUBSTRING(a13,3,2),'-',SUBSTRING(a13,1,2)),a6,a4,a9, if (a7='C',a10,0),if (a7='A',0,a10),a11,$maximo,'$regionsession','$usuario','$fechamia' from concilia_cartolatmp where a14='$fechamia' and a15='$usuario'  ";
//     echo $sql."<br><br>";
//      exit();
      mysql_query($sql);



      $sql="delete from concilia_cartolatmp where a15='$usuario'";
//      echo $sql."<br><br>";
      mysql_query($sql);
//    exit();
   echo "<script>location.href='consolidacion_subida.php?llave=1';</script>";
?>
</BODY>
</HTML>


