<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];



$cont=$_POST["cont"];
$var=$_POST["var"];
$cont2=1;
//echo $cont."<br>";

while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----<br>";


     if ($var1<>"" ) {
       $sql2="select * from dpp_etapas where eta_id=$var1";
//       echo $sql2."<br>";
       $res2 = mysql_query($sql2,$dbh2);
       while($row3 = mysql_fetch_array($res2)){
          $etafolio=$row3["eta_folio"];           
	  $etaregion=$row3["eta_region"];
           $etarut=$row3["eta_rut"];
           $etadig=$row3["eta_dig"];
           $etacliente=$row3["eta_cli_nombre"];
           $etanumero=$row3["eta_numero"];
           $etamonto=$row3["eta_monto2"];
           $etaitem=$row3["eta_item"];
           $etanegreso=$row3["eta_negreso"];
           $etaid=$row3["eta_id"];
           $fechafac=$row3["eta_fecha_fac"];
           $etafechache=$row3["eta_fechache"];
           $liquido=$etamonto*0.9;
           $sql1="insert into dpp_honorarios2 (hono2_folio,hono2_fechache,hono2_fecha1,hono2_codigo,hono2_region,hono2_rut,hono2_dig,hono2_nombre,hono2_nro_boleta,hono2_bruto,hono2_retencion,hono2_liquido,hono2_item,hono2_usuario,hono2_fecha,hono2_eta_id)
                           values         ('$etafolio', '$etafechache', '$fechafac', '$etanegreso', '$etaregion', '$etarut', '$etadig','$etacliente','$etanumero','$etamonto',       '$retencion1',            '$liquido','$etaitem','$usuario','$fechamia','$etaid')  ";
//           echo $sql1."<br>";
//           exit();
           mysql_query($sql1);
           
          $sql2b="update dpp_etapas set eta_swhono=1 where eta_id=$var1";
//          echo $sql2b."<br>";
          mysql_query($sql2b,$dbh2);


       }
     }

   $cont2++;

}
//exit();

echo "<script>location.href='contabilidad.php?llave=1';</script>";


?>


