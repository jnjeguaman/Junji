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



// --- Regla 2 los directo numero de documento y nuemro de sigfe ademas el monto es todo lo mismo.
     $sql2="select *
     from concilia_cartola x, concilia_sigfe y
     where x.carto_operacion=y.sigfe_numdoc and x.carto_cargo=y.sigfe_abono and  (y.sigfe_estado2 <>'AJUSTADO' and y.sigfe_estado2 <>'AJUSTE') and (x.carto_estado=1 and y.sigfe_estado=1) and (x.carto_region='$regionsession' and y.sigfe_region='$regionsession') ";
     echo $sql2.">>1<br><br>";
//     exit();
     $res2 = mysql_query($sql2);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $sigfeid=$row2["sigfe_id"];
       $sigfeabono=$row2["sigfe_abono"];
       $sigfeestado=$row2["sigfe_estado"];
       $cartoid=$row2["carto_id"];
       $cartocargo=$row2["carto_cargo"];
       $cartoestado=$row2["carto_estado"];

       if ($sigfeestado==1 and $cartoestado==1) {
          $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo)
                                     values ('$cartoid', '$sigfeid', '$fechamia','$usuario' , '2')";
          echo $sql.">>3<br>";
          mysql_query($sql);


          $sql="update concilia_sigfe set sigfe_estado=2 where sigfe_id=$sigfeid ";
          echo $sql.">>4<br>";
          mysql_query($sql);

          $sql="update concilia_cartola set carto_estado=2 where carto_id=$cartoid ";
          echo $sql.">>4<br>";
          mysql_query($sql);


       }

     }


//  exit();

/*

     $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo) select (x.carto_id) as carto,  (y.sigfe_id) as sigfe,'$fechamia','$usuario' , '2'
     from concilia_cartola x, concilia_sigfe y where x.carto_operacion=y.sigfe_numdoc and x.carto_cargo=y.sigfe_abono and  (y.sigfe_estado2 <>'AJUSTADO' and y.sigfe_estado2 <>'AJUSTE') and (x.carto_estado=1 and y.sigfe_estado=1) and (x.carto_region='$regionsession' and y.sigfe_region='$regionsession') ";
//     echo $sql."<br>";
     mysql_query($sql);


     $sql="update concilia_cartola x, concilia_sigfe y set x.carto_estado=2, y.sigfe_estado=2 where x.carto_operacion=y.sigfe_numdoc and x.carto_cargo=y.sigfe_abono and (y.sigfe_estado2 <>'AJUSTADO' and y.sigfe_estado2 <>'AJUSTE') and  (x.carto_region='$regionsession' and y.sigfe_region='$regionsession')";
//     echo $sql."<br>";
     mysql_query($sql);
*/
     
     

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
       
       



//exit();
echo "<script>location.href='consolidacion_consolida2.php?numero=$numero';</script>";
 ?>



