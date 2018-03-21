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

//--- Regla 3 ajuste con ajustados sumatoria si cuadra todo se hace el updates de los ajustados con los ajustes
     $sql=" select sum(sigfe_abono) as m11 from concilia_sigfe where sigfe_estado2='AJUSTADO' and sigfe_estado=1 and sigfe_region='$regionsession' ";
//     $sql=" select sum(sigfe_monto) as m11 from concilia_sigfe where sigfe_estado2='AJUSTADO' and sigfe_estado=1 ";
//     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m11=$row2["m11"];

     $sql=" select sum(sigfe_abono) as m22 from concilia_sigfe where sigfe_estado2='AJUSTE' and sigfe_estado=1 and sigfe_region='$regionsession'";
//     $sql=" select sum(sigfe_monto) as m22 from concilia_sigfe where sigfe_estado2='AJUSTE' and sigfe_estado=1 ";
//     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m22=$row2["m22"]*-1;
//     echo "      $m11----   $m22 <br> ";
     if ($m11==$m22) {
//         echo "entra";
         
        $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo) select '',  sigfe_id,'$fechamia','$usuario' , '3'
        from concilia_sigfe where (sigfe_estado2='AJUSTADO' or sigfe_estado2 ='AJUSTE') and sigfe_estado=1 and sigfe_region='$regionsession' ";
//        echo $sql."<br>";
        mysql_query($sql);

         
        $sql="update concilia_sigfe set sigfe_estado=2 where (sigfe_estado2='AJUSTADO' or sigfe_estado2 ='AJUSTE') and sigfe_estado=1 and sigfe_region='$regionsession' ";
        mysql_query($sql);
//        echo $sql."<br>";



     }


// --- Regla 2 los directo numero de documento y nuemro de sigfe ademas el monto es todo lo mismo.
     $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo) select (x.carto_id) as carto,  (y.sigfe_id) as sigfe,'$fechamia','$usuario' , '2'
     from concilia_cartola x, concilia_sigfe y where x.carto_operacion=y.sigfe_numdoc and x.carto_cargo=y.sigfe_abono and  (y.sigfe_estado2 <>'AJUSTADO' and y.sigfe_estado2 <>'AJUSTE') and (x.carto_estado=1 and y.sigfe_estado=1) and (x.carto_region='$regionsession' and y.sigfe_region='$regionsession') ";
//     echo $sql."<br>";
     mysql_query($sql);


     $sql="update concilia_cartola x, concilia_sigfe y set x.carto_estado=2, y.sigfe_estado=2 where x.carto_operacion=y.sigfe_numdoc and x.carto_cargo=y.sigfe_abono and (y.sigfe_estado2 <>'AJUSTADO' and y.sigfe_estado2 <>'AJUSTE') and  (x.carto_region='$regionsession' and y.sigfe_region='$regionsession')";
//     echo $sql."<br>";
     mysql_query($sql);
     
     

//****--- Regla 1 1720 son tranferencias los agrupados en la subida del sigfe por los numero correlativos de la cartola tranferencia

      $sql="select sum(sigfe_abono) as total, sigfe_numdoc from concilia_sigfe
                       where sigfe_user='$usuario'
                        and (sigfe_bene <>'BANCO DEL ESTADO DE CHILE'  AND sigfe_bene <>'DEFENSORIA PENAL PUBLICA'
                        AND sigfe_bene <>'MSLI LATAM INC.'
                        AND sigfe_bene <>'TESORERIA GENERAL DE LA REPUBLICA'
                        AND sigfe_tipo  ='abono')  and (sigfe_estado2 <>'AJUSTADO' and sigfe_estado2 <>'AJUSTE') and sigfe_anno<>'' and sigfe_estado=1
                        AND sigfe_region='$regionsession'
                       group by sigfe_numdoc  ";

