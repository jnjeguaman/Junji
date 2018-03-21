<?
    session_start();
 	unset($_SESSION["nom_user"]);
	unset($_SESSION["pfl_user"]);
	unset($_SESSION["idn"]);
    unset($_SESSION["cod"]);
    unset($_SESSION["regionnom"]);
    unset($_SESSION["region"]);
	session_destroy();
	echo "<script>location.replace('../index.php');</script>";
?>
