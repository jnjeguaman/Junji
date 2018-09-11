<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}
require_once("inc/config.php");
extract($_POST);

// AGREGA UN NUEVO PROVEEDOR DE TRANSPORTE
if($cmd == "AgregaN")
{
	$pizza = explode("-", $proveedor_rut);
	$rut = trim(str_replace(".","",$pizza[0]));
	$dv = strtoupper($pizza[1]);

	if(mysql_query("INSERT INTO acti_proveedor (proveedor_glosa,proveedor_rut,proveedor_dv,proveedor_estado) VALUES ('".strtoupper($proveedor_glosa)."','$rut','$dv',2)"));
	$proveedor_id = mysql_query("SELECT proveedor_id FROM acti_proveedor WHERE proveedor_rut = '$rut' AND proveedor_dv = '$dv' AND proveedor_estado = 2");
	$proveedor_id = mysql_fetch_array($proveedor_id);
	if(mysql_query("INSERT INTO bode_transporte VALUES (NULL,".$proveedor_id["proveedor_id"].",1)"))
	{
		$log = "INSERT INTO log VALUES (NULL,".$proveedor_id["proveedor_id"].",0,'AGREGA NUEVO PROVEEDOR DE TRANSPORTE','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','DESPACHOS')";
		mysql_query($log);
		$exito = 1;
	}else{
		$exito = 0;
	}
	echo "<script>window.location.href='bode_desp_agrega_e.php?exito=".$exito."'</script>";
}

// AGREGA UN PROVEEDOR YA EXISTENTE
if($cmd == "AgregaE")
{
	if(mysql_query("INSERT INTO bode_transporte VALUES (NULL,$proveedore,1)"))
	{
		$log = "INSERT INTO log VALUES (NULL,".$proveedore.",0,'AGREGA PROVEEDOR EXISTENTE','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','DESPACHOS')";
		mysql_query($log);

		$exito = 1;
	}else{
		$exito = 0;
	}
	echo "<script>window.location.href='bode_desp_agrega_e.php?exito=".$exito."'</script>";
}

// AGREGA UN CHOFER A UN TRANSPORTE
if($cmd == "AgregarChofer")
{
	if(mysql_query("INSERT INTO bode_chofer VALUES (NULL,'".strtoupper($chofer_nombre)."',".$transporte_id.",1)"))
	{
		$log = "INSERT INTO log VALUES (NULL,".$transporte_id.",0,'AGREGA CHOFER A TRANSPORTE','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','DESPACHOS')";
		mysql_query($log);

		$exito = 1;
	}else{
		$exito = 0;
	}
	echo "<script>window.location.href='bode_desp_agrega_c.php?exito=".$exito."'</script>";
}

// AGREGA UNA PATENTE A UN TRANSPORTE
if($cmd == "AgregarPatente")
{
	if(mysql_query("INSERT INTO bode_patente VALUES (NULL,".$transporte_id.",'".strtoupper($patente_glosa)."',1)"))
	{
		$log = "INSERT INTO log VALUES (NULL,".$transporte_id.",0,'AGREGA CHOFER A TRANSPORTE','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','DESPACHOS')";
		mysql_query($log);

		$exito = 1;
	}else{
		$exito = 0;
	}
	echo "<script>window.location.href='bode_desp_agrega_p.php?exito=".$exito."'</script>";

}

?>