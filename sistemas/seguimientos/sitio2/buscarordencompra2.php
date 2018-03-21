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
              <td height="20" colspan="2"><span class="Estilo7">ASOCIACIÓN ORDEN DE COMPRA A CONTRATO</span></td>
            </tr>
            <tr>
             <td><hr></td><td><hr></td>
           </tr>
           <?
           $contrato=$_GET["contrato"];
           $region=$_GET["region"];
           $fecha1=$_GET["fecha1"];
           $fecha2=$_GET["fecha2"];
           $rut=$_GET["rut"];
           $id=$_GET["id"];

           $numfac=$_GET["numfac"];
           $ori2=$_GET["ori2"];



           ?>


           <tr>
             <td  valign="top" class="Estilo1" colspan="4"><a href="contratosadjuntos.php?id=<? echo $id ?>" class="link" >Volver</a><br>  </td>
           </tr>
           <tr>
             <td  valign="top" class="Estilo1" colspan="4"><br>  </td>
           </tr>


           <tr>
            <td height="50" colspan="3">

             <table width="480" border="0" cellspacing="0" cellpadding="0">
               <form name="form1" action="buscarcontratos.php" method="get">
                 <tr>
                   <td  valign="top" class="Estilo1">REGION</td>
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


             </tr>
             <tr>
               <td  valign="top" class="Estilo1">RUT  </td>
               <td class="Estilo1" colspan=3>
                <input type="text" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>">
              </td>
            </tr>

            <tr>



            </tr>
            <input type="hidden" name="id1b" value="<? echo $id1b ?>" >
          </form>

        </td>


        <tr>
         <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
       </tr>
       <tr>
        <td class="Estilo1" colspan=4><a href="reportesexcel.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item=<? echo $item ?>&consolidado=<? echo $consolidado ?>" class="link" > </a>
          <form name="form1" action="grababuscarordencompra2.php" method="post" onsubmit="return validaGrabar()" >
           <tr>
             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Acepta Asociación "> </td>


           </tr>

           <table border=1>
            <tr>
             <td class="Estilo1b">Id </td>
             <td class="Estilo1b">Numero</td>
             <td class="Estilo1b">Tipo</td>
             <td class="Estilo1b">Rut</td>
             <td class="Estilo1b">R.Social</td>
             <td class="Estilo1b">Monto</td>
             <td class="Estilo1b">Estado</td>
             <td class="Estilo1b">Ver</td>
           </tr>


           <?

           $sql="select * from compra_orden where ";
//cont_contrato=3
           if ($rut<>"") {
            if ($contrato==3) {
              $peritaje="or oc_rut='61941900-6' ) and (oc_modalidad='Peritaje' or oc_modalidad REGEXP ('[0-9]') ";
            }
//    $sql.=" oc_rut='$rut'  and oc_estado<>'CERRADO' and oc_region='$regionsession' and oc_cont_id='' and ";
            $sql.=" (oc_rut='$rut'  $peritaje) and oc_estado<>'CANCELADA/ELIMINADA/RECHAZADA' and oc_region='$regionsession'  and ";
            $sw=1;
          }




          if ($sw==1){
            $sql.=" 1=1 order by oc_id ";
          }
          if ($sw==0){
            $sql.=" 1=2";
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

            ?>
            <tr>
             <td class="Estilo1c"><? echo $cont  ?><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["oc_id"] ?>" class="Estilo2" >
             </td>
             <td class="Estilo1" ><? echo $row3["oc_numero"]  ?></td>
             <td class="Estilo1" ><? echo $row3["oc_modalidad"]  ?></td>
             <td class="Estilo1" ><? echo $row3["oc_rut"]."-".$row3["oc_dig"];  ?></td>
             <td class="Estilo1" ><? echo $row3["oc_rsocial"]  ?></td>
             <td class="Estilo1" ><? echo number_format($row3["oc_monto"],0,',','.');  ?></td>
             <td class="Estilo1" ><? echo $row3["oc_estado"]  ?></td>
             <td class="Estilo1"><a href="compra_fichaorden2.php?id=<? echo $row3["oc_id"]  ?>" class="link" >ver</a></td>
           </tr>


           <?

           $cont++;

         }



         ?>
         <input type="hidden" name="cont" value="<? echo $cont ?>" >
         <input type="hidden" name="numfac" value="<? echo $numfac ?>" >
         <input type="hidden" name="id" value="<? echo $id ?>" >
         <input type="hidden" name="ori2" value="<? echo $ori2 ?>" >
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
