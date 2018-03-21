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

//echo $numero;

       
//--- Regla 8 agrupados de sigfe con montos y numero de cartola
     $sql2=" select *, sum(sigfe_abono) AS sigfe_abono, count(sigfe_id) as total from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and sigfe_cargo='0' GROUP BY sigfe_bene, sigfe_numdoc having total>1 order by sigfe_fecha";
//     echo $sql2.">1<br><br>";
     $res2 = mysql_query($sql2);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $sigfenumdoc=$row2["sigfe_numdoc"];
       $sigfeabono=$row2["sigfe_abono"];

       $sql3=" select * from concilia_cartola where carto_estado='1' and carto_operacion='$sigfenumdoc' and carto_cargo='$sigfeabono' and carto_region='$regionsession'  order by carto_fecha  ";
//       echo $sql3.">2<br><br>";
       $res3 = mysql_query($sql3);
       $row3 = mysql_fetch_array($res3);
       $catooperacion=$row3["carto_operacion"];
       $cartocargo=$row3["carto_cargo"];
       $cartoid=$row3["carto_id"];

       if ($catooperacion==$sigfenumdoc and $sigfeabono==$cartocargo) {


         $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo)
         select '$cartoid', sigfe_id, '$fechamia','$usuario' , '8'
         from concilia_sigfe
         where sigfe_estado='1' and sigfe_numero='$numero' and sigfe_cargo='0' and sigfe_numdoc='$sigfenumdoc' ";
//          echo $sql.">3<br>";
          mysql_query($sql);
//exit();

          $sql="update concilia_cartola set carto_estado=2 where carto_id=$cartoid ";
//          echo $sql.">4<br>";
          mysql_query($sql);

          $sql="update concilia_sigfe set sigfe_estado=2 where sigfe_numdoc='$sigfenumdoc' and sigfe_estado=1 and sigfe_region='$regionsession' ";
//          echo $sql.">5<br>";
//        exit();
          mysql_query($sql);



       }



     }







// --- Regla 4 los que cuadran por monto pero muy importante en cartola es el campo abono .
// buscar por cartola abono y sigfe cargo
     $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo) select (x.carto_id) as carto,  (y.sigfe_id) as sigfe,'$fechamia','$usuario' , '4'
     from concilia_cartola x, concilia_sigfe y where x.carto_abono=y.sigfe_cargo and x.carto_estado=1 and y.sigfe_estado=1 and (x.carto_abono<>0 and y.sigfe_cargo<>0) and (x.carto_region='$regionsession' and y.sigfe_region='$regionsession') group by x.carto_abono order by sigfe_id ";
//     echo $sql."<br>";
//     exit();
     mysql_query($sql);


      $sql=" select (x.carto_id) as carto,  (y.sigfe_id) as sigfe,'$fechamia','$usuario' , '4'
             from concilia_cartola x, concilia_sigfe y
             where x.carto_abono=y.sigfe_cargo and x.carto_estado=1 and y.sigfe_estado=1 and (x.carto_abono<>0 and y.sigfe_cargo<>0) and (x.carto_region='$regionsession' and y.sigfe_region='$regionsession') group by x.carto_abono order by sigfe_id ";
//     echo $sql."<br>";
       $res=mysql_query($sql);
       while ($row = mysql_fetch_array($res)) {
          $carto=$row["carto"];
          $sigfe=$row["sigfe"];
          
          $sql2="update concilia_cartola set carto_estado=2 where carto_id=$carto ";
//          echo $sql2."<br>";
//        exit();
          mysql_query($sql2);

          $sql2="update concilia_sigfe set sigfe_estado=2 where sigfe_id=$sigfe ";
//          echo $sql2."<br>";
//        exit();
          mysql_query($sql2);

      }


// Buscar por cartola cargo y sigfe abono
     $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo) select (x.carto_id) as carto,  (y.sigfe_id) as sigfe,'$fechamia','$usuario' , '4'
     from concilia_cartola x, concilia_sigfe y where x.carto_cargo=y.sigfe_abono and x.carto_estado=1 and y.sigfe_estado=1 and (x.carto_cargo<>0 and y.sigfe_abono<>0) and (x.carto_region='$regionsession' and y.sigfe_region='$regionsession') group by x.carto_cargo order by sigfe_id";
//     echo $sql."<br>";
//exit();
     mysql_query($sql);

      $sql=" select (x.carto_id) as carto,  (y.sigfe_id) as sigfe,'$fechamia','$usuario' , '4'
            from concilia_cartola x, concilia_sigfe y where x.carto_cargo=y.sigfe_abono and x.carto_estado=1 and y.sigfe_estado=1 and (x.carto_cargo<>0 and y.sigfe_abono<>0) and (x.carto_region='$regionsession' and y.sigfe_region='$regionsession') group by x.carto_cargo order by sigfe_id";
//     echo $sql."<br>";
       $res=mysql_query($sql);
       while ($row = mysql_fetch_array($res)) {
          $carto=$row["carto"];
          $sigfe=$row["sigfe"];

          $sql2="update concilia_cartola set carto_estado=2 where carto_id=$carto ";
//          echo $sql2;
//        exit();
          mysql_query($sql2);

          $sql2="update concilia_sigfe set sigfe_estado=2 where sigfe_id=$sigfe ";
//          echo $sql2;
//        exit();
          mysql_query($sql2);



       }

//    exit();








//exit();
echo "<script>location.href='consolidacion_consolida2.php?numero=$numero';</script>";
 ?>



