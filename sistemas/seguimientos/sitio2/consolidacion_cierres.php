<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$nivel = $_SESSION["pfl_user"];

$regionsession = $_SESSION["region"];

$user=$_SESSION["nom_user"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}

$date_in=date("Y-m-d");

?>

<html>

<head>

<title>Cierres</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/estilos.css" rel="stylesheet" type="text/css">

<style type="text/css">

<!--

body {

	margin-left: 0px;

	margin-top: 0px;

	margin-right: 0px;

	margin-bottom: 0px;

}

.Estilo1 {

	font-family: Verdana;

	font-weight: bold;

	font-size: 10px;

	color: #003063;

	text-align: left;

}

.Estilo2 {

	font-family: Verdana;

	font-size: 10px;

	text-align: left;

}

.Estilo2b {

	font-family: Verdana;

	font-size: 9px;

	text-align: left;

}

.link {

	font-family: Geneva, Arial, Helvetica, sans-serif;

	font-size: 10px;

	font-weight: bold;

	color: #00659C;

	text-decoration:none;

	text-transform:uppercase;

}

.link:over {

	font-family: Geneva, Arial, Helvetica, sans-serif;

	font-size: 10px;

	color: #0000cc;

	text-decoration:none;

	text-transform:uppercase;

}

.Estilo4 {

	font-size: 10px;

	font-weight: bold;

}

.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif;

font-size: 14px;

font-weight: bold;

text-align: center;}

-->

</style>







</head>

<!-- calendar stylesheet -->

  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />



  <!-- main calendar program -->

  <script type="text/javascript" src="librerias/calendar.js"></script>



  <!-- language for the calendar -->

  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>



  <!-- the following script defines the Calendar.setup helper function, which makes

       adding a calendar a matter of 1 or 2 lines of code. -->

  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

  



<body>
<div class="navbar-nav ">
    <div class="container">
        <div class="navbar-header">



    <?
    require("inc/top.php");
    ?>

   </div>
</div>
</div>


   <div class="container">
         <div class="row">
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

      <?
      require("inc/menu_1.php");
      ?>

            </div>
      </div>

        <div class="col-sm-9 col-lg-9">
                   <div class="dash-unit2">

            <table width="500" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td height="20" colspan="2"><span class="Estilo7">CIERRE POR REGIÓN PARA CONCILIACION BANCARIA</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

<?



$sql2 = "Select * from concilia_parametros";

$res2 = mysql_query($sql2);

$row2 = mysql_fetch_array($res2);

$mes=$row2["para_mes"];

$ano=$row2["para_anno"];





if (isset($_POST["mes"])) {



    $mes=$_POST["mes"];

    $anno=$_POST["anno"];

        $sql6="update concilia_parametros set para_mes='$mes', para_anno='$anno' where para_id=1";

//      echo $sql6."<br><br>";

        mysql_query($sql6);

        $sql6="update regiones set activo4=1 ";

        mysql_query($sql6);

        

        

        $sql6="update concilia_cartola set carto_estado='3' where carto_estado=2";

//      echo $sql6."<br><br>";

        mysql_query($sql6);

        

        $sql6="update concilia_sigfe set sigfe_estado='3' where sigfe_estado=2";

//      echo $sql6."<br><br>";

        mysql_query($sql6);

        

        $sql2="update concilia_sigferesumen set sigfe_estado='3' where sigfe_estado='11' ";

//        echo $sql2."<br>";

        mysql_query($sql2);



        $sql2="update concilia_resumen set resu_estado='3' where resu_estado='1' ";

//        echo $sql2."<br>";

        mysql_query($sql2);

        



}





if (isset($_GET["sw1"])) {

    $sw1=$_GET["sw1"];

    $idreg=$_GET["idreg"];

         $mesp=$mes*1;

        $annop=$ano*1;

    if ($sw1==1) {

        $sql6="update regiones set activo4=0 where codigo=$idreg";

//        echo $sql6;

        mysql_query($sql6);

        



        

        $sql22="select * from concilia_cc where cc_region='$idreg' order by cc_id desc";

//     echo $sql;

        $res22 = mysql_query($sql22);

        $i=1;



        while ($row22 = mysql_fetch_array($res22)) {

             $numero=$row22["cc_numero"];

             include("consolidacion_procesocierre.php");

             

             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , 'Saldo anterior:', '$resumonto', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);

             

             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , 'Ingresos del mes (+)', '$totalcargo', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);



             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , 'Ingresos Acumulados', '$ingresoacumu', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);





             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , 'Gastos del mes (-)', '$totalabono', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);

             

             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , 'Saldo disponible', '$saldodisponible', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);



             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , '(-) Cargos no reconocidos por el banco', '$totalasigfecargo', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);



             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , '(+) Cheques girados y no cobrados por el banco', '$totalabono2', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);



             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , '(-) Cargos no reconocidos por la contabilidad', '$totalacartocargo', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);



             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , '(+) Abonos no reconocidos por la contabilidad', '$totalacartoabono', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);

             

             $sql2="insert into concilia_resumen (resu_mesp, resu_annop, resu_descripcion, resu_monto    , resu_region,resu_numero, resu_user,resu_fechasis)

                                   values        ('$mesp'   , '$annop'    , 'Saldo cartola', '$saldocartola', '$idreg',  '$numero','$user','$date_in')";

