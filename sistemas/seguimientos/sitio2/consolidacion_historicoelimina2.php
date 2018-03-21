<?php
session_start();
extract($_POST);
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
// print_r($_POST);

/*
		var2 = indi_id
		var3 = indi_sigfe_id
		var4 = indi_carto_id
		var5 = indi_tipo
*/

for($i=0;$i<$totalElementos;$i++)
{
	if($var1[$i] <> "")
	{
		if ($var5[$i]==6) {
     $sql="update concilia_sigfe y set  y.sigfe_estado=1 where  y.sigfe_estado=2 and y.sigfe_id='$var4[$i]'  ";
    // echo $sql."<br>";
     mysql_query($sql);
     
     $sql="update concilia_sigfe y set  y.sigfe_estado=1 where  y.sigfe_estado=2 and y.sigfe_id='$var3[$i]'  ";
//     echo $sql."<br>";
     mysql_query($sql);


     $sql="delete from concilia_indice where indi_id='$var2[$i]'  ";
//     echo $sql."<br>";
     mysql_query($sql);

  }
  if ($var5[$i]==9) {
     $sql="update concilia_cartola x set x.carto_estado=1 where x.carto_estado=2 and x.carto_id='$var4[$i]'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="update concilia_cartola x set x.carto_estado=1 where x.carto_estado=2 and x.carto_id='$var3[$i]'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="delete from concilia_indice where indi_id='$var2[$i]'  ";
//     echo $sql."<br>";
     mysql_query($sql);

  }
  
  if ($var5[$i]<>6 and $var5[$i]<>9) {

     $sql="update concilia_cartola x set x.carto_estado=1 where x.carto_estado=2 and x.carto_id='$var4[$i]'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="update concilia_sigfe y set  y.sigfe_estado=1 where  y.sigfe_estado=2 and y.sigfe_id='$var3[$i]'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="delete from concilia_indice where indi_id='$var2[$i]'  ";
//     echo $sql."<br>";
     mysql_query($sql);
  }		
// echo $sql."<br>";
	}// IF

} //FOR

echo "<script>location.href='consolidacion_historico.php?llave=1';</script>";
?>