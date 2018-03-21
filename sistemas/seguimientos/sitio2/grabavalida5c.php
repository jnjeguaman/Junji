<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];





$cont=$_POST["cont"];
$obs=$_POST["obs"];
$fecha4=$_POST["fecha4"];
$var=$_POST["var"];
$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$cont2=1;
$fecha4= substr($fecha4,6,4)."-".substr($fecha4,3,2)."-".substr($fecha4,0,2);


//echo " $cont2<=$cont ";
while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $cont."$var1<> and ($uno==1 or $uno==10 or $uno==3<br>";

   if ($var1<>"" and ($uno==1 or $uno==10 or $uno==3 or $uno==2)) {
      $sql1="update dpp_contratos set cont_estado=$uno, cont_fechatermino='$fecha4', cont_texto1='$obs' where cont_id=$var1 ";
//      $sql1="update dpp_contratos set cont_estado=2,  eta_usu_recepcion2='$usuario', eta_fecha_recepcion2='$fechamia' where eta_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);
   }


   $cont2++;
}
//exit();

echo "<script>location.href='valida5c.php?llave=1';</script>";








?>


