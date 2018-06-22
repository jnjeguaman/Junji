<?php
error_reporting(0);
header('Content-Type: text/html; charset=ISO-8859-1');
$dbh2=mysql_connect ("192.168.100.237", "admin", "Hol@1234") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_segfac",$dbh2);


$dbh=mysql_connect ("192.168.100.237", "admin", "Hol@1234") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_honorario");


?>
