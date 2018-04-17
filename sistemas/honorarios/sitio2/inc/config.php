<?php
error_reporting(0);
header('Content-Type: text/html; charset=ISO-8859-1');
$dbh2=mysql_connect ("localhost", "segfac", "segfac.") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_segfac",$dbh2);


$dbh=mysql_connect ("localhost", "hono", "hono.") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_honorario");


?>
