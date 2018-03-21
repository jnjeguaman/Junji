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

.Estilo1b {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: left;

}

.Estilo1c {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: right;

}

.Estilo1cverde {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #009900;

	text-align: right;

}

.Estilo1camarrillo {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #CCCC00;

	text-align: right;

}

.Estilo1crojo {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #CC0000;

	text-align: right;

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

font-size: 14px; font-weight: bold;}

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





function ChequearTodos(chkbox)

{

  for (var i=0;i < document.forms[0].elements.length;i++){

      var elemento = document.forms[0].elements[i];

      if (elemento.type == "checkbox"){

          elemento.checked = chkbox.checked

      }

  }

}

function muestra() {

     if (document.form1.uno.value == 2) {

       seccion1.style.display="";

     } else {

       seccion1.style.display="none";

     }

}

function valida() {

   if (document.form1.uno.value==0 || document.form1.uno.value=='') {

      alert ("No ha seleccionado una Accion ");

      return false;

  }

   if (document.form1.uno.value==2 && document.form1.justifica.value=='') {

      alert ("No ha Justificado ");

      return false;

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

          <div class="col-sm-2 col-lg-2">

            <div class="dash-unit2">



      <?

      require("inc/menu_1.php");

      ?>



            </div>

      </div>


        <div class="col-sm-10 col-lg-10">

                    <div class="dash-unit2">

          <table width="529" border="0" cellspacing="0" cellpadding="0">

              <tr>

                    <td height="20" colspan="2"><span class="Estilo7">2.- EDITAR CONTRATO</span></td>

                  </tr>



                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

                 <tr>

                    <td height="20" colspan="2"><span class="Estilo2">  </span></td>

                  </tr>

<?

$region=$_GET["region"];

$nroresolucion=$_GET["nroresolucion"];

$servicio=$_GET["servicio"];

$rut=$_GET["rut"];

$item=$_GET["item"];

$consolidado=$_GET["consolidado"];



?>







                   <tr>

                    <td height="50" colspan="3">





     <table width="488" border="0" cellspacing="0" cellpadding="0">

       <form name="form1" action="valida1c.php" method="get">

                         <tr>

                             <td  valign="top" class="Estilo1">Región</td>

                             <td class="Estilo1">

                                <select name="region" class="Estilo1">



                                 <?

                                  if ($regionsession==0) {

                                    $sql2 = "Select * from regiones ";

                                    echo '<option value="0">Todas</option>';

                                  } else

                                    $sql2 = "Select * from regiones ";

//                                    $sql2 = "Select * from regiones where codigo=$regionsession";

                                  //echo $sql;

                                  $res2 = mysql_query($sql2);



                                   while($row2 = mysql_fetch_array($res2)){



                                 ?>

                                    <option value="<? echo $row2["codigo"] ?>" <? if ($row2["codigo"]==$region) echo "selected=selected" ?> ><? echo $row2["nombre"] ?></option>



                                 <?

                                   }

                                 ?>





                               </select>





                             </td>

                           </tr>

                            <tr>

                             <td  valign="top" class="Estilo1">Rut Proveedor  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>">

                             </td>

                           </tr>

                            <tr>

                             <td  valign="top" class="Estilo1">N° Resolucion  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nroresolucion" class="Estilo2" size="11" value="<? echo $nroresolucion ?>">

                             </td>

                           </tr>



                            <tr>

                             <td  valign="top" class="Estilo1">Nombre Del Servicio  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="servicio" class="Estilo2" size="30" value="<? echo $servicio ?>">

                             </td>

                           </tr>





                           <tr>

                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="consultasgenerales.php"> Limpiar </a> </td>





                           </tr>



                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      <tr>

                      </form>

                      

                     <form name="form1" action="grabavalida1c.php" method="post">

                      <table border=1>

                        <tr>

                         <td class="Estilo1b">Nº</td>

                         <td class="Estilo1b">Rut</td>

                         <td class="Estilo1b">Nombre</td>

                         <td class="Estilo1b">Servicio</td>

                         <td class="Estilo1b">N° Res</td>

                         <td class="Estilo1b">Fecha_vence</td>

                         <td class="Estilo1b">Monto</td>

                         <td class="Estilo1b">Moneda</td>

                         <td class="Estilo1b">Dias </td>

                         <td class="Estilo1b">VER </td>

                         <td class="Estilo1b">Eli. </td>

                        </tr>



<?



//   $sql5="select * from dpp_contratos where cont_estado=1";

$sql5="select * from dpp_plazos_cont ";

//echo $sql;

$res5 = mysql_query($sql5);

$row5 = mysql_fetch_array($res5);

$etapa1a=$row5["placont_fecha1"];

$etapa1b=$row5["placont_fecha2"];

$etapa2a=$row5["placont_monto1"];

$etapa2b=$row5["placont_monto2"];



//$sql="select * from dpp_contratos where cont_estado=1";



$sw=0;



   $sql="select * from dpp_contratos where ";

if ($region<>"") {

    if ($region==0)

        $sql.=" cont_region<>'' and ";

    else

        $sql.=" cont_region=$region and ";

    $sw=1;

}



if ($rut<>"") {

    $sql.=" cont_rut like '%$rut%' and ";

    $sw=1;

}



if ($nroresolucion<>"") {

    $sql.=" cont_nroresolucion  like '%$nroresolucion%' and ";

    $sw=1;

}



if ($servicio<>"") {

    $sql.=" cont_nombre1 like '%$servicio%' and ";

    $sw=1;

}









if ($sw==1){

    $sql.=" (cont_estado=1 or cont_estado=2) and 1=1 order by cont_id desc ";

}

if ($sw==0){

    $sql.=" cont_estado=1 and 1=2";

}



//echo $sql;

$res3 = mysql_query($sql);

$cont=1;



while($row3 = mysql_fetch_array($res3)){



    $fechahoy = $date_in;

    $dia1 = strtotime($fechahoy);

    $fechabase =$row3["cont_vence"];

    $dia2 = strtotime($fechabase);

    $diff=$dia1-$dia2;

    $diff=intval($diff/(60*60*24))*-1;

    $clase="Estilo1c";

    if ($etapa1a>$diff and $diff>$etapa1b)

      $clase="Estilo1cverde";

    if ( $etapa1b>=$diff )

      $clase="Estilo1crojo";



     $archivo="vercontrato4.php";

     $archivo2="vercontrato3.php";

     $cont_id=$row3["cont_id"];

     $sql22 = "Select sum(fac_monto) as facturamonto from dpp_contratos x, dpp_cont_fac y, dpp_facturas z where x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id group by y.confa_cont_id order by cont_rut desc ";

     //echo $sql22;

     $res22=mysql_query($sql22);

     $row22 = mysql_fetch_array($res22);

     $facturamonto=$row22["facturamonto"];

     $conttipo2=$row3["cont_tipo2"];

     

     $sql2b = "Select * from dpp_monedas where mone_id=$conttipo2 ";

     //echo $sql;

     $res2b = mysql_query($sql2b);

     $row2b = mysql_fetch_array($res2b);

     $conttipo2b=$row2b["mone_tipo"]

?>

                      



                       <tr>



                         <td class="Estilo1b"><? echo $cont  ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_rut"]  ?>-<? echo $row3["cont_dig"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_nombre"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_nombre1"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_nroresolucion"]  ?> </td>



                         <td class="<? echo $clase ?>" ><? echo substr($row3["cont_vence"],8,2)."-".substr($row3["cont_vence"],5,2)."-".substr($row3["cont_vence"],0,4)   ?></td>

                         <td class="Estilo1c"><? echo number_format($row3["cont_total"],0,',','.')  ?> </td>

                         <td class="Estilo1b"><? echo $conttipo2b;  ?> </td>

                         <td class="Estilo1c"><? echo $diff   ?> </td>

                         

                         <td class="Estilo1c"><a href="contratosadjuntos.php?id=<? echo $row3["cont_id"] ?>&ori=2" class="link" >EDI</a> </td>

                         <td class="Estilo1b"><a href="borrarcontrato.php?id=<? echo $row3["cont_id"] ?>" class="link" onclick="return confirm('Seguro Elimar Contrato ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a></td>

                       </tr>



                        







<?



   $cont++;



}

?>





                      <tr>



                               <input type="hidden" name="cont" value="<? echo $cont ?>" >

                           </form>





</td>

  </tr>



 

</table>



<img src="images/pix.gif" width="1" height="10">




</body>

</html>



<?

//require("inc/func.php");

?>

