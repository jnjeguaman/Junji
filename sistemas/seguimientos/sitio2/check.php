<?php
$archivo ="INEDIS_WMS_OC_".rand(1,1000).".csv";
$configuracion = [
"url" =>  "ftp.degesis.cl",
"usuario" => "junji",
"pwd" => "23.junWms"
];
echo $ftp = ftp_connect($configuracion["url"]);
echo "<br>".$ftp_id = ftp_login($ftp, $configuracion["usuario"], $configuracion["pwd"]);
if($ftp_id)
	{
		echo "Conectado!!1";
		$directorios = ftp_nlist($ftp, "inedis");
		print_r($directorios);
		echo "<br>FIN!";

		$destino = $directorios[2]."/".$archivo;
		// CARGAMOS EL ARCHIVO EN EL SERVIDOR FTP EN EL DIRECTORIO INEDIS/NUEVOS

	}

?>