//             echo $sql2."<br>";

             mysql_query($sql2);

             

             

             $sql2="insert into concilia_sigferesumen select * from concilia_sigfe where sigfe_estado='1' and sigfe_numero='$numero'  order by sigfe_fecha";

//             echo $sql2."<br>";

             mysql_query($sql2);

             

             $sql2="update concilia_sigferesumen set sigfe_estado='11' where sigfe_estado='1' and sigfe_numero='$numero'  ";

//             echo $sql2."<br>";

             mysql_query($sql2);
echo "<script>window.open('consolidacion_impreporte1b.php?numero=".$numero."&mesp=".$mes."&annop=".$ano."');</script>";

echo "<script>window.open('consolidacion_impreporte21.php?numero=".$numero."&mesp=".$mes."&annop=".$ano."&ori=1');</script>";
echo "<script>window.open('consolidacion_impreporte22.php?numero=".$numero."&mesp=".$mes."&annop=".$ano."&ori=1');</script>";

echo "<script>window.open('consolidacion_impreporte21a.php?numero=".$numero."&mesp=".$mes."&annop=".$ano."');</script>";
echo "<script>window.open('consolidacion_impreporte22a.php?numero=".$numero."&mesp=".$mes."&annop=".$ano."');</script>";
echo "<script>window.open('consolidacion_impreporte21b.php?numero=".$numero."&mesp=".$mes."&annop=".$ano."');</script>";        


       }

