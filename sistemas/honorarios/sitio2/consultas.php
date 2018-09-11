<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}

$date_in=date("Y-m-d");
$anno_in=date("Y");
?>

<html>
<head>
<title>Defensoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="select_dependientes.css">
<script type="text/javascript" src="select_dependientes.js"></script>
<script type="text/javascript" src="ajaxclient.js"></script>



<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>
  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
<SCRIPT LANGUAGE ="JavaScript">

  function aparece(){
     if (document.form1.commodity.value == 'Other') {

       document.form1.specifications.style.display='';

     } else {

       document.form1.specifications.style.display='none';

     }

     if (document.form1.commodity.value == 'Fishmeal') {

       seccion1.style.display="";

     } else {

       seccion1.style.display="none";

    }

     if (document.form1.commodity.value == 'Fishoil') {

       seccion2.style.display="";

     } else {

       seccion2.style.display="none";

    }
 }
</script>
</head>
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

                    <td height="20" colspan="2"><span class="Estilo7">CONSULTA / EDITAR</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

<?

$region=$_GET["region"];

$fecha1=$_GET["fecha1"];

$fecha2=$_GET["fecha2"];

$rut=$_GET["rut"];

$item1=$_GET["item1"];

$item2=$_GET["item2"];

$item3=$_GET["item3"];

$item4=$_GET["item4"];

$item5=$_GET["item5"];

$item6=$_GET["item6"];

$item7=$_GET["item7"];

$anno=$_GET["anno"];

$estado=$_GET["estado"];

$consolidado=$_GET["consolidado"];

$sw=$_GET["sw"];

$id=$_GET["id"];

if ($sw==2) {

//    $sql33="update dpp_honorarios set hono_estado=2 where hono_id=$id";

    $sql33="delete from dpp_honorarios where hono_id=$id";

//    echo $sql33;

    mysql_query($sql33);

}



?>







                   <tr>

                    <td height="50" colspan="3">



     <table width="520" border="0" cellspacing="0" cellpadding="0">

       <form name="form1" action="consultas.php" method="get">

                         <tr>

                             <td width="200px" valign="top" class="Estilo1">Regi&oacute;n</td>

                             <td class="Estilo1">

                                <select name="region" class="Estilo1">



                                 <?

                                  if ($regionsession==0) {

                                    $sql2 = "Select * from regiones ";

                                    echo '<option value="0">Todas</option>';

                                  } else

                                    $sql2 = "Select * from regiones where codigo=$regionsession";

                                  //echo $sql;

                                  $res2 = mysql_query($sql2);



                                   while($row2 = mysql_fetch_array($res2)){



                                 ?>

                                    <option value="<? echo $row2["codigo"] ?>" <? if ($region==$row2["codigo"]) echo "selected=selected" ?>  ><? echo $row2["nombre"] ?></option>



                                 <?

                                   }

                                 ?>





                               </select>





                             </td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Rango de Fechas</td>

                             <td colspan=3 class="Estilo1">

                                  <input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c2" readonly="1">

<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"

      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



 <script type="text/javascript">

    Calendar.setup({

        inputField     :    "f_date_c2",     // id of the input field

        ifFormat       :    "%Y-%m-%d",      // format of the input field

        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)

        align          :    "Tl",           // alignment (defaults to "Bl")

        singleClick    :    true

    });

</script>



                                  a

                                  <input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha2 ?>" id="f_date_c3" readonly="1">

<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"

      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



 <script type="text/javascript">

    Calendar.setup({

        inputField     :    "f_date_c3",     // id of the input field

        ifFormat       :    "%Y-%m-%d",      // format of the input field

        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)

        align          :    "Tl",           // alignment (defaults to "Bl")

        singleClick    :    true

    });

