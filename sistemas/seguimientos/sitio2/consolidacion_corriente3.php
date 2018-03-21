<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$nivel = $_SESSION["pfl_user"];

$regionsession = $_SESSION["region"];

$usuario=$_SESSION["nom_user"];



if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}

$date_in=date("d-m-Y");

?>

<html>

<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">

<title>CHEQUES CADUCADOS</title>

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

	font-size: 10px;

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

.Estilo1crojoc {

	font-family: Verdana;

	font-weight: bold;

	font-size: 12px;

	color: #CC0000;

	text-align: center;

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

text-align: center; }



}

.Estilo8 {font-family: Geneva, Arial, Helvetica, sans-serif; 

font-size: 10px; font-weight: bold; text-align: left; 

color: #009900;}



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

  

<SCRIPT LANGUAGE ="JavaScript">







</script>

<script language="javascript">

<!--

function valida() {



   if (document.form1.region.value==0 ) {

      alert ("Region presenta problemas ");

      return false;

  }

}

//-->

/*function validaGrabar() {

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }

}*/

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

            <table width="500" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td height="20" colspan="2"><span class="Estilo7">INGRESO ANTECEDENTES CUENTAS CORRIENTE</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1c">



<?





?>

                         </td>

                      </tr>

                      <tr>

                        <td><a href="consolidacion_corriente2.php" class="link" > Volver </a></td>

                      </tr>



                       <tr>

                       <td><br></td>





                      </tr>



                   <tr>

                  <td height="50" colspan="3">

                

                         <table border=1>

                             <tr>

                               <td class="Estilo1">NUMERO</td>

                               <td class="Estilo1">DESCRIPCION</td>

                              </tr>

                              

<?

     $id=$_GET["id"];

     $idante=$_GET["idante"];

     if ($idante<>'') {

         $sql="update concilia_antecedente set ante_estado=2 where ante_id='$idante'";

//         echo $sql;

         $res2 = mysql_query($sql);



     }

     

     $sql="select * from concilia_cc where cc_region='$regionsession' and cc_id=$id order by cc_id desc";

//     echo $sql;

     $res2 = mysql_query($sql);

     while ($row2 = mysql_fetch_array($res2)) {



?>

    <tr>

      <td  class="Estilo1"><? echo $row2["cc_numero"]; ?></td>

      <td  class="Estilo1"><? echo $row2["cc_descripcion"]; ?></td>

    </tr>

 <?

}

 ?>









                         </table>



                    

                    <br>

          <table width="488" border="0" cellspacing="0" cellpadding="0">

          <form name="form1" action="consolidacion_grabacorriente3.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">

                         <tr>

                             <td  valign="center" class="Estilo1">Fecha Cuenta</td>

                             <td class="Estilo1" valign="center">

<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in; ?>" id="f_date_c1" readonly="1">

<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"

      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



 <script type="text/javascript">

    Calendar.setup({

        inputField     :    "f_date_c1",     // id of the input field

        ifFormat       :    "%d-%m-%Y",      // format of the input field

        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)

        align          :    "Tl",           // alignment (defaults to "Bl")

        singleClick    :    true

    });

