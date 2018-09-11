<?
session_start();
require("inc/config.php");
// mysql_select_db ("junji_segfac",$adm);
$fecha=date('Y-m-d');
$hora=date("h:i");

$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);

// Comprar Contraseñas
if(strcmp($nueva1, $nueva2) == 0)
{

	// Buscamos la informacion del usuario;
	$query = "SELECT * FROM usuarios WHERE nombre = '".$usuario."'";
	$res = mysql_query($query,$dbh2);
	$row = mysql_fetch_array($res);
	$dbPwd = $row["password"];
	$actPwd = md5($actual);
	$frmPwd = md5($nueva1);

	if(strcmp($dbPwd, $actPwd) == 0)
	{
		$update = "UPDATE usuarios SET password = '".$frmPwd."' WHERE nombre = '".$usuario."'";

		if(mysql_query($update,$dbh2))
		{
			echo "<script>window.location.href='salir.php';</script>";
		}else{
			echo "<script>window.location.href='inv_cambioclave.php?cod=4&llave=1';</script>";
		}
	}else{
		echo "<script>window.location.href='inv_cambioclave.php?cod=4&llave=2';</script>";
	}

}else{
echo "<script>window.location.href='inv_cambioclave.php?cod=4&llave=3';</script>";
}

	

	



//echo "<script>window.location.href='inv_cambioclave.php?cod=4&sw=1';</script>";
//echo "$rut2<> and $nombres<> and $paterno<> and $materno<>";

/*if ($nueva1<>"" and $nueva2<>"" ) {

  $nueva1=md5($nueva1);
  $sql2="update usuarios set password='$nueva1' where nombre='$usuario' and password='$actual' ";
  echo $sql2;
  if (!(mysql_query($sql2))){
      $sw=2;
  } else {
      $sw=1;
  }

}

exit();


echo "<script>location.href='inv_cambioclave.php?llave=$sw&rut=$rut2';</script>";
*/

?>