<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
 



$cont=$_POST["cont"];
$var=$_POST["var"];
$var2=$_POST["var2"];
$var3=$_POST["var3"];
$nombre=$_POST["nombre"];

$cont2=1;


$sql1="insert into dpp_prorroteo (prorro_nombre, prorro_region, prorro_fecha, prorro_usuario)
                          values ('$nombre','$regionsession','$fechamia','$usuario')  ";
//      echo $sql1;
mysql_query($sql1);

$sql2="select max(prorro_id) as maximo2 from dpp_prorroteo where prorro_region='$regionsession' and prorro_usuario='$usuario' ";
//echo $sql2."$ $cont<br>";

$result=mysql_query($sql2);
$row=mysql_fetch_array($result);
//echo "--->".$row["maximo2"]."<br>";
$maximo=$row["maximo2"];


while ($cont2<=$cont) {

   $var11=$var[$cont2];
   $var22=$var2[$cont2];
   $var33=$var3[$cont2];
//   echo $var1."----".$uno;

   if ($var11<>"" ) {
        $sql1="insert into dpp_prorroteodet (prorrodet_prorro_id, prorrodet_region, prorrodet_unidadid, prorrodet_unidadnombre, prorrodet_monto, prorrodet_numero, prorrodet_fecha, prorrodet_usuario)
                                     values ('$maximo',          '$regionsession',       '$var11',            '$var33',               '0',          '$var22' ,   '$fechamia',           '$usuario')  ";
//        echo $sql1."<br><br>";
        mysql_query($sql1);


   }

//   echo $cont2."<br>";
   $cont2++;
}


//exit();
echo "<script>location.href='dpp_plantilla.php?llave=1';</script>";








?>



