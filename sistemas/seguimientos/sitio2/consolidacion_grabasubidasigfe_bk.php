<?
session_start();
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
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

$numero=$_POST["numero"];
$fechamia=date("Y-m-d");
//echo $numero;
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
$sql2 = "Select * from concilia_parametros";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$mesp=$row2["para_mes"];
$annop=$row2["para_anno"];



    if ($archivo1 != "") {
        $archivo1="arc".$producto."_".$regionsession."_".$mesp."_".$annop.".txt";
//        echo $archivo1;
//        exit();
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

     echo '<!--', NOMBRE_FICHERO, "-->\n";
   //  echo $fichero;
     $sw=1;
     $lineas=1;
   while (!feof($fichero) ) {
      $buffer = fgetss($fichero, 4096, '<BODY> <HR>');
      $buffer=trim($buffer);
//       echo $buffer;
      list($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $a21, $a22, $a23, $a24, $a25, $a26, $a27, $a28, $a29, $a30, $a31, $a32, $a33, $a34, $a35, $a36, $a37, $a38, $a39, $a40, $a41 ) = split(' ', $buffer);
      $todos= $a23." ".$a24." ".$a25." ".$a26." ".$a27." ".$a28." ".$a29." ".$a30." ".$a31." ".$a32." ".$a33." ".$a34." ".$a35." ".$a36." ".$a37." ".$a38." ".$a39." ".$a40." ".$a41;
      $buffer2=strrev($todos);
//      echo $buffer2."<br>";
      $b1= explode('$',$buffer2);
//      echo $b1[0]."<-".$b1[1]."-<br>";
      $monto=strrev($b1[0]);
      $glosa=strrev($b1[1]);
      $monto = str_replace(",","",$monto);
      $monto = str_replace(".","",$monto);

      $sql="insert into concilia_sigfetmp  (blanco1,blanco2,blanco3,blanco4,blanco5,blanco6,blanco7,blanco8,blanco9,blanco10,blanco11,blanco12,blanco13,user)
                                    values ('$a1','$a3','$a5','$a7','$a9','$a11','$a13','$a15','$a17','$a19','$a21','$glosa','$monto','$usuario') ";
//      echo $sql."<br>";
      mysql_query($sql);
       

      
      $lineas++;
}

//exit();

$sql2 = "Select * from concilia_parametros";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$mesp=$row2["para_mes"];
$annop=$row2["para_anno"];

$sql2 = "Select max(sigfe_fecha) as sigfe_fecha from concilia_sigfe where sigfe_numero='$numero'";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$sigfefecha=$row2["sigfe_fecha"];



/*
//exit();
      $sql="INSERT INTO concilia_sigfe (sigfe_anno,sigfe_area,sigfe_cbancaria,sigfe_ccontable,sigfe_tipo,sigfe_fecha,sigfe_sigfe,sigfe_estado2,sigfe_tesoreria,sigfe_numdoc,sigfe_rut,sigfe_bene,sigfe_abono, sigfe_cargo,sigfe_fechasis,sigfe_user,sigfe_numero,sigfe_mesp, sigfe_annop, sigfe_region)
                                 select blanco1,blanco2,blanco3,blanco4,blanco5,blanco6,blanco7,blanco8,blanco9,blanco10,blanco11,blanco12, CASE WHEN blanco5='ABONO' THEN sum(blanco13) ELSE '0' END, CASE WHEN blanco5='CARGO' THEN sum(blanco13) ELSE '0' END,'$fechamia','$usuario','$numero','$mesp','$annop','$regionsession' from concilia_sigfetmp
                                 where blanco1='2014' and user='$usuario'
                                  and (blanco12 <>'BANCO DEL ESTADO DE CHILE'  AND blanco12 <>'DEFENSORIA PENAL PUBLICA'
                                  AND blanco12 <>'MSLI LATAM INC.'
                                  AND blanco12 <>'TESORERIA GENERAL DE LA REPUBLICA'
                                  AND blanco5 ='abono')  and (blanco8<>'AJUSTADO' and blanco8<>'AJUSTE') and blanco2<>''
                                  group by sigfe_numdoc  ";
//      echo $sql."<br><br>";
      mysql_query($sql);
//exit();
      $sql="delete from concilia_sigfetmp where LENGTH(blanco1)=4 and user='$usuario'
                                  and (blanco12 <>'BANCO DEL ESTADO DE CHILE'  AND blanco12 <>'DEFENSORIA PENAL PUBLICA'
                                  AND blanco12 <>'MSLI LATAM INC.'
                                  AND blanco12 <>'TESORERIA GENERAL DE LA REPUBLICA'
                                  AND blanco5 ='abono')  and (blanco8<>'AJUSTADO' and blanco8<>'AJUSTE') ";
//      echo $sql."<br><br>";
      mysql_query($sql);

       $sql="INSERT INTO concilia_sigfe (sigfe_anno,sigfe_area,sigfe_cbancaria,sigfe_ccontable,sigfe_tipo,sigfe_fecha,sigfe_sigfe,sigfe_estado2,sigfe_tesoreria,sigfe_numdoc,sigfe_rut,sigfe_bene,sigfe_abono,sigfe_cargo,sigfe_fechasis,sigfe_user,sigfe_numero,sigfe_mesp, sigfe_annop, sigfe_region )
                                 select blanco1,blanco2,blanco3,blanco4,blanco5,blanco6,blanco7,blanco8,blanco9,blanco10,blanco11,blanco12, CASE WHEN blanco5='ABONO' THEN blanco13 ELSE '0' END, CASE WHEN blanco5='CARGO' THEN blanco13 ELSE '0' END,'$fechamia','$usuario','$numero','$mesp','$annop','$regionsession' from concilia_sigfetmp
                                 where (blanco8='AJUSTADO' or blanco8='AJUSTE') and blanco2<>''  ";

     echo $sql."<br><br>";
//     exit();
      mysql_query($sql);



      
      $sql="delete from concilia_sigfetmp where (blanco8='AJUSTADO' or blanco8='AJUSTE') ";
      echo $sql."<br><br>";
      mysql_query($sql);

      $sql="INSERT INTO concilia_sigfe (sigfe_anno,sigfe_area,sigfe_cbancaria,sigfe_ccontable,sigfe_tipo,sigfe_fecha,sigfe_sigfe,sigfe_estado2,sigfe_tesoreria,sigfe_numdoc,sigfe_rut,sigfe_bene,sigfe_abono,sigfe_cargo,sigfe_fechasis,sigfe_user,sigfe_numero,sigfe_mesp, sigfe_annop, sigfe_region )
                                 select blanco1,blanco2,blanco3,blanco4,blanco5,blanco6,blanco7,blanco8,blanco9,blanco10,blanco11,blanco12, CASE WHEN blanco5='ABONO' THEN sum(blanco13) ELSE '0' END, CASE WHEN blanco5='CARGO' THEN sum(blanco13) ELSE '0' END,'$fechamia','$usuario','$numero','$mesp','$annop','$regionsession' from concilia_sigfetmp
                                 where blanco2<>'' group by blanco10, blanco6  ";

//     echo $sql."<br><br>";
//     exit();
      mysql_query($sql);
      

      
      $sql="delete from concilia_sigfetmp where user='$usuario'";
      echo $sql."<br><br>";
      mysql_query($sql);
      
      

*/

      $sql="INSERT INTO concilia_sigfe (sigfe_anno,sigfe_area,sigfe_cbancaria,sigfe_ccontable,sigfe_tipo,sigfe_fecha,sigfe_sigfe,sigfe_estado2,sigfe_tesoreria,sigfe_numdoc,sigfe_rut,sigfe_bene,sigfe_abono, sigfe_cargo,sigfe_fechasis,sigfe_user,sigfe_numero,sigfe_mesp, sigfe_annop, sigfe_region)
                                 select blanco1,blanco2,blanco3,blanco4,blanco5,blanco6,blanco7,blanco8,blanco9,blanco10,blanco11,blanco12, CASE WHEN blanco5='ABONO' THEN (blanco13) ELSE '0' END, CASE WHEN blanco5='CARGO' THEN (blanco13) ELSE '0' END,'$fechamia','$usuario','$numero','$mesp','$annop','$regionsession' from concilia_sigfetmp
                                 where blanco3<>'' and blanco6>'$sigfefecha' ";
      echo $sql."<br><br>";
//      exit();
      mysql_query($sql);

      $sql="delete from concilia_sigfetmp where user='$usuario'";
//      echo $sql."<br><br>";
      mysql_query($sql);




 //   exit();
   echo "<script>location.href='consolidacion_subida2.php?llave=1';</script>";
?>
</BODY>
</HTML>


