
<?php 
function Conectarse() 
{ 


   if (!($link=mysql_connect("localhost","labroman1092","password")))
   { 
      echo "Error conectando a la base de datos 1."; 
      exit(); 
   } 
   if (!mysql_select_db("armadores_cl_labroman",$link))
   { 
      echo "Error seleccionando la base de datos 2."; 
      exit(); 
   } 
   return $link; 
} 
?>
