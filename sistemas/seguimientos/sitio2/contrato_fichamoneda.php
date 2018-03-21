<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
extract($_POST);
extract($_GET);
if ($nivel==23) {
  $regionsession = $region2;
} else {
   $regionsession = $_SESSION["region"];
}
$usuario=$_SESSION["nom_user"];
$regnombre=$_SESSION["regionnom"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$year=date("Y");
$year2=date("Y");


$sql="select * from dpp_contratos where cont_id=$id";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$evaluara=$row["cont_evaluara"];
$ejec2010=$row["cont_ejec2010"];
?>
<script type="text/javascript" src="jquery/jquery-1.6.4.js"></script>

<script language="JavaScript" type="text/javascript" src="ajax5.js"></script>
  <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />


<script type="text/javascript">
 //<![CDATA[
$(window).load(function(){
$('tr').bind('mouseover mouseout', function() {
    $(this).toggleClass("hover");
});
$('tr').bind('click', function() {
    $(this).toggleClass("active");

    if (event.target.type !== 'checkbox') {
        $(this).find("input[type=checkbox]").prop("checked", (!$(this).find("input[type=checkbox]").prop("checked")) );
    }
});
});//]]>


</script>
<script>
function cerrarventana(a,b){
//    alert(b);
//   window.opener.location.replace('vercontrato82.php?id='+a+'&tipodoc='+b);
   window.opener.location.replace('vercontrato82.php?id='+a+'&tipodoc='+b);
//   opener.document.form1.submit();
   window.close();
//alert('cerrando');
}
</script>
<style type="text/css">
<!--

tr td {
    background:#D8D8D8;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
}
tr.hover td {
    background: orange;
}
tr.active td {
    background: lightgreen;
}

.Estilo1 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: left;
}
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right !important;;
}
-->
</style>
<input type="button" name="Submit" value="Cerrar ventana" onclick="JavaScript: window.close();">
<br><br>

					<table width="485" border="0" cellspacing="0" cellpadding="0">

                           <tr>
                             <td  valign="center" class="Estilo1"  width="120">Nombre Empresa </td>
                             <td class="Estilo1" colspan=3 >
                                 <? echo $row["cont_nombre"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Rut Empresa  </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo $row["cont_rut"]."-".$row["cont_dig"]; ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Contrato </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo $row["cont_nombre1"]; ?>
                             </td>
                           </tr>
<?
$fechainicio=$row["cont_fechainicio"];
$fechavence=$row["cont_vence"];
$fechainicio=substr($fechainicio,8,2)."-".substr($fechainicio,5,2)."-".substr($fechainicio,0,4);
$fechavence=substr($fechavence,8,2)."-".substr($fechavence,5,2)."-".substr($fechavence,0,4);

?>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Inicio </td>
                             <td class="Estilo1" valign="center">
                                 <? echo $fechainicio; ?>                             </td>
                           </tr>


                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Vencimiento</td>
                             <td class="Estilo1" valign="center">
                                 <? echo $fechavence; ?>                             </td>
                           </tr>
<?
$tipomoneda2=$row["cont_tipo2"];
$sql2 = "Select * from dpp_monedas where mone_id=$tipomoneda2";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda2=$row2["mone_tipo"];
$montoejecutado22=$row["cont_total"];

?>

                           <tr>
                             <td  valign="center" class="Estilo1">Monto total </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo number_format($row["cont_total"],0,",","."); ?> <? echo $nombremoneda2; ?>
                             </td>
                           </tr>



                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1"  width="250">
                                 <? echo $row["cont_region"]; ?>
                             </td>
                           </tr>
<?
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fecha_recepcion"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24));

    $fechainicio=$row["cont_fechainicio"];
$annoactual=date ("Y");
$fechauno=$fechainicio;

$fecha_de_nacimiento = $row["cont_fechainicio"];
$fecha_actual = date ("Y-m-d");
//$fecha_actual = date ("2006-03-05"); //para pruebas



// separamos en partes las fechas
$array_nacimiento = explode ( "-", $fecha_de_nacimiento );
$array_actual = explode ( "-", $fecha_actual );

$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años
$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días

//ajuste de posible negativo en $días
if ($dias < 0)
{
    --$meses;

    //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
    switch ($array_actual[1]) {
           case 1:     $dias_mes_anterior=31; break;
           case 2:     $dias_mes_anterior=31; break;
           case 3:
                if (bisiesto($array_actual[0]))
                {
                    $dias_mes_anterior=29; break;
                } else {
                    $dias_mes_anterior=28; break;
                }
           case 4:     $dias_mes_anterior=31; break;
           case 5:     $dias_mes_anterior=30; break;
           case 6:     $dias_mes_anterior=31; break;
           case 7:     $dias_mes_anterior=30; break;
           case 8:     $dias_mes_anterior=31; break;
           case 9:     $dias_mes_anterior=31; break;
           case 10:     $dias_mes_anterior=30; break;
           case 11:     $dias_mes_anterior=31; break;
           case 12:     $dias_mes_anterior=30; break;
    }

    $dias=$dias + $dias_mes_anterior;
}

//ajuste de posible negativo en $meses
if ($meses < 0)
{
    --$anos;
    $meses=$meses + 12;
}

//echo "<br>Tu edad es: $anos años con $meses meses y $dias días";

function bisiesto($anio_actual){
    $bisiesto=false;
    //probamos si el mes de febrero del año actual tiene 29 días
      if (checkdate(2,29,$anio_actual))
      {
        $bisiesto=true;
    }
    return $bisiesto;
}

$anual=$row["cont_anual"];
$cuotas=$anual/12;
$tmeses=$cuotas*$meses;

$anos2=$anos;
$meses2=$meses;
$dias2=$dias;
?>


                           <tr>
                             <td  valign="center" class="Estilo1">Antiguedad </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo " $anos año - $meses mes " ?>
                             </td>
                           </tr>
<?
$tipomoneda1=$row["cont_tipo1"];
$sql2 = "Select * from dpp_monedas where mone_id=$tipomoneda1";
//echo $sql2;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda1=$row2["mone_tipo"];


$tipomoneda3=$row["cont_tipo3"];
$sql2 = "Select * from dpp_monedas where mone_id=$tipomoneda3";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda3=$row2["mone_tipo"];




?>




<?
//-------------- calculo del los meses de este año
$annoactual=date ("Y");
$fechauno="$annoactual-01-01";


$fecha_de_nacimiento = $fechauno;
$fecha_actual = date ("Y-m-d");
//$fecha_actual = date ("2006-03-05"); //para pruebas



// separamos en partes las fechas
$array_nacimiento = explode ( "-", $fecha_de_nacimiento );
$array_actual = explode ( "-", $fecha_actual );

$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años
$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días

//ajuste de posible negativo en $días
if ($dias < 0)
{
    --$meses;

    //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
    switch ($array_actual[1]) {
           case 1:     $dias_mes_anterior=31; break;
           case 2:     $dias_mes_anterior=31; break;
           case 3:
                if (bisiesto($array_actual[0]))
                {
                    $dias_mes_anterior=29; break;
                } else {
                    $dias_mes_anterior=28; break;
                }
           case 4:     $dias_mes_anterior=31; break;
           case 5:     $dias_mes_anterior=30; break;
           case 6:     $dias_mes_anterior=31; break;
           case 7:     $dias_mes_anterior=30; break;
           case 8:     $dias_mes_anterior=31; break;
           case 9:     $dias_mes_anterior=31; break;
           case 10:     $dias_mes_anterior=30; break;
           case 11:     $dias_mes_anterior=31; break;
           case 12:     $dias_mes_anterior=30; break;
    }

    $dias=$dias + $dias_mes_anterior;
}

//ajuste de posible negativo en $meses
if ($meses < 0)
{
    --$anos;
    $meses=$meses + 12;
}

//echo "<br>Tu edad es: $anos años con $meses meses y $dias días";


$anual=$row["cont_anual"];
$cuotas=$anual/12;
$tmeses=$cuotas*$meses;


//--------------

$montoanual2=$row["cont_total"];
$montoanual=$row["cont_anual"];
$montomensual=$montoanual/12;
$montoejecutado=$montomensual*$meses;
$diferencia=$montoanual-$montoejecutado;

     $cont_id=$row["cont_id"];
     $sql22 = "Select sum(fac_monto) as facturamonto, avg(fac_valortipo) as promediotipo from dpp_contratos x, dpp_cont_fac y, dpp_facturas z where x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id group by y.confa_cont_id order by x.cont_id desc ";
     //echo $sql22;
     $res22=mysql_query($sql22);
     if (!isset($res22)) {
       $row22 = mysql_fetch_array($res22);
//       echo "Entra";
     }

     $facturamonto=$row22["facturamonto"];
     $promediotipo=$row22["promediotipo"];

?>
              </table>

                      </td></tr>
                     <tr><td>
                  <div id="seccion1" style="display:">
                  <br>
                  


<?

if ($sw==1) {
//echo $tipodoc;
      $sql3=" update dpp_contratos set cont_total=$montototal, cont_tipo2=$tipomonedatotal where cont_id=$id  ";
//   echo $sql3;
//   exit();
     mysql_query($sql3);
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);
// Para UF
      $sql3=" update dpp_facturas set fac_valortipo='$monto1',  fac_fechatipo='$fecha1', fac_montotipo=fac_monto/$monto1  where fac_id=$facid  ";
//   echo $sql3."<br><br>";
//   exit();
     mysql_query($sql3);

// Para UTM
    $sql3=" update dpp_facturas set fac_valortipo2='$monto2',  fac_fechatipo2='$fecha2', fac_montotipo2=fac_monto/$monto2 where fac_id=$facid  ";
//   echo $sql3."<br><br>";
//   exit();
     mysql_query($sql3);

// Para Dolar
     $sql3=" update dpp_facturas set fac_valortipo3='$monto3',  fac_fechatipo3='$fecha3', fac_montotipo3=fac_monto/$monto3 where fac_id=$facid  ";
//   echo $sql3."<br><br>";
//   exit();
     mysql_query($sql3);
//     exit();

    echo "<script>cerrarventana($id,$tipodoc);</script>";
}

