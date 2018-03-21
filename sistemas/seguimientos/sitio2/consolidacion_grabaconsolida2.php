<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
$date_in=date("d-m-Y");
$fechamia=date("Y-m-d");

//error_reporting(E_ALL);
extract($_POST);
extract($_GET);

$sql="select max(indi_grupo) as maximo from concilia_indice  ";
//echo $sql;
//exit();
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$maximo=$row["maximo"]+1;

$numero=$_POST["numero"];

$cont1=$_POST["cont1"];
$cont2=$_POST["cont2"];

$var3=$_POST["var3"];
$var4=$_POST["var4"];

$var33=$_POST["var33"];
$var44=$_POST["var44"];


$conti=0;

// echo "$cont1<=$cont2 $numero<br>";
if ($cont1>=$cont2) {
    $cont=$cont1;
} else {
     $cont=$cont2;
}
// echo "$conti<=$cont";
//exit();
$i=1;
$j=1;
while ($conti<=$cont) {

   $var3b=$var3[$conti];
   $var4b=$var4[$conti];
   $var33b=$var33[$conti];
   $var44b=$var44[$conti];


//  echo $var33b."<--$var3b<--".$var44b."--> <----".$var4b."<br>";

   if ($var3b<>"" ) {
      $arre1[$i]=$var33b;
//      echo $var33b."<----<br>";
      $i++;
   }
   if ($var4b<>"") {
       $arre2[$j]=$var44b;
//       echo $var44b."<<<<br>";
       $j++;
   }

   $conti++;
}
$resultado1 = count($arre1);
$resultado2 = count($arre2);
//echo " $resultado1 ---- $resultado2 <br>";
//exit();

//------ Para todos de cartola con todos de sigfe
if ($resultado1<>0 and $resultado2<>0) {
 for ($j=1;$j<=$resultado1;$j++) {
  for ($k=1;$k<=$resultado2;$k++) {
//    echo $arre1[$j]."--".$arre2[$k]."<br>";

//--- Cambia estado los seleccionados
     $sql="update concilia_cartola x set x.carto_estado=2 where x.carto_estado=1 and x.carto_id='".$arre1[$j]."'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="update concilia_sigfe y set  y.sigfe_estado=2 where  y.sigfe_estado=1 and y.sigfe_id='".$arre2[$k]."'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo, indi_grupo)
                              values   ( '".$arre1[$j]."','".$arre2[$k]."', '$fechamia','$usuario' , '5','$maximo')";

//     echo $sql."<br>";
     mysql_query($sql);


      //mysql_query($sql1);
   }
 }
}


//------ Solo para SIGFE   7
if ($resultado1==0 and $resultado2<>0) {

  for ($k=1;$k<=$resultado2;$k++) {
//   echo $arre1[$j]."--".$arre2[$k]."<br>";

//--- Cambia estado los seleccionados

     $sql="update concilia_sigfe y set  y.sigfe_estado=2 where  y.sigfe_estado=1 and y.sigfe_id='".$arre2[$k]."'  ";
//     echo $sql."<br>";
     mysql_query($sql);

     $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo, indi_grupo)
                              values   ( '0','".$arre2[$k]."', '$fechamia','$usuario' , '7','$maximo')";

//     echo $sql."<br>";
     mysql_query($sql);
    //mysql_query($sql1);
   }

}



//------ Solo para CARTOLA  8
if ($resultado1<>0 and $resultado2==0) {

 for ($j=1;$j<=$resultado1;$j++) {
//   echo $arre1[$j]."--".$arre2[$k]."<br>";

//--- Cambia estado los seleccionados

     $sql="update concilia_cartola y set  y.carto_estado=2 where  y.carto_estado=1 and y.carto_id='".$arre1[$j]."'  ";
     // echo $sql."<br>";
     mysql_query($sql);

     $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo, indi_grupo)
                              values   ( '".$arre1[$j]."', '0','$fechamia','$usuario' , '8','$maximo')";

     // echo $sql."<br>";
     mysql_query($sql);
    //mysql_query($sql1);
   }

}

//exit();
echo "<script>location.href='consolidacion_consolida2.php?llave=1&numero=$numero';</script>";



 ?>



