<?
session_start();
$niv_m = $_SESSION["pfl_user"];
$nivel = $_SESSION["pfl_user"];

require("inc/config.php");

if ($nivel==1) {
	$wheresql="atributo1=1";
}
if ($nivel==2) {
	$wheresql="atributo2=1";
}
if ($nivel==3) {
	$wheresql="atributo3=1";
}
if ($nivel==4) {
	$wheresql="atributo4=1";
}
if ($nivel==5) {
	$wheresql="atributo5=1";
}
if ($nivel==6) {
	$wheresql="atributo6=1";
}
if ($nivel==7) {
	$wheresql="atributo7=1";
}
if ($nivel==8) {
	$wheresql="atributo8=1";
}

if ($nivel==31) {
	$wheresql="atributo31=1";
}
if ($nivel==32) {
	$wheresql="atributo32=1";
}
if ($nivel==33) {
	$wheresql="atributo33=1";
}
if ($nivel==34) {
	$wheresql="atributo34=1";
}
if ($nivel==35) {
	$wheresql="atributo35=1";
}
if ($nivel==36) {
	$wheresql="atributo36=1";
}

$sql = "Select * from menu where $wheresql order by num";
$res = mysql_query($sql);
?>

<script src="../../seguimientos/sitio2/librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../../seguimientos/sitio2/librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
<meta name="viewport" content="width=500, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css"  >


<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

		<td><img src="images/pix.gif" width="1" height="15"></td>

	</tr>

	<tr>

		<td class="Estilo1">Usuario : <? echo $_SESSION["nom_user"] ?>,</td>

	</tr>

	<tr>

		<td class="Estilo2"><? echo $_SESSION["regionnom"]; ?> </td>

	</tr>

	<tr>

		<td><img src="images/pix.gif" width="1" height="10"></td>

	</tr>

</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

		<tr>

			<td class="Estilo1">Secciones : </td>

		</tr>

		<tr>

			<td class="Estilo2">

				<ul class="nav navbar-nav navbar-left">


					<?

					while($row = mysql_fetch_array($res)){

						?>


						<?


						$nummenu=$row["num"];



//   echo $nummenu." ".$regionsession;


						?>


						<li id="activo_<?php echo $row["num"]?>"><a href="<? echo  $row["url"] ?>?cod=<? echo  $row["num"] ?>">

							<? echo $row["nombre"] ?>

						</a></li> <br>


						<?

					}

					?>

				</td>


			</tr>


		</table>


		<table width="100%" border="0" cellspacing="0" cellpadding="0">

			<tr>

				<td><img src="images/pix.gif" width="1" height="15"></td>

			</tr>

			<tr>

				<td class="Estilo1"><a href="../../seguimientos/sitio2/inicio.php" class="link">VOLVER A SEGFAC</a></td>


			</tr>


			<tr>  

				<td><img src="images/pix.gif" width="1" height="10"></td>

			</tr>

		</table>



		<style>
			.active{
				background-color: rgba(221,221,221,0.25);
			}
		</style>
		<script type="text/javascript">
			$(function(){
				var id = '<?php echo $_GET["cod"] ?>';
				$("#activo_"+id).addClass("active");
			})

			    function blockUI() {
      $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
      },
      message:"Espere un momento porfavor <i class='fa fa-spinner fa-spin'></i>" });
    }

    function unBlockUI() {
      $.unblockUI();
    }
		</script>