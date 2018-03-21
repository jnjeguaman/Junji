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
    .Estilo1crojo {
      font-size: 14px;
      color: #CC0000;
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
    font-size: 15px; font-weight: bold; }
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
            <td height="20" colspan="2"><span class="Estilo7">CONTABILIDAD</span></td>
          </tr>
          <tr>
           <td><hr></td><td><hr></td>
         </tr>

         <tr>
          <td height="20" colspan="3">
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
           <form name="form1" action="reportes.php" method="get">




            <?php if ($_SESSION["pfl_user"] <> 31 && $_SESSION["pfl_user"] != 34): 



            if(($_SESSION["pfl_user"] == 5 && $_SESSION["region"] == 14) || $_SESSION["region"] == 13) {

              ?>

              <tr>
                 <td  valign="top" class="Estilo1" colspan="2"><strong class="Estilo1crojo">* </strong> <a href="valida5asignacion.php" class="link" > ASIGNACIÓN SET DE PAGOS</a> </td>
               </tr>
               <tr>
                <td><br></td>
              </tr>






              <?php
            }


            if($_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33) {

              ?>
              <tr>
               <td  valign="top" class="Estilo1" colspan="2"><a href="valida5.php" class="link" >1.- RECEPCIÓN DEL SET DE PAGO</a>  </td>
             </tr>
             <tr>
              <td><br></td>
            </tr>




            <?php
          }
          if($_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33) {

            ?>



            <tr>
             <td  valign="top" class="Estilo1" colspan="2"><a href="valida5reg.php" class="link" >2.- GENERA GUIA TESORERIA</a>  </td>
           </tr>
           <tr>
            <td><hr></td>
          </tr>


          <?php } ?>



        <?php else: ?> 



          <?php

          if($_SESSION["pfl_user"] != 31) {

            ?>





            <tr>
             <td  valign="top" class="Estilo1" colspan="2"><a href="valida5.php" class="link" >1.- RECEPCIÓN FÍSICA DOCUMENTOS PARA PAGO DE CONTABILIDAD</a>  </td>
           </tr>
           <tr>
            <td><hr></td>
          </tr>


          <tr>
           <td  valign="top" class="Estilo1" colspan="2"><a href="valida5reg.php" class="link" >2.- GENERA GUIA TESORERIA</a>  </td>
         </tr>
         <tr>
          <td><hr></td>
        </tr>



        <?php
      }






      if($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 34) {

        ?>

<tr>
               <td  valign="top" class="Estilo1" colspan="2"><a href="valida5b.php" class="link" >1.- RECEPCIÓN DEL SET DE PAGO</a>  </td>
             </tr>
             <tr>
              <td><br></td>
            </tr>


        <tr>
         <td  valign="top" class="Estilo1" colspan="2"><a href="valida6.php" class="link" >2.-  ADMINISTRACIÓN PAGO PROVEEDORES </a>  </td>
       </tr>
       <tr>
        <td><br></td>
      </tr>



      <?php
    }
    if($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 34) {

      ?>




      <tr>
       <td  valign="top" class="Estilo1" colspan="2"><a href="valida7.php" class="link" >3.- ENTREGA PAGO A PROVEEDORES</a>  </td>
     </tr>
     <tr>
      <td><hr></td>
    </tr>

    <?php
  }


  ?>





<?php endif ?>


<?php 




if($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && $_SESSION["pfl_user"] != 34) {

  ?>
  <tr>
   <td  valign="top" class="Estilo1" colspan="2"><a href="buscaproveedor.php" class="link" >4.- EDITAR PROVEEDORES (FORMAS DE PAGO) </a>  </td>
 </tr>
 <tr>
  <td><br></td>
</tr>

<?php
}
if($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && $_SESSION["pfl_user"] != 34) {

  ?>

  <tr>
   <td  valign="top" class="Estilo1" colspan="2"><a href="comprobantetransferencia.php" class="link" >5.- COMPROBANTE DE TRANFERENCIA </a>  </td>
 </tr>
 <tr>
  <td><hr></td>
</tr>

<?php
}
if($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && $_SESSION["pfl_user"] != 34) {

  ?>


  <tr>
   <td  valign="top" class="Estilo1" colspan="2"><a href="chequecaducado.php" class="link" >6.- INGRESO CHEQUES CADUCADOS </a>  </td>
 </tr>
 <tr>
  <td><br></td>
</tr>

<?php
}
if($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && $_SESSION["pfl_user"] != 34) {

  ?>


  <tr>
   <td  valign="top" class="Estilo1" colspan="2"><a href="consultacaducado.php" class="link" >7.- ADMINISTRACION CHEQUES CADUCADOS </a>  </td>
 </tr>
 <tr>
  <td><hr></td>
</tr>

<?php

}

