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

<title>Defensoria</title>

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



.Estilo1l {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: left;

}

.Estilo1r {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: right;

}

.Estilo1c {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: center;

}



.Estilo1d {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: center;

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

font-weight: bold; }









-->

</style>

<link rel="stylesheet" type="text/css" href="select_dependientes.css">

<script type="text/javascript" src="select_dependientes.js"></script>

<script type="text/javascript" src="ajaxclient.js"></script>

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

                    <td height="20" colspan="2"><span class="Estilo7">EDITAR MIGRACION SEGFAC</span></td>

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

       <form name="form1" action="editconta.php" method="get">



                      </td>





                      





                      </tr>

                      <table border=0 class="table table-striped table-bordered">

                        <tr>

                         <td class="Estilo1c">FOLIO</td>

                         <td class="Estilo1c">FECHA BOLETA</td>

                         <td class="Estilo1c">N&#176;BOLETA</td>

                         <td class="Estilo1c">RUT</td>

                         <td class="Estilo1c">NOMBRE</td>

                         <td class="Estilo1c">MONTO BRUTO</td>

                         <td class="Estilo1c">RETENCION</td>

                         <td class="Estilo1c">LIQUIDO</td>

                         <td class="Estilo1c">EDITAR</td>

                        </tr>



<?

$sw=0;

$sql="select * from dpp_honorarios2 where hono2_region=$regionsession";

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

//    $liquido=$row3["hono2_liquido"];



//    $retencion



?>



<?

$liquido=$row3["hono2_liquido"];

$retencion=$liquido*10/90;

$retencion=number_format($retencion,0,"","");

$bruto=$liquido+$retencion;

?>

                      



                       <tr>

                         <td class="Estilo1c"><? echo $row3["hono2_folio"]  ?> </td>

                         <td class="Estilo1c">
                         
                            <? 
                            if ($row3["hono2_fecha1"]!='' || $row3["hono2_fecha1"]!=null || $row3["hono2_fecha1"]!='0000-00-00') {
                              $fecha = date("d-m-Y", strtotime($row3["hono2_fecha1"]));
                            }
                            else {
                              $fecha = "";
                            }

                            echo $fecha;

                            ?> 

                         </td>

                         <td class="Estilo1c"><? echo $row3["hono2_nro_boleta"]  ?> </td>

                         <td class="Estilo1l"><? echo $row3["hono2_rut"]  ?>-<? echo $row3["hono2_dig"]  ?> </td>

                         <td class="Estilo1l"><? echo $row3["hono2_nombre"]  ?> </td>

                         <td class="Estilo1r"><? echo number_format($bruto,0,',','.')  ?> </td>

                         <td class="Estilo1r"><? echo number_format($retencion ,0,',','.')   ?> </td>

                         <td class="Estilo1r"><? echo number_format($row3["hono2_liquido"],0,',','.')   ?> </td>

                         <td class="Estilo1c"><a href='honorario3.php?id=<? echo $row3["hono2_id"] ?>&region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item=<? echo $item ?>&estado=<? echo $estado ?>'>E</a> </td>





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
                      <td class="Estilo1b text-center" colspan="9">Sin registros</td>
                    </tr>
                    <?
                }

                ?>



                       <tr>



                        </tr>

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