// ?id=442&tipodoc=1

     $sql22 = "Select * from dpp_facturas where fac_id=$facid";
//     echo $sql22;
     $res22=mysql_query($sql22);
     $row22 = mysql_fetch_array($res22);
/*
     if (!isset($res22)) {

       $row22 = mysql_fetch_array($res22);
//       echo "Entra";

     }
*/
     $facvalortipo1=$row22["fac_valortipo"];
     $facvalortipo2=$row22["fac_valortipo2"];
     $facvalortipo3=$row22["fac_valortipo3"];
//     echo  $row22["fac_fechatipo"];
     $facfechatipo1=$row22["fac_fechatipo"];
     $facfechatipo2=$row22["fac_fechatipo2"];
     $facfechatipo3=$row22["fac_fechatipo3"];

     $facfechatipo1=substr($facfechatipo1,8,2)."-".substr($facfechatipo1,5,2)."-".substr($facfechatipo1,0,4);
     $facfechatipo2=substr($facfechatipo2,8,2)."-".substr($facfechatipo2,5,2)."-".substr($facfechatipo2,0,4);
     $facfechatipo3=substr($facfechatipo3,8,2)."-".substr($facfechatipo3,5,2)."-".substr($facfechatipo3,0,4);
//       echo "-->".$facfechatipo1;


