<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$fechamia=date("Y-m-d");
$numero=$_GET["numero"];

echo $numero;



//--- Regla 6 ajuste mismo monto en sigfe cargo y abono

     $sql2="select *  from  concilia_sigfe where sigfe_abono<>0 and sigfe_region='$regionsession' and sigfe_estado=1  ";
     echo $sql2.">>1<br><br>";
     $res2 = mysql_query($sql2);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $sigfeabono=$row2["sigfe_abono"];
       $sigfeid1=$row2["sigfe_id"];

       $sql3=" select * from concilia_sigfe where sigfe_estado='1'  and sigfe_cargo='$sigfeabono' and sigfe_region='$regionsession'  order by sigfe_fecha  ";
       echo $sql3.">>2<br><br>";
       $res3 = mysql_query($sql3);
       $row3 = mysql_fetch_array($res3);
       $sigfecargo=$row3["sigfe_cargo"];
       $sigfeid2=$row3["sigfe_id"];

       if ($sigfeabono==$sigfecargo) {
          $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo)
                                     values ('$sigfeid1', '$sigfeid2', '$fechamia','$usuario' , '6')";
          echo $sql.">>3<br>";
          mysql_query($sql);


          $sql="update concilia_sigfe set sigfe_estado=2 where sigfe_id=$sigfeid1 ";
          echo $sql.">>4<br>";
          mysql_query($sql);

          $sql="update concilia_sigfe set sigfe_estado=2 where sigfe_id=$sigfeid2 ";
          echo $sql.">>4<br>";
          mysql_query($sql);


       }

     }

//exit();
//--- Regla 9 ajuste mismo monto en cartola cargo y abono

     $sql2="select *  from  concilia_cartola where carto_abono<>0 and carto_region='$regionsession' and carto_estado=1  ";
//     echo $sql2.">1<br><br>";
     $res2 = mysql_query($sql2);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $cartoabono=$row2["carto_abono"];
       $cartoid1=$row2["carto_id"];

       $sql3=" select * from concilia_cartola where carto_estado='1'  and carto_cargo='$cartoabono' and carto_region='$regionsession'  order by carto_fecha  ";
//       echo $sql3.">2<br><br>";
       $res3 = mysql_query($sql3);
       $row3 = mysql_fetch_array($res3);
       $cartocargo=$row3["carto_cargo"];
       $cartoid2=$row3["carto_id"];

       if ($cartoabono==$cartocargo) {


         $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo)
                                     values ('$cartoid1', '$cartoid2', '$fechamia','$usuario' , '9')";
//          echo $sql.">3<br>";
          mysql_query($sql);

          $sql="update concilia_cartola set carto_estado=2 where carto_id=$cartoid1 ";
//          echo $sql.">4<br>";
          mysql_query($sql);

          $sql="update concilia_cartola set carto_estado=2 where carto_id=$cartoid2 ";
//          echo $sql.">4<br>";
          mysql_query($sql);


       }



     }











//exit();
echo "<script>location.href='consolidacion_consolida2.php?numero=$numero';</script>";
 ?>



