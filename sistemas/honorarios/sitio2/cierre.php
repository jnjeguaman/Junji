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
?>
<html>
<head>
  <title>Defensoria </title>
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
  <script LANGUAGE ="JavaScript">
    function cambiatexto(){
      if (document.form1.cierre.checked)
        document.form1.boton.value="  Hacer Cierre al Perido ?  ";
        else
        document.form1.boton.value="  Consultar  ";
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
                    <td height="20" colspan="2"><span class="Estilo7">Consultas</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$rut=$_GET["rut"];
$item=$_GET["item"];
$estado=$_GET["estado"];
$consolidado=$_GET["consolidado"];
$cierre=$_GET["cierre"];
$id=$_GET["id"];
if ($cierre==2 and $fecha1<>"" and $fecha2<>"") {
    $sql33="update dpp_honorarios set hono_estado=3 where (hono_fecha1>='$fecha1' and hono_fecha1<='$fecha2' ) and hono_estado=1";
    echo $sql33;
    mysql_query($sql33);
}

?>



                   <tr>
                    <td height="50" colspan="3">

     <table width="488" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="cierre.php" method="get">
                         <tr>
                             <td  valign="top" class="Estilo1">Region</td>
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
                                    <option value="<? echo $row2["codigo"] ?>" <? if ($region==$row2["codigo"]) echo "selected=selected" ?> ><? echo $row2["nombre"] ?></option>

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
                             <td  valign="top" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>">
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Estado  </td>
                             <td class="Estilo1" colspan=3>
                              Activo<input type="radio" name="estado" class="Estilo2" value="1" >
                              Anulado<input type="radio" name="estado" class="Estilo2" value="2" >
                              Cerrado<input type="radio" name="estado" class="Estilo2" value="3" >
                             </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Hacer Cierre  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="checkbox" name="cierre" class="Estilo2" value="2" onclick="cambiatexto();" >
                             </td>

                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="cierre.php"> Limpiar </a> </td>

                           </tr>

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      <td class="Estilo1" colspan=4><a href="reportesexcel.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item=<? echo $item ?>&consolidado=<? echo $consolidado ?>" class="link" > Exportar a Excel</a>
                      <table border=0 class="table table-striped table-bordered">
                        <tr>
                         <td class="Estilo1b">Nun</td>
                         <td class="Estilo1b" width="100px">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Bruto</td>
                         <td class="Estilo1b">Reten. </td>
                         <td class="Estilo1b">Neto </td>
                         <td class="Estilo1b" width="80px">Fecha </td>
                         <td class="Estilo1b">Estado </td>

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

if ($item<>"") {
    $sql.=" hono_item=$item and ";
    $sw=1;
}

if ($estado<>"") {
    $sql.=" hono_estado=$estado and ";
    $sw=1;
}

if ($sw==1){
    if ($consolidado <>"")
      $sql.=" 1=1 group by hono_nombre order by hono_nombre";
    else
      $sql.=" 1=1 order by hono_nombre";
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
while($row3 = mysql_fetch_array($res3)){

?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_rut"]  ?>-<? echo $row3["hono_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_nombre"]  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["hono_bruto"],0,',','.')  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["hono_retencion"],0,',','.')   ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["hono_liquido"],0,',','.')   ?> </td>
                         <td class="Estilo1c">
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
                         <td class="Estilo1c">
                          <? 
                          if ($row3["hono_estado"] == 1 ) {
                              $estado_nom="Activo";
                          } 
                          else {
                            if ($row3["hono_estado"] == 3) {
                              $estado_nom="Cerrado";
                            }
                            else {
                              $estado_nom="Anulado";
                            }
                          } 
                          echo $estado_nom;
                          ?> 
                         </td>
                         <!-- <td class="Estilo1c"><? echo number_format($row3["hono_estado"],0,',','.')   ?> </td> -->



<?

    if ($consolidado<>"") {
?>
                             <td class="Estilo1c"><? echo number_format($row3["cuentarut"],0,',','.')   ?> </td>
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
                        <td class="Estilo1b text-center" colspan="8">Sin registros</td>
                      </tr>
                      <?        

        }
        else{
                      ?>

                       <tr>
                         <td class="Estilo1b text-center" colspan="3">Total</td>
                         <!-- <td class="Estilo1b"> </td>
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
