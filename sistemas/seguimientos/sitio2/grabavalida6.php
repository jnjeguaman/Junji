<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$fechamia2=date('d-m-Y');
$usuario=$_SESSION["nom_user"];

$cont=$_POST["cont"];
$var=$_POST["var"];
$var2=$_POST["var2"];
$var3=$_POST["var3"];
$var4=$_POST["var4"];
//$var5=$_POST["var5"];
$var6=$_POST["var6"];
$var7=$_POST["var7"];
$var8=$_POST["var8"];

$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$cont2=1;


while ($cont2<=$cont) {
// echo "$cont2<=$cont";
   $var1=$var[$cont2];
   $var12=$var2[$cont2];
   $var13=$var3[$cont2];
   $var14=$var4[$cont2];
   $var15=$var5[$cont2];
   $var16=$var6[$cont2];
   $var17=$var7[$cont2];
   $var18=$var8[$cont2];
   $var16=trim($var16);
//   echo " $var1<> and $var12 (<12) and $var13 (<13) $var14<> and $var15 <-and ($var16) (<16) <br>";


   if ($var1<>"" and $var12<>"" and $var13<>"" ) {



     if ($var16=='Ch' or  $var16=='No') {
       $sql1="update dpp_etapas set eta_estado=7,  eta_usu_cheque='$usuario', eta_fecha_cheque='$fechamia', eta_negreso='$var12', eta_ncheque='$var13', eta_fechache='$var14'  where eta_id=$var1 ";
//       echo $sql1."(1)<br>";
       mysql_query($sql1);
     }

     if ($var16=='Tr') {
       $sql1="update dpp_etapas set eta_estado=7,  eta_usu_cheque='$usuario', eta_fecha_cheque='$fechamia', eta_negreso='$var12', eta_ncheque='$var13', eta_fechache='$var14'  where eta_id=$var1 ";
//      echo $sql1."(2)<br>";
       mysql_query($sql1);

      $sql1="update dpp_etapas set eta_estado=8,  eta_usu_pagado='$usuario', eta_fecha_pagado='$fechamia', eta_retira='$var12', eta_fecha_retira='$var14', eta_forma='Transferencia'  where eta_id=$var1 ";
//      echo $sql1."(3)<br>";
      mysql_query($sql1);

     }
     
      $sql1="update dpp_periid_etaid set pereta_idcont='$var12', pereta_fechacont='$var14'  where pereta_eta_id=$var1 ";
//     echo $sql1;
       mysql_query($sql1);

     
    $var14b=substr($var14,8,2)."-".substr($var14,5,2)."-".substr($var14,0,4);
//    require_once('inc2/nusoap.php');
//    $cliente = new nusoap_client('http://10.17.5.183/sdi/atencion/servicio3.php');
//    $resultado = $cliente->call('busca2', array('x' => $var17, 'y' => $var18, 'operacion' => 'multiplica'));
//    $resultado = $cliente->call('modifica3', array('x' => $var17, 'y' => $var18, 'a' => $var14b, 'b' => $var12, 'operacion' => 'modifica'));
//    echo "-->".$resultado;
//    sleep(5);

//   exit();
      
//------ calculo del dia pmg

$sql="select * from dpp_etapas where eta_estado=7 and eta_id=$var1 ";
$res3 = mysql_query($sql);
while($row3 = mysql_fetch_array($res3)){
    $etaid = $row3["eta_id"];
    $fechahoy = $row3["eta_fecha_aprobacionok"];
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fecha_recepcion"];

    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff4=$dia2+$diff;
    $diff2=($diff/(60*60*24));
//    echo $diff2."<br>";
    $diff2=intval($diff2);
    $diff2b=$diff2;

    $diff3= date('Y-m-d', $diff4);
   if ($diff2>8) {
    $diff5=8*24*60*60;
    //echo $diff5."<br>";
    $diff4=$dia2+$diff5;
    $diff3= date('Y-m-d', $diff4);
    $diff2b=8;
   }
   $cheque=$row3["eta_fechache"];
   $dia3 = strtotime($cheque);
   $diff6=$dia3-$dia2;
//   $diff7=intval($diff6/(60*60*24));
   $diff7=($diff6/(60*60*24));
   $diff7=intval($diff7);
   $diff8=intval($diff7-$diff2b);
//   echo $diff8."<br>";

   $sql4="update dpp_etapas set eta_diapmg='$diff8' where eta_id=$etaid  ";
//   echo $sql4;
//   exit();
   mysql_query($sql4);


}



//------- fin calculo pmg

   }
   
   
   
   
   if ($var1<>"" and $uno==22) {
      $sql1="update dpp_etapas set eta_estado=11, eta_usu_cheque='$usuario',  eta_fecha_cheque='$fechamia'  where eta_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);
   }

   $cont2++;
}
//exit();

if($var6[1] == "Tr")
{
  echo "<script>location.href='comprobantetransferencia.php';</script>";
}else{
  echo "<script>location.href='valida7.php?llave=1';</script>";
}


?>


