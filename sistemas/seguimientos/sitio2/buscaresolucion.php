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
     text-align: center;
   }
   .Estilo1d {
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
  
  <script type="text/javascript">
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
    <div class="navbar-nav">
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
        <table width="580" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <tr>
              <td height="20" colspan="2"><span class="Estilo7">ASOCIAR RESOLUCION</span></td>
            </tr>
            <tr>
             <td><hr></td><td><hr></td>
           </tr>
           <?
           $rut=$_GET["rut"];
           $id=$_GET["id"];
           $res=$_GET["res"];
           $nacional=$_GET["nacional"];

           $sql="select * from dpp_contratos where cont_id=$id";
//echo $sql;
           $result=mysql_query($sql);
           $row=mysql_fetch_array($result);
           $evaluara=$row["cont_evaluara"];


           ?>
           <tr>
             <td><a href="contratosadjuntos.php?id=<? echo $id ?>&rut=<? echo $rut ?>" class="link" >volver</a></td>
           </tr>
           <tr>
             <td><br></td>
           </tr>



           <tr>
            <td height="50" colspan="3">

             <table width="480" border="0" cellspacing="0" cellpadding="0">
              <tr>
               <td  valign="center" class="Estilo1">Rut Empresa  </td>
               <td class="Estilo1" colspan=3>
                <? echo $row["cont_rut"]; ?> -<? echo $row["cont_dig"]; ?>
              </td>
            </tr>
            <tr>
             <td  valign="center" class="Estilo1">Nombre Proveedor Adjudicado </td>
             <td class="Estilo1" colspan=3><? echo $row["cont_nombre"]; ?>
             </td>
           </tr>

           <tr>
             <td  valign="center" class="Estilo1">Descripción Contrato </td>
             <td class="Estilo1" colspan=3><? echo $row["cont_descripcion"]; ?>
             </td>
           </tr>
           <tr>
             <td valign="center" class="Estilo1">Tipo de Contrato</td>
             <td class="Estilo1"><? echo $row["cont_tipo"]; ?>
             </td>
           </tr>

           
           <form name="form1" action="buscaresolucion.php" method="get">
             
            <tr>
             <td  valign="top" class="Estilo1">Folio  </td>
             <td class="Estilo1" colspan=3>
              <input type="text" name="res" class="Estilo2" size="11" value="<? echo $res ?>">
            </td>
          </tr>
          <tr>
           
            <tr>
             <td  valign="top" class="Estilo1">Defensoría Nacional </td>
             <td class="Estilo1" colspan=3>
               <input type="checkbox" name="nacional" class="Estilo2" size="11" value="1" <? if ($nacional=='1') { echo "checked"; } ?>>
             </td>
           </tr>
           <tr>
            <tr>
              <td>&nbsp;</td>
              <td class="Estilo1" colspan=3>
                <input type="submit" name="boton" class="Estilo2" value="  Buscar  ">
              </td>
            </tr>
            <tr>


            </tr>
            <input type="hidden" name="rut" value="<? echo $rut ?>" >
            <input type="hidden" name="id" value="<? echo $id ?>" >
          </form>

        </td>


        <tr>
         <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
       </tr>
       <tr>
        <td class="Estilo1" colspan=4><a href="reportesexcel.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item=<? echo $item ?>&consolidado=<? echo $consolidado ?>" class="link" > </a>
          <form name="form1" action="grababuscaresolucion.php" method="post" onsubmit="return validaGrabar()" >
           <tr>
             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Acepta Asociación "> </td>


           </tr>

           <table border=1>
            <tr>
             <td class="Estilo1c">Num</td>
             <td class="Estilo1c">Tipo</td>
             <td class="Estilo1c">Folio</td>

             <td class="Estilo1c">Materia</td>
             <td class="Estilo1c">Fecha</td>
             <td class="Estilo1c">Defensoria</td>
           </tr>


           <?
           if ($nacional==1) {
             $defnacional=" or docs_defensoria ='15' ";
           }

           $sql="select * from argedo_documentos where (docs_defensoria ='$regionsession' $defnacional ) and docs_folio ='$res' and docs_tipo in (1,2,4,6) order by docs_fecha desc ";


//echo $sql;
           $cont=1;
           $res3 = mysql_query($sql);
           while($row3 = mysql_fetch_array($res3)){


            $numdef=$row3["docs_defensoria"];
            $sql4="select * from regiones  where codigo=$numdef";
//echo $sql;
            $result4=mysql_query($sql4);
            $row4=mysql_fetch_array($result4);
            $nombre2=$row4["nombre"];



            ?>
            

            <tr>
             <td class="Estilo1c"><? echo $cont  ?>
               <input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["docs_id"] ?>" class="Estilo2" >
             </td>
             <td class="Estilo1c"><? echo $row3["docs_documento"]  ?> </td>
             <td class="Estilo1c"><? echo $row3["docs_folio"]  ?> </td>
             <td class="Estilo1c"><? echo $row3["docs_materia"]  ?> </td>
             <td  class="Estilo1c"><? echo substr($row3["docs_fecha"],8,2)."-".substr($row3["docs_fecha"],5,2)."-".substr($row3["docs_fecha"],0,4)   ?></td>
             <td class="Estilo1c"><? echo $nombre2  ?> </td>

             
           </tr>

           



           <?

           $cont++;

         }

         ?>
         <input type="hidden" name="cont" value="<? echo $cont ?>" >
         <input type="hidden" name="res" value="<? echo $res ?>" >
         <input type="hidden" name="id" value="<? echo $id ?>" >
         <input type="hidden" name="rut" value="<? echo $rut ?>" >
       </form>

       <tr>
         <td class="Estilo1b"> </td>
         <td class="Estilo1b"> </td>
         <td class="Estilo1b"> </td>
         <td class="Estilo1c"> </td>
         <td class="Estilo1c"> </td>
         <td class="Estilo1c"> </td>
       </tr>
     </td>
   </tr>
   <tr>





   </td>
 </tr>

 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
