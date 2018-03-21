<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];





$cont=$_POST["cont"];
$rut=$_POST["rut"];
$id=$_POST["id"];
$res=$_POST["res"];
$var=$_POST["var"];

$cont2=1;

  echo $var1[1]."----".$id;
while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----".$uno;

   if ($var1<>"") {
//      $sql1="insert into dpp_cont_fac (confa_fac_id,confa_cont_id,confa_fecha,confa_usuario, confa_tipodoc, confa_eta_id ) values ('$numfac','$var1','$fechamia','$usuario','$ori2','$id1b') ";
//      echo $sql1;
//      exit();
//      mysql_query($sql1);
      
      
      
  $sql3 = "INSERT INTO dpp_contratores (conres_cont_id, conres_fecha, conres_numero, conres_materia, conres_archivo, conres_user)
                               select  '$id',   docs_fecha   ,docs_folio,     docs_materia,   CONCAT('../../../../archivos/docargedo/',docs_archivo) , '$usuario' from argedo_documentos where docs_id=$var1";


//  echo $sql3;
//  exit();
  mysql_query($sql3);


  $sql3 = "UPDATE  dpp_contratos set cont_nroresolucion ='$res' where cont_id='$id' and cont_nroresolucion='' ";
//  echo $sql3;
//  exit();
  mysql_query($sql3);



   }

   $cont2++;
}

//exit();

  echo "<script>location.href='contratosadjuntos.php?id=$id&rut=$rut';</script>";



?>



