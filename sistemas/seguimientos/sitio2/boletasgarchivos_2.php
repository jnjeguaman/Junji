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
     if (document.form1.dos.value == 'no') {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
     }
}

function cambia() {
    document.form22.submit;
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
                    <td height="20" colspan="2"><span class="Estilo7">BOLETAS DE GARANTIA</span></td>
                  </tr>
                  <tr>
                             <td  valign="top" class="Estilo1" colspan="4"><a href="menuformularios.php?cod=1" class="link" >VOLVER </a><br>  </td>
                           </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                      </table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="grabavalida2g.php" method="post" enctype="multipart/form-data" >

                      <tr>
                      <td class="Estilo1" colspan=4>
                      <table border=1>

                        <tr>
                         <td class="Estilo1b">Folio </td>
                         <td class="Estilo1b">Rut Proveedor</td>
                         <td class="Estilo1b">Nombre Proveedor</td>
                         <td class="Estilo1b">Monto</td>
                         <td class="Estilo1b">N° Doc </td>
                         <td class="Estilo1b">Fecha_Recep.</td>
                         <td class="Estilo1b">Emision</td>
                         <td class="Estilo1b">Vencimiento</td>
                         <td class="Estilo1b">Doc</td>
                         <td class="Estilo1b">Dias </td>
                         <td class="Estilo1b">Motivo Rechazo</td>
                         <td class="Estilo1b">Editar</td>
                        </tr>

<?
$sql5="select * from dpp_plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa1=$row5["pla_bolega"];
$etapa2=$row5["pla_bolegb"];
$etapa3=$row5["pla_bolegc"];


if ($regionsession==0) {
     $sql = "Select * from dpp_boletasg  where boleg_estado=2 order by boleg_id desc";
} else {
     $sql = "Select * from dpp_boletasg  where boleg_reg='$regionsession' and  boleg_estado=9 order by boleg_id desc";
    //$sql2 = "Select * from regiones where codigo=$regionsession";
}

//$sql="select * from dpp_boletasg where boleg_estado=2 order by boleg_id desc ";
//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["boleg_fecha_vence"];
    //echo "$dia1 - $fechabase";
    $dia2 = strtotime($fechabase);
    $diff=$dia2-$dia1;
    $diff=intval($diff/(60*60*24));
    if ($etapa1<$diff)
      $clase="Estilo1b";
    if ($etapa1>=$diff and $etapa2<$diff)
      $clase="Estilo1cverde";
    if ($etapa2>=$diff and $etapa3<$diff)
      $clase="Estilo1camarrillo";
    if ($etapa3>=$diff)
      $clase="Estilo1crojo";

/*
    if ($etapa2a<$diff and $etapa2b>=$diff )
      $clase="Estilo1camarrillo";
    if ( $etapa2b>$diff)
      $clase="Estilo1crojo";
*/


    $muestra1="X";

        $archivo="boletasgarchivos.php";
        $eta_id=$row3["eta_id"];

        $archivo5=$row3["boleg_archivo"];
        $archivo52=$row3["boleg_archivo2"];

        $muestra1="";
        $muestra2="";
        $viene_id=$row3["boleg_id"];
        if ($archivo5==""){
          $muestra1="X";
          $href1="#";
        }
        if ($archivo5<>"") {
          $muestra1="Ok";
          $href1="../../archivos/docgarantia/".$archivo5;
        }
        if ($archivo52<>"") {
          $muestra2="Ok";

        }




?>
                      

                       <tr>
                       <?
//                         if ($muestra1=="Ok" and $muestra2=="Ok") {
                         if ($muestra1=="Ok" || $row3["boleg_fecha_recep"] == "2016-09-15") {
                       ?>
                         <td class="Estilo1b"><? echo $row3["boleg_folio"]  ?></td>
                       <?
                        } else {
                        ?>
                         <td class="Estilo1b"><? echo  $row3["boleg_folio"]  ?> </td>
                        <?
                        }
                        ?>


                         <td class="Estilo1b" title="<? echo $row3["boleg_nombre"]  ?>"><? echo $row3["boleg_rut"]  ?>-<? echo $row3["boleg_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_nombre"]  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["boleg_monto"],0,',','.')  ?> </td>
                         <td class="Estilo1c"><? echo $row3["boleg_numero"]  ?> </td>
                         <td class="<? echo $clase ?>"><? echo substr($row3["boleg_fecha_recep"],8,2)."-".substr($row3["boleg_fecha_recep"],5,2)."-".substr($row3["boleg_fecha_recep"],0,4)   ?></td>
                         <td class="<? echo $clase ?>"><? echo substr($row3["boleg_fecha_emision"],8,2)."-".substr($row3["boleg_fecha_emision"],5,2)."-".substr($row3["boleg_fecha_emision"],0,4)   ?></td>
                         <td class="<? echo $clase ?>"><? echo substr($row3["boleg_fecha_vence"],8,2)."-".substr($row3["boleg_fecha_vence"],5,2)."-".substr($row3["boleg_fecha_vence"],0,4)   ?></td>
                         <td class="Estilo1c"><a href="<? echo $href1 ?>" class="link" target="_blank"><? echo $muestra1 ?></a> </td>
                         <td class="Estilo1c"><? echo $diff   ?> </td>
                         <td class="Estilo1c"><? echo $row3["boleg_rechazo"]   ?> </td>
                         <td class="Estilo1c"><a href="<? echo $archivo ?>?id=<? echo $viene_id ?>" class="link" >EDITAR</a></td>
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
