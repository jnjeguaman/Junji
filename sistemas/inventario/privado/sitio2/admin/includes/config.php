<?php
ini_set("display_errors", 0);
header('Content-Type: text/html; charset=UTF-8'); 

$dbh2=mysql_connect ("localhost", "segfac", "segfac.") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_segfac",$dbh2);

$dbh=mysql_connect ("localhost", "inventario", "inventario.") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_inventario");

// $adm=mysql_connect ("localhost", "root", ".junji.db") or die ('I cannot connect to the database because: ' . mysql_error());
?>