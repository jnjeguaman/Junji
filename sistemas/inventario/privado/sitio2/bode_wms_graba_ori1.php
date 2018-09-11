<?php
require_once("inc/config.php");
session_start();
if($_SESSION["nom_user"] == "" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
extract($_POST);
$regionSession = $_SESSION["region"];
$nombrecom = $_SESSION["nombrecom"];
$fechamia = date("Y-m-d");
$totalElementos = count($var1);
$nom_user = $_SESSION["nom_user"];

$sql = "INSERT INTO bode_orcom (oc_region,oc_region2,oc_fecha,oc_fecha_recep,oc_usu,oc_proveenomb,oc_swdespacho,oc_tipo_guia,oc_tipo,oc_region_destino,oc_wms,oc_usuario) VALUES ('".$var[1][2]."','".$regionSession."','".date("Y-m-d",strtotime($var[1][3]))."','".$fechamia."','".$nombrecom."','CENTRAL DE ABASTECIMIENTO','1','".$var[1][1]."','1','".$var[1][4]."','".$var[1][5]."','".$nom_user."')";
// echo $sql;
mysql_query($sql);
$rs=mysql_query("select @@identity as id");
if ($row=mysql_fetch_row($rs)) {
	$id = trim($row[0]);
}

// INSERTAMOS LOS PRODUCTOS ASOCIADOS A LA GUIA

for($i=1;$i<=$totalElementos;$i++)
{
	$sql2 = "INSERT INTO bode_detoc (doc_oc_id,	doc_especificacion,doc_cantidad,doc_valor_unit,doc_valor_unit2,doc_region,doc_origen_id,doc_numerooc,doc_moneda,doc_valor_moneda,doc_conversion,doc_umedida,doc_factor,doc_especificacion2,doc_item,doc_activo,doc_gasto,doc_id_mercado_publico) VALUES ('".$id."','".$var2[$i]."','".$var3[$i]."','".$var4[$i]."','".$var4[$i]."','".$var[1][4]."','".$var9[$i]."','".$var5[$i]."','PESO','1','".$var4[$i]."','UNIDAD','1','".$var3[$i]."','".$var6[$i]."','".$var7[$i]."','".$var8[$i]."','".$var1[$i]."')";
	
	mysql_query($sql2);
	// echo $sql2."<br>";
	$sql3 = "SELECT * FROM bode_detoc a inner join bode_detingreso b on b.ding_prod_id = a.doc_id WHERE a.doc_id_mercado_publico = '".$var1[$i]."' AND (b.ding_ubicacion = 'CD - DIRNAC' OR b.ding_ubicacion = 'INGRAM')";
	$res3 = mysql_query($sql3);
	$saldo = ($var3[$i]);
	$array = array();

	while($row3 = mysql_fetch_array($res3))
	{
		$array[] = $row3;
	}
	$paso = 0;
	for($x=0;$x<count($array);$x++)
	{       

		if($saldo > 0){

    		// VERIFICAMOS SI HAY STOCK DISPONIBLE EN LA PRIMERA UBICACION
			if($array[$x]["ding_unidad"] > 0)
			{

    			// COMPROBAMOS SI EL SALDO ES IGUAL AL STOCK DISPONIBLE
				if($array[$x]["ding_unidad"] == $saldo)
				{

					mysql_query("UPDATE bode_detingreso SET ding_unidad = ding_unidad - ".$saldo." WHERE ding_id = ".$array[$x]["ding_id"]);
					$saldo = 0;
					break;
				}else{
    					// COMPROBAMOS SI EN LA PRIMERA UBICACION PODEMOS DESCONTAR
					if( ($saldo - $array[$x]["ding_unidad"]) >= 0)
					{
    					// SE HACE EL DESCUENTO DEL TOTAL DE LA UBICACION Y QUEDA EL SALDO
						mysql_query("UPDATE bode_detingreso SET ding_unidad = ding_unidad - ding_unidad WHERE ding_id = ".$array[$x]["ding_id"]);
						$saldo-= $array[$x]["ding_unidad"];
					}else{

    					// EN EL CASO DE QUE EL SALDO SEA MENOR A LO DISPONIBLE EN STOCK
						if($saldo <= $array[$x]["ding_unidad"])
						{
    						// SE DECUENTA EL SALDO EN LA UBICACIN DADA
							mysql_query("UPDATE bode_detingreso SET ding_unidad = ding_unidad - ".$saldo." WHERE ding_id = ".$array[$x]["ding_id"]);
							$saldo-= $array[$x]["ding_unidad"];
						}
					}
				}

			}
			$paso++;
		}

	} 
	
	if(($paso) == sizeof($array) && ($saldo > 0))
	{
		// SI NO HAY DONDE DESCONTAR, SE DECUENTA DE LA PRIMERA UBICACION ENCONTRADA
		mysql_query("UPDATE bode_detingreso SET ding_unidad = ding_unidad - ".$saldo." WHERE ding_id = ".$array[0]["ding_id"]);
	}                    
}

if(1==1){
// MOVEMOS EL ARCHIVO CSV A LA CARPETA DE LOS PROCESADOS
	$configuracion = [
	"url" =>  "ftp.degesis.cl",
	"usuario" => "junji",
	"pwd" => "23.junWms"
	];

	$ftp = ftp_connect($configuracion["url"]);
	$ftp_id = ftp_login($ftp, $configuracion["usuario"], $configuracion["pwd"]);
	if($ftp){
	// CONEXION ESTABLECIDA
		if(ftp_rename($ftp,"openbox/nuevos/".$_POST["wms_file"],"openbox/procesado/".$_POST["wms_file"])){
			echo "<script>alert('El archivo ".$_POST["wms_file"]." ha sido procesado correctamente.');</script>";
		}else{
			echo "<script>alert('El archivo ".$_POST["wms_file"]." ha sido procesado correctamente pero no se ha podido mover de carpeta.');</script>";
		}

	}else{
		echo "<script>alert('Ha ocurrido un error al conectarse al host : ".$configuracion["url"]."');</script>";
	} 
}


?>

<script type="text/javascript">
window.location.href="bode_inv_indexoc4.php?cmd=WMS&ori=<?php $_POST["ori"] ?>";
</script>