//       echo $sql;
       $res=mysql_query($sql);
       while ($row = mysql_fetch_array($res)) {
          $total=$row["total"];
          $numdoc=$row["sigfe_numdoc"];
          $total2='';
          $sql2="select * from concilia_cartola where carto_operacion='1720'  and carto_user='$usuario' and carto_estado=1 and carto_cargo='$total' and carto_region='$regionsession' ";
//          echo $sql2."<br>";
          $res2=mysql_query($sql2);
          $row2 = mysql_fetch_array($res2);
          $total2=$row2["carto_cargo"];
          $carto_id=$row2["carto_id"];
//          echo $total2."<--<br>";
          if ($total2<>'') {
              $sql3="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo)
                       select '$carto_id',  (sigfe_id) as sigfe,'$fechamia','$usuario' , '1'
                       from concilia_sigfe y
                       where y.sigfe_numdoc='$numdoc' and sigfe_user='$usuario'
                        and (sigfe_bene <>'BANCO DEL ESTADO DE CHILE'  AND sigfe_bene <>'DEFENSORIA PENAL PUBLICA'
                        AND sigfe_bene <>'MSLI LATAM INC.'
                        AND sigfe_bene <>'TESORERIA GENERAL DE LA REPUBLICA'
                        AND sigfe_tipo  ='abono')  and (sigfe_estado2 <>'AJUSTADO' and sigfe_estado2 <>'AJUSTE') and sigfe_estado=1 and sigfe_anno<>''
                        AND sigfe_region='$regionsession'  ";
//              echo $sql3."<br><br>";
              mysql_query($sql3);


              $sql4="update concilia_cartola x set x.carto_estado=2 where x.carto_id='$carto_id'  ";
//              echo $sql4."<br><br>";
              mysql_query($sql4);

              $sql4="update concilia_sigfe set sigfe_estado=2 where sigfe_numdoc='$numdoc' and sigfe_user='$usuario'
                        and (sigfe_bene <>'BANCO DEL ESTADO DE CHILE'  AND sigfe_bene <>'DEFENSORIA PENAL PUBLICA'
                        AND sigfe_bene <>'MSLI LATAM INC.'
                        AND sigfe_bene <>'TESORERIA GENERAL DE LA REPUBLICA'
                        AND sigfe_tipo  ='abono')  and (sigfe_estado2 <>'AJUSTADO' and sigfe_estado2 <>'AJUSTE') and sigfe_anno<>''
                        AND sigfe_region='$regionsession' ";
//              echo $sql4."<br><br>";
              mysql_query($sql4);


          }


       }
       
       
       
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






//--- Regla 6 ajuste mismo monto en sigfe cargo y abono

     $sql2="select *  from  concilia_sigfe where sigfe_abono<>0 and sigfe_region='$regionsession' and sigfe_estado=1  ";
//     echo $sql2.">1<br><br>";
     $res2 = mysql_query($sql2);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $sigfeabono=$row2["sigfe_abono"];
       $sigfeid1=$row2["sigfe_id"];

       $sql3=" select * from concilia_sigfe where sigfe_estado='1'  and sigfe_cargo='$cartoabono' and sigfe_region='$regionsession'  order by sigfe_fecha  ";
//       echo $sql3.">2<br><br>";
       $res3 = mysql_query($sql3);
       $row3 = mysql_fetch_array($res3);
       $sigfecargo=$row3["sigfe_cargo"];
       $sigfeid2=$row3["sigfe_id"];

       if ($cartoabono==$cartocargo) {


         $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo)
                                     values ('$sigfeid1', '$sigfeid2', '$fechamia','$usuario' , '6')";
//          echo $sql.">3<br>";
          mysql_query($sql);
//exit();

          $sql="update concilia_sigfe set sigfe_estado=2 where sigfe_id=$sigfeid1 ";
//          echo $sql.">4<br>";
          mysql_query($sql);

          $sql="update concilia_sigfe set sigfe_estado=2 where sigfe_id=$sigfeid2 ";
//          echo $sql.">4<br>";
          mysql_query($sql);


       }



     }


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
echo "<script>location.href='consolidacion_consolida2.php';</script>";
 ?>



