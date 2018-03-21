<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
// $regionsession = $_SESSION["region"];
if(isset($_POST["region"]) && $_POST["region"] <> '')
{
  $regionsession = $_POST["region"];
}else{
  $regionsession = $_SESSION["region"];
}
if($_SESSION["nom_user"] =="" ){
  ?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("Y-m-d");

$sql3 = "SELECT * FROM regiones where activo = 1";
$res3 = mysql_query($sql3);
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

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">1.- RECEPCIÓN BOLETA GARANTÍA</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                         <td class="Estilo1" colspan=100> <?php if($_SESSION["pfl_user"] == 31 || $_SESSION["pfl_user"] == 37) { ?><a href="valida2g.php" class="link">2.  CUSTODIA GARANTIA</a> | <?php } ?> <?php if($_SESSION["pfl_user"] == 7 || $_SESSION["pfl_user"] == 31 || $_SESSION["pfl_user"] == 37) { ?><a href="valida3g.php" class="link">3. ADMINISTRACION GARANTIA </a> |<?php } ?> <?php if($_SESSION["pfl_user"] == 31 || $_SESSION["pfl_user"] == 37) { ?><a href="valida4g.php" class="link"> 4.POR DEVOLVER </a><?php } ?>
                       </tr>
                       <tr>
                       <td><br></td><td><br></td>
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
        <?
        if ($nivel != 37) {
        ?>
       <form name="form1" action="grabavalida1g.php" method="post"  onSubmit="return valida()">
                           <tr>
                             <td  valign="center" class="Estilo1">Acción </td>
                             <td class="Estilo1" colspan=3>
                                <select name="uno" class="Estilo1" onchange="muestra();">
                                   <option value="">Seleccione...</option>
                                   <option value="1">Recepcionar</option>
                                   <option value="2">No Recepcionar</option>
                                </select>
                                <div id="seccion1" style="display:none">
                                   Justificar <input type="text" name="justifica" class="Estilo2" size="60" >
                                </div>
                              <td>
                              

                           </tr>

<?
if ($nivel<>23) {
?>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Acepta Cambios "> </td>
<?
}
?>

                           </tr>



                      </td>

        


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
        <?
        }
        ?>
                      <table border="1" class="table table-striped table-hover">
                        <tr>
                         <td class="Estilo1b" colspan=9><input type='checkbox' name='checkbox11' value='checkbox' onClick='ChequearTodos(this);'>TODOS</td>
                         <?php if ($nivel == 37): ?>
                           <td colspan="4">
                           <form action="valida1g.php" method="POST">
                             <select name="region" id="region" class="Estilo1" onchange="this.form.submit();">
                               <option value="">Seleccionar...</option>
                               <?php while($row4 = mysql_fetch_array($res3)) { ?>
                                <option value="<?php echo $row4["codigo"] ?>" <?php if($regionsession == $row4["codigo"]){echo"selected";} ?>><?php echo $row4["nombre"] ?></option>
                               <?php } ?>
                             </select>
                             </form>
                           </td>
                         <?php endif ?>
                        </tr>

                        <tr>
                         <td class="Estilo1b">Op.</td>
                         <td class="Estilo1b">Folio</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">N° Documento</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">A pagar</td>
                         <td class="Estilo1b">Recepción </td>
                         <td class="Estilo1b">Días </td>
                         <td class="Estilo1b">ID Licitación</td>
                        </tr>

<?

$sql5="select * from dpp_plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa1=$row5["pla_etapa1"];
$etapa2a=$row5["pla_etapa2a"];
$etapa2b=$row5["pla_etapa2b"];
$etapa3=$row5["pla_etapa3"];
$etapa4=$row5["pla_etapa4"];
$etapa5=$row5["pla_etapa5"];

if ($regionsession==0) {
     $sql = "Select * from dpp_boletasg  where boleg_estado=1 order by boleg_id desc";
} else {
     $sql = "Select * from dpp_boletasg  where boleg_reg='".$regionsession."' and  boleg_estado=1 order by boleg_id desc";
    //$sql2 = "Select * from regiones where codigo=$regionsession";
}


//$sql="select * from dpp_boletasg where boleg_estado=1 order by boleg_id desc ";
// echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["boleg_fecha_recep"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24));
  

?>
                      

                       <tr>
                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["boleg_id"] ?>" class="Estilo2" > </td>
                         <td class="Estilo1b">
                         <?php if ($row3["boleg_archivo"] <> ""): ?>
                         <a href="../../archivos/docgarantia/<?php echo $row3["boleg_archivo"] ?>" class="link" target="_blank"><? echo $row3["boleg_folio"] ?></a>
                           
                           <?php else: ?>
                            <? echo $row3["boleg_folio"] ?>
                            <i class="fa fa-warning fa-lg" title="SIN ADJUNTO" style="color: tomato;"></i>
                         <?php endif ?>
                         </td>
                         <td class="Estilo1b" title="<? echo $row3["boleg_nombre"]  ?>"><? echo $row3["boleg_rut"]  ?>-<? echo $row3["boleg_dig"]  ?> </td>
                         <td class="Estilo1b"><?php  echo $row3["boleg_numero"] ?></td>
                         <td class="Estilo1b"><? echo $row3["boleg_nombre"]  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["boleg_monto"],0,',','.')  ?> </td>
                         <td class="Estilo1b ><? echo $clase ?>"><? echo substr($row3["boleg_fecha_recep"],8,2)."-".substr($row3["boleg_fecha_recep"],5,2)."-".substr($row3["boleg_fecha_recep"],0,4)   ?></td>
                         <td class="Estilo1c"><? echo $diff   ?> </td>
                         <td class="Estilo1c"><?php echo $row3["boleg_idlicitacion"] ?></td>
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
