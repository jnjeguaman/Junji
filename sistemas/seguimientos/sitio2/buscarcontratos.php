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
<script>
<!--
function valida() {
   if (document.form2.ncuota.value==0 ) {
      alert ("Numero Cuota presenta problemas ");
      return false;
   }
   if (document.form2.tcambio.value==0 ) {
      alert ("Tipo Cambio presenta problemas ");
      return false;
   }
   if (document.form2.tpago[0].checked=='' && document.form2.tpago[1].checked=='' ) {
      alert ("Tipo Pago presenta problemas ");
      return false;
   }
}
-->

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
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">
      <?
      require("inc/menu_1.php");
      ?>
            </div>
      </div>
        <div class="col-sm-9 col-lg-9">
                    <div class="dash-unit2">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">ASOCIACIÓN DE FACTURAS A CONTRATOS</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$monto=$_GET["monto"];
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$rut=$_GET["rut"];
$numfac=$_GET["numfac"];
$id1b=$_GET["id1b"];
$ori2=$_GET["ori2"];
$swori=$_GET["swori"];


if ($ori2=="h") {
    $volver="honorarioarchivos.php";
}
if ($ori2=="f") {
    $volver="facturasarchivos.php";
}


$sql2 = "Select * from dpp_proveedores where provee_rut =$rut";
//echo $sql;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombreprovee=$row2["provee_nombre"];



?>
                       <tr>
                       <td><a href="<? echo $volver ?>?id=<? echo $numfac ?>&id1b=<? echo $id1b ?>" class="link" >volver</a></td>
                      </tr>
                       <tr>
                       <td><br></td>
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
                             <td  valign="top" class="Estilo1">NOMBRE </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="50" value="<? echo $nombreprovee ?>">
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
                  <form name="form2" action="grababuscarcontrato.php" method="post"  onsubmit="return validaGrabar()" >
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Acepta Asociación "> </td>


                           </tr>


                      <br>
                      <table border=1>
                        <tr>
                         <td class="Estilo1c">SELEC</td>
                         <td class="Estilo1c">FECHA VENCIMIENTO</td>
                         <td class="Estilo1c">MONTO TOTAL CONTRATO</td>
                         <td class="Estilo1c">TIPO</td>
                         <td class="Estilo1c">SERVICIO</td>
                         <td class="Estilo1c">N° RES.</td>
<!--
                         <td class="Estilo1c">UTM</td>
                         <td class="Estilo1c">UF</td>
                         <td class="Estilo1c">DOLAR</td>
                         <td class="Estilo1c">Fijo</td>
                         <td class="Estilo1c">Var.</td>
                         <td class="Estilo1c">N°Cuota</td>
-->
                        </tr>


<?
/*
$xmlSource = "http://indicadoresdeldia.cl/webservice/indicadores.xml";
$xml = simplexml_load_file($xmlSource);

echo $xml->santoral->ayer;
echo $xml->santoral->hoy;
echo $xml->santoral->maniana;
echo $xml->moneda->dolar;
echo $xml->moneda->euro;
echo $xml->moneda->dolar_clp; //Dolar interbancario
echo $xml->indicador->ivp;
echo $xml->indicador->uf;
echo $xml->indicador->ipc;
echo $xml->indicador->utm;
echo $xml->indicador->imacec;
echo $xml->bolsa->ipsa;
echo $xml->bolsa->igpa;
echo $xml->bolsa->banca;
echo $xml->bolsa->commodities;
echo $xml->bolsa->retail;
echo $xml->bolsa->consumo;
echo $xml->bolsa->utilities;



$utm=str_replace("$","",$xml->indicador->utm);
$utm=number_format($utm,0,'','');

$uf=str_replace("$","",$xml->indicador->uf);
$uf=number_format($uf,0,'','');

$dolar=str_replace("$","",$xml->moneda->dolar);
$dolar=number_format($dolar,0,'','');

*/

$sql5="select * from dpp_plazos_cont ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa1a=$row5["placont_fecha1"];
$etapa1b=$row5["placont_fecha2"];
$etapa2a=$row5["placont_monto1"];
$etapa2b=$row5["placont_monto2"];

