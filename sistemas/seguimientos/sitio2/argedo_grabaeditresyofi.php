<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$fechamia=date('Y-m-d');

$anno=date('Y');

$hora=date("h:i");

$usuario=$_SESSION["nom_user"];

$regionsession = $_SESSION["region"];







extract($_POST);

foreach ($_REQUEST AS $indice => $valor){

  if(!is_numeric($valor)) {

     ${$indice}=strtoupper($valor);

  }

}



$fecha2b=$fecha2;

$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);





$archivo1 = $_FILES["archivo1"]["name"];

$archivo2 = $_FILES["archivo2"]["name"];

$archivo3 = $_FILES["archivo3"]["name"];

$archivo4 = $_FILES["archivo4"]["name"];







if (1==1) {





if ($paises=='' or $paises==0 ) {

   $paises=$area;

}



if ($estados=='' ) {

   $estados=$subarea;

//   echo "entra";

}



//echo $fechasis."--".$fecha2."<br>";

//exit();

 $dia1 = strtotime($fechasis);

// $dia1 = strtotime($fechamia);

// $fechabase =$fechabase;

 $dia2 = strtotime($fecha2b);

 $diff=$dia2-$dia1;

// echo "$fechahoy -- $fechabase $diff <br>";

 $diff2=(intval($diff/(60*60*24)));

 $diff2=$diff2*-1;

 

  if ($docstipo==6) {

      $ti=6;

  }

 

 if ($transparencia=='') {

     $transparencia=0;

 }


$docs_obs2fecha = substr($docs_obs2fecha, 6,4)."-".substr($docs_obs2fecha, 3,2)."-".substr($docs_obs2fecha, 0,2)."";
$docs_feccontra = substr($docs_feccontra, 6,4)."-".substr($docs_feccontra, 3,2)."-".substr($docs_feccontra, 0,2)."";
$docs_fectoma = substr($docs_fectoma, 6,4)."-".substr($docs_fectoma, 3,2)."-".substr($docs_fectoma, 0,2)."";
$docs_fecing = substr($docs_fecing, 6,4)."-".substr($docs_fecing, 3,2)."-".substr($docs_fecing, 0,2)."";
$docs_fecdevo = substr($docs_fecdevo, 6,4)."-".substr($docs_fecdevo, 3,2)."-".substr($docs_fecdevo, 0,2)."";
$docs_fecaretiro = substr($docs_fecaretiro, 6,4)."-".substr($docs_fecaretiro, 3,2)."-".substr($docs_fecaretiro, 0,2)."";
$docs_derivadofec=substr($docs_derivadofec, 6,4)."-".substr($docs_derivadofec, 3,2)."-".substr($docs_derivadofec, 0,2)."";
$docs_fechasiaper=substr($fecha3, 6,4)."-".substr($fecha3, 3,2)."-".substr($fecha3, 0,2)."";
  $sql1="update argedo_documentos set docs_defensoria='$regionsession', docs_fechamodi='$fechamia', docs_horamodi='$hora', docs_area='$paises', docs_subarea='$estados', docs_tramite=upper('$tramite'), docs_fecha='$fecha2', docs_materia=upper('$materia'), docs_obs=upper('$obs'), docs_user='$usuario', docs_tipodoc=upper('$tipodoc'), docs_tipo='$ti', docs_destinatario=upper('$destinatario'), docs_diferencia='$diff2', docs_transparencia='$transparencia', docs_codh='$codh', docs_numh='$numh', docs_annoh='$annoh', docs_referencia='$referencia',docs_feccontra = '$docs_feccontra',docs_fectoma = '$docs_fectoma',docs_fecing = '$docs_fecing',docs_fecdevo = '$docs_fecdevo',docs_fecaretiro = '$docs_fecaretiro',docs_derivado = '$docs_derivado',docs_derivadofec = '$docs_derivadofec',docs_obs2 = '$docs_obs2',docs_obs2fecha = '$docs_obs2fecha', docs_fechasiaper = '$docs_fechasiaper' where docs_id=$id ";



  // echo $sql1;
  // exit();

  mysql_query($sql1);

  



  if ($ti==1) {

   $prefijo="RE";

   $subfijo="resexc";

  }

  if ($ti==2) {

   $prefijo="RA";

   $subfijo="resafec";

  }

  if ($ti==3) {

   $prefijo="O";

   $subfijo="oficio";

  }

  if ($ti==6) {

   $prefijo="RE";

   $subfijo="resexc";

   $rrhh="_rrhh";

 //  $prefijo="SIAPER";

  }

  if($ti==7)
  {
    $prefijo="OC";
    $subfijo="circular";
  }

  

  

  







  $anno=$docsanno;

  $anno2012=$docsanno;

//  echo "$anno2012";

  if ($archivo1 != "") {



//      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession."_1.PDF";

      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_1.PDF";

      // guardamos el archivo a la carpeta files

      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo1;

//      echo $destino." ".$_FILES['archivo1']['tmp_name'];

      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {

          $status = "Archivo subido: <b>".$archivo1."</b>";

           $archivo1="fileargedo".$anno."/".$subfijo."/".$archivo1;

          $sql2="update argedo_documentos set docs_archivo ='$archivo1' where docs_id=$id ";

//          echo $sql2;

          mysql_query($sql2);

      }



   }

   





  if ($archivo2 != "") {



//      $archivo2=$prefijo."_".$folio."_".$anno2012."_".$regionsession."_2.PDF";

      $archivo2=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_2.PDF";

      // guardamos el archivo a la carpeta files

      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo2;

      if (copy($_FILES['archivo2']['tmp_name'],$destino)) {

          $status = "Archivo subido: <b>".$archivo2."</b>";

           $archivo2="fileargedo".$anno."/".$subfijo."/".$archivo2;

          $sql2="update argedo_documentos set docs_archivo2 ='$archivo2' where docs_id=$id ";

//          echo $sql2;

          mysql_query($sql2);

      }



   }

   

   

   

  if ($archivo3 != "") {



//      $archivo3=$prefijo."_".$folio."_".$anno2012."_".$regionsession."_3.PDF";

      $archivo3=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_3.PDF";

      // guardamos el archivo a la carpeta files

      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo3;

      if (copy($_FILES['archivo3']['tmp_name'],$destino)) {

          $status = "Archivo subido: <b>".$archivo3."</b>";

           $archivo3="fileargedo".$anno."/".$subfijo."/".$archivo3;

          $sql2="update argedo_documentos set docs_archivo3 ='$archivo3' where docs_id=$id ";

//          echo $sql2;

          mysql_query($sql2);

      }



   }

  if ($archivo4 != "") {



//      $archivo4=$prefijo."_".$folio."_".$anno2012."_".$regionsession."_4.PDF";

      $archivo4=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_4.PDF";

      // guardamos el archivo a la carpeta files

      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo4;

      if (copy($_FILES['archivo4']['tmp_name'],$destino)) {

          $status = "Archivo subido: <b>".$archivo4."</b>";

           $archivo4="fileargedo".$anno."/".$subfijo."/".$archivo4;

          $sql2="update argedo_documentos set docs_archivo4 ='$archivo4' where docs_id=$id ";

//          echo $sql2;

          mysql_query($sql2);

      }



   }







//        exit();

  







//  exit();

  



}

//exit();

echo "<script>location.href='argedo_editresyofi.php?sw=1&ti=$ti&id=$id&docstipo=$docstipo';</script>";





?>





