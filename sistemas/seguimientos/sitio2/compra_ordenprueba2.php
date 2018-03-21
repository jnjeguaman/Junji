
<?php



function idpadre($nombre,$valor) {
include("config.inc.php");
$query = "SELECT * from padre order by padre";
mysql_select_db($dbname);
$result = mysql_query($query);
echo "<select name='$nombre' id='$nombre'>";
echo "<option value='' selected>Selecciona un Padre....</option>";
while($registro=mysql_fetch_array($result))
{
echo "<option value='".$registro["idpadre"]."'";
if ($registro["idpadre"]==$valor ) echo " selected";
echo ">".$registro["padre"]." </option>\r\n";
}
echo "</select>";
}
function idhijo($nombre,$valor)
{
include("config.inc.php");
$query = "SELECT * FROM hijo order by hijo";
mysql_select_db($dbname);
$result = mysql_query($query);
echo "<select name='$nombre' id='$nombre'>";
echo "<option value=''>Selecciona un Hijo...</option>";
while($registro=mysql_fetch_array($result))
{
echo "<option value='".$registro["idhijo"]."'";
if ($registro["idhijo"]==$valor) echo " selected";
echo ">".$registro["hijo"]."</option>\r\n";
}
echo "</select>";
}
function idnieto($nombre,$valor)
{
include("config.inc.php");
$query = "SELECT * FROM nieto order by nieto";
mysql_select_db($dbname);
$result = mysql_query($query);
echo "<select name='$nombre' id='$nombre'>";
echo "<option value=''>Selecciona un Nieto...</option>";
while($registro=mysql_fetch_array($result))
{
echo "<option value='".$registro["idnieto"]."'";
if ($registro["idnieto"]==$valor) echo " selected";
echo ">".$registro["nieto"]."</option>\r\n";
}
echo "</select>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title>Ejemplo de Combobox o Select Dependientes con PHP y Jquery | Martin Iglesias</title>
<script type="text/javascript" src="jquery/jquery-1.6.4.js"></script>
<script type="text/javascript">
$(document).ready(function() {
/* COMBOBOX */
$("#idpadre").change(function(event)
{
var idpadre = $(this).find(':selected').val();
$("#pidhijo").html("<img src='loading.gif' />");
$("#pidhijo").load('combobox.php?buscar=hijos&idpadre='+idpadre);
var idhijo = $("#idhijo").find(':selected').val();
$("#pidnieto").html("<img src='loading.gif' />");
$("#pidnieto").load('combobox.php?buscar=nietos&idhijo='+idhijo);
});
$("#idhijo").live("change",function(event)
{
var id = $(this).find(':selected').val();
$("#pidnieto").html("<img src='loading.gif' />");
$("#pidnieto").load('combobox.php?buscar=nietos&idhijo='+id);
});
});
</script>
<style>
select{padding:5px;border:1px solid #bbb;border-radius:5px;margin:5px 0;display:block;box-shadow:0 0 10px #ddd}
#resultados{margin:20px 0;padding:20px;border:10px solid #ddd;}
</style>
</head>
<body>
<h1>Ejemplo de Combobox o Select Dependientes con PHP y Jquery | Martin Iglesias</h1>
<p>
<strong>Nota:</strong> Para nuestro ejemplo, utilizamos 3 selects. Vamos a preasignar valores. padre=1, hijo=2, nieto=3</p>
</p>
<div id="resultados">

<?php
if (isset($_POST)) print_r($_POST);
?>
</div>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<fieldset>
<p><label>Padre:</label><?php idpadre("idpadre","0"); ?></p>
<p id="pidhijo"><label>Hijo:::</label><?php idhijo("idhijo","2"); ?>222</p>
<p id="pidnieto"><label>Nieto:</label><?php idnieto("idnieto","3"); ?>444</p>
<p><input type="submit" name="submit" value="Mostrar resultados" /></p>
</fieldset>
</form>
</body>
</html>
