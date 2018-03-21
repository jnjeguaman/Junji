<?php

$tipoDato=$_POST['d'];
$muestra=filesize($tipoDato);
if ($muestra>700000) {
  echo 1;
} else {
  echo 0;
}

?>
