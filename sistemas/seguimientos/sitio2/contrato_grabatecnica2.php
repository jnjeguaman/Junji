<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);

$fecha1=$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

if ($id<>"" and $rut<>"") {
    $sql1="INSERT INTO contra_tecnico (ctec1_cont_id, ctec1_preg1, ctec1_preg2, ctec1_preg3, ctec1_preg4, ctec1_preg5, ctec1_preg6, ctec1_preg7, ctec1_obs, ctec1_user, ctec1_fecahsys)
                               VALUES ('$id', '$preg1', '$preg2', '$preg3', '$preg4', '$preg5', '$preg6', '$preg7', '$obs', '$usuario', '$fechamia')";
//   echo $sql1."<br>";
// exit();
    mysql_query($sql1);


   $sql1="update contra_tecnico set ctec1_preg1='$preg1', ctec1_preg2='$preg2', ctec1_preg3='$preg3', ctec1_preg4='$preg4', ctec1_preg5='$preg5', ctec1_preg6='$preg6', ctec1_preg7='$preg7', ctec1_obs='$obs' where ctec1_cont_id=$id";
//   echo $sql1."<br>";
// exit();
    mysql_query($sql1);
    
    $sql1="update dpp_contratos set cont_eva1='1'  where cont_id=$id ";
//   echo $sql1."<br>";
// exit();
    mysql_query($sql1);

 

}


//exit();
echo "<script>location.href='contrato_tecnico.php?llave=1&rut=$rut&id=$id&ori=$ori';</script>";


?>


