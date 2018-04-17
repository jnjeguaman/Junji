
<?php 
function Conectarse() 
{ 


   if (!($link=mysql_connect("localhost","www_hono","Honorario2009!!")))
   { 
      echo "Error conectando a la base de datos 1."; 
      exit(); 
   } 
   if (!mysql_select_db("aestudia_honorarios",$link))
   { 
      echo "Error seleccionando la base de datos 2."; 
      exit(); 
   } 
   return $link; 
} 
?>
