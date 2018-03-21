<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];



extract($_POST);

  

   if ($rut<>"" and $nombre1<>'') {

     $fecha1= substr($fechaini1a,6,4)."-".substr($fechaini1a,3,2)."-".substr($fechaini1a,0,2);
     $fecha2= substr($fechater1b,6,4)."-".substr($fechater1b,3,2)."-".substr($fechater1b,0,2);


     $sql1="INSERT INTO argedo_funcionario (func_rut, func_dig, func_nombre, func_fechaini, func_fechater, func_docs_id, func_user, func_fechasys)
                                     VALUES ( '$rut', '$dig', '$nombre1', '$fecha1', '$fecha2', '', '$usuario', '$fechamia' ); ";
  //   echo $sql1."<br>";
      mysql_query($sql1);
   }

  //         exit();
  echo "<script>location.href='argedo_agregafuncionario.php?llave=1';</script>";


?>


