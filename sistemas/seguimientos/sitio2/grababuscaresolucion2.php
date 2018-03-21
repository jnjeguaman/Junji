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

extract($_POST);

$cont2=1;

  //echo $var1[1]."----".$id;
//while ($cont2<=$cont) {

//   $var1=$var[$cont2];
//   echo $var1."----".$uno;

 //  if ($var1<>"") {

      
      
      
  $sql3 = "INSERT INTO dpp_contratores (conres_cont_id, conres_fecha, conres_numero, conres_docs_id, conres_user)
                               values(     '$id',       '$fecha4'   ,'$nroresolucion',    '$idargedo',  '$usuario' )";


//  echo $sql3;
//  exit();
  mysql_query($sql3);


  $sql3 = "UPDATE  dpp_contratos set cont_nroresolucion ='$res' where cont_id='$id' and cont_nroresolucion='' ";
//  echo $sql3;
//  exit();
  mysql_query($sql3);



//   }

   $cont2++;
//}

//exit();

  echo "<script>location.href='buscaresolucion2.php?id=$id&rut=$rut&ori=$ori';</script>";



?>



