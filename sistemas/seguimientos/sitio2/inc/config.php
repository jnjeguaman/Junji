<?php
error_reporting(0);
header('Content-Type: text/html; charset=ISO-8859-1');
// header('Content-Type: text/html; charset=UTF-8');
//ini_set('session.save_path', 'c:/temp');
//session_start();


//$dbh3=mysql_connect ("localhost", "pasaje", "pasaje") or die ('I cannot connect to the database because: ' . mysql_error());
//mysql_select_db ("pasaje",$dbh3);

//$dbh2=mysql_connect ("localhost", "junji2", "passpass") or die ('I cannot connect to the database because: ' . mysql_error());
//mysql_select_db ("segfac_junji",$dbh2);


//$dbh5=mysql_connect ("localhost", "ejecucion", "passpass") or die ('I cannot connect to the database because: ' . mysql_error());
//mysql_select_db ("ejecucion2",$dbh5);

//$dbh6=mysql_connect ("localhost", "inventario", "inventario.") or die ('I cannot connect to the database because: ' . mysql_error());
$dbh6=mysql_connect ("192.168.100.237", "admin", "Hol@1234") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_inventario",$dbh6);


//$dbh=mysql_connect ("localhost", "segfac", "segfac.") or die ('I cannot connect to the database because: ' . mysql_error());
$dbh=mysql_connect ("192.168.100.237", "admin", "Hol@1234") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_segfac",$dbh);

$programas = array();
$grupos = array();
$uMedida = array();

$qPrograma = "SELECT * FROM inedis_parametros WHERE param_tipo = 4 AND param_estado = 1";
$qGrupo = "SELECT * FROM inedis_parametros WHERE param_tipo = 6 AND param_estado = 1";
$qmedida = "SELECT * FROM inedis_parametros WHERE param_tipo = 7 AND param_estado = 1";

$rPrograma = mysql_query($qPrograma,$dbh6);
$rGrupo = mysql_query($qGrupo,$dbh6);
$rmedida = mysql_query($qmedida,$dbh6);


while($rowPrograma = mysql_fetch_array($rPrograma))
{
	$programas[] = $rowPrograma;
}
while($rowGrupo = mysql_fetch_array($rGrupo))
{
	$grupos[] = $rowGrupo;
}

while($rowUMedida = mysql_fetch_array($rmedida))
{
	$uMedida[] = $rowUMedida;
}

?>
