<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

$antigua=$_POST["antigua"];
$nueva1=$_POST["nueva1"];
$nueva2=$_POST["nueva2"];

if(strcasecmp($nueva1, $nueva2) == 0)
{
	$idn = $_SESSION["idn"];
	$md5 = md5($nueva1);
	$sql = "UPDATE usuarios SET password = '".$md5."' WHERE num = ".$idn;
	if(mysql_query($sql))
	{
		$sw = 1;
	}else{
		$sw = 2;
	}
}else{
	$sw = 2;
}

// $sql21="select * from usuarios where nombre='$usuario' and password='$antigua' ";
// echo $sql21;
// $result21=mysql_query($sql21);
// $row21=mysql_fetch_array($result21);
// $usuario2=$row21["nombre"];
// $password2=$row21["password"];
// echo "$usuario2=$usuario and $password2=$antigua and $antigua<>'' and $nueva1<>''";
// if ($usuario2==$usuario and $password2==$antigua and $antigua<>'' and $nueva1<>'') {
//     $sql1="update usuarios set password='$nueva1' where nombre='$usuario' and password='$antigua' ";
//     echo $sql1;
//     mysql_query($sql1);
//     $sw=1;

// } else {
//     $sw=2;
// }


echo "<script>location.href='cambiaclave.php?llave=$sw';</script>";


?>