</script>





                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Nombre</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nombre" class="Estilo2" size="40"  > <br>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Cargo</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="cargo" class="Estilo2" size="40"  > <br>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">RUT(Cédula de Identidad)</td>

                             <td class="Estilo1" colspan=3>

                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>

                              <a href="../../archivos/<? echo $row3["ante_archivo1"]; ?>" class="link" target="_blank"><? echo $row3["ante_archivo1"]; ?></a>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">N° Póliza de Fianza</td>

                             <td class="Estilo1" colspan=3>

                              <input type="file" name="archivo2" class="Estilo2" size="20"  > <br>

                              <a href="../../archivos/<? echo $row3["ante_archivo2"]; ?>" class="link" target="_blank"><? echo $row3["ante_archivo2"]; ?></a>

                             </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1">Autorización Oficio Contraloría</td>

                             <td class="Estilo1" colspan=3>

                              <input type="file" name="archivo3" class="Estilo2" size="20"  > <br>

                              <a href="../../archivos/<? echo $row3["ante_archivo3"]; ?>" class="link" target="_blank"><? echo $row3["ante_archivo3"]; ?></a>

                             </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1">Registro de Firma Cuenta Corriente</td>

                             <td class="Estilo1" colspan=3>

                              <input type="file" name="archivo4" class="Estilo2" size="20"  > <br>

                              <a href="../../archivos/<? echo $row3["ante_archivo4"]; ?>" class="link" target="_blank"><? echo $row3["ante_archivo4"]; ?></a>

                             </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1">Anexo de Contrato Transferencias</td>

                             <td class="Estilo1" colspan=3>

                              <input type="file" name="archivo5" class="Estilo2" size="20"  > <br>

                              <a href="../../archivos/<? echo $row3["ante_archivo5"]; ?>" class="link" target="_blank"><? echo $row3["ante_archivo5"]; ?></a>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Otros</td>

                             <td class="Estilo1" colspan=3>

                              <input type="file" name="archivo6" class="Estilo2" size="20"  > <br>

                              <a href="../../archivos/<? echo $row3["ante_archivo6"]; ?>" class="link" target="_blank"><? echo $row3["ante_archivo6"]; ?></a>

                             </td>

                           </tr>







                       <tr>



                    </table>

                     <tr>

                       <td><Br></td>

                      </tr>



                             <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR    " > </td>

                           </tr>







                          <input type="hidden" name="id" value="<? echo $id ?>">



                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      

                      

                         <table border=1>

                             <tr>

                               <td class="Estilo1">N°</td>

                               <td class="Estilo1">Fecha</td>

                               <td class="Estilo1">Nombre</td>

                               <td class="Estilo1">Cargo</td>

                               <td class="Estilo1">Ficha</td>

                               <td class="Estilo1">Estado</td>

                              </tr>



      <?

          $sql="select * from concilia_antecedente where ante_cc_id='$id' order by ante_estado asc, ante_fecha desc";

//     echo $sql;

     $res2 = mysql_query($sql);

     $cont=1;

     while ($row2 = mysql_fetch_array($res2)) {

         $anteestado=$row2["ante_estado"];

         if ($anteestado==1) {

             $estado="Vigente";

         }

         if ($anteestado==2) {

             $estado="Desactivado";

         }



?>

    <tr>

      <td  class="Estilo1"><? echo $cont; ?></td>

      <td  class="Estilo1"><? echo $row2["ante_fecha"]; ?></td>

      <td  class="Estilo1"><? echo $row2["ante_nombre"]; ?></td>

      <td  class="Estilo1"><? echo $row2["ante_cargo"]; ?></td>

<!--

      <td  class="Estilo1"><a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo1"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo1"]; ?></a></td>

      <td  class="Estilo1"><a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo2"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo2"]; ?></a></td>

      <td  class="Estilo1"><a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo3"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo3"]; ?></a></td>

      <td  class="Estilo1"><a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo4"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo4"]; ?></a></td>

      <td  class="Estilo1"><a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo5"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo5"]; ?></a></td>

      <td  class="Estilo1"><a href="../../archivos/docconciliacion/antecedentes/<? echo $row2["ante_archivo6"]; ?>" class="link" target="_blank"><? echo $row2["ante_archivo6"]; ?></a></td>

-->

      <td  class="Estilo1"><a href="consolidacion_corrienteficha.php?id=<? echo $id ?>&idante=<? echo $row2["ante_id"]; ?>" class="link" >VER</a></td>

      <td  class="Estilo1"><a href="consolidacion_corriente3.php?id=<? echo $id ?>&idante=<? echo $row2["ante_id"]; ?>" class="link" ><? echo $estado ?></a></td>

    </tr>

 <?

    $cont++;

}

 ?>

</table>

                      

                      <tr>

                      <td colspan="8">



                      <table border=1>

<tr></tr>







                      <tr>



                        











</td>

  </tr>





</table>

       <img src="images/pix.gif" width="1" height="10">







</body>

</html>



<?



?>