if($_SESSION["pfl_user"] != 31) {

  ?>



  <tr>
   <td  valign="top" class="Estilo1" colspan="2"><a href="menucontabilidad3.php" class="link" >8.- LIBRO DE COMPRAS  </a>  </td>
 </tr>
<!--
                            <tr>
                              <td><hr></td>
                            </tr>

                          <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="reportes3.php" class="link" >9.- CONSULTAS CHEQUES PAGADOS </a>  </td>
                          </tr>
                            <tr>
                              <td><br></td>
                            </tr>
                          <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="menucontabilidad2.php" class="link" >10.- INFORMES CONTABILIDAD </a>  </td>
                          </tr>
                        -->
                        <tr>
                          <td><hr></td>
                        </tr>

                        <?php

                      }
                      if($_SESSION["pfl_user"] != 31) {
                        ?>


                        <tr>
                         <td  valign="top" class="Estilo1" colspan="2"><a href="consolidacion_menu.php" class="link" >9.- CONCILIACION BANCARIA </a>  </td>
                       </tr>
                       <tr>
                        <td><hr></td>
                      </tr>


                      <?php
                    }
                    if($_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && 1==2) {

                      ?>
                      <tr>
                       <td  valign="top" class="Estilo1" colspan="2"><a href="devengo.php" class="link" >10.- DEVENGO </a>  </td>
                     </tr>
                     <tr>
                      <td><hr></td>
                    </tr>
                    <?php
                  }

if($_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33) {

                      ?>
                      <tr>
                       <td  valign="top" class="Estilo1" colspan="2"><a href="verdevueltos3.php" class="link" >11.- DEVUELTOS </a>  </td>
                     </tr>
                     <tr>
                      <td><hr></td>
                    </tr>
                    <?php
                  }

                  if ($regionsession==15 or 1==2) {


                    if($_SESSION["pfl_user"] != 32) {
                      ?>

                      <tr>
                       <td  valign="top" class="Estilo1" colspan="2"><a href="menucontabilidad5.php" class="link" >10.- COMETIDOS  </a>  </td>
                     </tr>
                     <tr>
                      <td><hr></td>
                    </tr>


                    <?php
                  }


                  if($_SESSION["pfl_user"] != 32) {

                    ?>


                    <tr>
                     <td  valign="top" class="Estilo1" colspan="2"><a href="menucontabilidad4.php" class="link" > INFOPRES  </a>  </td>
                   </tr>
                   <tr>
                    <td><hr></td>
                  </tr>


                  <?
                }
              }
              ?>
              <?php if ($_SESSION["pfl_user"] == 5 || $_SESSION["pfl_user"] == 31): ?>
                <tr>
                <td  valign="top" class="Estilo1" colspan="2"><a href="contabilidad_asiento.php" class="link" >12.- ASIENTO CONTABLE  </a>  </td>
               </tr>
               <tr>
                <td><hr></td>
              </tr>

            <?php endif ?>

            <?php if ($_SESSION["pfl_user"] == 5): ?>
                <tr>
                <td  valign="top" class="Estilo1" colspan="2"><a href="contabilidad_devengo.php" class="link" >13.- DEVENGOS  </a>  </td>
               </tr>
               <tr>
                <td><hr></td>
              </tr>

            <?php endif ?>







          </form>

        </td>




      </table>

      <img src="images/pix.gif" width="1" height="10">
    </body>
    </html>

    <?
//require("inc/func.php");
    ?>
