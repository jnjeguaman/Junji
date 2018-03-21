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
	font-size: 8px;
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

<script>
<!--
function calcula1(nn,a) {
   var c= document.form2["var["+nn+"]"].checked;
   if  (c) {
       document.form1.ordenes.value=Math.round(document.form1.ordenes.value)+Math.round(a);
   }
   if  (!c) {
       document.form1.ordenes.value=Math.round(document.form1.ordenes.value)-Math.round(a);
   }

}
-->
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
                    <td height="20" colspan="2"><span class="Estilo7">ASOCIACIÓN DE FACTURAS A ORDEN DE COMPRA</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$rut=$_GET["rut"];
$numfac=$_GET["numfac"];
$id1b=$_GET["id1b"];
$ori2=$_GET["ori2"];
$monto=$_GET["monto"];

if ($ori2=='h') {
    $volverarch="honorarioarchivos.php";
}
if ($ori2=='f') {
    $volverarch="facturasarchivos.php";
}


?>

                       <tr>
                       <td><a href="<? echo $volverarch ?>?id=<? echo $numfac ?>&id1b=<? echo $id1b ?>" class="link" >volver</a></td>
                      </tr>




                   <tr>
                    <td height="50" colspan="3">

     <table width="640" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="buscarcontratos.php" method="get">
                         <tr>
                             <td  valign="top" class="Estilo1">Monto Factura</td>
                             <td class="Estilo1">
                              <input type="text" name="monto" class="Estilo2" size="11" value="<? echo $monto ?>">
                             </td>
                           </tr>
                           <tr>
                             

                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Total Ordenes  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="ordenes" class="Estilo2" size="11" value="">
                             </td>
                           </tr>

                           <tr>
                             
                             

                           </tr>
                            <input type="hidden" name="id1b" value="<? echo $id1b ?>" >
                              <input type="hidden" name="region" class="Estilo2" size="11" value="<? echo $regionsession ?>">
                              <input type="hidden" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>">
                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      <td class="Estilo1" colspan=4><a href="reportesexcel.php?region=<? echo $region ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&item=<? echo $item ?>&consolidado=<? echo $consolidado ?>" class="link" > </a>
                  <form name="form2" action="grababuscarordencompra.php" method="post"  >
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Acepta Asociación "> </td>
                           </tr>

                      <table border=1>
                        <tr>
                         <td class="Estilo1b">N°</td>
                         <td class="Estilo1b">Numero</td>
                         <td class="Estilo1b">Tipo</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Observacion</td>
                         <td class="Estilo1b">Monto</td>
                         <td class="Estilo1b">Total OC</td>
                         <td class="Estilo1b">Estado</td>
                         <td class="Estilo1b">Archivo</td>
                         <td class="Estilo1b">Ver</td>
                        </tr>


<?

   $sql="select * from compra_orden where ";

if ($rut<>"") {
//    $sql.=" oc_rut='$rut' and oc_estado='En Proceso' and oc_region='$regionsession' and ";
//    $sql.=" oc_rut='$rut' and (oc_estado='ACEPTADO' or oc_estado='ENVIADA' or oc_estado='RECEPCION CONFORME') and oc_region='$regionsession' and ";
    $sql.=" oc_rut='$rut' and (oc_estado='ACEPTADO' or oc_estado='ENVIADA' ) and oc_region='$regionsession' and ";
    $sw=1;
}




if ($sw==1){
    $sql.=" 1=1 order by oc_id desc ";
}
if ($sw==0){
    $sql.=" 1=2";
}
//echo $sql."<br>";
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

   $op=0;
if ($row3["oc_archivo"]=='') {
    $imagen="punt_rojo.jpg";
    $titulo="Subir Archivo";
//   $href="<a href='#' class='link' onclick='abreVentana2(".$row3["oc_id"].",".$row3["oc_id"].")' title='".$titulo."'>";
    $href="<a href='#' class='link' >";
    $op=0;
} else {
    $imagen="punt_verde.jpg";
    $titulo="Ver Archivo";
    $href="<a href='../../archivos/docfac/".$row3["oc_archivo"]."' class='link' target='_blank' title='".$titulo."'>";
    $op=1;
}

  $octipo=$row3["oc_tipo"];
  $sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$octipo";
//  echo $sql33."<br>";
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $octipo2=$registro["cat_nombre"];
  
  $ocid=$row3["oc_id"];

//  $sql2="insert into compra_oceta (oceta_oc_id, oceta_eta_id, oceta_region, oceta_user, oceta_fecha)
//                               values ('$var1',    '$id1b', '$regionsession','$usuario', '$fechamia') ";
//      echo $sql2;
//      exit();

  
  $sql34="Select sum(eta_monto2) as total from compra_oceta x, dpp_etapas y where x.oceta_oc_id=$ocid and x.oceta_eta_id=y.eta_id ";
//  echo $sql34."<br>";
  $consulta34=mysql_query($sql34);
  $registro34=mysql_fetch_array($consulta34);
  $totalejecutado=$registro34["total"];


?>
                       <tr>
<?
if ($op==1) {
?>
                         <td class="Estilo1c"><? echo $cont  ?>
                           <input alt="ok" type="checkbox"  name="var[<? echo $cont ?>]" value="<? echo $row3["oc_id"] ?>" class="Estilo2" onclick="calcula1(<? echo $cont ?>,<? echo $row3["oc_monto"] ?> );" >
                           <input alt="ok" type="hidden" name="var2[<? echo $cont ?>]" value="<? echo $row3["oc_tipocodigo"] ?>"  >
                         </td>
<?
} else{
                       echo "<td class='Estilo1c'></td>";
}
?>
                         <td class="Estilo1" ><? echo $row3["oc_numero"]  ?></td>
                         <td class="Estilo1" ><? echo $octipo2;  ?></td>
                         <td class="Estilo1" ><? echo $row3["oc_nombre"];  ?></td>
                         <td class="Estilo1" ><? echo $row3["oc_obs"]  ?></td>
                         <td class="Estilo1" ><? echo number_format($row3["oc_monto"],0,',','.');  ?></td>
                         <td class="Estilo1" ><? echo number_format($totalejecutado,0,',','.');  ?></td>
                         <td class="Estilo1" ><? echo $row3["oc_estado"]  ?></td>
                         <td class="Estilo3c"><? echo $href ?><img src="images/<? echo $imagen ?>" width="20" height="20" border=0></a></td>
                         <td class="Estilo1"><a href="compra_fichaorden2.php?id=<? echo $row3["oc_id"]  ?>" class="link" >ver</a></td>
                       </tr>


<?

   $cont++;

}

?>
                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                               <input type="hidden" name="numfac" value="<? echo $numfac ?>" >
                               <input type="hidden" name="id1b" value="<? echo $id1b ?>" >
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
                        
                        
                    </table>
                    <br>
                  <form name="form2" action="grababuscarordencompra.php" method="post"  >
                     <table>
                          <tr>

                             <td class="Estilo1b">
                             <input type="submit" name="boton" class="Estilo2" value="  NO Asociar ">
                              </td>
                           </tr>
                           
                                                          <input type="hidden" name="cont" value="<? echo $cont ?>" >
                               <input type="hidden" name="numfac" value="<? echo $numfac ?>" >
                               <input type="hidden" name="id1b" value="<? echo $id1b ?>" >
                               <input type="hidden" name="ori2" value="<? echo $ori2 ?>" >
                               <input type="hidden" name="rut" value="<? echo $rut ?>" >
                  </form>
                           
                        
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
