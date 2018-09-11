<?php
ini_set("display_errors", 0);
session_start();
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
$nivel=$_SESSION["pfl_user"];
//echo $regionsession;
//ini_set("display_errors", 0);
require("inc/config.php");
extract($_GET);
extract($_POST);
extract($_SESSION);
if (!isset($_GET['limpia'])) {
	$limpia="";
}

$cookie_name1 = "oc";
$occookie=$_COOKIE[$cookie_name1];
// se da valor y se graba la cooki

if ($oc<>$occooke and $limpia<>1 ) {
//  echo "ver 1<br>";
  setcookie($cookie_name1, "", time() - 3600);
  $cookie_value =$oc;
  setcookie($cookie_name1, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}
if(isset($_COOKIE[$cookie_name1]) and ($limpia<>1) ) {
//  echo "ver 3<br>";
  $occookie=$_COOKIE[$cookie_name1];
  //    echo "Cookie named '" . $cookie_name1 . "' is not set!";
}
if ($oc=='' and $occookie<>'' and $limpia<>1) {
//  echo "ver 5<br>";
    $oc=$occookie;
}
if ($limpia==1) {
//  echo "ver 6<br>";
  setcookie($cookie_name1, "", time() - 3600);
  setcookie($cookie_name1, "", time() + (86400 * 30), "/"); // 86400 = 1 day
}



$cookie_name2 = "tipo";
$tipocookie=$_COOKIE[$cookie_name2];
// se da valor y se graba la cooki
if ($swtipo<>$tipocooke and $limpia<>1 ) {
//  echo "ver 1<br>";
  setcookie($cookie_name2, "", time() - 3600);
  $cookie_value2 =$swtipo;
  setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
}
if(isset($_COOKIE[$cookie_name2]) and ($limpia<>1) ) {
//  echo "ver 2<br>";
  $tipocookie=$_COOKIE[$cookie_name2];
  //    echo "Cookie named '" . $cookie_name1 . "' is not set!";
}
if ($swtipo=='' and $tipocookie<>'' and $limpia<>1) {
//  echo "ver 3<br>";
    $swtipo=$tipocookie;
}
if ($limpia==1 ) {
//  echo "ver 4<br>";
  setcookie($cookie_name2, "", time() - 3600);
  setcookie($cookie_name2, "", time() + (86400 * 30), "/"); // 86400 = 1 day
}

$cookie_name3 = "gd";
$gdcookie=$_COOKIE[$cookie_name3];
// se da valor y se graba la cooki
if ($gd<>$gdcookie and $limpia<>1 ) {
//  echo "ver 1<br>";
  setcookie($cookie_name3, "", time() - 3600);
  $cookie_value2 =$gd;
  setcookie($cookie_name3, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
}
if(isset($_COOKIE[$cookie_name3]) and ($limpia<>1) ) {
//  echo "ver 3<br>";
  $gdcookie=$_COOKIE[$cookie_name3];
  //    echo "Cookie named '" . $cookie_name1 . "' is not set!";
}
if ($gd=='' and $gdcookie<>'' and $limpia<>1) {
//  echo "ver 5<br>";
    $gd=$gdcookie;
}
if ($limpia==1) {
//  echo "ver 6<br>";
  setcookie($cookie_name3, "", time() - 3600);
  setcookie($cookie_name3, "", time() + (86400 * 30), "/"); // 86400 = 1 day
}

//  echo "limpia $limpia ";


//--- para el tipo que aun no se hace
if ($tipo<>$tipocookie) {
  // echo "ver 2<br>";
//  setcookie($cookie_name1, "", time() - 3600);
//  $cookie_value =$oc; //"John Doe b bbb";
//  setcookie($cookie_name1, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}


if ($regionsession<>16) {
  $whereregion="where region_id=$regionsession ";
}
   $sqlRegion = "SELECT * FROM acti_region $whereregion order by region_id";
$sqlRegionResp = mysql_query($sqlRegion);
$sqlRegionResp2 = mysql_query($sqlRegion);
$ii=1;
while($row = mysql_fetch_array($sqlRegionResp)) {
  $regionG[$ii]=$row["region_glosa"];
  $regionN[$ii]=$row["region_id"];
   $ii++;
}



$regionsession = $_SESSION["region"];
$sqlCategoria = "SELECT * FROM acti_categoria";
$sqlCategoriaResp = mysql_query($sqlCategoria);

$sqlSubtitulo = "SELECT DISTINCT(acti_subtitulo) FROM acti_subtitulo";
$sqlSubtituloResp = mysql_query($sqlSubtitulo);

$sqlZona = "SELECT * FROM acti_zona";
$sqlZonaResp = mysql_query($sqlZona);

$sqlProveedor = "SELECT proveedor_glosa FROM acti_proveedor ORDER BY proveedor_glosa ASC";
$sqlProveedorResp = mysql_query($sqlProveedor);

$sqlRegion = "SELECT * FROM acti_region";
$sqlRegionResp = mysql_query($sqlRegion);


$sql5="select * from plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$plabode1=$row5["pla_bode1"];
$plabode2=$row5["pla_bode2"];
$plabode3=$row5["pla_bode3"];

/*
if(isset($_POST["ori"]) && $_POST["ori"] <> "")
{
	$ori = $_POST["ori"];
}else{
	$ori = "";
}

if(isset($_GET["ori"]) && $_GET["ori"] <> "")
{
	$ori = $_GET["ori"];
}else{
	$ori = "";
}
*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<script src="librerias/jquery-1.11.3.min.js"></script>
<script src="librerias/jquery.blockUI.js"></script>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>

<script type="text/javascript">
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

</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>
	<?php if (isset($cod) && $cod == 20 or $cod==35): ?>
		<?php include("bode_nuevo_requerimiento3.php") ?>
		<?php// include("nuevo_requerimiento.php") ?>
		<?php // require("bode_ultimas_comprasoc.php") ?>
		<?php //  require("inv_ingresos.php") ?>
	<?php endif ?>

	<?php if ($ori == 1): ?>
		<?php include("bode_nuevo_requerimiento3.php") ?>
		<?php include("bode_ori_1oc.php"); ?>

	<?php endif ?>

	<?php if ($ori == 2): ?>
		<?php include("bode_nuevo_requerimiento3.php") ?>
		<?php include("bode_ori_2oc.php"); ?>
  		<?php //include("ori_2.php") ?>
		<?php //include("ori_1_1.php") ?>
	<?php endif ?>
	<?php if ($ori == 3): ?>
		<?php include("bode_nuevo_requerimiento3.php") ?>
		<?php include("bode_inv_ingresos2.php") ?>
	<?php endif ?>

	<?php if ($ori == 4): ?>
		<?php include("bode_nuevo_requerimiento3.php") ?>
		<?php include("bode_inv_rec_tecnica.php") ?>
		<?php include("bode_inv_rec_tecnica3.php") ?>
	<?php endif ?>
	<?php if ($ori == 5): ?>
		<?php include("bode_nuevo_requerimiento3.php") ?>
		<?php include("bode_inv_rec_tecnica.php") ?>
		<?php include("bode_inv_rec_tecnica2.php") ?>
		<?php include("bode_inv_rec_tecnica3.php") ?>
	<?php endif ?>
	<?php if ($ori == 6): ?>
		<?php include("bode_nuevo_requerimiento3.php") ?>
		<?php include("bode_inv_rec_final.php") ?>
		<?php include("bode_inv_rec_final2.php") ?>
	<?php endif ?>
	<?php if ($ori == 7): ?>
		<?php include("bode_nuevo_requerimiento3.php") ?>
		<?php include("bode_detalle_guiatc.php") ?>
	<?php endif ?>


	<script type="text/javascript">

		function getSubCat(input) {
			var data = ({command : "getSubCat", catsub_cat_id : input});
			$.ajax({
				type:"POST",
				url:"getsubcat.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+value+"'>"+value+"</option>";
					});
					$("#subgrupo").html(resp);

				}
			})

		}


		function getSubtitulo(input) {
			var data = ({command : "getSubtitulo", acti_subtitulo : input});
			$.ajax({
				type:"POST",
				url:"getsubtitulo.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+index+"'>"+value+"</option>";
					});
					$("#item").html(resp);

				}
			})
		}

		function getSubZona(input) {
			var data = ({command : "getSubZona", zona_id : input});
			$.ajax({
				type:"POST",
				url:"getsubzona.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+value+"'>"+value+"</option>";
					});
					$("#zona").html(resp);

				}
			})
		}

		function generarDistribucion()
		{
			console.log(frm4.document.getElementsById('region_distribucion').selectedValue);
		}

	</script>

</body>
</html>
