<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(0);
function Conectarse()
{


   if (!($link=mysql_connect("localhost","segfac","segfac.")))
   {
      echo "Error conectando a la base de datos 1."; 
      exit(); 
   } 
   if (!mysql_select_db("junji_segfac",$link))
   { 
      echo "Error seleccionando la base de datos 2."; 
      exit(); 
   } 
   return $link; 
} 

//$dbh2=mysql_connect ("localhost", "docdpp", "passpass") or die ('I cannot connect to the database because: ' . mysql_error());
//mysql_select_db ("cae12628_junjifac",$dbh2);

?>
