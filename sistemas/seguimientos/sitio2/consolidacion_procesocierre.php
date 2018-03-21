<?
$annohoy=date("Y");
if ($idreg<>'') {
  $regionsession=$idreg;
}
//-------- Saldo Anterior  -------------
$mesanterior=$mesp-1;
$annop22=$annop;
$mesp22=$mesp;
if ($mesanterior==0) {
    $mesp22=13;
    $annop22=$annop-1;
}

     $sql=" select max(resu_id), resu_monto from concilia_resumen where resu_mesp=$mesp22-1 and resu_annop='$annop22' and resu_region='$regionsession' and resu_numero='$numero' and (resu_descripcion='Saldo anterior' or resu_descripcion='Saldo disponible' )  group by resu_id ";
 //    echo $sql."<br><br>";
     $res2 = mysql_query($sql);
     $cont=1;
     $row2 = mysql_fetch_array($res2);
     $resumonto=$row2["resu_monto"];

//-----------  ingreso del mes
     $sql=" select sum(sigfe_abono) as totalabono, sum(sigfe_cargo) as totalcargo from concilia_sigfe where sigfe_mesp='$mesp' and sigfe_annop='$annop' and sigfe_region='$regionsession' and sigfe_numero='$numero'";
//     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $row2 = mysql_fetch_array($res2);
     $totalabono=$row2["totalabono"];
     $totalcargo=$row2["totalcargo"];

//-----------  girados y no cobrados.
      $sql=" select sum(sigfe_abono) as totalabono2 from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and sigfe_region='$regionsession'  order by sigfe_fecha";
//     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $row2 = mysql_fetch_array($res2);
     $totalabono2=$row2["totalabono2"];

// cargos no reconocidos por el banco es negativo
      $sql=" select sum(sigfe_cargo) as totalabono2 from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero' and sigfe_region='$regionsession'  order by sigfe_fecha";
//     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $row2 = mysql_fetch_array($res2);
    $totalasigfecargo=$row2["totalabono2"];


// cargos no reconocidos por la contabilidad
      $sql=" select sum(carto_cargo) as totalacartocargo from concilia_cartola where carto_estado='1' and carto_numero='$numero' and carto_region='$regionsession'  order by carto_fecha";

//     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $row2 = mysql_fetch_array($res2);
     $totalacartocargo=$row2["totalacartocargo"];


// Abonos no reconocidos por la contabilidad
      $sql=" select sum(carto_abono) as totalacartoabono from concilia_cartola where carto_estado='1' and carto_numero='$numero' and carto_region='$regionsession'  order by carto_fecha";
//     echo $sql;
     $res2 = mysql_query($sql);
     $cont=1;
     $row2 = mysql_fetch_array($res2);
     $totalacartoabono=$row2["totalacartoabono"];



//     $totalabono


     $ingresoacumu=$resumonto+$totalcargo;
     $saldodisponible=$ingresoacumu-$totalabono;
     $saldocartola=$saldodisponible+$totalabono2-$totalasigfecargo-$totalacartocargo+$totalacartoabono;
     
//     echo " $saldocartola=$saldodisponible+$totalabono2-$totalacartocargo+$totalacartoabono-$totalasigfecargo";
     
     
/*

      insert into resu_mesp, resu_annop, resu_descripcion, resu_monto, resu_region,resu_numero, resu_user,resu_fechasis
      Saldo anterior:  number_format($resumonto,0,',','.');
      Ingresos del mes (+)   number_format($totalcargo,0,',','.');
      Ingresos Acumulados  number_format($ingresoacumu,0,',','.');


      Gastos del mes (-) number_format($totalabono,0,',','.');
      Saldo disponible number_format($saldodisponible,0,',','.');





      (-) Cargos no reconocidos por el banco number_format($totalacartocargo,0,',','.');
      (+) Cheques girados y no cobrados por el banco number_format($totalabono2,0,',','.');

      (+) Cargos no reconocidos por la contabilidad number_format($totalacartoabono,0,',','.');
      (-) Abonos no reconocidos por la contabilidad number_format(0,0,',','.');
      Saldo cartola number_format($saldocartola,0,',','.');

*/
     

?>


