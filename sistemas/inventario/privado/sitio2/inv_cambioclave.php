<?php extract($_GET) ?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<script src="librerias/jquery-1.11.3.min.js"></script>
</head>
<body>
<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
	<?
	include("inc/menu_1b.php");
	?>
</div>

<div  style="width:700px; height:530px; background-color:#E0F8E0; position:absolute; top:120px; left:00px;" id="div1">

<table border=0 width="100%">
		<tr>
			<td  class="Estilo2titulo" colspan="10">CAMBIO DE CONTRASEÑA</td>
		</tr>
	</table>
<form action="inv_grabacambioclave.php" method="POST" onSubmit="return valida()">
	<table border="1" width="100%">
		<tr>
				<td  class="Estilo1">Contraseña Actual</td>
				<td  class="Estilo1"><input type="password" name="actual" class="Estilo2" size="40" value="<? echo $row2["ate_nombres"] ?>" > </td>
			</tr>
			<tr>
				<td  class="Estilo1">Contraseña Nuevo</td>
				<td  class="Estilo1"><input type="password" name="nueva1" class="Estilo2" size="40" value="<? echo $row2["ate_nombres"] ?>" > </td>
			</tr>
			<tr>
				<td  class="Estilo1">Repetir Contraseña</td>
				<td  class="Estilo1"><input type="password" name="nueva2" class="Estilo2" size="40" value="<? echo $row2["ate_nombres"] ?>" > </td>
			</tr>
			<tr>
				<td  class="Estilo1c" colspan=4><input type="submit" class="Estilo1C" value="          REALIZAR CAMBIO       " > </td>
			</tr>
	</table>
</form>
<?php
$aviso="";
if (!isset($_GET["llave"])) {
	$llave="";
}

if($llave == 1)
{
$aviso = "NO HA SIDO POSIBLE ACTUALIZAR LA CONTRASEÑA";
}

if($llave == 2)
{
$aviso = "ERROR EN LA CONTRASEÑA";
}

if($llave == 3)
{
$aviso = "ERROR EN LA CONTRASEÑA";
}
?>
<table border=0 width="100%">
		<tr>
			<td  class="Estilo1rojo"><? echo $aviso ?></td>
		</tr>
</table>		

</div>

<script type="text/javascript">
	function valida()
	{
		if(confirm("¿ ESTA SEGURO DE ENVIAR LA INFORMACION ?"))
		{
			blockUI();
			return true;
		}else{
			return false;
		}
	}
</script>
</body>
</html>