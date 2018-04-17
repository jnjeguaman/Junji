<?
    session_start();
 	unset($_SESSION["depto"]);
	unset($_SESSION["nom_user"]);
	unset($_SESSION["pfl_user"]);
    unset($_SESSION["idn"]);
    unset($_SESSION["rut_cliente"]);
    unset($_SESSION["deptonom"]);
    unset($_SESSION["regionnom"]);
    unset($_SESSION["region"]);
	session_destroy();
	echo "<script>location.replace('../../seguimientos/index.php');</script>";
?>