/*

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


    }

    if ($sw1==2) {

        $sql6="update regiones set activo4=1 where codigo=$idreg";

        mysql_query($sql6);

        

        

        $sql6="delete from concilia_resumen where resu_mesp='$mesp' and  resu_annop='$annop' and resu_region='$idreg'";

//        echo $sql6."<br>";

        mysql_query($sql6);

        

        

        $sql6="delete from concilia_sigferesumen where sigfe_region='$idreg' and sigfe_estado='11' ";

//        echo $sql6."<br>";

        mysql_query($sql6);





        

    }

    if ($sw1==3) {

        $sql6="update regiones set activo4=0 ";

        mysql_query($sql6);

    }



     $regionsession = $_SESSION["region"];



    

}

if (isset($_GET["llave"]))

 echo "<p>Registros insertados con Exito !";

?>

                         </td>

                      </tr>



                          <tr>

                             <td  valign="top" class="Estilo1" colspan="2"><a href="consolidacion_menu.php" class="link" >VOLVER </a>  </td>

                          </tr>

                          <tr>

                             <td  valign="top" class="Estilo1" colspan="2"><BR>  </td>

                          </tr>





                   <tr>

                    <td height="50" colspan="3">

                    

          <table width="488" border="0" cellspacing="0" cellpadding="0">

                         <tr>

                             <td  valign="top" class="Estilo1">Mes En Curso :<? echo $mes ?> </td>

                             <td class="Estilo1"></td>

                          </tr>

                         <tr>

                             <td  valign="top" class="Estilo1">Año En Curso :<? echo $ano ?> </td>

                             <td class="Estilo1"></td>

                          </tr>





     <?

                   if ($regionsession==14) {

     ?>

            <form name="form1" action="consolidacion_cierres.php" method="post"  onSubmit="return valida()">

                         <tr>

                             <td  valign="top" class="Estilo1">Mes </td>

                             <td class="Estilo1">



                             <?



//                                $mes=date("m");

//                                $ano=date("Y");

                                





                                //$tot_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

                             ?>



                                <input type="text" name="mes" class="Estilo2" size="6" value="<? echo $mes ?>">-<input type="text" name="anno" class="Estilo2" size="6" value="<? echo $ano ?>">

                                <input type="submit"  class="Estilo2"  value="    Cambiar datos de Fecha">

                             </td>

                           </tr>

                           

                           <tr>

                             <td  valign="top" class="Estilo1" colspan="8"> Importante al hacer cambio de mes todas las regiones quedaran activas </td>

                           </tr>

                           <tr>

                            <td><br></td>

                           </tr>



                            <tr>

                                <td  valign="center" class="Estilo1" colspan="8"><a href="consolidacion_cierres.php?sw1=3" >Cerrar Todos</a> </td>

                            </tr>

                           <tr>

                            <td><br></td>

                           </tr>

                           <tr>

                             <td  valign="top" class="Estilo1" colspan="8"> Rojo: Cerrado <br>Verde: Abierto</td>

                           </tr>



                                                          

                       </form>

                       <?

                        }

                        

                        

//-------- Resumenes de cierres por region documentos del periodo

     for ($i=1;$i<=20;$i++) {

             $arr1[$i]= "punt_rojo.jpg";

             $arr3[$i]= "punt_rojo.jpg";

     }



     $sql=" select * from concilia_resumen where resu_descripcion<>'Saldo anterior' and resu_annop='$ano' and resu_mesp='$mes' group by resu_region, resu_numero order by resu_region desc";

//     echo $sql;

     $res2 = mysql_query($sql);

     $cont=1;

     while ($row2 = mysql_fetch_array($res2)) {

          $i=$row2["resu_region"];

//          echo $row2["resu_numero"]."--".$cont."<br>";

          if ($cont==1) {

             if ($row2["resu_archivo"]=='') {

                $arr1[$i]= "punt_rojo.jpg";

                $arr2[$i]='';

       //       $href="<a href='#' class='link' onclick='abreVentana2(".$numero.",".$row2['resu_mesp'].",".$row2['resu_annop'].")' title='".$titulo."'>";

              } else {

                $arr1[$i]="punt_verde.jpg";

                $arr5[$i]=$row2["resu_numero"];

                $arr2[$i]="<a href='../../archivos/docconciliacion/reportes/".$row2["resu_archivo"]."' class='link' target='_blank' title='".$arr5[$i]."'>";

             }

         }

          if ($cont==2) {



             if ($row2["resu_archivo"]=='') {

                $arr3[$i]= "punt_rojo.jpg";

                $arr4[$i]='';

       //       $href="<a href='#' class='link' onclick='abreVentana2(".$numero.",".$row2['resu_mesp'].",".$row2['resu_annop'].")' title='".$titulo."'>";

              } else {

                $arr3[$i]="punt_verde.jpg";

                $arr6[$i]=$row2["resu_numero"];

                $arr4[$i]="<a href='../../archivos/docconciliacion/reportes/".$row2["resu_archivo"]."' class='link' target='_blank' title='".$arr6[$i]."'>";

             }

             $cont=0;

         }



          $cont++;

     }





//--------FIN  Resumenes de cierres por region documentos del periodo





                        

                       ?>

                          <tr>

                           <td colspan="8"><hr></td>

                          </tr>

                         <tr>

                             <td class="Estilo1" colspan="8">

                                 <table border=1>

                                   <tr>

                                    <td class="Estilo1">Num</td>

                                    <td class="Estilo1">Regi&oacute;n</td>

                                    <td class="Estilo1">Estado</td>

                                    <td class="Estilo1">Cerrar</td>

                                    <!-- <td class="Estilo1">Abrir</td> -->

                                    <td class="Estilo1" width=50></td>

                                    <td class="Estilo1" ></td>

                                    <td class="Estilo1">C1</td>

                                    <td class="Estilo1">C2</td>

                                   <tr>

                                 <?

                                  if ($regionsession==14) {

                                    $sql2 = "Select * from regiones where codigo<20 order by codigo";

                                  } else

                                    $sql2 = "Select * from regiones where codigo=$regionsession";

                                  //echo $sql;

                                  $res2 = mysql_query($sql2);

                                  $cont1=1;

                                  while($row2 = mysql_fetch_array($res2)){

                                       $idregion=$row2["codigo"];



                                 ?>

                                    <tr>

                                    <td class="Estilo1"><? echo $row2["codigo"] ?></td>

                                    <td class="Estilo1"> <? echo $row2["nombre"] ?></td>

                                    <td class="Estilo1"> <? if ($row2["activo4"]==1) { ?><img src="images/punt_verde.jpg"  width="15" height="15" /> <? } else { ?><img src="images/punt_rojo.jpg"  width="15" height="15" /><? } ?></td>

                                    <td class="Estilo1"> <? if ($row2["activo4"]==1) { ?> <a href="consolidacion_cierres.php?sw1=1&idreg=<? echo $idregion; ?>" >Cerrar</a> <? } else { ?>&nbsp<? } ?>    </td>





                                 <?



                                    if ($regionsession==14) {

                                 ?>

                                    <!-- <td class="Estilo1"><a href="consolidacion_cierres.php?sw1=2&idreg=<? echo $idregion ?>" >Abrir</a></td> -->

                                    <td></td>

                                    <td></td>

                                    <td><? echo $arr2[$idregion] ?><img src="images/<? echo $arr1[$idregion] ?>" width="20" height="20" border=0 ></a></td>

                                    <td><? echo $arr4[$idregion] ?><img src="images/<? echo $arr3[$idregion] ?>" width="20" height="20" border=0 ></a></td>



                                 <?

                                    }

                                    $cont++;

                                   }

                                 ?>



                             </td>

                           </tr>

                      </td>

                       <tr>

                       <td colspan=8><hr></td>

                      </tr>

                      





</td>

  </tr>

 

 

</table>

       <img src="images/pix.gif" width="1" height="10">





</body>

</html>



<?



?>

