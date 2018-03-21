<?
session_start();
$deptosession=$_SESSION["depto"];
$usuario=$_SESSION["nom_user"];


//Configuracion de la conexion a base de datos
//include("db.php");
require("inc/config.php");

?>
<script>

</script>


<?
//	$con = mysql_connect($bd_host, $bd_usuario, $bd_password);
//	mysql_select_db($bd_base, $con);

    $nom=$_POST['nombre'];
    


//consulta todos los empleados

if ($nom=='' or 1==1) {
//   $where1=" and provee_unidadnum=$deptosession  ";
}


$sql4="select * from argedo_funcionario where func_user='$usuario' and func_estado=1 ";

//$sql4="select * from dotacion where concat(NOMBRE,' ',PATERNO,' ',MATERNO) like '%$nom%' $where1 order by NOMBRE, PATERNO limit 0,100";
//$sql4="select * from dotacion where concat(NOMBRE,' ',PATERNO,' ',MATERNO) like '%$nom%' $where1 order by NOMBRE, PATERNO limit 0,100";
//echo $sql4;
//$sql4="select * from dpp_proveedores where concat(provee_nombre,' ',provee_paterno,' ',provee_materno) like '%$nom%' $where1 order by provee_nombre, provee_paterno limit 0,100";
$res2 = mysql_query($sql4);
//$res2 = mysql_query($sql4,$dbh2);
//echo $sql4;
//$sql=mysql_query("SELECT * FROM empleados where nombre like '%$nom%' order by nombre",$con);
//echo "---->".$sql;
?>
<table border=1>
	<tr>
		<td class='Estilo1'>Rut</td>
		<td class='Estilo1'>Nombre</td>
		<td class='Estilo1'>Fecha Ini.</td>
		<td class='Estilo1'>Fecha Ter.</td>
		<td class='Estilo1'>Borrar</td>

  	</tr>
<?php
  while($row = mysql_fetch_array($res2)){

?>
<tr>
<td class='Estilo1'><? echo $row["func_rut"]; ?><? echo $row["func_dig"]; ?></td>
<td class='Estilo1'><? echo $row["func_nombre"]; ?></td>
<td class='Estilo1'><? echo $row["func_fechaini"]; ?></td>
<td class='Estilo1'><? echo $row["func_fechater"]; ?></td>
<td class='Estilo1'><a href="#"  onclick="BorraAjax(<? echo $row["func_id"]; ?>);" class="link">Borrar</a></td>
</tr>
<?
  }
?>
</table>
