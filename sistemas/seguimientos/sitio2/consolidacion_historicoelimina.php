<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_GET);



if ($id<>"" and $idsigfe<>"" and $idcartola<>"" ) {

  if ($tipo==6) {
     $sql="update concilia_sigfe y set  y.sigfe_estado=1 where  y.sigfe_estado=2 and y.sigfe_id='$idcartola'  ";
//     echo $sql."<br>";
     mysql_query($sql);
     
     $sql="update concilia_sigfe y set  y.sigfe_estado=1 where  y.sigfe_estado=2 and y.sigfe_id='$idsigfe'  ";
//     echo $sql."<br>";
     mysql_query($sql);


     $sql="delete from concilia_indice where indi_id='$id'  ";
//     echo $sql."<br>";
     mysql_query($sql);

  }
  if ($tipo==9) {
     $sql="update concilia_cartola x set x.carto_estado=1 where x.carto_estado=2 and x.carto_id='$idcartola'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="update concilia_cartola x set x.carto_estado=1 where x.carto_estado=2 and x.carto_id='$idsigfe'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="delete from concilia_indice where indi_id='$id'  ";
//     echo $sql."<br>";
     mysql_query($sql);

  }
  
  if ($tipo<>6 and $tipo<>9) {

     $sql="update concilia_cartola x set x.carto_estado=1 where x.carto_estado=2 and x.carto_id='$idcartola'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="update concilia_sigfe y set  y.sigfe_estado=1 where  y.sigfe_estado=2 and y.sigfe_id='$idsigfe'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="delete from concilia_indice where indi_id='$id'  ";
//     echo $sql."<br>";
     mysql_query($sql);
  }


}


//exit();
echo "<script>location.href='consolidacion_historico.php?llave=1';</script>";


?>


