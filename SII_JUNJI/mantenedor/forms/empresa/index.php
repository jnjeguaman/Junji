<?php

if(isset($_GET["pagina"]) && $_GET["pagina"] == "empresa")
{
	if(isset($_GET["ori"]) && $_GET["ori"] == "editar")
	{
		require_once("editar.php");
	}else{
		require_once("ver.php");
	}
}

?>