$sw=0;

   $sql="select * from dpp_contratos where cont_region='$regionsession' and";

if ($fecha1<>"" and $fecha2<>"" ) {
    $sql.=" ( cont_recepcion>='$fecha1' and cont_recepcion<='$fecha2' ) and ";
    $sw=1;
}
if ($rut<>"") {
    $sql.=" cont_rut like '%$rut%' and ";
    $sw=1;
}




if ($sw==1){
    $sql.=" 1=1 and (cont_estado=2 or cont_estado=1) ";
}
if ($sw==0){
    $sql.=" 1=2";
}
//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
while($row3 = mysql_fetch_array($res3)){

        $archivo="vercontrato.php";

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

$contnombre1=$row3["cont_nombre1"];
$tipomoneda2=$row3["cont_tipo2"];

$sql2 = "Select * from dpp_monedas where mone_id=$tipomoneda2";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda2=$row2["mone_tipo"];



?>


                       <tr>
                         <td class="Estilo1c"><? echo $cont  ?>
                           <input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["cont_id"] ?>" class="Estilo2" >
                           <input alt="ok" type="hidden" name="var2[<? echo $cont ?>]" value="<? echo $contnombre1 ?>" class="Estilo2" >
                         </td>

                         <td  class="<? echo $clase ?>"><? echo substr($row3["cont_vence"],8,2)."-".substr($row3["cont_vence"],5,2)."-".substr($row3["cont_vence"],0,4)   ?></td>
                         <td class="Estilo1c"><? echo number_format($row3["cont_total"],0,',','.')  ?> </td>
                         <td class="Estilo1c"><? echo $nombremoneda2  ?> </td>



                         <td class="Estilo1b"><? echo $row3["cont_nombre1"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["cont_nroresolucion"]  ?> </td>
<!--
                         <td class="Estilo1c"> <input alt="ok" type="text" name="var3[<? echo $cont ?>]" value="<? echo $utm ?>" class="Estilo2" size=5></td>
                         <td class="Estilo1c"> <input alt="ok" type="text" name="var4[<? echo $cont ?>]" value="<? echo $uf ?>" class="Estilo2" size=5> </td>
                         <td class="Estilo1c"> <input alt="ok" type="text" name="var5[<? echo $cont ?>]" value="<? echo $dolar ?>" class="Estilo2" size=5> </td>
                         <td class="Estilo1c"> <input alt="ok" type="radio" name="var6[<? echo $cont ?>]"  class="Estilo2" value="fijo"> </td>
                         <td class="Estilo1c"> <input alt="ok" type="radio" name="var6[<? echo $cont ?>]"  class="Estilo2" value="variable"> </td>
                         <td class="Estilo1c"> <input alt="ok" type="text" name="var7[<? echo $cont ?>]" value="" class="Estilo2" size=5> </td>
-->
                       </tr>

                        



<?

   $sumab=$sumab+$row3["hono_bruto"];
   $sumar=$sumar+$row3["hono_retencion"];
   $sumal=$sumal+$row3["hono_liquido"] ;
   $cont++;
   $cont1++;
}

?>
                               <input type="hidden" name="monto" value="<? echo $monto ?>" >
                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                               <input type="hidden" name="numfac" value="<? echo $numfac ?>" >
                               <input type="hidden" name="id1b" value="<? echo $id1b ?>" >
                               <input type="hidden" name="ori2" value="<? echo $ori2 ?>" >
                               <input type="hidden" name="swori" value="<? echo $swori ?>" >
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
                  <form name="form3" action="grababuscarcontrato.php" method="post"  onSubmit="return valida()" >
                     <table>
                       <tr>
                         <td class="Estilo1b">
                           <input type="submit" name="boton" class="Estilo2" value="  NO Asociar ">
                         </td>
                        </tr>
                               <input type="hidden" name="monto" value="<? echo $monto ?>" >
                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                               <input type="hidden" name="numfac" value="<? echo $numfac ?>" >
                               <input type="hidden" name="id1b" value="<? echo $id1b ?>" >
                               <input type="hidden" name="ori2" value="<? echo $ori2 ?>" >
                               <input type="hidden" name="swori" value="<? echo $swori ?>" >
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
