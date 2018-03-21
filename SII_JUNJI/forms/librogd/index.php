<?php
require_once("includes/functions.librogd.php");
extract($_GET);

if($pagina == "librogd" && $ori == "generar")
{
    require_once("generar.php");
}elseif($pagina=="librogd" && $ori=="historial")
{
    require_once("historial.php");
}
?>