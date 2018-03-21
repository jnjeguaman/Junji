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

  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
  <link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">

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

     text-align: center;

   }

   .Estilo1c {

     font-family: Verdana;

     font-weight: bold;

     font-size: 8px;

     color: #003063;

     text-align: right;

   }

   .Estilo1d {

     font-family: Verdana;

     font-weight: bold;

     font-size: 8px;

     color: #003063;

     text-align: center;







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

     if (document.form1.uno.value == 3) {

       seccion1.style.display="";
       // $("#seccion1").css("display","inherit");

       $("#justifica").attr("required",true);

     } else {

       seccion1.style.display="none";

       $("#justifica").attr("required",false);

     }

   }

   function valida() {

     if (document.form1.uno.value==0 || document.form1.uno.value=='') {

      alert ("No ha seleccionado una Accion ");

      document.form1.uno.focus();

      return false;

    }

    if (document.form1.uno.value==2 && document.form1.justifica.value=='') {

      alert ("No ha Justificado ");

      return false;

    }

    if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA ACCIÓN ?')) {
      blockUI();
    }
    else{
      return false;
    }



    // if (document.form1.dos.value==0 || document.form1.dos.value=='') {

    //   alert ("No ha seleccionado un Ejecutivo ");

    //   document.form1.dos.focus();

    //   return false;

    // }



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

        <td height="20" colspan="2"><span class="Estilo7">Recepción de Facturas y
Asignación de Ejecutivos</span>

        <br><a href="menuadministracion.php" class="link">VOLVER</a> <br>

        </td>

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



     ?>





     <tr>

      <td height="50" colspan="3">

      </table>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

       <form name="form1" action="grabavalida1.php" method="post"  onSubmit="return valida()">

         <tr>

           <td  valign="center" class="Estilo1">Acción </td>

           <td class="Estilo1" colspan=3>

            <select name="uno" class="Estilo1" onchange="muestra();">

             <option value="">Seleccione...</option>

             <option value="1">1.- RECEPCIONAR DOCUMENTO</option>

             <option value="3">3.- DEVOLVER A OF. PARTES</option>

           </select>



           <td>

           </tr>


           <tr id="seccion1" style="display:none">

               <td class="Estilo1">Justificar</td>

               <td><input type="text" name="justifica" id="justifica" class="Estilo2" size="60" ></td>

             </tr>
             </div>



             <?php if ($_SESSION["pfl_user"] == 7): ?>

               <tr>

                        <td  valign="center" class="Estilo1">Asignar </td>

                        <td class="Estilo1" colspan=3>

                          <select name="dos" class="Estilo1" onchange="muestra();">

                            <option value="">Seleccione...</option>

                            <?



                            $sql4="select * from usuarios where atributo1=8 and region = ".$regionsession;

                            $res4 = mysql_query($sql4);

                            while($row4 = mysql_fetch_array($res4)){

                              ?>

                              <option value="<? echo $row4["nombre"]; ?>" ><? echo $row4["nombrecom"]; ?></option>



                              <?

                            }

                            ?>





                          </select>

<!--                           <div id="seccion1" style="display:none">

                            Justificar <input type="text" name="justifica" class="Estilo2" size="60" >

                          </div>
 -->


                          <td>



                          </tr>

             <?php endif ?>

           <tr>

             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Acepta Acción "> </td>

           </tr>







         </td>





         <tr>

           <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

         </tr>

         <tr>



          <table border=1 width="100%">



           <tr>

             <td class="Estilo1b">Op. </td>

             <td class="Estilo1b">Folio</td>

             <td class="Estilo1b">Rut_Proveedor</td>

             <td class="Estilo1b">Nombre</td>

             <td class="Estilo1b">Tipo Doc.</td>

             <td class="Estilo1b">A pagar</td>

             <td class="Estilo1b">N° Doc</td>

             <td class="Estilo1b">Recepción</td>

             <td class="Estilo1b">Días</td>

           </tr>



           <?



           $sql5="select * from dpp_plazos ";

