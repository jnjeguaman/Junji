<?
session_start();
require("inc/config.php");


extract($_POST);
extract($_GET);

     $sql1="delete from argedo_funcionario where func_id=$id ";
  //   echo $sql1."<br>";
      mysql_query($sql1);
      echo "borrar";

  //         exit();


?>


