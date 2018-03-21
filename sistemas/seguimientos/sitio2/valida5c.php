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

<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">

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


  function validaGrabar() {

    if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA ACCIÓN ?')) {
      blockUI();
    }
    else{
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



            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td height="20" colspan="2"><span class="Estilo7">5.- CERRAR CONTRATO </span></td>

                  </tr>

                      <tr>

                         <td width="487" valign="top" class="Estilo1">

                       <a href="menucontratos.php" class="link">VOLVER</a> <br>

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

$consolidado=$_GET["consolidado"];

$estado=$_GET["estado"];



?>







                   <tr>

                    <td height="50" colspan="3">



        </table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">

       <form name="form1" action="valida5c.php" method="get">

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

                             <td  valign="center" class="Estilo1">Fechas</td>

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

                                  <input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c3" readonly="1">

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

                             <td  valign="top" class="Estilo1">Estado</td>

                             <td class="Estilo1">

                                <select name="estado" class="Estilo1">



                                 <option value="">Todas</option>

                                 <option value="2" <? if ($estado==2) { echo "selected=selected"; } ?> >Abiertos</option>

                                 <option value="10"  <? if ($estado==10) { echo "selected=selected"; } ?> >Pre-Cierre</option>

                                 <option value="3"  <? if ($estado==3) { echo "selected=selected"; } ?> >Cerrado</option>

                               </select>





                             </td>

                           </tr>



                           <tr>

                             <td  valign="center" class="Estilo1" colspan=4 align="center">



                             <input type="submit" name="boton" class="Estilo2" value="  Consultar  ">

                             <a href="valida5c.php"> Limpiar </a> </td>





                           </tr>



                        </form>



                      </td>





                       <tr>

                       <td><br></td>

                      </tr>

                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      <tr>

                      </form>

                      

                     <form name="form1" action="grabavalida5c.php" method="post" onsubmit="return validaGrabar()">

                      <table border=0>

                           <tr>

                             <td  valign="center" class="Estilo1">Estado </td>

                             <td class="Estilo1" colspan=1>

                                <select name="uno" class="estilo1" onchange="muestra();">

                                   <option value="">Seleccione...</option>

                                   <option value="2" >Abrir</option>

                                   <option value="10" >Pre-Cierre</option>

                                   <option value="3" >Cerrar Contrato</option>

                                </select>

                             </td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Fecha  </td>

                             <td>

                                <input type="text" name="fecha4" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c4" readonly="1">

<img src="calendario.gif" id="f_trigger_c4" style="cursor: pointer; border: 1px solid red;" title="Date selector"

      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



 <script type="text/javascript">

    Calendar.setup({

        inputField     :    "f_date_c4",     // id of the input field

        ifFormat       :    "%d-%m-%Y",      // format of the input field

        button         :    "f_trigger_c4",  // trigger for the calendar (button ID)

        align          :    "Tl",           // alignment (defaults to "Bl")

        singleClick    :    true

    });

</script>

               </td>

                </tr>



                           <tr>

                             <td  valign="center" class="Estilo1">Observacion </td>

                             

            <td>

         <textarea name="obs" rows="3" class="Estilo2" cols="40"></textarea>

                                <br>

                                <input type="submit" name="boton" class="Estilo2" value="  Grabar Cambio de Estado  ">

                              <td>





                           </tr>



                    </table>

                    <hr>

                    <table border=1>

                        <tr>

                         <td class="Estilo1b">Op. </td>

                         <td class="Estilo1b">Nº</td>

                         <td class="Estilo1b">Rut</td>

                         <td class="Estilo1b">Nombre</td>

                         <td class="Estilo1b">Fecha_vence</td>

                         <td class="Estilo1b">Res. Ex.</td>

                         <td class="Estilo1b">Monto</td>

                         <td class="Estilo1b">Estado</td>

                         <td class="Estilo1b">VER </td>

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

if ($fecha1<>"" and $fecha2<>"" ) {

    $sql.=" ( cont_recepcion>='$fecha1' and cont_recepcion<='$fecha2' ) and ";

    $sw=1;

}

if ($rut<>"") {

    $sql.=" cont_rut like '%$rut%' and ";

    $sw=1;

}

if ($estado<>"") {

    $sql.=" cont_estado ='$estado%' and ";

    $sw=1;

}











if ($sw==1){

    $sql.=" (cont_estado=2 or cont_estado=3 or cont_estado=10) and 1=1 order by cont_id desc ";

}

if ($sw==0){

    $sql.=" cont_region=$regionsession and cont_estado=10 ";

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



     $archivo="vercontrato5b.php";

     $archivo2="vercontrato3.php";

     $cont_id=$row3["cont_id"];

/*

     $sql22 = "Select sum(fac_monto) as facturamonto from dpp_contratos x, dpp_cont_fac y, dpp_facturas z where x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id group by y.confa_cont_id order by x.cont_id desc ";

     //echo $sql22;

     $res22=mysql_query($sql22);

     $row22 = mysql_fetch_array($res22);

     $facturamonto=$row22["facturamonto"];

*/



    $contestado=$row3["cont_estado"];

    if ($contestado==2) {

        $estadonomb="Abierto";

    }

    if ($contestado==10) {

        $estadonomb="Pre-Cierre";

    }

    if ($contestado==3) {

        $estadonomb="Cerrado";

    }





?>

                      



                       <tr>

<?

                  if (($row3["cont_doc1"]<>"" and $row3["cont_doc3"]<>"") or 1==1) {

?>

                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["cont_id"] ?>" class="Estilo2" > </td>

<?

                  } else {

                      echo "<td> </td>";

                  }

?>

                         <td class="Estilo1b"><? echo $cont  ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_rut"]  ?>-<? echo $row3["cont_dig"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["cont_nombre"]  ?> </td>

                         <td class="<? echo $clase ?>" ><? echo substr($row3["cont_vence"],8,2)."-".substr($row3["cont_vence"],5,2)."-".substr($row3["cont_vence"],0,4)   ?></td>

                      	 <td class="Estilo1c"><? echo $row3["cont_nroresolucion"]  ?> </td>

                         <td class="Estilo1c"><? echo number_format($row3["cont_total"],0,',','.')  ?> </td>







<!--                         <td class="Estilo1c"><? echo $diff   ?> </td> -->

<!--                         <td class="Estilo1c"><? echo $facturamonto  ?> </td> -->

                         <td class="Estilo1b"><? echo $estadonomb  ?> </td>

                         <td class="Estilo1c"><a href="<? echo $archivo ?>?id2=<? echo $row3["cont_id"] ?>" class="link" >VER</a> </td>

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

