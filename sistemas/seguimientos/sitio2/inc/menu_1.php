<meta name="viewport" content="width=500, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css"  >
<script src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
<?

$niv_m = $_SESSION["pfl_user"];

$nivel = $_SESSION["pfl_user"];

//$regionsession = $_SESSION["region"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='../index.php';</script><?

}

if(isset($_POST["ur"]))
{
		//echo "region->".$_POST["ur"];
	$_SESSION["region"] = $_POST["ur"];
}

//OBLIGA AL USUARIO CAMBIAR LA CONTRASEÑA POR DEFECTO
$habilita = 1;
if($habilita == 1)
{	
require("inc/config.php");
$comparar = "202cb962ac59075b964b07152d234b70";
$sql_user_pwd = "SELECT password FROM usuarios WHERE nombre = '".$_SESSION["nom_user"]."' LIMIT 1";
$res_user_pwd = mysql_query($sql_user_pwd);
$row_user_pwd = mysql_fetch_array($res_user_pwd);
$pwd = $row_user_pwd["password"];

if(strcmp($comparar, $pwd) === 0)
{
	header("Location: cambiaclave.php?cod=120");
}
//Fin
}

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

if ($nivel==9) {
	$wheresql="atributo9=1";
}

if ($nivel==10) {
	$wheresql="atributo10=1";
}

if ($nivel==11) {
	$wheresql="atributo11=1";
}

if ($nivel==12) {
	$wheresql="atributo12=1";
}

if ($nivel==13) {
	$wheresql="atributo13=1";
}

if ($nivel==14) {
	$wheresql="atributo14=1";
}

if ($nivel==15) {
	$wheresql="atributo15=1";
}

if ($nivel==16) {
	$wheresql="atributo16=1";
}

if ($nivel==17) {
	$wheresql="atributo17=1";
}

if ($nivel==18) {
	$wheresql="atributo18=1";
}

if ($nivel==19) {
	$wheresql="atributo19=1";
}

if ($nivel==20) {
	$wheresql="atributo20=1";
}

if ($nivel==21) {
	$wheresql="atributo21=1";
}

if ($nivel==22) {
	$wheresql="atributo22=1";
}

if ($nivel==23) {
	$wheresql="atributo23=1";
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

if ($nivel==37) {
	$wheresql="atributo37=1";
}

if ($nivel==38) {
	$wheresql="atributo38=1";
}

$sql = "Select * from menu where $wheresql  and estado=1 order by num";

$res = mysql_query($sql);

?>





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


	<?php


	extract($_POST);
	// CAMBIAMOS DE REGION
	if(isset($_POST["ur"]))
	{
		//echo "region->".$_POST["ur"];
		$_SESSION["region"] = $_POST["ur"];
	}
	$sqla = "SELECT * FROM acceso WHERE acc_usr = '".$_SESSION["nom_user"]."' LIMIT 1";
	//echo $sqla;
	$sqlar = mysql_query($sqla);
	$sqlarow = mysql_fetch_array($sqlar);
	$_SESSION["Acceso"] =  $sqlarow;
	//echo $_SESSION["region"];
	?>
	<?php if ($_SESSION["Acceso"]["acc_multi_reg"] == 1): ?>
		<tr>
			<td>
          		<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            		<select name="ur" onchange="this.form.submit()" class="Estilo1">
              			<option value="">Seleccionar Region</option>
              			<?php for ($i=1; $i <= 16; $i++) { ?>
              				<option value="<?php echo $i ?>" <?php if($_SESSION["region"] == $i){echo "selected";}?>><?php echo $i ?></option>
              			<? } ?>
            		</select>
          		</form>
          	</td>
    	</tr>
    <?php endif ?>





        
	<?php if ($_SESSION["pfl_user"] == 7): ?>
		<tr>
		<td class="Estilo2"><a href="../../inventario/privado/sitio2/dashboard" target="_blank">Dashboard</a></td>
	</tr>
	<?php endif ?>

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

// $nummenu=$row["num"];
//   echo $nummenu." ".$regionsession;

						?>
						<li id="activo_<?php echo $row["num"]?>"><a href="<? echo  $row["url"] ?>?cod=<? echo  $row["num"] ?>"?><? echo $row["nombre"] ?></a></li><br>
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
				<td class="Estilo1"><a href="salir.php" class="link" target="_parent">Salir Sistema</a></td>
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
