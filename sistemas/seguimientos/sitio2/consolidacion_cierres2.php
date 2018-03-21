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

                    <td height="20" colspan="2"><span class="Estilo7">REPORTE REGIONAL DE CIERRES</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

<?



$sql2 = "Select * from concilia_parametros";

$res2 = mysql_query($sql2);

$row2 = mysql_fetch_array($res2);

//$mes=$row2["para_mes"];

//$ano=$row2["para_anno"];







if (isset($_GET["llave"]))

 echo "<p>Registros insertados con Exito !";

 

if ((isset($_GET["mes"]))) {

    $mes=$_GET["mes"];

    $anno=$_GET["anno"];

} else {

    // $mes=date("m");

    // $anno=date("Y");

  $sql2 = "Select * from concilia_parametros";

$res2 = mysql_query($sql2);

$row2 = mysql_fetch_array($res2);

$mes=$row2["para_mes"];

$anno=$row2["para_anno"];



}





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







     <?

                   if ($regionsession==14) {

     ?>

            <form name="form1" action="consolidacion_cierres2.php" method="get"  onSubmit="return valida()">



                          <tr>

                             <td  valign="top" class="Estilo1">Mes</td>

                             <td class="Estilo1">

                                <select name="mes" class="Estilo1" onchange="this.form.submit()">

                                   <option value="" >Seleccione...</option>

                                   <option value="01" <? if ($mes=='01') { echo "selected=selected"; } ?>>Enero</option>

                                   <option value="02" <? if ($mes=='02') { echo "selected=selected"; } ?>>Febrero</option>

                                   <option value="03" <? if ($mes=='03') { echo "selected=selected"; } ?>>Marzo</option>

                                   <option value="04" <? if ($mes=='04') { echo "selected=selected"; } ?>>Abril</option>

                                   <option value="05" <? if ($mes=='05') { echo "selected=selected"; } ?>>Mayo</option>

                                   <option value="06" <? if ($mes=='06') { echo "selected=selected"; } ?>>Junio</option>

                                   <option value="07" <? if ($mes=='07') { echo "selected=selected"; } ?>>Julio</option>

                                   <option value="08" <? if ($mes=='08') { echo "selected=selected"; } ?>>Agosto</option>

                                   <option value="09" <? if ($mes=='09') { echo "selected=selected"; } ?>>Septiembre</option>

                                   <option value="10" <? if ($mes=='10') { echo "selected=selected"; } ?>>Octubre</option>

                                   <option value="11" <? if ($mes=='11') { echo "selected=selected"; } ?>>Noviembre</option>

                                   <option value="12" <? if ($mes=='12') { echo "selected=selected"; } ?>>Diciembre</option>

                               </select>

                             </td>

                           </tr>

                          <tr>

                             <td  valign="top" class="Estilo1">Año</td>

                             <td class="Estilo1">

                              <input type="text" name="anno" class="Estilo2" size="20"  value="<? echo $anno ?>";> <br>

                             </td>

                           </tr>

                           </tr>

                           <tr>

                             <td  valign="top" class="Estilo1" colspan="8"> Rojo: Cerrado <br>Verde: Abierto</td>

                           </tr>



                                                          

                       </form>

                       <?

                        }

                        

                        

//-------- Resumenes de cierres por region documentos del periodo







   $arr1[1]='ENERO';

   $arr1[2]='FEBRERO';

   $arr1[3]='MARZO';

   $arr1[4]='ABRIL';

   $arr1[5]='MAYO';

   $arr1[6]='JUNIO';

   $arr1[7]='JULIO';

   $arr1[8]='AGOSTO';

   $arr1[9]='SEPTIEMBRE';

   $arr1[10]='OCTUBRE';

   $arr1[11]='NOVIEMBRE';

   $arr1[12]='DICIEMBRE';



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

                                 <?



                                    if ($regionsession==14) {

                                            if (strlen($idregion)==1) {

                                                $idregion='0'.$idregion;

                                            }

                                            $sql22=" select * from concilia_resumen where resu_descripcion<>'Saldo anterior' and resu_annop='$anno' and resu_mesp='$mes' and resu_region='$idregion' group by resu_region, resu_numero order by resu_region desc";

//                                            echo $sql22;

                                            $res22 = mysql_query($sql22);

                                            while ($row22 = mysql_fetch_array($res22)) {

                                              $archivo=$row22["resu_archivo"];

//                                              $numero=$row22["resu_numero"];

                                              if ($archivo=='') {

                                                  $imagen= "punt_rojo.jpg";

                                                  $link='';

                                         //       $href="<a href='#' class='link' onclick='abreVentana2(".$numero.",".$row2['resu_mesp'].",".$row2['resu_annop'].")' title='".$titulo."'>";

                                              } else {

                                                  $imagen="punt_verde.jpg";

                                                  $numero=$row22["resu_numero"];

                                                  $link="<a href='../../archivos/docconciliacion/reportes/".$row22["resu_archivo"]."' class='link' target='_blank' title='".$numero."'>";

                                              }





                                 ?>



                                    <td><? echo $link ?><img src="images/<? echo $imagen ?>" width="20" height="20" border=0 ></a></td>



                                 <?

                                       }

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

