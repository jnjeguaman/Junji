<?php
ini_set("display_errors", 0);
header('Content-Type: text/html; charset=UTF-8'); 
$dbh2=mysql_connect ("192.168.100.237", "admin", "Hol@1234") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_segfac",$dbh2);
$dbh=mysql_connect ("192.168.100.237", "admin", "Hol@1234") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("junji_inventario");

// $adm = mysql_connect("localhost","root",".junji.db");


/********* PARAMEETROS GENERALES **************/
$estados = array();
$calidad = array();
$ctaContable = array();
$programas = array();
$tCompras = array();
$grupos = array();
$uMedida = array();
$ctaContableEx = array();

$qEstado = "SELECT * FROM inedis_parametros WHERE param_tipo = 1 AND param_estado = 1";
$qCalidad = "SELECT * FROM inedis_parametros WHERE param_tipo = 2 AND param_estado = 1";
$qCta = "SELECT * FROM inedis_parametros WHERE param_tipo = 3 AND param_estado = 1";

$qPrograma = "SELECT * FROM inedis_parametros WHERE param_tipo = 4 AND param_estado = 1";
$qCompra = "SELECT * FROM inedis_parametros WHERE param_tipo = 5 AND param_estado = 1";
$qGrupo = "SELECT * FROM inedis_parametros WHERE param_tipo = 6 AND param_estado = 1";
$qmedida = "SELECT * FROM inedis_parametros WHERE param_tipo = 7 AND param_estado = 1";

$qCtaEx = "SELECT * FROM inedis_parametros WHERE param_tipo = 8 AND param_estado = 1";

$rEstado = mysql_query($qEstado);
$rCalidad = mysql_query($qCalidad);
$rCta = mysql_query($qCta);

$rPrograma = mysql_query($qPrograma);
$rCompra = mysql_query($qCompra);
$rGrupo = mysql_query($qGrupo);
$rmedida = mysql_query($qmedida);

$rCtaEx = mysql_query($qCtaEx);

while($rowEstado = mysql_fetch_array($rEstado))
{
	$estados[] = $rowEstado;
}

while($rowCalidad = mysql_fetch_array($rCalidad))
{
	$calidad[] = $rowCalidad;
}

while($rowCta = mysql_fetch_array($rCta))
{
	$ctaContable[] = $rowCta;
}

while($rowPrograma = mysql_fetch_array($rPrograma))
{
	$programas[] = $rowPrograma;
}


while($rowCompra = mysql_fetch_array($rCompra))
{
	$tCompras[] = $rowCompra;
}


while($rowGrupo = mysql_fetch_array($rGrupo))
{
	$grupos[] = $rowGrupo;
}

while($rowUMedida = mysql_fetch_array($rmedida))
{
	$uMedida[] = $rowUMedida;
}

while($rowCtaEx = mysql_fetch_array($rCtaEx))
{
	$ctaContableEx[] = $rowCtaEx;
}

/*********** FIN PARAMETROS GENERALES ***************/
?>