</script>



                              </td>



                           </tr>

                            <tr>

                             <td  valign="top" class="Estilo1">Rut (Sin d&iacute;gito) </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>">

                             </td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Sub T&iacute;tulo </td>

                             <td class="Estilo1" colspan=3>

                              21<input type="radio" name="item1" class="Estilo2" value="21"  <? if ($item1==21) echo "checked" ?> >

                              22<input type="radio" name="item2" class="Estilo2" value="22"  <? if ($item2==22) echo "checked" ?> >

                              24<input type="radio" name="item3" class="Estilo2" value="24"  <? if ($item3==24) echo "checked" ?> >

                              29<input type="radio" name="item4" class="Estilo2" value="29"  <? if ($item4==29) echo "checked" ?> >

                              31<input type="radio" name="item5" class="Estilo2" value="31"  <? if ($item5==31) echo "checked" ?> >

                              34<input type="radio" name="item6" class="Estilo2" value="34"  <? if ($item6==34) echo "checked" ?> >

                              Otro<input type="radio" name="item7" class="Estilo2" value="99" <? if ($item7==99) echo "checked" ?> >

                             </td>

                           </tr>

                         <tr>

                             <td  valign="top" class="Estilo1">A&ntilde;o Reporte</td>

                             <td class="Estilo1" width="380">

                                <select name="anno" class="Estilo1">

                                      <option value="">Seleccione...</option>

                                      <option value="<? echo $anno_in ?>"><? echo $anno_in ?></option>



                                 <?

                                    $sql2 = "Select year(hono_fecha1) as anno from dpp_honorarios group by year(hono_fecha1) order by hono_fecha1";

                                    //echo $sql2;

                                    $res2 = mysql_query($sql2);

                                    while($row2 = mysql_fetch_array($res2)){



                                 ?>

                                      <option value="<? echo $row2["anno"] ?>" <? if ($row2["anno"]==$anno) echo "selected=selected" ?> > <? echo $row2["anno"] ?> </option>



                                 <?

                                     }

                                 ?>

                               </select>





                             </td>

                           </tr>



                           

                           <tr>

                             <td  valign="center" class="Estilo1">Consolidado  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="checkbox" name="consolidado" class="Estilo2" value="21" >

                             </td>



                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1" colspan=4 align="center">

                             <input type="submit" name="boton" class="Estilo2" value="  Consultar  ">

                              </form>

                               <a href="consultas.php"> Limpiar </a>



                             </td>



                           </tr>





                        



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      <tr>

                      <td class="Estilo1" colspan=4><a href="reportesexcel.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item1=<? echo $item1 ?>&item2=<? echo $item2 ?>&item3=<? echo $item3 ?>&item4=<? echo $item4 ?>&item5=<? echo $item5 ?>&item6=<? echo $item6 ?>&item7=<? echo $item7 ?>&anno=<? echo $anno ?>&consolidado=<? echo $consolidado ?>" class="link" > Exportar a Excel</a>

                      <table border=1 class="table table-striped table-bordered">

                        <tr>

                         <td class="Estilo1b">Nun</td>

                         <td class="Estilo1b">Fecha</td>

                         <td class="Estilo1b">N&#176Bol</td>

                         <td class="Estilo1b">Rut</td>

                         <td class="Estilo1b">Nombre</td>

                         <td class="Estilo1b">Bruto</td>

                         <td class="Estilo1b">Reten. </td>

                         <td class="Estilo1b">Neto </td>

                         <td class="Estilo1b">Edit</td>

                         <td class="Estilo1b">Borrar</td>

                         <!-- <td class="Estilo1b"></td> -->

                         <td class="Estilo1b">Mes</td>

                         <td class="Estilo1b">Consolidado</td>

                        </tr>



<?

$sw=0;

if ($consolidado<>"")

   $sql="select hono_nombre, hono_rut,hono_dig, count(hono_rut) as cuentarut, sum(hono_bruto) as hono_bruto, sum(hono_retencion) as hono_retencion, sum(hono_liquido) as hono_liquido from dpp_honorarios where ";

else

   $sql="select * from dpp_honorarios where ";

if ($region<>"") {

    if ($region==0)

        $sql.=" hono_region<>'' and ";

    else

        $sql.=" hono_region=$region and ";

    $sw=1;

}

if ($fecha1<>"" and $fecha2<>"" ) {

    $sql.=" ( hono_fecha1>='$fecha1' and hono_fecha1<='$fecha2' ) and ";

    $sw=1;

}

if ($rut<>"") {

    $sql.=" hono_rut like '%$rut%' and ";

    $sw=1;

}



if ($item1<>"" or $item2<>"" or $item3<>"" or $item4<>"" or $item5<>"" or $item6<>"" or $item7<>"" ) {

    $sql.=" ( hono_item='$item1' or hono_item='$item2' or hono_item='$item3' or  hono_item='$item4' or  hono_item='$item5' or hono_item='$item6' or  hono_item='$item7')  and ";

    $sw=1;

}

if ($anno<>"") {

    $sql.=" year(hono_fecha1) = '$anno' and ";

    $sw=1;

}



if ($estado<>"") {

    $sql.=" hono_estado=$estado and ";

    $sw=1;

}



if ($sw==1){

    if ($consolidado <>"")

      $sql.=" 1=1 group by hono_nombre order by hono_fecha1 desc";

    else

      $sql.=" 1=1 order by hono_fecha1 desc";

}