?>

<form action="contrato_fichamoneda.php" name="buscar" method="post" enctype="multipart/form-data">

		          <table width="488" border="1" cellspacing="0" cellpadding="0">
                           <tr>
                             <td  valign="center" class="Estilo1">Monto Total del Contrato</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="montototal" class="Estilo2" size="20" value="<? echo $row["cont_total"] ?>">
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Tipo Meneda</td>
                             <td class="Estilo1" colspan=3>
                              <select name="tipomonedatotal" class="Estilo1">
                                    <option value="1"  <? if ($row["cont_tipo2"]==1) { echo "selected=selected";  } ?> >Pesos</option>
                                    <option value="2"  <? if ($row["cont_tipo2"]==2) { echo "selected=selected";  } ?> >Dolar</option>
                                    <option value="3"  <? if ($row["cont_tipo2"]==3) { echo "selected=selected";  } ?> >UTM</option>
                                    <option value="4"  <? if ($row["cont_tipo2"]==4) { echo "selected=selected";  } ?> >UF</option>

                               </select>
                             </td>
                           </tr>
</table>
<br><br>
                  
		          <table width="488" border="1" cellspacing="0" cellpadding="0">

                   <tr>
                             <td  valign="center" class="Estilo1">Fecha Monto UF</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $facfechatipo1 ?>" id="f_date_c1" readonly="1" onchange="meses();">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" onclick="meses();"/>

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c1",
        trigger    : "f_trigger_c1",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>



                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Monto Moneda UF</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="monto1" class="Estilo2" size="20" value="<? echo $facvalortipo1 ?>">
                             </td>
                           </tr>

<tr>
<td colspan=2>&nbsp</td>
</tr>
            
                   <tr>
                             <td  valign="center" class="Estilo1">Fecha Monto UTM</td>
                             <td class="Estilo1" valign="center">

<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $facfechatipo2 ?>" id="f_date_c2" readonly="1" onchange="meses();">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" onclick="meses();"/>

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c2",
        trigger    : "f_trigger_c2",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>
                             
                             


                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Monto Moneda UTM</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="monto2" class="Estilo2" size="20" value="<? echo $facvalortipo2 ?>">
                             </td>
                           </tr>

<tr>
<td colspan=2>&nbsp</td>
</tr>


                   <tr>
                             <td  valign="center" class="Estilo1">Fecha Monto Dolar</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo $facfechatipo2 ?>" id="f_date_c3" readonly="1" onchange="meses();">
<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" onclick="meses();"/>

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c3",
        trigger    : "f_trigger_c3",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>



                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Monto Moneda Dolar</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="monto3" class="Estilo2" size="20" value="<? echo $facvalortipo3 ?>">
                             </td>
                           </tr>
<tr>
<td colspan=2>&nbsp</td>
</tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR MONTO    " > </td>
                           </tr>
                           <tr>
                             <td colspan=4 align="center"><br></td>
                           </tr>
                         </table>
                     <input type="hidden" name="sw" value='1' >
                     <input type="hidden" name="action" value='<? echo $action ?>' >
                     <input type="hidden" name="id" value='<? echo $id ?>' >
                     <input type="hidden" name="facid" value='<? echo $facid ?>' >
                     <input type="hidden" name="tipodoc" value='<? echo $tipodoc ?>' >
                     <input type="hidden" name="ori" value='2' >
                     

</form>



