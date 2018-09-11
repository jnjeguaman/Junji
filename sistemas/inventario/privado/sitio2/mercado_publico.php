<?
require_once("inc/config.php");

// $sql = "SELECT * FROM bode_detoc a inner join bode_orcom b on a.doc_oc_id = b.oc_id where b.oc_tipo = 0";
$sql = "SELECT * FROM bode_detoc WHERE (doc_id_mercado_publico = '' OR doc_id_mercado_publico IS NULL) and (doc_region = 16 or doc_region = 13)";
$res = mysql_query($sql,$dbh);
$con_id = 0;
$sin_id = 0;
$inicio = microtime(true);
while($row = mysql_fetch_array($res)) { 

	$pizza = explode(" ",$row["doc_especificacion"]);
	$largo = strlen($pizza[0]);

	$inicio = $pizza[0][0];
	$final  = $pizza[0][$largo - 1];
	$reemplazo = array("(",")","ID: ");

	if($inicio == "(" && $final == ")")
	{
		$temporal = str_replace($reemplazo,"",$pizza[0]);
		$temporal = trim($temporal);
		$sql2 = "UPDATE bode_detoc SET doc_id_mercado_publico = '".$temporal."' WHERE doc_id = ".$row["doc_id"];
		if(mysql_query($sql2))
		{
			$con_id++;
		}
	}else{
		$temporal = trim(str_replace("-", "", $row["doc_numerooc"]));
		$concat = $temporal.$row["doc_id"];
		$sql2 = "UPDATE bode_detoc SET doc_id_mercado_publico = '".$concat."' WHERE doc_id = ".$row["doc_id"];
		mysql_query($sql2);
		$sin_id++;
	}

}
$final = microtime(true);
echo "Actualizados : ".$con_id;
echo "<br>Sin actualizar : ".$sin_id;
echo "<br>Tiempo de ejecucion : ".($_SERVER["REQUEST_TIME_FLOAT"] - $inicio) / 60;
?>