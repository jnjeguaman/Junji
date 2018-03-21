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

.Estilo1ce {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: center;

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

font-size: 14px; font-weight: bold; }

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



function cambia() {

    document.form1.submit();

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

                    <td height="20" colspan="2"><span class="Estilo7">6.- EVALUAR CONTRATO</span></td>

                  </tr>



                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>



<?

$region=$_GET["region"];

$fecha1=$_GET["fecha1"];

$fecha2=$_GET["fecha2"];

$rut=$_GET["rut"];

$item=$_GET["item"];

$estado=$_GET["estado"];

if (!isset($estado))

 $estado=1;

$consolidado=$_GET["consolidado"];





?>







                   <tr>

                    <td height="50" colspan="3">





     <table width="488" border="0" cellspacing="0" cellpadding="0">

       <form name="form1" action="aevaluar.php" method="get">

                         <tr>

                             <td  valign="top" class="Estilo1">Región</td>

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

                                    <option value="<? echo $row2["codigo"] ?>" <? if ($row2["codigo"]==$region) echo "selected=selected" ?> ><? echo $row2["nombre"] ?></option>



                                 <?

                                   }

                                 ?>





                               </select>





                             </td>

                           </tr>

                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>



                            <tr>

                             <td  valign="top" class="Estilo1">Estado del Contrato</td>

                             <td class="Estilo1" colspan=3>

                              <input type="radio" name="estado" class="Estilo2" size="11" value="1" <? if ($estado==1) echo "checked"; ?> onclick="cambia()"> EVALUABLE

                              <input type="radio" name="estado" class="Estilo2" size="11" value="2" <? if ($estado==2) echo "checked"; ?> onclick="cambia()"> NO EVALUABLE

                              <input type="radio" name="estado" class="Estilo2" size="11" value="3" <? if ($estado==3) echo "checked"; ?> onclick="cambia()"> TODOS

                             </td>

                           </tr>





                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      <tr>

                      </form>

                      

                     <form name="form2" action="grabavalida1c.php" method="post">

                      <table border=1>



                        <tr>

                         <td class="Estilo1ce">Nº</td>

                         <td class="Estilo1ce">Rut</td>

                         <td class="Estilo1ce">Nombre Proveedor</td>

                         <td class="Estilo1ce">Vence</td>

                         <td class="Estilo1ce">Nombre</td>

                         <td class="Estilo1ce">Año</td>

                         <td class="Estilo1ce">Decisión</td>

                         <td class="Estilo1ce">Nº Res.</td>

                         <td class="Estilo1ce">Nombre del Contrato</td>

                         <td class="Estilo1ce">Evaluación</td>

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



   $sql="select * from dpp_contratos where  cont_region='$regionsession' and  ";

if ($region<>"") {

    if ($region==0)

        $sql.=" cont_region<>'' and ";

    else

        $sql.=" cont_region=$region and ";

    $sw=1;

}

if ($fecha1<>"" and $fecha2<>"" ) {

    $sql.=" ( cont_recepcion>='$fecha1' and cont_recepcion<='$fecha2' ) and ";

    $sw=1;

}

/*

if ($estado==1) {

    $sql.=" cont_evaluara='SI' and ";

    $sw=1;

}

if ($estado==2) {

    $sql.=" cont_evaluara='NO' and ";

    $sw=1;

}

if ($estado==3) {

    $sql.=" (cont_evaluara='NO' or cont_evaluara='SI' ) and ";

    $sw=1;

}





*/





if ($rut<>"") {

    $sql.=" cont_rut like '%$rut%' and ";

    $sw=1;

}







if ($sw==1){

    $sql.=" cont_estado=2 and 1=1";

}

if ($sw==0){

    $sql.=" cont_estado=2 and 1=2";

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



     $archivo="vercontrato6.php";

     $archivo2="vercontrato3.php";

     $cont_id=$row3["cont_id"];

     $sql22 = "Select sum(fac_monto) as facturamonto from dpp_contratos x, dpp_cont_fac y, dpp_facturas z where x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id group by y.confa_cont_id order by x.cont_id desc ";

     //echo $sql22;

     $res22=mysql_query($sql22);

     $row22 = mysql_fetch_array($res22);

     $facturamonto=$row22["facturamonto"];





     $archivo="vercontrato8.php";

     $archivo2="vercontrato3.php";

     $cont_id=$row3["cont_id"];

     $sql22 = "Select sum(fac_monto) as facturamonto, sum(fac_montotipo) as facturauf, sum(fac_montotipo2) as facturautm from dpp_contratos x, dpp_cont_fac y, dpp_facturas z where x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id group by y.confa_cont_id order by x.cont_id desc ";

//     echo $sql22;

     $res22=mysql_query($sql22);

     $row22 = mysql_fetch_array($res22);

     $contratototal=$row3["cont_total"];

     $ejec2010=$row3["cont_ejec2010"];

     $facturamonto=$row22["facturamonto"];

     $facturauf=$row22["facturauf"];

     $facturautm=$row22["facturautm"];

     

     $tipomoneda2=$row3["cont_tipo2"];

//     echo "$facturamonto , $facturauf, $facturautm, $tipomoneda2  <br>  ";

     if ($tipomoneda2==1)

       $facturatotal=$facturamonto;

     if ($tipomoneda2==3)

       $facturatotal=$facturautm;

     if ($tipomoneda2==4)

       $facturatotal=$facturauf;

       

       $facturatotal=$facturatotal+$ejec2010;

       $porcentaje=$facturatotal*100/$contratototal;

       

    $clase2="Estilo1c";

    if ( $porcentaje>=90 )

      $clase2="Estilo1crojo";



       

     $sql23 = "Select * from dpp_encuestas where encu_cont_id=$cont_id order by encu_id desc limit 0,1";

     $res23 = mysql_query($sql23);

     $row23 = mysql_fetch_array($res23);

     $encunombre=$row23["encu_nombre"];

     $encufecha=substr($row23["encu_fecha"],0,4);

     $encudecision=$row23["encu_decision"];

     







?>

                      



                       <tr>

                         <td class="Estilo1b"><? echo $cont  ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_rut"]  ?>-<? echo $row3["cont_dig"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_nombre"]  ?> </td>

                         <td class="Estilo1b" ><? echo substr($row3["cont_vence"],8,2)."-".substr($row3["cont_vence"],5,2)."-".substr($row3["cont_vence"],0,4)   ?></td>

       

                   <td class="Estilo1c"><? echo $encunombre  ?> </td>

                       <td class="Estilo1c"><? echo $encufecha  ?> </td>

                       <td class="Estilo1c"><? echo $encudecision  ?> </td>

                         <td class="Estilo1c"><? echo $row3["cont_nroresolucion"] ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_nombre1"] ?>%</td>

<?

$evaluara=$row3["cont_evaluara"];

 if ($evaluara=='SI') {

?>

                         <td class="Estilo1c"><a href="evaexterna.php?id2=<? echo $row3["cont_id"] ?>" class="link" >Evaluar</a><td>

<?

} else {

?>

                         <td class="Estilo1c">No Evaluable</a><td>

<?

 }

?>

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

