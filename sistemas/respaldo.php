<h3>GENERACIÓN DE RESPALDO AUTOMÁTICO</h3>
<?php 
ini_set("display_errors", 0);
error_reporting(E_ALL);

$sistemas = [
0 => __DIR__."/archivos/respaldos/BD/INEDIS/".date("Y")."/".date("m"),
1 => __DIR__."/archivos/respaldos/BD/SEGFAC/".date("Y")."/".date("m"),
2 => __DIR__."/archivos/respaldos/BD/HONORARIO/".date("Y")."/".date("m"),
3 => __DIR__."/archivos/respaldos/BD/SII/".date("Y")."/".date("m")
];

foreach ($sistemas as $key => $value) {
	mkdir($value,0777,true);
}


$dataBases = [
0 => array(array("DB" =>"junji_inventario", "FILE" => $sistemas[0]."/INEDIS.".date("Y.m.d",strtotime("-1 day")).".gz")),
1 => array(array("DB" =>"junji_segfac","FILE" => $sistemas[1]."/SEGFAC.".date("Y.m.d",strtotime("-1 day")).".gz")),
2 => array(array("DB" =>"junji_honorario","FILE" => $sistemas[2]."/HONORARIO.".date("Y.m.d",strtotime("-1 day")).".gz")),
3 => array(array("DB" =>"junji_sii","FILE" => $sistemas[3]."/SII.".date("Y.m.d",strtotime("-1 day")).".gz")),
];

// print_r($salida);
// print_r($retorno);

foreach ($dataBases as $key => $value) {
	exec("/opt/lampp/bin/mysqldump -u root -pJunj1MysQL ".$value[0]["DB"] ." | gzip > ".$value[0]["FILE"],$salida,$retorno);
	if($retorno == 0)
	{
		echo "BASE DE DATOS RESPALDADA : <strong>".$value[0]["DB"]."</strong><br>";
	}
	// print_r($value[0]["DB"]);
}
?>