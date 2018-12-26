<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$nivel = $_SESSION["pfl_user"];

$regionsession = $_SESSION["region"];

if ($_SESSION["nom_user"] == "") {
  ?>
  <script language="javascript">location.href='sesion_perdida.php';</script>
<?
}
$date_in = date("Y-m-d");
?>

<html>

<head>

<title>Defensoria</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/estilos.css" rel="stylesheet" type="text/css">

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

                    <td height="20" colspan="2"><span class="Estilo7">MENU ARGEDO <?php echo date("Y") ?></span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>



                   <tr>

                    <td height="50" colspan="3">

<?

$sql = "select * from regiones where codigo=$regionsession ";

// echo $sql;

$result = mysql_query($sql);

$row = mysql_fetch_array($result);

$nombre = $row["nombre"];

$inicio = $row["inicio"];

$dirargedo = $row["argedo"];

// $anno=date("Y");

// $anno2=2011;



?>

  </table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">

       <form name="form1" action="reportes.php" method="get">






      <?php

      if ($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 7 && $_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && $_SESSION["pfl_user"] != 34 && $_SESSION["pfl_user"] != 35 && $_SESSION["pfl_user"] != 36 && $_SESSION["pfl_user"] != 38) {

        ?>



                            <tr>

                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_menudocs.php?cod=29" class="link" >1. AGREGAR DOCUMENTO</a>  </td>

                           </tr>

                            <tr>

                              <td><br></td>

                            </tr>




      <?php

    }
    if ($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 7 && $_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && $_SESSION["pfl_user"] != 34 && $_SESSION["pfl_user"] != 35 && $_SESSION["pfl_user"] != 36 && $_SESSION["pfl_user"] != 38) {

      ?>






                            <tr>

                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_menudocsm.php?cod=29" class="link" >2. MODIFICAR DOCUMENTO</a>  </td>

                           </tr>

                            <tr>

                              <td><br></td>

                            </tr>




      <?php

    }
    ?>






                            <tr>

                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_consulta.php" class="link" >3. CONSULTAS</a>  </td>

                           </tr>

                            <tr>

                              <td><br></td>

                            </tr>

<?

if ($regionsession == 1 or $regionsession == 2 or $regionsession == 3 or $regionsession == 4 or $regionsession == 5 or $regionsession == 6 or $regionsession == 7 or $regionsession == 8 or $regionsession == 9 or $regionsession == 10 or $regionsession == 11 or $regionsession == 12 or $regionsession == 13 or $regionsession == 14 or $regionsession == 15 or $regionsession == 17 or $regionsession == 18) {



  if ($_SESSION["pfl_user"] != 3 && $_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 7 && $_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && $_SESSION["pfl_user"] != 34 && $_SESSION["pfl_user"] != 35 && $_SESSION["pfl_user"] != 36 && $_SESSION["pfl_user"] != 37 && $_SESSION["pfl_user"] != 38) {

    ?>



                            <tr>

                             <td  valign="top" class="Estilo1" colspan="2"><a href="argedo_ingresoant.php?cod=29" class="link" >4. CARGA A�OS ANTERIORES </a>  </td>

                           </tr>



      <?php

    }





  } else {



    if ($_SESSION["pfl_user"] != 5 && $_SESSION["pfl_user"] != 7 && $_SESSION["pfl_user"] != 31 && $_SESSION["pfl_user"] != 32 && $_SESSION["pfl_user"] != 33 && $_SESSION["pfl_user"] != 34 && $_SESSION["pfl_user"] != 35 && $_SESSION["pfl_user"] != 36 && $_SESSION["pfl_user"] != 37 && $_SESSION["pfl_user"] != 38) {

      ?>




                         <tr>

                             <td  valign="top" class="Estilo1" colspan="2"><a href="http://grus:81/Resoluciones-Oficios/Lists/<? echo $dirargedo ?>/NewForm.aspx" class="link" target="_blank" >4. CARGA A�OS ANTERIORES</a>  </td>

                           </tr>

      <?php

    }



  }

  ?>



                            <tr>

                              <td><br></td>

                            </tr>



                            <tr>

                              <td><hr></td>

                            </tr>

<?

$reg = $regionsession;

$campo1 = "fol_reg" . $reg . "_1";

$campo2 = "fol_reg" . $reg . "_2";

$campo3 = "fol_reg" . $reg . "_3";

$campo4 = "fol_reg" . $reg . "_4";

$campo5 = "fol_reg" . $reg . "_5";

$sql2 = "select $campo1, $campo2, $campo3, $campo4, $campo5 from argedo_folios where fol_id=1 ";

//  echo $sql2."<br>";

$result2 = mysql_query($sql2);

$row2 = mysql_fetch_array($result2);

$folio1 = $row2["0"];

$folio2 = $row2["1"];

$folio3 = $row2["2"];

$folio4 = $row2["3"];

$folio5 = $row2["4"];







?>







                            <tr>

                              <td><br></td>

                            </tr>





                            <tr>

                              <td><br></td>

                            </tr>







                        </form>



                      </td>







 

</table>



<img src="images/pix.gif" width="1" height="10">

</body>

</html>



<?

//require("inc/func.php");

?>