if ($sw==0){

    $sql.=" 1=2";

}

//echo $sql;

$res3 = mysql_query($sql);

$cont=1;

$cont1=0;

$sumab=0;

$sumar=0;

$sumal=0;

$existedato=0;

                                $sql25 = "Select * from parametros";

                                $res25 = mysql_query($sql25);

                                $row25 = mysql_fetch_array($res25);

                                $mes25=$row25["para_mes"];

                                $anno25=$row25["para_anno"];



while($row3 = mysql_fetch_array($res3)){



?>

                      



                       <tr>

                         <td class="Estilo1b"><? echo $cont  ?> </td>

                         <td class="Estilo1b" width="90px">
                            <? 
                            if ($row3["hono_fecha1"]!='' && $row3["hono_fecha1"]!=null && $row3["hono_fecha1"]!='0000-00-00') {
                                $fecha = date("d-m-Y", strtotime($row3["hono_fecha1"]));
                            }
                            else {
                              $fecha = "";
                            }
                            echo $fecha;
                            ?> 
                         </td>

                         <td class="Estilo1b"><? echo $row3["hono_nro_boleta"]  ?> </td>

                         <td class="Estilo1b" width="90px"><? echo $row3["hono_rut"]  ?>-<? echo $row3["hono_dig"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["hono_nombre"]  ?> </td>

                         <td class="Estilo1c"><? echo number_format($row3["hono_bruto"],0,',','.')  ?> </td>

                         <td class="Estilo1c"><? echo number_format($row3["hono_retencion"],0,',','.')   ?> </td>

                         <td class="Estilo1c"><? echo number_format($row3["hono_liquido"],0,',','.')   ?> </td>

                         <td class="Estilo1c"><a href='honorario2.php?id=<? echo $row3["hono_id"] ?>&region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item=<? echo $item ?>&estado=<? echo $estado ?>'>E</a> </td>

                      <?

                      //if ($row3["hono_estado"]==1 and substr($row3["hono_fecha1"],5,2)==$mes25 and substr($row3["hono_fecha1"],0,4)==$anno25) {

                      if (substr($row3["hono_fecha1"],5,2)==$mes25 and substr($row3["hono_fecha1"],0,4)==$anno25) {

                          ?>



                         <td class="Estilo1c"><a href='consultas.php?id=<? echo $row3["hono_id"] ?>&sw=2' onclick="return confirm('Seguro que desea Borrar o Eliminar?')">B</a></td>

                         

                          <?

                      } else {

                          ?>

                          <td class="Estilo1c"></td>

                          <?

                      }

                      ?>

                      <td class="Estilo1c"><? echo substr($row3["hono_fecha1"],5,2); ?></td>

                      <?

                      if ($consolidado<>"") {

                             ?>

                             <td class="Estilo1c"><? echo number_format($row3["cuentarut"],0,',','.')   ?> </td>

                            <?

                      }
                      else {

                            ?>

                             <td class="Estilo1c"> </td>

                            <?
                      }

                      ?>



                        </tr>




<?



   $sumab=$sumab+$row3["hono_bruto"];

   $sumar=$sumar+$row3["hono_retencion"];

   $sumal=$sumal+$row3["hono_liquido"] ;

   $cont++;

   $cont1++;

   $existedato++;

}

?>

        <?
        if ($existedato==0) {
                      ?>
                      <tr>
                        <td class="Estilo1b text-center" colspan="12">Sin registros</td>
                      </tr>
                      <?        

        }
        else{
                      ?>


                       <tr>

                         <td class="Estilo1b text-center" colspan="5">Total</td>

                         <!-- <td class="Estilo1b"> </td>

                         <td class="Estilo1b"> </td>

                         <td class="Estilo1b"> </td>

                         <td class="Estilo1b"> </td>

                         <td class="Estilo1b"> </td> -->

                         <td class="Estilo1c"><? echo number_format($sumab,0,',','.')  ?> </td>

                         <td class="Estilo1c"><? echo number_format($sumar,0,',','.')  ?> </td>

                         <td class="Estilo1c"><? echo number_format($sumal,0,',','.') ?> </td>

                        </tr>
                        <?
        }
        ?>

                        </td>

                      </tr>

                      <tr>











                </td>

                  </tr>



                 

                </table>

                <br>

                <br>

                <? require("inc/pie.php"); ?>


                <img src="images/pix.gif" width="1" height="10">

              </div>

          </div>

        </div>

    </div>



</body>

</html>



<?

//require("inc/func.php");

?>



