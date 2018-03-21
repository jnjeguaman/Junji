<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];



$fecha1=$_POST["fecha1"];
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$rut=$_POST["rut"];
$dig=$_POST["dig"];
$nombre=$_POST["nombre"];
$region=$_POST["region"];
$tipo=$_POST["tipo"];
$contrato=$_POST["contrato"];
$nombre1=$_POST["nombre1"];
$fecha2=$_POST["fecha2"];
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3=$_POST["fecha3"];
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);
$antiguedad=$_POST["antiguedad"];
$anual=$_POST["anual"];
$moneda1=$_POST["moneda1"];
$total=$_POST["total"];
$moneda2=$_POST["moneda2"];
$termino=$_POST["termino"];
$renovacion=$_POST["renovacion"];
$anticipado=$_POST["anticipado"];
$ahorro=$_POST["ahorro"];
$energia=$_POST["energia"];
$propiedad=$_POST["propiedad"];
$habilidad=$_POST["habilidad"];
$usogarantia=$_POST["usogarantia"];
$multas=$_POST["multas"];
$aplicado=$_POST["aplicado"];
$inspector=$_POST["inspector"];
$variabilidad=$_POST["variabilidad"];
$ejecuta=$_POST["ejecuta"];
$evaluara=$_POST["evaluara"];
$nombre2=$_POST["nombre2"];

$ejecutaa=$_POST["ejecutaa"];
$ejecutaah=$_POST["ejecutaah"];
$ejecutab=$_POST["ejecutab"];
$ejecutabh=$_POST["ejecutabh"];
$ejecutac=$_POST["ejecutac"];
$ejecutach=$_POST["ejecutach"];
$ejecutad=$_POST["ejecutad"];
$ejecutadh=$_POST["ejecutadh"];

//exit();

$texto1=$_POST["texto1"];
$texto2=$_POST["texto2"];
$texto3=$_POST["texto3"];
$texto4=$_POST["texto4"];
$texto5=$_POST["texto5"];
$texto6=$_POST["texto6"];
$texto7=$_POST["texto7"];
$texto8=$_POST["texto8"];
$texto9=$_POST["texto9"];
$texto10=$_POST["texto10"];
$texto11=$_POST["texto11"];
$texto12=$_POST["texto12"];



//echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);




if ($rut<>"" and $nombre<>"") {


  $sql3 = "INSERT INTO  dpp_contratos (cont_recepcion, cont_rut, cont_dig, cont_nombre, cont_region, cont_tipo, cont_contrato, cont_nombre1, cont_suscrip, cont_vence, cont_antiguedad, cont_anual, cont_tipo1, cont_total, cont_tipo2 ,cont_termino, cont_renovacion, cont_anticipado, cont_ahorro, cont_energia, cont_propiedad, cont_habilidad, cont_usogarantia, cont_multas, cont_aplicado, cont_inspector, cont_variabilidad, cont_ejecuta, cont_evaluara, cont_nombre2, cont_codigoa, cont_porcea, cont_codigob, cont_porceb, cont_codigoc, cont_porcec, cont_codigod, cont_porced,   cont_usu)
                               VALUES ('$fecha1'     ,'$rut'   ,'$dig ','$nombre','$region', '$tipo', '$contrato', '$nombre1', '$fecha2', '$fecha3', '$antiguedad', '$anual', '$moneda1', '$total', '$moneda2', '$termino', '$renovacion', '$anticipado', '$ahorro', '$energia', '$propiedad', '$habilidad', '$usogarantia', '$multas', '$aplicado', '$inspector', '$variabilidad', '$ejecuta', '$evaluara', '$nombre2', '$ejecutaa', '$ejecutaah', '$ejecutab', '$ejecutabh', '$ejecutac', '$ejecutach', '$ejecutad', '$ejecutadh',             '$usuario')";
                               

  //echo $sql3;
  //exit();
  mysql_query($sql3);

  $sql2="select max(cont_id) as maximo from dpp_contratos where cont_usu='$usuario' ";
  //echo $sql2;
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
/*
 $sql4="insert into dpp_evaexterna (evaext_cont_id) values ('$maximo')";
  mysql_query($sql4);
  
 $sql5="insert into dpp_evainterna (evaint_cont_id) values ('$maximo')";
  mysql_query($sql5);

 $sql6="insert into dpp_evausuario (evausu_cont_id) values ('$maximo')";
  mysql_query($sql6);
*/


}

echo "<script>location.href='contratos.php?llave=1';</script>";


?>


