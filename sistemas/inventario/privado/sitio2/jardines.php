<?php
session_start();
require("inc/config.php");

$limite = 20;

if(isset($_GET["page"]))
{
	$page = $_GET["page"];
}else{
	$page = 1;
}

$start = ($page -1 ) * $limite;

$query = "SELECT * FROM jardines WHERE jardin_region = ".$_SESSION["region"]." LIMIT $start, $limite";
$query = mysql_query($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
</head>
<body>

	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<div style="width:100%;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">

		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">JARDINES</td>
			</tr>
		</table>
		
		<table border="0" cellpadding="4" cellspacing="4" width="100%" align="center">
			<thead>
				<th class="Estilo1mc">ID</th>
				<th class="Estilo1mc">REGION</th>
				<th class="Estilo1mc">CODIGO</th>
				<th class="Estilo1mc">PROVINCIA</th>
				<th class="Estilo1mc">COMUNA</th>
				<th class="Estilo1mc">NOMBRE</th>
				<th class="Estilo1mc">DIRECCION</th>
				<th class="Estilo1mc">PROGRAMA</th>
				<th class="Estilo1mc">TELEFONO</th>
			</thead>

			<tbody>
				<?php while($row = mysql_fetch_array($query)) { ?>
				<tr>
					<td class="Estilo1mc"><?php echo $row["jardin_id"] ?></td>
					<td class="Estilo1mc"><?php echo $row["jardin_region"] ?></td>
					<td class="Estilo1mc"><?php echo $row["jardin_codigo"] ?></td>
					<td class="Estilo1mc"><?php echo $row["jardin_provinvia"] ?></td>
					<td class="Estilo1mc"><?php echo $row["jardin_comuna"] ?></td>
					<td class="Estilo1mc"><?php echo $row["jardin_nombre"] ?></td>
					<td class="Estilo1mc"><?php echo $row["jardin_direccion"] ?></td>
					<td class="Estilo1mc"><?php echo $row["jardin_programa"] ?></td>
					<td class="Estilo1mc"><?php echo $row["jardin_telefono"] ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<?php 
		$query = "SELECT * FROM jardines WHERE jardin_region = ".$_SESSION["region"];
		$query = mysql_query($query);
		$actual = $_REQUEST["page"] + 1;
		$resultados = mysql_num_rows($query);
		$paginas = ceil($resultados / $limite);

		
		echo "<div id='pagination'><a href='".$_SERVER["PHP_SELF"]."?page=1' class='page'>".'Primero'."</a> ";
		if($_REQUEST["page"] - 1 < 1)
		{
		}else{
			echo "<a href='".$_SERVER["PHP_SELF"]."?page=".($_REQUEST["page"]-1)."' class='page' ><i class='fa fa-angle-left'></i></a> ";
		}

		for ($i=1; $i<=$paginas; $i++) { 
			echo "<a href='".$_SERVER["PHP_SELF"]."?page=".$i."' class='page' id='pagination_".$i."'>".$i."</a> "; 
		}; 

		if($_REQUEST["page"] + 1 > $paginas)
		{

		}else{
			echo "<a href='".$_SERVER["PHP_SELF"]."?page=".($_REQUEST["page"]+1)."' class='page'><i class='fa fa-angle-right'></i></a> ";
		}
echo " <a href='".$_SERVER["PHP_SELF"]."?page=$paginas' class='page'>".'Último'."</a></div>"; // Goto last page

?>

<style type="text/css">
	.btn {
    display: inline-block;
    padding: 10px;
    border-radius: 5px; /*optional*/
    color: #aaa;
    font-size: .875em;
}

.page.active {
    border: none;
    background: #616161;
    box-shadow: inset 0px 0px 8px rgba(0,0,0, .5), 0px 1px 0px rgba(255,255,255, .8);
    color: #f0f0f0;
    text-shadow: 0px 0px 3px rgba(0,0,0, .5);
}

	#pagination{
    padding: 20px;
    margin-bottom: 20px;
	}

	#pagination > a {
		color: black;
	}
.btn {
    display: inline-block;
    padding: 10px;
    border-radius: 5px; /*optional*/
    color: #aaa;
    font-size: .875em;
}
	.page:hover, .page.gradient:hover {
    background: #fefefe;
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FEFEFE), to(#f0f0f0));
    background: -moz-linear-gradient(0% 0% 270deg,#FEFEFE, #f0f0f0);
}

.page.gradient {
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#f8f8f8), to(#e9e9e9));
    background: -moz-linear-gradient(0% 0% 270deg,#f8f8f8, #e9e9e9);
}

.page {
    display: inline-block;
    padding: 0px 9px;
    margin-right: 4px;
    border-radius: 3px;
    border: solid 1px #c0c0c0;
    background: #e9e9e9;
    box-shadow: inset 0px 1px 0px rgba(255,255,255, .8), 0px 1px 3px rgba(0,0,0, .1);
    font-size: .875em;
    font-weight: bold;
    text-decoration: none;
    color: #717171;
    text-shadow: 0px 1px 0px rgba(255,255,255, 1);
}

</style>
<script type="text/javascript">
	$(function(){
		console.log("<? echo  $_REQUEST['page'] ?>");
		$("#pagination_<? echo  $_REQUEST['page'] ?>").addClass("active");
	})
</script>
</body>
</html>