//echo $sql;

           $res5 = mysql_query($sql5);

           $row5 = mysql_fetch_array($res5);

           $etapa1a=$row5["pla_etapa1a"];

           $etapa1b=$row5["pla_etapa1b"];

           $etapa2a=$row5["pla_etapa2a"];

           $etapa2b=$row5["pla_etapa2b"];



           $vartipodoc1=$row3["eta_tipo_doc"];

           if ($vartipodoc1=='Factura') {

             $vartipodoc2=$row3["eta_tipo_doc2"];

             if ($vartipodoc2=="f")

               $vartipodoc="Factura";

             if ($vartipodoc2=="b")

               $vartipodoc="Boleta Servicio";

             if ($vartipodoc2=="r")

               $vartipodoc="Recibo";

             if ($vartipodoc2=="n")

               $vartipodoc="N.Credito";

             if ($vartipodoc2=="bh")

               $vartipodoc="Honorario";

           }



           if ($vartipodoc1=='Honorario') {

             $vartipodoc="Honorario";

           }







           if ($regionsession==0) {

            $sql="select * from dpp_etapas where eta_estado=1 and eta_folioguia<>0 order by eta_folio desc";

          } else {

            // $sql="select * from dpp_etapas where eta_estado=1 and eta_folioguia<>0 and eta_region=$regionsession and year(eta_fecha_recepcion) >= 2017 order by eta_folio desc";
//            $sql="select * from dpp_etapas where eta_estado=1 and eta_folioguia<>0 and eta_region=$regionsession and eta_fecha_recepcion >= '2017-02-01' order by eta_folio desc";

            $sql="select * from dpp_etapas where eta_estado=1 and eta_folioguia<>0 and eta_region=$regionsession and eta_fecha_recepcion >= 2018 order by eta_folio desc";


          }
// echo $sql;




// echo $sql;

          $res3 = mysql_query($sql);

          $cont=1;

          while($row3 = mysql_fetch_array($res3)){

            $fechahoy = $date_in;

            $dia1 = strtotime($fechahoy);

            $fechabase =$row3["eta_fecha_recepcion"];

            $dia2 = strtotime($fechabase);

            $diff=$dia1-$dia2;

            $diff=intval($diff/(60*60*24));

            if($diff <= 10)

            {

              //VERDE

              $color="#139c06";

            }else if($diff > 10 && $diff <= 20)

            {

              //AZUL

              $color="#063bcc";

            }else{

              //ROJO

              $color="#f00";

            }

            if ($etapa1a>=$diff)

              $clase="Estilo1cverde";

            if ($etapa1a<$diff and $etapa1b>=$diff )

              $clase="Estilo1camarrillo";

            if ( $etapa1b<$diff)

              $clase="Estilo1crojo";





            $vartipodoc1=$row3["eta_tipo_doc"];

            if ($vartipodoc1=='Factura') {

             $vartipodoc2=$row3["eta_tipo_doc2"];

             if ($vartipodoc2=="f")

               $vartipodoc="Factura";

             if ($vartipodoc2=="b")

               $vartipodoc="Boleta Servicio";

             if ($vartipodoc2=="r")

               $vartipodoc="Recibo";

             if ($vartipodoc2=="n")

               $vartipodoc="N.Crédito";

             if ($vartipodoc2=="bh")

               $vartipodoc="Honorario";

           }

           if ($vartipodoc1=='Honorario') {

             $vartipodoc="Honorario";

           }



$eta_id=$row3["eta_id"];

$sql5="select * from dpp_facturas where fac_eta_id=$eta_id";



$res5 = mysql_query($sql5);

$row5=mysql_fetch_array($res5);

$archivo5=$row5["fac_archivo"];

if ($archivo5==""){

$muestra1="X";

$href1="#";

                                }

if ($archivo5<>"") {

$muestra1="Ok";

$href1="../../archivos/docfac/".$archivo5;

}

            // $sql2="SELECT * FROM dpp_etapas_nota WHERE notac_estado=1 AND notac_eta_id2='".$row3["eta_id"]."'";
$sql2="SELECT * FROM dpp_etapas_nota WHERE nota_estado=1 AND (nota_tipo_doc = 'NC' OR nota_tipo_doc = 'ND') AND nota_eta_id2='".$row3["eta_id"]."'";
            $res2=mysql_query($sql2);
            $row2=mysql_fetch_array($res2);

           ?>


          <?php
          if (!isset($row2['nota_id'])) {
            ?>


           <tr>

             <td class="Estilo1b">

                <input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" > 
                <input type="hidden" name="folio[<?php echo $cont ?>]" value="<?php echo $row3["eta_folio"] ?>">

             </td>

             <td class="Estilo1b"><a href="<?php echo $href1 ?>" target="_blank"><? echo $row3["eta_folio"]  ?></a></td>

             <td class="Estilo1c" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>

             <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>

             <td class="Estilo1d"><? echo $vartipodoc  ?> </td>

             <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>

             <td class="Estilo1b"><? echo $row3["eta_numero"]  ?> </td>

             <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>

             <td class="Estilo1c" style="color:<?php echo $color?>;font-weight: bold;"><? echo $diff   ?> </td>

           </tr>


            <?php
          }
          ?>








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

