<?php

$dev = '/';
$freespace = disk_free_space($dev);
$totalspace = disk_total_space($dev);
$freespace_mb = $freespace/1024/1024;
$totalspace_mb = $totalspace/1024/1024;
$freespace_percent = ($freespace/$totalspace)*100;
$used_percent = (1-($freespace/$totalspace))*100;

echo "------->".$freespace."<br>";
echo "------->".$totalspace."<br>";
echo "Espacio Libre ->".$freespace_mb."<br>";
echo "Espacio Total->".$totalspace_mb."<br>";
echo "Porcentaje Libre->".$freespace_percent."<br>";
echo "Porcentaje de Uso->".$used_percent."<br>";

//if($used_percent >= 85 or 1==1) // cuando sea mayor de 85% de uso
//{
/*
    $to = "micuenta@algo.com";
    $subject = "Espacio Libre en Disco en el Servidor ('$dev')";
    $text = "Espacio Libre en Disco en el Servidor ('$dev')"."<br>";
    $text .= sprintf("Espacio Total: %8d MB\n", $totalspace_mb."<br>");
    $text .= sprintf("Espacio Libre: %8d MB\n", $freespace_mb."<br>);
    $text .= sprintf("Porcentaje de Uso:  %.2f%%\n", $used_percent."<br>");
    $text .= sprintf("Porcentaje Libre:   %.2f%%\n", $freespace_percent."<br>");
    echo $text;
*/
//    $headers = "MIME-Version: 1.0\r\n";
//    $headers .= "Content-type: text/html; charset=utf-8\r\n";
//    $headers .= "From: info@miservidor.com \r\n";
//    mail($to, $subject, $text, $headers);
//}

$hdd = shell_exec("df -h");
$cpu = shell_exec("lscpu");
$last = shell_exec("last");
echo "Hora Consulta " . date("d/m/Y H:i:s");
echo "<pre>".$hdd."</pre>";
echo "<pre>".$cpu."</pre>";
echo "<pre>".$last."</pre>";

?>

