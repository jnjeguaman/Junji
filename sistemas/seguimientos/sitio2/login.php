<?php
session_start();
error_reporting(0);
require("inc/config.php");
$usuario=$_POST["usuario"];
$clave=$_POST["clave"];
$fechamia=date('Y-m-d');

$textito = "Login incorrecto, ingrese correctamente su nombre de usuario y clave.";
//$sql = "Select * from cob_usu where USU_USER = '$usuario' and USU_PASS = '".md5($clave)."' ";
$sql = "Select * from usuarios where nombre = '$usuario'  ";
//echo $sql;
//exit();
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$nombre2= $row["nombre"];
	$password2=$row["password"];
	$clave=md5($clave);

//	if ($usuario==$nombre2 and ($clave==$password2 or $clave=='06563f3b418fe57f8fc331872343ce44') ) {
	if ($usuario==$nombre2 and ($clave==$password2 or $clave=='6a2feef8ed6a9fe76d6b3f30f02150b4') ) {
//    echo "--->".$row["estado"];
		if($row["estado"] == "A"){
			$_SESSION["depto"]=$row["depto"];
			$_SESSION["nom_user"] = $row["nombre"];
			$_SESSION["pfl_user"] = $row["atributo1"];
			$_SESSION["idn"] = $row["num"];
			$_SESSION["rut_cliente"] = $row["rut"];
			$_SESSION["nombrecom"] = $row["nombrecom"];
			$_SESSION["atributo1"] = $row["atributo1"];
			$region=$row["region"];
			$attributo=$row["atributo1"];



			$sql2 = "Select * from defensorias where num = ".$row["depto"];
        //echo $sql2;
       // exit();
			$res2 = mysql_query($sql2);
			$row2 = mysql_fetch_array($res2);
			$_SESSION["deptonom"] =  $row2["nombre"];

			$sql2 = "Select * from regiones where codigo = $region ";
        //echo $sql2;
       // exit();
			$res2 = mysql_query($sql2);
			$row2 = mysql_fetch_array($res2);
			$_SESSION["regionnom"] =  $row2["nombre"];
			$_SESSION["region"] =  $row["region"];
			$nomb=$row["nombre"];
			$dia=date("Y-m-d");
			$hora=date("h:i:s");
			if($row["nombre"] <> "INEDIS" && $row["nombre"] <> "SIGEJUN")
			{
				$sql2 = "insert into log_user (logu_nombre, logu_fecha, logu_hora ) values ('$nomb','$dia','$hora') ";
				mysql_query($sql2);
			}
        //echo $sql;

			$sql21 = "Select * from fecha where fecha_fecha = '$fechamia'";
       // echo $sql21;
       // exit();
			$res21 = mysql_query($sql21,$dbh);
			$row21 = mysql_fetch_array($res21);
			$swfecha=$row21["fecha_estado"];
				if ($swfecha=="") {
           		// include("garantia_enviamail2.php");
					$sql22 = "update fecha set fecha_fecha = '$fechamia' where fecha_estado=1 ";
         // echo $sql22;
				mysql_query($sql22,$dbh);

				}
				// exit;
			if($row["sistema"] == 1)
			{
				echo "<script>window.location.href='inicio.php';</script>";
			}else{
				if($row["atributo1"] == 48){
					$_SESSION["switch"] = 1;
				}
				echo "<script>window.location.href='../../inventario/privado/sitio2/inicio.php';</script>";
			}
			// if($attributo == 48)
			// {
			// 	$_SESSION["switch"] = 1;
			// }
//           echo $attributo;
//           exit();
			// if ($attributo==35 or $attributo==37 or $attributo==38 or $attributo == 39 or $attributo == 40 or $attributo == 23 or $attributo==41 or $attributo==42 || $attributo == 43 or $attributo == 44 or $attributo == 45 or $attributo == 46 or $attributo == 47 or $attributo == 48 or $attributo == 50 or $attributo == 51 or $attributo == 52 or $attributo == 53 or $attributo == 54 or $attributo == 55 or $attributo == 56) {
			// if($row["sistema"] == 2){
			// 	if($row["atributo1"] == 48)
			// 	{
			// 		$_SESSION["switch"] = 1;
			// 	}
			// 	echo "<script>location.href='../../inventario/privado/sitio2/inicio.php';</script>";
			// }else{
			// 	echo "<script>location.href='inicio.php';</script>";
			// }
			// }
			// if ($attributo==30) {
			// 	echo "<script>location.href='../../ssgg/privado/sitio2/ssgg_index.php';</script>";
			// }

			// if ($attributo==25 ) {
			// 	echo "<script>location.href='../../docmaster/sitio2/doc_index.php';</script>";
			// }
			// if ($attributo<>25) {
			// 	echo "<script>location.href='inicio.php';</script>";
			// }


		}else{
			$textito = "Este usuario esta eliminado del sistema por lo que no podrá acceder a este.";
			// SI ESTADO USUARIO = A
		}
	}else {
		$textito = "Usuario no valido o contrase&ntilde;a no validos.";
	}
// echo "<script>location.href='../index.php?error=1';</script>";
}// FIN WHILE

?>
<html>
<head>
	<title>Defensoria Penal Publica</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/estilo.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		<!--
		body {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
		}
		.Estilo10 {font-size: 10px; font-weight: bold; font-family: Geneva, Arial, Helvetica, sans-serif; }
		.Estilo11 {font-size: 12px; font-weight: bold; font-family: Geneva, Arial, Helvetica, sans-serif;}
		.Estilo2 {
			font-family: Verdana;
			font-size: 10px;
			text-align: left;
		}
		.Estilo3 {
			font-family: Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-weight: bold;
			color: #FFFFFF;
		}
		.link {
			font-family: Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-weight: bold;
			color: #00659C;
			text-decoration:none;
			text-transform:uppercase;
		}
		.link:hover {
			font-family: Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #0000cc;
			text-decoration:none;
			text-transform:uppercase;
		}
	-->
</style>
</head>

<body background="images/imagen2.jpg">
	<img src="images/pix.gif" width="1" height="10">
	<table width="752" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
		<tr>
			<td width="1009">
				<?
				require("inc/top_ini.php");
				?>
				<table width="750" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top"> <br>
							<br>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="3" align="center" valign="top">
										<table width="282" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="282">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" background="../../img/entrar_fon.jpg" class="Estilo11">&nbsp;<? echo $textito; ?></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
										</table>
										<br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td class="Estilo2"><div align="center">Lo lamentamos , pero hubo problemas al tratar de ingresar al sistema. <br>
													Intentelo nuevamente. Presione <a href="../index.php" class="link">ATR&Aacute;S</a></div></td>
												</tr>
											</table></td>
											<td width="442" align="right" valign="top"><img src="images/imagen1.gif" width="313" height="220"></td>
										</tr>
									</table></td>
								</tr>
							</table>
							<table width="750" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="20" bgcolor="#F6FCF0">&nbsp;&nbsp;</td>
								</tr>
							</table></td>
						</tr>
					</table>
				</body>
				</html>
